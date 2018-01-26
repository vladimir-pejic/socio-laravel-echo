<?php

namespace App\Http\Controllers\User;

use App\Models\Users\UserProfile;
use App\Models\Users\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function show($user_alias) {
        if(UserProfile::where('profile_url', $user_alias)->first()) {
            $profile = UserProfile::where('profile_url', $user_alias)->firstOrFail();
            $profile = $profile->user;
        } else {
            $profile = User::where('uid', $user_alias)->firstOrFail();
        }

        $statuses = $profile->statuses;
        return view('user.profile.profile', compact('profile', 'statuses'));


    }
}
