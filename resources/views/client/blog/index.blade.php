@extends('client.layouts.app')

@section('content')
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
                <h1 class="mb-3 mt-5 bread">Blog</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Blog</span></p>
            </div>

        </div>
        </div>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row d-flex">
        @foreach ($posts as $post)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                <a href="{{route('blog.single',$post->slug)}}" class="block-20" style="background-image: url('/storage/{{$post->url_thumb}}');">
                </a>
                <div class="text py-4 d-block">
                    <div class="meta">
                    <div><a style="text-decoration-none">{{date('d-m-Y', strtotime($post->created_at))}}</a></div>
                    <div><a style="text-decoration-none">{{$post->admin->username}}</a></div>
                    <div><a class="meta-chat text-decoration-none"><span class="icon-chat"></span> {{$post->comments->count()}}</a></div>
                    </div>
                    <h3 class="heading mt-2"><a href="{{route('blog.single',$post->slug)}}">{{$post->title}}</a></h3>
                </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="row mt-5">
        <div class="col text-center">
            <div class="block-27">
                {{$posts->links()}}
            </div>
        </div>
        </div>
    </div>
</section>
@endsection