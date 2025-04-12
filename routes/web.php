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
    Route::get('/watch', 'VideoController@video')->name('user.watch.video');
    Route::get('/video/{filename}', 'VideoController@stream')->name('user.watch.stream');
});

Route::group(['prefix' => 'admin','namespace'=>"Admin"], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');

    Route::get('/movies', 'MovieController@index')->name('admin.movies.index');
    Route::get('/movies/add', 'MovieController@add')->name('admin.movies.add');
    Route::get('/movies/edit/{id}', 'MovieController@edit')->name('admin.movies.edit');
    Route::get('/movies/delete/{id}', 'MovieController@delete')->name('admin.movies.delete');
    Route::post('/movies/save', 'MovieController@save')->name('admin.movies.save');
    Route::post('/movies/update', 'MovieController@update')->name('admin.movies.update');
    
});

Route::group(['prefix' => 'auth','namespace'=>"Auth"], function () {
});

Auth::routes();

