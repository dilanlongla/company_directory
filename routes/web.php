<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'blog_index'])->name('blog.posts.index');
Route::get('/posts/{id}', [PostController::class, 'blog_show'])->name('blog.posts.post');
Route::get('/services', [ServiceController::class, 'blog_index'])->name('blog.services.index');
Route::get('/services/service', [ServiceController::class, 'blog_index'])->name('blog.services.service');


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('manage/comments', App\Http\Controllers\CommentController::class);

    Route::resource('manage/posts', App\Http\Controllers\PostController::class);

    Route::resource('manage/categories', App\Http\Controllers\CategoryController::class);

    Route::resource('manage/services', App\Http\Controllers\ServiceController::class);
});
