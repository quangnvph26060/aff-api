@extends('layouts.app')
@section('content')
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Danh sách đơn hàng</h4>
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
                                        <label for="">Từ khóa</label>
                                        <input value="" autocomplete="off" name="keyword" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Chọn dự án</label>
                                        <select name="project_id" class="form-control" id=""> </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Từ ngày</label>
                                    <input value="" type="date" name="date_from" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Đến ngày</label>
                                    <input value="" type="date" name="date_to" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="-1">Tất cả</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="" style="opacity: 0">1</label> <br>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fas fa-search"></i> Tìm kiếm</button>
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
                                        <th>Nhân viên</th>
                                        <th>Dự án</th>
                                        <th>Ngày giao</th>
                                        <th>Deadline</th>
                                        <th>Time hoàn thành</th>
                                        <th>Từ khóa giao</th>
                                        <th>URL viết bài</th>
                                        <th>URL publish</th>
                                        <th>Trạng thái</th>
                                        <th style="text-align: center">Hành động</th>
                                    </tr>
                                </thead>

                                <td align="center">
                                    <a class="btn btn-warning"
                                        href="https://quanlycongviec.site/admin/mission/2808/edit?url_pre=aHR0cHM6Ly9xdWFubHljb25ndmllYy5zaXRlL2FkbWluL21pc3Npb24vbGlzdD8%3D">Sửa</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                        class="btn btn-danger"
                                        href="https://quanlycongviec.site/admin/mission/2808/delete">Xóa</a>

                                    <button onclick="openModel(2808, 'Top 3 Hút mùi Faster')"
                                        class="btn btn-primary waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        type="button">
                                        Trao đổi
                                    </button>
                                </td>
                                </tr>
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