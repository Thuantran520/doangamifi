document.addEventListener("DOMContentLoaded", function () {
  // --- Lấy các phần tử trên trang ---
  const avatarInput = document.getElementById("avatarInput");
  const avatarPreview = document.getElementById("avatarPreview");
  
  const editBtn = document.getElementById("editBtn");
  const saveBtn = document.getElementById("saveBtn");
  const cancelBtn = document.getElementById("cancelBtn");

  // Các phần tử hiển thị (thẻ <p>)
  const nameDisplay = document.getElementById("nameDisplay");
  const emailDisplay = document.getElementById("emailDisplay");
  const phoneDisplay = document.getElementById("phoneDisplay");

  // Các phần tử nhập liệu (thẻ <input>)
  const nameInput = document.getElementById("nameInput");
  const emailInput = document.getElementById("emailInput");
  const phoneInput = document.getElementById("phoneInput");

  // Lưu trữ giá trị gốc để có thể hủy bỏ
  let originalValues = {};
  let tempAvatarSrc = avatarPreview.src;

  /**
   * Hàm chuyển đổi giữa chế độ xem và chế độ chỉnh sửa
   * @param {boolean} isEditing - True để vào chế độ chỉnh sửa, False để thoát.
   */
  function toggleEditMode(isEditing) {
    // Ẩn/hiện các phần tử hiển thị
    nameDisplay.classList.toggle('hidden', isEditing);
    emailDisplay.classList.toggle('hidden', isEditing);
    phoneDisplay.classList.toggle('hidden', isEditing);

    // Ẩn/hiện các ô nhập liệu
    nameInput.classList.toggle('hidden', !isEditing);
    emailInput.classList.toggle('hidden', !isEditing);
    phoneInput.classList.toggle('hidden', !isEditing);

    // Ẩn/hiện các nút điều khiển
    editBtn.classList.toggle('hidden', isEditing);
    saveBtn.classList.toggle('hidden', !isEditing);
    cancelBtn.classList.toggle('hidden', !isEditing);
  }

  // --- Gán sự kiện cho các nút ---

  // Sự kiện khi nhấn nút "Chỉnh sửa"
  editBtn.addEventListener("click", function () {
    // Lưu lại giá trị hiện tại trước khi chỉnh sửa
    originalValues = {
      name: nameDisplay.textContent.trim(),
      email: emailDisplay.textContent.trim(),
      phone: phoneDisplay.textContent.trim() === 'Chưa cập nhật' ? '' : phoneDisplay.textContent.trim(),
    };
    
    // Cập nhật giá trị cho các ô input
    nameInput.value = originalValues.name;
    emailInput.value = originalValues.email;
    phoneInput.value = originalValues.phone;

    // Chuyển sang chế độ chỉnh sửa
    toggleEditMode(true);
  });

  // Sự kiện khi nhấn nút "Hủy"
  cancelBtn.addEventListener("click", function () {
    // Khôi phục ảnh đại diện gốc
    avatarPreview.src = tempAvatarSrc;
    // Xóa file đã chọn (nếu có)
    avatarInput.value = ""; 

    // Thoát khỏi chế độ chỉnh sửa
    toggleEditMode(false);
  });

  // Sự kiện xem trước ảnh đại diện khi người dùng chọn file mới
  avatarInput.addEventListener("change", function () {
    const file = avatarInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        avatarPreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
});
