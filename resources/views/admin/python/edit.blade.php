<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài học</title>
    <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlessonedit.css') }}">
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa bài học</h1>
        <a href="{{ route('admin.python.index') }}" class="back-btn">← Quay lại</a>
        <form action="{{ route('admin.python.update', $python) }}" method="POST" id="lesson-form">
            @csrf
            @method('PUT')
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" value="{{ $python->title }}" required>

            <label for="content">Nội dung</label>
            <textarea name="content" id="content" placeholder="Nội dung">{{ $python->content }}</textarea>

            <label for="example">Ví dụ</label>
            <textarea name="example" id="example" placeholder="Ví dụ">{{ $python->example }}</textarea>

            <label for="topic">Chủ đề</label>
            <input type="text" name="topic" id="topic" value="{{ $python->topic }}">

            <label for="order">Thứ tự</label>
            <input type="number" name="order" id="order" value="{{ $python->order }}">

            <input type="hidden" name="updated_date" id="updated_date">
            <button type="submit">Cập nhật bài học</button>
        </form>
    </div>
    <script src="{{ asset('Adminlessons/Admintime.js') }}"></script>
</body>
</html>