@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin tài khoản</h6>
                            <p>Hạng thành viên: <strong>Admin</strong></p>
                            <p class="text-success">Tài khoản đã được xác thực</p>
                            <p>Mã khách hàng: <strong>{{$admin->referrer_id ?? ""}}</strong></p>
                            <button class="btn btn-outline-primary btn-sm">Giới thiệu bạn bè</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach($admin->wallet as $item)
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">{{$item->wallet_id == 1 ? "Ví chính" :"Ví thưởng"}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control bg-white" disabled value="{{  number_format($item->total_revenue)}}đ">
                                    </div>
                                </div>
                            @endforeach

{{--                            <div class="form-group row">--}}
{{--                                <label class="col-sm-4 col-form-label">Ví thưởng </label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <input type="text" class="form-control bg-white" disabled value="{{ $admin->wallet == '[]' ? 0 : number_format($admin->wallet[1]['total_revenue'])}}đ">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Ví tri ân 2</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="0đ">
                                </div>
                            </div> -->
                            <!-- <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Chỉ số năng động</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="500.000đ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Số thứ tự</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="401">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Điểm thưởng</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="0đ">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <label for="avatarInput">
                                <img src="{{ asset('/users/avatar-1.jpg') }}" alt="User Avatar" class="rounded-circle mb-3" width="150" height="150" style="cursor: pointer;" >
                            </label>
                            <form action="{{ route('file.upload') }}" method="post" id="btn-upload" enctype="multipart/form-data">
                                @csrf
                                <input id="avatarInput" type="file" name="file" style="display: none; cursor: pointer;" onchange="changeImage(event)">
                            </form>

{{--                            <img src="{{ asset('/users/avatar-1.jpg') }}" alt="User Avatar" class="rounded-circle mb-3" width="150" height="150">--}}
                            <h4>{{$admin->name}}</h4>
                            <p>{{$admin->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="user-info-form" action="{{route('admin.profile.update')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Họ và tên</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{$admin->name}}">
                                    </div>
                                </div>


                                <div class="form-group row mt-2 mb-2">
                                    <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <select class="form-control" name="city_id" id="city">
                                                    <option value="">Chọn thành phố</option>
                                                    @foreach($city as $item)
                                                    <option value="{{$item->id}}" {{$item->id == $admin->city_id ? 'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="district_id" id="district">
                                                    <option value="">Chọn quận/huyện</option>
                                                    @foreach($districts as $item)
                                                    <option value="{{$item->id}}" {{$item->id == $admin->district_id ? 'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="wards_id" id="ward">
                                                    <option value="">Chọn xã/phường/thị trấn</option>
                                                    @foreach($wards as $item)
                                                    <option value="{{$item->id}}" {{$item->id == $admin->wards_id ? 'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control mb-2" placeholder="Nhập địa chỉ" id="address" name="address" value="{{$admin->address}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$admin->phone}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="{{$admin->email}}">
                                    </div>
                                </div>
                                <button type="submit" id="update-info-btn" class="btn btn-outline-primary">Cập nhật thông tin</button>
                                <button type="button" id="openKycModalBtn" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">Định danh cá nhân</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-success">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Thông tin đăng nhập</h6>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Tên đăng nhập</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control bg-white" id="username" value="{{$admin->email}}" disabled>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                                <div class="col-sm-10 mb-2">
                                    <input type="password" class="form-control bg-white" id="password1" value="*********"
                                        disabled>
                                </div>
                            </div>
                            <button type="button" id="changePasswordBtn" class="btn btn-outline-primary btn-sm">Đổi mật
                                khẩu</button>

                            <!-- Thêm input mật khẩu mới và xác nhận mật khẩu -->

                            <form action="{{ route('admin.ChangePassword') }}" method="post" class="changePasswordFields" id="changePasswordFields" style="display: none;">
                                @csrf
                                <div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu hiện
                                            tại</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" class="form-control  is-invalid " id="password" name="password" placeholder="Mật khẩu hiện tại">
                                        </div>
                                        <div class="row">
                                           <div class="col-lg-2"></div> <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="password_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" name="newPassword" class="form-control  is-invalid"   id="newPassword">
                                        </div>
                                        <div class="row">
                                           <div class="col-lg-2"></div> <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="newPassword_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-sm-2 col-form-label">Xác nhận mật
                                            khẩu</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" class="form-control  is-invalid " name="confirmPassword" id="confirmPassword">
                                        </div>
                                        <div class="row">
                                           <div class="col-lg-2"></div> <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="confirmPassword_error"></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <button  type="button" class="btn btn-outline-primary btn-sm" onclick="submitForm(event)">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="kycModal" tabindex="-1" role="dialog" aria-labelledby="kycModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="form-group">
                <label for="cccdFrontImage">Ảnh CCCD mặt trước</label>
                <input type="file" class="form-control-file" id="cccdFrontImage">
            </div>
            <div class="form-group">
                <label for="cccdBackImage">Ảnh CCCD mặt sau</label>
                <input type="file" class="form-control-file" id="cccdBackImage">
            </div>
            <div class="form-group">
                <label for="fullName">Họ và tên</label>
                <input type="text" class="form-control" id="fullName" value="Nguyễn Thị Kiều Tiên">
            </div>
            <div class="form-group">
                <label for="cccdNumber">Số CCCD</label>
                <input type="text" class="form-control" id="cccdNumber" value="093179006863">
            </div>
            <div class="form-group">
                <label for="bank">Chọn ngân hàng</label>
                <select class="form-control" id="bank">
                    <option value="MB">Ngân hàng Quân Đội (MB Bank, MB)</option>
                    <!--Thêm các ngân hàng khác nếu cần-->
                </select>
            </div>
            <div class="form-group">
                <label for="accountNumber">Số tài khoản</label>
                <input type="text" class="form-control" id="accountNumber" value="9704229207176818767">
            </div>
            <div class="form-group">
                <label for="accountHolderName">Tên chủ tài khoản</label>
                <input type="text" class="form-control" id="accountHolderName" value="Nguyễn Thị Kiều Tiên">
            </div>
            <div class="form-group">
                <label for="bankBranch">Chi nhánh ngân hàng</label>
                <input type="text" class="form-control" id="bankBranch" value="Châu Thành a">
            </div>
            <div class="form-group">
                <label for="bankProvince">Chọn tỉnh của ngân hàng</label>
                <select class="form-control" id="bankProvince">
                    <option value="Hậu Giang">Hậu Giang</option>
                    <!--Thêm các tỉnh khác nếu cần-->
                </select>
            </div>
        </div>
    </div>
</div>

<script>

    // định dang
    const kyc = document.getElementById('kyc-btn');
    if (kyc) {
        kyc.addEventListener('click', function() {
        $('#kycModal').modal('show');
    });
    }

    //change password
    const changePassword = document.getElementById('changePasswordBtn');

    if(changePassword){
        changePassword.addEventListener('click', function() {
            var changePasswordForm = document.getElementById('changePasswordFields');
                changePasswordForm.style.display = 'block';
                // Ẩn nút đổi mật khẩu
                this.style.display = 'none';
        });
    }

    var formEconomyEdit = {
        'password': {
            'element': document.getElementById('password'),
            'error': document.getElementById('password_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E001')
                },
                {
                    'func':function(value){
                        return  checkLength(value ,8);
                    },
                    'message': generateErrorMessage('E002')
                }
            ]
        },
        'newPassword': {
            'element': document.getElementById('newPassword'),
            'error': document.getElementById('newPassword_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E001')
                },
                {
                    'func':function(value){
                        return  checkLength(value ,8);
                    },
                    'message': generateErrorMessage('E002')
                }
            ]
        },
        'confirmPassword': {
            'element': document.getElementById('confirmPassword'),
            'error': document.getElementById('confirmPassword_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E001')
                },
                {
                    'func':function(value){
                        return  checkLength(value ,8);
                    },
                    'message': generateErrorMessage('E002')
                }
            ]
        },
    }
    function submitForm(event) {
         event.preventDefault();
        if (validateAllFields(formEconomyEdit)){
            document.getElementById('changePasswordFields').submit();
        }
    }
    function changeImage(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById('btn-upload').submit();
        }
    }


</script>
<style>
    .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 0.5rem);
        margin-bottom: 0.5rem;
    }

    .modal-content {
        width: 100%;
    }
</style>
@endsection
