/**
 * ReviewServicePro Industries Interaction
 *
 * Features:
 * - Bento spotlight interaction
 * - Mouse glow tracking
 * - Hover state system
 * - Reduced motion support
 * - Touch-safe handling
 * - Keyboard accessibility
 * - Performance optimized
 */

(function () {
  "use strict";

  /**
   * Prevent duplicate initialization
   */
  if (window.__rspIndustriesInitialized) {
    return;
  }

  window.__rspIndustriesInitialized = true;

  /**
   * Helpers
   */
  const $ = (selector, parent = document) => parent.querySelector(selector);

  const $$ = (selector, parent = document) =>
    Array.from(parent.querySelectorAll(selector));

  /**
   * Elements
   */
  const wrap = $("#ind-bento-wrap");
  const grid = $("#ind-bento-grid");

  /**
   * Exit safely
   */
  if (!wrap || !grid) {
    return;
  }

  const cards = $$(".ind-card", grid);

  if (!cards.length) {
    return;
  }

  /**
   * Reduced motion
   */
  const prefersReducedMotion =
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /**
   * Touch device detection
   */
  const isTouchDevice =
    "ontouchstart" in window || navigator.maxTouchPoints > 0;

  /**
   * State
   */
  let raf = null;
  let mouseX = 50;
  let mouseY = 50;

  /**
   * Update spotlight position
   */
  function updateSpotlight() {
    wrap.style.setProperty("--ind-mx", `${mouseX}%`);
    wrap.style.setProperty("--ind-my", `${mouseY}%`);

    raf = null;
  }

  /**
   * Mouse move handler
   */
  function handleMouseMove(event) {
    if (prefersReducedMotion || isTouchDevice) {
      return;
    }

    const rect = wrap.getBoundingClientRect();

    mouseX = ((event.clientX - rect.left) / rect.width) * 100;

    mouseY = ((event.clientY - rect.top) / rect.height) * 100;

    if (!raf) {
      raf = window.requestAnimationFrame(updateSpotlight);
    }
  }

  /**
   * Activate spotlight
   */
  function activateSpotlight(card) {
    grid.classList.add("ind-spotlit");

    cards.forEach((item) => {
      item.classList.remove("ind-active");
    });

    if (card) {
      card.classList.add("ind-active");
    }
  }

  /**
   * Reset spotlight
   */
  function resetSpotlight() {
    grid.classList.remove("ind-spotlit");

    cards.forEach((card) => {
      card.classList.remove("ind-active");
    });
  }

  /**
   * Bind card interactions
   */
  function bindCardEvents() {
    cards.forEach((card) => {
      /**
       * Hover
       */
      card.addEventListener("mouseenter", () => {
        activateSpotlight(card);
      });

      card.addEventListener("mouseleave", () => {
        resetSpotlight();
      });

      /**
       * Keyboard accessibility
       */
      card.addEventListener("focusin", () => {
        activateSpotlight(card);
      });

      card.addEventListener("focusout", () => {
        resetSpotlight();
      });

      /**
       * Touch support
       */
      if (isTouchDevice) {
        card.addEventListener(
          "touchstart",
          () => {
            activateSpotlight(card);
          },
          { passive: true },
        );
      }
    });
  }

  /**
   * Reset spotlight on wrap leave
   */
  function bindContainerEvents() {
    wrap.addEventListener("mouseleave", resetSpotlight);

    if (!prefersReducedMotion && !isTouchDevice) {
      wrap.addEventListener("mousemove", handleMouseMove, { passive: true });
    }
  }

  /**
   * Cleanup
   */
  function cleanup() {
    if (raf) {
      cancelAnimationFrame(raf);
      raf = null;
    }
  }

  /**
   * Init
   */
  function init() {
    if (prefersReducedMotion) {
      wrap.classList.add("ind-reduced-motion");
    }

    bindContainerEvents();
    bindCardEvents();
  }

  /**
   * Cleanup before unload
   */
  window.addEventListener("beforeunload", cleanup);

  init();
})();
