<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('/v1')->namespace('Api\v1')->group(function(){

    // api authenticate
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::prefix('/admin')->group(function() {
        Route::post('login', 'AuthAdminController@login');
        Route::post('signup', 'AuthAdminController@signup');

        // only admin
        Route::post('logout', 'AuthController@logout');
        Route::get('',"AuthAdminController@admin");
        //end
    });
    //end

    // permisson user
    Route::post('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
    Route::post('/post/{post}/comment','CommentController@store');
    Route::post('/comment/{comment}/replyComment','ReplyCommentController@store');
    // end

    // api public
    Route::get('/booking','BookingController@index');
    Route::get('/category','CategoryController@index');
    Route::get('/product','ProductController@index');
    Route::get('/post','PostController@index');
    Route::get('/p/{slug}','PostController@showBySlug');
    Route::get('/search/post/{keyword}','PostController@search');
    Route::get('/comment','CommentController@index');
    Route::get('/post/{post}/comment','CommentController@getCommentInPost');

    Route::get('/replyComment','ReplyCommentController@index');
    Route::get('/comment/{comment}/replyComment','ReplyCommentController@getReplyCommentInPost');
    //end

    // permission admin
    Route::post('/booking','BookingController@store');
    Route::put('/booking/refuse/{booking}','BookingController@refuse');
    Route::put('/booking/confirm/{booking}','BookingController@confirm');

    Route::post('/category','CategoryController@store');
    Route::get('/category/{category}','CategoryController@show');
    Route::put('/category/{category}','CategoryController@update');
    Route::delete('/category/{category}','CategoryController@destroy');
    
    Route::post('/product','ProductController@store');
    Route::get('/product/{product}','ProductController@show');
    Route::put('/product/{product}','ProductController@update');
    Route::delete('/product/{product}','ProductController@destroy');

    Route::get('/customer','CustomerController@index');
    Route::get('/customer/{customer}','CustomerController@show');

    Route::get('/invoice','InvoiceController@index');
    Route::post('/invoice','InvoiceController@store');
    Route::get('/invoice/{invoice}','InvoiceController@show');
    Route::put('/invoice/completeOrder/{invoice}','InvoiceController@complete');

    Route::post('/post','PostController@store');
    Route::put('/post/{post}','PostController@update');
    Route::delete('/post/{post}','PostController@destroy');
    Route::put('/post/changeStatus/{post}','PostController@status');
    Route::get('/post/{post}','PostController@showById');
    //end
});