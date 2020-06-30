@extends('client.layouts.app')

@section('content')
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Blog Details</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span class="mr-2"><a href="{{route('blog')}}">Blog</a></span> <span>Blog Single</span></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
        <div class="col-md-8 ftco-animate">
            {!! $post->content !!}
            <div class="tag-widget post-tag-container mb-5 mt-5">
                <div class="tagcloud">
                    @foreach ($keywords as $item)
                        <a class="tag-cloud-link">{{$item}}</a>
                    @endforeach
                </div>
            </div>
            
            <div class="about-author d-flex">
                <div class="bio align-self-md-center mr-5">
                    <img src="/storage/thumb/default_ava.jpg" alt="Image placeholder" class="mb-4" style="width: 50px;border-radius: 50%">
                </div>
                <div class="desc align-self-md-center">
                    <h3>{{$post->admin->username}}</h3>
                    <p>{{$post->created_at}}</p>
                </div>
            </div>


            <div class="pt-5 mt-5">
                <h3 class="mb-5"><span  id="count">{{$post->comments->count()}}</span> Comments</h3>
                <div class="comment-form-wrap pt-5">
                    <form class="form-comment" action=" {{route('blog.comment',$post->id)}} " method="POST">
                        @csrf
                        <label for="message">Message</label>
                        <div class="form-group d-flex" style="position: relative">
                            <input type="text" name="comment" class="form-control" id="message">
                            <button type="submit" style="position: absolute;right: 0;" class="btn py-3 px-4 btn-primary">Post</button>
                        </div>
                    </form>
                </div>
                <ul class="comment-list">
                    @foreach ($post->comments as $comment)
                        <li class="comment">
                            <div class="vcard bio">
                                <img src="/storage/{{$comment->user->url_thumb}}" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>{{$comment->user->name}}</h3>
                                <div class="meta">{{$comment->created_at}}</div>
                                <p>{{$comment->content}}</p>
                                <p><a style="cursor: pointer" id="reply{{$comment->id}}" class="reply text-decoration-none">Reply</a></p>
                                <form class="d-none form-reply-comment" data-id="{{$comment->id}}" id="replyComment{{$comment->id}}" action="{{route('blog.reply',$comment->id)}}" method="post">
                                    @csrf
                                    <input class="form-control replyInput" type="text" id="replyCmt" name="replyCmt" placeholder="Write a reply..." style="height: 30px" required>
                                    <input type="hidden" style="position: absolute; right: 10px; top:10px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/>
                                </form>
                            </div>

                            <div class="reply-comment">
                                <ul class="children" id="ofcomment{{$comment->id}}">
                                    @foreach ($comment->replies as $reply)
                                        <li class="comment">
                                            <div class="vcard bio">
                                                <img src="/storage/{{$reply->user->url_thumb}}" alt="Image placeholder">
                                            </div>
                                            <div class="comment-body">
                                                <h3>{{$reply->user->name}}</h3>
                                                <div class="meta">{{$reply->created_at}}</div>
                                                <p>{{$reply->content}}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div> <!-- .col-md-8 -->
        <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box ftco-animate">
                <div class="categories">
                    <h3>Categories</h3>
                    @foreach ($categories as $cate)
                        <li><a href="{{route('cate',$cate->id)}}">{{$cate->name}} <span>({{$cate->products->count()}})</span></a></li>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-box ftco-animate">
                <h3>Recent Blog</h3>
                @foreach ($posts as $post)
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" href="{{route('blog.single',$post->slug)}}" style="background-image: url(/storage/{{$post->url_thumb}});"></a>
                        <div class="text">
                            <h3 class="heading"><a href="{{route('blog.single',$post->slug)}}">{{$post->title}}</a></h3>
                            <div class="meta">
                                <div><a class="text-decoration-none"><span class="icon-calendar"></span> {{$post->created_at}}</a></div>
                                <div><a class="text-decoration-none"><span class="icon-person"></span> {{$post->admin->username}}</a></div>
                                <div><a class="text-decoration-none"><span class="icon-chat"></span> {{$post->comments->count()}}</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sidebar-box ftco-animate">
            <h3>Tag Cloud</h3>
            <div class="tagcloud">
                <a href="#" class="tag-cloud-link">dish</a>
                <a href="#" class="tag-cloud-link">menu</a>
                <a href="#" class="tag-cloud-link">food</a>
                <a href="#" class="tag-cloud-link">sweet</a>
                <a href="#" class="tag-cloud-link">tasty</a>
                <a href="#" class="tag-cloud-link">delicious</a>
                <a href="#" class="tag-cloud-link">desserts</a>
                <a href="#" class="tag-cloud-link">drinks</a>
            </div>
            </div>

            <div class="sidebar-box ftco-animate">
            <h3>Paragraph</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
        </div>

        </div>
    </div>
    </section>
@endsection