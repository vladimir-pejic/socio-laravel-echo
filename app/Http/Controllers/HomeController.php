<?php

namespace App\Http\Controllers;

use App\Models\Statuses\UserStatus;
use App\Models\Users\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index() {
        $user = User::getUser();
        $statuses = UserStatus::orderBy('created_at', 'desc')->get();
        return view('user.home.home', compact('user', 'statuses'));
    }
}
