<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamification - Học lập trình qua thử thách</title>
    <link rel="stylesheet" href="{{ asset('css/launcher-v2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
    <!-- Header -->
    <header class="navbar">
        <div class="container">
            <a href="{{ route('launcher') }}" class="logo">GamifyLearn</a>
            <nav class="nav-links">
                @auth
                    <a href="{{ route('lesson') }}">Bài học</a>
                    <a href="{{ route('practice') }}">Thực hành</a>
                    <a href="{{ route('choose.quiz') }}">Trắc nghiệm</a>
                    <a href="{{ route('leaderboard.index') }}">Xếp hạng</a>
                @endauth
            </nav>
            <div class="user-actions">
                @guest
                    <a href="{{ route('login.form') }}" class="btn btn-secondary">Đăng nhập</a>
                    <a href="{{ route('register.form') }}" class="btn btn-primary">Đăng ký</a>
                @else
                    <div class="user-menu">
                        <button id="user-menu-toggle" class="user-menu-button">
                            <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="avatar">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="user-dropdown" class="dropdown-menu hidden">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.launcher') }}"><i class="fas fa-shield-halved"></i> Trang quản trị</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a href="{{ route('dashboard') }}"><i class="fas fa-user-circle"></i> Hồ sơ cá nhân</a>
                            <a href="{{ route('attempts.index') }}"><i class="fas fa-history"></i> Lịch sử làm bài</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-button"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Nội dung chính -->
    <main class="content">
        <!-- Hero Section được làm mới -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    {{-- Cột văn bản --}}
                    <div class="hero-text">
                        <h1 class="hero-title">Nâng Tầm Kỹ Năng Lập Trình</h1>
                        <p class="hero-subtitle">Học, thực hành và chinh phục các thử thách code thông qua một nền tảng được game hoá.</p>
                        @auth
                            <a href="{{ route('lesson') }}" class="btn-cta">Bắt đầu ngay <i class="fas fa-arrow-right"></i></a>
                        @else
                            <a href="{{ route('register.form') }}" class="btn-cta">Tham gia miễn phí <i class="fas fa-user-plus"></i></a>
                        @endguest
                    </div>
                    {{-- Cột hình ảnh minh họa --}}
                    <div class="hero-image">
                        {{-- SVG illustration from unDraw (https://undraw.co/illustrations) - MIT License --}}
                        <svg width="100%" height="100%" viewBox="0 0 591 498" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M590.23 220.51C590.23 220.51 590.23 497.11 590.23 497.11C590.23 497.11 295.23 497.11 295.23 497.11C295.23 497.11 295.23 220.51 295.23 220.51C295.23 220.51 590.23 220.51 590.23 220.51Z" fill="#6C63FF"/>
                            <path d="M532.73 220.51H352.73V497.11H532.73V220.51Z" fill="#4F46E5"/>
                            <path d="M590.23 497.11H295.23L352.73 439.61H590.23V497.11Z" fill="#333333"/>
                            <path d="M442.73 163.01C469.245 163.01 490.73 141.525 490.73 115.01C490.73 88.4951 469.245 67.0101 442.73 67.0101C416.215 67.0101 394.73 88.4951 394.73 115.01C394.73 141.525 416.215 163.01 442.73 163.01Z" fill="#FFD700"/>
                            <path d="M442.73 152.11C463.285 152.11 480.03 135.365 480.03 114.81C480.03 94.2551 463.285 77.5101 442.73 77.5101C422.175 77.5101 405.43 94.2551 405.43 114.81C405.43 135.365 422.175 152.11 442.73 152.11Z" fill="#FFC700"/>
                            <path d="M1.34998 205.51L147.73 0.51001H294.11L147.73 205.51H1.34998Z" fill="#6C63FF"/>
                            <path d="M147.73 205.51L294.11 0.51001V115.01L147.73 320.01V205.51Z" fill="#4F46E5"/>
                            <path d="M147.73 497.11L1.34998 292.11V406.61L147.73 497.11Z" fill="#333333"/>
                            <path d="M147.73 497.11L1.34998 406.61L147.73 320.01V497.11Z" fill="#4F46E5"/>
                            <path d="M442.73 249.26C442.73 249.26 383.48 345.51 383.48 345.51C383.48 345.51 501.98 345.51 501.98 345.51C501.98 345.51 442.73 249.26 442.73 249.26Z" fill="#FFFFFF"/>
                            <path d="M442.73 268.01C442.73 268.01 394.73 345.51 394.73 345.51H490.73C490.73 345.51 442.73 268.01 442.73 268.01Z" fill="#E0E0E0"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <h2 class="section-title">Khám phá các tính năng</h2>
                <div class="feature-cards">
                    <div class="card">
                        <i class="fas fa-book-open card-icon"></i>
                        <h3 class="card-title">Bài học chuyên sâu</h3>
                        <p class="card-text">Truy cập các bài giảng chi tiết về Python, C++, và JavaScript.</p>
                        <a href="{{ route('lesson') }}" class="card-link">Xem bài học</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-keyboard card-icon"></i>
                        <h3 class="card-title">Thực hành thực tế</h3>
                        <p class="card-text">Áp dụng kiến thức đã học vào các bài tập thực hành của riêng bạn.</p>
                        <a href="{{ route('practice') }}" class="card-link">Luyện tập</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-trophy card-icon"></i>
                        <h3 class="card-title">Trắc nghiệm thử thách</h3>
                        <p class="card-text">Kiểm tra và củng cố kiến thức qua các bài quiz đầy thử thách.</p>
                        <a href="{{ route('choose.quiz') }}" class="card-link">Làm bài quiz</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-medal card-icon"></i>
                        <h3 class="card-title">Bảng xếp hạng</h3>
                        <p class="card-text">Xem vị trí của bạn trên bảng xếp hạng và so tài với những người khác.</p>
                        <a href="{{ route('leaderboard.index') }}" class="card-link">Xem bảng xếp hạng</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-robot card-icon"></i>
                        <h3 class="card-title">Game: Điều khiển Robot</h3>
                        <p class="card-text">Học JavaScript cơ bản bằng cách ra lệnh cho robot di chuyển.</p>
                        <a href="{{ route('game.robot') }}" class="card-link">Bắt đầu chơi</a>
                    </div>
                    <div class="card">
                        <i class="fas fa-sort card-icon"></i>
                        <h3 class="card-title">Game: Thử thách Sắp xếp</h3>
                        <p class="card-text">Sắp xếp các con số theo thứ tự tăng dần bằng các phép hoán đổi.</p>
                        <a href="{{ route('game.sort') }}" class="card-link">Bắt đầu chơi</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('launcher.js') }}"></script>
</body>
</html>
