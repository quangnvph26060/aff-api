@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Thêm thương hiệu</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-body p-4">
                            <form action="{{ route('admin.brand.add') }}" method="POST" id="submitfrom"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Thương hiệu<span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="name" type="text"
                                                    id="name">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="name_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Logo  <span
                                                        class="text text-danger">*</span></label>

                                                <input id="images" class="form-control" type="file" name="images"
                                                     required>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="images_error"></span> </div>

                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Email <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="email" type="email"
                                                    id="email">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="email_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Địa chỉ <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="address"
                                                    type="text" id="address">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="address_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Số điện thoại <span
                                                        class="text text-danger">*</span></label>
                                                <input value="" required class="form-control" name="phone"
                                                    type="text" id="phone" >
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="phone_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <button type="button" onclick="submitaddBrand(event)" class="btn btn-primary w-md">
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
                        'message': generateErrorMessage('E027')
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
                        'message': generateErrorMessage('E028')
                    },
                ]
            },
            'email': {
                'element': document.getElementById('email'),
                'error': document.getElementById('email_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E029')
                    },
                ]
            },
            'address': {
                'element': document.getElementById('address'),
                'error': document.getElementById('address_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E031')
                    },
                ]
            },
            'phone': {
                'element': document.getElementById('phone'),
                'error': document.getElementById('phone_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E030')
                    },
                ]
            },


        }
        function submitaddBrand(event){
            event.preventDefault();
                if (validateAllFields(validateaddproduct)){
                    document.getElementById('submitfrom').submit();
                }
        }
    </script>
     <style scoped>
        .trang-thai{
            display: block !important;
        }
    </style>
    @endsection
