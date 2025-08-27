<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@section('content')
<div class="container">
    <h2>Tạo câu hỏi mới</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nội dung câu hỏi</label>
            <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Option A</label>
                <input type="text" name="option_a" class="form-control" value="{{ old('option_a') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Option B</label>
                <input type="text" name="option_b" class="form-control" value="{{ old('option_b') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Option C</label>
                <input type="text" name="option_c" class="form-control" value="{{ old('option_c') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Option D</label>
                <input type="text" name="option_d" class="form-control" value="{{ old('option_d') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Đáp án đúng</label>
            <select name="correct_answer" class="form-select" required>
                <option value="">-- chọn đáp án đúng --</option>
                <option value="a" {{ old('correct_answer')=='a' ? 'selected' : '' }}>A</option>
                <option value="b" {{ old('correct_answer')=='b' ? 'selected' : '' }}>B</option>
                <option value="c" {{ old('correct_answer')=='c' ? 'selected' : '' }}>C</option>
                <option value="d" {{ old('correct_answer')=='d' ? 'selected' : '' }}>D</option>
            </select>
        </div>

        <button class="btn btn-success" type="submit">Lưu</button>
        <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
</body>
</html>