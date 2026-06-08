<?php

/**
 * Cart Page
 *
 * File: woocommerce/cart/cart.php
 *
 * ReviewService.Pro custom WooCommerce cart page.
 *
 * Purpose:
 * - Premium service cart UI for one-time ORM packages and platform checks.
 * - Preserve WooCommerce cart hooks, coupon, quantity update, remove item, and totals.
 * - Keep spacious layout, clean cards, and client-service focused wording.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');

$checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
$pricing_url  = home_url('/pricing/');
$support_url  = home_url('/contact/?type=cart-support');
?>

<style>
  .rsp-cart-page {
    color: #ffffff;
  }

  .rsp-cart-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-cart-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-cart-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-cart-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-cart-x, 50%) var(--rsp-cart-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-cart-x, 50%) var(--rsp-cart-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-cart-card:hover::before {
    opacity: 1;
  }

  .rsp-cart-beam {
    animation: rspCartBeam 8s ease-in-out infinite;
  }

  @keyframes rspCartBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-cart-page input.input-text,
  .rsp-cart-page input[type="text"],
  .rsp-cart-page input[type="number"] {
    min-height: 52px;
    width: 100%;
    border: 1px solid rgba(148, 163, 184, 0.42);
    border-radius: 14px;
    background: #ffffff;
    color: #020617;
    padding: 12px 16px;
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

  .rsp-cart-page input.input-text:focus,
  .rsp-cart-page input[type="text"]:focus,
  .rsp-cart-page input[type="number"]:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-cart-page .quantity {
    width: 100%;
  }

  .rsp-cart-page .qty {
    max-width: 110px;
    text-align: center;
  }

  .rsp-cart-page .cart_totals {
    float: none !important;
    width: 100% !important;
  }

  .rsp-cart-page .cart_totals h2 {
    margin: 0 0 24px;
    color: #ffffff;
    font-size: 32px;
    font-weight: 600;
    line-height: 1.15;
    letter-spacing: -0.05em;
  }

  .rsp-cart-page .cart_totals table {
    width: 100%;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.035);
  }

  .rsp-cart-page .cart_totals table th,
  .rsp-cart-page .cart_totals table td {
    padding: 18px;
    border-color: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    font-size: 15px;
    line-height: 1.6;
    vertical-align: top;
  }

  .rsp-cart-page .cart_totals table th {
    color: rgb(203 213 225);
    font-weight: 500;
  }

  .rsp-cart-page .cart_totals table td {
    text-align: right;
    font-weight: 600;
  }

  .rsp-cart-page .cart_totals .wc-proceed-to-checkout {
    padding: 24px 0 0;
  }

  .rsp-cart-page .cart_totals .checkout-button {
    display: inline-flex;
    min-height: 58px;
    width: 100%;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: #2563EB;
    padding: 16px 24px;
    color: #ffffff;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.2;
    text-decoration: none;
    box-shadow: 0 18px 45px rgba(37, 99, 235, 0.28);
    transition: all 220ms ease;
  }

  .rsp-cart-page .cart_totals .checkout-button:hover {
    transform: translateY(-1px);
    background: #1D4ED8;
    color: #ffffff;
  }

  .rsp-cart-page .woocommerce-shipping-destination,
  .rsp-cart-page .woocommerce-shipping-calculator,
  .rsp-cart-page .woocommerce-shipping-methods {
    color: rgb(203 213 225);
    font-size: 14px;
    line-height: 1.7;
  }

  .rsp-cart-page a {
    color: #60A5FA;
    text-decoration: none;
  }

  .rsp-cart-page a:hover {
    color: #93C5FD;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-cart-reveal,
    .rsp-cart-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-cart-page relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-cart-card rsp-cart-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-cart-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-cart-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="shopping-cart" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Service Cart', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Review your selected reputation services.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Confirm your selected one-time ORM packages, platform checks, or reputation service add-ons before moving to secure checkout.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($checkout_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Go to Checkout', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Add More Services', 'reviewservicepro'); ?>
            <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Guidance Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-cart-card rsp-cart-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-cart-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="receipt-text" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Service order review', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Check package names, quantities, and pricing before continuing to checkout.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-cart-card rsp-cart-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-cart-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="layout-dashboard" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Client portal after payment', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('After checkout, your order and onboarding guidance will be available inside your client portal.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-cart-card rsp-cart-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-cart-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="shield-alert" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Ethical ORM scope', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('No fake reviews, paid incentives, rating manipulation, guaranteed removals, or ranking guarantees.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <form class="woocommerce-cart-form mt-8" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

      <?php do_action('woocommerce_before_cart_table'); ?>

      <section class="grid grid-cols-1 gap-8 xl:grid-cols-[1.15fr_0.85fr] xl:items-start">

        <!-- Cart Items -->
        <article class="rsp-cart-card rsp-cart-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-cart-card>
          <div class="relative z-10">
            <div class="mb-8">
              <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
                <i data-lucide="package-check" class="h-6 w-6" aria-hidden="true"></i>
              </span>

              <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
                <?php esc_html_e('Selected services', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
                <?php esc_html_e('These are the service items currently in your cart.', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="space-y-5">
              <?php do_action('woocommerce_before_cart_contents'); ?>

              <?php
              foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                if (! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 || ! apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                  continue;
                }

                $product_permalink = apply_filters(
                  'woocommerce_cart_item_permalink',
                  $_product->is_visible() ? $_product->get_permalink($cart_item) : '',
                  $cart_item,
                  $cart_item_key
                );

                $product_name = apply_filters(
                  'woocommerce_cart_item_name',
                  $_product->get_name(),
                  $cart_item,
                  $cart_item_key
                );

                $thumbnail = apply_filters(
                  'woocommerce_cart_item_thumbnail',
                  $_product->get_image('woocommerce_thumbnail'),
                  $cart_item,
                  $cart_item_key
                );

                $product_price = apply_filters(
                  'woocommerce_cart_item_price',
                  WC()->cart->get_product_price($_product),
                  $cart_item,
                  $cart_item_key
                );

                $product_subtotal = apply_filters(
                  'woocommerce_cart_item_subtotal',
                  WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
                  $cart_item,
                  $cart_item_key
                );

                $platform_scope = get_post_meta($product_id, '_rsp_platform_scope', true);
                $service_timeline = get_post_meta($product_id, '_rsp_service_timeline', true);
                $best_for = get_post_meta($product_id, '_rsp_best_for', true);
              ?>

                <article class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> rounded-[1.5rem] border border-white/[0.08] bg-white/[0.035] p-5 md:p-6">

                  <div class="grid grid-cols-1 gap-6 lg:grid-cols-[96px_1fr] lg:items-start">

                    <div class="overflow-hidden rounded-2xl border border-white/[0.08] bg-white">
                      <?php if (! $product_permalink) : ?>
                        <?php echo wp_kses_post($thumbnail); ?>
                      <?php else : ?>
                        <a href="<?php echo esc_url($product_permalink); ?>">
                          <?php echo wp_kses_post($thumbnail); ?>
                        </a>
                      <?php endif; ?>
                    </div>

                    <div class="min-w-0">
                      <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="min-w-0">
                          <h3 class="text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
                            <?php if (! $product_permalink) : ?>
                              <?php echo wp_kses_post($product_name); ?>
                            <?php else : ?>
                              <a href="<?php echo esc_url($product_permalink); ?>" class="transition-colors duration-200 hover:text-blue-300">
                                <?php echo wp_kses_post($product_name); ?>
                              </a>
                            <?php endif; ?>
                          </h3>

                          <?php if ($best_for) : ?>
                            <p class="mt-3 max-w-2xl text-sm font-normal leading-7 text-slate-300">
                              <?php echo esc_html($best_for); ?>
                            </p>
                          <?php endif; ?>

                          <div class="mt-4 flex flex-wrap gap-2">
                            <?php if ($platform_scope) : ?>
                              <span class="rounded-full border border-[#00C853]/20 bg-[#00C853]/10 px-3 py-1 text-xs font-medium text-[#6DFFB0]">
                                <?php echo esc_html($platform_scope); ?>
                              </span>
                            <?php endif; ?>

                            <?php if ($service_timeline) : ?>
                              <span class="rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1 text-xs font-medium text-blue-200">
                                <?php echo esc_html($service_timeline); ?>
                              </span>
                            <?php endif; ?>
                          </div>

                          <div class="mt-4 text-sm font-normal leading-7 text-slate-400">
                            <?php
                            echo wc_get_formatted_cart_item_data($cart_item);
                            ?>
                          </div>
                        </div>

                        <div class="flex shrink-0">
                          <?php
                          echo apply_filters(
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                              '<a href="%s" class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-300/20 bg-red-400/10 px-4 py-2 text-sm font-medium text-red-100 transition-all duration-300 hover:-translate-y-0.5 hover:bg-red-400/15" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i data-lucide="trash-2" class="h-4 w-4" aria-hidden="true"></i>%s</a>',
                              esc_url(wc_get_cart_remove_url($cart_item_key)),
                              esc_attr(sprintf(__('Remove %s from cart', 'reviewservicepro'), wp_strip_all_tags($product_name))),
                              esc_attr($product_id),
                              esc_attr($_product->get_sku()),
                              esc_html__('Remove', 'reviewservicepro')
                            ),
                            $cart_item_key
                          );
                          ?>
                        </div>
                      </div>

                      <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">

                        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                          <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                            <?php esc_html_e('Price', 'reviewservicepro'); ?>
                          </p>

                          <p class="mt-2 text-base font-semibold text-white">
                            <?php echo wp_kses_post($product_price); ?>
                          </p>
                        </div>

                        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                          <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                            <?php esc_html_e('Quantity', 'reviewservicepro'); ?>
                          </p>

                          <div class="mt-2">
                            <?php
                            if ($_product->is_sold_individually()) {
                              $min_quantity = 1;
                              $max_quantity = 1;
                            } else {
                              $min_quantity = 0;
                              $max_quantity = $_product->get_max_purchase_quantity();
                            }

                            $product_quantity = woocommerce_quantity_input(
                              [
                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                'input_value'  => $cart_item['quantity'],
                                'max_value'    => $max_quantity,
                                'min_value'    => $min_quantity,
                                'product_name' => $product_name,
                              ],
                              $_product,
                              false
                            );

                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                            ?>
                          </div>
                        </div>

                        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
                          <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                            <?php esc_html_e('Subtotal', 'reviewservicepro'); ?>
                          </p>

                          <p class="mt-2 text-base font-semibold text-white">
                            <?php echo wp_kses_post($product_subtotal); ?>
                          </p>
                        </div>

                      </div>
                    </div>
                  </div>
                </article>
              <?php
              }
              ?>

              <?php do_action('woocommerce_cart_contents'); ?>
            </div>

            <!-- Coupon + Update -->
            <div class="mt-8 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.035] p-5 md:p-6">
              <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1fr_auto] lg:items-end">

                <?php if (wc_coupons_enabled()) : ?>
                  <div class="coupon">
                    <label for="coupon_code" class="mb-3 block text-sm font-medium text-white">
                      <?php esc_html_e('Coupon code', 'reviewservicepro'); ?>
                    </label>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-[1fr_auto]">
                      <input
                        type="text"
                        name="coupon_code"
                        class="input-text"
                        id="coupon_code"
                        value=""
                        placeholder="<?php esc_attr_e('Enter coupon code', 'reviewservicepro'); ?>">

                      <button
                        type="submit"
                        class="button inline-flex min-h-[52px] items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]"
                        name="apply_coupon"
                        value="<?php esc_attr_e('Apply coupon', 'reviewservicepro'); ?>">

                        <?php esc_html_e('Apply Coupon', 'reviewservicepro'); ?>
                        <i data-lucide="badge-percent" class="h-4 w-4" aria-hidden="true"></i>
                      </button>

                      <?php do_action('woocommerce_cart_coupon'); ?>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="cart-actions flex flex-col gap-3 sm:flex-row lg:justify-end">
                  <button
                    type="submit"
                    class="button inline-flex min-h-[52px] items-center justify-center gap-2 rounded-xl border border-blue-400/20 bg-blue-500/10 px-5 py-3 text-base font-medium text-blue-100 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-500/15"
                    name="update_cart"
                    value="<?php esc_attr_e('Update cart', 'reviewservicepro'); ?>">

                    <?php esc_html_e('Update Cart', 'reviewservicepro'); ?>
                    <i data-lucide="refresh-cw" class="h-4 w-4" aria-hidden="true"></i>
                  </button>

                  <a
                    href="<?php echo esc_url($pricing_url); ?>"
                    class="inline-flex min-h-[52px] items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

                    <?php esc_html_e('Continue Shopping', 'reviewservicepro'); ?>
                    <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
                  </a>
                </div>

              </div>

              <?php do_action('woocommerce_cart_actions'); ?>

              <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
            </div>

            <?php do_action('woocommerce_after_cart_contents'); ?>
          </div>
        </article>

        <!-- Cart Totals -->
        <aside class="rsp-cart-card rsp-cart-reveal rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10 xl:sticky xl:top-28" data-rsp-cart-card style="transition-delay: 90ms;">
          <div class="relative z-10">
            <div class="mb-8">
              <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
                <i data-lucide="wallet-cards" class="h-6 w-6" aria-hidden="true"></i>
              </span>

              <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
                <?php esc_html_e('Service order summary', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-3 text-base font-normal leading-8 text-slate-300">
                <?php esc_html_e('Review your total before secure checkout. Onboarding details are collected after payment when needed.', 'reviewservicepro'); ?>
              </p>
            </div>

            <?php do_action('woocommerce_before_cart_collaterals'); ?>

            <div class="cart-collaterals">
              <?php
              /**
               * Cart collaterals hook.
               *
               * @hooked woocommerce_cross_sell_display
               * @hooked woocommerce_cart_totals - 10
               */
              do_action('woocommerce_cart_collaterals');
              ?>
            </div>

            <div class="mt-8 rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-5">
              <div class="flex gap-3">
                <i data-lucide="shield-alert" class="mt-0.5 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

                <p class="text-sm font-normal leading-7 text-slate-300">
                  <?php esc_html_e('ReviewService.Pro provides ethical reputation management support only. We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed removals, guaranteed 5-star ratings, or ranking guarantees.', 'reviewservicepro'); ?>
                </p>
              </div>
            </div>

            <a
              href="<?php echo esc_url($support_url); ?>"
              class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

              <?php esc_html_e('Need Help Before Checkout?', 'reviewservicepro'); ?>
              <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </aside>

      </section>

      <?php do_action('woocommerce_after_cart_table'); ?>

    </form>

  </div>
</section>

<script>
  (function() {
    function initRspCartPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-cart-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-cart-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-cart-x', x + '%');
          card.style.setProperty('--rsp-cart-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspCartPage);
    } else {
      initRspCartPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_cart'); ?>