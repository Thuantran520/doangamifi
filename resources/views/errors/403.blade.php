{{-- filepath: resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Không có quyền truy cập</title>
    <link rel="stylesheet" href="{{ asset('error.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
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