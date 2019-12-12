<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $title = 'Home Page Laravel Paypal';

        $products = Product::orderby('id', 'DESC')->get();

        return view('store.home.index', compact('title', 'products'));
    }
}
