<?php

/**
 * Checkout Form
 *
 * File: woocommerce/checkout/form-checkout.php
 *
 * ReviewService.Pro — Professional two-column WooCommerce checkout.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
  echo esc_html(
    apply_filters(
      'woocommerce_checkout_must_be_logged_in_message',
      __('You must be logged in to checkout.', 'woocommerce')
    )
  );

  return;
}

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<style>
  /* ─── Shell container ─────────────────────────────────── */
  .rsp-checkout-shell {
    --rsp-checkout-title: #334155;
    --rsp-checkout-heading: #3B4658;
    --rsp-checkout-body: #64748B;
    --rsp-checkout-blue: #2563EB;
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 32px 48px 80px;
    color: #334155;
  }

  .rsp-checkout-shell,
  .rsp-checkout-shell p,
  .rsp-checkout-shell label,
  .rsp-checkout-shell input,
  .rsp-checkout-shell textarea,
  .rsp-checkout-shell select,
  .rsp-checkout-shell button {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  .rsp-checkout-shell h2,
  .rsp-checkout-shell h3,
  .rsp-checkout-shell h4,
  .rsp-checkout-shell legend,
  .rsp-checkout-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-checkout-heading);
  }

  .rsp-checkout-shell *,
  .rsp-checkout-shell *::before,
  .rsp-checkout-shell *::after {
    box-sizing: border-box;
  }

  /* ─── Notices area (full-width above grid) ─────────────── */
  .rsp-checkout-notices {
    width: 100%;
    margin-bottom: 24px;
  }

  /* Override WooCommerce notice styles that break layout */
  .rsp-checkout-shell .woocommerce-NoticeGroup,
  .rsp-checkout-shell .woocommerce-NoticeGroup-checkout,
  .rsp-checkout-shell .woocommerce-notices-wrapper {
    width: 100% !important;
    float: none !important;
    max-width: none !important;
    margin: 0 0 24px !important;
    padding: 0 !important;
  }

  /* ─── Trust badge grid ─────────────────────────────────── */
  .rsp-checkout-trust-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 28px;
  }

  /* ─── Main two-column grid ─────────────────────────────── */
  .rsp-checkout-grid {
    display: grid !important;
    grid-template-columns: 1fr 400px !important;
    gap: 28px !important;
    align-items: start !important;
    width: 100% !important;
    float: none !important;
  }

  .rsp-checkout-main,
  .rsp-checkout-sidebar {
    min-width: 0;
    width: 100%;
  }

  .rsp-checkout-sidebar {
    position: sticky;
    top: calc(var(--rsp-header-height, 78px) + 24px);
  }

  /* ─── Card wrapper ─────────────────────────────────────── */
  .rsp-checkout-card {
    border: 1px solid #E2E8F0;
    border-radius: 24px;
    background: #FFFFFF;
    box-shadow: 0 18px 60px rgba(15, 23, 42, 0.07);
    overflow: hidden;
  }

  /* ─── WooCommerce customer_details floats reset ────────── */
  .rsp-checkout-shell #customer_details,
  .rsp-checkout-shell #customer_details .col-1,
  .rsp-checkout-shell #customer_details .col-2 {
    float: none !important;
    display: block !important;
    width: 100% !important;
    max-width: none !important;
    min-width: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  .rsp-checkout-shell #customer_details::before,
  .rsp-checkout-shell #customer_details::after,
  .rsp-checkout-shell #customer_details .col-1::before,
  .rsp-checkout-shell #customer_details .col-1::after,
  .rsp-checkout-shell #customer_details .col-2::before,
  .rsp-checkout-shell #customer_details .col-2::after {
    content: "";
    display: table;
    clear: both;
  }

  /* ─── Billing/shipping field wrappers ──────────────────── */
  .rsp-checkout-shell .woocommerce-billing-fields>h3 {
    display: none;
  }

  .rsp-checkout-shell .woocommerce-additional-fields>h3,
  .rsp-checkout-shell .woocommerce-shipping-fields>h3 {
    margin: 26px 0 16px;
    padding-top: 24px;
    border-top: 1px solid #E2E8F0;
    font-size: 22px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: var(--rsp-checkout-heading);
  }

  .rsp-checkout-shell .woocommerce-billing-fields__field-wrapper {
    display: grid !important;
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    column-gap: 18px !important;
    row-gap: 0 !important;
  }

  /* ─── Form rows ────────────────────────────────────────── */
  .rsp-checkout-shell .form-row {
    float: none !important;
    width: 100% !important;
    margin: 0 0 18px !important;
    padding: 0 !important;
  }

  .rsp-checkout-shell .form-row-first,
  .rsp-checkout-shell .form-row-last {
    float: none !important;
    width: 100% !important;
  }

  /* Wide fields span both columns */
  .rsp-checkout-shell .form-row-wide,
  .rsp-checkout-shell #billing_company_field,
  .rsp-checkout-shell #billing_country_field,
  .rsp-checkout-shell #billing_address_1_field,
  .rsp-checkout-shell #billing_address_2_field,
  .rsp-checkout-shell #billing_city_field,
  .rsp-checkout-shell #billing_phone_field,
  .rsp-checkout-shell #billing_email_field,
  .rsp-checkout-shell #order_comments_field {
    grid-column: 1 / -1 !important;
  }

  /* ─── Labels ───────────────────────────────────────────── */
  .rsp-checkout-shell .form-row label {
    display: block;
    margin: 0 0 7px;
    color: var(--rsp-checkout-heading);
    font-size: 13px;
    font-weight: 700;
    line-height: 1.35;
  }

  .rsp-checkout-shell .required {
    color: #EF4444;
    text-decoration: none;
  }

  /* ─── Inputs ───────────────────────────────────────────── */
  .rsp-checkout-shell input.input-text,
  .rsp-checkout-shell textarea,
  .rsp-checkout-shell select,
  .rsp-checkout-shell .select2-container--default .select2-selection--single {
    width: 100% !important;
    min-height: 50px;
    border: 1px solid #D8E0EA;
    border-radius: 14px;
    background: #FFFFFF;
    padding: 12px 16px;
    color: #334155;
    font-size: 15px;
    font-weight: 400;
    box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    transition: border-color 200ms ease, box-shadow 200ms ease;
    appearance: none;
    -webkit-appearance: none;
  }

  .rsp-checkout-shell textarea {
    min-height: 110px;
    resize: vertical;
  }

  .rsp-checkout-shell input.input-text:focus,
  .rsp-checkout-shell textarea:focus,
  .rsp-checkout-shell select:focus,
  .rsp-checkout-shell .select2-container--default.select2-container--focus .select2-selection--single {
    outline: none;
    border-color: rgba(37, 99, 235, 0.50);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.09), 0 8px 22px rgba(15, 23, 42, 0.05);
  }

  /* ─── Select2 ──────────────────────────────────────────── */
  .rsp-checkout-shell .select2-container {
    width: 100% !important;
  }

  .rsp-checkout-shell .select2-container--default .select2-selection--single {
    display: flex;
    align-items: center;
    padding: 0 40px 0 16px;
    height: 50px;
  }

  .rsp-checkout-shell .select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    color: #334155;
    line-height: 50px;
    font-size: 15px;
  }

  .rsp-checkout-shell .select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 12px;
    right: 14px;
  }

  /* Select2 dropdown open */
  .select2-dropdown {
    border: 1px solid #D8E0EA;
    border-radius: 14px;
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
    overflow: hidden;
  }

  .select2-results__option {
    padding: 10px 16px;
    font-size: 14px;
    font-family: "Inter", system-ui, sans-serif;
    color: #334155;
  }

  .select2-results__option--highlighted {
    background: #EFF6FF !important;
    color: #2563EB !important;
  }

  /* ─── Validation states ────────────────────────────────── */
  .rsp-checkout-shell .woocommerce-invalid input.input-text,
  .rsp-checkout-shell .woocommerce-invalid select,
  .rsp-checkout-shell .woocommerce-invalid .select2-selection--single {
    border-color: #FCA5A5 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.08) !important;
  }

  .rsp-checkout-shell .woocommerce-validated input.input-text,
  .rsp-checkout-shell .woocommerce-validated select {
    border-color: #6EE7B7 !important;
    background-color: #FFFFFF !important;
  }

  /* ─── Order table in sidebar ───────────────────────────── */
  .rsp-checkout-shell table.shop_table {
    width: 100%;
    margin: 0;
    border: 1px solid #E2E8F0;
    border-radius: 16px;
    overflow: hidden;
    border-collapse: separate;
    border-spacing: 0;
    background: #FFFFFF;
  }

  .rsp-checkout-shell table.shop_table th,
  .rsp-checkout-shell table.shop_table td {
    border: 0;
    border-bottom: 1px solid #F1F5F9;
    padding: 14px 16px;
    color: #475569;
    font-size: 14px;
    line-height: 1.55;
    vertical-align: middle;
  }

  .rsp-checkout-shell table.shop_table tr:last-child th,
  .rsp-checkout-shell table.shop_table tr:last-child td {
    border-bottom: 0;
  }

  .rsp-checkout-shell table.shop_table thead th {
    background: #F8FAFC;
    color: #334155;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    padding: 12px 16px;
  }

  .rsp-checkout-shell table.shop_table .amount,
  .rsp-checkout-shell table.shop_table .order-total th,
  .rsp-checkout-shell table.shop_table .order-total td {
    color: #0F172A;
    font-weight: 800;
  }

  .rsp-checkout-shell table.shop_table .order-total th,
  .rsp-checkout-shell table.shop_table .order-total td {
    font-size: 16px;
    border-top: 1px solid #E2E8F0;
    background: #F8FAFC;
  }

  .rsp-checkout-shell table.shop_table .cart-subtotal td {
    color: #475569;
    font-weight: 600;
  }

  /* ─── Payment section ──────────────────────────────────── */
  .rsp-checkout-shell #payment {
    margin-top: 16px;
    border: 1px solid #E2E8F0;
    border-radius: 20px;
    background: #F8FAFC;
    overflow: hidden;
  }

  .rsp-checkout-shell #payment ul.payment_methods {
    margin: 0;
    padding: 14px;
    border: 0;
    list-style: none;
  }

  .rsp-checkout-shell #payment ul.payment_methods li {
    list-style: none;
    margin: 0 0 10px;
    padding: 14px 16px;
    border: 1.5px solid #E2E8F0;
    border-radius: 14px;
    background: #FFFFFF;
    color: #334155;
    transition: border-color 200ms ease;
  }

  .rsp-checkout-shell #payment ul.payment_methods li:last-child {
    margin-bottom: 0;
  }

  .rsp-checkout-shell #payment ul.payment_methods li:has(input:checked) {
    border-color: rgba(37, 99, 235, 0.45);
    background: #EFF6FF;
  }

  .rsp-checkout-shell #payment div.payment_box {
    margin: 10px 0 0;
    padding: 12px 14px;
    border: 1px solid #DBEAFE;
    border-radius: 12px;
    background: #F0F7FF;
    color: #475569;
    font-size: 13px;
    line-height: 1.7;
  }

  .rsp-checkout-shell #payment .form-row.place-order {
    margin: 0 !important;
    padding: 16px !important;
    border-top: 1px solid #E2E8F0;
    background: #FFFFFF;
  }

  .rsp-checkout-shell .woocommerce-privacy-policy-text {
    margin-bottom: 14px;
    color: #64748B;
    font-size: 13px;
    line-height: 1.7;
  }

  /* ─── Place order button ───────────────────────────────── */
  .rsp-checkout-shell #place_order,
  .rsp-checkout-shell .button.alt {
    width: 100%;
    min-height: 52px;
    border: 0;
    border-radius: 16px;
    background: #2563EB;
    padding: 14px 20px;
    color: #FFFFFF !important;
    font-size: 15px;
    font-weight: 800;
    letter-spacing: -0.01em;
    box-shadow: 0 14px 32px rgba(37, 99, 235, 0.22);
    cursor: pointer;
    transition: transform 220ms ease, background-color 220ms ease, box-shadow 220ms ease;
  }

  .rsp-checkout-shell #place_order:hover,
  .rsp-checkout-shell .button.alt:hover {
    transform: translateY(-2px);
    background: #1D4ED8;
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.30);
  }

  /* ─── Responsive ───────────────────────────────────────── */
  @media (max-width: 1080px) {
    .rsp-checkout-grid {
      grid-template-columns: 1fr !important;
    }

    .rsp-checkout-sidebar {
      position: static;
    }
  }

  @media (max-width: 640px) {
    .rsp-checkout-shell {
      padding: 0 16px 48px;
    }

    .rsp-checkout-trust-grid,
    .rsp-checkout-shell .woocommerce-billing-fields__field-wrapper {
      grid-template-columns: 1fr !important;
    }

    .rsp-checkout-card {
      border-radius: 20px;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-checkout-shell *,
    .rsp-checkout-shell *::before,
    .rsp-checkout-shell *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
    }
  }
</style>

<div class="rsp-checkout-shell">

  <?php
  /**
   * Notices rendered INSIDE the shell so they respect max-width + padding.
   * We call the hook here instead of before the shell opens.
   */
  do_action('woocommerce_before_checkout_form', $checkout);
  ?>

  <?php /* ── Trust badges ── */ ?>
  <div class="rsp-checkout-trust-grid">
    <article class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
      <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-emerald-200 bg-white text-emerald-600 shadow-sm">
        <?php echo $render_icon('shield-check', 'h-5 w-5'); ?>
      </div>
      <h2 class="rsp-checkout-heading text-[17px] font-[700] leading-tight tracking-[-0.025em]">
        <?php esc_html_e('Secure checkout', 'reviewservicepro'); ?>
      </h2>
      <p class="mt-2 text-[13px] font-medium leading-6 text-[#64748B]">
        <?php esc_html_e('Your service order is processed safely through WooCommerce.', 'reviewservicepro'); ?>
      </p>
    </article>

    <article class="rounded-2xl border border-blue-200 bg-blue-50 p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
      <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
        <?php echo $render_icon('layout-dashboard', 'h-5 w-5'); ?>
      </div>
      <h2 class="rsp-checkout-heading text-[17px] font-[700] leading-tight tracking-[-0.025em]">
        <?php esc_html_e('Client portal next', 'reviewservicepro'); ?>
      </h2>
      <p class="mt-2 text-[13px] font-medium leading-6 text-[#64748B]">
        <?php esc_html_e('Order details and onboarding continue after checkout.', 'reviewservicepro'); ?>
      </p>
    </article>

    <article class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-[0_10px_28px_rgba(15,23,42,0.05)]">
      <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-amber-200 bg-white text-amber-600 shadow-sm">
        <?php echo $render_icon('badge-check', 'h-5 w-5'); ?>
      </div>
      <h2 class="rsp-checkout-heading text-[17px] font-[700] leading-tight tracking-[-0.025em]">
        <?php esc_html_e('Ethical ORM only', 'reviewservicepro'); ?>
      </h2>
      <p class="mt-2 text-[13px] font-medium leading-6 text-[#64748B]">
        <?php esc_html_e('No fake reviews, manipulation, or guaranteed outcomes.', 'reviewservicepro'); ?>
      </p>
    </article>
  </div>

  <?php /* ── Checkout form grid ── */ ?>
  <form
    name="checkout"
    method="post"
    class="checkout woocommerce-checkout rsp-checkout-grid"
    action="<?php echo esc_url(wc_get_checkout_url()); ?>"
    enctype="multipart/form-data"
    aria-label="<?php echo esc_attr__('Checkout', 'reviewservicepro'); ?>">

    <?php /* ── Left: billing details ── */ ?>
    <div class="rsp-checkout-main">
      <?php if ($checkout->get_checkout_fields()) : ?>
        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

        <section
          id="customer_details"
          class="rsp-checkout-card"
          aria-labelledby="rsp-checkout-billing-title">

          <?php /* Card header */ ?>
          <div class="flex flex-col gap-3 border-b border-slate-100 px-7 py-6 sm:flex-row sm:items-start sm:justify-between">
            <div>
              <span class="font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.14em] text-blue-700">
                <?php esc_html_e('Billing details', 'reviewservicepro'); ?>
              </span>

              <h2 id="rsp-checkout-billing-title" class="rsp-checkout-heading mt-2 text-[26px] font-[700] leading-[1.12] tracking-[-0.03em]">
                <?php esc_html_e('Confirm your service order details.', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-2 max-w-xl text-[14px] font-medium leading-7 text-[#64748B]">
                <?php esc_html_e('Checkout stays simple. Service-specific business links, screenshots, and onboarding details can be submitted after the order is placed.', 'reviewservicepro'); ?>
              </p>
            </div>

            <span class="inline-flex shrink-0 items-center gap-2 self-start rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-[13px] font-[700] text-emerald-700">
              <?php echo $render_icon('lock-keyhole', 'h-3.5 w-3.5'); ?>
              <?php esc_html_e('Private & secure', 'reviewservicepro'); ?>
            </span>
          </div>

          <?php /* Card body — fields */ ?>
          <div class="px-7 py-6">
            <?php do_action('woocommerce_checkout_billing'); ?>
            <?php do_action('woocommerce_checkout_shipping'); ?>
          </div>
        </section>

        <?php do_action('woocommerce_checkout_after_customer_details'); ?>
      <?php endif; ?>
    </div>

    <?php /* ── Right: order summary + payment ── */ ?>
    <aside
      class="rsp-checkout-sidebar"
      aria-label="<?php echo esc_attr__('Order summary and payment', 'reviewservicepro'); ?>">

      <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

      <section class="rsp-checkout-card">
        <?php /* Summary header */ ?>
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
          <div>
            <span class="font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.14em] text-blue-700">
              <?php esc_html_e('Order summary', 'reviewservicepro'); ?>
            </span>

            <h3 id="order_review_heading" class="mt-2 font-['Poppins',sans-serif] text-[22px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
              <?php esc_html_e('Your order', 'woocommerce'); ?>
            </h3>
          </div>

          <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-600">
            <?php echo $render_icon('receipt-text', 'h-5 w-5'); ?>
          </span>
        </div>

        <?php /* Order table + payment */ ?>
        <div class="px-1 pb-1">
          <?php do_action('woocommerce_checkout_before_order_review'); ?>

          <div id="order_review" class="woocommerce-checkout-review-order">
            <?php do_action('woocommerce_checkout_order_review'); ?>
          </div>

          <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
      </section>

      <div class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-center">
        <p class="text-[13px] font-[700] leading-6 text-emerald-800">
          <?php esc_html_e('After checkout, your order details and service next steps are available through the client portal.', 'reviewservicepro'); ?>
        </p>
      </div>
    </aside>

  </form>
</div>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>