<?php

/**
 * Home Section: Reputation Intelligence / Reporting Preview
 *
 * White SaaS animated version for ReviewService.Pro.
 *
 * Preserved hooks/classes:
 * - id="reputation-intelligence"
 * - data-gsap="ri-animate"
 * - data-gsap-item values
 * - ri-counter
 * - ri-underline
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$stats = array(
  array(
    'icon'   => 'badge-check',
    'color'  => '#2563eb',
    'target' => get_theme_mod('ri_stat1_num', '10'),
    'suffix' => '+',
    'label'  => get_theme_mod('ri_stat1_label', 'Review platforms supported'),
    'trend'  => __('Platform visibility', 'reviewservicepro'),
    'up'     => true,
  ),
  array(
    'icon'   => 'shield-check',
    'color'  => '#00C853',
    'target' => get_theme_mod('ri_stat2_num', '0'),
    'suffix' => '',
    'label'  => get_theme_mod('ri_stat2_label', 'Fake-review tactics used'),
    'trend'  => __('Ethical only', 'reviewservicepro'),
    'up'     => true,
  ),
  array(
    'icon'   => 'clock',
    'color'  => '#14B8A6',
    'target' => get_theme_mod('ri_stat3_num', '4'),
    'suffix' => '',
    'label'  => get_theme_mod('ri_stat3_label', 'Core tracking areas'),
    'trend'  => __('Review, response, trust, reports', 'reviewservicepro'),
    'up'     => false,
  ),
  array(
    'icon'   => 'bar-chart-2',
    'color'  => '#8b5cf6',
    'target' => get_theme_mod('ri_stat4_num', '3'),
    'suffix' => '',
    'label'  => get_theme_mod('ri_stat4_label', 'Report focus areas'),
    'trend'  => __('Trends, issues, next steps', 'reviewservicepro'),
    'up'     => true,
  ),
);

$dash_metrics = array(
  array(
    'label'     => __('Reputation Score', 'reviewservicepro'),
    'value'     => '87 / 100',
    'color'     => '#2563eb',
    'sub'       => __('Sample dashboard metric', 'reviewservicepro'),
    'sub_color' => '#00C853',
  ),
  array(
    'label'     => __('Avg. Star Rating', 'reviewservicepro'),
    'value'     => '4.6 ★',
    'color'     => '#d6a84f',
    'sub'       => __('Platform snapshot', 'reviewservicepro'),
    'sub_color' => '#00C853',
  ),
  array(
    'label'     => __('Positive Sentiment', 'reviewservicepro'),
    'value'     => '91%',
    'color'     => '#00C853',
    'sub'       => __('Example report metric', 'reviewservicepro'),
    'sub_color' => '#00C853',
  ),
  array(
    'label'     => __('Unanswered Reviews', 'reviewservicepro'),
    'value'     => '3',
    'color'     => '#ef4444',
    'sub'       => __('Needs professional response', 'reviewservicepro'),
    'sub_color' => '#d6a84f',
  ),
);

$chart_months = array(
  array('label' => 'Jan', 'pos' => 42, 'neg' => 55),
  array('label' => 'Feb', 'pos' => 50, 'neg' => 40),
  array('label' => 'Mar', 'pos' => 48, 'neg' => 65),
  array('label' => 'Apr', 'pos' => 62, 'neg' => 35),
  array('label' => 'May', 'pos' => 70, 'neg' => 28),
  array('label' => 'Jun', 'pos' => 78, 'neg' => 18),
);

$alerts = array(
  array(
    'text' => __('New review detected on Google Business Profile', 'reviewservicepro'),
    'time' => __('2m ago', 'reviewservicepro'),
  ),
  array(
    'text' => __('Response draft prepared for review before publishing', 'reviewservicepro'),
    'time' => __('18m ago', 'reviewservicepro'),
  ),
  array(
    'text' => __('Review pattern documented for monthly report', 'reviewservicepro'),
    'time' => __('1h ago', 'reviewservicepro'),
  ),
  array(
    'text' => __('Reputation insight summary ready for client review', 'reviewservicepro'),
    'time' => __('Today', 'reviewservicepro'),
  ),
);

$platforms = array(
  array('name' => 'Google', 'color' => '#4285F4'),
  array('name' => 'Trustpilot', 'color' => '#00b67a'),
  array('name' => 'Facebook', 'color' => '#1877f2'),
  array('name' => 'Yelp', 'color' => '#d32323'),
  array('name' => 'Tripadvisor', 'color' => '#34967c'),
  array('name' => 'G2', 'color' => '#ff492c'),
  array('name' => 'BBB', 'color' => '#003087'),
  array('name' => 'Capterra', 'color' => '#f59e0b'),
  array('name' => '+ more', 'color' => '#64748b'),
);

$key_metrics = array(
  array(
    'icon'  => 'bar-chart-2',
    'color' => '#2563eb',
    'title' => __('Rating Trend Snapshot', 'reviewservicepro'),
    'desc'  => __('Track rating movement across selected platforms and see where reputation signals may need attention.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'message-square',
    'color' => '#00C853',
    'title' => __('Review Response Tracking', 'reviewservicepro'),
    'desc'  => __('Monitor response status, response timing, tone consistency, and pending review actions.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'trending-up',
    'color' => '#d6a84f',
    'title' => __('Sentiment Intelligence', 'reviewservicepro'),
    'desc'  => __('AI-assisted sentiment review helps identify positive, neutral, and negative feedback patterns.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'map-pin',
    'color' => '#8b5cf6',
    'title' => __('Local Trust Signal Snapshot', 'reviewservicepro'),
    'desc'  => __('Review profile completeness, response activity, and local trust indicators without ranking guarantees.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'users',
    'color' => '#14B8A6',
    'title' => __('Competitor Visibility Context', 'reviewservicepro'),
    'desc'  => __('Compare public reputation signals against nearby or relevant competitors for planning purposes.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'shield-check',
    'color' => '#f97316',
    'title' => __('Platform Health Monitor', 'reviewservicepro'),
    'desc'  => __('Spot missing profiles, response gaps, policy concerns, and reputation documentation needs.', 'reviewservicepro'),
  ),
);

$primary_cta_url   = get_theme_mod('ri_cta_primary_url', home_url('/contact/'));
$secondary_cta_url = get_theme_mod('ri_cta_secondary_url', home_url('/pricing/'));

if (empty($primary_cta_url)) {
  $primary_cta_url = home_url('/contact/');
}

if (empty($secondary_cta_url)) {
  $secondary_cta_url = home_url('/pricing/');
}
?>

<section
  id="reputation-intelligence"
  class="rsp-ri-section relative overflow-hidden border-t border-slate-200 bg-[#F8FAFC] py-24 md:py-32"
  role="region"
  aria-label="<?php echo esc_attr__('Reputation Intelligence Dashboard', 'reviewservicepro'); ?>"
  data-gsap="ri-animate">
  <style>
    #reputation-intelligence {
      --ri-navy: #07111F;
      --ri-blue: #2563EB;
      --ri-green: #00C853;
      --ri-teal: #14B8A6;
      --ri-slate: #475569;
      --ri-soft: #F8FAFC;
      --ri-card: #FFFFFF;
      --ri-border: rgba(15, 23, 42, 0.10);
    }

    #reputation-intelligence .rsp-ri-main-text {
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
    }

    #reputation-intelligence .rsp-ri-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #reputation-intelligence .rsp-ri-motion-border::before {
      content: "";
      position: absolute;
      inset: -1px;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from var(--ri-angle, 0deg),
          rgba(37, 99, 235, 0.10),
          rgba(0, 200, 83, 0.30),
          rgba(20, 184, 166, 0.22),
          rgba(37, 99, 235, 0.26),
          rgba(37, 99, 235, 0.10));
      animation: rspRiBorderSpin 7s linear infinite;
      opacity: 0;
      transition: opacity 320ms ease;
    }

    #reputation-intelligence .rsp-ri-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: #ffffff;
    }

    #reputation-intelligence .rsp-ri-motion-border:hover::before {
      opacity: 1;
    }

    #reputation-intelligence .rsp-ri-card {
      transform: translateY(0) scale(1);
      transition:
        transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 420ms ease,
        background-color 420ms ease;
    }

    #reputation-intelligence .rsp-ri-card:hover {
      transform: translateY(-8px) scale(1.012);
      box-shadow: 0 28px 88px rgba(15, 23, 42, 0.14);
    }

    #reputation-intelligence .rsp-ri-icon {
      transition:
        transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 420ms ease,
        background-color 420ms ease;
    }

    #reputation-intelligence .rsp-ri-card:hover .rsp-ri-icon {
      transform: rotate(-4deg) scale(1.08);
      box-shadow: 0 18px 42px rgba(37, 99, 235, 0.14);
    }

    #reputation-intelligence .rsp-ri-dashboard-shell {
      position: relative;
      transform: translateY(0);
      animation: rspRiFloat 7s ease-in-out infinite;
    }

    #reputation-intelligence .rsp-ri-dashboard-shell::before {
      content: "";
      position: absolute;
      inset: -1px;
      border-radius: 2rem;
      background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.40), rgba(0, 200, 83, 0.32), transparent);
      background-size: 220% 100%;
      animation: rspRiBeam 5.5s ease-in-out infinite;
      opacity: 0.80;
      pointer-events: none;
    }

    #reputation-intelligence .rsp-ri-dashboard-inner {
      position: relative;
      z-index: 1;
    }

    #reputation-intelligence .rsp-ri-bar-positive,
    #reputation-intelligence .rsp-ri-bar-negative {
      transform-origin: bottom;
      animation: rspRiBarRise 900ms cubic-bezier(0.2, 0.9, 0.2, 1) both;
    }

    #reputation-intelligence .rsp-ri-platform-pill {
      transition:
        transform 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease,
        box-shadow 260ms ease;
    }

    #reputation-intelligence .rsp-ri-platform-pill:hover {
      transform: translateY(-3px);
      border-color: rgba(37, 99, 235, 0.24);
      background: #EFF6FF;
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.10);
    }

    #reputation-intelligence .rsp-ri-alert-row {
      transition:
        transform 260ms ease,
        background-color 260ms ease;
    }

    #reputation-intelligence .rsp-ri-alert-row:hover {
      transform: translateX(6px);
      background: rgba(255, 255, 255, 0.55);
    }

    #reputation-intelligence .rsp-ri-cta-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #reputation-intelligence .rsp-ri-cta-card::before {
      content: "";
      position: absolute;
      inset: -80px;
      z-index: -1;
      background:
        radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.14), transparent 28%),
        radial-gradient(circle at 80% 40%, rgba(0, 200, 83, 0.13), transparent 28%);
      animation: rspRiGlowMove 8s ease-in-out infinite alternate;
    }

    #reputation-intelligence .rsp-ri-primary-btn,
    #reputation-intelligence .rsp-ri-secondary-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        background-color 260ms ease,
        border-color 260ms ease;
    }

    #reputation-intelligence .rsp-ri-primary-btn::before,
    #reputation-intelligence .rsp-ri-secondary-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.28), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
    }

    #reputation-intelligence .rsp-ri-primary-btn:hover,
    #reputation-intelligence .rsp-ri-secondary-btn:hover {
      transform: translateY(-3px);
    }

    #reputation-intelligence .rsp-ri-primary-btn:hover::before,
    #reputation-intelligence .rsp-ri-secondary-btn:hover::before {
      left: 135%;
    }

    #reputation-intelligence .ri-underline {
      transform-origin: left;
    }

    #reputation-intelligence:hover .ri-underline {
      transform: scaleX(1);
    }

    @keyframes rspRiBorderSpin {
      to {
        --ri-angle: 360deg;
      }
    }

    @property --ri-angle {
      syntax: "<angle>";
      initial-value: 0deg;
      inherits: false;
    }

    @keyframes rspRiFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes rspRiBeam {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    @keyframes rspRiBarRise {
      from {
        transform: scaleY(0.18);
        opacity: 0.35;
      }

      to {
        transform: scaleY(1);
        opacity: 1;
      }
    }

    @keyframes rspRiGlowMove {
      from {
        transform: translate3d(-20px, -10px, 0) scale(1);
      }

      to {
        transform: translate3d(20px, 12px, 0) scale(1.04);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #reputation-intelligence *,
      #reputation-intelligence *::before,
      #reputation-intelligence *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }
    }
  </style>

  <div
    class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.10),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.10),transparent_32%)]"
    aria-hidden="true"></div>

  <div
    class="pointer-events-none absolute left-1/2 top-0 z-0 h-px w-full max-w-6xl -translate-x-1/2 bg-gradient-to-r from-transparent via-slate-300 to-transparent"
    aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

    <div class="mx-auto mb-16 max-w-3xl text-center" data-gsap-item="ri-heading">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-blue-700 shadow-sm">
        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-blue-600" aria-hidden="true"></span>
        <?php esc_html_e('Reputation Intelligence', 'reviewservicepro'); ?>
      </span>

      <h2 class="mb-5 font-['Poppins',sans-serif] text-[clamp(34px,4.8vw,58px)] font-extrabold leading-[1.08] tracking-[-0.05em] text-[#07111F]">
        <span class="mb-3 block font-['Inter',sans-serif] text-[16px] font-normal tracking-normal text-slate-500 md:text-[18px]">
          <?php esc_html_e('See the signals behind your', 'reviewservicepro'); ?>
        </span>

        <span class="relative inline-block">
          <span class="relative z-10 bg-gradient-to-r from-blue-600 via-[#00C853] to-blue-500 bg-clip-text text-transparent">
            <?php esc_html_e('Reputation Score', 'reviewservicepro'); ?>
          </span>
          <span class="absolute inset-[-4px_-10px] z-0 rounded-lg border border-blue-200 bg-blue-50" aria-hidden="true"></span>
          <span class="ri-underline absolute -bottom-1 left-0 right-0 z-10 h-[2.5px] origin-left scale-x-0 rounded-full bg-gradient-to-r from-blue-600 via-[#00C853] to-transparent transition-transform duration-700" aria-hidden="true"></span>
        </span>

        <span class="mt-4 block font-['Inter',sans-serif] text-[16px] font-normal tracking-normal text-slate-500 md:text-[18px]">
          <?php esc_html_e('in one clear dashboard preview', 'reviewservicepro'); ?>
        </span>
      </h2>

      <p class="rsp-ri-main-text mx-auto max-w-2xl font-['Inter',sans-serif] text-slate-600">
        <?php esc_html_e('A monthly reputation intelligence view can help you understand rating trends, review volume, sentiment shifts, platform gaps, pending responses, and practical next steps.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="mb-10 grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-4" data-gsap-item="ri-stats" role="list">
      <?php foreach ($stats as $stat) : ?>
        <?php
        $target_number = preg_replace('/\D/', '', (string) $stat['target']);
        $target_number = '' !== $target_number ? $target_number : '0';
        ?>

        <div class="rsp-ri-card rsp-ri-motion-border group rounded-2xl border border-slate-200 bg-white px-5 py-6 text-left shadow-[0_18px_60px_rgba(15,23,42,0.08)] sm:text-center" role="listitem">
          <div class="absolute inset-x-0 top-0 h-[2px] opacity-80" style="background:<?php echo esc_attr($stat['color']); ?>;" aria-hidden="true"></div>

          <div class="rsp-ri-icon mb-4 flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 sm:mx-auto">
            <i data-lucide="<?php echo esc_attr($stat['icon']); ?>" class="h-5 w-5" style="color:<?php echo esc_attr($stat['color']); ?>;" aria-hidden="true"></i>
          </div>

          <p class="mb-2 font-['Poppins',sans-serif] text-[34px] font-extrabold leading-none text-[#07111F]">
            <span class="ri-counter" data-target="<?php echo esc_attr($target_number); ?>">0</span>
            <span class="font-['Inter',sans-serif] text-[16px] font-semibold" style="color:<?php echo esc_attr($stat['color']); ?>;">
              <?php echo esc_html($stat['suffix']); ?>
            </span>
          </p>

          <p class="rsp-ri-main-text mb-3 font-['Inter',sans-serif] text-slate-600">
            <?php echo esc_html($stat['label']); ?>
          </p>

          <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 font-['Inter',sans-serif] text-[13px] font-semibold <?php echo ! empty($stat['up']) ? 'border border-emerald-200 bg-emerald-50 text-emerald-700' : 'border border-slate-200 bg-slate-50 text-slate-600'; ?>">
            <?php echo ! empty($stat['up']) ? esc_html__('✓ ', 'reviewservicepro') : ''; ?>
            <?php echo esc_html($stat['trend']); ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>

    <div
      class="rsp-ri-dashboard-shell relative mb-10 rounded-[2rem] border border-slate-200 bg-white p-[2px] shadow-[0_30px_100px_rgba(15,23,42,0.12)]"
      data-gsap-item="ri-dashboard">
      <div class="rsp-ri-dashboard-inner overflow-hidden rounded-[calc(2rem-2px)] border border-slate-200 bg-white">

        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-5 py-4">
          <div class="flex items-center gap-1.5" aria-hidden="true">
            <span class="h-2.5 w-2.5 rounded-full bg-[#ff5f57]"></span>
            <span class="h-2.5 w-2.5 rounded-full bg-[#ffbd2e]"></span>
            <span class="h-2.5 w-2.5 rounded-full bg-[#28c840]"></span>
          </div>

          <span class="text-center font-['Inter',sans-serif] text-[12px] font-bold uppercase tracking-[0.13em] text-slate-500">
            <?php esc_html_e('Reputation Intelligence Dashboard Preview', 'reviewservicepro'); ?>
          </span>

          <span class="flex items-center gap-1.5 font-['Inter',sans-serif] text-[12px] font-semibold text-emerald-700">
            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#00C853]" aria-hidden="true"></span>
            <?php esc_html_e('Preview', 'reviewservicepro'); ?>
          </span>
        </div>

        <div class="p-5 md:p-7">

          <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4" role="list">
            <?php foreach ($dash_metrics as $dm) : ?>
              <div class="rsp-ri-card rounded-xl border border-slate-200 bg-slate-50 px-4 py-4" role="listitem">
                <p class="mb-2 font-['Inter',sans-serif] text-[13px] font-bold uppercase tracking-[0.08em] text-slate-500">
                  <?php echo esc_html($dm['label']); ?>
                </p>

                <p class="mb-1 font-['Poppins',sans-serif] text-[22px] font-bold" style="color:<?php echo esc_attr($dm['color']); ?>;">
                  <?php echo esc_html($dm['value']); ?>
                </p>

                <p class="font-['Inter',sans-serif] text-[14px]" style="color:<?php echo esc_attr($dm['sub_color']); ?>;">
                  <?php echo esc_html($dm['sub']); ?>
                </p>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="mb-5 grid grid-cols-1 gap-5 md:grid-cols-[auto_1fr]">

            <div class="rounded-xl border border-slate-200 bg-slate-50 px-6 py-5 text-center shadow-sm">
              <div class="relative mx-auto mb-3 h-[104px] w-[104px]">
                <svg class="h-[104px] w-[104px] -rotate-90" viewBox="0 0 90 90" aria-hidden="true" focusable="false">
                  <circle cx="45" cy="45" r="36" fill="none" stroke="rgba(15,23,42,0.08)" stroke-width="7" />
                  <circle cx="45" cy="45" r="36" fill="none" stroke="url(#riGrad)" stroke-width="7" stroke-dasharray="226" stroke-dashoffset="35" stroke-linecap="round" />
                  <defs>
                    <linearGradient id="riGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#2563eb" />
                      <stop offset="100%" stop-color="#00C853" />
                    </linearGradient>
                  </defs>
                </svg>

                <div class="absolute inset-0 flex flex-col items-center justify-center">
                  <span class="font-['Poppins',sans-serif] text-[26px] font-extrabold leading-none text-[#07111F]">87</span>
                  <span class="mt-1 font-['Inter',sans-serif] text-[13px] text-slate-500">
                    <?php esc_html_e('Score', 'reviewservicepro'); ?>
                  </span>
                </div>
              </div>

              <p class="font-['Inter',sans-serif] text-[14px] font-bold uppercase tracking-[0.10em] text-slate-500">
                <?php esc_html_e('Trust Index', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-5 shadow-sm">
              <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <span class="font-['Inter',sans-serif] text-[16px] font-semibold text-[#07111F]">
                  <?php esc_html_e('Review Volume — Last 6 Months', 'reviewservicepro'); ?>
                </span>

                <div class="flex items-center gap-4">
                  <span class="flex items-center gap-1.5 font-['Inter',sans-serif] text-[14px] text-slate-500">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                    <?php esc_html_e('Positive', 'reviewservicepro'); ?>
                  </span>

                  <span class="flex items-center gap-1.5 font-['Inter',sans-serif] text-[14px] text-slate-500">
                    <span class="h-1.5 w-1.5 rounded-full bg-red-500/70"></span>
                    <?php esc_html_e('Negative', 'reviewservicepro'); ?>
                  </span>
                </div>
              </div>

              <div class="flex h-28 items-end gap-1.5 overflow-hidden">
                <?php foreach ($chart_months as $month) : ?>
                  <div class="flex h-full flex-1 flex-col items-center gap-0.5">
                    <div class="flex w-full flex-1 flex-col justify-end gap-0.5">
                      <div class="rsp-ri-bar-negative w-full rounded-sm" style="height:<?php echo esc_attr(absint($month['neg'])); ?>%;background:rgba(239,68,68,0.38);"></div>
                      <div class="rsp-ri-bar-positive w-full rounded-sm" style="height:<?php echo esc_attr(absint($month['pos'])); ?>%;background:linear-gradient(to top,#2563EB,#3B82F6);"></div>
                    </div>

                    <span class="mt-1 font-['Inter',sans-serif] text-[13px] text-slate-500">
                      <?php echo esc_html($month['label']); ?>
                    </span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

          </div>

          <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4">
            <p class="mb-3 flex items-center gap-2 font-['Inter',sans-serif] text-[14px] font-bold uppercase tracking-[0.10em] text-emerald-700">
              <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#00C853]" aria-hidden="true"></span>
              <?php esc_html_e('Reputation insight alerts', 'reviewservicepro'); ?>
            </p>

            <?php foreach ($alerts as $alert) : ?>
              <div class="rsp-ri-alert-row flex items-center gap-3 rounded-xl border-b border-emerald-200/70 px-2 py-2.5 last:border-0">
                <span class="h-2 w-2 flex-shrink-0 rounded-full bg-[#00C853]"></span>

                <span class="flex-1 font-['Inter',sans-serif] text-[16px] leading-[1.7] text-emerald-950">
                  <?php echo esc_html($alert['text']); ?>
                </span>

                <span class="flex-shrink-0 font-['Inter',sans-serif] text-[14px] text-emerald-700/70">
                  <?php echo esc_html($alert['time']); ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="flex flex-wrap gap-2">
            <?php foreach ($platforms as $platform) : ?>
              <span class="rsp-ri-platform-pill inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-3 py-2 font-['Inter',sans-serif] text-[14px] text-slate-600">
                <span class="h-2 w-2 flex-shrink-0 rounded-full" style="background:<?php echo esc_attr($platform['color']); ?>;"></span>
                <?php echo esc_html($platform['name']); ?>
              </span>
            <?php endforeach; ?>
          </div>

        </div>
      </div>
    </div>

    <div class="mb-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-gsap-item="ri-metrics" role="list">
      <?php foreach ($key_metrics as $metric) : ?>
        <div class="rsp-ri-card rsp-ri-motion-border group flex items-start gap-4 rounded-2xl border border-slate-200 bg-white px-5 py-6 shadow-[0_14px_40px_rgba(15,23,42,0.06)]" role="listitem">
          <div
            class="rsp-ri-icon flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl border"
            style="background:<?php echo esc_attr($metric['color']); ?>12;border-color:<?php echo esc_attr($metric['color']); ?>30;">
            <i data-lucide="<?php echo esc_attr($metric['icon']); ?>" class="h-5 w-5" style="color:<?php echo esc_attr($metric['color']); ?>;" aria-hidden="true"></i>
          </div>

          <div>
            <h3 class="mb-2 font-['Poppins',sans-serif] text-[18px] font-bold leading-snug text-[#07111F]">
              <?php echo esc_html($metric['title']); ?>
            </h3>

            <p class="rsp-ri-main-text font-['Inter',sans-serif] text-slate-600">
              <?php echo esc_html($metric['desc']); ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="rsp-ri-cta-card mx-auto max-w-4xl rounded-[2rem] border border-slate-200 bg-white p-7 text-center shadow-[0_18px_60px_rgba(15,23,42,0.08)] sm:p-9" data-gsap-item="ri-cta">
      <p class="rsp-ri-main-text mb-7 font-['Inter',sans-serif] text-slate-600">
        <?php esc_html_e('Want to understand what your public reputation signals look like right now?', 'reviewservicepro'); ?>
      </p>

      <div class="flex flex-wrap items-center justify-center gap-4">
        <a
          href="<?php echo esc_url($primary_cta_url); ?>"
          class="rsp-ri-primary-btn inline-flex min-h-[56px] items-center gap-2 rounded-2xl bg-blue-600 px-7 py-3.5 font-['Inter',sans-serif] text-[16px] font-bold text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-200">
          <span class="relative z-10 inline-flex items-center gap-2">
            <i data-lucide="search" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Request a Reputation Review', 'reviewservicepro'); ?>
          </span>
        </a>

        <a
          href="<?php echo esc_url($secondary_cta_url); ?>"
          class="rsp-ri-secondary-btn inline-flex min-h-[56px] items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-7 py-3.5 font-['Inter',sans-serif] text-[16px] font-semibold text-slate-700 no-underline hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('View One-Time Packages', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>