
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Câu hỏi Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/quiz-choice.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="{{ route('admin.launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại</a>
            <h1><i class="fas fa-file-circle-question"></i> Quản lý Câu hỏi Quiz</h1>
            <p>Chọn một ngôn ngữ để xem, thêm, sửa hoặc xóa câu hỏi.</p>
        </header>

        <main class="lesson-grid">
            <a href="{{ route('admin.quizpython.index') }}" class="lesson-card python">
                <div class="card-icon-container"><i class="fab fa-python card-icon"></i></div>
                <h2>Python</h2>
                <p>Quản lý bộ câu hỏi trắc nghiệm cho ngôn ngữ Python.</p>
                <span class="btn-manage">Quản lý ngay</span>
            </a>
            <a href="{{ route('admin.quizcpp.index') }}" class="lesson-card cpp">
                <div class="card-icon-container"><i class="fab fa-cuttlefish card-icon"></i></div>
                <h2>C++</h2>
                <p>Quản lý bộ câu hỏi trắc nghiệm cho ngôn ngữ C++.</p>
                <span class="btn-manage">Quản lý ngay</span>
            </a>
            <a href="{{ route('admin.quizjavascript.index') }}" class="lesson-card javascript">
                <div class="card-icon-container"><i class="fab fa-js-square card-icon"></i></div>
                <h2>Javascript</h2>
                <p>Quản lý bộ câu hỏi trắc nghiệm cho ngôn ngữ Javascript.</p>
                <span class="btn-manage">Quản lý ngay</span>
            </a>
        </main>
    </div>
</body>
</html>