<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {   
        $bestSeller = Product::withCount('invoice')->orderByDesc('invoice_count')->skip(0)->take(4)->get();
        $title = $product->name;

        return view('client.singleproduct',\compact('product','bestSeller','title'));
    }
}
