<?php

/**
 * Single Product Content Override
 *
 * File: woocommerce/content-single-product.php
 *
 * ReviewService.Pro — Premium Service Package Details Layout
 *
 * Purpose:
 * - Replace normal ecommerce product layout with premium service package page.
 * - Keep WooCommerce as checkout/order/client-account system.
 * - Support dynamic product data + optional ACF fields.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

global $product;

if (! $product || ! is_a($product, 'WC_Product')) {
  return;
}

$product_id          = $product->get_id();
$product_title       = get_the_title($product_id);
$product_permalink   = get_permalink($product_id);
$product_price       = $product->get_price_html();
$product_excerpt     = $product->get_short_description();
$product_description = get_post_field('post_content', $product_id);
$product_image_id    = $product->get_image_id();
$product_gallery_ids = $product->get_gallery_image_ids();
$product_categories  = wc_get_product_category_list($product_id, ', ');
$product_tags        = wc_get_product_tag_list($product_id, ', ');

/**
 * Local ACF/meta field helper.
 */
if (! function_exists('rsp_single_service_get_field')) {
  function rsp_single_service_get_field($field_name, $post_id, $default = '')
  {
    $field_name = sanitize_key($field_name);
    $post_id    = absint($post_id);

    if (! $post_id || '' === $field_name) {
      return $default;
    }

    if (function_exists('get_field')) {
      $acf_value = get_field($field_name, $post_id);

      if (null !== $acf_value && '' !== $acf_value && [] !== $acf_value) {
        return $acf_value;
      }
    }

    $meta_value = get_post_meta($post_id, $field_name, true);

    if ('' !== $meta_value && [] !== $meta_value) {
      return $meta_value;
    }

    return $default;
  }
}

/**
 * Normalize text/list fields.
 */
if (! function_exists('rsp_single_service_normalize_list')) {
  function rsp_single_service_normalize_list($raw_items, $fallback = [])
  {
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

      return ! empty($items) ? $items : $fallback;
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

      return ! empty($items) ? $items : $fallback;
    }

    return $fallback;
  }
}

/**
 * Direct checkout URL.
 */
if (! function_exists('rsp_single_service_checkout_url')) {
  function rsp_single_service_checkout_url($product_id, $fallback_url = '/contact/?type=pricing-help')
  {
    $product_id = absint($product_id);

    if (
      $product_id <= 0 ||
      ! class_exists('WooCommerce') ||
      ! function_exists('wc_get_product') ||
      ! function_exists('wc_get_checkout_url')
    ) {
      return home_url($fallback_url);
    }

    $product = wc_get_product($product_id);

    if (! $product || ! $product->is_purchasable()) {
      return home_url($fallback_url);
    }

    return add_query_arg(
      [
        'add-to-cart' => $product_id,
        'quantity'    => 1,
      ],
      wc_get_checkout_url()
    );
  }
}

$package_badge = rsp_single_service_get_field(
  'package_badge',
  $product_id,
  $product->is_featured() ? __('Recommended Service', 'reviewservicepro') : __('Service Package', 'reviewservicepro')
);

$package_subtitle = rsp_single_service_get_field(
  'package_subtitle',
  $product_id,
  __('A focused ethical reputation management service for trust-driven businesses.', 'reviewservicepro')
);

$best_for = rsp_single_service_get_field(
  'best_for',
  $product_id,
  __('Businesses that want a clear, low-risk first step before ongoing monthly reputation management.', 'reviewservicepro')
);

$delivery_timeline = rsp_single_service_get_field(
  'delivery_timeline',
  $product_id,
  __('Timeline shown after order confirmation', 'reviewservicepro')
);

$included_platform_count = rsp_single_service_get_field(
  'included_platform_count',
  $product_id,
  __('Based on package scope', 'reviewservicepro')
);

$deliverables = rsp_single_service_normalize_list(
  rsp_single_service_get_field('deliverables', $product_id, []),
  [
    __('Clear service scope and reputation review', 'reviewservicepro'),
    __('Professional recommendations based on visible trust signals', 'reviewservicepro'),
    __('Client portal access after payment', 'reviewservicepro'),
  ]
);

$not_included = rsp_single_service_normalize_list(
  rsp_single_service_get_field('not_included', $product_id, []),
  [
    __('Fake reviews or paid review incentives', 'reviewservicepro'),
    __('Guaranteed negative review removal', 'reviewservicepro'),
    __('Guaranteed 5-star ratings or ranking outcomes', 'reviewservicepro'),
  ]
);

$onboarding_questions = rsp_single_service_normalize_list(
  rsp_single_service_get_field('onboarding_questions', $product_id, []),
  [
    __('Business name and website URL', 'reviewservicepro'),
    __('Review platform links you want checked', 'reviewservicepro'),
    __('Main reputation concern or review issue', 'reviewservicepro'),
    __('Screenshots or review examples if needed', 'reviewservicepro'),
  ]
);

$upgrade_offer = rsp_single_service_get_field(
  'upgrade_offer',
  $product_id,
  __('If ongoing monitoring, response management, and reporting are needed, this service can help you decide whether a monthly ORM plan is the right next step.', 'reviewservicepro')
);

$related_monthly_plan = rsp_single_service_get_field(
  'related_monthly_plan',
  $product_id,
  __('Monthly ORM plans are available on the Services page.', 'reviewservicepro')
);

$compliance_note = rsp_single_service_get_field(
  'compliance_note',
  $product_id,
  __('ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on ethical monitoring, response support, documentation, platform-compliant reporting, and transparent reputation improvement.', 'reviewservicepro')
);

$order_cta_text = rsp_single_service_get_field(
  'order_cta_text',
  $product_id,
  __('Order Now', 'reviewservicepro')
);

$checkout_url = rsp_single_service_checkout_url($product_id);
$pricing_url  = home_url('/pricing/');
$contact_url  = home_url('/contact/?type=service-question');

$all_gallery_ids = [];

if ($product_image_id) {
  $all_gallery_ids[] = $product_image_id;
}

if (! empty($product_gallery_ids)) {
  $all_gallery_ids = array_merge($all_gallery_ids, $product_gallery_ids);
}

$all_gallery_ids = array_values(array_unique(array_filter(array_map('absint', $all_gallery_ids))));
?>

<style>
  .rsp-single-service-reveal {
    opacity: 0;
    transform: translateY(22px);
    animation: rspSingleServiceReveal 760ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  .rsp-single-service-delay-1 {
    animation-delay: 110ms;
  }

  .rsp-single-service-delay-2 {
    animation-delay: 220ms;
  }

  @keyframes rspSingleServiceReveal {
    0% {
      opacity: 0;
      transform: translateY(22px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .rsp-single-service-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-single-service-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(circle at 12% 0%, rgba(37, 99, 235, 0.12), transparent 36%),
      radial-gradient(circle at 88% 100%, rgba(0, 200, 83, 0.12), transparent 36%);
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  .rsp-single-service-card:hover::before {
    opacity: 1;
  }

  .rsp-single-service-beam {
    animation: rspSingleServiceBeam 7s ease-in-out infinite;
  }

  @keyframes rspSingleServiceBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-single-service-reveal,
    .rsp-single-service-beam {
      opacity: 1;
      transform: none;
      animation: none;
    }
  }
</style>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('rsp-single-service-product', $product); ?>>

  <?php do_action('woocommerce_before_single_product'); ?>

  <section class="rsp-single-service-reveal grid grid-cols-1 gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-start">

    <!-- Gallery -->
    <div class="rsp-single-service-card rounded-[2rem] border border-white/[0.08] bg-white/[0.04] p-4 shadow-[0_24px_90px_rgba(0,0,0,0.22)] backdrop-blur-xl">
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10" aria-hidden="true">
        <div class="rsp-single-service-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10">
        <?php if (! empty($all_gallery_ids)) : ?>
          <div class="overflow-hidden rounded-[1.5rem] border border-white/[0.08] bg-white">
            <?php
            echo wp_get_attachment_image(
              $all_gallery_ids[0],
              'large',
              false,
              [
                'class' => 'h-auto w-full object-cover',
                'alt'   => esc_attr($product_title),
              ]
            );
            ?>
          </div>

          <?php if (count($all_gallery_ids) > 1) : ?>
            <div class="mt-4 grid grid-cols-4 gap-3">
              <?php foreach (array_slice($all_gallery_ids, 1, 4) as $image_id) : ?>
                <a
                  href="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'large')); ?>"
                  class="block overflow-hidden rounded-2xl border border-white/[0.10] bg-white/5 transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-400/30"
                  target="_blank"
                  rel="noopener">

                  <?php
                  echo wp_get_attachment_image(
                    $image_id,
                    'thumbnail',
                    false,
                    [
                      'class' => 'aspect-square h-full w-full object-cover',
                      'alt'   => esc_attr($product_title),
                    ]
                  );
                  ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php else : ?>
          <div class="flex min-h-[360px] items-center justify-center rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04]">
            <div class="text-center">
              <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-[#00C853]/10">
                <i data-lucide="image" class="h-7 w-7 text-[#00C853]" aria-hidden="true"></i>
              </div>
              <p class="mt-4 text-base font-normal text-white/70">
                <?php esc_html_e('Add a service package image in WooCommerce.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Summary -->
    <div class="rsp-single-service-reveal rsp-single-service-delay-1">
      <div class="rsp-single-service-card rounded-[2rem] border border-white/[0.08] bg-white/[0.04] p-5 shadow-[0_24px_90px_rgba(0,0,0,0.20)] backdrop-blur-xl md:p-6">

        <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10" aria-hidden="true">
          <div class="rsp-single-service-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
        </div>

        <div class="relative z-10">
          <div class="mb-5 flex flex-wrap items-center gap-3">
            <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-emerald-200">
              <i data-lucide="shield-check" class="h-4 w-4 text-[#00C853]" aria-hidden="true"></i>
              <?php echo esc_html($package_badge); ?>
            </span>

            <?php if ($product->is_featured()) : ?>
              <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
                <i data-lucide="badge-check" class="h-4 w-4 text-blue-300" aria-hidden="true"></i>
                <?php esc_html_e('Recommended', 'reviewservicepro'); ?>
              </span>
            <?php endif; ?>
          </div>

          <h2 class="text-4xl font-semibold leading-[1.04] tracking-[-0.055em] text-white md:text-5xl">
            <?php echo esc_html($product_title); ?>
          </h2>

          <p class="mt-4 text-base font-normal leading-8 text-white/78">
            <?php echo esc_html($package_subtitle); ?>
          </p>

          <?php if ($product_excerpt) : ?>
            <div class="mt-4 text-base font-normal leading-8 text-white/82">
              <?php echo wp_kses_post(wpautop($product_excerpt)); ?>
            </div>
          <?php endif; ?>

          <div class="mt-6 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.05] p-5">
            <p class="text-sm font-medium uppercase tracking-[0.14em] text-white/55">
              <?php esc_html_e('Service Price', 'reviewservicepro'); ?>
            </p>

            <div class="mt-2 text-4xl font-semibold leading-none tracking-[-0.05em] text-white">
              <?php echo wp_kses_post($product_price ? $product_price : __('Custom quote', 'reviewservicepro')); ?>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
              <div class="rounded-2xl border border-blue-400/20 bg-blue-500/10 p-3">
                <div class="flex items-center gap-2 text-sm font-medium text-blue-200">
                  <i data-lucide="clock-3" class="h-4 w-4 text-blue-300" aria-hidden="true"></i>
                  <?php esc_html_e('Timeline', 'reviewservicepro'); ?>
                </div>
                <p class="mt-1 text-base font-normal leading-6 text-white">
                  <?php echo esc_html($delivery_timeline); ?>
                </p>
              </div>

              <div class="rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 p-3">
                <div class="flex items-center gap-2 text-sm font-medium text-emerald-200">
                  <i data-lucide="layers-3" class="h-4 w-4 text-[#00C853]" aria-hidden="true"></i>
                  <?php esc_html_e('Platform Scope', 'reviewservicepro'); ?>
                </div>
                <p class="mt-1 text-base font-normal leading-6 text-white">
                  <?php echo esc_html($included_platform_count); ?>
                </p>
              </div>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
            <a
              href="<?php echo esc_url($checkout_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-4 text-base font-medium text-white shadow-lg shadow-blue-900/30 transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700">

              <?php echo esc_html($order_cta_text); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.05] px-6 py-4 text-base font-medium text-white transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/[0.09]">

              <?php esc_html_e('Ask Before Ordering', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4 text-blue-300" aria-hidden="true"></i>
            </a>
          </div>

          <p class="mt-4 rounded-2xl border border-amber-300/20 bg-amber-300/[0.08] p-4 text-sm font-normal leading-7 text-amber-100">
            <?php echo esc_html($compliance_note); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Details Grid -->
  <section class="rsp-single-service-reveal rsp-single-service-delay-2 mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

    <!-- Deliverables -->
    <article class="rsp-single-service-card rounded-[2rem] border border-white/[0.08] bg-white/[0.04] p-5 shadow-[0_18px_60px_rgba(0,0,0,0.16)] backdrop-blur-xl">
      <div class="relative z-10">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-[#00C853]/10">
          <i data-lucide="check-circle-2" class="h-5 w-5 text-[#00C853]" aria-hidden="true"></i>
        </div>

        <h3 class="text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
          <?php esc_html_e('What’s included', 'reviewservicepro'); ?>
        </h3>

        <ul class="mt-5 space-y-3" role="list">
          <?php foreach ($deliverables as $deliverable) : ?>
            <li class="flex items-start gap-3 text-base font-normal leading-7 text-white/78">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <span><?php echo esc_html($deliverable); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </article>

    <!-- Best For -->
    <article class="rsp-single-service-card rounded-[2rem] border border-white/[0.08] bg-white/[0.04] p-5 shadow-[0_18px_60px_rgba(0,0,0,0.16)] backdrop-blur-xl">
      <div class="relative z-10">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10">
          <i data-lucide="target" class="h-5 w-5 text-blue-300" aria-hidden="true"></i>
        </div>

        <h3 class="text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
          <?php esc_html_e('Best for', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-5 text-base font-normal leading-8 text-white/78">
          <?php echo esc_html($best_for); ?>
        </p>

        <div class="mt-5 rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 p-4">
          <p class="text-sm font-medium uppercase tracking-[0.14em] text-emerald-200">
            <?php esc_html_e('Upgrade path', 'reviewservicepro'); ?>
          </p>
          <p class="mt-2 text-base font-normal leading-7 text-white/78">
            <?php echo esc_html($upgrade_offer); ?>
          </p>
        </div>
      </div>
    </article>

    <!-- Not Included -->
    <article class="rsp-single-service-card rounded-[2rem] border border-amber-300/20 bg-amber-300/[0.06] p-5 shadow-[0_18px_60px_rgba(0,0,0,0.16)] backdrop-blur-xl">
      <div class="relative z-10">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10">
          <i data-lucide="shield-alert" class="h-5 w-5 text-amber-200" aria-hidden="true"></i>
        </div>

        <h3 class="text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
          <?php esc_html_e('Not included', 'reviewservicepro'); ?>
        </h3>

        <ul class="mt-5 space-y-3" role="list">
          <?php foreach ($not_included as $item) : ?>
            <li class="flex items-start gap-3 text-base font-normal leading-7 text-white/78">
              <i data-lucide="x-circle" class="mt-1 h-4 w-4 shrink-0 text-amber-200" aria-hidden="true"></i>
              <span><?php echo esc_html($item); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </article>
  </section>

  <!-- Description + Onboarding -->
  <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-[1.05fr_0.95fr]">

    <article class="rsp-single-service-card rounded-[2rem] border border-white/[0.08] bg-white/[0.04] p-5 shadow-[0_18px_60px_rgba(0,0,0,0.16)] backdrop-blur-xl md:p-6">
      <div class="relative z-10">
        <span class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-500/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
          <i data-lucide="file-text" class="h-4 w-4 text-blue-300" aria-hidden="true"></i>
          <?php esc_html_e('Service Details', 'reviewservicepro'); ?>
        </span>

        <div class="mt-5 prose prose-invert max-w-none text-base font-normal leading-8 text-white/78">
          <?php
          if ($product_description) {
            echo wp_kses_post(wpautop($product_description));
          } else {
            echo '<p>' . esc_html__('This service is designed to give your business a clear, ethical, and practical next step for improving online reputation signals.', 'reviewservicepro') . '</p>';
          }
          ?>
        </div>
      </div>
    </article>

    <article class="rsp-single-service-card rounded-[2rem] border border-white/[0.08] bg-white/[0.04] p-5 shadow-[0_18px_60px_rgba(0,0,0,0.16)] backdrop-blur-xl md:p-6">
      <div class="relative z-10">
        <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-emerald-200">
          <i data-lucide="clipboard-list" class="h-4 w-4 text-[#00C853]" aria-hidden="true"></i>
          <?php esc_html_e('After Payment', 'reviewservicepro'); ?>
        </span>

        <h3 class="mt-5 text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
          <?php esc_html_e('What we collect during onboarding', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-3 text-base font-normal leading-8 text-white/78">
          <?php esc_html_e('To keep checkout simple, detailed service information is collected after payment inside the client portal/onboarding workflow.', 'reviewservicepro'); ?>
        </p>

        <ul class="mt-5 space-y-3" role="list">
          <?php foreach ($onboarding_questions as $question) : ?>
            <li class="flex items-start gap-3 text-base font-normal leading-7 text-white/78">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <span><?php echo esc_html($question); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="mt-5 rounded-2xl border border-blue-400/20 bg-blue-500/10 p-4">
          <p class="text-sm font-medium uppercase tracking-[0.14em] text-blue-200">
            <?php esc_html_e('Related monthly option', 'reviewservicepro'); ?>
          </p>

          <p class="mt-2 text-base font-normal leading-7 text-white/78">
            <?php echo esc_html($related_monthly_plan); ?>
          </p>
        </div>
      </div>
    </article>
  </section>

  <!-- Bottom CTA -->
  <section class="mt-8 rounded-[2rem] border border-blue-400/20 bg-blue-500/[0.08] p-5 shadow-[0_18px_60px_rgba(0,0,0,0.16)] md:p-6">
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1fr_auto] lg:items-center">
      <div>
        <h3 class="text-2xl font-semibold leading-tight tracking-[-0.04em] text-white">
          <?php esc_html_e('Ready to order this reputation service?', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-2 text-base font-normal leading-8 text-white/78">
          <?php esc_html_e('Complete secure checkout, then continue your service onboarding inside your ReviewService.Pro client portal.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="flex flex-col gap-3 sm:flex-row">
        <a
          href="<?php echo esc_url($checkout_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-4 text-base font-medium text-white shadow-lg shadow-blue-900/30 transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700">

          <?php echo esc_html($order_cta_text); ?>
          <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
        </a>

        <a
          href="<?php echo esc_url($pricing_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.05] px-6 py-4 text-base font-medium text-white transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/[0.09]">

          <?php esc_html_e('Back to Pricing', 'reviewservicepro'); ?>
          <i data-lucide="arrow-left" class="h-4 w-4 text-blue-300" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>

  <?php do_action('woocommerce_after_single_product'); ?>

</div>