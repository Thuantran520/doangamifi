document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-lesson').forEach(btn => {
        const type = btn.getAttribute('href').replace(/.*\/(\w+)$/, '$1');
        if(localStorage.getItem('viewed-' + type)) {
            btn.classList.add('viewed');
        }
        btn.addEventListener('click', function() {
            localStorage.setItem('viewed-' + type, '1');
            btn.classList.add('viewed');
        });
    });
});

function showDeleteModal(lessonId) {
    // Hiển thị modal xác nhận xóa
    document.getElementById('delete-modal').style.display = 'flex';
    // Lưu ID bài học cần xóa vào form
    document.getElementById('delete-form').action = '/admin/' + lessonId;
}

function hideDeleteModal() {
    // Ẩn modal xác nhận xóa
    document.getElementById('delete-modal').style.display = 'none';
}