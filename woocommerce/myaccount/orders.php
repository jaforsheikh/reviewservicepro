<?php

/**
 * Orders
 *
 * File: woocommerce/myaccount/orders.php
 *
 * ReviewService.Pro custom WooCommerce My Account orders page.
 *
 * Purpose:
 * - Show client service orders in a premium portal layout.
 * - Preserve WooCommerce order links and pagination.
 * - Keep enough negative space, clean cards, strong visual hierarchy.
 * - Keep reputation-management wording compliance-safe.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$current_user_id = get_current_user_id();

if (! isset($customer_orders) || ! $customer_orders) {
  $paged = isset($current_page) ? absint($current_page) : 1;

  $customer_orders = function_exists('wc_get_orders')
    ? wc_get_orders(
      [
        'customer_id' => $current_user_id,
        'paginate'    => true,
        'page'        => max(1, $paged),
        'limit'       => 10,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'return'      => 'objects',
      ]
    )
    : null;
}

$orders = [];

if (is_object($customer_orders) && isset($customer_orders->orders)) {
  $orders = $customer_orders->orders;
  $max_num_pages = isset($customer_orders->max_num_pages) ? absint($customer_orders->max_num_pages) : 1;
} elseif (is_array($customer_orders)) {
  $orders = $customer_orders;
  $max_num_pages = isset($max_num_pages) ? absint($max_num_pages) : 1;
} else {
  $max_num_pages = isset($max_num_pages) ? absint($max_num_pages) : 1;
}

$has_orders = ! empty($orders);

$current_page = isset($current_page) ? absint($current_page) : 1;

$pricing_url = home_url('/pricing/');
$support_url = home_url('/contact/?type=client-support');
$portal_url  = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');

do_action('woocommerce_before_account_orders', $has_orders);
?>

<style>
  .rsp-orders-page {
    color: #ffffff;
  }

  .rsp-orders-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-orders-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-orders-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-orders-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(440px circle at var(--rsp-orders-x, 50%) var(--rsp-orders-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-orders-x, 50%) var(--rsp-orders-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-orders-card:hover::before {
    opacity: 1;
  }

  .rsp-orders-beam {
    animation: rspOrdersBeam 8s ease-in-out infinite;
  }

  @keyframes rspOrdersBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-orders-reveal,
    .rsp-orders-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-orders-page relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <div class="rsp-orders-card rsp-orders-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-orders-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-orders-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="package-check" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Service Orders', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-5 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Your reputation service orders', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Track every ReviewService.Pro order from checkout to service review, onboarding, delivery, and completion. Order details are kept inside your secure client account.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Order New Service', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Need Support?', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Orders -->
    <?php if ($has_orders) : ?>

      <div class="mt-8 grid grid-cols-1 gap-6">

        <?php foreach ($orders as $customer_order) : ?>
          <?php
          $order = $customer_order instanceof WC_Order ? $customer_order : wc_get_order($customer_order);

          if (! $order instanceof WC_Order) {
            continue;
          }

          $order_id      = $order->get_id();
          $order_number  = $order->get_order_number();
          $order_date    = $order->get_date_created() ? wc_format_datetime($order->get_date_created()) : '';
          $order_status  = function_exists('wc_get_order_status_name') ? wc_get_order_status_name($order->get_status()) : $order->get_status();
          $order_total   = $order->get_formatted_order_total();
          $view_url      = $order->get_view_order_url();
          $pay_url       = $order->get_checkout_payment_url();
          $items         = $order->get_items();
          $item_count    = $order->get_item_count();
          $first_item    = ! empty($items) ? reset($items) : null;
          $service_name  = $first_item instanceof WC_Order_Item_Product ? $first_item->get_name() : __('Reputation service order', 'reviewservicepro');

          $status_key = $order->get_status();

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
          ?>

          <article class="rsp-orders-card rsp-orders-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8" data-rsp-orders-card>

            <div class="relative z-10 grid grid-cols-1 gap-6 xl:grid-cols-[1fr_auto] xl:items-center">

              <div>
                <div class="flex flex-wrap items-center gap-3">
                  <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.12em] text-blue-200">
                    <i data-lucide="receipt-text" class="h-3.5 w-3.5" aria-hidden="true"></i>
                    #<?php echo esc_html($order_number); ?>
                  </span>

                  <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-medium uppercase tracking-[0.12em] <?php echo esc_attr($status_class); ?>">
                    <i data-lucide="circle-dot" class="h-3.5 w-3.5" aria-hidden="true"></i>
                    <?php echo esc_html($order_status); ?>
                  </span>
                </div>

                <h2 class="mt-5 text-2xl font-semibold leading-tight tracking-[-0.04em] text-white md:text-3xl">
                  <?php echo esc_html($service_name); ?>
                </h2>

                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                  <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                    <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                      <?php esc_html_e('Order Date', 'reviewservicepro'); ?>
                    </p>

                    <p class="mt-2 text-sm font-medium text-white">
                      <?php echo esc_html($order_date); ?>
                    </p>
                  </div>

                  <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                    <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                      <?php esc_html_e('Service Items', 'reviewservicepro'); ?>
                    </p>

                    <p class="mt-2 text-sm font-medium text-white">
                      <?php
                      printf(
                        esc_html(_n('%d item', '%d items', $item_count, 'reviewservicepro')),
                        absint($item_count)
                      );
                      ?>
                    </p>
                  </div>

                  <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                    <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                      <?php esc_html_e('Order Total', 'reviewservicepro'); ?>
                    </p>

                    <p class="mt-2 text-sm font-semibold text-white">
                      <?php echo wp_kses_post($order_total); ?>
                    </p>
                  </div>
                </div>

                <div class="mt-5 rounded-2xl border border-amber-300/20 bg-amber-300/[0.05] p-4">
                  <p class="text-sm font-normal leading-7 text-slate-300">
                    <?php esc_html_e('Service progress depends on onboarding details, payment status, platform access information, and the package scope. We follow ethical reputation management practices only.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>

              <div class="flex flex-col gap-3 xl:min-w-[220px]">
                <a
                  href="<?php echo esc_url($view_url); ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

                  <?php esc_html_e('View Details', 'reviewservicepro'); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </a>

                <?php if ($order->needs_payment()) : ?>
                  <a
                    href="<?php echo esc_url($pay_url); ?>"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-amber-300/25 bg-amber-300/10 px-5 py-3 text-base font-medium text-amber-100 transition-all duration-300 hover:-translate-y-0.5 hover:bg-amber-300/15">

                    <?php esc_html_e('Complete Payment', 'reviewservicepro'); ?>
                    <i data-lucide="credit-card" class="h-4 w-4" aria-hidden="true"></i>
                  </a>
                <?php endif; ?>
              </div>

            </div>
          </article>
        <?php endforeach; ?>

      </div>

      <?php if (1 < $max_num_pages) : ?>
        <nav class="rsp-orders-reveal mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" aria-label="<?php esc_attr_e('Orders pagination', 'reviewservicepro'); ?>">
          <div>
            <?php if (1 < $current_page) : ?>
              <a
                href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-sm font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

                <i data-lucide="arrow-left" class="h-4 w-4" aria-hidden="true"></i>
                <?php esc_html_e('Previous Orders', 'reviewservicepro'); ?>
              </a>
            <?php endif; ?>
          </div>

          <div>
            <?php if ($current_page < $max_num_pages) : ?>
              <a
                href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-sm font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

                <?php esc_html_e('Next Orders', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            <?php endif; ?>
          </div>
        </nav>
      <?php endif; ?>

    <?php else : ?>

      <!-- Empty state -->
      <div class="rsp-orders-card rsp-orders-reveal mt-8 rounded-[1.75rem] border border-blue-400/20 bg-blue-500/[0.08] p-8 text-center shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-12" data-rsp-orders-card>
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="package-search" class="h-8 w-8" aria-hidden="true"></i>
        </div>

        <h2 class="mx-auto mt-6 max-w-2xl text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
          <?php esc_html_e('No reputation service orders yet.', 'reviewservicepro'); ?>
        </h2>

        <p class="mx-auto mt-4 max-w-2xl text-base font-normal leading-8 text-slate-300">
          <?php esc_html_e('Once you order a one-time reputation package or platform check, your order status and service details will appear here inside your client portal.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Explore Packages', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($portal_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Back to Dashboard', 'reviewservicepro'); ?>
            <i data-lucide="layout-dashboard" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    <?php endif; ?>

  </div>
</section>

<script>
  (function() {
    function initRspOrdersPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-orders-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-orders-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-orders-x', x + '%');
          card.style.setProperty('--rsp-orders-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspOrdersPage);
    } else {
      initRspOrdersPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>