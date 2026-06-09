<?php

/**
 * Template Name: Cookie Policy Page
 *
 * ReviewService.Pro — Compact White SaaS Cookie Policy
 *
 * File: page-templates/template-cookie-policy.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$last_updated = date_i18n('F Y');

$cookie_categories = [
  [
    'icon'  => 'lock',
    'tone'  => 'emerald',
    'title' => __('Essential Cookies', 'reviewservicepro'),
    'desc'  => __('Required cookies help the website load, protect forms, keep sessions secure, and support core site functionality.', 'reviewservicepro'),
    'items' => [
      __('Security and fraud prevention', 'reviewservicepro'),
      __('Navigation and page loading', 'reviewservicepro'),
      __('Contact forms and session support', 'reviewservicepro'),
    ],
  ],
  [
    'icon'  => 'bar-chart-3',
    'tone'  => 'blue',
    'title' => __('Analytics Cookies', 'reviewservicepro'),
    'desc'  => __('Analytics cookies help us understand page performance, traffic sources, and visitor behavior so we can improve the website experience.', 'reviewservicepro'),
    'items' => [
      __('Aggregated visitor insights', 'reviewservicepro'),
      __('Content and conversion path analysis', 'reviewservicepro'),
      __('Performance improvement reporting', 'reviewservicepro'),
    ],
  ],
  [
    'icon'  => 'megaphone',
    'tone'  => 'violet',
    'title' => __('Marketing Cookies', 'reviewservicepro'),
    'desc'  => __('Marketing cookies may support campaign measurement, retargeting, and attribution when advertising tools are active.', 'reviewservicepro'),
    'items' => [
      __('Ad platform measurement', 'reviewservicepro'),
      __('Campaign attribution', 'reviewservicepro'),
      __('Retargeting and conversion insights', 'reviewservicepro'),
    ],
  ],
  [
    'icon'  => 'settings',
    'tone'  => 'slate',
    'title' => __('Preference Cookies', 'reviewservicepro'),
    'desc'  => __('Preference cookies may remember choices such as display preferences, consent settings, or form usability selections.', 'reviewservicepro'),
    'items' => [
      __('Cookie consent choices', 'reviewservicepro'),
      __('Interface preferences', 'reviewservicepro'),
      __('Usability improvements', 'reviewservicepro'),
    ],
  ],
];

get_header();
?>

<div id="cookie-policy-page" class="rsp-page-shell relative overflow-hidden bg-[#F8FAFC] px-5 py-14 sm:px-6 lg:px-8 lg:py-16">

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
    <section class="rsp-page-reveal mx-auto max-w-4xl text-center">
      <span class="rsp-page-kicker">
        <i data-lucide="cookie" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Cookie Policy', 'reviewservicepro'); ?>
      </span>

      <h1 class="rsp-page-title mx-auto mt-5">
        <?php esc_html_e('How cookies support our website experience.', 'reviewservicepro'); ?>
      </h1>

      <p class="rsp-page-text mx-auto mt-5 max-w-3xl">
        <?php esc_html_e('This page explains how ReviewService.Pro may use cookies and similar technologies for security, analytics, preferences, and campaign measurement.', 'reviewservicepro'); ?>
      </p>

      <p class="mt-6 text-sm font-bold text-[#64748B]">
        <?php esc_html_e('Last updated:', 'reviewservicepro'); ?> <?php echo esc_html($last_updated); ?>
      </p>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2">
      <?php foreach ($cookie_categories as $index => $category) : ?>
        <article class="rsp-page-card rsp-page-reveal p-6 md:p-7" style="animation-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
            <i data-lucide="<?php echo esc_attr($category['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-2xl font-[800] leading-tight"><?php echo esc_html($category['title']); ?></h2>
          <p class="rsp-page-text mt-3"><?php echo esc_html($category['desc']); ?></p>

          <ul class="mt-5 grid gap-2">
            <?php foreach ($category['items'] as $item) : ?>
              <li class="flex gap-2 text-[15px] font-medium leading-7 text-[#64748B]">
                <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 flex-shrink-0 text-emerald-500" aria-hidden="true"></i>
                <?php echo esc_html($item); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </article>
      <?php endforeach; ?>
    </section>

    <section class="rsp-page-card rsp-page-prose rsp-page-reveal mt-8 p-6 md:p-8">
      <h2><?php esc_html_e('Managing Cookie Preferences', 'reviewservicepro'); ?></h2>
      <p><?php esc_html_e('You can control cookies through your browser settings. Some browsers allow you to block, delete, or limit cookies. Blocking essential cookies may affect website functionality. If a cookie consent tool is available on our website, you can use it to adjust non-essential cookie preferences.', 'reviewservicepro'); ?></p>

      <h3><?php esc_html_e('Third-Party Tools', 'reviewservicepro'); ?></h3>
      <p><?php esc_html_e('We may use tools such as analytics platforms, security services, payment processors, CRM systems, advertising platforms, or embedded content providers. These tools may set their own cookies according to their policies.', 'reviewservicepro'); ?></p>
    </section>

    <section class="rsp-page-card rsp-page-reveal mt-8 grid gap-5 border-blue-200 bg-white p-6 md:grid-cols-[1fr_auto] md:items-center md:p-8">
      <div>
        <h2 class="text-2xl font-[800]"><?php esc_html_e('Need more privacy information?', 'reviewservicepro'); ?></h2>
        <p class="rsp-page-text mt-2"><?php esc_html_e('Review our Privacy Policy or contact us for questions about cookie and tracking practices.', 'reviewservicepro'); ?></p>
      </div>

      <div class="flex flex-col gap-3 sm:flex-row">
        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="rsp-page-btn inline-flex min-h-[50px] items-center justify-center rounded-2xl bg-[#2563EB] px-6 py-3 font-bold text-white no-underline shadow-[0_14px_34px_rgba(37,99,235,0.22)] hover:bg-blue-700 hover:text-white">
          <span class="relative z-10"><?php esc_html_e('Privacy Policy', 'reviewservicepro'); ?></span>
        </a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex min-h-[50px] items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 font-bold text-[#3B4658] no-underline hover:bg-slate-50">
          <?php esc_html_e('Contact Us', 'reviewservicepro'); ?>
        </a>
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
