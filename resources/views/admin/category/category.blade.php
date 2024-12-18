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
                            <div class="row">
                                <form class="col-lg-5" method="GET" action="{{ route('admin.category.search') }}"
                                    id="categorySearchForm">
                                    @csrf
                                    <div class="row category-main-mobi">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="">Tên danh mục</label>
                                                <input autocomplete="off" name="name" id="category" type="text"
                                                    class="form-control " placeholder="Nhập tìm kiếm">
                                                <div id="category_error" class="invalid-feedback d-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group main-btn-category">
                                                <label for="" style="opacity: 0">1</label> <br>
                                                <button type="button" class="btn btn-primary" onclick="submitForm(event)">
                                                    <i class="fas fa-search"></i> Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                               
                                    <div class="col-lg-5"> </div>
                                    <div class="col-lg-2 mt-29">
                                        <a href="{{ route('admin.category.add') }}" class="btn btn-primary">Thêm danh
                                            mục</a>
                                    </div>
                              


                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-rep-plugin">
                                <div id="flash-message" style="display:none;" class="alert alert-success"></div>
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
                                            @foreach ($data as $index => $item)
                                                <tr id="category-{{ $item->id }}">
                                                    <td> {{ $index + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="text-black">{{ $item->description }}</td>
                                                    <!-- <td>{{ $item->products_count }}</td> -->
                                                    <td align="center">
                                                        <a class="btn btn-warning"
                                                            href="{{ route('admin.category.edit', ['id' => $item->id]) }}">Sửa</a>
                                                        <a class="btn btn-danger"
                                                            onclick="deleteCategory({{ $item->id }})">Xóa</a>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <nav>
                                     
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
                'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E003')
                }, ]
            },
        }

        function submitForm(event) {

            event.preventDefault();
            if (validateAllFields(formEconomyEdit)) {
                document.getElementById('categorySearchForm').submit();
            }
        }


        function deleteCategory(categoryId) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                $.ajax({
                    url: '{{ route('admin.category.delete', '') }}/' + categoryId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#flash-message').text(response.success).show().delay(3000).fadeOut();
                            // Xóa phần tử đã xóa khỏi DOM
                            $('#category-' + categoryId).remove();
                        } else {
                            alert('Có lỗi xảy ra: ' + response.error);
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra: ' + xhr.responseJSON.error);
                    }
                });
            }
        }
    </script>
@endsection
<style scoped>
    .mt-29{
        margin-top: 29px !important;
    }
    @media(max-width:768px){
        .category-main-mobi{
            padding: 10px;
        }
        .main-btn-category{
            line-height: 2px;
        }
        .mt-29{
            margin-left: 10px;
            margin-top: 0px !important;
        }
    }
</style>