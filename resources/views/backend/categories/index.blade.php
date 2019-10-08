@extends('backend.layouts.master')

@section('content-header')
    <!-- Content Header -->
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh mục sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Danh mục sản phẩm</a></li>
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
                            <h3 class="card-title">Danh mục sản phẩm</h3>

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
                                    <th>Tên danh mục</th>
                                    <th>Hãng</th>
                                    <th>Số lượng</th>
                                    <th>Mô tả</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Iphone</td>
                                    <td>Iphone</td>
                                    <td>1200</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Samsung</td>
                                    <td>Samsung</td>
                                    <td>1000</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Oppo</td>
                                    <td>Oppo</td>
                                    <td>950</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Xiaomi</td>
                                    <td>Xiaomi</td>
                                    <td>600</td>
                                    <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                </tr>
                                </tbody>
                            </table>
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