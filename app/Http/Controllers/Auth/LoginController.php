<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Users\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login() {
        return view('auth.login');
    }


    public function loginUser(Request $request)
    {
        // Validation and validation rules.
        $rules = [
            'email' => 'required|email|max:120'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);
        // Find user by email.
        $user = Sentinel::findByCredentials(['email' => $request->email]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        // Check if user exists.
        if ($user) {
            // If user didn't activate.
            if (Activation::exists($user)) {
                $request->session()->flash('alert-error', 'User not activated.');
                return redirect()->back();
            }
            // If activation completed.
            if (Activation::completed($user)) {
                // If checked remember me.
                if ($request->remember) {
                    if (Sentinel::authenticateAndRemember($credentials)) {
                        $profile = User::getUser();
                        // On success go to home, profile, whatever
                        if($profile->profile->profile_url != null)
                            return redirect()->route('profile', $profile->profile->profile_url);
                        else
                            return redirect()->route('profile', $profile->uid);

                    } else {
                        $request->session()->flash('alert-error', 'Wrong Password.');
                        return redirect()->back();

                    }
                } else {
                    if (Sentinel::authenticate($credentials)) {
                        $profile = User::getUser();
                        // On success go to home, profile, whatever
                        if($profile->profile->profile_url != null)
                            return redirect()->route('profile', $profile->profile->profile_url);
                        else
                            return redirect()->route('profile', $profile->uid);

                    } else {
                        $request->session()->flash('alert-error', 'Wrong Password.');
                        return redirect()->back();
                    }
                }
            }
        } else {
            $request->session()->flash('alert-error', 'User does not exist.');
            return redirect()->back();
        }

    }

    public function logout()
    {
        Sentinel::logout();
        return redirect('/');
    }

}
