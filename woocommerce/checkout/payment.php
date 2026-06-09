<?php

/**
 * Checkout Payment Section
 *
 * File: woocommerce/checkout/payment.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (! wp_doing_ajax()) {
  do_action('woocommerce_review_order_before_payment');
}

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<div id="payment" class="woocommerce-checkout-payment rsp-checkout-payment">
  <div class="border-b border-slate-200 bg-white px-4 py-4">
    <div class="flex items-center gap-3">
      <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-700 shadow-sm">
        <?php echo $render_icon('credit-card', 'h-5 w-5'); ?>
      </span>

      <div>
        <h3 class="!mb-0 text-[18px] font-[700] leading-tight tracking-[-0.025em] text-[#3B4658]">
          <?php esc_html_e('Payment method', 'reviewservicepro'); ?>
        </h3>
        <p class="mt-1 text-[13px] font-medium leading-6 text-[#64748B]">
          <?php esc_html_e('Choose a payment option to place your service order.', 'reviewservicepro'); ?>
        </p>
      </div>
    </div>
  </div>

  <?php if (WC()->cart->needs_payment()) : ?>
    <ul class="wc_payment_methods payment_methods methods">
      <?php
      if (! empty($available_gateways)) {
        foreach ($available_gateways as $gateway) {
          wc_get_template('checkout/payment-method.php', ['gateway' => $gateway]);
        }
      } else {
        echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">';
        echo esc_html(apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? __('Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : __('Please fill in your details above to see available payment methods.', 'woocommerce')));
        echo '</li>';
      }
      ?>
    </ul>
  <?php endif; ?>

  <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 mx-4 mb-4">
    <div class="flex gap-3">
      <span class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-700 shadow-sm">
        <?php echo $render_icon('shield-check', 'h-4 w-4'); ?>
      </span>
      <p class="text-[13px] font-[700] leading-6 text-emerald-800">
        <?php esc_html_e('Your order is handled securely. Service delivery starts only through ethical, platform-compliant reputation workflows.', 'reviewservicepro'); ?>
      </p>
    </div>
  </div>

  <div class="form-row place-order">
    <noscript>
      <?php
      printf(
        esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'),
        '<em>',
        '</em>'
      );
      ?>
      <br><button type="submit" class="button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
    </noscript>

    <?php wc_get_template('checkout/terms.php'); ?>

    <?php do_action('woocommerce_review_order_before_submit'); ?>

    <?php
    echo apply_filters(
      'woocommerce_order_button_html',
      '<button type="submit" class="button alt' . esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'
    ); // @codingStandardsIgnoreLine
    ?>

    <?php do_action('woocommerce_review_order_after_submit'); ?>

    <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
  </div>
</div>

<?php
if (! wp_doing_ajax()) {
  do_action('woocommerce_review_order_after_payment');
}
