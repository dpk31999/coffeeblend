<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Reply;
use App\Category;
use Pusher\Pusher;

use App\Events\SendComment;

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

    public function checkUser()
    {   
        if(\auth()->user() == null)
        {   
            return false;
        }
        return true;
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

    public function createComment(Post $post,Request $request)
    {   
        if($this->checkUser() == false)
        {
            return \response()->json(['error' => 'error']);
        }

        $data = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment')
        ]);

        $this->pusherComment($post,$data);
    }

    public function createReplyComment(Request $request, Comment $comment)
    {

        if($this->checkUser() == false)
        {
            return \response()->json(['error' => 'error']);
        }

        $data = Reply::create([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment->id,
            'content' => $request->input('replyCmt')
        ]);

        $this->pusherReplyComment($comment,$data);
    }
}
