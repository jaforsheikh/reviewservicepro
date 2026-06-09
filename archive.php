<?php

/**
 * Default Archive Template
 *
 * ReviewService.Pro — Premium White SaaS Archive
 *
 * File: archive.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$archive_title = get_the_archive_title();
$archive_desc  = get_the_archive_description();

if (empty($archive_title)) {
  $archive_title = __('ORM Academy Archive', 'reviewservicepro');
}

$audit_url       = home_url('/contact/?type=audit');
$academy_url     = home_url('/orm-academy/');
$archive_count   = 0;
$queried_object  = get_queried_object();

if ($queried_object && isset($queried_object->count)) {
  $archive_count = (int) $queried_object->count;
} elseif (isset($GLOBALS['wp_query']->found_posts)) {
  $archive_count = (int) $GLOBALS['wp_query']->found_posts;
}

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<div
  id="rsp-archive-page"
  class="relative overflow-hidden bg-white"
  role="main">

  <style>
    #rsp-archive-page {
      --rsp-archive-title: #334155;
      --rsp-archive-heading: #3B4658;
      --rsp-archive-body: #64748B;
      --rsp-archive-blue: #2563EB;
      --rsp-archive-green: #00C853;
      --rsp-archive-border: rgba(148, 163, 184, 0.26);
    }

    #rsp-archive-page .rsp-archive-title,
    #rsp-archive-page .rsp-archive-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      text-wrap: balance;
    }

    #rsp-archive-page .rsp-archive-title {
      color: var(--rsp-archive-title);
    }

    #rsp-archive-page .rsp-archive-heading {
      color: var(--rsp-archive-heading);
    }

    #rsp-archive-page .rsp-archive-text,
    #rsp-archive-page .rsp-archive-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-archive-body);
    }

    #rsp-archive-page .rsp-archive-text {
      font-weight: 500;
    }

    #rsp-archive-page .rsp-archive-body {
      font-weight: 400;
    }

    #rsp-archive-page .rsp-archive-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #rsp-archive-page .rsp-archive-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #rsp-archive-page .rsp-archive-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #rsp-archive-page .rsp-archive-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #rsp-archive-page .rsp-archive-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #rsp-archive-page .rsp-archive-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #rsp-archive-page .rsp-archive-card:hover .rsp-archive-card-image img {
      transform: scale(1.06);
    }

    #rsp-archive-page .rsp-archive-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #rsp-archive-page .rsp-archive-motion-border::before {
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
      animation: rspArchiveBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #rsp-archive-page .rsp-archive-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-archive-inner, #ffffff);
      pointer-events: none;
    }

    #rsp-archive-page .rsp-archive-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #rsp-archive-page .rsp-archive-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #rsp-archive-page .rsp-archive-btn::before {
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

    #rsp-archive-page .rsp-archive-btn:hover {
      transform: translateY(-3px);
    }

    #rsp-archive-page .rsp-archive-btn:hover::before {
      left: 135%;
    }

    #rsp-archive-page .rsp-archive-pagination .nav-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.75rem;
    }

    #rsp-archive-page .rsp-archive-pagination .page-numbers {
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

    #rsp-archive-page .rsp-archive-pagination .page-numbers:hover,
    #rsp-archive-page .rsp-archive-pagination .page-numbers.current {
      transform: translateY(-2px);
      border-color: rgba(37, 99, 235, 0.28);
      background: #2563EB;
      color: #ffffff;
    }

    @keyframes rspArchiveBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #rsp-archive-page *,
      #rsp-archive-page *::before,
      #rsp-archive-page *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #rsp-archive-page .rsp-archive-reveal {
        opacity: 1;
        transform: none;
      }

      #rsp-archive-page .rsp-archive-card:hover,
      #rsp-archive-page .rsp-archive-btn:hover {
        transform: none;
      }

      #rsp-archive-page .rsp-archive-card:hover .rsp-archive-card-image img {
        transform: none;
      }
    }
  </style>

  <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24" aria-labelledby="archive-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="mx-auto max-w-4xl text-center">
        <?php if (function_exists('rsp_breadcrumb')) : ?>
          <div class="rsp-archive-reveal mb-8 flex justify-center" data-rsp-archive-reveal>
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="rsp-archive-eyebrow rsp-archive-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-archive-reveal>
          <?php echo $render_icon('archive', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Knowledge Archive', 'reviewservicepro'); ?>
        </span>

        <h1 id="archive-title" class="rsp-archive-title rsp-archive-reveal mx-auto text-[clamp(38px,5.6vw,74px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-archive-reveal>
          <?php echo wp_kses_post($archive_title); ?>
        </h1>

        <?php if (! empty($archive_desc)) : ?>
          <div class="rsp-archive-text rsp-archive-reveal mx-auto mt-6 max-w-3xl" data-rsp-archive-reveal>
            <?php echo wp_kses_post($archive_desc); ?>
          </div>
        <?php else : ?>
          <p class="rsp-archive-text rsp-archive-reveal mx-auto mt-6 max-w-3xl" data-rsp-archive-reveal>
            <?php esc_html_e('Explore practical articles, guides, insights, and strategies from ReviewService.Pro about reputation management, reviews, customer trust, and ethical ORM systems.', 'reviewservicepro'); ?>
          </p>
        <?php endif; ?>

        <div class="rsp-archive-reveal mt-8 flex flex-wrap justify-center gap-3" data-rsp-archive-reveal>
          <span class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600 shadow-sm">
            <?php echo $render_icon('file-text', 'h-4 w-4 text-blue-600'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php echo esc_html((string) $archive_count); ?> <?php esc_html_e('resources', 'reviewservicepro'); ?>
          </span>
          <span class="inline-flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-emerald-700 shadow-sm">
            <?php echo $render_icon('shield-check', 'h-4 w-4 text-emerald-600'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Ethical ORM focused', 'reviewservicepro'); ?>
          </span>
        </div>
      </div>
    </div>
  </section>

  <section class="relative overflow-hidden bg-white px-5 py-14 sm:px-6 lg:px-8 lg:py-16">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 gap-6 lg:grid-cols-[1fr_0.62fr] lg:items-stretch">
      <div class="rsp-archive-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-archive-reveal>
        <span class="rsp-archive-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
          <?php echo $render_icon('book-open-text', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Knowledge Library', 'reviewservicepro'); ?>
        </span>

        <h2 class="rsp-archive-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
          <?php esc_html_e('Browse latest reputation resources.', 'reviewservicepro'); ?>
        </h2>

        <p class="rsp-archive-body mt-5 max-w-3xl">
          <?php esc_html_e('Read practical ORM guides covering review platforms, response strategy, customer feedback systems, trust signals, and online reputation growth.', 'reviewservicepro'); ?>
        </p>
      </div>

      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="rsp-archive-reveal rounded-[2rem] border border-blue-200 bg-blue-50/80 p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-archive-reveal>
        <label for="archive-search" class="rsp-archive-eyebrow mb-4 block text-blue-700">
          <?php esc_html_e('Search ORM resources', 'reviewservicepro'); ?>
        </label>

        <div class="relative">
          <input
            id="archive-search"
            type="search"
            name="s"
            placeholder="<?php esc_attr_e('Search ORM resources...', 'reviewservicepro'); ?>"
            class="w-full rounded-2xl border border-blue-200 bg-white px-5 py-4 pr-14 font-['Inter',sans-serif] text-[16px] font-medium text-[#334155] shadow-sm placeholder:text-slate-400 focus:border-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-100">

          <button type="submit" class="absolute right-2 top-1/2 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-xl bg-blue-600 text-white transition-colors duration-200 hover:bg-blue-700">
            <span class="sr-only"><?php esc_html_e('Search', 'reviewservicepro'); ?></span>
            <?php echo $render_icon('search', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </button>
        </div>
      </form>
    </div>
  </section>

  <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="archive-grid-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-archive-reveal mb-12 max-w-3xl" data-rsp-archive-reveal>
        <span class="rsp-archive-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
          <?php echo $render_icon('layout-grid', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Archive Library', 'reviewservicepro'); ?>
        </span>

        <h2 id="archive-grid-title" class="rsp-archive-title mt-4 text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
          <?php esc_html_e('Latest resources and insights', 'reviewservicepro'); ?>
        </h2>
      </div>

      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          $post_index = 0;

          while (have_posts()) :
            the_post();

            $post_categories = get_the_category();
            $delay           = min($post_index * 70, 420);
          ?>
            <article
              id="post-<?php the_ID(); ?>"
              <?php post_class('rsp-archive-card rsp-archive-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
              data-rsp-archive-reveal
              style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">

              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-archive-card-image h-56 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <?php echo $render_icon('book-open-text', 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="p-6">
                  <div class="mb-4 flex flex-wrap items-center gap-2">
                    <?php if (! empty($post_categories)) : ?>
                      <?php foreach (array_slice($post_categories, 0, 2) as $post_category) : ?>
                        <span class="rsp-archive-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                          <?php echo esc_html($post_category->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                  <h3 class="rsp-archive-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                    <?php the_title(); ?>
                  </h3>

                  <p class="rsp-archive-body mt-4">
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

        <div class="rsp-archive-pagination mt-12">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
              'next_text'          => esc_html__('Next', 'reviewservicepro'),
              'screen_reader_text' => esc_html__('Archive navigation', 'reviewservicepro'),
            ]
          );
          ?>
        </div>
      <?php else : ?>
        <div class="rsp-archive-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-archive-reveal>
          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
            <?php echo $render_icon('archive-x', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h2 class="rsp-archive-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
            <?php esc_html_e('No posts found.', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-archive-text mx-auto mt-4 max-w-xl">
            <?php esc_html_e('There are no articles available in this archive yet.', 'reviewservicepro'); ?>
          </p>

          <a href="<?php echo esc_url($academy_url); ?>" class="rsp-archive-btn mt-8 inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php echo $render_icon('book-open', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Browse ORM Academy', 'reviewservicepro'); ?>
            </span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-archive-reveal rsp-archive-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-archive-reveal style="--rsp-archive-inner:#ffffff;">
        <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.55fr] lg:items-center">
          <div>
            <span class="rsp-archive-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
              <?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Ethical Reputation Support', 'reviewservicepro'); ?>
            </span>

            <h2 class="rsp-archive-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
              <?php esc_html_e('Need help improving your reputation?', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-archive-text mt-5 max-w-2xl">
              <?php esc_html_e('Get a free reputation audit and discover what is hurting your online trust, visibility, and customer conversion rate.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($audit_url); ?>" class="rsp-archive-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>

            <a href="<?php echo esc_url($academy_url); ?>" class="rsp-archive-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Visit ORM Academy', 'reviewservicepro'); ?>
                <?php echo $render_icon('book-open', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  (function() {
    function initRspArchivePage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-archive-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspArchiveVisible === 'true') {
          return;
        }

        item.dataset.rspArchiveVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspArchivePage);
    } else {
      initRspArchivePage();
    }
  })();
</script>

<?php
get_footer();
