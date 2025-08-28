<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gamification</title>
  <link rel="stylesheet" href="{{asset('launcher.css')}}">
</head>
<body>
  <!-- Header -->
  <header class="navbar">
    <div class="logo">Gamification</div>
    <nav class="nav-links">
      @auth
      <a href="{{ route('lesson') }}">Nội dung bài học</a>
      <a href="{{ route('practice') }}">Các bài thực hành của tôi</a>
      <a href="{{ route('choose.quiz') }}">Bài trắc nghiệm</a>
      @endauth
      @guest
        <h3> Vui lòng đăng nhập để tiếp tục </h3>
      @endguest
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
          <li>
            @if(Auth::check()&& Auth::user()-> role=== 'admin')
              <a href="{{route('admin.launcher')}}">Quản lý người dùng</a>
            @else
              <a href="{{route('dashboard')}}">Hồ sơ cá nhân</a>
            @endif
          </li>
        </ul>
      </div>
    @endguest
    </div>
  </header>

  <!-- Nội dung chính -->
  <main class="content">
    <h1>Chào mừng đến với Gamification</h1>
    <p>Đây là phần nội dung bài học. Bạn có thể thêm chi tiết tại đây.</p>
  </main>

  <script src="{{asset('launcher.js')}}"></script>
</body>
</html>
