<?php

namespace App\Http\Controllers\Api\v1;

use App\Post;
use Throwable;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('apiAdmin');
    }

    public function index()
    {
        $posts = Post::all();

        return response()->json($posts, 200);
    }

    public function store(PostRequest $request)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

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

        return response()->json([
            'message' => 'Success',
            'post' => $post
        ], 200);
    }

    public function update(Request $request,Post $post)
    {   
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        if(isset($request->url_image)){

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'slug' => 'required|string|unique:posts,slug,' . $post->id,
                'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
                'keyword' =>'required|string',
                'content' => 'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json(['error'=>$validator->errors()->all()],405);
            }

            $image = $this->handleUploadEdit($request,$post);

        }

        else{
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'slug' => 'required|string|unique:posts,slug,' . $post->id,
                'url_image' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
                'keyword' =>'required|string',
                'content' => 'required|string',
            ]);

            if($validator->fails())
            {
                return response()->json(['error'=>$validator->errors()->all()],405);
            }

            $image = $post->url_thumb;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->url_thumb = $image;
        $post->slug = $request->slug;
        $post->keyword = $request->keyword;
        $post->save();
        
        return response()->json([
            'message' => 'Success',
            'post' => $post
        ], 200);
    }

    public function detroy(Post $post)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $this->deleteExistThumb($post);

        $post->delete();

        return response()->json([
            'message' => 'Success'
        ], 200);
    }

    public function showById(Post $post)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'Success',
            'post' => $post
        ], 200);
    }

    public function showBySlug($slug)
    {   
        try {
            $post = Post::where('slug',$slug)->first();

            return response()->json([
                'message' => 'Success',
                'post' => $post
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th, 400);
        }
    }

    public function search($keyword)
    {
        $posts = Post::where('title','like', '%' . $keyword . '%')->get();

        return response()->json([
            'message' => 'Success',
            'posts' => $posts
        ], 200);
    }

    public function status(Post $post)
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

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
