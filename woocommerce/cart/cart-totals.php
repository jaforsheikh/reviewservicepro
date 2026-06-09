<?php

/**
 * Cart totals
 *
 * ReviewService.Pro — Compact white SaaS cart totals
 *
 * File: woocommerce/cart/cart-totals.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<div class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?> rounded-[24px] border border-slate-200 bg-white p-5 shadow-[0_18px_55px_rgba(15,23,42,0.07)]">
  <?php do_action('woocommerce_before_cart_totals'); ?>

  <div class="mb-5 flex items-center gap-3 border-b border-slate-200 pb-4">
    <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
      <?php echo $render_icon('receipt-text', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
      ?>
    </div>

    <div>
      <h2 class="font-['Poppins',sans-serif] text-[22px] font-[800] leading-tight tracking-[-0.035em] text-[#334155]">
        <?php esc_html_e('Order Summary', 'woocommerce'); ?>
      </h2>
      <p class="mt-1 text-[14px] font-medium text-[#64748B]">
        <?php esc_html_e('Review totals before checkout.', 'reviewservicepro'); ?>
      </p>
    </div>
  </div>

  <table cellspacing="0" class="shop_table shop_table_responsive w-full">
    <tr class="cart-subtotal border-b border-slate-100">
      <th class="py-3 text-left text-[14px] font-[800] text-[#3B4658]"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
      <td data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>" class="py-3 text-right text-[15px] font-[800] text-[#334155]"><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>

    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
      <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> border-b border-slate-100">
        <th class="py-3 text-left text-[14px] font-[800] text-[#3B4658]"><?php wc_cart_totals_coupon_label($coupon); ?></th>
        <td data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>" class="py-3 text-right text-[15px] font-[800] text-emerald-700"><?php wc_cart_totals_coupon_html($coupon); ?></td>
      </tr>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
      <?php do_action('woocommerce_cart_totals_before_shipping'); ?>
      <?php wc_cart_totals_shipping_html(); ?>
      <?php do_action('woocommerce_cart_totals_after_shipping'); ?>
    <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>
      <tr class="shipping border-b border-slate-100">
        <th class="py-3 text-left text-[14px] font-[800] text-[#3B4658]"><?php esc_html_e('Shipping', 'woocommerce'); ?></th>
        <td data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>" class="py-3 text-right text-[15px] text-[#64748B]"><?php woocommerce_shipping_calculator(); ?></td>
      </tr>
    <?php endif; ?>

    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
      <tr class="fee border-b border-slate-100">
        <th class="py-3 text-left text-[14px] font-[800] text-[#3B4658]"><?php echo esc_html($fee->name); ?></th>
        <td data-title="<?php echo esc_attr($fee->name); ?>" class="py-3 text-right text-[15px] font-[800] text-[#334155]"><?php wc_cart_totals_fee_html($fee); ?></td>
      </tr>
    <?php endforeach; ?>

    <?php if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) : ?>
      <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
        <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
          <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> border-b border-slate-100">
            <th class="py-3 text-left text-[14px] font-[800] text-[#3B4658]"><?php echo esc_html($tax->label); ?></th>
            <td data-title="<?php echo esc_attr($tax->label); ?>" class="py-3 text-right text-[15px] font-[800] text-[#334155]"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr class="tax-total border-b border-slate-100">
          <th class="py-3 text-left text-[14px] font-[800] text-[#3B4658]"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
          <td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>" class="py-3 text-right text-[15px] font-[800] text-[#334155]"><?php wc_cart_totals_taxes_total_html(); ?></td>
        </tr>
      <?php endif; ?>
    <?php endif; ?>

    <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

    <tr class="order-total">
      <th class="pt-4 text-left text-[16px] font-[800] text-[#334155]"><?php esc_html_e('Total', 'woocommerce'); ?></th>
      <td data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>" class="pt-4 text-right text-[20px] font-[800] text-[#334155]"><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>

    <?php do_action('woocommerce_cart_totals_after_order_total'); ?>
  </table>

  <div class="wc-proceed-to-checkout mt-5">
    <?php do_action('woocommerce_proceed_to_checkout'); ?>
  </div>

  <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-[14px] font-medium leading-6 text-emerald-800">
    <?php esc_html_e('Ethical ORM promise: no fake reviews, no paid review incentives, and no guaranteed rating or removal claims.', 'reviewservicepro'); ?>
  </div>

  <?php do_action('woocommerce_after_cart_totals'); ?>
</div>