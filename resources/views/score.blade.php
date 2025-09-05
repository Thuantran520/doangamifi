
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Bảng xếp hạng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon_io/favicon-32x32.png') }}">
</head>
<body>
<div class="leaderboard-container">
    <div class="page-header">
        <h1><i class="fas fa-trophy"></i> Bảng Xếp Hạng</h1>
        <a href="{{ route('launcher') }}" class="btn-back"><i class="fas fa-rocket"></i> Về trang chủ</a>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>Hạng</th>
                <th>Người chơi</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            @if($topUsers->count() > 0)
                @foreach($topUsers as $index => $score)
                    {{-- Làm nổi bật người dùng hiện tại --}}
                    <tr class="{{ (Auth::check() && Auth::id() == $score->user->id) ? 'current-user' : '' }}">
                        <td class="rank">
                            {{-- Tính thứ hạng dựa trên trang hiện tại --}}
                            {{ $topUsers->firstItem() + $index }}
                        </td>
                        <td class="player">
                            <img src="{{ $score->user->avatar ? asset('storage/'.$score->user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar">
                            <span>{{ $score->user->name }}</span>
                        </td>
                        <td class="score">{{ $score->score }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" style="text-align: center; padding: 20px;">Chưa có ai trên bảng xếp hạng.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Hiển thị phân trang --}}
    <div class="pagination-container">
        {{ $topUsers->links('pagination::bootstrap-5') }}
    </div>
</div>
</body>
</html>
