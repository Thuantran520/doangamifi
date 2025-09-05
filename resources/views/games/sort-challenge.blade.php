
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Game: Sort Challenge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Link tới file CSS mới --}}
    <link rel="stylesheet" href="{{ asset('css/sort-challenge.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon_io/favicon-32x32.png') }}">
</head>
<body>
<div class="container">
    <header class="sc-header">
        <h1><i class="fas fa-sort-amount-up"></i> SORT CHALLENGE</h1>
        <div class="header-actions">
            <div class="score-box">
                <i class="fas fa-star"></i>
                <span>Điểm: </span>
                <strong id="global-score">{{ auth()->user()->score->score ?? 0 }}</strong>
            </div>
            <a href="{{ route('launcher') }}" class="back-link"><i class="fas fa-home"></i> Trang chủ</a>
        </div>
    </header>

    <div class="game-area">
        {{-- Cột bên trái --}}
        <div class="game-controls">
            <section class="panel array-panel">
                <div class="panel-header">
                    <h2><i class="fas fa-cubes"></i> Mảng cần sắp xếp</h2>
                    {{-- Thanh thông số mới --}}
                    <div id="stats-bar">
                        <span title="Số phần tử">N: <strong id="stat-n">?</strong></span>
                        <span title="Số thao tác đã dùng">Lượt: <strong id="stat-ops">0</strong></span>
                        <span title="Điểm dự kiến">Điểm: <strong id="stat-score">?</strong></span>
                    </div>
                </div>
                <div id="array-container"></div>
                <button id="shuffle-btn" class="btn btn-secondary"><i class="fas fa-random"></i> Mảng mới</button>
            </section>

            <section class="panel code-panel">
                <div class="panel-header">
                    <h2><i class="fas fa-code"></i> Viết lệnh của bạn</h2>
                </div>
                <div class="instructions">
                    <p>Sử dụng các lệnh (mỗi lệnh một dòng):</p>
                    <ul>
                        <li><code>compare(i, j)</code> - So sánh hai phần tử.</li>
                        <li><code>swap(i, j)</code> - Hoán đổi hai phần tử.</li>
                        <li><code>done()</code> - Báo hiệu kết thúc và nộp bài.</li>
                    </ul>
                </div>
                <textarea id="code-area" rows="10" placeholder="Viết code của bạn ở đây...">swap(0,1)
done()</textarea>
                <div class="actions">
                    <button id="run-btn" class="btn btn-primary"><i class="fas fa-play"></i> Chạy</button>
                    <button id="reset-btn" class="btn btn-light"><i class="fas fa-undo"></i> Reset</button>
                </div>
            </section>
        </div>

        {{-- Cột bên phải --}}
        <div class="game-output">
            <section class="panel log-panel">
                <div class="panel-header">
                    <h2><i class="fas fa-clipboard-list"></i> Log Thao Tác</h2>
                </div>
                <div id="result-msg"></div>
                <ul id="log"></ul>
            </section>
        </div>
    </div>
</div>

<script>
    window.INIT_ARRAY = @json($initialArray);
</script>
<script src="{{ asset('js/sort-challenge.js') }}"></script>
</body>
</html>