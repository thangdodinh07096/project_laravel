<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $categories = Cache::remember('categories', 10, function() {
            return Category::get();
        });
    	$products = Product::get();
        return view('frontend.index')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

}
