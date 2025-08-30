document.addEventListener("DOMContentLoaded", function () {
    const lessonList = document.querySelector(".lesson-list");

    // Nếu không có danh sách bài học trên trang, không làm gì cả
    if (!lessonList) {
        return;
    }

    // Sử dụng kỹ thuật Event Delegation để xử lý tất cả các click trong danh sách
    lessonList.addEventListener("click", function (event) {
        const header = event.target.closest(".accordion-header");
        const viewedBtn = event.target.closest(".btn-viewed");

        // --- Xử lý nút "Đã xem" ---
        if (viewedBtn) {
            event.stopPropagation(); // Ngăn không cho accordion mở/đóng khi bấm nút này
            const lessonItem = viewedBtn.closest(".lesson-item");
            const lessonId = lessonItem.dataset.lessonId;

            if (lessonId) {
                // Thêm/xóa trạng thái đã xem trong localStorage
                if (localStorage.getItem(lessonId) === "true") {
                    localStorage.removeItem(lessonId);
                    lessonItem.classList.remove("viewed");
                    viewedBtn.classList.remove("viewed");
                } else {
                    localStorage.setItem(lessonId, "true");
                    lessonItem.classList.add("viewed");
                    viewedBtn.classList.add("viewed");
                }
            }
            return; // Dừng lại sau khi xử lý nút
        }

        // --- Xử lý việc mở/đóng accordion ---
        if (header) {
            const lessonItem = header.closest(".lesson-item");
            const content = lessonItem.querySelector(".accordion-content");

            // Đóng tất cả các accordion khác (tùy chọn, có thể bỏ nếu muốn mở nhiều cái cùng lúc)
            document.querySelectorAll(".lesson-item.active").forEach(item => {
                if (item !== lessonItem) {
                    item.classList.remove("active");
                    item.querySelector(".accordion-content").style.maxHeight = null;
                }
            });

            // Mở hoặc đóng accordion hiện tại
            lessonItem.classList.toggle("active");
            if (lessonItem.classList.contains("active")) {
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                content.style.maxHeight = null;
            }
        }
    });

    // --- Khôi phục trạng thái "Đã xem" khi tải trang ---
    document.querySelectorAll(".lesson-item").forEach(item => {
        const lessonId = item.dataset.lessonId;
        if (lessonId && localStorage.getItem(lessonId) === "true") {
            item.classList.add("viewed");
            item.querySelector(".btn-viewed").classList.add("viewed");
        }
    });
});