<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = Post::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'phone' => 'required|unique:posts|numeric'
        ])->validate();

        $post = new Post;
        $post->phone = $request->phone;
        $post->save();

        $this->sendMessage('Post registered successfully!!', $request->phone);
        return back()->with(['success' => "{$request->phone} registered"]);
    }
   
    public function sendCustomMessage(Request $request)
    {
        \Validator::make($request->all(), [
            'post' => 'required|array',
            'body' => 'required',
        ])->validate();
        $recipients = $request->post;
     
        foreach ($recipients as $recipient) {
            $this->sendMessage($request->body, $recipient);
        }
        return back()->with(['success' => "Message on its way to recipients!"]);
    }
   
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }
}