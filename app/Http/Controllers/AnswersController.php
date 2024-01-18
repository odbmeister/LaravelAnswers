<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Notifications\NewAnswerSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:15',
            'question_id' => 'required|integer'
        ]);

        $answer = new Answer();
        $answer->content = $request->get('content');
        $answer->user()->associate(Auth::id());

        $question = Question::findOrFail($request->question_id);
        $question->answers()->save($answer);
        $question->user->notify(new NewAnswerSubmitted($answer, $question, Auth::user()->name));


        return redirect()->route('questions.show', $question->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $answer = Answer::findOrFail($id);
        if($answer->user->id != Auth::id()){
            return abort(403);
        }
        return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $answer = Answer::findOrFail($id);
        if($answer->user->id != Auth::id()){
            return abort(403);
        }

        //validate the form data
        $this->validate($request, [
            'content' => 'required|min:15',
        ]);

        //update the answer
        $answer->content = $request->get('content');

        //save the updated answer
        $answer->save();

        //redirect to the question's page
        return redirect()->route('questions.show', $answer->question->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
