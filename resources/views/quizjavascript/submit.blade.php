
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả trắc nghiệm JavaScript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('quiz.css') }}">
</head>
<body>
<div class="quiz-container">
    <div class="quiz-header">
        <h1><i class="fas fa-poll"></i> Kết quả trắc nghiệm</h1>
    </div>

    <div class="result-summary">
        <h2>Điểm của bạn</h2>
        <div class="score-display">{{ $score }}<span>/{{ $total }}</span></div>
    </div>

    @foreach($results as $item)
        <div class="question-card result-item">
            <div class="card-header">
                Câu {{ $loop->iteration }}: {{ $item['question_text'] }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach(['a','b','c','d'] as $opt)
                        @php
                            $isCorrect = $item['correct_answer'] == $opt;
                            $isSelected = $item['selected'] == $opt;
                            $class = '';
                            if ($isCorrect) $class = 'option-correct';
                            elseif ($isSelected) $class = 'option-incorrect';
                        @endphp
                        <li class="{{ $class }}">
                            {{ strtoupper($opt) }}. {{ $item['options'][$opt] }}
                            @if($isCorrect)
                                <span class="correct-answer-badge">Đáp án đúng</span>
                            @endif
                            @if($isSelected)
                                <span class="user-choice-badge {{ $item['selected'] == $item['correct_answer'] ? 'user-choice-correct' : 'user-choice-incorrect' }}">Bạn chọn</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach

    <div class="result-actions">
        <a href="{{ route('quizjavascript.index') }}" class="btn btn-primary btn-lg">Làm lại</a>
        <a href="{{ route('launcher') }}" class="btn btn-secondary btn-lg ms-2">Quay về trang chủ</a>
    </div>
</div>
</body>
</html>