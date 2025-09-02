
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Bài Học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('lesson.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="{{ route('launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại Trang chủ</a>
            <h1><i class="fas fa-graduation-cap"></i> Chọn Chủ Đề Bài Học</h1>
            <p>Bắt đầu hành trình lập trình của bạn bằng cách chọn một ngôn ngữ bên dưới.</p>
        </header>

        <main class="lesson-grid">
            <a href="{{ route('python') }}" class="lesson-card python">
                <div class="card-icon-container">
                    <i class="fab fa-python card-icon"></i>
                </div>
                <div class="card-content">
                    <h2>Python</h2>
                    <p>Ngôn ngữ lập trình đa năng, dễ học cho người mới bắt đầu.</p>
                </div>
                <span class="btn-start">Bắt đầu học <i class="fas fa-chevron-right"></i></span>
            </a>
            <a href="{{ route('cpp') }}" class="lesson-card cpp">
                <div class="card-icon-container">
                    <i class="fab fa-cuttlefish card-icon"></i>
                </div>
                <div class="card-content">
                    <h2>C++</h2>
                    <p>Ngôn ngữ mạnh mẽ, hiệu suất cao cho phát triển game và hệ thống.</p>
                </div>
                <span class="btn-start">Bắt đầu học <i class="fas fa-chevron-right"></i></span>
            </a>
            <a href="{{ route('javascript') }}" class="lesson-card javascript">
                <div class="card-icon-container">
                    <i class="fab fa-js-square card-icon"></i>
                </div>
                <div class="card-content">
                    <h2>Javascript</h2>
                    <p>Ngôn ngữ của web, xây dựng các trang web tương tác và động.</p>
                </div>
                <span class="btn-start">Bắt đầu học <i class="fas fa-chevron-right"></i></span>
            </a>
        </main>
    </div>
</body>
</html>