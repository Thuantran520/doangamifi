document.addEventListener('DOMContentLoaded', function () {
    // Kiểm tra xem các URL đã được định nghĩa từ Blade chưa
    if (typeof window.verificationUrls === 'undefined' || !window.verificationUrls.status || !window.verificationUrls.dashboard) {
        console.error('Lỗi: Không tìm thấy các URL xác thực. Hãy đảm bảo chúng được định nghĩa trong tệp Blade.');
        return;
    }

    // Kiểm tra trạng thái mỗi 5 giây
    const interval = setInterval(function () {
        fetch(window.verificationUrls.status) // Sử dụng URL đã được truyền
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.verified) {
                    // Nếu đã xác thực, dừng việc kiểm tra và chuyển hướng
                    clearInterval(interval);
                    window.location.href = window.verificationUrls.launcher; // Sử dụng URL đã được truyền
                }
            })
            .catch(error => {
                console.error('Lỗi khi kiểm tra trạng thái xác thực:', error);
                clearInterval(interval); // Dừng lại nếu có lỗi
            });
    }, 5000); // 5000ms = 5 giây
});