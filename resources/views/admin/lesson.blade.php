<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý các loại bài học</title>
    <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlesson.css') }}">
</head>
<body>
    <a href="{{ route('admin.launcher') }}" class="back-btn">← Quay lại</a>
    <div class="container">
        <h1>Quản lý các loại bài học</h1>

        <div class="lesson-category-list">
            <div class="lesson-category-item">
                <h2>Python</h2>
                <a href="{{ route('admin.python.index') }}" class="btn-action btn-primary">Quản lý bài học Python</a>
            </div>
            <div class="lesson-category-item">
                <h2>C++</h2>
                <a href="{{ route('admin.cpp.index') }}" class="btn-action btn-primary">Quản lý bài học C++</a>
            </div>
            <div class="lesson-category-item">
                <h2>Javascript</h2>
                <a href="{{ route('admin.javascript.index') }}" class="btn-action btn-primary">Quản lý bài học Javascript</a>
            </div>
        </div>
    </div>
</body>
</html>