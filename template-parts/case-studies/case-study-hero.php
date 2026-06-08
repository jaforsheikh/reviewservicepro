<?php

/**
 * Case Study Hero Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id           = get_the_ID();
$title             = get_the_title();
$excerpt           = get_the_excerpt();

$client_type       = get_post_meta($post_id, 'rsp_client_type', true);
$platform_used     = get_post_meta($post_id, 'rsp_platform_used', true);
$starting_rating   = get_post_meta($post_id, 'rsp_starting_rating', true);
$final_rating      = get_post_meta($post_id, 'rsp_final_rating', true);
$review_growth     = get_post_meta($post_id, 'rsp_review_growth', true);
$timeline          = get_post_meta($post_id, 'rsp_timeline', true);
$focus_keyword     = get_post_meta($post_id, 'rsp_focus_keyword', true);

$industry_terms = get_the_terms($post_id, 'industry_type');
$case_terms     = get_the_terms($post_id, 'case_study_type');

$featured_image = '';

if (has_post_thumbnail()) {
  $featured_image = get_the_post_thumbnail_url(
    $post_id,
    'rsp-featured-large'
  );
}

if (empty($featured_image)) {
  $featured_image = get_template_directory_uri() . '/assets/images/placeholder-case-study.jpg';
}

$metrics = [
  [
    'label' => __('Starting Rating', 'reviewservicepro'),
    'value' => $starting_rating ? $starting_rating : '—',
    'icon'  => 'star-half',
  ],
  [
    'label' => __('Final Rating', 'reviewservicepro'),
    'value' => $final_rating ? $final_rating : '—',
    'icon'  => 'badge-check',
  ],
  [
    'label' => __('Review Growth', 'reviewservicepro'),
    'value' => $review_growth ? $review_growth : '—',
    'icon'  => 'chart-column-big',
  ],
  [
    'label' => __('Timeline', 'reviewservicepro'),
    'value' => $timeline ? $timeline : '—',
    'icon'  => 'clock-3',
  ],
];

?>

<section
  class="relative overflow-hidden border-b border-white/[0.05] bg-[#07111F] py-20 md:py-28"
  data-gsap="case-study-hero"
  aria-labelledby="case-study-title">
  <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>

  <div class="pointer-events-none absolute -top-24 left-1/2 z-0 h-[540px] w-[920px] -translate-x-1/2 rounded-full bg-blue-600/[0.16] blur-[140px]"></div>

  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[440px] w-[520px] rounded-full bg-emerald-500/[0.08] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <?php if (function_exists('rsp_breadcrumb')) : ?>
      <div class="mb-10">
        <?php rsp_breadcrumb(); ?>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1fr_0.92fr] lg:items-center">

      <div>

        <div class="mb-6 flex flex-wrap gap-3">

          <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
            <?php
            echo function_exists('rsp_icon')
              ? wp_kses_post(rsp_icon('shield-check', 'h-3.5 w-3.5'))
              : '';
            ?>
            <?php esc_html_e('Verified Case Study', 'reviewservicepro'); ?>
          </span>

          <?php if ($platform_used) : ?>
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
              <?php
              echo function_exists('rsp_icon')
                ? wp_kses_post(rsp_icon('star', 'h-3.5 w-3.5'))
                : '';
              ?>
              <?php echo esc_html($platform_used); ?>
            </span>
          <?php endif; ?>

        </div>

        <h1
          id="case-study-title"
          class="max-w-4xl text-4xl font-extrabold leading-tight tracking-tight text-white md:text-6xl">
          <?php the_title(); ?>
        </h1>

        <?php if (! empty($excerpt)) : ?>
          <p class="mt-6 max-w-3xl text-base leading-8 text-slate-400 md:text-lg">
            <?php echo esc_html($excerpt); ?>
          </p>
        <?php endif; ?>

        <div class="mt-8 flex flex-wrap gap-3">

          <?php if ($client_type) : ?>
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.04] px-5 py-3">
              <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
                <?php esc_html_e('Client Type', 'reviewservicepro'); ?>
              </p>

              <p class="mt-1 text-sm font-semibold text-white">
                <?php echo esc_html($client_type); ?>
              </p>
            </div>
          <?php endif; ?>

          <?php if ($focus_keyword) : ?>
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.04] px-5 py-3">
              <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
                <?php esc_html_e('Focus Area', 'reviewservicepro'); ?>
              </p>

              <p class="mt-1 text-sm font-semibold text-white">
                <?php echo esc_html($focus_keyword); ?>
              </p>
            </div>
          <?php endif; ?>

        </div>

        <?php if (! empty($industry_terms) || ! empty($case_terms)) : ?>
          <div class="mt-8 flex flex-wrap gap-3">

            <?php
            if (! empty($industry_terms) && ! is_wp_error($industry_terms)) :
              foreach ($industry_terms as $term) :
            ?>
                <span class="inline-flex items-center rounded-full border border-white/[0.08] bg-white/[0.035] px-4 py-2 text-xs font-bold text-slate-300">
                  <?php echo esc_html($term->name); ?>
                </span>
            <?php
              endforeach;
            endif;
            ?>

            <?php
            if (! empty($case_terms) && ! is_wp_error($case_terms)) :
              foreach ($case_terms as $term) :
            ?>
                <span class="inline-flex items-center rounded-full border border-blue-500/20 bg-blue-600/10 px-4 py-2 text-xs font-bold text-blue-300">
                  <?php echo esc_html($term->name); ?>
                </span>
            <?php
              endforeach;
            endif;
            ?>

          </div>
        <?php endif; ?>

        <div class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-4">

          <?php foreach ($metrics as $metric) : ?>
            <div class="rounded-[1.6rem] border border-white/[0.08] bg-white/[0.035] p-5 backdrop-blur-sm">

              <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php
                echo function_exists('rsp_icon')
                  ? wp_kses_post(rsp_icon($metric['icon'], 'h-5 w-5'))
                  : '';
                ?>
              </div>

              <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
                <?php echo esc_html($metric['label']); ?>
              </p>

              <p class="mt-2 text-2xl font-extrabold text-white">
                <?php echo esc_html($metric['value']); ?>
              </p>

            </div>
          <?php endforeach; ?>

        </div>

      </div>

      <div class="relative">

        <div class="absolute -inset-5 rounded-[2rem] bg-blue-600/[0.08] blur-3xl"></div>

        <div class="relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] shadow-[0_20px_100px_rgba(37,99,235,0.15)]">

          <img
            src="<?php echo esc_url($featured_image); ?>"
            alt="<?php echo esc_attr($title); ?>"
            class="h-full w-full object-cover"
            loading="eager"
            decoding="async">

          <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#07111F] via-[#07111F]/75 to-transparent p-6 md:p-8">

            <div class="flex flex-wrap items-center gap-3">

              <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-4 py-2 text-xs font-bold text-emerald-300">
                <?php
                echo function_exists('rsp_icon')
                  ? wp_kses_post(rsp_icon('badge-check', 'h-3.5 w-3.5'))
                  : '';
                ?>
                <?php esc_html_e('Ethical ORM Strategy', 'reviewservicepro'); ?>
              </div>

              <div class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-600/10 px-4 py-2 text-xs font-bold text-blue-300">
                <?php
                echo function_exists('rsp_icon')
                  ? wp_kses_post(rsp_icon('chart-no-axes-column', 'h-3.5 w-3.5'))
                  : '';
                ?>
                <?php esc_html_e('Trust Growth Focused', 'reviewservicepro'); ?>
              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
</section>