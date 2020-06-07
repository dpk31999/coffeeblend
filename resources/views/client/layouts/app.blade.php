<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}} - The Coffee Blend</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('fonts/store-icon.png') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container" style="
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        padding-right: 0px;"    
    >
            <a class="navbar-brand" href="{{route('home')}}">Coffee<small>Blend</small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="mr-5">
                        <form action="{{route('search')}}" method="get" class="search-form">
                            <div class="form-group">
                                <div class="icon">
                                <span class="icon-search"></span>
                            </div>
                            <input type="text" name="result" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </li>
                    <li class="nav-item"><a href="{{route('home')}}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{route('menu')}}" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="{{route('blog')}}" class="nav-link">Blog</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{route('cart')}}">Cart</a>
                            <a class="dropdown-item" href="{{route('checkout')}}">Checkout</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>
                    <li class="nav-item cart" data-toggle="modal" data-target="#cart"><a style="cursor: pointer" class="nav-link"><span class="icon icon-shopping_cart"><span class="bag d-flex justify-content-center align-items-center total-count" style="color: aliceblue"></span></a></li>
                    @guest
                        <li id="avatar" style="padding: 20px"><img src="/images/about.jpg" width="30px" height="30px" style="border-radius: 50%;cursor: pointer" alt="" data-toggle="modal" data-target="#formLogin"></li>
                    @else
                        <li class="nav-item dropdown">
                            <div style="padding: 20px"><img src="/storage/{{auth()->user()->url_thumb}}" width="30px" height="30px" style="border-radius: 50%;cursor: pointer;" alt=""></div>
                            <div class="dropdown-menu" aria-labelledby="dropdown05">
                                    <a class="dropdown-item">{{auth()->user()->name}}</a>
                                <a class="dropdown-item" href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('content')


    <footer class="ftco-footer ftco-section img">
        <div class="overlay"></div>
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">About Us</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Recent Blog</h2>
                        @foreach (App\Post::withCount('comments')->orderByDesc('comments_count')->skip(0)->take(2)->get() as $post)
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4" href="{{route('blog.single',$post->slug)}}" style="background-image: url(/storage/{{$post->url_thumb}});"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="{{route('blog.single',$post->slug)}}">{{$post->title}}</a></h3>
                                    <div class="meta">
                                        <div><a class="text-decoration-none"><span class="icon-calendar"></span>{{$post->created_at}}</a></div>
                                        <div><a class="text-decoration-none"><span class="icon-person"></span>{{$post->admin->username}}</a></div>
                                        <div><a class="text-decoration-none"><span class="icon-chat"></span> {{$post->comments->count()}}</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Services</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Cooked</a></li>
                            <li><a href="#" class="py-2 d-block">Deliver</a></li>
                            <li><a href="#" class="py-2 d-block">Quality Foods</a></li>
                            <li><a href="#" class="py-2 d-block">Mixed</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Ton Dan Street,Hoa An,Cam Le,Da Nang</span></li>
                                <li><span class="icon icon-phone"></span><span class="text">+0914219941</span></li>
                                <li><span class="icon icon-envelope"></span><span class="text">d01295306466@gmail.com</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                    <div>Total price: $<span class="total-cart"></span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"><a class="text-decoration-none text-dark" href="{{route('cart')}}">Go to Cart</a></button>
                    <button type="button" class="clear-cart btn btn-warning">Clear Cart</button>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="formLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content" style="background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;position: relative;
            padding: 20px;
            height: 500px;
            overflow-y: scroll;">
            <!--Header-->
            <div class="col-sm-12" style="
            padding-left: 0px;
            padding-right: 0px;
        ">
                <div class="top border bg-white d-flex flex-column justify-content-center" style="background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;">
                    <a class="navbar-brand" style="padding: 25px 0px;font-size: 30px;">Coffee<small>Blend</small></a>
                    <div class="form mr-5 ml-5">
                    <form method="POST" id="form_login"">
                        @csrf
    
                        <div class="form-group row">
                            <input id="email" type="email" placeholder="email" class="form-control" name="email" required autocomplete="email" autofocus>
                        </div>
    
                        <div class="form-group row">
                            <input id="password" placeholder="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        </div>
                        @if (session()->has('errorFb'))
                            <div id="errorlogin"><p style="color: red" class="help is-danger error">{{ session()->get('errorFb') }}</p></div>                            
                        @else
                            <div id="errorlogin"></div>
                        @endif
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-info btn-lg btn-block text-light d-flex justify-content-center align-items-center" style=" height: 40px">
                                Log In
                            </button>
                        </div>
                        <div class="or pt-4" style="position: relative">
                            <div class="border-top pt-3">
                            </div>
                            <div>
                                <p class="text-center" style="position: absolute;bottom: -10px;right: 40%;padding: 0 17px;background-color: white;background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;">OR</p>
                            </div>
                        </div>
                        <div class="fb d-flex justify-content-center">
                            <a href="{{ url('/auth/redirect/facebook') }}"><p>Log in with Facebook</p></a>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="down mt-4 border bg-white d-flex justify-content-center" style="background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;">
                    <p style="padding: 5px; margin-top: 15px">Don't have an account? <a style="cursor: pointer;    color: #c49b63;" data-toggle="modal" data-target="#formSignup" data-dismiss="modal">Sign up</a></p>
                </div>
            </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <div class="modal fade" id="formSignup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <!--Content-->
            <div class="modal-content" style="background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;position: relative;
            padding: 20px;
            height: 600px;
            overflow-y: scroll;">
            <!--Header-->
            <div class="col-sm-12" style="
            padding-left: 0px;
            padding-right: 0px;
        ">
                <div class="top border bg-white d-flex flex-column justify-content-center" style="position: relative;background: url(/images/bg_4.jpg) no-repeat fixed;background-size: cover;">
                    <i class="fas fa-arrow-left fa-lg" style="position: absolute;top:30px;left: 25px;cursor: pointer" data-toggle="modal" data-target="#formLogin" data-dismiss="modal"></i>
                    <a class="navbar-brand" style="padding: 25px 0px;font-size: 30px;">Coffee<small>Blend</small></a>
                    <div class="form mr-5 ml-5">
                    <form id="form_signup" method="POST">
                        @csrf
    
                        <div class="form-group row">
                            <input id="name" type="text" placeholder="name" class="form-control" name="name" required autocomplete="name" autofocus>
                            <div id="errorname"></div>
                        </div>
                        <div class="form-group row">
                            <input id="email" type="email" placeholder="email" class="form-control" name="email" required autocomplete="email" autofocus>
                            <div id="erroremail"></div>
                        </div>
                        <div class="form-group row" style="position: relative">
                            <div class="col-md-12">
                                <label for="image" class="control-label mb-1">Avatar</label>
                            </div>
                            <div class="col-md-6">
                                <input name="image" class="form-control-file" type='file' id="image" />
                            </div>
                            <div class="col-md-6">
                                <img id="blah" src="" alt="" style="position: absolute;top:-80%"/>
                            </div>
                            <div class="col-md-12">
                                <div id="errorimage"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input id="password" type="password" placeholder="password" class="form-control" name="password" required autocomplete="password" autofocus>
                            <div id="errorpassword"></div>
                        </div>
                        <div class="form-group row">
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm your password" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group row" style="padding: 10px 0px">
                            <p id="message" class="text-success"></p>
                            <button type="submit" class="btn btn-info btn-lg btn-block text-light d-flex justify-content-center align-items-center" style=" height: 40px">
                                Register
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <!-- loader -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.easing.1.3.js"></script>
    <script src="/js/jquery.waypoints.min.js"></script>
    <script src="/js/jquery.stellar.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/aos.js"></script>
    <script src="/js/jquery.animateNumber.min.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/jquery.timepicker.min.js"></script>
    <script src="/js/scrollax.min.js"></script>
    <script src="/js/cart.js"></script>
    <script src="/js/main.js"></script>
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var token = "{{ csrf_token() }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            //comment
            $('.form-comment').submit(function(e){
                $form = $(this); //wrap this in jQuery
                var route = $form.attr('action');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: $(this).serialize(),
                    success: function(data){
                        $('input').val('');
                        
                        if($.isEmptyObject(data.error))
                        {
                            
                        }
                        else{
                            $('#formLogin').modal('show');
                        }
                    }
                });
            });

            $('.reply').one('click',function(){
                var reply_id = $(this).attr('id');
                var arr = reply_id.split('reply');
                var id = parseInt(arr[0]+arr[1]);
                $('#replyComment' + id).removeClass('d-none');
            });

            $('.form-reply-comment').submit(function(e){
                $form = $(this); 
                var route = $form.attr('action');
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: $(this).serialize(),
                    success: function(data){
                        $('input').val('');
                        if($.isEmptyObject(data.error))
                        {
                            
                        }
                        else{
                            $('#formLogin').modal('show');
                        }
                    }
                });
            });
            

            //set up pusher
            Pusher.logToConsole = true;

            var pusher = new Pusher('64c47fbb72fcddee6d67', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');

            channel.bind('my-event',function(data){
                var data = data.data;
                var count = parseInt($('#count').html());
                count++;
                $('#count').html(count);

                $('.comment-list').prepend('<li class="comment">'+ 
                    '<div class="vcard bio">' + 
                        '<img src="/storage/'+ data.url_thumb +'" alt="Image placeholder">' +
                    '</div>' + 
                    '<div class="comment-body">' +
                        '<h3>'+ data.name +'</h3>' +
                        '<div class="meta">'+ data.created_at +'</div>' +
                        '<p>'+ data.comment +'</p>' +
                        '<p><a style="cursor: pointer" id="reply'+ data.id_comment +'" class="reply text-decoration-none">Reply</a></p>' +
                        '<form class="d-none form-reply-comment" data-id="'+ data.id_comment +'" id="replyComment'+ data.id_comment +'" action="/replyCmt/'+ data.id_comment +'" method="post">' +
                            '<input type="hidden" name="_token" value="'+ token +'">' + 
                            '<input class="form-control replyInput" type="text" id="replyCmt" name="replyCmt" placeholder="Write a reply..." style="height: 30px" required>' +
                            '<input type="hidden" style="position: absolute; right: 10px; top:10px; background-color: white; color: slateblue; border: none;font-weight: bold" value="Post"/>' +
                        '</form>' +
                    '</div>' +
                    '<div class="reply-comment">' +
                        '<ul class="children" id="ofcomment'+ data.id_comment +'">' + 
                        '</ul>' +
                    '</div>' +
                '</li>'
                );

                // show form reply comment
                $('.reply').one('click',function(){
                    var reply_id = $(this).attr('id');
                    var arr = reply_id.split('reply');
                    var id = parseInt(arr[0]+arr[1]);
                    var set = '#replyComment' + id;
                    $(set).removeClass('d-none');
                });

                // handle form reply
                $('.form-reply-comment').submit(function(e){
                    $form = $(this); 
                    var route = $form.attr('action');
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: route,
                        data: $(this).serialize(),
                        success: function(data){
                            $('.replyInput').val('');
                        }
                    });
                });
            });

            var channelRepCmt = pusher.subscribe('channel-rep-cmt');
            channelRepCmt.bind('event-rep-cmt',function(data){
                $('#ofcomment' + data.id_comment).prepend('<li class="comment">' +
                '<div class="vcard bio">' +
                    '<img src="/storage/'+ data.url_thumb +'" alt="Image placeholder">' +
                '</div>' +
                '<div class="comment-body">' +
                    '<h3>'+ data.name +'</h3>' +
                    '<div class="meta">'+ data.created_at +'</div>' +
                    '<p>'+ data.replyCmt +'</p>' +
                '</div>' +
                '</li>'
                );
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    $("#blah").css({"border-radius": "50%", "margin-left": "50px", "height": "100px", "width": "100px"});
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#image").change(function() {
                readURL(this);
            });

            $('#form_signup').on('submit',function(e){
                e.preventDefault();
                var formData = new FormData($('#form_signup')[0]);
                var url_image = $('#image').attr('src');
                $.ajax({
                    method: 'post',
                    url: '/register',
                    processData: false,
                    contentType: false, 
                    data: formData,
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#message').html('Register success, Please back to login !');
                        }else{
                            for(var error in data.error)
                            {
                                if(`${data.error[error]}`.includes('The name'))
                                {
                                    $('#errorname').append('<p style="color: red" class="help is-danger error">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The email'))
                                {
                                    $('#erroremail').append('<p style="color: red" class="help is-danger error">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The password'))
                                {
                                    $('#errorpassword').append('<p style="color: red" class="help is-danger error">'+ `${data.error[error]}` +'</p>');
                                }
                            }
                            $("input").change(function(){
                                $('.error').remove();
                            });
                        }
                    }
                });
            });

            $('#form_login').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    method: 'post',
                    url: '/login',
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            window.location.reload();
                        }else{
                            $('#errorlogin').append('<p style="color: red" class="help is-danger error">'+ data.error +'</p>');
                        }
                        $("input").change(function(){
                            $('.error').remove();
                        });
                    }
                })
            });

            const countryList = [
                "Afghanistan",
                "Albania",
                "Algeria",
                "American Samoa",
                "Andorra",
                "Angola",
                "Anguilla",
                "Antarctica",
                "Antigua and Barbuda",
                "Argentina",
                "Armenia",
                "Aruba",
                "Australia",
                "Austria",
                "Azerbaijan",
                "Bahamas (the)",
                "Bahrain",
                "Bangladesh",
                "Barbados",
                "Belarus",
                "Belgium",
                "Belize",
                "Benin",
                "Bermuda",
                "Bhutan",
                "Bolivia (Plurinational State of)",
                "Bonaire, Sint Eustatius and Saba",
                "Bosnia and Herzegovina",
                "Botswana",
                "Bouvet Island",
                "Brazil",
                "British Indian Ocean Territory (the)",
                "Brunei Darussalam",
                "Bulgaria",
                "Burkina Faso",
                "Burundi",
                "Cabo Verde",
                "Cambodia",
                "Cameroon",
                "Canada",
                "Cayman Islands (the)",
                "Central African Republic (the)",
                "Chad",
                "Chile",
                "China",
                "Christmas Island",
                "Cocos (Keeling) Islands (the)",
                "Colombia",
                "Comoros (the)",
                "Congo (the Democratic Republic of the)",
                "Congo (the)",
                "Cook Islands (the)",
                "Costa Rica",
                "Croatia",
                "Cuba",
                "Curaçao",
                "Cyprus",
                "Czechia",
                "Côte d'Ivoire",
                "Denmark",
                "Djibouti",
                "Dominica",
                "Dominican Republic (the)",
                "Ecuador",
                "Egypt",
                "El Salvador",
                "Equatorial Guinea",
                "Eritrea",
                "Estonia",
                "Eswatini",
                "Ethiopia",
                "Falkland Islands (the) [Malvinas]",
                "Faroe Islands (the)",
                "Fiji",
                "Finland",
                "France",
                "French Guiana",
                "French Polynesia",
                "French Southern Territories (the)",
                "Gabon",
                "Gambia (the)",
                "Georgia",
                "Germany",
                "Ghana",
                "Gibraltar",
                "Greece",
                "Greenland",
                "Grenada",
                "Guadeloupe",
                "Guam",
                "Guatemala",
                "Guernsey",
                "Guinea",
                "Guinea-Bissau",
                "Guyana",
                "Haiti",
                "Heard Island and McDonald Islands",
                "Holy See (the)",
                "Honduras",
                "Hong Kong",
                "Hungary",
                "Iceland",
                "India",
                "Indonesia",
                "Iran (Islamic Republic of)",
                "Iraq",
                "Ireland",
                "Isle of Man",
                "Israel",
                "Italy",
                "Jamaica",
                "Japan",
                "Jersey",
                "Jordan",
                "Kazakhstan",
                "Kenya",
                "Kiribati",
                "Korea (the Democratic People's Republic of)",
                "Korea (the Republic of)",
                "Kuwait",
                "Kyrgyzstan",
                "Lao People's Democratic Republic (the)",
                "Latvia",
                "Lebanon",
                "Lesotho",
                "Liberia",
                "Libya",
                "Liechtenstein",
                "Lithuania",
                "Luxembourg",
                "Macao",
                "Madagascar",
                "Malawi",
                "Malaysia",
                "Maldives",
                "Mali",
                "Malta",
                "Marshall Islands (the)",
                "Martinique",
                "Mauritania",
                "Mauritius",
                "Mayotte",
                "Mexico",
                "Micronesia (Federated States of)",
                "Moldova (the Republic of)",
                "Monaco",
                "Mongolia",
                "Montenegro",
                "Montserrat",
                "Morocco",
                "Mozambique",
                "Myanmar",
                "Namibia",
                "Nauru",
                "Nepal",
                "Netherlands (the)",
                "New Caledonia",
                "New Zealand",
                "Nicaragua",
                "Niger (the)",
                "Nigeria",
                "Niue",
                "Norfolk Island",
                "Northern Mariana Islands (the)",
                "Norway",
                "Oman",
                "Pakistan",
                "Palau",
                "Palestine, State of",
                "Panama",
                "Papua New Guinea",
                "Paraguay",
                "Peru",
                "Philippines (the)",
                "Pitcairn",
                "Poland",
                "Portugal",
                "Puerto Rico",
                "Qatar",
                "Republic of North Macedonia",
                "Romania",
                "Russian Federation (the)",
                "Rwanda",
                "Réunion",
                "Saint Barthélemy",
                "Saint Helena, Ascension and Tristan da Cunha",
                "Saint Kitts and Nevis",
                "Saint Lucia",
                "Saint Martin (French part)",
                "Saint Pierre and Miquelon",
                "Saint Vincent and the Grenadines",
                "Samoa",
                "San Marino",
                "Sao Tome and Principe",
                "Saudi Arabia",
                "Senegal",
                "Serbia",
                "Seychelles",
                "Sierra Leone",
                "Singapore",
                "Sint Maarten (Dutch part)",
                "Slovakia",
                "Slovenia",
                "Solomon Islands",
                "Somalia",
                "South Africa",
                "South Georgia and the South Sandwich Islands",
                "South Sudan",
                "Spain",
                "Sri Lanka",
                "Sudan (the)",
                "Suriname",
                "Svalbard and Jan Mayen",
                "Sweden",
                "Switzerland",
                "Syrian Arab Republic",
                "Taiwan (Province of China)",
                "Tajikistan",
                "Tanzania, United Republic of",
                "Thailand",
                "Timor-Leste",
                "Togo",
                "Tokelau",
                "Tonga",
                "Trinidad and Tobago",
                "Tunisia",
                "Turkey",
                "Turkmenistan",
                "Turks and Caicos Islands (the)",
                "Tuvalu",
                "Uganda",
                "Ukraine",
                "United Arab Emirates (the)",
                "United Kingdom of Great Britain and Northern Ireland (the)",
                "United States Minor Outlying Islands (the)",
                "United States of America (the)",
                "Uruguay",
                "Uzbekistan",
                "Vanuatu",
                "Venezuela (Bolivarian Republic of)",
                "Viet Nam",
                "Virgin Islands (British)",
                "Virgin Islands (U.S.)",
                "Wallis and Futuna",
                "Western Sahara",
                "Yemen",
                "Zambia",
                "Zimbabwe",
                "Åland Islands"
            ];
            if ($('#country_list').length > 0) {
                for (var i = 0; i < countryList.length; i++) {
                    var opt = document.createElement('option');
                    if(countryList[i] == 'Viet Nam')
                    {
                        opt.selected="selected";
                    }
                    opt.value = countryList[i];
                    opt.classList = 'text-muted';
                    opt.innerHTML = countryList[i];
                    $('#country_list').append(opt);
                }
            }

            $('#form_contact').on('submit', function(e){
                e.preventDefault();
                $('#submit').html('Waiting...');
                $.ajax({
                    method: 'post',
                    url: 'contact',
                    cache: false,
                    data: $(this).serialize(),
                    success: function(data){
                        $('#submit').html('Send Message');
                        $('#textarea').val('');
                        $('input').val('');
                        if ($.isEmptyObject(data.error)) {
                            $('.toast').show();
                            setTimeout(() => {
                                $(".toast").hide();
                            }, 2000);
                        }else {
                            for (var error in data.error) {
                                if (`${data.error[error]}`.includes('The name')) {
                                    $('#errorname').append('<p style="color: red" class="help is-danger">' + `${data.error[error]}` + '</p>');
                                } else if (`${data.error[error]}`.includes('The email')) {
                                    $('#erroremail').append('<p style="color: red" class="help is-danger">' + `${data.error[error]}` + '</p>');
                                } else if (`${data.error[error]}`.includes('The subject')) {
                                    $('#errorsubject').append('<p style="color: red" class="help is-danger">' + `${data.error[error]}` + '</p>');
                                } else if (`${data.error[error]}`.includes('The message')) {
                                    $('#errormessage').append('<p style="color: red" class="help is-danger">' + `${data.error[error]}` + '</p>');
                                }
                            }
                            $("input").change(function() {
                                $('p').remove();
                            });
                        }
                    }
                });
            });

            $('#form_add_booking').on('submit',function(e){
                e.preventDefault();
                $('#submitBooking').html('Please Wait ...');
                $.ajax({
                    method: 'post',
                    url: '/addBooking',
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        $('#submitBooking').html('Appointment');
                        if(data.error_date)
                        {
                            $('#errorBooking').append('<p style="color: red" class="help is-danger">' + data.error_date + '</p>');
                        }
                        if ($.isEmptyObject(data.error)) {
                            $('input').val('');
                            $('#textarea').val('');
                            // $('.toast').show();
                            // setTimeout(() => {
                            //     $(".toast").hide();
                            // }, 2000);
                        } else {
                            for (var error in data.error) {
                                $('#errorBooking').append('<p style="color: red" class="help is-danger">' + `${data.error[error]}` + '</p>');
                            }
                            $("input").change(function() {
                                $('p').remove();
                            });
                        }
                    }
                })
            });
        });
    </script>
</body>
</html>
