<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Đăng nhập - Gamification</title>
  <link rel="stylesheet" href="{{ asset('login.css') }}" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="container">
    <form id="loginForm" class="form-box active" method="POST" action="{{ route('login.post') }}">
        @csrf
        <h2 class="form-title">Đăng nhập tài khoản</h2>

        <input type="email"    id="loginUsername" name="email"    class="input-field" placeholder="Email" required />
        <input type="password" id="loginPassword" name="password" class="input-field" placeholder="Mật khẩu" required />

        <button type="submit" class="btn-login">Đăng nhập</button>
        <p class="switch-text">
            Bạn chưa có tài khoản?
            <a href="{{ route('register') }}" class="switch-link">Đăng ký</a>
        </p>
    </form>
  </div>
</body>
</html>
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Có lỗi xảy ra',
            html: '{!! implode('<br>', $errors->all()) !!}', // xuong dong moi loi
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            html: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
