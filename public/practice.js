const editorEl = document.getElementById("codeEditor");
const langSelectEl = document.getElementById("languageSelect");
const outputEl = document.getElementById("outputArea");
const runBtn   = document.getElementById("runBtn");
const clearBtn = document.getElementById("clearBtn");

/* ===================== RUN CODE VIA PISTON API ===================== */
async function runCode(code, language) {
  if (!code || !code.trim()) {
    outputEl.textContent = "⚠️ Bạn chưa viết code nào.";
    return;
  }
  outputEl.textContent = "⏳ Đang biên dịch và chạy...";
  let version = "";
  let filename = "main.txt";
  if (language === "cpp") {
    version = "10.2.0";
    filename = "main.cpp";
  } else if (language === "python") {
    version = "3.10.0";
    filename = "main.py";
  } else if (language === "javascript") {
    version = "18.15.0"; // Node.js mới nhất trên piston
    filename = "main.js";
  }
  try {
    const res = await fetch("https://emkc.org/api/v2/piston/execute", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        language,
        version,
        files: [{ name: filename, content: code }]
      })
    });
    const data = await res.json();
    if (data.run) {
      let output = "";
      if (data.run.stdout) output += data.run.stdout;
      if (data.run.stderr) output += "\n⚠️ Lỗi:\n" + data.run.stderr;
      if (!output.trim()) {
        if (language === "javascript") {
          output = "✅ Chạy thành công nhưng không có output.\n\nLưu ý: Chỉ các lệnh Node.js như console.log mới hiển thị kết quả.";
        } else {
          output = "✅ Chạy thành công nhưng không có output.";
        }
      }
      outputEl.textContent = output;
    } else {
      outputEl.textContent = "❌ Không nhận được kết quả.";
    }
  } catch (err) {
    outputEl.textContent = "🚨 Lỗi kết nối API: " + err.message;
  }
}

/* ===================== EVENTS ===================== */
runBtn.addEventListener("click", () => runCode(editorEl.value, langSelectEl.value));
clearBtn.addEventListener("click", () => { outputEl.textContent = ""; });

editorEl.addEventListener("keydown", (e) => {
  if ((e.ctrlKey || e.metaKey) && e.key === "Enter") {
    e.preventDefault();
    runCode(editorEl.value, langSelectEl.value);
  }
});

// Đổi placeholder khi chọn ngôn ngữ
const placeholders = {
  cpp: `#include <iostream>\nusing namespace std;\nint main() {\n    cout << "Hello, World!";\n    return 0;\n}`,
  python: `print("Hello, World!")`,
  javascript: `// Chỉ dùng lệnh Node.js\nconsole.log("Hello, World!");`
};
langSelectEl.addEventListener("change", () => {
  editorEl.placeholder = placeholders[langSelectEl.value] || "";
  editorEl.value = "";
  outputEl.textContent = "";
});
