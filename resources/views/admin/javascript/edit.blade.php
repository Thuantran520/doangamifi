<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài học Javascript</title>
    <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlessonedit.css') }}">
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa bài học Javascript</h1>
        <a href="{{ route('admin.javascript.index') }}" class="back-btn">← Quay lại</a>
        <form action="{{ route('admin.javascript.update', $javascript) }}" method="POST" id="lesson-form">
            @csrf
            @method('PUT')
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" value="{{ $javascript->title }}" required>

            <label for="content">Nội dung</label>
            <textarea name="content" id="content" placeholder="Nội dung">{{ $javascript->content }}</textarea>

            <label for="example">Ví dụ</label>
            <textarea name="example" id="example" placeholder="Ví dụ">{{ $javascript->example }}</textarea>

            <label for="topic">Chủ đề</label>
            <input type="text" name="topic" id="topic" value="{{ $javascript->topic }}">

            <label for="order">Thứ tự</label>
            <input type="number" name="order" id="order" value="{{ $javascript->order }}">

            <input type="hidden" name="updated_date" id="updated_date">
            <button type="submit">Cập nhật bài học</button>
        </form>
    </div>
    <script src="{{ asset('Adminlesson/Admintime.js') }}"></script>
</body>
</html>