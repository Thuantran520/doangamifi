{{-- filepath: resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>403 - Không có quyền truy cập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">403</h1>
    <p class="lead">Xin lỗi, bạn không có quyền truy cập vào trang này.</p>
    <a href="{{ route('launcher') }}" class="btn btn-primary">Trang chủ</a>
</div>
</body>
</html>