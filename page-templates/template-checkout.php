<?php

/**
 * Template Name: Checkout Page
 * Template Post Type: page
 *
 * File: page-templates/template-checkout.php
 *
 * ReviewService.Pro — Premium White SaaS Checkout Page
 *
 * Purpose:
 * - Use this template for the WooCommerce Checkout page.
 * - Page content should contain only: [woocommerce_checkout]
 * - Creates a white/light SaaS checkout experience.
 * - Keeps ReviewService.Pro service funnel clear:
 *   Product/Pricing → Checkout → Payment → Client Portal / My Account.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$pricing_url = home_url('/pricing/');
$contact_url = home_url('/contact/?type=checkout-help');
$portal_url  = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');

$checkout_schema = [
  '@context'    => 'https://schema.org',
  '@type'       => 'WebPage',
  'name'        => 'Secure Service Checkout',
  'url'         => get_permalink(),
  'description' => 'Secure checkout for ReviewService.Pro ethical online reputation management packages and one-time reputation services.',
  'isPartOf'    => [
    '@type' => 'WebSite',
    'name'  => 'ReviewService.Pro',
    'url'   => home_url('/'),
  ],
];

$trust_items = [
  [
    'title' => __('Secure service checkout', 'reviewservicepro'),
    'text'  => __('Complete your order through WooCommerce checkout with a clear service workflow.', 'reviewservicepro'),
    'icon'  => 'lock',
    'tone'  => 'blue',
  ],
  [
    'title' => __('Client portal after payment', 'reviewservicepro'),
    'text'  => __('After payment, service onboarding continues inside your account/client portal.', 'reviewservicepro'),
    'icon'  => 'layout-dashboard',
    'tone'  => 'green',
  ],
  [
    'title' => __('Ethical ORM only', 'reviewservicepro'),
    'text'  => __('No fake reviews, paid incentives, rating manipulation, or guaranteed removals.', 'reviewservicepro'),
    'icon'  => 'shield-check',
    'tone'  => 'amber',
  ],
];

$next_steps = [
  __('Payment confirmation and order record are created.', 'reviewservicepro'),
  __('You receive access to order details and account area.', 'reviewservicepro'),
  __('Submit business details, review platform links, and screenshots after payment.', 'reviewservicepro'),
  __('Your reputation service workflow starts based on the package scope.', 'reviewservicepro'),
];

$tone_classes = [
  'blue' => [
    'card' => 'border-blue-200 bg-blue-50/80',
    'icon' => 'border-blue-200 bg-white text-blue-600',
  ],
  'green' => [
    'card' => 'border-[#00C853]/20 bg-[#00C853]/[0.055]',
    'icon' => 'border-[#00C853]/25 bg-white text-[#00A344]',
  ],
  'amber' => [
    'card' => 'border-amber-200 bg-amber-50/80',
    'icon' => 'border-amber-200 bg-white text-amber-600',
  ],
];
?>

<style>
  .rsp-checkout-reveal {
    opacity: 0;
    transform: translateY(22px);
    animation: rspCheckoutReveal 760ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  .rsp-checkout-delay-1 {
    animation-delay: 120ms;
  }

  .rsp-checkout-delay-2 {
    animation-delay: 240ms;
  }

  @keyframes rspCheckoutReveal {
    0% {
      opacity: 0;
      transform: translateY(22px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .rsp-checkout-beam {
    animation: rspCheckoutBeam 7s ease-in-out infinite;
  }

  @keyframes rspCheckoutBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-checkout-float {
    animation: rspCheckoutFloat 5.2s ease-in-out infinite;
  }

  @keyframes rspCheckoutFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-7px);
    }
  }

  /**
   * Classic WooCommerce checkout white SaaS styling.
   */
  .rsp-checkout-page .woocommerce {
    color: #020617;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.75;
  }

  .rsp-checkout-page .woocommerce a {
    color: #2563EB;
    text-decoration: none;
  }

  .rsp-checkout-page .woocommerce a:hover {
    color: #1D4ED8;
  }

  .rsp-checkout-page .woocommerce h1,
  .rsp-checkout-page .woocommerce h2,
  .rsp-checkout-page .woocommerce h3,
  .rsp-checkout-page .woocommerce h4 {
    color: #020617;
    font-weight: 600;
    letter-spacing: -0.035em;
  }

  .rsp-checkout-page .woocommerce-form-coupon-toggle,
  .rsp-checkout-page .woocommerce-info,
  .rsp-checkout-page .woocommerce-message,
  .rsp-checkout-page .woocommerce-error {
    margin-bottom: 1.25rem;
    border-radius: 1.25rem;
    border: 1px solid #BFDBFE;
    border-top: 1px solid #BFDBFE;
    background: #EFF6FF;
    color: #020617;
    box-shadow: 0 14px 45px rgba(15, 23, 42, 0.055);
  }

  .rsp-checkout-page .woocommerce-error {
    border-color: #FECACA;
    background: #FEF2F2;
  }

  .rsp-checkout-page form.checkout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(340px, 420px);
    gap: 2rem;
    align-items: start;
  }

  .rsp-checkout-page #customer_details {
    min-width: 0;
  }

  .rsp-checkout-page #customer_details .col-1,
  .rsp-checkout-page #customer_details .col-2,
  .rsp-checkout-page #order_review,
  .rsp-checkout-page #payment,
  .rsp-checkout-page .woocommerce-checkout-review-order-table {
    border-radius: 1.5rem;
    border: 1px solid #E2E8F0;
    background: #FFFFFF;
    box-shadow: 0 18px 60px rgba(15, 23, 42, 0.07);
  }

  .rsp-checkout-page #customer_details .col-1,
  .rsp-checkout-page #customer_details .col-2 {
    float: none;
    width: 100%;
    padding: 1.5rem;
  }

  .rsp-checkout-page #customer_details {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }

  .rsp-checkout-page #order_review_heading {
    position: sticky;
    top: 92px;
    margin: 0 0 1rem;
    border-radius: 1.25rem;
    border: 1px solid #E2E8F0;
    background: #F8FAFC;
    padding: 1rem 1.25rem;
    color: #020617;
    font-size: 1.25rem;
    font-weight: 600;
    box-shadow: 0 12px 38px rgba(15, 23, 42, 0.055);
  }

  .rsp-checkout-page #order_review {
    position: sticky;
    top: 160px;
    padding: 1.25rem;
  }

  .rsp-checkout-page .woocommerce table.shop_table {
    border-radius: 1.25rem;
    border: 1px solid #E2E8F0;
    overflow: hidden;
    background: #FFFFFF;
    color: #334155;
  }

  .rsp-checkout-page .woocommerce table.shop_table th,
  .rsp-checkout-page .woocommerce table.shop_table td {
    border-color: #E2E8F0;
    color: #334155;
    font-size: 0.95rem;
    line-height: 1.6;
  }

  .rsp-checkout-page .woocommerce table.shop_table tfoot th,
  .rsp-checkout-page .woocommerce table.shop_table tfoot td,
  .rsp-checkout-page .woocommerce table.shop_table .order-total th,
  .rsp-checkout-page .woocommerce table.shop_table .order-total td {
    color: #020617;
    font-weight: 600;
  }

  .rsp-checkout-page .woocommerce form .form-row {
    margin-bottom: 1rem;
  }

  .rsp-checkout-page .woocommerce form .form-row label {
    color: #334155;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.6;
  }

  .rsp-checkout-page .woocommerce form .form-row .required {
    color: #00A344;
  }

  .rsp-checkout-page .woocommerce form .form-row input.input-text,
  .rsp-checkout-page .woocommerce form .form-row textarea,
  .rsp-checkout-page .woocommerce form .form-row select,
  .rsp-checkout-page .select2-container--default .select2-selection--single {
    min-height: 52px;
    border-radius: 1rem;
    border: 1px solid #CBD5E1;
    background: #FFFFFF;
    color: #020617;
    font-size: 1rem;
    font-weight: 400;
    outline: none;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
  }

  .rsp-checkout-page .woocommerce form .form-row textarea {
    min-height: 132px;
    padding: 1rem;
  }

  .rsp-checkout-page .woocommerce form .form-row input.input-text:focus,
  .rsp-checkout-page .woocommerce form .form-row textarea:focus,
  .rsp-checkout-page .woocommerce form .form-row select:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
  }

  .rsp-checkout-page .woocommerce form .form-row input.input-text::placeholder,
  .rsp-checkout-page .woocommerce form .form-row textarea::placeholder {
    color: #94A3B8;
  }

  .rsp-checkout-page .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #020617;
    line-height: 52px;
  }

  .rsp-checkout-page .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 52px;
  }

  .rsp-checkout-page .woocommerce-checkout #payment {
    margin-top: 1rem;
    background: #F8FAFC;
  }

  .rsp-checkout-page .woocommerce-checkout #payment ul.payment_methods {
    border-bottom: 1px solid #E2E8F0;
  }

  .rsp-checkout-page .woocommerce-checkout #payment div.payment_box {
    border-radius: 1rem;
    border: 1px solid #E2E8F0;
    background: #FFFFFF;
    color: #475569;
    font-size: 0.95rem;
    line-height: 1.7;
  }

  .rsp-checkout-page .woocommerce-privacy-policy-text {
    color: #64748B;
    font-size: 0.95rem;
    line-height: 1.7;
  }

  .rsp-checkout-page .woocommerce button.button,
  .rsp-checkout-page .woocommerce a.button,
  .rsp-checkout-page .woocommerce input.button,
  .rsp-checkout-page .woocommerce #payment #place_order {
    min-height: 56px;
    border-radius: 1rem;
    border: 0;
    background: #2563EB;
    color: #FFFFFF;
    font-size: 1rem;
    font-weight: 500;
    padding: 1rem 1.4rem;
    box-shadow: 0 14px 38px rgba(37, 99, 235, 0.25);
    transition: all 0.2s ease;
  }

  .rsp-checkout-page .woocommerce button.button:hover,
  .rsp-checkout-page .woocommerce a.button:hover,
  .rsp-checkout-page .woocommerce input.button:hover,
  .rsp-checkout-page .woocommerce #payment #place_order:hover {
    background: #1D4ED8;
    color: #FFFFFF;
    transform: translateY(-1px);
  }

  .rsp-checkout-page .woocommerce #payment #place_order {
    width: 100%;
    margin-top: 1rem;
  }

  @media (max-width: 1024px) {
    .rsp-checkout-page form.checkout {
      grid-template-columns: 1fr;
    }

    .rsp-checkout-page #order_review,
    .rsp-checkout-page #order_review_heading {
      position: relative;
      top: auto;
    }
  }

  @media (max-width: 640px) {

    .rsp-checkout-page #customer_details .col-1,
    .rsp-checkout-page #customer_details .col-2,
    .rsp-checkout-page #order_review {
      border-radius: 1.25rem;
      padding: 1rem;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-checkout-reveal,
    .rsp-checkout-beam,
    .rsp-checkout-float {
      opacity: 1;
      transform: none;
      animation: none;
    }
  }
</style>

<section
  id="rsp-checkout-page"
  class="rsp-checkout-page relative overflow-hidden bg-white font-sans text-[#020617]">

  <!-- White SaaS Background -->
  <div
    class="pointer-events-none absolute inset-0 z-0"
    style="background-image:linear-gradient(rgba(37,99,235,0.055) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.055) 1px,transparent 1px);background-size:52px 52px;mask-image:linear-gradient(to bottom,black 0%,black 70%,transparent 100%);-webkit-mask-image:linear-gradient(to bottom,black 0%,black 70%,transparent 100%);"></div>

  <div class="pointer-events-none absolute -left-40 top-10 z-0 h-[540px] w-[540px] rounded-full bg-blue-500/[0.12] blur-[125px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-40 top-72 z-0 h-[540px] w-[540px] rounded-full bg-[#00C853]/[0.12] blur-[125px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute bottom-24 left-1/2 z-0 h-[420px] w-[720px] -translate-x-1/2 rounded-full bg-[#14B8A6]/[0.08] blur-[135px]" aria-hidden="true"></div>

  <!-- Hero -->
  <section class="relative z-10 px-5 pb-10 pt-28 sm:px-6 lg:px-8 lg:pb-14 lg:pt-32">
    <div class="mx-auto max-w-7xl">

      <div class="rsp-checkout-reveal grid grid-cols-1 gap-8 lg:grid-cols-[0.95fr_0.45fr] lg:items-end">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#065F46]">
            <i data-lucide="credit-card" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
            <?php esc_html_e('Secure Service Checkout', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-5 max-w-5xl text-4xl font-semibold leading-[1.04] tracking-[-0.055em] text-[#020617] sm:text-5xl lg:text-6xl">
            <?php esc_html_e('Complete your reputation service order.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-700">
            <?php esc_html_e('Checkout securely, complete payment, and continue your ReviewService.Pro onboarding inside your client portal after purchase.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-6 flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-sm font-normal text-blue-700">
              <i data-lucide="lock" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
              <?php esc_html_e('Secure checkout', 'reviewservicepro'); ?>
            </span>

            <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-3 py-1.5 text-sm font-normal text-[#065F46]">
              <i data-lucide="layout-dashboard" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
              <?php esc_html_e('Client portal after payment', 'reviewservicepro'); ?>
            </span>

            <span class="inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-sm font-normal text-amber-700">
              <i data-lucide="shield-alert" class="h-4 w-4 text-amber-600" aria-hidden="true"></i>
              <?php esc_html_e('Platform-compliant ORM', 'reviewservicepro'); ?>
            </span>
          </div>
        </div>

        <aside class="rsp-checkout-float rounded-[1.75rem] border border-slate-200 bg-white/90 p-5 shadow-[0_18px_65px_rgba(15,23,42,0.08)] backdrop-blur-xl">
          <div class="flex items-start gap-3">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-[#00C853]/10">
              <i data-lucide="shield-check" class="h-5 w-5 text-[#00A344]" aria-hidden="true"></i>
            </div>

            <div>
              <h2 class="text-base font-medium leading-6 text-[#020617]">
                <?php esc_html_e('Ethical service promise', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-2 text-sm font-normal leading-6 text-slate-600">
                <?php esc_html_e('No fake reviews, no paid review incentives, no guaranteed removals, and no rating manipulation.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </aside>
      </div>

    </div>
  </section>

  <!-- Trust Strip -->
  <section class="relative z-10 px-5 pb-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <div class="rsp-checkout-reveal rsp-checkout-delay-1 grid grid-cols-1 gap-4 md:grid-cols-3">
        <?php foreach ($trust_items as $item) : ?>
          <?php
          $tone = isset($tone_classes[$item['tone']]) ? $tone_classes[$item['tone']] : $tone_classes['blue'];
          ?>

          <article class="rounded-[1.5rem] border <?php echo esc_attr($tone['card']); ?> p-5 shadow-[0_14px_45px_rgba(15,23,42,0.055)]">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?>">
              <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <h3 class="text-xl font-semibold tracking-[-0.035em] text-[#020617]">
              <?php echo esc_html($item['title']); ?>
            </h3>

            <p class="mt-2 text-base font-normal leading-7 text-slate-700">
              <?php echo esc_html($item['text']); ?>
            </p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Checkout Content -->
  <section class="relative z-10 px-5 pb-20 sm:px-6 lg:px-8 lg:pb-24">
    <div class="mx-auto max-w-7xl">

      <div class="rsp-checkout-reveal rsp-checkout-delay-2 relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white/92 p-4 shadow-[0_28px_100px_rgba(15,23,42,0.10)] backdrop-blur-xl md:p-6 lg:p-8">

        <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-slate-200" aria-hidden="true">
          <div class="rsp-checkout-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
        </div>

        <div class="mb-6 rounded-[1.5rem] border border-slate-200 bg-slate-50/80 p-5">
          <div class="grid grid-cols-1 gap-4 lg:grid-cols-[auto_1fr_auto] lg:items-center">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50">
              <i data-lucide="shopping-bag" class="h-5 w-5 text-blue-600" aria-hidden="true"></i>
            </div>

            <div>
              <h2 class="text-2xl font-semibold tracking-[-0.04em] text-[#020617]">
                <?php esc_html_e('Service checkout details', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-2 text-base font-normal leading-7 text-slate-700">
                <?php esc_html_e('Complete the billing/payment details now. Service-specific onboarding details can be submitted after payment to keep checkout simple.', 'reviewservicepro'); ?>
              </p>
            </div>

            <a
              href="<?php echo esc_url($pricing_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-base font-medium text-[#020617] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50">

              <?php esc_html_e('Back to Pricing', 'reviewservicepro'); ?>
              <i data-lucide="arrow-left" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <?php
        while (have_posts()) :
          the_post();
          the_content();
        endwhile;
        ?>

      </div>

      <!-- After Checkout / Portal Note -->
      <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-[1fr_0.42fr]">
        <div class="rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-5">
          <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-white">
              <i data-lucide="clipboard-list" class="h-5 w-5 text-[#00A344]" aria-hidden="true"></i>
            </div>

            <div>
              <h3 class="text-2xl font-semibold tracking-[-0.04em] text-[#020617]">
                <?php esc_html_e('What happens after payment?', 'reviewservicepro'); ?>
              </h3>

              <ul class="mt-4 grid grid-cols-1 gap-3 md:grid-cols-2" role="list">
                <?php foreach ($next_steps as $step) : ?>
                  <li class="flex items-start gap-2 text-base font-normal leading-7 text-slate-700">
                    <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <span><?php echo esc_html($step); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="rounded-[1.5rem] border border-blue-200 bg-blue-50/80 p-5">
          <h3 class="text-2xl font-semibold tracking-[-0.04em] text-[#020617]">
            <?php esc_html_e('Need help before ordering?', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-2 text-base font-normal leading-7 text-slate-700">
            <?php esc_html_e('Ask us if you are not sure which reputation package fits your situation.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-5 flex flex-col gap-3">
            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php esc_html_e('Ask Before Ordering', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($portal_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-base font-medium text-[#020617] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#00C853]/25 hover:bg-[#00C853]/[0.055]">

              <?php esc_html_e('Client Portal', 'reviewservicepro'); ?>
              <i data-lucide="layout-dashboard" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="mt-6 rounded-[1.5rem] border border-amber-200 bg-amber-50 p-5">
        <div class="flex items-start gap-3">
          <i data-lucide="shield-alert" class="mt-1 h-5 w-5 shrink-0 text-amber-600" aria-hidden="true"></i>

          <p class="text-sm font-normal leading-7 text-slate-700">
            <?php esc_html_e('Compliance reminder: ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on ethical review monitoring, response support, documentation, platform-compliant reporting, and transparent reputation improvement.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>

    </div>
  </section>

</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($checkout_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
  (function() {
    function initRspCheckoutPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspCheckoutPage);
    } else {
      initRspCheckoutPage();
    }
  })();
</script>

<?php
/**
 * header.php opens <main id="primary">, so this template closes it.
 */
?>
</main>

<?php get_footer(); ?>