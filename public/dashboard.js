document.addEventListener("DOMContentLoaded", function () {
  const avatarInput = document.getElementById("avatarInput");
  const avatarPreview = document.getElementById("avatarPreview");
  const editBtn = document.getElementById("editBtn");
  const saveBtn = document.getElementById("saveBtn");
  const cancelBtn = document.getElementById("cancelBtn");
  const nameSpan = document.getElementById("name");
  const gmailSpan = document.getElementById("gmail");
  const nameInput = document.getElementById("nameInput");
  const gmailInput = document.getElementById("gmailInput");
  const editSection = document.getElementById("editSection");
  const backBtn = document.getElementById("backBtn");

  let tempAvatar = avatarPreview.src;

  // Click vào ảnh để đổi khi đang trong chế độ chỉnh sửa
  avatarPreview.addEventListener("click", function () {
    if (!avatarInput.classList.contains("hidden")) {
      avatarInput.click();
    }
  });

  // Xem trước ảnh
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

  // Thay đổi
  editBtn.addEventListener("click", function () {
    editSection.classList.remove("hidden");
    avatarInput.classList.remove("hidden");
    saveBtn.classList.remove("hidden");
    cancelBtn.classList.remove("hidden");
    editBtn.classList.add("hidden");
  });

  // Lưu
  saveBtn.addEventListener("click", function () {
    saveBtn.closest("form").submit();
    resetForm();
  });

  // Hủy
  cancelBtn.addEventListener("click", function () {
    nameInput.value = nameSpan.textContent;
    gmailInput.value = gmailSpan.textContent;
    avatarPreview.src = tempAvatar;
    avatarInput.value = "";
    resetForm();
  });

  // Quay về
  backBtn.addEventListener("click", function () {
    window.history.back();
  });

  function resetForm() {
    editSection.classList.add("hidden");
    avatarInput.classList.add("hidden");
    saveBtn.classList.add("hidden");
    cancelBtn.classList.add("hidden");
    editBtn.classList.remove("hidden");
  }
});
