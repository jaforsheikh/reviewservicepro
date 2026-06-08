<?php

/**
 * Home Section: FAQ
 *
 * White SaaS FAQ section for ReviewService.Pro.
 *
 * Preserved JS/animation hooks:
 * - id="faq"
 * - data-gsap="faq-animate"
 * - data-gsap-item="faq-heading"
 * - data-gsap-item="faq-accordion"
 * - faq-accordion-item
 * - faq-toggle
 * - faq-answer
 * - faq-number
 * - faq-question-text
 * - faq-icon
 * - faq-underline
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$faq_items = array(
  array(
    'q' => __('What is Online Reputation Management?', 'reviewservicepro'),
    'a' => __('Online Reputation Management is the process of monitoring, improving, and protecting how your business appears online across Google, review platforms, search results, and social media.', 'reviewservicepro'),
  ),
  array(
    'q' => __('Why does my business need reputation management?', 'reviewservicepro'),
    'a' => __('Customers often check reviews before they contact or buy from a business. A stronger reputation system can help build trust, improve confidence, and make your business look more reliable against competitors.', 'reviewservicepro'),
  ),
  array(
    'q' => __('Do you use fake reviews?', 'reviewservicepro'),
    'a' => __('No. We never buy, generate, or manipulate fake reviews. Our ORM process is ethical, platform-compliant, and focused on genuine customer feedback, review monitoring, documentation, and professional response support.', 'reviewservicepro'),
  ),
  array(
    'q' => __('Which platforms do you support?', 'reviewservicepro'),
    'a' => __('We help review, monitor, and support platforms such as Google Business Profile, Trustpilot, Yelp, Facebook, Tripadvisor, BBB, Sitejabber, G2, Capterra, Glassdoor, and other industry-specific review platforms where applicable.', 'reviewservicepro'),
  ),
  array(
    'q' => __('How long does reputation improvement take?', 'reviewservicepro'),
    'a' => __('The timeline depends on your current review profile, platform coverage, response gaps, customer feedback volume, and business category. We focus on transparent improvement steps instead of guaranteed timelines or artificial rating promises.', 'reviewservicepro'),
  ),
  array(
    'q' => __('Can you remove negative reviews?', 'reviewservicepro'),
    'a' => __('We cannot remove genuine customer reviews. If a review appears to violate a platform policy, we can help document the issue and guide you through the official reporting process while supporting professional response strategy.', 'reviewservicepro'),
  ),
  array(
    'q' => __('Can ORM improve Google local ranking?', 'reviewservicepro'),
    'a' => __('Online reputation management can support local trust signals such as review quality, response activity, profile completeness, and customer confidence. We do not promise guaranteed Google ranking outcomes.', 'reviewservicepro'),
  ),
  array(
    'q' => __('How do I get started?', 'reviewservicepro'),
    'a' => __('You can start with a reputation review or audit. We look at your current reputation presence, platform coverage, review response gaps, visible issues, and improvement opportunities before recommending the next step.', 'reviewservicepro'),
  ),
);
?>

<section
  id="faq"
  class="rsp-faq-section relative overflow-hidden border-t border-slate-200 bg-[#F8FAFC] py-24 md:py-32"
  role="region"
  aria-label="<?php esc_attr_e('Frequently Asked Questions', 'reviewservicepro'); ?>"
  data-gsap="faq-animate">
  <style>
    #faq {
      --faq-navy: #07111F;
      --faq-blue: #2563EB;
      --faq-green: #00C853;
      --faq-teal: #14B8A6;
      --faq-slate: #475569;
      --faq-border: rgba(15, 23, 42, 0.10);
    }

    #faq .rsp-faq-main-text {
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
    }

    #faq .faq-underline {
      transform-origin: left;
    }

    #faq:hover .faq-underline {
      transform: scaleX(1);
    }

    #faq .rsp-faq-motion-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      transform: translateY(0) scale(1);
      transition:
        transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 320ms ease,
        background-color 320ms ease;
    }

    #faq .rsp-faq-motion-card::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.28),
          rgba(20, 184, 166, 0.20),
          rgba(37, 99, 235, 0.28),
          rgba(37, 99, 235, 0.08));
      opacity: 0;
      transform: rotate(0deg);
      transition: opacity 280ms ease;
      animation: rspFaqBorderSpin 7s linear infinite;
    }

    #faq .rsp-faq-motion-card::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: #ffffff;
    }

    #faq .rsp-faq-motion-card:hover,
    #faq .rsp-faq-motion-card.is-open,
    #faq .rsp-faq-motion-card:has(.faq-toggle[aria-expanded="true"]) {
      transform: translateY(-6px) scale(1.006);
      border-color: rgba(37, 99, 235, 0.20);
      box-shadow: 0 26px 80px rgba(15, 23, 42, 0.12);
    }

    #faq .rsp-faq-motion-card:hover::before,
    #faq .rsp-faq-motion-card.is-open::before,
    #faq .rsp-faq-motion-card:has(.faq-toggle[aria-expanded="true"])::before {
      opacity: 1;
    }

    #faq .faq-toggle {
      position: relative;
    }

    #faq .faq-toggle::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.08), transparent 34%),
        radial-gradient(circle at 80% 50%, rgba(0, 200, 83, 0.07), transparent 34%);
      opacity: 0;
      transition: opacity 280ms ease;
      pointer-events: none;
    }

    #faq .faq-toggle:hover::before,
    #faq .faq-toggle[aria-expanded="true"]::before {
      opacity: 1;
    }

    #faq .faq-number,
    #faq .faq-icon {
      transition:
        transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
        background-color 280ms ease,
        border-color 280ms ease,
        color 280ms ease,
        box-shadow 280ms ease;
    }

    #faq .rsp-faq-motion-card:hover .faq-number,
    #faq .faq-toggle[aria-expanded="true"] .faq-number {
      transform: rotate(-4deg) scale(1.06);
      border-color: rgba(37, 99, 235, 0.18);
      background: #EFF6FF;
      color: #2563EB;
      box-shadow: 0 14px 34px rgba(37, 99, 235, 0.12);
    }

    #faq .rsp-faq-motion-card:hover .faq-icon,
    #faq .faq-toggle[aria-expanded="true"] .faq-icon {
      border-color: rgba(0, 200, 83, 0.22);
      background: #ECFDF5;
      color: #047857;
      box-shadow: 0 14px 34px rgba(0, 200, 83, 0.10);
    }

    #faq .faq-toggle[aria-expanded="true"] .faq-icon svg {
      transform: rotate(180deg);
    }

    #faq .faq-icon svg {
      transition: transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #faq .faq-question-text {
      transition: color 280ms ease, transform 280ms ease;
    }

    #faq .rsp-faq-motion-card:hover .faq-question-text,
    #faq .faq-toggle[aria-expanded="true"] .faq-question-text {
      color: #2563EB;
      transform: translateX(2px);
    }

    #faq .faq-answer {
      animation: rspFaqAnswerIn 320ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #faq .rsp-faq-answer-box {
      position: relative;
      overflow: hidden;
    }

    #faq .rsp-faq-answer-box::before {
      content: "";
      position: absolute;
      left: 0;
      top: 16px;
      bottom: 16px;
      width: 3px;
      border-radius: 999px;
      background: linear-gradient(180deg, #2563EB, #00C853);
    }

    #faq .rsp-faq-help-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #faq .rsp-faq-help-card::before {
      content: "";
      position: absolute;
      inset: -80px;
      z-index: -1;
      background:
        radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.12), transparent 28%),
        radial-gradient(circle at 80% 35%, rgba(0, 200, 83, 0.12), transparent 28%);
      animation: rspFaqGlowMove 8s ease-in-out infinite alternate;
    }

    #faq .rsp-faq-link {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        background-color 260ms ease,
        border-color 260ms ease;
    }

    #faq .rsp-faq-link::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.30), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
    }

    #faq .rsp-faq-link:hover {
      transform: translateY(-3px);
    }

    #faq .rsp-faq-link:hover::before {
      left: 135%;
    }

    @keyframes rspFaqBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspFaqAnswerIn {
      from {
        opacity: 0;
        transform: translateY(-8px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes rspFaqGlowMove {
      from {
        transform: translate3d(-18px, -10px, 0) scale(1);
      }

      to {
        transform: translate3d(18px, 12px, 0) scale(1.04);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #faq *,
      #faq *::before,
      #faq *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }
    }
  </style>

  <div
    class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.09),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.10),transparent_32%)]"
    aria-hidden="true"></div>

  <div
    class="pointer-events-none absolute left-1/2 top-0 z-0 h-px w-full max-w-6xl -translate-x-1/2 bg-gradient-to-r from-transparent via-slate-300 to-transparent"
    aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">

    <div class="mx-auto mb-14 max-w-3xl text-center" data-gsap-item="faq-heading">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-blue-700 shadow-sm">
        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-blue-600" aria-hidden="true"></span>
        <?php esc_html_e('FAQ Center', 'reviewservicepro'); ?>
      </span>

      <h2 class="mb-5 font-['Poppins',sans-serif] text-[clamp(34px,4.8vw,58px)] font-extrabold leading-[1.08] tracking-[-0.05em] text-[#07111F]">
        <?php esc_html_e('Questions?', 'reviewservicepro'); ?>
        <span class="relative inline-block">
          <span class="relative z-10 bg-gradient-to-r from-blue-600 via-[#00C853] to-blue-500 bg-clip-text text-transparent">
            <?php esc_html_e('Clear Answers.', 'reviewservicepro'); ?>
          </span>
          <span class="absolute inset-[-4px_-10px] z-0 rounded-lg border border-blue-200 bg-blue-50" aria-hidden="true"></span>
          <span class="faq-underline absolute -bottom-1 left-0 right-0 z-10 h-[2.5px] origin-left scale-x-0 rounded-full bg-gradient-to-r from-blue-600 via-[#00C853] to-transparent transition-transform duration-700" aria-hidden="true"></span>
        </span>
      </h2>

      <p class="rsp-faq-main-text mx-auto max-w-2xl font-['Inter',sans-serif] text-slate-600">
        <?php esc_html_e('Click any question to see the answer. Opening another question automatically closes the previous one.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="space-y-4" data-gsap-item="faq-accordion">
      <?php foreach ($faq_items as $index => $item) : ?>
        <article class="faq-accordion-item rsp-faq-motion-card group rounded-[1.5rem] border border-slate-200 bg-white shadow-[0_14px_44px_rgba(15,23,42,0.06)]">
          <button
            type="button"
            class="faq-toggle flex w-full items-center justify-between gap-4 px-5 py-5 text-left transition-all duration-300 md:px-6"
            aria-expanded="false">
            <span class="relative z-10 flex min-w-0 flex-1 items-center gap-4">
              <span class="faq-number flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 font-['DM_Mono',monospace] text-[13px] font-bold text-slate-700">
                <?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?>
              </span>

              <span class="faq-question-text block font-['Poppins',sans-serif] text-[18px] font-bold leading-snug tracking-[-0.02em] text-[#07111F] md:text-[20px]">
                <?php echo esc_html($item['q']); ?>
              </span>
            </span>

            <span class="faq-icon relative z-10 flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-600">
              <i data-lucide="chevron-down" class="h-5 w-5" aria-hidden="true"></i>
            </span>
          </button>

          <div class="faq-answer hidden border-t border-slate-200 px-5 pb-6 pt-5 md:px-6">
            <div class="rsp-faq-answer-box rounded-2xl border border-slate-200 bg-slate-50 py-5 pl-6 pr-5">
              <p class="rsp-faq-main-text font-['Inter',sans-serif] text-slate-700">
                <?php echo esc_html($item['a']); ?>
              </p>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="rsp-faq-help-card mt-12 rounded-[2rem] border border-slate-200 bg-white p-6 text-center shadow-[0_18px_60px_rgba(15,23,42,0.08)] sm:p-8">
      <p class="rsp-faq-main-text mx-auto mb-6 max-w-2xl font-['Inter',sans-serif] text-slate-600">
        <?php esc_html_e('Still unsure what your business needs? Start with a reputation review so we can identify platform gaps, response risks, and ethical improvement opportunities.', 'reviewservicepro'); ?>
      </p>

      <div class="flex flex-wrap items-center justify-center gap-4">
        <a
          href="<?php echo esc_url(home_url('/contact/')); ?>"
          class="rsp-faq-link inline-flex min-h-[54px] items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 py-3.5 font-['Inter',sans-serif] text-[16px] font-bold text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-200">
          <span class="relative z-10 inline-flex items-center gap-2">
            <i data-lucide="search" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Request Reputation Review', 'reviewservicepro'); ?>
          </span>
        </a>

        <a
          href="<?php echo esc_url(home_url('/pricing/')); ?>"
          class="rsp-faq-link inline-flex min-h-[54px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-7 py-3.5 font-['Inter',sans-serif] text-[16px] font-semibold text-slate-700 no-underline hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('View Packages', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>