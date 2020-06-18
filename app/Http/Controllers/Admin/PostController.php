<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Post;

use App\Services\PostService;
use App\Http\Requests\PostRequest;

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

    public function store(PostRequest $request)
    {
        $image = $this->handleUploadStore($request);

        $post = Post::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'url_thumb' => $image,
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

    public function edit(Request $request,Post $post)
    {   
        if(isset($request->url_image)){

            $request->validate([
                'title' => 'required|string',
                'slug' => 'required|string|unique:posts,slug,' . $post->id,
                'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
                'keyword' =>'required|string',
                'content' => 'required|string',
            ]);

            $image = $this->handleUploadEdit($request,$post);

        }

        else{
            $request->validate([
                'title' => 'required|string',
                'slug' => 'required|string|unique:posts,slug,' . $post->id,
                'url_image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
                'keyword' =>'required|string',
                'content' => 'required|string',
            ]);

            $image = $post->url_thumb;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->url_thumb = $image;
        $post->slug = $request->slug;
        $post->keyword = $request->keyword;
        $post->save();
        
        return \redirect()->route('admin.post');
    }

    public function detroy(Post $post)
    {
        $this->deleteExistThumb($post);

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

    public function handleUploadEdit($request,$post)
    {
        $postService = PostService::create();

        $postService->handleDeleteThumbPost($post);

        $image = $postService->handleUploadThumbPost($request);

        return $image;
    }

    public function handleUploadStore($request)
    {
        $postService = PostService::create();

        $image = $postService->handleUploadThumbPost($request);

        return $image;
    }

    public function deleteExistThumb($post)
    {
        $postService = PostService::create();

        $postService->handleDeleteThumbPost($post);
    }
}
