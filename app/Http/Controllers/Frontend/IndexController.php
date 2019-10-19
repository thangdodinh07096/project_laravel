<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
    	$products = Product::get();
        return view('frontend.index')->with([
            'products' => $products
        ]);
    }

}