<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Bạn đang là admin</h1>
    <h2>Chào mừng đến với trang quản trị</h2>
    <button onclick="window.location.href='{{ route('logout') }}'">Đăng xuất</button>
</body>
</html>