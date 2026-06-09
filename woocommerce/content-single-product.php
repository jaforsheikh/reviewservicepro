<?php

/**
 * Single Product Content Override
 *
 * File: woocommerce/content-single-product.php
 *
 * ReviewService.Pro — White SaaS Service Product Details Layout
 *
 * Purpose:
 * - Turn WooCommerce products into clean service package detail pages.
 * - Preserve product image/gallery, price, checkout/order flow, product meta, categories/tags.
 * - Keep ORM compliance wording safe and professional.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

global $product;

if (! $product instanceof WC_Product) {
  $product = wc_get_product(get_the_ID());
}

if (! $product instanceof WC_Product) {
  return;
}

$product_id          = $product->get_id();
$product_title       = $product->get_name();
$product_price_html  = $product->get_price_html();
$product_excerpt     = $product->get_short_description();
$product_description = get_post_field('post_content', $product_id);
$product_image_id    = $product->get_image_id();
$product_gallery_ids = $product->get_gallery_image_ids();
$product_categories  = wc_get_product_category_list($product_id, ', ');
$product_tags        = wc_get_product_tag_list($product_id, ', ');

$pricing_url  = home_url('/pricing/');
$services_url = home_url('/services/');
$contact_url  = home_url('/contact/?type=product-help&service=' . rawurlencode($product_title));

/**
 * Render icon with fallback.
 */
$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

/**
 * Meta helper: supports both ReviewService.Pro underscore meta and older ACF/plain keys.
 */
$get_service_field = static function ($keys, $default = '') use ($product_id) {
  $keys = is_array($keys) ? $keys : [$keys];

  foreach ($keys as $key) {
    $key = (string) $key;

    if ('' === $key) {
      continue;
    }

    if (function_exists('get_field')) {
      $acf_value = get_field($key, $product_id);

      if (null !== $acf_value && '' !== $acf_value && [] !== $acf_value) {
        return $acf_value;
      }
    }

    $meta_value = get_post_meta($product_id, $key, true);

    if ('' !== $meta_value && null !== $meta_value && [] !== $meta_value) {
      return $meta_value;
    }
  }

  return $default;
};

/**
 * Normalize textarea/repeater/list fields.
 */
$normalize_list = static function ($raw_items, $fallback = []) {
  if (is_array($raw_items)) {
    $items = [];

    foreach ($raw_items as $item) {
      if (is_array($item)) {
        $text = $item['text'] ?? $item['deliverable'] ?? $item['item'] ?? $item['question'] ?? $item['title'] ?? '';
      } else {
        $text = $item;
      }

      $text = trim(wp_strip_all_tags((string) $text));

      if ('' !== $text) {
        $items[] = $text;
      }
    }

    return ! empty($items) ? array_values(array_unique($items)) : $fallback;
  }

  if (is_string($raw_items) && '' !== trim($raw_items)) {
    $parts = preg_split('/\r\n|\r|\n/', $raw_items);
    $items = [];

    foreach ($parts as $part) {
      $text = trim(wp_strip_all_tags((string) $part));

      if ('' !== $text) {
        $items[] = $text;
      }
    }

    return ! empty($items) ? array_values(array_unique($items)) : $fallback;
  }

  return $fallback;
};

/**
 * Checkout URL for simple service packages.
 */
$get_checkout_url = static function ($product_id, $fallback_url) {
  $product_id = absint($product_id);

  if (
    $product_id <= 0 ||
    ! class_exists('WooCommerce') ||
    ! function_exists('wc_get_product') ||
    ! function_exists('wc_get_checkout_url')
  ) {
    return $fallback_url;
  }

  $product = wc_get_product($product_id);

  if (! $product instanceof WC_Product || ! $product->is_purchasable() || ! $product->is_in_stock()) {
    return $fallback_url;
  }

  if ($product->is_type('variable')) {
    return $product->add_to_cart_url();
  }

  return add_query_arg(
    [
      'add-to-cart' => $product_id,
      'quantity'    => 1,
    ],
    wc_get_checkout_url()
  );
};

$package_badge = $get_service_field(
  ['_rsp_card_badge', 'package_badge'],
  $product->is_featured() ? __('Recommended Service', 'reviewservicepro') : __('Service Package', 'reviewservicepro')
);

$package_subtitle = $get_service_field(
  ['package_subtitle', '_rsp_package_subtitle'],
  __('A focused ethical reputation management service for trust-driven businesses.', 'reviewservicepro')
);

$platform_scope = $get_service_field(
  ['_rsp_platform_scope', 'included_platform_count', 'platform_scope'],
  __('Based on package scope', 'reviewservicepro')
);

$best_for = $get_service_field(
  ['_rsp_best_for', 'best_for'],
  __('Businesses that want a clear, low-risk first step before ongoing monthly reputation management.', 'reviewservicepro')
);

$service_timeline = $get_service_field(
  ['_rsp_service_timeline', 'delivery_timeline'],
  __('Timeline shown after order confirmation', 'reviewservicepro')
);

$primary_cta_label = $get_service_field(
  ['_rsp_cta_label', 'order_cta_text'],
  __('Order Now', 'reviewservicepro')
);

$secondary_cta_label = $get_service_field(
  ['_rsp_secondary_cta_label', 'secondary_cta_label'],
  __('Ask Before Ordering', 'reviewservicepro')
);

$included_items = $normalize_list(
  $get_service_field(['_rsp_included_items', 'deliverables'], []),
  [
    __('Clear service scope and reputation review', 'reviewservicepro'),
    __('Professional recommendations based on visible trust signals', 'reviewservicepro'),
    __('Client portal access after payment', 'reviewservicepro'),
  ]
);

$card_deliverables = $normalize_list(
  $get_service_field(['_rsp_card_deliverables', '_rsp_included_items', 'deliverables'], []),
  [
    __('Clear service scope', 'reviewservicepro'),
    __('Professional recommendations', 'reviewservicepro'),
    __('Client portal access after payment', 'reviewservicepro'),
  ]
);

$not_included_items = $normalize_list(
  $get_service_field(['_rsp_not_included', 'not_included'], []),
  [
    __('Fake reviews or paid review incentives', 'reviewservicepro'),
    __('Guaranteed negative review removal', 'reviewservicepro'),
    __('Guaranteed 5-star ratings or ranking outcomes', 'reviewservicepro'),
  ]
);

$onboarding_items = $normalize_list(
  $get_service_field(['_rsp_onboarding_items', 'onboarding_questions'], []),
  [
    __('Business name and website URL', 'reviewservicepro'),
    __('Review platform links you want checked', 'reviewservicepro'),
    __('Main reputation concern or review issue', 'reviewservicepro'),
    __('Screenshots or review examples if needed', 'reviewservicepro'),
  ]
);

$upgrade_note_title = $get_service_field(
  ['_rsp_upgrade_note_title', 'upgrade_note_title'],
  __('Upgrade path', 'reviewservicepro')
);

$upgrade_note_text = $get_service_field(
  ['_rsp_upgrade_note_text', 'upgrade_offer'],
  __('If ongoing monitoring, response management, and reporting are needed, this service can help you decide whether a monthly ORM plan is the right next step.', 'reviewservicepro')
);

$related_monthly_note = $get_service_field(
  ['_rsp_related_monthly_note', 'related_monthly_plan'],
  __('Monthly ORM plans are available on the Services page.', 'reviewservicepro')
);

$compliance_note = $get_service_field(
  ['_rsp_product_compliance_note', 'compliance_note'],
  __('ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on ethical monitoring, response support, documentation, platform-compliant reporting, and transparent reputation improvement.', 'reviewservicepro')
);

$checkout_url = $get_checkout_url($product_id, $contact_url);
$can_order    = $product->is_purchasable() && $product->is_in_stock();

$gallery_items = [];

if ($product_image_id) {
  $gallery_items[] = $product_image_id;
}

if (! empty($product_gallery_ids)) {
  foreach ($product_gallery_ids as $gallery_id) {
    $gallery_id = absint($gallery_id);

    if ($gallery_id && ! in_array($gallery_id, $gallery_items, true)) {
      $gallery_items[] = $gallery_id;
    }
  }
}

$main_image_url = $product_image_id ? wp_get_attachment_image_url($product_image_id, 'full') : wc_placeholder_img_src('woocommerce_single');
$main_image_alt = $product_image_id ? get_post_meta($product_image_id, '_wp_attachment_image_alt', true) : $product_title;

if ('' === $main_image_alt) {
  $main_image_alt = $product_title;
}

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
  #rsp-single-service-product {
    --rsp-service-title: #334155;
    --rsp-service-heading: #3B4658;
    --rsp-service-body: #64748B;
    --rsp-service-muted: #94A3B8;
    --rsp-service-blue: #2563EB;
    --rsp-service-green: #00C853;
    --rsp-service-border: rgba(148, 163, 184, 0.24);
  }

  #rsp-single-service-product,
  #rsp-single-service-product p,
  #rsp-single-service-product li,
  #rsp-single-service-product a,
  #rsp-single-service-product span,
  #rsp-single-service-product button,
  #rsp-single-service-product div {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  #rsp-single-service-product h1,
  #rsp-single-service-product h2,
  #rsp-single-service-product h3,
  #rsp-single-service-product h4,
  #rsp-single-service-product .rsp-service-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-service-heading);
    letter-spacing: -0.032em;
  }

  #rsp-single-service-product .rsp-service-title {
    color: var(--rsp-service-title) !important;
    font-size: clamp(32px, 4vw, 46px);
    font-weight: 700;
    line-height: 1.08;
    letter-spacing: -0.04em;
    text-wrap: balance;
  }

  #rsp-single-service-product .rsp-service-text {
    color: var(--rsp-service-body);
    font-size: 16px;
    font-weight: 400;
    line-height: 1.76;
  }

  #rsp-single-service-product .rsp-service-eyebrow {
    font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
  }

  #rsp-single-service-product .rsp-service-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    border: 1px solid var(--rsp-service-border);
    border-radius: 1.6rem;
    background: rgba(255, 255, 255, 0.96);
    box-shadow: 0 16px 52px rgba(15, 23, 42, 0.07);
    transition:
      transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 240ms ease,
      border-color 240ms ease;
  }

  #rsp-single-service-product .rsp-service-card:hover {
    transform: translateY(-3px);
    border-color: rgba(37, 99, 235, 0.28);
    box-shadow: 0 22px 68px rgba(15, 23, 42, 0.10);
  }

  #rsp-single-service-product .rsp-service-card-soft {
    background: rgba(255, 255, 255, 0.92);
  }

  #rsp-single-service-product .rsp-service-reveal {
    opacity: 0;
    transform: translateY(18px);
    transition:
      opacity 680ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 680ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #rsp-single-service-product .rsp-service-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  #rsp-single-service-product .rsp-service-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 220ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 220ms ease,
      background-color 220ms ease,
      border-color 220ms ease,
      color 220ms ease;
  }

  #rsp-single-service-product .rsp-service-btn::before {
    content: "";
    position: absolute;
    left: -120%;
    top: 0;
    width: 70%;
    height: 100%;
    transform: skewX(-18deg);
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.32), transparent);
    transition: left 620ms ease;
    pointer-events: none;
  }

  #rsp-single-service-product .rsp-service-btn:hover {
    transform: translateY(-2px);
  }

  #rsp-single-service-product .rsp-service-btn:hover::before {
    left: 135%;
  }

  #rsp-single-service-product .rsp-service-thumbnail {
    opacity: 0.78;
  }

  #rsp-single-service-product .rsp-service-thumbnail.rsp-active,
  #rsp-single-service-product .rsp-service-thumbnail:hover {
    opacity: 1;
    transform: translateY(-2px);
    border-color: rgba(37, 99, 235, 0.65);
  }

  #rsp-single-service-product .rsp-service-description :where(p, li) {
    color: var(--rsp-service-body);
    font-size: 16px;
    font-weight: 400;
    line-height: 1.78;
  }

  #rsp-single-service-product .rsp-service-description :where(h2, h3, h4) {
    margin-top: 1.7rem;
    margin-bottom: 0.75rem;
    color: var(--rsp-service-heading);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
  }

  #rsp-single-service-product .rsp-service-description :where(a) {
    color: var(--rsp-service-blue);
    text-decoration: none;
    font-weight: 700;
  }

  #rsp-single-service-product .rsp-service-description :where(ul, ol) {
    margin-top: 1rem;
    margin-bottom: 1rem;
    padding-left: 1.25rem;
  }

  #rsp-single-service-product .price,
  #rsp-single-service-product .amount {
    color: var(--rsp-service-title) !important;
    font-family: "Poppins", system-ui, sans-serif;
    font-weight: 700;
  }

  #rsp-single-service-product del .amount {
    color: #94A3B8 !important;
    font-size: 0.78em;
    font-weight: 600;
  }

  #rsp-single-service-product ins {
    text-decoration: none;
  }

  @media (max-width: 640px) {
    #rsp-single-service-product .rsp-service-title {
      font-size: 32px;
      line-height: 1.12;
      letter-spacing: -0.032em;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #rsp-single-service-product *,
    #rsp-single-service-product *::before,
    #rsp-single-service-product *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
      scroll-behavior: auto !important;
    }

    #rsp-single-service-product .rsp-service-reveal {
      opacity: 1;
      transform: none;
    }

    #rsp-single-service-product .rsp-service-card:hover,
    #rsp-single-service-product .rsp-service-btn:hover,
    #rsp-single-service-product .rsp-service-thumbnail:hover {
      transform: none;
    }
  }
</style>

<article
  id="rsp-single-service-product"
  <?php wc_product_class('relative overflow-hidden bg-[#F8FAFC] text-[#334155]', $product); ?>>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[480px] w-[480px] rounded-full bg-blue-200/40 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 top-72 z-0 h-[480px] w-[480px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

  <section class="relative z-10 px-5 pb-12 pt-20 sm:px-6 lg:px-8 lg:pb-16 lg:pt-24">
    <div class="mx-auto max-w-7xl">

      <nav class="rsp-service-reveal mb-7 flex flex-wrap items-center gap-2 font-['Inter',sans-serif] text-[13px] font-[600] text-[#94A3B8]" aria-label="<?php esc_attr_e('Breadcrumb', 'reviewservicepro'); ?>">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-[#64748B] no-underline transition-colors duration-200 hover:text-[#2563EB]">
          <?php esc_html_e('Home', 'reviewservicepro'); ?>
        </a>
        <span>/</span>
        <a href="<?php echo esc_url($pricing_url); ?>" class="text-[#64748B] no-underline transition-colors duration-200 hover:text-[#2563EB]">
          <?php esc_html_e('Pricing', 'reviewservicepro'); ?>
        </a>
        <span>/</span>
        <span class="text-[#334155]"><?php echo esc_html($product_title); ?></span>
      </nav>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.94fr_1.06fr] lg:items-start xl:gap-10">

        <section class="rsp-service-reveal">
          <div class="rsp-service-card p-3">
            <div class="relative overflow-hidden rounded-[1.25rem] border border-slate-200 bg-white">
              <img
                id="rsp-main-product-image"
                src="<?php echo esc_url($main_image_url); ?>"
                alt="<?php echo esc_attr($main_image_alt); ?>"
                class="h-auto w-full object-cover transition-all duration-500"
                loading="eager"
                decoding="async">
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
                    class="rsp-service-thumbnail <?php echo 0 === $index ? 'rsp-active' : ''; ?> overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-sm transition-all duration-300"
                    data-rsp-gallery-image="<?php echo esc_url($full_url); ?>"
                    data-rsp-gallery-alt="<?php echo esc_attr($alt); ?>"
                    aria-label="<?php echo esc_attr(sprintf(__('View image %d', 'reviewservicepro'), absint($index + 1))); ?>">
                    <img
                      src="<?php echo esc_url($thumb_url); ?>"
                      alt="<?php echo esc_attr($alt); ?>"
                      class="aspect-square w-full rounded-lg object-cover"
                      loading="lazy"
                      decoding="async">
                  </button>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </section>

        <section class="rsp-service-reveal" style="transition-delay:90ms;">
          <div class="rsp-service-card p-6 md:p-8">
            <span class="rsp-service-eyebrow inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
              <?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php echo esc_html($package_badge); ?>
            </span>

            <h1 class="rsp-service-title mt-5">
              <?php echo esc_html($product_title); ?>
            </h1>

            <?php if ($product_excerpt) : ?>
              <div class="rsp-service-text mt-5 max-w-3xl">
                <?php echo wp_kses_post(wpautop($product_excerpt)); ?>
              </div>
            <?php else : ?>
              <p class="rsp-service-text mt-5 max-w-3xl">
                <?php echo esc_html($package_subtitle); ?>
              </p>
            <?php endif; ?>

            <div class="mt-7 rounded-2xl border border-slate-200 bg-slate-50 p-5">
              <p class="rsp-service-eyebrow text-[#94A3B8]">
                <?php esc_html_e('Service Price', 'reviewservicepro'); ?>
              </p>

              <div class="mt-2 text-[30px] font-[700] leading-none tracking-[-0.035em] text-[#334155]">
                <?php echo wp_kses_post($product_price_html); ?>
              </div>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
              <div class="rounded-2xl border border-blue-200 bg-blue-50 p-4">
                <div class="flex items-center gap-2 font-['Inter',sans-serif] text-[14px] font-[700] text-blue-700">
                  <?php echo $render_icon('clock-3', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                  <?php esc_html_e('Timeline', 'reviewservicepro'); ?>
                </div>

                <p class="mt-2 font-['Inter',sans-serif] text-[14px] font-[400] leading-6 text-[#64748B]">
                  <?php echo esc_html($service_timeline); ?>
                </p>
              </div>

              <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                <div class="flex items-center gap-2 font-['Inter',sans-serif] text-[14px] font-[700] text-emerald-700">
                  <?php echo $render_icon('badge-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                  <?php esc_html_e('Platform Scope', 'reviewservicepro'); ?>
                </div>

                <p class="mt-2 font-['Inter',sans-serif] text-[14px] font-[400] leading-6 text-[#64748B]">
                  <?php echo esc_html($platform_scope); ?>
                </p>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
              <a
                href="<?php echo esc_url($checkout_url); ?>"
                class="rsp-service-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-[700] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <?php echo esc_html($can_order ? $primary_cta_label : __('Contact Support', 'reviewservicepro')); ?>
                  <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </span>
              </a>

              <a
                href="<?php echo esc_url($contact_url); ?>"
                class="rsp-service-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[15px] font-[700] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <?php echo esc_html($secondary_cta_label); ?>
                  <?php echo $render_icon('message-square', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </span>
              </a>
            </div>

            <div class="mt-5 rounded-2xl border border-amber-200 bg-amber-50 p-4">
              <p class="font-['Inter',sans-serif] text-[14px] font-[400] leading-7 text-amber-800">
                <?php echo esc_html($compliance_note); ?>
              </p>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>

  <section class="relative z-10 px-5 pb-12 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">

        <article class="rsp-service-card rsp-service-reveal p-6">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-700">
            <?php echo $render_icon('check-circle-2', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h2 class="text-[20px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
            <?php esc_html_e('What’s included', 'reviewservicepro'); ?>
          </h2>

          <ul class="mt-4 space-y-3" role="list">
            <?php foreach ($included_items as $item) : ?>
              <li class="flex items-start gap-2 font-['Inter',sans-serif] text-[15px] font-[400] leading-7 text-[#64748B]">
                <?php echo $render_icon('check', 'mt-1 h-4 w-4 shrink-0 text-emerald-600'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </article>

        <article class="rsp-service-card rsp-service-reveal p-6" style="transition-delay:80ms;">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-700">
            <?php echo $render_icon('target', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h2 class="text-[20px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
            <?php esc_html_e('Best for', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 font-['Inter',sans-serif] text-[15px] font-[400] leading-7 text-[#64748B]">
            <?php echo esc_html($best_for); ?>
          </p>

          <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
            <p class="rsp-service-eyebrow text-emerald-700">
              <?php echo esc_html($upgrade_note_title); ?>
            </p>

            <p class="mt-2 font-['Inter',sans-serif] text-[14px] font-[400] leading-7 text-[#64748B]">
              <?php echo esc_html($upgrade_note_text); ?>
            </p>
          </div>
        </article>

        <article class="rsp-service-card rsp-service-reveal border-amber-200 bg-amber-50/60 p-6" style="transition-delay:160ms;">
          <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl border border-amber-200 bg-white text-amber-700">
            <?php echo $render_icon('shield-alert', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h2 class="text-[20px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
            <?php esc_html_e('Not included', 'reviewservicepro'); ?>
          </h2>

          <ul class="mt-4 space-y-3" role="list">
            <?php foreach ($not_included_items as $item) : ?>
              <li class="flex items-start gap-2 font-['Inter',sans-serif] text-[15px] font-[400] leading-7 text-[#64748B]">
                <?php echo $render_icon('ban', 'mt-1 h-4 w-4 shrink-0 text-amber-600'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </article>

      </div>
    </div>
  </section>

  <section class="relative z-10 px-5 pb-12 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1.05fr_0.95fr]">

        <article class="rsp-service-card rsp-service-reveal p-6 md:p-8">
          <span class="rsp-service-eyebrow inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
            <?php echo $render_icon('file-text', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Service Details', 'reviewservicepro'); ?>
          </span>

          <div class="rsp-service-description mt-5 max-w-none">
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
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                  <p class="font-['Inter',sans-serif] text-[15px] font-[700] text-[#3B4658]">
                    <?php esc_html_e('Quick deliverables', 'reviewservicepro'); ?>
                  </p>

                  <ul class="mt-3 grid grid-cols-1 gap-2 sm:grid-cols-2" role="list">
                    <?php foreach ($card_deliverables as $deliverable) : ?>
                      <li class="flex items-start gap-2 font-['Inter',sans-serif] text-[14px] font-[400] leading-6 text-[#64748B]">
                        <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-emerald-600'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                        <span><?php echo esc_html($deliverable); ?></span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <div class="flex flex-wrap gap-3 font-['Inter',sans-serif] text-[14px] text-[#64748B]">
                <?php if ($product_categories) : ?>
                  <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5">
                    <strong class="font-[700] text-[#3B4658]"><?php esc_html_e('Category:', 'reviewservicepro'); ?></strong>
                    <?php echo wp_kses_post($product_categories); ?>
                  </span>
                <?php endif; ?>

                <?php if ($product_tags) : ?>
                  <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5">
                    <strong class="font-[700] text-[#3B4658]"><?php esc_html_e('Tags:', 'reviewservicepro'); ?></strong>
                    <?php echo wp_kses_post($product_tags); ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </article>

        <article class="rsp-service-card rsp-service-reveal p-6 md:p-8" style="transition-delay:90ms;">
          <span class="rsp-service-eyebrow inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
            <?php echo $render_icon('clipboard-list', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('After Payment', 'reviewservicepro'); ?>
          </span>

          <h2 class="mt-5 text-[24px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
            <?php esc_html_e('What we collect during onboarding', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-service-text mt-3">
            <?php esc_html_e('To keep checkout simple, detailed service information is collected after payment inside the client portal/onboarding workflow.', 'reviewservicepro'); ?>
          </p>

          <ul class="mt-5 grid grid-cols-1 gap-3" role="list">
            <?php foreach ($onboarding_items as $item) : ?>
              <li class="flex items-start gap-2 font-['Inter',sans-serif] text-[15px] font-[400] leading-7 text-[#64748B]">
                <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-emerald-600'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="mt-6 rounded-2xl border border-blue-200 bg-blue-50 p-4">
            <p class="rsp-service-eyebrow text-blue-700">
              <?php esc_html_e('Related monthly option', 'reviewservicepro'); ?>
            </p>

            <p class="mt-2 font-['Inter',sans-serif] text-[14px] font-[400] leading-7 text-[#64748B]">
              <?php echo esc_html($related_monthly_note); ?>
            </p>

            <a
              href="<?php echo esc_url($services_url); ?>"
              class="mt-4 inline-flex items-center gap-2 font-['Inter',sans-serif] text-[14px] font-[700] text-blue-700 no-underline transition-colors duration-200 hover:text-blue-800">
              <?php esc_html_e('View monthly ORM plans', 'reviewservicepro'); ?>
              <?php echo $render_icon('arrow-up-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <?php if ($cluster_related_links || $cluster_faq_block) : ?>
    <section class="relative z-10 px-5 pb-12 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl space-y-6">
        <?php
        echo wp_kses_post($cluster_related_links);
        echo wp_kses_post($cluster_faq_block);
        ?>
      </div>
    </section>
  <?php endif; ?>

  <section class="relative z-20 px-5 pb-16 sm:px-6 lg:px-8 lg:pb-20">
    <div class="mx-auto max-w-7xl">
      <div class="rsp-service-card rsp-service-reveal border-blue-200 bg-blue-50/80 p-5 md:p-6">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <h2 class="text-[24px] font-[700] leading-tight tracking-[-0.03em] text-[#3B4658]">
              <?php esc_html_e('Ready to order this reputation service?', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-service-text mt-2 max-w-3xl">
              <?php esc_html_e('Complete secure checkout, then continue your service onboarding inside your ReviewService.Pro client portal.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row">
            <a
              href="<?php echo esc_url($checkout_url); ?>"
              class="rsp-service-btn inline-flex min-h-[50px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-[700] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php echo esc_html($can_order ? $primary_cta_label : __('Contact Support', 'reviewservicepro')); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>

            <a
              href="<?php echo esc_url($pricing_url); ?>"
              class="rsp-service-btn inline-flex min-h-[50px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[15px] font-[700] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-white hover:text-blue-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Back to Pricing', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</article>

<script>
  (function() {
    function initRspSingleServiceProduct() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('#rsp-single-service-product .rsp-service-reveal');

      function showItem(item) {
        if (!item || item.dataset.rspVisible === 'true') {
          return;
        }

        item.dataset.rspVisible = 'true';
        item.classList.add('rsp-visible');
      }

      if ('IntersectionObserver' in window && revealItems.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              showItem(entry.target);
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
        revealItems.forEach(showItem);
      }

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
      document.addEventListener('DOMContentLoaded', initRspSingleServiceProduct);
    } else {
      initRspSingleServiceProduct();
    }
  })();
</script>