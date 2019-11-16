@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Chi tiết sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 style="font-weight: 550;">
                <p>Id: {{$product->id}}</p>
                <p>Tên sản phẩm: {{$product->name}}</p>
                <p>Danh mục sản phẩm: {{$category->name}}</p>
                <p>Giá gốc: {{$product->origin_price}}</p>
                <p>Giá bán: {{$product->sale_price}}</p>
                <p>Trạng thái: @if($product->status == -1) Đang nhập @endif
                    @if($product->status == 0)  Mở bán @endif
                    @if($product->status == 1) Hết hàng @endif
                </p>
                </h3>
            </div>
            <div class="col-lg-6">
                <h3>Ảnh sản phẩm</h3>
{{--                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">--}}
{{--                    <div class="carousel-inner">--}}
{{--                        <div class="carousel-item active">--}}
{{--                            <img class="d-block w-100" src="..." alt="First slide">--}}
{{--                        </div>--}}
{{--                        <div class="carousel-item">--}}
{{--                            <img class="d-block w-100" src="..." alt="Second slide">--}}
{{--                        </div>--}}
{{--                        <div class="carousel-item">--}}
{{--                            <img class="d-block w-100" src="..." alt="Third slide">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">--}}
{{--                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                        <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">--}}
{{--                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                        <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                @foreach($product->images as $image)
                <img style="width: 120px" src="/{{$image->path}}" alt="">
                @endforeach
            </div>
            <h2 class="col-lg-12">
                <p>Mô tả: {!! $product->content !!}</p>
            </h2>
        </div>
    </div>
@endsection
