{{-- filepath: resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang</title>
    <link rel="stylesheet" href="{{ asset('error.css') }}">
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Không tìm thấy trang</h2>
            <p class="error-message">Rất tiếc, trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.</p>
            <a href="{{ route('launcher') }}" class="btn-home">
                <i class="fas fa-home"></i>
                <span>Về trang chủ</span>
            </a>
        </div>
    </div>
</body>
</html>