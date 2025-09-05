document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('game-grid');
    const codeEditor = document.getElementById('code-editor');
    const runBtn = document.getElementById('run-btn');
    const resetBtn = document.getElementById('reset-btn');
    const messageBox = document.getElementById('message-box');
    const levelSelector = document.getElementById('level-selector');
    const scoreDisplay = document.getElementById('score-display');

    const GRID_SIZE = 10;
    const MIN_DISTANCE = 5;
    let robotElement;
    let isGameWon = false;

    const levels = [
        { name: "Màn 1: Cơ bản", start: { x: 0, y: 0, dir: 0 }, target: { x: 5, y: 5 }, obstacles: [] },
        { name: "Màn 2: Chướng ngại vật", start: { x: 0, y: 0, dir: 0 }, target: { x: 8, y: 8 }, obstacles: [{x:2,y:0},{x:2,y:1},{x:2,y:2},{x:2,y:3},{x:5,y:5},{x:6,y:5},{x:7,y:5}] },
        { name: "Màn 3: Thử thách", start: { x: 9, y: 9, dir: 3 }, target: { x: 0, y: 0 }, obstacles: [{x:4,y:0},{x:4,y:1},{x:4,y:2},{x:4,y:3},{x:4,y:4},{x:4,y:5},{x:4,y:6}] }
    ];
    let currentLevelConfig;
    let robotState;

    const sleep = ms => new Promise(res => setTimeout(res, ms));

    function isLevelSolvable(level) {
        const queue = [{ x: level.start.x, y: level.start.y, dir: level.start.dir }];
        const visited = new Set([`${level.start.x},${level.start.y},${level.start.dir}`]);
        const dx = [1, 0, -1, 0];
        const dy = [0, 1, 0, -1];

        while (queue.length > 0) {
            const { x, y, dir } = queue.shift();
            if (x === level.target.x && y === level.target.y) return true;

            const actions = [
                { type: 'move', newDir: dir },
                { type: 'turnLeft', newDir: (dir + 3) % 4 },
                { type: 'turnRight', newDir: (dir + 1) % 4 }
            ];

            for (const action of actions) {
                let newX = x;
                let newY = y;
                const newDir = action.newDir;

                if (action.type === 'move') {
                    newX += dx[dir];
                    newY += dy[dir];
                    if (newX < 0 || newX >= GRID_SIZE || newY < 0 || newY >= GRID_SIZE ||
                        level.obstacles.some(obs => obs.x === newX && obs.y === newY)) {
                        continue;
                    }
                }

                const key = `${newX},${newY},${newDir}`;
                if (!visited.has(key)) {
                    visited.add(key);
                    queue.push({ x: newX, y: newY, dir: newDir });
                }
            }
        }
        return false;
    }

    function generateRandomLevel() {
        let level;
        let solvable = false;
        let attempts = 0;
        do {
            const startX = Math.floor(Math.random() * GRID_SIZE);
            const startY = Math.floor(Math.random() * GRID_SIZE);
            let targetX, targetY;
            do {
                targetX = Math.floor(Math.random() * GRID_SIZE);
                targetY = Math.floor(Math.random() * GRID_SIZE);
                const distance = Math.abs(startX - targetX) + Math.abs(startY - targetY);
                if (distance >= MIN_DISTANCE) break;
            } while (true);

            const obstacles = [];
            const numObstacles = Math.floor(GRID_SIZE * GRID_SIZE * 0.2);
            for (let i = 0; i < numObstacles; i++) {
                const obsX = Math.floor(Math.random() * GRID_SIZE);
                const obsY = Math.floor(Math.random() * GRID_SIZE);
                if ((obsX !== startX || obsY !== startY) && (obsX !== targetX || obsY !== targetY)) {
                    obstacles.push({ x: obsX, y: obsY });
                }
            }

            level = {
                name: "Ngẫu nhiên",
                start: { x: startX, y: startY, dir: Math.floor(Math.random() * 4) },
                target: { x: targetX, y: targetY },
                obstacles: obstacles
            };
            solvable = isLevelSolvable(level);
            attempts++;
        } while (!solvable && attempts < 200);

        if (!solvable) {
            return { name: "Ngẫu nhiên (Dự phòng)", start: { x: 0, y: 0, dir: 0 }, target: { x: 5, y: 5 }, obstacles: [] };
        }
        return level;
    }

    function loadLevel(levelIdentifier) {
        if (levelIdentifier === 'random') {
            currentLevelConfig = generateRandomLevel();
        } else {
            const levelIndex = parseInt(levelIdentifier);
            currentLevelConfig = levels[levelIndex];
        }
        levelSelector.value = levelIdentifier;
        resetGame();
    }

    function setupGrid() {
        grid.innerHTML = '';
        for (let i = 0; i < GRID_SIZE * GRID_SIZE; i++) {
            const cell = document.createElement('div');
            cell.classList.add('grid-cell');
            cell.dataset.x = i % GRID_SIZE;
            cell.dataset.y = Math.floor(i / GRID_SIZE);
            grid.appendChild(cell);
        }
    }

    function placeElements() {
        const startCell = grid.querySelector(`[data-x='${currentLevelConfig.start.x}'][data-y='${currentLevelConfig.start.y}']`);
        robotElement = document.createElement('span');
        robotElement.textContent = '🤖';
        robotElement.classList.add('robot');
        startCell.appendChild(robotElement);

        const targetCell = grid.querySelector(`[data-x='${currentLevelConfig.target.x}'][data-y='${currentLevelConfig.target.y}']`);
        targetCell.textContent = '💎';

        currentLevelConfig.obstacles.forEach(obs => {
            const obsCell = grid.querySelector(`[data-x='${obs.x}'][data-y='${obs.y}']`);
            if (obsCell) obsCell.classList.add('obstacle');
        });
    }

    function resetGame() {
        isGameWon = false;
        robotState = { ...currentLevelConfig.start };
        setupGrid();
        placeElements();
        updateRobotTransform();
        messageBox.innerHTML = '';
        messageBox.className = '';
        runBtn.disabled = false;
        resetBtn.disabled = false;
    }

    function updateRobotTransform() {
        const cell = grid.querySelector(`[data-x='${robotState.x}'][data-y='${robotState.y}']`);
        if (cell) cell.appendChild(robotElement);
        robotElement.style.transform = `rotate(${robotState.dir * 90}deg)`;
    }

    const robot = {
        move: async (steps = 1) => {
            for (let i = 0; i < steps; i++) {
                if (isGameWon) break;
                await robot.moveOneStep();
            }
        },
        moveOneStep: async () => {
            if (isGameWon) return;
            const dx = [1, 0, -1, 0];
            const dy = [0, 1, 0, -1];
            const newX = robotState.x + dx[robotState.dir];
            const newY = robotState.y + dy[robotState.dir];

            if (currentLevelConfig.obstacles.some(obs => obs.x === newX && obs.y === newY)) {
                throw new Error("Robot đã đâm vào chướng ngại vật!");
            }
            if (newX < 0 || newX >= GRID_SIZE || newY < 0 || newY >= GRID_SIZE) {
                throw new Error("Robot đi ra ngoài lưới!");
            }

            robotState.x = newX;
            robotState.y = newY;
            updateRobotTransform();
            await sleep(350);
            await checkWinCondition();
        },
        turnRight: async () => {
            if (isGameWon) return;
            robotState.dir = (robotState.dir + 1) % 4;
            updateRobotTransform();
            await sleep(250);
        },
        turnLeft: async () => {
            if (isGameWon) return;
            robotState.dir = (robotState.dir + 3) % 4;
            updateRobotTransform();
            await sleep(250);
        },
        turnAround: async () => {
            if (isGameWon) return;
            robotState.dir = (robotState.dir + 2) % 4;
            updateRobotTransform();
            await sleep(250);
        },
        // Thêm lệnh moveForward để tương thích ngược
        moveForward: async () => {
            await robot.move(1);
        }
    };

    async function addScore(points) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found!');
                return;
            }
            const response = await fetch('/game/robot/add-score', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: JSON.stringify({ score: points })
            });
            const data = await response.json();
            if (data.success && data.newTotalScore !== undefined) {
                scoreDisplay.textContent = data.newTotalScore;
            }
        } catch (error) {
            console.error('Lỗi khi cộng điểm:', error);
        }
    }

    async function checkWinCondition() {
        if (!isGameWon && robotState.x === currentLevelConfig.target.x && robotState.y === currentLevelConfig.target.y) {
            isGameWon = true; // Đặt cờ đã thắng để dừng các hành động khác

            // Kiểm tra xem đây có phải là màn chơi ngẫu nhiên không
            if (currentLevelConfig.name.startsWith('Ngẫu nhiên')) {
                messageBox.textContent = 'Thành công! Bạn nhận được 10 điểm!';
                messageBox.className = 'message-success';
                await addScore(10); // Chỉ cộng điểm cho màn ngẫu nhiên
            } else {
                messageBox.textContent = 'Thành công! Bạn đã hoàn thành màn chơi!';
                messageBox.className = 'message-success';
                // Không cộng điểm cho các màn chơi có sẵn
            }

            const currentIndex = levels.findIndex(l => l.name === currentLevelConfig.name);
            if (currentIndex !== -1 && currentIndex < levels.length - 1) {
                // Nếu là màn có sẵn, chuyển đến màn tiếp theo
                setTimeout(() => loadLevel(currentIndex + 1), 2000);
            } else {
                // Nếu là màn cuối cùng hoặc màn ngẫu nhiên, tạo màn ngẫu nhiên mới
                setTimeout(() => loadLevel('random'), 2000);
            }
        }
    }

    // NÂNG CẤP: Thay thế bộ đọc lệnh bằng trình thông dịch JavaScript
    runBtn.addEventListener('click', async () => {
        const userCode = codeEditor.value;
        messageBox.innerHTML = '';
        messageBox.className = '';
        runBtn.disabled = true;
        resetBtn.disabled = true;

        // Reset trạng thái game trước khi chạy code mới
        await resetGame();
        // Cho một khoảng trễ nhỏ để người dùng thấy trạng thái reset
        await sleep(100);

        try {
            // Tạo một hàm bất đồng bộ an toàn từ code của người dùng
            // Hàm này sẽ có quyền truy cập vào đối tượng 'robot'
            const AsyncFunction = Object.getPrototypeOf(async function(){}).constructor;
            const func = new AsyncFunction('robot', userCode);

            // Thực thi code của người dùng
            await func(robot);

            // Sau khi code chạy xong, kiểm tra lại xem đã thắng chưa
            // (phòng trường hợp người dùng không di chuyển vào ô cuối cùng)
            if (!isGameWon) {
                messageBox.textContent = 'Nhiệm vụ chưa hoàn thành. Hãy thử lại!';
                messageBox.className = 'message-error';
            }

        } catch (e) {
            if (!isGameWon) {
                messageBox.textContent = `Lỗi: ${e.message}`;
                messageBox.className = 'message-error';
            }
        } finally {
            resetBtn.disabled = false;
        }
    });

    resetBtn.addEventListener('click', resetGame);
    levelSelector.addEventListener('change', (e) => loadLevel(e.target.value));

    // --- DÁN ĐOẠN MÃ NÀY VÀO ---
    const accordions = document.querySelectorAll('.accordion-toggle');
    accordions.forEach(accordion => {
        accordion.addEventListener('click', function() {
            this.classList.toggle('active');
            const content = this.nextElementSibling;
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = null;
                content.style.paddingTop = '0';
                content.style.paddingBottom = '0';
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                content.style.paddingTop = '15px';
                content.style.paddingBottom = '15px';
            }
        });
    });
    // --- KẾT THÚC ĐOẠN MÃ CẦN DÁN ---

    loadLevel('random');
});