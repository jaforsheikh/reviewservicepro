<?php

/**
 * Services Page Client Portal Preview Section
 *
 * File: template-parts/sections/services/client-portal-preview.php
 *
 * ReviewService.Pro — Client Portal Preview
 *
 * Purpose:
 * - Show what clients receive after checkout/payment
 * - Explain how WooCommerce My Account becomes a premium ORM client portal
 * - Build trust around active plan, managed platforms, response usage,
 *   monthly reports, negative review cases, client action items, support, and invoices
 *
 * Stack:
 * - WordPress PHP
 * - WooCommerce My Account links
 * - Tailwind CSS from theme build
 * - Lucide icons already enqueued by theme
 * - Sans-serif typography
 * - Scoped CSS/JS only
 *
 * Compliance:
 * - No fake reviews
 * - No paid/incentivized reviews
 * - No guaranteed 5-star ratings
 * - No guaranteed negative review removal
 * - No guaranteed ranking outcomes
 *
 * Future:
 * - Real portal data, messages, uploads, report files, response tracker,
 *   negative review case tracker, and admin/client replies should be handled
 *   later through a custom plugin/module, not inside this template file.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$monthly_plans_url    = '#monthly-plans';
$one_time_package_url = '#one-time-packages';
$process_url          = '#orm-process';
$contact_url          = home_url('/contact/?type=client-portal-question');

$my_account_url = function_exists('wc_get_page_permalink')
  ? wc_get_page_permalink('myaccount')
  : home_url('/my-account/');

$orders_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('orders')
  : trailingslashit($my_account_url) . 'orders/';

$account_details_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('edit-account')
  : trailingslashit($my_account_url) . 'edit-account/';

$portal_features = [
  [
    'icon'  => 'credit-card',
    'tone'  => 'blue',
    'title' => __('Active Service Plan', 'reviewservicepro'),
    'text'  => __('See your selected ORM plan, platform limit, service type, billing status, and current account stage.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'monitor-check',
    'tone'  => 'emerald',
    'title' => __('Managed Platform List', 'reviewservicepro'),
    'text'  => __('View which review platforms are included in your reputation management workflow.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'message-square',
    'tone'  => 'purple',
    'title' => __('Review Response Usage', 'reviewservicepro'),
    'text'  => __('Track included response draft usage and monthly response support limits.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'shield-alert',
    'tone'  => 'amber',
    'title' => __('Negative Review Cases', 'reviewservicepro'),
    'text'  => __('Follow sensitive review cases, documentation notes, action status, and safe next-step direction.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'file-text',
    'tone'  => 'blue',
    'title' => __('Monthly Reports', 'reviewservicepro'),
    'text'  => __('Access reputation activity summaries, review response work, risk notes, platform insights, and next action recommendations.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'list-checks',
    'tone'  => 'emerald',
    'title' => __('Client Action Required', 'reviewservicepro'),
    'text'  => __('See what information, approvals, platform links, or business details are needed from your side.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'life-buoy',
    'tone'  => 'purple',
    'title' => __('Support Access', 'reviewservicepro'),
    'text'  => __('Request help, ask for updates, report a review concern, or contact the ORM support team.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'receipt-text',
    'tone'  => 'amber',
    'title' => __('Orders & Invoices', 'reviewservicepro'),
    'text'  => __('Access WooCommerce orders, invoices, billing details, and account information from one secure account area.', 'reviewservicepro'),
  ],
];

$mini_features = [
  [
    'icon'  => 'credit-card',
    'title' => __('Active Service Plan', 'reviewservicepro'),
    'text'  => __('See selected ORM plan, platform limit, and current account status.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'radar',
    'title' => __('Managed Platform List', 'reviewservicepro'),
    'text'  => __('View which platforms are included in your reputation workflow.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'file-text',
    'title' => __('Monthly Reports', 'reviewservicepro'),
    'text'  => __('Access reputation summaries, risks, and next action recommendations.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'message-square',
    'title' => __('Support Access', 'reviewservicepro'),
    'text'  => __('Request help, report a review concern, or contact the ORM team.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'receipt-text',
    'title' => __('Orders & Invoices', 'reviewservicepro'),
    'text'  => __('Access billing details, orders, invoices, and account information.', 'reviewservicepro'),
  ],
];

$portal_snapshot_stats = [
  [
    'label' => __('Active Plan', 'reviewservicepro'),
    'value' => __('Growth ORM', 'reviewservicepro'),
    'tag'   => __('Monthly management', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'label' => __('Platforms Connected', 'reviewservicepro'),
    'value' => __('5', 'reviewservicepro'),
    'tag'   => __('Selected review sites', 'reviewservicepro'),
    'tone'  => 'emerald',
  ],
  [
    'label' => __('Response Usage', 'reviewservicepro'),
    'value' => __('12/20', 'reviewservicepro'),
    'tag'   => __('Drafts this month', 'reviewservicepro'),
    'tone'  => 'purple',
  ],
  [
    'label' => __('Next Report', 'reviewservicepro'),
    'value' => __('Monthly', 'reviewservicepro'),
    'tag'   => __('Progress summary', 'reviewservicepro'),
    'tone'  => 'amber',
  ],
];

$platform_rows = [
  [
    'platform' => __('Google', 'reviewservicepro'),
    'status'   => __('Monitoring', 'reviewservicepro'),
    'usage'    => __('6/20', 'reviewservicepro'),
    'progress' => 30,
    'risk'     => __('Medium', 'reviewservicepro'),
    'tone'     => 'blue',
    'risk_tone' => 'amber',
  ],
  [
    'platform' => __('Facebook', 'reviewservicepro'),
    'status'   => __('Active', 'reviewservicepro'),
    'usage'    => __('2/20', 'reviewservicepro'),
    'progress' => 10,
    'risk'     => __('Low', 'reviewservicepro'),
    'tone'     => 'emerald',
    'risk_tone' => 'emerald',
  ],
  [
    'platform' => __('Trustpilot', 'reviewservicepro'),
    'status'   => __('Review Needed', 'reviewservicepro'),
    'usage'    => __('4/20', 'reviewservicepro'),
    'progress' => 20,
    'risk'     => __('Medium', 'reviewservicepro'),
    'tone'     => 'amber',
    'risk_tone' => 'amber',
  ],
];

$client_actions = [
  __('Share Google Business Profile link or access direction', 'reviewservicepro'),
  __('Confirm business name, website URL, and platform links', 'reviewservicepro'),
  __('Approve review response tone and brand wording', 'reviewservicepro'),
  __('Submit current reputation concerns or priority issues', 'reviewservicepro'),
];

$future_modules = [
  __('Client messages and admin replies', 'reviewservicepro'),
  __('File and image upload workflow', 'reviewservicepro'),
  __('Report upload and download system', 'reviewservicepro'),
  __('Reputation score and local SEO tracker', 'reviewservicepro'),
  __('Negative review case management', 'reviewservicepro'),
  __('Review response approval workflow', 'reviewservicepro'),
];

$tone_classes = [
  'blue' => [
    'icon'   => 'border-blue-200 bg-blue-50 text-blue-700',
    'tag'    => 'border-blue-200 bg-blue-50 text-blue-700',
    'glow'   => 'bg-blue-300/25',
    'bar'    => 'bg-blue-600',
    'dot'    => 'bg-blue-500',
    'status' => 'border-blue-200 bg-blue-50 text-blue-700',
  ],
  'emerald' => [
    'icon'   => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'tag'    => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'glow'   => 'bg-emerald-300/25',
    'bar'    => 'bg-emerald-600',
    'dot'    => 'bg-emerald-500',
    'status' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
  ],
  'purple' => [
    'icon'   => 'border-violet-200 bg-violet-50 text-violet-700',
    'tag'    => 'border-violet-200 bg-violet-50 text-violet-700',
    'glow'   => 'bg-violet-300/25',
    'bar'    => 'bg-violet-600',
    'dot'    => 'bg-violet-500',
    'status' => 'border-violet-200 bg-violet-50 text-violet-700',
  ],
  'amber' => [
    'icon'   => 'border-amber-200 bg-amber-50 text-amber-700',
    'tag'    => 'border-amber-200 bg-amber-50 text-amber-700',
    'glow'   => 'bg-amber-300/25',
    'bar'    => 'bg-amber-600',
    'dot'    => 'bg-amber-500',
    'status' => 'border-amber-200 bg-amber-50 text-amber-700',
  ],
];

$schema_items = [];

foreach ($portal_features as $index => $feature) {
  $schema_items[] = [
    '@type'    => 'ListItem',
    'position' => $index + 1,
    'name'     => wp_strip_all_tags($feature['title']),
    'description' => wp_strip_all_tags($feature['text']),
  ];
}

$portal_schema = [
  '@context' => 'https://schema.org',
  '@type'    => 'ItemList',
  'name'     => 'ReviewService.Pro client portal features',
  'description' => 'Client portal preview for ReviewService.Pro online reputation management clients, including active plan details, managed platforms, response usage, monthly reports, negative review cases, required actions, support access, and invoices.',
  'itemListElement' => $schema_items,
];
?>

<style>
  .rsp-client-portal-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition: opacity 700ms ease, transform 700ms ease, box-shadow 280ms ease, border-color 280ms ease;
  }

  .rsp-client-portal-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-client-portal-feature:nth-child(1) {
    transition-delay: 0ms;
  }

  .rsp-client-portal-feature:nth-child(2) {
    transition-delay: 70ms;
  }

  .rsp-client-portal-feature:nth-child(3) {
    transition-delay: 140ms;
  }

  .rsp-client-portal-feature:nth-child(4) {
    transition-delay: 210ms;
  }

  .rsp-client-portal-feature:nth-child(5) {
    transition-delay: 40ms;
  }

  .rsp-client-portal-feature:nth-child(6) {
    transition-delay: 110ms;
  }

  .rsp-client-portal-feature:nth-child(7) {
    transition-delay: 180ms;
  }

  .rsp-client-portal-feature:nth-child(8) {
    transition-delay: 250ms;
  }

  .rsp-client-score-ring {
    transform: rotate(-90deg);
  }

  .rsp-client-score-ring-fill {
    stroke-dasharray: 132;
    stroke-dashoffset: 132;
    transition: stroke-dashoffset 1400ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-client-score-ring-fill.rsp-active {
    stroke-dashoffset: 33;
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-client-portal-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-client-score-ring-fill {
      stroke-dashoffset: 33;
      transition: none;
    }
  }
</style>

<section
  id="client-portal-preview"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F1F5F9] py-20 font-sans md:py-28"
  aria-labelledby="client-portal-preview-title"
  data-rsp-client-portal-section>

  <!-- Background -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.045)_1px,transparent_1px)] bg-[size:52px_52px]"></div>
  <div class="pointer-events-none absolute -left-32 -top-44 z-0 h-[560px] w-[560px] rounded-full bg-blue-300/20 blur-[130px]"></div>
  <div class="pointer-events-none absolute -bottom-32 -right-28 z-0 h-[520px] w-[520px] rounded-full bg-emerald-300/20 blur-[130px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="rsp-client-portal-reveal mx-auto max-w-4xl text-center" data-rsp-client-portal-animate>
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.16em] text-blue-700 shadow-sm">
        <i data-lucide="monitor-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Client Portal Preview', 'reviewservicepro'); ?>
      </span>

      <h2
        id="client-portal-preview-title"
        class="font-sans text-[2.35rem] font-black leading-[1.12] tracking-[-0.045em] text-slate-950 sm:text-5xl lg:text-[3.55rem]">
        <?php esc_html_e('After payment, your ORM service stays organized inside the client portal.', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-slate-600 md:text-lg">
        <?php esc_html_e('One secure place to track your active plan, managed platforms, review response usage, monthly reports, negative review cases, required actions, support access, orders, invoices, and account details.', 'reviewservicepro'); ?>
      </p>

      <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row sm:flex-wrap">
        <a
          href="<?php echo esc_url($monthly_plans_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#1E3A8A] px-7 py-4 text-sm font-black text-white shadow-lg shadow-blue-900/25 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
          <?php esc_html_e('Choose a Plan', 'reviewservicepro'); ?>
          <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
        </a>

        <a
          href="<?php echo esc_url($my_account_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 text-sm font-black text-slate-700 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
          <?php esc_html_e('Open Client Portal', 'reviewservicepro'); ?>
          <i data-lucide="lock" class="h-5 w-5" aria-hidden="true"></i>
        </a>
      </div>
    </div>

    <!-- AEO / SEO Answer Block -->
    <div class="rsp-client-portal-reveal mx-auto mt-9 max-w-4xl rounded-[1.75rem] border border-blue-200 bg-white/90 p-6 shadow-sm backdrop-blur-xl" data-rsp-client-portal-animate>
      <h3 class="flex items-start gap-3 font-sans text-xl font-black tracking-[-0.02em] text-slate-950">
        <i data-lucide="search-check" class="mt-1 h-5 w-5 shrink-0 text-blue-700" aria-hidden="true"></i>
        <?php esc_html_e('What does the ReviewService.Pro client portal include?', 'reviewservicepro'); ?>
      </h3>

      <p class="mt-3 text-base leading-8 text-slate-600">
        <?php esc_html_e('The ReviewService.Pro client portal gives reputation management clients a secure place to review their active ORM plan, managed platforms, review response usage, monthly reputation reports, negative review case notes, client action items, support options, orders, invoices, and account details.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Main Split Layout -->
    <div class="mt-14 grid grid-cols-1 gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">

      <!-- Left Column -->
      <div class="space-y-4">

        <!-- Trust Card -->
        <div class="rsp-client-portal-reveal rounded-[1.5rem] border border-emerald-200 bg-emerald-50 p-6 shadow-sm" data-rsp-client-portal-animate>
          <div class="flex gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-700 shadow-sm">
              <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <div>
              <h3 class="font-sans text-lg font-black text-slate-950">
                <?php esc_html_e('Built for service transparency.', 'reviewservicepro'); ?>
              </h3>

              <p class="mt-2 text-sm leading-7 text-emerald-900">
                <?php esc_html_e('This preview uses placeholder values. Real project data, messages, reports, status updates, response approvals, and review case workflows should be connected later through a custom WordPress plugin.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Mini Feature Cards -->
        <?php foreach ($mini_features as $feature) : ?>
          <article class="rsp-client-portal-reveal group rounded-[1.25rem] border border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-slate-900/10" data-rsp-client-portal-animate>
            <div class="flex gap-4">
              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-700 transition-all duration-300 group-hover:bg-blue-700 group-hover:text-white">
                <i data-lucide="<?php echo esc_attr($feature['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
              </div>

              <div>
                <h3 class="font-sans text-base font-black leading-tight text-slate-950">
                  <?php echo esc_html($feature['title']); ?>
                </h3>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                  <?php echo esc_html($feature['text']); ?>
                </p>
              </div>
            </div>
          </article>
        <?php endforeach; ?>

      </div>

      <!-- Right Column: Portal Mockup -->
      <div class="rsp-client-portal-reveal relative" data-rsp-client-portal-animate>
        <div class="pointer-events-none absolute -inset-5 rounded-[2.5rem] bg-blue-500/10 blur-3xl"></div>

        <div
          class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-2xl shadow-slate-900/15"
          role="img"
          aria-label="<?php esc_attr_e('Client portal preview showing ORM plan, reputation score, managed platforms, response usage, client actions, and reports.', 'reviewservicepro'); ?>">

          <!-- Browser Bar -->
          <div class="flex items-center justify-between gap-3 border-b border-slate-200 bg-slate-50 px-4 py-3">
            <div class="flex gap-1.5" aria-hidden="true">
              <span class="h-3 w-3 rounded-full bg-red-300"></span>
              <span class="h-3 w-3 rounded-full bg-amber-300"></span>
              <span class="h-3 w-3 rounded-full bg-emerald-300"></span>
            </div>

            <div class="hidden max-w-sm flex-1 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 sm:flex">
              <i data-lucide="lock" class="h-3.5 w-3.5 text-emerald-600" aria-hidden="true"></i>
              <span class="truncate text-xs font-bold text-slate-500">
                <?php echo esc_html(wp_parse_url($my_account_url, PHP_URL_HOST) ? wp_parse_url($my_account_url, PHP_URL_HOST) . '/my-account/' : 'reviewservice.pro/my-account/'); ?>
              </span>
            </div>

            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700">
              <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
              <?php esc_html_e('Secure', 'reviewservicepro'); ?>
            </span>
          </div>

          <!-- Portal Body -->
          <div class="p-4 md:p-5">

            <!-- Portal Hero -->
            <div class="relative mb-4 overflow-hidden rounded-[1.5rem] bg-[linear-gradient(135deg,#1E3A8A_0%,#2563EB_55%,#3B82F6_100%)] p-5">
              <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.08)_1px,transparent_1px)] bg-[size:24px_24px]"></div>

              <div class="relative z-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                  <p class="text-xs font-black uppercase tracking-[0.14em] text-white/50">
                    <?php esc_html_e('Welcome back', 'reviewservicepro'); ?>
                  </p>

                  <h3 class="mt-1 font-sans text-xl font-black leading-tight text-white">
                    <?php esc_html_e('Your ORM service is active', 'reviewservicepro'); ?>
                  </h3>

                  <p class="mt-1 text-sm leading-6 text-white/65">
                    <?php esc_html_e('Track platforms, reports, actions, and support in one place.', 'reviewservicepro'); ?>
                  </p>
                </div>

                <span class="inline-flex w-fit rounded-full border border-white/25 bg-white/15 px-4 py-2 text-xs font-black text-white">
                  <?php esc_html_e('Growth Plan', 'reviewservicepro'); ?>
                </span>
              </div>
            </div>

            <!-- Reputation Score -->
            <div class="mb-4 flex flex-col gap-4 rounded-[1.25rem] border border-violet-200 bg-violet-50 p-4 sm:flex-row sm:items-center">
              <div class="relative h-[52px] w-[52px] shrink-0" aria-label="<?php esc_attr_e('Reputation score 75 out of 100', 'reviewservicepro'); ?>">
                <svg class="rsp-client-score-ring" width="52" height="52" viewBox="0 0 52 52" aria-hidden="true">
                  <circle cx="26" cy="26" r="21" fill="none" stroke="#DDD6FE" stroke-width="5"></circle>
                  <circle
                    class="rsp-client-score-ring-fill"
                    cx="26"
                    cy="26"
                    r="21"
                    fill="none"
                    stroke="#7C3AED"
                    stroke-width="5"
                    stroke-linecap="round"
                    data-rsp-score-ring></circle>
                </svg>

                <div class="absolute inset-0 flex items-center justify-center text-sm font-black text-violet-700">
                  <?php esc_html_e('75', 'reviewservicepro'); ?>
                </div>
              </div>

              <div class="min-w-0 flex-1">
                <h4 class="font-sans text-sm font-black text-violet-700">
                  <?php esc_html_e('Reputation Score', 'reviewservicepro'); ?>
                </h4>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                  <?php esc_html_e('Based on response rate, review freshness, platform consistency, and visible trust signals.', 'reviewservicepro'); ?>
                </p>
              </div>

              <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-black text-emerald-700">
                <i data-lucide="trending-up" class="h-3.5 w-3.5" aria-hidden="true"></i>
                <?php esc_html_e('+8 this month', 'reviewservicepro'); ?>
              </span>
            </div>

            <!-- Snapshot Stats -->
            <div class="mb-4 grid grid-cols-2 gap-3">
              <?php foreach ($portal_snapshot_stats as $stat) : ?>
                <?php $tone = $tone_classes[$stat['tone']] ?? $tone_classes['blue']; ?>

                <div class="rounded-[1.1rem] border border-slate-200 bg-slate-50 p-4">
                  <p class="text-xs font-bold text-slate-400">
                    <?php echo esc_html($stat['label']); ?>
                  </p>

                  <p class="mt-2 font-sans text-lg font-black leading-none text-slate-950">
                    <?php echo esc_html($stat['value']); ?>
                  </p>

                  <span class="<?php echo esc_attr($tone['tag']); ?> mt-3 inline-flex rounded-full border px-2 py-1 text-[10px] font-black">
                    <?php echo esc_html($stat['tag']); ?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Platform Table -->
            <div class="mb-4 overflow-hidden rounded-[1.25rem] border border-slate-200 bg-white">
              <div class="flex items-center justify-between gap-3 border-b border-slate-200 bg-slate-50 px-4 py-3">
                <h4 class="text-sm font-black text-slate-950">
                  <?php esc_html_e('Managed Platform Snapshot', 'reviewservicepro'); ?>
                </h4>

                <span class="text-[10px] font-black uppercase tracking-[0.14em] text-slate-400">
                  <?php esc_html_e('3 of 5 shown', 'reviewservicepro'); ?>
                </span>
              </div>

              <div class="overflow-x-auto">
                <table class="min-w-[520px] w-full border-collapse" aria-label="<?php esc_attr_e('Platform monitoring status', 'reviewservicepro'); ?>">
                  <thead>
                    <tr>
                      <th scope="col" class="border-b border-slate-200 bg-white px-3 py-2 text-left text-[10px] font-black uppercase tracking-[0.12em] text-slate-400">
                        <?php esc_html_e('Platform', 'reviewservicepro'); ?>
                      </th>
                      <th scope="col" class="border-b border-slate-200 bg-white px-3 py-2 text-left text-[10px] font-black uppercase tracking-[0.12em] text-slate-400">
                        <?php esc_html_e('Status', 'reviewservicepro'); ?>
                      </th>
                      <th scope="col" class="border-b border-slate-200 bg-white px-3 py-2 text-left text-[10px] font-black uppercase tracking-[0.12em] text-slate-400">
                        <?php esc_html_e('Usage', 'reviewservicepro'); ?>
                      </th>
                      <th scope="col" class="border-b border-slate-200 bg-white px-3 py-2 text-left text-[10px] font-black uppercase tracking-[0.12em] text-slate-400">
                        <?php esc_html_e('Risk', 'reviewservicepro'); ?>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach ($platform_rows as $row) : ?>
                      <?php
                      $tone      = $tone_classes[$row['tone']] ?? $tone_classes['blue'];
                      $risk_tone = $tone_classes[$row['risk_tone']] ?? $tone_classes['amber'];
                      ?>

                      <tr class="border-b border-slate-100 last:border-b-0 hover:bg-blue-50/50">
                        <td class="px-3 py-3 text-sm font-black text-slate-950">
                          <span class="inline-flex items-center gap-2">
                            <span class="<?php echo esc_attr($tone['dot']); ?> h-2 w-2 rounded-full"></span>
                            <?php echo esc_html($row['platform']); ?>
                          </span>
                        </td>

                        <td class="px-3 py-3">
                          <span class="<?php echo esc_attr($tone['status']); ?> inline-flex rounded-full border px-2.5 py-1 text-xs font-black">
                            <?php echo esc_html($row['status']); ?>
                          </span>
                        </td>

                        <td class="px-3 py-3 text-sm font-bold text-slate-600">
                          <span class="inline-flex items-center gap-2">
                            <?php echo esc_html($row['usage']); ?>
                            <span class="inline-block h-1.5 w-16 overflow-hidden rounded-full bg-slate-200">
                              <span
                                class="<?php echo esc_attr($tone['bar']); ?> block h-full rounded-full"
                                style="width: <?php echo esc_attr(absint($row['progress'])); ?>%;"></span>
                            </span>
                          </span>
                        </td>

                        <td class="px-3 py-3">
                          <span class="<?php echo esc_attr($risk_tone['tag']); ?> inline-flex rounded-full border px-2.5 py-1 text-xs font-black">
                            <?php echo esc_html($row['risk']); ?>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Client Actions -->
            <div class="rounded-[1.25rem] border border-amber-200 bg-amber-50 p-4">
              <h4 class="flex items-center gap-2 text-sm font-black text-amber-900">
                <i data-lucide="list-checks" class="h-4 w-4" aria-hidden="true"></i>
                <?php esc_html_e('Client Action Required', 'reviewservicepro'); ?>
              </h4>

              <ul class="mt-3 space-y-2">
                <?php foreach ($client_actions as $action) : ?>
                  <li class="flex gap-2 text-xs leading-5 text-amber-900">
                    <span class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-md bg-white text-amber-700">
                      <i data-lucide="check" class="h-3 w-3" aria-hidden="true"></i>
                    </span>
                    <?php echo esc_html($action); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Feature Grid -->
    <div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($portal_features as $feature) : ?>
        <?php $tone = $tone_classes[$feature['tone']] ?? $tone_classes['blue']; ?>

        <article
          class="rsp-client-portal-reveal rsp-client-portal-feature group relative overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-2xl hover:shadow-slate-900/10"
          data-rsp-client-portal-animate>

          <div class="<?php echo esc_attr($tone['glow']); ?> pointer-events-none absolute -right-12 -top-12 h-44 w-44 rounded-full opacity-0 blur-3xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="<?php echo esc_attr($tone['icon']); ?> relative z-10 mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border transition-all duration-300 group-hover:scale-105 group-hover:-rotate-3">
            <i data-lucide="<?php echo esc_attr($feature['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h3 class="relative z-10 font-sans text-lg font-black leading-tight tracking-[-0.02em] text-slate-950">
            <?php echo esc_html($feature['title']); ?>
          </h3>

          <p class="relative z-10 mt-3 text-base leading-7 text-slate-600">
            <?php echo esc_html($feature['text']); ?>
          </p>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Portal System Direction -->
    <div class="rsp-client-portal-reveal mt-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-900/5" data-rsp-client-portal-animate>
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_420px]">

        <div class="p-6 md:p-8 lg:p-10">
          <span class="mb-5 inline-flex rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-slate-500">
            <?php esc_html_e('Portal System Direction', 'reviewservicepro'); ?>
          </span>

          <h3 class="font-sans text-3xl font-black leading-tight tracking-[-0.035em] text-slate-950 md:text-4xl">
            <?php esc_html_e('The portal starts simple now and can become a full service management system later.', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-5 max-w-3xl text-base leading-8 text-slate-600">
            <?php esc_html_e('The first version can show active services, reports, orders, invoices, support links, onboarding direction, and client action items. Later, a custom plugin can add messages, file uploads, admin replies, project status database, score tracking, report uploads, response approvals, and negative review case management.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
            <a
              href="<?php echo esc_url($process_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-blue-200 bg-blue-50 px-6 py-4 text-sm font-black text-blue-700 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-100">
              <?php esc_html_e('View ORM Process', 'reviewservicepro'); ?>
              <i data-lucide="workflow" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($orders_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-4 text-sm font-black text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:bg-slate-50">
              <?php esc_html_e('View Orders Area', 'reviewservicepro'); ?>
              <i data-lucide="receipt-text" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($account_details_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-4 text-sm font-black text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:bg-slate-50">
              <?php esc_html_e('Account Details', 'reviewservicepro'); ?>
              <i data-lucide="user-cog" class="h-5 w-5" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="border-t border-slate-200 bg-slate-50 p-6 md:p-8 lg:border-l lg:border-t-0 lg:p-10">
          <h4 class="font-sans text-xl font-black text-slate-950">
            <?php esc_html_e('Future portal modules:', 'reviewservicepro'); ?>
          </h4>

          <ul class="mt-5 space-y-3">
            <?php foreach ($future_modules as $module) : ?>
              <li class="flex gap-3 text-base leading-7 text-slate-600">
                <span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-blue-700"></span>
                <?php echo esc_html($module); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>
    </div>

    <!-- Compliance Band -->
    <div class="rsp-client-portal-reveal mt-8 rounded-[2rem] border border-emerald-200 bg-emerald-50 p-6 shadow-sm md:p-8" data-rsp-client-portal-animate>
      <div class="flex flex-col gap-5 md:flex-row md:items-start">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-700 shadow-sm">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <div>
          <h3 class="font-sans text-2xl font-black tracking-[-0.025em] text-slate-950">
            <?php esc_html_e('The portal supports transparent, ethical ORM delivery.', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-3 text-base leading-8 text-emerald-900">
            <?php esc_html_e('ReviewService.Pro does not offer fake reviews, paid incentives, rating manipulation, guaranteed negative review removal, or guaranteed ranking outcomes. The client portal helps organize ethical review monitoring, response management, case documentation, genuine feedback workflows, reporting, support, orders, and invoices.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-6 py-4 text-sm font-black text-emerald-700 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-100">
              <?php esc_html_e('Ask About Client Portal', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($one_time_package_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-6 py-4 text-sm font-black text-white shadow-lg shadow-emerald-900/20 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-600">
              <?php esc_html_e('View One-Time Packages', 'reviewservicepro'); ?>
              <i data-lucide="package-check" class="h-5 w-5" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($portal_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
  (function() {
    function initRspClientPortalSection() {
      var root = document.querySelector('[data-rsp-client-portal-section]');

      if (!root) {
        return;
      }

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = root.querySelectorAll('[data-rsp-client-portal-animate]');
      var ring = root.querySelector('[data-rsp-score-ring]');

      function reveal(item) {
        if (!item || item.dataset.rspClientPortalRevealed === 'true') {
          return;
        }

        item.dataset.rspClientPortalRevealed = 'true';
        item.classList.add('rsp-visible');

        if (ring) {
          ring.classList.add('rsp-active');
        }
      }

      if (!('IntersectionObserver' in window)) {
        revealItems.forEach(reveal);

        if (ring) {
          ring.classList.add('rsp-active');
        }

        return;
      }

      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            reveal(entry.target);
          }
        });
      }, {
        threshold: 0.08,
        rootMargin: '0px 0px -20px 0px'
      });

      revealItems.forEach(function(item) {
        observer.observe(item);
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspClientPortalSection);
    } else {
      initRspClientPortalSection();
    }
  })();
</script>