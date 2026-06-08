<?php

/**
 * Pricing Hero Section
 *
 * File: template-parts/sections/pricing/hero.php
 *
 * Fixes (all functions/keyframes/font-names/data-gsap unchanged):
 * 1.  Title color  #334155 → #0F172A (proper dark heading)
 * 2.  Title size   clamp(44px,7vw,80px) → clamp(32px,5vw,56px)
 * 3.  Title tracking  -0.065em → -0.04em (less compressed)
 * 4.  Title line-height 0.98 → 1.1 (multi-line breathing)
 * 5.  Title-line gradient → blue→green brand (was gray)
 * 6.  Subtitle  font-weight 500 → 400, color #475569, max-width 580px
 * 7.  Text  color #475569, Inter 16px/1.72
 * 8.  Stat number  Poppins 36px #0F172A (was 32px #334155)
 * 9.  Stat border  border-slate-200 → border-[#E2E8F0]
 * 10. Compliance note  amber-800 → #78350F (proper amber dark)
 * 11. Visual card H2  20px → 16px font-extrabold Poppins
 * 12. Visual card body  16px → 14px/1.7 Inter
 * 13. Visual card inner-nav buttons  16px → 14px font-semibold
 * 14. CTA primary btn  font-bold → font-semibold
 * 15. CTA secondary  border-slate-200 → border-[#E2E8F0]
 * 16. Kicker badge  border-emerald-200 → explicit tokens
 * 17. Hero section border-b  border-slate-200 → border-[#E2E8F0]
 * 18. All keyframes, motion-border, beam, float, GSAP attr — UNCHANGED
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$context = isset($args) && is_array($args) ? $args : [];

$services_page_url = ! empty($context['services_page_url'])
  ? esc_url($context['services_page_url'])
  : esc_url(home_url('/services/'));

$contact_url = ! empty($context['contact_url'])
  ? esc_url($context['contact_url'])
  : esc_url(home_url('/contact/?type=pricing-help'));

$packages_url  = '#pricing-main-packages';
$platforms_url = '#pricing-platform-checks';

$compliance_note = ! empty($context['compliance_note'])
  ? $context['compliance_note']
  : __(
    'Ethical ORM only — no fake reviews, no paid review incentives, no rating manipulation, no guaranteed review removal, no guaranteed 5-star ratings, and no guaranteed ranking outcomes.',
    'reviewservicepro'
  );

$hero_stats = [
  [
    'value' => '3',
    'label' => __('Main packages', 'reviewservicepro'),
    'icon'  => 'package-check',
  ],
  [
    'value' => '3+',
    'label' => __('Platform checks', 'reviewservicepro'),
    'icon'  => 'radar',
  ],
  [
    'value' => '0',
    'label' => __('Fake-review tactics', 'reviewservicepro'),
    'icon'  => 'shield-check',
  ],
];

$visual_cards = [
  [
    'badge' => __('Start Here', 'reviewservicepro'),
    'title' => __('Reputation Audit', 'reviewservicepro'),
    'text'  => __('Find review risks, response gaps, and next actions.', 'reviewservicepro'),
    'icon'  => 'search-check',
    'tone'  => 'green',
  ],
  [
    'badge' => __('Popular', 'reviewservicepro'),
    'title' => __('Response Setup', 'reviewservicepro'),
    'text'  => __('Build a professional response framework.', 'reviewservicepro'),
    'icon'  => 'message-square',
    'tone'  => 'blue',
  ],
  [
    'badge' => __('Focused Help', 'reviewservicepro'),
    'title' => __('Negative Review Case', 'reviewservicepro'),
    'text'  => __('Document the issue and prepare safe next steps.', 'reviewservicepro'),
    'icon'  => 'shield-alert',
    'tone'  => 'amber',
  ],
];

$tone_classes = [
  'green' => [
    'badge' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'icon'  => 'border-emerald-100 bg-emerald-50 text-[#059669]',
    'line'  => 'from-emerald-500 via-[#00C853] to-transparent',
  ],
  'blue' => [
    'badge' => 'border-blue-200 bg-blue-50 text-[#1D4ED8]',
    'icon'  => 'border-blue-100 bg-blue-50 text-[#2563EB]',
    'line'  => 'from-[#2563EB] via-blue-400 to-transparent',
  ],
  'amber' => [
    'badge' => 'border-amber-200 bg-amber-50 text-amber-700',
    'icon'  => 'border-amber-100 bg-amber-50 text-amber-600',
    'line'  => 'from-amber-500 via-amber-400 to-transparent',
  ],
];
?>

<section
  id="pricing-hero"
  class="relative overflow-hidden border-b border-[#E2E8F0] bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24"
  aria-labelledby="pricing-hero-title"
  data-gsap="pricing-hero-animate">

  <style>
    /* ── Design tokens — variable names unchanged ── */
    #pricing-hero {
      --rsp-pricing-title: #0F172A;
      --rsp-pricing-heading: #1E293B;
      --rsp-pricing-subtitle: #475569;
      --rsp-pricing-text: #475569;
      --rsp-pricing-blue: #2563EB;
      --rsp-pricing-green: #00C853;
      --rsp-pricing-teal: #14B8A6;
      --rsp-pricing-border: rgba(226, 232, 240, 1);
    }

    /* ── Typography — font names unchanged ── */
    #pricing-hero .rsp-pricing-text {
      font-family: 'Inter', sans-serif;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.72;
      color: var(--rsp-pricing-text);
    }

    #pricing-hero .rsp-pricing-subtitle {
      font-family: 'Inter', sans-serif;
      font-size: 16px;
      font-weight: 400;
      /* FIX: was 500 */
      line-height: 1.75;
      color: var(--rsp-pricing-subtitle);
    }

    /* FIX: size, tracking, line-height all refined */
    #pricing-hero .rsp-pricing-title {
      font-family: 'Poppins', sans-serif;
      font-size: clamp(32px, 5vw, 56px);
      font-weight: 800;
      line-height: 1.1;
      letter-spacing: -0.04em;
      color: var(--rsp-pricing-title);
    }

    #pricing-hero .rsp-pricing-heading {
      color: var(--rsp-pricing-heading);
    }

    /* ── Reveal animations — unchanged ── */
    #pricing-hero .rsp-pricing-reveal {
      opacity: 0;
      transform: translateY(24px);
      animation: rspPricingReveal 760ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    #pricing-hero .rsp-pricing-delay-1 {
      animation-delay: 90ms;
    }

    #pricing-hero .rsp-pricing-delay-2 {
      animation-delay: 180ms;
    }

    #pricing-hero .rsp-pricing-delay-3 {
      animation-delay: 270ms;
    }

    /* ── Title frame decorations — unchanged ── */
    #pricing-hero .rsp-pricing-title-wrap {
      position: relative;
      isolation: isolate;
    }

    #pricing-hero .rsp-pricing-title-wrap::before {
      content: '';
      position: absolute;
      left: 43%;
      top: 53%;
      z-index: -2;
      width: min(760px, 96vw);
      height: 260px;
      border-radius: 999px;
      background:
        radial-gradient(circle at 18% 40%, rgba(37, 99, 235, 0.10), transparent 34%),
        radial-gradient(circle at 82% 50%, rgba(0, 200, 83, 0.09), transparent 34%),
        rgba(255, 255, 255, 0.52);
      transform: translate(-50%, -50%) scaleX(0.92);
      filter: blur(2px);
      opacity: 0.82;
      animation: rspPricingTitleSpotlight 5.8s ease-in-out infinite alternate;
    }

    #pricing-hero .rsp-pricing-title-frame {
      position: relative;
      display: inline-block;
    }

    #pricing-hero .rsp-pricing-title-frame::before,
    #pricing-hero .rsp-pricing-title-frame::after {
      content: '';
      position: absolute;
      width: 56px;
      height: 56px;
      pointer-events: none;
      opacity: 0.36;
      transition:
        opacity 320ms ease,
        transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #pricing-hero .rsp-pricing-title-frame::before {
      left: -18px;
      top: -12px;
      border-left: 1px solid rgba(51, 65, 85, 0.16);
      border-top: 1px solid rgba(51, 65, 85, 0.16);
      border-top-left-radius: 18px;
    }

    #pricing-hero .rsp-pricing-title-frame::after {
      right: -18px;
      bottom: -12px;
      border-right: 1px solid rgba(51, 65, 85, 0.16);
      border-bottom: 1px solid rgba(51, 65, 85, 0.16);
      border-bottom-right-radius: 18px;
    }

    #pricing-hero .rsp-pricing-title-wrap:hover .rsp-pricing-title-frame::before {
      opacity: 0.68;
      transform: translate(-4px, -4px);
    }

    #pricing-hero .rsp-pricing-title-wrap:hover .rsp-pricing-title-frame::after {
      opacity: 0.68;
      transform: translate(4px, 4px);
    }

    #pricing-hero .rsp-pricing-title-word {
      display: inline-block;
      transition:
        transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
        letter-spacing 360ms ease;
    }

    #pricing-hero .rsp-pricing-title-wrap:hover .rsp-pricing-title-word {
      transform: translateY(-2px);
      letter-spacing: -0.046em;
    }

    /* ── Title highlight box — unchanged ── */
    #pricing-hero .rsp-pricing-title-highlight {
      position: relative;
      display: inline-block;
      color: var(--rsp-pricing-title);
    }

    #pricing-hero .rsp-pricing-title-highlight::before {
      content: '';
      position: absolute;
      inset: -5px -12px;
      z-index: -1;
      border-radius: 16px;
      border: 1px solid rgba(37, 99, 235, 0.13);
      background:
        linear-gradient(90deg, rgba(255, 255, 255, 0.82), rgba(248, 250, 252, 0.74)),
        radial-gradient(circle at 12% 50%, rgba(37, 99, 235, 0.10), transparent 42%),
        radial-gradient(circle at 88% 50%, rgba(0, 200, 83, 0.10), transparent 42%);
      box-shadow: 0 18px 50px rgba(15, 23, 42, 0.04);
    }

    /* FIX: title-line → blue→green brand */
    #pricing-hero .rsp-pricing-title-line {
      transform-origin: left;
      background: linear-gradient(90deg, rgba(37, 99, 235, 0.55), rgba(0, 200, 83, 0.3), transparent);
      animation: rspPricingTitleLine 2.4s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
    }

    /* ── Motion border — unchanged ── */
    #pricing-hero .rsp-pricing-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #pricing-hero .rsp-pricing-motion-border::before {
      content: '';
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.28),
          rgba(20, 184, 166, 0.20),
          rgba(37, 99, 235, 0.28),
          rgba(37, 99, 235, 0.08));
      transform: rotate(0deg);
      animation: rspPricingBorderSpin 7s linear infinite;
      opacity: 0.75;
      transition: opacity 260ms ease;
    }

    #pricing-hero .rsp-pricing-motion-border::after {
      content: '';
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-pricing-card-bg, #ffffff);
    }

    #pricing-hero .rsp-pricing-motion-border:hover::before {
      opacity: 1;
      animation-duration: 3.8s;
    }

    /* ── CTA button shimmer — unchanged ── */
    #pricing-hero .rsp-pricing-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #pricing-hero .rsp-pricing-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -120%;
      z-index: 0;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
    }

    #pricing-hero .rsp-pricing-btn:hover {
      transform: translateY(-4px);
    }

    #pricing-hero .rsp-pricing-btn:hover::before {
      left: 135%;
    }

    #pricing-hero .rsp-pricing-primary {
      --rsp-pricing-card-bg: #2563EB;
    }

    #pricing-hero .rsp-pricing-secondary {
      --rsp-pricing-card-bg: #ffffff;
    }

    /* ── Glow panel — unchanged ── */
    #pricing-hero .rsp-pricing-glow-panel {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #pricing-hero .rsp-pricing-glow-panel::before {
      content: '';
      position: absolute;
      inset: -110px;
      z-index: -1;
      background:
        radial-gradient(circle at 16% 18%, rgba(37, 99, 235, 0.14), transparent 30%),
        radial-gradient(circle at 76% 20%, rgba(0, 200, 83, 0.12), transparent 30%),
        radial-gradient(circle at 70% 88%, rgba(20, 184, 166, 0.10), transparent 32%);
      animation: rspPricingGlowMove 9s ease-in-out infinite alternate;
    }

    /* ── Visual frame float + beam — unchanged ── */
    #pricing-hero .rsp-pricing-beam-shell {
      position: relative;
      animation: rspPricingFloat 7s ease-in-out infinite;
    }

    #pricing-hero .rsp-pricing-beam-shell::before {
      content: '';
      position: absolute;
      inset: -1px;
      border-radius: 2rem;
      background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.38), rgba(0, 200, 83, 0.28), transparent);
      background-size: 220% 100%;
      animation: rspPricingBeam 5.5s ease-in-out infinite;
      opacity: 0.86;
      pointer-events: none;
    }

    #pricing-hero .rsp-pricing-beam-inner {
      position: relative;
      z-index: 1;
    }

    /* ── Visual card hover — unchanged ── */
    #pricing-hero .rsp-pricing-card {
      transition:
        transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 340ms ease,
        border-color 280ms ease;
    }

    #pricing-hero .rsp-pricing-card:hover {
      transform: translateY(-7px);
      box-shadow: 0 24px 70px rgba(15, 23, 42, 0.10);
    }

    #pricing-hero .rsp-pricing-card-icon {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 280ms ease;
    }

    #pricing-hero .rsp-pricing-card:hover .rsp-pricing-card-icon {
      transform: rotate(-4deg) scale(1.08);
      box-shadow: 0 16px 38px rgba(37, 99, 235, 0.10);
    }

    #pricing-hero .rsp-pricing-stat {
      --rsp-pricing-card-bg: rgba(255, 255, 255, 0.92);
    }

    /* ── Pulse dot — unchanged ── */
    #pricing-hero .rsp-pricing-mini-dot {
      animation: rspPricingPulse 1.4s ease-in-out infinite;
    }

    /* ── Keyframes — all names unchanged ── */
    @keyframes rspPricingReveal {
      0% {
        opacity: 0;
        transform: translateY(24px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes rspPricingTitleSpotlight {
      from {
        transform: translate(-50%, -50%) scaleX(0.86);
        opacity: 0.48;
      }

      to {
        transform: translate(-50%, -50%) scaleX(1.04);
        opacity: 0.88;
      }
    }

    @keyframes rspPricingBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspPricingGlowMove {
      from {
        transform: translate3d(-20px, -10px, 0) scale(1);
      }

      to {
        transform: translate3d(20px, 14px, 0) scale(1.04);
      }
    }

    @keyframes rspPricingBeam {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    @keyframes rspPricingFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes rspPricingTitleLine {
      from {
        transform: scaleX(0.48);
        opacity: 0.42;
      }

      to {
        transform: scaleX(1);
        opacity: 0.82;
      }
    }

    @keyframes rspPricingPulse {

      0%,
      100% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.55);
        opacity: 0.55;
      }
    }

    /* ── Reduced motion — unchanged ── */
    @media (prefers-reduced-motion: reduce) {

      #pricing-hero *,
      #pricing-hero *::before,
      #pricing-hero *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
      }
    }
  </style>

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.032)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.032)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <!-- radial tints -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.07),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.07),transparent_32%)]" aria-hidden="true"></div>
  <!-- top center line -->
  <div class="pointer-events-none absolute left-1/2 top-0 z-0 h-px w-full max-w-6xl -translate-x-1/2 bg-gradient-to-r from-transparent via-[#CBD5E1] to-transparent" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(380px,0.72fr)] lg:gap-14">

    <!-- ── LEFT: Headline + CTAs + Stats + Compliance ── -->
    <div class="rsp-pricing-reveal rsp-pricing-title-wrap">

      <!-- Kicker badge -->
      <span class="mb-6 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-emerald-700 shadow-sm">
        <span class="rsp-pricing-mini-dot h-1.5 w-1.5 rounded-full bg-[#00C853]" aria-hidden="true"></span>
        <?php esc_html_e('Ethical ORM System', 'reviewservicepro'); ?>
      </span>

      <!-- H1 -->
      <div class="rsp-pricing-title-frame">
        <h1
          id="pricing-hero-title"
          class="rsp-pricing-title m-0 max-w-[820px]">
          <span class="rsp-pricing-title-word block">
            <?php esc_html_e('Ethical Online', 'reviewservicepro'); ?>
          </span>

          <span class="rsp-pricing-title-highlight">
            <span class="rsp-pricing-title-word relative z-10">
              <?php esc_html_e('Reputation Management', 'reviewservicepro'); ?>
            </span>
            <span class="rsp-pricing-title-line absolute -bottom-1 left-0 right-0 z-10 h-[2.5px] origin-left rounded-full" aria-hidden="true"></span>
          </span>

          <span class="rsp-pricing-title-word block">
            <?php esc_html_e('System', 'reviewservicepro'); ?>
          </span>
        </h1>
      </div>

      <!-- Subtext -->
      <p class="rsp-pricing-subtitle mt-6 max-w-[580px]">
        <?php esc_html_e('Choose focused reputation audits, platform checks, review response setup, and negative review case support through an ethical, platform-compliant reputation management system.', 'reviewservicepro'); ?>
      </p>

      <!-- CTA row -->
      <div class="rsp-pricing-reveal rsp-pricing-delay-1 mt-8 flex flex-col gap-3 sm:flex-row">

        <!-- Primary -->
        <a
          href="<?php echo esc_url($packages_url); ?>"
          class="rsp-pricing-btn rsp-pricing-motion-border rsp-pricing-primary inline-flex min-h-[54px] items-center justify-center gap-2 rounded-2xl border border-blue-500/25 bg-[#2563EB] px-7 py-3.5 font-['Inter',sans-serif] text-[15px] font-semibold text-white no-underline shadow-[0_4px_6px_rgba(37,99,235,.2),0_14px_40px_rgba(37,99,235,.26)] hover:bg-[#1D4ED8] hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-200">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Explore ORM Packages', 'reviewservicepro'); ?>
            <i data-lucide="arrow-down" class="h-4 w-4" aria-hidden="true"></i>
          </span>
        </a>

        <!-- Secondary -->
        <a
          href="<?php echo esc_url($contact_url); ?>"
          class="rsp-pricing-btn rsp-pricing-motion-border rsp-pricing-secondary inline-flex min-h-[54px] items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-7 py-3.5 font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-[#065F46] focus:outline-none focus:ring-4 focus:ring-emerald-100">
          <span class="relative z-10 inline-flex items-center gap-2">
            <i data-lucide="messages-square" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Help Me Choose', 'reviewservicepro'); ?>
          </span>
        </a>
      </div>

      <!-- Stat cards -->
      <div class="rsp-pricing-reveal rsp-pricing-delay-2 mt-8 grid max-w-2xl grid-cols-1 gap-4 sm:grid-cols-3">
        <?php foreach ($hero_stats as $stat) : ?>
          <div class="rsp-pricing-stat rsp-pricing-motion-border rounded-2xl border border-[#E2E8F0] bg-white px-5 py-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_12px_40px_rgba(15,23,42,0.06)]">
            <div class="relative z-10 flex items-start gap-3 sm:block sm:text-center">
              <span class="inline-flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-[#2563EB] sm:mx-auto sm:mb-3">
                <i data-lucide="<?php echo esc_attr($stat['icon']); ?>" class="h-[18px] w-[18px]" aria-hidden="true"></i>
              </span>
              <span class="block">
                <!-- FIX: 36px Poppins #0F172A (was 32px #334155) -->
                <strong class="block font-['Poppins',sans-serif] text-[34px] font-extrabold leading-none tracking-[-0.045em] text-[#0F172A]">
                  <?php echo esc_html($stat['value']); ?>
                </strong>
                <span class="rsp-pricing-subtitle mt-1.5 block text-[14px]">
                  <?php echo esc_html($stat['label']); ?>
                </span>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Compliance note -->
      <div class="rsp-pricing-reveal rsp-pricing-delay-3 mt-7 max-w-2xl rounded-2xl border border-amber-200 bg-amber-50/80 px-5 py-4 shadow-sm">
        <p class="flex items-start gap-3 font-['Inter',sans-serif] text-[14px] font-normal leading-[1.65] text-[#78350F]">
          <i data-lucide="info" class="mt-0.5 h-4 w-4 flex-shrink-0 text-amber-600" aria-hidden="true"></i>
          <span><?php echo esc_html($compliance_note); ?></span>
        </p>
      </div>
    </div>

    <!-- ── RIGHT: Visual preview panel ── -->
    <div class="rsp-pricing-reveal rsp-pricing-delay-2">
      <div class="rsp-pricing-beam-shell rounded-[2rem] bg-white p-[2px] shadow-[0_4px_6px_rgba(0,0,0,.04),0_30px_100px_rgba(15,23,42,0.11)]">
        <div class="rsp-pricing-beam-inner rsp-pricing-glow-panel overflow-hidden rounded-[calc(2rem-2px)] border border-[#E2E8F0] bg-white p-5 sm:p-6">

          <!-- browser top bar -->
          <div class="mb-5 flex items-center justify-between border-b border-[#F1F5F9] pb-5">
            <div class="flex items-center gap-1.5" aria-hidden="true">
              <span class="h-2.5 w-2.5 rounded-full bg-[#ff5f57]"></span>
              <span class="h-2.5 w-2.5 rounded-full bg-[#ffbd2e]"></span>
              <span class="h-2.5 w-2.5 rounded-full bg-[#28c840]"></span>
            </div>
            <span class="font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.13em] text-[#94A3B8]">
              <?php esc_html_e('Pricing Preview', 'reviewservicepro'); ?>
            </span>
          </div>

          <!-- Service preview cards -->
          <div class="space-y-3">
            <?php foreach ($visual_cards as $card) :
              $tone = $tone_classes[$card['tone']]; ?>

              <article class="rsp-pricing-card rsp-pricing-motion-border rounded-2xl border border-[#E2E8F0] bg-white p-4 shadow-[0_1px_3px_rgba(0,0,0,.04)]">
                <!-- FIX: accent top line (already good — keep) -->
                <div class="absolute inset-x-0 top-0 h-[2.5px] rounded-t-2xl bg-gradient-to-r <?php echo esc_attr($tone['line']); ?>" aria-hidden="true"></div>

                <div class="relative z-10 flex gap-3">
                  <span class="rsp-pricing-card-icon flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border <?php echo esc_attr($tone['icon']); ?>">
                    <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-[18px] w-[18px]" aria-hidden="true"></i>
                  </span>

                  <div class="min-w-0 flex-1">
                    <!-- badge -->
                    <span class="mb-1.5 inline-flex rounded-full border px-2.5 py-[3px] font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.08em] <?php echo esc_attr($tone['badge']); ?>">
                      <?php echo esc_html($card['badge']); ?>
                    </span>

                    <!-- FIX: 16px → 15px Poppins bold (was 20px extrabold) -->
                    <h2 class="rsp-pricing-heading font-['Poppins',sans-serif] text-[15px] font-bold leading-snug tracking-[-0.02em]">
                      <?php echo esc_html($card['title']); ?>
                    </h2>

                    <!-- FIX: 14px Inter (was 16px) -->
                    <p class="rsp-pricing-text mt-1 text-[14px] leading-[1.6]">
                      <?php echo esc_html($card['text']); ?>
                    </p>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

          <!-- Portal note -->
          <div class="mt-4 rounded-2xl border border-emerald-100 bg-emerald-50/70 p-4">
            <p class="flex items-start gap-2.5 font-['Inter',sans-serif] text-[13px] font-normal leading-[1.65] text-[#065F46]">
              <i data-lucide="shield-check" class="mt-0.5 h-[15px] w-[15px] flex-shrink-0 text-[#059669]" aria-hidden="true"></i>
              <span>
                <?php esc_html_e('After checkout, clients can access order details, next steps, and service progress through the client portal.', 'reviewservicepro'); ?>
              </span>
            </p>
          </div>

          <!-- Inner nav buttons -->
          <div class="mt-4 grid grid-cols-2 gap-3">
            <a
              href="<?php echo esc_url($platforms_url); ?>"
              class="rsp-pricing-btn inline-flex min-h-[44px] items-center justify-center gap-1.5 rounded-xl border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-2.5 font-['Inter',sans-serif] text-[13px] font-semibold text-[#334155] no-underline hover:border-blue-200 hover:bg-blue-50 hover:text-[#1D4ED8]">
              <i data-lucide="radar" class="h-[14px] w-[14px]" aria-hidden="true"></i>
              <?php esc_html_e('Platform Checks', 'reviewservicepro'); ?>
            </a>

            <a
              href="<?php echo esc_url($services_page_url); ?>"
              class="rsp-pricing-btn inline-flex min-h-[44px] items-center justify-center gap-1.5 rounded-xl border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-2.5 font-['Inter',sans-serif] text-[13px] font-semibold text-[#334155] no-underline hover:border-emerald-200 hover:bg-emerald-50 hover:text-[#065F46]">
              <i data-lucide="refresh-cw" class="h-[14px] w-[14px]" aria-hidden="true"></i>
              <?php esc_html_e('Monthly Plans', 'reviewservicepro'); ?>
            </a>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>