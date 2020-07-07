<?php

namespace App\Http\Controllers\Api\v1;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('apiAdmin');
    }

    public function index()
    {
        $products = Product::all();

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {       
        if(isset($request->url_image)){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:products',
                'price' => 'required',
                'selectcate' => 'required',
                'description' => 'required|string|min:5',
                'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:products',
                'price' => 'required',
                'selectcate' => 'required',
                'description' => 'required|string|min:5',
                'url_image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
            ]);
        }

        if ($validator->passes()) {

            if(Auth::check() == false)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $category = Category::where('name',$request->selectcate)->first();

            if(isset($request->url_image))
            {
                $image = $this->handleUpload($request);
            }
            else {
                $image = 'uploads/default_product.jpg';
            }

            $product = Product::create([
                'cate_id' => $category->id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'url_image' => $image
            ]);
    
            return response()->json([
                'message' => 'success',
                'product' => $product
            ], 200);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'message' => 'success',
            'product' => $product
        ], 200);
    }

    public function update(Product $product,Request $request)
    {   
        if($request->name == $product->name)
        {   
            if(isset($request->url_image)){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'price' => 'required',
                    'selectcate' => 'required',
                    'description' => 'required|string|min:5',
                    'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'price' => 'required',
                    'selectcate' => 'required',
                    'description' => 'required|string|min:5',
                ]);
            }
        }
        else{
            if(isset($request->url_image)){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255|unique:products',
                    'price' => 'required',
                    'selectcate' => 'required',
                    'description' => 'required|string|min:5',
                    'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255|unique:products',
                    'price' => 'required',
                    'selectcate' => 'required',
                    'description' => 'required|string|min:5',
                ]);
            }
        }

        if ($validator->passes()) {

            if(Auth::check() == false)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            if(isset($request->url_image))
            {
                $this->handleDelete($product);
    
                $image_path = $this->handleUpload($request);
            }
            else{
                $image_path = 'uploads/' . $request->url_image_src;
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->cate_id = Category::where('name',$request->selectcate)->first()->id;
            $product->description = $request->description;
            $product->url_image = $image_path;

            $product->save();
    
            return response()->json([
                'product' => $product,
                'cate_name' => $request->selectcate,
            ], 200);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function destroy(Product $product)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        try {
            $this->handleDelete($product);
            $product->delete();

            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th,
            ], 500);
        }
    }

    public function handleDelete($product)
    {
        $productService = ProductService::create();

        $productService->handleDeleteImageProduct($product);
    }

    public function handleUpload($request)
    {
        $productService = ProductService::create();

        $image = $productService->handleUploadImageProduct($request);

        return $image;
    }
}
