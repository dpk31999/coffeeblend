<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $bestSeller = Product::withCount('invoice')->orderByDesc('invoice_count')->skip(0)->take(4)->get();
        
        $mainDish = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'MAIN DISH');
        })->take(3)->get();

        $desserts = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'DESSERTS');
        })->take(3)->get();

        $drinks = Product::with('category')
        ->whereHas('category', function($query) {
            $query->where('name', 'DRINKS');
        })->take(3)->get();

        $title = 'Home';
        
        return view('client.home',compact('bestSeller','mainDish','desserts','drinks','title'));
    }

    public function getCate(Category $cate)
    {   
        $title = $cate->name;
        return view('client.category',\compact('cate','title'));
    }
}
