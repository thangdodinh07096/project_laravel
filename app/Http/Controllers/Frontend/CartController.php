<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Model\User;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Cache::remember('categories', 10, function() {
            return DB::table('categories')->get();
        });

        $all = Cart::content();
//        dd($all);
        $cart = Cart::count();
        return view('frontend.cart')->with(['categories'=>$categories, 'all' => $all,'cart' => $cart]);
    }

    public function add($id){
//        dd($id);
        $product = Product::find($id);
        $product_iamges = Product::with('images')->find($id);
        $images = $product_iamges->images;
        Cart::add($id, $product->name, 1, $product->sale_price,0, ['image'=> $images[0]->path]);
        return redirect()->route('frontend.cart.index');
    }
//    public function delete($id){
//        Cart::remove($id);
//        return redirect()->route('frontend.cart.index');
//    }
}
