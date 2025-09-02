
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài học C++</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('lesson.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <div class="lesson-page-container">
        <header class="page-header">
            <a href="{{ route('lesson') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại chọn chủ đề</a>
            {{-- Sửa icon và tiêu đề cho C++ --}}
            <h1><i class="fab fa-cuttlefish"></i> Bài học C++</h1>
        </header>

        <div class="lesson-list">
            {{-- Sửa biến lặp và data-lesson-id --}}
            @forelse($cpp as $lesson)
                <div class="lesson-item accordion" data-lesson-id="cpp-{{ $lesson->lesson_id }}">
                    <div class="accordion-header">
                        <h3>{{ $lesson->title }}</h3>
                        <div class="header-controls">
                            <button class="btn-viewed"><i class="fas fa-check"></i> Đã xem</button>
                            <i class="fas fa-chevron-down expand-icon"></i>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <div class="content-inner">
                            <p>{!! nl2br(e($lesson->content)) !!}</p>
                            @if(!empty($lesson->example))
                                <pre><code>{{ $lesson->example }}</code></pre>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="empty-message">Chưa có bài học nào cho chủ đề này.</p>
            @endforelse
        </div>
    </div>
    <script src="{{ asset('lesson.js') }}"></script>
</body>
</html>