<?php

namespace App\Http\Controllers\Messages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageInboxController extends Controller
{
    //
    public function index() {
        return view('messages.inbox');
    }
}
