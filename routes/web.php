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

Route::get('/', [App\Http\Controllers\HomeController::class,'index'])->name('user.home.index');

Route::post('/upload-chunks', [App\Http\Controllers\VideoUploadController::class, 'uploadChunk']);


Route::group(['prefix' => 'user','namespace'=>"User"], function () {
    Route::get('/profile', 'ProfileController@index')->name('user.profile.index');

    Route::get('/details/{id}', 'MovieController@details')->name('user.movie.details');

    Route::get('/watch/{id}', 'MovieController@video')->name('user.watch.video');
    Route::get('/video/{filename}', 'VideoController@stream')->name('user.watch.stream');

    // Categories
    Route::get('/categories', 'CategoryController@index')->name('user.categories.index');
    Route::get('/categories/{type}', 'CategoryController@sortby')->name('user.categories.sort');
    Route::post('/categories/search', 'CategoryController@search')->name('user.categories.search');

    // watchlist
    Route::get('/watchlist/{id}', 'MovieController@watchlist')->name('user.watchlist.add');

    // Staff Details
    Route::get('/directors/{name}', 'DirectorController@show')->name('user.director.show');
    Route::get('/actors/{name}', 'CastController@show')->name('user.actor.show');

    // Comment Routes
    Route::post('/comments/store', 'CommentController@store')->name('user.comment.store');

    // View Routes
    Route::post('watch/video/{id}/increase-view', 'MovieController@increaseView')->name('user.video.increase-view');

});

Route::group(['prefix' => 'admin','middleware'=>'admin','namespace'=>"Admin"], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard.index');

    // Movie Routes
    Route::get('/movies', 'MovieController@index')->name('admin.movies.index');
    Route::get('/movies/active', 'MovieController@active_list')->name('admin.movies.sidebar');
    Route::get('/movies/add', 'MovieController@add')->name('admin.movies.add');
    Route::get('/movies/edit/{id}', 'MovieController@edit')->name('admin.movies.edit');
    Route::get('/movies/delete/{id}', 'MovieController@delete')->name('admin.movies.delete');
    Route::post('/movies/save', 'MovieController@save')->name('admin.movies.save');
    Route::post('/movies/update', 'MovieController@update')->name('admin.movies.update');
    Route::get('/movies/active/{id}', 'MovieController@active_movie')->name('admin.movies.active');
    Route::get('/movies/inactive/{id}', 'MovieController@inactive_movie')->name('admin.movies.inactive');

    // Cast Routes
    Route::get('/cast', 'CastController@index')->name('admin.cast.index');
    Route::get('/cast/edit/{id}', 'CastController@edit')->name('admin.cast.edit');
    Route::post('/cast/update', 'CastController@update')->name('admin.cast.update');
    Route::get('/cast/delete/{id}', 'CastController@delete')->name('admin.cast.delete');

    // Director Routes
    Route::get('/director', 'DirectorController@index')->name('admin.director.index');
    Route::get('/director/edit/{id}', 'DirectorController@edit')->name('admin.director.edit');
    Route::post('/director/update', 'DirectorController@update')->name('admin.director.update');
    Route::get('/director/delete/{id}', 'DirectorController@delete')->name('admin.director.delete');
    
});

Route::group(['prefix' => 'auth','namespace'=>"Auth"], function () {
});

Auth::routes();

