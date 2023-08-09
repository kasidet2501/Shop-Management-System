<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

// Get
Route::get('/product', [ProductController::class, 'index']);

// Search
Route::get('/product/search', [ProductController::class, 'search']);
Route::post('/product/search', [ProductController::class, 'search']);

// Edit
Route::get('/product/edit/{id?}', [ProductController::class, 'edit']);

// update จะถูกเรียกจาก action form ของ edit.blade.php
Route::post('/product/update', [ProductController::class, 'update']);