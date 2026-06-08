<?php

/**
 * Show error messages
 *
 * File: woocommerce/notices/error.php
 *
 * ReviewService.Pro custom WooCommerce error notices.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (empty($notices)) {
  return;
}
?>

<div class="rsp-wc-notices rsp-wc-notices-error mb-8 space-y-4" role="alert" aria-live="assertive">
  <?php foreach ($notices as $notice) : ?>
    <?php
    $notice_text = isset($notice['notice']) ? $notice['notice'] : '';
    $data_attr   = function_exists('wc_get_notice_data_attr') ? wc_get_notice_data_attr($notice) : '';
    ?>

    <div
      class="relative overflow-hidden rounded-[1.35rem] border border-red-400/25 bg-red-500/[0.08] p-5 shadow-[0_18px_55px_rgba(239,68,68,0.10)] backdrop-blur-xl"
      <?php echo wp_kses_post($data_attr); ?>>

      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(239,68,68,0.18),transparent_36%)]"></div>

      <div class="relative z-10 flex gap-4">
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-red-300/25 bg-red-400/10 text-red-200">
          <i data-lucide="circle-alert" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <div class="min-w-0 flex-1">
          <p class="text-xs font-semibold uppercase tracking-[0.14em] text-red-200">
            <?php esc_html_e('Action Needed', 'reviewservicepro'); ?>
          </p>

          <div class="mt-2 text-base font-normal leading-8 text-slate-100 [&_a]:font-medium [&_a]:text-red-200 [&_a]:underline-offset-4 hover:[&_a]:underline">
            <?php echo wc_kses_notice($notice_text); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>