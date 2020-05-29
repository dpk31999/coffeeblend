<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        $categories = Category::all();
        return view('admin.products',compact('products','categories'));
    }

    public function addProduct(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products',
            'price' => 'required',
            'selectcate' => 'required',
            'description' => 'required|string|min:5',
            'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
        ]);

        if ($validator->passes()) {
            $category = Category::where('name',$request->selectcate)->first();

            $image = $request->url_image;

            $image_path = 'uploads/' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/uploads');
            $image->move($path ,$image_path);

            $product = Product::create([
                'cate_id' => $category->id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'url_image' => $image_path
            ]);
    
            return response()->json([
                'product' => $product,
                'url_image' => $image_path,
                'cate_name' => $request->selectcate
            ], 200);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->product_id);

        if(File::exists(public_path('storage/' . $product->url_image))){

            File::delete(public_path('storage/' . $product->url_image));
        }

        $product->delete();
    }

    public function getProduct(Request $request,Product $product)
    {
        return response()->json([
            'product' => $product,
            'cate_name' => $product->category->name,
            'url_image' => $product->url_image
        ], 200);
    }

    public function editProduct(Request $request,Product $product)
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

            if(isset($request->url_image))
            {
                if(File::exists(public_path('storage/' . $product->url_image))){

                    File::delete(public_path('storage/' . $product->url_image));
                }
    
                $image = $request->url_image;
    
                $image_path = 'uploads/' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('/storage/uploads');
                $image->move($path ,$image_path);
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
}
