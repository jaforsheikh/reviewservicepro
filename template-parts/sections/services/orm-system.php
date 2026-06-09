<?php

/**
 * Services Page ORM Service System Section
 *
 * File: template-parts/sections/services/orm-system.php
 *
 * ReviewService.Pro — AI-Driven ORM Service System
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$primary_cta_url   = '#monthly-plans';
$secondary_cta_url = '#one-time-packages';
$audit_cta_url     = home_url('/contact/?type=orm-audit');

$workflow_steps = [
  [
    'number' => '01',
    'label'  => __('Audit', 'reviewservicepro'),
    'icon'   => 'search-check',
  ],
  [
    'number' => '02',
    'label'  => __('Monitor', 'reviewservicepro'),
    'icon'   => 'radar',
  ],
  [
    'number' => '03',
    'label'  => __('Respond', 'reviewservicepro'),
    'icon'   => 'message-square',
  ],
  [
    'number' => '04',
    'label'  => __('Improve', 'reviewservicepro'),
    'icon'   => 'trending-up',
  ],
  [
    'number' => '05',
    'label'  => __('Report', 'reviewservicepro'),
    'icon'   => 'file-text',
  ],
];

$workflow_metrics = [
  [
    'label'  => __('Selected Platforms', 'reviewservicepro'),
    'value'  => 10,
    'prefix' => '2–',
    'suffix' => '+',
    'tag'    => __('Platforms covered', 'reviewservicepro'),
    'tone'   => 'emerald',
  ],
  [
    'label'  => __('Response Support', 'reviewservicepro'),
    'value'  => 50,
    'prefix' => '5–',
    'suffix' => '',
    'tag'    => __('Reviews / month', 'reviewservicepro'),
    'tone'   => 'blue',
  ],
  [
    'label'      => __('Monthly Reports', 'reviewservicepro'),
    'value_text' => __('Yes', 'reviewservicepro'),
    'tag'        => __('Every month', 'reviewservicepro'),
    'tone'       => 'gold',
  ],
];

$service_system_items = [
  [
    'number'    => '01',
    'title'     => __('Reputation Audit', 'reviewservicepro'),
    'text'      => __('We review your rating profile, review volume, response gaps, negative review risks, platform visibility, and customer trust signals.', 'reviewservicepro'),
    'outcome'   => __('Know what needs attention first.', 'reviewservicepro'),
    'tone'      => 'blue',
    'image'     => 'assets/images/services/orm-system/reputation-audit.webp',
    'image_alt' => __('Reputation audit dashboard and trust signal analysis visual', 'reviewservicepro'),
  ],
  [
    'number'    => '02',
    'title'     => __('AI-Assisted Review Monitoring', 'reviewservicepro'),
    'text'      => __('We monitor selected review platforms so new feedback, rating changes, and reputation risks are easier to track consistently.', 'reviewservicepro'),
    'outcome'   => __('Never miss important feedback.', 'reviewservicepro'),
    'tone'      => 'teal',
    'image'     => 'assets/images/services/orm-system/ai-assisted-review-monitoring.webp',
    'image_alt' => __('AI assisted review monitoring dashboard visual', 'reviewservicepro'),
  ],
  [
    'number'    => '03',
    'title'     => __('Review Response Management', 'reviewservicepro'),
    'text'      => __('We prepare calm, professional, brand-safe responses for positive, neutral, and negative customer reviews.', 'reviewservicepro'),
    'outcome'   => __('Turn responses into trust signals.', 'reviewservicepro'),
    'tone'      => 'green',
    'image'     => 'assets/images/services/orm-system/review-response-management.webp',
    'image_alt' => __('Professional review response management workflow visual', 'reviewservicepro'),
  ],
  [
    'number'    => '04',
    'title'     => __('Negative Review Case Support', 'reviewservicepro'),
    'text'      => __('We help identify, document, respond to, and report reviews that may violate platform policies when appropriate.', 'reviewservicepro'),
    'outcome'   => __('Handle negative cases safely.', 'reviewservicepro'),
    'tone'      => 'red',
    'image'     => 'assets/images/services/orm-system/negative-review-case-support.webp',
    'image_alt' => __('Negative review case support documentation visual', 'reviewservicepro'),
  ],
  [
    'number'    => '05',
    'title'     => __('Genuine Feedback Request System', 'reviewservicepro'),
    'text'      => __('We help create ethical feedback request workflows so real customers can share real experiences without pressure or incentives.', 'reviewservicepro'),
    'outcome'   => __('Encourage genuine customer feedback.', 'reviewservicepro'),
    'tone'      => 'purple',
    'image'     => 'assets/images/services/orm-system/genuine-feedback-request-system.webp',
    'image_alt' => __('Genuine customer feedback request workflow visual', 'reviewservicepro'),
  ],
  [
    'number'    => '06',
    'title'     => __('Platform Profile Optimization', 'reviewservicepro'),
    'text'      => __('We review platform profile quality, business details, trust elements, review freshness, and consistency across important platforms.', 'reviewservicepro'),
    'outcome'   => __('Improve customer-facing trust signals.', 'reviewservicepro'),
    'tone'      => 'gold',
    'image'     => 'assets/images/services/orm-system/platform-profile-optimization.webp',
    'image_alt' => __('Platform profile optimization and trust signal improvement visual', 'reviewservicepro'),
  ],
  [
    'number'    => '07',
    'title'     => __('Monthly Reputation Reporting', 'reviewservicepro'),
    'text'      => __('We summarize review activity, response work, risk areas, platform performance, and recommended next actions every month.', 'reviewservicepro'),
    'outcome'   => __('See progress clearly.', 'reviewservicepro'),
    'tone'      => 'orange',
    'image'     => 'assets/images/services/orm-system/monthly-reputation-reporting.webp',
    'image_alt' => __('Monthly reputation reporting dashboard visual', 'reviewservicepro'),
  ],
  [
    'number'    => '08',
    'title'     => __('Local Trust Signal Support', 'reviewservicepro'),
    'text'      => __('We support local trust through profile quality, Google Business Profile reputation management, review response consistency, review freshness, and reputation visibility signals.', 'reviewservicepro'),
    'outcome'   => __('Strengthen local business trust.', 'reviewservicepro'),
    'tone'      => 'slate',
    'image'     => 'assets/images/services/orm-system/local-trust-signal-support.webp',
    'image_alt' => __('Local trust signal support for reputation management visual', 'reviewservicepro'),
  ],
];

$trust_checks = [
  __('No fake reviews', 'reviewservicepro'),
  __('No paid review incentives', 'reviewservicepro'),
  __('Platform-compliant workflow', 'reviewservicepro'),
];

$tone_classes = [
  'blue' => [
    'border'   => 'border-t-[#1E3A8A]',
    'image'    => 'border-blue-100 bg-blue-50',
    'fallback' => 'from-blue-50 via-white to-blue-100 text-blue-700',
    'pill'     => 'bg-blue-50 text-blue-700',
    'glow'     => 'bg-blue-400/10',
    'line'     => 'from-blue-600 via-blue-400 to-transparent',
  ],
  'teal' => [
    'border'   => 'border-t-[#14B8A6]',
    'image'    => 'border-teal-100 bg-teal-50',
    'fallback' => 'from-teal-50 via-white to-teal-100 text-teal-700',
    'pill'     => 'bg-teal-50 text-teal-700',
    'glow'     => 'bg-teal-400/10',
    'line'     => 'from-teal-500 via-teal-400 to-transparent',
  ],
  'green' => [
    'border'   => 'border-t-[#00C853]',
    'image'    => 'border-emerald-100 bg-emerald-50',
    'fallback' => 'from-emerald-50 via-white to-emerald-100 text-emerald-700',
    'pill'     => 'bg-emerald-50 text-emerald-700',
    'glow'     => 'bg-emerald-400/10',
    'line'     => 'from-emerald-500 via-emerald-400 to-transparent',
  ],
  'red' => [
    'border'   => 'border-t-red-500',
    'image'    => 'border-red-100 bg-red-50',
    'fallback' => 'from-red-50 via-white to-red-100 text-red-700',
    'pill'     => 'bg-red-50 text-red-700',
    'glow'     => 'bg-red-400/10',
    'line'     => 'from-red-500 via-red-400 to-transparent',
  ],
  'purple' => [
    'border'   => 'border-t-violet-600',
    'image'    => 'border-violet-100 bg-violet-50',
    'fallback' => 'from-violet-50 via-white to-violet-100 text-violet-700',
    'pill'     => 'bg-violet-50 text-violet-700',
    'glow'     => 'bg-violet-400/10',
    'line'     => 'from-violet-500 via-violet-400 to-transparent',
  ],
  'gold' => [
    'border'   => 'border-t-[#FFC107]',
    'image'    => 'border-amber-100 bg-amber-50',
    'fallback' => 'from-amber-50 via-white to-amber-100 text-amber-700',
    'pill'     => 'bg-amber-50 text-amber-700',
    'glow'     => 'bg-amber-400/10',
    'line'     => 'from-amber-500 via-amber-400 to-transparent',
  ],
  'orange' => [
    'border'   => 'border-t-orange-600',
    'image'    => 'border-orange-100 bg-orange-50',
    'fallback' => 'from-orange-50 via-white to-orange-100 text-orange-700',
    'pill'     => 'bg-orange-50 text-orange-700',
    'glow'     => 'bg-orange-400/10',
    'line'     => 'from-orange-500 via-orange-400 to-transparent',
  ],
  'slate' => [
    'border'   => 'border-t-slate-500',
    'image'    => 'border-slate-100 bg-slate-50',
    'fallback' => 'from-slate-50 via-white to-slate-100 text-slate-700',
    'pill'     => 'bg-slate-100 text-slate-700',
    'glow'     => 'bg-slate-400/10',
    'line'     => 'from-slate-500 via-slate-400 to-transparent',
  ],
];
?>

<style>
  #orm-service-system {
    --rsp-orm-title: #334155;
    --rsp-orm-heading: #3B4658;
    --rsp-orm-body: #64748B;
    --rsp-orm-blue: #2563EB;
    --rsp-orm-green: #00C853;
  }

  #orm-service-system .rsp-orm-title {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-orm-title);
  }

  #orm-service-system .rsp-orm-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-orm-heading);
  }

  #orm-service-system .rsp-orm-text {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.78;
    color: var(--rsp-orm-body);
  }

  #orm-service-system .rsp-orm-body {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.78;
    color: var(--rsp-orm-body);
  }

  .rsp-orm-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition:
      opacity 650ms ease,
      transform 650ms ease,
      box-shadow 280ms ease,
      border-color 280ms ease;
  }

  .rsp-orm-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-orm-card:nth-child(1) {
    transition-delay: 0ms;
  }

  .rsp-orm-card:nth-child(2) {
    transition-delay: 80ms;
  }

  .rsp-orm-card:nth-child(3) {
    transition-delay: 160ms;
  }

  .rsp-orm-card:nth-child(4) {
    transition-delay: 240ms;
  }

  .rsp-orm-card:nth-child(5) {
    transition-delay: 40ms;
  }

  .rsp-orm-card:nth-child(6) {
    transition-delay: 120ms;
  }

  .rsp-orm-card:nth-child(7) {
    transition-delay: 200ms;
  }

  .rsp-orm-card:nth-child(8) {
    transition-delay: 280ms;
  }

  .rsp-orm-step-icon {
    transition:
      background-color 420ms ease,
      border-color 420ms ease,
      box-shadow 420ms ease,
      color 420ms ease;
  }

  .rsp-orm-step-fill {
    width: 0%;
    transition: width 520ms ease;
  }

  .rsp-orm-step.is-active .rsp-orm-step-icon {
    background: #E8FFF0;
    border-color: #00C853;
    color: #00A844;
    box-shadow: 0 0 0 4px rgba(0, 200, 83, 0.12);
  }

  .rsp-orm-step.is-done .rsp-orm-step-icon {
    background: #00C853;
    border-color: #00A844;
    color: #ffffff;
  }

  .rsp-orm-step.is-active .rsp-orm-step-label,
  .rsp-orm-step.is-done .rsp-orm-step-label {
    color: #334155;
  }

  #orm-service-system .rsp-orm-motion-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 360ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #orm-service-system .rsp-orm-motion-card::before {
    content: "";
    position: absolute;
    inset: -80%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.08),
        rgba(0, 200, 83, 0.26),
        rgba(20, 184, 166, 0.20),
        rgba(139, 92, 246, 0.20),
        rgba(37, 99, 235, 0.08));
    opacity: 0.72;
    transform: rotate(0deg);
    animation: rspOrmBorderSpin 8s linear infinite;
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  #orm-service-system .rsp-orm-motion-card::after {
    content: "";
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: #ffffff;
    pointer-events: none;
  }

  #orm-service-system .rsp-orm-motion-card:hover {
    transform: translateY(-8px);
    border-color: rgba(37, 99, 235, 0.22);
    box-shadow: 0 26px 80px rgba(15, 23, 42, 0.12);
  }

  #orm-service-system .rsp-orm-motion-card:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  #orm-service-system .rsp-orm-card-image {
    width: 100%;
    aspect-ratio: 16 / 10;
    border-radius: 1.15rem;
    transition:
      transform 520ms cubic-bezier(0.2, 0.9, 0.2, 1),
      filter 320ms ease,
      box-shadow 320ms ease;
  }

  #orm-service-system .rsp-orm-card-image img {
    display: block;
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 680ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #orm-service-system .rsp-orm-motion-card:hover .rsp-orm-card-image {
    transform: translateY(-3px) scale(1.015);
    filter: saturate(1.06);
    box-shadow: 0 18px 42px rgba(15, 23, 42, 0.10);
  }

  #orm-service-system .rsp-orm-motion-card:hover .rsp-orm-card-image img {
    transform: scale(1.08);
  }

  #orm-service-system .rsp-orm-fallback {
    display: flex;
    height: 100%;
    width: 100%;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .rsp-orm-shield-pulse {
    animation: rspOrmShieldPulse 3s ease-in-out infinite;
  }

  @keyframes rspOrmBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes rspOrmShieldPulse {

    0%,
    100% {
      box-shadow: 0 0 0 0 rgba(0, 200, 83, 0);
      transform: scale(1);
    }

    50% {
      box-shadow: 0 0 0 16px rgba(0, 200, 83, 0.10);
      transform: scale(1.04);
    }
  }

  @media (max-width: 1024px) {
    #orm-service-system .rsp-orm-card-image {
      aspect-ratio: 16 / 9;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #orm-service-system *,
    #orm-service-system *::before,
    #orm-service-system *::after,
    #orm-system-ethical-commitment *,
    #orm-system-ethical-commitment *::before,
    #orm-system-ethical-commitment *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      scroll-behavior: auto !important;
      transition-duration: 0.001ms !important;
    }

    .rsp-orm-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-orm-step-fill {
      width: 100%;
      transition: none;
    }

    .rsp-orm-shield-pulse {
      animation: none;
    }

    #orm-service-system .rsp-orm-motion-card:hover,
    #orm-service-system .rsp-orm-motion-card:hover .rsp-orm-card-image {
      transform: none;
    }

    #orm-service-system .rsp-orm-motion-card:hover .rsp-orm-card-image img {
      transform: none;
    }
  }
</style>

<section
  id="orm-service-system"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F7F9F8] py-20 md:py-28"
  aria-labelledby="orm-service-system-title"
  data-gsap="services-orm-system">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle,rgba(0,200,83,0.12)_1px,transparent_1px)] bg-[size:28px_28px]"></div>
  <div class="pointer-events-none absolute -left-28 -top-28 z-0 h-[480px] w-[480px] rounded-full bg-emerald-300/20 blur-[120px]"></div>
  <div class="pointer-events-none absolute -bottom-28 right-[5%] z-0 h-[360px] w-[360px] rounded-full bg-blue-300/20 blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-1 gap-12 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">

      <div class="rsp-orm-reveal" data-rsp-orm-animate>
        <span class="mb-6 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.14em] text-emerald-700 shadow-sm">
          <i data-lucide="network" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Complete AI-Driven ORM Service System', 'reviewservicepro'); ?>
        </span>

        <h2
          id="orm-service-system-title"
          class="rsp-orm-title max-w-4xl text-3xl font-extrabold leading-tight tracking-[-0.03em] md:text-4xl lg:text-5xl">
          <?php esc_html_e('Online reputation management is a system — not just review tracking.', 'reviewservicepro'); ?>
        </h2>

        <p class="rsp-orm-text mt-5 max-w-2xl">
          <?php esc_html_e('Our AI-Driven Online Reputation Management system combines reputation audits, AI-assisted review monitoring, review response management, negative review case support, genuine feedback request workflows, platform profile optimization, local trust signal support, and monthly reporting.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 rounded-[1.5rem] border border-blue-200 bg-blue-50 p-5">
          <h3 class="rsp-orm-heading flex items-center gap-2 text-lg font-extrabold">
            <i data-lucide="search-check" class="h-5 w-5 text-blue-700" aria-hidden="true"></i>
            <?php esc_html_e('What is an online reputation management system?', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-2 text-base font-medium leading-8 text-blue-900">
            <?php esc_html_e('An online reputation management system helps businesses audit reputation risks, monitor review platforms, respond professionally, support genuine feedback requests, improve profile trust signals, and report progress consistently.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
          <a
            href="<?php echo esc_url($primary_cta_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#1E3A8A] px-7 py-4 text-sm font-extrabold text-white shadow-lg shadow-blue-900/20 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
            <?php esc_html_e('View Monthly Plans', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($secondary_cta_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-7 py-4 text-sm font-extrabold text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:border-[#14B8A6]/40 hover:bg-teal-50 hover:text-teal-700 focus:outline-none focus:ring-4 focus:ring-teal-500/10">
            <i data-lucide="package-check" class="h-5 w-5" aria-hidden="true"></i>
            <?php esc_html_e('Start With One-Time Package', 'reviewservicepro'); ?>
          </a>
        </div>
      </div>

      <div class="rsp-orm-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-2xl shadow-slate-900/10" data-rsp-orm-animate data-rsp-delay="120">

        <div class="border-b border-slate-200 px-5 py-5 md:px-6">
          <p class="font-mono text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
            <?php esc_html_e('ORM Workflow Engine', 'reviewservicepro'); ?>
          </p>

          <h3 class="rsp-orm-heading mt-2 flex items-center gap-2 text-xl font-extrabold">
            <i data-lucide="activity" class="h-5 w-5 text-[#00C853]" aria-hidden="true"></i>
            <?php esc_html_e('Audit → Monitor → Respond → Improve → Report', 'reviewservicepro'); ?>
          </h3>
        </div>

        <div class="px-4 py-6 md:px-6" data-rsp-orm-stepper>
          <div class="flex items-start gap-0" aria-label="<?php esc_attr_e('Five-step online reputation management workflow', 'reviewservicepro'); ?>">

            <?php foreach ($workflow_steps as $index => $step) : ?>
              <div class="flex flex-1 items-start">
                <div
                  class="rsp-orm-step flex flex-1 flex-col items-center"
                  data-rsp-step="<?php echo esc_attr($index + 1); ?>">

                  <div class="rsp-orm-step-icon flex h-11 w-11 items-center justify-center rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-400">
                    <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
                  </div>

                  <span class="mt-2 font-mono text-[10px] font-bold text-slate-400">
                    <?php echo esc_html($step['number']); ?>
                  </span>

                  <span class="rsp-orm-step-label mt-1 text-center text-xs font-bold text-slate-400">
                    <?php echo esc_html($step['label']); ?>
                  </span>
                </div>

                <?php if ($index < count($workflow_steps) - 1) : ?>
                  <div class="mt-[1.35rem] h-0.5 flex-1 overflow-hidden rounded-full bg-slate-200">
                    <div
                      class="rsp-orm-step-fill h-full rounded-full bg-gradient-to-r from-[#00C853] to-[#14B8A6]"
                      data-rsp-fill="<?php echo esc_attr($index + 1); ?>"></div>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>

          </div>
        </div>

        <div class="grid grid-cols-1 divide-y divide-slate-200 border-t border-slate-200 sm:grid-cols-3 sm:divide-x sm:divide-y-0">
          <?php foreach ($workflow_metrics as $metric) : ?>
            <?php
            $metric_tone = $metric['tone'];

            $metric_value_class = 'text-[#00C853]';
            $metric_tag_class   = 'bg-emerald-50 text-emerald-700';

            if ('blue' === $metric_tone) {
              $metric_value_class = 'text-[#1E3A8A]';
              $metric_tag_class   = 'bg-blue-50 text-blue-700';
            } elseif ('gold' === $metric_tone) {
              $metric_value_class = 'text-[#FFC107]';
              $metric_tag_class   = 'bg-amber-50 text-amber-700';
            }
            ?>

            <div class="bg-white p-5">
              <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-400">
                <?php echo esc_html($metric['label']); ?>
              </p>

              <p class="<?php echo esc_attr($metric_value_class); ?> mt-2 font-['Poppins'] text-3xl font-extrabold leading-none">
                <?php if (isset($metric['value_text'])) : ?>
                  <?php echo esc_html($metric['value_text']); ?>
                <?php else : ?>
                  <span
                    data-rsp-orm-count
                    data-target="<?php echo esc_attr($metric['value']); ?>"
                    data-prefix="<?php echo esc_attr($metric['prefix']); ?>"
                    data-suffix="<?php echo esc_attr($metric['suffix']); ?>">
                    <?php echo esc_html($metric['prefix']); ?>0<?php echo esc_html($metric['suffix']); ?>
                  </span>
                <?php endif; ?>
              </p>

              <span class="<?php echo esc_attr($metric_tag_class); ?> mt-3 inline-flex rounded-lg px-2.5 py-1 text-xs font-extrabold">
                <?php echo esc_html($metric['tag']); ?>
              </span>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>

    <div class="rsp-orm-reveal mx-auto mt-20 max-w-4xl text-center" data-rsp-orm-animate>
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.14em] text-emerald-700 shadow-sm">
        <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e("What's Included", 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-orm-title text-3xl font-extrabold leading-tight tracking-[-0.03em] md:text-4xl">
        <?php esc_html_e('8 systems working together for your reputation', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-orm-text mx-auto mt-4 max-w-2xl">
        <?php esc_html_e('Each service plays a specific role. Together they form a complete, ethical reputation management system — not a patchwork of one-off fixes.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($service_system_items as $item) : ?>
        <?php
        $item_tone = $tone_classes[$item['tone']] ?? $tone_classes['blue'];
        $image_path = get_theme_file_path($item['image']);
        $image_url  = get_theme_file_uri($item['image']);
        $has_image  = file_exists($image_path);
        ?>

        <article
          class="rsp-orm-reveal rsp-orm-card rsp-orm-motion-card <?php echo esc_attr($item_tone['border']); ?> relative rounded-[1.5rem] border border-t-[3px] border-slate-200 bg-white p-4 shadow-sm"
          data-rsp-orm-animate>

          <div class="<?php echo esc_attr($item_tone['glow']); ?> pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="absolute inset-x-0 top-0 h-[3px] rounded-t-[1.5rem] bg-gradient-to-r <?php echo esc_attr($item_tone['line']); ?>" aria-hidden="true"></div>

          <div class="relative z-10">
            <div class="rsp-orm-card-image mb-5 overflow-hidden border <?php echo esc_attr($item_tone['image']); ?>">
              <?php if ($has_image) : ?>
                <img
                  src="<?php echo esc_url($image_url); ?>"
                  alt="<?php echo esc_attr($item['image_alt']); ?>"
                  loading="lazy"
                  decoding="async"
                  width="800"
                  height="520">
              <?php else : ?>
                <span class="rsp-orm-fallback bg-gradient-to-br <?php echo esc_attr($item_tone['fallback']); ?> px-4 font-['DM_Mono',monospace] text-[13px] font-[800] uppercase tracking-[0.12em]">
                  <?php echo esc_html($item['number']); ?>
                </span>
              <?php endif; ?>
            </div>

            <div class="mb-4 flex items-center justify-between gap-4">
              <span class="font-mono text-xs font-bold text-slate-300">
                <?php echo esc_html($item['number']); ?>
              </span>
            </div>

            <h3 class="rsp-orm-heading pr-4 text-lg font-extrabold leading-snug">
              <?php echo esc_html($item['title']); ?>
            </h3>

            <p class="rsp-orm-body mt-3">
              <?php echo esc_html($item['text']); ?>
            </p>

            <div class="mt-5">
              <p class="mb-2 font-mono text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">
                <?php esc_html_e('Outcome', 'reviewservicepro'); ?>
              </p>

              <span class="<?php echo esc_attr($item_tone['pill']); ?> inline-flex items-start gap-2 rounded-xl px-3 py-2 text-sm font-extrabold leading-6">
                <i data-lucide="check" class="mt-0.5 h-4 w-4 shrink-0" aria-hidden="true"></i>
                <?php echo esc_html($item['outcome']); ?>
              </span>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<section
  id="orm-system-ethical-commitment"
  class="relative overflow-hidden bg-[#0D0F12] py-20 md:py-24"
  aria-labelledby="orm-system-ethical-title">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle,rgba(0,200,83,0.18)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
  <div class="pointer-events-none absolute -left-28 -top-48 z-0 h-[520px] w-[520px] rounded-full bg-[#00C853]/20 blur-[130px]"></div>
  <div class="pointer-events-none absolute -bottom-40 -right-20 z-0 h-[420px] w-[420px] rounded-full bg-[#1E3A8A]/30 blur-[130px]"></div>

  <div class="rsp-orm-reveal relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8" data-rsp-orm-animate>

    <span class="mb-7 inline-flex items-center gap-2 rounded-full border border-emerald-400/25 bg-emerald-400/10 px-5 py-2 text-xs font-extrabold uppercase tracking-[0.14em] text-emerald-200">
      <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
      <?php esc_html_e('Ethical ORM Commitment', 'reviewservicepro'); ?>
    </span>

    <div class="rsp-orm-shield-pulse mx-auto mb-7 flex h-[72px] w-[72px] items-center justify-center rounded-[1.4rem] border border-emerald-400/25 bg-emerald-400/10 text-emerald-200">
      <i data-lucide="shield-check" class="h-9 w-9" aria-hidden="true"></i>
    </div>

    <h2
      id="orm-system-ethical-title"
      class="font-['Poppins'] text-3xl text-white! font-extrabold leading-tight tracking-[-0.03em] md:text-5xl">
      <?php esc_html_e('A reputation system should', 'reviewservicepro'); ?>
      <span class="block text-emerald-300">
        <?php esc_html_e('build trust safely.', 'reviewservicepro'); ?>
      </span>
    </h2>

    <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-white/65">
      <?php esc_html_e('We do not use fake reviews, paid review incentives, review manipulation, or guaranteed removal claims. Our work focuses on genuine feedback, professional responses, platform-compliant documentation, transparent reporting, and long-term trust improvement.', 'reviewservicepro'); ?>
    </p>

    <div class="mt-8 flex flex-wrap items-center justify-center gap-x-7 gap-y-3">
      <?php foreach ($trust_checks as $check) : ?>
        <span class="inline-flex items-center gap-2 text-sm font-semibold text-white/80">
          <i data-lucide="check" class="h-4 w-4 text-emerald-300" aria-hidden="true"></i>
          <?php echo esc_html($check); ?>
        </span>
      <?php endforeach; ?>
    </div>

    <a
      href="<?php echo esc_url($audit_cta_url); ?>"
      class="mt-9 inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-7 py-4 text-sm font-extrabold text-[#0D0F12] shadow-lg shadow-emerald-900/25 transition-all duration-300 hover:-translate-y-1 hover:bg-[#00C853] hover:text-white focus:outline-none focus:ring-4 focus:ring-emerald-400/25">
      <?php esc_html_e('Request ORM Audit', 'reviewservicepro'); ?>
      <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
    </a>

    <p class="mt-7 font-mono text-xs uppercase tracking-[0.14em] text-white/35">
      <?php esc_html_e('Built for ethical reputation management across important review platforms', 'reviewservicepro'); ?>
    </p>

  </div>
</section>

<script>
  (function() {
    function countUp(element) {
      var target = parseInt(element.getAttribute('data-target'), 10);
      var prefix = element.getAttribute('data-prefix') || '';
      var suffix = element.getAttribute('data-suffix') || '';
      var duration = 1250;
      var startTime = null;

      if (isNaN(target)) {
        return;
      }

      if (element.dataset.rspOrmCounted === 'true') {
        return;
      }

      element.dataset.rspOrmCounted = 'true';

      function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
      }

      function step(timestamp) {
        if (!startTime) {
          startTime = timestamp;
        }

        var progress = Math.min((timestamp - startTime) / duration, 1);
        var value = Math.round(easeOutCubic(progress) * target);

        element.textContent = prefix + value + suffix;

        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          element.textContent = prefix + target + suffix;
        }
      }

      window.requestAnimationFrame(step);
    }

    function runStepper(stepper) {
      if (!stepper || stepper.dataset.rspOrmStepperDone === 'true') {
        return;
      }

      stepper.dataset.rspOrmStepperDone = 'true';

      var steps = stepper.querySelectorAll('[data-rsp-step]');
      var fills = stepper.querySelectorAll('[data-rsp-fill]');

      steps.forEach(function(step, index) {
        setTimeout(function() {
          if (index > 0) {
            var previous = steps[index - 1];

            if (previous) {
              previous.classList.remove('is-active');
              previous.classList.add('is-done');
            }

            var fill = fills[index - 1];

            if (fill) {
              fill.style.width = '100%';
            }
          }

          step.classList.add('is-active');

          if (index === steps.length - 1) {
            setTimeout(function() {
              step.classList.remove('is-active');
              step.classList.add('is-done');
            }, 650);
          }
        }, index * 520);
      });
    }

    function revealItem(item) {
      if (!item || item.dataset.rspOrmAnimated === 'true') {
        return;
      }

      item.dataset.rspOrmAnimated = 'true';

      var delay = parseInt(item.getAttribute('data-rsp-delay') || '0', 10);

      setTimeout(function() {
        item.classList.add('rsp-visible');

        item.querySelectorAll('[data-rsp-orm-count]').forEach(countUp);

        item.querySelectorAll('[data-rsp-orm-stepper]').forEach(runStepper);
      }, delay);
    }

    function initOrmSystemAnimations() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-orm-animate]');
      var steppers = document.querySelectorAll('[data-rsp-orm-stepper]');

      if (!items.length && !steppers.length) {
        return;
      }

      if (!('IntersectionObserver' in window)) {
        items.forEach(revealItem);
        steppers.forEach(runStepper);
        return;
      }

      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            revealItem(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.14,
        rootMargin: '0px 0px -40px 0px'
      });

      items.forEach(function(item) {
        observer.observe(item);
      });

      var stepObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            runStepper(entry.target);
            stepObserver.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.3
      });

      steppers.forEach(function(stepper) {
        stepObserver.observe(stepper);
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initOrmSystemAnimations);
    } else {
      initOrmSystemAnimations();
    }
  })();
</script>