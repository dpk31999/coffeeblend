<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Post;

class PostController extends Controller
{
    public function index()
    {   
        if (Auth::guard('admin')->user()->hasrole(['author']))
        {
            $posts = Post::where('admin_id',Auth::guard('admin')->user()->id)->get();
        }
        else {
            $posts = Post::all();
        }
        return view('admin.posts',\compact('posts'));
    }

    public function formAdd()
    {
        return view('admin.posteditoradd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
            'keyword' =>'required|string',
            'content' => 'required|string',
        ]);

        $image = $request->url_image;

        $image_path = 'thumbpost/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/thumbpost');
        $image->move($path ,$image_path);

        $post = Post::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'url_thumb' => $image_path,
            'slug' => $request->slug,
            'keyword' => $request->keyword,
            'status' => '0',
            'view' => '0'
        ]);

        return \redirect()->route('admin.post');
    }

    public function formEdit(Post $post)
    {
        return view('admin.posteditoradd',\compact('post'));
    }

    public function detroy(Post $post)
    {
        if(File::exists(public_path('storage/' . $post->url_thumb))){

            File::delete(public_path('storage/' . $post->url_thumb));
        }

        $post->delete();
    }

    public function changeStatus(Post $post)
    {
        if($post->status == 0)
        {
            $post->status = 1;
        }
        else{
            $post->status = 0;
        }
        $post->save();

        if($post->status == 0)
        {
            $status = 'Unavailable';
        }
        else{
            $status = 'Available';
        }

        return response()->json(
            ['status' => $status]
        , 200);
    }
}
