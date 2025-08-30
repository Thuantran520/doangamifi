{{-- filepath: resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Không có quyền truy cập</title>
    <link rel="stylesheet" href="{{ asset('error.css') }}">
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <h1 class="error-code">403</h1>
            <h2 class="error-title">Truy cập bị từ chối</h2>
            <p class="error-message">Rất tiếc, bạn không có quyền để xem trang này.</p>
            <a href="{{ route('launcher') }}" class="btn-home">
                <i class="fas fa-home"></i>
                <span>Về trang chủ</span>
            </a>
        </div>
    </div>
</body>
</html>