<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Post;

class SearchController extends Controller
{
    public function upperResult($request)
    {
        return strtoupper($request->result);
    }

    public function search(Request $request)
    {   
        $bestSeller = Product::bestSeller();
        $products = Product::searchByName($request->result);
        $category = Category::searchByName($this->upperResult($request));
        $categories = Category::all();
        $posts = Post::postTrend()->take(3);

        $title = $request->result;

        return view('client.search',[
            'bestSeller'=> $bestSeller,
            'products' => $products,
            'category' => $category,
            'posts' => $posts,
            'keyword' => $request->result,
            'categories' => $categories,
            'title' => $title
        ]);
    }
}
