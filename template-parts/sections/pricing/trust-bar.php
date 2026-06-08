<?php

/**
 * Pricing Trust / Compliance Bar
 *
 * File: template-parts/sections/pricing/trust-bar.php
 *
 * Fixes applied (functions/options/font names unchanged):
 * 1. Typography scale — Poppins headings, Inter body, DM Mono labels
 * 2. Card text size — 16px body (was inconsistent)
 * 3. Card padding — p-5 → p-6 for more breathing room
 * 4. Compliance text — max-width + line-height for readability
 * 5. Card icon size — h-12 w-12 → slightly refined border-radius
 * 6. H3 card heading — size/tracking refined
 * 7. Mini conversion note — layout tightened
 * 8. All animations, keyframes, reveal system, JS — unchanged
 * 9. All $trust_items, $tone_classes, $compliance_note — unchanged
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$context = isset($args) && is_array($args) ? $args : [];

$compliance_note = ! empty($context['compliance_note'])
  ? $context['compliance_note']
  : __(
    'ReviewService.Pro provides ethical online reputation management services. We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on review monitoring, professional response support, documentation, genuine feedback workflows, platform-compliant reporting, and transparent reputation improvement.',
    'reviewservicepro'
  );

$trust_items = [
  [
    'label' => __('No Fake Reviews', 'reviewservicepro'),
    'text'  => __('We do not sell, create, or support fake customer reviews.', 'reviewservicepro'),
    'icon'  => 'ban',
    'tone'  => 'green',
  ],
  [
    'label' => __('No Guaranteed Removal', 'reviewservicepro'),
    'text'  => __('We help document, respond, and report eligible issues safely — platform decisions are not guaranteed.', 'reviewservicepro'),
    'icon'  => 'shield-alert',
    'tone'  => 'amber',
  ],
  [
    'label' => __('Platform-Compliant', 'reviewservicepro'),
    'text'  => __('Our work focuses on monitoring, documentation, response quality, and ethical feedback workflows.', 'reviewservicepro'),
    'icon'  => 'badge-check',
    'tone'  => 'blue',
  ],
  [
    'label' => __('Secure Checkout', 'reviewservicepro'),
    'text'  => __('Order reputation services safely through WooCommerce checkout.', 'reviewservicepro'),
    'icon'  => 'credit-card',
    'tone'  => 'blue',
  ],
  [
    'label' => __('Client Portal Access', 'reviewservicepro'),
    'text'  => __('After payment, onboarding, support, order details, and reports continue inside your client portal.', 'reviewservicepro'),
    'icon'  => 'layout-dashboard',
    'tone'  => 'green',
  ],
];

$tone_classes = [
  'green' => [
    'card'  => 'border-[#00C853]/20 bg-[#00C853]/[0.045]',
    'icon'  => 'border-[#00C853]/25 bg-[#00C853]/10 text-[#00A344]',
    'inner' => '#F0FDF4',
  ],
  'blue' => [
    'card'  => 'border-blue-200 bg-blue-50/60',
    'icon'  => 'border-blue-200 bg-blue-50 text-blue-600',
    'inner' => '#EFF6FF',
  ],
  'amber' => [
    'card'  => 'border-amber-200 bg-amber-50/70',
    'icon'  => 'border-amber-200 bg-amber-50 text-amber-600',
    'inner' => '#FFFBEB',
  ],
];
?>

<style>
  /* ── Design tokens — unchanged variable names ── */
  #pricing-trust-bar {
    --rsp-trust-title: #0F172A;
    --rsp-trust-heading: #1E293B;
    --rsp-trust-subtitle: #475569;
    --rsp-trust-text: #475569;
    --rsp-trust-blue: #2563EB;
    --rsp-trust-green: #00C853;
    --rsp-trust-teal: #14B8A6;
  }

  /* ── Typography — Poppins/Inter/DM Mono preserved ── */
  #pricing-trust-bar .rsp-pricing-trust-text {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-trust-text);
  }

  #pricing-trust-bar .rsp-pricing-trust-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.78;
    color: var(--rsp-trust-subtitle);
    max-width: 680px;
    /* FIX: prose max-width for readability */
  }

  #pricing-trust-bar .rsp-pricing-trust-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 3.2vw, 42px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.042em;
    color: var(--rsp-trust-title);
  }

  #pricing-trust-bar .rsp-pricing-trust-heading {
    color: var(--rsp-trust-heading);
  }

  /* ── Reveal system — unchanged ── */
  #pricing-trust-bar .rsp-pricing-trust-reveal {
    opacity: 0;
    transform: translateY(20px);
    transition:
      opacity 700ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 700ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #pricing-trust-bar .rsp-pricing-trust-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Title frame decorations — unchanged ── */
  #pricing-trust-bar .rsp-pricing-trust-title-wrap {
    position: relative;
    isolation: isolate;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-wrap::before {
    content: '';
    position: absolute;
    left: 38%;
    top: 58%;
    z-index: -2;
    width: min(520px, 92vw);
    height: 150px;
    border-radius: 999px;
    background:
      radial-gradient(circle at 16% 42%, rgba(37, 99, 235, 0.10), transparent 34%),
      radial-gradient(circle at 82% 50%, rgba(0, 200, 83, 0.10), transparent 34%),
      rgba(255, 255, 255, 0.64);
    transform: translate(-50%, -50%) scaleX(0.88);
    filter: blur(2px);
    opacity: 0.80;
    animation: rspPricingTrustTitleSpotlight 5.4s ease-in-out infinite alternate;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-frame {
    position: relative;
    display: inline-block;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-frame::before,
  #pricing-trust-bar .rsp-pricing-trust-title-frame::after {
    content: '';
    position: absolute;
    width: 46px;
    height: 46px;
    pointer-events: none;
    opacity: 0.36;
    transition:
      opacity 320ms ease,
      transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #pricing-trust-bar .rsp-pricing-trust-title-frame::before {
    left: -16px;
    top: -12px;
    border-left: 1px solid rgba(51, 65, 85, 0.18);
    border-top: 1px solid rgba(51, 65, 85, 0.18);
    border-top-left-radius: 16px;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-frame::after {
    right: -16px;
    bottom: -12px;
    border-right: 1px solid rgba(51, 65, 85, 0.18);
    border-bottom: 1px solid rgba(51, 65, 85, 0.18);
    border-bottom-right-radius: 16px;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-wrap:hover .rsp-pricing-trust-title-frame::before {
    opacity: 0.68;
    transform: translate(-4px, -4px);
  }

  #pricing-trust-bar .rsp-pricing-trust-title-wrap:hover .rsp-pricing-trust-title-frame::after {
    opacity: 0.68;
    transform: translate(4px, 4px);
  }

  #pricing-trust-bar .rsp-pricing-trust-title-word {
    display: inline-block;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      letter-spacing 360ms ease;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-wrap:hover .rsp-pricing-trust-title-word {
    transform: translateY(-2px);
    letter-spacing: -0.048em;
  }

  #pricing-trust-bar .rsp-pricing-trust-title-line {
    display: block;
    height: 2.5px;
    width: min(320px, 78vw);
    margin-top: 18px;
    border-radius: 999px;
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.45), rgba(0, 200, 83, 0.2), transparent);
    transform-origin: left;
    animation: rspPricingTrustTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
  }

  /* ── Kicker badge glow ── */
  #pricing-trust-bar .rsp-pricing-trust-kicker {
    position: relative;
    isolation: isolate;
  }

  #pricing-trust-bar .rsp-pricing-trust-kicker::before {
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
  #pricing-trust-bar .rsp-pricing-trust-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-trust-bar .rsp-pricing-trust-motion-border::before {
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
    animation: rspPricingTrustBorderSpin 8s linear infinite;
    opacity: 0.65;
    transition: opacity 260ms ease;
  }

  #pricing-trust-bar .rsp-pricing-trust-motion-border::after {
    content: '';
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-trust-inner, #ffffff);
  }

  #pricing-trust-bar .rsp-pricing-trust-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  /* ── Glow panel — unchanged ── */
  #pricing-trust-bar .rsp-pricing-trust-panel {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  #pricing-trust-bar .rsp-pricing-trust-panel::before {
    content: '';
    position: absolute;
    inset: -110px;
    z-index: -1;
    background:
      radial-gradient(circle at 10% 18%, rgba(37, 99, 235, 0.09), transparent 30%),
      radial-gradient(circle at 90% 74%, rgba(0, 200, 83, 0.09), transparent 32%);
    animation: rspPricingTrustGlowMove 9s ease-in-out infinite alternate;
  }

  /* ── Card hover — unchanged ── */
  #pricing-trust-bar .rsp-pricing-trust-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 340ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #pricing-trust-bar .rsp-pricing-trust-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 58px rgba(15, 23, 42, 0.09);
  }

  #pricing-trust-bar .rsp-pricing-trust-card-icon {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 280ms ease;
  }

  #pricing-trust-bar .rsp-pricing-trust-card:hover .rsp-pricing-trust-card-icon {
    transform: rotate(-4deg) scale(1.08);
    box-shadow: 0 14px 36px rgba(37, 99, 235, 0.09);
  }

  /* ── CTA button shimmer — unchanged ── */
  #pricing-trust-bar .rsp-pricing-trust-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #pricing-trust-bar .rsp-pricing-trust-btn::before {
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

  #pricing-trust-bar .rsp-pricing-trust-btn:hover {
    transform: translateY(-3px);
  }

  #pricing-trust-bar .rsp-pricing-trust-btn:hover::before {
    left: 135%;
  }

  /* ── Top beam — unchanged ── */
  #pricing-trust-bar .rsp-pricing-trust-beam {
    animation: rspPricingTrustBeam 7s ease-in-out infinite;
  }

  /* ── Keyframes — all unchanged ── */
  @keyframes rspPricingTrustTitleSpotlight {
    from {
      transform: translate(-50%, -50%) scaleX(0.86);
      opacity: 0.48;
    }

    to {
      transform: translate(-50%, -50%) scaleX(1.04);
      opacity: 0.88;
    }
  }

  @keyframes rspPricingTrustTitleLine {
    from {
      transform: scaleX(0.48);
      opacity: 0.42;
    }

    to {
      transform: scaleX(1);
      opacity: 0.82;
    }
  }

  @keyframes rspPricingTrustBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspPricingTrustGlowMove {
    from {
      transform: translate3d(-18px, -10px, 0) scale(1);
    }

    to {
      transform: translate3d(18px, 12px, 0) scale(1.04);
    }
  }

  @keyframes rspPricingTrustBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {

    #pricing-trust-bar *,
    #pricing-trust-bar *::before,
    #pricing-trust-bar *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #pricing-trust-bar .rsp-pricing-trust-reveal {
      opacity: 1;
      transform: none;
    }
  }
</style>

<section
  id="pricing-trust-bar"
  class="relative overflow-hidden bg-white px-5 py-12 sm:px-6 lg:px-8 lg:py-16"
  aria-labelledby="pricing-trust-title">

  <!-- grid texture -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.032)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.032)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>
  <!-- glow orbs -->
  <div class="pointer-events-none absolute -left-24 top-4 z-0 h-[360px] w-[360px] rounded-full bg-blue-500/[0.07] blur-[110px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-24 bottom-4 z-0 h-[360px] w-[360px] rounded-full bg-[#00C853]/[0.07] blur-[110px]" aria-hidden="true"></div>
  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── TOP COMPLIANCE STRIP ── -->
    <div
      class="rsp-pricing-trust-reveal rsp-pricing-trust-panel rounded-[1.75rem] border border-[#E2E8F0] bg-white/95 p-7 shadow-[0_1px_3px_rgba(0,0,0,.04),0_20px_70px_rgba(15,23,42,0.07)] backdrop-blur-xl md:p-8"
      data-pricing-trust-reveal>

      <!-- animated top beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[1.75rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-trust-beam h-full w-[60%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.88fr_1.12fr] lg:items-center">

        <!-- Left: headline block -->
        <div class="rsp-pricing-trust-title-wrap">
          <span class="rsp-pricing-trust-kicker inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-white px-4 py-[5px] font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-[#475569] shadow-sm">
            <i data-lucide="shield-check" class="h-[13px] w-[13px] text-[#00A344]" aria-hidden="true"></i>
            <?php esc_html_e('Ethical ORM Promise', 'reviewservicepro'); ?>
          </span>

          <div class="rsp-pricing-trust-title-frame mt-5">
            <h2
              id="pricing-trust-title"
              class="rsp-pricing-trust-title m-0">
              <span class="rsp-pricing-trust-title-word block">
                <?php esc_html_e('Clear, ethical', 'reviewservicepro'); ?>
              </span>
              <span class="rsp-pricing-trust-title-word block">
                <?php esc_html_e('reputation services.', 'reviewservicepro'); ?>
              </span>
            </h2>
          </div>

          <span class="rsp-pricing-trust-title-line" aria-hidden="true"></span>
        </div>

        <!-- Right: compliance text -->
        <p class="rsp-pricing-trust-subtitle">
          <?php echo esc_html($compliance_note); ?>
        </p>
      </div>
    </div>

    <!-- ── TRUST CARDS (5 items) ── -->
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">
      <?php foreach ($trust_items as $index => $item) :
        $tone = isset($tone_classes[$item['tone']]) ? $tone_classes[$item['tone']] : $tone_classes['green'];
      ?>
        <article
          class="rsp-pricing-trust-card rsp-pricing-trust-motion-border rsp-pricing-trust-reveal group rounded-[1.35rem] border <?php echo esc_attr($tone['card']); ?> p-6 shadow-[0_1px_3px_rgba(0,0,0,.04),0_10px_32px_rgba(15,23,42,0.06)]"
          data-pricing-trust-reveal
          style="transition-delay:<?php echo esc_attr((string)($index * 70)); ?>ms;--rsp-trust-inner:<?php echo esc_attr($tone['inner']); ?>;">

          <div class="relative z-10">
            <!-- icon -->
            <div class="rsp-pricing-trust-card-icon mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?>">
              <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <!-- title — FIX: Poppins explicit, size tightened -->
            <h3 class="rsp-pricing-trust-heading font-['Poppins',sans-serif] text-[16px] font-extrabold leading-snug tracking-[-0.02em] mb-2">
              <?php echo esc_html($item['label']); ?>
            </h3>

            <!-- body — FIX: Inter explicit, 15px, 1.72 -->
            <p class="rsp-pricing-trust-text">
              <?php echo esc_html($item['text']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- ── MINI CONVERSION NOTE ── -->
    <div
      class="rsp-pricing-trust-reveal rsp-pricing-trust-motion-border mt-6 rounded-[1.5rem] border border-[#E2E8F0] bg-white p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_12px_40px_rgba(15,23,42,0.06)]"
      data-pricing-trust-reveal
      style="--rsp-trust-inner:#ffffff;">

      <div class="relative z-10 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div class="flex items-start gap-3">
          <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-emerald-200 bg-emerald-50 text-[#00A344]">
            <i data-lucide="info" class="h-5 w-5" aria-hidden="true"></i>
          </span>
          <!-- FIX: Inter font explicit on conversion note -->
          <p class="font-['Inter',sans-serif] text-[15px] font-normal leading-[1.72] text-[#475569]">
            <?php esc_html_e('Focused reputation packages are ideal when you want a clear service before starting ongoing monthly ORM management.', 'reviewservicepro'); ?>
          </p>
        </div>

        <a
          href="#pricing-main-packages"
          class="rsp-pricing-trust-btn inline-flex min-h-[50px] shrink-0 items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-6 py-3 font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155] shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Explore Packages', 'reviewservicepro'); ?>
            <i data-lucide="arrow-down" class="h-4 w-4 text-[#2563EB]" aria-hidden="true"></i>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    /* IntersectionObserver reveal — unchanged logic */
    function initPricingTrustBar() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-pricing-trust-reveal]');
      if (!items.length) return;

      function showItem(item) {
        if (!item || item.dataset.pricingTrustVisible === 'true') return;
        item.dataset.pricingTrustVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initPricingTrustBar);
    } else {
      initPricingTrustBar();
    }
  }());
</script>