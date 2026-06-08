<?php

/**
 * Pricing Main Packages Section
 *
 * File: template-parts/sections/pricing/main-packages.php
 *
 * Fixes (all functions/options/font names unchanged):
 * 1. Title color token  #334155 → #0F172A
 * 2. Title size clamp(34px,4.8vw,64px) → clamp(28px,4vw,44px)
 * 3. Title letter-spacing -0.058em → -0.038em
 * 4. Subtitle/text color #64748B → #475569 (more readable)
 * 5. Subtitle font-weight 500 → 400 (body weight)
 * 6. Trust feature H3  18px font-[800] → 16px font-extrabold Poppins
 * 7. Trust feature body 16px → 15px / 1.72 Inter
 * 8. Trust feature padding p-5 → p-6, gap icon+text → gap-3
 * 9. Bottom guidance H3  28px → 22px
 * 10. Empty/no-WC H3     28px → 22px
 * 11. CTA button font-[700] text-[16px] → font-semibold text-[15px]
 * 12. "Need monthly ORM?" link font-[700] → font-semibold
 * 13. Title-line gradient → blue→green brand (was gray)
 * 14. Section borders top/bottom bg-[#E2E8F0]
 * 15. Trust panel border border-slate-200 → border-[#E2E8F0]
 * All keyframes, IntersectionObserver, mousemove, WC query — UNCHANGED
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$context = isset($args) && is_array($args) ? $args : [];

$category_slug = ! empty($context['categories']['one_time_packages'])
  ? sanitize_title($context['categories']['one_time_packages'])
  : 'one-time-orm-packages';

$contact_url = ! empty($context['contact_url'])
  ? esc_url_raw($context['contact_url'])
  : home_url('/contact/?type=pricing-help');

$services_url = ! empty($context['services_page_url'])
  ? esc_url_raw($context['services_page_url'])
  : home_url('/services/');

$products = [];

if (class_exists('WooCommerce') && function_exists('wc_get_products')) {
  $products = wc_get_products([
    'status'   => 'publish',
    'limit'    => -1,
    'category' => [$category_slug],
    'orderby'  => ['menu_order' => 'ASC', 'date' => 'DESC'],
    'return'   => 'objects',
  ]);
}

$product_count = is_array($products) ? count($products) : 0;
?>

<style>
  /* ── Design tokens — variable names unchanged ── */
  #pricing-main-packages {
    --rsp-pricing-main-title: #0F172A;
    --rsp-pricing-main-heading: #1E293B;
    --rsp-pricing-main-subtitle: #475569;
    --rsp-pricing-main-text: #475569;
    --rsp-pricing-main-blue: #2563EB;
    --rsp-pricing-main-green: #00C853;
    --rsp-pricing-main-teal: #14B8A6;
    --rsp-pricing-main-border: rgba(226, 232, 240, 1);
  }

  /* ── Typography — Poppins/Inter/DM Mono names unchanged ── */
  #pricing-main-packages .rsp-pricing-main-text {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-pricing-main-text);
  }

  #pricing-main-packages .rsp-pricing-main-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    /* FIX: was 500 */
    line-height: 1.75;
    color: var(--rsp-pricing-main-subtitle);
    max-width: 600px;
  }

  /* FIX: size + tracking reduced, color darkened */
  #pricing-main-packages .rsp-pricing-main-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.038em;
    color: var(--rsp-pricing-main-title);
  }

  #pricing-main-packages .rsp-pricing-main-heading {
    color: var(--rsp-pricing-main-heading);
  }

  /* ── Reveal system — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #pricing-main-packages .rsp-pricing-main-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Title frame decorations — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-title-wrap {
    position: relative;
    isolation: isolate;
  }

  #pricing-main-packages .rsp-pricing-main-title-wrap::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 54%;
    z-index: -2;
    width: min(720px, 92vw);
    height: 210px;
    border-radius: 999px;
    background:
      radial-gradient(circle at 18% 40%, rgba(37, 99, 235, 0.10), transparent 34%),
      radial-gradient(circle at 82% 50%, rgba(0, 200, 83, 0.09), transparent 34%),
      rgba(255, 255, 255, 0.52);
    transform: translate(-50%, -50%) scaleX(0.92);
    filter: blur(2px);
    opacity: 0.80;
    animation: rspPricingMainTitleSpotlight 5.6s ease-in-out infinite alternate;
  }

  #pricing-main-packages .rsp-pricing-main-title-frame {
    position: relative;
    display: inline-block;
  }

  #pricing-main-packages .rsp-pricing-main-title-frame::before,
  #pricing-main-packages .rsp-pricing-main-title-frame::after {
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

  #pricing-main-packages .rsp-pricing-main-title-frame::before {
    left: -18px;
    top: -12px;
    border-left: 1px solid rgba(51, 65, 85, 0.16);
    border-top: 1px solid rgba(51, 65, 85, 0.16);
    border-top-left-radius: 18px;
  }

  #pricing-main-packages .rsp-pricing-main-title-frame::after {
    right: -18px;
    bottom: -12px;
    border-right: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom-right-radius: 18px;
  }

  #pricing-main-packages .rsp-pricing-main-title-wrap:hover .rsp-pricing-main-title-frame::before {
    opacity: 0.68;
    transform: translate(-4px, -4px);
  }

  #pricing-main-packages .rsp-pricing-main-title-wrap:hover .rsp-pricing-main-title-frame::after {
    opacity: 0.68;
    transform: translate(4px, 4px);
  }

  /* FIX: title-line → blue→green brand gradient, centered */
  #pricing-main-packages .rsp-pricing-main-title-line {
    display: block;
    height: 2.5px;
    width: min(480px, 86vw);
    margin: 24px auto 0;
    border-radius: 999px;
    background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.5), rgba(0, 200, 83, 0.3), transparent);
    transform-origin: center;
    animation: rspPricingMainTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
  }

  #pricing-main-packages .rsp-pricing-main-title-word {
    display: inline-block;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      letter-spacing 360ms ease;
  }

  #pricing-main-packages .rsp-pricing-main-title-wrap:hover .rsp-pricing-main-title-word {
    transform: translateY(-2px);
    letter-spacing: -0.044em;
  }

  /* ── Kicker badge glow — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-kicker {
    position: relative;
  }

  #pricing-main-packages .rsp-pricing-main-kicker::before {
    content: '';
    position: absolute;
    inset: -1px;
    z-index: -1;
    border-radius: inherit;
    background:
      linear-gradient(90deg, rgba(255, 255, 255, 0.90), rgba(255, 255, 255, 0.72)),
      radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.10), transparent 40%),
      radial-gradient(circle at 80% 50%, rgba(0, 200, 83, 0.10), transparent 40%);
  }

  /* ── Motion border — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-main-packages .rsp-pricing-main-motion-border::before {
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
    animation: rspPricingMainBorderSpin 8s linear infinite;
    opacity: 0.65;
    transition: opacity 260ms ease;
  }

  #pricing-main-packages .rsp-pricing-main-motion-border::after {
    content: '';
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-pricing-main-inner, #ffffff);
  }

  #pricing-main-packages .rsp-pricing-main-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  /* ── Glow panel — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-panel {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-main-packages .rsp-pricing-main-panel::before {
    content: '';
    position: absolute;
    inset: -110px;
    z-index: -1;
    background:
      radial-gradient(circle at 12% 20%, rgba(37, 99, 235, 0.09), transparent 28%),
      radial-gradient(circle at 88% 72%, rgba(0, 200, 83, 0.09), transparent 30%);
    animation: rspPricingMainGlowMove 9s ease-in-out infinite alternate;
  }

  /* ── Feature card hover — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-feature {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease,
      border-color 280ms ease;
  }

  #pricing-main-packages .rsp-pricing-main-feature:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 52px rgba(15, 23, 42, 0.09);
  }

  /* ── CTA button shimmer — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #pricing-main-packages .rsp-pricing-main-btn::before {
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

  #pricing-main-packages .rsp-pricing-main-btn:hover {
    transform: translateY(-3px);
  }

  #pricing-main-packages .rsp-pricing-main-btn:hover::before {
    left: 135%;
  }

  /* ── Top beam — unchanged ── */
  #pricing-main-packages .rsp-pricing-main-beam {
    animation: rspPricingMainBeam 8s ease-in-out infinite;
  }

  /* ── Keyframes — all names unchanged ── */
  @keyframes rspPricingMainTitleSpotlight {
    from {
      transform: translate(-50%, -50%) scaleX(0.86);
      opacity: 0.48;
    }

    to {
      transform: translate(-50%, -50%) scaleX(1.04);
      opacity: 0.88;
    }
  }

  @keyframes rspPricingMainTitleLine {
    from {
      transform: scaleX(0.48);
      opacity: 0.42;
    }

    to {
      transform: scaleX(1);
      opacity: 0.82;
    }
  }

  @keyframes rspPricingMainBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspPricingMainGlowMove {
    from {
      transform: translate3d(-18px, -10px, 0) scale(1);
    }

    to {
      transform: translate3d(18px, 12px, 0) scale(1.04);
    }
  }

  @keyframes rspPricingMainBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {

    #pricing-main-packages *,
    #pricing-main-packages *::before,
    #pricing-main-packages *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #pricing-main-packages .rsp-pricing-main-reveal {
      opacity: 1;
      transform: none;
    }
  }
</style>

<section
  id="pricing-main-packages"
  class="relative overflow-hidden bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="pricing-main-packages-title">

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.038)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.038)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>
  <!-- glow orbs -->
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-500/[0.08] blur-[120px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-16 z-0 h-[520px] w-[520px] rounded-full bg-[#00C853]/[0.08] blur-[120px]" aria-hidden="true"></div>
  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── SECTION HEADER — centered ── -->
    <div
      class="rsp-pricing-main-reveal rsp-pricing-main-title-wrap mx-auto max-w-3xl text-center"
      data-rsp-pricing-main-reveal>

      <span class="rsp-pricing-main-kicker relative inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-white px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-[#475569] shadow-sm">
        <i data-lucide="shield-check" class="h-[13px] w-[13px] text-[#047A35]" aria-hidden="true"></i>
        <?php esc_html_e('Focused ORM Packages', 'reviewservicepro'); ?>
      </span>

      <div class="rsp-pricing-main-title-frame mt-6">
        <h2
          id="pricing-main-packages-title"
          class="rsp-pricing-main-title m-0">
          <span class="rsp-pricing-main-title-word block">
            <?php esc_html_e('Start with a focused', 'reviewservicepro'); ?>
          </span>
          <span class="rsp-pricing-main-title-word block">
            <?php esc_html_e('reputation service.', 'reviewservicepro'); ?>
          </span>
        </h2>
      </div>

      <span class="rsp-pricing-main-title-line" aria-hidden="true"></span>

      <p class="rsp-pricing-main-subtitle mx-auto mt-6">
        <?php esc_html_e('Choose a clear reputation package before committing to ongoing monthly ORM management. Each package is built for ethical monitoring, response quality, documentation, and trust improvement.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- ── TRUST STRIP ── -->
    <div
      class="rsp-pricing-main-reveal rsp-pricing-main-panel mt-12 rounded-[1.75rem] border border-[#E2E8F0] bg-white/92 p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_20px_70px_rgba(15,23,42,0.07)] backdrop-blur-xl"
      data-rsp-pricing-main-reveal>

      <!-- animated beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[1.75rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-main-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        <!-- Feature 1 -->
        <div class="rsp-pricing-main-feature rounded-2xl border border-blue-100 bg-blue-50/80 p-6">
          <div class="flex items-start gap-3">
            <span class="mt-0.5 flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-blue-200 bg-white text-[#2563EB] shadow-sm">
              <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <!-- FIX: 16px font-extrabold Poppins (was 18px font-[800]) -->
              <h3 class="rsp-pricing-main-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em]">
                <?php esc_html_e('Clear starting point', 'reviewservicepro'); ?>
              </h3>
              <p class="rsp-pricing-main-text mt-1.5">
                <?php esc_html_e('Understand your reputation gaps before ongoing service.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Feature 2 -->
        <div class="rsp-pricing-main-feature rounded-2xl border border-[#00C853]/20 bg-[#00C853]/[0.045] p-6">
          <div class="flex items-start gap-3">
            <span class="mt-0.5 flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-[#00C853]/25 bg-white text-[#00A344] shadow-sm">
              <i data-lucide="layout-dashboard" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <h3 class="rsp-pricing-main-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em]">
                <?php esc_html_e('Portal after payment', 'reviewservicepro'); ?>
              </h3>
              <p class="rsp-pricing-main-text mt-1.5">
                <?php esc_html_e('Onboarding and service details continue after checkout.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Feature 3 -->
        <div class="rsp-pricing-main-feature rounded-2xl border border-amber-100 bg-amber-50/80 p-6">
          <div class="flex items-start gap-3">
            <span class="mt-0.5 flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-amber-200 bg-white text-amber-600 shadow-sm">
              <i data-lucide="shield-alert" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <div>
              <h3 class="rsp-pricing-main-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em]">
                <?php esc_html_e('Ethical ORM only', 'reviewservicepro'); ?>
              </h3>
              <p class="rsp-pricing-main-text mt-1.5">
                <?php esc_html_e('No fake reviews, paid incentives, or guaranteed removals.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── PRODUCT STATES ── -->

    <?php if (! class_exists('WooCommerce')) : ?>

      <!-- State 1: WooCommerce not active -->
      <div class="rsp-pricing-main-reveal mt-12 rounded-[1.75rem] border border-amber-200 bg-amber-50 p-8 text-center shadow-sm" data-rsp-pricing-main-reveal>
        <h3 class="rsp-pricing-main-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
          <?php esc_html_e('WooCommerce is not active', 'reviewservicepro'); ?>
        </h3>
        <p class="rsp-pricing-main-text mx-auto mt-3 max-w-lg">
          <?php esc_html_e('Activate WooCommerce to load ORM packages dynamically on this pricing page.', 'reviewservicepro'); ?>
        </p>
      </div>

    <?php elseif (empty($products)) : ?>

      <!-- State 2: No products -->
      <div class="rsp-pricing-main-reveal mt-12 rounded-[1.75rem] border border-[#E2E8F0] bg-white p-7 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-pricing-main-reveal>
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[auto_1fr_auto] lg:items-center">
          <span class="flex h-14 w-14 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-[#2563EB] shadow-sm">
            <i data-lucide="package-plus" class="h-6 w-6" aria-hidden="true"></i>
          </span>
          <div>
            <h3 class="rsp-pricing-main-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
              <?php esc_html_e('No packages found yet.', 'reviewservicepro'); ?>
            </h3>
            <p class="rsp-pricing-main-text mt-2">
              <?php printf(
                esc_html__('Create WooCommerce products and assign them to the category slug: %s.', 'reviewservicepro'),
                esc_html($category_slug)
              ); ?>
            </p>
          </div>
          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="rsp-pricing-main-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Ask for Help', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </div>

    <?php else : ?>

      <!-- State 3: Products found -->
      <div class="mt-12 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div class="rsp-pricing-main-reveal" data-rsp-pricing-main-reveal>
          <p class="font-['Inter',sans-serif] text-[14px] font-medium text-[#64748B]">
            <?php printf(
              esc_html(_n('%d package available', '%d packages available', $product_count, 'reviewservicepro')),
              absint($product_count)
            ); ?>
          </p>
        </div>

        <a
          href="<?php echo esc_url($services_url); ?>"
          class="rsp-pricing-main-reveal hidden items-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 font-['Inter',sans-serif] text-[14px] font-semibold text-[#334155] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB] md:inline-flex"
          data-rsp-pricing-main-reveal>
          <?php esc_html_e('Need monthly ORM?', 'reviewservicepro'); ?>
          <i data-lucide="arrow-up-right" class="h-4 w-4 text-[#2563EB]" aria-hidden="true"></i>
        </a>
      </div>

      <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        <?php foreach ($products as $index => $product) : ?>
          <div
            class="rsp-pricing-main-reveal"
            data-rsp-pricing-main-reveal
            style="transition-delay:<?php echo esc_attr((string) min($index * 70, 420)); ?>ms;">
            <?php
            get_template_part(
              'template-parts/components/pricing-product-card',
              null,
              [
                'product'       => $product,
                'fallback_url'  => $contact_url,
                'section_label' => __('ORM Package', 'reviewservicepro'),
              ]
            );
            ?>
          </div>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

    <!-- ── BOTTOM GUIDANCE ── -->
    <div
      class="rsp-pricing-main-reveal rsp-pricing-main-motion-border mt-12 rounded-[1.75rem] border border-[#E2E8F0] bg-[#F8FAFC] p-7 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_60px_rgba(15,23,42,0.06)]"
      data-rsp-pricing-main-reveal
      style="--rsp-pricing-main-inner:#F8FAFC;">

      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <!-- FIX: 22px (was 28px) -->
          <h3 class="rsp-pricing-main-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
            <?php esc_html_e('Not sure which reputation package fits?', 'reviewservicepro'); ?>
          </h3>
          <p class="rsp-pricing-main-subtitle mt-3">
            <?php esc_html_e('Start with a Reputation Audit if you need clarity. Choose Review Response Setup if your main issue is response quality. Choose Negative Review Case Review when you need documentation and platform-compliant next-step guidance.', 'reviewservicepro'); ?>
          </p>
        </div>

        <a
          href="<?php echo esc_url($contact_url); ?>"
          class="rsp-pricing-main-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Get Help Choosing', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    /* IntersectionObserver reveal + mousemove handler — both unchanged */
    function initRspPricingMainPackages() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('[data-rsp-pricing-main-reveal]');

      if ('IntersectionObserver' in window && revealItems.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('rsp-is-visible');
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        revealItems.forEach(function(item) {
          observer.observe(item);
        });
      } else {
        revealItems.forEach(function(item) {
          item.classList.add('rsp-is-visible');
        });
      }

      /* mousemove card glow — unchanged */
      var cards = document.querySelectorAll('[data-rsp-pricing-card]');
      cards.forEach(function(card) {
        if (card.dataset.rspPricingMouseReady === 'true') return;
        card.dataset.rspPricingMouseReady = 'true';
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;
          card.style.setProperty('--rsp-card-x', x + '%');
          card.style.setProperty('--rsp-card-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPricingMainPackages);
    } else {
      initRspPricingMainPackages();
    }
  }());
</script>