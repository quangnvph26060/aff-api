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
                            <p>Hạng thành viên: <strong>Membership</strong></p>
                            <p>Tài khoản đã được xác thực</p>
                            <p>Mã khách hàng: <strong>KP702624</strong></p>
                            <button class="btn btn-outline-primary btn-sm">Giới thiệu bạn bè</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Ví chính</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="0đ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Ví tri ân 1</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="0đ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Ví tri ân 2</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control bg-white" disabled value="0đ">
                                </div>
                            </div>
                            <div class="form-group row">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ asset('/users/avatar-1.jpg') }}" alt="User Avatar" class="rounded-circle mb-3"
                                width="150" height="150">
                            <h4>name</h4>
                            <p>email</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="user-info-form" action="" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Họ và tên</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="Nguyễn Thị Kiều Tiên">
                                    </div>
                                </div>

                                <div class="form-group row mt-2 mb-2 ">
                                    <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <select class="form-control" id="city">
                                                    <option value="">Chọn thành phố</option>
                                                    <!-- Danh sách các thành phố -->
                                                    <option value="tp_hcm">TP. Hồ Chí Minh</option>
                                                    <option value="ha_noi">Hà Nội</option>
                                                    <!-- Thêm các thành phố khác nếu cần -->
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="district">
                                                    <option value="">Chọn quận/huyện</option>
                                                    <!-- Danh sách các quận/huyện sẽ được thêm bằng JS -->
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="ward">
                                                    <option value="">Chọn xã/phường/thị trấn</option>
                                                    <!-- Danh sách các xã/phường/thị trấn sẽ được thêm bằng JS -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="0359862787">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="">
                                    </div>
                                </div>
                                <button type="button" id="update-info-btn" class="btn btn-outline-primary">Cập nhật
                                    thông tin</button>
                                <button type="button" id="openKycModalBtn" class="btn btn-primary" data-toggle="modal"
                                    data-target="#kycModal">Định danh cá nhân</button>
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
                                <div class="col-sm-10 mb-2">
                                    <input type="text" class="form-control bg-white" id="username" value="0359862787"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                                <div class="col-sm-10 mb-2">
                                    <input type="password" class="form-control bg-white" id="password" value="*********"
                                        disabled>
                                </div>
                            </div>
                            <button type="button" id="changePasswordBtn" class="btn btn-outline-primary btn-sm">Đổi mật
                                khẩu</button>

                            <!-- Thêm input mật khẩu mới và xác nhận mật khẩu -->
                            <form action="{{ route('admin.ChangePassword') }}" method="post" id="changePasswordFields"
                                style="display: none;">
                                @csrf
                                <div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu hiện
                                            tại</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Mật khẩu hiện tại">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" name="newPassword" class="form-control"
                                                id="newPassword">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-sm-2 col-form-label">Xác nhận mật
                                            khẩu</label>
                                        <div class="col-sm-10 mb-2">
                                            <input type="password" class="form-control" name="confirmPassword"
                                                id="confirmPassword">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary btn-sm">Lưu</button>
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
    const updateinfo = document.getElementById('update-info-btn');
    if(updateinfo){
        updateinfo.addEventListener('click', function() {
            const inputs = document.querySelectorAll('#user-info-form input');
            const isDisabled = inputs[0].disabled;

            inputs.forEach(input => {
                input.disabled = !isDisabled;
            });

            if (isDisabled) {
                this.textContent = 'Lưu';
            } else {
                this.textContent = 'Cập nhật thông tin';
                document.getElementById('user-info-form').submit();
            }
        });
    }
    // định dang
    const kyc =  document.getElementById('kyc-btn');
    if(kyc){
        kyc.addEventListener('click', function() {
        $('#kycModal').modal('show');
    });
    }

    //change password
    const changePassword = document.getElementById('changePasswordBtn');
    console.log(changePassword);
    if(changePassword){
        changePassword.addEventListener('click', function() {
            var changePasswordForm = document.getElementById('changePasswordFields');
                changePasswordForm.style.display = 'block';

                // Ẩn nút đổi mật khẩu
                this.style.display = 'none';

                // Xuất thông báo ra console để kiểm tra xem sự kiện click được kích hoạt hay không
                console.log('Đã bấm vào nút đổi mật khẩu');
        });
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
