<?php

/**
 * Payment Methods
 *
 * ReviewService.Pro — Compact payment methods endpoint
 *
 * File: woocommerce/myaccount/payment-methods.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$saved_methods = isset($saved_methods) ? (array) $saved_methods : (function_exists('wc_get_customer_saved_methods_list') ? wc_get_customer_saved_methods_list(get_current_user_id()) : []);
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();
$columns       = wc_get_account_payment_methods_columns();
$add_url       = wc_get_endpoint_url('add-payment-method');

do_action('woocommerce_before_account_payment_methods', $has_methods);

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-payment-methods-endpoint">
  <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <span class="rsp-eyebrow">
        <?php echo $render_icon('credit-card', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Billing', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mt-3">
        <?php esc_html_e('Payment methods', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mt-3">
        <?php esc_html_e('Manage saved payment methods used for checkout, invoices, and future service orders.', 'reviewservicepro'); ?>
      </p>
    </div>

    <a href="<?php echo esc_url($add_url); ?>" class="rsp-btn rsp-btn-primary">
      <span class="relative z-10 inline-flex items-center gap-2">
        <?php echo $render_icon('plus', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Add payment method', 'woocommerce'); ?>
      </span>
    </a>
  </div>

  <?php if ($has_methods) : ?>
    <div class="grid grid-cols-1 gap-4">
      <?php foreach ($saved_methods as $type => $methods) : ?>
        <?php foreach ($methods as $method) : ?>
          <?php
          $method_type = isset($types[$type]) ? $types[$type] : ucfirst($type);
          $actions     = ! empty($method['actions']) ? $method['actions'] : [];
          ?>
          <article class="rsp-card p-5 md:p-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
                  <?php echo $render_icon('credit-card', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </div>

                <div>
                  <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
                    <?php echo esc_html($method_type); ?>
                  </p>

                  <h3 class="rsp-account-heading mt-1 text-[21px] font-[800] leading-tight">
                    <?php echo isset($method['method']['last4']) ? esc_html(sprintf(__('Card ending in %s', 'reviewservicepro'), $method['method']['last4'])) : esc_html__('Saved payment method', 'reviewservicepro'); ?>
                  </h3>

                  <div class="mt-2 flex flex-wrap gap-x-5 gap-y-2 text-[14px] font-medium text-[#64748B]">
                    <?php foreach ($columns as $column_id => $column_name) : ?>
                      <?php if ('method' === $column_id) {
                        continue;
                      } ?>
                      <span>
                        <strong class="text-[#3B4658]"><?php echo esc_html($column_name); ?>:</strong>
                        <?php do_action('woocommerce_account_payment_methods_column_' . $column_id, $method); ?>
                      </span>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

              <?php if (! empty($actions)) : ?>
                <div class="flex flex-wrap gap-2">
                  <?php foreach ($actions as $key => $action) : ?>
                    <a href="<?php echo esc_url($action['url']); ?>" class="rsp-btn <?php echo 'delete' === $key ? 'rsp-btn-secondary' : 'rsp-btn-secondary'; ?>">
                      <?php echo esc_html($action['name']); ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <div class="rsp-card p-6 text-center md:p-8">
      <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
        <?php echo $render_icon('credit-card', 'h-6 w-6'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
      </div>

      <h3 class="rsp-account-heading text-[24px] font-[800] leading-tight">
        <?php esc_html_e('No saved payment methods', 'reviewservicepro'); ?>
      </h3>

      <p class="rsp-account-text mx-auto mt-3 max-w-xl">
        <?php esc_html_e('Saved payment methods will appear here after they are added through checkout or the secure payment method form.', 'reviewservicepro'); ?>
      </p>

      <a href="<?php echo esc_url($add_url); ?>" class="rsp-btn rsp-btn-primary mt-5">
        <span class="relative z-10 inline-flex items-center gap-2">
          <?php echo $render_icon('plus', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Add payment method', 'woocommerce'); ?>
        </span>
      </a>
    </div>
  <?php endif; ?>
</section>

<?php do_action('woocommerce_after_account_payment_methods', $has_methods); ?>