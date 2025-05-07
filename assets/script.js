class Slideshow {
  constructor(options) {
    // Default configuration
    this.config = {
      containerSelector: "#slideContent",
      prevButtonSelector: "#prevSlide",
      nextButtonSelector: "#nextSlide",
      slides: [],
      autoplayInterval: 5000,
      transitionDuration: 700,
      enableAutoplay: true,
      enableKeyboard: true,
      enableSwipe: true,
      enableDots: true,
      ...options,
    };

    // State variables
    this.currentSlide = 0;
    this.autoplayTimer = null;
    this.isTransitioning = false;
    this.touchStartX = 0;
    this.touchEndX = 0;

    // DOM elements
    this.container = document.querySelector(this.config.containerSelector);
    this.prevButton = document.querySelector(this.config.prevButtonSelector);
    this.nextButton = document.querySelector(this.config.nextButtonSelector);

    // Initialize slideshow if container exists
    if (this.container) {
      this.init();
    } else {
      console.error("Slideshow container not found");
    }
  }

  init() {
    // Reset container and add necessary styles
    this.resetContainer();

    // Create slide dots if enabled
    if (this.config.enableDots) {
      this.createDots();
    }

    // Set up event listeners
    this.setupEventListeners();

    // Start autoplay if enabled
    if (this.config.enableAutoplay) {
      this.startAutoplay();
    }

    // Initial slide display (no animation for first load)
    this.updateSlide(true);
  }

  resetContainer() {
    // Clear any existing content
    this.container.innerHTML = "";

    // Add necessary styles for slide animations
    this.container.style.position = "relative";
    this.container.style.overflow = "hidden";
    this.container.style.width = "100%";
    this.container.style.height = "100%";
  }

  createDots() {
    const dotsContainer = document.createElement("div");
    dotsContainer.className =
      "absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20 pointer-events-auto";
    dotsContainer.setAttribute("aria-hidden", "true");

    this.config.slides.forEach((_, index) => {
      const dot = document.createElement("button");
      dot.className =
        "w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-500 transition-colors";
      dot.setAttribute("aria-label", `Go to slide ${index + 1}`);

      dot.addEventListener("click", () => {
        this.goToSlide(index);
      });

      dotsContainer.appendChild(dot);
    });

    this.container.parentNode.insertBefore(
      dotsContainer,
      this.container.nextSibling
    );
    this.dots = dotsContainer.querySelectorAll("button");
  }

  updateDots() {
    if (!this.config.enableDots || !this.dots) return;

    this.dots.forEach((dot, index) => {
      if (index === this.currentSlide) {
        dot.classList.remove("bg-gray-300");
        dot.classList.add("bg-blue-500");
      } else {
        dot.classList.remove("bg-blue-500");
        dot.classList.add("bg-gray-300");
      }
    });
  }

  setupEventListeners() {
    // Navigation buttons
    if (this.prevButton) {
      this.prevButton.addEventListener("click", () => this.prevSlide());
    }

    if (this.nextButton) {
      this.nextButton.addEventListener("click", () => this.nextSlide());
    }

    // Touch swipe support
    if (this.config.enableSwipe) {
      this.container.addEventListener(
        "touchstart",
        (e) => {
          this.touchStartX = e.changedTouches[0].screenX;
        },
        { passive: true }
      );

      this.container.addEventListener(
        "touchend",
        (e) => {
          this.touchEndX = e.changedTouches[0].screenX;
          this.handleSwipe();
        },
        { passive: true }
      );
    }

    // Keyboard navigation
    if (this.config.enableKeyboard) {
      document.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") {
          this.prevSlide();
        } else if (e.key === "ArrowRight") {
          this.nextSlide();
        }
      });
    }
  }

  handleSwipe() {
    const threshold = 100; // Minimum distance for a swipe
    const swipeDistance = this.touchEndX - this.touchStartX;

    if (swipeDistance > threshold) {
      this.prevSlide();
    } else if (swipeDistance < -threshold) {
      this.nextSlide();
    }
  }

  startAutoplay() {
    this.pauseAutoplay(); // Clear any existing timer
    this.autoplayTimer = setInterval(() => {
      this.nextSlide();
    }, this.config.autoplayInterval);
  }

  pauseAutoplay() {
    if (this.autoplayTimer) {
      clearInterval(this.autoplayTimer);
      this.autoplayTimer = null;
    }
  }

  prevSlide() {
    if (this.isTransitioning) return;
    this.currentSlide =
      (this.currentSlide - 1 + this.config.slides.length) %
      this.config.slides.length;
    this.updateSlide();
  }

  nextSlide() {
    if (this.isTransitioning) return;
    this.currentSlide = (this.currentSlide + 1) % this.config.slides.length;
    this.updateSlide();
  }

  goToSlide(index) {
    if (this.isTransitioning || this.currentSlide === index) return;
    this.currentSlide = index;
    this.updateSlide();
  }

  updateSlide(isInitial = false) {
    if (!this.container) return;

    this.isTransitioning = true;
    const currentIndex = this.currentSlide;

    // Create new slide image element
    const newSlide = document.createElement("img");
    newSlide.src = this.config.slides[currentIndex];
    newSlide.alt = `Slide ${currentIndex + 1}`;

    // Set styles for slide transition
    if (isInitial) {
      // For initial load, just show the image with no animation
      newSlide.className = "w-full h-full object-cover absolute inset-0";
    } else {
      // For subsequent slides, prepare for animation
      newSlide.className =
        "w-full h-full object-cover absolute inset-0 translate-x-full";
      newSlide.style.transition = `transform ${this.config.transitionDuration}ms ease-out`;
    }

    // Add to container
    this.container.appendChild(newSlide);

    // Find current slide (if any)
    const currentSlide = this.container.querySelector("img.current-slide");

    if (!isInitial) {
      // Trigger slide animation after a brief delay to ensure DOM updates
      setTimeout(() => {
        newSlide.classList.remove("translate-x-full");
        newSlide.classList.add("translate-x-0");

        if (currentSlide) {
          currentSlide.style.transition = `transform ${this.config.transitionDuration}ms ease-out`;
          currentSlide.classList.remove("translate-x-0");
          currentSlide.classList.add("-translate-x-full");
        }
      }, 20);
    }

    // Mark the new slide as current
    newSlide.classList.add("current-slide");

    // Clean up old slide after transition
    if (currentSlide) {
      setTimeout(() => {
        if (currentSlide.parentNode === this.container) {
          this.container.removeChild(currentSlide);
        }
      }, this.config.transitionDuration + 100);
    }

    // Update navigation dots
    this.updateDots();

    // Accessibility: announce slide change
    const newAnnouncer = document.createElement("div");
    newAnnouncer.setAttribute("aria-live", "polite");
    newAnnouncer.className = "sr-only";
    newAnnouncer.textContent = `Slide ${currentIndex + 1} of ${
      this.config.slides.length
    }`;

    // Remove any existing announcer
    const existingAnnouncer = this.container.querySelector(
      '[aria-live="polite"]'
    );
    if (existingAnnouncer) {
      this.container.removeChild(existingAnnouncer);
    }

    this.container.appendChild(newAnnouncer);

    // Reset transition flag after animation completes
    setTimeout(() => {
      this.isTransitioning = false;
    }, this.config.transitionDuration + 50);
  }
}

// Initialize slideshow when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  const mySlideshow = new Slideshow({
    containerSelector: "#slideContent",
    prevButtonSelector: "#prevSlide",
    nextButtonSelector: "#nextSlide",
    slides: [
      "images/slide1.jpeg",
      "images/slide2.jpg",
      "images/slide3.jpg",
      "images/slide4.jpeg",
    ],
    autoplayInterval: 5000,
    transitionDuration: 700,
    enableAutoplay: true,
    enableKeyboard: true,
    enableSwipe: true,
    enableDots: true,
  });
});

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
