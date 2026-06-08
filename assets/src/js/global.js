/**
 * ReviewServicePro Global JavaScript
 *
 * Handles:
 * - Mobile menu
 * - Sticky header state
 * - Header height CSS variable
 * - Smooth anchor scrolling
 * - Back to top button
 * - Lucide icon refresh
 * - Accessibility helpers
 */

(function () {
  "use strict";

  /**
   * Safe query helpers
   */
  const $ = (selector, parent = document) => parent.querySelector(selector);
  const $$ = (selector, parent = document) =>
    Array.from(parent.querySelectorAll(selector));

  /**
   * Refresh Lucide icons safely
   */
  function refreshIcons() {
    if (window.lucide && typeof window.lucide.createIcons === "function") {
      window.lucide.createIcons();
    }
  }

  /**
   * Set CSS variable for header height
   */
  function setHeaderHeight() {
    const header = $("#site-header");

    if (!header) {
      return;
    }

    const height = header.offsetHeight || 0;
    document.documentElement.style.setProperty(
      "--rsp-header-height",
      `${height}px`,
    );
  }

  /**
   * Sticky header scroll state
   */
  function initStickyHeader() {
    const header = $("#site-header");

    if (!header) {
      return;
    }

    let ticking = false;

    const updateHeader = () => {
      const isScrolled = window.scrollY > 12;

      header.classList.toggle("is-scrolled", isScrolled);
      header.classList.toggle(
        "shadow-[0_12px_40px_rgba(0,0,0,0.25)]",
        isScrolled,
      );
      header.classList.toggle("backdrop-blur-xl", isScrolled);

      ticking = false;
    };

    const onScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(updateHeader);
        ticking = true;
      }
    };

    updateHeader();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  /**
   * Mobile menu
   *
   * Expected IDs/classes:
   * - #mobile-menu-toggle
   * - #mobile-menu
   * - [data-mobile-menu-close]
   */
  function initMobileMenu() {
    const toggle = $("#mobile-menu-toggle");
    const menu = $("#mobile-menu");

    if (!toggle || !menu) {
      return;
    }

    const closeButtons = $$("[data-mobile-menu-close]");
    const focusableSelectors = [
      "a[href]",
      "button:not([disabled])",
      "textarea:not([disabled])",
      "input:not([disabled])",
      "select:not([disabled])",
      '[tabindex]:not([tabindex="-1"])',
    ].join(",");

    let previousFocus = null;

    const isOpen = () => toggle.getAttribute("aria-expanded") === "true";

    const openMenu = () => {
      previousFocus = document.activeElement;

      toggle.setAttribute("aria-expanded", "true");
      menu.classList.remove("hidden");
      menu.classList.add("flex");
      document.body.classList.add("overflow-hidden");

      const firstFocusable = $(focusableSelectors, menu);

      if (firstFocusable) {
        setTimeout(() => firstFocusable.focus(), 50);
      }

      refreshIcons();
    };

    const closeMenu = () => {
      toggle.setAttribute("aria-expanded", "false");
      menu.classList.add("hidden");
      menu.classList.remove("flex");
      document.body.classList.remove("overflow-hidden");

      if (previousFocus && typeof previousFocus.focus === "function") {
        previousFocus.focus();
      }
    };

    const toggleMenu = () => {
      if (isOpen()) {
        closeMenu();
      } else {
        openMenu();
      }
    };

    toggle.addEventListener("click", toggleMenu);

    closeButtons.forEach((button) => {
      button.addEventListener("click", closeMenu);
    });

    menu.addEventListener("click", (event) => {
      const target = event.target;

      if (!(target instanceof HTMLElement)) {
        return;
      }

      if (target.matches("a[href]")) {
        closeMenu();
      }

      if (target.dataset.mobileMenuBackdrop === "true") {
        closeMenu();
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && isOpen()) {
        closeMenu();
      }
    });

    window.addEventListener("resize", () => {
      if (window.innerWidth >= 1024 && isOpen()) {
        closeMenu();
      }

      setHeaderHeight();
    });
  }

  /**
   * Smooth anchor scrolling
   */
  function initSmoothAnchors() {
    $$('a[href^="#"]').forEach((link) => {
      link.addEventListener("click", (event) => {
        const href = link.getAttribute("href");

        if (!href || href === "#") {
          return;
        }

        const target = $(href);

        if (!target) {
          return;
        }

        event.preventDefault();

        const headerHeight =
          parseInt(
            getComputedStyle(document.documentElement).getPropertyValue(
              "--rsp-header-height",
            ),
            10,
          ) || 0;

        const targetTop =
          target.getBoundingClientRect().top +
          window.scrollY -
          headerHeight -
          20;

        window.scrollTo({
          top: targetTop,
          behavior: "smooth",
        });

        target.setAttribute("tabindex", "-1");
        target.focus({ preventScroll: true });
      });
    });
  }

  /**
   * Back to top button
   *
   * Expected:
   * - #back-to-top
   */
  function initBackToTop() {
    const button = $("#back-to-top");

    if (!button) {
      return;
    }

    let ticking = false;

    const updateButton = () => {
      const show = window.scrollY > 500;

      button.classList.toggle("opacity-100", show);
      button.classList.toggle("pointer-events-auto", show);
      button.classList.toggle("translate-y-0", show);

      button.classList.toggle("opacity-0", !show);
      button.classList.toggle("pointer-events-none", !show);
      button.classList.toggle("translate-y-4", !show);

      ticking = false;
    };

    const onScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(updateButton);
        ticking = true;
      }
    };

    button.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });

    updateButton();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  /**
   * External links security helper
   */
  function initExternalLinks() {
    $$('a[target="_blank"]').forEach((link) => {
      const rel = link.getAttribute("rel") || "";

      if (!rel.includes("noopener")) {
        link.setAttribute("rel", `${rel} noopener noreferrer`.trim());
      }
    });
  }

  /**
   * Form UX helpers
   */
  function initFormEnhancements() {
    $$("input, textarea, select").forEach((field) => {
      field.addEventListener("focus", () => {
        field
          .closest("label, .form-field, .rsp-field")
          ?.classList.add("is-focused");
      });

      field.addEventListener("blur", () => {
        field
          .closest("label, .form-field, .rsp-field")
          ?.classList.remove("is-focused");
      });
    });
  }

  /**
   * Global accordion fallback
   *
   * Expected:
   * - [data-accordion]
   * - [data-accordion-button]
   * - [data-accordion-panel]
   */
  function initAccordions() {
    $$("[data-accordion]").forEach((accordion) => {
      const buttons = $$("[data-accordion-button]", accordion);

      buttons.forEach((button) => {
        button.addEventListener("click", () => {
          const item = button.closest("[data-accordion-item]");
          const panel = item ? $("[data-accordion-panel]", item) : null;

          if (!item || !panel) {
            return;
          }

          const currentlyOpen = button.getAttribute("aria-expanded") === "true";

          $$("[data-accordion-item]", accordion).forEach((otherItem) => {
            const otherButton = $("[data-accordion-button]", otherItem);
            const otherPanel = $("[data-accordion-panel]", otherItem);

            if (otherButton && otherPanel) {
              otherButton.setAttribute("aria-expanded", "false");
              otherPanel.classList.add("hidden");
              otherItem.classList.remove("is-open");
            }
          });

          if (!currentlyOpen) {
            button.setAttribute("aria-expanded", "true");
            panel.classList.remove("hidden");
            item.classList.add("is-open");
          }
        });
      });
    });
  }

  /**
   * Add loaded class
   */
  function initPageLoadedState() {
    document.documentElement.classList.add("rsp-js-ready");

    window.addEventListener("load", () => {
      document.documentElement.classList.add("rsp-page-loaded");
    });
  }

  /**
   * Init all
   */
  function init() {
    setHeaderHeight();
    initStickyHeader();
    initMobileMenu();
    initSmoothAnchors();
    initBackToTop();
    initExternalLinks();
    initFormEnhancements();
    initAccordions();
    initPageLoadedState();
    refreshIcons();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }

  window.addEventListener("resize", setHeaderHeight);
})();
