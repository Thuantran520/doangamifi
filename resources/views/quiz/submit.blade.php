<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">Kết quả bài trắc nghiệm</h2>
    <p><strong>Điểm của bạn:</strong> {{ $score }} / {{ $total }}</p>

    @foreach($results as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Câu {{ $loop->iteration }}: {{ $item['question_text'] }}</h5>
                <ul>
                    @foreach(['a','b','c','d'] as $opt)
                        <li
                            @if($item['correct_answer'] == $opt)
                                style="color:green;font-weight:bold"
                            @elseif($item['selected'] == $opt)
                                style="color:red"
                            @endif
                        >
                            {{ strtoupper($opt) }}. {{ $item['options'][$opt] }}
                            @if($item['selected'] == $opt)
                                <span> ← Bạn chọn</span>
                            @endif
                            @if($item['correct_answer'] == $opt)
                                <span> ← Đáp án đúng</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <p>
                    @if($item['selected'] == $item['correct_answer'])
                        <span class="text-success">Đúng</span>
                    @else
                        <span class="text-danger">Sai</span>
                    @endif
                </p>
            </div>
        </div>
    @endforeach

    <a href="{{ route('quiz.index') }}" class="btn btn-primary">Làm lại</a>
    <a href="{{ route('launcher') }}" class="btn btn-secondary ms-2">Quay về trang chủ</a>
</div>
</body>
</html>