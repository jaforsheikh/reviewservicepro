<?php

/**
 * Pricing Ethical Policy Section
 *
 * File: template-parts/sections/pricing/ethical-policy.php
 *
 * Fixes (all functions/keyframes/font-names unchanged):
 * 1.  Title color  #334155 → #0F172A
 * 2.  Title size   clamp(36px,5vw,68px) → clamp(28px,4vw,44px)
 * 3.  Title tracking  -0.058em → -0.038em
 * 4.  Title line-height 1.02 → 1.1
 * 5.  Title-line gradient → blue→green brand (was gray)
 * 6.  Subtitle  font-weight 500 → 400, color #475569, max-width 560px
 * 7.  Text color  #64748B → #475569
 * 8.  Principle items  16px font-medium text-slate-600 → 15px #334155, border-[#E2E8F0]
 * 9.  Section H3 "What we help with / do not offer"  28px font-[800] → 20px font-extrabold
 * 10. Section H3 subtitle  Inter 15px/400 #475569
 * 11. Item card H4  20px font-[800] → 16px font-extrabold Poppins
 * 12. Item card body  16px → 15px/1.72 Inter
 * 13. Item card padding  p-5 → p-6
 * 14. CTA H3  28px font-[800] → 22px font-extrabold
 * 15. CTA buttons  font-[700] text-[16px] → font-semibold text-[15px]
 * 16. CTA border  border-slate-200 → border-[#E2E8F0]
 * 17. Floating badge title  font-[800] #334155 → font-bold #0F172A
 * 18. Floating badge sub  text-slate-500 → text-[#64748B]
 * 19. Panel/borders  border-slate-200 → border-[#E2E8F0]
 * 20. Kicker badge  border-slate-200 → border-[#E2E8F0], text-slate-600 → text-[#475569]
 * 21. Section borders top/bottom bg-[#E2E8F0]
 * All keyframes, IntersectionObserver, visual float, beam, motion-border — UNCHANGED
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$context = isset($args) && is_array($args) ? $args : [];

$contact_url = ! empty($context['contact_url'])
  ? esc_url($context['contact_url'])
  : esc_url(home_url('/contact/?type=pricing-help'));

$services_page_url = ! empty($context['services_page_url'])
  ? esc_url($context['services_page_url'])
  : esc_url(home_url('/services/'));

$theme_uri = trailingslashit(get_template_directory_uri());
$image_url = $theme_uri . 'assets/images/pricing/pricing-ethical-policy-visual.webp';

$not_offered = [
  [
    'title' => __('Fake reviews', 'reviewservicepro'),
    'text'  => __('We do not create, sell, request, or support fake customer reviews.', 'reviewservicepro'),
    'icon'  => 'ban',
  ],
  [
    'title' => __('Paid review incentives', 'reviewservicepro'),
    'text'  => __('We do not encourage paid, incentivized, or misleading review generation.', 'reviewservicepro'),
    'icon'  => 'circle-dollar-sign',
  ],
  [
    'title' => __('Guaranteed 5-star ratings', 'reviewservicepro'),
    'text'  => __('We do not promise guaranteed rating outcomes, guaranteed star increases, or artificial rating manipulation.', 'reviewservicepro'),
    'icon'  => 'star-off',
  ],
  [
    'title' => __('Guaranteed negative review removal', 'reviewservicepro'),
    'text'  => __('We can help identify, document, and report reviews that may violate platform policies, but platform decisions are not guaranteed.', 'reviewservicepro'),
    'icon'  => 'shield-alert',
  ],
];

$what_we_do = [
  [
    'title' => __('Monitor reputation signals', 'reviewservicepro'),
    'text'  => __('Review key platforms, response gaps, customer feedback patterns, and trust signal issues.', 'reviewservicepro'),
    'icon'  => 'radar',
  ],
  [
    'title' => __('Improve response quality', 'reviewservicepro'),
    'text'  => __('Create professional, calm, brand-safe response direction for customer reviews.', 'reviewservicepro'),
    'icon'  => 'message-square',
  ],
  [
    'title' => __('Document review issues', 'reviewservicepro'),
    'text'  => __('Organize notes, screenshots, platform observations, and case details where needed.', 'reviewservicepro'),
    'icon'  => 'file-text',
  ],
  [
    'title' => __('Support genuine feedback workflows', 'reviewservicepro'),
    'text'  => __('Help businesses request honest customer feedback ethically and platform-compliantly.', 'reviewservicepro'),
    'icon'  => 'users',
  ],
];

$principles = [
  __('Ethical reputation management only', 'reviewservicepro'),
  __('Platform-compliant review support', 'reviewservicepro'),
  __('Transparent reporting and clear next steps', 'reviewservicepro'),
  __('No misleading review tactics or shortcuts', 'reviewservicepro'),
];
?>

<style>
  /* ── Design tokens — variable names unchanged ── */
  #pricing-ethical-policy {
    --rsp-ethical-title: #0F172A;
    --rsp-ethical-heading: #1E293B;
    --rsp-ethical-text: #475569;
    --rsp-ethical-subtitle: #475569;
    --rsp-ethical-blue: #2563EB;
    --rsp-ethical-green: #00C853;
    --rsp-ethical-teal: #14B8A6;
  }

  /* ── Typography — font names unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-text {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-ethical-text);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.75;
    color: var(--rsp-ethical-subtitle);
    max-width: 560px;
  }

  /* FIX: size + tracking + line-height */
  #pricing-ethical-policy .rsp-pricing-ethical-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.038em;
    color: var(--rsp-ethical-title);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-heading {
    color: var(--rsp-ethical-heading);
  }

  /* ── Reveal system — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Title frame decorations — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-title-wrap {
    position: relative;
    isolation: isolate;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-wrap::before {
    content: '';
    position: absolute;
    left: 42%;
    top: 54%;
    z-index: -2;
    width: min(720px, 92vw);
    height: 210px;
    border-radius: 999px;
    background:
      radial-gradient(circle at 18% 40%, rgba(37, 99, 235, 0.10), transparent 34%),
      radial-gradient(circle at 82% 50%, rgba(0, 200, 83, 0.09), transparent 34%),
      rgba(255, 255, 255, 0.58);
    transform: translate(-50%, -50%) scaleX(0.92);
    filter: blur(2px);
    opacity: 0.82;
    animation: rspPricingEthicalTitleSpotlight 5.6s ease-in-out infinite alternate;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-frame {
    position: relative;
    display: inline-block;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-frame::before,
  #pricing-ethical-policy .rsp-pricing-ethical-title-frame::after {
    content: '';
    position: absolute;
    width: 52px;
    height: 52px;
    pointer-events: none;
    opacity: 0.38;
    transition:
      opacity 320ms ease,
      transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-frame::before {
    left: -18px;
    top: -12px;
    border-left: 1px solid rgba(30, 41, 59, 0.16);
    border-top: 1px solid rgba(30, 41, 59, 0.16);
    border-top-left-radius: 18px;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-frame::after {
    right: -18px;
    bottom: -12px;
    border-right: 1px solid rgba(30, 41, 59, 0.16);
    border-bottom: 1px solid rgba(30, 41, 59, 0.16);
    border-bottom-right-radius: 18px;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-wrap:hover .rsp-pricing-ethical-title-frame::before {
    opacity: 0.68;
    transform: translate(-4px, -4px);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-wrap:hover .rsp-pricing-ethical-title-frame::after {
    opacity: 0.68;
    transform: translate(4px, 4px);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-word {
    display: inline-block;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      letter-spacing 360ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-title-wrap:hover .rsp-pricing-ethical-title-word {
    transform: translateY(-2px);
    letter-spacing: -0.044em;
  }

  /* FIX: title-line → blue→green brand */
  #pricing-ethical-policy .rsp-pricing-ethical-title-line {
    display: block;
    height: 2.5px;
    width: min(460px, 86vw);
    margin-top: 22px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.5), rgba(0, 200, 83, 0.3), transparent);
    transform-origin: left;
    animation: rspPricingEthicalTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
  }

  /* ── Kicker badge — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-kicker {
    position: relative;
    isolation: isolate;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-kicker::before {
    content: '';
    position: absolute;
    inset: -1px;
    z-index: -1;
    border-radius: inherit;
    background:
      linear-gradient(90deg, rgba(255, 255, 255, 0.96), rgba(255, 255, 255, 0.78)),
      radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.10), transparent 40%),
      radial-gradient(circle at 80% 50%, rgba(0, 200, 83, 0.13), transparent 40%);
  }

  /* ── Motion border — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-motion-border::before {
    content: '';
    position: absolute;
    inset: -80%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.07),
        rgba(0, 200, 83, 0.25),
        rgba(20, 184, 166, 0.18),
        rgba(37, 99, 235, 0.25),
        rgba(37, 99, 235, 0.07));
    transform: rotate(0deg);
    animation: rspPricingEthicalBorderSpin 8s linear infinite;
    opacity: 0.65;
    transition: opacity 260ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-motion-border::after {
    content: '';
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-ethical-inner, #ffffff);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  /* ── Glow panel — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-panel {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-panel::before {
    content: '';
    position: absolute;
    inset: -110px;
    z-index: -1;
    background:
      radial-gradient(circle at 12% 20%, rgba(37, 99, 235, 0.09), transparent 28%),
      radial-gradient(circle at 88% 72%, rgba(0, 200, 83, 0.09), transparent 30%);
    animation: rspPricingEthicalGlowMove 9s ease-in-out infinite alternate;
  }

  /* ── Visual frame float + beam — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-visual-frame {
    position: relative;
    animation: rspPricingEthicalFloat 7s ease-in-out infinite;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-visual-frame::before {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 2.25rem;
    background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.38), rgba(0, 200, 83, 0.28), transparent);
    background-size: 220% 100%;
    animation: rspPricingEthicalVisualBeam 5.5s ease-in-out infinite;
    opacity: 0.86;
    pointer-events: none;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-visual-inner {
    position: relative;
    z-index: 1;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-img {
    display: block;
    width: 100%;
    aspect-ratio: 16 / 11;
    object-fit: cover;
    transition:
      transform 720ms cubic-bezier(0.2, 0.9, 0.2, 1),
      filter 420ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-visual-frame:hover .rsp-pricing-ethical-img {
    transform: scale(1.04);
    filter: saturate(1.06);
  }

  /* ── Floating badge — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-floating-card {
    --rsp-ethical-inner: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(18px);
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.11);
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-floating-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 26px 70px rgba(15, 23, 42, 0.14);
  }

  /* ── Item card hover — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 340ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 58px rgba(15, 23, 42, 0.09);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-icon {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 280ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-card:hover .rsp-pricing-ethical-icon {
    transform: rotate(-4deg) scale(1.08);
    box-shadow: 0 14px 36px rgba(37, 99, 235, 0.09);
  }

  /* ── CTA button shimmer — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #pricing-ethical-policy .rsp-pricing-ethical-btn::before {
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

  #pricing-ethical-policy .rsp-pricing-ethical-btn:hover {
    transform: translateY(-3px);
  }

  #pricing-ethical-policy .rsp-pricing-ethical-btn:hover::before {
    left: 135%;
  }

  /* ── Top beam — unchanged ── */
  #pricing-ethical-policy .rsp-pricing-ethical-beam {
    animation: rspPricingEthicalBeam 7s ease-in-out infinite;
  }

  /* ── Keyframes — all names unchanged ── */
  @keyframes rspPricingEthicalTitleSpotlight {
    from {
      transform: translate(-50%, -50%) scaleX(0.86);
      opacity: 0.48;
    }

    to {
      transform: translate(-50%, -50%) scaleX(1.04);
      opacity: 0.88;
    }
  }

  @keyframes rspPricingEthicalTitleLine {
    from {
      transform: scaleX(0.48);
      opacity: 0.42;
    }

    to {
      transform: scaleX(1);
      opacity: 0.82;
    }
  }

  @keyframes rspPricingEthicalBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspPricingEthicalGlowMove {
    from {
      transform: translate3d(-18px, -10px, 0) scale(1);
    }

    to {
      transform: translate3d(18px, 12px, 0) scale(1.04);
    }
  }

  @keyframes rspPricingEthicalVisualBeam {

    0%,
    100% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }
  }

  @keyframes rspPricingEthicalFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-10px);
    }
  }

  @keyframes rspPricingEthicalBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {

    #pricing-ethical-policy *,
    #pricing-ethical-policy *::before,
    #pricing-ethical-policy *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #pricing-ethical-policy .rsp-pricing-ethical-reveal {
      opacity: 1;
      transform: none;
    }
  }
</style>

<section
  id="pricing-ethical-policy"
  class="relative overflow-hidden bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="pricing-ethical-policy-title">

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.036)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.036)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>
  <!-- glow orbs -->
  <div class="pointer-events-none absolute -left-28 top-24 z-0 h-[460px] w-[460px] rounded-full bg-blue-500/[0.07] blur-[120px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-28 bottom-16 z-0 h-[460px] w-[460px] rounded-full bg-[#00C853]/[0.07] blur-[120px]" aria-hidden="true"></div>
  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── HEADER GRID: Left headline + Right image ── -->
    <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-[minmax(0,0.92fr)_minmax(420px,0.82fr)] lg:gap-16">

      <!-- Left: headline + principles -->
      <div class="rsp-pricing-ethical-reveal rsp-pricing-ethical-title-wrap" data-pricing-ethical-reveal>

        <span class="rsp-pricing-ethical-kicker inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-white px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-[#475569] shadow-sm">
          <i data-lucide="shield-check" class="h-[13px] w-[13px] text-[#00A344]" aria-hidden="true"></i>
          <?php esc_html_e('Ethical ORM Promise', 'reviewservicepro'); ?>
        </span>

        <div class="rsp-pricing-ethical-title-frame mt-6">
          <h2
            id="pricing-ethical-policy-title"
            class="rsp-pricing-ethical-title m-0">
            <span class="rsp-pricing-ethical-title-word block">
              <?php esc_html_e('Built for long-term trust', 'reviewservicepro'); ?>
            </span>
            <span class="rsp-pricing-ethical-title-word block">
              <?php esc_html_e('not reputation shortcuts.', 'reviewservicepro'); ?>
            </span>
          </h2>
        </div>

        <span class="rsp-pricing-ethical-title-line" aria-hidden="true"></span>

        <p class="rsp-pricing-ethical-subtitle mt-6">
          <?php esc_html_e('ReviewService.Pro focuses on ethical, platform-compliant online reputation management. Our work helps businesses monitor, respond, document, report, and improve reputation signals without manipulative review tactics.', 'reviewservicepro'); ?>
        </p>

        <!-- Principle checklist -->
        <div class="mt-8 grid grid-cols-1 gap-3 sm:grid-cols-2">
          <?php foreach ($principles as $principle) : ?>
            <div class="flex items-start gap-3 rounded-2xl border border-[#E2E8F0] bg-white/90 p-4 shadow-sm transition-all duration-300 hover:-translate-y-[3px] hover:border-emerald-200 hover:bg-emerald-50/40">
              <i data-lucide="check-circle-2" class="mt-0.5 h-[16px] w-[16px] shrink-0 text-[#00A344]" aria-hidden="true"></i>
              <!-- FIX: 15px font-medium #334155 (was 16px text-slate-600) -->
              <p class="font-['Inter',sans-serif] text-[15px] font-medium leading-[1.6] text-[#334155]">
                <?php echo esc_html($principle); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right: image + floating badges -->
      <div class="rsp-pricing-ethical-reveal relative" data-pricing-ethical-reveal>
        <div class="absolute -inset-8 rounded-[2.75rem] bg-blue-100/70 blur-3xl" aria-hidden="true"></div>

        <div class="rsp-pricing-ethical-visual-frame rounded-[2.25rem] bg-white p-[2px] shadow-[0_4px_6px_rgba(0,0,0,.04),0_30px_100px_rgba(15,23,42,0.11)]">
          <div class="rsp-pricing-ethical-visual-inner overflow-hidden rounded-[calc(2.25rem-2px)] border border-[#E2E8F0] bg-white">
            <img
              src="<?php echo esc_url($image_url); ?>"
              alt="<?php esc_attr_e('Ethical online reputation management policy dashboard and compliance workflow', 'reviewservicepro'); ?>"
              class="rsp-pricing-ethical-img"
              loading="lazy"
              decoding="async"
              width="1200"
              height="825">
          </div>
        </div>

        <!-- Floating badge: bottom-left -->
        <div class="rsp-pricing-ethical-floating-card rsp-pricing-ethical-motion-border absolute -left-4 bottom-8 hidden rounded-2xl border border-[#E2E8F0] px-4 py-3 lg:block">
          <div class="relative z-10 flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#00A344]">
              <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <!-- FIX: font-bold #0F172A (was font-[800] #334155) -->
              <p class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug text-[#0F172A]">
                <?php esc_html_e('Ethical Only', 'reviewservicepro'); ?>
              </p>
              <p class="font-['Inter',sans-serif] text-[13px] font-medium leading-snug text-[#64748B]">
                <?php esc_html_e('No fake review tactics.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Floating badge: top-right -->
        <div class="rsp-pricing-ethical-floating-card rsp-pricing-ethical-motion-border absolute -right-4 top-7 hidden rounded-2xl border border-[#E2E8F0] px-4 py-3 lg:block">
          <div class="relative z-10 flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">
              <i data-lucide="file-check-2" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <p class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug text-[#0F172A]">
                <?php esc_html_e('Documented Work', 'reviewservicepro'); ?>
              </p>
              <p class="font-['Inter',sans-serif] text-[13px] font-medium leading-snug text-[#64748B]">
                <?php esc_html_e('Clear reporting and next steps.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── MAIN POLICY SHELL: 2-col grid ── -->
    <div
      class="rsp-pricing-ethical-panel rsp-pricing-ethical-reveal mt-14 rounded-[2rem] border border-[#E2E8F0] bg-white/92 p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_24px_90px_rgba(15,23,42,0.07)] backdrop-blur-xl md:p-8"
      data-pricing-ethical-reveal>

      <!-- animated top beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[2rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-ethical-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-2">

        <!-- What we help with -->
        <div>
          <div class="mb-6 flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-[#00C853]/[0.08]">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-[#00A344]" aria-hidden="true"></i>
            </div>
            <div>
              <!-- FIX: 20px font-extrabold (was 28px font-[800]) -->
              <h3 class="rsp-pricing-ethical-heading font-['Poppins',sans-serif] text-[20px] font-extrabold leading-snug tracking-[-0.025em]">
                <?php esc_html_e('What we help with', 'reviewservicepro'); ?>
              </h3>
              <p class="font-['Inter',sans-serif] mt-1.5 text-[15px] font-normal leading-[1.65] text-[#475569]">
                <?php esc_html_e('Practical ORM support that improves clarity, consistency, and customer trust signals.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>

          <div class="grid grid-cols-1 gap-4">
            <?php foreach ($what_we_do as $index => $item) : ?>
              <article
                class="rsp-pricing-ethical-card rsp-pricing-ethical-motion-border rsp-pricing-ethical-reveal rounded-[1.35rem] border border-[#00C853]/18 bg-[#00C853]/[0.04] p-6 shadow-[0_1px_3px_rgba(0,0,0,.03),0_8px_28px_rgba(0,0,0,.05)]"
                data-pricing-ethical-reveal
                style="transition-delay:<?php echo esc_attr((string)($index * 70)); ?>ms;--rsp-ethical-inner:#F0FDF4;">

                <div class="relative z-10 flex items-start gap-4">
                  <div class="rsp-pricing-ethical-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/22 bg-[#00C853]/[0.08]">
                    <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-[18px] w-[18px] text-[#00A344]" aria-hidden="true"></i>
                  </div>
                  <div>
                    <!-- FIX: 16px font-extrabold (was 20px font-[800]) -->
                    <h4 class="rsp-pricing-ethical-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em]">
                      <?php echo esc_html($item['title']); ?>
                    </h4>
                    <p class="rsp-pricing-ethical-text mt-2">
                      <?php echo esc_html($item['text']); ?>
                    </p>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- What we do not offer -->
        <div>
          <div class="mb-6 flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-amber-200 bg-amber-50">
              <i data-lucide="shield-alert" class="h-5 w-5 text-amber-600" aria-hidden="true"></i>
            </div>
            <div>
              <h3 class="rsp-pricing-ethical-heading font-['Poppins',sans-serif] text-[20px] font-extrabold leading-snug tracking-[-0.025em]">
                <?php esc_html_e('What we do not offer', 'reviewservicepro'); ?>
              </h3>
              <p class="font-['Inter',sans-serif] mt-1.5 text-[15px] font-normal leading-[1.65] text-[#475569]">
                <?php esc_html_e('Clear boundaries help protect your business and our brand integrity.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>

          <div class="grid grid-cols-1 gap-4">
            <?php foreach ($not_offered as $index => $item) : ?>
              <article
                class="rsp-pricing-ethical-card rsp-pricing-ethical-motion-border rsp-pricing-ethical-reveal rounded-[1.35rem] border border-amber-100 bg-amber-50/70 p-6 shadow-[0_1px_3px_rgba(0,0,0,.03),0_8px_28px_rgba(0,0,0,.05)]"
                data-pricing-ethical-reveal
                style="transition-delay:<?php echo esc_attr((string)($index * 70)); ?>ms;--rsp-ethical-inner:#FFFBEB;">

                <div class="relative z-10 flex items-start gap-4">
                  <div class="rsp-pricing-ethical-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-amber-200 bg-amber-50">
                    <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-[18px] w-[18px] text-amber-600" aria-hidden="true"></i>
                  </div>
                  <div>
                    <h4 class="rsp-pricing-ethical-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em]">
                      <?php echo esc_html($item['title']); ?>
                    </h4>
                    <p class="rsp-pricing-ethical-text mt-2">
                      <?php echo esc_html($item['text']); ?>
                    </p>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>

    <!-- ── BOTTOM CTA ── -->
    <div
      class="rsp-pricing-ethical-reveal rsp-pricing-ethical-motion-border mt-8 rounded-[1.75rem] border border-blue-100 bg-blue-50/60 p-6 shadow-[0_1px_3px_rgba(0,0,0,.03),0_14px_48px_rgba(37,99,235,0.07)]"
      data-pricing-ethical-reveal
      style="--rsp-ethical-inner:#EFF6FF;">

      <div class="relative z-10 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
        <div>
          <!-- FIX: 22px font-extrabold (was 28px font-[800]) -->
          <h3 class="rsp-pricing-ethical-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
            <?php esc_html_e('Have a compliance question before ordering?', 'reviewservicepro'); ?>
          </h3>
          <p class="rsp-pricing-ethical-subtitle mt-3">
            <?php esc_html_e('Ask before checkout if you are unsure whether your review issue needs an audit, documentation, response guidance, platform check, or monthly ORM support.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <!-- Primary CTA -->
          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="rsp-pricing-ethical-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Ask a Compliance Question', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>
          <!-- Secondary CTA -->
          <a
            href="<?php echo esc_url($services_page_url); ?>#monthly-plans"
            class="rsp-pricing-ethical-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155] shadow-sm hover:border-[#00C853]/25 hover:bg-[#00C853]/[0.045] hover:text-[#065F46]">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('View Monthly ORM Plans', 'reviewservicepro'); ?>
              <i data-lucide="calendar-check" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    /* IntersectionObserver — data-pricing-ethical-reveal + pricingEthicalVisible + rsp-is-visible unchanged */
    function initPricingEthicalPolicy() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-pricing-ethical-reveal]');
      if (!items.length) return;

      function showItem(item) {
        if (!item || item.dataset.pricingEthicalVisible === 'true') return;
        item.dataset.pricingEthicalVisible = 'true';
        item.classList.add('rsp-is-visible');
      }

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              showItem(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -30px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });
        return;
      }

      items.forEach(showItem);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initPricingEthicalPolicy);
    } else {
      initPricingEthicalPolicy();
    }
  }());
</script>