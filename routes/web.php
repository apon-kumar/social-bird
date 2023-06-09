<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\googleController;
use App\Http\Controllers\postController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\profileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'guest'], function(){
    Route::get('/login', [authController::class, 'index'])->name('login');
    Route::post('/login', [authController::class, 'login'])->name('login');
    Route::get('/register', [authController::class, 'register_view'])->name('register');
    Route::post('/register', [authController::class, 'register'])->name('register');
    Route::get('/auth/google', [googleController::class, 'signupView'])->name('signup.view');
    Route::get('/auth/google/callback', [googleController::class, 'signup'])->name('signup');

});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', [homeController::class, 'home'])->name('home');
    Route::get('/logout', [authController::class, 'logout'])->name('logout');
    Route::get('/home/{post}/viewpost', [postController::class, 'viewPost'])->name('post.view');
    Route::post('/createpost',[postController::class, 'postCreatePost'])->name('post.create');
    Route::post('/post/{id}/comment', [postController::class, 'createComment'])->name('comment.create');
    Route::get('/profile', [profileController::class, 'profile'])->name('profile');
    Route::post('/profile/avatar', [profileController::class, 'uploadAvatar'])->name('avatar.upload');
    Route::post('/post/{id}/like', [postController::class, 'likePost'])->name('post.like');
    Route::post('/post/{id}/delete', [postController::class, 'deletePost'])->name('post.delete');
    Route::get('/post/{post}/edit', [postController::class, 'editPost'])->name('post.edit');
    Route::post('/post/{post}/update', [postController::class, 'updatePost'])->name('post.update');
    Route::post('/comment/{id}/delete', [postController::class, 'deleteComment'])->name('comment.delete');
    Route::post('/post/comment/{id}/edit', [postController::class, 'updateComment'])->name('comment.update');

});
