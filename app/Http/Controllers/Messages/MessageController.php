<?php

namespace App\Http\Controllers\Messages;

use App\Events\MessagePosted;
use App\Models\Messages\Message;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MessageController extends Controller
{

    public function all() {
        return Message::with('user')->get();
    }

    public function store(Request $request) {
        $user = User::getUser();
        $message =$user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessagePosted($message, $user))->toOthers();

        return ['status' => 'OK'];
    }
}
