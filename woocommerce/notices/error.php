<?php

/**
 * Show error messages
 *
 * File: woocommerce/notices/error.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (empty($notices)) {
  return;
}

$render_notice_icon = function () {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon('circle-alert', 'h-5 w-5'));
  }

  return '<span aria-hidden="true">!</span>';
};
?>

<div class="rsp-wc-notices rsp-wc-notices-error mb-7 space-y-4" role="alert" aria-live="assertive">
  <?php foreach ($notices as $notice) : ?>
    <?php
    $notice_text = isset($notice['notice']) ? $notice['notice'] : '';
    $data_attr   = function_exists('wc_get_notice_data_attr') ? wc_get_notice_data_attr($notice) : '';
    ?>

    <div
      class="woocommerce-error relative overflow-hidden rounded-[1.35rem] border border-red-200 bg-red-50 px-5 py-4 text-[#3B4658] shadow-[0_14px_40px_rgba(15,23,42,0.06)]"
      <?php echo wp_kses_post($data_attr); ?>>
      <div class="flex items-start gap-4">
        <span class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-red-200 bg-white text-red-600 shadow-sm">
          <?php echo $render_notice_icon(); ?>
        </span>

        <div class="min-w-0">
          <p class="font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.14em] text-red-700">
            <?php esc_html_e('Action Needed', 'reviewservicepro'); ?>
          </p>

          <div class="mt-1 text-[16px] font-medium leading-7 text-[#3B4658] [&_a]:font-[800] [&_a]:text-red-700">
            <?php echo wc_kses_notice($notice_text); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>