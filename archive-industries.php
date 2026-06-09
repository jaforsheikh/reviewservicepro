<?php

/**
 * Industries Archive Template
 *
 * ReviewService.Pro — Premium White SaaS Industries Archive
 *
 * File: archive-industries.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$industry_count  = wp_count_posts('industries');
$published_count = isset($industry_count->publish) ? (int) $industry_count->publish : 0;
$archive_title   = __('Industry Reputation Management Guides', 'reviewservicepro');

$industry_cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('industry') : home_url('/contact/?type=industry-audit');
$consultation_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('consultation') : home_url('/contact/?type=consultation');
$services_url     = home_url('/services/');

$trust_stats = [
  [
    'icon'  => 'building-2',
    'value' => $published_count ? $published_count . '+' : '0',
    'label' => __('industry guides', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'shield-check',
    'value' => __('Ethical', 'reviewservicepro'),
    'label' => __('ORM strategies only', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'radar',
    'value' => __('Audit', 'reviewservicepro'),
    'label' => __('trust gaps by industry', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$industry_terms = get_terms(
  [
    'taxonomy'   => 'industry_type',
    'hide_empty' => true,
    'number'     => 10,
  ]
);

$strategy_cards = [
  [
    'icon'  => 'map-pin-check',
    'title' => __('Local trust signals', 'reviewservicepro'),
    'text'  => __('Understand what customers check before they call, book, visit, or request a quote in each industry.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-square-heart',
    'title' => __('Review response quality', 'reviewservicepro'),
    'text'  => __('Build calm, professional, and customer-focused response systems that fit your business category.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'clipboard-check',
    'title' => __('Platform priorities', 'reviewservicepro'),
    'text'  => __('Identify which review platforms, directories, and local trust signals deserve the most attention first.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$tone_classes = [
  'blue'  => 'border-blue-200 bg-blue-50 text-blue-700',
  'green' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
  'teal'  => 'border-teal-200 bg-teal-50 text-teal-700',
];
?>

<div id="industries-archive" class="relative overflow-hidden bg-white" role="main">
  <style>
    #industries-archive {
      --rsp-industry-title: #334155;
      --rsp-industry-heading: #3B4658;
      --rsp-industry-body: #64748B;
    }

    #industries-archive .rsp-industry-title,
    #industries-archive .rsp-industry-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      text-wrap: balance;
    }

    #industries-archive .rsp-industry-title {
      color: var(--rsp-industry-title);
    }

    #industries-archive .rsp-industry-heading {
      color: var(--rsp-industry-heading);
    }

    #industries-archive .rsp-industry-text,
    #industries-archive .rsp-industry-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-industry-body);
    }

    #industries-archive .rsp-industry-text {
      font-weight: 500;
    }

    #industries-archive .rsp-industry-body {
      font-weight: 400;
    }

    #industries-archive .rsp-industry-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industries-archive .rsp-industry-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industries-archive .rsp-industry-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industries-archive .rsp-industry-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #industries-archive .rsp-industry-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #industries-archive .rsp-industry-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #industries-archive .rsp-industry-card:hover .rsp-industry-card-image img {
      transform: scale(1.06);
    }

    #industries-archive .rsp-industry-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #industries-archive .rsp-industry-motion-border::before {
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

    #industries-archive .rsp-industry-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-industry-inner, #ffffff);
      pointer-events: none;
    }

    #industries-archive .rsp-industry-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #industries-archive .rsp-industry-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #industries-archive .rsp-industry-btn::before {
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

    #industries-archive .rsp-industry-btn:hover {
      transform: translateY(-3px);
    }

    #industries-archive .rsp-industry-btn:hover::before {
      left: 135%;
    }

    #industries-archive .rsp-industry-pagination .nav-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.75rem;
    }

    #industries-archive .rsp-industry-pagination .page-numbers {
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
      transition: transform 220ms ease, background-color 220ms ease, border-color 220ms ease, color 220ms ease;
    }

    #industries-archive .rsp-industry-pagination .page-numbers:hover,
    #industries-archive .rsp-industry-pagination .page-numbers.current {
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

      #industries-archive *,
      #industries-archive *::before,
      #industries-archive *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      #industries-archive .rsp-industry-reveal {
        opacity: 1;
        transform: none;
      }

      #industries-archive .rsp-industry-card:hover,
      #industries-archive .rsp-industry-btn:hover {
        transform: none;
      }

      #industries-archive .rsp-industry-card:hover .rsp-industry-card-image img {
        transform: none;
      }
    }
  </style>

  <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24" aria-labelledby="industry-archive-title">
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
          <?php echo $render_icon('building-2', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Industry Trust Hub', 'reviewservicepro'); ?>
        </span>

        <h1 id="industry-archive-title" class="rsp-industry-title rsp-industry-reveal mx-auto text-[clamp(38px,5.6vw,74px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-industry-reveal>
          <?php echo esc_html($archive_title); ?>
        </h1>

        <p class="rsp-industry-text rsp-industry-reveal mx-auto mt-6 max-w-3xl" data-rsp-industry-reveal>
          <?php esc_html_e('Explore reputation management guides for restaurants, salons, clinics, real estate, ecommerce, agencies, local services, and other businesses where customer trust directly affects conversions.', 'reviewservicepro'); ?>
        </p>

        <div class="rsp-industry-reveal mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3" data-rsp-industry-reveal>
          <?php foreach ($trust_stats as $stat) : ?>
            <?php $tone_class = $tone_classes[$stat['tone']] ?? $tone_classes['blue']; ?>
            <div class="rounded-2xl border <?php echo esc_attr($tone_class); ?> px-5 py-5 text-center shadow-sm">
              <div class="mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-white shadow-sm">
                <?php echo $render_icon($stat['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>
              <p class="font-['Poppins',sans-serif] text-2xl font-[800] leading-none"><?php echo esc_html((string) $stat['value']); ?></p>
              <p class="mt-2 font-['Inter',sans-serif] text-sm font-semibold opacity-80"><?php echo esc_html($stat['label']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-14 sm:px-6 lg:px-8 lg:py-16">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-industry-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-industry-reveal>
        <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
          <?php echo $render_icon('compass', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Industry Reputation Strategy', 'reviewservicepro'); ?>
        </span>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
          <div>
            <h2 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
              <?php esc_html_e('Different industries need different reputation systems.', 'reviewservicepro'); ?>
            </h2>
            <p class="rsp-industry-body mt-5">
              <?php esc_html_e('A clinic, restaurant, law firm, agency, and ecommerce store do not face the same reputation risks. These guides help prioritize the right platforms, trust signals, review response workflows, and ethical feedback systems.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <?php foreach ($strategy_cards as $index => $card) : ?>
              <?php $tone_class = $tone_classes[$card['tone']] ?? $tone_classes['blue']; ?>
              <div class="rsp-industry-card rounded-[1.4rem] border <?php echo esc_attr($tone_class); ?> p-5" style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-white shadow-sm">
                  <?php echo $render_icon($card['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </div>
                <h3 class="rsp-industry-heading text-lg font-[800] leading-tight tracking-[-0.03em]"><?php echo esc_html($card['title']); ?></h3>
                <p class="mt-3 font-['Inter',sans-serif] text-sm font-medium leading-7 text-[#64748B]"><?php echo esc_html($card['text']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="industry-grid-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="rsp-industry-reveal max-w-3xl" data-rsp-industry-reveal>
          <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
            <?php echo $render_icon('layout-grid', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Industry Library', 'reviewservicepro'); ?>
          </span>
          <h2 id="industry-grid-title" class="rsp-industry-title mt-4 text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
            <?php esc_html_e('Browse industry reputation guides', 'reviewservicepro'); ?>
          </h2>
        </div>

        <?php if (! empty($industry_terms) && ! is_wp_error($industry_terms)) : ?>
          <div class="rsp-industry-reveal flex flex-wrap gap-3 lg:max-w-xl lg:justify-end" data-rsp-industry-reveal>
            <?php foreach ($industry_terms as $term) : ?>
              <?php $term_link = get_term_link($term);
              if (is_wp_error($term_link)) {
                continue;
              } ?>
              <a href="<?php echo esc_url($term_link); ?>" class="rounded-full border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-[800] text-[#3B4658] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                <?php echo esc_html($term->name); ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          $post_index = 0;
          while (have_posts()) :
            the_post();
            $post_terms = get_the_terms(get_the_ID(), 'industry_type');
            $delay      = min($post_index * 70, 420);
          ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('rsp-industry-card rsp-industry-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?> data-rsp-industry-reveal style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">
              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-industry-card-image h-56 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <?php echo $render_icon('building-2', 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="p-6">
                  <div class="mb-4 flex flex-wrap items-center gap-2">
                    <?php if (! empty($post_terms) && ! is_wp_error($post_terms)) : ?>
                      <?php foreach (array_slice($post_terms, 0, 2) as $post_term) : ?>
                        <span class="rsp-industry-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700"><?php echo esc_html($post_term->name); ?></span>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <span class="rsp-industry-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700"><?php esc_html_e('Industry Guide', 'reviewservicepro'); ?></span>
                    <?php endif; ?>
                  </div>
                  <h3 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em]"><?php the_title(); ?></h3>
                  <p class="rsp-industry-body mt-4"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                  <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                    <span class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500"><?php echo esc_html(get_the_date()); ?></span>
                    <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700"><?php esc_html_e('Read guide', 'reviewservicepro'); ?><?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                                  ?></span>
                  </div>
                </div>
              </a>
            </article>
          <?php $post_index++;
          endwhile; ?>
        </div>
        <div class="rsp-industry-pagination mt-12">
          <?php the_posts_pagination(['mid_size' => 2, 'prev_text' => esc_html__('Previous', 'reviewservicepro'), 'next_text' => esc_html__('Next', 'reviewservicepro'), 'screen_reader_text' => esc_html__('Industry guides navigation', 'reviewservicepro')]); ?>
        </div>
      <?php else : ?>
        <div class="rsp-industry-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-industry-reveal>
          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600"><?php echo $render_icon('search-x', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                            ?></div>
          <h2 class="rsp-industry-heading text-2xl font-[800] leading-tight tracking-[-0.04em]"><?php esc_html_e('No industry guides found yet.', 'reviewservicepro'); ?></h2>
          <p class="rsp-industry-text mx-auto mt-4 max-w-xl"><?php esc_html_e('Add industry pages from the WordPress dashboard to build your industry reputation hub.', 'reviewservicepro'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-industry-reveal rsp-industry-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-industry-reveal style="--rsp-industry-inner:#ffffff;">
        <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.55fr] lg:items-center">
          <div>
            <span class="rsp-industry-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700"><?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                    ?><?php esc_html_e('Industry ORM Audit', 'reviewservicepro'); ?></span>
            <h2 class="rsp-industry-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]"><?php esc_html_e('Not sure which reputation issues matter in your industry?', 'reviewservicepro'); ?></h2>
            <p class="rsp-industry-text mt-5 max-w-2xl"><?php esc_html_e('Get a free industry-specific audit and discover which platforms, review signals, response gaps, and trust risks should be prioritized first.', 'reviewservicepro'); ?></p>
          </div>
          <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($industry_cta_url); ?>" class="rsp-industry-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]"><span class="relative z-10 inline-flex items-center gap-2"><?php esc_html_e('Request Industry Audit', 'reviewservicepro'); ?><?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ?></span></a>
            <a href="<?php echo esc_url($consultation_url); ?>" class="rsp-industry-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700"><span class="relative z-10 inline-flex items-center gap-2"><?php esc_html_e('Book Consultation', 'reviewservicepro'); ?><?php echo $render_icon('calendar-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?></span></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  (function() {
    function initRspIndustryArchive() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
      var items = document.querySelectorAll('[data-rsp-industry-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspIndustryVisible === 'true') return;
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
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initRspIndustryArchive);
    else initRspIndustryArchive();
  })();
</script>

<?php
get_footer();
