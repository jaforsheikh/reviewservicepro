<?php

/**
 * Template Name: Disclaimer Page
 *
 * ReviewService.Pro — Compact White SaaS Disclaimer
 *
 * File: page-templates/template-disclaimer.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$last_updated = date_i18n('F Y');

$summary_cards = [
  [
    'icon'  => 'trending-up',
    'title' => __('No Ranking Guarantees', 'reviewservicepro'),
    'desc'  => __('Search rankings and map visibility depend on third-party algorithms, competition, and business activity.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'trash-2',
    'title' => __('No Review Removal Guarantees', 'reviewservicepro'),
    'desc'  => __('Only review platforms decide whether a review qualifies for removal under their policies.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'star',
    'title' => __('No Rating Guarantees', 'reviewservicepro'),
    'desc'  => __('Customer ratings depend on real customer experiences and cannot be ethically controlled.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'ban',
    'title' => __('No Fake Reviews', 'reviewservicepro'),
    'desc'  => __('We do not create, sell, buy, or manipulate reviews. Our work is platform-compliant.', 'reviewservicepro'),
  ],
];

$disclaimer_sections = [
  [
    'icon'  => 'map',
    'title' => __('No Guaranteed Rankings', 'reviewservicepro'),
    'text'  => __('ReviewService.Pro may provide local trust, review response, platform optimization, and reputation strategy support. We do not guarantee search rankings, Google Maps positions, Local Pack placement, organic visibility, traffic growth, or specific algorithmic outcomes.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'shield-alert',
    'title' => __('No Guaranteed Review Removal', 'reviewservicepro'),
    'text'  => __('We may help identify reviews that appear to violate platform policies and guide clients through official reporting steps. We cannot guarantee that Google, Yelp, Trustpilot, Facebook, BBB, or any other platform will remove a review.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'message-square',
    'title' => __('Review Response Support Is Not Legal Advice', 'reviewservicepro'),
    'text'  => __('Review response drafts, documentation guidance, and reputation recommendations are business communication support only. They are not legal, financial, medical, or regulatory advice. Clients should consult qualified professionals where required.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'user-check',
    'title' => __('Ethical Customer Feedback Only', 'reviewservicepro'),
    'text'  => __('Feedback workflows should request genuine customer feedback without pressure, incentives, gating, manipulation, or selective targeting that violates platform policies. We do not provide fake review services or rating manipulation.', 'reviewservicepro'),
  ],
];

get_header();
?>

<div id="disclaimer-page" class="rsp-page-shell relative overflow-hidden bg-[#F8FAFC] px-5 py-14 sm:px-6 lg:px-8 lg:py-16">

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
        <i data-lucide="shield-alert" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Service Disclaimer', 'reviewservicepro'); ?>
      </span>

      <h1 class="rsp-page-title mx-auto mt-5">
        <?php esc_html_e('Transparent limits for ethical reputation services.', 'reviewservicepro'); ?>
      </h1>

      <p class="rsp-page-text mx-auto mt-5 max-w-3xl">
        <?php esc_html_e('Our services focus on responsible monitoring, documentation, response support, reporting, and platform-compliant improvement workflows — not manipulation or guaranteed outcomes.', 'reviewservicepro'); ?>
      </p>

      <p class="mt-6 text-sm font-bold text-[#64748B]">
        <?php esc_html_e('Last updated:', 'reviewservicepro'); ?> <?php echo esc_html($last_updated); ?>
      </p>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
      <?php foreach ($summary_cards as $index => $card) : ?>
        <article class="rsp-page-card rsp-page-reveal p-6" style="animation-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
            <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
          </div>
          <h2 class="text-xl font-[800] leading-tight"><?php echo esc_html($card['title']); ?></h2>
          <p class="mt-3 text-[15px] leading-7 text-[#64748B]"><?php echo esc_html($card['desc']); ?></p>
        </article>
      <?php endforeach; ?>
    </section>

    <section class="mt-8 grid gap-5">
      <?php foreach ($disclaimer_sections as $index => $section) : ?>
        <article class="rsp-page-card rsp-page-prose rsp-page-reveal p-6 md:p-8" style="animation-delay: <?php echo esc_attr((string) min($index * 55, 320)); ?>ms;">
          <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 text-emerald-600">
            <i data-lucide="<?php echo esc_attr($section['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
          </div>
          <h2><?php echo esc_html($section['title']); ?></h2>
          <p><?php echo esc_html($section['text']); ?></p>
        </article>
      <?php endforeach; ?>
    </section>

    <section class="rsp-page-card rsp-page-reveal mt-8 grid gap-5 border-emerald-200 bg-white p-6 md:grid-cols-[1fr_auto] md:items-center md:p-8">
      <div>
        <h2 class="text-2xl font-[800]"><?php esc_html_e('Want to understand our ethical service approach?', 'reviewservicepro'); ?></h2>
        <p class="rsp-page-text mt-2"><?php esc_html_e('Visit the Trust Center for our compliance standards and service boundaries.', 'reviewservicepro'); ?></p>
      </div>

      <a href="<?php echo esc_url(home_url('/trust-center/')); ?>" class="rsp-page-btn inline-flex min-h-[50px] items-center justify-center rounded-2xl bg-[#2563EB] px-6 py-3 font-bold text-white no-underline shadow-[0_14px_34px_rgba(37,99,235,0.22)] hover:bg-blue-700 hover:text-white">
        <span class="relative z-10"><?php esc_html_e('View Trust Center', 'reviewservicepro'); ?></span>
      </a>
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
