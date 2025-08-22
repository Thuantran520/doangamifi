<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hồ sơ cá nhân</title>
  <link rel="stylesheet" href="{{asset('dashboard.css')}}">
</head>
<body>
  <!-- Nút quay về -->
  <button id="backBtn" class="back-btn">← Quay về</button>

  <div class="profile-container">
    <h1>Hồ sơ cá nhân</h1>
    @if(asset($user))
    <form action="{{ route('user.update')}}" method="POST" enctype="multipart/form-data">
        <div class="avatar-section">
        <img id="avatarPreview" src="{{asset('storage/'.$user->avatar)}}" alt="Ảnh đại diện">
        <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
        </div>

        <div class="info-section">
        <p><strong>Họ tên:</strong> <span id="name"> {{ $user->name }}</span></p>
        <p><strong>Gmail:</strong> <span id="gmail"> {{ $user->email }}</span></p>
        <div id="editSection" class="hidden">
            @csrf
            <label for="nameInput">Cập nhật Họ tên:</label>
            <input type="text" id="nameInput" name="name" value="{{ $user->name }}">

            <label for="gmailInput">Cập nhật Gmail:</label>
            <input type="email" id="gmailInput" name="email" value="{{ $user->email }}">

            <label for="phoneInput">Cập nhật Số điện thoại:</label>
            <input type="text" id="phoneInput" name="phone" value="{{ $user->phone }}">
        </div>
      <div class="btn-group">
        <button id="editBtn" type="button">Thay đổi</button>
        <button id="saveBtn" class="hidden">Lưu</button>
        <button id="cancelBtn" class="hidden">Hủy</button>
      </div>
    </form>
    @endif
    </div>
  </div>
  <script src="{{asset('dashboard.js')}}"></script>
</body>
</html>
