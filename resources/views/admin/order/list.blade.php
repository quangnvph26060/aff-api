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
        $count = count($orderStatuses) ?? 0;
    @endphp
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>
                        </div>
                        <div class="row">
                            <form class="col-lg-5" method="get" action="{{ route('admin.order.list') }}"
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
                                            <button type="button" onclick="searchProduct(event)" class="btn btn-primary">
                                                <i class="fas fa-search"></i> Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-lg-7">
                                <form class="col-lg-4" action="{{ route('admin.order.list') }}" method="get"
                                    id="statusForm">
                                    <div class="form-group">
                                        <label for="exampleSelect" class="form-label">Trạng thái đơn hàng</label>
                                        <select class="form-select" id="loc_category" name="status"
                                            onchange="this.form.submit()">
                                            <option value="">--- Chọn ---</option>
                                            @foreach ($orderStatuses as $index => $item)
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
                                            @foreach ($orders as $key => $item)
                                                <tr>
                                                    <td> {{ $key + 1 }}</td>
                                                    <td>{{ $item->zip_code }}</td>
                                                    <td class="product-cell">
                                                        @foreach ($item->order_detail as $k)
                                                            <span
                                                                class="product-name">{{ $k->product['name'] ?? '' }}</span>
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach ($item->order_detail as $quantity)
                                                            {{ $quantity->quantity }} <br>
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach ($item->order_detail as $k)
                                                            {{ isset($k->product['price']) ? number_format($k->product['price']) : '' }}đ<br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->user_id[0]['referral_code'] ?? '' }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td style="width:150px">{{ $item->receive_address }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    @if ($role === 4)
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-select"
                                                                    onchange="updateOrderStatus({{ $item->id }} , this.value)">
                                                                    @foreach ($orderStatuses as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            {{ $item->status == $key ? 'selected' : '' }}>
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    @endif
                                                    @if ($role === 1)
                                                        <td>
                                                            <div class="form-group">

                                                                <select class="form-select"
                                                                    onchange="updateOrderStatus({{ $item->id }} , this.value)">
                                                                    @foreach ($orderStatuses as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            {{ $item->status == $key ? 'selected' : '' }}
                                                                            disabled>
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    @endif

                                                    <td>{{ number_format($item->total_money) }}đ</td>
                                                    <td align="center">
                                                        <a class="btn btn-warning" href="">Sửa</a>
                                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                            class="btn btn-danger" href="">Xóa</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <nav class="pt-4 pb-4">
                                        @if ($role === 1)
                                            {{ $orders->links() }}
                                        @elseif($role === 4)
                                            {{-- {{ $orders->setPath(route('admin.order.list'))->links('pagination::bootstrap-4') }} --}}
                                            @if ($orders->lastPage() > 1)
                                            <ul class="pagination">
                                                @if ($orders->currentPage() > 3)
                                                    <li><a href="{{ route('admin.order.list', ['page' => 1]) }}">1</a></li>
                                                    <li><span>...</span></li>
                                                @endif
                                        
                                                @for ($i = max(1, $orders->currentPage() - 2); $i <= min($orders->currentPage() + 2, $orders->lastPage()); $i++)
                                                    <li class="{{ $orders->currentPage() == $i ? 'active' : '' }}">
                                                        <a href="{{ route('admin.order.list', ['page' => $i]) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                        
                                                @if ($orders->currentPage() < $orders->lastPage() - 2)
                                                    <li><span>...</span></li>
                                                    <li><a href="{{ route('admin.order.list', ['page' => $orders->lastPage()]) }}">{{ $orders->lastPage() }}</a></li>
                                                @endif
                                            </ul>
                                        @endif
                                        @endif
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
    function searchProduct(event) {
        event.preventDefault();
        document.getElementById('productSearchForm').submit();
    }

    function updateOrderStatus(orderId, status) {
        console.log(orderId, status);
        $.ajax({
            url: '{{ route('admin.order.updateStatus') }}',
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
    /* pagination.css */

ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
    list-style: none;
}

ul.pagination li {
    display: inline;
}

ul.pagination li a {
    border-radius:10px; 
    color: black;
    margin-right: 5px;
    border: 1px solid;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}

ul.pagination li a.active {
    background-color: #007bff;
    color: white;
}

ul.pagination li a:hover:not(.active) {
    background-color: #ddd;
}

ul.pagination li span {
    color: black;
    float: left;
    padding: 8px 16px;
}
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
