<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
/**
 * dung cache khi can thiet truy van database thay doi lien tuc trong 1 khoang thoi gian can thiet
*/
//        Cache::put('name', 'Do Dinh Thang', 10);
//        Cache::put('age', '21', 10);
//        Cache::put('number', ['123456'=>1, '321'=>2], 10);
//        Cache::put('name', 'Ha Noi', 10);
//        Cache::add('view_count', '0', 10000);

//        $view_count = Cache::increment('view_count');
//        $vew_count_down = Cache::decrement('view_count');
//        Cache::put('view_count', '0', 1);
//        $add = Cache::add('name', 'value', 10);

        $cate = Cache::remember('categories', 10, function() {
            return DB::table('categories')->get();
        });
        $top_product = Cache::remember('top_product', 10, function() {
            return $top_product = Product::take(5)->get('name');
        });

//        $name = Cache::get('name');
////        $number = Cache::get('number');
//
//        $cate = Category::Find(1);
//        $categories = Category::Get();
//        Cache::put('cate', $cate, 10);
//        Cache::put('categories', $categories, 10);
//        $categoriessssss = Cache::get('categories');
//        dd($add);
        dd($top_product);
//        dd($vew_count_down);
        return view('home')->with(['view_count' => $vew_count_down]);

    }
}
