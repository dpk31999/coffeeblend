<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // $this->validator($request);

        //check if the user has too many login attempts.
        // if ($this->hasTooManyLoginAttempts($request)){
        //     //Fire the lockout event
        //     $this->fireLockoutEvent($request);

        //     //redirect the user back after lockout.
        //     return $this->sendLockoutResponse($request);
        // }

        $username = $request->input('username');
        $password = $request->input('password');
        //attempt login.
        if(Auth::guard('admin')->attempt(['username' => $username, 'password' =>$password])){
            //Authenticated, redirect to the intended route
            //if available else admin dashboard.
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are Logged in as Admin!');
        }

        //keep track of login attempts from the user.
        // $this->incrementLoginAttempts($request);

        //Authentication failed, redirect back with input.
        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('status','Admin has been logged out!');
    }

    // private function validator(Request $request)
    // {
    //     //validation rules.
    //     $rules = [
    //         'username'    => 'required|exists:admins|min:5|max:191',
    //         'password' => 'required|string|min:4|max:255',
    //     ];

    //     //custom validation error messages.
    //     $messages = [
    //         'email.exists' => 'These credentials do not match our records.',
    //     ];

    //     //validate the request.
    //     $request->validate($rules,$messages);
    // }

    private function loginFailed(){
        return view('admin.auth.login',[
            'error' => 'Username or Password not correct'
        ]);
    }
}
