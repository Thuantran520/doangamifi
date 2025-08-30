
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hồ sơ cá nhân</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
</head>
<body>
  <div class="profile-page">
    <div class="page-header">
        <a href="{{ route('launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay về trang chủ</a>
    </div>

    <div class="profile-container">
        <div class="profile-card">
            <h1><i class="fas fa-user-circle"></i> Hồ sơ cá nhân</h1>
            @if(isset($user))
            <form action="{{ route('user.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-body">
                    <div class="avatar-section">
                        <img id="avatarPreview" src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}" alt="Ảnh đại diện">
                        <label for="avatarInput" class="avatar-edit-button">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
                    </div>

                    <div class="info-section">
                        <div class="info-group">
                            <label><i class="fas fa-user"></i> Họ tên</label>
                            <p id="nameDisplay">{{ $user->name }}</p>
                            <input type="text" id="nameInput" name="name" value="{{ $user->name }}" class="form-control hidden">
                        </div>
                        <div class="info-group">
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <p id="emailDisplay">{{ $user->email }}</p>
                            <input type="email" id="emailInput" name="email" value="{{ $user->email }}" class="form-control hidden">
                        </div>
                        <div class="info-group">
                            <label><i class="fas fa-phone"></i> Số điện thoại</label>
                            <p id="phoneDisplay">{{ $user->phone ?? 'Chưa cập nhật' }}</p>
                            <input type="text" id="phoneInput" name="phone" value="{{ $user->phone }}" class="form-control hidden">
                        </div>
                    </div>
                </div>
                <div class="profile-footer">
                    <button id="editBtn" type="button" class="btn btn-secondary"><i class="fas fa-edit"></i> Chỉnh sửa</button>
                    <button id="saveBtn" type="submit" class="btn btn-primary hidden"><i class="fas fa-save"></i> Lưu thay đổi</button>
                    <button id="cancelBtn" type="button" class="btn btn-light hidden"><i class="fas fa-times"></i> Hủy</button>
                </div>
            </form>
            @else
            <p>Không tìm thấy thông tin người dùng.</p>
            @endif
        </div>
    </div>
  </div>
  <script src="{{ asset('dashboard.js') }}"></script>
</body>
</html>
