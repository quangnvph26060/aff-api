@extends('layouts.app')
@section('content')
@php
$orderStatuses = [
1 => 'Chờ xử lý',
2 => 'Đang vận chuyển',
3 => 'Đã giao hàng',
4 => 'Đã hủy',
5 => 'Đã hoàn tiền',
6 => 'Tạm dừng',
7 => 'Thất bại',
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
                                            <th>Tên sản phẩm</th>
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
                                                    @foreach($item->order_detail as $k)
                                                        <span class="product-name">{{$k->product['name'] ?? ""}}</span>
                                                    @endforeach
                                                </td>
                                                
                                                <td>
                                                
                                                    @foreach($item->order_detail as $quantity )
                                                    {{$quantity->quantity}} <br>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach($item->order_detail as $k )
                                                    {{ isset($k->product['price']) ? number_format($k->product['price']) : "" }}đ<br>
                                                    @endforeach
                                                </td>
                                                <td>{{$item->user_id[0]['referral_code']}}</td>
                                                <td>{{$item->name}}</td>
                                                <td style="width:150px">{{$item->receive_address}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-select" onchange="updateOrderStatus({{$item->id}} , this.value)">
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
                                <nav>
                                    <!-- <ul class="pagination">

                <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
        <span class="page-link" aria-hidden="true">&lsaquo;</span>
    </li>


                
    
    
                                                                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=2">2</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=3">3</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=4">4</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=5">5</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=6">6</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=7">7</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=8">8</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=9">9</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=10">10</a></li>
                                                                            
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
    
    
                                
    
    
                                                                            <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=119">119</a></li>
                                                                                    <li class="page-item"><a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=120">120</a></li>
                                                            

                <li class="page-item">
        <a class="page-link" href="https://quanlycongviec.site/admin/mission/list?page=2" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
    </li>
</ul> -->
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
</script>
<style scoped>
.product-cell {
   flex-direction: column;
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