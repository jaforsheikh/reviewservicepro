<?php

/**
 * Checkout Shipping Form
 *
 * File: woocommerce/checkout/form-shipping.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

/**
 * Digital / service products typically don't need shipping.
 * This file is kept functional but RSP hides the ship-to-different
 * address toggle via CSS in form-checkout.php.
 */
?>

<div class="woocommerce-shipping-fields">
  <?php if (true === WC()->cart->needs_shipping_address()) : ?>

    <h3 id="ship-to-different-address" class="mt-6 mb-4 text-[22px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
      <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex cursor-pointer items-center gap-3">
        <input
          id="ship-to-different-address-checkbox"
          class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
          <?php checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1); ?>
          type="checkbox"
          name="ship_to_different_address"
          value="1" />

        <span class="text-[18px] font-[700] text-[#3B4658]">
          <?php esc_html_e('Ship to a different address?', 'woocommerce'); ?>
        </span>
      </label>
    </h3>

    <div class="shipping_address">
      <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

      <div class="woocommerce-shipping-fields__field-wrapper">
        <?php
        $fields = $checkout->get_checkout_fields('shipping');

        foreach ($fields as $key => $field) {
          woocommerce_form_field($key, $field, $checkout->get_value($key));
        }
        ?>
      </div>

      <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
    </div>

  <?php endif; ?>
</div>

<div class="woocommerce-additional-fields">
  <?php do_action('woocommerce_before_order_notes', $checkout); ?>

  <?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))) : ?>

    <?php if (! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only()) : ?>

      <h3 class="mt-6 mb-4 text-[20px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
        <?php esc_html_e('Additional information', 'woocommerce'); ?>
      </h3>

    <?php endif; ?>

    <?php foreach ($checkout->get_checkout_fields('order') as $key => $field) : ?>
      <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
    <?php endforeach; ?>

  <?php endif; ?>

  <?php do_action('woocommerce_after_order_notes', $checkout); ?>
</div>