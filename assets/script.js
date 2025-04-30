let currentSlide = 0;
const slides = [
  "Slide Images",
  "Empowering Entrepreneurs",
  "Innovative Solutions",
];
const slideContent = document.getElementById("slideContent");

// Slide functionality
if (slideContent) {
  document.getElementById("prevSlide")?.addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    slideContent.textContent = slides[currentSlide];
  });

  document.getElementById("nextSlide")?.addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    slideContent.textContent = slides[currentSlide];
  });

  // Auto-rotate slides
  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    slideContent.textContent = slides[currentSlide];
  }, 5000);
}

document
  .getElementById("mobile-menu-button")
  .addEventListener("click", function () {
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.classList.toggle("hidden");
  });

// Desktop dropdowns
document.querySelectorAll(".dropdown-menu").forEach(function (dropdown) {
  const toggle = dropdown.querySelector(".dropdown-toggle");
  const content = dropdown.querySelector(".dropdown-content");

  toggle.addEventListener("click", function (e) {
    e.preventDefault();
    content.classList.toggle("hidden");
  });

  // Hide dropdown when clicking outside
  document.addEventListener("click", function (e) {
    if (!dropdown.contains(e.target)) {
      content.classList.add("hidden");
    }
  });
});

// Mobile dropdowns
document.querySelectorAll(".mobile-dropdown").forEach(function (dropdown) {
  const toggle = dropdown.querySelector("button");
  const content = dropdown.querySelector("div");
  const arrow = toggle.querySelector("svg");

  toggle.addEventListener("click", function () {
    content.classList.toggle("hidden");
    arrow.classList.toggle("rotate-180");
  });
});
