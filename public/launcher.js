document.addEventListener('DOMContentLoaded', function () {
    // Lấy đúng ID của các phần tử trong giao diện mới
    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userDropdown = document.getElementById('user-dropdown');

    // Kiểm tra xem các phần tử có tồn tại không
    if (userMenuToggle && userDropdown) {
        // Thêm sự kiện click cho nút bấm menu
        userMenuToggle.addEventListener('click', function (event) {
            // Ngăn sự kiện click lan ra ngoài
            event.stopPropagation();
            
            // Thêm/xóa class 'hidden' để ẩn/hiện menu
            userDropdown.classList.toggle('hidden');
            // Thêm/xóa class 'open' để xoay icon mũi tên
            userMenuToggle.classList.toggle('open');
        });

        // Thêm sự kiện click cho toàn bộ trang để ẩn menu khi bấm ra ngoài
        document.addEventListener('click', function (event) {
            // Nếu bấm ra ngoài menu và ngoài nút bấm
            if (!userDropdown.contains(event.target) && !userMenuToggle.contains(event.target)) {
                // Luôn ẩn menu đi
                userDropdown.classList.add('hidden');
                userMenuToggle.classList.remove('open');
            }
        });
    }
});
