<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hồ sơ cá nhân</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
  <div class="profile-page">
    <div class="page-header">
        <a href="{{ route('launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay về trang chủ</a>
    </div>

    <div class="profile-container">
        @if(isset($user))
            <div class="profile-card">
                <h1><i class="fas fa-user-circle"></i> Hồ sơ cá nhân</h1>
                <form action="{{ route('user.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-body">
                        <div class="avatar-section">
                            <img id="avatarPreview" src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}" alt="Ảnh đại diện">
                            <label for="avatarInput" class="avatar-edit-button hidden">
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
            </div>

            {{-- === PHẦN GAMIFICATION ĐÃ SỬA LẠI === --}}
            <div class="gamification-stats">
                <div class="stat-card">
                    <h3><i class="fas fa-star"></i> Tổng điểm</h3>
                    {{-- Dùng $user thay vì Auth::user() --}}
                    <p class="total-score">{{ $user->score->score ?? 0 }}</p>
                </div>

                <div class="stat-card">
                    <h3><i class="fas fa-medal"></i> Huy hiệu đã đạt được</h3>
                    <div class="badges-collection">
                        {{-- Dòng này lấy tất cả huy hiệu mà user đang có --}}
                        @forelse($user->badges as $badge)
                            {{-- Với mỗi huy hiệu, nó hiển thị ảnh và tên --}}
                            <div class="badge-item" title="{{ $badge->description }}">
                                <img src="{{ asset('images/badges/' . $badge->icon) }}" alt="{{ $badge->name }}">
                                <span>{{ $badge->name }}</span>
                            </div>
                        @empty
                            {{-- Nếu user chưa có huy hiệu nào, hiển thị dòng này --}}
                            <p class="no-items">Chưa có huy hiệu nào.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="recent-activity-card">
                <h3><i class="fas fa-history"></i> Lịch sử làm bài gần đây</h3>
                <ul class="list-group">
                    {{-- Dùng $user thay vì Auth::user() --}}
                    @forelse($user->quizAttempts->take(5) as $attempt)
                        <li class="list-group-item">
                            Làm bài <strong>{{ ucfirst($attempt->quiz_type) }}</strong> - {{ $attempt->created_at->diffForHumans() }}
                            <span class="float-end"><strong>{{ $attempt->score }}/{{ $attempt->max_score }}</strong> điểm</span>
                        </li>
                    @empty
                        <li class="list-group-item">Chưa có hoạt động nào.</li>
                    @endforelse
                </ul>
                <div class="text-center mt-3">
                    <a href="{{ route('attempts.index') }}" class="btn btn-light">Xem tất cả lịch sử</a>
                </div>
            </div>
        @else
            <div class="profile-card">
                <p>Không tìm thấy thông tin người dùng.</p>
            </div>
        @endif
    </div>
  </div>
  <script src="{{ asset('dashboard.js') }}"></script>
</body>
</html>
