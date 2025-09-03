
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Trình biên dịch Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('practice.css') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
</head>
<body>
    <div class="compiler-container">
        <header class="page-header">
            <a href="{{ route('launcher') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay về trang chủ</a>
            <h1><i class="fas fa-code"></i> Trình biên dịch Online</h1>
        </header>

        <main class="compiler-main">
            <div class="compiler-panel">
                <div class="panel-header">
                    <div class="language-selector">
                        <label for="languageSelect"><i class="fas fa-laptop-code"></i> Ngôn ngữ</label>
                        <select id="languageSelect">
                            <option value="python">Python</option>
                            <option value="cpp">C++</option>
                            <option value="javascript">JavaScript (Node.js)</option>
                        </select>
                    </div>
                    <div class="panel-actions">
                        <button id="runBtn" class="btn btn-run"><i class="fas fa-play"></i> Chạy (Ctrl+Enter)</button>
                        <button id="clearBtn" class="btn btn-clear"><i class="fas fa-broom"></i> Xóa kết quả</button>
                    </div>
                </div>
                <div class="code-area">
                    <textarea
                        id="codeEditor"
                        spellcheck="false"
                        placeholder="print('Hello, World!')"
                        autocomplete="off"
                        autocorrect="off"
                        autocapitalize="off"
                    ></textarea>
                </div>
            </div>

            <div class="output-panel">
                <div class="panel-header">
                    <h3><i class="fas fa-terminal"></i> Kết quả</h3>
                </div>
                <div class="output-area-container">
                    <pre id="outputArea"></pre>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('practice.js') }}"></script>
</body>
</html>
