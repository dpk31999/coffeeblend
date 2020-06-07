<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login fb
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
// end

//client
Route::get('/', 'HomeController@index')->name('home');
Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/cart','CartController@index')->name('cart');
Route::get('/checkout', 'CheckOutController@index')->name('checkout');
Route::get('/contact','ContactController@index')->name('contact');
Route::get('/blog','BlogController@index')->name('blog');
Route::get('/blog/{slug}.html','BlogController@page')->name('blog.single');
Route::get('/category/{cate}','HomeController@getCate')->name('cate');
Route::get('/search','SearchController@search')->name('search');
Route::get('/product/{product}','ProductController@show')->name('product.show');

Route::post('/checkout', 'CheckOutController@store')->name('checkout.store');
Route::post('/contact','ContactController@store')->name('contact.store');

Route::post('/comment/{post}','BlogController@createComment')->name('blog.comment');
Route::post('/replyCmt/{comment}','BlogController@createReplyComment')->name('blog.reply');

Route::post('/addBooking','BookingController@store')->name('booking');
Auth::routes();
//endclient

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){

    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('make.login');
        Route::post('/logout','LoginController@logout')->name('logout');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/','HomeController@index')->name('home');

        //post
        Route::get('/post','PostController@index')->name('post');
        Route::get('/post/create','PostController@formAdd')->name('post.add');
        Route::get('/post/edit/{post}','PostController@formEdit')->name('post.edit');

        Route::post('/post/create','PostController@store')->name('post.create');
        Route::post('/post/delete/{post}','PostController@detroy');
        Route::post('/post/allowordeny/{post}','PostController@changeStatus');
        Route::post('/post/edit/{post}','PostController@edit')->name('post.change');
        //endpost

        //setting
        Route::middleware('isSuperAdmin')->group(function () {
            Route::get('/setting','SettingController@index')->name('setting');

            Route::post('/addAdmin','SettingController@addAdmin')->name('addadmin');
            Route::post('/deleteAdmin','SettingController@deleteAdmin')->name('deleteAdmin');
            Route::post('/editAdmin/{admin}','SettingController@editAdmin')->name('editAdmin');
            Route::post('/getAdmin/{admin}','SettingController@getAdmin')->name('getAdmin');
        });
        //endsetting


        Route::middleware('adminOrSuperAdmin')->group(function () {
            //product
            Route::get('/category','CateController@index')->name('category');

            Route::post('/addCate','CateController@addCate')->name('addCate');
            Route::post('/deleteCate','CateController@deleteCate')->name('deleteCate');
            Route::post('/getCate/{cate}','CateController@getCate')->name('getCate');
            Route::post('/editCate/{cate}','CateController@editCate')->name('editCate');
            //endproduct

            //category
            Route::get('/product','ProductController@index')->name('product');

            Route::post('/addProduct','ProductController@addProduct')->name('addProduct');
            Route::post('/deleteProduct','ProductController@deleteProduct')->name('deleteProduct');
            Route::post('/getProduct/{product}','ProductController@getProduct')->name('getProduct');
            Route::post('/editProduct/{product}','ProductController@editProduct')->name('editProduct');
            //endcategory

            //user
            Route::get('/user','UserController@index')->name('user');
            Route::post('/blockUser/{user}','UserController@blockUser')->name('blockUser');
            //enduser

            //order
            Route::get('/order','OrderController@index')->name('order');
            Route::post('/completedOrder/{invoice}','OrderController@completedOrder');
            Route::get('/getCustomer/{invoice}','OrderController@getCustomer');
            Route::get('/getInvoice/{invoice}','OrderController@getInvoice');
            //endorder

            //booking
            Route::get('/booking','BookingController@index')->name('booking');
            Route::post('/refuseBook/{book}','BookingController@refuse');
            Route::post('/confirmBook/{book}','BookingController@confirm');
            //endbooking
        });

    });
});
