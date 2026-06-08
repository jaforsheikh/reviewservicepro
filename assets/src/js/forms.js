/**
 * ReviewServicePro Forms
 *
 * Features:
 * - Field focus states
 * - Required field validation
 * - Email validation
 * - Phone validation
 * - Error message handling
 * - Success/error notice reveal
 * - Double submit protection
 * - Multi-step form support
 * - Tag/checkbox selection UX
 * - Accessible validation feedback
 */

(function () {
  "use strict";

  /**
   * Prevent duplicate initialization
   */
  if (window.__rspFormsInitialized) {
    return;
  }

  window.__rspFormsInitialized = true;

  /**
   * Helpers
   */
  const $ = (selector, parent = document) => parent.querySelector(selector);

  const $$ = (selector, parent = document) =>
    Array.from(parent.querySelectorAll(selector));

  /**
   * Selectors
   */
  const FORM_SELECTOR = "[data-rsp-form]";
  const FIELD_SELECTOR = "input, textarea, select";
  const ERROR_CLASS = "rsp-field-error";
  const INVALID_CLASS = "is-invalid";
  const VALID_CLASS = "is-valid";
  const FOCUSED_CLASS = "is-focused";

  /**
   * Validation helpers
   */
  function isEmpty(value) {
    return !String(value || "").trim();
  }

  function isValidEmail(value) {
    if (isEmpty(value)) {
      return false;
    }

    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(value).trim());
  }

  function isValidPhone(value) {
    if (isEmpty(value)) {
      return true;
    }

    return /^[0-9+\-\s().]{7,20}$/.test(String(value).trim());
  }

  function getFieldWrapper(field) {
    return (
      field.closest("[data-rsp-field]") ||
      field.closest(".rsp-field") ||
      field.closest(".form-field") ||
      field.parentElement
    );
  }

  function getFieldLabel(field) {
    const wrapper = getFieldWrapper(field);

    if (!wrapper) {
      return "This field";
    }

    const label = wrapper.querySelector("label");

    if (label) {
      return label.textContent.replace("*", "").trim() || "This field";
    }

    const ariaLabel = field.getAttribute("aria-label");

    if (ariaLabel) {
      return ariaLabel;
    }

    const placeholder = field.getAttribute("placeholder");

    if (placeholder) {
      return placeholder;
    }

    return "This field";
  }

  function getErrorId(field) {
    if (!field.id) {
      field.id = `rsp-field-${Math.random().toString(36).slice(2, 10)}`;
    }

    return `${field.id}-error`;
  }

  function showFieldError(field, message) {
    const wrapper = getFieldWrapper(field);

    if (!wrapper) {
      return;
    }

    const errorId = getErrorId(field);

    let error = wrapper.querySelector(`#${errorId}`);

    if (!error) {
      error = document.createElement("p");
      error.id = errorId;
      error.className =
        "rsp-field-error mt-2 text-xs font-semibold text-red-300";
      wrapper.appendChild(error);
    }

    error.textContent = message;

    field.classList.add(INVALID_CLASS);
    field.classList.remove(VALID_CLASS);
    field.setAttribute("aria-invalid", "true");
    field.setAttribute("aria-describedby", errorId);

    wrapper.classList.add(INVALID_CLASS);
  }

  function clearFieldError(field) {
    const wrapper = getFieldWrapper(field);

    if (!wrapper) {
      return;
    }

    const errorId = getErrorId(field);
    const error = wrapper.querySelector(`#${errorId}`);

    if (error) {
      error.remove();
    }

    field.classList.remove(INVALID_CLASS);
    field.setAttribute("aria-invalid", "false");

    if (field.value && String(field.value).trim()) {
      field.classList.add(VALID_CLASS);
    } else {
      field.classList.remove(VALID_CLASS);
    }

    wrapper.classList.remove(INVALID_CLASS);
  }

  function validateField(field) {
    if (!field || field.disabled || field.type === "hidden") {
      return true;
    }

    const value = field.value;
    const label = getFieldLabel(field);
    const type = field.getAttribute("type");
    const required =
      field.required || field.getAttribute("aria-required") === "true";

    clearFieldError(field);

    if (required && isEmpty(value)) {
      showFieldError(field, `${label} is required.`);
      return false;
    }

    if (!isEmpty(value) && type === "email" && !isValidEmail(value)) {
      showFieldError(field, "Please enter a valid email address.");
      return false;
    }

    if (
      !isEmpty(value) &&
      (type === "tel" || field.dataset.validate === "phone") &&
      !isValidPhone(value)
    ) {
      showFieldError(field, "Please enter a valid phone number.");
      return false;
    }

    return true;
  }

  function validateForm(form) {
    const fields = $$(FIELD_SELECTOR, form);
    let isValid = true;
    let firstInvalid = null;

    fields.forEach((field) => {
      const valid = validateField(field);

      if (!valid) {
        isValid = false;

        if (!firstInvalid) {
          firstInvalid = field;
        }
      }
    });

    if (firstInvalid) {
      firstInvalid.focus();

      const wrapper = getFieldWrapper(firstInvalid);

      if (wrapper) {
        wrapper.scrollIntoView({
          behavior: "smooth",
          block: "center",
        });
      }
    }

    return isValid;
  }

  /**
   * Notice helpers
   */
  function showNotice(form, type, message) {
    let notice = form.querySelector("[data-rsp-form-notice]");

    if (!notice) {
      notice = document.createElement("div");
      notice.setAttribute("data-rsp-form-notice", "");
      notice.setAttribute("role", "status");
      notice.className =
        "mb-5 rounded-2xl border px-4 py-3 text-sm font-semibold";
      form.prepend(notice);
    }

    notice.textContent = message;
    notice.classList.remove(
      "border-emerald-500/30",
      "bg-emerald-500/10",
      "text-emerald-300",
      "border-red-500/30",
      "bg-red-500/10",
      "text-red-300",
    );

    if (type === "success") {
      notice.classList.add(
        "border-emerald-500/30",
        "bg-emerald-500/10",
        "text-emerald-300",
      );
    } else {
      notice.classList.add(
        "border-red-500/30",
        "bg-red-500/10",
        "text-red-300",
      );
    }

    notice.classList.remove("hidden");
  }

  /**
   * Submit button loading state
   */
  function setSubmitting(form, submitting) {
    const button =
      form.querySelector('[type="submit"]') ||
      form.querySelector("[data-rsp-submit]");

    if (!button) {
      return;
    }

    if (submitting) {
      if (!button.dataset.originalText) {
        button.dataset.originalText = button.textContent.trim();
      }

      button.disabled = true;
      button.setAttribute("aria-busy", "true");
      button.classList.add("opacity-70", "cursor-not-allowed");
      button.textContent = button.dataset.loadingText || "Submitting...";
    } else {
      button.disabled = false;
      button.setAttribute("aria-busy", "false");
      button.classList.remove("opacity-70", "cursor-not-allowed");

      if (button.dataset.originalText) {
        button.textContent = button.dataset.originalText;
      }
    }
  }

  /**
   * Focus state
   */
  function initFieldFocus(form) {
    $$(FIELD_SELECTOR, form).forEach((field) => {
      const wrapper = getFieldWrapper(field);

      if (!wrapper) {
        return;
      }

      field.addEventListener("focus", () => {
        wrapper.classList.add(FOCUSED_CLASS);
      });

      field.addEventListener("blur", () => {
        wrapper.classList.remove(FOCUSED_CLASS);
        validateField(field);
      });

      field.addEventListener("input", () => {
        if (field.classList.contains(INVALID_CLASS)) {
          validateField(field);
        }
      });

      field.addEventListener("change", () => {
        validateField(field);
      });
    });
  }

  /**
   * Tag / checkbox selection UX
   *
   * Expected:
   * - [data-rsp-choice]
   * - input[type="checkbox"] inside
   */
  function initChoiceCards(form) {
    $$("[data-rsp-choice]", form).forEach((choice) => {
      const input = choice.querySelector(
        'input[type="checkbox"], input[type="radio"]',
      );

      if (!input) {
        return;
      }

      const sync = () => {
        choice.classList.toggle("is-selected", input.checked);
        choice.classList.toggle("border-blue-500/50", input.checked);
        choice.classList.toggle("bg-blue-600/[0.08]", input.checked);
      };

      input.addEventListener("change", sync);
      sync();
    });
  }

  /**
   * Multi-step form support
   *
   * Expected:
   * - [data-rsp-step]
   * - [data-rsp-next]
   * - [data-rsp-prev]
   * - [data-rsp-step-current]
   */
  function initMultiStep(form) {
    const steps = $$("[data-rsp-step]", form);

    if (!steps.length) {
      return;
    }

    const nextButtons = $$("[data-rsp-next]", form);
    const prevButtons = $$("[data-rsp-prev]", form);
    const currentEls = $$("[data-rsp-step-current]", form);
    const totalEls = $$("[data-rsp-step-total]", form);

    let currentStep = 0;

    const updateStep = () => {
      steps.forEach((step, index) => {
        const active = index === currentStep;

        step.classList.toggle("hidden", !active);
        step.setAttribute("aria-hidden", active ? "false" : "true");
      });

      currentEls.forEach((el) => {
        el.textContent = String(currentStep + 1);
      });

      totalEls.forEach((el) => {
        el.textContent = String(steps.length);
      });
    };

    const validateCurrentStep = () => {
      const fields = $$(FIELD_SELECTOR, steps[currentStep]);
      let valid = true;

      fields.forEach((field) => {
        if (!validateField(field)) {
          valid = false;
        }
      });

      return valid;
    };

    nextButtons.forEach((button) => {
      button.addEventListener("click", () => {
        if (!validateCurrentStep()) {
          return;
        }

        currentStep = Math.min(currentStep + 1, steps.length - 1);
        updateStep();
      });
    });

    prevButtons.forEach((button) => {
      button.addEventListener("click", () => {
        currentStep = Math.max(currentStep - 1, 0);
        updateStep();
      });
    });

    updateStep();
  }

  /**
   * Submission handler
   */
  function initSubmit(form) {
    form.addEventListener("submit", (event) => {
      const shouldValidate = form.dataset.rspValidate !== "false";

      if (shouldValidate && !validateForm(form)) {
        event.preventDefault();
        showNotice(
          form,
          "error",
          "Please fix the highlighted fields before submitting.",
        );
        return;
      }

      if (form.dataset.rspAjax === "true") {
        event.preventDefault();
        showNotice(form, "error", "AJAX submission is not configured yet.");
        return;
      }

      setSubmitting(form, true);
    });
  }

  /**
   * Initialize one form
   */
  function initForm(form) {
    if (!form || form.dataset.rspReady === "true") {
      return;
    }

    form.dataset.rspReady = "true";

    initFieldFocus(form);
    initChoiceCards(form);
    initMultiStep(form);
    initSubmit(form);
  }

  /**
   * Init all forms
   */
  function initForms() {
    $$(FORM_SELECTOR).forEach(initForm);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initForms);
  } else {
    initForms();
  }
})();
