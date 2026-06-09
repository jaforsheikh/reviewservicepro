<?php

/**
 * Template Name: About Page
 *
 * ReviewService.Pro — Compact White SaaS About Page
 *
 * File: page-templates/template-about.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$values = [
  [
    'icon'  => 'shield-check',
    'title' => __('Ethical ORM First', 'reviewservicepro'),
    'desc'  => __('We focus on platform-compliant monitoring, response support, reporting, documentation, and genuine customer feedback workflows.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'eye',
    'title' => __('Transparent Reporting', 'reviewservicepro'),
    'desc'  => __('Clients should understand what is being monitored, what changed, where risks exist, and what actions are recommended next.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'bot',
    'title' => __('AI-Assisted, Human Reviewed', 'reviewservicepro'),
    'desc'  => __('AI-supported insights can help organize reputation data, while human judgment keeps communication professional and brand-safe.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'users',
    'title' => __('Customer Trust Focus', 'reviewservicepro'),
    'desc'  => __('Reputation management is not only about reviews. It is about every visible trust signal a customer sees before contacting a business.', 'reviewservicepro'),
  ],
];

$process = [
  [
    'num'   => '01',
    'title' => __('Audit', 'reviewservicepro'),
    'desc'  => __('We review public review profiles, platform visibility, rating patterns, response gaps, and reputation risks.', 'reviewservicepro'),
  ],
  [
    'num'   => '02',
    'title' => __('Structure', 'reviewservicepro'),
    'desc'  => __('We create a clear ORM workflow around monitoring, response support, feedback requests, documentation, and reporting.', 'reviewservicepro'),
  ],
  [
    'num'   => '03',
    'title' => __('Support', 'reviewservicepro'),
    'desc'  => __('We help clients manage reputation activity professionally and consistently without fake reviews or manipulation.', 'reviewservicepro'),
  ],
  [
    'num'   => '04',
    'title' => __('Report', 'reviewservicepro'),
    'desc'  => __('Monthly visibility helps businesses see progress, risks, platform gaps, and next steps with better clarity.', 'reviewservicepro'),
  ],
];

$service_focus = [
  __('Online Reputation Management', 'reviewservicepro'),
  __('AI-Driven Review Monitoring', 'reviewservicepro'),
  __('Review Response Management', 'reviewservicepro'),
  __('Negative Review Case Support', 'reviewservicepro'),
  __('Google Business Profile Reputation Support', 'reviewservicepro'),
  __('Local SEO Trust Building', 'reviewservicepro'),
  __('Ethical Customer Feedback Request System', 'reviewservicepro'),
  __('Monthly ORM Reporting', 'reviewservicepro'),
];

$audience = [
  __('Restaurants', 'reviewservicepro'),
  __('Clinics', 'reviewservicepro'),
  __('Salons', 'reviewservicepro'),
  __('Real estate businesses', 'reviewservicepro'),
  __('Agencies', 'reviewservicepro'),
  __('Ecommerce brands', 'reviewservicepro'),
  __('Local service businesses', 'reviewservicepro'),
  __('Consultants and founders', 'reviewservicepro'),
];

get_header();
?>

<div id="about-page" class="rsp-page-shell relative overflow-hidden bg-[#F8FAFC] px-5 py-14 sm:px-6 lg:px-8 lg:py-16">

  <style>
    .rsp-page-shell {
      --rsp-title: #334155;
      --rsp-heading: #3B4658;
      --rsp-body: #64748B;
      --rsp-blue: #2563EB;
      --rsp-green: #00C853;
      --rsp-border: rgba(148, 163, 184, 0.24);
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .rsp-page-shell h1,
    .rsp-page-shell h2,
    .rsp-page-shell h3,
    .rsp-page-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-heading);
      letter-spacing: -0.035em;
    }

    .rsp-page-title {
      max-width: 860px;
      color: var(--rsp-title);
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(36px, 4.4vw, 48px);
      font-weight: 800;
      line-height: 1.08;
      letter-spacing: -0.05em;
      text-wrap: balance;
    }

    .rsp-page-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border-radius: 999px;
      border: 1px solid rgba(37, 99, 235, 0.20);
      background: rgba(37, 99, 235, 0.06);
      padding: 8px 14px;
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: #2563EB;
    }

    .rsp-page-text {
      color: var(--rsp-body);
      font-size: 16px;
      font-weight: 400;
      line-height: 1.78;
    }

    .rsp-page-card {
      border: 1px solid var(--rsp-border);
      border-radius: 24px;
      background: #ffffff;
      box-shadow: 0 16px 48px rgba(15, 23, 42, 0.06);
      transition:
        transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 240ms ease,
        border-color 240ms ease;
    }

    .rsp-page-card:hover {
      transform: translateY(-3px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 64px rgba(15, 23, 42, 0.09);
    }

    .rsp-page-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 240ms ease,
        background-color 240ms ease,
        border-color 240ms ease;
    }

    .rsp-page-btn::before {
      content: "";
      position: absolute;
      inset: 0;
      transform: translateX(-110%);
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.32), transparent);
      transition: transform 640ms ease;
    }

    .rsp-page-btn:hover {
      transform: translateY(-2px);
    }

    .rsp-page-btn:hover::before {
      transform: translateX(110%);
    }

    .rsp-page-reveal {
      opacity: 0;
      transform: translateY(18px);
      animation: rspPageReveal 680ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .rsp-page-prose h2 {
      margin-top: 0;
      margin-bottom: 14px;
      font-size: clamp(22px, 2.4vw, 30px);
      font-weight: 800;
      line-height: 1.18;
    }

    .rsp-page-prose h3 {
      margin-top: 22px;
      margin-bottom: 10px;
      font-size: 20px;
      font-weight: 800;
      line-height: 1.25;
    }

    .rsp-page-prose p,
    .rsp-page-prose li {
      color: #64748B;
      font-size: 16px;
      line-height: 1.78;
    }

    .rsp-page-prose ul,
    .rsp-page-prose ol {
      margin: 16px 0 0;
      padding-left: 22px;
    }

    .rsp-page-prose a {
      color: #2563EB;
      font-weight: 800;
      text-decoration: none;
    }

    .rsp-page-prose a:hover {
      text-decoration: underline;
    }

    @keyframes rspPageReveal {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 640px) {
      .rsp-page-title {
        font-size: clamp(34px, 10vw, 42px);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      .rsp-page-shell *,
      .rsp-page-shell *::before,
      .rsp-page-shell *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      .rsp-page-reveal {
        opacity: 1;
        transform: none;
      }

      .rsp-page-card:hover,
      .rsp-page-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.028)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.028)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">
    <section class="rsp-page-reveal grid grid-cols-1 gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
      <div>
        <span class="rsp-page-kicker">
          <i data-lucide="building-2" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('About ReviewService.Pro', 'reviewservicepro'); ?>
        </span>

        <h1 class="rsp-page-title mt-5">
          <?php esc_html_e('Ethical reputation management for trust-focused businesses.', 'reviewservicepro'); ?>
        </h1>

        <p class="rsp-page-text mt-5 max-w-3xl">
          <?php esc_html_e('ReviewService.Pro helps businesses protect credibility with responsible review monitoring, professional response support, negative review case documentation, customer feedback workflows, local trust signals, and clear monthly reporting.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row">
          <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="rsp-page-btn inline-flex min-h-[50px] items-center justify-center rounded-2xl bg-[#2563EB] px-6 py-3 font-bold text-white no-underline shadow-[0_14px_34px_rgba(37,99,235,0.22)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10"><?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?></span>
          </a>
          <a href="<?php echo esc_url(home_url('/services/')); ?>" class="inline-flex min-h-[50px] items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 font-bold text-[#3B4658] no-underline hover:bg-slate-50">
            <?php esc_html_e('Explore Services', 'reviewservicepro'); ?>
          </a>
        </div>
      </div>

      <div class="rsp-page-card p-6 md:p-7">
        <div class="grid grid-cols-2 gap-4">
          <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
            <p class="text-3xl font-[800] text-blue-700">AI</p>
            <p class="mt-2 text-sm font-bold text-[#64748B]"><?php esc_html_e('Assisted monitoring', 'reviewservicepro'); ?></p>
          </div>
          <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
            <p class="text-3xl font-[800] text-emerald-700">0</p>
            <p class="mt-2 text-sm font-bold text-[#64748B]"><?php esc_html_e('Fake-review tactics', 'reviewservicepro'); ?></p>
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-3xl font-[800] text-[#334155]">10+</p>
            <p class="mt-2 text-sm font-bold text-[#64748B]"><?php esc_html_e('Platforms supported', 'reviewservicepro'); ?></p>
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <p class="text-3xl font-[800] text-[#334155]">360°</p>
            <p class="mt-2 text-sm font-bold text-[#64748B]"><?php esc_html_e('Trust workflow view', 'reviewservicepro'); ?></p>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-12">
      <div class="rsp-page-reveal mx-auto max-w-3xl text-center">
        <span class="rsp-page-kicker">
          <i data-lucide="sparkles" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Our Principles', 'reviewservicepro'); ?>
        </span>
        <h2 class="rsp-page-title mx-auto mt-5 text-[clamp(32px,4vw,44px)]">
          <?php esc_html_e('Built for sustainable reputation improvement.', 'reviewservicepro'); ?>
        </h2>
      </div>

      <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
        <?php foreach ($values as $index => $value) : ?>
          <article class="rsp-page-card rsp-page-reveal p-6" style="animation-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
              <i data-lucide="<?php echo esc_attr($value['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>
            <h3 class="text-xl font-[800] leading-tight"><?php echo esc_html($value['title']); ?></h3>
            <p class="mt-3 text-[15px] leading-7 text-[#64748B]"><?php echo esc_html($value['desc']); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-[0.95fr_1.05fr]">
      <div class="rsp-page-card rsp-page-reveal p-6 md:p-8">
        <span class="rsp-page-kicker">
          <i data-lucide="workflow" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('How We Work', 'reviewservicepro'); ?>
        </span>
        <h2 class="mt-5 text-3xl font-[800] leading-tight md:text-4xl">
          <?php esc_html_e('A clear system, not random fixes.', 'reviewservicepro'); ?>
        </h2>
        <p class="rsp-page-text mt-4">
          <?php esc_html_e('Our process is designed to help clients understand reputation risk, take responsible action, and keep communication professional across important review platforms.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid gap-4">
        <?php foreach ($process as $step) : ?>
          <article class="rsp-page-card rsp-page-reveal flex gap-4 p-5">
            <span class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 font-['DM_Mono',monospace] text-sm font-[800] text-blue-700">
              <?php echo esc_html($step['num']); ?>
            </span>
            <div>
              <h3 class="text-xl font-[800] leading-tight"><?php echo esc_html($step['title']); ?></h3>
              <p class="mt-2 text-[15px] leading-7 text-[#64748B]"><?php echo esc_html($step['desc']); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-2">
      <div class="rsp-page-card rsp-page-reveal p-6 md:p-8">
        <h2 class="text-3xl font-[800] leading-tight"><?php esc_html_e('Service focus', 'reviewservicepro'); ?></h2>
        <div class="mt-6 flex flex-wrap gap-3">
          <?php foreach ($service_focus as $item) : ?>
            <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-[#64748B]">
              <?php echo esc_html($item); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="rsp-page-card rsp-page-reveal p-6 md:p-8">
        <h2 class="text-3xl font-[800] leading-tight"><?php esc_html_e('Who we help', 'reviewservicepro'); ?></h2>
        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
          <?php foreach ($audience as $item) : ?>
            <span class="flex items-center gap-2 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-800">
              <i data-lucide="check-circle-2" class="h-4 w-4" aria-hidden="true"></i>
              <?php echo esc_html($item); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  </div>
</div>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>

<?php
get_footer();
