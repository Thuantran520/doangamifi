<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài học C++</title>
    <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlessonedit.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa bài học C++</h1>
        <a href="{{ route('admin.cpp.index') }}" class="back-btn">← Quay lại</a>
        <form action="{{ route('admin.cpp.update', $cpp) }}" method="POST" id="lesson-form">
            @csrf
            @method('PUT')
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" value="{{ $cpp->title }}" required>

            <label for="content">Nội dung</label>
            <textarea name="content" id="content" placeholder="Nội dung">{{ $cpp->content }}</textarea>

            <label for="example">Ví dụ</label>
            <textarea name="example" id="example" placeholder="Ví dụ">{{ $cpp->example }}</textarea>

            <label for="topic">Chủ đề</label>
            <input type="text" name="topic" id="topic" value="{{ $cpp->topic }}">

            <label for="order">Thứ tự</label>
            <input type="number" name="order" id="order" value="{{ $cpp->order }}">

            <input type="hidden" name="updated_date" id="updated_date">
            <button type="submit">Cập nhật bài học</button>
        </form>
    </div>
    <script src="{{ asset('Adminlesson/Admintime.js') }}"></script>
</body>
</html>