
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bài học</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/lesson.css') }}">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="{{ route('admin.launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại Bảng điều khiển</a>
            <h1><i class="fas fa-book-open"></i> Quản lý Bài học</h1>
            <p>Chọn một danh mục để thêm, sửa hoặc xóa bài học.</p>
        </header>

        <main class="lesson-grid">
            <div class="lesson-card python">
                <div class="card-icon-container">
                    <i class="fab fa-python card-icon"></i>
                </div>
                <h2>Python</h2>
                <p>Quản lý các bài học và nội dung liên quan đến Python.</p>
                <a href="{{ route('admin.python.index') }}" class="btn-manage">Quản lý ngay</a>
            </div>
            <div class="lesson-card cpp">
                <div class="card-icon-container">
                    <i class="fab fa-cuttlefish card-icon"></i>
                </div>
                <h2>C++</h2>
                <p>Quản lý các bài học và nội dung liên quan đến C++.</p>
                <a href="{{ route('admin.cpp.index') }}" class="btn-manage">Quản lý ngay</a>
            </div>
            <div class="lesson-card javascript">
                <div class="card-icon-container">
                    <i class="fab fa-js-square card-icon"></i>
                </div>
                <h2>Javascript</h2>
                <p>Quản lý các bài học và nội dung liên quan đến Javascript.</p>
                <a href="{{ route('admin.javascript.index') }}" class="btn-manage">Quản lý ngay</a>
            </div>
        </main>
    </div>
</body>
</html>