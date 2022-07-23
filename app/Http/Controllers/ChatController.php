<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chats');
    }

    public function fetchMessages(Request $request)
    {

        return Message::where(['sender_id' => $request->sender, 'reciver_id' => $request->reciver])
            ->Orwhere(['sender_id' => $request->reciver, 'reciver_id' => $request->sender])
            ->get();
    }

    public function fetchUsers()
    {
        return User::all()->except(Auth::id());
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => $request[0]['sender_id'],
            'reciver_id' => $request[0]['reciver_id'],
            'message' => $request[0]['message']
        ]);

        broadcast(new MessageEvent($message))->toOthers();

        return ['status' => 'success'];
    }
}
