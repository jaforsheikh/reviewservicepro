<?php

/**
 * Home Section: Services Overview
 *
 * File: template-parts/sections/home/services-overview.php
 *
 * White SaaS premium services overview section for ReviewService.Pro.
 *
 * Preserved hooks/targets:
 * - id="services-overview"
 * - data-gsap="services-animate"
 * - data-gsap-item="svc-intro"
 * - data-gsap-item="svc-cards"
 * - data-gsap-item="svc-timeline"
 * - data-gsap-item="svc-ethical"
 * - id="orm-timeline"
 * - orm-timeline-progress
 * - orm-tl-step
 * - orm-tl-icon
 * - orm-tl-icon-color
 * - orm-tl-label
 * - orm-tl-desc
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$img_base        = trailingslashit(get_template_directory_uri()) . 'assets/images/home/services-overview/';
$img_dashboard   = $img_base . 'orm-services-dashboard-preview.webp';
$img_timeline_bg = $img_base . 'orm-workflow-timeline-bg.webp';
$img_ethical     = $img_base . 'ethical-reputation-support-team.webp';

$services = array(
  array(
    'number'  => '01',
    'accent'  => 'blue',
    'icon'    => 'scan-search',
    'title'   => __('Reputation Audit & Intelligence', 'reviewservicepro'),
    'desc'    => __('Understand your reputation health, review gaps, customer sentiment, and competitor position before making decisions.', 'reviewservicepro'),
    'outcome' => __('Know what to fix first.', 'reviewservicepro'),
    'link'    => home_url('/services/reputation-audit/'),
    'img'     => 'reputation-audit-consultation.webp',
    'img_alt' => __('Reputation audit consultation session with reputation report dashboard', 'reviewservicepro'),
  ),
  array(
    'number'  => '02',
    'accent'  => 'emerald',
    'icon'    => 'radar',
    'title'   => __('Review Monitoring', 'reviewservicepro'),
    'desc'    => __('Track customer reviews across Google, Facebook, Trustpilot, Yelp, Tripadvisor, and other important platforms.', 'reviewservicepro'),
    'outcome' => __('Never miss important feedback.', 'reviewservicepro'),
    'link'    => home_url('/services/review-monitoring/'),
    'img'     => 'orm-services-dashboard-preview.webp',
    'img_alt' => __('Online review monitoring dashboard with platform alerts', 'reviewservicepro'),
  ),
  array(
    'number'  => '03',
    'accent'  => 'gold',
    'icon'    => 'message-square-text',
    'title'   => __('Review Response Strategy', 'reviewservicepro'),
    'desc'    => __('Create professional, brand-safe responses for positive, neutral, and negative customer reviews.', 'reviewservicepro'),
    'outcome' => __('Turn responses into trust signals.', 'reviewservicepro'),
    'link'    => home_url('/services/review-response-strategy/'),
    'img'     => 'review-response-workflow-team.webp',
    'img_alt' => __('Professional team preparing review response workflow', 'reviewservicepro'),
  ),
  array(
    'number'  => '04',
    'accent'  => 'purple',
    'icon'    => 'messages-square',
    'title'   => __('Customer Feedback System', 'reviewservicepro'),
    'desc'    => __('Build ethical feedback workflows that help real customers share real experiences without manipulation.', 'reviewservicepro'),
    'outcome' => __('Collect better customer insights.', 'reviewservicepro'),
    'link'    => home_url('/services/customer-feedback-system/'),
    'img'     => 'client-reputation-report-meeting.webp',
    'img_alt' => __('Client reputation report meeting and customer feedback workflow', 'reviewservicepro'),
  ),
  array(
    'number'  => '05',
    'accent'  => 'cyan',
    'icon'    => 'map-pin-check',
    'title'   => __('Local Trust Growth', 'reviewservicepro'),
    'desc'    => __('Strengthen local reputation signals that support customer confidence and local business visibility.', 'reviewservicepro'),
    'outcome' => __('Look more trusted locally.', 'reviewservicepro'),
    'link'    => home_url('/services/local-trust-growth/'),
    'img'     => 'ethical-reputation-support-team.webp',
    'img_alt' => __('Professional reputation support team reviewing local trust signals', 'reviewservicepro'),
  ),
  array(
    'number'  => '06',
    'accent'  => 'orange',
    'icon'    => 'bar-chart-3',
    'title'   => __('Reporting & Consultation', 'reviewservicepro'),
    'desc'    => __('Get clear monthly insights, reputation score tracking, platform performance, and strategy recommendations.', 'reviewservicepro'),
    'outcome' => __('Make decisions with data.', 'reviewservicepro'),
    'link'    => home_url('/services/reporting-consultation/'),
    'img'     => 'orm-workflow-timeline-bg.webp',
    'img_alt' => __('ORM workflow and reputation reporting illustration', 'reviewservicepro'),
  ),
);

$accent_classes = array(
  'blue'    => array(
    'text'   => 'text-[#2563EB]',
    'bg'     => 'bg-blue-50',
    'border' => 'border-blue-100',
    'hover'  => 'hover:border-blue-200',
    'bar'    => 'from-blue-500 via-blue-400 to-transparent',
    'inner'  => '#FFFFFF',
  ),
  'emerald' => array(
    'text'   => 'text-[#059669]',
    'bg'     => 'bg-emerald-50',
    'border' => 'border-emerald-100',
    'hover'  => 'hover:border-emerald-200',
    'bar'    => 'from-emerald-500 via-emerald-400 to-transparent',
    'inner'  => '#FFFFFF',
  ),
  'gold'    => array(
    'text'   => 'text-[#D97706]',
    'bg'     => 'bg-amber-50',
    'border' => 'border-amber-100',
    'hover'  => 'hover:border-amber-200',
    'bar'    => 'from-amber-500 via-amber-400 to-transparent',
    'inner'  => '#FFFFFF',
  ),
  'purple'  => array(
    'text'   => 'text-[#7C3AED]',
    'bg'     => 'bg-violet-50',
    'border' => 'border-violet-100',
    'hover'  => 'hover:border-violet-200',
    'bar'    => 'from-violet-500 via-violet-400 to-transparent',
    'inner'  => '#FFFFFF',
  ),
  'cyan'    => array(
    'text'   => 'text-[#0891B2]',
    'bg'     => 'bg-cyan-50',
    'border' => 'border-cyan-100',
    'hover'  => 'hover:border-cyan-200',
    'bar'    => 'from-cyan-500 via-cyan-400 to-transparent',
    'inner'  => '#FFFFFF',
  ),
  'orange'  => array(
    'text'   => 'text-[#EA580C]',
    'bg'     => 'bg-orange-50',
    'border' => 'border-orange-100',
    'hover'  => 'hover:border-orange-200',
    'bar'    => 'from-orange-500 via-orange-400 to-transparent',
    'inner'  => '#FFFFFF',
  ),
);

$timeline_steps = array(
  array(
    'icon'  => 'radar',
    'label' => __('Monitor', 'reviewservicepro'),
    'desc'  => __('Track reviews and customer feedback.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'activity',
    'label' => __('Analyze', 'reviewservicepro'),
    'desc'  => __('Find sentiment, risks, and opportunities.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'message-square',
    'label' => __('Respond', 'reviewservicepro'),
    'desc'  => __('Reply professionally and consistently.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'refresh-cw',
    'label' => __('Improve', 'reviewservicepro'),
    'desc'  => __('Optimize customer feedback workflows.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'bar-chart-2',
    'label' => __('Measure', 'reviewservicepro'),
    'desc'  => __('Report progress and reputation trends.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'trending-up',
    'label' => __('Grow', 'reviewservicepro'),
    'desc'  => __('Build long-term trust and authority.', 'reviewservicepro'),
  ),
);

$ethical_items = array(
  array(
    'icon'  => 'shield-check',
    'title' => __('No Fake Reviews', 'reviewservicepro'),
    'desc'  => __('We never create or facilitate artificial reviews.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'ban',
    'title' => __('No Rating Manipulation', 'reviewservicepro'),
    'desc'  => __('All reputation work is ethical and platform-compliant.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'lock',
    'title' => __('Platform-Compliant', 'reviewservicepro'),
    'desc'  => __('Every method follows platform terms of service.', 'reviewservicepro'),
  ),
  array(
    'icon'  => 'eye',
    'title' => __('Transparent Reporting', 'reviewservicepro'),
    'desc'  => __('Clear monthly reports with no hidden metrics.', 'reviewservicepro'),
  ),
);
?>

<section
  id="services-overview"
  class="rsp-services-overview relative overflow-hidden bg-white py-24 md:py-32"
  role="region"
  aria-label="<?php esc_attr_e('Online Reputation Management Services Overview', 'reviewservicepro'); ?>"
  data-gsap="services-animate">
  <style>
    #services-overview {
      --svc-title: #334155;
      --svc-heading: #3B4658;
      --svc-body: #64748B;
      --svc-blue: #2563EB;
      --svc-green: #00C853;
      --svc-teal: #14B8A6;
      --svc-soft: #F8FAFC;
      --svc-border: rgba(148, 163, 184, 0.28);
    }

    #services-overview .rsp-svc-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #services-overview .rsp-svc-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(34px, 4.8vw, 58px);
      font-weight: 800;
      line-height: 1.07;
      letter-spacing: -0.055em;
      color: var(--svc-title);
    }

    #services-overview .rsp-svc-section-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(30px, 4vw, 48px);
      font-weight: 800;
      line-height: 1.1;
      letter-spacing: -0.05em;
      color: var(--svc-title);
    }

    #services-overview .rsp-svc-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--svc-heading);
    }

    #services-overview .rsp-svc-main-text {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 500;
      line-height: 1.78;
      color: var(--svc-body);
    }

    #services-overview .rsp-svc-body-text {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
      color: var(--svc-body);
    }

    #services-overview .rsp-svc-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
    }

    #services-overview .rsp-svc-reveal.rsp-is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #services-overview .rsp-svc-motion-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      transform: translateY(0) scale(1);
      transition:
        transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 320ms ease,
        background-color 320ms ease;
    }

    #services-overview .rsp-svc-motion-card::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.28),
          rgba(20, 184, 166, 0.20),
          rgba(37, 99, 235, 0.28),
          rgba(37, 99, 235, 0.08));
      opacity: 0.72;
      transform: rotate(0deg);
      transition: opacity 280ms ease;
      animation: rspSvcBorderSpin 8s linear infinite;
      pointer-events: none;
    }

    #services-overview .rsp-svc-motion-card::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--svc-card-inner, #ffffff);
      pointer-events: none;
    }

    #services-overview .rsp-svc-motion-card:hover {
      transform: translateY(-8px) scale(1.006);
      border-color: rgba(37, 99, 235, 0.22);
      box-shadow: 0 30px 90px rgba(15, 23, 42, 0.13);
    }

    #services-overview .rsp-svc-motion-card:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #services-overview .rsp-svc-panel {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #services-overview .rsp-svc-panel::before {
      content: "";
      position: absolute;
      inset: -120px;
      z-index: -1;
      background:
        radial-gradient(circle at 12% 18%, rgba(37, 99, 235, 0.10), transparent 30%),
        radial-gradient(circle at 88% 78%, rgba(0, 200, 83, 0.10), transparent 32%),
        radial-gradient(circle at 52% 10%, rgba(20, 184, 166, 0.08), transparent 28%);
      animation: rspSvcGlowMove 9s ease-in-out infinite alternate;
      pointer-events: none;
    }

    #services-overview .rsp-svc-image-wrap img {
      transition:
        transform 680ms cubic-bezier(0.2, 0.9, 0.2, 1),
        filter 420ms ease;
    }

    #services-overview .rsp-svc-motion-card:hover .rsp-svc-image-wrap img {
      transform: scale(1.055);
      filter: saturate(1.06);
    }

    #services-overview .rsp-svc-icon {
      transition:
        transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 280ms ease,
        background-color 280ms ease;
    }

    #services-overview .rsp-svc-motion-card:hover .rsp-svc-icon,
    #services-overview .orm-tl-step:hover .orm-tl-icon {
      transform: rotate(-4deg) scale(1.08);
      box-shadow: 0 16px 40px rgba(37, 99, 235, 0.12);
    }

    #services-overview .rsp-svc-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        background-color 260ms ease,
        border-color 260ms ease;
    }

    #services-overview .rsp-svc-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      z-index: 0;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
      pointer-events: none;
    }

    #services-overview .rsp-svc-btn:hover {
      transform: translateY(-3px);
    }

    #services-overview .rsp-svc-btn:hover::before {
      left: 135%;
    }

    #services-overview .rsp-svc-dashboard {
      position: relative;
      animation: rspSvcFloat 7s ease-in-out infinite;
    }

    #services-overview .rsp-svc-dashboard::before {
      content: "";
      position: absolute;
      inset: -1px;
      border-radius: 2rem;
      background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.42), rgba(0, 200, 83, 0.32), transparent);
      background-size: 220% 100%;
      animation: rspSvcBeam 5.5s ease-in-out infinite;
      opacity: 0.88;
      pointer-events: none;
    }

    #services-overview .rsp-svc-dashboard-inner {
      position: relative;
      z-index: 1;
    }

    #services-overview .rsp-svc-dashboard-inner img,
    #services-overview .rsp-svc-ethical-inner img {
      transition:
        transform 720ms cubic-bezier(0.2, 0.9, 0.2, 1),
        filter 420ms ease;
    }

    #services-overview .rsp-svc-dashboard:hover img,
    #services-overview .rsp-svc-ethical-image:hover img {
      transform: scale(1.035);
      filter: saturate(1.06);
    }

    #services-overview .rsp-svc-timeline-shell {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #services-overview .rsp-svc-timeline-shell::before {
      content: "";
      position: absolute;
      inset: -1px;
      z-index: -1;
      border-radius: inherit;
      background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.32), rgba(0, 200, 83, 0.26), transparent);
      background-size: 220% 100%;
      animation: rspSvcBeam 6s ease-in-out infinite;
      opacity: 0.75;
      pointer-events: none;
    }

    #services-overview .orm-tl-step {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        color 280ms ease;
    }

    #services-overview .orm-tl-step:hover {
      transform: translateY(-6px);
    }

    #services-overview .orm-tl-step:hover .orm-tl-icon {
      border-color: rgba(37, 99, 235, 0.24);
      background: #EFF6FF;
    }

    #services-overview .orm-tl-step:hover .orm-tl-icon-color,
    #services-overview .orm-tl-step:hover .orm-tl-label {
      color: #2563EB;
    }

    #services-overview .orm-tl-step:hover .orm-tl-desc {
      color: #64748B;
    }

    #services-overview .rsp-svc-ethical-image {
      position: relative;
      animation: rspSvcFloat 7s ease-in-out infinite;
    }

    #services-overview .rsp-svc-ethical-image::before {
      content: "";
      position: absolute;
      inset: -1px;
      border-radius: 2rem;
      background: linear-gradient(90deg, transparent, rgba(0, 200, 83, 0.36), rgba(37, 99, 235, 0.26), transparent);
      background-size: 220% 100%;
      animation: rspSvcBeam 5.5s ease-in-out infinite;
      opacity: 0.80;
      pointer-events: none;
    }

    #services-overview .rsp-svc-ethical-inner {
      position: relative;
      z-index: 1;
    }

    @keyframes rspSvcBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspSvcFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes rspSvcBeam {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    @keyframes rspSvcGlowMove {
      from {
        transform: translate3d(-18px, -10px, 0) scale(1);
      }

      to {
        transform: translate3d(18px, 12px, 0) scale(1.04);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #services-overview *,
      #services-overview *::before,
      #services-overview *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #services-overview .rsp-svc-reveal {
        opacity: 1;
        transform: none;
      }

      #services-overview .rsp-svc-motion-card:hover,
      #services-overview .rsp-svc-btn:hover,
      #services-overview .orm-tl-step:hover,
      #services-overview .rsp-svc-motion-card:hover .rsp-svc-icon,
      #services-overview .orm-tl-step:hover .orm-tl-icon,
      #services-overview .rsp-svc-motion-card:hover .rsp-svc-image-wrap img,
      #services-overview .rsp-svc-dashboard:hover img,
      #services-overview .rsp-svc-ethical-image:hover img {
        transform: none;
      }
    }
  </style>

  <div class="absolute inset-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.075),transparent_40%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.075),transparent_40%)]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

    <!-- Block 1: Intro + Dashboard -->
    <div class="mb-24 grid items-center gap-14 lg:grid-cols-2 lg:gap-16" data-gsap-item="svc-intro">

      <div class="rsp-svc-reveal" data-rsp-svc-reveal>
        <span class="rsp-svc-eyebrow mb-6 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-[7px] text-blue-700 shadow-sm">
          <i data-lucide="sparkles" class="h-[13px] w-[13px]" aria-hidden="true"></i>
          <?php esc_html_e('ORM Services Overview', 'reviewservicepro'); ?>
        </span>

        <h2 class="rsp-svc-title max-w-3xl">
          <?php esc_html_e('Ethical Online Reputation', 'reviewservicepro'); ?>
          <span class="block"><?php esc_html_e('Management', 'reviewservicepro'); ?></span>
          <span class="relative inline-block">
            <span class="relative z-10 bg-gradient-to-r from-[#2563EB] via-[#00C853] to-[#0891B2] bg-clip-text text-transparent">
              <?php esc_html_e('Built For Trust', 'reviewservicepro'); ?>
            </span>
            <span class="absolute bottom-1 left-0 right-0 h-[3px] rounded-full bg-blue-100" aria-hidden="true"></span>
          </span>
        </h2>

        <p class="rsp-svc-main-text mt-6 max-w-[640px]">
          <?php esc_html_e('Online Reputation Management is more than watching reviews. It is a structured system for monitoring feedback, responding professionally, improving customer experience, and building long-term customer trust.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-8 flex flex-wrap gap-4">
          <a
            href="<?php echo esc_url(home_url('/contact/')); ?>"
            class="rsp-svc-btn inline-flex min-h-[54px] items-center gap-2 rounded-2xl bg-[#2563EB] px-7 py-3.5 font-['Inter',sans-serif] text-[16px] font-bold text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,.24)] hover:bg-[#1D4ED8] hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-200">
            <span class="relative z-10 inline-flex items-center gap-2">
              <i data-lucide="calendar-check" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
            </span>
          </a>

          <a
            href="<?php echo esc_url(home_url('/services/')); ?>"
            class="rsp-svc-btn inline-flex min-h-[54px] items-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-7 py-3.5 font-['Inter',sans-serif] text-[16px] font-semibold text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Explore Services', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="rsp-svc-reveal" data-rsp-svc-reveal style="transition-delay: 120ms;">
        <div class="rsp-svc-dashboard rounded-[2rem] bg-white p-[2px] shadow-[0_28px_90px_rgba(37,99,235,.14)]">
          <div class="rsp-svc-dashboard-inner overflow-hidden rounded-[calc(2rem-2px)] border border-[#E2E8F0] bg-white">
            <img
              src="<?php echo esc_url($img_dashboard); ?>"
              alt="<?php echo esc_attr__('ReviewService.Pro reputation management dashboard preview', 'reviewservicepro'); ?>"
              class="block aspect-[4/3] w-full object-cover"
              loading="lazy"
              decoding="async"
              width="900"
              height="680">
          </div>
        </div>
      </div>
    </div>

    <!-- Block 2: 6 Service Cards -->
    <div class="mb-24" data-gsap-item="svc-cards">

      <div class="rsp-svc-reveal mx-auto mb-14 max-w-3xl text-center" data-rsp-svc-reveal>
        <span class="rsp-svc-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-[7px] text-blue-700 shadow-sm">
          <i data-lucide="layers-3" class="h-[13px] w-[13px]" aria-hidden="true"></i>
          <?php esc_html_e('What Our ORM System Includes', 'reviewservicepro'); ?>
        </span>

        <h3 class="rsp-svc-section-title">
          <?php esc_html_e('Six Services. One Complete Reputation System.', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-svc-main-text mx-auto mt-5 max-w-[660px]">
          <?php esc_html_e('Every service works together to help your business protect trust, respond better, and improve reputation performance.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($services as $index => $service) : ?>
          <?php $ac = $accent_classes[$service['accent']]; ?>

          <article
            class="rsp-svc-motion-card rsp-svc-reveal group rounded-[2rem] border border-[#E2E8F0] bg-white p-4 shadow-[0_14px_44px_rgba(15,23,42,.06)] <?php echo esc_attr($ac['hover']); ?>"
            data-rsp-svc-reveal
            style="--svc-card-inner: <?php echo esc_attr($ac['inner']); ?>; transition-delay: <?php echo esc_attr((string) min($index * 70, 420)); ?>ms;">

            <div class="absolute inset-x-0 top-0 h-[3px] rounded-t-[2rem] bg-gradient-to-r <?php echo esc_attr($ac['bar']); ?> opacity-80 transition-opacity duration-300 group-hover:opacity-100" aria-hidden="true"></div>

            <div class="rsp-svc-image-wrap relative mb-5 overflow-hidden rounded-[1.5rem] border border-slate-100 bg-slate-50">
              <img
                src="<?php echo esc_url($img_base . $service['img']); ?>"
                alt="<?php echo esc_attr($service['img_alt']); ?>"
                class="aspect-[4/3] w-full object-cover"
                loading="lazy"
                decoding="async"
                width="900"
                height="680">

              <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#07111F]/58 to-transparent opacity-80" aria-hidden="true"></div>

              <span class="absolute left-4 top-4 inline-flex items-center rounded-full border border-white/45 bg-white/92 px-3 py-1.5 font-['DM_Mono',monospace] text-[12px] font-bold text-[#334155] shadow-sm backdrop-blur-md">
                <?php echo esc_html($service['number']); ?>
              </span>

              <div class="rsp-svc-icon absolute bottom-4 left-4 flex h-12 w-12 items-center justify-center rounded-2xl border border-white/45 bg-white/94 shadow-sm backdrop-blur-md <?php echo esc_attr($ac['text']); ?>">
                <i data-lucide="<?php echo esc_attr($service['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
              </div>
            </div>

            <div class="relative z-10 px-2 pb-2">
              <h4 class="rsp-svc-heading mb-3 text-[22px] font-[800] leading-[1.18] tracking-[-0.035em]">
                <?php echo esc_html($service['title']); ?>
              </h4>

              <p class="rsp-svc-body-text mb-5">
                <?php echo esc_html($service['desc']); ?>
              </p>

              <div class="mb-5 rounded-2xl border <?php echo esc_attr($ac['border']); ?> <?php echo esc_attr($ac['bg']); ?> px-4 py-3">
                <p class="font-['Inter',sans-serif] text-[16px] font-[500] leading-[1.65] text-[#64748B]">
                  <span class="font-[800] <?php echo esc_attr($ac['text']); ?>">
                    <?php esc_html_e('Outcome:', 'reviewservicepro'); ?>
                  </span>
                  <?php echo esc_html($service['outcome']); ?>
                </p>
              </div>

              <a
                href="<?php echo esc_url($service['link']); ?>"
                class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-[16px] font-bold <?php echo esc_attr($ac['text']); ?> no-underline transition-all duration-300 group-hover:gap-3">
                <?php esc_html_e('Learn more', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Block 3: Process Timeline -->
    <div class="mb-24" data-gsap-item="svc-timeline">

      <div class="rsp-svc-reveal mx-auto mb-14 max-w-3xl text-center" data-rsp-svc-reveal>
        <span class="rsp-svc-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-[7px] text-emerald-700 shadow-sm">
          <i data-lucide="workflow" class="h-[13px] w-[13px]" aria-hidden="true"></i>
          <?php esc_html_e('How The Framework Works', 'reviewservicepro'); ?>
        </span>

        <h3 class="rsp-svc-section-title">
          <?php esc_html_e('Monitor. Analyze. Respond. Improve.', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-svc-main-text mx-auto mt-5 max-w-[640px]">
          <?php esc_html_e('A clear reputation workflow helps your business turn scattered review activity into a structured trust-building system.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div
        class="rsp-svc-reveal rsp-svc-timeline-shell rounded-[2rem] bg-white p-[2px] shadow-[0_24px_80px_rgba(15,23,42,.10)]"
        data-rsp-svc-reveal>
        <div
          class="relative overflow-hidden rounded-[calc(2rem-2px)] border border-[#E2E8F0] bg-white px-6 py-10 sm:px-8"
          style="background-image: linear-gradient(rgba(255,255,255,0.90), rgba(255,255,255,0.96)), url('<?php echo esc_url($img_timeline_bg); ?>'); background-size: cover; background-position: center;">
          <div class="relative z-10" id="orm-timeline">
            <div class="absolute left-[5%] right-[5%] top-7 hidden h-px bg-[#E2E8F0] md:block" aria-hidden="true"></div>
            <div class="orm-timeline-progress absolute left-[5%] top-7 hidden h-px w-0 bg-gradient-to-r from-[#2563EB] to-[#00C853] md:block" aria-hidden="true"></div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-6">
              <?php foreach ($timeline_steps as $step) : ?>
                <div class="orm-tl-step text-center">
                  <div class="orm-tl-icon mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full border border-[#E2E8F0] bg-[#F8FAFC] transition-all duration-500">
                    <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="orm-tl-icon-color h-6 w-6 text-[#94A3B8] transition-colors duration-500" aria-hidden="true"></i>
                  </div>

                  <p class="orm-tl-label mb-2 font-['Poppins',sans-serif] text-[16px] font-[800] text-[#3B4658] transition-colors duration-500">
                    <?php echo esc_html($step['label']); ?>
                  </p>

                  <p class="orm-tl-desc font-['Inter',sans-serif] text-[16px] font-[500] leading-[1.65] text-[#64748B] transition-colors duration-500">
                    <?php echo esc_html($step['desc']); ?>
                  </p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Block 4: Ethical Commitment -->
    <div data-gsap-item="svc-ethical">

      <div class="rsp-svc-reveal mx-auto mb-12 max-w-3xl text-center" data-rsp-svc-reveal>
        <span class="rsp-svc-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-[7px] text-emerald-700 shadow-sm">
          <i data-lucide="shield-check" class="h-[13px] w-[13px]" aria-hidden="true"></i>
          <?php esc_html_e('Our Ethical Commitment', 'reviewservicepro'); ?>
        </span>

        <h3 class="rsp-svc-section-title">
          <?php esc_html_e('We Build Trust. We Do Not Manufacture It.', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-svc-main-text mx-auto mt-5 max-w-[660px]">
          <?php esc_html_e('Our work is built around customer feedback, professional response strategy, transparent reporting, and long-term reputation growth.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid items-center gap-14 lg:grid-cols-2">

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
          <?php foreach ($ethical_items as $index => $item) : ?>
            <article
              class="rsp-svc-motion-card rsp-svc-reveal group rounded-2xl border border-emerald-100 bg-white p-6 shadow-[0_14px_44px_rgba(16,185,129,.06)]"
              data-rsp-svc-reveal
              style="--svc-card-inner:#ffffff; transition-delay: <?php echo esc_attr((string) min($index * 80, 320)); ?>ms;">
              <div class="relative z-10">
                <div class="rsp-svc-icon mb-4 flex h-12 w-12 items-center justify-center rounded-xl border border-emerald-200 bg-emerald-50 text-[#059669] shadow-sm">
                  <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
                </div>

                <p class="rsp-svc-heading text-[20px] font-[800] leading-snug tracking-[-0.035em]">
                  <?php echo esc_html($item['title']); ?>
                </p>

                <p class="rsp-svc-body-text mt-2">
                  <?php echo esc_html($item['desc']); ?>
                </p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="rsp-svc-reveal" data-rsp-svc-reveal style="transition-delay: 160ms;">
          <div class="rsp-svc-ethical-image relative rounded-[2rem] bg-white p-[2px] shadow-[0_24px_80px_rgba(16,185,129,.12)]">
            <div class="rsp-svc-ethical-inner overflow-hidden rounded-[calc(2rem-2px)] border border-emerald-100 bg-white">
              <img
                src="<?php echo esc_url($img_ethical); ?>"
                alt="<?php echo esc_attr__('Ethical reputation management team reviewing client trust report', 'reviewservicepro'); ?>"
                class="block aspect-[6/5] w-full object-cover"
                loading="lazy"
                decoding="async"
                width="900"
                height="750">
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
</section>

<script>
  (function() {
    function initRspServicesOverview() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('#services-overview [data-rsp-svc-reveal]');

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
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspServicesOverview);
    } else {
      initRspServicesOverview();
    }
  })();
</script>