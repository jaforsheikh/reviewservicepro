<?php

/**
 * My Addresses
 *
 * ReviewService.Pro — Compact client portal address overview
 *
 * File: woocommerce/myaccount/my-address.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

if (! $customer_id) {
  return;
}

$addresses = [
  'billing' => __('Billing address', 'reviewservicepro'),
];

if (function_exists('wc_shipping_enabled') && wc_shipping_enabled() && ! wc_ship_to_billing_address_only()) {
  $addresses['shipping'] = __('Shipping address', 'reviewservicepro');
}

$addresses = apply_filters('woocommerce_my_account_get_addresses', $addresses, $customer_id);

do_action('woocommerce_before_account_addresses');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-address-endpoint">
  <div class="mb-6">
    <span class="rsp-eyebrow">
      <?php echo $render_icon('map-pin', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
      ?>
      <?php esc_html_e('Address Book', 'reviewservicepro'); ?>
    </span>

    <h2 class="rsp-endpoint-title mt-3">
      <?php esc_html_e('Billing and service addresses', 'reviewservicepro'); ?>
    </h2>

    <p class="rsp-endpoint-subtitle mt-3">
      <?php esc_html_e('Keep your address details accurate for invoices, service records, order communication, and account documentation.', 'reviewservicepro'); ?>
    </p>
  </div>

  <?php if (! wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
    <p class="rsp-account-text mb-5">
      <?php esc_html_e('The following addresses will be used on the checkout page by default.', 'woocommerce'); ?>
    </p>
  <?php endif; ?>

  <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <?php foreach ($addresses as $name => $address_title) : ?>
      <?php
      $address = wc_get_account_formatted_address($name);
      $edit_url = wc_get_endpoint_url('edit-address', $name);
      ?>

      <article class="rsp-card p-5 md:p-6">
        <div class="mb-5 flex items-start justify-between gap-4">
          <div class="flex items-start gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
              <?php echo $render_icon('billing' === $name ? 'wallet-cards' : 'truck', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </div>

            <div>
              <h3 class="rsp-account-heading text-[22px] font-[800] leading-tight">
                <?php echo esc_html($address_title); ?>
              </h3>

              <p class="mt-1 text-[14px] font-medium text-[#64748B]">
                <?php echo 'billing' === $name ? esc_html__('Used for invoices and payment records.', 'reviewservicepro') : esc_html__('Used only when a service requires shipping details.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>

        <address class="min-h-[130px] rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4 text-[15px] not-italic leading-7 text-[#64748B]">
          <?php
          echo $address
            ? wp_kses_post($address)
            : esc_html_e('You have not set up this type of address yet.', 'woocommerce');
          ?>
        </address>

        <a href="<?php echo esc_url($edit_url); ?>" class="rsp-btn rsp-btn-secondary mt-5">
          <?php echo $render_icon($address ? 'pencil' : 'plus', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php echo $address ? esc_html__('Edit address', 'woocommerce') : esc_html__('Add address', 'woocommerce'); ?>
        </a>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<?php do_action('woocommerce_after_account_addresses'); ?>