<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlessoncreate.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
    <title>Tạo bài học Javascript mới</title>
</head>
<body>
<div class="container mt-4">
    <h1>Tạo bài học Javascript mới</h1>
    <a href="{{ route('admin.javascript.index') }}" class="back-btn">← Quay lại</a>
    <form action="{{ route('admin.javascript.store') }}" method="POST" id="lesson-create-form">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea name="content" id="content" class="form-control" placeholder="Nội dung"></textarea>
        </div>
        <div class="mb-3">
            <label for="example" class="form-label">Ví dụ</label>
            <textarea name="example" id="example" class="form-control" placeholder="Ví dụ"></textarea>
        </div>
        <div class="mb-3">
            <label for="topic" class="form-label">Chủ đề</label>
            <input type="text" name="topic" id="topic" class="form-control" placeholder="Chủ đề">
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Thứ tự</label>
            <input type="number" name="order" id="order" class="form-control" placeholder="Thứ tự">
        </div>
        <input type="hidden" name="created_at" id="created_at">
        <button type="submit" class="btn btn-primary">Thêm bài học</button>
    </form>

    <hr>
    <h4>Nhập liệu bằng file CSV</h4>
    <form method="POST" action="{{ route('admin.javascript.upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="csv_file" accept=".csv" required>
        </div>
        <button type="submit" class="btn btn-success">Upload & Nhập liệu</button>
    </form>
</div>
<script src="{{ asset('Adminlesson/Admintime.js') }}"></script>
</body>
</html>