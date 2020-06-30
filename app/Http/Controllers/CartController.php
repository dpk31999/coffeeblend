<?php

namespace App\Http\Controllers;

use Session;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {   
        $title = 'Cart';
        $bestSeller = Product::bestSeller();
        return view('client.cart',\compact('title','bestSeller'));
    }
}
