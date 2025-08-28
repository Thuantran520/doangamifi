<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Chọn bài làm trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Quizchoice.css') }}">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Chọn bài / chủ đề để làm trắc nghiệm</h2>
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-6">
            <div class="quiz-card">
                <div class="quiz-icon">
                  <!-- Python icon: snake -->
                  <svg width="38" height="38" viewBox="0 0 38 38" fill="none">
                    <path d="M10 19c0-5 4-9 9-9s9 4 9 9-4 9-9 9" stroke="#3776AB" stroke-width="2.2" fill="none"/>
                    <circle cx="15" cy="17" r="1.5" fill="#3776AB"/>
                    <circle cx="23" cy="17" r="1.5" fill="#FFD43B"/>
                  </svg>
                </div>
                <div class="quiz-title">Python</div>
                <div class="quiz-desc">Làm bài trắc nghiệm về Python: cú pháp, logic, ứng dụng thực tế.</div>
                <a href="{{ route('admin.quizpython.index') }}" class="btn-quiz">Chinh phục Python</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="quiz-card">
                <div class="quiz-icon">
                  <!-- C++ icon: gear -->
                  <svg width="38" height="38" viewBox="0 0 38 38" fill="none">
                    <circle cx="19" cy="19" r="10" stroke="#00599C" stroke-width="2.2" fill="#e0e7ff"/>
                    <path d="M19 12v3M19 23v3M12 19h3M23 19h3M15.5 15.5l2.1 2.1M22.5 22.5l2.1 2.1M15.5 22.5l2.1-2.1M22.5 15.5l2.1-2.1" stroke="#00599C" stroke-width="1.5"/>
                  </svg>
                </div>
                <div class="quiz-title">C++</div>
                <div class="quiz-desc">Kiểm tra kiến thức C++: cấu trúc, hàm, hướng đối tượng, thực hành.</div>
                <a href="{{ route('admin.quizcpp.index') }}" class="btn-quiz">Chinh phục C++</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="quiz-card">
                <div class="quiz-icon">
                  <!-- JavaScript icon: JS letters -->
                  <svg width="38" height="38" viewBox="0 0 38 38" fill="none">
                    <rect x="6" y="6" width="26" height="26" rx="6" fill="#F7DF1E"/>
                    <text x="12" y="27" font-family="Arial, Helvetica, sans-serif" font-size="16" font-weight="bold" fill="#222">JS</text>
                  </svg>
                </div>
                <div class="quiz-title">JavaScript</div>
                <div class="quiz-desc">Thử sức với JavaScript: biến, hàm, DOM, ứng dụng web.</div>
                <a href="{{ route('admin.quizjavascript.index') }}" class="btn-quiz">Chinh phục JavaScript</a>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('launcher') }}" class="btn btn-secondary">Quay lại trang chính</a>
    </div>
</div>
</body>
</html>