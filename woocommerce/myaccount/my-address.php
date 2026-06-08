<?php

/**
 * My Addresses
 *
 * File: woocommerce/myaccount/my-address.php
 *
 * ReviewService.Pro custom WooCommerce My Account addresses page.
 *
 * Purpose:
 * - Show billing/shipping address overview in premium client portal UI.
 * - Preserve WooCommerce address edit links and hooks.
 * - Use comfortable spacing, clean cards, and professional service-dashboard layout.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

if (! $customer_id) {
  return;
}

$myaccount_url = function_exists('wc_get_page_permalink')
  ? wc_get_page_permalink('myaccount')
  : home_url('/my-account/');

$dashboard_url = $myaccount_url;
$support_url   = home_url('/contact/?type=account-support');

$addresses = [
  'billing' => __('Billing address', 'reviewservicepro'),
];

if (function_exists('wc_shipping_enabled') && wc_shipping_enabled() && ! wc_ship_to_billing_address_only()) {
  $addresses['shipping'] = __('Shipping address', 'reviewservicepro');
}

$addresses = apply_filters('woocommerce_my_account_get_addresses', $addresses, $customer_id);

do_action('woocommerce_before_account_addresses');
?>

<style>
  .rsp-address-page {
    color: #ffffff;
  }

  .rsp-address-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-address-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-address-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-address-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-address-x, 50%) var(--rsp-address-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-address-x, 50%) var(--rsp-address-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-address-card:hover::before {
    opacity: 1;
  }

  .rsp-address-beam {
    animation: rspAddressBeam 8s ease-in-out infinite;
  }

  @keyframes rspAddressBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-address-reveal,
    .rsp-address-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-address-page relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-address-card rsp-address-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-address-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-address-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="map-pin" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Billing & Address Details', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Manage your billing and service contact addresses.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Keep your billing details accurate for invoices, order records, payment confirmation, and client portal communication.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($dashboard_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Back to Portal', 'reviewservicepro'); ?>
            <i data-lucide="layout-dashboard" class="h-4 w-4" aria-hidden="true"></i>
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

    <!-- Address explanation -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-address-card rsp-address-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-address-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="receipt-text" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Billing records', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Your billing address is used for WooCommerce order records, receipts, payment details, and account communication.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-address-card rsp-address-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-address-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Secure account details', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Address information stays inside your account and supports order-related communication and service management.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-address-card rsp-address-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-address-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="info" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Service onboarding note', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Business profile links, review platform links, and screenshots are collected separately during onboarding when required.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <!-- Address Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
      <?php foreach ($addresses as $name => $address_title) : ?>
        <?php
        $formatted_address = function_exists('wc_get_account_formatted_address')
          ? wc_get_account_formatted_address($name)
          : '';

        $edit_url = function_exists('wc_get_endpoint_url')
          ? wc_get_endpoint_url('edit-address', $name, $myaccount_url)
          : '#';

        $address_icon = 'billing' === $name ? 'wallet-cards' : 'truck';
        ?>

        <article class="rsp-address-card rsp-address-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-address-card>

          <div class="relative z-10 flex h-full flex-col">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
              <div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
                  <i data-lucide="<?php echo esc_attr($address_icon); ?>" class="h-6 w-6" aria-hidden="true"></i>
                </span>

                <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
                  <?php echo esc_html($address_title); ?>
                </h2>

                <p class="mt-3 text-base font-normal leading-8 text-slate-300">
                  <?php
                  if ('billing' === $name) {
                    esc_html_e('Used for billing, receipts, order records, and payment-related details.', 'reviewservicepro');
                  } else {
                    esc_html_e('Used when shipping information is required for this account.', 'reviewservicepro');
                  }
                  ?>
                </p>
              </div>

              <a
                href="<?php echo esc_url($edit_url); ?>"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

                <?php
                echo $formatted_address
                  ? esc_html__('Edit Address', 'reviewservicepro')
                  : esc_html__('Add Address', 'reviewservicepro');
                ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            </div>

            <div class="mt-8 flex-1 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.035] p-5">
              <?php if ($formatted_address) : ?>
                <address class="not-italic text-base font-normal leading-8 text-slate-300">
                  <?php echo wp_kses_post($formatted_address); ?>
                </address>
              <?php else : ?>
                <div class="rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-5">
                  <div class="flex gap-3">
                    <i data-lucide="circle-alert" class="mt-1 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

                    <div>
                      <h3 class="text-base font-semibold text-white">
                        <?php esc_html_e('No address added yet.', 'reviewservicepro'); ?>
                      </h3>

                      <p class="mt-2 text-sm font-normal leading-7 text-slate-300">
                        <?php esc_html_e('Add your address so your account, billing, and service records stay complete.', 'reviewservicepro'); ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </section>

    <!-- Footer CTA -->
    <section class="rsp-address-card rsp-address-reveal mt-8 rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-address-card>
      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Need to update business onboarding details?', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Billing address is separate from reputation service onboarding. For platform links, screenshots, business profile details, or service instructions, contact support with your order number.', 'reviewservicepro'); ?>
          </p>
        </div>

        <a
          href="<?php echo esc_url($support_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

          <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
          <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
        </a>
      </div>
    </section>

  </div>
</section>

<script>
  (function() {
    function initRspAddressPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-address-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-address-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-address-x', x + '%');
          card.style.setProperty('--rsp-address-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspAddressPage);
    } else {
      initRspAddressPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_account_addresses'); ?>