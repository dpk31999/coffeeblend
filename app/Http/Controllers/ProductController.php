<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {   
        $bestSeller = Product::bestSeller();
        $title = $product->name;

        return view('client.singleproduct',\compact('product','bestSeller','title'));
    }
}
