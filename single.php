<?php

/**
 * Single Post Template
 *
 * ReviewService.Pro — Premium White SaaS Single Blog Post
 *
 * File: single.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$post_id          = get_queried_object_id();
$categories       = get_the_category($post_id);
$primary_category = ! empty($categories) ? $categories[0] : null;
$author_id        = get_post_field('post_author', $post_id);
$content_raw      = get_post_field('post_content', $post_id);
$word_count       = str_word_count(wp_strip_all_tags($content_raw));
$read_time        = max(1, (int) ceil($word_count / 220));

$related_args = [
  'post_type'           => 'post',
  'post_status'         => 'publish',
  'posts_per_page'      => 3,
  'post__not_in'        => [$post_id],
  'ignore_sticky_posts' => true,
];

if (! empty($categories)) {
  $related_args['category__in'] = wp_list_pluck($categories, 'term_id');
}

$related_posts = new WP_Query($related_args);
?>

<?php while (have_posts()) : the_post(); ?>

  <article
    id="post-<?php the_ID(); ?>"
    <?php post_class('relative overflow-hidden bg-white'); ?>>

    <style>
      #rsp-single-post {
        --rsp-single-title: #334155;
        --rsp-single-heading: #3B4658;
        --rsp-single-body: #64748B;
        --rsp-single-blue: #2563EB;
        --rsp-single-green: #00C853;
        --rsp-single-teal: #14B8A6;
        --rsp-single-border: rgba(148, 163, 184, 0.26);
      }

      #rsp-single-post .rsp-single-title,
      #rsp-single-post .rsp-single-heading {
        font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      }

      #rsp-single-post .rsp-single-title {
        color: var(--rsp-single-title);
        text-wrap: balance;
      }

      #rsp-single-post .rsp-single-heading {
        color: var(--rsp-single-heading);
      }

      #rsp-single-post .rsp-single-text,
      #rsp-single-post .rsp-single-body {
        font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-size: 16px;
        line-height: 1.78;
        color: var(--rsp-single-body);
      }

      #rsp-single-post .rsp-single-text {
        font-weight: 500;
      }

      #rsp-single-post .rsp-single-body {
        font-weight: 400;
      }

      #rsp-single-post .rsp-single-eyebrow {
        font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
      }

      #rsp-single-post .rsp-single-reveal {
        opacity: 0;
        transform: translateY(24px);
        transition:
          opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
          transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
          box-shadow 320ms ease,
          border-color 320ms ease;
      }

      #rsp-single-post .rsp-single-reveal.rsp-visible {
        opacity: 1;
        transform: translateY(0);
      }

      #rsp-single-post .rsp-single-motion-border {
        position: relative;
        isolation: isolate;
        overflow: hidden;
      }

      #rsp-single-post .rsp-single-motion-border::before {
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
        opacity: 0.66;
        transform: rotate(0deg);
        animation: rspSingleBorderSpin 8s linear infinite;
        pointer-events: none;
        transition: opacity 260ms ease;
      }

      #rsp-single-post .rsp-single-motion-border::after {
        content: "";
        position: absolute;
        inset: 1px;
        z-index: -1;
        border-radius: inherit;
        background: var(--rsp-single-inner, #ffffff);
        pointer-events: none;
      }

      #rsp-single-post .rsp-single-motion-border:hover::before {
        opacity: 1;
        animation-duration: 4.2s;
      }

      #rsp-single-post .rsp-single-card {
        transition:
          transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
          box-shadow 320ms ease,
          border-color 260ms ease,
          background-color 260ms ease;
      }

      #rsp-single-post .rsp-single-card:hover {
        transform: translateY(-5px);
        border-color: rgba(37, 99, 235, 0.22);
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.10);
      }

      #rsp-single-post .rsp-single-btn {
        position: relative;
        overflow: hidden;
        transition:
          transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
          box-shadow 260ms ease,
          border-color 260ms ease,
          background-color 260ms ease;
      }

      #rsp-single-post .rsp-single-btn::before {
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

      #rsp-single-post .rsp-single-btn:hover {
        transform: translateY(-3px);
      }

      #rsp-single-post .rsp-single-btn:hover::before {
        left: 135%;
      }

      #rsp-single-post .rsp-single-content {
        font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        color: var(--rsp-single-body);
      }

      #rsp-single-post .rsp-single-content p {
        margin-top: 1.25rem;
        margin-bottom: 1.25rem;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.9;
        color: var(--rsp-single-body);
      }

      #rsp-single-post .rsp-single-content h2 {
        margin-top: 3rem;
        margin-bottom: 1rem;
        font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-size: clamp(26px, 3vw, 34px);
        font-weight: 800;
        line-height: 1.18;
        letter-spacing: -0.035em;
        color: var(--rsp-single-heading);
      }

      #rsp-single-post .rsp-single-content h3 {
        margin-top: 2.25rem;
        margin-bottom: 0.85rem;
        font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        font-size: clamp(20px, 2vw, 24px);
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.025em;
        color: var(--rsp-single-heading);
      }

      #rsp-single-post .rsp-single-content strong {
        font-weight: 800;
        color: #3B4658;
      }

      #rsp-single-post .rsp-single-content a {
        color: #2563EB;
        font-weight: 700;
        text-decoration: none;
      }

      #rsp-single-post .rsp-single-content a:hover {
        color: #1D4ED8;
        text-decoration: underline;
      }

      #rsp-single-post .rsp-single-content ul,
      #rsp-single-post .rsp-single-content ol {
        margin-top: 1.35rem;
        margin-bottom: 1.35rem;
        padding-left: 1.35rem;
        color: var(--rsp-single-body);
      }

      #rsp-single-post .rsp-single-content li {
        margin-top: 0.75rem;
        padding-left: 0.25rem;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.85;
        color: var(--rsp-single-body);
      }

      #rsp-single-post .rsp-single-content li::marker {
        color: #2563EB;
      }

      #rsp-single-post .rsp-single-content blockquote {
        margin-top: 2rem;
        margin-bottom: 2rem;
        border-left: 4px solid #2563EB;
        border-radius: 1rem;
        background: #EFF6FF;
        padding: 1.25rem 1.5rem;
        color: #3B4658;
      }

      #rsp-single-post .rsp-single-content figure {
        margin-top: 2.25rem;
        margin-bottom: 2.25rem;
      }

      #rsp-single-post .rsp-single-content figure.wp-block-image {
        overflow: hidden;
        border-radius: 1.5rem;
        border: 1px solid rgba(148, 163, 184, 0.22);
        background: #ffffff;
        padding: 0.5rem;
        box-shadow: 0 18px 60px rgba(15, 23, 42, 0.08);
      }

      #rsp-single-post .rsp-single-content figure.wp-block-image img {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 1.1rem;
        object-fit: cover;
      }

      #rsp-single-post .rsp-single-content figcaption {
        margin-top: 0.85rem;
        padding: 0 0.5rem 0.35rem;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
        color: #64748B;
      }

      #rsp-single-post .rsp-single-content .wp-block-buttons {
        margin-top: 2rem;
      }

      #rsp-single-post .rsp-single-content .wp-block-button__link {
        border-radius: 1rem;
        background: #2563EB;
        padding: 0.95rem 1.4rem;
        font-family: "Inter", sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: #ffffff;
        box-shadow: 0 14px 34px rgba(37, 99, 235, 0.22);
        transition:
          transform 260ms ease,
          background-color 260ms ease,
          box-shadow 260ms ease;
      }

      #rsp-single-post .rsp-single-content .wp-block-button__link:hover {
        transform: translateY(-2px);
        background: #1D4ED8;
        color: #ffffff;
        text-decoration: none;
        box-shadow: 0 18px 44px rgba(37, 99, 235, 0.30);
      }

      @keyframes rspSingleBorderSpin {
        to {
          transform: rotate(360deg);
        }
      }

      @media (prefers-reduced-motion: reduce) {

        #rsp-single-post *,
        #rsp-single-post *::before,
        #rsp-single-post *::after {
          animation-duration: 0.001ms !important;
          animation-iteration-count: 1 !important;
          scroll-behavior: auto !important;
          transition-duration: 0.001ms !important;
        }

        #rsp-single-post .rsp-single-reveal {
          opacity: 1;
          transform: none;
        }

        #rsp-single-post .rsp-single-card:hover,
        #rsp-single-post .rsp-single-btn:hover {
          transform: none;
        }
      }
    </style>

    <div id="rsp-single-post">

      <!-- Hero -->
      <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto max-w-5xl text-center">

          <nav class="rsp-single-reveal mb-8 flex flex-wrap items-center justify-center gap-2 font-['Inter',sans-serif] text-sm font-medium text-slate-500" aria-label="<?php esc_attr_e('Breadcrumb', 'reviewservicepro'); ?>" data-rsp-single-reveal>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="transition-colors duration-200 hover:text-blue-600">
              <?php esc_html_e('Home', 'reviewservicepro'); ?>
            </a>
            <span>/</span>
            <a href="<?php echo esc_url(home_url('/orm-academy/')); ?>" class="transition-colors duration-200 hover:text-blue-600">
              <?php esc_html_e('ORM Academy', 'reviewservicepro'); ?>
            </a>

            <?php if ($primary_category) : ?>
              <span>/</span>
              <a href="<?php echo esc_url(get_category_link($primary_category->term_id)); ?>" class="transition-colors duration-200 hover:text-blue-600">
                <?php echo esc_html($primary_category->name); ?>
              </a>
            <?php endif; ?>
          </nav>

          <?php if (! empty($categories)) : ?>
            <div class="rsp-single-reveal mb-5 flex flex-wrap justify-center gap-2" data-rsp-single-reveal>
              <?php foreach ($categories as $category) : ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="rsp-single-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-100">
                  <?php echo esc_html($category->name); ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <h1 class="rsp-single-title rsp-single-reveal mx-auto max-w-5xl text-[clamp(34px,5.4vw,68px)] font-[800] leading-[1.04] tracking-[-0.058em]" data-rsp-single-reveal>
            <?php the_title(); ?>
          </h1>

          <?php if (has_excerpt()) : ?>
            <p class="rsp-single-text rsp-single-reveal mx-auto mt-6 max-w-3xl" data-rsp-single-reveal>
              <?php echo esc_html(get_the_excerpt()); ?>
            </p>
          <?php endif; ?>

          <div class="rsp-single-reveal mx-auto mt-7 flex max-w-4xl flex-wrap items-center justify-center gap-3" data-rsp-single-reveal>
            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600 shadow-sm">
              <i data-lucide="user" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
              <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
            </span>

            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600 shadow-sm">
              <i data-lucide="calendar" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
              <?php echo esc_html(get_the_date()); ?>
            </span>

            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600 shadow-sm">
              <i data-lucide="clock" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
              <?php echo esc_html($read_time); ?>
              <?php esc_html_e('min read', 'reviewservicepro'); ?>
            </span>

            <?php if (get_the_modified_date('U') > get_the_date('U')) : ?>
              <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600 shadow-sm">
                <i data-lucide="refresh-cw" class="h-4 w-4 text-violet-600" aria-hidden="true"></i>
                <?php esc_html_e('Updated', 'reviewservicepro'); ?>
                <?php echo esc_html(get_the_modified_date()); ?>
              </span>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <!-- Featured Image -->
      <?php if (has_post_thumbnail()) : ?>
        <section class="relative bg-white px-5 py-10 sm:px-6 lg:px-8">
          <div class="rsp-single-reveal mx-auto max-w-6xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-2 shadow-[0_24px_90px_rgba(15,23,42,0.10)]" data-rsp-single-reveal>
            <?php the_post_thumbnail('full', ['class' => 'h-auto w-full rounded-[1.55rem] object-cover']); ?>
          </div>
        </section>
      <?php endif; ?>

      <!-- Content Layout -->
      <section class="relative overflow-hidden bg-white px-5 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.05),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.05),transparent_28%)]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 gap-8 lg:grid-cols-[290px_minmax(0,820px)] lg:justify-center lg:gap-10">

          <!-- Left Sidebar: Article Guide + CTA Cards -->
          <aside class="rsp-single-reveal lg:sticky lg:top-28 lg:self-start" data-rsp-single-reveal>
            <div class="space-y-5">

              <div class="rsp-single-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-[0_14px_45px_rgba(15,23,42,0.06)]">
                <p class="rsp-single-eyebrow mb-4 text-blue-700">
                  <?php esc_html_e('Article Guide', 'reviewservicepro'); ?>
                </p>

                <ul class="space-y-3 font-['Inter',sans-serif] text-sm font-medium leading-6 text-slate-600">
                  <li class="flex gap-2">
                    <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('Quick summary', 'reviewservicepro'); ?>
                  </li>
                  <li class="flex gap-2">
                    <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('Practical guidance', 'reviewservicepro'); ?>
                  </li>
                  <li class="flex gap-2">
                    <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('Ethical ORM focus', 'reviewservicepro'); ?>
                  </li>
                  <li class="flex gap-2">
                    <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('Free audit CTA', 'reviewservicepro'); ?>
                  </li>
                </ul>
              </div>

              <div class="rsp-single-motion-border rsp-single-card rounded-[1.5rem] border border-blue-200 bg-white p-5 shadow-[0_14px_45px_rgba(15,23,42,0.06)]" style="--rsp-single-inner:#ffffff;">
                <div class="relative z-10">
                  <p class="rsp-single-eyebrow mb-3 text-[#00A344]">
                    <?php esc_html_e('Need expert help?', 'reviewservicepro'); ?>
                  </p>

                  <h3 class="rsp-single-heading mb-3 text-xl font-[800] leading-tight tracking-[-0.035em]">
                    <?php esc_html_e('Free Reputation Audit', 'reviewservicepro'); ?>
                  </h3>

                  <p class="rsp-single-body mb-5">
                    <?php esc_html_e('Find review gaps, platform risks, and trust opportunities.', 'reviewservicepro'); ?>
                  </p>

                  <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="rsp-single-btn inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white shadow-[0_14px_34px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
                    <span class="relative z-10 inline-flex items-center gap-2">
                      <i data-lucide="search-check" class="h-4 w-4" aria-hidden="true"></i>
                      <?php esc_html_e('Get Audit', 'reviewservicepro'); ?>
                    </span>
                  </a>
                </div>
              </div>

              <div class="rsp-single-card rounded-[1.5rem] border border-emerald-200 bg-emerald-50/70 p-5 shadow-[0_14px_45px_rgba(15,23,42,0.05)]">
                <p class="rsp-single-eyebrow mb-4 text-emerald-700">
                  <?php esc_html_e('Trust Policy', 'reviewservicepro'); ?>
                </p>

                <ul class="space-y-3 font-['Inter',sans-serif] text-sm font-semibold leading-6 text-slate-700">
                  <li class="flex gap-2">
                    <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('No fake reviews', 'reviewservicepro'); ?>
                  </li>
                  <li class="flex gap-2">
                    <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('Platform-compliant methods', 'reviewservicepro'); ?>
                  </li>
                  <li class="flex gap-2">
                    <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <?php esc_html_e('Transparent reporting', 'reviewservicepro'); ?>
                  </li>
                </ul>

                <a href="<?php echo esc_url(home_url('/trust-center/')); ?>" class="mt-5 inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700 hover:text-blue-800">
                  <?php esc_html_e('View Trust Center', 'reviewservicepro'); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </a>
              </div>

            </div>
          </aside>

          <!-- Main Article -->
          <main class="min-w-0">
            <div class="rsp-single-reveal rsp-single-motion-border mb-8 rounded-[1.5rem] border border-blue-200 bg-blue-50/70 p-6 shadow-[0_14px_45px_rgba(15,23,42,0.05)]" data-rsp-single-reveal style="--rsp-single-inner:#EFF6FF;">
              <div class="relative z-10 mb-3 flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                <i data-lucide="sparkles" class="h-4 w-4" aria-hidden="true"></i>
                <?php esc_html_e('Quick Summary', 'reviewservicepro'); ?>
              </div>

              <p class="relative z-10 rsp-single-text">
                <?php
                if (has_excerpt()) {
                  echo esc_html(get_the_excerpt());
                } else {
                  echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_content()), 42));
                }
                ?>
              </p>
            </div>

            <div class="rsp-single-reveal rsp-single-content" data-rsp-single-reveal>
              <?php
              $single_content = apply_filters('the_content', get_the_content());

              /**
               * Prevent broken placeholder images from showing on the frontend
               * when IMAGE_URL_1 / IMAGE_URL_2 has not been replaced yet.
               */
              $single_content = preg_replace('/<!--\s*wp:image[^>]*-->.*?<img[^>]+src=["\']IMAGE_URL[^"\']*["\'][^>]*>.*?<!--\s*\/wp:image\s*-->/is', '', $single_content);
              $single_content = preg_replace('/<figure[^>]*class=["\'][^"\']*wp-block-image[^"\']*["\'][^>]*>\s*<img[^>]+src=["\']IMAGE_URL[^"\']*["\'][^>]*>.*?<\/figure>/is', '', $single_content);

              echo $single_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

              wp_link_pages(
                [
                  'before' => '<div class="mt-10 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-slate-600">' . esc_html__('Pages:', 'reviewservicepro'),
                  'after'  => '</div>',
                ]
              );
              ?>
            </div>

            <div class="rsp-single-reveal mt-12 rounded-[2rem] border border-emerald-200 bg-emerald-50/80 p-7 text-center shadow-[0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-single-reveal>
              <h2 class="rsp-single-heading mb-3 text-2xl font-[800] leading-tight tracking-[-0.04em]">
                <?php esc_html_e('Want help applying this to your business?', 'reviewservicepro'); ?>
              </h2>

              <p class="rsp-single-text mx-auto mb-6 max-w-2xl">
                <?php esc_html_e('Get a free reputation audit and discover review gaps, platform risks, and practical trust-building opportunities.', 'reviewservicepro'); ?>
              </p>

              <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="rsp-single-btn inline-flex items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
                  <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
                </span>
              </a>
            </div>

            <div class="rsp-single-reveal mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-8" data-rsp-single-reveal>
              <div>
                <p class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500">
                  <?php esc_html_e('Published in', 'reviewservicepro'); ?>
                </p>

                <?php if (! empty($categories)) : ?>
                  <div class="mt-2 flex flex-wrap gap-2">
                    <?php foreach ($categories as $category) : ?>
                      <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 font-['Inter',sans-serif] text-xs font-[800] text-slate-600 transition-all duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                        <?php echo esc_html($category->name); ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>

              <a href="<?php echo esc_url(home_url('/orm-academy/')); ?>" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 font-['Inter',sans-serif] text-sm font-[800] text-[#3B4658] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                <i data-lucide="book-open" class="h-4 w-4" aria-hidden="true"></i>
                <?php esc_html_e('Back to Academy', 'reviewservicepro'); ?>
              </a>
            </div>
          </main>

        </div>
      </section>

      <!-- Related Articles -->
      <?php if ($related_posts->have_posts()) : ?>
        <section class="relative overflow-hidden border-t border-slate-200 bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24">
          <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
          <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
          <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

          <div class="relative z-10 mx-auto max-w-7xl">
            <div class="rsp-single-reveal mb-10 max-w-3xl" data-rsp-single-reveal>
              <span class="rsp-single-eyebrow mb-4 inline-flex rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
                <?php esc_html_e('Related Articles', 'reviewservicepro'); ?>
              </span>

              <h2 class="rsp-single-title mt-4 text-3xl font-[800] leading-tight tracking-[-0.045em] md:text-5xl">
                <?php esc_html_e('Keep learning with these guides.', 'reviewservicepro'); ?>
              </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
              <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                <article class="rsp-single-reveal rsp-single-card overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]" data-rsp-single-reveal>
                  <a href="<?php the_permalink(); ?>" class="block no-underline">
                    <div class="h-52 overflow-hidden bg-slate-100">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover transition-transform duration-500 hover:scale-105']); ?>
                      <?php else : ?>
                        <div class="flex h-full items-center justify-center bg-gradient-to-br from-blue-50 to-emerald-50">
                          <i data-lucide="file-text" class="h-12 w-12 text-blue-600" aria-hidden="true"></i>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="p-6">
                      <h3 class="rsp-single-heading mb-3 text-xl font-[800] leading-tight tracking-[-0.035em]">
                        <?php the_title(); ?>
                      </h3>

                      <p class="rsp-single-body mb-5">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?>
                      </p>

                      <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                        <?php esc_html_e('Read guide', 'reviewservicepro'); ?>
                        <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                      </span>
                    </div>
                  </a>
                </article>
              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
            </div>
          </div>
        </section>
      <?php endif; ?>

    </div>
  </article>

<?php endwhile; ?>

<script>
  (function() {
    function initRspSinglePost() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-single-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspSingleVisible === 'true') {
          return;
        }

        item.dataset.rspSingleVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspSinglePost);
    } else {
      initRspSinglePost();
    }
  })();
</script>

<?php
get_footer();
