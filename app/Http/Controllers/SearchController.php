<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $bestSeller = Product::bestSeller();
        $cateupper = strtoupper($request->result);
        $products = Product::where('name', 'like', '%' . $request->result . '%')->get();
        $category = Category::where('name', $cateupper)->first();
        $categories = Category::all();
        $posts = Post::withCount('comments')->orderByDesc('comments_count')->skip(0)->take(3)->get();

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
