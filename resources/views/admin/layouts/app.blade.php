<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <div><a class="navbar-brand" href="index.html">Coffee<div><small>Blend</small></div></a></div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                </a>
            </div>
            
            @auth('admin')
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Home
                            </a>
                        </li>
                        @if (Auth::guard('admin')->user()->hasRoles(['superadmin','admin']))
                        <li>
                            <a href="{{route('admin.product')}}">
                                <i class="fas fa-chart-bar"></i>Products</a>
                        </li>
                        <li>
                            <a href="{{route('admin.category')}}">
                                <i class="fas fa-table"></i>Categories</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('admin.post')}}">
                                <i class="fas fa-table"></i>Post</a>
                        </li>
                        @if (Auth::guard('admin')->user()->hasRole('superadmin'))
                        <li>
                            <a href="{{route('admin.setting')}}">
                                <i class="fas fa-map-marker-alt"></i>Setting Manager</a>
                        </li>
                        @endif
                        {{--<li style="position: relative">
                            <div id="pending" style="position: absolute;left: 100px">
                                @if ($count_mess_group > 0)
                                    <span id="count_mess_group" class="pending">{{$count_mess_group}}</span>
                                @endif
                            </div>
                            <a href="{{route('admin.chat')}}">
                                <i class="fas fa-calendar-alt"></i>Room Chat</a>
                        </li>
                        @if (Auth::guard('admin')->user()->hasRole('superadmin'))
                        <li>
                            <a href="{{route('admin.setting')}}">
                                <i class="fas fa-map-marker-alt"></i>Setting Manager</a>
                        </li>
                        @endif --}}
                    
                    </ul>
                </nav>
            </div>
            @endauth
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            @auth('admin')
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="content">
                                <a class="js-acc-btn" href="#" 
                                onclick="event.preventDefault(); document.querySelector('#admin-logout-form').submit();" >
                                Logout</a>

                                <form id="admin-logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            @endauth
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        @auth('admin')
                                        <div class="content">
                                            {{Auth::guard('admin')->user()->username}} ({{Auth::guard('admin')->user()->get_role()->name}})
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <div class="main-content">
                @yield('content')
            <div></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {{-- <!-- Jquery JS-->
    {{-- <script src=" {{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src=" {{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script> --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        if ($('#editor1').length > 0) {
        CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        })
    };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webshim/1.16.0/minified/polyfiller.js"></script> 
    <!-- Vendor JS       -->
    {{-- <script src=" {{ asset('vendor/slick/slick.min.js') }}">
    </script>
    <script src=" {{ asset('vendor/wow/wow.min.js') }}"></script>
    <script src=" {{ asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src=" {{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src=" {{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src=" {{ asset('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src=" {{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src=" {{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src=" {{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src=" {{ asset('vendor/select2/select2.min.js') }}">
    </script> --}}

    <!-- Main JS-->
    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $(document).ready(function(){
            webshims.setOptions('forms-ext', {
                replaceUI: 'auto',
                types: 'number'
            });
            webshims.polyfill('forms forms-ext');

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURLedit(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                    $('#editimage').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURLaddpost(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                    $('#postthumb').attr('src', e.target.result);
                    $("#postthumb").css({"height": "200px", "width": "200px"});
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#url_image").change(function() {
                readURL(this);
            });

            $("#url_image_edit").change(function() {
                readURLedit(this);
            });

            $("#url_image_post").change(function() {
                readURLaddpost(this);
            });

            function ChangeToSlug()
            {
                var title, slug;
                title = $('.title').val();
                slug = title.toLowerCase();
            
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                slug = slug.replace(/ /gi, "-");
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                $('.slug').val(slug);
            }

            $('.slug').on('click', function() {
                ChangeToSlug();
            });

            $('#form_add_cate').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'addCate',
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            document.getElementById('close').click();
                            $('#tbody').append('<tr class="cate" data-id="'+ data.cate.id +'"><td>'+ data.cate.created_at +'</td><td>'+ data.cate.name +'</td><td>'+ data.total_products +'</td><td>'+ data.create_by +'</td><td>'+ data.role +'</td></tr>');
                        }else{
                            $('#errorname').html(data.error);
                        }
                    },
                });
            });

            $("input").keyup(function(){
                $("p").html('');
            });

            $('.cate').on('click', function(e) {
                var cate_id = $(this).data('id');
                $('#modalSelect').modal('show');
                $('.content').find('a[data-id="delete"]').attr('id',cate_id);
                $('.content').find('a[data-id="edit"]').attr('id',cate_id);
                $('.content').find('a[data-id="view"]').attr('id',cate_id);
            });

            $('.post').on('click', function(e) {
                var post_id = $(this).data('id');
                $('#modalSelect').modal('show');
                $('.content').find('a[data-id="allow-post"]').attr('id',post_id);
                $('.content').find('a[data-id="delete_post"]').attr('id',post_id);
                $('.content').find('a[data-id="edit_post"]').attr('id',post_id);
                $('.content').find('a[data-id="edit_post"]').attr('href','post/edit/' + post_id);
                $('.content').find('a[data-id="view_post"]').attr('id',post_id);
            });

            $('.product').on('click', function(e) {
                var product_id = $(this).data('id');
                $('#modalSelect').modal('show');
                $('.content').find('a[data-id="delete_product"]').attr('id',product_id);
                $('.content').find('a[data-id="edit_product"]').attr('id',product_id);
                $('.content').find('a[data-id="view_product"]').attr('id',product_id);
            });

            // $(document).click(function(event) { 
            // $target = $(event.target);
            // if(!$target.closest('#context-menu').length && 
            // $('#context-menu').is(":visible")) {
            //     $('#context-menu').hide();
            // }        
            // });

            $('.delete').on('click',function(e){
                $confirm = confirm('You want delete this category ? !!!');
                if($confirm == false){
                    return false;
                }
                var cate_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : 'deleteCate',
                    data: {cate_id:cate_id},
                    cache: false,
                    success: function(data){
                        $('#modalSelect').modal('hide');
                        $('#tbody').find('tr[data-id="'+ cate_id +'"]').remove();
                    }
                });
            });

            $('.delete-product').on('click',function(e){
                $confirm = confirm('You want delete this product ? !!!');
                if($confirm == false){
                    return false;
                }
                var product_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : 'deleteProduct',
                    data: {product_id:product_id},
                    cache: false,
                    success: function(data){
                        $('#modalSelect').modal('hide');
                        $('#tbody').find('tr[data-id="'+ product_id +'"]').remove();
                    }
                });
            });

            $('.delete-post').on('click',function(e){
                $confirm = confirm('You want delete this post ? !!!');
                if($confirm == false){
                    return false;
                }
                var post_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : '/admin/post/delete/' + post_id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $('#modalSelect').modal('hide');
                        $('#tbody').find('tr[data-id="'+ post_id +'"]').remove();
                    }
                });
            });

            $('.allow-post').on('click',function(){
                var post_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url: '/admin/post/allowordeny/' + post_id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $('#modalSelect').modal('hide');
                        $('#status' + post_id).html(data.status)
                        if(data.status == 'Available'){
                            $('#tbody').find('tr[data-id="'+ post_id +'"]').css('background-color', '#ffb3b3');
                        }
                        else{
                            $('#tbody').find('tr[data-id="'+ post_id +'"]').css('background-color', '');
                        }
                    }
                });
            });

            $('.edit').on('click',function(){
                var cate_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : 'getCate/'+ cate_id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $('#modalSelect').modal('hide');
                        $("#modalEdit").modal('show');
                        $('.form_edit_cate').attr('id',cate_id);
                        $('#namecateedit').val(data.cate_name);
                    }
                });
            });

            $('.edit-product').on('click',function(){
                var product_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : 'getProduct/'+ product_id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $('#modalSelect').modal('hide');
                        $("#modalEdit").modal('show');
                        console.log(data);
                        $('.form_edit_product').attr('id',product_id);
                        $('#nameproductedit').val(data.product.name);
                        $('#priceproductedit').val(data.product.price);
                        $('#selectedit').val(data.cate_name);
                        $('#descriptionedit').val(data.product.description);
                        $('#editimage').attr('src', '/storage/' + data.url_image);
                    }
                });
            });

            $('.form_edit_cate').on('submit', function(e){
                e.preventDefault();
                var cate_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url: 'editCate/' + cate_id,
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            document.getElementById('closeEdit').click();
                            $('#namecate' + cate_id).html(data.name)
                        }else{
                            $('#errornameedit').html(data.error);
                        }
                    },
                });
            });

            $('.form_edit_product').on('submit', function(e){
                e.preventDefault();
                var product_id = $(this).attr('id');
                var formData = new FormData($('.form_edit_product')[0]);
                var url_image = $('#editimage').attr('src');
                if(url_image !== '')
                {
                    var arr = url_image.split('/storage/uploads/');
                    var name = arr[1];
                    formData.append('url_image_src', name);
                }
                $.ajax({
                    method: 'post',
                    url: 'editProduct/' + product_id,
                    processData: false,
                    contentType: false, 
                    data: formData,
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            document.getElementById('closeEdit').click();
                            $('#nameproduct' + product_id).html(data.product.name);
                            $('#priceproduct' + product_id).html(data.product.price);
                            $('#cateproduct' + product_id).html(data.cate_name);
                            $('#imageproduct' + product_id).attr('src',url_image);
                        }else{
                            for(var error in data.error)
                            {
                                if(`${data.error[error]}`.includes('The name'))
                                {
                                    $('#errornameedit').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The price'))
                                {
                                    $('#errorpriceedit').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The description'))
                                {
                                    $('#errordescriptionedit').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The url image'))
                                {
                                    $('#errorimageedit').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                            }
                            $("input").change(function(){
                                $('p').remove();
                            });
                        }
                    },
                });
            });

            $('#form_add_product').on('submit', function(e){
                e.preventDefault();
                var formData = new FormData($('#form_add_product')[0]);
                var url_image = $('#blah').attr('src');
                $.ajax({
                    method: 'post',
                    url: 'addProduct',
                    processData: false,
                    contentType: false, 
                    data: formData,
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            document.getElementById('close').click();
                            $('#tbody').append('<tr class="product" data-id="'+ data.product.id +'"><td>'+ data.product.created_at +'</td><td id="nameproduct'+ data.product.id +'">'+ data.product.name +'</td><td id="priceproduct'+ data.product.id +'">'+ data.product.price + '.00' +'</td><td id="cateproduct'+ data.product.id +'">'+ data.cate_name +'</td><td id="imageproduct'+ data.product.id +'"><img src="'+ url_image +'" width="50px" height="50px" alt=""></td></tr>');
                        }else{
                            for(var error in data.error)
                            {
                                if(`${data.error[error]}`.includes('The name'))
                                {
                                    $('#errorname').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The price'))
                                {
                                    $('#errorprice').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The description'))
                                {
                                    $('#errordescription').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The url image'))
                                {
                                    $('#errorimage').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                            }
                            $("input").change(function(){
                                $('p').remove();
                            });
                        }
                    },
                });
            });

            $('#form_add_admin').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'addAdmin',
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            document.getElementById('close').click();
                            $('#tbody').append('<tr class="admin" data-id="'+ data.admin.id +'"><td>'+ data.admin.created_at +'</td><td>'+ data.admin.username +'</td><td>'+ data.admin.name +'</td><td>'+ data.role +'</td></tr>');
                        }else{
                            for(var error in data.error)
                            {
                                if(`${data.error[error]}`.includes('The username'))
                                {
                                    $('#errorusername').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The name'))
                                {
                                    $('#errorname').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The email'))
                                {
                                    $('#erroremail').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                                else if(`${data.error[error]}`.includes('The password'))
                                {
                                    $('#errorpassword').append('<p style="color: red" class="help is-danger">'+ `${data.error[error]}` +'</p>');
                                }
                            }
                            $("input").change(function(){
                                $('p').remove();
                            });
                        }
                    },
                });
            });

            $("input").keyup(function(){
                $("p").html('');
            });

            $('.admin').on('contextmenu', function(e) {
                var admin_id = $(this).data('id');
                $('#context-menu').find('a[id="delete"]').attr('data-admin-id',admin_id);
                $('#context-menu').find('a[data-id="edit"]').attr('id', admin_id);
                var top = e.pageY - 10;
                var left = e.pageX - 90;
                $("#context-menu").css({
                    display: "block",
                    top: top,
                    left: left
                }).addClass("show");
                return false; //blocks default Webbrowser right click menu
                }).on("click", function() {
                $("#context-menu").removeClass("show").hide();
                });

                $("#context-menu a").on("click", function() {
                $(this).parent().removeClass("show").hide();
            });

            $(document).click(function(event) { 
            $target = $(event.target);
            if(!$target.closest('#context-menu').length && 
            $('#context-menu').is(":visible")) {
                $('#context-menu').hide();
            }        
            });

            $('#delete').on('click',function(e){
                $confirm = confirm('You want delete this admin ? !!!');
                if($confirm == false){
                    return false;
                }
                var admin_id = $(this).data('admin-id');
                $.ajax({
                    method: 'post',
                    url : 'deleteAdmin',
                    data: {admin_id:admin_id},
                    cache: false,
                    success: function(data){
                        $("#context-menu").hide();
                        $('#tbody').find('tr[data-id="'+ admin_id +'"]').remove();
                    }
                });
            });

            $('.edit').on('click',function(){
                var admin_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url : 'getAdmin/'+ admin_id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $("#modalEdit").modal('show');
                        $('.form_edit_admin').attr('id',admin_id);
                        $('#usernameedit').val(data.admin.username);
                        $('#nameedit').val(data.admin.name);
                        $('#emailedit').val(data.admin.email);
                        $('#selectedit').val(data.role);
                        $('#passwordedit').val(data.admin.password);
                        $('#confirmpasswordedit').val(data.admin.password);
                    }
                });
            });

            $('.form_edit_admin').on('submit', function(e){
                e.preventDefault();
                var admin_id = $(this).attr('id');
                $.ajax({
                    method: 'post',
                    url: 'editAdmin/' + admin_id,
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                        document.getElementById('closeEdit').click();
                        $('#create' + admin_id).html(data.admin.created_at);
                        $('#username' + admin_id).html(data.admin.username);
                        $('#name' + admin_id).html(data.admin.nam);
                        $('#role' + admin_id).html(data.role);
                    },
                    error: function(xhr, status, data){
                        for(var p in xhr.responseJSON.errors){
                            $('#error' + `${p}`).html(`${xhr.responseJSON.errors[p]}`);
                        }
                    }
                });
            });

            $('.user').on('contextmenu', function(e) {
                var user_id = $(this).data('id');
                $('#context-menu').find('a[data-id="view"]').attr('id', 'view' + user_id);
                $('#context-menu').find('a[data-id="block"]').attr('id', 'block' + user_id);
                var top = e.pageY - 10;
                var left = e.pageX - 90;
                $("#context-menu").css({
                    display: "block",
                    top: top,
                    left: left
                }).addClass("show");
                return false; //blocks default Webbrowser right click menu
                }).on("click", function() {
                $("#context-menu").removeClass("show").hide();
                });

                $("#context-menu a").on("click", function() {
                $(this).parent().removeClass("show").hide();
            });

            $('.block').on('click', function(){
                var user_id = $(this).attr('id');
                var arr = user_id.split('block');
                var id = parseInt(arr[0]+arr[1]);
                $.ajax({
                    method: 'post',
                    url: 'blockUser/' + id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $('#status' + id).html(data.status)
                        if(data.status == 'Block'){
                            $('#tbody').find('tr[data-id="'+ id +'"]').css('background-color', '#ffb3b3');
                        }
                        else{
                            $('#tbody').find('tr[data-id="'+ id +'"]').css('background-color', '');
                        }
                    }
                });
            });

            $('.view').on('click',function(){
                var user_id = $(this).attr('id');
                var arr = user_id.split('view');
                var id = parseInt(arr[0]+arr[1]);
                $.ajax({
                    method: 'post',
                    url : 'getUser/'+ id,
                    data: '',
                    cache: false,
                    success: function(data){
                        $("#modalView").modal('show');
                        $('#name').html(data.user.name);
                        $('#username').html(data.user.username);
                        $('#email').html(data.user.email);
                        $('#provider').html(data.user.provider);
                        $('#status').html(data.status);
                        $('#posts').html(data.count_post);
                        $('#following').html(data.count_following);
                        $('#follower').html(data.count_follower);
                    }
                });
            });
        });
    </script>

</body>

</html>
<!-- end document-->
