<?php

namespace App\Http\Controllers\Messages;

use App\Events\ChatMessagePosted;
use App\Models\Messages\ChatMessage;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatMessagesController extends Controller
{
    //
    public function index() {
        return view('chat.index');
    }

    public function all() {
        return ChatMessage::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request) {
        $user = User::getUser();
        $message =$user->chat_messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new ChatMessagePosted($message, $user))->toOthers();

        return ['status' => 'OK'];
    }
}
