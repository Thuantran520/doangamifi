<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thực hành lập trình C++</title>
  <link rel="stylesheet" href="{{ asset('practice.css') }}" />
</head>
<body>
  <div class="container">
    <div class="header-bar">
      
    </div>

    <h1 class="page-title">Compiler</h1>
    <div class="content">
      <main class="exercise-detail">
        <label for="codeEditor" class="section-title">Viết code:</label>
        <label for="languageSelect" class="section-title">Chọn ngôn ngữ:</label>
        <select id="languageSelect">
          <option value="cpp">C++</option>
          <option value="python">Python</option>
          <option value="javascript">JavaScript</option>
        </select>

        <textarea
          id="codeEditor"
          spellcheck="false"
          placeholder="write your code here..."
          autocomplete="off"
          autocorrect="off"
          autocapitalize="off"
        ></textarea>

        <div class="btn-row">
          <button id="runBtn" class="btn run">▶ Chạy thử</button>
          <button id="clearBtn" class="btn ghost">🧹 Xóa kết quả</button>
        </div>

        <h3 class="section-title">Kết quả:</h3>
        <pre id="outputArea" class="output"></pre>
        <a href="{{ route('launcher') }}" class="btn btn-secondary mt-3">Quay về trang chủ</a>
      </main>
    </div>
  </div>

  <script src="{{ asset('practice.js') }}"></script>
</body>
</html>
