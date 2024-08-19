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
                        <h4 class="mb-sm-0 font-size-18">Danh sách nhà cung cấp </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="">
                            <div class="row ">
                                <form class="col-lg-5" method="get" action="{{ route('admin.brand.search') }}"
                                    id="brandSearchForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="">Tên thương hiệu</label>
                                                <input autocomplete="off" name="name" type="text" class="form-control"
                                                    placeholder="Tên sản phẩm" required id="name">
                                                <div style="color: red;" id="name_error" class="name_error"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="" style="opacity: 0">1</label> <br>
                                                <button type="button" onclick="searchProduct(event)"
                                                    class="btn btn-primary">
                                                    <i class="fas fa-search"></i> Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- <div class="col-lg-7">
                                    <form class="col-lg-4" action="" method="get">
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="exampleSelect" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="loc_category" name="category">
                                                <option value="}">--- Loại sản phẩm ---</option>
                                                @foreach ($category as $item)
                                                <option value="{{ route('admin.product.filter', ['id'=> $item->id]) }}">
                                                    {{
                                                    $item->name }}</option>
                                                @endforeach
                                                <option value="{{ route('admin.product.store')}}"> Danh sách tất cả các
                                                    sản phẩm</option>
                                            </select>
                                        </div>
                                    </form>
                                </div> --}}
                            </div>


                            <div style="float: right">
                                <a href="{{ route('admin.brand.add') }}" class="btn btn-primary">Thêm nhà cung cấp</a>
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
                                                <th>Logo</th>
                                                <th>Thương hiệu</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th style="text-align: center">Hành động</th>
                                            </tr>
                                        </thead>
                                        @if ($brand->count() > 0)
                                        <tbody>

                                            @foreach($brand as $key => $value)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>

                                                    @if (isset($value->logo))
                                                    <img style="width: 100px; height: 75px;"
                                                        src="{{asset($value->logo )}}" alt="">
                                                    @endif

                                                </td>
                                                <td>@truncate($value->name)</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->address }}</td>


                                                <td align="center">
                                                    <a class="btn btn-warning"
                                                        href="{{ route('admin.brand.edit', ['id'=> $value->id]) }}">Sửa</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @else
                                        <tbody>
                                            <td class="text-center" colspan="10">
                                                <div class="">

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
    <script>
        var validateaddproduct = {
            'name': {
            'element': document.getElementById('name'),
            'error': document.getElementById('name_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E0018')
                },
            ]
        },
        };
        function searchProduct(event){
        event.preventDefault();
            if (validateAllFields(validateaddproduct)){
                document.getElementById('brandSearchForm').submit();
            }
    }


    </script>
    <style scoped>
        .trang-thai {
            display: block !important;
        }
    </style>
    @endsection
