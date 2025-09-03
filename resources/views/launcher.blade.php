<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gamification - Học lập trình qua thử thách</title>
  <link rel="stylesheet" href="{{asset('launcher.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
  <!-- Header -->
  <header class="navbar">
    <div class="logo">Gamification</div>
    <nav class="nav-links">
      @auth
      <a href="{{ route('lesson') }}">Nội dung bài học</a>
      <a href="{{ route('practice') }}">Thực hành</a>
      <a href="{{ route('choose.quiz') }}">Bài trắc nghiệm</a>
      @endauth
    </nav>
    <div class="user-actions">
      @guest
      <button class="auth-btn" onclick="window.location.href='{{route('login.form')}}'">Đăng nhập</button>
      <button class="auth-btn" onclick="window.location.href='{{route('register.form')}}'">Đăng ký</button>
      @else
       <span class="username">Xin chào, {{ Auth::user()->name }}</span>
       <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button type="submit" class="auth-btn">Đăng xuất</button>
        </form>
      <div class="user-menu">
        <button id="menuToggle" class="menu-btn">☰</button>
        <ul id="dropdownMenu" class="dropdown hidden">
          @if(Auth::check() && Auth::user()->role === 'admin')
            <li><a href="{{route('admin.launcher')}}">Quản lý người dùng</a></li>
            <li><a href="{{route('dashboard')}}">Thông tin người dùng</a></li>
            <li><a href="{{route('attempts.index')}}">Lịch sử làm bài</a></li>
          @else
            <li><a href="{{route('dashboard')}}">Hồ sơ cá nhân</a></li>
            <li><a href="{{route('attempts.index')}}">Lịch sử làm bài</a></li>
          @endif
        </ul>
      </div>
    @endguest
    </div>
  </header>

  <!-- Nội dung chính -->
  <main class="content">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Nâng tầm kỹ năng lập trình của bạn</h1>
            <p class="hero-subtitle">Học, thực hành và chinh phục các thử thách code qua các bài trắc nghiệm tương tác.</p>
            @auth
                <a href="{{ route('lesson') }}" class="btn-cta">Bắt đầu học ngay</a>
            @else
                <a href="{{ route('login.form') }}" class="btn-cta">Tham gia ngay</a>
            @endguest
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
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
        </div>
    </section>
  </main>

  <script src="{{asset('launcher.js')}}"></script>
</body>
</html>
