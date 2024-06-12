@extends('layouts.app')
@section('content')
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
                        <div class="card-header">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Tên sản phẩm</label>
                                            <input value="" autocomplete="off" name="keyword" type="text"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="exampleSelect" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="exampleSelect">
                                                <option>--- Loại sản phẩm ---</option>
                                                @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="" style="opacity: 0">1</label> <br>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm
                                            kiếm</button>
                                        <a href="https://quanlycongviec.site/admin/mission/list"
                                            class="btn btn-danger"><i class="fas fa-history"></i> Tải lại</a>

                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
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
                                            <th style="text-align: center">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>

                                                @if (isset($value->images[0]))
                                                <img style="width: 100px; height: 75px;"
                                                    src="{{asset($value->images[0]->image_path )}}" alt="">
                                                @endif

                                            </td>
                                            <td>{{ $value->quantity }}</td>
                                            <td>{{ $value->price }}</td>
                                            <td>{{ $value->commission_rate }}%</td>
                                            <td>{{ $value->category->name }}</td>
                                            <td align="center">
                                                <a class="btn btn-warning" href="{{ route('admin.product.edit', ['id'=> $value->id]) }}">Sửa</a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                    class="btn btn-danger"
                                                    href="https://quanlycongviec.site/admin/mission/2808/delete">Xóa</a>


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
