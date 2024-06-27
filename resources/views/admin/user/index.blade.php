@extends('layouts.app')

@section('content')
<style>
    .modal-content {
        padding: 30px 20px;
    }

    .modal-content input,
    .modal-content select {
        width: 500px;
    }

    .modal-content input,
    .modal-content select,
    .modal-content img {
        margin-bottom: 10px
    }
</style>
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
                            <p id="customer">Mã khách hàng: <strong>{{$admin->referrer_id ?? ""}}</strong></p>
                            <button class="btn btn-outline-primary btn-sm" id="btn-copy">Giới thiệu bạn bè</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach($admin->wallet as $item)
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">{{$item->wallet_id == 1 ? "Ví chính" :"Ví
                                    thưởng"}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="{{  number_format($item->total_revenue)}}đ">
                                </div>
                            </div>
                            @endforeach

                            {{-- <div class="form-group row">--}}
                            {{-- <label class="col-sm-4 col-form-label">Ví thưởng </label>--}}
                            {{-- <div class="col-sm-8">--}}
                            {{-- <input type="text" class="form-control bg-white" disabled
                                        value="{{ $admin->wallet == '[]' ? 0 : number_format($admin->wallet[1]['total_revenue'])}}đ">--}}
                            {{-- </div>--}}
                            {{-- </div>--}}

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
                                <img id="userAvatar"
                                    src="{{  $admin->user_info && count($admin->user_info) > 0 && isset($admin->user_info[0]['img_url']) ? asset($admin->user_info[0]['img_url']): asset('/users/avatar-1.jpg') }}"
                                    alt="User Avatar" class="rounded-circle mb-3" width="150" height="150"
                                    style="cursor: pointer;">
                            </label>
                            <form action="{{ route('admin.file.upload') }}" method="post" id="btn-upload"
                                enctype="multipart/form-data">
                                @csrf
                                <input id="avatarInput" type="file" name="file" style="display: none; cursor: pointer;" onchange="changeImage(event)">
                            </form>
                            <h4>{{$admin->name}}</h4>
                            <p>{{$admin->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="user-info-form" action="{{route('admin.profile.update')}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Họ và tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name" value="{{$admin->name}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="name_error"></span> </div>
                                        </div>
                                        <div class="form-group row mt-2 mb-2">
                                            <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="city_id" id="city">
                                                            <option value="">Chọn thành phố</option>
                                                            @foreach($city as $item)
                                                            <option value="{{$item->id}}" {{$item->id == $admin->city_id ?
                                                            'selected' : ''}}>{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-lg-2"></div>
                                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="city_error"></span> </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="district_id" id="district">
                                                            <option value="">Chọn quận/huyện</option>
                                                            @foreach($districts as $item)
                                                            <option value="{{$item->id}}" {{$item->id == $admin->district_id ?
                                                            'selected' : ''}}>{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-lg-2"></div>
                                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="district_error"></span> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="wards_id" id="ward">
                                                            <option value="">Chọn xã/phường/thị trấn</option>
                                                            @foreach($wards as $item)
                                                            <option value="{{$item->id}}" {{$item->id == $admin->wards_id ?
                                                            'selected' : ''}}>{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-lg-2"></div>
                                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="ward_error"></span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control mb-2" placeholder="Nhập địa chỉ" id="address" name="address" value="{{$admin->address}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="address_error"></span> </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{$admin->phone}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="phone_error"></span> </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2 mt-2">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email" value="{{$admin->email}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="email_error"></span> </div>
                                            </div>
                                        </div>
                                        <button type="submit" id="update-info-btn" class="btn btn-outline-primary" onclick="submitEditForm(event)">Cập nhật
                                            thông tin</button>
                                        <button type="button" id="openKycModalBtn" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">Định danh cá nhân</button>
                                    </form>
                                @if (session('dinhdanh'))
                                <div class="alert alert-success mt-2">
                                    {{ session('dinhdanh') }}
                                </div>
                                @endif
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
                            <div class="form-group row mt-2">
                                <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                                <div class="col-sm-10 mb-2">
                                    <input type="password" class="form-control bg-white" id="password1" value="*********" disabled>
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
                                            <input type="password" class="form-control  " id="password" name="password" placeholder="Mật khẩu hiện tại">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="password_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" name="newPassword" class="form-control  " placeholder="Mật khẩu mới" id="newPassword">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="newPassword_error"></span> </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-sm-2 col-form-label">Xác nhận mật
                                            khẩu</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" class="form-control  " placeholder="Xác nhận mật khẩu" name="confirmPassword" id="confirmPassword">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500" id="confirmPassword_error"></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="submitForm(event)">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->


<div class="modal fade" id="kycModal" tabindex="-1" role="dialog" aria-labelledby="kycModalLabel" aria-hidden="true" style="margin-top: 20px">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <form action="{{ route('admin.infoAdmin.update') }}" method="POST" id="personalIdentification"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="form-group">
                    <input type="file" class="form-control-file" id="cccdFrontImage" name='font-image'>
                    <div class="form-group">
                        <label for="cccdFrontImage">Ảnh CCCD mặt trước</label> <br>

                        <img style="width: 60px; height: 50px" src="{{ $userInfor != null ? asset($userInfor->front_image):'' }}" alt="">
                    </div>
                </div>
                <div class="form-group">

                    <input type="file" class="form-control-file" id="cccdBackImage" name='back-image'>
                    <div class="form-group">
                        <label for="cccdFrontImage">Ảnh CCCD mặt sau</label> <br>
                        <img style="width: 60px; height: 50px" src="{{ $userInfor? asset($userInfor->back_image) :'' }}" alt="">
                    </div>

                </div>

                <div class="form-group">
                    <label for="cccdNumber">Số CCCD</label>
                    <input type="text" class="form-control" id="cccdNumber" name="citizen_id_number"
                        value="{{ $userInfor? $userInfor->citizen_id_number :''}}" oninput="validateInput(this)">
                    <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                            id="cccdNumber_error"></span> </div>
                </div>
                <div class="form-group">
                    <label for="bank">Chọn ngân hàng</label>
                    <select class="form-control" id="bank" name="bank">
                        <option  value="">Chọn ngân hàng</option>
                        @foreach ($bank as $item )
                        <option {{ $userInfor && $userInfor->bank == $item->code ? 'selected' : '' }}
                            value="{{ $item->code }}">{{ $item->name.'-'.$item->shortName }}</option>
                        @endforeach


                    </select>
                    <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                        id="bank_error"></span> </div>
                </div>
                <div class="form-group">
                    <label for="accountNumber">Số tài khoản</label>
                    <input type="text" class="form-control" id="accountNumber" name="idnumber"
                        value="{{ $userInfor? $userInfor->idnumber:'' }}" oninput="validateInput(this)">
                        <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                            id="accountNumber_error"></span> </div>
                </div>
                <div class="form-group">
                    <label for="accountHolderName">Tên chủ tài khoản</label>
                    <input type="text" class="form-control" id="accountHolderName" name="bank_name"
                        value="{{ $userInfor? $userInfor->bank_name:'' }}">
                        <div class="col-lg-9"><span class="invalid-feedback d-block" style="font-weight: 500"
                            id="accountHolderName_error"></span> </div>
                </div>



                <button type="button" onclick="Submutidentification(event)" class="btn btn-primary btn-sm"
                    style="width: 100px;">Lưu</button>

            </div>
        </form>
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

    if (changePassword) {
        changePassword.addEventListener('click', function() {
            var changePasswordForm = document.getElementById('changePasswordFields');
            changePasswordForm.style.display = 'block';
            // Ẩn nút đổi mật khẩu
            this.style.display = 'none';
        });
    }
    var formInfoEdit = {
        'name': {
            'element': document.getElementById('name'),
            'error': document.getElementById('name_error'),
            'validations': [{
                'func': function(value) {
                    return checkRequired(value);
                },
                'message': generateErrorMessage('E019')
            }, ]
        },
        'city': {
            'element': document.getElementById('city'),
            'error': document.getElementById('city_error'),
            'validations': [{
                'func': function(value) {
                    return value !== "";
                },
                'message': generateErrorMessage('E021')
            }, ]
        },
        'district': {
            'element': document.getElementById('district'),
            'error': document.getElementById('district_error'),
            'validations': [{
                'func': function(value) {
                    return value !== "";
                },
                'message': generateErrorMessage('E022')
            }, ]
        },
        'ward': {
            'element': document.getElementById('ward'),
            'error': document.getElementById('ward_error'),
            'validations': [{
                'func': function(value) {
                    return value !== "";
                },
                'message': generateErrorMessage('E023')
            }, ]
        },
        'address': {
            'element': document.getElementById('address'),
            'error': document.getElementById('address_error'),
            'validations': [{
                'func': function(value) {
                    return checkRequired(value);
                },
                'message': generateErrorMessage('E020')
            }, ]
        },
        'phone': {
            'element': document.getElementById('phone'),
            'error': document.getElementById('phone_error'),
            'validations': [{
                'func': function(value) {
                    return checkRequired(value);
                },
                'message': generateErrorMessage('E024')
            }, ]
        },
        'email': {
            'element': document.getElementById('email'),
            'error': document.getElementById('email_error'),
            'validations': [{
                'func': function(value) {
                    return checkRequired(value);
                },
                'message': generateErrorMessage('E025')
            }, ]
        },

    }

    function submitEditForm(event) {
        event.preventDefault();
        if (validateAllFields(formInfoEdit)) {
            document.getElementById('user-info-form').submit();
        }
    }
    var formEconomyEdit = {
        'password': {
            'element': document.getElementById('password'),
            'error': document.getElementById('password_error'),
            'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E001')
                },
                {
                    'func': function(value) {
                        return checkLength(value, 8);
                    },
                    'message': generateErrorMessage('E002')
                }
            ]
        },
        'newPassword': {
            'element': document.getElementById('newPassword'),
            'error': document.getElementById('newPassword_error'),
            'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E001')
                },
                {
                    'func': function(value) {
                        return checkLength(value, 8);
                    },
                    'message': generateErrorMessage('E002')
                }
            ]
        },
        'confirmPassword': {
            'element': document.getElementById('confirmPassword'),
            'error': document.getElementById('confirmPassword_error'),
            'validations': [{
                    'func': function(value) {
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E001')
                },
                {
                    'func': function(value) {
                        return checkLength(value, 8);
                    },
                    'message': generateErrorMessage('E002')
                }
            ]
        },
    }

    function submitForm(event) {
        event.preventDefault();
        if (validateAllFields(formEconomyEdit)) {
            document.getElementById('changePasswordFields').submit();
        }
    }
    /// dinh danh cá nhân

    var identification ={
        'cccdNumber': {
            'element': document.getElementById('cccdNumber'),
            'error': document.getElementById('cccdNumber_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E004')
                },
                {
                    'func':function(value){
                        return  checkLength(value ,12);
                    },
                    'message': generateErrorMessage('E006')
                }
            ]
        },
        'bank': {
            'element': document.getElementById('bank'),
            'error': document.getElementById('bank_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E006')
                },
            ]
        },
        'accountNumber': {
            'element': document.getElementById('accountNumber'),
            'error': document.getElementById('accountNumber_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E007')
                },

            ]
        },
        'accountHolderName': {
            'element': document.getElementById('accountHolderName'),
            'error': document.getElementById('accountHolderName_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E008')
                },
                {
                    'func':function(value){
                        return  checkLength(value ,4);
                    },
                    'message': generateErrorMessage('E008')
                }
            ]
        },
    }

    function Submutidentification(event){
    event.preventDefault();
        if (validateAllFields(identification)){
            document.getElementById('personalIdentification').submit();
        }
    }
    function changeImage(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: '{{ route("admin.file.upload") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    $('#uploadResult').html('<p>File uploaded successfully: ' + response.file + '</p>');
                    $('#userAvatar').attr('src', '{{ config("app.url") }}/' + response.file);
                } else {
                    $('#uploadResult').html('<p>Error: ' + response.error + '</p>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#uploadResult').html('<p>An error occurred: ' + textStatus + '</p>');
            }
        });
    }
}
document.getElementById('copyBtn').addEventListener('click', function() {
    const textToCopy = document.getElementById('customerId').innerText;
    navigator.clipboard.writeText(textToCopy).then(function() {
        // Hiển thị thông báo khi sao chép thành công
        document.getElementById('copyResult').innerText = 'Copied: ' + textToCopy;
    }, function(err) {
        console.error('Error copying text: ', err);
        document.getElementById('copyResult').innerText = 'Failed to copy text';
    });
});

/////
function validateInput(input) {
        // Replace any non-numeric character with an empty string
        input.value = input.value.replace(/\D/g, '');
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
