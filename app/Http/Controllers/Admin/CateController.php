<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CateController extends Controller
{
    public function index()
    {   
        $categories = Category::all();
        return view('admin.categories',compact('categories'));
    }

    public function validateCate($request)
    {
        return $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:category',
        ]);
    }

    public function addCate(Request $request)
    {   
        if ($this->validateCate($request)->passes()) {
            $cate = Category::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
            ]);
    
            return response()->json([
                'cate' => $cate,
                'total_products' => $cate->products->count(),
                'create_by' => $cate->admin->username,
                'role' => $cate->admin->get_role()->name
            ], 200);
        }

    	return response()->json(['error'=>$this->validateCate($request)->errors()->all()]);
    }

    public function deleteCate(Request $request)
    {
        $cate_id = $request->cate_id;

        $cate = Category::find($cate_id);

        $cate->products()->delete();

        $cate->delete();
    }

    public function getCate(Category $cate)
    {   
        return response()->json([
            'cate_name' => $cate->name,
        ], 200);
    }

    public function editCate(Request $request,Category $cate)
    {       
        if($request->name == $cate->name){
            return response()->json(['success'=>'200 ok']);
        }

        if ($this->validateCate($request)->passes()) {
            $cate->name = $request->name;
            $cate->save();
    
            return response()->json([
                'name' => $request->name,
            ], 200);
        }

        return response()->json(['error'=>$this->validateCate($request)->errors()->all()]);
    }
}
