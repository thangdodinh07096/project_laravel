@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('content')
    <!-- Content -->
    <div class="container-fluid">
            <!-- Main row -->
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sản phẩm mới nhập</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>User</th>
                                    <th>Thời gian</th>
                                    <th>Status</th>
                                    <th>Mô tả</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $product)
                                   <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->user->name }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>
                                            <a href="/admin/products/{{ $product->id }}" "email me">email me</a>
                                        </td>
                                        {{-- <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->content }}</td> --}}
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                            {!! $products->links() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
@endsection