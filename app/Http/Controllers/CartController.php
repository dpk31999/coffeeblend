<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index()
    {   
        $title = 'Cart';
        return view('client.cart',\compact('title'));
    }
}
