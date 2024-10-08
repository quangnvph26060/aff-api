@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Thông tin cửa hàng </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <form action="{{ route('admin.updateconfig') }}" method="POST" id="submitform" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên công ty</label>
                                                <input value="{{ $data->name ?? ""}}" required class="form-control" name="name" type="text" id="name">
                                            </div>
                                          
                                            
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Số điện thoại công ty</label>
                                                <input value="{{ $data->phone ?? ""}}" required class="form-control" name="phone" type="text" id="phone">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input value="{{ $data->email ?? ""}}" required class="form-control" name="email" type="text" id="email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="policy" class="form-label">Chính sách</label>
                                                <textarea required class="form-control" name="policy" id="policy" rows="4">{{ $data->policy ?? ""}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Logo công ty</label>
                                            <input id="logo" class="form-control" type="file" name="logo" accept="image/*">
                                            <img src="{{asset($data['logo'])}}" alt="" width="30%">
                                        </div>
                                        <div class="mb-3">
                                            <label for="banner" class="form-label">Banner đăng nhập</label>
                                            <input id="banner" class="form-control" type="file" name="login_banner" accept="image/*">
                                            <img src="{{asset($data['login_banner'])}}" alt="" width="30%">
                                        </div>
                                       
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <button type="button" onclick="submitForm()" class="btn btn-primary w-md">
                                                Xác nhận
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    function submitForm() {
        document.getElementById('submitform').submit();
    }
    CKEDITOR.replace('policy');
</script>
@endsection
