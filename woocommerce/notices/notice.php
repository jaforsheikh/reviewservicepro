<?php

/**
 * Show info messages
 *
 * File: woocommerce/notices/notice.php
 *
 * ReviewService.Pro custom WooCommerce info notices.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (empty($notices)) {
  return;
}
?>

<div class="rsp-wc-notices rsp-wc-notices-info mb-8 space-y-4" role="status" aria-live="polite">
  <?php foreach ($notices as $notice) : ?>
    <?php
    $notice_text = isset($notice['notice']) ? $notice['notice'] : '';
    $data_attr   = function_exists('wc_get_notice_data_attr') ? wc_get_notice_data_attr($notice) : '';
    ?>

    <div
      class="relative overflow-hidden rounded-[1.35rem] border border-blue-400/25 bg-blue-500/[0.08] p-5 shadow-[0_18px_55px_rgba(37,99,235,0.10)] backdrop-blur-xl"
      <?php echo wp_kses_post($data_attr); ?>>

      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.18),transparent_36%)]"></div>

      <div class="relative z-10 flex gap-4">
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-blue-300/25 bg-blue-400/10 text-blue-200">
          <i data-lucide="info" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <div class="min-w-0 flex-1">
          <p class="text-xs font-semibold uppercase tracking-[0.14em] text-blue-200">
            <?php esc_html_e('Notice', 'reviewservicepro'); ?>
          </p>

          <div class="mt-2 text-base font-normal leading-8 text-slate-100 [&_a]:font-medium [&_a]:text-blue-200 [&_a]:underline-offset-4 hover:[&_a]:underline">
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