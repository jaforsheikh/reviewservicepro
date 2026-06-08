<?php

/**
 * Search Form Template
 *
 * ReviewService.Pro — Premium White SaaS Search Form
 *
 * File: searchform.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$unique_id = wp_unique_id('search-form-');
?>

<form
  role="search"
  method="get"
  class="relative w-full"
  action="<?php echo esc_url(home_url('/')); ?>"
  aria-label="<?php esc_attr_e('Search ReviewService.Pro', 'reviewservicepro'); ?>">

  <label class="sr-only" for="<?php echo esc_attr($unique_id); ?>">
    <?php esc_html_e('Search for:', 'reviewservicepro'); ?>
  </label>

  <div class="relative flex flex-col gap-3 sm:flex-row">
    <div class="relative flex-1">
      <i
        data-lucide="search"
        class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
        aria-hidden="true"></i>

      <input
        id="<?php echo esc_attr($unique_id); ?>"
        type="search"
        name="s"
        value="<?php echo esc_attr(get_search_query()); ?>"
        placeholder="<?php esc_attr_e('Search ORM guides, reviews, Trustpilot, Google reviews...', 'reviewservicepro'); ?>"
        class="h-14 w-full rounded-2xl border border-slate-200 bg-white pl-12 pr-5 font-['Inter',sans-serif] text-[16px] font-medium text-[#334155] outline-none shadow-[0_14px_40px_rgba(15,23,42,0.06)] transition-all duration-200 placeholder:text-slate-400 hover:border-blue-200 focus:border-blue-300 focus:bg-white focus:shadow-[0_0_0_4px_rgba(37,99,235,0.12)]">
    </div>

    <button
      type="submit"
      class="relative inline-flex h-14 items-center justify-center gap-2 overflow-hidden rounded-2xl bg-[#2563EB] px-7 font-['Inter',sans-serif] text-[16px] font-[800] text-white shadow-[0_16px_36px_rgba(37,99,235,0.22)] transition-all duration-300 before:absolute before:left-[-120%] before:top-0 before:h-full before:w-[70%] before:-skew-x-[18deg] before:bg-[linear-gradient(90deg,transparent,rgba(255,255,255,0.34),transparent)] before:transition-[left] before:duration-700 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-[0_18px_44px_rgba(37,99,235,0.30)] hover:before:left-[135%] focus:outline-none focus:ring-4 focus:ring-blue-100">
      <span class="relative z-10 inline-flex items-center gap-2">
        <i data-lucide="search-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Search', 'reviewservicepro'); ?>
      </span>
    </button>
  </div>
</form>