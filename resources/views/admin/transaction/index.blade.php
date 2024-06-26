@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Danh sách yêu cầu rút tiền</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="col-lg-4">
                                <form action="" method="post">
                                    <div class="form-group d-flex col-7">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Nhập tìm kiếm">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div> --}}
                    <div class="card-body">
                        <div class="table-rep-plugin">
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Kỳ đối soát</th>
                                            <th>Tên khách hàng</th>
                                            <th>Ví</th>
                                            <th>Số dư trong kỳ</th>
                                            <th>Thuế thu nhập</th>
                                            <th>Số dư thực nhận</th>
                                            <th>Trạng thái </th>
                                            <th style="text-align: center">Hành động</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr>
                                            <td> {{ $index + 1 }}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->user->name}}</td>
                                            <td>{{$item->wallet_id == 1 ? "Ví chính" : "Ví thưởng"}}</td>
                                            <td>{{{number_format($item->amount) }}}</td>
                                            <td>{{number_format($item->amount * 0.1)}}</td>
                                            <td>{{number_format(($item->amount - ($item->amount * 0.1)))}}</td>
                                            <td>{{$item->status == 'pending' ? 'Chưa được xử lý' : 'Đã hoàn thành'}}
                                            </td>
                                            <td align="center">
                                                <p class="btn btn-primary openModalBtn" data-id='{{ $item->id }}'
                                                    data-modal-id="modal{{ $item->id }}">Thực hiện</p>
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
        @foreach ($data as $item)
        <!-- The Modal -->

        <div id="modal{{ $item->id }}" class="modal">
            <div class="modal-content">
                {{-- <span class="close" data-modal-id="modal{{ $item->user->id }}">&times;</span> --}}
                <form action="{{ route('admin.xulytransaction', ['id' => $item->id ]) }}" method="post">
                    @csrf
                    <div class="modal-header" style="display: block">
                        <h5 style="color: white; text-align: center;" class="modal-title" id="infoModalLabel">Thông Tin
                            Chi Tiết</h5>
                    </div>
                    <div class="modal-body">
                        <div class="info-item">
                            <span class="label"><strong>Tên:</strong></span>
                            <span class="value">{{ $item->user->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label"><strong>Địa chỉ:</strong></span>
                            <span class="value">{{ $item->user->address }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label"><strong>Số điện thoại:</strong></span>
                            <span class="value">{{ $item->user->phone }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label"><strong>Ngân hàng:</strong></span>
                            <span class="value">{{ count($item->user->user_info) > 0 ? $item->user->user_info[0]->bank : "" }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label"><strong>Số tài khoản:</strong></span>
                            <span class="value">{{ count($item->user->user_info) > 0 ? $item->user->user_info[0]->idnumber : "" }} </span>
                        </div>
                        <hr>
                        <div class="text-center">

                            <img style="width:250px ; height: auto;" src="{{  count($item->user->user_info) > 0 ? $item->user->user_info[0]->branch : "" }}"
                                alt="QR Code" class="img-fluid">
                        </div>
                    </div>

                    <button class="btn btn-success confirmBtn" data-modal-id="modal{{ $item->user->id }}">Xác
                        nhận</button>
                </form>
            </div>
        </div>
        @endforeach
    </div> <!-- container-fluid -->
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khi bấm nút Thực hiện, hiển thị modal tương ứng
        var openModalBtns = document.querySelectorAll('.openModalBtn');
        openModalBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var modalId = this.getAttribute('data-modal-id');
                document.getElementById(modalId).style.display = 'block';
            });
        });

        // Khi bấm vào <span> (x), đóng modal tương ứng
        var closeBtns = document.querySelectorAll('.close');
        closeBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var modalId = this.getAttribute('data-modal-id');
                document.getElementById(modalId).style.display = 'none';
            });
        });

        // Khi bấm vào nút Xác nhận, đóng modal tương ứng
        var confirmBtns = document.querySelectorAll('.confirmBtn');
        confirmBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var modalId = this.getAttribute('data-modal-id');
                document.getElementById(modalId).style.display = 'none';
            });
        });

        // Khi bấm ra ngoài modal, đóng modal
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
    });
</script>
<style scoped>
    /* Modal CSS */
    .modal {
        display: none;
        /* Ẩn modal theo mặc định */
        position: fixed;
        /* Giữ modal ở giữa màn hình */
        z-index: 1;
        /* Đảm bảo modal nằm trên tất cả các nội dung khác */
        left: 0;
        top: 0;
        width: 100%;
        /* Chiều rộng đầy đủ */
        height: 100%;
        /* Chiều cao đầy đủ */
        overflow: auto;
        /* Kích hoạt cuộn khi cần thiết */
        background-color: rgb(0, 0, 0);
        /* Black background with opacity */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% từ trên và căn giữa */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Chiều rộng của modal */
        max-width: 500px;
        /* Chiều rộng tối đa của modal */
        text-align: center;
        /* Căn giữa nội dung bên trong modal */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-body .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .modal-body .label {
        flex: 1;
        font-weight: bold;
    }

    .modal-body .value {
        flex: 2;
    }

    .modal-body .colon {
        width: 10px;
        text-align: center;
    }

    .modal-body img {
        margin-top: 20px;
    }

    .modal-content {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background-color: #414598;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .btn-success {
        background-color: #414598;
        border-color: #414598;
    }

    .btn-success:hover {
        background-color: #414598;
        border-color: #414598;
    }
</style>
@endsection
