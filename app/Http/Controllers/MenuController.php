<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class MenuController extends Controller
{
    public function index()
    {   
        $starters = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'STARTER');
        })->get();

        $mainDish = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'MAIN DISH');
        })->get();

        $desserts = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'DESSERTS');
        })->get();

        $drinks = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'DRINKS');
        })->get();

        $title = 'Menu';

        return view('client.menu',\compact('starters','mainDish','desserts','drinks','title'));
    }
}
