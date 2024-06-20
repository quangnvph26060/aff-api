@extends('layouts.app')
@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('loc_category').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        });
    });
</script>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Danh sách sản phẩm </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="">
                            <div class="row ">
                                <form class="col-lg-5" method="get" action="{{ route('admin.product.search') }}" id="productSearchForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="">Tên sản phẩm</label>
                                                <input autocomplete="off" name="name" type="text" class="form-control" placeholder="Nhập tên sản phẩm" required>
                                                <div id="name_error" class="error"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="" style="opacity: 0">1</label> <br>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i> Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-lg-7">
                                    <form class="col-lg-4" action="" method="get">
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="exampleSelect" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="loc_category" name="category">
                                                <option value="}">--- Loại sản phẩm ---</option>
                                                @foreach ($category as $item)
                                                <option value="{{ route('admin.product.filter', ['id'=> $item->id]) }}">{{
                                                $item->name }}</option>
                                                @endforeach
                                                <option value="{{ route('admin.product.store')}}"> Danh sách tất cả các sản phẩm</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div style="float: right">
                                <a href="{{ route('admin.product.add') }}" class="btn btn-primary">Thêm sản phẩm</a>
                            </div>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('fail'))
                        <div class="alert alert-success">
                            {{ session('fail') }}
                        </div>
                        @endif

                        <div class="card-body">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Hoa Hồng</th>
                                                <th>Loại danh mục</th>
                                                <th>Trạng thái</th>
                                                <th style="text-align: center">Hành động</th>
                                            </tr>
                                        </thead>
                                        @if ($products->count() > 0)
                                        <tbody>

                                            @foreach($products as $key => $value)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>

                                                    @if (isset($value->images[0]))
                                                    <img style="width: 100px; height: 75px;" src="{{asset($value->images[0]->image_path )}}" alt="">
                                                    @endif

                                                </td>
                                                <td>{{ $value->quantity }}</td>
                                                <td>{{ $value->price }}</td>
                                                <td>{{ $value->commission_rate }}%</td>
                                                <td>{{ $value->category->name }}</td>
                                                <td>{{$value->status}}</td>
                                                <td align="center">
                                                    <a class="btn btn-warning" href="{{ route('admin.product.edit', ['id'=> $value->id]) }}">Sửa</a>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger" href="{{ route('admin.product.delete', ['id'=> $value->id]) }}">Xóa</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @else
                                        <tbody>
                                            <td class="text-center" colspan="10">
                                                <div class="">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 2048 2048">--}}
                                                    {{-- <path fill="currentColor" d="m960 120l832 416v1040l-832 415l-832-415V536l832-416zm625 456L960 264L719 384l621 314l245-122zM960 888l238-118l-622-314l-241 120l625 312zM256 680v816l640 320v-816L256 680zm768 1136l640-320V680l-640 320v816z"/>--}}
                                                    {{-- </svg>--}}
                                                    Không có sản phẩm cần tìm
                                                </div>
                                            </td>
                                        </tbody>
                                        @endif
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

@endsection