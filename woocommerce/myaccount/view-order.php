<?php

/**
 * View Order
 *
 * File: woocommerce/myaccount/view-order.php
 *
 * ReviewService.Pro custom WooCommerce My Account view order page.
 *
 * Purpose:
 * - Show a premium service-order detail page inside the client portal.
 * - Preserve WooCommerce order hooks and order details.
 * - Show service status, onboarding guidance, payment status, service items, and support CTA.
 * - Keep ethical ORM language safe.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$order_id = isset($order_id) ? absint($order_id) : absint(get_query_var('view-order'));
$order    = $order_id ? wc_get_order($order_id) : false;

if (! $order instanceof WC_Order) {
  wc_print_notice(esc_html__('Invalid order. Please return to your account dashboard and try again.', 'reviewservicepro'), 'error');
  return;
}

$current_user_id = get_current_user_id();

if ($order->get_user_id() && $order->get_user_id() !== $current_user_id && ! current_user_can('manage_woocommerce')) {
  wc_print_notice(esc_html__('You do not have permission to view this order.', 'reviewservicepro'), 'error');
  return;
}

$order_number = $order->get_order_number();
$order_status = function_exists('wc_get_order_status_name') ? wc_get_order_status_name($order->get_status()) : $order->get_status();
$status_key   = $order->get_status();
$order_date   = $order->get_date_created() ? wc_format_datetime($order->get_date_created()) : '';
$order_total  = $order->get_formatted_order_total();

$orders_url      = function_exists('wc_get_account_endpoint_url') ? wc_get_account_endpoint_url('orders') : home_url('/my-account/orders/');
$dashboard_url   = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$pricing_url     = home_url('/pricing/');
$support_url     = home_url('/contact/?type=order-support&order=' . rawurlencode($order_number));
$payment_url     = $order->get_checkout_payment_url();

$payment_method = $order->get_payment_method_title();
$billing_email  = $order->get_billing_email();

$items = $order->get_items();

$status_classes = [
  'processing' => 'border-blue-400/20 bg-blue-500/10 text-blue-200',
  'completed'  => 'border-[#00C853]/20 bg-[#00C853]/10 text-[#6DFFB0]',
  'pending'    => 'border-amber-300/20 bg-amber-300/10 text-amber-100',
  'on-hold'    => 'border-amber-300/20 bg-amber-300/10 text-amber-100',
  'cancelled'  => 'border-red-300/20 bg-red-400/10 text-red-100',
  'failed'     => 'border-red-300/20 bg-red-400/10 text-red-100',
  'refunded'   => 'border-slate-300/20 bg-slate-300/10 text-slate-200',
];

$status_class = isset($status_classes[$status_key])
  ? $status_classes[$status_key]
  : 'border-white/[0.12] bg-white/[0.06] text-slate-200';

$is_payment_needed = $order->needs_payment();
$is_completed      = $order->has_status('completed');
$is_failed         = $order->has_status('failed');
$is_cancelled      = $order->has_status('cancelled');
$is_active         = $order->has_status(['pending', 'processing', 'on-hold']);

$customer_notes = function_exists('wc_get_order_notes')
  ? wc_get_order_notes(
    [
      'order_id' => $order_id,
      'type'     => 'customer',
      'orderby'  => 'date_created',
      'order'    => 'DESC',
    ]
  )
  : [];

?>

<style>
  .rsp-view-order {
    color: #ffffff;
  }

  .rsp-view-order-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-view-order-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-view-order-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-view-order-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-order-x, 50%) var(--rsp-order-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-order-x, 50%) var(--rsp-order-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-view-order-card:hover::before {
    opacity: 1;
  }

  .rsp-view-order-beam {
    animation: rspViewOrderBeam 8s ease-in-out infinite;
  }

  @keyframes rspViewOrderBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-view-order-default :where(h2, h3) {
    color: #ffffff;
    font-weight: 600;
    letter-spacing: -0.035em;
  }

  .rsp-view-order-default :where(p, li, td, th, address) {
    color: rgb(203 213 225);
    font-size: 15px;
    line-height: 1.75;
  }

  .rsp-view-order-default :where(a) {
    color: #60A5FA;
    text-decoration: none;
  }

  .rsp-view-order-default :where(a:hover) {
    color: #93C5FD;
  }

  .rsp-view-order-default :where(table) {
    width: 100%;
    overflow: hidden;
    border: 1px solid rgba(148, 163, 184, 0.18);
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.025);
  }

  .rsp-view-order-default :where(th, td) {
    padding: 16px;
    border-color: rgba(148, 163, 184, 0.16);
  }

  .rsp-view-order-default .woocommerce-order-details {
    margin-top: 0;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-view-order-reveal,
    .rsp-view-order-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-view-order relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-view-order-card rsp-view-order-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-view-order-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-view-order-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <div class="flex flex-wrap items-center gap-3">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
              <i data-lucide="receipt-text" class="h-4 w-4" aria-hidden="true"></i>
              <?php echo esc_html(sprintf(__('Order #%s', 'reviewservicepro'), $order_number)); ?>
            </span>

            <span class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] <?php echo esc_attr($status_class); ?>">
              <i data-lucide="circle-dot" class="h-4 w-4" aria-hidden="true"></i>
              <?php echo esc_html($order_status); ?>
            </span>
          </div>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Service order details and next steps.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Review your purchased reputation service, order status, payment information, onboarding expectations, and service workflow from your client portal.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <?php if ($is_payment_needed) : ?>
            <a
              href="<?php echo esc_url($payment_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php esc_html_e('Complete Payment', 'reviewservicepro'); ?>
              <i data-lucide="credit-card" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          <?php endif; ?>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Ask About This Order', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($orders_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.035] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Back to Orders', 'reviewservicepro'); ?>
            <i data-lucide="arrow-left" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Order Snapshot -->
    <section class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">

      <article class="rsp-view-order-card rsp-view-order-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-view-order-card>
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-300">
          <i data-lucide="calendar-days" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
          <?php esc_html_e('Order Date', 'reviewservicepro'); ?>
        </p>

        <p class="mt-2 text-lg font-semibold tracking-[-0.03em] text-white">
          <?php echo esc_html($order_date); ?>
        </p>
      </article>

      <article class="rsp-view-order-card rsp-view-order-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-view-order-card style="transition-delay: 70ms;">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="wallet-cards" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
          <?php esc_html_e('Order Total', 'reviewservicepro'); ?>
        </p>

        <p class="mt-2 text-lg font-semibold tracking-[-0.03em] text-white">
          <?php echo wp_kses_post($order_total); ?>
        </p>
      </article>

      <article class="rsp-view-order-card rsp-view-order-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-view-order-card style="transition-delay: 140ms;">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="credit-card" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
          <?php esc_html_e('Payment Method', 'reviewservicepro'); ?>
        </p>

        <p class="mt-2 text-lg font-semibold tracking-[-0.03em] text-white">
          <?php echo esc_html($payment_method ? $payment_method : __('Not available', 'reviewservicepro')); ?>
        </p>
      </article>

      <article class="rsp-view-order-card rsp-view-order-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-view-order-card style="transition-delay: 210ms;">
        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-300">
          <i data-lucide="mail" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
          <?php esc_html_e('Billing Email', 'reviewservicepro'); ?>
        </p>

        <p class="mt-2 break-words text-sm font-medium leading-6 text-white">
          <?php echo esc_html($billing_email ? $billing_email : __('Not available', 'reviewservicepro')); ?>
        </p>
      </article>

    </section>

    <!-- Service Workflow -->
    <section class="rsp-view-order-card rsp-view-order-reveal mt-8 rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-view-order-card>
      <div class="relative z-10">
        <div class="grid grid-cols-1 gap-8 xl:grid-cols-[0.75fr_1.25fr] xl:items-start">
          <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
              <i data-lucide="route" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Service Workflow', 'reviewservicepro'); ?>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Where this order stands now.', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-4 text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('This timeline explains the normal delivery flow for one-time reputation services and platform checks. Some steps may vary depending on package scope.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="grid grid-cols-1 gap-4">
            <div class="rounded-2xl border <?php echo $is_failed || $is_cancelled ? 'border-red-300/20 bg-red-400/10' : 'border-[#00C853]/20 bg-[#00C853]/[0.08]'; ?> p-5">
              <div class="flex gap-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full <?php echo $is_failed || $is_cancelled ? 'bg-red-300 text-[#07111F]' : 'bg-[#00C853] text-[#07111F]'; ?> text-sm font-bold">1</span>
                <div>
                  <h3 class="text-lg font-semibold tracking-[-0.035em] text-white">
                    <?php esc_html_e('Order received', 'reviewservicepro'); ?>
                  </h3>
                  <p class="mt-2 text-sm font-normal leading-7 text-slate-300">
                    <?php esc_html_e('Your service order is stored in the client portal with order details and payment status.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>
            </div>

            <div class="rounded-2xl border <?php echo $is_active || $is_completed ? 'border-blue-400/20 bg-blue-500/[0.08]' : 'border-white/[0.08] bg-white/[0.035]'; ?> p-5">
              <div class="flex gap-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full <?php echo $is_active || $is_completed ? 'bg-blue-500 text-white' : 'bg-white/[0.08] text-slate-300'; ?> text-sm font-bold">2</span>
                <div>
                  <h3 class="text-lg font-semibold tracking-[-0.035em] text-white">
                    <?php esc_html_e('Onboarding / service review', 'reviewservicepro'); ?>
                  </h3>
                  <p class="mt-2 text-sm font-normal leading-7 text-slate-300">
                    <?php esc_html_e('We review your business details, platform links, reputation concerns, and any screenshots or context needed for this package.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>
            </div>

            <div class="rounded-2xl border <?php echo $is_completed ? 'border-[#00C853]/20 bg-[#00C853]/[0.08]' : 'border-white/[0.08] bg-white/[0.035]'; ?> p-5">
              <div class="flex gap-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full <?php echo $is_completed ? 'bg-[#00C853] text-[#07111F]' : 'bg-white/[0.08] text-slate-300'; ?> text-sm font-bold">3</span>
                <div>
                  <h3 class="text-lg font-semibold tracking-[-0.035em] text-white">
                    <?php esc_html_e('Service delivery / completion', 'reviewservicepro'); ?>
                  </h3>
                  <p class="mt-2 text-sm font-normal leading-7 text-slate-300">
                    <?php esc_html_e('When the service work is complete, the order will be marked completed and any relevant delivery notes or guidance will be shared.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Ordered Services -->
    <section class="rsp-view-order-card rsp-view-order-reveal mt-8 rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-view-order-card>
      <div class="relative z-10">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Services in this order', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 max-w-2xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('These are the one-time reputation services or platform checks included in this order.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-5">
          <?php foreach ($items as $item_id => $item) : ?>
            <?php
            if (! $item instanceof WC_Order_Item_Product) {
              continue;
            }

            $item_product = $item->get_product();
            $item_name    = $item->get_name();
            $quantity     = $item->get_quantity();
            $line_total   = $order->get_formatted_line_subtotal($item);

            $product_id   = $item_product instanceof WC_Product ? $item_product->get_id() : 0;
            $product_url  = $product_id ? get_permalink($product_id) : '';
            $image_id     = $item_product instanceof WC_Product ? $item_product->get_image_id() : 0;
            $image_url    = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : wc_placeholder_img_src('woocommerce_thumbnail');

            $platform_scope = $product_id ? get_post_meta($product_id, '_rsp_platform_scope', true) : '';
            $timeline       = $product_id ? get_post_meta($product_id, '_rsp_service_timeline', true) : '';
            ?>

            <article class="rounded-[1.5rem] border border-white/[0.08] bg-white/[0.035] p-5">
              <div class="grid grid-cols-1 gap-5 md:grid-cols-[84px_1fr_auto] md:items-center">
                <div class="overflow-hidden rounded-2xl border border-white/[0.08] bg-white">
                  <img
                    src="<?php echo esc_url($image_url); ?>"
                    alt="<?php echo esc_attr($item_name); ?>"
                    class="aspect-square w-full object-cover"
                    loading="lazy">
                </div>

                <div>
                  <h3 class="text-xl font-semibold tracking-[-0.035em] text-white">
                    <?php if ($product_url) : ?>
                      <a href="<?php echo esc_url($product_url); ?>" class="transition-colors duration-200 hover:text-blue-300">
                        <?php echo esc_html($item_name); ?>
                      </a>
                    <?php else : ?>
                      <?php echo esc_html($item_name); ?>
                    <?php endif; ?>
                  </h3>

                  <div class="mt-3 flex flex-wrap gap-2">
                    <span class="rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-200">
                      <?php
                      printf(
                        esc_html__('Quantity: %s', 'reviewservicepro'),
                        esc_html((string) $quantity)
                      );
                      ?>
                    </span>

                    <?php if ($platform_scope) : ?>
                      <span class="rounded-full border border-[#00C853]/20 bg-[#00C853]/10 px-3 py-1 text-xs font-medium text-[#6DFFB0]">
                        <?php echo esc_html($platform_scope); ?>
                      </span>
                    <?php endif; ?>

                    <?php if ($timeline) : ?>
                      <span class="rounded-full border border-amber-300/20 bg-amber-300/10 px-3 py-1 text-xs font-medium text-amber-100">
                        <?php echo esc_html($timeline); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="text-left md:text-right">
                  <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                    <?php esc_html_e('Line Total', 'reviewservicepro'); ?>
                  </p>

                  <p class="mt-2 text-lg font-semibold text-white">
                    <?php echo wp_kses_post($line_total); ?>
                  </p>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Customer Notes -->
    <?php if (! empty($customer_notes)) : ?>
      <section class="rsp-view-order-card rsp-view-order-reveal mt-8 rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-view-order-card>
        <div class="relative z-10">
          <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Order updates from our team', 'reviewservicepro'); ?>
          </h2>

          <div class="mt-8 space-y-4">
            <?php foreach ($customer_notes as $note) : ?>
              <article class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-5">
                <p class="text-sm font-normal leading-7 text-slate-300">
                  <?php echo wp_kses_post(wpautop($note->content)); ?>
                </p>

                <?php if (! empty($note->date_created)) : ?>
                  <p class="mt-3 text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
                    <?php echo esc_html(wc_format_datetime($note->date_created)); ?>
                  </p>
                <?php endif; ?>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <!-- Onboarding Guidance + Compliance -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">

      <article class="rsp-view-order-card rsp-view-order-reveal rounded-[1.75rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl md:p-8" data-rsp-view-order-card>
        <div class="relative z-10">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
            <i data-lucide="file-input" class="h-6 w-6" aria-hidden="true"></i>
          </div>

          <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
            <?php esc_html_e('Onboarding information we may request', 'reviewservicepro'); ?>
          </h2>

          <ul class="mt-5 space-y-3" role="list">
            <li class="flex gap-3 text-sm font-normal leading-7 text-slate-300">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <?php esc_html_e('Business name, website URL, and target location.', 'reviewservicepro'); ?>
            </li>
            <li class="flex gap-3 text-sm font-normal leading-7 text-slate-300">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <?php esc_html_e('Google Business Profile, Trustpilot, Yelp, Facebook, or other review platform links.', 'reviewservicepro'); ?>
            </li>
            <li class="flex gap-3 text-sm font-normal leading-7 text-slate-300">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <?php esc_html_e('Screenshots, negative review examples, or reputation concerns if relevant.', 'reviewservicepro'); ?>
            </li>
          </ul>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Send Order Message', 'reviewservicepro'); ?>
            <i data-lucide="send" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </article>

      <article class="rsp-view-order-card rsp-view-order-reveal rounded-[1.75rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl md:p-8" data-rsp-view-order-card style="transition-delay: 90ms;">
        <div class="relative z-10">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
            <i data-lucide="shield-alert" class="h-6 w-6" aria-hidden="true"></i>
          </div>

          <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
            <?php esc_html_e('Ethical ORM service boundary', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 text-sm font-normal leading-7 text-slate-300">
            <?php esc_html_e('ReviewService.Pro provides ethical online reputation management support. We help monitor, document, respond, report eligible issues, and improve trust signals through platform-compliant workflows.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-5 flex flex-wrap gap-2">
            <span class="rounded-full border border-[#00C853]/20 bg-[#00C853]/10 px-3 py-1 text-xs font-medium text-[#6DFFB0]">
              <?php esc_html_e('No fake reviews', 'reviewservicepro'); ?>
            </span>

            <span class="rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-200">
              <?php esc_html_e('No paid incentives', 'reviewservicepro'); ?>
            </span>

            <span class="rounded-full border border-amber-300/20 bg-amber-300/10 px-3 py-1 text-xs font-medium text-amber-100">
              <?php esc_html_e('No guaranteed removals', 'reviewservicepro'); ?>
            </span>

            <span class="rounded-full border border-white/[0.10] bg-white/[0.05] px-3 py-1 text-xs font-medium text-slate-200">
              <?php esc_html_e('No ranking guarantees', 'reviewservicepro'); ?>
            </span>
          </div>
        </div>
      </article>

    </section>

    <!-- WooCommerce Details Hook -->
    <section class="rsp-view-order-card rsp-view-order-reveal mt-8 rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-view-order-card>
      <div class="relative z-10">
        <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
          <?php esc_html_e('Full WooCommerce order details', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
          <?php esc_html_e('The official WooCommerce order details are preserved below for payment, billing, taxes, and order record compatibility.', 'reviewservicepro'); ?>
        </p>

        <div class="rsp-view-order-default mt-8">
          <?php
          /**
           * Preserve WooCommerce order details, downloads, customer details,
           * and gateway/order plugin compatibility.
           *
           * @hooked woocommerce_order_details_table - 10
           */
          do_action('woocommerce_view_order', $order_id);
          ?>
        </div>
      </div>
    </section>

    <!-- Final CTA -->
    <section class="rsp-view-order-card rsp-view-order-reveal mt-8 rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-view-order-card>
      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Need help with this order?', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Contact support with your order number and any platform links, screenshots, or reputation concerns related to this service.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($dashboard_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Back to Portal', 'reviewservicepro'); ?>
            <i data-lucide="layout-dashboard" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

  </div>
</section>

<script>
  (function() {
    function initRspViewOrderPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-view-order-reveal');

      if ('IntersectionObserver' in window && revealItems.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('rsp-is-visible');
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        revealItems.forEach(function(item) {
          observer.observe(item);
        });
      } else {
        revealItems.forEach(function(item) {
          item.classList.add('rsp-is-visible');
        });
      }

      var cards = document.querySelectorAll('[data-rsp-view-order-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-order-x', x + '%');
          card.style.setProperty('--rsp-order-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspViewOrderPage);
    } else {
      initRspViewOrderPage();
    }
  })();
</script>