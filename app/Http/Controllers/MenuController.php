<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class MenuController extends Controller
{
    public function index()
    {   
        $starters = Product::callCategory('STARTER');

        $mainDish = Product::callCategory('MAIN DISH');

        $desserts = Product::callCategory('DESSERTS');

        $drinks = Product::callCategory('DRINKS');

        $title = 'Menu';

        return view('client.menu',\compact('starters','mainDish','desserts','drinks','title'));
    }
}
