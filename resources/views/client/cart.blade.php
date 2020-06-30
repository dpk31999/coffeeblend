@extends('client.layouts.app')

@section('content')
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Cart</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Cart</span></p>
                </div>

            </div>
        </div>
    </div>
    </section>
        <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody class="show-cart">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span class="total-cart"></span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>$0.00</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span class="total-cart"></span>
                        </p>
                    </div>
                    <p class="text-center"><a href="{{route('checkout')}}" class="check-out btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
            </div>
        </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Related products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($bestSeller as $product)
                    <div class="col-md-3">
                        <div class="menu-entry">
                            <a href="{{route('product.show',$product->id)}}" class="img" style="background-image: url(/storage/{{$product->url_image}});"></a>
                            <div class="text text-center pt-4">
                                <h3><a href="{{route('product.show',$product->id)}}">{{$product->name}}</a></h3>
                                <p>{{$product->description}}</p>
                                <p class="price"><span>${{$product->price}}</span></p>
                                <p><a href="#" class="btn btn-primary add-to-cart" data-name="{{$product->name}}" data-price="{{$product->price}}" data-urlImg="{{$product->url_image}}">Add to Cart</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection