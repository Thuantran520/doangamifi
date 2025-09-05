
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Game: Điều khiển Robot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/robot-game.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon_io/favicon-32x32.png') }}">
</head>
<body>
    <div class="game-container">
        <div class="game-header">
            <h1><i class="fas fa-robot"></i> Điều khiển Robot</h1>
            <div class="score-container">
                <i class="fas fa-star"></i> Điểm: <span id="score-display">{{ auth()->user()->score->score ?? 0 }}</span>
            </div>
            <a href="{{ route('launcher') }}" class="btn-back">Về trang chủ</a>
        </div>

        <div class="level-selector-container">
            <label for="level-selector">Chọn màn chơi:</label>
            <select id="level-selector">
                <option value="0">Màn 1: Cơ bản</option>
                <option value="1">Màn 2: Chướng ngại vật</option>
                <option value="2">Màn 3: Thử thách</option>
                <option value="random">Ngẫu nhiên (Tính điểm)</option>
            </select>
        </div>

        <div class="game-layout">
            <div class="game-grid-container">
                <div id="game-grid"></div>
            </div>
            <div class="game-editor-container">
                {{-- KHU VỰC HƯỚNG DẪN MỚI --}}
                <div class="instructions-container">
                    <div class="instruction-item">
                        <button class="accordion-toggle active">
                            <span><i class="fas fa-book-open"></i> Hướng dẫn chơi</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="accordion-content" style="max-height: 500px; padding: 15px 18px;">
                            <p><strong>Mục tiêu:</strong> Viết mã JavaScript để điều khiển robot 🤖 đến viên kim cương 💎.</p>
                            <h4>Các lệnh điều khiển:</h4>
                            <ul>
                                <li><code>await robot.move()</code>: Di chuyển robot tiến 1 bước.</li>
                                <li><code>await robot.move(n)</code>: Di chuyển robot tiến <strong>n</strong> bước.</li>
                                <li><code>await robot.turnLeft()</code>: Quay robot sang trái 90 độ.</li>
                                <li><code>await robot.turnRight()</code>: Quay robot sang phải 90 độ.</li>
                                <li><code>await robot.turnAround()</code>: Quay robot 180 độ.</li>
                            </ul>
                            <p><strong>Quan trọng:</strong> Luôn thêm từ khóa <code>await</code> trước mỗi lệnh của robot.</p>
                            <p><strong>Nâng cao:</strong> Bạn có thể dùng vòng lặp <code>for</code>, <code>while</code> và câu lệnh <code>if/else</code>.</p>
                        </div>
                    </div>

                    <div class="instruction-item">
                        <button class="accordion-toggle">
                            <span><i class="fas fa-star"></i> Thể lệ tính điểm</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="accordion-content">
                            <ul>
                                <li>Chỉ có các màn chơi <strong>"Ngẫu nhiên"</strong> mới được tính điểm.</li>
                                <li>Mỗi khi hoàn thành một màn chơi ngẫu nhiên, bạn sẽ nhận được <strong>10 điểm</strong>.</li>
                                <li>Các màn chơi còn lại dùng để luyện tập và <strong>không được cộng điểm</strong>.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <textarea id="code-editor" rows="10">
// Viết code của bạn ở đây
// Ví dụ sử dụng vòng lặp for:
for (let i = 0; i < 5; i++) {
    await robot.move();
}
await robot.turnRight();
await robot.move(5);
                </textarea>
                <div class="editor-controls">
                    <button id="run-btn">Chạy Code</button>
                    <button id="reset-btn">Chơi lại</button>
                </div>
                <div id="message-box"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/robot-game.js') }}"></script>
</body>
</html>