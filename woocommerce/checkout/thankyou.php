<?php

/**
 * Order received / Thank you page
 *
 * File: woocommerce/checkout/thankyou.php
 *
 * ReviewService.Pro custom WooCommerce thank you template.
 *
 * Purpose:
 * - Keep WooCommerce order/payment hooks working.
 * - Show premium service-order confirmation.
 * - Guide client toward onboarding/client portal.
 * - Keep ORM compliance-safe messaging.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$order_id = isset($order_id) ? absint($order_id) : absint(get_query_var('order-received'));

if (! isset($order) || ! $order instanceof WC_Order) {
  $order = $order_id ? wc_get_order($order_id) : false;
}

$my_account_url = function_exists('wc_get_page_permalink')
  ? wc_get_page_permalink('myaccount')
  : home_url('/my-account/');

$pricing_url = home_url('/pricing/');
$contact_url = home_url('/contact/?type=order-support');

?>

<style>
  .rsp-thankyou-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-thankyou-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-thankyou-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-thankyou-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(420px circle at var(--rsp-mouse-x, 50%) var(--rsp-mouse-y, 50%), rgba(37, 99, 235, 0.12), transparent 42%),
      radial-gradient(320px circle at var(--rsp-mouse-x, 50%) var(--rsp-mouse-y, 50%), rgba(0, 200, 83, 0.10), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-thankyou-card:hover::before {
    opacity: 1;
  }

  .rsp-thankyou-beam {
    animation: rspThankyouBeam 8s ease-in-out infinite;
  }

  @keyframes rspThankyouBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-thankyou-default-hooks :where(p, li, td, th) {
    color: rgb(203 213 225);
    font-size: 15px;
    line-height: 1.75;
  }

  .rsp-thankyou-default-hooks :where(a) {
    color: #60A5FA;
    text-decoration: none;
  }

  .rsp-thankyou-default-hooks :where(a:hover) {
    color: #93C5FD;
  }

  .rsp-thankyou-default-hooks :where(table) {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
    border: 1px solid rgba(148, 163, 184, 0.18);
    border-radius: 16px;
  }

  .rsp-thankyou-default-hooks :where(th, td) {
    padding: 14px 16px;
    border-bottom: 1px solid rgba(148, 163, 184, 0.16);
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-thankyou-reveal,
    .rsp-thankyou-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="relative overflow-hidden bg-[#07111F] px-4 py-16 text-white sm:px-6 lg:px-8 lg:py-20">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:52px_52px]"></div>
  <div class="pointer-events-none absolute -left-36 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-600/[0.12] blur-[130px]"></div>
  <div class="pointer-events-none absolute -right-36 top-72 z-0 h-[520px] w-[520px] rounded-full bg-[#00C853]/[0.10] blur-[130px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <?php if ($order && $order->has_status('failed')) : ?>

      <div class="rsp-thankyou-card rsp-thankyou-reveal rounded-[2rem] border border-red-400/20 bg-red-500/[0.08] p-6 shadow-[0_30px_100px_rgba(0,0,0,0.22)] md:p-10" data-rsp-thankyou-card>
        <span class="inline-flex items-center gap-2 rounded-full border border-red-300/25 bg-red-400/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-red-200">
          <i data-lucide="circle-alert" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Payment Issue', 'reviewservicepro'); ?>
        </span>

        <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-[1.05] tracking-[-0.055em] text-white md:text-5xl">
          <?php esc_html_e('Your payment could not be completed.', 'reviewservicepro'); ?>
        </h1>

        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
          <?php esc_html_e('Your order was created, but payment did not complete successfully. You can try again or contact us for help before placing the service order.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Try Payment Again', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    <?php elseif ($order) : ?>

      <?php do_action('woocommerce_before_thankyou', $order->get_id()); ?>

      <!-- Hero confirmation -->
      <div class="rsp-thankyou-card rsp-thankyou-reveal rounded-[2rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_30px_100px_rgba(0,0,0,0.24)] backdrop-blur-xl md:p-10" data-rsp-thankyou-card>

        <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
          <div class="rsp-thankyou-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
          <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
              <i data-lucide="badge-check" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Service Order Received', 'reviewservicepro'); ?>
            </span>

            <h1 class="mt-5 max-w-4xl text-4xl font-semibold leading-[1.05] tracking-[-0.055em] text-white md:text-6xl">
              <?php esc_html_e('Thank you — your reputation service order is now received.', 'reviewservicepro'); ?>
            </h1>

            <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Our team will review your order, confirm the service scope, and guide you through the next onboarding steps inside your ReviewService.Pro client portal.', 'reviewservicepro'); ?>
            </p>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
              <a
                href="<?php echo esc_url($my_account_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

                <?php esc_html_e('Go to Client Portal', 'reviewservicepro'); ?>
                <i data-lucide="layout-dashboard" class="h-4 w-4" aria-hidden="true"></i>
              </a>

              <a
                href="<?php echo esc_url($contact_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

                <?php esc_html_e('Need Help?', 'reviewservicepro'); ?>
                <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            </div>
          </div>

          <div class="rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-5">
            <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
              <?php esc_html_e('Order Snapshot', 'reviewservicepro'); ?>
            </h2>

            <dl class="mt-5 grid grid-cols-1 gap-4">
              <div class="rounded-xl border border-white/[0.08] bg-white/[0.035] p-4">
                <dt class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                  <?php esc_html_e('Order Number', 'reviewservicepro'); ?>
                </dt>
                <dd class="mt-1 text-lg font-semibold text-white">
                  #<?php echo esc_html($order->get_order_number()); ?>
                </dd>
              </div>

              <div class="rounded-xl border border-white/[0.08] bg-white/[0.035] p-4">
                <dt class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                  <?php esc_html_e('Order Date', 'reviewservicepro'); ?>
                </dt>
                <dd class="mt-1 text-base font-medium text-white">
                  <?php echo esc_html(wc_format_datetime($order->get_date_created())); ?>
                </dd>
              </div>

              <div class="rounded-xl border border-white/[0.08] bg-white/[0.035] p-4">
                <dt class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                  <?php esc_html_e('Total', 'reviewservicepro'); ?>
                </dt>
                <dd class="mt-1 text-lg font-semibold text-white">
                  <?php echo wp_kses_post($order->get_formatted_order_total()); ?>
                </dd>
              </div>

              <?php if ($order->get_payment_method_title()) : ?>
                <div class="rounded-xl border border-white/[0.08] bg-white/[0.035] p-4">
                  <dt class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                    <?php esc_html_e('Payment Method', 'reviewservicepro'); ?>
                  </dt>
                  <dd class="mt-1 text-base font-medium text-white">
                    <?php echo esc_html($order->get_payment_method_title()); ?>
                  </dd>
                </div>
              <?php endif; ?>
            </dl>
          </div>
        </div>
      </div>

      <!-- Next steps -->
      <div class="mt-8 grid grid-cols-1 gap-5 lg:grid-cols-3">

        <article class="rsp-thankyou-card rsp-thankyou-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-thankyou-card>
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
            <i data-lucide="clipboard-check" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
            <?php esc_html_e('1. Order Review', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
            <?php esc_html_e('We review your selected service, order details, payment status, and required onboarding steps before starting work.', 'reviewservicepro'); ?>
          </p>
        </article>

        <article class="rsp-thankyou-card rsp-thankyou-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-thankyou-card style="transition-delay: 80ms;">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-300">
            <i data-lucide="file-input" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
            <?php esc_html_e('2. Onboarding Details', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
            <?php esc_html_e('You may be asked for your business name, website, review platform links, reputation concern, and screenshots if needed.', 'reviewservicepro'); ?>
          </p>
        </article>

        <article class="rsp-thankyou-card rsp-thankyou-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-thankyou-card style="transition-delay: 160ms;">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
            <i data-lucide="shield-alert" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
            <?php esc_html_e('3. Ethical Service Scope', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
            <?php esc_html_e('Our work follows platform-compliant reputation management practices. We do not offer fake reviews, paid incentives, manipulation, or guaranteed removals.', 'reviewservicepro'); ?>
          </p>
        </article>

      </div>

      <!-- WooCommerce gateway/order hooks -->
      <div class="rsp-thankyou-card rsp-thankyou-reveal mt-8 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8" data-rsp-thankyou-card>
        <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
          <?php esc_html_e('Payment and order details', 'reviewservicepro'); ?>
        </h2>

        <div class="rsp-thankyou-default-hooks mt-5">
          <?php
          /**
           * Preserve gateway-specific instructions.
           * Example: bank transfer details, payment instructions, etc.
           */
          do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id());

          /**
           * Preserve default WooCommerce thankyou hooks.
           */
          do_action('woocommerce_thankyou', $order->get_id());
          ?>
        </div>
      </div>

      <!-- Product list summary -->
      <div class="rsp-thankyou-card rsp-thankyou-reveal mt-8 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8" data-rsp-thankyou-card>
        <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
          <?php esc_html_e('Services ordered', 'reviewservicepro'); ?>
        </h2>

        <div class="mt-5 grid grid-cols-1 gap-4">
          <?php foreach ($order->get_items() as $item_id => $item) : ?>
            <?php
            $product = $item->get_product();
            $product_name = $item->get_name();
            $quantity = $item->get_quantity();
            $line_total = $order->get_formatted_line_subtotal($item);
            $product_url = $product instanceof WC_Product ? get_permalink($product->get_id()) : '';
            ?>

            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
              <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                  <h3 class="text-lg font-semibold tracking-[-0.03em] text-white">
                    <?php if ($product_url) : ?>
                      <a href="<?php echo esc_url($product_url); ?>" class="transition-colors duration-200 hover:text-blue-300">
                        <?php echo esc_html($product_name); ?>
                      </a>
                    <?php else : ?>
                      <?php echo esc_html($product_name); ?>
                    <?php endif; ?>
                  </h3>

                  <p class="mt-1 text-sm text-slate-400">
                    <?php
                    printf(
                      esc_html__('Quantity: %s', 'reviewservicepro'),
                      esc_html((string) $quantity)
                    );
                    ?>
                  </p>
                </div>

                <div class="text-base font-semibold text-white">
                  <?php echo wp_kses_post($line_total); ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Final guidance -->
      <div class="rsp-thankyou-card rsp-thankyou-reveal mt-8 rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-8" data-rsp-thankyou-card>
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
              <?php esc_html_e('What should you do next?', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Visit your client portal to view order information. If onboarding fields are not ready yet, our team will contact you with the next steps.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row">
            <a
              href="<?php echo esc_url($my_account_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php esc_html_e('Open Client Portal', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($pricing_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

              <?php esc_html_e('View More Services', 'reviewservicepro'); ?>
              <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>

    <?php else : ?>

      <div class="rsp-thankyou-card rsp-thankyou-reveal rounded-[2rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_30px_100px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-10" data-rsp-thankyou-card>
        <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/25 bg-blue-500/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
          <i data-lucide="info" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Order Status', 'reviewservicepro'); ?>
        </span>

        <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-[1.05] tracking-[-0.055em] text-white md:text-5xl">
          <?php esc_html_e('Thank you. Your order information is being prepared.', 'reviewservicepro'); ?>
        </h1>

        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
          <?php esc_html_e('We could not load the order details on this screen. Please visit your client portal or contact support if you need help.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($my_account_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Go to Client Portal', 'reviewservicepro'); ?>
            <i data-lucide="layout-dashboard" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    <?php endif; ?>

  </div>
</section>

<script>
  (function() {
    function initRspThankyouPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-thankyou-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-thankyou-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-mouse-x', x + '%');
          card.style.setProperty('--rsp-mouse-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspThankyouPage);
    } else {
      initRspThankyouPage();
    }
  })();
</script>