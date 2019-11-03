<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
//        if (Gate::allows('products-view')){
//            return view('backend.products.index')->with([
//                'products' => $products
//            ]);
//        } else dd('Khong dc cap quyen!');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.products.create')->with('categories', $categories);
//        if (Gate::allows('create-product')){
//            return view('backend.products.create')->with('categories', $categories);
//        } else dd('Khong dc cap quyen!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $image_info = [];
//        if($request->hasFile('images')) {
//            $images = $request->file('images');
//            foreach ( $images as $key => $image){
//                $nameFile = $image->getClientOriginalName();
//                $url= 'storage/images/'.$nameFile;
//                Storage::disk('public')->putFileAs('product', $image, $nameFile);
//                $image_info[] = [
//                    'url' => $url,
//                    'nameFile' => $nameFile
//                ];
//            }
//        }

//        $images = $request->image;
//
//        if ($request->hasFile('images')) {
//            $attributes = [];
//            foreach ($images as $key => $value) {
//                $name_image = $value->getClientOriginalName();
//                $attribute['Image.' . $key] = $name_image;
//            }
//        } else {
//            $attributes = [
//                'image' => 'Ảnh',
//            ];
//        }
//        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
//        if ($validator->fails()) {
//            return back()
//                ->withErrors($validator)
//                ->withInput();
//        }

//        $path_images = [];
//        foreach ($images as $image) {
//            //$img = new Image();
//            $type_image = $image->getClientOriginalExtension();
//            $name_image = $image->getClientOriginalName();
//            $time = time();
//             $img->path = $image['url'];
//             $img->product_id = $product->id;
//             $img->save();
//            $path = $image->storeAS('public/products', $name_image . '_' . $time . '.' . $type_image);
//            $path_images = $path;
//        }

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

        $product = new Product();
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->content = $request->get('content');
        $product->status = $request->get('status');
        $product->user_id = Auth::user()->id;
//        dd($product);
        $save = $product->save();

        foreach ($image_info as $image){
            $img = new Image();
            $img->name = $image['nameFile'];
            $img->path = $image['url'];
            $img->product_id = $product->id;
            $save_img= $img->save();
        }

        if ($save && $save_img) {
            $request->session()->flash('success', 'Tạo sản phẩm thành công' . '<br>');
        } else {
            $request->session()->flash('fail', 'Tạo sản phẩm thất bại' . '<br>');
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
        $user = Auth::user();
        $product = Product::find($id);
        $category = Category::find($product->category_id);
        $categories = Category::get();
//        $author = $this->authorize('update', $product);
//        dd($author);

//        if ($this->authorize('update', $product)){
//            return view('backend.products.edit')->with(['product' => $product,
//                'categories' => $categories,
//                'cate' =>$category]);
//        }else dd('Khong dc cap quyen!');

//        if ($user->can('update', $product)) {
//            return view('backend.products.edit')->with(['product' => $product,
//                                                            'categories' => $categories,
//                                                            'cate' =>$category]);
//        }else dd('Khong dc cap quyen!');


        if (Gate::allows('update-product-admin')){
            return view('backend.products.edit')->with(['product' => $product,
                'categories' => $categories,
                'cate' =>$category]);
        } else if (Gate::allows('update-product', $product)){
            return view('backend.products.edit')->with(['product' => $product,
                'categories' => $categories,
                'cate' =>$category]);
        } else dd('Khong dc cap quyen!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $save = $product->save();

        foreach ($image_info as $image){
            $img = new Image();
            $img->name = $image['nameFile'];
            $img->path = $image['url'];
            $img->product_id = $product->id;
            $img->save();
        }
        if ($save) {
            $request->session()->flash('success_update', 'Cập nhật sản phẩm thành công' . '<br>');
        } else {
            $request->session()->flash('fail_update', 'Cập nhật sản phẩm thất bại' . '<br>');
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
