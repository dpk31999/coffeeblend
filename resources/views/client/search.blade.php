@extends('client.layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ftco-animate">
                @if (isset($category))
                    <h4 class="mb-5">Products of {{$category->name}}</h4>
                    @foreach ($category->products as $product)
                        <div class="d-flex mb-3">
                            <a href="{{route('product.show',$product->id)}}"><img class="mr-4" src="/storage/{{$product->url_image}}" height="100px" width="100px" alt=""></a>
                            <div>
                                <a href="{{route('product.show',$product->id)}}"><h3>{{$product->name}}</h3></a>
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="mb-5">Products has keyword is {{$keyword}}</h4>
                    @foreach ($products as $product)
                        <div class="d-flex mb-3">
                            <a href="{{route('product.show',$product->id)}}"><img class="mr-4" src="/storage/{{$product->url_image}}" height="100px" width="100px" alt=""></a>
                            <div>
                                <a href="{{route('product.show',$product->id)}}"><h3>{{$product->name}}</h3></a>
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
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
                    @foreach ($bestSeller as $product)
                        <a href="{{route('product.show',$product->id)}}" class="tag-cloud-link">{{$product->name}}</a>
                    @endforeach
                    @foreach ($categories as $category)
                        <a href="{{route('cate',$category->id)}}" class="tag-cloud-link">{{$category->name}}</a>
                    @endforeach
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