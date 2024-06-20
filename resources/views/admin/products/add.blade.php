@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Thêm Sản Phẩm</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-body p-4">
                            <form action="{{ route('admin.product.add.submit') }}" method="POST" id="submitfrom"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="name" type="text"
                                                    id="name">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="name_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Ảnh sản phẩm <span
                                                        class="text text-danger">*</span></label>

                                                <input id="images" class="form-control" type="file" name="images[]"
                                                    multiple accept="image/*" required>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="images_error"></span> </div>

                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Giá sản phẩm <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="price" type="number"
                                                    id="price">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="price_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Số lượng <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="quantity"
                                                    type="number" id="quantity">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="quantity_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Hoa Hồng <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="commission_rate"
                                                    type="number" id="commission_rate" max="100">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="commission_rate_error"></span>
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Loại Danh Mục<span
                                                        class="text text-danger">*</span></label>
                                                <select class="form-control" name="category_id" id="category_id"
                                                    required>
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($category as $item )
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="category_id_error"></span> </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Mô tả <span
                                                        class="text text-danger">*</span></label>
                                                <textarea class="form-control" id="description" name="description"
                                                    rows="2"></textarea>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="description_error"></span> </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Trạng thái<span
                                                        class="text text-danger">*</span></label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Chọn trạng thái</option>
                                                    <option value="published">Được phát hành</option>
                                                    <option value="inactive">Không hoạt động</option>
                                                    <option value="scheduled">Lên kế hoạch</option>
                                                </select>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="status_error"></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <button type="button" onclick="submitaddProduct(event)" class="btn btn-primary w-md">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>


    <script>
        var validateaddproduct = {
            'name': {
                'element': document.getElementById('name'),
                'error': document.getElementById('name_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0010')
                    },
                ]
            },
            'images': {
                'element': document.getElementById('images'),
                'error': document.getElementById('images_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0011')
                    },
                ]
            },
            'price': {
                'element': document.getElementById('price'),
                'error': document.getElementById('price_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0012')
                    },
                ]
            },
            'quantity': {
                'element': document.getElementById('quantity'),
                'error': document.getElementById('quantity_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0013')
                    },
                ]
            },
            'commission_rate': {
                'element': document.getElementById('commission_rate'),
                'error': document.getElementById('commission_rate_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0014')
                    },
                ]
            },
            'category_id': {
                'element': document.getElementById('category_id'),
                'error': document.getElementById('category_id_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0015')
                    },
                ]
            },
            'description': {
                'element': document.getElementById('description'),
                'error': document.getElementById('description_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0016')
                    },
                ]
            },
            'status': {
                'element': document.getElementById('status'),
                'error': document.getElementById('status_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0017')
                    },
                ]
            },
        }
        function submitaddProduct(event){
            event.preventDefault();
                if (validateAllFields(validateaddproduct)){
                    document.getElementById('submitfrom').submit();
                }
        }
    </script>
    @endsection
