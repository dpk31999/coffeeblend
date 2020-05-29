<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Reply;
use App\Category;
use Pusher\Pusher;

class BlogController extends Controller
{
    public function index()
    {   
        $posts = Post::paginate(6);
        $title = 'Blog';
        return view('client.blog.index',\compact('posts','title'));
    }

    public function page($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $posts = Post::withCount('comments')->orderByDesc('comments_count')->skip(0)->take(3)->get();
        $categories = Category::all();
        $keywords = explode(",", $post->keyword);
        $title = $post->title;

        return view('client.blog.single',\compact('post','keywords','posts','categories','title'));
    }

    public function createComment(Post $post,Request $request)
    {   
        if(\auth()->user() == null)
        {
            return \response()->json(['error' => 'error']);
        }

        $url_thumb = auth()->user()->url_thumb;
        

        $data = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment')
        ]);

        $id_comment = $data->id;

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            'id_post' => $post->id,
            'name' => auth()->user()->name,
            'comment' => $request->input('comment'),
            'url_thumb' => $url_thumb,
            'id_comment' => $id_comment,
            'created_at' => date('d-m-Y H:i:s', strtotime($data->created_at))
        ]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function createReplyComment(Request $request, Comment $comment){
        if(\auth()->user() == null)
        {
            return \response()->json(['error' => 'error']);
        }

        $url_thumb = auth()->user()->url_thumb;
        
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = Reply::create([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment->id,
            'content' => $request->input('replyCmt')
        ]);

        $data = [
            'from' => auth()->user()->id, 
            'to' => $comment->user->id,
            'id_comment' => $comment->id,
            'name' => auth()->user()->name,
            'url_thumb' => $url_thumb,
            'replyCmt' => $request->input('replyCmt'),
            'created_at' => date('d-m-Y H:i:s', strtotime($data->created_at))
        ]; // sending from and to user id when pressed enter
        $pusher->trigger('channel-rep-cmt', 'event-rep-cmt', $data);
    }
}
