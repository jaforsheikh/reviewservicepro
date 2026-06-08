<?php

/**
 * Home Trust Signals Section
 *
 * File: template-parts/sections/home/trust-signals.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$stats = [
  [
    'icon'   => 'building-2',
    'target' => get_theme_mod('trust_stat1_num', '500'),
    'suffix' => '+',
    'label'  => get_theme_mod('trust_stat1_label', __('Businesses helped', 'reviewservicepro')),
  ],
  [
    'icon'   => 'star',
    'target' => get_theme_mod('trust_stat2_num', '12000'),
    'suffix' => '+',
    'label'  => get_theme_mod('trust_stat2_label', __('Reviews monitored', 'reviewservicepro')),
  ],
  [
    'icon'   => 'chart-line',
    'target' => get_theme_mod('trust_stat3_num', '98'),
    'suffix' => '%',
    'label'  => get_theme_mod('trust_stat3_label', __('Client satisfaction', 'reviewservicepro')),
  ],
  [
    'icon'   => 'clock-3',
    'target' => get_theme_mod('trust_stat4_num', '24'),
    'suffix' => 'h',
    'label'  => get_theme_mod('trust_stat4_label', __('Avg. response time', 'reviewservicepro')),
  ],
];

$platforms = [
  'Google Business Profile',
  'Google Maps',
  'Facebook',
  'Trustpilot',
  'Yelp',
  'Tripadvisor',
  'Sitejabber',
  'BBB',
  'G2',
  'Capterra',
  'Glassdoor',
  'Clutch',
  'Houzz',
  'HomeAdvisor',
  'Reviews.io',
  'Yellowpages',
  'Bark',
  'Checkatrade',
  'Trustindex.io',
  'BrightLocal',
];

$certs = [
  [
    'icon' => 'shield-check',
    'text' => __('Platform-compliant methods', 'reviewservicepro'),
  ],
  [
    'icon' => 'eye',
    'text' => __('Transparent reporting', 'reviewservicepro'),
  ],
  [
    'icon' => 'ban',
    'text' => __('Zero fake reviews policy', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock',
    'text' => __('Data privacy protected', 'reviewservicepro'),
  ],
];

$platforms_loop = array_merge($platforms, $platforms);
?>

<section
  id="trust-signals"
  class="relative overflow-hidden bg-white py-20 md:py-28"
  role="region"
  aria-label="<?php echo esc_attr__('Trust signals', 'reviewservicepro'); ?>"
  data-gsap="trust-animate">

  <style>
    #trust-signals {
      --rsp-trust-title: #334155;
      --rsp-trust-heading: #3B4658;
      --rsp-trust-body: #64748B;
      --rsp-trust-blue: #2563EB;
      --rsp-trust-green: #00C853;
      --rsp-trust-teal: #14B8A6;
      --rsp-trust-soft: #F8FAFC;
      --rsp-trust-border: #E2E8F0;
    }

    #trust-signals .rsp-trust-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #trust-signals .rsp-trust-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(32px, 4.8vw, 56px);
      font-weight: 800;
      line-height: 1.07;
      letter-spacing: -0.055em;
      color: var(--rsp-trust-title);
    }

    #trust-signals .rsp-trust-text {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 500;
      line-height: 1.8;
      color: var(--rsp-trust-body);
    }

    #trust-signals .rsp-trust-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
    }

    #trust-signals .rsp-trust-reveal.rsp-is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #trust-signals .rsp-trust-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #trust-signals .rsp-trust-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.07),
          rgba(0, 200, 83, 0.26),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.26),
          rgba(37, 99, 235, 0.07));
      opacity: 0.72;
      transform: rotate(0deg);
      animation: rspTrustBorderSpin 8s linear infinite;
      transition: opacity 260ms ease;
      pointer-events: none;
    }

    #trust-signals .rsp-trust-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-trust-card-bg, #ffffff);
      pointer-events: none;
    }

    #trust-signals .rsp-trust-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #trust-signals .rsp-trust-stat-card,
    #trust-signals .rsp-trust-cert-card {
      transition:
        transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 340ms ease,
        border-color 280ms ease;
    }

    #trust-signals .rsp-trust-stat-card:hover {
      transform: translateY(-7px);
      box-shadow: 0 24px 72px rgba(15, 23, 42, 0.10);
    }

    #trust-signals .rsp-trust-cert-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 58px rgba(16, 185, 129, 0.11);
    }

    #trust-signals .rsp-trust-icon {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 280ms ease,
        background-color 280ms ease;
    }

    #trust-signals .rsp-trust-stat-card:hover .rsp-trust-icon,
    #trust-signals .rsp-trust-cert-card:hover .rsp-trust-icon {
      transform: rotate(-5deg) scale(1.08);
      box-shadow: 0 16px 38px rgba(37, 99, 235, 0.12);
    }

    #trust-signals .rsp-trust-stat-number {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 38px;
      font-weight: 800;
      line-height: 1;
      letter-spacing: -0.045em;
      color: var(--rsp-trust-title);
    }

    #trust-signals .rsp-trust-stat-label {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 500;
      line-height: 1.55;
      color: var(--rsp-trust-body);
    }

    #trust-signals .rsp-trust-platform-chip {
      transition:
        transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 240ms ease,
        background-color 240ms ease,
        color 240ms ease,
        box-shadow 240ms ease;
    }

    #trust-signals .rsp-trust-platform-chip:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(37, 99, 235, 0.08);
    }

    #trust-signals .orm-marquee {
      animation: rspTrustMarquee 46s linear infinite;
    }

    #trust-signals .orm-marquee:hover {
      animation-play-state: paused;
    }

    #trust-signals .rsp-trust-beam {
      animation: rspTrustBeam 7s ease-in-out infinite;
    }

    @keyframes rspTrustBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspTrustMarquee {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }
    }

    @keyframes rspTrustBeam {
      0% {
        transform: translateX(-120%);
      }

      100% {
        transform: translateX(120%);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #trust-signals *,
      #trust-signals *::before,
      #trust-signals *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
      }

      #trust-signals .rsp-trust-reveal {
        opacity: 1;
        transform: none;
      }

      #trust-signals .rsp-trust-stat-card:hover,
      #trust-signals .rsp-trust-cert-card:hover,
      #trust-signals .rsp-trust-platform-chip:hover,
      #trust-signals .rsp-trust-stat-card:hover .rsp-trust-icon,
      #trust-signals .rsp-trust-cert-card:hover .rsp-trust-icon {
        transform: none;
      }
    }
  </style>

  <!-- Section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <!-- Background texture -->
  <div
    class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]"
    aria-hidden="true"></div>

  <div
    class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.075),transparent_38%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.075),transparent_38%)]"
    aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

    <!-- Section heading -->
    <div
      class="rsp-trust-reveal mx-auto mb-14 max-w-3xl text-center"
      data-gsap-item="trust-heading"
      data-rsp-trust-reveal>

      <span class="rsp-trust-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-[7px] text-emerald-700 shadow-sm">
        <i data-lucide="shield-check" class="h-[13px] w-[13px]" aria-hidden="true"></i>
        <?php esc_html_e('Why businesses trust us', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-trust-title">
        <?php esc_html_e('Reputation Trust Signals', 'reviewservicepro'); ?>
        <span class="block"><?php esc_html_e('You Can Measure', 'reviewservicepro'); ?></span>
      </h2>

      <p class="rsp-trust-text mx-auto mt-5 max-w-[640px]">
        <?php esc_html_e('Ethical reputation management built around real customer feedback, review monitoring, transparent reporting, and long-term trust growth.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Stat cards -->
    <div class="mb-16 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-gsap-item="trust-stats">
      <?php foreach ($stats as $index => $stat) : ?>
        <article
          class="rsp-trust-stat-card rsp-trust-motion-border rsp-trust-reveal rounded-[1.6rem] border border-[#E2E8F0] bg-white p-6 text-center shadow-[0_1px_3px_rgba(0,0,0,.04),0_14px_38px_rgba(15,23,42,.06)]"
          data-rsp-trust-reveal
          style="--rsp-trust-card-bg:#ffffff; transition-delay: <?php echo esc_attr((string) min($index * 80, 320)); ?>ms;">

          <div class="pointer-events-none absolute inset-x-0 top-0 z-10 h-px overflow-hidden bg-[#E2E8F0]" aria-hidden="true">
            <div class="rsp-trust-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
          </div>

          <div class="relative z-10">
            <div class="rsp-trust-icon mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-[#2563EB]">
              <i data-lucide="<?php echo esc_attr($stat['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
            </div>

            <p class="rsp-trust-stat-number">
              <span
                class="trust-counter"
                data-target="<?php echo esc_attr(preg_replace('/\D/', '', (string) $stat['target'])); ?>">0</span><sup class="ml-0.5 font-['Inter',sans-serif] text-[15px] font-[800] text-[#2563EB]"><?php echo esc_html($stat['suffix']); ?></sup>
            </p>

            <p class="rsp-trust-stat-label mx-auto mt-3 max-w-[180px]">
              <?php echo esc_html($stat['label']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Platform marquee -->
    <div
      class="rsp-trust-reveal mb-16"
      data-gsap-item="trust-platforms"
      data-rsp-trust-reveal>

      <p class="mb-6 text-center font-['Inter',sans-serif] text-[12px] font-[800] uppercase tracking-[0.14em] text-[#94A3B8]">
        <?php esc_html_e('Platforms we monitor and manage', 'reviewservicepro'); ?>
      </p>

      <div class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-24 bg-gradient-to-r from-white to-transparent" aria-hidden="true"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-24 bg-gradient-to-l from-white to-transparent" aria-hidden="true"></div>

        <div class="orm-marquee flex w-max gap-3 py-2">
          <?php foreach ($platforms_loop as $platform) : ?>
            <span class="rsp-trust-platform-chip inline-flex items-center gap-2 whitespace-nowrap rounded-[14px] border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-[11px] font-['Inter',sans-serif] text-[14px] font-[600] text-[#334155] hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]">
              <i data-lucide="badge-check" class="h-[14px] w-[14px] flex-shrink-0 text-[#2563EB]" aria-hidden="true"></i>
              <?php echo esc_html($platform); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Compliance cards -->
    <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-4" data-gsap-item="trust-certs">
      <?php foreach ($certs as $index => $cert) : ?>
        <article
          class="rsp-trust-cert-card rsp-trust-motion-border rsp-trust-reveal rounded-[1.5rem] border border-emerald-100 bg-emerald-50 p-6 text-center"
          data-rsp-trust-reveal
          style="--rsp-trust-card-bg:#ECFDF5; transition-delay: <?php echo esc_attr((string) min($index * 80, 320)); ?>ms;">

          <div class="relative z-10">
            <div class="rsp-trust-icon mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-200 bg-white text-[#059669] shadow-sm">
              <i data-lucide="<?php echo esc_attr($cert['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <p class="font-['Inter',sans-serif] text-[16px] font-[700] leading-[1.5] text-[#065F46]">
              <?php echo esc_html($cert['text']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspTrustSignals() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('#trust-signals [data-rsp-trust-reveal]');

      if ('IntersectionObserver' in window && revealItems.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('rsp-is-visible');
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.14,
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
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspTrustSignals);
    } else {
      initRspTrustSignals();
    }
  })();
</script>