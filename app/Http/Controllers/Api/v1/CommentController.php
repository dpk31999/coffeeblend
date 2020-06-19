<?php

namespace App\Http\Controllers\Api\v1;

use App\Post;
use App\Comment;
use Pusher\Pusher;
use App\Events\SendComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    public function index()
    {
        $comments = Comment::all();

        return response()->json($comments, 200);
    }

    public function configPusher()
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        return $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
    }

    public function pusherComment($post,$data)
    {   

        $data = [
            'id_post' => $post->id,
            'name' => auth()->user()->name,
            'comment' => $data->content,
            'url_thumb' => auth()->user()->url_thumb,
            'id_comment' => $data->id,
            'created_at' => date('d-m-Y H:i:s', strtotime($data->created_at))
        ]; // sending from and to user id when pressed enter

        event( new SendComment($data));
    }

    public function store(Request $request,Post $post)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if(Auth::check() == false)
        {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $data = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment')
        ]);

        $this->pusherComment($post,$data);

        return response()->json([
            'message' => 'Success'
        ], 200);
    }

    public function getCommentInPost(Post $post)
    {
        return response()->json([
            'message' => 'Success',
            'comments' => $post->comments
        ], 200);
    }
}
