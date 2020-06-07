<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
{
    public function index()
    {      
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function blockUser(User $user)
    {   

        if($user->status == 0)
        {
            $user->status = 1;
        }
        else{
            $user->status = 0;
        }
        $user->save();

        if($user->status == 0)
        {
            $status = 'Active';
        }
        else{
            $status = 'Block';
        }

        return response()->json(
            ['status' => $status]
        , 200);
    }
}
