<?php

/**
 * Orders
 *
 * ReviewService.Pro — Compact client portal orders endpoint
 *
 * File: woocommerce/myaccount/orders.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$current_page = empty($current_page) ? 1 : absint($current_page);

if (! isset($customer_orders) || ! $customer_orders) {
  $customer_orders = wc_get_orders(
    apply_filters(
      'woocommerce_my_account_my_orders_query',
      [
        'customer' => get_current_user_id(),
        'page'     => $current_page,
        'paginate' => true,
      ]
    )
  );
}

$has_orders = $customer_orders && ! empty($customer_orders->orders);

do_action('woocommerce_before_account_orders', $has_orders);

$dashboard_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$support_url   = home_url('/contact/?type=order-support');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-orders-endpoint">
  <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <span class="rsp-eyebrow">
        <?php echo $render_icon('package-check', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Service Orders', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mt-3">
        <?php esc_html_e('Orders and service progress', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mt-3">
        <?php esc_html_e('Review your reputation management orders, payment status, service records, and next actions from one organized view.', 'reviewservicepro'); ?>
      </p>
    </div>

    <a href="<?php echo esc_url($support_url); ?>" class="rsp-btn rsp-btn-secondary">
      <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
      ?>
      <?php esc_html_e('Order Support', 'reviewservicepro'); ?>
    </a>
  </div>

  <?php if ($has_orders) : ?>
    <div class="grid grid-cols-1 gap-4">
      <?php foreach ($customer_orders->orders as $customer_order) : ?>
        <?php
        $order      = wc_get_order($customer_order);
        $item_count = $order ? $order->get_item_count() : 0;

        if (! $order) {
          continue;
        }

        $actions = wc_get_account_orders_actions($order);
        ?>

        <article class="rsp-card p-5 md:p-6">
          <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1fr_auto] lg:items-start">
            <div>
              <div class="mb-4 flex flex-wrap items-center gap-2">
                <span class="rsp-eyebrow border-blue-200 bg-blue-50 text-blue-700">
                  <?php echo $render_icon('receipt-text', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                  <?php
                  printf(
                    /* translators: %s: order number */
                    esc_html__('Order #%s', 'reviewservicepro'),
                    esc_html($order->get_order_number())
                  );
                  ?>
                </span>

                <span class="rsp-status-pill">
                  <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                </span>
              </div>

              <h3 class="rsp-account-heading text-[22px] font-[800] leading-tight">
                <?php
                printf(
                  /* translators: 1: item count 2: order date */
                  esc_html(_n('%1$s service item ordered on %2$s', '%1$s service items ordered on %2$s', $item_count, 'reviewservicepro')),
                  esc_html((string) $item_count),
                  esc_html(wc_format_datetime($order->get_date_created()))
                );
                ?>
              </h3>

              <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
                  <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
                    <?php esc_html_e('Total', 'reviewservicepro'); ?>
                  </p>
                  <p class="mt-1 text-[17px] font-[800] text-[#334155]">
                    <?php echo wp_kses_post($order->get_formatted_order_total()); ?>
                  </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
                  <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
                    <?php esc_html_e('Payment', 'reviewservicepro'); ?>
                  </p>
                  <p class="mt-1 text-[17px] font-[800] text-[#334155]">
                    <?php echo esc_html($order->get_payment_method_title() ? $order->get_payment_method_title() : __('Recorded', 'reviewservicepro')); ?>
                  </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
                  <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400">
                    <?php esc_html_e('Items', 'reviewservicepro'); ?>
                  </p>
                  <p class="mt-1 text-[17px] font-[800] text-[#334155]">
                    <?php echo esc_html((string) $item_count); ?>
                  </p>
                </div>
              </div>
            </div>

            <?php if (! empty($actions)) : ?>
              <div class="flex flex-col gap-2 sm:flex-row lg:flex-col lg:min-w-[190px]">
                <?php foreach ($actions as $key => $action) : ?>
                  <a
                    href="<?php echo esc_url($action['url']); ?>"
                    class="rsp-btn <?php echo 'view' === $key ? 'rsp-btn-primary' : 'rsp-btn-secondary'; ?>">
                    <span class="relative z-10">
                      <?php echo esc_html($action['name']); ?>
                    </span>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if (1 < $customer_orders->max_num_pages) : ?>
      <nav class="mt-6 flex items-center justify-between gap-3" aria-label="<?php echo esc_attr__('Orders pagination', 'reviewservicepro'); ?>">
        <?php if (1 !== $current_page) : ?>
          <a class="rsp-btn rsp-btn-secondary" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>">
            <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Previous', 'woocommerce'); ?>
          </a>
        <?php else : ?>
          <span></span>
        <?php endif; ?>

        <?php if ((int) $customer_orders->max_num_pages !== $current_page) : ?>
          <a class="rsp-btn rsp-btn-primary" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Next', 'woocommerce'); ?>
              <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </span>
          </a>
        <?php endif; ?>
      </nav>
    <?php endif; ?>

  <?php else : ?>
    <div class="rsp-card p-6 text-center md:p-8">
      <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
        <?php echo $render_icon('package-open', 'h-6 w-6'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
      </div>

      <h3 class="rsp-account-heading text-[24px] font-[800] leading-tight">
        <?php esc_html_e('No service orders yet', 'reviewservicepro'); ?>
      </h3>

      <p class="rsp-account-text mx-auto mt-3 max-w-xl">
        <?php esc_html_e('Once you order a reputation audit, platform check, or ORM package, your order history and service next steps will appear here.', 'reviewservicepro'); ?>
      </p>

      <a class="rsp-btn rsp-btn-primary mt-5" href="<?php echo esc_url(home_url('/pricing/')); ?>">
        <span class="relative z-10 inline-flex items-center gap-2">
          <?php esc_html_e('Explore Packages', 'reviewservicepro'); ?>
          <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </span>
      </a>
    </div>
  <?php endif; ?>
</section>

<?php
do_action('woocommerce_after_account_orders', $has_orders);
