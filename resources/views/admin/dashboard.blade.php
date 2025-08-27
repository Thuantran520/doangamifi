<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hồ sơ cá nhân</title>
  <link rel="stylesheet" href="{{ asset('admin/dashboard.css') }}">
</head>
<body>
  <!-- út đăng xuất -->
   <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="back-btn">Đăng xuất</button>
    </form>
    <a href="{{ route('admin.launcher') }}" class="back-btn">← Quay lại launcher</a>
  <div class="profile-container">
    <h1>Danh sách người dùng</h1>
    @if(isset($users) && count($users))
        <table border="1" cellpadding="5" style="width:100%; text-align:center;">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Role</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" width="50">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có người dùng nào.</p>
    @endif
</div>
  <script src="{{asset('dashboard.js')}}"></script>
</body>
</html>
