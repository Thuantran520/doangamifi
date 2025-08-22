<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh sách bài học</title>
    <link rel="stylesheet" href="{{ asset('lesson.css') }}">
</head>
<body>
    <button class="back-btn" onclick="window.history.back()">← Quay lại</button>
    <div class="lesson-header">
        <h1>Danh sách bài học</h1>
    </div>
    <div class="lesson-list">
        @foreach($lessons as $lesson)
            <div class="lesson-item accordion">
                <div class="accordion-header">
                    <h2>{{ $lesson->title }}</h2>
                    <div class="lesson-topic">{{ $lesson->topic ?? 'N/A' }}</div>
                </div>
                <div class="accordion-content" style="display:none;">
                    <p>{{ $lesson->content ?: 'Chưa có nội dung cho bài học này.' }}</p>
                    @if(!empty($lesson->example))
                        <div class="lesson-meta">
                            <span><strong>Ví dụ:</strong> {{ $lesson->example }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <script src="{{ asset('lesson.js') }}"></script>
</body>
</html>