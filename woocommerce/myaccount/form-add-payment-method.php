<?php

/**
 * Add Payment Method
 *
 * File: woocommerce/myaccount/form-add-payment-method.php
 *
 * ReviewService.Pro custom WooCommerce Add Payment Method page.
 *
 * Purpose:
 * - Premium client portal UI for adding saved payment methods.
 * - Preserve WooCommerce gateway fields, tokenization, nonce, and add payment method flow.
 * - Show clear guidance when no gateway supports saved payment methods.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$available_gateways = [];

if (function_exists('WC') && WC()->payment_gateways()) {
  $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
}

$supported_gateways = [];

if (! empty($available_gateways)) {
  foreach ($available_gateways as $gateway) {
    if (! $gateway instanceof WC_Payment_Gateway) {
      continue;
    }

    if ($gateway->supports('add_payment_method') || $gateway->supports('tokenization')) {
      $supported_gateways[] = $gateway;
    }
  }
}

$has_supported_gateways = ! empty($supported_gateways);

$payment_methods_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('payment-methods')
  : home_url('/my-account/payment-methods/');

$orders_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('orders')
  : home_url('/my-account/orders/');

$dashboard_url = function_exists('wc_get_page_permalink')
  ? wc_get_page_permalink('myaccount')
  : home_url('/my-account/');

$support_url = home_url('/contact/?type=billing-support');

?>

<style>
  .rsp-add-payment {
    color: #ffffff;
  }

  .rsp-add-payment-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-add-payment-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-add-payment-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-add-payment-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-add-payment-x, 50%) var(--rsp-add-payment-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-add-payment-x, 50%) var(--rsp-add-payment-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-add-payment-card:hover::before {
    opacity: 1;
  }

  .rsp-add-payment-beam {
    animation: rspAddPaymentBeam 8s ease-in-out infinite;
  }

  @keyframes rspAddPaymentBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-add-payment #payment {
    position: relative;
    z-index: 10;
    border-radius: 24px;
    background: transparent;
  }

  .rsp-add-payment .woocommerce-PaymentMethods {
    display: grid;
    gap: 18px;
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .rsp-add-payment .woocommerce-PaymentMethod {
    margin: 0;
    list-style: none;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 22px;
    background: rgba(255, 255, 255, 0.04);
    padding: 22px;
  }

  .rsp-add-payment .woocommerce-PaymentMethod label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.5;
  }

  .rsp-add-payment .input-radio {
    height: 18px;
    width: 18px;
    accent-color: #2563EB;
  }

  .rsp-add-payment .payment_box {
    margin-top: 18px;
    border-radius: 18px;
    border: 1px solid rgba(148, 163, 184, 0.18);
    background: rgba(255, 255, 255, 0.055);
    padding: 20px;
    color: rgb(203 213 225);
  }

  .rsp-add-payment .payment_box :where(p, li) {
    color: rgb(203 213 225);
    font-size: 15px;
    line-height: 1.75;
  }

  .rsp-add-payment .payment_box :where(a) {
    color: #60A5FA;
    text-decoration: none;
  }

  .rsp-add-payment .payment_box :where(a:hover) {
    color: #93C5FD;
  }

  .rsp-add-payment input.input-text,
  .rsp-add-payment input[type="text"],
  .rsp-add-payment input[type="email"],
  .rsp-add-payment input[type="tel"],
  .rsp-add-payment input[type="number"],
  .rsp-add-payment input[type="password"],
  .rsp-add-payment select,
  .rsp-add-payment textarea {
    min-height: 56px;
    width: 100%;
    border: 1px solid rgba(148, 163, 184, 0.42);
    border-radius: 14px;
    background: #ffffff;
    color: #020617;
    padding: 14px 16px;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.45;
    outline: none;
    box-shadow: none;
    box-sizing: border-box;
    transition:
      border-color 180ms ease,
      box-shadow 180ms ease;
  }

  .rsp-add-payment input.input-text:focus,
  .rsp-add-payment input[type="text"]:focus,
  .rsp-add-payment input[type="email"]:focus,
  .rsp-add-payment input[type="tel"]:focus,
  .rsp-add-payment input[type="number"]:focus,
  .rsp-add-payment input[type="password"]:focus,
  .rsp-add-payment select:focus,
  .rsp-add-payment textarea:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-add-payment label {
    color: #ffffff;
  }

  .rsp-add-payment .form-row {
    margin: 0;
    padding: 0;
  }

  .rsp-add-payment .woocommerce-error,
  .rsp-add-payment .woocommerce-info,
  .rsp-add-payment .woocommerce-message {
    border-radius: 18px;
    border: 1px solid rgba(37, 99, 235, 0.25);
    background: #ffffff;
    color: #334155;
    padding: 16px 20px;
    line-height: 1.7;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-add-payment-reveal,
    .rsp-add-payment-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-add-payment relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-add-payment-card rsp-add-payment-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-add-payment-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-add-payment-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="plus-circle" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Add Payment Method', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Add a secure saved payment method.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('When your active payment gateway supports secure tokenized payments, you can save a payment method for faster future reputation service orders.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($payment_methods_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Saved Methods', 'reviewservicepro'); ?>
            <i data-lucide="wallet-cards" class="h-4 w-4" aria-hidden="true"></i>
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

      <article class="rsp-add-payment-card rsp-add-payment-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-add-payment-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Tokenized storage', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Saved method details are handled by the payment gateway. The theme does not store raw card numbers.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-add-payment-card rsp-add-payment-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-add-payment-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="zap" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Faster future orders', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('A saved method can make future one-time ORM package or platform check checkout faster.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-add-payment-card rsp-add-payment-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-add-payment-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="info" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Gateway support required', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('This page works only if your active payment gateway supports adding saved payment methods.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <?php if ($has_supported_gateways) : ?>

      <!-- Add payment method form -->
      <section class="rsp-add-payment-card rsp-add-payment-reveal mt-8 rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-add-payment-card>
        <div class="relative z-10">
          <div class="mb-8">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
              <i data-lucide="credit-card" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Choose a payment method to save.', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Select an available gateway below and complete the secure payment method setup process.', 'reviewservicepro'); ?>
            </p>
          </div>

          <form id="add_payment_method" method="post">
            <div id="payment" class="woocommerce-Payment">

              <ul class="woocommerce-PaymentMethods payment_methods methods">
                <?php foreach ($supported_gateways as $index => $gateway) : ?>
                  <?php
                  $gateway_id = $gateway->id;
                  $is_chosen  = ! empty($gateway->chosen) || 0 === $index;
                  ?>

                  <li class="woocommerce-PaymentMethod woocommerce-PaymentMethod--<?php echo esc_attr($gateway_id); ?> payment_method_<?php echo esc_attr($gateway_id); ?>">
                    <div class="flex items-start gap-3">
                      <input
                        id="payment_method_<?php echo esc_attr($gateway_id); ?>"
                        type="radio"
                        class="input-radio"
                        name="payment_method"
                        value="<?php echo esc_attr($gateway_id); ?>"
                        <?php checked($is_chosen, true); ?>>

                      <div class="min-w-0 flex-1">
                        <label for="payment_method_<?php echo esc_attr($gateway_id); ?>">
                          <span><?php echo wp_kses_post($gateway->get_title()); ?></span>
                          <?php echo wp_kses_post($gateway->get_icon()); ?>
                        </label>

                        <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
                          <div
                            class="woocommerce-PaymentBox woocommerce-PaymentBox--<?php echo esc_attr($gateway_id); ?> payment_box payment_method_<?php echo esc_attr($gateway_id); ?>"
                            style="<?php echo $is_chosen ? '' : 'display:none;'; ?>">

                            <?php $gateway->payment_fields(); ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>

              <?php do_action('woocommerce_add_payment_method_form_bottom'); ?>

              <section class="mt-8 rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 md:p-8">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
                  <div>
                    <h3 class="text-2xl font-semibold tracking-[-0.04em] text-white">
                      <?php esc_html_e('Save this payment method securely.', 'reviewservicepro'); ?>
                    </h3>

                    <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
                      <?php esc_html_e('After saving, this method may be available for faster future service orders depending on your payment gateway settings.', 'reviewservicepro'); ?>
                    </p>
                  </div>

                  <div>
                    <?php wp_nonce_field('woocommerce-add-payment-method', 'woocommerce-add-payment-method-nonce'); ?>

                    <button
                      type="submit"
                      class="woocommerce-Button woocommerce-Button--alt button alt inline-flex min-h-[56px] items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700"
                      id="place_order"
                      value="<?php esc_attr_e('Add payment method', 'reviewservicepro'); ?>">

                      <?php esc_html_e('Add Payment Method', 'reviewservicepro'); ?>
                      <i data-lucide="save" class="h-4 w-4" aria-hidden="true"></i>
                    </button>

                    <input type="hidden" name="woocommerce_add_payment_method" id="woocommerce_add_payment_method" value="1">
                  </div>
                </div>
              </section>

            </div>
          </form>
        </div>
      </section>

    <?php else : ?>

      <!-- No supported gateway -->
      <section class="rsp-add-payment-card rsp-add-payment-reveal mt-8 rounded-[1.75rem] border border-blue-400/20 bg-blue-500/[0.08] p-8 text-center shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-12" data-rsp-add-payment-card>
        <div class="relative z-10">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
            <i data-lucide="credit-card" class="h-8 w-8" aria-hidden="true"></i>
          </div>

          <h2 class="mx-auto mt-6 max-w-2xl text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('No saved-payment gateway is available yet.', 'reviewservicepro'); ?>
          </h2>

          <p class="mx-auto mt-4 max-w-2xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Your active WooCommerce payment gateway may not support adding saved payment methods from the account area. You can still place orders through checkout.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
            <a
              href="<?php echo esc_url($orders_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php esc_html_e('View Orders', 'reviewservicepro'); ?>
              <i data-lucide="package-check" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($support_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

              <?php esc_html_e('Contact Billing Support', 'reviewservicepro'); ?>
              <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </section>

    <?php endif; ?>

    <!-- Security Notice -->
    <section class="rsp-add-payment-card rsp-add-payment-reveal mt-8 rounded-[1.75rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-add-payment-card>
      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Billing security note.', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Payment data is processed by the selected WooCommerce payment gateway. ReviewService.Pro support will never ask for your card number or password.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
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
    function initRspAddPaymentMethodPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-add-payment-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-add-payment-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-add-payment-x', x + '%');
          card.style.setProperty('--rsp-add-payment-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspAddPaymentMethodPage);
    } else {
      initRspAddPaymentMethodPage();
    }
  })();
</script>