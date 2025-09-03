
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm câu hỏi Quiz JavaScript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
<div class="container mt-4">
    <h2>Thêm câu hỏi Quiz JavaScript</h2>
    <form id="lesson-form" method="POST" action="{{ route('admin.quizjavascript.store') }}">
        @csrf

        <!-- hidden created_at (will be filled by Admintime.js) -->
        <input type="hidden" id="created_at" name="created_at" value="">

        <div class="mb-3">
            <label for="question_text" class="form-label">Nội dung câu hỏi</label>
            <input type="text" class="form-control" name="question_text" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Đáp án A</label>
            <input type="text" class="form-control" name="option_a" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Đáp án B</label>
            <input type="text" class="form-control" name="option_b" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Đáp án C</label>
            <input type="text" class="form-control" name="option_c" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Đáp án D</label>
            <input type="text" class="form-control" name="option_d" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Đáp án đúng</label>
            <select class="form-select" name="correct_answer" required>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Độ khó (tùy chọn)</label>
            <input type="text" class="form-control" name="difficulty" value="">
        </div>
        <div class="mb-3">
            <label class="form-label">Chủ đề (tùy chọn)</label>
            <input type="text" class="form-control" name="topic" value="">
        </div>

        <button type="submit" class="btn btn-primary">Thêm câu hỏi</button>
        <a href="{{ route('admin.quizjavascript.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
    </form>

    <hr>
    <h4>Nhập liệu bằng file Excel/CSV</h4>
    <form method="POST" action="{{ route('admin.quizjavascript.upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="quiz_file" accept=".xlsx,.xls,.csv" required>
        </div>
        <button type="submit" class="btn btn-success">Upload & Nhập liệu</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('Adminlesson/Admintime.js') }}"></script>
</body>
</html>