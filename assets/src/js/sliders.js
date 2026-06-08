/**
 * ReviewServicePro Hero Slider
 *
 * Features:
 * - Auto slider
 * - Progress animation
 * - Visibility pause
 * - Hover pause
 * - Reduced motion support
 * - Future-ready controls
 * - Safe initialization
 */

(function () {
  "use strict";

  /**
   * Prevent duplicate initialization
   */
  if (window.__rspHeroSliderInitialized) {
    return;
  }

  window.__rspHeroSliderInitialized = true;

  /**
   * Helpers
   */
  const $ = (selector, parent = document) => parent.querySelector(selector);

  const $$ = (selector, parent = document) =>
    Array.from(parent.querySelectorAll(selector));

  /**
   * Elements
   */
  const slider = $("[data-hero-slider]");
  const slides = $$(".hero-bg-slide");
  const progress = $("#hero-progress");

  /**
   * Exit safely
   */
  if (!slider || !slides.length) {
    return;
  }

  /**
   * Settings
   */
  const totalSlides = slides.length;

  const prefersReducedMotion =
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const slideDelay = prefersReducedMotion ? 9000 : 5200;

  /**
   * State
   */
  let currentIndex = 0;
  let interval = null;
  let isPaused = false;

  /**
   * Reset progress bar
   */
  function resetProgress() {
    if (!progress) {
      return;
    }

    progress.style.transition = "none";
    progress.style.width = "0%";

    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        progress.style.transition = `width ${slideDelay}ms linear`;
        progress.style.width = "100%";
      });
    });
  }

  /**
   * Update active slide
   */
  function activateSlide(index) {
    slides.forEach((slide, i) => {
      const isActive = i === index;

      slide.classList.toggle("is-active", isActive);
      slide.classList.toggle("opacity-100", isActive);
      slide.classList.toggle("opacity-0", !isActive);

      slide.setAttribute("aria-hidden", isActive ? "false" : "true");
    });

    currentIndex = index;

    if (!prefersReducedMotion) {
      resetProgress();
    }
  }

  /**
   * Next slide
   */
  function nextSlide() {
    const nextIndex = (currentIndex + 1) % totalSlides;
    activateSlide(nextIndex);
  }

  /**
   * Previous slide
   */
  function prevSlide() {
    const prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;

    activateSlide(prevIndex);
  }

  /**
   * Start slider
   */
  function startSlider() {
    stopSlider();

    if (prefersReducedMotion) {
      return;
    }

    resetProgress();

    interval = window.setInterval(() => {
      if (!isPaused) {
        nextSlide();
      }
    }, slideDelay);
  }

  /**
   * Stop slider
   */
  function stopSlider() {
    if (interval) {
      clearInterval(interval);
      interval = null;
    }
  }

  /**
   * Pause slider
   */
  function pauseSlider() {
    isPaused = true;

    if (progress) {
      const computedWidth = window.getComputedStyle(progress).width;

      progress.style.transition = "none";
      progress.style.width = computedWidth;
    }
  }

  /**
   * Resume slider
   */
  function resumeSlider() {
    isPaused = false;

    if (!prefersReducedMotion) {
      resetProgress();
    }
  }

  /**
   * Visibility handling
   */
  function handleVisibilityChange() {
    if (document.hidden) {
      pauseSlider();
    } else {
      resumeSlider();
    }
  }

  /**
   * Hover interactions
   */
  function bindHoverEvents() {
    slider.addEventListener("mouseenter", pauseSlider);

    slider.addEventListener("mouseleave", () => {
      resumeSlider();
    });
  }

  /**
   * Touch interaction
   */
  function bindTouchEvents() {
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener(
      "touchstart",
      (event) => {
        touchStartX = event.changedTouches[0].screenX;
      },
      { passive: true },
    );

    slider.addEventListener(
      "touchend",
      (event) => {
        touchEndX = event.changedTouches[0].screenX;

        const distance = touchStartX - touchEndX;

        if (Math.abs(distance) < 50) {
          return;
        }

        if (distance > 0) {
          nextSlide();
        } else {
          prevSlide();
        }

        startSlider();
      },
      { passive: true },
    );
  }

  /**
   * Manual controls (future-ready)
   *
   * Optional:
   * data-slide-next
   * data-slide-prev
   */
  function bindControls() {
    const nextButton = $("[data-slide-next]");
    const prevButton = $("[data-slide-prev]");

    if (nextButton) {
      nextButton.addEventListener("click", () => {
        nextSlide();
        startSlider();
      });
    }

    if (prevButton) {
      prevButton.addEventListener("click", () => {
        prevSlide();
        startSlider();
      });
    }
  }

  /**
   * Keyboard accessibility
   */
  function bindKeyboardControls() {
    slider.addEventListener("keydown", (event) => {
      if (event.key === "ArrowRight") {
        nextSlide();
        startSlider();
      }

      if (event.key === "ArrowLeft") {
        prevSlide();
        startSlider();
      }
    });
  }

  /**
   * Init
   */
  function init() {
    activateSlide(currentIndex);

    bindHoverEvents();
    bindTouchEvents();
    bindControls();
    bindKeyboardControls();

    document.addEventListener("visibilitychange", handleVisibilityChange);

    startSlider();
  }

  /**
   * Cleanup
   */
  window.addEventListener("beforeunload", () => {
    stopSlider();
  });

  init();
})();
