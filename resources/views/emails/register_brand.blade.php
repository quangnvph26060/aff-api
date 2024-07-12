<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đăng nhập </title>
</head>
<body>
<p>Kính gửi thương hiệu <strong>{{ $data['name'] }}</strong>,</p>
<p>Thông tin đăng nhập của thương hiệu</p>
<p><strong>Tài khoản: </strong>{{ $data['email'] }}</p>
<p><strong>Mật khẩu: </strong>{{ $password_mail }}</p>
<p>Trân trọng</p>
</body>
</html>