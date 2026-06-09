<?php

/**
 * Case Studies Archive Template
 *
 * ReviewService.Pro — Premium White SaaS Case Studies Archive
 *
 * File: archive-case_studies.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$case_count      = wp_count_posts('case_studies');
$published_count = isset($case_count->publish) ? (int) $case_count->publish : 0;
$archive_title   = get_the_archive_title();

if (empty($archive_title) || false !== strpos($archive_title, ':')) {
  $archive_title = __('Reputation Management Case Studies', 'reviewservicepro');
}

$audit_url        = home_url('/contact/?type=free-audit');
$consultation_url = home_url('/contact/?type=consultation');
$services_url     = home_url('/services/');

$proof_stats = [
  [
    'icon'  => 'shield-check',
    'value' => __('Ethical', 'reviewservicepro'),
    'label' => __('ORM workflows only', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'chart-column-big',
    'value' => $published_count ? $published_count . '+' : '0',
    'label' => __('published case studies', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'radar',
    'value' => __('Audit', 'reviewservicepro'),
    'label' => __('review risks & trust gaps', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$filter_terms = get_terms(
  [
    'taxonomy'   => 'industry_type',
    'hide_empty' => true,
    'number'     => 8,
  ]
);

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

<div id="case-studies-archive" class="relative overflow-hidden bg-white" role="main">
  <style>
    #case-studies-archive {
      --rsp-case-title: #334155;
      --rsp-case-heading: #3B4658;
      --rsp-case-body: #64748B;
    }

    #case-studies-archive .rsp-case-title,
    #case-studies-archive .rsp-case-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      text-wrap: balance;
    }

    #case-studies-archive .rsp-case-title {
      color: var(--rsp-case-title);
    }

    #case-studies-archive .rsp-case-heading {
      color: var(--rsp-case-heading);
    }

    #case-studies-archive .rsp-case-text,
    #case-studies-archive .rsp-case-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-case-body);
    }

    #case-studies-archive .rsp-case-text {
      font-weight: 500;
    }

    #case-studies-archive .rsp-case-body {
      font-weight: 400;
    }

    #case-studies-archive .rsp-case-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #case-studies-archive .rsp-case-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #case-studies-archive .rsp-case-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #case-studies-archive .rsp-case-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #case-studies-archive .rsp-case-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #case-studies-archive .rsp-case-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #case-studies-archive .rsp-case-card:hover .rsp-case-card-image img {
      transform: scale(1.06);
    }

    #case-studies-archive .rsp-case-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #case-studies-archive .rsp-case-motion-border::before {
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
      animation: rspCaseBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #case-studies-archive .rsp-case-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-case-inner, #ffffff);
      pointer-events: none;
    }

    #case-studies-archive .rsp-case-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #case-studies-archive .rsp-case-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #case-studies-archive .rsp-case-btn::before {
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

    #case-studies-archive .rsp-case-btn:hover {
      transform: translateY(-3px);
    }

    #case-studies-archive .rsp-case-btn:hover::before {
      left: 135%;
    }

    #case-studies-archive .rsp-case-pagination .nav-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.75rem;
    }

    #case-studies-archive .rsp-case-pagination .page-numbers {
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

    #case-studies-archive .rsp-case-pagination .page-numbers:hover,
    #case-studies-archive .rsp-case-pagination .page-numbers.current {
      transform: translateY(-2px);
      border-color: rgba(37, 99, 235, 0.28);
      background: #2563EB;
      color: #ffffff;
    }

    @keyframes rspCaseBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #case-studies-archive *,
      #case-studies-archive *::before,
      #case-studies-archive *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      #case-studies-archive .rsp-case-reveal {
        opacity: 1;
        transform: none;
      }

      #case-studies-archive .rsp-case-card:hover,
      #case-studies-archive .rsp-case-btn:hover {
        transform: none;
      }

      #case-studies-archive .rsp-case-card:hover .rsp-case-card-image img {
        transform: none;
      }
    }
  </style>

  <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24" aria-labelledby="case-archive-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="mx-auto max-w-4xl text-center">
        <?php if (function_exists('rsp_breadcrumb')) : ?>
          <div class="rsp-case-reveal mb-8 flex justify-center" data-rsp-case-reveal>
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="rsp-case-eyebrow rsp-case-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-case-reveal>
          <?php echo $render_icon('chart-no-axes-combined', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Proof & Trust Library', 'reviewservicepro'); ?>
        </span>

        <h1 id="case-archive-title" class="rsp-case-title rsp-case-reveal mx-auto text-[clamp(38px,5.6vw,74px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-case-reveal>
          <?php echo esc_html($archive_title); ?>
        </h1>

        <p class="rsp-case-text rsp-case-reveal mx-auto mt-6 max-w-3xl" data-rsp-case-reveal>
          <?php esc_html_e('Explore practical case studies showing how review monitoring, professional response workflows, platform visibility, reporting, and ethical reputation systems can support trust-focused businesses.', 'reviewservicepro'); ?>
        </p>

        <div class="rsp-case-reveal mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3" data-rsp-case-reveal>
          <?php foreach ($proof_stats as $stat) : ?>
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
    <div class="relative z-10 mx-auto grid max-w-7xl grid-cols-1 gap-6 lg:grid-cols-[1fr_0.7fr]">
      <div class="rsp-case-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-case-reveal>
        <span class="rsp-case-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
          <?php echo $render_icon('file-check-2', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Case Study Strategy', 'reviewservicepro'); ?>
        </span>
        <h2 class="rsp-case-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
          <?php esc_html_e('Learn from ethical reputation workflows, not risky shortcuts.', 'reviewservicepro'); ?>
        </h2>
        <p class="rsp-case-body mt-5 max-w-3xl">
          <?php esc_html_e('Each case study focuses on the problem, the strategy, the platform-compliant actions, and the practical next steps — without claiming guaranteed review removal, guaranteed rankings, fake reviews, or rating manipulation.', 'reviewservicepro'); ?>
        </p>
      </div>
      <div class="rsp-case-reveal rsp-case-motion-border rounded-[2rem] border border-blue-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-case-reveal style="--rsp-case-inner:#ffffff;">
        <div class="relative z-10">
          <span class="rsp-case-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700">
            <?php echo $render_icon('search-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Need your own audit?', 'reviewservicepro'); ?>
          </span>
          <h2 class="rsp-case-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
            <?php esc_html_e('Turn reputation gaps into a clear action plan.', 'reviewservicepro'); ?>
          </h2>
          <p class="rsp-case-body mt-5">
            <?php esc_html_e('We can review your public reputation signals, response gaps, platform issues, and customer trust opportunities.', 'reviewservicepro'); ?>
          </p>
          <a href="<?php echo esc_url($audit_url); ?>" class="rsp-case-btn mt-7 inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?>
              <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="case-grid-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="rsp-case-reveal max-w-3xl" data-rsp-case-reveal>
          <span class="rsp-case-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
            <?php echo $render_icon('layout-grid', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Case Study Library', 'reviewservicepro'); ?>
          </span>
          <h2 id="case-grid-title" class="rsp-case-title mt-4 text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
            <?php esc_html_e('Browse reputation case studies', 'reviewservicepro'); ?>
          </h2>
        </div>

        <?php if (! empty($filter_terms) && ! is_wp_error($filter_terms)) : ?>
          <div class="rsp-case-reveal flex flex-wrap gap-3 lg:max-w-xl lg:justify-end" data-rsp-case-reveal>
            <?php foreach ($filter_terms as $term) : ?>
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
            $case_terms     = get_the_terms(get_the_ID(), 'case_study_type');
            $industry_terms = get_the_terms(get_the_ID(), 'industry_type');
            $delay          = min($post_index * 70, 420);
          ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('rsp-case-card rsp-case-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?> data-rsp-case-reveal style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">
              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-case-card-image h-56 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <?php echo $render_icon('file-chart-column', 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="p-6">
                  <div class="mb-4 flex flex-wrap items-center gap-2">
                    <?php if (! empty($case_terms) && ! is_wp_error($case_terms)) : ?>
                      <?php foreach (array_slice($case_terms, 0, 1) as $case_term) : ?>
                        <span class="rsp-case-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700"><?php echo esc_html($case_term->name); ?></span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (! empty($industry_terms) && ! is_wp_error($industry_terms)) : ?>
                      <?php foreach (array_slice($industry_terms, 0, 1) as $industry_term) : ?>
                        <span class="rsp-case-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700"><?php echo esc_html($industry_term->name); ?></span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                  <h3 class="rsp-case-heading text-2xl font-[800] leading-tight tracking-[-0.04em]"><?php the_title(); ?></h3>
                  <p class="rsp-case-body mt-4"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                  <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                    <span class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500"><?php echo esc_html(get_the_date()); ?></span>
                    <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                      <?php esc_html_e('Read case study', 'reviewservicepro'); ?>
                      <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                      ?>
                    </span>
                  </div>
                </div>
              </a>
            </article>
          <?php $post_index++;
          endwhile; ?>
        </div>
        <div class="rsp-case-pagination mt-12">
          <?php the_posts_pagination(['mid_size' => 2, 'prev_text' => esc_html__('Previous', 'reviewservicepro'), 'next_text' => esc_html__('Next', 'reviewservicepro'), 'screen_reader_text' => esc_html__('Case studies navigation', 'reviewservicepro')]); ?>
        </div>
      <?php else : ?>
        <div class="rsp-case-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-case-reveal>
          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600"><?php echo $render_icon('search-x', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                            ?></div>
          <h2 class="rsp-case-heading text-2xl font-[800] leading-tight tracking-[-0.04em]"><?php esc_html_e('No case studies found yet.', 'reviewservicepro'); ?></h2>
          <p class="rsp-case-text mx-auto mt-4 max-w-xl"><?php esc_html_e('Add case studies from the WordPress dashboard to build this proof library.', 'reviewservicepro'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="rsp-case-reveal rsp-case-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-case-reveal style="--rsp-case-inner:#ffffff;">
        <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.55fr] lg:items-center">
          <div>
            <span class="rsp-case-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700"><?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                ?><?php esc_html_e('Ethical ORM Case Review', 'reviewservicepro'); ?></span>
            <h2 class="rsp-case-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]"><?php esc_html_e('Want a reputation strategy built around your business?', 'reviewservicepro'); ?></h2>
            <p class="rsp-case-text mt-5 max-w-2xl"><?php esc_html_e('Get a free audit and discover which review platforms, customer trust signals, response gaps, and reputation risks should be prioritized first.', 'reviewservicepro'); ?></p>
          </div>
          <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url($audit_url); ?>" class="rsp-case-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]"><span class="relative z-10 inline-flex items-center gap-2"><?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?><?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ?></span></a>
            <a href="<?php echo esc_url($consultation_url); ?>" class="rsp-case-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700"><span class="relative z-10 inline-flex items-center gap-2"><?php esc_html_e('Book Consultation', 'reviewservicepro'); ?><?php echo $render_icon('calendar-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ?></span></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  (function() {
    function initRspCaseArchive() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
      var items = document.querySelectorAll('[data-rsp-case-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspCaseVisible === 'true') return;
        item.dataset.rspCaseVisible = 'true';
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
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initRspCaseArchive);
    else initRspCaseArchive();
  })();
</script>

<?php
get_footer();
