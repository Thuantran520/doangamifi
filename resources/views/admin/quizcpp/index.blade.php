
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý câu hỏi Quiz C++ (Admin)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@php use Illuminate\Support\Str; @endphp
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Quản lý câu hỏi Quiz C++</h2>
        <a href="{{ route('admin.quizcpp.create') }}" class="btn btn-primary">Thêm câu hỏi mới</a>
    </div>

    <form class="mb-3" method="GET" action="{{ route('admin.quizcpp.index') }}">
        <div class="input-group">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Tìm theo nội dung câu hỏi...">
            <button class="btn btn-outline-secondary" type="submit">Tìm</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Nội dung</th>
                        <th style="width:200px;">Đáp án đúng</th>
                        <th style="width:160px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ Str::limit($item->question_text, 120) }}</td>
                            <td>
                                @php
                                    $map = ['a' => $item->option_a, 'b' => $item->option_b, 'c' => $item->option_c, 'd' => $item->option_d];
                                @endphp
                                <strong>{{ strtoupper($item->correct_answer) }}.</strong> {{ $map[$item->correct_answer] ?? '-' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.quizcpp.show', ['quizcpp' => $item->id]) }}" class="btn btn-sm btn-info">Xem</a>
                                <a href="{{ route('admin.quizcpp.edit', ['quizcpp' => $item->id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.quizcpp.destroy', ['quizcpp' => $item->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav>
            {{ $items->links('pagination::bootstrap-5') }}
        </nav>
        <a href="{{ route('admin.launcher') }}" class="btn btn-secondary mt-3">Quay lại trang quản trị</a>
    @else
        <div class="alert alert-secondary">Chưa có câu hỏi nào.</div>
    @endif
</div>
</body>
</html>