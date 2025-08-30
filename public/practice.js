document.addEventListener("DOMContentLoaded", function () {
    const editorEl = document.getElementById("codeEditor");
    const langSelectEl = document.getElementById("languageSelect");
    const outputEl = document.getElementById("outputArea");
    const runBtn = document.getElementById("runBtn");
    const clearBtn = document.getElementById("clearBtn");

    /* ===================== RUN CODE VIA PISTON API ===================== */
    async function runCode(code, language) {
        if (!code || !code.trim()) {
            outputEl.style.color = '#dc3545';
            outputEl.textContent = "⚠️ Lỗi: Bạn chưa viết mã nguồn để thực thi.";
            return;
        }
        outputEl.style.color = '#6c757d';
        outputEl.textContent = "⏳ Đang biên dịch và chạy...";
        
        let version = "";
        // Piston API versions
        const versions = {
            python: "3.10.0",
            cpp: "10.2.0",
            javascript: "18.15.0"
        };
        version = versions[language] || "latest";

        try {
            const response = await fetch("https://emkc.org/api/v2/piston/execute", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    language: language,
                    version: version,
                    files: [{ content: code }]
                })
            });
            const data = await response.json();

            if (data.run && data.run.stdout) {
                outputEl.style.color = '#212529';
                outputEl.textContent = data.run.stdout;
            } else if (data.run && data.run.stderr) {
                outputEl.style.color = '#dc3545';
                outputEl.textContent = `⚠️ Lỗi:\n${data.run.stderr}`;
            } else {
                outputEl.style.color = '#212529';
                outputEl.textContent = "✅ Chạy thành công nhưng không có kết quả đầu ra.";
            }
        } catch (err) {
            outputEl.style.color = '#dc3545';
            outputEl.textContent = `🚨 Lỗi kết nối đến API: ${err.message}`;
        }
    }

    /* ===================== EVENTS ===================== */
    runBtn.addEventListener("click", () => runCode(editorEl.value, langSelectEl.value));
    clearBtn.addEventListener("click", () => { outputEl.textContent = ""; });

    editorEl.addEventListener("keydown", (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === "Enter") {
            e.preventDefault();
            runBtn.click(); // Simulate a click on the run button
        }
    });

    // Change placeholder and clear editor when language changes
    const placeholders = {
        python: `print("Hello, World!")`,
        cpp: `#include <iostream>\n\nint main() {\n    std::cout << "Hello, World!";\n    return 0;\n}`,
        javascript: `// Chỉ dùng lệnh Node.js\nconsole.log("Hello, World!");`
    };

    function updateEditorForLanguage(language) {
        editorEl.placeholder = placeholders[language] || "";
        // Optional: clear editor on language change
        // editorEl.value = ""; 
        // outputEl.textContent = "";
    }

    langSelectEl.addEventListener("change", () => {
        updateEditorForLanguage(langSelectEl.value);
    });

    // Set initial placeholder
    updateEditorForLanguage(langSelectEl.value);
});
