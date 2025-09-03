
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý bài học C++</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('admin/admin.css') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
<div class="admin-container">
    <div class="page-header">
        {{-- Sửa icon, tiêu đề và route cho C++ --}}
        <h1><i class="fab fa-cuttlefish"></i> Quản lý bài học C++</h1>
        <div>
            <a href="{{ route('admin.lesson') }}" class="back-btn" style="margin-right: 15px;"><i class="fas fa-arrow-left"></i> Quay lại</a>
            <a href="{{ route('admin.cpp.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm bài học</a>
        </div>
    </div>

    <table class="content-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tiêu đề</th>
          <th>Nội dung (rút gọn)</th>
          <th width="25%">Hành động</th>
        </tr>
      </thead>
      <tbody>
        {{-- Sửa biến lặp cho C++ --}}
        @forelse($cpp as $lesson)
        <tr>
          <td>{{ $lesson->lesson_id }}</td>
          <td>{{ $lesson->title }}</td>
          <td>{{ Str::limit($lesson->content, 70) }}</td>
          <td>
            <div class="table-actions">
      
                {{-- Sửa route cho C++ --}}
                <a href="{{ route('admin.cpp.edit', $lesson->lesson_id) }}" class="btn btn-edit">
                  <i class="fas fa-edit"></i> Sửa
                </a>
                <form action="{{ route('admin.cpp.destroy', $lesson->lesson_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Xóa
                  </button>
                </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align: center; padding: 20px;">Chưa có bài học nào.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
</div>

<!-- Modal để xem nội dung -->
<div id="contentModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 id="modalTitle"></h2>
      <span class="close-btn" onclick="closeContentModal()">&times;</span>
    </div>
    <div class="modal-body" id="modalBody"></div>
  </div>
</div>

<script>
    var modal = document.getElementById("contentModal"), modalTitle = document.getElementById("modalTitle"), modalBody = document.getElementById("modalBody");
    function showContentModal(title, content) { modalTitle.innerText = title; modalBody.innerHTML = content.replace(/\n/g, '<br>'); modal.style.display = "block"; }
    function closeContentModal() { modal.style.display = "none"; }
    window.onclick = function(event) { if (event.target == modal) closeContentModal(); }
</script>
</body>
</html>