<?php

/**
 * Services Page Trust Bar / Trust Proof Section
 *
 * File: template-parts/sections/services/trust-bar.php
 *
 * ReviewService.Pro — AI-Driven ORM Trust Proof Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$stats = [
  [
    'icon'   => 'monitor',
    'label'  => __('Platforms', 'reviewservicepro'),
    'value'  => 20,
    'suffix' => '+',
    'desc'   => __('Review platforms supported', 'reviewservicepro'),
    'type'   => 'normal',
  ],
  [
    'icon'   => 'layers',
    'label'  => __('Plan Tiers', 'reviewservicepro'),
    'value'  => 3,
    'suffix' => '',
    'desc'   => __('Monthly ORM plan levels', 'reviewservicepro'),
    'type'   => 'featured',
  ],
  [
    'icon'   => 'package-check',
    'label'  => __('Packages', 'reviewservicepro'),
    'value'  => 4,
    'suffix' => '',
    'desc'   => __('One-time starter packages', 'reviewservicepro'),
    'type'   => 'normal',
  ],
];

$features = [
  [
    'title'     => __('Ethical ORM Only', 'reviewservicepro'),
    'text'      => __('No fake reviews, no paid review incentives, no rating manipulation — just responsible online reputation management.', 'reviewservicepro'),
    'tone'      => 'emerald',
    'short'     => 'ORM',
    'image'     => 'assets/images/services/trust-bar/ethical-orm-only.webp',
    'image_alt' => __('Ethical online reputation management support visual', 'reviewservicepro'),
  ],
  [
    'title'     => __('Platform-Compliant Methods', 'reviewservicepro'),
    'text'      => __('We focus on review monitoring, response strategy, documentation, safe reporting direction, and transparent workflows.', 'reviewservicepro'),
    'tone'      => 'blue',
    'short'     => 'SAFE',
    'image'     => 'assets/images/services/trust-bar/platform-compliant-methods.webp',
    'image_alt' => __('Platform compliant reputation management methods visual', 'reviewservicepro'),
  ],
  [
    'title'     => __('Multi-Platform Monitoring', 'reviewservicepro'),
    'text'      => __('Google Business Profile, Facebook, Trustpilot, Yelp, Tripadvisor, BBB, G2, Capterra, and other relevant platforms.', 'reviewservicepro'),
    'tone'      => 'amber',
    'short'     => '360',
    'image'     => 'assets/images/services/trust-bar/multi-platform-monitoring.webp',
    'image_alt' => __('Multi platform review monitoring dashboard visual', 'reviewservicepro'),
  ],
  [
    'title'     => __('Monthly Reporting', 'reviewservicepro'),
    'text'      => __('Clients receive clear reputation progress, review response work, risk notes, and recommended next actions.', 'reviewservicepro'),
    'tone'      => 'coral',
    'short'     => 'RPT',
    'image'     => 'assets/images/services/trust-bar/monthly-reporting.webp',
    'image_alt' => __('Monthly reputation management reporting visual', 'reviewservicepro'),
  ],
  [
    'title'     => __('Secure Client Portal', 'reviewservicepro'),
    'text'      => __('After payment, clients can access service details, reports, support direction, orders, invoices, and account details.', 'reviewservicepro'),
    'tone'      => 'purple',
    'short'     => 'PORTAL',
    'image'     => 'assets/images/services/trust-bar/secure-client-portal.webp',
    'image_alt' => __('Secure client portal for reputation management services visual', 'reviewservicepro'),
  ],
];

$tone_classes = [
  'emerald' => [
    'border'     => 'border-emerald-300',
    'line'       => 'from-[#00C853] via-emerald-400 to-transparent',
    'image_wrap' => 'border-emerald-100 bg-emerald-50',
    'fallback'   => 'from-emerald-50 via-white to-emerald-100 text-emerald-700',
  ],
  'blue' => [
    'border'     => 'border-blue-300',
    'line'       => 'from-blue-600 via-blue-400 to-transparent',
    'image_wrap' => 'border-blue-100 bg-blue-50',
    'fallback'   => 'from-blue-50 via-white to-blue-100 text-blue-700',
  ],
  'amber' => [
    'border'     => 'border-amber-300',
    'line'       => 'from-amber-500 via-amber-400 to-transparent',
    'image_wrap' => 'border-amber-100 bg-amber-50',
    'fallback'   => 'from-amber-50 via-white to-amber-100 text-amber-700',
  ],
  'coral' => [
    'border'     => 'border-orange-300',
    'line'       => 'from-orange-500 via-orange-400 to-transparent',
    'image_wrap' => 'border-orange-100 bg-orange-50',
    'fallback'   => 'from-orange-50 via-white to-orange-100 text-orange-700',
  ],
  'purple' => [
    'border'     => 'border-violet-300',
    'line'       => 'from-violet-500 via-violet-400 to-transparent',
    'image_wrap' => 'border-violet-100 bg-violet-50',
    'fallback'   => 'from-violet-50 via-white to-violet-100 text-violet-700',
  ],
];

$trust_points = [
  __('No fake reviews', 'reviewservicepro'),
  __('No rating manipulation', 'reviewservicepro'),
  __('Platform-compliant workflow', 'reviewservicepro'),
];

$primary_cta_url   = '#monthly-plans';
$secondary_cta_url = home_url('/contact/');
?>

<style>
  #services-trust-bar {
    --rsp-services-trust-title: #334155;
    --rsp-services-trust-heading: #3B4658;
    --rsp-services-trust-body: #64748B;
    --rsp-services-trust-blue: #2563EB;
    --rsp-services-trust-green: #00C853;
    --rsp-services-trust-border: rgba(148, 163, 184, 0.26);
  }

  #services-trust-bar .rsp-trust-eyebrow {
    font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
  }

  #services-trust-bar .rsp-trust-title {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: clamp(34px, 4.4vw, 54px);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.055em;
    color: var(--rsp-services-trust-title);
  }

  #services-trust-bar .rsp-trust-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-services-trust-heading);
  }

  #services-trust-bar .rsp-trust-text {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.78;
    color: var(--rsp-services-trust-body);
  }

  #services-trust-bar .rsp-trust-reveal {
    opacity: 0;
    transform: translateY(28px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
      box-shadow 320ms ease,
      border-color 320ms ease;
  }

  #services-trust-bar .rsp-trust-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  #services-trust-bar .rsp-trust-delay-1 {
    transition-delay: 90ms;
  }

  #services-trust-bar .rsp-trust-delay-2 {
    transition-delay: 180ms;
  }

  #services-trust-bar .rsp-trust-delay-3 {
    transition-delay: 270ms;
  }

  #services-trust-bar .rsp-trust-delay-4 {
    transition-delay: 360ms;
  }

  #services-trust-bar .rsp-trust-motion-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 360ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #services-trust-bar .rsp-trust-motion-card::before {
    content: "";
    position: absolute;
    inset: -80%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.08),
        rgba(0, 200, 83, 0.28),
        rgba(20, 184, 166, 0.20),
        rgba(139, 92, 246, 0.22),
        rgba(37, 99, 235, 0.08));
    opacity: 0.78;
    transform: rotate(0deg);
    animation: rspServicesTrustBorderSpin 8s linear infinite;
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  #services-trust-bar .rsp-trust-motion-card::after {
    content: "";
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-trust-card-bg, #ffffff);
    pointer-events: none;
  }

  #services-trust-bar .rsp-trust-motion-card:hover {
    transform: translateY(-8px);
    border-color: rgba(37, 99, 235, 0.22);
    box-shadow: 0 26px 80px rgba(15, 23, 42, 0.12);
  }

  #services-trust-bar .rsp-trust-motion-card:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  #services-trust-bar .rsp-trust-stat-card {
    transition:
      transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 340ms ease,
      border-color 280ms ease;
  }

  #services-trust-bar .rsp-trust-stat-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 24px 72px rgba(15, 23, 42, 0.12);
  }

  #services-trust-bar .rsp-trust-stat-icon {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 280ms ease;
  }

  #services-trust-bar .rsp-trust-stat-card:hover .rsp-trust-stat-icon {
    transform: rotate(-4deg) scale(1.08);
    box-shadow: 0 16px 38px rgba(37, 99, 235, 0.12);
  }

  /* FIXED: feature images now fill the full top image area */
  #services-trust-bar .rsp-trust-feature-image {
    width: 100%;
    height: 108px;
    min-height: 108px;
    border-radius: 1.15rem;
    transition:
      transform 520ms cubic-bezier(0.2, 0.9, 0.2, 1),
      filter 320ms ease,
      box-shadow 320ms ease;
  }

  #services-trust-bar .rsp-trust-feature-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #services-trust-bar .rsp-trust-feature-card:hover .rsp-trust-feature-image {
    transform: translateY(-3px) scale(1.015);
    filter: saturate(1.06);
    box-shadow: 0 18px 42px rgba(15, 23, 42, 0.10);
  }

  #services-trust-bar .rsp-trust-feature-card:hover .rsp-trust-feature-image img {
    transform: scale(1.08);
  }

  #services-trust-bar .rsp-trust-feature-fallback {
    display: flex;
    height: 100%;
    width: 100%;
    align-items: center;
    justify-content: center;
  }

  #services-trust-bar .rsp-trust-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #services-trust-bar .rsp-trust-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -120%;
    z-index: 0;
    width: 70%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
    transform: skewX(-18deg);
    transition: left 720ms ease;
    pointer-events: none;
  }

  #services-trust-bar .rsp-trust-btn:hover {
    transform: translateY(-3px);
  }

  #services-trust-bar .rsp-trust-btn:hover::before {
    left: 135%;
  }

  @keyframes rspServicesTrustBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @media (max-width: 1024px) {
    #services-trust-bar .rsp-trust-feature-image {
      height: 140px;
      min-height: 140px;
    }
  }

  @media (max-width: 640px) {
    #services-trust-bar .rsp-trust-feature-image {
      height: 160px;
      min-height: 160px;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #services-trust-bar *,
    #services-trust-bar *::before,
    #services-trust-bar *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      scroll-behavior: auto !important;
      transition-duration: 0.001ms !important;
    }

    #services-trust-bar .rsp-trust-reveal {
      opacity: 1;
      transform: none;
    }

    #services-trust-bar .rsp-trust-motion-card:hover,
    #services-trust-bar .rsp-trust-stat-card:hover,
    #services-trust-bar .rsp-trust-btn:hover,
    #services-trust-bar .rsp-trust-feature-card:hover .rsp-trust-feature-image,
    #services-trust-bar .rsp-trust-stat-card:hover .rsp-trust-stat-icon {
      transform: none;
    }

    #services-trust-bar .rsp-trust-feature-card:hover .rsp-trust-feature-image img {
      transform: none;
    }
  }
</style>

<section
  id="services-trust-bar"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F0FDF7]"
  aria-labelledby="services-trust-title"
  data-gsap="services-trust-bar">

  <!-- Background System -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle,rgba(29,158,117,0.18)_1px,transparent_1px)] bg-[size:28px_28px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-28 -top-28 z-0 h-[420px] w-[420px] rounded-full bg-emerald-400/15 blur-[90px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -bottom-24 -right-24 z-0 h-[360px] w-[360px] rounded-full bg-blue-400/10 blur-[90px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute right-[10%] top-[42%] z-0 h-[260px] w-[260px] rounded-full bg-violet-400/10 blur-[90px]" aria-hidden="true"></div>

  <div class="relative z-10">

    <!-- Stats Section -->
    <div class="mx-auto max-w-7xl px-4 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24">

      <div class="mb-12 text-center">
        <span class="rsp-trust-eyebrow inline-flex items-center gap-2 rounded-full border border-emerald-600/20 bg-emerald-600/10 px-4 py-2 text-emerald-800 shadow-sm">
          <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Trusted AI-Driven Reputation Management', 'reviewservicepro'); ?>
        </span>
      </div>

      <div class="mx-auto grid max-w-4xl grid-cols-1 gap-5 md:grid-cols-3">
        <?php foreach ($stats as $index => $stat) : ?>
          <?php $is_featured = 'featured' === $stat['type']; ?>

          <article
            class="rsp-trust-stat-card rsp-trust-reveal <?php echo esc_attr('rsp-trust-delay-' . min($index, 4)); ?> relative overflow-hidden rounded-[1.75rem] border px-8 py-9 text-center <?php echo $is_featured ? 'border-emerald-700 bg-gradient-to-br from-[#065F46] to-[#008E61] text-white shadow-[0_24px_70px_rgba(6,95,70,0.22)]' : 'border-slate-200 bg-white text-[#334155] shadow-[0_18px_52px_rgba(15,23,42,0.08)]'; ?>"
            data-rsp-trust-reveal>

            <div class="relative z-10">
              <div class="rsp-trust-stat-icon mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl <?php echo $is_featured ? 'bg-white/16 text-white' : 'bg-emerald-50 text-emerald-700'; ?>">
                <i data-lucide="<?php echo esc_attr($stat['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
              </div>

              <p class="font-['DM_Mono',monospace] text-[12px] font-bold uppercase tracking-[0.16em] <?php echo $is_featured ? 'text-emerald-100' : 'text-emerald-700/60'; ?>">
                <?php echo esc_html($stat['label']); ?>
              </p>

              <p class="mt-3 font-['Poppins',sans-serif] text-[56px] font-[800] leading-none tracking-[-0.06em] <?php echo $is_featured ? 'text-white' : 'text-emerald-700'; ?>">
                <span class="rsp-trust-count" data-target="<?php echo esc_attr($stat['value']); ?>">0</span><?php echo esc_html($stat['suffix']); ?>
              </p>

              <p class="mt-5 font-['Inter',sans-serif] text-[16px] font-[700] leading-7 <?php echo $is_featured ? 'text-white' : 'text-[#64748B]'; ?>">
                <?php echo esc_html($stat['desc']); ?>
              </p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Feature Cards Section -->
    <div class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-24">
      <div class="mx-auto mb-12 max-w-3xl text-center">
        <h2
          id="services-trust-title"
          class="rsp-trust-title">
          <?php esc_html_e('Everything you need to protect', 'reviewservicepro'); ?>
          <span class="block"><?php esc_html_e('your online reputation', 'reviewservicepro'); ?></span>
        </h2>

        <p class="rsp-trust-text mx-auto mt-5 max-w-2xl">
          <?php esc_html_e('AI-assisted review monitoring, ethical response workflows, transparent reporting, and platform-compliant online reputation management across important review sites.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="mx-auto grid max-w-6xl grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">
        <?php foreach ($features as $index => $feature) : ?>
          <?php
          $tone = isset($tone_classes[$feature['tone']]) ? $tone_classes[$feature['tone']] : $tone_classes['emerald'];

          $image_path = get_theme_file_path($feature['image']);
          $image_url  = get_theme_file_uri($feature['image']);
          $has_image  = file_exists($image_path);
          ?>

          <article
            class="rsp-trust-feature-card rsp-trust-motion-card rsp-trust-reveal <?php echo esc_attr('rsp-trust-delay-' . min($index, 4)); ?> rounded-[1.6rem] border <?php echo esc_attr($tone['border']); ?> bg-white p-4 shadow-[0_16px_48px_rgba(15,23,42,0.08)]"
            data-rsp-trust-reveal
            style="--rsp-trust-card-bg:#ffffff;">

            <div class="absolute inset-x-0 top-0 h-[3px] rounded-t-[1.6rem] bg-gradient-to-r <?php echo esc_attr($tone['line']); ?>" aria-hidden="true"></div>

            <div class="relative z-10">
              <div class="rsp-trust-feature-image mb-5 overflow-hidden border <?php echo esc_attr($tone['image_wrap']); ?>">
                <?php if ($has_image) : ?>
                  <img
                    src="<?php echo esc_url($image_url); ?>"
                    alt="<?php echo esc_attr($feature['image_alt']); ?>"
                    loading="lazy"
                    decoding="async"
                    width="420"
                    height="260">
                <?php else : ?>
                  <span class="rsp-trust-feature-fallback bg-gradient-to-br <?php echo esc_attr($tone['fallback']); ?> font-['DM_Mono',monospace] text-[13px] font-[800] uppercase tracking-[0.12em]">
                    <?php echo esc_html($feature['short']); ?>
                  </span>
                <?php endif; ?>
              </div>

              <h3 class="rsp-trust-heading text-[20px] font-[800] leading-[1.18] tracking-[-0.035em]">
                <?php echo esc_html($feature['title']); ?>
              </h3>

              <p class="mt-4 font-['Inter',sans-serif] text-[16px] font-[500] leading-8 text-[#64748B]">
                <?php echo esc_html($feature['text']); ?>
              </p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="mx-auto mt-12 flex max-w-4xl flex-col items-center justify-center gap-4 rounded-[1.5rem] border border-emerald-200 bg-white/80 p-5 text-center shadow-[0_16px_50px_rgba(15,23,42,0.06)] backdrop-blur-xl md:flex-row md:justify-between md:text-left">
        <div>
          <p class="font-['Poppins',sans-serif] text-[20px] font-[800] tracking-[-0.035em] text-[#3B4658]">
            <?php esc_html_e('Ready to choose the right monthly reputation management plan?', 'reviewservicepro'); ?>
          </p>

          <div class="mt-3 flex flex-wrap gap-2">
            <?php foreach ($trust_points as $point) : ?>
              <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 font-['Inter',sans-serif] text-[13px] font-[700] text-emerald-700">
                <i data-lucide="check-circle-2" class="h-4 w-4" aria-hidden="true"></i>
                <?php echo esc_html($point); ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($primary_cta_url); ?>"
            class="rsp-trust-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,.24)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('View Plans', 'reviewservicepro'); ?>
              <i data-lucide="arrow-down" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>

          <a
            href="<?php echo esc_url($secondary_cta_url); ?>"
            class="rsp-trust-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Talk to Us', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function animateTrustCount(element, target) {
      var start = 0;
      var duration = 1200;
      var startTime = null;

      function step(timestamp) {
        if (!startTime) {
          startTime = timestamp;
        }

        var progress = Math.min((timestamp - startTime) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        var current = Math.floor(start + (target - start) * eased);

        element.textContent = current;

        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          element.textContent = target;
        }
      }

      window.requestAnimationFrame(step);
    }

    function initServicesTrustBar() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var section = document.getElementById('services-trust-bar');

      if (!section) {
        return;
      }

      var revealItems = section.querySelectorAll('[data-rsp-trust-reveal]');
      var counters = section.querySelectorAll('.rsp-trust-count');

      function reveal(item) {
        if (!item || item.dataset.rspTrustVisible === 'true') {
          return;
        }

        item.dataset.rspTrustVisible = 'true';
        item.classList.add('rsp-visible');
      }

      function runCounter(counter) {
        if (!counter || counter.dataset.rspCounterDone === 'true') {
          return;
        }

        var target = parseInt(counter.getAttribute('data-target'), 10);

        if (isNaN(target)) {
          return;
        }

        counter.dataset.rspCounterDone = 'true';
        animateTrustCount(counter, target);
      }

      if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              reveal(entry.target);
              revealObserver.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        revealItems.forEach(function(item) {
          revealObserver.observe(item);
        });

        var counterObserver = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              runCounter(entry.target);
              counterObserver.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.35
        });

        counters.forEach(function(counter) {
          counterObserver.observe(counter);
        });

        return;
      }

      revealItems.forEach(reveal);
      counters.forEach(runCounter);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initServicesTrustBar);
    } else {
      initServicesTrustBar();
    }
  })();
</script>