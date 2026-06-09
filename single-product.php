<?php

/**
 * Single WooCommerce Product Template
 *
 * File: single-product.php
 *
 * ReviewService.Pro — White SaaS Service Product Page Wrapper
 *
 * Purpose:
 * - Load WooCommerce product pages with a clean white SaaS wrapper.
 * - Preserve WooCommerce hooks and template flow.
 * - Keep product content inside woocommerce/content-single-product.php.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

get_header();

if (! class_exists('WooCommerce')) :
?>

  <main id="primary" class="relative overflow-hidden bg-[#F8FAFC] px-5 py-24 sm:px-6 lg:px-8" role="main">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_22px_70px_rgba(15,23,42,0.08)]">
      <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.14em] text-amber-700">
        <?php esc_html_e('WooCommerce Required', 'reviewservicepro'); ?>
      </span>

      <h1 class="mt-5 font-['Poppins',sans-serif] text-[32px] font-[700] leading-[1.12] tracking-[-0.035em] text-[#334155] md:text-[42px]">
        <?php esc_html_e('WooCommerce is required', 'reviewservicepro'); ?>
      </h1>

      <p class="mt-4 font-['Inter',sans-serif] text-[16px] font-[400] leading-8 text-[#64748B]">
        <?php esc_html_e('Please activate WooCommerce to view this service package.', 'reviewservicepro'); ?>
      </p>
    </div>
  </main>

<?php
  get_footer();
  return;
endif;
?>

<main id="primary" class="relative overflow-hidden bg-[#F8FAFC]" role="main">
  <?php
  /**
   * Hook: woocommerce_before_main_content.
   *
   * Keeps compatibility with WooCommerce wrappers/breadcrumbs/plugins.
   */
  do_action('woocommerce_before_main_content');

  while (have_posts()) :
    the_post();

    /**
     * Hook: woocommerce_before_single_product.
     *
     * @hooked woocommerce_output_all_notices - 10
     */
    do_action('woocommerce_before_single_product');

    if (post_password_required()) {
      echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      continue;
    }

    wc_get_template_part('content', 'single-product');

    /**
     * Hook: woocommerce_after_single_product.
     */
    do_action('woocommerce_after_single_product');
  endwhile;

  /**
   * Hook: woocommerce_after_main_content.
   */
  do_action('woocommerce_after_main_content');
  ?>
</main>

<?php
get_footer();
