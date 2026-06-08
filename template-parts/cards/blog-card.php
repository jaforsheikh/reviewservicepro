<?php

/**
 * Reusable Blog / ORM Academy Card
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id   = get_the_ID();
$title     = get_the_title($post_id);
$permalink = get_permalink($post_id);
$excerpt   = function_exists('rsp_get_excerpt') ? rsp_get_excerpt($post_id, 24) : wp_trim_words(get_the_excerpt($post_id), 24);

$category      = function_exists('rsp_get_primary_category') ? rsp_get_primary_category($post_id) : null;
$category_name = $category ? $category->name : __('ORM Academy', 'reviewservicepro');

$reading_time = function_exists('rsp_reading_time')
  ? rsp_reading_time($post_id)
  : __('3 min read', 'reviewservicepro');

$image_url = has_post_thumbnail($post_id)
  ? get_the_post_thumbnail_url($post_id, 'rsp-blog-card')
  : '';

$author_name = get_the_author_meta('display_name', (int) get_post_field('post_author', $post_id));
$post_date   = get_the_date('M j, Y', $post_id);
?>

<article
  id="post-<?php echo esc_attr($post_id); ?>"
  <?php post_class('group relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/35 hover:bg-white/[0.055] hover:shadow-[0_24px_90px_rgba(37,99,235,0.14)]', $post_id); ?>
  itemscope
  itemtype="https://schema.org/BlogPosting">
  <a
    href="<?php echo esc_url($permalink); ?>"
    class="absolute inset-0 z-20"
    aria-label="<?php echo esc_attr(sprintf(__('Read article: %s', 'reviewservicepro'), $title)); ?>"></a>

  <meta itemprop="headline" content="<?php echo esc_attr($title); ?>">
  <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
  <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('c', $post_id)); ?>">
  <meta itemprop="author" content="<?php echo esc_attr($author_name); ?>">

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
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('book-open-text', 'mb-3 h-10 w-10 text-blue-300')) : ''; ?>

        <span class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
          <?php esc_html_e('ORM Academy', 'reviewservicepro'); ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="absolute inset-0 bg-gradient-to-t from-[#07111F]/90 via-[#07111F]/15 to-transparent"></div>

    <div class="absolute left-4 top-4 z-10 flex flex-wrap gap-2">
      <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-500/20 bg-blue-600/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-blue-300 backdrop-blur-md">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('graduation-cap', 'h-3 w-3')) : ''; ?>
        <?php esc_html_e('Academy', 'reviewservicepro'); ?>
      </span>

      <?php if (! empty($category_name)) : ?>
        <span class="inline-flex rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.12em] text-emerald-300 backdrop-blur-md">
          <?php echo esc_html($category_name); ?>
        </span>
      <?php endif; ?>
    </div>
  </div>

  <div class="relative z-10 p-6 md:p-7">
    <div class="mb-4 flex flex-wrap items-center gap-3 text-xs font-bold text-slate-400">
      <span class="inline-flex items-center gap-1.5">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('calendar-days', 'h-3.5 w-3.5 text-blue-300')) : ''; ?>
        <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
          <?php echo esc_html($post_date); ?>
        </time>
      </span>

      <span class="inline-flex items-center gap-1.5">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('clock-3', 'h-3.5 w-3.5 text-emerald-300')) : ''; ?>
        <?php echo esc_html($reading_time); ?>
      </span>
    </div>

    <h3 class="text-xl font-extrabold leading-tight text-white md:text-2xl" itemprop="name">
      <?php echo esc_html($title); ?>
    </h3>

    <?php if (! empty($excerpt)) : ?>
      <p class="mt-4 text-sm leading-7 text-slate-400" itemprop="description">
        <?php echo esc_html($excerpt); ?>
      </p>
    <?php endif; ?>

    <div class="mt-6 rounded-2xl border border-white/[0.07] bg-white/[0.035] p-4">
      <div class="flex items-start gap-3">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('lightbulb', 'h-4 w-4')) : ''; ?>
        </div>

        <div>
          <p class="text-[10px] font-bold uppercase tracking-[0.10em] text-slate-500">
            <?php esc_html_e('Learning Focus', 'reviewservicepro'); ?>
          </p>

          <p class="mt-1 text-sm font-bold leading-6 text-white">
            <?php esc_html_e('Reputation, reviews, trust signals, and ethical ORM education.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between gap-4 border-t border-white/[0.06] pt-5">
      <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('user', 'h-3.5 w-3.5 text-blue-300')) : ''; ?>
        <?php echo esc_html($author_name); ?>
      </span>

      <span class="inline-flex items-center gap-2 text-sm font-extrabold text-blue-300">
        <?php esc_html_e('Read Article', 'reviewservicepro'); ?>
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1')) : ''; ?>
      </span>
    </div>
  </div>
</article>