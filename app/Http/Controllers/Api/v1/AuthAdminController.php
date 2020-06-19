<?php

namespace App\Http\Controllers\Api\v1;

use App\Role;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AuthAdminController extends Controller
{   
    public function __construct()
    {
        Auth::shouldUse('apiAdmin');
    }
    
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255|unique:admins',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'selectrole' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->passes())
        {
            $admin = Admin::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $superAdmin = Role::where('name',$request->selectrole)->first();
    
            $admin->role()->attach($superAdmin);
    
            return response()->json([
                'admin' => $admin,
                'role' => $request->selectrole
            ], 200);
        }

        return response()->json(['error'=>$validator->errors()->all()],400);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'    => 'required|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()],400);
        }

        Config::set('jwt.user', 'App\Admin'); 
		Config::set('auth.providers.users.model', \App\Admin::class);
        $token = null;
        if($token = JWTAuth::attempt(['username' => $request->username, 'password' => $request->password])){
            return response()->json([
                'response' => 'success',
                'result' => [
                    'token' => $token,
                    'message' => 'I am admin',
                ],
            ]);
        }
        return response()->json(['error'=>'Email or Password not correct'],401);
    }

    public function logout(Request $request)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        Auth::guard('apiAdmin')->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function admin(Request $request)
    {   
        if(Auth::check())
        {
            return response()->json([
                'status' => true,
                'response' => Auth::user(),
                'message' => 'Check Success'
            ], 200);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Check Error'
            ], 401);
        }
    }
}
