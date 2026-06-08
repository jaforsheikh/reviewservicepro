<?php

/**
 * Payment Methods
 *
 * File: woocommerce/myaccount/payment-methods.php
 *
 * ReviewService.Pro custom WooCommerce My Account payment methods page.
 *
 * Purpose:
 * - Premium client portal payment methods UI.
 * - Preserve WooCommerce saved payment method actions.
 * - Preserve WooCommerce hooks and add payment method endpoint.
 * - Show professional empty state if saved payment methods are unavailable.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$saved_methods = function_exists('wc_get_customer_saved_methods_list')
  ? wc_get_customer_saved_methods_list(get_current_user_id())
  : [];

$has_methods = (bool) $saved_methods;

$add_payment_method_url = function_exists('wc_get_endpoint_url') && function_exists('wc_get_page_permalink')
  ? wc_get_endpoint_url('add-payment-method', '', wc_get_page_permalink('myaccount'))
  : home_url('/my-account/add-payment-method/');

$dashboard_url = function_exists('wc_get_page_permalink')
  ? wc_get_page_permalink('myaccount')
  : home_url('/my-account/');

$orders_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('orders')
  : home_url('/my-account/orders/');

$support_url = home_url('/contact/?type=billing-support');

$columns = function_exists('wc_get_account_payment_methods_columns')
  ? wc_get_account_payment_methods_columns()
  : [
    'method'  => __('Method', 'reviewservicepro'),
    'expires' => __('Expires', 'reviewservicepro'),
    'actions' => __('Actions', 'reviewservicepro'),
  ];

do_action('woocommerce_before_account_payment_methods', $has_methods);
?>

<style>
  .rsp-payment-methods {
    color: #ffffff;
  }

  .rsp-payment-methods-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-payment-methods-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-payment-methods-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-payment-methods-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-payment-x, 50%) var(--rsp-payment-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-payment-x, 50%) var(--rsp-payment-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-payment-methods-card:hover::before {
    opacity: 1;
  }

  .rsp-payment-methods-beam {
    animation: rspPaymentMethodsBeam 8s ease-in-out infinite;
  }

  @keyframes rspPaymentMethodsBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-payment-methods .rsp-payment-action-button,
  .rsp-payment-methods .button {
    display: inline-flex;
    min-height: 42px;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: rgba(255, 255, 255, 0.055);
    padding: 10px 14px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.2;
    text-decoration: none;
    transition: all 220ms ease;
  }

  .rsp-payment-methods .rsp-payment-action-button:hover,
  .rsp-payment-methods .button:hover {
    transform: translateY(-1px);
    border-color: rgba(37, 99, 235, 0.35);
    background: rgba(37, 99, 235, 0.14);
    color: #ffffff;
  }

  .rsp-payment-methods .delete,
  .rsp-payment-methods .button.delete {
    border-color: rgba(248, 113, 113, 0.22);
    background: rgba(248, 113, 113, 0.09);
    color: #fecaca;
  }

  .rsp-payment-methods .delete:hover,
  .rsp-payment-methods .button.delete:hover {
    border-color: rgba(248, 113, 113, 0.35);
    background: rgba(248, 113, 113, 0.14);
    color: #ffffff;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-payment-methods-reveal,
    .rsp-payment-methods-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-payment-methods relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-payment-methods-card rsp-payment-methods-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-payment-methods-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-payment-methods-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="credit-card" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Payment Methods', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Manage saved payment methods.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Saved payment methods appear here when your payment gateway supports secure tokenized payments. Use this area to view, set default, or remove saved methods.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($add_payment_method_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Add Payment Method', 'reviewservicepro'); ?>
            <i data-lucide="plus" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Billing Support', 'reviewservicepro'); ?>
            <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Guidance Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-payment-methods-card rsp-payment-methods-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-payment-methods-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Secure tokenized storage', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Saved methods are handled by your payment gateway. ReviewService.Pro does not store raw card numbers in the theme.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-payment-methods-card rsp-payment-methods-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-payment-methods-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="receipt-text" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Faster checkout', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Saved payment methods can make future reputation service orders faster when supported by your gateway.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-payment-methods-card rsp-payment-methods-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-payment-methods-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="info" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Gateway dependent', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('This feature appears only when your active payment method supports saved customer payment tokens.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <?php if ($has_methods) : ?>

      <!-- Saved Methods -->
      <section class="rsp-payment-methods-card rsp-payment-methods-reveal mt-8 rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-payment-methods-card>
        <div class="relative z-10">
          <div class="mb-8">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
              <i data-lucide="wallet-cards" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Saved payment methods', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Manage saved methods below. You can set a default method or remove a saved method if your payment gateway allows it.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="grid grid-cols-1 gap-5">
            <?php foreach ($saved_methods as $type => $methods) : ?>
              <?php foreach ($methods as $method) : ?>
                <?php
                $brand = ! empty($method['method']['brand']) ? $method['method']['brand'] : '';
                $last4 = ! empty($method['method']['last4']) ? $method['method']['last4'] : '';
                $expires = ! empty($method['expires']) ? $method['expires'] : '';
                $is_default = ! empty($method['is_default']);
                $actions = ! empty($method['actions']) && is_array($method['actions']) ? $method['actions'] : [];

                $method_label = '';

                if ($brand && $last4 && function_exists('wc_get_credit_card_type_label')) {
                  $method_label = sprintf(
                    /* translators: 1: credit card type, 2: last 4 digits */
                    esc_html__('%1$s ending in %2$s', 'reviewservicepro'),
                    wc_get_credit_card_type_label($brand),
                    $last4
                  );
                } elseif ($brand && function_exists('wc_get_credit_card_type_label')) {
                  $method_label = wc_get_credit_card_type_label($brand);
                } elseif ($last4) {
                  $method_label = sprintf(
                    esc_html__('Payment method ending in %s', 'reviewservicepro'),
                    $last4
                  );
                } else {
                  $method_label = esc_html__('Saved payment method', 'reviewservicepro');
                }
                ?>

                <article class="rounded-[1.5rem] border border-white/[0.08] bg-white/[0.035] p-5 md:p-6">
                  <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
                    <div>
                      <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.12em] text-blue-200">
                          <i data-lucide="credit-card" class="h-3.5 w-3.5" aria-hidden="true"></i>
                          <?php echo esc_html($type); ?>
                        </span>

                        <?php if ($is_default) : ?>
                          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/20 bg-[#00C853]/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.12em] text-[#6DFFB0]">
                            <i data-lucide="badge-check" class="h-3.5 w-3.5" aria-hidden="true"></i>
                            <?php esc_html_e('Default', 'reviewservicepro'); ?>
                          </span>
                        <?php endif; ?>
                      </div>

                      <h3 class="mt-4 text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
                        <?php echo esc_html($method_label); ?>
                      </h3>

                      <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                          <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                            <?php esc_html_e('Method Type', 'reviewservicepro'); ?>
                          </p>

                          <p class="mt-2 text-sm font-medium text-white">
                            <?php echo esc_html(ucfirst((string) $type)); ?>
                          </p>
                        </div>

                        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                          <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                            <?php esc_html_e('Expires', 'reviewservicepro'); ?>
                          </p>

                          <p class="mt-2 text-sm font-medium text-white">
                            <?php echo $expires ? esc_html($expires) : esc_html__('Not available', 'reviewservicepro'); ?>
                          </p>
                        </div>
                      </div>
                    </div>

                    <?php if (! empty($actions)) : ?>
                      <div class="flex flex-col gap-3 lg:min-w-[220px]">
                        <?php foreach ($actions as $key => $action) : ?>
                          <?php
                          $action_url  = ! empty($action['url']) ? $action['url'] : '#';
                          $action_name = ! empty($action['name']) ? $action['name'] : ucfirst((string) $key);
                          $action_class = 'button ' . sanitize_html_class($key) . ' rsp-payment-action-button';
                          ?>

                          <a
                            href="<?php echo esc_url($action_url); ?>"
                            class="<?php echo esc_attr($action_class); ?>">

                            <?php echo esc_html($action_name); ?>
                            <i data-lucide="<?php echo 'delete' === $key ? 'trash-2' : 'arrow-right'; ?>" class="h-4 w-4" aria-hidden="true"></i>
                          </a>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <?php
                  /**
                   * Preserve gateway-specific custom columns/actions.
                   */
                  foreach ($columns as $column_id => $column_name) {
                    if (has_action('woocommerce_account_payment_methods_column_' . $column_id)) {
                      echo '<div class="mt-5 rounded-2xl border border-white/[0.08] bg-white/[0.025] p-4 text-sm leading-7 text-slate-300">';
                      do_action('woocommerce_account_payment_methods_column_' . $column_id, $method);
                      echo '</div>';
                    }
                  }
                  ?>
                </article>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

    <?php else : ?>

      <!-- Empty State -->
      <section class="rsp-payment-methods-card rsp-payment-methods-reveal mt-8 rounded-[1.75rem] border border-blue-400/20 bg-blue-500/[0.08] p-8 text-center shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-12" data-rsp-payment-methods-card>
        <div class="relative z-10">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
            <i data-lucide="wallet-cards" class="h-8 w-8" aria-hidden="true"></i>
          </div>

          <h2 class="mx-auto mt-6 max-w-2xl text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('No saved payment methods yet.', 'reviewservicepro'); ?>
          </h2>

          <p class="mx-auto mt-4 max-w-2xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Saved payment methods will appear here only if your payment gateway supports secure saved customer payment tokens.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
            <a
              href="<?php echo esc_url($add_payment_method_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php esc_html_e('Add Payment Method', 'reviewservicepro'); ?>
              <i data-lucide="plus" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($orders_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

              <?php esc_html_e('View Orders', 'reviewservicepro'); ?>
              <i data-lucide="package-check" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>

    <?php endif; ?>

    <!-- Security Notice -->
    <section class="rsp-payment-methods-card rsp-payment-methods-reveal mt-8 rounded-[1.75rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-payment-methods-card>
      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Payment security note.', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Payment details are processed by the active WooCommerce payment gateway. For billing issues, payment failures, or account questions, contact support with your order number or account email.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Contact Billing Support', 'reviewservicepro'); ?>
            <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
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
    function initRspPaymentMethodsPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-payment-methods-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-payment-methods-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-payment-x', x + '%');
          card.style.setProperty('--rsp-payment-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPaymentMethodsPage);
    } else {
      initRspPaymentMethodsPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_account_payment_methods', $has_methods); ?>