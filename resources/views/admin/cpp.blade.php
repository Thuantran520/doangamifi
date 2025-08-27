<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý bài học C++</title>
  <link rel="stylesheet" href="{{ asset('Adminlesson/Adminlesson.css') }}">
</head>
<body>
  <a href="{{ route('admin.lesson') }}" class="back-btn">← Quay lại</a>
  <div class="container">
    <h1>Quản lý bài học C++</h1>
    <a href="{{ route('admin.cpp.create') }}" class="btn-action btn-add" style="margin-bottom:18px; display:inline-block;">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;">
        <circle cx="9" cy="9" r="8" stroke="currentColor" stroke-width="2" fill="none"/>
        <path d="M9 5v8M5 9h8" stroke="currentColor" stroke-width="2"/>
      </svg>
      Thêm bài học mới
    </a>
    <table class="lesson-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tiêu đề</th>
          <th>Nội dung</th>
          <th>Ngày cập nhật</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cpp as $lesson)
        <tr>
          <td>{{ $lesson->lesson_id }}</td>
          <td>{{ $lesson->title }}</td>
          <td>{{ Str::limit($lesson->content, 50) }}</td>
          <td>{{ $lesson->updated_date }}</td>
          <td>
            <a href="{{ route('admin.cpp.edit', $lesson->lesson_id) }}" class="btn-action btn-edit" title="Chỉnh sửa">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;">
                <path d="M12.5 3.5l2 2a2 2 0 010 2.8l-7.5 7.5a2 2 0 01-1.4.6H3v-2.1a2 2 0 01.6-1.4l7.5-7.5a2 2 0 012.8 0z"/>
              </svg>
              Sửa
            </a>
            <form action="{{ route('admin.cpp.destroy', $lesson->lesson_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-action btn-delete">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;">
                  <path d="M6 6v6m6-6v6M4 4h10M5 4V3a1 1 0 011-1h6a1 1 0 011 1v1M4 4v11a2 2 0 002 2h6a2 2 0 002-2V4"/>
                </svg>
                Xóa
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div id="delete-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); align-items:center; justify-content:center;">
    <div style="background:#fff; padding:24px; border-radius:8px; min-width:300px; box-shadow:0 2px 8px rgba(0,0,0,0.12); text-align:center;">
      <h3>Bạn có chắc chắn muốn xóa bài học này?</h3>
      <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete" style="margin-right:8px;">Xác nhận xóa</button>
        <button type="button" onclick="hideDeleteModal()">Hủy</button>
      </form>
    </div>
  </div>
</body>
</html>
<script src="{{ asset('Adminlesson/Adminlesson.js') }}"></script>