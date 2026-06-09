<?php

/**
 * Single Payment Method Item
 *
 * File: woocommerce/checkout/payment-method.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;
?>

<li class="wc_payment_method payment_method_<?php echo esc_attr($gateway->id); ?>">

  <label
    for="payment_method_<?php echo esc_attr($gateway->id); ?>"
    class="flex cursor-pointer items-start gap-4">

    <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center">
      <input
        id="payment_method_<?php echo esc_attr($gateway->id); ?>"
        type="radio"
        class="input-radio"
        name="payment_method"
        value="<?php echo esc_attr($gateway->id); ?>"
        <?php checked($gateway->chosen, true); ?>
        data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />
    </span>

    <span class="min-w-0 flex-1">
      <span class="flex flex-wrap items-center gap-2">
        <span class="text-[15px] font-[700] text-[#334155]">
          <?php echo wp_kses_post($gateway->get_title()); ?>
        </span>

        <?php if ($gateway->get_icon()) : ?>
          <span class="gateway-icon flex items-center gap-1">
            <?php echo $gateway->get_icon(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </span>
        <?php endif; ?>
      </span>

      <?php if ($gateway->get_description()) : ?>
        <span class="mt-1 block text-[13px] leading-6 text-[#64748B]">
          <?php echo wpautop(wptexturize($gateway->get_description())); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </span>
      <?php endif; ?>
    </span>
  </label>

  <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
    <div class="payment_box payment_method_<?php echo esc_attr($gateway->id); ?>" <?php if (! $gateway->chosen) : ?>style="display:none;" <?php endif; ?>>
      <?php $gateway->payment_fields(); ?>
    </div>
  <?php endif; ?>

</li>