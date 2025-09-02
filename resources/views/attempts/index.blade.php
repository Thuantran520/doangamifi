<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Lịch sử làm bài</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('attempts.css') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
<div class="attempts-container">
    <div class="page-header">
        <h1><i class="fas fa-history"></i> Lịch sử làm bài</h1>
        <a href="{{ route('launcher') }}" class="btn"><i class="fas fa-rocket"></i> Về trang chủ</a>
    </div>

    @if($attempts->count())
        <table class="content-table">
            <thead>
                <tr>
                    <th>Ngày làm</th>
                    <th>Loại Quiz</th>
                    <th>Điểm</th>
                    <th>Kết quả</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attempts as $a)
                <tr>
                    <td>{{ $a->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($a->quiz_type == 'Python')
                            <span class="quiz-badge python"><i class="fab fa-python"></i> Python</span>
                        @elseif($a->quiz_type == 'C++')
                            <span class="quiz-badge cpp"><i class="fab fa-cuttlefish"></i> C++</span>
                        @elseif($a->quiz_type == 'Javascript')
                            <span class="quiz-badge javascript"><i class="fab fa-js-square"></i> Javascript</span>
                        @else
                            {{ $a->quiz_type }}
                        @endif
                    </td>
                    <td><strong>{{ $a->score }} / {{ $a->max_score }}</strong></td>
                    <td>
                        @if($a->passed)
                            <span class="badge badge-success">Đạt</span>
                        @else
                            <span class="badge badge-danger">Chưa đạt</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $attempts->links() }}
        </div>
    @else
        <p>Bạn chưa có lịch sử làm bài nào.</p>
    @endif
</div>
</body>
</html>