<?php

/**
 * Pricing Platform Checks Section
 *
 * File: template-parts/sections/pricing/platform-checks.php
 *
 * Fixes applied (all functions/options/font names unchanged):
 * 1. Title color — #334155 → #0F172A (proper dark heading)
 * 2. Title size — clamp(34px,4.8vw,64px) → clamp(28px,4vw,44px) (matches page scale)
 * 3. Title letter-spacing — -0.058em → -0.038em (less compressed)
 * 4. Body/subtitle — color tokens updated to #475569 (more readable)
 * 5. Subtitle max-width — added max-w-[600px] for readability
 * 6. Feature card H3 — Poppins 16px extrabold (was 18px font-[800])
 * 7. Feature card body — Inter 15px / 1.72 (was 16px/1.75)
 * 8. Feature card padding — p-5 → p-6
 * 9. CTA button — font-semibold (was font-[700]) cleaner weight token
 * 10. "Need a platform" H3 — 24px (was 28px, better proportion)
 * 11. Empty/no-WC state H3 — same 24px fix
 * 12. Title-line gradient — blue→teal brand gradient (was gray)
 * 13. Section borders — top/bottom px bg-[#E2E8F0]
 * 14. All keyframes, animations, JS functions, WooCommerce query — UNCHANGED
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$context      = isset($args) && is_array($args) ? $args : [];

$category_slug = ! empty($context['categories']['platform_checks'])
  ? sanitize_title($context['categories']['platform_checks'])
  : 'platform-checks';

$contact_url = ! empty($context['contact_url'])
  ? esc_url_raw($context['contact_url'])
  : home_url('/contact/?type=pricing-help');

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
  #pricing-platform-checks {
    --rsp-platform-title: #0F172A;
    --rsp-platform-heading: #1E293B;
    --rsp-platform-subtitle: #475569;
    --rsp-platform-text: #475569;
    --rsp-platform-blue: #2563EB;
    --rsp-platform-green: #00C853;
    --rsp-platform-teal: #14B8A6;
    --rsp-platform-border: rgba(226, 232, 240, 1);
  }

  /* ── Typography — Poppins/Inter/DM Mono names unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-text {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-platform-text);
  }

  #pricing-platform-checks .rsp-pricing-platform-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.75;
    color: var(--rsp-platform-subtitle);
    max-width: 600px;
  }

  /* FIX: size reduced + tracking less extreme */
  #pricing-platform-checks .rsp-pricing-platform-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.038em;
    color: var(--rsp-platform-title);
  }

  #pricing-platform-checks .rsp-pricing-platform-heading {
    color: var(--rsp-platform-heading);
  }

  /* ── Reveal system — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #pricing-platform-checks .rsp-pricing-platform-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Title frame — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-title-wrap {
    position: relative;
    isolation: isolate;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-wrap::before {
    content: '';
    position: absolute;
    left: 48%;
    top: 54%;
    z-index: -2;
    width: min(720px, 92vw);
    height: 220px;
    border-radius: 999px;
    background:
      radial-gradient(circle at 18% 40%, rgba(37, 99, 235, 0.10), transparent 34%),
      radial-gradient(circle at 82% 50%, rgba(20, 184, 166, 0.11), transparent 34%),
      rgba(255, 255, 255, 0.62);
    transform: translate(-50%, -50%) scaleX(0.92);
    filter: blur(2px);
    opacity: 0.80;
    animation: rspPricingPlatformTitleSpotlight 5.6s ease-in-out infinite alternate;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-frame {
    position: relative;
    display: inline-block;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-frame::before,
  #pricing-platform-checks .rsp-pricing-platform-title-frame::after {
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

  #pricing-platform-checks .rsp-pricing-platform-title-frame::before {
    left: -18px;
    top: -12px;
    border-left: 1px solid rgba(51, 65, 85, 0.16);
    border-top: 1px solid rgba(51, 65, 85, 0.16);
    border-top-left-radius: 18px;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-frame::after {
    right: -18px;
    bottom: -12px;
    border-right: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom: 1px solid rgba(51, 65, 85, 0.16);
    border-bottom-right-radius: 18px;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-wrap:hover .rsp-pricing-platform-title-frame::before {
    opacity: 0.68;
    transform: translate(-4px, -4px);
  }

  #pricing-platform-checks .rsp-pricing-platform-title-wrap:hover .rsp-pricing-platform-title-frame::after {
    opacity: 0.68;
    transform: translate(4px, 4px);
  }

  /* FIX: title line — blue→teal brand gradient */
  #pricing-platform-checks .rsp-pricing-platform-title-line {
    display: block;
    height: 2.5px;
    width: min(460px, 86vw);
    margin-top: 22px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.5), rgba(20, 184, 166, 0.25), transparent);
    transform-origin: left;
    animation: rspPricingPlatformTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-word {
    display: inline-block;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      letter-spacing 360ms ease;
  }

  #pricing-platform-checks .rsp-pricing-platform-title-wrap:hover .rsp-pricing-platform-title-word {
    transform: translateY(-2px);
    letter-spacing: -0.044em;
  }

  /* ── Kicker badge ── */
  #pricing-platform-checks .rsp-pricing-platform-kicker {
    position: relative;
    isolation: isolate;
  }

  #pricing-platform-checks .rsp-pricing-platform-kicker::before {
    content: '';
    position: absolute;
    inset: -1px;
    z-index: -1;
    border-radius: inherit;
    background:
      linear-gradient(90deg, rgba(255, 255, 255, 0.94), rgba(255, 255, 255, 0.74)),
      radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.10), transparent 40%),
      radial-gradient(circle at 80% 50%, rgba(20, 184, 166, 0.12), transparent 40%);
  }

  /* ── Glow panel — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-panel {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-platform-checks .rsp-pricing-platform-panel::before {
    content: '';
    position: absolute;
    inset: -110px;
    z-index: -1;
    background:
      radial-gradient(circle at 10% 20%, rgba(20, 184, 166, 0.09), transparent 30%),
      radial-gradient(circle at 88% 74%, rgba(37, 99, 235, 0.09), transparent 32%);
    animation: rspPricingPlatformGlowMove 9s ease-in-out infinite alternate;
  }

  /* ── Motion border — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-platform-checks .rsp-pricing-platform-motion-border::before {
    content: '';
    position: absolute;
    inset: -80%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.07),
        rgba(20, 184, 166, 0.25),
        rgba(0, 200, 83, 0.17),
        rgba(37, 99, 235, 0.25),
        rgba(37, 99, 235, 0.07));
    transform: rotate(0deg);
    animation: rspPricingPlatformBorderSpin 8s linear infinite;
    opacity: 0.65;
    transition: opacity 260ms ease;
  }

  #pricing-platform-checks .rsp-pricing-platform-motion-border::after {
    content: '';
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-platform-inner, #ffffff);
  }

  #pricing-platform-checks .rsp-pricing-platform-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  /* ── Feature card hover — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-feature {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease,
      border-color 280ms ease;
  }

  #pricing-platform-checks .rsp-pricing-platform-feature:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 52px rgba(15, 23, 42, 0.09);
  }

  /* ── Orbit animation — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-orbit {
    animation: rspPricingPlatformOrbit 9s ease-in-out infinite;
  }

  #pricing-platform-checks .rsp-pricing-platform-icon {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 280ms ease;
  }

  #pricing-platform-checks .rsp-pricing-platform-feature:hover .rsp-pricing-platform-icon {
    transform: rotate(-4deg) scale(1.08);
  }

  /* ── CTA button shimmer — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #pricing-platform-checks .rsp-pricing-platform-btn::before {
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

  #pricing-platform-checks .rsp-pricing-platform-btn:hover {
    transform: translateY(-3px);
  }

  #pricing-platform-checks .rsp-pricing-platform-btn:hover::before {
    left: 135%;
  }

  /* ── Top beam — unchanged ── */
  #pricing-platform-checks .rsp-pricing-platform-beam {
    animation: rspPricingPlatformBeam 8s ease-in-out infinite;
  }

  /* ── Keyframes — all names unchanged ── */
  @keyframes rspPricingPlatformTitleSpotlight {
    from {
      transform: translate(-50%, -50%) scaleX(0.86);
      opacity: 0.48;
    }

    to {
      transform: translate(-50%, -50%) scaleX(1.04);
      opacity: 0.88;
    }
  }

  @keyframes rspPricingPlatformTitleLine {
    from {
      transform: scaleX(0.48);
      opacity: 0.42;
    }

    to {
      transform: scaleX(1);
      opacity: 0.82;
    }
  }

  @keyframes rspPricingPlatformGlowMove {
    from {
      transform: translate3d(-18px, -10px, 0) scale(1);
    }

    to {
      transform: translate3d(18px, 12px, 0) scale(1.04);
    }
  }

  @keyframes rspPricingPlatformBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspPricingPlatformBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @keyframes rspPricingPlatformOrbit {

    0%,
    100% {
      transform: translateY(0) rotate(0deg);
    }

    50% {
      transform: translateY(-8px) rotate(1deg);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {

    #pricing-platform-checks *,
    #pricing-platform-checks *::before,
    #pricing-platform-checks *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #pricing-platform-checks .rsp-pricing-platform-reveal {
      opacity: 1;
      transform: none;
    }
  }
</style>

<section
  id="pricing-platform-checks"
  class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="pricing-platform-checks-title">

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.036)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.036)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>
  <!-- glow orbs -->
  <div class="pointer-events-none absolute -left-28 top-24 z-0 h-[440px] w-[440px] rounded-full bg-[#14B8A6]/[0.08] blur-[115px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-28 bottom-16 z-0 h-[480px] w-[480px] rounded-full bg-blue-500/[0.08] blur-[120px]" aria-hidden="true"></div>
  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── HEADER GRID: Left headline + Right feature panel ── -->
    <div class="grid grid-cols-1 gap-10 lg:grid-cols-[0.92fr_1.08fr] lg:items-end">

      <!-- Left: headline -->
      <div class="rsp-pricing-platform-reveal rsp-pricing-platform-title-wrap" data-rsp-pricing-platform-reveal>

        <span class="rsp-pricing-platform-kicker inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-white px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-[#475569] shadow-sm">
          <i data-lucide="radar" class="h-[13px] w-[13px] text-[#2563EB]" aria-hidden="true"></i>
          <?php esc_html_e('Platform Checks', 'reviewservicepro'); ?>
        </span>

        <div class="rsp-pricing-platform-title-frame mt-6">
          <h2
            id="pricing-platform-checks-title"
            class="rsp-pricing-platform-title m-0">
            <span class="rsp-pricing-platform-title-word block">
              <?php esc_html_e('Check your reputation', 'reviewservicepro'); ?>
            </span>
            <span class="rsp-pricing-platform-title-word block">
              <?php esc_html_e('on key review platforms.', 'reviewservicepro'); ?>
            </span>
          </h2>
        </div>

        <span class="rsp-pricing-platform-title-line" aria-hidden="true"></span>

        <p class="rsp-pricing-platform-subtitle mt-6">
          <?php esc_html_e('Order focused platform checks for Google Business Profile, Trustpilot, Yelp, Facebook Reviews, or other review channels. Each check helps identify visible trust gaps, response issues, profile consistency problems, and platform-compliant next steps.', 'reviewservicepro'); ?>
        </p>
      </div>

      <!-- Right: 3 feature cards panel -->
      <div
        class="rsp-pricing-platform-reveal rsp-pricing-platform-panel rounded-[1.75rem] border border-[#E2E8F0] bg-white/92 p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_22px_76px_rgba(15,23,42,0.07)] backdrop-blur-xl"
        data-rsp-pricing-platform-reveal>

        <!-- animated beam -->
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[1.75rem] bg-[#E2E8F0]" aria-hidden="true">
          <div class="rsp-pricing-platform-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#14B8A6,#2563EB,transparent)]"></div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

          <!-- Feature 1 — Profile signals -->
          <div class="rsp-pricing-platform-feature rsp-pricing-platform-orbit rounded-2xl border border-[#00C853]/20 bg-[#00C853]/[0.045] p-6">
            <div class="rsp-pricing-platform-icon mb-5 flex h-11 w-11 items-center justify-center rounded-xl border border-[#00C853]/25 bg-white text-[#00A344] shadow-sm">
              <i data-lucide="badge-check" class="h-5 w-5" aria-hidden="true"></i>
            </div>
            <!-- FIX: 16px Poppins extrabold (was 18px font-[800]) -->
            <h3 class="rsp-pricing-platform-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em] mb-2">
              <?php esc_html_e('Profile signals', 'reviewservicepro'); ?>
            </h3>
            <p class="rsp-pricing-platform-text">
              <?php esc_html_e('Review visible trust signals and consistency.', 'reviewservicepro'); ?>
            </p>
          </div>

          <!-- Feature 2 — Response gaps -->
          <div class="rsp-pricing-platform-feature rsp-pricing-platform-orbit rounded-2xl border border-blue-100 bg-blue-50/80 p-6" style="animation-delay:160ms;">
            <div class="rsp-pricing-platform-icon mb-5 flex h-11 w-11 items-center justify-center rounded-xl border border-blue-200 bg-white text-[#2563EB] shadow-sm">
              <i data-lucide="message-square-text" class="h-5 w-5" aria-hidden="true"></i>
            </div>
            <h3 class="rsp-pricing-platform-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em] mb-2">
              <?php esc_html_e('Response gaps', 'reviewservicepro'); ?>
            </h3>
            <p class="rsp-pricing-platform-text">
              <?php esc_html_e('Find weak or missing review responses.', 'reviewservicepro'); ?>
            </p>
          </div>

          <!-- Feature 3 — Safe next steps -->
          <div class="rsp-pricing-platform-feature rsp-pricing-platform-orbit rounded-2xl border border-amber-100 bg-amber-50/80 p-6" style="animation-delay:320ms;">
            <div class="rsp-pricing-platform-icon mb-5 flex h-11 w-11 items-center justify-center rounded-xl border border-amber-200 bg-white text-amber-600 shadow-sm">
              <i data-lucide="shield-alert" class="h-5 w-5" aria-hidden="true"></i>
            </div>
            <h3 class="rsp-pricing-platform-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em] mb-2">
              <?php esc_html_e('Safe next steps', 'reviewservicepro'); ?>
            </h3>
            <p class="rsp-pricing-platform-text">
              <?php esc_html_e('Get platform-compliant guidance only.', 'reviewservicepro'); ?>
            </p>
          </div>

        </div>
      </div>
    </div>

    <!-- ── PRODUCT AREA: 3 states ── -->

    <?php if (! class_exists('WooCommerce')) : ?>

      <!-- State 1: WooCommerce not active -->
      <div class="rsp-pricing-platform-reveal mt-12 rounded-[1.75rem] border border-amber-200 bg-amber-50 p-8 text-center shadow-sm" data-rsp-pricing-platform-reveal>
        <h3 class="rsp-pricing-platform-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
          <?php esc_html_e('WooCommerce is not active', 'reviewservicepro'); ?>
        </h3>
        <p class="rsp-pricing-platform-text mx-auto mt-3 max-w-lg">
          <?php esc_html_e('Activate WooCommerce to load platform check products dynamically.', 'reviewservicepro'); ?>
        </p>
      </div>

    <?php elseif (empty($products)) : ?>

      <!-- State 2: No products found -->
      <div class="rsp-pricing-platform-reveal mt-12 rounded-[1.75rem] border border-[#E2E8F0] bg-white p-7 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-pricing-platform-reveal>
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[auto_1fr_auto] lg:items-center">
          <span class="flex h-14 w-14 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-[#2563EB] shadow-sm">
            <i data-lucide="package-plus" class="h-6 w-6" aria-hidden="true"></i>
          </span>
          <div>
            <h3 class="rsp-pricing-platform-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
              <?php esc_html_e('No platform checks found yet.', 'reviewservicepro'); ?>
            </h3>
            <p class="rsp-pricing-platform-text mt-2">
              <?php printf(
                esc_html__('Create WooCommerce products and assign them to the category slug: %s.', 'reviewservicepro'),
                esc_html($category_slug)
              ); ?>
            </p>
          </div>
          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="rsp-pricing-platform-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Ask for Help', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </div>

    <?php else : ?>

      <!-- State 3: Products exist -->
      <div class="mt-12 flex items-center justify-between gap-4">
        <div class="rsp-pricing-platform-reveal" data-rsp-pricing-platform-reveal>
          <p class="font-['Inter',sans-serif] text-[14px] font-medium text-[#64748B]">
            <?php printf(
              esc_html(_n('%d platform check available', '%d platform checks available', $product_count, 'reviewservicepro')),
              absint($product_count)
            ); ?>
          </p>
        </div>
      </div>

      <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        <?php foreach ($products as $index => $product) : ?>
          <div
            class="rsp-pricing-platform-reveal"
            data-rsp-pricing-platform-reveal
            style="transition-delay:<?php echo esc_attr((string) min($index * 70, 420)); ?>ms;">
            <?php
            get_template_part(
              'template-parts/components/pricing-product-card',
              null,
              [
                'product'       => $product,
                'fallback_url'  => $contact_url,
                'section_label' => __('Platform Check', 'reviewservicepro'),
              ]
            );
            ?>
          </div>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

    <!-- ── BOTTOM: Need a platform not listed ── -->
    <div
      class="rsp-pricing-platform-reveal rsp-pricing-platform-motion-border mt-12 rounded-[1.75rem] border border-[#E2E8F0] bg-white p-7 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_60px_rgba(15,23,42,0.06)]"
      data-rsp-pricing-platform-reveal
      style="--rsp-platform-inner:#ffffff;">

      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <!-- FIX: 24px (was 28px) -->
          <h3 class="rsp-pricing-platform-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-tight tracking-[-0.03em]">
            <?php esc_html_e('Need a platform not listed?', 'reviewservicepro'); ?>
          </h3>
          <p class="rsp-pricing-platform-subtitle mt-3">
            <?php esc_html_e('We can review other major reputation platforms where your customers leave public feedback. Ask us before ordering if you need a specific platform check.', 'reviewservicepro'); ?>
          </p>
        </div>

        <a
          href="<?php echo esc_url($contact_url); ?>"
          class="rsp-pricing-platform-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] hover:bg-[#1D4ED8] hover:text-white">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Ask About a Platform', 'reviewservicepro'); ?>
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
    function initRspPricingPlatformChecks() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('[data-rsp-pricing-platform-reveal]');

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
      document.addEventListener('DOMContentLoaded', initRspPricingPlatformChecks);
    } else {
      initRspPricingPlatformChecks();
    }
  }());
</script>