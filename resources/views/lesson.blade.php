<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chọn loại bài học</title>
    <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlesson.css') }}">
    <link rel="stylesheet" href="{{ asset('lesson.css') }}">
    <!-- Nếu có JS dùng chung, thêm ở cuối file -->
</head>
<body>
    <a href="{{ route('launcher') }}" class="btn-back-home">Quay lại trang chủ</a>
    <div class="container">
        <h1 class="lesson-title">Chọn loại bài học</h1>
        <div class="lesson-category-list">
            <div class="lesson-category-item">
                <h2>Python</h2>
                <a href="{{ route('python') }}" class="btn-lesson">Xem bài học Python</a>
            </div>
            <div class="lesson-category-item">
                <h2>C++</h2>
                <a href="{{ route('cpp') }}" class="btn-lesson">Xem bài học C++</a>
            </div>
            <div class="lesson-category-item">
                <h2>Javascript</h2>
                <a href="{{ route('javascript') }}" class="btn-lesson">Xem bài học Javascript</a>
            </div>
        </div>
    </div>
    <!-- hoặc dùng chung với admin: <script src="{{ asset('Adminlesson/Adminlesson.js') }}"></script> -->
</body>
</html>