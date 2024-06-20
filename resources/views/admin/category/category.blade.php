@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Danh sách danh mục</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row ">
                            <form class="col-lg-5"  method="GET" action="{{ route('admin.category.search') }}"  id="categorySearchForm">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="">Tên danh mục</label>
                                            <input autocomplete="off" name="name" id="category" type="text" class="form-control " placeholder="Nhập tìm kiếm">
                                            <div id="category_error" class="invalid-feedback d-block"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="" style="opacity: 0">1</label> <br>
                                            <button type="button"  class="btn btn-primary" onclick="submitForm(event)">
                                                <i class="fas fa-search"></i> Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-lg-5"> </div>
                            <div class="col-lg-2 mt-5">
                            <a href="{{route('admin.category.add')}}" class="btn btn-primary">Thêm danh mục</a>
                            </div>
                           
                        </div>

                    </div>
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
                                            <th>Tên danh mục</th>
                                            <th>Mô tả</th>
                                            <!-- <th>Tổng sản phẩm</th> -->
                                            <th style="text-align: center">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr>
                                            <td> {{ $index + 1 }}</td>
                                            <td>{{$item->name}}</td>
                                            <td class="text-black">{{$item->description}}</td>
                                            <!-- <td>{{$item->products_count}}</td> -->
                                            <td align="center">
                                                <a class="btn btn-warning" href="{{ route('admin.category.edit', ['id' => $item->id]) }}">Sửa</a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')"  class="btn btn-danger"
                                                    href="{{ route('admin.category.delete', ['id' => $item->id]) }}">Xóa</a>
                                               
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
<script>
        var formEconomyEdit = {
        'category': {
            'element': document.getElementById('category'),
            'error': document.getElementById('category_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E003')
                },
            ]
        },
    }
    function submitForm(event) {
        
         event.preventDefault();
        if (validateAllFields(formEconomyEdit)){
            document.getElementById('categorySearchForm').submit();
        }
    }
</script>
@endsection
