<?php

/**
 * Industry Type Taxonomy Archive Template
 *
 * ReviewService.Pro — Premium White SaaS Industry Taxonomy Archive
 *
 * File: taxonomy-industry_type.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$term = get_queried_object();

$term_name = ($term && ! is_wp_error($term) && ! empty($term->name))
  ? $term->name
  : __('Industry Type', 'reviewservicepro');

$term_description = term_description();

$term_count = ($term && ! is_wp_error($term) && isset($term->count))
  ? (int) $term->count
  : 0;

$industry_archive_url = get_post_type_archive_link('industries');
$industry_archive_url = $industry_archive_url ? $industry_archive_url : home_url('/industries/');

$audit_url        = home_url('/contact/?type=audit');
$consultation_url = home_url('/contact/?type=consultation');
$services_url     = home_url('/services/');
$case_studies_url = home_url('/case-studies/');

$insight_cards = [
  [
    'icon'  => 'map-pin',
    'title' => __('Local trust starts before contact', 'reviewservicepro'),
    'text'  => __('Customers often check reviews, profile quality, business details, and response activity before they call or book.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-square-heart',
    'title' => __('Response quality shapes confidence', 'reviewservicepro'),
    'text'  => __('Professional review responses help businesses show care, accountability, and customer-first communication.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'shield-check',
    'title' => __('Ethical ORM protects reputation', 'reviewservicepro'),
    'text'  => __('Safe reputation systems focus on real feedback, monitoring, documentation, reporting, and platform-compliant action.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$tone_classes = [
  'blue' => [
    'card' => 'border-blue-200 bg-blue-50/80',
    'icon' => 'border-blue-200 bg-white text-blue-600',
  ],
  'green' => [
    'card' => 'border-emerald-200 bg-emerald-50/80',
    'icon' => 'border-emerald-200 bg-white text-emerald-600',
  ],
  'teal' => [
    'card' => 'border-teal-200 bg-teal-50/80',
    'icon' => 'border-teal-200 bg-white text-teal-600',
  ],
];

$related_case_studies = null;

if ($term && ! is_wp_error($term) && ! empty($term->term_id)) {
  $related_case_studies = new WP_Query(
    [
      'post_type'           => 'case_studies',
      'post_status'         => 'publish',
      'posts_per_page'      => 3,
      'ignore_sticky_posts' => true,
      'tax_query'           => [
        [
          'taxonomy' => 'industry_type',
          'field'    => 'term_id',
          'terms'    => absint($term->term_id),
        ],
      ],
    ]
  );
}
?>

<main
  id="primary"
  class="relative overflow-hidden bg-white"
  role="main">

  <style>
    #primary {
      --rsp-industry-title: #334155;
      --rsp-industry-heading: #3B4658;
      --rsp-industry-body: #64748B;
      --rsp-industry-blue: #2563EB;
      --rsp-industry-green: #00C853;
      --rsp-industry-teal: #14B8A6;
      --rsp-industry-border: rgba(148, 163, 184, 0.26);
    }

    #primary .rsp-industry-title,
    #primary .rsp-industry-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #primary .rsp-industry-title {
      color: var(--rsp-industry-title);
      text-wrap: balance;
    }

    #primary .rsp-industry-heading {
      color: var(--rsp-industry-heading);
    }

    #primary .rsp-industry-text,
    #primary .rsp-industry-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-industry-body);
    }

    #primary .rsp-industry-text {
      font-weight: 500;
    }

    #primary .rsp-industry-body {
      font-weight: 400;
    }

    #primary .rsp-industry-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #primary .rsp-industry-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #primary .rsp-industry-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #primary .rsp-industry-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #primary .rsp-industry-motion-border::before {
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
      animation: rspIndustryBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #primary .rsp-industry-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-industry-inner, #ffffff);
      pointer-events: none;
    }

    #primary .rsp-industry-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #primary .rsp-industry-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #primary .rsp-industry-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #primary .rsp-industry-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #primary .rsp-industry-card:hover .rsp-industry-card-image img {
      transform: scale(1.06);
    }

    #primary .rsp-industry-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #primary .rsp-industry-btn::before {
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

    #primary .rsp-industry-btn:hover {
      transform: translateY(-3px);
    }

    #primary .rsp-industry-btn:hover::before {
      left: 135%;
    }

    #primary .rsp-industry-pagination .nav-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.75rem;
    }

    #primary .rsp-industry-pagination .page-numbers {
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

    #primary .rsp-industry-pagination .page-numbers:hover,
    #primary .rsp-industry-pagination .page-numbers.current {
      transform: translateY(-2px);
      border-color: rgba(37, 99, 235, 0.28);
      background: #2563EB;
      color: #ffffff;
    }

    @keyframes rspIndustryBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #primary *,
      #primary *::before,
      #primary *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #primary .rsp-industry-reveal {
        opacity: 1;
        transform: none;
      }

      #primary .rsp-industry-card:hover,
      #primary .rsp-industry-btn:hover {
        transform: none;
      }

      #primary .rsp-industry-card:hover .rsp-industry-card-image img {
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
          <div class="rsp-industry-reveal mb-8 flex justify-center" data-rsp-industry-reveal>
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="rsp-industry-eyebrow rsp-industry-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-industry-reveal>
          <i data-lucide="briefcase-business" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Industry Category', 'reviewservicepro'); ?>
        </span>

        <h1 class="rsp-industry-title rsp-industry-reveal mx-auto text-[clamp(38px,5.5vw,72px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-industry-reveal>
          <?php echo esc_html($term_name); ?>
        </h1>

        <div class="rsp-industry-text rsp-industry-reveal mx-auto mt-6 max-w-3xl" data-rsp-industry-reveal>
          <?php
          if (! empty($term_description)) {
            echo wp_kses_post(wpautop($term_description));
          } else {
            printf(
              esc_html__('Explore %s reputation management resources, review response guidance, local trust strategies, and ethical ORM support for businesses that depend on customer confidence.', 'reviewservicepro'),
              esc_html($term_name)
            );
          }
          ?>
        </div>

        <div class="rsp-industry-reveal mt-8 flex flex-wrap justify-center gap-3" data-rsp-industry-reveal>
          <span class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600 shadow-sm">
            <i data-lucide="layout-list" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
            <?php echo esc_html($term_count); ?>
            <?php esc_html_e('industry resources', 'reviewservicepro'); ?>
          </span>

          <span class="inline-flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-emerald-700 shadow-sm">
            <i data-lucide="shield-check" class="h-4 w-4 text-emerald-600" aria-hidden="true"></i>
            <?php esc_html_e('Ethical ORM guidance', 'reviewservicepro'); ?>
          </span>

          <span class="inline-flex items-center gap-2 rounded-2xl border border-blue-200 bg-blue-50 px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-blue-700 shadow-sm">
            <i data-lucide="map-pin-check" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
            <?php esc_html_e('Local trust focused', 'reviewservicepro'); ?>
          </span>
        </div>

      </div>
    </div>
  </section>

  <!-- Industry Strategy + Audit CTA -->
  <section class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-14 sm:px-6 lg:px-8 lg:py-16">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 gap-6 lg:grid-cols-[1fr_0.72fr] lg:items-stretch">

      <div class="rsp-industry-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-industry-reveal>
        <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
          <i data-lucide="compass" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Industry Reputation Strategy', 'reviewservicepro'); ?>
        </span>

        <h2 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
          <?php
          printf(
            esc_html__('Why %s reputation strategy needs its own approach', 'reviewservicepro'),
            esc_html($term_name)
          );
          ?>
        </h2>

        <p class="rsp-industry-body mt-5 max-w-3xl">
          <?php esc_html_e('Every industry has different trust triggers. Restaurants need review freshness and response speed. Clinics need careful, professional communication. Real estate professionals need credibility signals. Service businesses need consistent local proof. Industry-specific ORM helps prioritize the right platforms, responses, and trust signals.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 grid grid-cols-1 gap-4 md:grid-cols-3">
          <?php foreach ($insight_cards as $index => $insight) : ?>
            <?php $tone = $tone_classes[$insight['tone']] ?? $tone_classes['blue']; ?>

            <div class="rsp-industry-card rounded-[1.4rem] border <?php echo esc_attr($tone['card']); ?> p-5" style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
              <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl border <?php echo esc_attr($tone['icon']); ?> shadow-sm">
                <i data-lucide="<?php echo esc_attr($insight['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
              </div>

              <h3 class="rsp-industry-heading text-lg font-[800] leading-tight tracking-[-0.03em]">
                <?php echo esc_html($insight['title']); ?>
              </h3>

              <p class="rsp-industry-body mt-3 text-sm leading-7">
                <?php echo esc_html($insight['text']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="rsp-industry-reveal rsp-industry-motion-border rounded-[2rem] border border-blue-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-industry-reveal style="--rsp-industry-inner:#ffffff;">
        <div class="relative z-10 flex h-full flex-col justify-between">
          <div>
            <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700">
              <i data-lucide="search-check" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Need an industry audit?', 'reviewservicepro'); ?>
            </span>

            <h2 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
              <?php esc_html_e('See what customers notice before they contact you.', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-industry-body mt-5">
              <?php esc_html_e('Get a review of your public review profile, customer trust signals, response quality, platform consistency, and ethical feedback opportunities.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="mt-7 flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($audit_url); ?>" class="rsp-industry-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </span>
            </a>

            <a href="<?php echo esc_url($services_url); ?>" class="rsp-industry-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Explore ORM Services', 'reviewservicepro'); ?>
                <i data-lucide="external-link" class="h-4 w-4" aria-hidden="true"></i>
              </span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Industry Resource Grid -->
  <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="industry-taxonomy-grid-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">

      <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="rsp-industry-reveal max-w-3xl" data-rsp-industry-reveal>
          <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
            <i data-lucide="layout-grid" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Industry Resources', 'reviewservicepro'); ?>
          </span>

          <h2 id="industry-taxonomy-grid-title" class="rsp-industry-title mt-4 text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
            <?php
            printf(
              esc_html__('%s ORM guides and resources', 'reviewservicepro'),
              esc_html($term_name)
            );
            ?>
          </h2>

          <p class="rsp-industry-text mt-5 max-w-2xl">
            <?php esc_html_e('Explore industry-specific reputation management guides designed to improve review monitoring, response quality, customer trust, and local business credibility.', 'reviewservicepro'); ?>
          </p>
        </div>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="rsp-industry-reveal w-full max-w-md" data-rsp-industry-reveal>
          <label for="industry-taxonomy-search" class="sr-only">
            <?php esc_html_e('Search industries', 'reviewservicepro'); ?>
          </label>

          <div class="relative">
            <input
              id="industry-taxonomy-search"
              type="search"
              name="s"
              placeholder="<?php esc_attr_e('Search industry guides...', 'reviewservicepro'); ?>"
              class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 pr-14 font-['Inter',sans-serif] text-[16px] font-medium text-[#334155] shadow-[0_14px_40px_rgba(15,23,42,0.06)] placeholder:text-slate-400 focus:border-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-100">
            <input type="hidden" name="post_type" value="industries">

            <button type="submit" class="absolute right-2 top-1/2 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-xl bg-blue-600 text-white transition-colors duration-200 hover:bg-blue-700">
              <span class="sr-only"><?php esc_html_e('Search', 'reviewservicepro'); ?></span>
              <i data-lucide="search" class="h-4 w-4" aria-hidden="true"></i>
            </button>
          </div>
        </form>
      </div>

      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          $post_index = 0;

          while (have_posts()) :
            the_post();

            $industry_terms = get_the_terms(get_the_ID(), 'industry_type');
            $card_delay     = min($post_index * 70, 420);
          ?>

            <article
              id="post-<?php the_ID(); ?>"
              <?php post_class('rsp-industry-card rsp-industry-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
              data-rsp-industry-reveal
              style="transition-delay: <?php echo esc_attr((string) $card_delay); ?>ms;">

              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-industry-card-image h-56 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <i data-lucide="briefcase-business" class="h-8 w-8" aria-hidden="true"></i>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="p-6">
                  <div class="mb-4 flex flex-wrap items-center gap-2">
                    <?php if (! empty($industry_terms) && ! is_wp_error($industry_terms)) : ?>
                      <?php foreach (array_slice($industry_terms, 0, 2) as $industry_term) : ?>
                        <span class="rsp-industry-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                          <?php echo esc_html($industry_term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <span class="rsp-industry-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
                        <?php esc_html_e('Industry Guide', 'reviewservicepro'); ?>
                      </span>
                    <?php endif; ?>
                  </div>

                  <h3 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                    <?php the_title(); ?>
                  </h3>

                  <p class="rsp-industry-body mt-4">
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?>
                  </p>

                  <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                    <span class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500">
                      <?php echo esc_html(get_the_date()); ?>
                    </span>

                    <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                      <?php esc_html_e('Read guide', 'reviewservicepro'); ?>
                      <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
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

        <div class="rsp-industry-pagination mt-12">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
              'next_text'          => esc_html__('Next', 'reviewservicepro'),
              'screen_reader_text' => esc_html__('Industry type pagination', 'reviewservicepro'),
            ]
          );
          ?>
        </div>

      <?php else : ?>
        <div class="rsp-industry-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-industry-reveal>
          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-red-200 bg-red-50 text-red-600">
            <i data-lucide="search-x" class="h-7 w-7" aria-hidden="true"></i>
          </div>

          <h2 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
            <?php esc_html_e('No industry resources found', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-industry-text mx-auto mt-4 max-w-xl">
            <?php esc_html_e('No industry resources are available in this category yet. Add industry guides from the WordPress dashboard to grow this taxonomy archive.', 'reviewservicepro'); ?>
          </p>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- Related Case Studies -->
  <?php if ($related_case_studies instanceof WP_Query && $related_case_studies->have_posts()) : ?>
    <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="industry-related-case-studies-title">
      <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.055),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.055),transparent_30%)]" aria-hidden="true"></div>

      <div class="relative z-10 mx-auto max-w-7xl">
        <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div class="rsp-industry-reveal max-w-3xl" data-rsp-industry-reveal>
            <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
              <i data-lucide="chart-no-axes-combined" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Related Case Studies', 'reviewservicepro'); ?>
            </span>

            <h2 id="industry-related-case-studies-title" class="rsp-industry-title mt-4 text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
              <?php esc_html_e('See how reputation systems work in practice.', 'reviewservicepro'); ?>
            </h2>
          </div>

          <a href="<?php echo esc_url($case_studies_url); ?>" class="rsp-industry-reveal inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 font-['Inter',sans-serif] text-sm font-[800] text-[#3B4658] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700" data-rsp-industry-reveal>
            <?php esc_html_e('View All Case Studies', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <?php
          $case_index = 0;

          while ($related_case_studies->have_posts()) :
            $related_case_studies->the_post();

            $case_delay = min($case_index * 70, 280);
          ?>

            <article
              id="case-study-<?php the_ID(); ?>"
              <?php post_class('rsp-industry-card rsp-industry-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
              data-rsp-industry-reveal
              style="transition-delay: <?php echo esc_attr((string) $case_delay); ?>ms;">

              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-industry-card-image h-52 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <i data-lucide="file-chart-column" class="h-8 w-8" aria-hidden="true"></i>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="p-6">
                  <span class="rsp-industry-eyebrow mb-4 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
                    <?php esc_html_e('Case Study', 'reviewservicepro'); ?>
                  </span>

                  <h3 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                    <?php the_title(); ?>
                  </h3>

                  <p class="rsp-industry-body mt-4">
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?>
                  </p>

                  <div class="mt-6 border-t border-slate-200 pt-5">
                    <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                      <?php esc_html_e('Read case study', 'reviewservicepro'); ?>
                      <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
              </a>
            </article>

          <?php
            $case_index++;
          endwhile;
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Final CTA -->
  <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-industry-reveal rsp-industry-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-industry-reveal style="--rsp-industry-inner:#ffffff;">
        <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.55fr] lg:items-center">
          <div>
            <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
              <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Ethical Industry ORM', 'reviewservicepro'); ?>
            </span>

            <h2 class="rsp-industry-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
              <?php
              printf(
                esc_html__('Want a reputation plan for your %s business?', 'reviewservicepro'),
                esc_html($term_name)
              );
              ?>
            </h2>

            <p class="rsp-industry-text mt-5 max-w-2xl">
              <?php esc_html_e('We can audit your current review presence and identify the platforms, response gaps, customer trust issues, and reporting needs that should be prioritized first.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($audit_url); ?>" class="rsp-industry-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </span>
            </a>

            <a href="<?php echo esc_url($consultation_url); ?>" class="rsp-industry-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
                <i data-lucide="calendar-check" class="h-4 w-4" aria-hidden="true"></i>
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
    function initRspIndustryTaxonomy() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-industry-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspIndustryVisible === 'true') {
          return;
        }

        item.dataset.rspIndustryVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspIndustryTaxonomy);
    } else {
      initRspIndustryTaxonomy();
    }
  })();
</script>

<?php
get_footer();
