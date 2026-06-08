<?php

/**
 * Services Page ORM Process Section
 *
 * File: template-parts/sections/services/process.php
 *
 * ReviewService.Pro — AI-Driven ORM Process
 *
 * Purpose:
 * - Explain what happens after choosing a monthly ORM plan or one-time package
 * - Reduce buyer confusion before checkout
 * - Build trust around onboarding, monitoring, response workflow, reporting, and client portal
 * - Support SEO/AEO for AI-Driven Online Reputation Management process
 *
 * Stack:
 * - WordPress PHP
 * - Tailwind CSS from theme build
 * - Lucide icons already enqueued by theme
 * - Sans-serif typography
 * - Minimal scoped CSS and vanilla JS only
 *
 * Compliance:
 * - No fake reviews
 * - No paid/incentivized reviews
 * - No guaranteed 5-star ratings
 * - No guaranteed negative review removal
 * - No guaranteed ranking outcomes
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$monthly_plans_url    = '#monthly-plans';
$one_time_package_url = '#one-time-packages';
$client_portal_url    = '#client-portal-preview';
$contact_url          = home_url('/contact/?type=orm-process-question');

$process_steps = [
  [
    'number'        => '01',
    'icon'          => 'shopping-cart',
    'tone'          => 'blue',
    'title'         => __('Choose Plan or Package', 'reviewservicepro'),
    'text'          => __('Select a monthly ORM plan or one-time reputation package based on your platforms, response needs, review concerns, and business goals.', 'reviewservicepro'),
    'output'        => __('Clear service scope before checkout.', 'reviewservicepro'),
    'client_action' => __('Choose monthly plan, one-time package, or custom quote.', 'reviewservicepro'),
    'portal_module' => __('Order / Invoice', 'reviewservicepro'),
  ],
  [
    'number'        => '02',
    'icon'          => 'credit-card',
    'tone'          => 'emerald',
    'title'         => __('Secure Checkout', 'reviewservicepro'),
    'text'          => __('After clicking Order Now, you complete checkout securely through WooCommerce. The order becomes the starting point for your ORM workflow.', 'reviewservicepro'),
    'output'        => __('Payment confirmation and order record.', 'reviewservicepro'),
    'client_action' => __('Complete payment and create/login to account.', 'reviewservicepro'),
    'portal_module' => __('Billing / Orders', 'reviewservicepro'),
  ],
  [
    'number'        => '03',
    'icon'          => 'clipboard-check',
    'tone'          => 'purple',
    'title'         => __('Client Onboarding', 'reviewservicepro'),
    'text'          => __('We collect your business details, website URL, review platform links, preferred response tone, urgent concerns, and priority platforms.', 'reviewservicepro'),
    'output'        => __('Business context and access requirements collected.', 'reviewservicepro'),
    'client_action' => __('Submit business information and platform links.', 'reviewservicepro'),
    'portal_module' => __('Client Action Required', 'reviewservicepro'),
  ],
  [
    'number'        => '04',
    'icon'          => 'search-check',
    'tone'          => 'amber',
    'title'         => __('Reputation Audit', 'reviewservicepro'),
    'text'          => __('We review your current rating profile, review freshness, response gaps, negative review risks, platform visibility, and local trust signals.', 'reviewservicepro'),
    'output'        => __('Reputation baseline and priority action direction.', 'reviewservicepro'),
    'client_action' => __('Review audit notes and confirm priority areas.', 'reviewservicepro'),
    'portal_module' => __('Reputation Snapshot', 'reviewservicepro'),
  ],
  [
    'number'        => '05',
    'icon'          => 'radar',
    'tone'          => 'cyan',
    'title'         => __('Platform Monitoring Setup', 'reviewservicepro'),
    'text'          => __('We set up monitoring for the platforms included in your plan, such as Google Business Profile, Facebook, Trustpilot, Yelp, Tripadvisor, G2, Capterra, or other relevant profiles.', 'reviewservicepro'),
    'output'        => __('Selected platforms organized for ongoing monitoring.', 'reviewservicepro'),
    'client_action' => __('Confirm platform access or public review profile links.', 'reviewservicepro'),
    'portal_module' => __('Platform List', 'reviewservicepro'),
  ],
  [
    'number'        => '06',
    'icon'          => 'message-square',
    'tone'          => 'blue',
    'title'         => __('Review Response Workflow', 'reviewservicepro'),
    'text'          => __('We prepare professional response drafts and response frameworks for positive, neutral, and negative reviews using your brand tone and compliance-safe language.', 'reviewservicepro'),
    'output'        => __('Better public communication and stronger trust signals.', 'reviewservicepro'),
    'client_action' => __('Approve response tone or request adjustment.', 'reviewservicepro'),
    'portal_module' => __('Review Response Tracker', 'reviewservicepro'),
  ],
  [
    'number'        => '07',
    'icon'          => 'shield-alert',
    'tone'          => 'red',
    'title'         => __('Negative Review Case Support', 'reviewservicepro'),
    'text'          => __('For sensitive negative reviews, we help identify, document, respond to, and report reviews that may violate platform policies when appropriate.', 'reviewservicepro'),
    'output'        => __('Safer case handling without risky claims.', 'reviewservicepro'),
    'client_action' => __('Share review link, issue context, and supporting details.', 'reviewservicepro'),
    'portal_module' => __('Negative Review Cases', 'reviewservicepro'),
  ],
  [
    'number'        => '08',
    'icon'          => 'file-text',
    'tone'          => 'emerald',
    'title'         => __('Monthly Report & Strategy Review', 'reviewservicepro'),
    'text'          => __('You receive monthly reporting with review activity, response work, risks, platform performance, client action items, and next-step recommendations.', 'reviewservicepro'),
    'output'        => __('Clear progress visibility and better decisions.', 'reviewservicepro'),
    'client_action' => __('Review report and approve next priorities.', 'reviewservicepro'),
    'portal_module' => __('Monthly Reports', 'reviewservicepro'),
  ],
];

$tone_classes = [
  'blue' => [
    'card'  => 'border-blue-200 bg-blue-50/70',
    'icon'  => 'border-blue-200 bg-blue-50 text-blue-700',
    'pill'  => 'bg-blue-50 text-blue-700 border-blue-200',
    'glow'  => 'bg-blue-300/25',
    'line'  => 'from-blue-600 to-blue-400',
  ],
  'emerald' => [
    'card'  => 'border-emerald-200 bg-emerald-50/70',
    'icon'  => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'pill'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'glow'  => 'bg-emerald-300/25',
    'line'  => 'from-emerald-600 to-emerald-400',
  ],
  'purple' => [
    'card'  => 'border-violet-200 bg-violet-50/70',
    'icon'  => 'border-violet-200 bg-violet-50 text-violet-700',
    'pill'  => 'bg-violet-50 text-violet-700 border-violet-200',
    'glow'  => 'bg-violet-300/25',
    'line'  => 'from-violet-600 to-violet-400',
  ],
  'amber' => [
    'card'  => 'border-amber-200 bg-amber-50/70',
    'icon'  => 'border-amber-200 bg-amber-50 text-amber-700',
    'pill'  => 'bg-amber-50 text-amber-700 border-amber-200',
    'glow'  => 'bg-amber-300/25',
    'line'  => 'from-amber-600 to-amber-400',
  ],
  'cyan' => [
    'card'  => 'border-cyan-200 bg-cyan-50/70',
    'icon'  => 'border-cyan-200 bg-cyan-50 text-cyan-700',
    'pill'  => 'bg-cyan-50 text-cyan-700 border-cyan-200',
    'glow'  => 'bg-cyan-300/25',
    'line'  => 'from-cyan-600 to-cyan-400',
  ],
  'red' => [
    'card'  => 'border-red-200 bg-red-50/70',
    'icon'  => 'border-red-200 bg-red-50 text-red-700',
    'pill'  => 'bg-red-50 text-red-700 border-red-200',
    'glow'  => 'bg-red-300/25',
    'line'  => 'from-red-600 to-red-400',
  ],
];

$portal_items = [
  [
    'icon'  => 'layout-dashboard',
    'title' => __('Client Portal Access', 'reviewservicepro'),
    'text'  => __('After payment, the client portal keeps service details, orders, invoices, action items, reports, and support requests organized.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'list-checks',
    'title' => __('Client Action Required', 'reviewservicepro'),
    'text'  => __('We show what we need from the client, such as platform links, business details, preferred response tone, or urgent review context.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'bar-chart-3',
    'title' => __('Transparent Monthly Reporting', 'reviewservicepro'),
    'text'  => __('Monthly plans include clear reporting around review activity, response work, reputation risks, platform notes, and next actions.', 'reviewservicepro'),
  ],
];

$onboarding_items = [
  __('Business name and website URL', 'reviewservicepro'),
  __('Google Business Profile / review platform links', 'reviewservicepro'),
  __('Preferred review response tone', 'reviewservicepro'),
  __('Urgent negative review links if any', 'reviewservicepro'),
  __('Priority platforms and business goals', 'reviewservicepro'),
  __('Logo, images, or brand notes if needed', 'reviewservicepro'),
];

$schema_steps = [];

foreach ($process_steps as $index => $step) {
  $schema_steps[] = [
    '@type'    => 'HowToStep',
    'position' => $index + 1,
    'name'     => wp_strip_all_tags($step['title']),
    'text'     => wp_strip_all_tags($step['text'] . ' Output: ' . $step['output']),
  ];
}

$process_schema = [
  '@context'    => 'https://schema.org',
  '@type'       => 'HowTo',
  'name'        => 'How ReviewService.Pro AI-Driven Online Reputation Management Process Works',
  'description' => 'A step-by-step overview of ReviewService.Pro online reputation management workflow from checkout and onboarding to monitoring, review response management, negative review case support, monthly reporting, and client portal updates.',
  'step'        => $schema_steps,
];
?>

<style>
  .rsp-process-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition: opacity 700ms ease, transform 700ms ease, box-shadow 280ms ease, border-color 280ms ease;
  }

  .rsp-process-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-process-card:nth-child(1) {
    transition-delay: 0ms;
  }

  .rsp-process-card:nth-child(2) {
    transition-delay: 70ms;
  }

  .rsp-process-card:nth-child(3) {
    transition-delay: 140ms;
  }

  .rsp-process-card:nth-child(4) {
    transition-delay: 210ms;
  }

  .rsp-process-card:nth-child(5) {
    transition-delay: 40ms;
  }

  .rsp-process-card:nth-child(6) {
    transition-delay: 110ms;
  }

  .rsp-process-card:nth-child(7) {
    transition-delay: 180ms;
  }

  .rsp-process-card:nth-child(8) {
    transition-delay: 250ms;
  }

  .rsp-process-progress-fill {
    width: 0%;
    transition: width 1400ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-process-progress-fill.rsp-active {
    width: 100%;
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-process-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-process-progress-fill {
      width: 100%;
      transition: none;
    }
  }
</style>

<section
  id="orm-process"
  class="relative overflow-hidden border-b border-slate-200 bg-white py-20 font-sans md:py-28"
  aria-labelledby="orm-process-title"
  data-rsp-process-section>

  <!-- Background -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(30,58,138,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(30,58,138,0.045)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 -top-40 z-0 h-[560px] w-[560px] rounded-full bg-blue-200/45 blur-[130px]"></div>
  <div class="pointer-events-none absolute -bottom-40 -right-32 z-0 h-[520px] w-[560px] rounded-full bg-emerald-200/45 blur-[130px]"></div>
  <div class="pointer-events-none absolute left-[48%] top-[38%] z-0 h-[300px] w-[300px] rounded-full bg-violet-200/25 blur-[110px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="rsp-process-reveal mx-auto max-w-4xl text-center" data-rsp-process-animate>
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] text-emerald-700 shadow-sm">
        <i data-lucide="workflow" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('AI-Driven ORM Process', 'reviewservicepro'); ?>
      </span>

      <h2
        id="orm-process-title"
        class="font-sans text-[2.35rem] font-black leading-[1.12] tracking-[-0.045em] text-slate-950 sm:text-5xl lg:text-[3.55rem]">
        <?php esc_html_e('A clear reputation workflow from checkout to monthly reporting.', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-slate-600 md:text-lg">
        <?php esc_html_e('Our process is designed to reduce confusion. You know what happens first, what we monitor, how review responses are handled, what gets reported, and which actions are needed from your side.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- AEO / SEO Answer Block -->
    <div class="rsp-process-reveal mx-auto mt-9 max-w-4xl rounded-[1.75rem] border border-blue-200 bg-blue-50 p-6 shadow-sm" data-rsp-process-animate>
      <h3 class="flex items-start gap-3 font-sans text-xl font-black tracking-[-0.02em] text-slate-950">
        <i data-lucide="search-check" class="mt-1 h-5 w-5 shrink-0 text-blue-700" aria-hidden="true"></i>
        <?php esc_html_e('How does an online reputation management process work?', 'reviewservicepro'); ?>
      </h3>

      <p class="mt-3 text-base leading-8 text-blue-900">
        <?php esc_html_e('An online reputation management process usually starts with checkout and onboarding, then moves into reputation audit, review monitoring, review response management, negative review case support, trust signal improvement, monthly reporting, and strategy review. ReviewService.Pro keeps this workflow organized through WooCommerce checkout and a secure client portal.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Process Progress Bar -->
    <div class="rsp-process-reveal mt-12 rounded-[2rem] border border-slate-200 bg-white p-5 shadow-xl shadow-slate-900/5" data-rsp-process-animate>
      <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm font-black uppercase tracking-[0.14em] text-slate-400">
          <?php esc_html_e('Process Momentum', 'reviewservicepro'); ?>
        </p>

        <p class="text-sm font-bold text-slate-500">
          <?php esc_html_e('Plan / Package → Checkout → Portal → Reporting', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="h-3 overflow-hidden rounded-full bg-slate-100">
        <div class="rsp-process-progress-fill h-full rounded-full bg-gradient-to-r from-[#1E3A8A] via-[#14B8A6] to-[#00C853]" data-rsp-process-progress></div>
      </div>
    </div>

    <!-- Process Cards -->
    <div class="mt-10 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
      <?php foreach ($process_steps as $step) : ?>
        <?php $tone = $tone_classes[$step['tone']] ?? $tone_classes['blue']; ?>

        <article
          class="rsp-process-reveal rsp-process-card group relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-slate-300 hover:shadow-2xl hover:shadow-slate-900/10"
          data-rsp-process-animate>

          <div class="<?php echo esc_attr($tone['glow']); ?> pointer-events-none absolute -right-16 -top-16 h-52 w-52 rounded-full opacity-0 blur-3xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="relative z-10 flex items-start justify-between gap-4">
            <span class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-black uppercase tracking-[0.14em] text-slate-400">
              <?php echo esc_html($step['number']); ?>
            </span>

            <div class="<?php echo esc_attr($tone['icon']); ?> flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border transition-all duration-300 group-hover:scale-105 group-hover:-rotate-3">
              <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
            </div>
          </div>

          <h3 class="relative z-10 mt-6 font-sans text-xl font-black leading-tight tracking-[-0.025em] text-slate-950">
            <?php echo esc_html($step['title']); ?>
          </h3>

          <p class="relative z-10 mt-3 text-base leading-8 text-slate-600">
            <?php echo esc_html($step['text']); ?>
          </p>

          <div class="relative z-10 mt-5 rounded-[1.25rem] border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs font-black uppercase tracking-[0.14em] text-slate-400">
              <?php esc_html_e('Output', 'reviewservicepro'); ?>
            </p>

            <p class="mt-2 text-sm font-bold leading-6 text-slate-800">
              <?php echo esc_html($step['output']); ?>
            </p>
          </div>

          <div class="<?php echo esc_attr($tone['card']); ?> relative z-10 mt-4 rounded-[1.25rem] border p-4">
            <p class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
              <?php esc_html_e('Client Action', 'reviewservicepro'); ?>
            </p>

            <p class="mt-2 text-sm font-bold leading-6 text-slate-700">
              <?php echo esc_html($step['client_action']); ?>
            </p>
          </div>

          <div class="relative z-10 mt-4">
            <span class="<?php echo esc_attr($tone['pill']); ?> inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-black">
              <i data-lucide="layout-dashboard" class="h-3.5 w-3.5" aria-hidden="true"></i>
              <?php echo esc_html($step['portal_module']); ?>
            </span>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- After Payment / Portal Bridge -->
    <div class="rsp-process-reveal mt-12 overflow-hidden rounded-[2rem] border border-blue-200 bg-blue-50 shadow-xl shadow-blue-900/5" data-rsp-process-animate>
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_0.9fr]">

        <!-- Left -->
        <div class="p-6 md:p-8 lg:p-10">
          <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-blue-700">
            <i data-lucide="door-open" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('After Payment Workflow', 'reviewservicepro'); ?>
          </span>

          <h3 class="font-sans text-3xl font-black leading-tight tracking-[-0.035em] text-slate-950 md:text-4xl">
            <?php esc_html_e('Checkout is not the end — it starts your client portal workflow.', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-5 max-w-3xl text-base leading-8 text-blue-900">
            <?php esc_html_e('After payment, we collect your business details, review platform links, website URL, requirements, current issues, brand tone, and priority actions. This keeps your reputation management service organized and reduces back-and-forth confusion.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
            <a
              href="<?php echo esc_url($monthly_plans_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#1E3A8A] px-7 py-4 text-sm font-black text-white shadow-lg shadow-blue-900/25 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
              <?php esc_html_e('Choose a Monthly Plan', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($one_time_package_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-blue-200 bg-white px-7 py-4 text-sm font-black text-blue-700 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-100 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
              <?php esc_html_e('View One-Time Packages', 'reviewservicepro'); ?>
              <i data-lucide="package-check" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($client_portal_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 text-sm font-black text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-500/10">
              <?php esc_html_e('Preview Client Portal', 'reviewservicepro'); ?>
              <i data-lucide="layout-dashboard" class="h-5 w-5" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <!-- Right Onboarding Checklist -->
        <div class="border-t border-blue-200 bg-white p-6 md:p-8 lg:border-l lg:border-t-0 lg:p-10">
          <h4 class="font-sans text-2xl font-black tracking-[-0.025em] text-slate-950">
            <?php esc_html_e('What we collect during onboarding', 'reviewservicepro'); ?>
          </h4>

          <ul class="mt-5 space-y-3">
            <?php foreach ($onboarding_items as $item) : ?>
              <li class="flex gap-3 text-base leading-7 text-slate-600">
                <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                  <i data-lucide="check" class="h-3.5 w-3.5" aria-hidden="true"></i>
                </span>
                <?php echo esc_html($item); ?>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="mt-6 rounded-[1.5rem] border border-amber-200 bg-amber-50 p-5">
            <p class="flex gap-3 text-sm font-bold leading-6 text-amber-900">
              <i data-lucide="info" class="mt-0.5 h-4 w-4 shrink-0 text-amber-700" aria-hidden="true"></i>
              <?php esc_html_e('The more accurate the onboarding information, the faster we can audit, organize, and begin the reputation workflow.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>

      </div>
    </div>

    <!-- Portal Support Cards -->
    <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-3">
      <?php foreach ($portal_items as $item) : ?>
        <article class="rsp-process-reveal rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-900/10" data-rsp-process-animate>
          <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-700">
            <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
          </div>

          <h3 class="font-sans text-xl font-black leading-tight tracking-[-0.02em] text-slate-950">
            <?php echo esc_html($item['title']); ?>
          </h3>

          <p class="mt-3 text-base leading-8 text-slate-600">
            <?php echo esc_html($item['text']); ?>
          </p>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Compliance Band -->
    <div class="rsp-process-reveal mt-8 rounded-[2rem] border border-emerald-200 bg-emerald-50 p-6 shadow-sm md:p-8" data-rsp-process-animate>
      <div class="flex flex-col gap-5 md:flex-row md:items-start">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-700 shadow-sm">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <div>
          <h3 class="font-sans text-2xl font-black tracking-[-0.025em] text-slate-950">
            <?php esc_html_e('The process stays ethical and platform-safe.', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-3 text-base leading-8 text-emerald-900">
            <?php esc_html_e('We do not use fake reviews, paid review incentives, review manipulation, guaranteed review removal, or guaranteed ranking claims. Our workflow focuses on monitoring, professional responses, documentation, genuine feedback requests, platform-compliant reporting, and transparent monthly progress.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-6 py-4 text-sm font-black text-emerald-700 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-100">
              <?php esc_html_e('Ask a Process Question', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($monthly_plans_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-6 py-4 text-sm font-black text-white shadow-lg shadow-emerald-900/20 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-600">
              <?php esc_html_e('Compare Monthly Plans', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($process_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
  (function() {
    function initRspProcessSection() {
      var root = document.querySelector('[data-rsp-process-section]');

      if (!root) {
        return;
      }

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var progress = root.querySelector('[data-rsp-process-progress]');
      var revealItems = root.querySelectorAll('[data-rsp-process-animate]');

      function reveal(item) {
        if (!item || item.dataset.rspProcessRevealed === 'true') {
          return;
        }

        item.dataset.rspProcessRevealed = 'true';
        item.classList.add('rsp-visible');

        if (progress) {
          progress.classList.add('rsp-active');
        }
      }

      if (!('IntersectionObserver' in window)) {
        revealItems.forEach(reveal);

        if (progress) {
          progress.classList.add('rsp-active');
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
      document.addEventListener('DOMContentLoaded', initRspProcessSection);
    } else {
      initRspProcessSection();
    }
  })();
</script>