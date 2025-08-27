
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa câu hỏi (Admin)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2>Chỉnh sửa câu hỏi #{{ $quiz->id }}</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.quiz.update', $quiz) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nội dung câu hỏi</label>
            <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text', $quiz->question_text) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Option A</label>
                <input type="text" name="option_a" class="form-control" value="{{ old('option_a', $quiz->option_a) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Option B</label>
                <input type="text" name="option_b" class="form-control" value="{{ old('option_b', $quiz->option_b) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Option C</label>
                <input type="text" name="option_c" class="form-control" value="{{ old('option_c', $quiz->option_c) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Option D</label>
                <input type="text" name="option_d" class="form-control" value="{{ old('option_d', $quiz->option_d) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Đáp án đúng</label>
            <select name="correct_answer" class="form-select" required>
                <option value="">-- chọn đáp án đúng --</option>
                <option value="a" {{ old('correct_answer', $quiz->correct_answer)=='a' ? 'selected' : '' }}>A</option>
                <option value="b" {{ old('correct_answer', $quiz->correct_answer)=='b' ? 'selected' : '' }}>B</option>
                <option value="c" {{ old('correct_answer', $quiz->correct_answer)=='c' ? 'selected' : '' }}>C</option>
                <option value="d" {{ old('correct_answer', $quiz->correct_answer)=='d' ? 'selected' : '' }}>D</option>
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Cập nhật</button>
        <a href="{{ route('admin.quiz.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

    <form action="{{ route('admin.quiz.destroy', $quiz) }}" method="POST" class="mt-4" onsubmit="return confirm('Bạn chắc chắn muốn xóa câu hỏi này?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Xóa câu hỏi</button>
    </form>
</div>
</body>
</html>