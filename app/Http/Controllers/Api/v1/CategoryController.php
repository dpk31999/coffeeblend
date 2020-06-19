<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('apiAdmin');
    }

    public function index()
    {
        $categories = Category::all();

        return response()->json($categories, 200);
    }

    public function validateCate($request)
    {
        return $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:category',
        ]);
    }

    public function store(Request $request)
    {   
        if ($this->validateCate($request)->passes()) {

            if(Auth::check() == false)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $cate = Category::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
            ]);
    
            return response()->json([
                'message' => 'success',
                'category' => $cate
            ], 200);
        }

    	return response()->json(['error'=>$this->validateCate($request)->errors()->all()],405);
    }

    public function show(Category $category)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'success',
            'category' => $category
        ], 200);
    }

    public function update(Category $category,Request $request)
    {   
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $category->update($request->all());

        return response()->json([
            'message' => 'success',
            'category' => $category
        ], 200);
    }

    public function destroy(Category $category)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        try {
            $category->products()->delete();

            $category->delete();

            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th,
            ], 500);
        }
    }
}
