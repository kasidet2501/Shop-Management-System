<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CartMiddleware;


Route::get('/', function () {
    return view('welcome');
});

// -----------------> Home <----------------------
Route::get('/home', [HomeController::class, 'index']);

// -----------------> Product <----------------------
// Get
Route::get('/product', [ProductController::class, 'index']);

// Search
Route::get('/product/search', [ProductController::class, 'search']);
Route::post('/product/search', [ProductController::class, 'search']);

// Edit
Route::get('/product/edit/{id?}', [ProductController::class, 'edit']);

// update จะถูกเรียกจาก action form ของ edit.blade.php
Route::post('/product/update', [ProductController::class, 'update']);

// insert
Route::post('/product/add', [ProductController::class, 'insert']);

// remove
Route::get('/product/remove/{id}', [ProductController::class, 'remove']);



// -----------------> Category <----------------------
Route::get('/category', [CategoryController::class, 'index']);

// Search
Route::get('/category/search', [CategoryController::class, 'search']);
Route::post('/category/search', [CategoryController::class, 'search']);

// Edit
Route::get('/category/edit/{id?}', [CategoryController::class, 'edit']);

// update จะถูกเรียกจาก action form ของ edit.blade.php
Route::post('/category/update', [CategoryController::class, 'update']);

// insert
Route::post('/category/add', [CategoryController::class, 'insert']);

// remove
Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);

// -----------------> Cart <----------------------
Route::get('/cart/view', [CartController::class, 'viewCart']);

Route::get('/cart/add/{id}', [CartController::class, 'addToCart']);

Route::get('/cart/delete/{id}', [CartController::class, 'deleteCart']);

Route::get('/cart/update/{id}/{qty}', [CartController::class, 'updateCart']);

Route::middleware([CartMiddleware::class])->group(function(){
    Route::get('/cart/update/{id}/{qty}', [CartController::class, 'updateCart']);
});

// ---------------------> Authentication <---------------------
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ---------------------> Logout <---------------------
Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout']);
