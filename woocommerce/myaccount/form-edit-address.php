<?php

/**
 * Edit address form
 *
 * File: woocommerce/myaccount/form-edit-address.php
 *
 * ReviewService.Pro custom WooCommerce edit address form.
 *
 * Purpose:
 * - Premium billing/shipping address edit UI inside client portal.
 * - Preserve WooCommerce address fields, validation, nonce, hooks, and save action.
 * - Keep strong spacing, field height, negative space, and responsive layout.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$page_title = ('billing' === $load_address)
  ? esc_html__('Billing address', 'reviewservicepro')
  : esc_html__('Shipping address', 'reviewservicepro');

$page_title = apply_filters('woocommerce_my_account_edit_address_title', $page_title, $load_address);

$dashboard_url = function_exists('wc_get_page_permalink')
  ? wc_get_page_permalink('myaccount')
  : home_url('/my-account/');

$address_overview_url = function_exists('wc_get_account_endpoint_url')
  ? wc_get_account_endpoint_url('edit-address')
  : home_url('/my-account/edit-address/');

$support_url = home_url('/contact/?type=account-support');

do_action('woocommerce_before_edit_account_address_form');

if (! $load_address) {
  wc_get_template('myaccount/my-address.php');
  do_action('woocommerce_after_edit_account_address_form');
  return;
}

$address_icon = 'billing' === $load_address ? 'wallet-cards' : 'truck';
$address_note = 'billing' === $load_address
  ? esc_html__('Your billing address is used for invoices, order records, payment confirmation, and account-related service communication.', 'reviewservicepro')
  : esc_html__('Your shipping address is only used when a service or order requires shipping-related details.', 'reviewservicepro');
?>

<style>
  .rsp-edit-address {
    color: #ffffff;
  }

  .rsp-edit-address-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-edit-address-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-edit-address-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-edit-address-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-address-edit-x, 50%) var(--rsp-address-edit-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-address-edit-x, 50%) var(--rsp-address-edit-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-edit-address-card:hover::before {
    opacity: 1;
  }

  .rsp-edit-address-beam {
    animation: rspEditAddressBeam 8s ease-in-out infinite;
  }

  @keyframes rspEditAddressBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-edit-address .woocommerce-address-fields {
    position: relative;
    z-index: 10;
  }

  .rsp-edit-address .woocommerce-address-fields__field-wrapper {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .rsp-edit-address .form-row {
    margin: 0 !important;
    padding: 0 !important;
  }

  .rsp-edit-address .form-row-first,
  .rsp-edit-address .form-row-last {
    float: none !important;
    width: 100% !important;
  }

  .rsp-edit-address label {
    display: block;
    margin-bottom: 9px;
    color: #ffffff;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.45;
  }

  .rsp-edit-address .required {
    color: #EF4444;
    text-decoration: none;
  }

  .rsp-edit-address input.input-text,
  .rsp-edit-address textarea,
  .rsp-edit-address select,
  .rsp-edit-address .select2-container--default .select2-selection--single {
    min-height: 56px;
    width: 100% !important;
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

  .rsp-edit-address textarea {
    min-height: 140px;
    resize: vertical;
  }

  .rsp-edit-address input.input-text:focus,
  .rsp-edit-address textarea:focus,
  .rsp-edit-address select:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-edit-address .select2-container {
    width: 100% !important;
  }

  .rsp-edit-address .select2-container--default .select2-selection--single {
    padding: 0 16px;
  }

  .rsp-edit-address .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #020617;
    line-height: 56px;
    padding-left: 0;
    padding-right: 34px;
  }

  .rsp-edit-address .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 56px;
  }

  .rsp-edit-address .woocommerce-input-wrapper {
    display: block;
    width: 100%;
  }

  .rsp-edit-address .woocommerce-invalid input.input-text,
  .rsp-edit-address .woocommerce-invalid select,
  .rsp-edit-address .woocommerce-invalid .select2-selection {
    border-color: #EF4444 !important;
  }

  .rsp-edit-address .woocommerce-validated input.input-text,
  .rsp-edit-address .woocommerce-validated select,
  .rsp-edit-address .woocommerce-validated .select2-selection {
    border-color: rgba(0, 200, 83, 0.75) !important;
  }

  @media (min-width: 768px) {
    .rsp-edit-address .woocommerce-address-fields__field-wrapper {
      grid-template-columns: 1fr 1fr;
      gap: 26px 24px;
    }

    .rsp-edit-address .form-row-wide,
    .rsp-edit-address #billing_company_field,
    .rsp-edit-address #billing_address_1_field,
    .rsp-edit-address #billing_address_2_field,
    .rsp-edit-address #billing_country_field,
    .rsp-edit-address #billing_email_field,
    .rsp-edit-address #billing_phone_field,
    .rsp-edit-address #shipping_company_field,
    .rsp-edit-address #shipping_address_1_field,
    .rsp-edit-address #shipping_address_2_field,
    .rsp-edit-address #shipping_country_field {
      grid-column: 1 / -1;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-edit-address-reveal,
    .rsp-edit-address-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-edit-address relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-edit-address-card rsp-edit-address-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-address-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-edit-address-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="<?php echo esc_attr($address_icon); ?>" class="h-4 w-4" aria-hidden="true"></i>
            <?php echo esc_html($page_title); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php
            printf(
              esc_html__('Update your %s details.', 'reviewservicepro'),
              esc_html(strtolower($page_title))
            );
            ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php echo esc_html($address_note); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($address_overview_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Back to Addresses', 'reviewservicepro'); ?>
            <i data-lucide="arrow-left" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Need Help?', 'reviewservicepro'); ?>
            <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Guidance Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-edit-address-card rsp-edit-address-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-edit-address-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="receipt-text" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Order records', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Address details support invoices, receipts, payment confirmation, and WooCommerce order records.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-edit-address-card rsp-edit-address-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-edit-address-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Secure client account', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Your address data is used for your account and order workflow, not for fake review or manipulation services.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-edit-address-card rsp-edit-address-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-edit-address-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="info" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Different from onboarding', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Review platform links, screenshots, and reputation concerns are collected separately during service onboarding.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <!-- Address Form -->
    <form method="post" class="mt-8">

      <section class="rsp-edit-address-card rsp-edit-address-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-address-card>
        <div class="relative z-10">

          <div class="mb-8">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
              <i data-lucide="<?php echo esc_attr($address_icon); ?>" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php echo esc_html($page_title); ?>
            </h2>

            <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Complete the required fields below and save your address details. Required fields are marked with an asterisk.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="woocommerce-address-fields">
            <?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

            <div class="woocommerce-address-fields__field-wrapper">
              <?php
              foreach ($address as $key => $field) {
                woocommerce_form_field(
                  $key,
                  $field,
                  wc_get_post_data_by_key($key, isset($field['value']) ? $field['value'] : '')
                );
              }
              ?>
            </div>

            <?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>
          </div>

        </div>
      </section>

      <!-- Save CTA -->
      <section class="rsp-edit-address-card rsp-edit-address-reveal mt-8 rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-address-card>
        <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Save your address updates.', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Your updated address will be used for account records, payment details, and order-related communication.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div>
            <button
              type="submit"
              class="button inline-flex min-h-[56px] items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700"
              name="save_address"
              value="<?php esc_attr_e('Save address', 'reviewservicepro'); ?>">

              <?php esc_html_e('Save Address', 'reviewservicepro'); ?>
              <i data-lucide="save" class="h-4 w-4" aria-hidden="true"></i>
            </button>

            <?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
            <input type="hidden" name="action" value="edit_address">
          </div>
        </div>
      </section>

    </form>

  </div>
</section>

<script>
  (function() {
    function initRspEditAddressPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-edit-address-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-edit-address-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-address-edit-x', x + '%');
          card.style.setProperty('--rsp-address-edit-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspEditAddressPage);
    } else {
      initRspEditAddressPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>