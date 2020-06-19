<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return \response()->json($users,200);
    }
}
