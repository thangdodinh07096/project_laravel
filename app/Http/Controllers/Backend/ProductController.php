<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('backend.products.index')->with([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.products.create')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $image_info = [];
        if($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ( $images as $key => $image){
                $nameFile = $image->getClientOriginalName();
                $url= 'storage/images/'.$nameFile;
                Storage::disk('public')->putFileAs('product', $image, $nameFile);
                $image_info[] = [
                    'url' => $url,
                    'nameFile' => $nameFile
                ];
            }
        }
//        dd($request->all());
        $product = new Product();
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->content = $request->get('content');
        $product->status = $request->get('status');
        $product->user_id = Auth::user()->id;
        $product->save();



        foreach ($image_info as $image){
            $img = new Image();
            $img->name = $image['nameFile'];
            $img->path = $image['url'];
            $img->product_id = $product->id;
//            dd($img->name);
            $img->save();
        }
        return redirect()->route('backend.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        return view('backend.products.show')->with(['product' => $product,
                                                        'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        $categories = Category::get();
        return view('backend.products.edit')->with(['product' => $product,
                                                        'categories' => $categories,
                                                        'cate' =>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $image_info = [];
        if($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ( $images as $key => $image){
                $nameFile = $image->getClientOriginalName();
                $url= 'storage/images/'.$nameFile;
                Storage::disk('public')->putFileAs('product', $image, $nameFile);
                $image_info[] = [
                    'url' => $url,
                    'nameFile' => $nameFile
                ];
            }
        }

        $name = $request->get('name');
        $slug = \Illuminate\Support\Str::slug($request->get('name'));
        $category_id = $request->get('category_id');
        $origin_price = $request->get('origin_price');
        $sale_price = $request->get('sale_price');
        $content = $request->get('content');
        $status = $request->get('status');

        $product = Product::Find($id);
        $product->name = $name;
        $product->slug = $slug;
        $product->category_id = $category_id;
        $product->origin_price = $origin_price;
        $product->sale_price = $sale_price;
        $product->content = $content;
        $product->status = $status;
        $product->user_id = Auth::user()->id;
        $product->save();

        foreach ($image_info as $image){
            $img = new Image();
            $img->name = $image['nameFile'];
            $img->path = $image['url'];
            $img->product_id = $product->id;
            $img->save();
        }
        return redirect()->route('backend.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('backend.product.index');
    }
}
