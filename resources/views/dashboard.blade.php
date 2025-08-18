<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang người dùng</title>
</head>
<body>
        <h1>Chào mừng đến với trang người dùng</h1>
        <p>Đây là nội dung riêng tư chỉ dành cho người dùng đã đăng nhập.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
</body>
</html>