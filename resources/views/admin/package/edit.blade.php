@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Sửa  gói tháng</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-body p-4">
                            <form action="{{ route('admin.package.update',['id'=>$package->id]) }}" method="POST" id="submitfrom"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div>

                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên gói <span
                                                        class="text text-danger">*</span></label>
                                                <input value="{{ old('name', $package->name) }}" required class="form-control" name="name" type="text" id="name">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="name_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Hình ảnh  <span
                                                        class="text text-danger">*</span></label>

                                                <input id="images" class="form-control" type="file" name="images"
                                                     required>
                                                <input id="images" class="form-control" type="hidden" name="images"
                                                       required value="{{ old('image',$package->image)  }}">
                                                <img src="{{asset(old('image',$package->image))}}" width="30%" class="mt-2">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="images_error"></span> </div>

                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Giá gói tháng <span
                                                        class="text text-danger">*</span></label>
                                                <input value="{{ old('name', $package->price) }}" required class="form-control" name="price" type="number"
                                                    id="price">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="price_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Phần trăm giảm giá <span
                                                        class="text text-danger">*</span></label>
                                                <input value="{{ old('name', $package->reduced_price) }}" required class="form-control" name="reduced_price" type="reduced_price"
                                                    id="reduced_price">
                                                <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                        style="font-weight: 500" id="reduced_price_error"></span> </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Trạng thái <span class="text text-danger">*</span></label>
                                                <select required class="form-control  trang-thai" name="status" id="status" >
                                                    <option value="">-- Chọn trạng thái --</option>
                                                    <option value="1" {{ $package->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                                                    <option value="0" {{ $package->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
                                                </select>
                                                <div class="col-lg-9">
                                                    <span class="invalid-feedback d-block" style="font-weight: 500" id="status_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-url-input" class="form-label">Mô tả <span
                                                    class="text text-danger">*</span></label>
                                            <textarea class="form-control" id="description" name="description" rows="2">{{$package->note}}</textarea>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block"
                                                    style="font-weight: 500" id="description_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <button type="button" onclick="submitaddPackage(event)" class="btn btn-primary w-md">
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
                        'message': generateErrorMessage('E0018')
                    },
                ]
            },

            // 'images': {
            //     'element': document.getElementById('images'),
            //     'error': document.getElementById('images_error'),
            //     'validations': [
            //         {
            //             'func': function(value){
            //                 return checkRequired(value);
            //             },
            //             'message': generateErrorMessage('E0018')
            //         },
            //     ]
            // },
            'email': {
                'element': document.getElementById('price'),
                'error': document.getElementById('price_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0018')
                    },
                ]
            },
            'email': {
                'element': document.getElementById('reduced_price'),
                'error': document.getElementById('reduced_price_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0018')
                    },
                ]
            },
            'address': {
                'element': document.getElementById('status'),
                'error': document.getElementById('status_error'),
                'validations': [
                    {
                        'func': function(value){
                            return checkRequired(value);
                        },
                        'message': generateErrorMessage('E0018')
                    },
                ]
            },



        }
        function submitaddPackage(event){
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
