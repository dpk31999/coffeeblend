<?php

namespace App\Http\Controllers\Api\v1;

use App\Reply;
use App\Comment;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReplyCommentController extends Controller
{   
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    public function index()
    {
        $replies = Reply::all();

        return response()->json($replies, 200);
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

    public function pusherReplyComment($comment,$data)
    {   

        $data = [
            'from' => auth()->user()->id, 
            'to' => $comment->user->id,
            'id_comment' => $comment->id,
            'name' => auth()->user()->name,
            'url_thumb' => auth()->user()->url_thumb,
            'replyCmt' => $data->content,
            'created_at' => date('d-m-Y H:i:s', strtotime($data->created_at))
        ]; // sending from and to user id when pressed enter
        
        $this->configPusher()->trigger('channel-rep-cmt', 'event-rep-cmt', $data);
    }

    public function store(Request $request,Comment $comment)
    {
        
        $validator = Validator::make($request->all(), [
            'replyCmt' => 'required|string'
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

        $data = Reply::create([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment->id,
            'content' => $request->input('replyCmt')
        ]);

        $this->pusherReplyComment($comment,$data);

        return response()->json([
            'message' => 'Success',
        ], 200);
    }

    public function getReplyCommentInPost(Comment $comment)
    {
        return response()->json([
            'message' => 'Success',
            'relies' => $comment->replies
        ], 200);
    }
}
