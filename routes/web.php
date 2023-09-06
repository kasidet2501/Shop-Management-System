<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


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