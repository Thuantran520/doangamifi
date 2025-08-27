{{-- filepath: resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>404 - Không tìm thấy trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">404</h1>
    <p class="lead">Xin lỗi, trang bạn yêu cầu không tồn tại.</p>
    <a href="{{ route('launcher') }}" class="btn btn-primary">Trang chủ</a>
</div>
</body>
</html>