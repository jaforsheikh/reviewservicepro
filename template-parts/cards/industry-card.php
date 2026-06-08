<?php

/**
 * Reusable Industry Card
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

$industry_icon = function_exists('rsp_get_industry_icon')
  ? rsp_get_industry_icon($post_id)
  : get_post_meta($post_id, 'rsp_industry_icon', true);

$focus_keyword         = get_post_meta($post_id, 'rsp_focus_keyword', true);
$trust_factors         = get_post_meta($post_id, 'rsp_trust_factors', true);
$reputation_challenges = get_post_meta($post_id, 'rsp_reputation_challenges', true);
$recommended_platforms = get_post_meta($post_id, 'rsp_recommended_platforms', true);

$industry_terms = get_the_terms($post_id, 'industry_type');
$icon           = ! empty($industry_icon) ? sanitize_key($industry_icon) : 'building-2';

$image_url = has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'rsp-blog-card')
  : '';

$trust_summary = ! empty($trust_factors)
  ? wp_trim_words(wp_strip_all_tags($trust_factors), 14)
  : __('Ratings, customer feedback, response quality, and visible trust signals.', 'reviewservicepro');

$challenge_summary = ! empty($reputation_challenges)
  ? wp_trim_words(wp_strip_all_tags($reputation_challenges), 14)
  : __('Low ratings, unanswered reviews, weak feedback systems, and trust gaps.', 'reviewservicepro');

$platform_summary = ! empty($recommended_platforms)
  ? wp_trim_words(wp_strip_all_tags($recommended_platforms), 10)
  : __('Google, Trustpilot, Facebook, Yelp, BBB, and industry platforms.', 'reviewservicepro');
?>

<article
  id="post-<?php echo esc_attr($post_id); ?>"
  <?php post_class('group relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/35 hover:bg-white/[0.055] hover:shadow-[0_24px_90px_rgba(16,185,129,0.12)]', $post_id); ?>
  itemscope
  itemtype="https://schema.org/Article">
  <a
    href="<?php echo esc_url($permalink); ?>"
    class="absolute inset-0 z-20"
    aria-label="<?php echo esc_attr(sprintf(__('View industry guide: %s', 'reviewservicepro'), $title)); ?>"></a>

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
      <div class="flex h-full w-full flex-col items-center justify-center bg-gradient-to-br from-emerald-500/[0.14] to-blue-600/[0.10]">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($icon, 'mb-3 h-11 w-11 text-emerald-300')) : ''; ?>

        <span class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
          <?php esc_html_e('Industry Guide', 'reviewservicepro'); ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="absolute inset-0 bg-gradient-to-t from-[#07111F]/90 via-[#07111F]/15 to-transparent"></div>

    <div class="absolute left-4 top-4 z-10 flex flex-wrap gap-2">
      <?php if (! empty($industry_terms) && ! is_wp_error($industry_terms)) : ?>
        <span class="inline-flex rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-emerald-300 backdrop-blur-md">
          <?php echo esc_html($industry_terms[0]->name); ?>
        </span>
      <?php endif; ?>

      <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-500/20 bg-blue-600/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-blue-300 backdrop-blur-md">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-3 w-3')) : ''; ?>
        <?php esc_html_e('Trust Industry', 'reviewservicepro'); ?>
      </span>
    </div>

    <div class="absolute bottom-4 right-4 z-10 flex h-14 w-14 items-center justify-center rounded-2xl border border-white/[0.10] bg-[#07111F]/80 text-emerald-300 shadow-lg backdrop-blur-md">
      <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($icon, 'h-7 w-7')) : ''; ?>
    </div>
  </div>

  <div class="relative z-10 p-6 md:p-7">
    <?php if (! empty($focus_keyword)) : ?>
      <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/[0.08] bg-white/[0.04] px-3 py-1.5 text-xs font-bold text-slate-300">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search', 'h-3.5 w-3.5 text-emerald-300')) : ''; ?>
        <?php echo esc_html($focus_keyword); ?>
      </div>
    <?php endif; ?>

    <h3 class="text-xl font-extrabold leading-tight text-white md:text-2xl" itemprop="name">
      <?php echo esc_html($title); ?>
    </h3>

    <?php if (! empty($excerpt)) : ?>
      <p class="mt-4 text-sm leading-7 text-slate-400" itemprop="description">
        <?php echo esc_html($excerpt); ?>
      </p>
    <?php endif; ?>

    <div class="mt-6 grid grid-cols-1 gap-4">
      <div class="rounded-2xl border border-white/[0.07] bg-white/[0.035] p-4">
        <div class="flex items-start gap-3">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('badge-check', 'h-4 w-4')) : ''; ?>
          </div>

          <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
              <?php esc_html_e('Trust Factors', 'reviewservicepro'); ?>
            </p>

            <p class="mt-1 text-sm font-bold leading-6 text-white">
              <?php echo esc_html($trust_summary); ?>
            </p>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-white/[0.07] bg-white/[0.035] p-4">
        <div class="flex items-start gap-3">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-red-500/20 bg-red-500/10 text-red-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('triangle-alert', 'h-4 w-4')) : ''; ?>
          </div>

          <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
              <?php esc_html_e('Reputation Risks', 'reviewservicepro'); ?>
            </p>

            <p class="mt-1 text-sm font-bold leading-6 text-white">
              <?php echo esc_html($challenge_summary); ?>
            </p>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-white/[0.07] bg-white/[0.035] p-4">
        <div class="flex items-start gap-3">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('network', 'h-4 w-4')) : ''; ?>
          </div>

          <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
              <?php esc_html_e('Recommended Platforms', 'reviewservicepro'); ?>
            </p>

            <p class="mt-1 text-sm font-bold leading-6 text-white">
              <?php echo esc_html($platform_summary); ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between gap-4 border-t border-white/[0.06] pt-5">
      <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('building-2', 'h-3.5 w-3.5 text-emerald-300')) : ''; ?>
        <?php esc_html_e('Industry Resource', 'reviewservicepro'); ?>
      </span>

      <span class="inline-flex items-center gap-2 text-sm font-extrabold text-emerald-300">
        <?php esc_html_e('Explore Guide', 'reviewservicepro'); ?>
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1')) : ''; ?>
      </span>
    </div>
  </div>
</article>