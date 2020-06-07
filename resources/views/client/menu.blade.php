@extends('client.layouts.app')

@section('content')
<section class="home-slider owl-carousel">

<div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
    <div class="row slider-text justify-content-center align-items-center">

        <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Our Menu</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Menu</span></p>
        </div>

    </div>
    </div>
</div>
</section>

<section class="ftco-intro">
    <div class="container-wrap">
        <div class="wrap d-md-flex align-items-xl-end">
            <div class="info">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-phone"></span></div>
                        <div class="text">
                            <h3>0914219941</h3>
                            <p>Call me if you want !</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-my_location"></span></div>
                        <div class="text">
                            <h3>Ton Dan St. Cam Le, DaNang,VietNam</h3>
                            <p>Ton Dan St. Cam Le, DaNang,VietNam</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-clock-o"></span></div>
                        <div class="text">
                            <h3>Open Monday-Friday</h3>
                            <p>Everytime</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="book p-4">
                <div id="errorBooking"></div>
                <h3>Book a Table</h3>
                <form method="post" id="form_add_booking" class="appointment-form">
                    @csrf
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group ml-md-4">
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <div class="input-wrap">
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input type="text" name="date" class="form-control appointment_date" placeholder="Date" required>
                            </div>
                        </div>
                        <div class="form-group ml-md-4">
                            <div class="input-wrap">
                                <div class="icon"><span class="ion-ios-clock"></span></div>
                                <input type="text" name="time" class="form-control appointment_time" placeholder="Time" required>
                            </div>
                        </div>
                        <div class="form-group ml-md-4">
                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <textarea name="message" id="textarea" cols="30" rows="2" class="form-control" placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group ml-md-4">
                            <button id="submitBooking" type="submit" class="btn btn-white py-3 px-4">Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
    <div class="row">
        <div class="col-md-6 mb-5 pb-3">
            <h3 class="mb-5 heading-pricing ftco-animate">Starter</h3>
            @foreach ($starters->take(4) as $product)
                <div class="pricing-entry d-flex ftco-animate">
                    <div class="img" style="background-image: url(/storage/{{$product->url_image}});"></div>
                    <div class="desc pl-3">
                        <div class="d-flex text align-items-center">
                            <h3><span>{{$product->name}}</span></h3>
                            <span class="price">{{$product->price}}</span>
                        </div>
                        <div class="d-block">
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-6 mb-5 pb-3">
            <h3 class="mb-5 heading-pricing ftco-animate">Main Dish</h3>
            @foreach ($mainDish->take(4) as $product)
                <div class="pricing-entry d-flex ftco-animate">
                    <div class="img" style="background-image: url(/storage/{{$product->url_image}});"></div>
                    <div class="desc pl-3">
                        <div class="d-flex text align-items-center">
                            <h3><span>{{$product->name}}</span></h3>
                            <span class="price">{{$product->price}}</span>
                        </div>
                        <div class="d-block">
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-6">
            <h3 class="mb-5 heading-pricing ftco-animate">Desserts</h3>
            @foreach ($desserts->take(4) as $product)
                <div class="pricing-entry d-flex ftco-animate">
                    <div class="img" style="background-image: url(/storage/{{$product->url_image}});"></div>
                    <div class="desc pl-3">
                        <div class="d-flex text align-items-center">
                            <h3><span>{{$product->name}}</span></h3>
                            <span class="price">{{$product->price}}</span>
                        </div>
                        <div class="d-block">
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-6">
            <h3 class="mb-5 heading-pricing ftco-animate">Drinks</h3>
            @foreach ($drinks->take(4) as $product)
                <div class="pricing-entry d-flex ftco-animate">
                    <div class="img" style="background-image: url(/storage/{{$product->url_image}});"></div>
                    <div class="desc pl-3">
                        <div class="d-flex text align-items-center">
                            <h3><span>{{$product->name}}</span></h3>
                            <span class="price">${{$product->price}}</span>
                        </div>
                        <div class="d-block">
                            <p>{{$product->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</section>

<section class="ftco-menu mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
    <div class="col-md-7 heading-section text-center ftco-animate">
        <span class="subheading">Discover</span>
        <h2 class="mb-4">Our Products</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
    </div>
    </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
            <div class="col-md-12 nav-link-wrap mb-5">
                <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Main Dish</a>

                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Drinks</a>

                <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Desserts</a>
                </div>
            </div>
            <div class="col-md-12 d-flex align-items-center">
                
                <div class="tab-content ftco-animate" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                    <div class="row">
                        @foreach ($mainDish as $product)
                            <div class="col-md-4 text-center">
                                <div class="menu-wrap">
                                    <a href="{{route('product.show',$product->id)}}" class="menu-img img mb-4" style="background-image: url(/storage/{{$product->url_image}});"></a>
                                    <div class="text">
                                        <h3><a href="{{route('product.show',$product->id)}}">{{$product->name}}</a></h3>
                                        <p>{{$product->description}}</p>
                                        <p class="price"><span>${{$product->price}}</span></p>
                                        <p><a href="#" class="btn btn-primary add-to-cart" data-name="{{$product->name}}" data-price="{{$product->price}}" data-urlImg="{{$product->url_image}}">Add to cart</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                    <div class="row">
                        @foreach ($drinks as $product)
                            <div class="col-md-4 text-center">
                                <div class="menu-wrap">
                                    <a href="{{route('product.show',$product->id)}}" class="menu-img img mb-4" style="background-image: url(/storage/{{$product->url_image}});"></a>
                                    <div class="text">
                                        <h3><a href="{{route('product.show',$product->id)}}">{{$product->name}}</a></h3>
                                        <p>{{$product->description}}</p>
                                        <p class="price"><span>${{$product->price}}</span></p>
                                        <p><a href="#" class="btn btn-primary add-to-cart" data-name="{{$product->name}}" data-price="{{$product->price}}" data-urlImg="{{$product->url_image}}">Add to cart</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                    <div class="row">
                        @foreach ($desserts as $product)
                            <div class="col-md-4 text-center">
                                <div class="menu-wrap">
                                    <a href="{{route('product.show',$product->id)}}" class="menu-img img mb-4" style="background-image: url(/storage/{{$product->url_image}});"></a>
                                    <div class="text">
                                        <h3><a href="{{route('product.show',$product->id)}}">{{$product->name}}</a></h3>
                                        <p>{{$product->description}}</p>
                                        <p class="price"><span>${{$product->price}}</span></p>
                                        <p><a href="#" class="btn btn-primary add-to-cart" data-name="{{$product->name}}" data-price="{{$product->price}}" data-urlImg="{{$product->url_image}}">Add to cart</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection