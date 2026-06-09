<?php

/**
 * Home Section: ORM Academy Preview
 *
 * File: template-parts/sections/home/academy-preview.php
 *
 * ReviewService.Pro — Dynamic ORM Academy preview for homepage.
 *
 * Purpose:
 * - Show real ORM Academy blog posts on the homepage.
 * - Pull latest published WordPress posts dynamically.
 * - Preserve the existing dark premium academy visual direction.
 * - Keep fallback content if no posts exist yet.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$academy_url = home_url('/orm-academy/');

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$get_read_time = function ($post_id) {
  $content    = wp_strip_all_tags((string) get_post_field('post_content', $post_id));
  $word_count = str_word_count($content);
  $minutes    = max(1, (int) ceil($word_count / 220));

  return sprintf(
    _n('%d min read', '%d min read', $minutes, 'reviewservicepro'),
    $minutes
  );
};

$category_colors = [
  'reviews'             => '#3B82F6',
  'review-responses'    => '#A855F7',
  'customer-experience' => '#14B8A6',
  'industry-reputation' => '#F97316',
  'case-studies'        => '#22C55E',
  'platform-guides'     => '#10B981',
  'local-seo'           => '#8B5CF6',
  'templates'           => '#06B6D4',
  'audit'               => '#2563EB',
];

$get_primary_category = function ($post_id) use ($category_colors) {
  $categories = get_the_category($post_id);

  if (! empty($categories) && ! is_wp_error($categories)) {
    $category = $categories[0];
    $slug     = sanitize_title($category->slug);

    return [
      'name'  => $category->name,
      'slug'  => $slug,
      'url'   => get_category_link($category->term_id),
      'color' => $category_colors[$slug] ?? '#8B5CF6',
    ];
  }

  return [
    'name'  => __('ORM Academy', 'reviewservicepro'),
    'slug'  => 'orm-academy',
    'url'   => home_url('/orm-academy/'),
    'color' => '#8B5CF6',
  ];
};

$academy_query = new WP_Query(
  [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
  ]
);

$fallback_posts = [
  [
    'icon'     => 'file-text',
    'category' => __('Review Responses', 'reviewservicepro'),
    'color'    => '#A855F7',
    'title'    => __('How to Respond to Negative Reviews: A Complete Guide for Business Owners', 'reviewservicepro'),
    'desc'     => __('A practical guide covering tone, timing, documentation, and safe response strategy for business reviews.', 'reviewservicepro'),
    'meta'     => __('5 min read', 'reviewservicepro'),
    'url'      => $academy_url,
  ],
  [
    'icon'     => 'map',
    'category' => __('Platform Guides', 'reviewservicepro'),
    'color'    => '#10B981',
    'title'    => __('Google Business Profile: The Complete ORM Guide for Local Businesses', 'reviewservicepro'),
    'desc'     => __('Understand profile trust signals, customer visibility, and ethical review management basics.', 'reviewservicepro'),
    'meta'     => __('4 min read', 'reviewservicepro'),
    'url'      => $academy_url,
  ],
  [
    'icon'     => 'clipboard-list',
    'category' => __('Templates', 'reviewservicepro'),
    'color'    => '#06B6D4',
    'title'    => __('Professional Review Response Templates for Better Customer Communication', 'reviewservicepro'),
    'desc'     => __('Use calm and brand-safe response frameworks for positive, neutral, and negative feedback.', 'reviewservicepro'),
    'meta'     => __('3 min read', 'reviewservicepro'),
    'url'      => $academy_url,
  ],
  [
    'icon'     => 'chart-no-axes-combined',
    'category' => __('Local SEO', 'reviewservicepro'),
    'color'    => '#8B5CF6',
    'title'    => __('How Review Signals Support Local Trust and Customer Confidence', 'reviewservicepro'),
    'desc'     => __('Learn how review visibility, response quality, and platform consistency influence customer trust.', 'reviewservicepro'),
    'meta'     => __('6 min read', 'reviewservicepro'),
    'url'      => $academy_url,
  ],
];

$academy_posts = [];

if ($academy_query->have_posts()) {
  while ($academy_query->have_posts()) {
    $academy_query->the_post();

    $post_id  = get_the_ID();
    $category = $get_primary_category($post_id);

    $academy_posts[] = [
      'id'           => $post_id,
      'icon'         => 'book-open-text',
      'category'     => $category['name'],
      'category_url' => $category['url'],
      'color'        => $category['color'],
      'title'        => get_the_title($post_id),
      'desc'         => wp_trim_words(get_the_excerpt($post_id), 24, '...'),
      'meta'         => $get_read_time($post_id),
      'url'          => get_permalink($post_id),
      'has_image'    => has_post_thumbnail($post_id),
    ];
  }

  wp_reset_postdata();
}

if (empty($academy_posts)) {
  $academy_posts = $fallback_posts;
}

$featured   = $academy_posts[0];
$side_posts = array_slice($academy_posts, 1, 3);

$category_pills = get_categories(
  [
    'hide_empty' => true,
    'number'     => 7,
    'orderby'    => 'count',
    'order'      => 'DESC',
  ]
);
?>

<section
  id="academy-preview"
  class="relative overflow-hidden border-t border-white/[0.05] bg-[#07111F] py-20 md:py-28"
  role="region"
  aria-label="<?php esc_attr_e('ORM Academy Preview', 'reviewservicepro'); ?>"
  data-gsap="academy-animate">

  <style>
    #academy-preview {
      --rsp-academy-title: #FFFFFF;
      --rsp-academy-body: #94A3B8;
      --rsp-academy-purple: #A855F7;
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #academy-preview .rsp-academy-heading,
    #academy-preview .rsp-academy-card-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #academy-preview .rsp-academy-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      transition:
        transform 300ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 260ms ease,
        box-shadow 300ms ease,
        background-color 260ms ease;
    }

    #academy-preview .rsp-academy-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 24px 70px rgba(0, 0, 0, 0.24);
    }

    #academy-preview .rsp-academy-card::before {
      content: "";
      position: absolute;
      inset: -90%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(168, 85, 247, 0.08),
          rgba(37, 99, 235, 0.26),
          rgba(0, 200, 83, 0.18),
          rgba(168, 85, 247, 0.26),
          rgba(168, 85, 247, 0.08));
      opacity: 0;
      animation: rspAcademyBorderSpin 9s linear infinite;
      transition: opacity 260ms ease;
      pointer-events: none;
    }

    #academy-preview .rsp-academy-card::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: rgba(255, 255, 255, 0.035);
      pointer-events: none;
    }

    #academy-preview .rsp-academy-card:hover::before {
      opacity: 1;
    }

    #academy-preview .rsp-academy-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1), filter 320ms ease;
    }

    #academy-preview .rsp-academy-card:hover .rsp-academy-image img {
      transform: scale(1.06);
      filter: saturate(1.08);
    }

    #academy-preview .rsp-academy-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
        background-color 240ms ease,
        box-shadow 240ms ease;
    }

    #academy-preview .rsp-academy-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 70%;
      height: 100%;
      transform: skewX(-18deg);
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
      transition: left 680ms ease;
      pointer-events: none;
    }

    #academy-preview .rsp-academy-btn:hover {
      transform: translateY(-3px);
    }

    #academy-preview .rsp-academy-btn:hover::before {
      left: 135%;
    }

    @keyframes rspAcademyBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #academy-preview *,
      #academy-preview *::before,
      #academy-preview *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      #academy-preview .rsp-academy-card:hover,
      #academy-preview .rsp-academy-btn:hover {
        transform: none;
      }

      #academy-preview .rsp-academy-card:hover .rsp-academy-image img {
        transform: none;
      }
    }




    /* ................. */
    #academy-preview .rsp-academy-heading,
    #academy-preview .rsp-academy-heading span,
    #academy-preview .rsp-academy-card-title,
    #academy-preview .rsp-academy-card-title a,
    #academy-preview .rsp-academy-card h3,
    #academy-preview article h3 {
      color: #ffffff !important;
    }

    #academy-preview .rsp-academy-card p,
    #academy-preview .rsp-academy-card .rsp-academy-excerpt {
      color: #cbd5e1 !important;
    }

    #academy-preview .rsp-academy-card a {
      color: inherit;
    }

    #academy-preview .rsp-academy-card .rsp-academy-meta,
    #academy-preview .rsp-academy-card .rsp-academy-meta span {
      color: #94a3b8 !important;
    }

    #academy-preview .rsp-academy-heading {
      font-weight: 700 !important;
      letter-spacing: -0.035em !important;
    }

    #academy-preview .rsp-academy-heading span {
      font-weight: 700 !important;
    }

    #academy-preview .rsp-academy-heading .block {
      font-weight: 500 !important;
      letter-spacing: normal !important;
    }

    #academy-preview .rsp-academy-card-title,
    #academy-preview .rsp-academy-card h3,
    #academy-preview article h3 {
      color: #ffffff !important;
      font-weight: 700 !important;
      letter-spacing: -0.025em !important;
    }

    #academy-preview .rsp-academy-card p {
      color: #cbd5e1 !important;
      font-weight: 400 !important;
    }

    #academy-preview .rsp-academy-card span,
    #academy-preview .rsp-academy-card .rsp-academy-meta {
      font-weight: 500 !important;
    }
  </style>

  <div
    class="pointer-events-none absolute inset-0 z-0"
    style="background-image:radial-gradient(rgba(139,92,246,0.16) 1px,transparent 1px);background-size:24px 24px;"
    aria-hidden="true"></div>

  <div class="pointer-events-none absolute -top-24 right-0 z-0 h-[420px] w-[520px] rounded-full bg-purple-600/[0.12] blur-[110px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute bottom-0 left-0 z-0 h-[360px] w-[460px] rounded-full bg-blue-600/[0.08] blur-[100px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mx-auto mb-8 max-w-3xl text-center" data-gsap-item="academy-heading">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-purple-500/30 bg-purple-500/10 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.1em] text-purple-300">
        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-purple-400" aria-hidden="true"></span>
        <?php esc_html_e('ORM Academy', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-academy-heading mb-4 text-3xl font-extrabold leading-[1.12] tracking-[-0.045em] text-white md:text-4xl lg:text-[42px]">
        <span class="mb-2 block text-base font-medium tracking-normal text-slate-400 md:text-lg">
          <?php esc_html_e('Latest guides from ORM Academy', 'reviewservicepro'); ?>
        </span>

        <span class="relative inline-block">
          <span class="relative z-10 bg-gradient-to-r from-purple-300 via-purple-100 to-purple-400 bg-clip-text text-transparent">
            <?php esc_html_e('Build Better Reputation Knowledge', 'reviewservicepro'); ?>
          </span>
          <span class="absolute inset-[-4px_-10px] z-0 rounded-lg border border-purple-500/[0.18] bg-purple-500/[0.12]" aria-hidden="true"></span>
        </span>
      </h2>

      <p class="mx-auto max-w-xl text-[16px] font-medium leading-7 text-slate-400">
        <?php esc_html_e('Real posts from the ORM Academy knowledge hub — review strategy, response guidance, platform support, local trust, and ethical reputation education.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="mb-10 flex flex-wrap justify-center gap-2" data-gsap-item="academy-cats">
      <a
        href="<?php echo esc_url($academy_url); ?>"
        class="inline-flex rounded-full border border-slate-500/50 bg-slate-500/10 px-4 py-1.5 text-[11px] font-semibold text-slate-300 no-underline transition-all duration-200 hover:-translate-y-0.5 hover:border-purple-400/60 hover:bg-purple-500/10 hover:text-purple-200">
        <?php esc_html_e('All Articles', 'reviewservicepro'); ?>
      </a>

      <?php if (! empty($category_pills) && ! is_wp_error($category_pills)) : ?>
        <?php foreach ($category_pills as $cat) : ?>
          <?php
          $cat_slug  = sanitize_title($cat->slug);
          $cat_color = $category_colors[$cat_slug] ?? '#8B5CF6';
          ?>
          <a
            href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
            class="inline-flex rounded-full border px-4 py-1.5 text-[11px] font-semibold no-underline transition-all duration-200 hover:-translate-y-0.5"
            style="border-color:<?php echo esc_attr($cat_color); ?>55;color:<?php echo esc_attr($cat_color); ?>;background:<?php echo esc_attr($cat_color); ?>12;">
            <?php echo esc_html($cat->name); ?>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1.25fr_0.75fr]" data-gsap-item="academy-cards">

      <article class="rsp-academy-card group relative flex min-h-[520px] flex-col overflow-hidden rounded-3xl border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:border-purple-500/40">
        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-purple-500 via-blue-500 to-transparent" aria-hidden="true"></div>

        <a href="<?php echo esc_url($featured['url']); ?>" class="relative z-10 flex h-full flex-col no-underline">
          <div class="rsp-academy-image relative flex min-h-[240px] items-center justify-center overflow-hidden border-b border-white/[0.06] bg-gradient-to-br from-purple-900/40 via-blue-950/40 to-slate-950">
            <?php if (! empty($featured['id']) && ! empty($featured['has_image'])) : ?>
              <?php
              echo get_the_post_thumbnail(
                (int) $featured['id'],
                'large',
                [
                  'class'    => 'h-full min-h-[240px] w-full object-cover opacity-80',
                  'loading'  => 'lazy',
                  'decoding' => 'async',
                ]
              );
              ?>
              <div class="absolute inset-0 bg-gradient-to-t from-[#07111F]/75 via-[#07111F]/18 to-transparent" aria-hidden="true"></div>
            <?php else : ?>
              <div class="absolute h-40 w-40 rounded-full bg-purple-500/20 blur-[70px]" aria-hidden="true"></div>
              <div class="relative z-10 flex h-20 w-20 items-center justify-center rounded-3xl border border-purple-400/25 bg-purple-500/10 text-purple-200 shadow-[0_18px_60px_rgba(168,85,247,0.22)]">
                <?php echo $render_icon($featured['icon'], 'h-9 w-9'); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="flex flex-1 flex-col p-7">
            <span
              class="mb-4 inline-flex w-fit rounded-full border px-3 py-1 text-[10px] font-semibold"
              style="border-color:<?php echo esc_attr($featured['color']); ?>55;color:<?php echo esc_attr($featured['color']); ?>;background:<?php echo esc_attr($featured['color']); ?>15;">
              <?php echo esc_html($featured['category']); ?>
            </span>

            <h3 class="rsp-academy-card-title mb-4 max-w-2xl text-2xl font-medium leading-tight tracking-[-0.035em] text-white md:text-3xl">
              <?php echo esc_html($featured['title']); ?>
            </h3>

            <p class="mb-6 max-w-2xl text-[16px] font-medium leading-7 text-slate-400">
              <?php echo esc_html($featured['desc']); ?>
            </p>

            <div class="mt-auto flex flex-wrap items-center justify-between gap-4 border-t border-white/[0.06] pt-5">
              <div class="flex items-center gap-4 text-[12px] font-medium text-slate-500">
                <span class="inline-flex items-center gap-1.5">
                  <?php echo $render_icon('clock', 'h-3.5 w-3.5'); ?>
                  <?php echo esc_html($featured['meta']); ?>
                </span>
                <span><?php echo esc_html($featured['category']); ?></span>
              </div>

              <span class="inline-flex items-center gap-2 text-sm font-semibold text-purple-300 transition-all duration-200 group-hover:gap-3">
                <?php esc_html_e('Read article', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); ?>
              </span>
            </div>
          </div>
        </a>
      </article>

      <div class="flex flex-col gap-4">
        <?php foreach ($side_posts as $post_item) : ?>
          <article class="rsp-academy-card group flex min-h-[155px] gap-4 overflow-hidden rounded-2xl border border-white/[0.08] bg-white/[0.03] p-5 transition-all duration-300 hover:border-white/[0.16]">
            <a href="<?php echo esc_url($post_item['url']); ?>" class="relative z-10 flex w-full gap-4 no-underline">
              <div
                class="rsp-academy-image flex h-16 w-16 flex-shrink-0 items-center justify-center overflow-hidden rounded-2xl border text-2xl"
                style="border-color:<?php echo esc_attr($post_item['color']); ?>44;background:<?php echo esc_attr($post_item['color']); ?>14;">
                <?php if (! empty($post_item['id']) && ! empty($post_item['has_image'])) : ?>
                  <?php
                  echo get_the_post_thumbnail(
                    (int) $post_item['id'],
                    'thumbnail',
                    [
                      'class'    => 'h-full w-full object-cover',
                      'loading'  => 'lazy',
                      'decoding' => 'async',
                    ]
                  );
                  ?>
                <?php else : ?>
                  <span style="color:<?php echo esc_attr($post_item['color']); ?>;">
                    <?php echo $render_icon($post_item['icon'], 'h-6 w-6'); ?>
                  </span>
                <?php endif; ?>
              </div>

              <div class="min-w-0 flex-1">
                <span
                  class="mb-2 inline-flex rounded-full px-2.5 py-1 text-[9px] font-semibold"
                  style="color:<?php echo esc_attr($post_item['color']); ?>;background:<?php echo esc_attr($post_item['color']); ?>14;">
                  <?php echo esc_html($post_item['category']); ?>
                </span>

                <h3 class="rsp-academy-card-title mb-3 text-[15px] font-bold leading-snug tracking-[-0.025em] text-white">
                  <?php echo esc_html($post_item['title']); ?>
                </h3>

                <div class="flex items-center justify-between gap-3">
                  <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-slate-500">
                    <?php echo $render_icon('clock', 'h-3 w-3'); ?>
                    <?php echo esc_html($post_item['meta']); ?>
                  </span>

                  <span
                    class="text-[11px] font-semibold transition-all duration-200 group-hover:translate-x-1"
                    style="color:<?php echo esc_attr($post_item['color']); ?>;">
                    <?php esc_html_e('Read', 'reviewservicepro'); ?> →
                  </span>
                </div>
              </div>
            </a>
          </article>
        <?php endforeach; ?>
      </div>

    </div>

    <div class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-white/[0.06] pt-6" data-gsap-item="academy-cta">
      <p class="text-[16px] font-medium leading-7 text-slate-500">
        <?php esc_html_e('Explore guides, templates, and reputation growth resources built for modern businesses.', 'reviewservicepro'); ?>
      </p>

      <a
        href="<?php echo esc_url($academy_url); ?>"
        class="rsp-academy-btn inline-flex items-center gap-2 rounded-xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white no-underline transition-all duration-200 hover:bg-purple-700 hover:text-white">
        <span class="relative z-10 inline-flex items-center gap-2">
          <?php echo $render_icon('book-open', 'h-4 w-4'); ?>
          <?php esc_html_e('Visit ORM Academy', 'reviewservicepro'); ?>
        </span>
      </a>
    </div>

  </div>
</section>