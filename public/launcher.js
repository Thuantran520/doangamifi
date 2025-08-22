document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("menuToggle");
  const dropdownMenu = document.getElementById("dropdownMenu");

  // Toggle dropdown menu
  menuToggle.addEventListener("click", function () {
    dropdownMenu.classList.toggle("hidden");
  });

  // Ẩn menu khi click ra ngoài
  document.addEventListener("click", function (event) {
    if (!menuToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
      dropdownMenu.classList.add("hidden");
    }
  });
});
