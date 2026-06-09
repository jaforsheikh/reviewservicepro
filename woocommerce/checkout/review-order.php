<?php

/**
 * Review order table
 *
 * File: woocommerce/checkout/review-order.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;
?>

<table class="shop_table woocommerce-checkout-review-order-table rsp-checkout-order-table">
  <thead>
    <tr>
      <th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
      <th class="product-total text-right"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
    </tr>
  </thead>

  <tbody>
    <?php do_action('woocommerce_review_order_before_cart_contents'); ?>

    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
      <?php
      $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

      if (! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 || ! apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
        continue;
      }
      ?>

      <tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
        <td class="product-name">
          <div class="flex items-start gap-3">
            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-700">
              <?php if (function_exists('rsp_icon')) : ?>
                <?php echo wp_kses_post(rsp_icon('package-check', 'h-4 w-4')); ?>
              <?php else : ?>
                <span aria-hidden="true">✓</span>
              <?php endif; ?>
            </span>

            <span class="min-w-0">
              <span class="block text-[14px] font-[700] leading-6 text-[#3B4658]">
                <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?>
              </span>

              <?php
              echo apply_filters(
                'woocommerce_checkout_cart_item_quantity',
                ' <strong class="product-quantity mt-1 inline-flex rounded-full border border-blue-200 bg-blue-50 px-2 py-0.5 text-[11px] font-[800] text-blue-700">' . sprintf('&times;&nbsp;%s', esc_html($cart_item['quantity'])) . '</strong>',
                $cart_item,
                $cart_item_key
              ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
              ?>

              <span class="block text-[13px] leading-6 text-[#64748B]">
                <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </span>
          </div>
        </td>

        <td class="product-total text-right text-[14px] font-[800] text-[#334155]">
          <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </td>
      </tr>
    <?php endforeach; ?>

    <?php do_action('woocommerce_review_order_after_cart_contents'); ?>
  </tbody>

  <tfoot>
    <tr class="cart-subtotal">
      <th><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
      <td class="text-right"><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>

    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
      <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
        <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
        <td class="text-right"><?php wc_cart_totals_coupon_html($coupon); ?></td>
      </tr>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
      <?php do_action('woocommerce_review_order_before_shipping'); ?>
      <?php wc_cart_totals_shipping_html(); ?>
      <?php do_action('woocommerce_review_order_after_shipping'); ?>
    <?php endif; ?>

    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
      <tr class="fee">
        <th><?php echo esc_html($fee->name); ?></th>
        <td class="text-right"><?php wc_cart_totals_fee_html($fee); ?></td>
      </tr>
    <?php endforeach; ?>

    <?php if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) : ?>
      <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
        <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
          <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
            <th><?php echo esc_html($tax->label); ?></th>
            <td class="text-right"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr class="tax-total">
          <th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
          <td class="text-right"><?php wc_cart_totals_taxes_total_html(); ?></td>
        </tr>
      <?php endif; ?>
    <?php endif; ?>

    <?php do_action('woocommerce_review_order_before_order_total'); ?>

    <tr class="order-total">
      <th><?php esc_html_e('Total', 'woocommerce'); ?></th>
      <td class="text-right"><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>

    <?php do_action('woocommerce_review_order_after_order_total'); ?>
  </tfoot>
</table>