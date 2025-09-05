<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/quiz-gamify.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon_io/favicon-32x32.png') }}">
</head>
<body>
<div class="quiz-container">
    <div class="quiz-header">
        <h1><i class="@yield('icon')"></i> @yield('title')</h1>
        <div class="quiz-info">
            <div id="timer">Thời gian: 10:00</div>
            <div id="progress-text">Tiến độ: 0 / {{ $items->count() }}</div>
        </div>
        <div class="progress">
            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="@yield('form-action')">
        @csrf
        {{-- THÊM DÒNG NÀY VÀO --}}
        <input type="hidden" name="question_ids" value="{{ $items->pluck('id')->implode(',') }}">

        @yield('quiz-content')
        <div class="quiz-footer">
            <button class="btn btn-submit" type="submit">Nộp bài</button>
            <a href="{{ route('launcher') }}" class="btn btn-cancel"
               onclick="return confirm('Bạn có chắc chắn muốn hủy? Mọi dữ liệu làm bài sẽ bị mất!');">
                Hủy
            </a>
        </div>
    </form>
</div>

<script>
    // JavaScript cho thanh tiến trình và bộ đếm thời gian
    document.addEventListener('DOMContentLoaded', function () {
        const totalQuestions = {{ $items->count() }};
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        const radioButtons = document.querySelectorAll('.form-check-input');
        const answeredQuestions = new Set();

        radioButtons.forEach(radio => {
            radio.addEventListener('change', () => {
                const questionId = radio.name.match(/\[(\d+)\]/)[1];
                answeredQuestions.add(questionId);
                const progress = (answeredQuestions.size / totalQuestions) * 100;
                progressBar.style.width = progress + '%';
                progressText.textContent = `Tiến độ: ${answeredQuestions.size} / ${totalQuestions}`;
            });
        });

        // Timer
        const timerElement = document.getElementById('timer');
        let timeLeft = 600; // 10 phút
        const timerInterval = setInterval(() => {
            const minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            timerElement.textContent = `Thời gian: ${minutes}:${seconds}`;
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                alert('Hết giờ!');
                document.querySelector('form').submit();
            }
            timeLeft--;
        }, 1000);
    });
</script>
</body>
</html>