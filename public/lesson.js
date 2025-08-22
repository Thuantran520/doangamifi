document.addEventListener("DOMContentLoaded", function () {
  // Hiệu ứng mở rộng/thu gọn nội dung bài học
  document.querySelectorAll(".lesson-item h2").forEach(function (title) {
    title.style.cursor = "pointer";
    title.addEventListener("click", function () {
      const detail = this.parentElement.querySelector(".lesson-detail");
      if (detail.style.maxHeight && detail.style.maxHeight !== "0px") {
        detail.style.maxHeight = "0px";
        detail.style.opacity = 0.7;
      } else {
        detail.style.maxHeight = detail.scrollHeight + "px";
        detail.style.opacity = 1;
      }
    });
  });

  // Hiệu ứng highlight khi hover
  document.querySelectorAll(".lesson-item").forEach(function (item) {
    item.addEventListener("mouseenter", function () {
      item.style.background = "linear-gradient(120deg, #e3eafc 0%, #fff 100%)";
    });
    item.addEventListener("mouseleave", function () {
      item.style.background = "#fff";
    });
  });

  document.querySelectorAll(".flip-card").forEach(function (card) {
    card.addEventListener("click", function () {
      card.classList.toggle("flipped");
    });
  });

  document.querySelectorAll(".accordion-header").forEach(function (header) {
    header.style.cursor = "pointer";
    header.addEventListener("click", function () {
      const content = header.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  });
});