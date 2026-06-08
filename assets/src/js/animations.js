/**
 * ReviewServicePro Animations
 *
 * Architecture:
 * - One animation engine
 * - Section-by-section init functions
 * - Safe GSAP + ScrollTrigger usage
 * - Reduced motion support
 * - Missing element safe
 * - Future scalable
 */

(function () {
  "use strict";

  /**
   * Core Helpers
   */
  const SELECTORS = {
    hero: '[data-gsap="hero-animate"]',
    trust: '[data-gsap="trust-animate"]',
    problem: '[data-gsap="problem-animate"]',
    services: '[data-gsap="services-animate"]',
    industries: '[data-gsap="industries-animate"]',
    reputationIntelligence: '[data-gsap="ri-animate"]',
    caseStudies: '[data-gsap="cs-animate"]',
    academy: '[data-gsap="academy-animate"]',
    faq: '[data-gsap="faq-animate"]',
    cta: '[data-gsap="cta-animate"]',
    platformHero: '[data-gsap="platform-hero"]',
    platformOverview: '[data-gsap="platform-overview"]',
    platformProblems: '[data-gsap="platform-problems"]',
    platformContent: '[data-gsap="platform-content"]',
    platformRelated: '[data-gsap="platform-related"]',
    platformCta: '[data-gsap="platform-cta"]',
  };

  const $ = (selector, parent = document) => parent.querySelector(selector);
  const $$ = (selector, parent = document) =>
    Array.from(parent.querySelectorAll(selector));

  const hasGsap = () =>
    typeof window.gsap !== "undefined" && typeof window.gsap.to === "function";

  const hasScrollTrigger = () => typeof window.ScrollTrigger !== "undefined";

  const prefersReducedMotion = () =>
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function registerGsapPlugins() {
    if (!hasGsap() || !hasScrollTrigger()) {
      return false;
    }

    window.gsap.registerPlugin(window.ScrollTrigger);
    return true;
  }

  function refreshScrollTrigger(delay = 350) {
    if (!hasScrollTrigger()) {
      return;
    }

    window.setTimeout(() => {
      window.ScrollTrigger.refresh();
    }, delay);
  }

  function makeVisible(elements) {
    const items = Array.isArray(elements)
      ? elements
      : Array.from(elements || []);

    items.forEach((el) => {
      if (!el) return;

      el.style.opacity = "1";
      el.style.transform = "translateY(0)";
      el.style.visibility = "visible";
    });
  }

  function animateFromTo(targets, fromVars, toVars) {
    if (!hasGsap() || prefersReducedMotion()) {
      makeVisible($$(targets));
      return;
    }

    window.gsap.fromTo(targets, fromVars, toVars);
  }

  function fadeUp(targets, options = {}) {
    if (!hasGsap()) {
      makeVisible(Array.isArray(targets) ? targets : $$(targets));
      return;
    }

    const items =
      typeof targets === "string"
        ? $$(targets)
        : Array.isArray(targets)
          ? targets.filter(Boolean)
          : Array.from(targets || []);

    if (!items.length) {
      return;
    }

    if (prefersReducedMotion()) {
      makeVisible(items);
      return;
    }

    const {
      trigger = items[0],
      start = "top 86%",
      y = 28,
      duration = 0.65,
      stagger = 0.08,
      ease = "power3.out",
      once = true,
      scale = 1,
    } = options;

    window.gsap.fromTo(
      items,
      {
        opacity: 0,
        y,
        scale,
      },
      {
        opacity: 1,
        y: 0,
        scale: 1,
        duration,
        stagger,
        ease,
        scrollTrigger: hasScrollTrigger()
          ? {
              trigger,
              start,
              once,
            }
          : undefined,
      },
    );
  }

  function fadeIn(target, options = {}) {
    const el = typeof target === "string" ? $(target) : target;

    if (!el) {
      return;
    }

    if (!hasGsap() || prefersReducedMotion()) {
      makeVisible([el]);
      return;
    }

    const {
      trigger = el,
      start = "top 86%",
      y = 24,
      x = 0,
      duration = 0.65,
      ease = "power3.out",
      once = true,
      scale = 1,
    } = options;

    window.gsap.fromTo(
      el,
      {
        opacity: 0,
        y,
        x,
        scale,
      },
      {
        opacity: 1,
        y: 0,
        x: 0,
        scale: 1,
        duration,
        ease,
        scrollTrigger: hasScrollTrigger()
          ? {
              trigger,
              start,
              once,
            }
          : undefined,
      },
    );
  }

  function revealUnderline(selector, trigger, start = "top 75%") {
    const underline = $(selector);
    const triggerEl = typeof trigger === "string" ? $(trigger) : trigger;

    if (!underline || !triggerEl) {
      return;
    }

    if (!hasScrollTrigger() || prefersReducedMotion()) {
      underline.classList.add("scale-x-100");
      return;
    }

    window.ScrollTrigger.create({
      trigger: triggerEl,
      start,
      once: true,
      onEnter: () => underline.classList.add("scale-x-100"),
    });
  }

  function animateCounterElement(el, duration = 1800) {
    if (!el) {
      return;
    }

    const target = Number.parseInt(el.dataset.target || "0", 10);

    if (Number.isNaN(target)) {
      el.textContent = "0";
      return;
    }

    if (prefersReducedMotion()) {
      el.textContent = target.toLocaleString();
      return;
    }

    const startTime = performance.now();

    const tick = (now) => {
      const progress = Math.min((now - startTime) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const value = Math.floor(eased * target);

      el.textContent = value.toLocaleString();

      if (progress < 1) {
        window.requestAnimationFrame(tick);
      } else {
        el.textContent = target.toLocaleString();
      }
    };

    window.requestAnimationFrame(tick);
  }

  function initCounters(selector = ".trust-counter") {
    const counters = $$(selector);

    if (!counters.length) {
      return;
    }

    if (!("IntersectionObserver" in window)) {
      counters.forEach((counter) => animateCounterElement(counter));
      return;
    }

    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;

          animateCounterElement(entry.target);
          obs.unobserve(entry.target);
        });
      },
      {
        threshold: 0.25,
      },
    );

    counters.forEach((counter) => observer.observe(counter));
  }

  /**
   * Hero Animation
   */
  function initHeroAnimation() {
    const section = $(SELECTORS.hero);

    if (!section) {
      return;
    }

    const order = [
      "eyebrow",
      "headline",
      "subline",
      "cta-row",
      "stats",
      "trust-bar",
    ];

    const items = order
      .map((item) => $(`[data-gsap-item="${item}"]`, section))
      .filter(Boolean);

    if (!items.length) {
      return;
    }

    if (!hasGsap() || prefersReducedMotion()) {
      makeVisible(items);
      return;
    }

    window.gsap.set(items, {
      opacity: 0,
      y: 28,
    });

    const timeline = window.gsap.timeline({
      defaults: {
        ease: "power3.out",
        duration: 0.78,
      },
    });

    items.forEach((item, index) => {
      timeline.to(
        item,
        {
          opacity: 1,
          y: 0,
        },
        index === 0 ? undefined : "-=0.42",
      );
    });
  }

  /**
   * Generic Homepage Trust Section
   */
  function initTrustSection() {
    const section = $(SELECTORS.trust);

    if (!section) {
      return;
    }

    fadeUp($$("[data-gsap-item]", section), {
      trigger: section,
      start: "top 82%",
      stagger: 0.1,
    });

    initCounters(".trust-counter");
  }

  /**
   * Problem Section
   */
  function initProblemSection() {
    const section = $(SELECTORS.problem);

    if (!section) {
      return;
    }

    const heading = $('[data-gsap-item="problem-heading"]', section);
    const cards = $$('[data-gsap-item="problem-cards"] > article', section);
    const cta = $('[data-gsap-item="problem-cta"]', section);

    fadeUp([heading, ...cards, cta].filter(Boolean), {
      trigger: section,
      start: "top 82%",
      stagger: 0.09,
    });
  }

  /**
   * Services Overview Section
   */
  function initServicesSection() {
    const section = $(SELECTORS.services);

    if (!section) {
      return;
    }

    fadeUp($$("[data-gsap-item]", section), {
      trigger: section,
      start: "top 82%",
      y: 36,
      stagger: 0.12,
      duration: 0.75,
    });
  }

  /**
   * ORM Timeline
   */
  function initOrmTimeline() {
    const timeline = $("#orm-timeline");

    if (!timeline) {
      return;
    }

    const steps = $$(".orm-tl-step", timeline);
    const progress = $(".orm-timeline-progress", timeline);

    if (!steps.length) {
      return;
    }

    if (prefersReducedMotion()) {
      steps.forEach((step) => step.classList.add("is-active"));
      if (progress) progress.style.width = "90%";
      return;
    }

    if (!("IntersectionObserver" in window)) {
      steps.forEach((step) => step.classList.add("is-active"));
      if (progress) progress.style.width = "90%";
      return;
    }

    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;

          steps.forEach((step, index) => {
            window.setTimeout(() => {
              const icon = $(".orm-tl-icon", step);
              const iconColor = $(".orm-tl-icon-color", step);
              const label = $(".orm-tl-label", step);
              const desc = $(".orm-tl-desc", step);

              step.classList.add("is-active");

              if (icon) {
                icon.classList.add("border-blue-400/40", "bg-blue-500/10");
              }

              if (iconColor) {
                iconColor.classList.remove("text-slate-600");
                iconColor.classList.add("text-blue-400");
              }

              if (label) {
                label.classList.remove("text-slate-500");
                label.classList.add("text-white");
              }

              if (desc) {
                desc.classList.remove("text-slate-600");
                desc.classList.add("text-slate-400");
              }

              if (progress && steps.length > 1) {
                const width = (index / (steps.length - 1)) * 90;
                progress.style.width = `${width}%`;
              }
            }, index * 200);
          });

          obs.unobserve(entry.target);
        });
      },
      {
        threshold: 0.35,
      },
    );

    observer.observe(timeline);
  }

  /**
   * Industries Homepage Section
   */
  function initIndustriesSection() {
    const section = $(SELECTORS.industries);

    if (!section) {
      return;
    }

    const heading = $('[data-gsap-item="ind-heading"]', section);
    const cards = $$("#ind-bento-grid .ind-card", section);
    const cta = $('[data-gsap-item="ind-cta"]', section);

    revealUnderline(".ind-underline", section);

    fadeUp([heading, ...cards, cta].filter(Boolean), {
      trigger: section,
      start: "top 82%",
      stagger: 0.08,
    });
  }

  /**
   * Reputation Intelligence Section
   */
  function initReputationIntelligence() {
    const section = $(SELECTORS.reputationIntelligence);

    if (!section) {
      return;
    }

    revealUnderline(".ri-underline", section);

    fadeIn('[data-gsap-item="ri-heading"]', {
      trigger: section,
      start: "top 80%",
    });

    fadeUp('[data-gsap-item="ri-stats"] > div', {
      trigger: $('[data-gsap-item="ri-stats"]', section),
      start: "top 84%",
      stagger: 0.1,
    });

    fadeIn('[data-gsap-item="ri-dashboard"]', {
      trigger: $('[data-gsap-item="ri-dashboard"]', section),
      start: "top 82%",
      y: 30,
      scale: 0.98,
      duration: 0.75,
    });

    fadeUp('[data-gsap-item="ri-metrics"] > div', {
      trigger: $('[data-gsap-item="ri-metrics"]', section),
      start: "top 84%",
      y: 20,
      stagger: 0.08,
    });

    fadeIn('[data-gsap-item="ri-cta"]', {
      trigger: $('[data-gsap-item="ri-cta"]', section),
      start: "top 92%",
      y: 16,
    });

    initCounters(".ri-counter");
  }

  /**
   * Case Studies Preview
   */
  function initCaseStudiesPreview() {
    const section = $(SELECTORS.caseStudies);

    if (!section) {
      return;
    }

    const cards = $$('[data-gsap-item="cs-cards"] > article', section);

    revealUnderline(".cs-underline", section);

    fadeIn('[data-gsap-item="cs-heading"]', {
      trigger: section,
      start: "top 80%",
    });

    fadeUp(cards, {
      trigger: $('[data-gsap-item="cs-cards"]', section),
      start: "top 88%",
      y: 30,
      stagger: 0.1,
    });

    fadeIn('[data-gsap-item="cs-cta"]', {
      trigger: $('[data-gsap-item="cs-cta"]', section),
      start: "top 94%",
      y: 16,
    });
  }

  /**
   * ORM Academy Preview
   */
  function initAcademyPreview() {
    const section = $(SELECTORS.academy);

    if (!section) {
      return;
    }

    const cards = $$('[data-gsap-item="academy-cards"] article', section);

    revealUnderline(".academy-underline", section);

    fadeIn('[data-gsap-item="academy-heading"]', {
      trigger: section,
      start: "top 80%",
    });

    fadeUp('[data-gsap-item="academy-cats"] > span', {
      trigger: $('[data-gsap-item="academy-cats"]', section),
      start: "top 88%",
      y: 14,
      stagger: 0.05,
      duration: 0.45,
    });

    fadeUp(cards, {
      trigger: $('[data-gsap-item="academy-cards"]', section),
      start: "top 88%",
      y: 30,
      stagger: 0.1,
    });

    fadeIn('[data-gsap-item="academy-cta"]', {
      trigger: $('[data-gsap-item="academy-cta"]', section),
      start: "top 94%",
      y: 16,
    });
  }

  /**
   * FAQ Section
   */
  function initFaqSection() {
    const section = $(SELECTORS.faq);

    if (!section) {
      return;
    }

    const faqItems = $$(".faq-accordion-item", section);

    faqItems.forEach((item) => {
      const button = $(".faq-toggle", item);
      const answer = $(".faq-answer", item);
      const icon = $(".faq-icon", item);
      const number = $(".faq-number", item);
      const questionText = $(".faq-question-text", item);

      if (!button || !answer) {
        return;
      }

      button.addEventListener("click", () => {
        const isOpen = item.classList.contains("is-open");

        faqItems.forEach((otherItem) => {
          const otherButton = $(".faq-toggle", otherItem);
          const otherAnswer = $(".faq-answer", otherItem);
          const otherIcon = $(".faq-icon", otherItem);
          const otherNumber = $(".faq-number", otherItem);
          const otherQuestionText = $(".faq-question-text", otherItem);

          otherItem.classList.remove(
            "is-open",
            "border-blue-500/50",
            "bg-blue-600/[0.06]",
            "shadow-[0_0_50px_rgba(37,99,235,0.14)]",
          );

          otherAnswer?.classList.add("hidden");
          otherButton?.setAttribute("aria-expanded", "false");

          otherIcon?.classList.remove(
            "rotate-180",
            "border-blue-500/40",
            "bg-blue-600",
            "text-white",
            "shadow-lg",
            "shadow-blue-500/20",
          );

          otherNumber?.classList.remove(
            "border-blue-500/50",
            "bg-blue-600",
            "text-white",
            "shadow-lg",
            "shadow-blue-500/20",
          );

          otherQuestionText?.classList.remove("translate-x-1");
        });

        if (!isOpen) {
          item.classList.add(
            "is-open",
            "border-blue-500/50",
            "bg-blue-600/[0.06]",
            "shadow-[0_0_50px_rgba(37,99,235,0.14)]",
          );

          answer.classList.remove("hidden");
          button.setAttribute("aria-expanded", "true");

          icon?.classList.add(
            "rotate-180",
            "border-blue-500/40",
            "bg-blue-600",
            "text-white",
            "shadow-lg",
            "shadow-blue-500/20",
          );

          number?.classList.add(
            "border-blue-500/50",
            "bg-blue-600",
            "text-white",
            "shadow-lg",
            "shadow-blue-500/20",
          );

          questionText?.classList.add("translate-x-1");
        }
      });
    });

    revealUnderline(".faq-underline", section);

    fadeIn('[data-gsap-item="faq-heading"]', {
      trigger: section,
      start: "top 80%",
      y: 28,
    });

    fadeUp('[data-gsap-item="faq-accordion"] .faq-accordion-item', {
      trigger: $('[data-gsap-item="faq-accordion"]', section),
      start: "top 88%",
      y: 28,
      scale: 0.98,
      stagger: 0.06,
      ease: "back.out(1.25)",
    });
  }

  /**
   * Final CTA Section
   */
  function initFinalCta() {
    const section = $(SELECTORS.cta);

    if (!section) {
      return;
    }

    revealUnderline(".cta-underline", section);

    fadeIn('[data-gsap-item="cta-card"]', {
      trigger: section,
      start: "top 80%",
      y: 35,
      scale: 0.97,
      duration: 0.75,
    });

    fadeUp('[data-gsap-item="cta-trust"] > span', {
      trigger: $('[data-gsap-item="cta-trust"]', section),
      start: "top 88%",
      y: 14,
      stagger: 0.05,
      duration: 0.45,
    });

    fadeUp('[data-gsap-item="cta-steps"] > div', {
      trigger: $('[data-gsap-item="cta-steps"]', section),
      start: "top 88%",
      y: 24,
      scale: 0.98,
      stagger: 0.07,
      ease: "back.out(1.25)",
    });
  }

  /**
   * Footer
   */
  function initFooterAnimation() {
    const footer = $("#site-footer");

    if (!footer) {
      return;
    }

    const glow = $("#footer-mouse-glow");

    if (glow && !prefersReducedMotion()) {
      footer.addEventListener("mousemove", (event) => {
        const rect = footer.getBoundingClientRect();

        glow.style.left = `${event.clientX - rect.left}px`;
        glow.style.top = `${event.clientY - rect.top}px`;
      });

      footer.addEventListener("mouseleave", () => {
        glow.style.left = "50%";
        glow.style.top = "50%";
      });
    }

    fadeIn(".nl-bar", {
      trigger: footer,
      start: "top 90%",
      y: 16,
      duration: 0.5,
    });

    fadeUp(".footer-col", {
      trigger: footer,
      start: "top 88%",
      y: 24,
      stagger: 0.09,
    });

    fadeIn(".footer-cta-card", {
      trigger: $(".footer-cta-card", footer),
      start: "top 94%",
      scale: 0.97,
      y: 0,
    });

    fadeUp(".footer-social", {
      trigger: footer,
      start: "top 94%",
      y: 0,
      scale: 0.85,
      stagger: 0.05,
      ease: "back.out(1.4)",
    });
  }

  /**
   * Platform Pages
   */
  function initPlatformPages() {
    const hero = $(SELECTORS.platformHero);
    const overview = $(SELECTORS.platformOverview);
    const problems = $(SELECTORS.platformProblems);
    const content = $(SELECTORS.platformContent);
    const related = $(SELECTORS.platformRelated);
    const cta = $(SELECTORS.platformCta);

    if (hero) {
      fadeIn('[data-gsap-item="platform-hero-left"]', {
        trigger: hero,
        start: "top 80%",
        x: -24,
        y: 0,
      });

      fadeIn('[data-gsap-item="platform-hero-right"]', {
        trigger: hero,
        start: "top 80%",
        x: 24,
        y: 0,
        scale: 0.98,
      });
    }

    if (overview) {
      fadeIn('[data-gsap-item="platform-overview-left"]', {
        trigger: overview,
        start: "top 82%",
        x: -24,
        y: 0,
      });

      fadeIn('[data-gsap-item="platform-overview-right"]', {
        trigger: overview,
        start: "top 82%",
        x: 24,
        y: 0,
      });

      fadeUp(".platform-content-card", {
        trigger: overview,
        start: "top 86%",
        stagger: 0.08,
      });
    }

    if (problems) {
      fadeIn('[data-gsap-item="platform-problems-heading"]', {
        trigger: problems,
        start: "top 82%",
      });

      fadeUp('[data-gsap-item="platform-problems-cards"] > div', {
        trigger: $('[data-gsap-item="platform-problems-cards"]', problems),
        start: "top 86%",
        stagger: 0.08,
      });
    }

    if (content) {
      fadeIn('[data-gsap-item="platform-content-main"]', {
        trigger: content,
        start: "top 82%",
        x: -18,
        y: 0,
      });

      fadeIn('[data-gsap-item="platform-content-sidebar"]', {
        trigger: content,
        start: "top 82%",
        x: 18,
        y: 0,
      });
    }

    if (related) {
      fadeIn('[data-gsap-item="platform-related-heading"]', {
        trigger: related,
        start: "top 82%",
      });

      fadeUp('[data-gsap-item="platform-related-academy"] article', {
        trigger: related,
        start: "top 86%",
        stagger: 0.08,
      });

      fadeUp('[data-gsap-item="platform-related-cases"] article', {
        trigger: related,
        start: "top 86%",
        stagger: 0.08,
      });

      fadeUp('[data-gsap-item="platform-related-industries"] article', {
        trigger: related,
        start: "top 86%",
        stagger: 0.08,
      });
    }

    if (cta) {
      fadeIn(cta.querySelector("div"), {
        trigger: cta,
        start: "top 82%",
        y: 30,
        scale: 0.98,
      });
    }
  }

  /**
   * Generic CPT / Archive Cards
   */
  function initReusableCards() {
    const cardSelectors = [
      ".post-type-archive-platforms article",
      ".post-type-archive-industries article",
      ".post-type-archive-case_studies article",
      ".single-platforms article.group",
      ".single-industries article.group",
      ".single-case_studies article.group",
    ];

    cardSelectors.forEach((selector) => {
      const cards = $$(selector);

      if (!cards.length) {
        return;
      }

      fadeUp(cards, {
        trigger: cards[0].parentElement || cards[0],
        start: "top 88%",
        stagger: 0.06,
      });
    });
  }

  /**
   * Init All
   */
  function initAnimations() {
    registerGsapPlugins();

    if (prefersReducedMotion()) {
      document.documentElement.classList.add("rsp-reduced-motion");
    }

    initHeroAnimation();
    initTrustSection();
    initProblemSection();
    initServicesSection();
    initOrmTimeline();
    initIndustriesSection();
    initReputationIntelligence();
    initCaseStudiesPreview();
    initAcademyPreview();
    initFaqSection();
    initFinalCta();
    initFooterAnimation();
    initPlatformPages();
    initReusableCards();

    refreshScrollTrigger(600);

    if (window.lucide && typeof window.lucide.createIcons === "function") {
      window.lucide.createIcons();
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initAnimations);
  } else {
    initAnimations();
  }
})();
