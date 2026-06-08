<?php

/**
 * Pricing Product Card Component
 *
 * File: template-parts/components/pricing-product-card.php
 *
 * Purpose:
 * - Display WooCommerce service products as premium pricing cards.
 * - Pull card content from ReviewService.Pro product meta fields.
 * - Support View Details + Direct Checkout.
 * - Keep compliance-safe service wording.
 *
 * Expected args:
 * - product: WC_Product object OR product ID
 * - fallback_url: string
 * - section_label: string
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$product_arg = $args['product'] ?? null;
$product     = null;

if ($product_arg instanceof WC_Product) {
  $product = $product_arg;
} elseif (is_numeric($product_arg) && function_exists('wc_get_product')) {
  $product = wc_get_product(absint($product_arg));
}

if (! $product instanceof WC_Product) {
  return;
}

$product_id      = $product->get_id();
$title           = $product->get_name();
$permalink       = get_permalink($product_id);
$price_html      = $product->get_price_html();
$short_desc      = $product->get_short_description();
$is_featured     = $product->is_featured();
$is_purchasable  = $product->is_purchasable() && $product->is_in_stock();

$fallback_url = ! empty($args['fallback_url'])
  ? esc_url_raw($args['fallback_url'])
  : home_url('/contact/?type=pricing-help');

$section_label = ! empty($args['section_label'])
  ? sanitize_text_field($args['section_label'])
  : __('Reputation Service', 'reviewservicepro');

/**
 * Local safe meta getter.
 */
$rsp_card_get_meta = static function ($key, $default = '') use ($product_id) {
  $value = get_post_meta($product_id, sanitize_key($key), true);

  if ('' === $value || null === $value) {
    return $default;
  }

  return is_string($value) ? $value : $default;
};

/**
 * Local textarea line parser.
 */
$rsp_card_lines = static function ($raw, $fallback = []) {
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

/**
 * Product meta fields from:
 * inc/woocommerce-product-meta.php
 */
$card_badge = $rsp_card_get_meta(
  '_rsp_card_badge',
  $section_label
);

$platform_scope = $rsp_card_get_meta(
  '_rsp_platform_scope',
  __('Based on package scope', 'reviewservicepro')
);

$best_for = $rsp_card_get_meta(
  '_rsp_best_for',
  __('Businesses that want a focused, ethical reputation service.', 'reviewservicepro')
);

$primary_cta_label = $rsp_card_get_meta(
  '_rsp_cta_label',
  __('Order Now', 'reviewservicepro')
);

$deliverables = $rsp_card_lines(
  $rsp_card_get_meta('_rsp_card_deliverables'),
  [
    __('Clear service scope', 'reviewservicepro'),
    __('Professional recommendations', 'reviewservicepro'),
    __('Client portal access after payment', 'reviewservicepro'),
  ]
);

$deliverables = array_slice($deliverables, 0, 3);

/**
 * Product image.
 */
$image_id = $product->get_image_id();

$image_url = $image_id
  ? wp_get_attachment_image_url($image_id, 'large')
  : wc_placeholder_img_src('woocommerce_single');

$image_alt = $image_id
  ? get_post_meta($image_id, '_wp_attachment_image_alt', true)
  : $title;

if ('' === $image_alt) {
  $image_alt = $title;
}

/**
 * Direct checkout URL.
 */
$checkout_url = $is_purchasable
  ? add_query_arg(
    [
      'add-to-cart' => $product_id,
      'quantity'    => 1,
    ],
    wc_get_checkout_url()
  )
  : $fallback_url;
?>

<article
  class="rsp-pricing-product-card group relative flex h-full flex-col overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-[0_24px_80px_rgba(37,99,235,0.14)]"
  data-rsp-pricing-card>

  <div
    class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
    style="background: radial-gradient(420px circle at var(--rsp-card-x,50%) var(--rsp-card-y,50%), rgba(37,99,235,0.10), transparent 42%), radial-gradient(340px circle at var(--rsp-card-x,50%) var(--rsp-card-y,50%), rgba(0,200,83,0.08), transparent 38%);">
  </div>

  <div class="relative z-10 flex h-full flex-col">

    <!-- Image -->
    <div class="relative overflow-hidden rounded-[1.25rem] border border-slate-200 bg-slate-50">
      <a href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr($title); ?>">
        <img
          src="<?php echo esc_url($image_url); ?>"
          alt="<?php echo esc_attr($image_alt); ?>"
          class="aspect-[16/10] w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
          loading="lazy">
      </a>

      <div class="absolute left-3 top-3 flex flex-wrap gap-2">
        <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-white/90 px-3 py-1 text-xs font-medium uppercase tracking-[0.12em] text-blue-700 backdrop-blur">
          <i data-lucide="shield-check" class="h-3.5 w-3.5" aria-hidden="true"></i>
          <?php echo esc_html($card_badge); ?>
        </span>

        <?php if ($is_featured) : ?>
          <span class="inline-flex items-center gap-1.5 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-3 py-1 text-xs font-medium uppercase tracking-[0.12em] text-[#047A35] backdrop-blur">
            <i data-lucide="star" class="h-3.5 w-3.5" aria-hidden="true"></i>
            <?php esc_html_e('Recommended', 'reviewservicepro'); ?>
          </span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Content -->
    <div class="mt-5 flex flex-1 flex-col">
      <h3 class="text-2xl font-semibold leading-tight tracking-[-0.04em] text-[#020617]">
        <a href="<?php echo esc_url($permalink); ?>" class="transition-colors duration-200 hover:text-blue-600">
          <?php echo esc_html($title); ?>
        </a>
      </h3>

      <?php if ($short_desc) : ?>
        <div class="mt-3 line-clamp-3 text-base font-normal leading-7 text-slate-600">
          <?php echo wp_kses_post(wpautop($short_desc)); ?>
        </div>
      <?php else : ?>
        <p class="mt-3 text-base font-normal leading-7 text-slate-600">
          <?php esc_html_e('A focused reputation management service designed for trust-driven businesses.', 'reviewservicepro'); ?>
        </p>
      <?php endif; ?>

      <!-- Price + scope -->
      <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <p class="text-xs font-medium uppercase tracking-[0.14em] text-slate-500">
              <?php esc_html_e('Service Price', 'reviewservicepro'); ?>
            </p>

            <div class="mt-1 text-2xl font-semibold tracking-[-0.035em] text-[#020617]">
              <?php echo wp_kses_post($price_html); ?>
            </div>
          </div>

          <span class="inline-flex w-fit rounded-full border border-[#00C853]/20 bg-[#00C853]/10 px-3 py-1 text-xs font-medium text-[#047A35]">
            <?php echo esc_html($platform_scope); ?>
          </span>
        </div>
      </div>

      <!-- Best for + deliverables -->
      <div class="mt-5 grid grid-cols-1 gap-3">
        <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4">
          <p class="text-sm font-medium text-blue-700">
            <?php esc_html_e('Best for', 'reviewservicepro'); ?>
          </p>

          <p class="mt-1 text-sm font-normal leading-6 text-slate-700">
            <?php echo esc_html($best_for); ?>
          </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <p class="text-sm font-medium text-[#020617]">
            <?php esc_html_e('What you get', 'reviewservicepro'); ?>
          </p>

          <ul class="mt-3 space-y-2" role="list">
            <?php foreach ($deliverables as $deliverable) : ?>
              <li class="flex items-start gap-2 text-sm font-normal leading-6 text-slate-600">
                <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
                <span><?php echo esc_html($deliverable); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- Compliance -->
      <div class="mt-5 rounded-2xl border border-amber-200 bg-amber-50 p-4">
        <p class="text-xs font-normal leading-6 text-amber-800">
          <?php esc_html_e('Platform-compliant service only. No fake reviews, paid review incentives, guaranteed removals, guaranteed 5-star ratings, or ranking guarantees.', 'reviewservicepro'); ?>
        </p>
      </div>

      <!-- CTA -->
      <div class="mt-auto grid grid-cols-1 gap-3 pt-6 sm:grid-cols-2">
        <a
          href="<?php echo esc_url($permalink); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-base font-medium text-[#020617] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50">

          <?php esc_html_e('View Details', 'reviewservicepro'); ?>
          <i data-lucide="arrow-up-right" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
        </a>

        <a
          href="<?php echo esc_url($checkout_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-4 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700">

          <?php echo esc_html($primary_cta_label); ?>
          <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
        </a>
      </div>
    </div>

  </div>
</article>