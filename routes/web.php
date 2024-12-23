<?php

use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\CartManager;
use App\Http\Controllers\HomeManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminManager;
use App\Http\Controllers\PostsManager;
use App\Http\Controllers\ProfileManager;
Route::resource('posts', PostsManager::class);
Route::resource('posts', ProfileManager::class );
//Auth

Route::get('/login',[AuthManager::class, 'login'])->name('login');
Route::get('/registration',[AuthManager::class, 'register'])->name('register');
Route::post('/login',[AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/registration',[AuthManager::class, 'registerPost'])->name('register.post');
Route::get('/logout',[AuthManager::class,'logout'])->name('logout');


// Profile
Route::get('/profile', [ProfileManager::class, 'profileView'])->name('profileView');

//Home
Route::get('/', HomeManager::class)->name('home');

// Product

Route::get('/product/{id}',[PostsManager:: class, 'getProductById'])->name('getProduct.get');

Route::get('/dashboard/product/{id}/edit', [PostsManager:: class, 'updateProductView']);

Route::put('/dashboard/product/{id}/edit', [PostsManager:: class, 'updateProduct'])->name('updateProduct.put');

Route::delete('/post/{id}/delete', [PostsManager:: class, 'deletePost'])->name('deletePost.delete');

Route::get('/dashboard', [AdminManager::class,'getAdminDashboard'])->name('adminDashboard.get')->middleware("role:admin|editor");
Route::post('/dashboard/product/create', [PostsManager::class,'createPost'])->name('createPost.post')->middleware("role:user|admin");
Route::get('/dashboard/product/create', function(){
    return view('createProduct');
});
Route::post('/posts/{id}/addLike',[PostsManager::class,'addLike'])->name('posts.addLike');