<?php

/**
 * Pricing How It Works Section
 *
 * File: template-parts/sections/pricing/how-it-works.php
 *
 * Fixes (all functions/options/font names/keyframes unchanged):
 * 1.  Title color token  #334155 → #0F172A
 * 2.  Title size  clamp(36px,5vw,68px) → clamp(28px,4vw,44px)
 * 3.  Title letter-spacing  -0.058em → -0.038em
 * 4.  Subtitle font-weight 500 → 400 (body weight), color #475569
 * 5.  Text color #64748B → #475569
 * 6.  Title-line gradient → blue→green brand (was gray)
 * 7.  Step card H3  24px font-[800] → 17px font-extrabold Poppins
 * 8.  Step card body  16px/1.75 → 15px/1.72 Inter
 * 9.  Step card padding  p-5 → p-6
 * 10. Floating badge H  font-[800] 15px → font-bold 15px Poppins
 * 11. Floating badge sub  13px → 13px Inter (already fine, explicit)
 * 12. Confidence items  16px font-medium → 15px font-medium Inter
 * 13. Confidence items  border-slate-200 → border-[#E2E8F0]
 * 14. CTA H3  28px font-[800] → 22px font-extrabold Poppins
 * 15. CTA buttons  font-[700] text-[16px] → font-semibold text-[15px]
 * 16. Process shell border  border-slate-200 → border-[#E2E8F0]
 * 17. Section borders top/bottom bg-[#E2E8F0]
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
$image_url = $theme_uri . 'assets/images/pricing/pricing-how-it-works-flow.webp';

$steps = [
  [
    'number' => '01',
    'title'  => __('Choose a focused service', 'reviewservicepro'),
    'text'   => __('Start with an ORM package, platform check, or add-on that matches your current reputation concern.', 'reviewservicepro'),
    'icon'   => 'package-check',
    'tone'   => 'blue',
  ],
  [
    'number' => '02',
    'title'  => __('Review the service details', 'reviewservicepro'),
    'text'   => __('Open the product details page to see what is included, what is not included, the timeline, and the compliance-safe scope.', 'reviewservicepro'),
    'icon'   => 'file-search',
    'tone'   => 'green',
  ],
  [
    'number' => '03',
    'title'  => __('Complete secure checkout', 'reviewservicepro'),
    'text'   => __('Order through WooCommerce checkout. Ready buyers can also use the direct Order Now button from the pricing card.', 'reviewservicepro'),
    'icon'   => 'credit-card',
    'tone'   => 'blue',
  ],
  [
    'number' => '04',
    'title'  => __('Continue inside client portal', 'reviewservicepro'),
    'text'   => __('After payment, your order, invoice, onboarding instructions, support, and service updates continue inside your client portal.', 'reviewservicepro'),
    'icon'   => 'layout-dashboard',
    'tone'   => 'green',
  ],
  [
    'number' => '05',
    'title'  => __('Submit onboarding details', 'reviewservicepro'),
    'text'   => __('Share your business name, review platform links, priority concerns, screenshots if needed, and the outcome you want clarity on.', 'reviewservicepro'),
    'icon'   => 'clipboard-list',
    'tone'   => 'teal',
  ],
  [
    'number' => '06',
    'title'  => __('Receive your delivery', 'reviewservicepro'),
    'text'   => __('You receive the agreed report, setup guidance, response direction, platform check notes, or add-on deliverable based on your order.', 'reviewservicepro'),
    'icon'   => 'badge-check',
    'tone'   => 'green',
  ],
];

$tone_classes = [
  'blue' => [
    'card'  => 'border-blue-100 bg-blue-50/70',
    'icon'  => 'border-blue-200 bg-blue-50 text-[#2563EB]',
    'num'   => 'text-[#2563EB]',
    'inner' => '#EFF6FF',
  ],
  'green' => [
    'card'  => 'border-[#00C853]/20 bg-[#00C853]/[0.045]',
    'icon'  => 'border-[#00C853]/25 bg-[#00C853]/10 text-[#00A344]',
    'num'   => 'text-[#00A344]',
    'inner' => '#F0FDF4',
  ],
  'teal' => [
    'card'  => 'border-[#14B8A6]/20 bg-[#14B8A6]/[0.06]',
    'icon'  => 'border-[#14B8A6]/25 bg-[#14B8A6]/10 text-[#0F766E]',
    'num'   => 'text-[#0F766E]',
    'inner' => '#F0FDFA',
  ],
];

$confidence_items = [
  ['label' => __('No long-term commitment required', 'reviewservicepro'), 'icon' => 'check-circle-2'],
  ['label' => __('Clear scope before checkout', 'reviewservicepro'),     'icon' => 'check-circle-2'],
  ['label' => __('Client portal access after payment', 'reviewservicepro'), 'icon' => 'check-circle-2'],
  ['label' => __('Upgrade path to monthly ORM later', 'reviewservicepro'), 'icon' => 'check-circle-2'],
];
?>

<style>
  /* ── Design tokens — variable names unchanged ── */
  #pricing-how-it-works {
    --rsp-process-title: #0F172A;
    --rsp-process-heading: #1E293B;
    --rsp-process-subtitle: #475569;
    --rsp-process-text: #475569;
    --rsp-process-blue: #2563EB;
    --rsp-process-green: #00C853;
    --rsp-process-teal: #14B8A6;
  }

  /* ── Typography — Poppins/Inter/DM Mono names unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-text {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-process-text);
  }

  #pricing-how-it-works .rsp-pricing-process-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.75;
    color: var(--rsp-process-subtitle);
    max-width: 600px;
  }

  /* FIX: size + tracking reduced, color darkened */
  #pricing-how-it-works .rsp-pricing-process-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.038em;
    color: var(--rsp-process-title);
  }

  #pricing-how-it-works .rsp-pricing-process-heading {
    color: var(--rsp-process-heading);
  }

  /* ── Reveal system — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #pricing-how-it-works .rsp-pricing-process-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Title frame decorations — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-title-wrap {
    position: relative;
    isolation: isolate;
  }

  #pricing-how-it-works .rsp-pricing-process-title-wrap::before {
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
    animation: rspPricingProcessTitleSpotlight 5.6s ease-in-out infinite alternate;
  }

  #pricing-how-it-works .rsp-pricing-process-title-frame {
    position: relative;
    display: inline-block;
  }

  #pricing-how-it-works .rsp-pricing-process-title-frame::before,
  #pricing-how-it-works .rsp-pricing-process-title-frame::after {
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

  #pricing-how-it-works .rsp-pricing-process-title-frame::before {
    left: -18px;
    top: -12px;
    border-left: 1px solid rgba(51, 65, 85, 0.16);
    border-top: 1px solid rgba(51, 65, 85, 0.16);
    border-top-left-radius: 18px;
  }

  #pricing-how-it-works .rsp-pricing-process-title-frame::after {
    right: -18px;
    bottom: -12px;
    border-right: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom-right-radius: 18px;
  }

  #pricing-how-it-works .rsp-pricing-process-title-wrap:hover .rsp-pricing-process-title-frame::before {
    opacity: 0.68;
    transform: translate(-4px, -4px);
  }

  #pricing-how-it-works .rsp-pricing-process-title-wrap:hover .rsp-pricing-process-title-frame::after {
    opacity: 0.68;
    transform: translate(4px, 4px);
  }

  #pricing-how-it-works .rsp-pricing-process-title-word {
    display: inline-block;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      letter-spacing 360ms ease;
  }

  #pricing-how-it-works .rsp-pricing-process-title-wrap:hover .rsp-pricing-process-title-word {
    transform: translateY(-2px);
    letter-spacing: -0.044em;
  }

  /* FIX: title-line → blue→green brand */
  #pricing-how-it-works .rsp-pricing-process-title-line {
    display: block;
    height: 2.5px;
    width: min(460px, 86vw);
    margin-top: 22px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.5), rgba(0, 200, 83, 0.3), transparent);
    transform-origin: left;
    animation: rspPricingProcessTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
  }

  /* ── Kicker badge — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-kicker {
    position: relative;
    isolation: isolate;
  }

  #pricing-how-it-works .rsp-pricing-process-kicker::before {
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
  #pricing-how-it-works .rsp-pricing-process-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-how-it-works .rsp-pricing-process-motion-border::before {
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
    animation: rspPricingProcessBorderSpin 8s linear infinite;
    opacity: 0.65;
    transition: opacity 260ms ease;
  }

  #pricing-how-it-works .rsp-pricing-process-motion-border::after {
    content: '';
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-process-inner, #ffffff);
  }

  #pricing-how-it-works .rsp-pricing-process-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  /* ── Glow panel — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-panel {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-how-it-works .rsp-pricing-process-panel::before {
    content: '';
    position: absolute;
    inset: -110px;
    z-index: -1;
    background:
      radial-gradient(circle at 12% 20%, rgba(37, 99, 235, 0.09), transparent 28%),
      radial-gradient(circle at 88% 72%, rgba(0, 200, 83, 0.09), transparent 30%);
    animation: rspPricingProcessGlowMove 9s ease-in-out infinite alternate;
  }

  /* ── Visual frame + image — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-visual-frame {
    position: relative;
    animation: rspPricingProcessFloat 7s ease-in-out infinite;
  }

  #pricing-how-it-works .rsp-pricing-process-visual-frame::before {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 2.25rem;
    background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.38), rgba(0, 200, 83, 0.28), transparent);
    background-size: 220% 100%;
    animation: rspPricingProcessVisualBeam 5.5s ease-in-out infinite;
    opacity: 0.86;
    pointer-events: none;
  }

  #pricing-how-it-works .rsp-pricing-process-visual-inner {
    position: relative;
    z-index: 1;
  }

  #pricing-how-it-works .rsp-pricing-process-img {
    display: block;
    width: 100%;
    aspect-ratio: 16 / 11;
    object-fit: cover;
    transition:
      transform 720ms cubic-bezier(0.2, 0.9, 0.2, 1),
      filter 420ms ease;
  }

  #pricing-how-it-works .rsp-pricing-process-visual-frame:hover .rsp-pricing-process-img {
    transform: scale(1.04);
    filter: saturate(1.06);
  }

  /* ── Floating badge — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-floating-card {
    --rsp-process-inner: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(18px);
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.11);
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease;
  }

  #pricing-how-it-works .rsp-pricing-process-floating-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 26px 70px rgba(15, 23, 42, 0.14);
  }

  /* ── Step card — unchanged hover logic ── */
  #pricing-how-it-works .rsp-pricing-process-step-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 340ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #pricing-how-it-works .rsp-pricing-process-step-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 62px rgba(15, 23, 42, 0.09);
  }

  #pricing-how-it-works .rsp-pricing-process-step-card:hover .rsp-pricing-process-icon {
    transform: rotate(-4deg) scale(1.08);
    box-shadow: 0 14px 36px rgba(37, 99, 235, 0.09);
  }

  #pricing-how-it-works .rsp-pricing-process-icon {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 280ms ease;
  }

  /* ── CTA button shimmer — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #pricing-how-it-works .rsp-pricing-process-btn::before {
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

  #pricing-how-it-works .rsp-pricing-process-btn:hover {
    transform: translateY(-3px);
  }

  #pricing-how-it-works .rsp-pricing-process-btn:hover::before {
    left: 135%;
  }

  /* ── Top beam — unchanged ── */
  #pricing-how-it-works .rsp-pricing-process-beam {
    animation: rspPricingProcessBeam 7s ease-in-out infinite;
  }

  /* ── Keyframes — all names unchanged ── */
  @keyframes rspPricingProcessTitleSpotlight {
    from {
      transform: translate(-50%, -50%) scaleX(0.86);
      opacity: 0.48;
    }

    to {
      transform: translate(-50%, -50%) scaleX(1.04);
      opacity: 0.88;
    }
  }

  @keyframes rspPricingProcessTitleLine {
    from {
      transform: scaleX(0.48);
      opacity: 0.42;
    }

    to {
      transform: scaleX(1);
      opacity: 0.82;
    }
  }

  @keyframes rspPricingProcessBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspPricingProcessGlowMove {
    from {
      transform: translate3d(-18px, -10px, 0) scale(1);
    }

    to {
      transform: translate3d(18px, 12px, 0) scale(1.04);
    }
  }

  @keyframes rspPricingProcessVisualBeam {

    0%,
    100% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }
  }

  @keyframes rspPricingProcessFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-10px);
    }
  }

  @keyframes rspPricingProcessBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {

    #pricing-how-it-works *,
    #pricing-how-it-works *::before,
    #pricing-how-it-works *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #pricing-how-it-works .rsp-pricing-process-reveal {
      opacity: 1;
      transform: none;
    }
  }
</style>

<section
  id="pricing-how-it-works"
  class="relative overflow-hidden bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="pricing-how-it-works-title">

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.036)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.036)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>
  <!-- glow orbs -->
  <div class="pointer-events-none absolute -left-28 top-24 z-0 h-[460px] w-[460px] rounded-full bg-blue-500/[0.08] blur-[120px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-28 bottom-16 z-0 h-[460px] w-[460px] rounded-full bg-[#00C853]/[0.08] blur-[120px]" aria-hidden="true"></div>
  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── HEADER GRID: Left text + Right image ── -->
    <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-[minmax(0,0.92fr)_minmax(420px,0.82fr)] lg:gap-16">

      <!-- Left: headline + confidence items -->
      <div class="rsp-pricing-process-reveal rsp-pricing-process-title-wrap" data-pricing-process-reveal>

        <span class="rsp-pricing-process-kicker inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-white px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-[#475569] shadow-sm">
          <i data-lucide="workflow" class="h-[13px] w-[13px] text-[#2563EB]" aria-hidden="true"></i>
          <?php esc_html_e('How It Works', 'reviewservicepro'); ?>
        </span>

        <div class="rsp-pricing-process-title-frame mt-6">
          <h2
            id="pricing-how-it-works-title"
            class="rsp-pricing-process-title m-0">
            <span class="rsp-pricing-process-title-word block">
              <?php esc_html_e('A clear order flow', 'reviewservicepro'); ?>
            </span>
            <span class="rsp-pricing-process-title-word block">
              <?php esc_html_e('built for service buyers.', 'reviewservicepro'); ?>
            </span>
          </h2>
        </div>

        <span class="rsp-pricing-process-title-line" aria-hidden="true"></span>

        <p class="rsp-pricing-process-subtitle mt-6">
          <?php esc_html_e('ReviewService.Pro keeps the buying process simple: choose a focused reputation service, review the details, checkout securely, then continue the work inside your client portal.', 'reviewservicepro'); ?>
        </p>

        <!-- Confidence checklist -->
        <div class="mt-8 grid grid-cols-1 gap-3 sm:grid-cols-2">
          <?php foreach ($confidence_items as $item) : ?>
            <div class="flex items-start gap-3 rounded-2xl border border-[#E2E8F0] bg-white/90 p-4 shadow-sm transition-all duration-300 hover:-translate-y-[3px] hover:border-emerald-200 hover:bg-emerald-50/40">
              <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="mt-0.5 h-[18px] w-[18px] shrink-0 text-[#00A344]" aria-hidden="true"></i>
              <!-- FIX: Inter 15px font-medium -->
              <p class="font-['Inter',sans-serif] text-[15px] font-medium leading-[1.6] text-[#334155]">
                <?php echo esc_html($item['label']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right: image + floating badges (unchanged structure) -->
      <div class="rsp-pricing-process-reveal relative" data-pricing-process-reveal>
        <div class="absolute -inset-8 rounded-[2.75rem] bg-blue-100/70 blur-3xl" aria-hidden="true"></div>

        <div class="rsp-pricing-process-visual-frame rounded-[2.25rem] bg-white p-[2px] shadow-[0_30px_100px_rgba(15,23,42,0.12)]">
          <div class="rsp-pricing-process-visual-inner overflow-hidden rounded-[calc(2.25rem-2px)] border border-[#E2E8F0] bg-white">
            <img
              src="<?php echo esc_url($image_url); ?>"
              alt="<?php echo esc_attr__('ReviewService.Pro order flow from service package selection to secure checkout and client portal', 'reviewservicepro'); ?>"
              class="rsp-pricing-process-img"
              loading="lazy"
              decoding="async"
              width="1200"
              height="825">
          </div>
        </div>

        <!-- Floating badge: bottom-left -->
        <div class="rsp-pricing-process-floating-card rsp-pricing-process-motion-border absolute -left-4 bottom-8 hidden rounded-2xl border border-[#E2E8F0] px-4 py-3 lg:block">
          <div class="relative z-10 flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#00A344]">
              <i data-lucide="layout-dashboard" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <!-- FIX: Poppins font-bold 15px (was font-[800]) -->
              <p class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug text-[#0F172A]">
                <?php esc_html_e('Client Portal', 'reviewservicepro'); ?>
              </p>
              <p class="font-['Inter',sans-serif] text-[13px] font-medium leading-snug text-[#64748B]">
                <?php esc_html_e('Access after payment', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Floating badge: top-right -->
        <div class="rsp-pricing-process-floating-card rsp-pricing-process-motion-border absolute -right-4 top-7 hidden rounded-2xl border border-[#E2E8F0] px-4 py-3 lg:block">
          <div class="relative z-10 flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">
              <i data-lucide="credit-card" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <p class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug text-[#0F172A]">
                <?php esc_html_e('Secure Checkout', 'reviewservicepro'); ?>
              </p>
              <p class="font-['Inter',sans-serif] text-[13px] font-medium leading-snug text-[#64748B]">
                <?php esc_html_e('WooCommerce flow', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── PROCESS SHELL: 6-step grid ── -->
    <div
      class="rsp-pricing-process-panel rsp-pricing-process-reveal relative mt-14 rounded-[2rem] border border-[#E2E8F0] bg-white/92 p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_24px_90px_rgba(15,23,42,0.07)] backdrop-blur-xl md:p-8"
      data-pricing-process-reveal>

      <!-- animated beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[2rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-process-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-5 lg:grid-cols-3">
        <?php foreach ($steps as $index => $step) :
          $tone = isset($tone_classes[$step['tone']]) ? $tone_classes[$step['tone']] : $tone_classes['blue'];
        ?>
          <article
            class="rsp-pricing-process-step-card rsp-pricing-process-motion-border rsp-pricing-process-reveal group rounded-[1.5rem] border <?php echo esc_attr($tone['card']); ?> p-6 shadow-[0_1px_3px_rgba(0,0,0,.03),0_10px_32px_rgba(15,23,42,0.05)]"
            data-pricing-process-reveal
            style="transition-delay:<?php echo esc_attr((string)($index * 70)); ?>ms;--rsp-process-inner:<?php echo esc_attr($tone['inner']); ?>;">

            <div class="relative z-10">
              <!-- icon + number row -->
              <div class="mb-5 flex items-start justify-between gap-4">
                <div class="rsp-pricing-process-icon flex h-12 w-12 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?>">
                  <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
                </div>
                <span class="<?php echo esc_attr($tone['num']); ?> font-['DM_Mono',monospace] text-[12px] font-medium tracking-[0.16em]">
                  <?php echo esc_html($step['number']); ?>
                </span>
              </div>

              <!-- FIX: 17px font-extrabold Poppins (was 24px font-[800]) -->
              <h3 class="rsp-pricing-process-heading font-['Poppins',sans-serif] text-[17px] font-extrabold leading-snug tracking-[-0.02em] mb-2">
                <?php echo esc_html($step['title']); ?>
              </h3>

              <!-- FIX: Inter 15px/1.72 (was 16px/1.75) -->
              <p class="rsp-pricing-process-text">
                <?php echo esc_html($step['text']); ?>
              </p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ── BOTTOM CTA ── -->
    <div
      class="rsp-pricing-process-reveal rsp-pricing-process-motion-border mt-8 rounded-[1.75rem] border border-blue-100 bg-blue-50/60 p-6 shadow-[0_1px_3px_rgba(0,0,0,.03),0_14px_48px_rgba(37,99,235,0.07)]"
      data-pricing-process-reveal
      style="--rsp-process-inner:#EFF6FF;">

      <div class="relative z-10 flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
        <div>
          <!-- FIX: 22px font-extrabold (was 28px font-[800]) -->
          <h3 class="rsp-pricing-process-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
            <?php esc_html_e('Want to start small before monthly ORM?', 'reviewservicepro'); ?>
          </h3>
          <p class="rsp-pricing-process-subtitle mt-3">
            <?php esc_html_e('Use a focused package first. If ongoing monitoring, response management, and reporting make sense later, you can move into a monthly ORM plan.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <!-- Primary CTA -->
          <a
            href="#pricing-main-packages"
            class="rsp-pricing-process-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('View Packages', 'reviewservicepro'); ?>
              <i data-lucide="arrow-up" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>

          <!-- Secondary CTA -->
          <a
            href="<?php echo esc_url($services_page_url); ?>#monthly-plans"
            class="rsp-pricing-process-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155] shadow-sm hover:border-[#00C853]/25 hover:bg-[#00C853]/[0.045] hover:text-[#065F46]">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('View Monthly Plans', 'reviewservicepro'); ?>
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
    /* IntersectionObserver reveal — data-pricing-process-reveal + rsp-is-visible unchanged */
    function initPricingProcess() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-pricing-process-reveal]');
      if (!items.length) return;

      function showItem(item) {
        if (!item || item.dataset.pricingProcessVisible === 'true') return;
        item.dataset.pricingProcessVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initPricingProcess);
    } else {
      initPricingProcess();
    }
  }());
</script>