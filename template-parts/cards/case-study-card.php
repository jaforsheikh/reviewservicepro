<?php

/**
 * Reusable Case Study Card
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id   = get_the_ID();
$title     = get_the_title($post_id);
$permalink = get_permalink($post_id);
$excerpt   = function_exists('rsp_get_excerpt') ? rsp_get_excerpt($post_id, 22) : wp_trim_words(get_the_excerpt($post_id), 22);

if (function_exists('rsp_get_case_study_metrics')) {
  $case_metrics = rsp_get_case_study_metrics($post_id);
} else {
  $case_metrics = [
    'client_type'     => get_post_meta($post_id, 'rsp_client_type', true),
    'platform_used'   => get_post_meta($post_id, 'rsp_platform_used', true),
    'starting_rating' => get_post_meta($post_id, 'rsp_starting_rating', true),
    'final_rating'    => get_post_meta($post_id, 'rsp_final_rating', true),
    'review_growth'   => get_post_meta($post_id, 'rsp_review_growth', true),
    'timeline'        => get_post_meta($post_id, 'rsp_timeline', true),
  ];
}

$client_type     = $case_metrics['client_type'] ?? '';
$platform_used   = $case_metrics['platform_used'] ?? '';
$starting_rating = $case_metrics['starting_rating'] ?? '—';
$final_rating    = $case_metrics['final_rating'] ?? '—';
$review_growth   = $case_metrics['review_growth'] ?? '—';
$timeline        = $case_metrics['timeline'] ?? '';

$industry_terms = get_the_terms($post_id, 'industry_type');

$image_url = has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'rsp-blog-card')
  : '';

$metrics = [
  [
    'icon'  => 'star-half',
    'label' => __('Before', 'reviewservicepro'),
    'value' => $starting_rating ? $starting_rating : '—',
  ],
  [
    'icon'  => 'badge-check',
    'label' => __('After', 'reviewservicepro'),
    'value' => $final_rating ? $final_rating : '—',
  ],
  [
    'icon'  => 'trending-up',
    'label' => __('Growth', 'reviewservicepro'),
    'value' => $review_growth ? $review_growth : '—',
  ],
];
?>

<article
  id="post-<?php echo esc_attr($post_id); ?>"
  <?php post_class('group relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/35 hover:bg-white/[0.055] hover:shadow-[0_24px_90px_rgba(37,99,235,0.14)]', $post_id); ?>
  itemscope
  itemtype="https://schema.org/Article">
  <a
    href="<?php echo esc_url($permalink); ?>"
    class="absolute inset-0 z-20"
    aria-label="<?php echo esc_attr(sprintf(__('Read case study: %s', 'reviewservicepro'), $title)); ?>"></a>

  <meta itemprop="headline" content="<?php echo esc_attr($title); ?>">
  <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
  <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('c', $post_id)); ?>">

  <div class="relative aspect-[16/10] overflow-hidden border-b border-white/[0.06] bg-[#0B1220]">
    <?php if (! empty($image_url)) : ?>
      <img
        src="<?php echo esc_url($image_url); ?>"
        alt="<?php echo esc_attr($title); ?>"
        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
        loading="lazy"
        decoding="async"
        itemprop="image">
    <?php else : ?>
      <div class="flex h-full w-full flex-col items-center justify-center bg-gradient-to-br from-blue-600/[0.16] to-emerald-500/[0.08]">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('chart-column-big', 'mb-3 h-10 w-10 text-blue-300')) : ''; ?>

        <span class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
          <?php esc_html_e('Case Study', 'reviewservicepro'); ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="absolute inset-0 bg-gradient-to-t from-[#07111F]/90 via-[#07111F]/15 to-transparent"></div>

    <div class="absolute left-4 top-4 z-10 flex flex-wrap gap-2">
      <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-emerald-300 backdrop-blur-md">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-3 w-3')) : ''; ?>
        <?php esc_html_e('Ethical ORM', 'reviewservicepro'); ?>
      </span>

      <?php if (! empty($industry_terms) && ! is_wp_error($industry_terms)) : ?>
        <span class="inline-flex rounded-full border border-blue-500/20 bg-blue-600/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-blue-300 backdrop-blur-md">
          <?php echo esc_html($industry_terms[0]->name); ?>
        </span>
      <?php endif; ?>
    </div>
  </div>

  <div class="relative z-10 p-6 md:p-7">
    <div class="mb-4 flex flex-wrap gap-2">
      <?php if (! empty($client_type) && '—' !== $client_type) : ?>
        <span class="inline-flex items-center gap-1.5 rounded-full border border-white/[0.08] bg-white/[0.04] px-3 py-1.5 text-xs font-bold text-slate-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('briefcase-business', 'h-3.5 w-3.5 text-blue-300')) : ''; ?>
          <?php echo esc_html($client_type); ?>
        </span>
      <?php endif; ?>

      <?php if (! empty($platform_used) && '—' !== $platform_used) : ?>
        <span class="inline-flex items-center gap-1.5 rounded-full border border-white/[0.08] bg-white/[0.04] px-3 py-1.5 text-xs font-bold text-slate-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('star', 'h-3.5 w-3.5 text-amber-300')) : ''; ?>
          <?php echo esc_html($platform_used); ?>
        </span>
      <?php endif; ?>
    </div>

    <h3 class="text-xl font-extrabold leading-tight text-white md:text-2xl" itemprop="name">
      <?php echo esc_html($title); ?>
    </h3>

    <?php if (! empty($excerpt)) : ?>
      <p class="mt-4 text-sm leading-7 text-slate-400" itemprop="description">
        <?php echo esc_html($excerpt); ?>
      </p>
    <?php endif; ?>

    <div class="mt-6 grid grid-cols-3 gap-3">
      <?php foreach ($metrics as $metric) : ?>
        <div class="rounded-2xl border border-white/[0.07] bg-white/[0.035] p-3">
          <div class="mb-2 flex h-8 w-8 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($metric['icon'], 'h-3.5 w-3.5')) : ''; ?>
          </div>

          <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
            <?php echo esc_html($metric['label']); ?>
          </p>

          <p class="mt-1 truncate text-sm font-extrabold text-white">
            <?php echo esc_html($metric['value']); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-6 flex items-center justify-between gap-4 border-t border-white/[0.06] pt-5">
      <?php if (! empty($timeline) && '—' !== $timeline) : ?>
        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('clock-3', 'h-3.5 w-3.5 text-blue-300')) : ''; ?>
          <?php echo esc_html($timeline); ?>
        </span>
      <?php else : ?>
        <span class="text-xs font-bold text-slate-500">
          <?php esc_html_e('Case Study', 'reviewservicepro'); ?>
        </span>
      <?php endif; ?>

      <span class="inline-flex items-center gap-2 text-sm font-extrabold text-blue-300">
        <?php esc_html_e('View Details', 'reviewservicepro'); ?>
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1')) : ''; ?>
      </span>
    </div>
  </div>
</article>