
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết câu hỏi Quiz C++ (Admin)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
<div class="container py-4">
    <h2>Chi tiết câu hỏi #{{ $quiz->id }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Câu hỏi:</strong></p>
            <p>{{ $quiz->question_text }}</p>
            <hr>
            <div>
                @php
                    $options = [
                        'a' => $quiz->option_a,
                        'b' => $quiz->option_b,
                        'c' => $quiz->option_c,
                        'd' => $quiz->option_d,
                    ];
                @endphp
                @foreach($options as $key => $text)
                    <p>
                        <strong>{{ strtoupper($key) }}.</strong>
                        @if($quiz->correct_answer == $key)
                            <span class="fw-bold text-success">{{ $text }}</span>
                        @else
                            {{ $text }}
                        @endif
                    </p>
                @endforeach
            </div>
            <p class="mt-3"><strong>Đáp án đúng:</strong> {{ strtoupper($quiz->correct_answer) }}</p>
            @if(!empty($quiz->difficulty))
                <p><strong>Độ khó:</strong> {{ $quiz->difficulty }}</p>
            @endif
            @if(!empty($quiz->topic))
                <p><strong>Chủ đề:</strong> {{ $quiz->topic }}</p>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.quizcpp.edit', ['quizcpp' => $quiz->id]) }}" class="btn btn-warning">Sửa</a>
    <a href="{{ route('admin.quizcpp.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
</body>
</html>