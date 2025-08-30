
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Chủ Đề Trắc Nghiệm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Quizchoice.css') }}">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="{{ route('launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại Trang chủ</a>
            <h1><i class="fas fa-question-circle"></i> Chọn Chủ Đề Trắc Nghiệm</h1>
            <p>Kiểm tra kiến thức của bạn với các bài trắc nghiệm đầy thử thách của chúng tôi.</p>
        </header>

        <main class="quiz-grid">
            <a href="{{ route('quizpython.index') }}" class="quiz-card python">
                <div class="card-icon-container">
                    <i class="fab fa-python card-icon"></i>
                </div>
                <div class="card-content">
                    <h2>Python</h2>
                    <p>Cú pháp, logic, và các ứng dụng thực tế của Python.</p>
                </div>
                <span class="btn-start">Bắt đầu ngay <i class="fas fa-chevron-right"></i></span>
            </a>
            <a href="{{ route('quizcpp.index') }}" class="quiz-card cpp">
                <div class="card-icon-container">
                    <i class="fab fa-cuttlefish card-icon"></i>
                </div>
                <div class="card-content">
                    <h2>C++</h2>
                    <p>Cấu trúc, hàm, hướng đối tượng và các bài toán hiệu suất cao.</p>
                </div>
                <span class="btn-start">Bắt đầu ngay <i class="fas fa-chevron-right"></i></span>
            </a>
            <a href="{{ route('quizjavascript.index') }}" class="quiz-card javascript">
                <div class="card-icon-container">
                    <i class="fab fa-js-square card-icon"></i>
                </div>
                <div class="card-content">
                    <h2>Javascript</h2>
                    <p>Biến, hàm, DOM và các kỹ thuật xây dựng trang web tương tác.</p>
                </div>
                <span class="btn-start">Bắt đầu ngay <i class="fas fa-chevron-right"></i></span>
            </a>
        </main>
    </div>
</body>
</html>