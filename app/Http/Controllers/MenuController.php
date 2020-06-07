<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class MenuController extends Controller
{
    public function index()
    {   
        $starters = Product::callCategory('STARTER')->get();

        $mainDish = Product::callCategory('MAIN DISH')->get();

        $desserts = Product::callCategory('DESSERTS')->get();

        $drinks = Product::callCategory('DRINKS')->get();

        $title = 'Menu';

        return view('client.menu',\compact('starters','mainDish','desserts','drinks','title'));
    }
}
