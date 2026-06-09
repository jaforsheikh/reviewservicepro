<?php

/**
 * View Order
 *
 * ReviewService.Pro — Compact order detail endpoint
 *
 * File: woocommerce/myaccount/view-order.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$order_id = isset($order_id) ? absint($order_id) : absint(get_query_var('view-order'));
$order    = $order_id ? wc_get_order($order_id) : false;

if (! $order instanceof WC_Order || (int) $order->get_user_id() !== get_current_user_id()) {
  wc_print_notice(esc_html__('This order could not be found or is not available for this account.', 'reviewservicepro'), 'error');
  return;
}

$orders_url  = wc_get_account_endpoint_url('orders');
$support_url = add_query_arg('order', $order->get_order_number(), home_url('/contact/?type=order-support'));
$item_count  = $order->get_item_count();

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-view-order-endpoint">
  <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
    <div>
      <div class="mb-3 flex flex-wrap items-center gap-2">
        <span class="rsp-eyebrow">
          <?php echo $render_icon('receipt-text', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php
          printf(
            /* translators: %s: order number */
            esc_html__('Order #%s', 'reviewservicepro'),
            esc_html($order->get_order_number())
          );
          ?>
        </span>

        <span class="rsp-status-pill">
          <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
        </span>
      </div>

      <h2 class="rsp-endpoint-title">
        <?php esc_html_e('Order details and next steps', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mt-3">
        <?php
        printf(
          /* translators: 1: order date 2: order total */
          esc_html__('Placed on %1$s. Current total: %2$s. Use this page to review service items, billing details, and account records.', 'reviewservicepro'),
          esc_html(wc_format_datetime($order->get_date_created())),
          wp_kses_post($order->get_formatted_order_total())
        );
        ?>
      </p>
    </div>

    <div class="flex flex-col gap-2 sm:flex-row">
      <a href="<?php echo esc_url($orders_url); ?>" class="rsp-btn rsp-btn-secondary">
        <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('All Orders', 'reviewservicepro'); ?>
      </a>

      <a href="<?php echo esc_url($support_url); ?>" class="rsp-btn rsp-btn-secondary">
        <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Order Support', 'reviewservicepro'); ?>
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
    <div class="rsp-card p-4">
      <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
        <?php esc_html_e('Status', 'reviewservicepro'); ?>
      </p>
      <p class="mt-2 text-[18px] font-[800] text-[#334155]">
        <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
      </p>
    </div>

    <div class="rsp-card p-4">
      <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
        <?php esc_html_e('Date', 'reviewservicepro'); ?>
      </p>
      <p class="mt-2 text-[18px] font-[800] text-[#334155]">
        <?php echo esc_html(wc_format_datetime($order->get_date_created(), get_option('date_format'))); ?>
      </p>
    </div>

    <div class="rsp-card p-4">
      <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
        <?php esc_html_e('Total', 'reviewservicepro'); ?>
      </p>
      <p class="mt-2 text-[18px] font-[800] text-[#334155]">
        <?php echo wp_kses_post($order->get_formatted_order_total()); ?>
      </p>
    </div>

    <div class="rsp-card p-4">
      <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
        <?php esc_html_e('Items', 'reviewservicepro'); ?>
      </p>
      <p class="mt-2 text-[18px] font-[800] text-[#334155]">
        <?php echo esc_html((string) $item_count); ?>
      </p>
    </div>
  </div>

  <div class="rsp-card mt-5 p-5 md:p-6">
    <div class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h3 class="rsp-account-heading text-[22px] font-[800] leading-tight">
          <?php esc_html_e('Service record', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-account-text mt-1">
          <?php esc_html_e('WooCommerce order details are preserved below for invoices, service records, totals, billing, and order notes.', 'reviewservicepro'); ?>
        </p>
      </div>
    </div>

    <div class="rsp-order-details-content">
      <?php do_action('woocommerce_view_order', $order_id); ?>
    </div>
  </div>

  <div class="mt-5 grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="rounded-[20px] border border-emerald-200 bg-emerald-50 p-5">
      <div class="mb-3 flex items-center gap-2 text-emerald-700">
        <?php echo $render_icon('shield-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <h3 class="font-['Poppins',sans-serif] text-[18px] font-[800] tracking-[-0.03em]">
          <?php esc_html_e('Ethical ORM reminder', 'reviewservicepro'); ?>
        </h3>
      </div>

      <p class="text-[15px] leading-7 text-emerald-800">
        <?php esc_html_e('ReviewService.Pro focuses on monitoring, documentation, response support, reporting, and compliant workflows. We do not offer fake reviews, paid review incentives, guaranteed review removal, or guaranteed rating outcomes.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="rounded-[20px] border border-blue-200 bg-blue-50 p-5">
      <div class="mb-3 flex items-center gap-2 text-blue-700">
        <?php echo $render_icon('clipboard-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <h3 class="font-['Poppins',sans-serif] text-[18px] font-[800] tracking-[-0.03em]">
          <?php esc_html_e('Next step', 'reviewservicepro'); ?>
        </h3>
      </div>

      <p class="text-[15px] leading-7 text-blue-800">
        <?php esc_html_e('Keep your order details available. If your service requires onboarding information or access details, our support workflow will guide the next step.', 'reviewservicepro'); ?>
      </p>
    </div>
  </div>
</section>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>