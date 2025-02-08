<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/categories', function () {
    return view('frontend.categories');
});

Route::get('/blogs', function () {
    return view('frontend.blogs');
});

Route::get('/blog-details', function () {
    return view('frontend.blog_details');
});

Route::get('/details', function () {
    return view('frontend.details');
});

Route::get('/watch', function () {
    return view('frontend.watch');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::group(['prefix' => 'user','namespace'=>"User"], function () {
});

Route::group(['prefix' => 'admin','namespace'=>"Admin"], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');
});

Route::group(['prefix' => 'auth','namespace'=>"Auth"], function () {
});

Auth::routes();

