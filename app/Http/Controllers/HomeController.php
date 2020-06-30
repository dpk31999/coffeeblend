<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Admin;
use App\Invoice;
use App\Booking;

class HomeController extends Controller
{
    public function index()
    {   
        
        $bestSeller = Product::bestSeller();
        
        $mainDish = Product::callCategory('MAIN DISH')->take(3);

        $desserts = Product::callCategory('DESSERTS')->take(3);

        $drinks = Product::callCategory('DRINKS')->take(3);

        $count_product = Product::all()->count();

        $count_order = Invoice::all()->count();

        $count_booking = Booking::all()->count();

        $count_admin = Admin::all()->count();

        $title = 'Home';
        
        return view('client.home',compact('bestSeller','mainDish','desserts','drinks','title','count_product','count_order','count_booking','count_admin'));
    }

    public function getCate(Category $cate)
    {   
        $title = $cate->name;
        return view('client.category',\compact('cate','title'));
    }
}
