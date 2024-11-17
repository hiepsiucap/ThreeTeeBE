<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .content {
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666666;
            text-align: center;
        }

        .warning {
            color: #721c24;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Đặt lại mật khẩu</h2>
    </div>

    <div class="content">
        <p>Xin chào {{ $user->name }},</p>

        <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Vui lòng click vào nút bên dưới để đặt
            lại mật khẩu:</p>

        <div style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button">Đặt lại mật khẩu</a>
        </div>

        <p>Hoặc copy đường link sau vào trình duyệt:</p>
        <p style="word-break: break-all;">{{ $resetUrl }}</p>

        <div class="warning">
            <p><strong>Lưu ý:</strong> Link đặt lại mật khẩu sẽ hết hạn sau {{ $expiresIn }} phút.</p>
            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
        </div>
    </div>

    <div class="footer">
        <p>Email này được gửi tự động, vui lòng không trả lời.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>

</html>