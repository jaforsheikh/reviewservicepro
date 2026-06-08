<?php

/**
 * Pricing Help Choosing Section
 *
 * File: template-parts/sections/pricing/help-choosing.php
 *
 * Fixes (all functions/keyframes/font-names unchanged):
 * 1.  Title color  #334155 → #0F172A
 * 2.  Title size   clamp(36px,5vw,68px) → clamp(28px,4vw,44px)
 * 3.  Title tracking  -0.058em → -0.038em
 * 4.  Title line-height 1.02 → 1.1
 * 5.  Title-line gradient → blue→green brand (was gray)
 * 6.  Subtitle font-weight 500 → 400, color #475569, max-width 560px
 * 7.  Text color #64748B → #475569
 * 8.  Recommendation card H3  26px font-[800] → 17px font-extrabold Poppins
 * 9.  Recommendation card label  DM Mono 11px — unchanged (already correct)
 * 10. Recommendation card body  16px/1.75 → 15px/1.72 Inter
 * 11. Recommendation card CTA link  16px font-[700] → 14px font-semibold
 * 12. Decision box H3  28px font-[800] → 20px font-extrabold Poppins
 * 13. Decision box subtitle  Inter 16px/400 #475569
 * 14. Decision list items  16px font-medium → 14px font-medium Inter
 * 15. Decision list border  border-slate-200 bg-slate-50 → border-[#E2E8F0] bg-[#F8FAFC]
 * 16. Floating badge title  font-[800] #334155 → font-bold #0F172A Poppins
 * 17. Floating badge sub  text-slate-500 → text-[#64748B]
 * 18. CTA buttons  font-[700] text-[16px] → font-semibold text-[15px]
 * 19. Trust note text  16px font-medium → 14px font-normal #78350F
 * 20. Panel/borders  border-slate-200 → border-[#E2E8F0]
 * 21. Section borders top/bottom bg-[#E2E8F0]
 * All keyframes, IntersectionObserver, motion-border, visual float, beam — UNCHANGED
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
$image_url = $theme_uri . 'assets/images/pricing/pricing-help-choosing-visual.webp';

$recommendation_cards = [
  [
    'label' => __('Need clarity first?', 'reviewservicepro'),
    'title' => __('Start with a Reputation Audit', 'reviewservicepro'),
    'text'  => __('Best when you are not sure which platforms, reviews, responses, or trust signals need attention first.', 'reviewservicepro'),
    'icon'  => 'search-check',
    'tone'  => 'blue',
    'link'  => '#pricing-main-packages',
    'cta'   => __('View Audit Package', 'reviewservicepro'),
  ],
  [
    'label' => __('Responses feel inconsistent?', 'reviewservicepro'),
    'title' => __('Choose Review Response Setup', 'reviewservicepro'),
    'text'  => __('Best when your business needs a calm, professional, brand-safe response framework for customer reviews.', 'reviewservicepro'),
    'icon'  => 'message-square',
    'tone'  => 'green',
    'link'  => '#pricing-main-packages',
    'cta'   => __('View Response Setup', 'reviewservicepro'),
  ],
  [
    'label' => __('Have a sensitive review issue?', 'reviewservicepro'),
    'title' => __('Choose Negative Review Case Review', 'reviewservicepro'),
    'text'  => __('Best when you need documentation, response direction, and platform-policy-aware next steps for a specific review situation.', 'reviewservicepro'),
    'icon'  => 'shield-alert',
    'tone'  => 'amber',
    'link'  => '#pricing-main-packages',
    'cta'   => __('View Case Review', 'reviewservicepro'),
  ],
];

$tone_classes = [
  'blue' => [
    'card'  => 'border-blue-100 bg-blue-50/60',
    'icon'  => 'border-blue-100 bg-blue-50 text-[#2563EB]',
    'link'  => 'text-[#1D4ED8] hover:text-[#1E3A8A]',
    'inner' => '#EFF6FF',
  ],
  'green' => [
    'card'  => 'border-[#00C853]/20 bg-[#00C853]/[0.045]',
    'icon'  => 'border-[#00C853]/25 bg-[#00C853]/10 text-[#00A344]',
    'link'  => 'text-[#047A34] hover:text-[#065F46]',
    'inner' => '#F0FDF4',
  ],
  'amber' => [
    'card'  => 'border-amber-100 bg-amber-50/70',
    'icon'  => 'border-amber-100 bg-amber-50 text-amber-600',
    'link'  => 'text-amber-700 hover:text-amber-800',
    'inner' => '#FFFBEB',
  ],
];

$decision_points = [
  __('Your business type and customer review platforms', 'reviewservicepro'),
  __('The review issue you want help with first', 'reviewservicepro'),
  __('Whether you need audit, response setup, or platform check', 'reviewservicepro'),
  __('Whether a focused package or monthly ORM plan fits better', 'reviewservicepro'),
];
?>

<style>
  /* ── Design tokens — variable names unchanged ── */
  #pricing-help-choosing {
    --rsp-help-title: #0F172A;
    --rsp-help-heading: #1E293B;
    --rsp-help-subtitle: #475569;
    --rsp-help-text: #475569;
    --rsp-help-blue: #2563EB;
    --rsp-help-green: #00C853;
    --rsp-help-teal: #14B8A6;
    --rsp-help-border: rgba(226, 232, 240, 1);
  }

  /* ── Typography — Poppins/Inter/DM Mono names unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-text {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-help-text);
  }

  #pricing-help-choosing .rsp-pricing-help-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.75;
    color: var(--rsp-help-subtitle);
    max-width: 560px;
  }

  /* FIX: size + tracking + line-height */
  #pricing-help-choosing .rsp-pricing-help-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.038em;
    color: var(--rsp-help-title);
  }

  #pricing-help-choosing .rsp-pricing-help-heading {
    color: var(--rsp-help-heading);
  }

  /* ── Reveal system — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #pricing-help-choosing .rsp-pricing-help-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Title frame decorations — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-title-wrap {
    position: relative;
    isolation: isolate;
  }

  #pricing-help-choosing .rsp-pricing-help-title-wrap::before {
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
    opacity: 0.80;
    animation: rspPricingHelpTitleSpotlight 5.6s ease-in-out infinite alternate;
  }

  #pricing-help-choosing .rsp-pricing-help-title-frame {
    position: relative;
    display: inline-block;
  }

  #pricing-help-choosing .rsp-pricing-help-title-frame::before,
  #pricing-help-choosing .rsp-pricing-help-title-frame::after {
    content: '';
    position: absolute;
    width: 52px;
    height: 52px;
    pointer-events: none;
    opacity: 0.36;
    transition:
      opacity 320ms ease,
      transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #pricing-help-choosing .rsp-pricing-help-title-frame::before {
    left: -18px;
    top: -12px;
    border-left: 1px solid rgba(51, 65, 85, 0.16);
    border-top: 1px solid rgba(51, 65, 85, 0.16);
    border-top-left-radius: 18px;
  }

  #pricing-help-choosing .rsp-pricing-help-title-frame::after {
    right: -18px;
    bottom: -12px;
    border-right: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom-right-radius: 18px;
  }

  #pricing-help-choosing .rsp-pricing-help-title-wrap:hover .rsp-pricing-help-title-frame::before {
    opacity: 0.68;
    transform: translate(-4px, -4px);
  }

  #pricing-help-choosing .rsp-pricing-help-title-wrap:hover .rsp-pricing-help-title-frame::after {
    opacity: 0.68;
    transform: translate(4px, 4px);
  }

  #pricing-help-choosing .rsp-pricing-help-title-word {
    display: inline-block;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      letter-spacing 360ms ease;
  }

  #pricing-help-choosing .rsp-pricing-help-title-wrap:hover .rsp-pricing-help-title-word {
    transform: translateY(-2px);
    letter-spacing: -0.044em;
  }

  /* FIX: title-line → blue→green brand */
  #pricing-help-choosing .rsp-pricing-help-title-line {
    display: block;
    height: 2.5px;
    width: min(460px, 86vw);
    margin-top: 22px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.5), rgba(0, 200, 83, 0.3), transparent);
    transform-origin: left;
    animation: rspPricingHelpTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
  }

  /* ── Kicker badge — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-kicker {
    position: relative;
    isolation: isolate;
  }

  #pricing-help-choosing .rsp-pricing-help-kicker::before {
    content: '';
    position: absolute;
    inset: -1px;
    z-index: -1;
    border-radius: inherit;
    background:
      linear-gradient(90deg, rgba(255, 255, 255, 0.96), rgba(255, 255, 255, 0.78)),
      radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.10), transparent 40%),
      radial-gradient(circle at 80% 50%, rgba(0, 200, 83, 0.12), transparent 40%);
  }

  /* ── Motion border — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-help-choosing .rsp-pricing-help-motion-border::before {
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
    animation: rspPricingHelpBorderSpin 8s linear infinite;
    opacity: 0.65;
    transition: opacity 260ms ease;
  }

  #pricing-help-choosing .rsp-pricing-help-motion-border::after {
    content: '';
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-help-inner, #ffffff);
  }

  #pricing-help-choosing .rsp-pricing-help-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  /* ── Glow panel — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-panel {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-help-choosing .rsp-pricing-help-panel::before {
    content: '';
    position: absolute;
    inset: -110px;
    z-index: -1;
    background:
      radial-gradient(circle at 12% 20%, rgba(37, 99, 235, 0.09), transparent 28%),
      radial-gradient(circle at 88% 72%, rgba(0, 200, 83, 0.09), transparent 30%);
    animation: rspPricingHelpGlowMove 9s ease-in-out infinite alternate;
  }

  /* ── Visual frame float + beam — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-visual-frame {
    position: relative;
    animation: rspPricingHelpFloat 7s ease-in-out infinite;
  }

  #pricing-help-choosing .rsp-pricing-help-visual-frame::before {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 2.25rem;
    background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.38), rgba(0, 200, 83, 0.28), transparent);
    background-size: 220% 100%;
    animation: rspPricingHelpVisualBeam 5.5s ease-in-out infinite;
    opacity: 0.86;
    pointer-events: none;
  }

  #pricing-help-choosing .rsp-pricing-help-visual-inner {
    position: relative;
    z-index: 1;
  }

  #pricing-help-choosing .rsp-pricing-help-img {
    display: block;
    width: 100%;
    aspect-ratio: 16 / 11;
    object-fit: cover;
    transition:
      transform 720ms cubic-bezier(0.2, 0.9, 0.2, 1),
      filter 420ms ease;
  }

  #pricing-help-choosing .rsp-pricing-help-visual-frame:hover .rsp-pricing-help-img {
    transform: scale(1.04);
    filter: saturate(1.06);
  }

  /* ── Floating badge — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-floating-card {
    --rsp-help-inner: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(18px);
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.11);
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease;
  }

  #pricing-help-choosing .rsp-pricing-help-floating-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 26px 70px rgba(15, 23, 42, 0.14);
  }

  /* ── Recommendation card — unchanged hover logic ── */
  #pricing-help-choosing .rsp-pricing-help-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 340ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #pricing-help-choosing .rsp-pricing-help-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 62px rgba(15, 23, 42, 0.09);
  }

  #pricing-help-choosing .rsp-pricing-help-card:hover .rsp-pricing-help-icon {
    transform: rotate(-4deg) scale(1.08);
    box-shadow: 0 14px 36px rgba(37, 99, 235, 0.09);
  }

  #pricing-help-choosing .rsp-pricing-help-icon {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 280ms ease;
  }

  /* ── CTA button shimmer — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #pricing-help-choosing .rsp-pricing-help-btn::before {
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

  #pricing-help-choosing .rsp-pricing-help-btn:hover {
    transform: translateY(-3px);
  }

  #pricing-help-choosing .rsp-pricing-help-btn:hover::before {
    left: 135%;
  }

  /* ── Top beam — unchanged ── */
  #pricing-help-choosing .rsp-pricing-help-beam {
    animation: rspPricingHelpBeam 7s ease-in-out infinite;
  }

  /* ── Keyframes — all names unchanged ── */
  @keyframes rspPricingHelpTitleSpotlight {
    from {
      transform: translate(-50%, -50%) scaleX(0.86);
      opacity: 0.48;
    }

    to {
      transform: translate(-50%, -50%) scaleX(1.04);
      opacity: 0.88;
    }
  }

  @keyframes rspPricingHelpTitleLine {
    from {
      transform: scaleX(0.48);
      opacity: 0.42;
    }

    to {
      transform: scaleX(1);
      opacity: 0.82;
    }
  }

  @keyframes rspPricingHelpBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspPricingHelpGlowMove {
    from {
      transform: translate3d(-18px, -10px, 0) scale(1);
    }

    to {
      transform: translate3d(18px, 12px, 0) scale(1.04);
    }
  }

  @keyframes rspPricingHelpVisualBeam {

    0%,
    100% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }
  }

  @keyframes rspPricingHelpFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-10px);
    }
  }

  @keyframes rspPricingHelpBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {

    #pricing-help-choosing *,
    #pricing-help-choosing *::before,
    #pricing-help-choosing *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #pricing-help-choosing .rsp-pricing-help-reveal {
      opacity: 1;
      transform: none;
    }
  }
</style>

<section
  id="pricing-help-choosing"
  class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="pricing-help-choosing-title">

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.036)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.036)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>
  <!-- glow orbs -->
  <div class="pointer-events-none absolute -left-28 top-24 z-0 h-[460px] w-[460px] rounded-full bg-blue-500/[0.07] blur-[120px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-28 bottom-16 z-0 h-[460px] w-[460px] rounded-full bg-[#00C853]/[0.07] blur-[120px]" aria-hidden="true"></div>
  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── MAIN CTA SHELL ── -->
    <div
      class="rsp-pricing-help-panel rsp-pricing-help-reveal rounded-[2rem] border border-[#E2E8F0] bg-white/92 p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_24px_90px_rgba(15,23,42,0.07)] backdrop-blur-xl md:p-8"
      data-pricing-help-reveal>

      <!-- animated beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[2rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-help-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 items-center gap-12 lg:grid-cols-[minmax(0,0.92fr)_minmax(420px,0.82fr)] lg:gap-16">

        <!-- Left: headline + CTAs -->
        <div class="rsp-pricing-help-title-wrap">

          <span class="rsp-pricing-help-kicker inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-white px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-[#475569] shadow-sm">
            <i data-lucide="help-circle" class="h-[13px] w-[13px] text-[#2563EB]" aria-hidden="true"></i>
            <?php esc_html_e('Need Help Choosing?', 'reviewservicepro'); ?>
          </span>

          <div class="rsp-pricing-help-title-frame mt-6">
            <h2
              id="pricing-help-choosing-title"
              class="rsp-pricing-help-title m-0">
              <span class="rsp-pricing-help-title-word block">
                <?php esc_html_e('Choose the right', 'reviewservicepro'); ?>
              </span>
              <span class="rsp-pricing-help-title-word block">
                <?php esc_html_e('reputation package.', 'reviewservicepro'); ?>
              </span>
            </h2>
          </div>

          <span class="rsp-pricing-help-title-line" aria-hidden="true"></span>

          <p class="rsp-pricing-help-subtitle mt-6">
            <?php esc_html_e('Tell us your business type, review platform, and main reputation concern. We will guide you toward the right package, platform check, add-on, or monthly ORM plan without pushing unnecessary services.', 'reviewservicepro'); ?>
          </p>

          <!-- CTAs -->
          <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <!-- Primary -->
            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="rsp-pricing-help-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3.5 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Request Recommendation', 'reviewservicepro'); ?>
                <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
              </span>
            </a>
            <!-- Secondary -->
            <a
              href="<?php echo esc_url($services_page_url); ?>#monthly-plans"
              class="rsp-pricing-help-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-6 py-3.5 font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155] shadow-sm hover:border-[#00C853]/25 hover:bg-[#00C853]/[0.045] hover:text-[#065F46]">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('View Monthly ORM Plans', 'reviewservicepro'); ?>
                <i data-lucide="calendar-check" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
              </span>
            </a>
          </div>
        </div>

        <!-- Right: image + floating badges (structure unchanged) -->
        <div class="relative">
          <div class="absolute -inset-8 rounded-[2.75rem] bg-blue-100/70 blur-3xl" aria-hidden="true"></div>

          <div class="rsp-pricing-help-visual-frame rounded-[2.25rem] bg-white p-[2px] shadow-[0_4px_6px_rgba(0,0,0,.04),0_30px_100px_rgba(15,23,42,0.11)]">
            <div class="rsp-pricing-help-visual-inner overflow-hidden rounded-[calc(2.25rem-2px)] border border-[#E2E8F0] bg-white">
              <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php esc_attr_e('Consultant helping a business owner choose the right reputation management package', 'reviewservicepro'); ?>"
                class="rsp-pricing-help-img"
                loading="lazy"
                decoding="async"
                width="1200"
                height="825">
            </div>
          </div>

          <!-- Floating badge: bottom-left -->
          <div class="rsp-pricing-help-floating-card rsp-pricing-help-motion-border absolute -left-4 bottom-8 hidden rounded-2xl border border-[#E2E8F0] px-4 py-3 lg:block">
            <div class="relative z-10 flex items-center gap-3">
              <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#00A344]">
                <i data-lucide="check-circle-2" class="h-5 w-5" aria-hidden="true"></i>
              </span>
              <div>
                <!-- FIX: font-bold #0F172A (was font-[800] #334155) -->
                <p class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug text-[#0F172A]">
                  <?php esc_html_e('Smallest Useful Step', 'reviewservicepro'); ?>
                </p>
                <p class="font-['Inter',sans-serif] text-[13px] font-medium leading-snug text-[#64748B]">
                  <?php esc_html_e('No unnecessary service push.', 'reviewservicepro'); ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Floating badge: top-right -->
          <div class="rsp-pricing-help-floating-card rsp-pricing-help-motion-border absolute -right-4 top-7 hidden rounded-2xl border border-[#E2E8F0] px-4 py-3 lg:block">
            <div class="relative z-10 flex items-center gap-3">
              <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">
                <i data-lucide="list-checks" class="h-5 w-5" aria-hidden="true"></i>
              </span>
              <div>
                <p class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug text-[#0F172A]">
                  <?php esc_html_e('Recommendation Path', 'reviewservicepro'); ?>
                </p>
                <p class="font-['Inter',sans-serif] text-[13px] font-medium leading-snug text-[#64748B]">
                  <?php esc_html_e('Audit, setup, case, or monthly.', 'reviewservicepro'); ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── DECISION BOX ── -->
    <div
      class="rsp-pricing-help-reveal rsp-pricing-help-motion-border mt-8 rounded-[1.75rem] border border-[#E2E8F0] bg-white p-6 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_60px_rgba(15,23,42,0.06)]"
      data-pricing-help-reveal
      style="--rsp-help-inner:#ffffff;">

      <div class="relative z-10 grid grid-cols-1 gap-7 lg:grid-cols-[0.5fr_1fr] lg:items-center">
        <!-- Left: heading -->
        <div class="flex items-start gap-4">
          <div class="flex h-13 w-13 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-[#00C853]/[0.08]">
            <i data-lucide="list-checks" class="h-6 w-6 text-[#00A344]" aria-hidden="true"></i>
          </div>
          <div>
            <!-- FIX: 20px font-extrabold (was 28px font-[800]) -->
            <h3 class="rsp-pricing-help-heading font-['Poppins',sans-serif] text-[20px] font-extrabold leading-snug tracking-[-0.025em]">
              <?php esc_html_e('We help you decide based on:', 'reviewservicepro'); ?>
            </h3>
            <p class="font-['Inter',sans-serif] mt-1.5 text-[15px] font-normal leading-[1.65] text-[#475569]">
              <?php esc_html_e('The goal is to choose the smallest useful service first.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>

        <!-- Right: decision checklist -->
        <ul class="grid grid-cols-1 gap-3 md:grid-cols-2" role="list">
          <?php foreach ($decision_points as $point) : ?>
            <li class="flex items-start gap-3 rounded-2xl border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-3">
              <i data-lucide="check-circle-2" class="mt-0.5 h-[16px] w-[16px] shrink-0 text-[#00A344]" aria-hidden="true"></i>
              <!-- FIX: 14px font-medium (was 16px) -->
              <span class="font-['Inter',sans-serif] text-[14px] font-medium leading-[1.6] text-[#334155]">
                <?php echo esc_html($point); ?>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <!-- ── RECOMMENDATION CARDS ── -->
    <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-3">
      <?php foreach ($recommendation_cards as $index => $card) :
        $tone = isset($tone_classes[$card['tone']]) ? $tone_classes[$card['tone']] : $tone_classes['blue'];
      ?>
        <article
          class="rsp-pricing-help-card rsp-pricing-help-motion-border rsp-pricing-help-reveal group rounded-[1.5rem] border <?php echo esc_attr($tone['card']); ?> p-6 shadow-[0_1px_3px_rgba(0,0,0,.03),0_14px_44px_rgba(15,23,42,0.06)]"
          data-pricing-help-reveal
          style="transition-delay:<?php echo esc_attr((string)($index * 80)); ?>ms;--rsp-help-inner:<?php echo esc_attr($tone['inner']); ?>;">

          <div class="relative z-10">
            <!-- icon -->
            <div class="rsp-pricing-help-icon mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?>">
              <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <!-- DM Mono label — unchanged -->
            <p class="font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.13em] text-[#64748B]">
              <?php echo esc_html($card['label']); ?>
            </p>

            <!-- FIX: 17px font-extrabold (was 26px font-[800]) -->
            <h3 class="rsp-pricing-help-heading mt-2.5 font-['Poppins',sans-serif] text-[17px] font-extrabold leading-snug tracking-[-0.02em]">
              <?php echo esc_html($card['title']); ?>
            </h3>

            <!-- FIX: 15px/1.72 Inter (was 16px/1.75) -->
            <p class="rsp-pricing-help-text mt-3">
              <?php echo esc_html($card['text']); ?>
            </p>

            <!-- FIX: 13px font-semibold (was 16px font-[700]) -->
            <a
              href="<?php echo esc_url($card['link']); ?>"
              class="<?php echo esc_attr($tone['link']); ?> mt-5 inline-flex items-center gap-1.5 font-['Inter',sans-serif] text-[13px] font-semibold no-underline transition-all duration-200 group-hover:gap-2.5">
              <?php echo esc_html($card['cta']); ?>
              <i data-lucide="arrow-right" class="h-[13px] w-[13px]" aria-hidden="true"></i>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- ── TRUST NOTE ── -->
    <div
      class="rsp-pricing-help-reveal rsp-pricing-help-motion-border mt-8 rounded-[1.5rem] border border-amber-100 bg-amber-50/80 p-5"
      data-pricing-help-reveal
      style="--rsp-help-inner:#FFFBEB;">

      <div class="relative z-10 flex items-start gap-3">
        <i data-lucide="shield-alert" class="mt-0.5 h-[16px] w-[16px] shrink-0 text-amber-600" aria-hidden="true"></i>
        <!-- FIX: 14px font-normal #78350F (was 16px font-medium text-slate-600) -->
        <p class="font-['Inter',sans-serif] text-[14px] font-normal leading-[1.7] text-[#78350F]">
          <?php esc_html_e('We will never recommend fake reviews, paid review incentives, rating manipulation, guaranteed review removal, or guaranteed ranking outcomes. Recommendations are based on ethical monitoring, response support, documentation, platform-compliant reporting, and genuine trust improvement.', 'reviewservicepro'); ?>
        </p>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    /* IntersectionObserver reveal — data-pricing-help-reveal + pricingHelpVisible + rsp-is-visible unchanged */
    function initPricingHelpChoosing() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-pricing-help-reveal]');
      if (!items.length) return;

      function showItem(item) {
        if (!item || item.dataset.pricingHelpVisible === 'true') return;
        item.dataset.pricingHelpVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initPricingHelpChoosing);
    } else {
      initPricingHelpChoosing();
    }
  }());
</script>