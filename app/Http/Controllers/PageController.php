<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function index()
    {
        $questions = [
            'Why is this awesome?',
            'Why always me?',
            'What if i did this',
            'What about the other day again?'
        ];
        return view('welcome')->with('questions', $questions);
    }

    public function about()
    {
        return 'ABOUT US PAGE';
    }
    public function profile($id)
    {
        $user = User::with(['questions', 'answers', 'answers.question'])->find($id);

        if(!$user){
            abort(404);
        } else {
            return view('profile')->with('user', $user);
        }
    }
    public function contact()
    {
        return view('contact');
    }
    public function sendContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10'
        ]);

        Mail::to('admin@example.com')->send(new ContactForm($request));

        return redirect('/');
    }
}
