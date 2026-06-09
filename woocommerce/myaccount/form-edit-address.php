<?php

/**
 * Edit address form
 *
 * ReviewService.Pro — Compact client portal address form
 *
 * File: woocommerce/myaccount/form-edit-address.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$page_title = ('billing' === $load_address)
  ? esc_html__('Billing address', 'reviewservicepro')
  : esc_html__('Shipping address', 'reviewservicepro');

$page_title = apply_filters('woocommerce_my_account_edit_address_title', $page_title, $load_address);

$address_overview_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('edit-address')
  : home_url('/my-account/edit-address/');

$support_url = home_url('/contact/?type=account-support');

do_action('woocommerce_before_edit_account_address_form');

if (! $load_address) {
  wc_get_template('myaccount/my-address.php');
  do_action('woocommerce_after_edit_account_address_form');
  return;
}

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$address_note = ('billing' === $load_address)
  ? esc_html__('Your billing address is used for invoices, order records, payment confirmation, and account-related service communication.', 'reviewservicepro')
  : esc_html__('Your shipping address is only used when a service or order requires shipping-related details.', 'reviewservicepro');
?>

<section class="rsp-edit-address-endpoint">
  <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <span class="rsp-eyebrow">
        <?php echo $render_icon('map-pin', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Address Details', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mt-3">
        <?php echo esc_html($page_title); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mt-3">
        <?php echo esc_html($address_note); ?>
      </p>
    </div>

    <div class="flex flex-col gap-2 sm:flex-row">
      <a href="<?php echo esc_url($address_overview_url); ?>" class="rsp-btn rsp-btn-secondary">
        <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('All Addresses', 'reviewservicepro'); ?>
      </a>

      <a href="<?php echo esc_url($support_url); ?>" class="rsp-btn rsp-btn-secondary">
        <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Support', 'reviewservicepro'); ?>
      </a>
    </div>
  </div>

  <form method="post" class="rsp-card p-5 md:p-6">
    <div class="woocommerce-address-fields">
      <?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

      <div class="woocommerce-address-fields__field-wrapper grid grid-cols-1 gap-x-5 md:grid-cols-2">
        <?php
        foreach ($address as $key => $field) {
          $field['input_class'][] = 'input-text';
          woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
        }
        ?>
      </div>

      <?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

      <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <button type="submit" class="button" name="save_address" value="<?php esc_attr_e('Save address', 'woocommerce'); ?>">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php echo $render_icon('save', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Save address', 'woocommerce'); ?>
          </span>
        </button>

        <?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
        <input type="hidden" name="action" value="edit_address" />
      </div>
    </div>
  </form>
</section>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>