@extends('layouts.app')
@section('content')
<div class="main-content" >
    <div class="page-content">
        <div class="container-fluid">
            <!-- Begin page -->
            <div id="layout-wrapper">
                <!-- removeNotificationModal -->
                <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="NotificationModalbtn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                    </lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Are you sure ?</h4>
                                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this
                                            Notification ?</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes,
                                        Delete
                                        It!</button>
                                </div>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- ========== App Menu ========== -->

                <!-- Left Sidebar End -->
                <!-- Vertical Overlay-->
                <div class="vertical-overlay"></div>

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content ml-dasboard" >

                    <div class="page-content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-8">

                                    <div class="h-100">
                                        <div class="row mb-3 pb-1">
                                            <div class="col-12">
                                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                                    <div class="flex-grow-1">
                                                        <h4 class="fs-16 mb-1">Xin chào,
                                                            {{$loggedInUser['user']['name']}}! </h4>
                                                        <p class="text-muted mb-0">Đây là thống kê của trang web</p>
                                                    </div>
                                                    {{-- <div class="mt-3 mt-lg-0">
                                                        <form action="javascript:void(0);">
                                                            <div class="row g-3 mb-0 align-items-center">
                                                                <div class="col-sm-auto">
                                                                    <div class="input-group">
                                                                        <input type="text"
                                                                            class="form-control border-0 dash-filter-picker shadow"
                                                                            data-provider="flatpickr"
                                                                            data-range-date="true"
                                                                            data-date-format="d M, Y"
                                                                            data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                                        <div
                                                                            class="input-group-text bg-primary border-primary text-white">
                                                                            <i class="ri-calendar-2-line"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-auto">
                                                                    <button type="button"
                                                                        class="btn btn-soft-success"><i
                                                                            class="ri-add-circle-line align-middle me-1"></i>
                                                                        Add Product</button>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-auto">
                                                                    <button type="button"
                                                                        class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                                            class="ri-pulse-line"></i></button>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </form>
                                                    </div> --}}
                                                </div><!-- end card header -->
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->

                                        <div class="row">
                                            <div class="col-xl-3 col-md-6" id="div1">
                                                <!-- card -->
                                                <div class="card card-animate">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <p
                                                                    class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                    Tổng thu nhập</p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <h5 class="text-success fs-14 mb-0">
                                                                    <i
                                                                        class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                                    +16.24 %
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-end justify-content-between mt-4">
                                                            <div>
                                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                                    <span class="counter-value" data-target="{{ $statistic['total'] }}">0</span>đ
                                                                </h4>
                                                                <a style="text-decoration: none !important"
                                                                    class="text-decoration-underline">Tổng thu nhập</a>
                                                            </div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-success-subtle rounded fs-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 32 32">
                                                                        <path fill="currentColor"
                                                                            d="M2 22h28v2H2zm0 4h28v2H2zm22-16a2 2 0 1 0 2 2a2 2 0 0 0-2-2zm-8 6a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4zm0-6a2 2 0 1 0 2 2a2.002 2.002 0 0 0-2-2zm-8 0a2 2 0 1 0 2 2a2 2 0 0 0-2-2z" />
                                                                        <path fill="currentColor"
                                                                            d="M28 20H4a2.005 2.005 0 0 1-2-2V6a2.005 2.005 0 0 1 2-2h24a2.005 2.005 0 0 1 2 2v12a2.003 2.003 0 0 1-2 2Zm0-14H4v12h24Z" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end col -->

                                            <div class="col-xl-3 col-md-6" id="div2">
                                                <!-- card -->
                                                <div class="card card-animate">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <a href="/admin/order/list">
                                                                    <p
                                                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                        Đơn hàng</p>
                                                                </a>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <h5 class="text-danger fs-14 mb-0">
                                                                    <i
                                                                        class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                                                    -3.57 %
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-end justify-content-between mt-4">
                                                            <div>
                                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                                        class="counter-value"
                                                                        data-target="{{ $statistic['number'] }}">0</span>
                                                                </h4>
                                                                <a href="/admin/order/list"
                                                                    class="text-decoration-underline">Xem tất cả</a>
                                                            </div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" viewBox="0 0 24 24">
                                                                        <path fill="currentColor"
                                                                            d="m17.371 19.827l2.84-2.796l-.626-.627l-2.214 2.183l-.956-.975l-.627.632l1.583 1.583ZM6.77 8.73h10.462v-1H6.769v1ZM18 22.115q-1.671 0-2.836-1.164T14 18.115q0-1.67 1.164-2.835T18 14.115q1.671 0 2.836 1.165T22 18.115q0 1.672-1.164 2.836Q19.67 22.115 18 22.115ZM4 20.77V4h16v7.56q-.244-.09-.485-.154q-.24-.064-.515-.1V5H5v14.05h6.344q.068.41.176.802q.109.392.303.748l-.035.035l-1.134-.827l-1.346.961l-1.346-.961l-1.347.961l-1.346-.961L4 20.769Zm2.77-4.5h4.709q.056-.275.138-.515q.083-.24.193-.485H6.77v1Zm0-3.769h7.31q.49-.387 1.05-.645q.56-.259 1.197-.355H6.769v1ZM5 19.05V5v14.05Z" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end col -->
                                            @if($loggedInUser['user']['role_id'] === 1)
                                                <div class="col-xl-3 col-md-6">
                                                    <!-- card -->
                                                    <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <p
                                                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                        Khách hàng</p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <h5 class="text-success fs-14 mb-0">

                                                                        +29.08 %
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-end justify-content-between mt-4">
                                                                <div>
                                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                                            class="counter-value"
                                                                            data-target="{{$useramount}}">0</span>
                                                                    </h4>
                                                                    <a style="text-decoration: none !important"
                                                                        class="text-decoration-underline">Khách hàng</a>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-warning-subtle rounded fs-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                            height="20" viewBox="0 0 32 32">
                                                                            <path fill="currentColor"
                                                                                d="M26 30h-2v-5a5.006 5.006 0 0 0-5-5h-6a5.006 5.006 0 0 0-5 5v5H6v-5a7.008 7.008 0 0 1 7-7h6a7.008 7.008 0 0 1 7 7v5zM22 6v4c0 1.103-.897 2-2 2h-1a1 1 0 0 0 0 2h1c2.206 0 4-1.794 4-4V6h-2zm-6 10c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.988 0 3.89.85 5.217 2.333l-1.49 1.334A5.008 5.008 0 0 0 16 4c-2.757 0-5 2.243-5 5s2.243 5 5 5v2z" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->
                                                <div class="col-xl-3 col-md-6">
                                                    <!-- card -->
                                                    <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <p
                                                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                                        CÔNG TÁC VIÊN</p>
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <h5 class="text-success fs-14 mb-0">

                                                                        +29.08 %
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex align-items-end justify-content-between mt-4">
                                                                <div>
                                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                                            class="counter-value"
                                                                            data-target="{{$useramountAffliate}}">0</span>
                                                                    </h4>
                                                                    <a style="text-decoration: none !important"
                                                                        class="text-decoration-underline">CÔNG TÁC VIÊN</a>
                                                                </div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-warning-subtle rounded fs-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                            height="20" viewBox="0 0 32 32">
                                                                            <path fill="currentColor"
                                                                                d="M26 30h-2v-5a5.006 5.006 0 0 0-5-5h-6a5.006 5.006 0 0 0-5 5v5H6v-5a7.008 7.008 0 0 1 7-7h6a7.008 7.008 0 0 1 7 7v5zM22 6v4c0 1.103-.897 2-2 2h-1a1 1 0 0 0 0 2h1c2.206 0 4-1.794 4-4V6h-2zm-6 10c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.988 0 3.89.85 5.217 2.333l-1.49 1.334A5.008 5.008 0 0 0 16 4c-2.757 0-5 2.243-5 5s2.243 5 5 5v2z" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div><!-- end card -->
                                                </div>
                                            @endif
                                         
                                        </div> <!-- end row-->

                                        <div class="row">
                                            <div class="col-xl-12" style="width:100%">
                                                <div class="card">
                                                    <div class="card-header border-0 align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Doanh thu</h4>
                                                    </div><!-- end card header -->
                                                    <div class="card-header p-0 border-0 bg-light-subtle">
                                                        <div class="row g-0 text-center">
                                                            <div class="col-6 col-sm-6">
                                                                <div class="p-3 border border-dashed border-start-0">
                                                                    <h5 class="mb-1"><span class="counter-value"
                                                                            data-target="{{ $statistic['number'] }}">0</span></h5>
                                                                    <p class="text-muted mb-0">Đơn hàng</p>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-6 col-sm-6">
                                                                <div class="p-3 border border-dashed border-start-0">
                                                                    <h5 class="mb-1"><span class="counter-value"
                                                                            data-target="{{  $statistic['total'] }}">0</span>đ</h5>
                                                                    <p class="text-muted mb-0">Thu nhập</p>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            {{-- <div class="col-6 col-sm-3">
                                                                <div class="p-3 border border-dashed border-start-0">
                                                                    <h5 class="mb-1"><span class="counter-value"
                                                                            data-target="367">0</span></h5>
                                                                    <p class="text-muted mb-0">Hoàn tiền</p>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                            <div class="col-6 col-sm-3">
                                                                <div
                                                                    class="p-3 border border-dashed border-start-0 border-end-0">
                                                                    <h5 class="mb-1 text-success"><span
                                                                            class="counter-value"
                                                                            data-target="18.92">0</span>%</h5>
                                                                    <p class="text-muted mb-0">Tăng trưởng</p>
                                                                </div>
                                                            </div> --}}
                                                            <!--end col-->
                                                        </div>
                                                    </div><!-- end card header -->

                                                    <div class="card-body p-0 pb-2">
                                                        <div class="w-100">
                                                            <canvas class="revenueChart demo" id="revenueChart"></canvas>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end col -->


                                        </div>

                                        <div class="row">
                                           

                                            <div class="">
                                                <div class="card card-height-100">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Bán chạy nhất</h4>
                                                        <div class="flex-shrink-0">
                                                            <div class="dropdown card-header-dropdown">
                                                                <a class="text-reset dropdown-btn" href="#"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="text-muted">Báo cáo<i
                                                                            class="mdi mdi-chevron-down ms-1"></i></span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Tải báo cáo</a>
                                                                    <a class="dropdown-item" href="#">Xuất</a>
                                                                    <a class="dropdown-item" href="#">Nhập</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card header -->

                                                    <div class="card-body">
                                                        <div class="table-responsive table-card">
                                                            <table
                                                                class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                                
                                                                <tbody>
                                                                    @foreach($bestseller as $product)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                {{-- <div class="flex-shrink-0 me-2">
                                                                                    <img src="{{asset('assets/images/products/default.png')}}"
                                                                                        alt="" class="avatar-sm p-2" />
                                                                                </div> --}}
                                                                                <div>
                                                                                    <h5 class="fs-14 my-1 fw-medium">
                                                                                        <a href="#"
                                                                                            class="text-reset">{{
                                                                                            $product->product_name
                                                                                            }}</a>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <span class="text-muted">{{
                                                                                number_format($product->price )}}đ</span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="text-muted">{{
                                                                                $product->total_sold_amount }}</span>
                                                                            <span class="text-muted">Đã bán</span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="text-muted">{{
                                                                                number_format($product->total_cost) }}
                                                                                đ</span>
                                                                        </td>
                                                                    </tr><!-- end -->
                                                                    @endforeach
                                                                </tbody>
                                                            </table><!-- end table -->
                                                        </div>

                                                        <div
                                                            class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                                            <div class="col-sm">
                                                                <div class="text-muted">
                                                                    Hiển thị <span class="fw-semibold">
                                                                       
                                                                        {{-- {{ $bestseller->count() }} --}}
                                                                        </span> / <span
                                                                        class="fw-semibold">6</span> kết quả
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-auto  mt-3 mt-sm-0">
                                                                <!-- Pagination if needed -->
                                                            </div>
                                                        </div>
                                                    </div> <!-- .card-body-->
                                                </div> <!-- .card-->
                                            </div> <!-- .col-->

                                        </div> <!-- end row-->

                                        <div class="row">
                                            {{-- <div class="col-xl-4">
                                                <div class="card card-height-100">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source
                                                        </h4>
                                                        <div class="flex-shrink-0">
                                                            <div class="dropdown card-header-dropdown">
                                                                <a class="text-reset dropdown-btn" href="#"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <span class="text-muted">Report<i
                                                                            class="mdi mdi-chevron-down ms-1"></i></span>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#">Download
                                                                        Report</a>
                                                                    <a class="dropdown-item" href="#">Export</a>
                                                                    <a class="dropdown-item" href="#">Import</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card header -->

                                                    <div class="card-body">
                                                        <div id="store-visits-source"
                                                            data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                                                            class="apex-charts" dir="ltr"></div>
                                                    </div>
                                                </div> <!-- .card-->
                                            </div> <!-- .col--> --}}

                                            <div class="">
                                                <div class="card">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                                                        <div class="flex-shrink-0">
                                                            {{-- <button type="button" class="btn btn-soft-info btn-sm">
                                                                <i class="ri-file-list-3-line align-middle"></i> Xem chi
                                                                tiết
                                                            </button> --}}
                                                        </div>
                                                    </div><!-- end card header -->

                                                    <div class="card-body">
                                                        <div class="table-responsive table-card">
                                                            <table
                                                                class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                                <thead class="text-muted table-light">
                                                                    <tr>
                                                                        <th scope="col">Mã đơn hàng</th>
                                                                        <th scope="col">Khách hàng</th>
                                                                        <th scope="col">Tổng tiền</th>
                                                                        <th scope="col">Trạng thái</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($order as $item )
                                                                    <tr>
                                                                        <td>
                                                                            <a href="{{ route('admin.order.list') }}"
                                                                                class="fw-medium link-primary">{{
                                                                                $item->zip_code }}</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="flex-shrink-0 me-2">
                                                                                    <img src="{{asset('assets/images/users/avatar-1.jpg')}}"
                                                                                        alt=""
                                                                                        class="avatar-xs rounded-circle" />
                                                                                </div>
                                                                                <div class="flex-grow-1">{{ $item->name
                                                                                    }}
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <span class="text-success">
                                                                                {{ number_format($item->total_money) }}đ
                                                                            </span>
                                                                        </td>

                                                                        <td>
                                                                            <span
                                                                                class="badge bg-success-subtle text-success">Paid</span>
                                                                        </td>

                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div> <!-- .card-->
                                            </div> <!-- .col-->
                                        </div> <!-- end row-->

                                    </div> <!-- end .h-100-->

                                </div> <!-- end col -->

                                <div class="col-lg-4 layout-rightside-col">
                                    <div class="overlay"></div>
                                    <div class="layout-rightside">
                                        <div class="card h-100 rounded-0">
                                            <div class="card-body p-0">
                                                <div class="p-3">
                                                    <h6 class="text-muted mb-0 text-uppercase fw-semibold">Hoạt động gần
                                                        đây</h6>
                                                </div>
                                                <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                                    <div class="acitivity-timeline acitivity-main">
                                                        <div class="acitivity-item d-flex">
                                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                                <div
                                                                    class="avatar-title bg-success-subtle text-success rounded-circle">
                                                                    <i class="ri-shopping-cart-2-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                                                <p class="text-muted mb-1">Product noise evolve
                                                                    smartwatch </p>
                                                                <small class="mb-0 text-muted">02:14 PM Today</small>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item py-3 d-flex">
                                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                                <div
                                                                    class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                                    <i class="ri-stack-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Added new <span
                                                                        class="fw-semibold">style collection</span></h6>
                                                                <p class="text-muted mb-1">By Nesta Technologies</p>
                                                                <div
                                                                    class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                                    <a href="apps-ecommerce-product-details.html"
                                                                        class="bg-light rounded p-1">
                                                                        <img src="{{asset('assets/images/products/img-8.png')}}"
                                                                            alt="" class="img-fluid d-block" />
                                                                    </a>
                                                                    <a href="apps-ecommerce-product-details.html"
                                                                        class="bg-light rounded p-1">
                                                                        <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                            alt="" class="img-fluid d-block" />
                                                                    </a>
                                                                    <a href="apps-ecommerce-product-details.html"
                                                                        class="bg-light rounded p-1">
                                                                        <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                            alt="" class="img-fluid d-block" />
                                                                    </a>
                                                                </div>
                                                                <p class="mb-0 text-muted"><small>9:47 PM
                                                                        Yesterday</small></p>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item py-3 d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                    alt=""
                                                                    class="avatar-xs rounded-circle acitivity-avatar">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Natasha Carey have liked the
                                                                    products
                                                                </h6>
                                                                <p class="text-muted mb-1">Allow users to like products
                                                                    in your
                                                                    WooCommerce store.</p>
                                                                <small class="mb-0 text-muted">25 Dec, 2021</small>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item py-3 d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar-xs acitivity-avatar">
                                                                    <div
                                                                        class="avatar-title rounded-circle bg-secondary">
                                                                        <i class="mdi mdi-sale fs-14"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Today offers by <a
                                                                        href="apps-ecommerce-seller-details.html"
                                                                        class="link-secondary">Digitech Galaxy</a></h6>
                                                                <p class="text-muted mb-2">Offer is valid on orders of
                                                                    Rs.500 Or
                                                                    above for selected products only.</p>
                                                                <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item py-3 d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar-xs acitivity-avatar">
                                                                    <div
                                                                        class="avatar-title rounded-circle bg-danger-subtle text-danger">
                                                                        <i class="ri-bookmark-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Favorite Product</h6>
                                                                <p class="text-muted mb-2">Esther James have Favorite
                                                                    product.
                                                                </p>
                                                                <small class="mb-0 text-muted">25 Nov, 2021</small>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item py-3 d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar-xs acitivity-avatar">
                                                                    <div
                                                                        class="avatar-title rounded-circle bg-secondary">
                                                                        <i class="mdi mdi-sale fs-14"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Flash sale starting <span
                                                                        class="text-primary">Tomorrow.</span></h6>
                                                                <p class="text-muted mb-0">Flash sale by <a
                                                                        href="javascript:void(0);"
                                                                        class="link-secondary fw-medium">Zoetic
                                                                        Fashion</a></p>
                                                                <small class="mb-0 text-muted">22 Oct, 2021</small>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item py-3 d-flex">
                                                            <div class="flex-shrink-0">
                                                                <div class="avatar-xs acitivity-avatar">
                                                                    <div
                                                                        class="avatar-title rounded-circle bg-info-subtle text-info">
                                                                        <i class="ri-line-chart-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                                                <p class="text-muted mb-2"><span class="text-danger">2
                                                                        days
                                                                        left</span> notification to submit the monthly
                                                                    sales
                                                                    report. <a href="javascript:void(0);"
                                                                        class="link-warning text-decoration-underline">Reports
                                                                        Builder</a></p>
                                                                <small class="mb-0 text-muted">15 Oct</small>
                                                            </div>
                                                        </div>
                                                        <div class="acitivity-item d-flex">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                    alt=""
                                                                    class="avatar-xs rounded-circle acitivity-avatar" />
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                                                <p class="text-muted mb-2 fst-italic">" A product that
                                                                    has
                                                                    reviews is more likable to be sold than a product. "
                                                                </p>
                                                                <small class="mb-0 text-muted">26 Aug, 2021</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($loggedInUser['user']['role_id'] === 1) 
                                                    <div class="p-3 mt-2">
                                                        <h6 class="text-muted mb-3 text-uppercase fw-semibold">10 Danh mục hàng đầu </h6>
                                                        <ol class="ps-3 text-muted">
                                                            @foreach ($category as $item)
                                                            <li class="py-1">
                                                                <a href="#" class="text-muted">{{ $item->name }} <span
                                                                        class="float-end">({{ $item->products_count
                                                                        }})</span></a>
                                                            </li>
                                                            @endforeach

                                                        </ol>
                                                        <div class="mt-3 text-center">
                                                            <a href="{{route('admin.category.index')}}"
                                                                class="text-muted text-decoration-underline">Xem tất cả danh mục</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="p-3">
                                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Đánh giá sản
                                                        phẩm</h6>
                                                    <!-- Swiper -->
                                                    <div class="swiper vertical-swiper" style="height: 250px;">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div class="card border border-dashed shadow-none">
                                                                    <div class="card-body">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0 avatar-sm">
                                                                                <div
                                                                                    class="avatar-title bg-light rounded">
                                                                                    <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                                        alt="" height="30">
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <div>
                                                                                    <p
                                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                        " Sản phẩm tuyệt vời và trông rất đẹp, có nhiều tính năng. "</p>
                                                                                    <div
                                                                                        class="fs-11 align-middle text-warning">
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-end mb-0 text-muted">
                                                                                    - Từ : <cite
                                                                                        title="Source Title">Force
                                                                                        Medicines</cite>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                <div class="card border border-dashed shadow-none">
                                                                    <div class="card-body">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0">
                                                                                <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                                    alt="" class="avatar-sm rounded">
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <div>
                                                                                    <p
                                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                        " Mẫu tuyệt vời, rất dễ hiểu và dễ thao tác. "</p>
                                                                                    <div
                                                                                        class="fs-11 align-middle text-warning">
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i
                                                                                            class="ri-star-half-fill"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-end mb-0 text-muted">
                                                                                    - Từ : <cite
                                                                                        title="Source Title">Henry
                                                                                        Baird</cite>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide" style="display: none">
                                                                <div class="card border border-dashed shadow-none">
                                                                    <div class="card-body">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0 avatar-sm">
                                                                                <div
                                                                                    class="avatar-title bg-light rounded">
                                                                                    <img src="{{asset('assets/images/companies/img-2.png')}}"
                                                                                        alt="" height="30">
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <div>
                                                                                    <p
                                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                        "Very beautiful product and Very
                                                                                        helpful
                                                                                        customer service."</p>
                                                                                    <div
                                                                                        class="fs-11 align-middle text-warning">
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-line"></i>
                                                                                        <i class="ri-star-line"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-end mb-0 text-muted">
                                                                                    - by <cite
                                                                                        title="Source Title">Zoetic
                                                                                        Fashion</cite>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide" style="display: none">
                                                                <div class="card border border-dashed shadow-none">
                                                                    <div class="card-body">
                                                                        <div class="d-flex">
                                                                            <div class="flex-shrink-0">
                                                                                <img src="{{asset('assets/images/products/img-2.png')}}"
                                                                                    alt="" class="avatar-sm rounded">
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-3">
                                                                                <div>
                                                                                    <p
                                                                                        class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                                        " The product is very beautiful.
                                                                                        I like
                                                                                        it. "</p>
                                                                                    <div
                                                                                        class="fs-11 align-middle text-warning">
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i class="ri-star-fill"></i>
                                                                                        <i
                                                                                            class="ri-star-half-fill"></i>
                                                                                        <i class="ri-star-line"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-end mb-0 text-muted">
                                                                                    - by <cite
                                                                                        title="Source Title">Nancy
                                                                                        Martino</cite>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="p-3">
                                                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">PHẢN HỒI KHÁCH HÀNG</h6>
                                                    <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                <div class="fs-16 align-middle text-warning">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-half-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <h6 class="mb-0">4.5 out of 5</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="text-muted">Tổng cộng  <span
                                                                class="fw-medium">5.50k</span>
                                                            đánh giá</div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0">5 sao</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-1">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 50.16%"
                                                                            aria-valuenow="50.16" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0 text-muted">2758</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0">4 sao</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-1">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 29.32%"
                                                                            aria-valuenow="29.32" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0 text-muted">1063</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0">3 sao</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-1">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-warning"
                                                                            role="progressbar" style="width: 18.12%"
                                                                            aria-valuenow="18.12" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0 text-muted">997</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0">2 sao</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-1">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 4.98%"
                                                                            aria-valuenow="4.98" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0 text-muted">227</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0">1 sao</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-1">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 7.42%"
                                                                            aria-valuenow="7.42" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-1">
                                                                    <h6 class="mb-0 text-muted">408</h6>
                                                                </div>
                                                            </div>
                                                        </div><!-- end row -->
                                                    </div>
                                                </div>
                                                
                                                    <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                                        
                                                            <div class="card-body" id="div3">
                                                                <img src="{{asset('assets/images/giftbox.png')}}" alt="">
                                                                <div class="mt-4">
                                                                    <h5>Mời người dùng mới</h5>
                                                                    <p class="text-muted lh-base">Giới thiệu người bán mới cho chúng tôi và kiếm 100 USD cho mỗi lượt giới thiệu.</p>
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-label rounded-pill" id="handleDashboard">
                                                                        Mời ngay</button>
                                                                        <p id="copy_link" hidden> {{config("app.url")}}/login?referralcode={{$loggedInUser['user']['referral_code']}}</p>
                                                                </div>
                                                            </div>
                                                     
                                                    </div>
                                              
                                            </div>
                                        </div> <!-- end card-->
                                    </div> <!-- end .rightbar-->

                                </div> <!-- end col -->
                            </div>

                        </div>
                        <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->

                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> © Velzon.
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-sm-end d-none d-sm-block">
                                        Design & Develop by Themesbrand
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->



            <!--start back-to-top-->
            <!-- <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
                <i class="ri-arrow-up-line"></i>
            </button> -->
            <!--end back-to-top-->

            <!--preloader-->
            <!-- <div id="preloader">
                <div id="status">
                    <div class="spinner-border text-primary avatar-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div> -->

            <!-- <div class="customizer-setting d-none d-md-block">
                <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                    <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
                </div>
            </div> -->

            <!-- Theme Settings -->
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
                <div class="d-flex align-items-center bg-primary bg-gradient p-3 offcanvas-header">
                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn"
                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div data-simplebar class="h-100">
                        <div class="p-4">
                            <h6 class="mb-0 fw-semibold text-uppercase">Layout</h6>
                            <p class="text-muted">Choose your layout</p>

                            <div class="row gy-3">
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input id="customizer-layout01" name="data-layout" type="radio" value="vertical"
                                            class="form-check-input">
                                        <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout01">
                                            <span class="d-flex gap-1 h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                        <span
                                                            class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="fs-13 text-center mt-2">Vertical</h5>
                                </div>
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input id="customizer-layout02" name="data-layout" type="radio"
                                            value="horizontal" class="form-check-input">
                                        <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout02">
                                            <span class="d-flex h-100 flex-column gap-1">
                                                <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                                    <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                                    <span
                                                        class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                                    <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="fs-13 text-center mt-2">Horizontal</h5>
                                </div>
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input id="customizer-layout03" name="data-layout" type="radio"
                                            value="twocolumn" class="form-check-input">
                                        <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout03">
                                            <span class="d-flex gap-1 h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1">
                                                        <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                                        <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="fs-13 text-center mt-2">Two Column</h5>
                                </div>
                                <!-- end col -->

                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input id="customizer-layout04" name="data-layout" type="radio" value="semibox"
                                            class="form-check-input">
                                        <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout04">
                                            <span class="d-flex gap-1 h-100">
                                                <span class="flex-shrink-0 p-1">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                        <span
                                                            class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column pt-1 pe-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="fs-13 text-center mt-2">Semi Box</h5>
                                </div>
                                <!-- end col -->
                            </div>

                            <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Color Scheme</h6>
                            <p class="text-muted">Choose Light or Dark Scheme.</p>

                            <div class="colorscheme-cardradio">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="data-bs-theme"
                                                id="layout-mode-light" value="light">
                                            <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-light">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Light</h5>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-check card-radio dark">
                                            <input class="form-check-input" type="radio" name="data-bs-theme"
                                                id="layout-mode-dark" value="dark">
                                            <label class="form-check-label p-0 avatar-md w-100 bg-dark"
                                                for="layout-mode-dark">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span
                                                            class="bg-white bg-opacity-10 d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-white bg-opacity-10 d-block p-1"></span>
                                                            <span
                                                                class="bg-white bg-opacity-10 d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Dark</h5>
                                    </div>
                                </div>
                            </div>

                            <div id="sidebar-visibility">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Visibility</h6>
                                <p class="text-muted">Choose show or Hidden sidebar.</p>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar-visibility"
                                                id="sidebar-visibility-show" value="show">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-visibility-show">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0 p-1">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column pt-1 pe-2">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Show</h5>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar-visibility"
                                                id="sidebar-visibility-hidden" value="hidden">
                                            <label class="form-check-label p-0 avatar-md w-100 px-2"
                                                for="sidebar-visibility-hidden">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column pt-1 px-2">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Hidden</h5>
                                    </div>
                                </div>
                            </div>

                            <div id="layout-width">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Width</h6>
                                <p class="text-muted">Choose Fluid or Boxed layout.</p>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="data-layout-width"
                                                id="layout-width-fluid" value="fluid">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="layout-width-fluid">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Fluid</h5>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="data-layout-width"
                                                id="layout-width-boxed" value="boxed">
                                            <label class="form-check-label p-0 avatar-md w-100 px-2"
                                                for="layout-width-boxed">
                                                <span class="d-flex gap-1 h-100 border-start border-end">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Boxed</h5>
                                    </div>
                                </div>
                            </div>

                            <div id="layout-position">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Position</h6>
                                <p class="text-muted">Choose Fixed or Scrollable Layout Position.</p>

                                <div class="btn-group radio" role="group">
                                    <input type="radio" class="btn-check" name="data-layout-position"
                                        id="layout-position-fixed" value="fixed">
                                    <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                                    <input type="radio" class="btn-check" name="data-layout-position"
                                        id="layout-position-scrollable" value="scrollable">
                                    <label class="btn btn-light w-sm ms-0"
                                        for="layout-position-scrollable">Scrollable</label>
                                </div>
                            </div>
                            <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Topbar Color</h6>
                            <p class="text-muted">Choose Light or Dark Topbar Color.</p>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input class="form-check-input" type="radio" name="data-topbar"
                                            id="topbar-color-light" value="light">
                                        <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                            <span class="d-flex gap-1 h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                        <span
                                                            class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="fs-13 text-center mt-2">Light</h5>
                                </div>
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input class="form-check-input" type="radio" name="data-topbar"
                                            id="topbar-color-dark" value="dark">
                                        <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                            <span class="d-flex gap-1 h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                        <span
                                                            class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-primary d-block p-1"></span>
                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="fs-13 text-center mt-2">Dark</h5>
                                </div>
                            </div>

                            <div id="sidebar-size">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Size</h6>
                                <p class="text-muted">Choose a size of Sidebar.</p>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar-size"
                                                id="sidebar-size-default" value="lg">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-size-default">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Default</h5>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar-size"
                                                id="sidebar-size-compact" value="md">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-size-compact">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 bg-primary-subtle rounded mb-2"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Compact</h5>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar-size"
                                                id="sidebar-size-small" value="sm">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-size-small">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1">
                                                            <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Small (Icon View)</h5>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar-size"
                                                id="sidebar-size-small-hover" value="sm-hover">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-size-small-hover">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1">
                                                            <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Small Hover View</h5>
                                    </div>
                                </div>
                            </div>

                            <div id="sidebar-view">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar View</h6>
                                <p class="text-muted">Choose Default or Detached Sidebar view.</p>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-layout-style"
                                                id="sidebar-view-default" value="default">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-view-default">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Default</h5>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-layout-style"
                                                id="sidebar-view-detached" value="detached">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-view-detached">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-flex p-1 gap-1 align-items-center px-2">
                                                        <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                                        <span
                                                            class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                                    </span>
                                                    <span class="d-flex gap-1 h-100 p-1 px-2">
                                                        <span class="flex-shrink-0">
                                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                                <span
                                                                    class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                <span
                                                                    class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                <span
                                                                    class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Detached</h5>
                                    </div>
                                </div>
                            </div>
                            <div id="sidebar-color">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Color</h6>
                                <p class="text-muted">Choose a color of Sidebar.</p>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse"
                                            data-bs-target="#collapseBgGradient.show">
                                            <input class="form-check-input" type="radio" name="data-sidebar"
                                                id="sidebar-color-light" value="light">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-color-light">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span
                                                            class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Light</h5>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse"
                                            data-bs-target="#collapseBgGradient.show">
                                            <input class="form-check-input" type="radio" name="data-sidebar"
                                                id="sidebar-color-dark" value="dark">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="sidebar-color-dark">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-primary d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Dark</h5>
                                    </div>
                                    <div class="col-4">
                                        <button
                                            class="btn btn-link avatar-md w-100 p-0 overflow-hidden border collapsed"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient"
                                            aria-expanded="false" aria-controls="collapseBgGradient">
                                            <span class="d-flex gap-1 h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1">
                                                        <span
                                                            class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                        <span
                                                            class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                        <span
                                                            class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                        <span
                                                            class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </button>
                                        <h5 class="fs-13 text-center mt-2">Gradient</h5>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="collapse" id="collapseBgGradient">
                                    <div class="d-flex gap-2 flex-wrap img-switch p-2 px-3 bg-light rounded">

                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar"
                                                id="sidebar-color-gradient" value="gradient">
                                            <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                for="sidebar-color-gradient">
                                                <span class="avatar-title rounded-circle bg-vertical-gradient"></span>
                                            </label>
                                        </div>
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar"
                                                id="sidebar-color-gradient-2" value="gradient-2">
                                            <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                for="sidebar-color-gradient-2">
                                                <span class="avatar-title rounded-circle bg-vertical-gradient-2"></span>
                                            </label>
                                        </div>
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar"
                                                id="sidebar-color-gradient-3" value="gradient-3">
                                            <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                for="sidebar-color-gradient-3">
                                                <span class="avatar-title rounded-circle bg-vertical-gradient-3"></span>
                                            </label>
                                        </div>
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-sidebar"
                                                id="sidebar-color-gradient-4" value="gradient-4">
                                            <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                for="sidebar-color-gradient-4">
                                                <span class="avatar-title rounded-circle bg-vertical-gradient-4"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="sidebar-img">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Images</h6>
                                <p class="text-muted">Choose a image of Sidebar.</p>

                                <div class="d-flex gap-2 flex-wrap img-switch">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidebar-image"
                                            id="sidebarimg-none" value="none">
                                        <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-none">
                                            <span
                                                class="avatar-md w-auto bg-light d-flex align-items-center justify-content-center">
                                                <i class="ri-close-fill fs-20"></i>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidebar-image"
                                            id="sidebarimg-01" value="img-1">
                                        <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-01">
                                            <img src="{{asset('assets/images/products/img-2.png')}}" alt=""
                                                class="avatar-md w-auto object-fit-cover">
                                        </label>
                                    </div>

                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidebar-image"
                                            id="sidebarimg-02" value="img-2">
                                        <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-02">
                                            <img src="{{asset('assets/images/products/img-2.png')}}" alt=""
                                                class="avatar-md w-auto object-fit-cover">
                                        </label>
                                    </div>
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidebar-image"
                                            id="sidebarimg-03" value="img-3">
                                        <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-03">
                                            <img src="{{asset('assets/images/products/img-2.png')}}" alt=""
                                                class="avatar-md w-auto object-fit-cover">
                                        </label>
                                    </div>
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidebar-image"
                                            id="sidebarimg-04" value="img-4">
                                        <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-04">
                                            <img src="{{asset('assets/images/products/img-2.png')}}" alt=""
                                                class="avatar-md w-auto object-fit-cover">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="preloader-menu">
                                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Preloader</h6>
                                <p class="text-muted">Choose a preloader.</p>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-preloader"
                                                id="preloader-view-custom" value="enable">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="preloader-view-custom">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                                <!-- <div id="preloader"> -->
                                                <div id="status"
                                                    class="d-flex align-items-center justify-content-center">
                                                    <div class="spinner-border text-primary avatar-xxs m-auto"
                                                        role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Enable</h5>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check sidebar-setting card-radio">
                                            <input class="form-check-input" type="radio" name="data-preloader"
                                                id="preloader-view-none" value="disable">
                                            <label class="form-check-label p-0 avatar-md w-100"
                                                for="preloader-view-none">
                                                <span class="d-flex gap-1 h-100">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                            <span
                                                                class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                            <span
                                                                class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                        </span>
                                                    </span>
                                                    <span class="flex-grow-1">
                                                        <span class="d-flex h-100 flex-column">
                                                            <span class="bg-light d-block p-1"></span>
                                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <h5 class="fs-13 text-center mt-2">Disable</h5>
                                    </div>
                                </div>

                            </div>
                            <!-- end preloader-menu -->

                        </div>
                    </div>

                </div>
                <div class="offcanvas-footer border-top p-3 text-center">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                        </div>
                        <div class="col-6">
                            <a href="https://1.envato.market/velzon-admin" target="_blank"
                                class="btn btn-primary w-100">Buy
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    var div1Element = document.getElementById('div1');
    var div2Element = document.getElementById('div2');
    var div3Element = document.getElementById('div3');
    var role =  {{$loggedInUser['user']['role_id']}};
 
  if (role === 1) {
    div1Element.className = 'col-xl-3 col-md-6';
    div2Element.className = 'col-xl-3 col-md-6';
    div3Element.style.display = 'block';
  } else if (role === 4) {
    div1Element.className = 'col-xl-6 col-md-6';
    div2Element.className = 'col-xl-6 col-md-6';
    div3Element.style.display = 'none';
  }
    //
    document.getElementById('handleDashboard').addEventListener('click', function() {
    var copyText = document.getElementById('copy_link').innerText;

 
    var textarea = document.createElement('textarea');
    textarea.value = copyText;
    document.body.appendChild(textarea);

   
    textarea.select();
    textarea.setSelectionRange(0, 99999); // For mobile devices


    document.execCommand('copy');

   
    document.body.removeChild(textarea);

   
});

    
    var revenueData = {!! json_encode($getMonthlyRevenue) !!};
    var revenueCtx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                    label: 'Revenue',
                    data: revenueData,
                    backgroundColor: '#007bff',
                    skipNull: false  // Cho phép hiển thị các giá trị bằng 0
                }]
        },
        options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
    });


        // Pie Chart for Sales by Locations


        $(document).ready(function() {
    // Function to animate the counter
    function animateCounter(element) {
        var target = parseInt(element.attr('data-target'));
        var count = 0;
        var step = Math.ceil(target / 100); // Adjust the step for smooth animation

        var counter = setInterval(function() {
            count += step;
            if (count >= target) {
                count = target;
                clearInterval(counter);
            }
            element.text(count.toLocaleString()); // Update the element text with comma-separated format
        }, 10); // Adjust the interval as needed for smoother animation
    }

    // Trigger the animation on page load
    $('.counter-value').each(function() {
        animateCounter($(this));
    });
});

    </script>
    <style scoped>
        .revenueChart{
            width: 700px !important;
            height: 350px !important;
        }
        .ml-dasboard{
            margin-left: 10px;
        }
    </style>
@endsection
