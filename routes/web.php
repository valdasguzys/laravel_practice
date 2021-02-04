<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

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


//naudoja .htaccess www folderyje. pasiekiama tiesiai is localhost
Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

// //nenaudojant .htacces www foleryje pasiekti per /laravel_practice/
// Route::get('/laravel_practice/', function () {
//     return view('welcome');
// })->name('index');

// Route::get('/laravel_practice/about', function () {
//     return view('about');
// })->name('about');

//naudoja .htaccess www folderyje. pasiekiama tiesiai is localhost
Route::get('/posts', 'App\Http\Controllers\BlogPostController@index')->name('posts.index');
Route::get('/posts/{id}', 'App\Http\Controllers\BlogPostController@show')->name('posts.show');
Route::post('/posts', 'App\Http\Controllers\BlogPostController@store');
Route::delete('/posts/{id}', 'App\Http\Controllers\BlogPostController@destroy')->name('posts.destroy');
Route::put('/posts/{id}', 'App\Http\Controllers\BlogPostController@update')->name('posts.update');
Route::post('/posts/{id}/comments', [BlogPostController::class, 'storePostComment'])->name('posts.comments.store');

Route::get('/', function () { return view('welcome'); })->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('.home');


// //nenaudojant .htacces www foleryje pasiekti per /laravel_practice/
// Route::get('/laravel_practice/posts', 'App\Http\Controllers\BlogPostController@index')->name('posts.index');
// Route::get('/laravel_practice/posts/{id}', 'App\Http\Controllers\BlogPostController@show')->name('posts.show');
// Route::post('/laravel_practice/posts', 'App\Http\Controllers\BlogPostController@store');
// Route::delete('/laravel_practice/posts/{id}', 'App\Http\Controllers\BlogPostController@destroy')->name('posts.destroy');
// Route::put('/laravel_practice/posts/{id}', 'App\Http\Controllers\BlogPostController@update')->name('posts.update');
// Route::post('/laravel_practice/posts/{id}/comments', [BlogPostController::class, 'storePostComment'])->name('posts.comments.store');


// // sitas veikia importavus:
// // use App\Http\Controllers\BlogPostController;
//  Route::post('/laravel_practice/posts', [BlogPostController::class, 'store']);






// Route::get('/laravel_practice/db', function () {
//     var_dump(DB::connection()->getPdo());
//     return view('welcome');
// })->name('laravel_practice');

// use App\Models\BlogPost;
// Route::get('/laravel_practice/bp', function () {
//     // $bp = new BlogPost();
//     // $bp->title = "Bp 1";
//     // $bp->text = "Bp text 1";
//     // $bp->save();
//     return BlogPost::where('title', 'title 1')->latest()->first();
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
