<?php

/**
 * Template Name: Checkout Page
 * Template Post Type: page
 *
 * File: page-templates/template-checkout.php
 *
 * ReviewService.Pro — Clean WooCommerce Checkout Page
 *
 * Important architecture:
 * - header.php already opens <main id="primary" class="pt-[78px]">.
 * - This template controls only checkout page sections and closes </main> before footer.
 * - Page content should contain only: [woocommerce_checkout]
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$checkout_schema = [
  '@context'    => 'https://schema.org',
  '@type'       => 'WebPage',
  'name'        => 'Secure Service Checkout',
  'url'         => get_permalink(),
  'description' => 'Secure checkout for ReviewService.Pro ethical online reputation management services.',
  'isPartOf'    => [
    '@type' => 'WebSite',
    'name'  => 'ReviewService.Pro',
    'url'   => home_url('/'),
  ],
];
?>

<style>
  #rsp-checkout-template {
    --rsp-checkout-title: #334155;
    --rsp-checkout-heading: #3B4658;
    --rsp-checkout-body: #64748B;
    --rsp-checkout-blue: #2563EB;
    --rsp-checkout-green: #00C853;
    background: #FFFFFF;
    color: #334155;
  }

  #rsp-checkout-template,
  #rsp-checkout-template p,
  #rsp-checkout-template a,
  #rsp-checkout-template label,
  #rsp-checkout-template input,
  #rsp-checkout-template select,
  #rsp-checkout-template textarea {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  #rsp-checkout-template h1,
  #rsp-checkout-template h2,
  #rsp-checkout-template h3,
  #rsp-checkout-template h4 {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  #rsp-checkout-template .woocommerce,
  #rsp-checkout-template .woocommerce-page,
  #rsp-checkout-template .entry-content {
    width: 100% !important;
    max-width: none !important;
  }

  #rsp-checkout-template .rsp-checkout-hero-title {
    color: var(--rsp-checkout-title);
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -0.045em;
  }

  #rsp-checkout-template .rsp-checkout-hero-text {
    color: var(--rsp-checkout-body);
    font-size: 16px;
    font-weight: 500;
    line-height: 1.75;
  }

  @media (max-width: 640px) {
    #rsp-checkout-template .rsp-checkout-hero-title {
      line-height: 1.1;
      letter-spacing: -0.035em;
    }
  }
</style>

<section id="rsp-checkout-template" class="relative overflow-hidden bg-white">

  <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:px-8 lg:py-14" aria-labelledby="rsp-checkout-page-title">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-0 z-0 h-[420px] w-[520px] rounded-full bg-blue-200/30 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-200/35 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-4xl text-center">
      <?php if (function_exists('rsp_breadcrumb')) : ?>
        <div class="mb-5 flex justify-center">
          <?php rsp_breadcrumb(); ?>
        </div>
      <?php endif; ?>

      <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.14em] text-blue-700 shadow-sm">
        <?php esc_html_e('ReviewService.Pro', 'reviewservicepro'); ?>
      </span>

      <h1 id="rsp-checkout-page-title" class="rsp-checkout-hero-title mt-5 text-[38px] sm:text-[44px]">
        <?php esc_html_e('Checkout', 'reviewservicepro'); ?>
      </h1>

      <p class="rsp-checkout-hero-text mx-auto mt-4 max-w-2xl">
        <?php esc_html_e('Complete your secure service order. Billing, payment, and onboarding details stay organized through WooCommerce and your client portal.', 'reviewservicepro'); ?>
      </p>
    </div>
  </section>

  <section class="relative bg-white">
    <div class="w-full" style="overflow-x:hidden;">
      <?php
      while (have_posts()) :
        the_post();

        $content = get_the_content();

        if (has_shortcode($content, 'woocommerce_checkout')) {
          the_content();
        } else {
          echo do_shortcode('[woocommerce_checkout]');
        }
      endwhile;
      ?>
    </div>
  </section>

</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($checkout_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

</main>

<?php
get_footer();
