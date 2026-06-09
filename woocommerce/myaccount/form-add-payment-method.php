<?php

/**
 * Add Payment Method
 *
 * ReviewService.Pro — Compact payment method form
 *
 * File: woocommerce/myaccount/form-add-payment-method.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$available_gateways = [];

if (function_exists('WC') && WC()->payment_gateways()) {
  $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
}

$payment_methods_url = function_exists('wc_get_account_endpoint_url') ? wc_get_account_endpoint_url('payment-methods') : home_url('/my-account/payment-methods/');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-add-payment-endpoint">
  <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <span class="rsp-eyebrow">
        <?php echo $render_icon('credit-card', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Secure Billing', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mt-3">
        <?php esc_html_e('Add a payment method', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mt-3">
        <?php esc_html_e('Add a saved payment method for future reputation management orders and billing convenience.', 'reviewservicepro'); ?>
      </p>
    </div>

    <a href="<?php echo esc_url($payment_methods_url); ?>" class="rsp-btn rsp-btn-secondary">
      <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
      ?>
      <?php esc_html_e('Payment Methods', 'reviewservicepro'); ?>
    </a>
  </div>

  <form id="add_payment_method" method="post" class="rsp-card p-5 md:p-6">
    <?php if ($available_gateways) : ?>
      <div id="payment" class="woocommerce-Payment">
        <ul class="woocommerce-PaymentMethods payment_methods methods grid gap-3">
          <?php foreach ($available_gateways as $gateway) : ?>
            <li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr($gateway->id); ?> payment_method_<?php echo esc_attr($gateway->id); ?> rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
              <div class="flex items-start gap-3">
                <input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio mt-1" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> />

                <label for="payment_method_<?php echo esc_attr($gateway->id); ?>" class="!mb-0 flex-1">
                  <span class="block text-[16px] font-[800] text-[#3B4658]">
                    <?php echo esc_html($gateway->get_title()); ?>
                  </span>

                  <?php if ($gateway->get_icon()) : ?>
                    <span class="mt-2 block">
                      <?php echo wp_kses_post($gateway->get_icon()); ?>
                    </span>
                  <?php endif; ?>
                </label>
              </div>

              <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
                <div class="payment_box payment_method_<?php echo esc_attr($gateway->id); ?> mt-4 rounded-2xl border border-slate-200 bg-white p-4 text-[15px] leading-7 text-[#64748B]" <?php if (! $gateway->chosen) : ?>style="display:none;" <?php endif; ?>>
                  <?php $gateway->payment_fields(); ?>
                </div>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <?php do_action('woocommerce_add_payment_method_form_bottom'); ?>

        <div class="form-row mt-5">
          <?php wp_nonce_field('woocommerce-add-payment-method', 'woocommerce-add-payment-method-nonce'); ?>
          <input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1" />

          <button type="submit" class="woocommerce-Button button" id="place_order" value="<?php esc_attr_e('Add payment method', 'woocommerce'); ?>">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php echo $render_icon('plus', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Add payment method', 'woocommerce'); ?>
            </span>
          </button>
        </div>
      </div>
    <?php else : ?>
      <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-amber-800">
        <?php esc_html_e('No payment gateways are currently available for saved payment methods.', 'reviewservicepro'); ?>
      </div>
    <?php endif; ?>
  </form>
</section>