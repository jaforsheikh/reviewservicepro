<?php

/**
 * Cart totals
 *
 * Premium ReviewService.Pro cart totals template.
 *
 * This template preserves WooCommerce totals, shipping, fees, taxes,
 * checkout hooks, and payment flow while upgrading the UI for a
 * reputation management service ordering experience.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package ReviewServicePro\WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

$cart     = WC()->cart;
$customer = WC()->customer;

if (! $cart || ! $customer) {
  return;
}

$has_calculated_shipping = $customer->has_calculated_shipping();
$cart_item_count         = $cart->get_cart_contents_count();
$has_coupons             = count($cart->get_coupons()) > 0;
$needs_shipping          = $cart->needs_shipping();
$pricing_url             = home_url('/pricing/');
$services_url            = home_url('/services/');
$my_account_url          = wc_get_page_permalink('myaccount');
?>

<div class="cart_totals <?php echo esc_attr($has_calculated_shipping ? 'calculated_shipping' : ''); ?> rsp-cart-totals relative w-full">

  <?php do_action('woocommerce_before_cart_totals'); ?>

  <style>
    .rsp-cart-totals {
      color: #07111F;
    }

    .rsp-cart-totals .rsp-totals-card {
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(15, 23, 42, 0.10);
      box-shadow: 0 28px 80px rgba(7, 17, 31, 0.12);
    }

    .rsp-cart-totals .rsp-totals-card::before {
      content: "";
      position: absolute;
      inset: -1px;
      pointer-events: none;
      background:
        radial-gradient(circle at 18% 0%, rgba(0, 200, 83, 0.16), transparent 34%),
        radial-gradient(circle at 92% 8%, rgba(37, 99, 235, 0.16), transparent 32%),
        linear-gradient(135deg, rgba(255, 255, 255, 0.78), rgba(255, 255, 255, 0));
      opacity: 0.95;
    }

    .rsp-cart-totals .shop_table {
      position: relative;
      width: 100%;
      border: 0;
      border-collapse: separate;
      border-spacing: 0;
      margin: 0;
      background: transparent;
    }

    .rsp-cart-totals .shop_table tbody,
    .rsp-cart-totals .shop_table tr,
    .rsp-cart-totals .shop_table th,
    .rsp-cart-totals .shop_table td {
      border-color: rgba(15, 23, 42, 0.10);
    }

    .rsp-cart-totals .shop_table th,
    .rsp-cart-totals .shop_table td {
      padding: 18px 0;
      vertical-align: top;
      border-width: 0 0 1px 0;
      border-style: solid;
      background: transparent;
    }

    .rsp-cart-totals .shop_table th {
      width: 44%;
      padding-right: 20px;
      color: rgba(7, 17, 31, 0.72);
      font-size: 14px;
      font-weight: 700;
      line-height: 1.55;
      letter-spacing: -0.01em;
      text-align: left;
    }

    .rsp-cart-totals .shop_table td {
      color: #07111F;
      font-size: 15px;
      font-weight: 600;
      line-height: 1.6;
      text-align: right;
    }

    .rsp-cart-totals .shop_table td small,
    .rsp-cart-totals .shop_table th small {
      display: inline-block;
      margin-top: 4px;
      color: rgba(7, 17, 31, 0.56);
      font-size: 12px;
      font-weight: 500;
      line-height: 1.45;
    }

    .rsp-cart-totals .woocommerce-Price-amount {
      font-weight: 800;
      letter-spacing: -0.02em;
    }

    .rsp-cart-totals .cart-subtotal .woocommerce-Price-amount {
      color: #07111F;
    }

    .rsp-cart-totals .cart-discount th,
    .rsp-cart-totals .cart-discount td {
      color: #047857;
    }

    .rsp-cart-totals .cart-discount a,
    .rsp-cart-totals .woocommerce-remove-coupon {
      color: #2563EB;
      font-size: 12px;
      font-weight: 700;
      text-decoration: none;
    }

    .rsp-cart-totals .cart-discount a:hover,
    .rsp-cart-totals .woocommerce-remove-coupon:hover {
      color: #1D4ED8;
      text-decoration: underline;
    }

    .rsp-cart-totals .shipping td {
      text-align: right;
    }

    .rsp-cart-totals .woocommerce-shipping-methods {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .rsp-cart-totals .woocommerce-shipping-methods li {
      display: flex;
      align-items: flex-start;
      justify-content: flex-end;
      gap: 10px;
      margin: 0 0 10px;
      color: rgba(7, 17, 31, 0.72);
      font-size: 14px;
      font-weight: 500;
      line-height: 1.5;
    }

    .rsp-cart-totals .woocommerce-shipping-methods li:last-child {
      margin-bottom: 0;
    }

    .rsp-cart-totals .woocommerce-shipping-methods input[type="radio"] {
      margin-top: 4px;
      accent-color: #2563EB;
    }

    .rsp-cart-totals .woocommerce-shipping-destination,
    .rsp-cart-totals .woocommerce-shipping-calculator {
      margin-top: 12px;
      color: rgba(7, 17, 31, 0.58);
      font-size: 13px;
      font-weight: 500;
      line-height: 1.55;
    }

    .rsp-cart-totals .shipping-calculator-button {
      color: #2563EB;
      font-weight: 800;
      text-decoration: none;
    }

    .rsp-cart-totals .shipping-calculator-button:hover {
      color: #1D4ED8;
      text-decoration: underline;
    }

    .rsp-cart-totals .shipping-calculator-form {
      margin-top: 16px;
      padding: 16px;
      border: 1px solid rgba(15, 23, 42, 0.10);
      border-radius: 20px;
      background: rgba(248, 250, 252, 0.92);
      text-align: left;
    }

    .rsp-cart-totals .shipping-calculator-form p {
      margin-bottom: 12px;
    }

    .rsp-cart-totals .shipping-calculator-form p:last-child {
      margin-bottom: 0;
    }

    .rsp-cart-totals .shipping-calculator-form input,
    .rsp-cart-totals .shipping-calculator-form select,
    .rsp-cart-totals .shipping-calculator-form .select2-selection {
      min-height: 46px;
      width: 100%;
      border: 1px solid rgba(15, 23, 42, 0.14);
      border-radius: 14px;
      background: #ffffff;
      color: #07111F;
      font-size: 14px;
      font-weight: 500;
      outline: none;
    }

    .rsp-cart-totals .shipping-calculator-form input,
    .rsp-cart-totals .shipping-calculator-form select {
      padding: 10px 14px;
    }

    .rsp-cart-totals .shipping-calculator-form input:focus,
    .rsp-cart-totals .shipping-calculator-form select:focus,
    .rsp-cart-totals .shipping-calculator-form .select2-selection:focus {
      border-color: rgba(37, 99, 235, 0.55);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }

    .rsp-cart-totals .shipping-calculator-form .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 46px;
      width: 100%;
      border: 0;
      border-radius: 14px;
      background: #07111F;
      color: #ffffff;
      font-size: 14px;
      font-weight: 800;
      line-height: 1;
      text-decoration: none;
      transition: transform 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
    }

    .rsp-cart-totals .shipping-calculator-form .button:hover {
      background: #0D0F12;
      box-shadow: 0 14px 34px rgba(7, 17, 31, 0.18);
      transform: translateY(-1px);
    }

    .rsp-cart-totals .fee th,
    .rsp-cart-totals .fee td,
    .rsp-cart-totals .tax-rate th,
    .rsp-cart-totals .tax-rate td,
    .rsp-cart-totals .tax-total th,
    .rsp-cart-totals .tax-total td {
      color: rgba(7, 17, 31, 0.78);
    }

    .rsp-cart-totals .order-total th,
    .rsp-cart-totals .order-total td {
      padding-top: 24px;
      padding-bottom: 4px;
      border-bottom: 0;
      color: #07111F;
      font-size: 17px;
      font-weight: 900;
    }

    .rsp-cart-totals .order-total .woocommerce-Price-amount {
      color: #07111F;
      font-size: clamp(24px, 3vw, 34px);
      font-weight: 950;
      letter-spacing: -0.045em;
    }

    .rsp-cart-totals .includes_tax {
      display: block;
      margin-top: 8px;
      color: rgba(7, 17, 31, 0.56);
      font-size: 12px;
      font-weight: 500;
      line-height: 1.5;
    }

    .rsp-cart-totals .wc-proceed-to-checkout {
      position: relative;
      margin-top: 28px;
      padding: 0;
    }

    .rsp-cart-totals .wc-proceed-to-checkout .checkout-button {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 58px;
      width: 100%;
      overflow: hidden;
      border: 0;
      border-radius: 20px;
      background: linear-gradient(135deg, #2563EB, #3B82F6);
      color: #ffffff;
      font-size: 16px;
      font-weight: 900;
      line-height: 1.1;
      letter-spacing: -0.01em;
      text-align: center;
      text-decoration: none;
      box-shadow: 0 20px 46px rgba(37, 99, 235, 0.28);
      transition: transform 180ms ease, box-shadow 180ms ease, filter 180ms ease;
    }

    .rsp-cart-totals .wc-proceed-to-checkout .checkout-button::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.24), transparent);
      transform: skewX(-18deg);
      transition: left 700ms ease;
    }

    .rsp-cart-totals .wc-proceed-to-checkout .checkout-button:hover {
      color: #ffffff;
      box-shadow: 0 26px 60px rgba(37, 99, 235, 0.36);
      filter: saturate(1.06);
      transform: translateY(-2px);
    }

    .rsp-cart-totals .wc-proceed-to-checkout .checkout-button:hover::before {
      left: 135%;
    }

    .rsp-cart-totals .wc-proceed-to-checkout .checkout-button:focus-visible {
      outline: 3px solid rgba(20, 184, 166, 0.38);
      outline-offset: 4px;
    }

    .rsp-cart-totals .checkout-button br {
      display: none;
    }

    @media (max-width: 640px) {

      .rsp-cart-totals .shop_table th,
      .rsp-cart-totals .shop_table td {
        display: block;
        width: 100%;
        padding: 12px 0;
        text-align: left;
      }

      .rsp-cart-totals .shop_table th {
        padding-bottom: 4px;
      }

      .rsp-cart-totals .shop_table td {
        padding-top: 0;
      }

      .rsp-cart-totals .shop_table td::before {
        display: none;
      }

      .rsp-cart-totals .woocommerce-shipping-methods li {
        justify-content: flex-start;
      }

      .rsp-cart-totals .order-total td {
        padding-top: 2px;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      .rsp-cart-totals *,
      .rsp-cart-totals *::before,
      .rsp-cart-totals *::after {
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
      }
    }
  </style>

  <section class="rsp-totals-card rounded-[2rem] bg-white p-6 sm:p-7 lg:p-8">

    <div class="relative z-10">
      <div class="mb-7 flex flex-col gap-5 border-b border-slate-200/80 pb-7 sm:flex-row sm:items-start sm:justify-between">
        <div class="max-w-xl">
          <p class="mb-3 inline-flex items-center gap-2 rounded-full border border-emerald-500/15 bg-emerald-50 px-3.5 py-2 text-xs font-extrabold uppercase tracking-[0.16em] text-emerald-700">
            <span class="h-2 w-2 rounded-full bg-[#00C853] shadow-[0_0_0_5px_rgba(0,200,83,0.12)]"></span>
            <?php esc_html_e('Secure service checkout', 'reviewservicepro'); ?>
          </p>

          <h2 class="m-0 text-2xl font-black tracking-[-0.04em] text-[#07111F] sm:text-3xl">
            <?php esc_html_e('Service order summary', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 max-w-md text-base font-normal leading-7 text-slate-600">
            <?php esc_html_e('Review your selected reputation management service before moving to the secure WooCommerce checkout.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-left sm:min-w-[160px] sm:text-right">
          <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">
            <?php esc_html_e('Selected items', 'reviewservicepro'); ?>
          </p>
          <p class="mt-1 text-3xl font-black tracking-[-0.05em] text-[#07111F]">
            <?php echo esc_html(number_format_i18n($cart_item_count)); ?>
          </p>
        </div>
      </div>

      <div class="mb-7 grid gap-3 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600/10 text-blue-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M12 3L4.5 6.2v5.6c0 4.7 3.2 7.8 7.5 9.2 4.3-1.4 7.5-4.5 7.5-9.2V6.2L12 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
              <path d="M9.5 12l1.7 1.7 3.6-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
          <p class="m-0 text-sm font-extrabold text-[#07111F]">
            <?php esc_html_e('Secure payment flow', 'reviewservicepro'); ?>
          </p>
          <p class="mt-1 text-sm font-normal leading-6 text-slate-600">
            <?php esc_html_e('Checkout, payment, and order records stay inside WooCommerce.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M8 11.5l2.5 2.5L16 8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2" />
            </svg>
          </div>
          <p class="m-0 text-sm font-extrabold text-[#07111F]">
            <?php esc_html_e('Ethical ORM scope', 'reviewservicepro'); ?>
          </p>
          <p class="mt-1 text-sm font-normal leading-6 text-slate-600">
            <?php esc_html_e('Work focuses on monitoring, documentation, and compliant support.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <div class="mb-3 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-teal-500/10 text-teal-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v13A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5v-13Z" stroke="currentColor" stroke-width="2" />
              <path d="M8 8h8M8 12h8M8 16h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </div>
          <p class="m-0 text-sm font-extrabold text-[#07111F]">
            <?php esc_html_e('Client portal access', 'reviewservicepro'); ?>
          </p>
          <p class="mt-1 text-sm font-normal leading-6 text-slate-600">
            <?php esc_html_e('After payment, order details appear in your account dashboard.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>

      <div class="rounded-[1.5rem] border border-slate-200 bg-white px-5 py-2 sm:px-6">
        <table cellspacing="0" class="shop_table shop_table_responsive">
          <tr class="cart-subtotal">
            <th><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
            <td data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
              <?php wc_cart_totals_subtotal_html(); ?>
            </td>
          </tr>

          <?php foreach ($cart->get_coupons() as $code => $coupon) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
              <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
              <td data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>">
                <?php wc_cart_totals_coupon_html($coupon); ?>
              </td>
            </tr>
          <?php endforeach; ?>

          <?php if ($needs_shipping && $cart->show_shipping()) : ?>

            <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

          <?php elseif ($needs_shipping && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

            <tr class="shipping">
              <th><?php esc_html_e('Shipping', 'woocommerce'); ?></th>
              <td data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>">
                <?php woocommerce_shipping_calculator(); ?>
              </td>
            </tr>

          <?php endif; ?>

          <?php foreach ($cart->get_fees() as $fee) : ?>
            <tr class="fee">
              <th><?php echo esc_html($fee->name); ?></th>
              <td data-title="<?php echo esc_attr($fee->name); ?>">
                <?php wc_cart_totals_fee_html($fee); ?>
              </td>
            </tr>
          <?php endforeach; ?>

          <?php
          if (wc_tax_enabled() && ! $cart->display_prices_including_tax()) {
            $taxable_address = $customer->get_taxable_address();
            $country_code     = isset($taxable_address[0]) ? $taxable_address[0] : '';
            $country_name     = ($country_code && isset(WC()->countries->countries[$country_code])) ? WC()->countries->countries[$country_code] : '';
            $estimated_text   = '';

            if ($customer->is_customer_outside_base() && ! $customer->has_calculated_shipping() && $country_name) {
              $estimated_text = sprintf(
                ' <small>%s</small>',
                sprintf(
                  /* translators: %s location. */
                  esc_html__('(estimated for %s)', 'woocommerce'),
                  esc_html(WC()->countries->estimated_for_prefix($country_code) . $country_name)
                )
              );
            }

            if ('itemized' === get_option('woocommerce_tax_total_display')) {
              foreach ($cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
          ?>
                <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                  <th>
                    <?php
                    echo esc_html($tax->label);
                    echo wp_kses(
                      $estimated_text,
                      array(
                        'small' => array(),
                      )
                    );
                    ?>
                  </th>
                  <td data-title="<?php echo esc_attr($tax->label); ?>">
                    <?php echo wp_kses_post($tax->formatted_amount); ?>
                  </td>
                </tr>
              <?php
              }
            } else {
              ?>
              <tr class="tax-total">
                <th>
                  <?php
                  echo esc_html(WC()->countries->tax_or_vat());
                  echo wp_kses(
                    $estimated_text,
                    array(
                      'small' => array(),
                    )
                  );
                  ?>
                </th>
                <td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>">
                  <?php wc_cart_totals_taxes_total_html(); ?>
                </td>
              </tr>
          <?php
            }
          }
          ?>

          <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

          <tr class="order-total">
            <th><?php esc_html_e('Total', 'woocommerce'); ?></th>
            <td data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
              <?php wc_cart_totals_order_total_html(); ?>
            </td>
          </tr>

          <?php do_action('woocommerce_cart_totals_after_order_total'); ?>
        </table>
      </div>

      <div class="wc-proceed-to-checkout">
        <?php do_action('woocommerce_proceed_to_checkout'); ?>
      </div>

      <div class="mt-5 rounded-2xl border border-amber-300/50 bg-amber-50 px-5 py-4">
        <div class="flex gap-3">
          <div class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M12 9v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <path d="M12 17h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
              <path d="M10.3 4.3 2.8 17.5A2 2 0 0 0 4.5 20.5h15a2 2 0 0 0 1.7-3L13.7 4.3a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
            </svg>
          </div>

          <div>
            <p class="m-0 text-sm font-extrabold text-amber-900">
              <?php esc_html_e('Ethical service reminder', 'reviewservicepro'); ?>
            </p>
            <p class="mt-1 text-sm font-normal leading-6 text-amber-900/80">
              <?php esc_html_e('ReviewService.Pro does not offer fake reviews, paid review incentives, guaranteed review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>
      </div>

      <div class="mt-5 grid gap-3 sm:grid-cols-2">
        <a href="<?php echo esc_url($pricing_url); ?>" class="group inline-flex min-h-[52px] items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-extrabold text-[#07111F] no-underline shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:text-blue-700 hover:shadow-lg">
          <?php esc_html_e('Continue choosing services', 'reviewservicepro'); ?>
        </a>

        <a href="<?php echo esc_url($my_account_url ? $my_account_url : $services_url); ?>" class="group inline-flex min-h-[52px] items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-center text-sm font-extrabold text-slate-700 no-underline transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
          <?php esc_html_e('View client portal', 'reviewservicepro'); ?>
        </a>
      </div>

      <?php if ($has_coupons) : ?>
        <p class="mt-5 text-center text-sm font-normal leading-6 text-slate-500">
          <?php esc_html_e('Discounts are shown above and will remain applied during checkout unless removed.', 'reviewservicepro'); ?>
        </p>
      <?php endif; ?>
    </div>
  </section>

  <?php do_action('woocommerce_after_cart_totals'); ?>

</div>