@extends('client.layouts.app')

@section('content')
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
    <div class="container">
    <div class="row slider-text justify-content-center align-items-center">

        <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Checkout</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Checout</span></p>
        </div>

    </div>
    </div>
</div>
</section>

<section class="ftco-section">
<div class="container">
    <div class="row">
    <div class="col-xl-8 ftco-animate">
        <form id="form_check_out" class="billing-form ftco-bg-dark p-3 p-md-5">
            @csrf
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="firstname">Firt Name</label>
                    <input name="firstname" type="text" class="form-control" placeholder="">
                    <div id="errorfirstname"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input name="lastname" type="text" class="form-control" placeholder="">
                    <div id="errorlastname"></div>
                </div>
            </div>
            <div class="w-100"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="country">State / Country</label>
                        <div class="select-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="select" id="country_list" class="form-control">
                    </select>
                    </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="streetaddress">Street Address</label>
                        <input name="address" type="text" class="form-control" placeholder="House number and street name">
                        <div id="erroraddress"></div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" type="text" class="form-control" placeholder="">
                    <div id="errorphone"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input name="email" type="text" class="form-control" placeholder="">
                    <div id="erroremail"></div>
                </div>
            </div>
            </div>
            <div class="row mt-5 pt-3 d-flex">
                <div class="col-md-6 d-flex">
                    <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Cart Total</h3>
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
                </div>
                <div class="col-md-6">
                    <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Payment Method</h3>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="radio">
                                    <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="radio">
                                    <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="radio">
                                    <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                                </div>
                            </div>
                        </div>
                        <button id="check_out" type="submit" class="btn btn-primary py-3 px-4 text-decoration-none text-dark" style="cursor: pointer">Place an order</button>
                    </div>
                </div>
            </div>
            <span style="color:red" id="error_cart"></span>
        </form><!-- END -->
    </div> <!-- .col-md-8 -->




    <div class="col-xl-4 sidebar ftco-animate">
        <div class="sidebar-box">
        <form action="#" class="search-form">
            <div class="form-group">
                <div class="icon">
                <span class="icon-search"></span>
            </div>
            <input type="text" class="form-control" placeholder="Search...">
            </div>
        </form>
        </div>
        <div class="sidebar-box ftco-animate">
        <div class="categories">
            <h3>Categories</h3>
            <li><a href="#">Tour <span>(12)</span></a></li>
            <li><a href="#">Hotel <span>(22)</span></a></li>
            <li><a href="#">Coffee <span>(37)</span></a></li>
            <li><a href="#">Drinks <span>(42)</span></a></li>
            <li><a href="#">Foods <span>(14)</span></a></li>
            <li><a href="#">Travel <span>(140)</span></a></li>
        </div>
        </div>

        <div class="sidebar-box ftco-animate">
        <h3>Recent Blog</h3>
        <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
            <div class="text">
            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
            <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
            </div>
            </div>
        </div>
        <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
            <div class="text">
            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
            <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
            </div>
            </div>
        </div>
        <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
            <div class="text">
            <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
            <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
            </div>
            </div>
        </div>
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
</section> <!-- .section -->

<div class="position-absolute w-100 d-flex flex-column p-4">
    <div class="toast ml-auto" role="alert" data-delay="700" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto text-primary">Another Toast</strong>
            <small class="text-muted">8 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body"> Hey, there! This is a Bootstrap 4 toast. </div>
    </div>
</div>
@endsection