<?php

/**
 * Platforms Archive Template
 *
 * ReviewService.Pro — Premium White SaaS Platforms Archive
 *
 * File: archive-platforms.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$platform_count  = wp_count_posts('platforms');
$published_count = isset($platform_count->publish) ? (int) $platform_count->publish : 0;

$platform_terms = get_terms(
  [
    'taxonomy'   => 'platform_type',
    'hide_empty' => true,
    'number'     => 12,
  ]
);

$audit_url        = home_url('/contact/?type=free-audit');
$consultation_url = home_url('/contact/?type=consultation');
$services_url     = home_url('/services/');

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$trust_items = [
  [
    'icon' => 'layout-list',
    'text' => sprintf(
      /* translators: %d: published platform count */
      _n('%d platform guide', '%d platform guides', $published_count, 'reviewservicepro'),
      $published_count
    ),
    'tone' => 'blue',
  ],
  [
    'icon' => 'shield-check',
    'text' => __('Ethical ORM only', 'reviewservicepro'),
    'tone' => 'green',
  ],
  [
    'icon' => 'bot',
    'text' => __('AI/AEO ready', 'reviewservicepro'),
    'tone' => 'blue',
  ],
];

$strategy_cards = [
  [
    'icon'  => 'radar',
    'title' => __('Platform visibility', 'reviewservicepro'),
    'text'  => __('Understand where customers discover reviews, trust signals, profile details, and public reputation risks.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-square-text',
    'title' => __('Response expectations', 'reviewservicepro'),
    'text'  => __('Learn how each platform shapes response quality, tone, speed, and customer confidence.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'shield-check',
    'title' => __('Policy-safe support', 'reviewservicepro'),
    'text'  => __('Use ethical review monitoring, documentation, response support, and platform-compliant next steps.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$tone_classes = [
  'blue' => [
    'card' => 'border-blue-200 bg-blue-50/80 text-blue-700',
    'icon' => 'text-blue-600',
  ],
  'green' => [
    'card' => 'border-emerald-200 bg-emerald-50/80 text-emerald-700',
    'icon' => 'text-emerald-600',
  ],
  'teal' => [
    'card' => 'border-teal-200 bg-teal-50/80 text-teal-700',
    'icon' => 'text-teal-600',
  ],
];
?>

<main
  id="platforms-archive"
  class="relative overflow-hidden bg-white"
  role="main">

  <style>
    #platforms-archive {
      --rsp-platforms-title: #334155;
      --rsp-platforms-heading: #3B4658;
      --rsp-platforms-body: #64748B;
      --rsp-platforms-blue: #2563EB;
      --rsp-platforms-green: #00C853;
      --rsp-platforms-teal: #14B8A6;
      --rsp-platforms-border: rgba(148, 163, 184, 0.26);
    }

    #platforms-archive .rsp-platforms-title,
    #platforms-archive .rsp-platforms-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #platforms-archive .rsp-platforms-title {
      color: var(--rsp-platforms-title);
      text-wrap: balance;
    }

    #platforms-archive .rsp-platforms-heading {
      color: var(--rsp-platforms-heading);
    }

    #platforms-archive .rsp-platforms-text,
    #platforms-archive .rsp-platforms-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-platforms-body);
    }

    #platforms-archive .rsp-platforms-text {
      font-weight: 500;
    }

    #platforms-archive .rsp-platforms-body {
      font-weight: 400;
    }

    #platforms-archive .rsp-platforms-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #platforms-archive .rsp-platforms-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #platforms-archive .rsp-platforms-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #platforms-archive .rsp-platforms-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #platforms-archive .rsp-platforms-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.24),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.26),
          rgba(37, 99, 235, 0.08));
      opacity: 0.68;
      transform: rotate(0deg);
      animation: rspPlatformsBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #platforms-archive .rsp-platforms-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-platforms-inner, #ffffff);
      pointer-events: none;
    }

    #platforms-archive .rsp-platforms-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #platforms-archive .rsp-platforms-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platforms-archive .rsp-platforms-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #platforms-archive .rsp-platforms-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #platforms-archive .rsp-platforms-card:hover .rsp-platforms-card-image img {
      transform: scale(1.06);
    }

    #platforms-archive .rsp-platforms-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platforms-archive .rsp-platforms-btn::before {
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

    #platforms-archive .rsp-platforms-btn:hover {
      transform: translateY(-3px);
    }

    #platforms-archive .rsp-platforms-btn:hover::before {
      left: 135%;
    }

    #platforms-archive .rsp-platforms-pagination .nav-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.75rem;
    }

    #platforms-archive .rsp-platforms-pagination .page-numbers {
      display: inline-flex;
      min-width: 44px;
      height: 44px;
      align-items: center;
      justify-content: center;
      border-radius: 0.9rem;
      border: 1px solid rgba(148, 163, 184, 0.26);
      background: #ffffff;
      padding: 0 0.9rem;
      font-family: "Inter", sans-serif;
      font-size: 14px;
      font-weight: 800;
      color: #475569;
      box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
      transition:
        transform 220ms ease,
        background-color 220ms ease,
        border-color 220ms ease,
        color 220ms ease;
    }

    #platforms-archive .rsp-platforms-pagination .page-numbers:hover,
    #platforms-archive .rsp-platforms-pagination .page-numbers.current {
      transform: translateY(-2px);
      border-color: rgba(37, 99, 235, 0.28);
      background: #2563EB;
      color: #ffffff;
    }

    @keyframes rspPlatformsBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #platforms-archive *,
      #platforms-archive *::before,
      #platforms-archive *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #platforms-archive .rsp-platforms-reveal {
        opacity: 1;
        transform: none;
      }

      #platforms-archive .rsp-platforms-card:hover,
      #platforms-archive .rsp-platforms-btn:hover {
        transform: none;
      }

      #platforms-archive .rsp-platforms-card:hover .rsp-platforms-card-image img {
        transform: none;
      }
    }
  </style>

  <!-- Hero -->
  <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="mx-auto max-w-4xl text-center">

        <?php if (function_exists('rsp_breadcrumb')) : ?>
          <div class="rsp-platforms-reveal mb-8 flex justify-center" data-rsp-platforms-reveal>
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="rsp-platforms-eyebrow rsp-platforms-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-platforms-reveal>
          <?php echo $render_icon('star', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Review Platform Hub', 'reviewservicepro'); ?>
        </span>

        <h1 class="rsp-platforms-title rsp-platforms-reveal mx-auto text-[clamp(38px,5.6vw,74px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-platforms-reveal>
          <?php esc_html_e('Review Platform Reputation Management', 'reviewservicepro'); ?>
        </h1>

        <p class="rsp-platforms-text rsp-platforms-reveal mx-auto mt-6 max-w-3xl" data-rsp-platforms-reveal>
          <?php esc_html_e('Explore platform-specific ORM guides for Google Reviews, Trustpilot, Yelp, Facebook, BBB, Sitejabber, G2, Capterra, and other review ecosystems where trust shapes customer decisions.', 'reviewservicepro'); ?>
        </p>

        <div class="rsp-platforms-reveal mt-8 flex flex-wrap justify-center gap-3" data-rsp-platforms-reveal>
          <?php foreach ($trust_items as $item) : ?>
            <?php $tone = $tone_classes[$item['tone']] ?? $tone_classes['blue']; ?>

            <span class="<?php echo esc_attr($tone['card']); ?> inline-flex items-center gap-2 rounded-2xl border px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold shadow-sm">
              <?php echo $render_icon($item['icon'], 'h-4 w-4 ' . $tone['icon']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php echo esc_html($item['text']); ?>
            </span>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>

  <!-- Strategy Section -->
  <section class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-14 sm:px-6 lg:px-8 lg:py-16">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 gap-6 lg:grid-cols-[1fr_0.72fr] lg:items-stretch">

      <div class="rsp-platforms-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-platforms-reveal>
        <span class="rsp-platforms-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
          <?php echo $render_icon('compass', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Platform Strategy', 'reviewservicepro'); ?>
        </span>

        <h2 class="rsp-platforms-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
          <?php esc_html_e('Find the right reputation strategy for each platform.', 'reviewservicepro'); ?>
        </h2>

        <p class="rsp-platforms-body mt-5 max-w-3xl">
          <?php esc_html_e('Every review platform has different trust signals, response expectations, visibility patterns, and policy rules. These platform pages help businesses understand where reputation risks appear and how ethical review management can improve customer confidence.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 grid grid-cols-1 gap-4 md:grid-cols-3">
          <?php foreach ($strategy_cards as $index => $card) : ?>
            <?php $tone = $tone_classes[$card['tone']] ?? $tone_classes['blue']; ?>

            <div class="rsp-platforms-card rounded-[1.4rem] border <?php echo esc_attr($tone['card']); ?> p-5" style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
              <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl border border-white bg-white shadow-sm">
                <?php echo $render_icon($card['icon'], 'h-5 w-5 ' . $tone['icon']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>

              <h3 class="rsp-platforms-heading text-lg font-[800] leading-tight tracking-[-0.03em]">
                <?php echo esc_html($card['title']); ?>
              </h3>

              <p class="mt-3 font-['Inter',sans-serif] text-sm font-medium leading-7 text-[#64748B]">
                <?php echo esc_html($card['text']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="rsp-platforms-reveal rsp-platforms-motion-border rounded-[2rem] border border-blue-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-platforms-reveal style="--rsp-platforms-inner:#ffffff;">
        <div class="relative z-10 flex h-full flex-col justify-between">
          <div>
            <span class="rsp-platforms-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700">
              <?php echo $render_icon('search-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Need a reputation audit?', 'reviewservicepro'); ?>
            </span>

            <h2 class="rsp-platforms-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
              <?php esc_html_e('See which platform gaps are hurting trust.', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-platforms-body mt-5">
              <?php esc_html_e('Get a clear review of rating risks, unanswered reviews, trust gaps, and platform-specific improvement opportunities.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="mt-7 flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($audit_url); ?>" class="rsp-platforms-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>

            <a href="<?php echo esc_url($services_url); ?>" class="rsp-platforms-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Explore ORM Services', 'reviewservicepro'); ?>
                <?php echo $render_icon('external-link', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Platform Library -->
  <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="platforms-grid-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">

      <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="rsp-platforms-reveal max-w-3xl" data-rsp-platforms-reveal>
          <span class="rsp-platforms-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
            <?php echo $render_icon('layout-grid', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Platform Library', 'reviewservicepro'); ?>
          </span>

          <h2 id="platforms-grid-title" class="rsp-platforms-title mt-4 text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
            <?php esc_html_e('Browse reputation platform guides', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-platforms-text mt-5 max-w-2xl">
            <?php esc_html_e('Search or browse review platforms to understand platform-specific reputation risks, trust signals, response workflows, and ethical ORM opportunities.', 'reviewservicepro'); ?>
          </p>
        </div>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="rsp-platforms-reveal w-full max-w-md" data-rsp-platforms-reveal>
          <label for="platform-search" class="sr-only">
            <?php esc_html_e('Search platforms', 'reviewservicepro'); ?>
          </label>

          <div class="relative">
            <input
              id="platform-search"
              type="search"
              name="s"
              placeholder="<?php esc_attr_e('Search review platforms...', 'reviewservicepro'); ?>"
              class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 pr-14 font-['Inter',sans-serif] text-[16px] font-medium text-[#334155] shadow-[0_14px_40px_rgba(15,23,42,0.06)] placeholder:text-slate-400 focus:border-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-100">
            <input type="hidden" name="post_type" value="platforms">

            <button type="submit" class="absolute right-2 top-1/2 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-xl bg-blue-600 text-white transition-colors duration-200 hover:bg-blue-700">
              <span class="sr-only"><?php esc_html_e('Search', 'reviewservicepro'); ?></span>
              <?php echo $render_icon('search', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </button>
          </div>
        </form>
      </div>

      <?php if (! empty($platform_terms) && ! is_wp_error($platform_terms)) : ?>
        <div class="rsp-platforms-reveal mb-10 flex flex-wrap gap-3" data-rsp-platforms-reveal>
          <?php foreach ($platform_terms as $term) : ?>
            <?php
            $term_link = get_term_link($term);

            if (is_wp_error($term_link)) {
              continue;
            }
            ?>

            <a
              href="<?php echo esc_url($term_link); ?>"
              class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-[800] text-[#3B4658] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
              <?php echo esc_html($term->name); ?>
              <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs text-slate-500">
                <?php echo esc_html((string) $term->count); ?>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          $post_index = 0;

          while (have_posts()) :
            the_post();

            $post_terms = get_the_terms(get_the_ID(), 'platform_type');
            $delay      = min($post_index * 70, 420);
          ?>

            <article
              id="post-<?php the_ID(); ?>"
              <?php post_class('rsp-platforms-card rsp-platforms-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
              data-rsp-platforms-reveal
              style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">

              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-platforms-card-image h-56 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <?php echo $render_icon('monitor-check', 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="p-6">
                  <div class="mb-4 flex flex-wrap items-center gap-2">
                    <?php if (! empty($post_terms) && ! is_wp_error($post_terms)) : ?>
                      <?php foreach (array_slice($post_terms, 0, 2) as $post_term) : ?>
                        <span class="rsp-platforms-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                          <?php echo esc_html($post_term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <span class="rsp-platforms-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
                        <?php esc_html_e('Platform Guide', 'reviewservicepro'); ?>
                      </span>
                    <?php endif; ?>
                  </div>

                  <h3 class="rsp-platforms-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                    <?php the_title(); ?>
                  </h3>

                  <p class="rsp-platforms-body mt-4">
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?>
                  </p>

                  <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                    <span class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500">
                      <?php echo esc_html(get_the_date()); ?>
                    </span>

                    <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                      <?php esc_html_e('Read guide', 'reviewservicepro'); ?>
                      <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                      ?>
                    </span>
                  </div>
                </div>
              </a>
            </article>

          <?php
            $post_index++;
          endwhile;
          ?>
        </div>

        <div class="rsp-platforms-pagination mt-12">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
              'next_text'          => esc_html__('Next', 'reviewservicepro'),
              'screen_reader_text' => esc_html__('Platforms pagination', 'reviewservicepro'),
            ]
          );
          ?>
        </div>

      <?php else : ?>
        <div class="rsp-platforms-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platforms-reveal>
          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-red-200 bg-red-50 text-red-600">
            <?php echo $render_icon('search-x', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h2 class="rsp-platforms-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
            <?php esc_html_e('No platform guides found', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-platforms-text mx-auto mt-4 max-w-xl">
            <?php esc_html_e('No review platform pages are available yet. Add platform pages from the WordPress dashboard to build your ORM platform hub.', 'reviewservicepro'); ?>
          </p>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- Final CTA -->
  <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-platforms-reveal rsp-platforms-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-platforms-reveal style="--rsp-platforms-inner:#ffffff;">
        <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.55fr] lg:items-center">
          <div>
            <span class="rsp-platforms-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
              <?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Ethical Platform ORM', 'reviewservicepro'); ?>
            </span>

            <h2 class="rsp-platforms-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
              <?php esc_html_e('Not sure which review platform matters most?', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-platforms-text mt-5 max-w-2xl">
              <?php esc_html_e('We can audit your current reputation presence and identify which platforms, review signals, and response gaps should be prioritized first.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($audit_url); ?>" class="rsp-platforms-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>

            <a href="<?php echo esc_url($consultation_url); ?>" class="rsp-platforms-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
                <?php echo $render_icon('calendar-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<script>
  (function() {
    function initRspPlatformsArchive() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-platforms-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformsVisible === 'true') {
          return;
        }

        item.dataset.rspPlatformsVisible = 'true';
        item.classList.add('rsp-visible');
      }

      if ('IntersectionObserver' in window && items.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              reveal(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });

        return;
      }

      items.forEach(reveal);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPlatformsArchive);
    } else {
      initRspPlatformsArchive();
    }
  })();
</script>

<?php
get_footer();
