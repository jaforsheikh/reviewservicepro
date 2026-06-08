<?php

/**
 * Single WooCommerce Product Template
 *
 * File: woocommerce/single-product.php
 *
 * ReviewService.Pro — Premium Service Product Detail Page
 *
 * Purpose:
 * - Turn WooCommerce products into premium ORM service package pages.
 * - Use WooCommerce product data dynamically.
 * - Use ReviewService.Pro product meta fields dynamically.
 * - Keep checkout default and stable.
 * - Send Order Now directly to WooCommerce checkout.
 * - Keep compliance-safe reputation management language.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

if (! class_exists('WooCommerce')) {
?>

  <section class="relative min-h-screen overflow-hidden bg-[#07111F] px-5 py-32 text-white">
    <div class="mx-auto max-w-4xl rounded-3xl border border-white/10 bg-white/[0.04] p-8">
      <h1 class="text-3xl font-semibold tracking-[-0.04em]">
        <?php esc_html_e('WooCommerce is required', 'reviewservicepro'); ?>
      </h1>

      <p class="mt-4 text-base font-normal leading-8 text-slate-300">
        <?php esc_html_e('Please activate WooCommerce to view this service package.', 'reviewservicepro'); ?>
      </p>
    </div>
  </section>

<?php
  get_footer();
  return;
}

global $product;

$product_id = get_queried_object_id();

if (! $product instanceof WC_Product) {
  $product = wc_get_product($product_id);
}

if (! $product instanceof WC_Product) {
?>

  <section class="relative min-h-screen overflow-hidden bg-[#07111F] px-5 py-32 text-white">
    <div class="mx-auto max-w-4xl rounded-3xl border border-white/10 bg-white/[0.04] p-8">
      <h1 class="text-3xl font-semibold tracking-[-0.04em]">
        <?php esc_html_e('Service package not found', 'reviewservicepro'); ?>
      </h1>

      <p class="mt-4 text-base font-normal leading-8 text-slate-300">
        <?php esc_html_e('Please go back to the Pricing page and choose an available service package.', 'reviewservicepro'); ?>
      </p>

      <a
        href="<?php echo esc_url(home_url('/pricing/')); ?>"
        class="mt-6 inline-flex items-center justify-center rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">
        <?php esc_html_e('Back to Pricing', 'reviewservicepro'); ?>
      </a>
    </div>
  </section>

<?php
  get_footer();
  return;
}

/**
 * Helper: get product meta safely.
 */
$rsp_get_meta = static function ($key, $default = '') use ($product_id) {
  $value = get_post_meta($product_id, sanitize_key($key), true);

  if ('' === $value || null === $value) {
    return $default;
  }

  return is_string($value) ? $value : $default;
};

/**
 * Helper: convert textarea lines to array.
 */
$rsp_lines = static function ($raw, $fallback = []) {
  $raw = (string) $raw;

  if ('' === trim($raw)) {
    return is_array($fallback) ? $fallback : [];
  }

  $lines = preg_split('/\r\n|\r|\n/', $raw);
  $items = [];

  foreach ($lines as $line) {
    $line = trim(wp_strip_all_tags((string) $line));

    if ('' !== $line) {
      $items[] = $line;
    }
  }

  return array_values(array_unique($items));
};

$product_title       = $product->get_name();
$product_permalink   = get_permalink($product_id);
$product_price_html  = $product->get_price_html();
$product_short_desc  = $product->get_short_description();
$product_description = get_post_field('post_content', $product_id);
$product_image_id    = $product->get_image_id();
$gallery_image_ids   = $product->get_gallery_image_ids();

$pricing_url  = home_url('/pricing/');
$services_url = home_url('/services/');
$contact_url  = home_url('/contact/?type=product-help&service=' . rawurlencode($product_title));

/**
 * Product meta fields from inc/woocommerce-product-meta.php
 */
$card_badge = $rsp_get_meta(
  '_rsp_card_badge',
  __('Service Package', 'reviewservicepro')
);

$platform_scope = $rsp_get_meta(
  '_rsp_platform_scope',
  __('Based on package scope', 'reviewservicepro')
);

$best_for = $rsp_get_meta(
  '_rsp_best_for',
  __('Businesses that want a focused, ethical reputation service.', 'reviewservicepro')
);

$service_timeline = $rsp_get_meta(
  '_rsp_service_timeline',
  __('Timeline shown after order confirmation', 'reviewservicepro')
);

$primary_cta_label = $rsp_get_meta(
  '_rsp_cta_label',
  __('Order Now', 'reviewservicepro')
);

$secondary_cta_label = $rsp_get_meta(
  '_rsp_secondary_cta_label',
  __('Ask Before Ordering', 'reviewservicepro')
);

$included_items = $rsp_lines(
  $rsp_get_meta('_rsp_included_items'),
  [
    __('Clear service scope and reputation review', 'reviewservicepro'),
    __('Professional recommendations based on visible trust signals', 'reviewservicepro'),
    __('Client portal access after payment', 'reviewservicepro'),
  ]
);

$card_deliverables = $rsp_lines(
  $rsp_get_meta('_rsp_card_deliverables'),
  [
    __('Clear service scope', 'reviewservicepro'),
    __('Professional recommendations', 'reviewservicepro'),
    __('Client portal access after payment', 'reviewservicepro'),
  ]
);

$not_included_items = $rsp_lines(
  $rsp_get_meta('_rsp_not_included'),
  [
    __('Fake reviews or paid review incentives', 'reviewservicepro'),
    __('Guaranteed negative review removal', 'reviewservicepro'),
    __('Guaranteed 5-star ratings or ranking outcomes', 'reviewservicepro'),
  ]
);

$onboarding_items = $rsp_lines(
  $rsp_get_meta('_rsp_onboarding_items'),
  [
    __('Business name and website URL', 'reviewservicepro'),
    __('Review platform links you want checked', 'reviewservicepro'),
    __('Main reputation concern or review issue', 'reviewservicepro'),
    __('Screenshots or review examples if needed', 'reviewservicepro'),
  ]
);

$upgrade_note_title = $rsp_get_meta(
  '_rsp_upgrade_note_title',
  __('Upgrade path', 'reviewservicepro')
);

$upgrade_note_text = $rsp_get_meta(
  '_rsp_upgrade_note_text',
  __('If ongoing monitoring, response management, and reporting are needed, this service can help you decide whether a monthly ORM plan is the right next step.', 'reviewservicepro')
);

$related_monthly_note = $rsp_get_meta(
  '_rsp_related_monthly_note',
  __('Monthly ORM plans are available on the Services page.', 'reviewservicepro')
);

$compliance_note = $rsp_get_meta(
  '_rsp_product_compliance_note',
  __('ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on ethical monitoring, response support, documentation, platform-compliant reporting, and transparent reputation improvement.', 'reviewservicepro')
);

/**
 * Checkout URL.
 */
$checkout_url = $product->is_purchasable() && $product->is_in_stock()
  ? add_query_arg(
    [
      'add-to-cart' => $product_id,
      'quantity'    => 1,
    ],
    wc_get_checkout_url()
  )
  : $contact_url;

/**
 * Product image.
 */
$main_image_url = $product_image_id
  ? wp_get_attachment_image_url($product_image_id, 'full')
  : wc_placeholder_img_src('woocommerce_single');

$main_image_alt = $product_image_id
  ? get_post_meta($product_image_id, '_wp_attachment_image_alt', true)
  : $product_title;

if ('' === $main_image_alt) {
  $main_image_alt = $product_title;
}

$gallery_items = [];

if ($product_image_id) {
  $gallery_items[] = $product_image_id;
}

foreach ($gallery_image_ids as $gallery_id) {
  if ($gallery_id && ! in_array($gallery_id, $gallery_items, true)) {
    $gallery_items[] = $gallery_id;
  }
}

$product_categories = wc_get_product_category_list($product_id, ', ');
$product_tags       = wc_get_product_tag_list($product_id, ', ');

/**
 * Optional SEO cluster visible blocks from inc/seo-cluster-meta.php
 */
$cluster_related_links = '';

if (
  function_exists('rsp_cluster_get_meta') &&
  function_exists('rsp_cluster_render_related_links') &&
  'yes' === rsp_cluster_get_meta($product_id, '_rsp_cluster_show_related_links', 'no')
) {
  $cluster_related_links = rsp_cluster_render_related_links($product_id);
}

$cluster_faq_block = '';

if (
  function_exists('rsp_cluster_get_meta') &&
  function_exists('rsp_cluster_render_faq_block') &&
  'yes' === rsp_cluster_get_meta($product_id, '_rsp_cluster_show_frontend_faq', 'no')
) {
  $cluster_faq_block = rsp_cluster_render_faq_block($product_id);
}
?>

<style>
  .rsp-product-reveal {
    opacity: 0;
    transform: translateY(24px);
    transition:
      opacity 760ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 760ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-product-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-product-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-product-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(420px circle at var(--rsp-mouse-x, 50%) var(--rsp-mouse-y, 50%), rgba(37, 99, 235, 0.15), transparent 42%),
      radial-gradient(320px circle at var(--rsp-mouse-x, 50%) var(--rsp-mouse-y, 50%), rgba(0, 200, 83, 0.10), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-product-card:hover::before {
    opacity: 1;
  }

  .rsp-product-beam {
    animation: rspProductBeam 8s ease-in-out infinite;
  }

  @keyframes rspProductBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-product-float {
    animation: rspProductFloat 5.2s ease-in-out infinite;
  }

  @keyframes rspProductFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-8px);
    }
  }

  .rsp-product-thumbnail {
    opacity: 0.76;
  }

  .rsp-product-thumbnail.rsp-active,
  .rsp-product-thumbnail:hover {
    opacity: 1;
    transform: translateY(-2px);
    border-color: rgba(37, 99, 235, 0.65);
  }

  .rsp-product-content :where(h1, h2, h3, h4) {
    color: #ffffff;
    font-weight: 600;
    letter-spacing: -0.035em;
  }

  .rsp-product-content :where(p, li) {
    color: rgb(203 213 225);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.9;
  }

  .rsp-product-content :where(a) {
    color: #60A5FA;
    text-decoration: none;
  }

  .rsp-product-content :where(a:hover) {
    color: #93C5FD;
  }

  .rsp-product-content :where(ul, ol) {
    margin-top: 1rem;
    margin-bottom: 1rem;
    padding-left: 1.25rem;
  }

  .rsp-product-content :where(strong) {
    color: #ffffff;
    font-weight: 600;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-product-reveal,
    .rsp-product-beam,
    .rsp-product-float,
    .rsp-product-thumbnail {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<article id="product-<?php echo esc_attr((string) $product_id); ?>" <?php wc_product_class('relative overflow-hidden bg-[#07111F] text-white', $product); ?>>

  <!-- Background system -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:52px_52px]"></div>
  <div class="pointer-events-none absolute -left-36 top-32 z-0 h-[520px] w-[520px] rounded-full bg-blue-600/[0.12] blur-[130px]"></div>
  <div class="pointer-events-none absolute -right-36 top-72 z-0 h-[520px] w-[520px] rounded-full bg-[#00C853]/[0.10] blur-[130px]"></div>
  <div class="pointer-events-none absolute bottom-56 left-1/2 z-0 h-[420px] w-[720px] -translate-x-1/2 rounded-full bg-[#14B8A6]/[0.07] blur-[135px]"></div>

  <!-- Product Hero -->
  <section class="relative z-10 px-4 pb-12 pt-28 sm:px-6 lg:px-8 lg:pb-16 lg:pt-32">
    <div class="mx-auto max-w-7xl">

      <nav class="rsp-product-reveal mb-6 flex flex-wrap items-center gap-2 text-sm font-normal text-slate-500" aria-label="<?php esc_attr_e('Breadcrumb', 'reviewservicepro'); ?>">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="transition-colors duration-200 hover:text-white">
          <?php esc_html_e('Home', 'reviewservicepro'); ?>
        </a>
        <span>/</span>
        <a href="<?php echo esc_url($pricing_url); ?>" class="transition-colors duration-200 hover:text-white">
          <?php esc_html_e('Pricing', 'reviewservicepro'); ?>
        </a>
        <span>/</span>
        <span class="text-slate-300"><?php echo esc_html($product_title); ?></span>
      </nav>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.9fr_1fr] lg:items-start">

        <!-- Gallery -->
        <section class="rsp-product-reveal">
          <div class="rsp-product-card rounded-[2rem] border border-white/[0.08] bg-white/[0.045] p-3 shadow-[0_30px_100px_rgba(0,0,0,0.26)] backdrop-blur-xl" data-rsp-product-card>

            <div class="relative overflow-hidden rounded-[1.5rem] border border-white/[0.08] bg-white">
              <img
                id="rsp-main-product-image"
                src="<?php echo esc_url($main_image_url); ?>"
                alt="<?php echo esc_attr($main_image_alt); ?>"
                class="h-auto w-full object-cover transition-all duration-500"
                loading="eager">
            </div>

            <?php if (count($gallery_items) > 1) : ?>
              <div class="mt-4 grid grid-cols-4 gap-3 sm:grid-cols-5">
                <?php foreach ($gallery_items as $index => $image_id) : ?>
                  <?php
                  $thumb_url = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
                  $full_url  = wp_get_attachment_image_url($image_id, 'full');
                  $alt       = get_post_meta($image_id, '_wp_attachment_image_alt', true);

                  if ('' === $alt) {
                    $alt = $product_title;
                  }
                  ?>

                  <button
                    type="button"
                    class="rsp-product-thumbnail <?php echo 0 === $index ? 'rsp-active' : ''; ?> overflow-hidden rounded-xl border border-white/[0.12] bg-white/[0.04] p-1 transition-all duration-300"
                    data-rsp-gallery-image="<?php echo esc_url($full_url); ?>"
                    data-rsp-gallery-alt="<?php echo esc_attr($alt); ?>"
                    aria-label="<?php echo esc_attr(sprintf(__('View image %d', 'reviewservicepro'), absint($index + 1))); ?>">

                    <img
                      src="<?php echo esc_url($thumb_url); ?>"
                      alt="<?php echo esc_attr($alt); ?>"
                      class="aspect-square w-full rounded-lg object-cover"
                      loading="lazy">
                  </button>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

          </div>
        </section>

        <!-- Product Summary -->
        <section class="rsp-product-reveal" style="transition-delay: 90ms;">
          <div class="rsp-product-card relative rounded-[2rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_30px_100px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8" data-rsp-product-card>

            <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
              <div class="rsp-product-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
            </div>

            <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
              <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
              <?php echo esc_html($card_badge); ?>
            </span>

            <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-[1.05] tracking-[-0.055em] text-white md:text-5xl">
              <?php echo esc_html($product_title); ?>
            </h1>

            <?php if ($product_short_desc) : ?>
              <div class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
                <?php echo wp_kses_post(wpautop($product_short_desc)); ?>
              </div>
            <?php else : ?>
              <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
                <?php esc_html_e('A focused ethical reputation management service for trust-driven businesses.', 'reviewservicepro'); ?>
              </p>
            <?php endif; ?>

            <div class="mt-7 rounded-[1.5rem] border border-white/[0.10] bg-white/[0.055] p-5">
              <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-400">
                <?php esc_html_e('Service Price', 'reviewservicepro'); ?>
              </p>

              <div class="mt-2 text-3xl font-semibold tracking-[-0.04em] text-white">
                <?php echo wp_kses_post($product_price_html); ?>
              </div>

              <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="rounded-xl border border-blue-400/20 bg-blue-500/[0.10] p-4">
                  <div class="flex items-center gap-2 text-sm font-medium text-blue-200">
                    <i data-lucide="clock-3" class="h-4 w-4" aria-hidden="true"></i>
                    <?php esc_html_e('Timeline', 'reviewservicepro'); ?>
                  </div>

                  <p class="mt-2 text-sm font-normal leading-6 text-slate-300">
                    <?php echo esc_html($service_timeline); ?>
                  </p>
                </div>

                <div class="rounded-xl border border-[#00C853]/20 bg-[#00C853]/[0.10] p-4">
                  <div class="flex items-center gap-2 text-sm font-medium text-[#6DFFB0]">
                    <i data-lucide="badge-check" class="h-4 w-4" aria-hidden="true"></i>
                    <?php esc_html_e('Platform Scope', 'reviewservicepro'); ?>
                  </div>

                  <p class="mt-2 text-sm font-normal leading-6 text-slate-300">
                    <?php echo esc_html($platform_scope); ?>
                  </p>
                </div>
              </div>

              <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <a
                  href="<?php echo esc_url($checkout_url); ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-blue-600/35">

                  <?php echo esc_html($primary_cta_label); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </a>

                <a
                  href="<?php echo esc_url($contact_url); ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

                  <?php echo esc_html($secondary_cta_label); ?>
                  <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
                </a>
              </div>

              <div class="mt-5 rounded-xl border border-amber-300/20 bg-amber-300/[0.07] p-4">
                <p class="text-sm font-normal leading-7 text-amber-100">
                  <?php echo esc_html($compliance_note); ?>
                </p>
              </div>
            </div>

          </div>
        </section>

      </div>
    </div>
  </section>

  <!-- Service Cards -->
  <section class="relative z-10 px-4 pb-12 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">

        <article class="rsp-product-card rsp-product-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-product-card>
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
            <i data-lucide="check-circle-2" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
            <?php esc_html_e('What’s included', 'reviewservicepro'); ?>
          </h2>

          <ul class="mt-4 space-y-3" role="list">
            <?php foreach ($included_items as $item) : ?>
              <li class="flex items-start gap-2 text-sm font-normal leading-6 text-slate-300">
                <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </article>

        <article class="rsp-product-card rsp-product-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl" data-rsp-product-card style="transition-delay: 80ms;">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-300">
            <i data-lucide="target" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
            <?php esc_html_e('Best for', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 text-sm font-normal leading-7 text-slate-300">
            <?php echo esc_html($best_for); ?>
          </p>

          <div class="mt-5 rounded-xl border border-[#00C853]/20 bg-[#00C853]/[0.08] p-4">
            <p class="text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
              <?php echo esc_html($upgrade_note_title); ?>
            </p>

            <p class="mt-2 text-sm font-normal leading-6 text-slate-300">
              <?php echo esc_html($upgrade_note_text); ?>
            </p>
          </div>
        </article>

        <article class="rsp-product-card rsp-product-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-product-card style="transition-delay: 160ms;">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
            <i data-lucide="shield-alert" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
            <?php esc_html_e('Not included', 'reviewservicepro'); ?>
          </h2>

          <ul class="mt-4 space-y-3" role="list">
            <?php foreach ($not_included_items as $item) : ?>
              <li class="flex items-start gap-2 text-sm font-normal leading-6 text-slate-300">
                <i data-lucide="ban" class="mt-1 h-4 w-4 shrink-0 text-amber-200" aria-hidden="true"></i>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </article>

      </div>
    </div>
  </section>

  <!-- Details and After Payment -->
  <section class="relative z-10 px-4 pb-12 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1.05fr_0.95fr]">

        <article class="rsp-product-card rsp-product-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8" data-rsp-product-card>
          <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
            <i data-lucide="file-text" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Service Details', 'reviewservicepro'); ?>
          </span>

          <div class="rsp-product-content mt-5 max-w-none">
            <?php
            if ($product_description) {
              echo wp_kses_post(apply_filters('the_content', $product_description));
            } else {
              echo '<p>' . esc_html__('This service helps businesses understand reputation gaps, visible trust signals, review response quality, and next-step recommendations.', 'reviewservicepro') . '</p>';
            }
            ?>
          </div>

          <?php if ($product_categories || $product_tags || ! empty($card_deliverables)) : ?>
            <div class="mt-6 space-y-4">

              <?php if (! empty($card_deliverables)) : ?>
                <div class="rounded-xl border border-white/[0.08] bg-white/[0.035] p-4">
                  <p class="text-sm font-medium text-white">
                    <?php esc_html_e('Quick deliverables', 'reviewservicepro'); ?>
                  </p>

                  <ul class="mt-3 grid grid-cols-1 gap-2 sm:grid-cols-2" role="list">
                    <?php foreach ($card_deliverables as $deliverable) : ?>
                      <li class="flex items-start gap-2 text-sm font-normal leading-6 text-slate-300">
                        <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
                        <span><?php echo esc_html($deliverable); ?></span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <div class="flex flex-wrap gap-3 text-sm text-slate-400">
                <?php if ($product_categories) : ?>
                  <span class="rounded-full border border-white/[0.10] bg-white/[0.04] px-3 py-1.5">
                    <?php esc_html_e('Category:', 'reviewservicepro'); ?>
                    <?php echo wp_kses_post($product_categories); ?>
                  </span>
                <?php endif; ?>

                <?php if ($product_tags) : ?>
                  <span class="rounded-full border border-white/[0.10] bg-white/[0.04] px-3 py-1.5">
                    <?php esc_html_e('Tags:', 'reviewservicepro'); ?>
                    <?php echo wp_kses_post($product_tags); ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </article>

        <article class="rsp-product-card rsp-product-reveal rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8" data-rsp-product-card style="transition-delay: 90ms;">
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/20 bg-[#00C853]/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="clipboard-list" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('After Payment', 'reviewservicepro'); ?>
          </span>

          <h2 class="mt-5 text-2xl font-semibold tracking-[-0.04em] text-white">
            <?php esc_html_e('What we collect during onboarding', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('To keep checkout simple, detailed service information is collected after payment inside the client portal/onboarding workflow.', 'reviewservicepro'); ?>
          </p>

          <ul class="mt-5 grid grid-cols-1 gap-3" role="list">
            <?php foreach ($onboarding_items as $item) : ?>
              <li class="flex items-start gap-2 text-sm font-normal leading-6 text-slate-300">
                <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="mt-6 rounded-xl border border-blue-400/20 bg-blue-500/[0.10] p-4">
            <p class="text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
              <?php esc_html_e('Related monthly option', 'reviewservicepro'); ?>
            </p>

            <p class="mt-2 text-sm font-normal leading-6 text-slate-300">
              <?php echo esc_html($related_monthly_note); ?>
            </p>

            <a
              href="<?php echo esc_url($services_url); ?>"
              class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-blue-200 transition-colors duration-200 hover:text-white">

              <?php esc_html_e('View monthly ORM plans', 'reviewservicepro'); ?>
              <i data-lucide="arrow-up-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <?php if ($cluster_related_links || $cluster_faq_block) : ?>
    <section class="relative z-10 px-4 pb-12 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <?php
        echo wp_kses_post($cluster_related_links);
        echo wp_kses_post($cluster_faq_block);
        ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- Bottom CTA -->
  <section class="relative z-20 px-4 pb-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <div class="rsp-product-card rsp-product-reveal rounded-[1.5rem] border border-white/[0.08] bg-blue-600/[0.10] p-5 backdrop-blur-xl" data-rsp-product-card>
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
              <?php esc_html_e('Ready to order this reputation service?', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-2 text-base font-normal leading-7 text-slate-300">
              <?php esc_html_e('Complete secure checkout, then continue your service onboarding inside your ReviewService.Pro client portal.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row">
            <a
              href="<?php echo esc_url($checkout_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php echo esc_html($primary_cta_label); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($pricing_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

              <?php esc_html_e('Back to Pricing', 'reviewservicepro'); ?>
              <i data-lucide="arrow-left" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</article>

<script>
  (function() {
    function initRspProductPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-product-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-product-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-mouse-x', x + '%');
          card.style.setProperty('--rsp-mouse-y', y + '%');
        });
      });

      var mainImage = document.getElementById('rsp-main-product-image');
      var galleryButtons = document.querySelectorAll('[data-rsp-gallery-image]');

      galleryButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          if (!mainImage) {
            return;
          }

          var nextImage = button.getAttribute('data-rsp-gallery-image');
          var nextAlt = button.getAttribute('data-rsp-gallery-alt') || '';

          if (!nextImage) {
            return;
          }

          mainImage.style.opacity = '0.35';

          window.setTimeout(function() {
            mainImage.setAttribute('src', nextImage);
            mainImage.setAttribute('alt', nextAlt);
            mainImage.style.opacity = '1';
          }, 160);

          galleryButtons.forEach(function(item) {
            item.classList.remove('rsp-active');
          });

          button.classList.add('rsp-active');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspProductPage);
    } else {
      initRspProductPage();
    }
  })();
</script>

<?php get_footer(); ?>