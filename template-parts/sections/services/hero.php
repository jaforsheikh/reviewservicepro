<?php

/**
 * Services Page Hero Section
 *
 * File: template-parts/sections/services/hero.php
 *
 * ReviewService.Pro — SEO Optimized AI-Driven ORM Hero
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$hero_slides = [
  [
    'file'     => 'assets/images/services/orm-dashboard-monitoring.jpg',
    'fallback' => 'assets/images/hero/hero-1.jpg',
    'alt'      => __('AI-driven online reputation management dashboard monitoring review platforms', 'reviewservicepro'),
    'position' => 'center center',
  ],
  [
    'file'     => 'assets/images/services/review-response-workflow.jpg',
    'fallback' => 'assets/images/hero/hero-2.jpg',
    'alt'      => __('Professional review response management workflow for business reviews', 'reviewservicepro'),
    'position' => 'center center',
  ],
  [
    'file'     => 'assets/images/services/negative-review-case-handling.jpg',
    'fallback' => 'assets/images/hero/hero-3.jpg',
    'alt'      => __('Negative review case handling and reputation risk documentation', 'reviewservicepro'),
    'position' => 'center center',
  ],
  [
    'file'     => 'assets/images/services/google-business-profile-optimization.jpg',
    'fallback' => 'assets/images/hero/hero-4.jpg',
    'alt'      => __('Google Business Profile reputation management and local trust optimization', 'reviewservicepro'),
    'position' => 'center center',
  ],
  [
    'file'     => 'assets/images/services/client-portal-reporting.jpg',
    'fallback' => 'assets/images/hero/hero-1.jpg',
    'alt'      => __('Client portal for monthly reputation management reporting and support', 'reviewservicepro'),
    'position' => 'center center',
  ],
];

$resolved_slides = [];

foreach ($hero_slides as $slide) {
  $image_path = get_theme_file_path($slide['file']);
  $image_url  = file_exists($image_path)
    ? get_theme_file_uri($slide['file'])
    : get_theme_file_uri($slide['fallback']);

  $resolved_slides[] = [
    'url'      => $image_url,
    'alt'      => $slide['alt'],
    'position' => $slide['position'],
  ];
}

$primary_cta_url   = '#monthly-plans';
$secondary_cta_url = home_url('/contact/');

$trust_badges = [
  [
    'icon' => 'shield-check',
    'text' => __('No Fake Reviews', 'reviewservicepro'),
  ],
  [
    'icon' => 'badge-check',
    'text' => __('Platform-Compliant', 'reviewservicepro'),
  ],
  [
    'icon' => 'file-text',
    'text' => __('Monthly Reporting', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock',
    'text' => __('Secure Client Portal', 'reviewservicepro'),
  ],
];

$dashboard_metrics = [
  [
    'label'  => __('Reputation Score', 'reviewservicepro'),
    'target' => 78,
    'suffix' => '/100',
    'tone'   => 'blue',
  ],
  [
    'label'  => __('Platforms Monitored', 'reviewservicepro'),
    'target' => 5,
    'suffix' => '',
    'tone'   => 'emerald',
  ],
  [
    'label'  => __('Responses This Month', 'reviewservicepro'),
    'target' => 42,
    'suffix' => '',
    'tone'   => 'blue',
  ],
  [
    'label' => __('Risk Level', 'reviewservicepro'),
    'text'  => __('Medium', 'reviewservicepro'),
    'tone'  => 'amber',
  ],
];
?>

<style>
  #services-hero {
    --rsp-services-title-white: #ffffff;
    --rsp-services-text-light: rgba(241, 245, 249, 0.96);
    --rsp-services-text-muted: rgba(203, 213, 225, 0.92);
    --rsp-services-blue: #2563EB;
    --rsp-services-green: #00C853;
    --rsp-services-sky: #7DD3FC;
  }

  #services-hero .rsp-services-hero-slide {
    opacity: 0;
    transform: scale(1.08);
    animation: rspServicesHeroSlide 35s infinite;
  }

  #services-hero .rsp-services-hero-slide:nth-child(1) {
    animation-delay: 0s;
  }

  #services-hero .rsp-services-hero-slide:nth-child(2) {
    animation-delay: 7s;
  }

  #services-hero .rsp-services-hero-slide:nth-child(3) {
    animation-delay: 14s;
  }

  #services-hero .rsp-services-hero-slide:nth-child(4) {
    animation-delay: 21s;
  }

  #services-hero .rsp-services-hero-slide:nth-child(5) {
    animation-delay: 28s;
  }

  @keyframes rspServicesHeroSlide {
    0% {
      opacity: 0;
      transform: scale(1.08);
    }

    5% {
      opacity: 1;
      transform: scale(1.045);
    }

    21% {
      opacity: 1;
      transform: scale(1);
    }

    28% {
      opacity: 0;
      transform: scale(1);
    }

    100% {
      opacity: 0;
      transform: scale(1.08);
    }
  }

  #services-hero .rsp-hero-score-bar {
    width: 0%;
    transition: width 1400ms cubic-bezier(0.22, 1, 0.36, 1);
  }

  #services-hero .rsp-services-hero-title {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif !important;
    font-size: clamp(42px, 5.45vw, 72px);
    font-weight: 800 !important;
    line-height: 1.06;
    letter-spacing: -0.055em;
    color: #ffffff !important;
    opacity: 1 !important;
    text-wrap: balance;
    text-shadow: 0 18px 42px rgba(0, 0, 0, 0.34);
    -webkit-text-fill-color: #ffffff !important;
  }

  #services-hero .rsp-services-hero-title-solid {
    color: #ffffff !important;
    opacity: 1 !important;
    -webkit-text-fill-color: #ffffff !important;
  }

  #services-hero .rsp-services-hero-title-gradient {
    display: block;
    margin-top: 0.5rem;
    background-image: linear-gradient(90deg, #7DD3FC 0%, #60A5FA 42%, #22D3EE 68%, #34D399 100%) !important;
    background-size: 100% 100%;
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent !important;
    opacity: 1 !important;
    -webkit-text-fill-color: transparent !important;
    text-shadow: none;
  }

  #services-hero .rsp-services-hero-subtitle {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.78;
    color: var(--rsp-services-text-light) !important;
  }

  #services-hero .rsp-services-hero-small-text {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-services-text-muted) !important;
  }

  #services-hero .rsp-hero-dashboard {
    max-width: 470px;
    margin-left: auto;
  }

  #services-hero .rsp-services-hero-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #services-hero .rsp-services-hero-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -120%;
    z-index: 0;
    width: 70%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.32), transparent);
    transform: skewX(-18deg);
    transition: left 720ms ease;
    pointer-events: none;
  }

  #services-hero .rsp-services-hero-btn:hover {
    transform: translateY(-4px);
  }

  #services-hero .rsp-services-hero-btn:hover::before {
    left: 135%;
  }

  @media (max-width: 1280px) {
    #services-hero .rsp-hero-dashboard {
      max-width: 430px;
    }
  }

  @media (max-width: 640px) {
    #services-hero .rsp-services-hero-title {
      font-size: clamp(38px, 11vw, 52px);
      letter-spacing: -0.045em;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #services-hero *,
    #services-hero *::before,
    #services-hero *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #services-hero .rsp-services-hero-slide {
      animation: none;
      opacity: 0;
      transform: none;
    }

    #services-hero .rsp-services-hero-slide:first-child {
      opacity: 1;
    }

    #services-hero .rsp-hero-score-bar {
      transition: none;
    }

    #services-hero .rsp-services-hero-btn:hover {
      transform: none;
    }
  }
</style>

<section
  id="services-hero"
  class="relative min-h-[88vh] overflow-hidden bg-[#07111F] text-white"
  aria-labelledby="services-hero-title"
  data-gsap="services-hero">

  <!-- Animated Background Image Slider -->
  <div class="absolute inset-0 z-0 overflow-hidden" aria-hidden="true">
    <?php foreach ($resolved_slides as $slide) : ?>
      <div
        class="rsp-services-hero-slide absolute inset-0 bg-cover bg-no-repeat"
        style="background-image:url('<?php echo esc_url($slide['url']); ?>'); background-position:<?php echo esc_attr($slide['position']); ?>;"
        aria-label="<?php echo esc_attr($slide['alt']); ?>"></div>
    <?php endforeach; ?>
  </div>

  <!-- Overlay System -->
  <div class="absolute inset-0 z-[1] bg-[#07111F]/34" aria-hidden="true"></div>
  <div class="absolute inset-0 z-[1] bg-gradient-to-r from-[#07111F]/96 via-[#07111F]/68 to-[#07111F]/18" aria-hidden="true"></div>
  <div class="absolute inset-0 z-[1] bg-gradient-to-t from-[#07111F]/78 via-[#07111F]/16 to-[#07111F]/10" aria-hidden="true"></div>

  <!-- Glow Layers -->
  <div class="pointer-events-none absolute -left-32 top-20 z-[2] h-96 w-96 rounded-full bg-blue-600/28 blur-[120px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-10 z-[2] h-96 w-96 rounded-full bg-emerald-400/18 blur-[130px]" aria-hidden="true"></div>

  <!-- Grid Texture -->
  <div class="pointer-events-none absolute inset-0 z-[2] bg-[linear-gradient(rgba(255,255,255,0.025)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.025)_1px,transparent_1px)] bg-[size:64px_64px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto flex min-h-[88vh] max-w-7xl items-center px-5 py-24 sm:px-6 lg:px-8 lg:py-28">

    <div class="grid w-full grid-cols-1 gap-10 lg:grid-cols-[1fr_0.78fr] lg:items-center xl:gap-14">

      <!-- Left Content -->
      <div data-gsap-item="services-hero-content">

        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-400/30 bg-blue-600/18 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.15em] text-blue-100 shadow-[0_0_35px_rgba(37,99,235,0.28)] backdrop-blur-xl">
          <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Ethical AI-Driven ORM Services', 'reviewservicepro'); ?>
        </span>

        <h1
          id="services-hero-title"
          class="rsp-services-hero-title max-w-[760px]">
          <span class="rsp-services-hero-title-solid block">
            <?php esc_html_e('AI-Driven Online Reputation Management', 'reviewservicepro'); ?>
          </span>

          <span class="rsp-services-hero-title-gradient">
            <?php esc_html_e('Services for Trust-Driven Businesses', 'reviewservicepro'); ?>
          </span>
        </h1>

        <p class="rsp-services-hero-subtitle mt-6 max-w-2xl">
          <?php esc_html_e('ReviewService.Pro helps businesses monitor reviews, manage responses, document reputation risks, request genuine customer feedback ethically, and improve online trust through AI-assisted reputation insights and transparent monthly reporting.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
          <a
            href="<?php echo esc_url($primary_cta_url); ?>"
            class="rsp-services-hero-btn inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 py-4 font-['Inter',sans-serif] text-[16px] font-bold text-white shadow-[0_0_45px_rgba(37,99,235,0.45)] transition-all duration-300 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-500/30">
            <span class="relative z-10 inline-flex items-center gap-2">
              <i data-lucide="shopping-cart" class="h-5 w-5" aria-hidden="true"></i>
              <?php esc_html_e('Order Now', 'reviewservicepro'); ?>
            </span>
          </a>

          <a
            href="<?php echo esc_url($secondary_cta_url); ?>"
            class="rsp-services-hero-btn inline-flex items-center justify-center gap-2 rounded-2xl border border-white/20 bg-white/12 px-7 py-4 font-['Inter',sans-serif] text-[16px] font-bold text-white backdrop-blur-xl transition-all duration-300 hover:border-white/35 hover:bg-white/18 hover:text-white focus:outline-none focus:ring-4 focus:ring-white/10">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Contact Us', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
            </span>
          </a>
        </div>

        <div class="mt-7 flex flex-wrap gap-3">
          <?php foreach ($trust_badges as $badge) : ?>
            <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/12 px-4 py-2 font-['Inter',sans-serif] text-[14px] font-bold text-slate-100 backdrop-blur-xl">
              <i data-lucide="<?php echo esc_attr($badge['icon']); ?>" class="h-4 w-4 text-emerald-300" aria-hidden="true"></i>
              <?php echo esc_html($badge['text']); ?>
            </span>
          <?php endforeach; ?>
        </div>

        <p class="rsp-services-hero-small-text mt-6 max-w-2xl font-['Inter',sans-serif] text-[14px] font-medium leading-7">
          <?php esc_html_e('We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed review removal, or guaranteed ranking outcomes. Our work focuses on monitoring, documenting, responding, reporting, and ethical reputation improvement.', 'reviewservicepro'); ?>
        </p>
      </div>

      <!-- Right Dashboard Mockup -->
      <div data-gsap-item="services-hero-visual" class="relative hidden lg:flex lg:justify-end">

        <div class="absolute -inset-6 rounded-[2.5rem] bg-blue-500/18 blur-3xl" aria-hidden="true"></div>

        <div
          class="rsp-hero-dashboard relative w-full overflow-hidden rounded-[1.6rem] border border-white/16 bg-white/14 p-4 shadow-[0_28px_90px_rgba(37,99,235,0.20)] backdrop-blur-2xl"
          data-rsp-dashboard>

          <div class="mb-4 flex items-center justify-between border-b border-white/14 pb-3">
            <div>
              <p class="font-['DM_Mono',monospace] text-[10px] font-bold uppercase tracking-[0.16em] text-blue-100">
                <?php esc_html_e('AI Reputation Intelligence', 'reviewservicepro'); ?>
              </p>

              <h2 class="mt-1 font-['Poppins',sans-serif] text-lg font-extrabold text-white">
                <?php esc_html_e('Live Trust Overview', 'reviewservicepro'); ?>
              </h2>
            </div>

            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/25 bg-emerald-400/12 px-3 py-1 font-['Inter',sans-serif] text-[11px] font-extrabold text-emerald-100">
              <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-300"></span>
              <?php esc_html_e('Active', 'reviewservicepro'); ?>
            </span>
          </div>

          <div class="rounded-2xl border border-white/12 bg-[#07111F]/76 p-4">
            <p class="font-['Inter',sans-serif] text-sm font-semibold text-slate-200">
              <?php esc_html_e('Overall Reputation Score', 'reviewservicepro'); ?>
            </p>

            <div class="mt-3 flex items-end justify-between gap-4">
              <p class="font-['Poppins',sans-serif] text-4xl font-extrabold text-white">
                <span class="rsp-hero-counter" data-rsp-count-target="78">0</span><span class="font-['Inter',sans-serif] text-base text-slate-400">/100</span>
              </p>

              <span class="rounded-full border border-emerald-400/25 bg-emerald-400/12 px-3 py-1 font-['Inter',sans-serif] text-xs font-extrabold text-emerald-100">
                <?php esc_html_e('Improving', 'reviewservicepro'); ?>
              </span>
            </div>

            <div class="mt-4 h-2.5 overflow-hidden rounded-full bg-white/12">
              <div class="rsp-hero-score-bar h-full rounded-full bg-gradient-to-r from-blue-500 to-emerald-400" data-rsp-bar-width="78"></div>
            </div>
          </div>

          <div class="mt-4 grid grid-cols-2 gap-3">
            <?php foreach ($dashboard_metrics as $metric) : ?>
              <?php
              $tone_class = 'text-blue-100 bg-blue-500/12 border-blue-400/25';

              if ('emerald' === $metric['tone']) {
                $tone_class = 'text-emerald-100 bg-emerald-400/12 border-emerald-400/25';
              }

              if ('amber' === $metric['tone']) {
                $tone_class = 'text-amber-100 bg-amber-400/12 border-amber-400/25';
              }
              ?>

              <div class="rounded-2xl border border-white/14 bg-white/12 p-3.5">
                <p class="font-['DM_Mono',monospace] text-[10px] font-bold uppercase tracking-[0.10em] text-slate-300">
                  <?php echo esc_html($metric['label']); ?>
                </p>

                <p class="mt-2 font-['Poppins',sans-serif] text-xl font-extrabold text-white">
                  <?php if (isset($metric['target'])) : ?>
                    <span class="rsp-hero-counter" data-rsp-count-target="<?php echo esc_attr($metric['target']); ?>">0</span><?php echo esc_html($metric['suffix']); ?>
                  <?php else : ?>
                    <?php echo esc_html($metric['text']); ?>
                  <?php endif; ?>
                </p>

                <span class="<?php echo esc_attr($tone_class); ?> mt-2 inline-flex rounded-full border px-2 py-0.5 font-['DM_Mono',monospace] text-[9px] font-extrabold uppercase tracking-[0.08em]">
                  <?php esc_html_e('Tracked', 'reviewservicepro'); ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="mt-4 rounded-2xl border border-emerald-400/25 bg-emerald-400/12 p-4">
            <div class="mb-2 flex items-center gap-2 font-['Inter',sans-serif] text-xs font-extrabold text-emerald-100">
              <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Ethical ORM Promise', 'reviewservicepro'); ?>
            </div>

            <p class="font-['Inter',sans-serif] text-sm leading-6 text-emerald-50">
              <?php esc_html_e('Monitor real feedback, respond professionally, document risks, and report progress using platform-compliant methods.', 'reviewservicepro'); ?>
            </p>
          </div>

        </div>
      </div>

    </div>
  </div>

</section>

<script>
  (function() {
    function animateCounter(element, target, duration) {
      var start = 0;
      var startTime = null;

      function step(timestamp) {
        if (!startTime) {
          startTime = timestamp;
        }

        var progress = Math.min((timestamp - startTime) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        var value = Math.floor(start + (target - start) * eased);

        element.textContent = value;

        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          element.textContent = target;
        }
      }

      window.requestAnimationFrame(step);
    }

    function runDashboardAnimation(dashboard) {
      if (!dashboard || dashboard.dataset.rspAnimated === 'true') {
        return;
      }

      dashboard.dataset.rspAnimated = 'true';

      var counters = dashboard.querySelectorAll('[data-rsp-count-target]');
      var bars = dashboard.querySelectorAll('[data-rsp-bar-width]');

      counters.forEach(function(counter) {
        var target = parseInt(counter.getAttribute('data-rsp-count-target'), 10);

        if (!isNaN(target)) {
          animateCounter(counter, target, 1300);
        }
      });

      bars.forEach(function(bar) {
        var width = parseInt(bar.getAttribute('data-rsp-bar-width'), 10);

        if (!isNaN(width)) {
          setTimeout(function() {
            bar.style.width = width + '%';
          }, 150);
        }
      });
    }

    function initHeroDashboard() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var dashboard = document.querySelector('[data-rsp-dashboard]');

      if (!dashboard) {
        return;
      }

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              runDashboardAnimation(dashboard);
              observer.disconnect();
            }
          });
        }, {
          threshold: 0.35
        });

        observer.observe(dashboard);
      } else {
        runDashboardAnimation(dashboard);
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initHeroDashboard);
    } else {
      initHeroDashboard();
    }
  })();
</script>