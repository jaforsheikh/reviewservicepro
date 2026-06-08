<?php

/**
 * Reusable Platform Card
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

$platform_logo = function_exists('rsp_get_platform_logo')
  ? rsp_get_platform_logo($post_id)
  : get_post_meta($post_id, 'rsp_platform_logo', true);

$platform_url    = get_post_meta($post_id, 'rsp_platform_url', true);
$focus_keyword   = get_post_meta($post_id, 'rsp_focus_keyword', true);
$best_for        = get_post_meta($post_id, 'rsp_best_for', true);
$common_problems = get_post_meta($post_id, 'rsp_common_problems', true);

$platform_terms = get_the_terms($post_id, 'platform_type');

$image_url = has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'rsp-blog-card')
  : '';

$best_for_summary = ! empty($best_for)
  ? wp_trim_words(wp_strip_all_tags($best_for), 14)
  : __('Businesses that need stronger online trust, visibility, and reputation monitoring.', 'reviewservicepro');

$problem_summary = ! empty($common_problems)
  ? wp_trim_words(wp_strip_all_tags($common_problems), 14)
  : __('Review management, customer trust, response quality, and reputation visibility challenges.', 'reviewservicepro');
?>

<article
  id="post-<?php echo esc_attr($post_id); ?>"
  <?php post_class('group relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/35 hover:bg-white/[0.055] hover:shadow-[0_24px_90px_rgba(37,99,235,0.14)]', $post_id); ?>
  itemscope
  itemtype="https://schema.org/Article">
  <a
    href="<?php echo esc_url($permalink); ?>"
    class="absolute inset-0 z-20"
    aria-label="<?php echo esc_attr(sprintf(__('View platform guide: %s', 'reviewservicepro'), $title)); ?>"></a>

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
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('star', 'mb-3 h-10 w-10 text-blue-300')) : ''; ?>

        <span class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
          <?php esc_html_e('Platform Guide', 'reviewservicepro'); ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="absolute inset-0 bg-gradient-to-t from-[#07111F]/90 via-[#07111F]/15 to-transparent"></div>

    <div class="absolute left-4 top-4 z-10 flex flex-wrap gap-2">
      <?php if (! empty($platform_terms) && ! is_wp_error($platform_terms)) : ?>
        <span class="inline-flex rounded-full border border-blue-500/20 bg-blue-600/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-blue-300 backdrop-blur-md">
          <?php echo esc_html($platform_terms[0]->name); ?>
        </span>
      <?php endif; ?>

      <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-emerald-300 backdrop-blur-md">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-3 w-3')) : ''; ?>
        <?php esc_html_e('Trust Platform', 'reviewservicepro'); ?>
      </span>
    </div>

    <?php if (! empty($platform_logo)) : ?>
      <div class="absolute bottom-4 right-4 z-10 flex h-14 w-14 items-center justify-center overflow-hidden rounded-2xl border border-white/[0.10] bg-white p-2 shadow-lg">
        <img
          src="<?php echo esc_url($platform_logo); ?>"
          alt="<?php echo esc_attr(sprintf(__('%s logo', 'reviewservicepro'), $title)); ?>"
          class="max-h-full max-w-full object-contain"
          loading="lazy"
          decoding="async">
      </div>
    <?php endif; ?>
  </div>

  <div class="relative z-10 p-6 md:p-7">
    <?php if (! empty($focus_keyword)) : ?>
      <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/[0.08] bg-white/[0.04] px-3 py-1.5 text-xs font-bold text-slate-300">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search', 'h-3.5 w-3.5 text-blue-300')) : ''; ?>
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
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('users', 'h-4 w-4')) : ''; ?>
          </div>

          <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
              <?php esc_html_e('Best For', 'reviewservicepro'); ?>
            </p>

            <p class="mt-1 text-sm font-bold leading-6 text-white">
              <?php echo esc_html($best_for_summary); ?>
            </p>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-white/[0.07] bg-white/[0.035] p-4">
        <div class="flex items-start gap-3">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-amber-500/20 bg-amber-500/10 text-amber-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('triangle-alert', 'h-4 w-4')) : ''; ?>
          </div>

          <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
              <?php esc_html_e('Common Problems', 'reviewservicepro'); ?>
            </p>

            <p class="mt-1 text-sm font-bold leading-6 text-white">
              <?php echo esc_html($problem_summary); ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between gap-4 border-t border-white/[0.06] pt-5">
      <?php if (! empty($platform_url)) : ?>
        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('globe', 'h-3.5 w-3.5 text-blue-300')) : ''; ?>
          <?php esc_html_e('Official Platform', 'reviewservicepro'); ?>
        </span>
      <?php else : ?>
        <span class="text-xs font-bold text-slate-500">
          <?php esc_html_e('Platform Resource', 'reviewservicepro'); ?>
        </span>
      <?php endif; ?>

      <span class="inline-flex items-center gap-2 text-sm font-extrabold text-blue-300">
        <?php esc_html_e('Explore Guide', 'reviewservicepro'); ?>
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1')) : ''; ?>
      </span>
    </div>
  </div>
</article>