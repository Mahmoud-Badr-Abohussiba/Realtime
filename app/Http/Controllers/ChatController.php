<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard
     *
     * @return Renderable
     */
    public function showChat()
    {
        return view('chat.show');
    }

    public function messageReceived(Request $request)
    {
        $rules = [
            'message'=>'required'
        ];
        $request->validate($rules);

        broadcast(new MessageSent($request->user(),$request->message));

        return response()->json('Message broadcast');
    }

}
