@extends('client.layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <h3>{{$cate->name}}</h3>
        <div class="row">
            @foreach ($cate->products as $product)
                <div class="col-md-4 text-center">
                    <div class="menu-wrap">
                        <a href="#" class="menu-img img mb-4" style="background-image: url(/storage/{{$product->url_image}});"></a>
                        <div class="text">
                            <h3><a href="#">{{$product->name}}</a></h3>
                            <p>{{$product->description}}</p>
                            <p class="price"><span>${{$product->price}}</span></p>
                            <p><a href="#" class="btn btn-primary add-to-cart" data-name="{{$product->name}}" data-price="{{$product->price}}" data-urlImg="{{$product->url_image}}">Add to cart</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection