<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        // ส่ง compactของproductsที่เราget all มา ให้ส่งไปยังpage index
        return view('product/index', compact('products'));
    }
}
