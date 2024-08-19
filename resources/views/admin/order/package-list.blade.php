@extends('layouts.app')
@section('content')
@php
$orderStatuses = [
1 => 'Chờ xử lý',
2 => 'Thành Công',
3 => 'Đã hủy',
];
@endphp
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{$title}}</h4>
                    </div>
                    <div class="row">
                        <form class="col-lg-5" method="get" action="{{ route('admin.package.list') }}"
                            id="productSearchForm">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="">Tìm kiếm đơn hàng</label>
                                        <input autocomplete="off" name="search" type="text" class="form-control"
                                            placeholder="Tìm kiếm đơn hàng" required id="name">
                                        {{-- <div style="color: red;" id="name_error" class="name_error"></div> --}}
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
                            <form class="col-lg-4" action="{{ route('admin.package.list') }}" method="get" id="statusForm">
                                <div class="form-group">
                                    <label for="exampleSelect" class="form-label">Trạng thái đơn hàng</label>
                                    <select class="form-select" id="loc_category" name="status" onchange="this.form.submit()">
                                        <option value="">---  Chọn  ---</option>
                                        @foreach($orderStatuses as $index => $item)
                                            <option value="{{ $index }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                   </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Tên gói tháng</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá </th>
                                            <th>Mã người đặt hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ giao hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền thanh toán</th>
                                            <th style="text-align: center">Hành động</th>
                                        </tr>
                                    </thead>
                                       
                                        <tbody>
                                            @foreach($orders as $key => $item)

                                            <tr>
                                                <td> {{$key + 1}}</td>
                                                <td>{{$item->zip_code}}</td>
                                                <td class="product-cell">
                                                    {{$item->package->name}}
                                                </td>
                                                
                                                <td>
                                                   1
                                                </td>

                                                <td>
                                                    {{$item->package->price}}
                                                </td>
                                                <td>{{ $item->referral_code }}</td>
                                                <td>{{$item->name}}</td>
                                                <td style="width:150px">{{$item->receive_address}}</td>
                                                <td>{{$item->phone}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-select" onchange="updateOrderStatus({{$item->id}} , this.value)" >
                                                                @foreach($orderStatuses as $key => $value)
                                                                <option value="{{ $key }}" {{ $item->status == $key ? 'selected' : '' }}>
                                                                    {{ $value }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                <td>{{number_format($item->total_money)}}đ</td>
                                                <td align="center">
                                                    <a class="btn btn-warning" href="">Sửa</a>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger" href="">Xóa</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                  
                                </table>
                                <nav class="pt-4 pb-4">
                                   {{$orders->links()}}
                                </nav>

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
<script>
     function searchProduct(event){
        event.preventDefault();
        document.getElementById('productSearchForm').submit();
    }
    function updateOrderStatus(orderId, status) {
        console.log(orderId, status);
        $.ajax({
            url: '{{ route("admin.order.updateStatus") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                order_id: orderId,
                status: status
            },
            success: function(response) {
                alert('Cập nhật trạng thái thành công!');
            },
            error: function(xhr, status, error) {
                alert('Có lỗi xảy ra: ' + error);
            }
        });
    }
    var productName = document.querySelectorAll(".product-name");
    if (productName.innerText.trim() === "") {
        productName.classList.add("hide");
    }
</script>
<style scoped>
.product-cell {
   flex-direction: column;
}
.hide {
    display: none;
  }
.product-cell .product-name {    
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    text-overflow: ellipsis;
    border-bottom: 1px solid gray;
    line-height: 22px;
}

</style>