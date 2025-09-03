
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Quiz Python</title>
    <link rel="stylesheet" href="{{ asset('admin/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
@php use Illuminate\Support\Str; @endphp

<div class="admin-container">
    <div class="page-header">
        <h1><i class="fab fa-python"></i> Quản lý Quiz Python</h1>
        <div>
            <a href="{{ route('admin.launcher') }}" class="back-btn" style="margin-right: 15px;"><i class="fas fa-arrow-left"></i> Quay lại</a>
            <a href="{{ route('admin.quizpython.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm câu hỏi</a>
        </div>
    </div>

    <div class="table-controls">
        <form method="GET" action="{{ route('admin.quizpython.index') }}" class="search-form">
            <input type="text" name="q" placeholder="Tìm kiếm câu hỏi..." value="{{ request('q') }}" class="search-input">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Chưa có câu hỏi nào cho Python.
        </div>
    @else
        <table class="content-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Nội dung câu hỏi</th>
                    <th>Đáp án đúng</th>
                    <th width="25%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ Str::limit($item->question_text, 100) }}</td>
                        <td>
                            @php
                                $map = ['a' => $item->option_a, 'b' => $item->option_b, 'c' => $item->option_c, 'd' => $item->option_d];
                            @endphp
                            <strong>{{ strtoupper($item->correct_answer) }}.</strong> {{ Str::limit($map[$item->correct_answer] ?? '-', 50) }}
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.quizpython.show', $item->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> Xem</a>
                                <a href="{{ route('admin.quizpython.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i> Sửa</a>
                                <form action="{{ route('admin.quizpython.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn câu hỏi này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $items->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
</body>
</html>