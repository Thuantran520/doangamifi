document.addEventListener('DOMContentLoaded', () => {
    const arrayContainer = document.getElementById('array-container');
    const codeArea       = document.getElementById('code-area');
    const runBtn         = document.getElementById('run-btn');
    const resetBtn       = document.getElementById('reset-btn');
    const shuffleBtn     = document.getElementById('shuffle-btn');
    const logUl          = document.getElementById('log');
    const resultMsg      = document.getElementById('result-msg');
    const globalScoreEl  = document.getElementById('global-score');

    // Định nghĩa độ khó
    const difficulties = [
        { level: 1, length: 6,  max: 8,  required: 2 },
        { level: 2, length: 7,  max: 10, required: 2 },
        { level: 3, length: 8,  max: 12, required: 2 },
        { level: 4, length: 9,  max: 15, required: 2 },
        { level: 5, length: 10, max: 18, required: 999 } // level cuối: lặp vô hạn
    ];
    let currentDifficultyIndex = 0;
    let completionsAtDifficulty = 0;

    // Thanh thống kê & tiến độ
    let statsBar = document.getElementById('sort-stats-bar');
    if (!statsBar) {
        statsBar = document.createElement('div');
        statsBar.id = 'sort-stats-bar';
        statsBar.style.marginTop = '10px';
        statsBar.style.fontSize = '13px';
        statsBar.style.fontFamily = 'system-ui';
        statsBar.style.lineHeight = '1.5';
        arrayContainer.parentElement.appendChild(statsBar);
    }

    let original   = [];
    let working    = [];
    let operations = 0;
    let finished   = false;
    let locking    = false;

    // ========= UTIL =========
    function uniqRandomArray(length, max){
        const pool = [];
        for (let i=1;i<=max;i++) pool.push(i);
        // Fisher-Yates
        for (let i=pool.length-1;i>0;i--){
            const j = Math.floor(Math.random()*(i+1));
            [pool[i], pool[j]] = [pool[j], pool[i]];
        }
        return pool.slice(0,length);
    }
    function range(a,b){ const arr=[]; for(let i=a;i<=b;i++) arr.push(i); return arr; }
    function isSorted(arr){ for(let i=1;i<arr.length;i++) if(arr[i-1]>arr[i]) return false; return true; }
    function idealOps(n){ return Math.round(n * Math.log(n) / Math.log(2)); }
    function estimateScore(n, ops){
        const ideal = idealOps(n);
        const raw = 30 - Math.max(0, ops - ideal);
        return Math.max(5, Math.min(30, raw));
    }

    // ========= STATE =========
    function generateNewArray(){
        const diff = difficulties[currentDifficultyIndex];
        original = uniqRandomArray(diff.length, diff.max);
        working  = [...original];
    }

    function advanceDifficultyIfNeeded(){
        const diff = difficulties[currentDifficultyIndex];
        if (completionsAtDifficulty >= diff.required && currentDifficultyIndex < difficulties.length - 1){
            currentDifficultyIndex++;
            completionsAtDifficulty = 0;
        }
    }

    function difficultyLabel(){
        const diff = difficulties[currentDifficultyIndex];
        return `Level ${diff.level} (n=${diff.length}, max=${diff.max})`;
    }

    // ========= RENDER =========
    function renderArray(highlightIdx = []) {
        arrayContainer.innerHTML = '';
        working.forEach((v,i) => {
            const div = document.createElement('div');
            div.className = 'array-item';
            if (highlightIdx.includes(i)) div.classList.add('highlight');
            div.textContent = v;
            arrayContainer.appendChild(div);
        });
        updateStatsPreview();
    }

    function updateStatsPreview() {
        const diff = difficulties[currentDifficultyIndex];
        const n = working.length;
        const ideal = idealOps(n);
        const potential = estimateScore(n, operations);
        statsBar.innerHTML =
            `<strong>${difficultyLabel()}</strong> | Hoàn thành: ${completionsAtDifficulty}/${diff.required === 999 ? '∞' : diff.required} | ` +
            `Thao tác hiện tại: ${operations} | Ước tính lý tưởng ≈ ${ideal} | ` +
            `Điểm tiềm năng nếu xong ngay: <strong>${potential}</strong>`;
    }

    function log(line) {
        const li = document.createElement('li');
        li.textContent = line;
        logUl.appendChild(li);
        logUl.scrollTop = logUl.scrollHeight;
    }

    function reset(withNew = false){
        if (locking) return;
        finished = false;
        operations = 0;
        logUl.innerHTML = '';
        resultMsg.className = '';
        resultMsg.textContent = '';
        if (withNew) generateNewArray(); else working = [...original];
        renderArray();
    }

    // ========= SUBMIT =========
    async function submitResult(logData){
        try {
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrf) {
                console.error('CSRF token missing');
                return;
            }
            const res = await fetch('/game/sort-challenge/submit', {
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    original,
                    result: working,
                    log: logData,
                    ops: operations
                })
            });
            let data;
            try { data = await res.json(); } catch(e){ console.error('Invalid JSON', e); return; }

            if (data.success) {
                if (data.added > 0) {
                    resultMsg.textContent += ` (+${data.added} điểm)`;
                    resultMsg.classList.add('success');
                    if (data.newTotalScore !== undefined) globalScoreEl.textContent = data.newTotalScore;
                } else {
                    resultMsg.textContent += ' (0 điểm)';
                }
            } else {
                resultMsg.textContent += ` (${data.message || 'Lỗi'})`;
            }

            // Xử lý tăng độ khó sau khi submit (nếu đã sorted)
            if (resultMsg.classList.contains('success')){
                completionsAtDifficulty++;
                advanceDifficultyIfNeeded();
                setTimeout(() => {
                    generateNewArray();
                    reset(false); // không random tiếp khác vì generateNewArray đã làm
                }, 1400);
            }

        } catch (e) {
            console.error('Submit error', e);
            resultMsg.textContent += ' (Lỗi gửi kết quả)';
            resultMsg.classList.add('error');
        }
    }

    // ========= PARSER =========
    function parseAndRun(){
        if (locking) return;
        locking = true;
        runBtn.disabled = true;

        finished = false;
        operations = 0;
        logUl.innerHTML = '';
        resultMsg.className = '';
        resultMsg.textContent = '';
        working = [...original];
        renderArray();

        const lines = codeArea.value.split('\n').map(l=>l.trim()).filter(l=>l.length);
        if (!lines.length){
            fail('Chưa có lệnh.');
            unlock();
            return;
        }
        const logData = [];

        for (let line of lines){
            if (finished) break;
            if (line.startsWith('//')) continue;

            if (line.startsWith('compare(') && line.endsWith(')')){
                const [i,j] = parseTwo(line,'compare'); if (i===null){ unlock(); return; }
                operations++;
                log(`compare(${i},${j}) => ${working[i]} vs ${working[j]}`);
                logData.push({type:'compare', i,j, values:[working[i],working[j]]});
                flash([i,j]);
            }
            else if (line.startsWith('swap(') && line.endsWith(')')){
                const [i,j] = parseTwo(line,'swap'); if (i===null){ unlock(); return; }
                operations++;
                log(`swap(${i},${j})`);
                logData.push({type:'swap', i,j, before:[working[i],working[j]]});
                [working[i],working[j]] = [working[j],working[i]];
                renderArray([i,j]);
            }
            else if (line === 'done()'){
                finished = true;
                const sorted = isSorted(working);
                if (sorted){
                    resultMsg.textContent = 'Thành công! Mảng đã được sắp xếp.';
                    resultMsg.className = 'success';
                } else {
                    resultMsg.textContent = 'Chưa đúng – mảng chưa được sắp xếp.';
                    resultMsg.className = 'error';
                }
                log(`done() -> ${sorted ? 'sorted' : 'not sorted'}`);
                logData.push({
                    type:'done',
                    sorted,
                    final:[...working],
                    difficulty: difficulties[currentDifficultyIndex].level,
                    completionsAtDifficulty
                });
                submitResult(logData);
            }
            else {
                fail(`Lệnh không hợp lệ: ${line}`);
                unlock();
                return;
            }
        }

        if (!finished) fail('Thiếu done() ở cuối.');
        unlock();
    }

    function parseTwo(line, key){
        const inside = line.slice(key.length+1,-1);
        const parts = inside.split(',').map(s=>s.trim());
        if (parts.length !== 2){ fail(`Cú pháp ${key} sai: ${line}`); return [null,null]; }
        const i = +parts[0], j = +parts[1];
        if (!validIndex(i) || !validIndex(j)){ fail(`Chỉ số không hợp lệ: ${line}`); return [null,null]; }
        return [i,j];
    }

    function validIndex(i){ return Number.isInteger(i) && i>=0 && i<working.length; }
    function fail(msg){
        resultMsg.textContent = msg;
        resultMsg.className = 'error';
        log(msg);
        finished = true;
    }
    function flash(idxs){ renderArray(idxs); }
    function unlock(){ locking = false; runBtn.disabled = false; }

    // ========= EVENTS =========
    runBtn.addEventListener('click', parseAndRun);
    resetBtn.addEventListener('click', () => reset(false));
    shuffleBtn.addEventListener('click', () => {
        generateNewArray();
        reset(false);
    });

    // ========= INIT =========
    generateNewArray();
    renderArray();
});