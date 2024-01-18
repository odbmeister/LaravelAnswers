<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'create']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // go to the model and get a group of records
        $questions = Question::orderBy('id', 'desc')->paginate(5);
        // return the view, and pass in the group of records to loop through
        return view('index')->with('questions', $questions);
    }

    public function showall()
    {
        // go to the model and get a group of records
        $questions = Question::all();
        // return the view, and pass in the group of records to loop through
        return view('showall')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the form data
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);
        // process the data and submit it
        $question = new Question();
        $question->title = $request->title;
        $question->description = $request->description;
        $question->user()->associate(Auth::id());

        // if successful we want to redirect
        if ($question->save()) {
            return redirect()->route('questions.show', $question->id);
        } else {
            return redirect()->route('questions.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Use the model to get 1 record from the database
        $question = Question::findOrFail($id);
        // Show the view and pass the record to the view
        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        if($question->user->id != Auth::id()){
            return abort(403);
        }
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::findOrFail($id);
        if($question->user->id != Auth::id()){
            return abort(403);
        }

        //validate the form data
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        //update the question
        $question->title = $request->title;
        $question->description = $request->description;

        //save the updated question
        $question->save();

        //redirect to the updated question's page
        return redirect()->route('questions.show', $question->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
