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
                                <form class="col-lg-5" method="get" action="{{ route('admin.product.search') }}"
                                    id="productSearchForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="">Tên sản phẩm</label>
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
                                <div class="col-lg-7">
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
                                                <th>Thương hiệu</th>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá nhập</th>
                                                <th>Giá bán</th>
                                                <th>Hoa Hồng</th>
                                                <th>Loại danh mục</th>
                                                <th>Trạng thái</th>
                                                <th>Đặc trưng</th>
                                                <th style="text-align: center">Hành động</th>
                                            </tr>
                                        </thead>
                                        @if ($products->count() > 0)
                                        <tbody>

                                            @foreach($products as $key => $value)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td class="text-product">{{ $value->name }}</td>
                                                <td>{{ $value->brands->name ?? ""}}</td>
                                                <td>

                                                    @if (isset($value->images[0]))
                                                    <img style="width: 100px; height: 75px;"
                                                        src="{{asset($value->images[0]->image_path )}}" alt="">
                                                    @endif

                                                </td>
                                                <td>{{ $value->quantity }}</td>
                                                <td>{{ number_format($value->purchase_price) }}đ</td>
                                                <td>{{ number_format($value->price) }}đ</td>
                                                <td>{{ $value->commission_rate }}%</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-select category" name="category">
                                                            @foreach ($category as $item)
                                                            <option {{ $value->category_id == $item->id ? 'selected' :
                                                                ''}}
                                                                data-idProduct="{{ $value->id }}" value="{{ $item->id
                                                                }}">
                                                                {{$item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-select status trang-thai" id="status">
                                                            <option {{ $value->status == 'published' ? 'selected' : ''
                                                                }}
                                                                data-idProduct="{{ $value->id }}" value="published">Được
                                                                phát hành</option>
                                                            <option {{ $value->status == 'inactive' ? 'selected' : '' }}
                                                                data-idProduct="{{ $value->id }}" value="inactive">Không
                                                                hoạt động</option>
                                                            <option {{ $value->status == 'scheduled' ? 'selected' : ''
                                                                }}
                                                                data-idProduct="{{ $value->id }}" value="scheduled">Lên
                                                                kế
                                                                hoạch</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-container">
                                                        <input type="checkbox" id="toggle{{$value->id}}" {{$value->is_featured == 1  ? "checked" : ""}} value="{{$value->id}}" class="toggle-checkbox">
                                                        <label for="toggle{{$value->id}}" class="toggle-label">
                                                            <span class="toggle-knob"></span>
                                                        </label>
                                                    </div>
                                                    
                                                   
                                                </td>
                                                <td align="center">
                                                    <a class="btn btn-warning"
                                                        href="{{ route('admin.product.edit', ['id'=> $value->id]) }}">Sửa</a>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                        class="btn btn-danger"
                                                        href="{{ route('admin.product.delete', ['id'=> $value->id]) }}">Xóa</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @else
                                        <tbody>
                                            <td class="text-center" colspan="10">
                                                <div class="">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                                        viewBox="0 0 2048 2048">--}}
                                                        {{--
                                                        <path fill="currentColor"
                                                            d="m960 120l832 416v1040l-832 415l-832-415V536l832-416zm625 456L960 264L719 384l621 314l245-122zM960 888l238-118l-622-314l-241 120l625 312zM256 680v816l640 320v-816L256 680zm768 1136l640-320V680l-640 320v816z" />
                                                        --}}
                                                        {{--
                                                    </svg>--}}
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                                        viewBox="0 0 2048 2048">--}}
                                                        {{--
                                                        <path fill="currentColor"
                                                            d="m960 120l832 416v1040l-832 415l-832-415V536l832-416zm625 456L960 264L719 384l621 314l245-122zM960 888l238-118l-622-314l-241 120l625 312zM256 680v816l640 320v-816L256 680zm768 1136l640-320V680l-640 320v816z" />
                                                        --}}
                                                        {{--
                                                    </svg>--}}
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
    document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.toggle-checkbox');
    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', function(event) {
            const value = event.target.value;
            const isChecked = this.checked ? 1 : 0;
              // Gọi API với fetch
              const formData = new FormData();
                formData.append('id_commi', value);
                formData.append('status', isChecked);
                formData.append('_token', '{{ csrf_token() }}');
              $.ajax({
                url: '{{ route("admin.product.featured") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                
            }   
        });

        });
    });
});

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
                document.getElementById('productSearchForm').submit();
            }
    }

    $(document).ready(function(){
        $('.category').change(function(){
            var category = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var productId = selectedOption.data('idproduct');

            $.ajax({
                    url: '{{ route('admin.changecategory') }}',
                    type: 'POST',
                    data: {
                        category: category,
                        productId: productId,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if(response.success) {
                            alert('Đã chuyển đổi sang loại danh mục : ' + response.data);
                        } else {
                            alert('Thay đổi thất bại');
                        }
                    }
                });
        })


        $('.status').change(function(){
            var status = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var productId = selectedOption.data('idproduct');
            $.ajax({
                    url: '{{ route('admin.changestatus') }}',
                    type: 'POST',
                    data: {
                        status: status,
                        productId: productId,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if(response.success) {
                            $thongbao = '';
                            if(response.data == 'published' ){
                                $thongbao = 'Được phát hành ';
                            }else if(response.data == 'inactive'){
                                $thongbao = "Không hoạt động";
                            }else{
                                $thongbao = "Lập kế hoạch";
                            }
                            alert('Đã chuyển đổi trạng thái thành : ' + $thongbao);
                        } else {
                            alert('Thay đổi thất bại');
                        }
                    }
                });
        })
    })
    </script>
    <style scoped>
        .trang-thai{
            display: block !important;
        }
    .toggle-container {
        display: flex;
        align-items: center;
    }

    .toggle-checkbox {
        display: none;
    }

    .toggle-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        width: 60px;
        height: 30px;
        background-color: #ccc;
        border-radius: 30px;
        position: relative;
        transition: background-color 0.3s ease;
    }
.text-product{
    width: 200px !important; /* Thiết lập chiều rộng */
  word-wrap: break-word;
  white-space: normal;
  overflow: hidden; /* Ẩn phần văn bản vượt quá */
  display: -webkit-box; /* Sử dụng box để giới hạn số dòng */
  -webkit-line-clamp: 2; /* Hiển thị tối đa 2 dòng */
  -webkit-box-orient: vertical; /* Định hướng dọc cho box */
  line-height: 1.2; /* Điều chỉnh chiều cao dòng nếu cần */
}
    .toggle-knob {
        width: 26px;
        height: 26px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: transform 0.3s ease;
    }

    .toggle-checkbox:checked + .toggle-label {
        background-color: #4caf50;
    }

    .toggle-checkbox:checked + .toggle-label .toggle-knob {
        transform: translateX(30px);
    }
    </style>
    @endsection
