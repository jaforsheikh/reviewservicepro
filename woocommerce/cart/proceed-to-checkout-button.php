<?php

/**
 * Proceed to checkout button
 *
 * Premium ReviewService.Pro checkout CTA template.
 *
 * This template preserves the WooCommerce checkout URL and required button classes,
 * while improving the CTA presentation for a service-ordering flow.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package ReviewServicePro\WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

$checkout_url      = wc_get_checkout_url();
$theme_button_class = wc_wp_theme_get_element_class_name('button');
$button_classes    = 'checkout-button button alt wc-forward rsp-checkout-button';

if ($theme_button_class) {
  $button_classes .= ' ' . $theme_button_class;
}
?>

<a
  href="<?php echo esc_url($checkout_url); ?>"
  class="<?php echo esc_attr($button_classes); ?>"
  aria-label="<?php echo esc_attr__('Proceed to secure checkout for your selected reputation management service', 'reviewservicepro'); ?>">
  <span class="rsp-checkout-button__inner">
    <span class="rsp-checkout-button__icon" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" focusable="false">
        <path d="M12 3L5 6v5.6c0 4.3 2.8 7.4 7 8.9 4.2-1.5 7-4.6 7-8.9V6l-7-3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
        <path d="M9.3 12.1l1.7 1.7 3.9-4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </span>

    <span class="rsp-checkout-button__content">
      <span class="rsp-checkout-button__label">
        <?php esc_html_e('Proceed to secure checkout', 'reviewservicepro'); ?>
      </span>
      <span class="rsp-checkout-button__note">
        <?php esc_html_e('Secure payment · Order details saved in your client portal', 'reviewservicepro'); ?>
      </span>
    </span>

    <span class="rsp-checkout-button__arrow" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" focusable="false">
        <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        <path d="M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </span>
  </span>
</a>