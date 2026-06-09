<?php

/**
 * Pricing ORM Add-ons & Small Services Section
 *
 * File: template-parts/sections/pricing/add-ons.php
 *
 * Purpose:
 * - Display ORM add-on products dynamically from WooCommerce.
 * - Uses product category slug: orm-add-ons
 * - Uses component: template-parts/components/pricing-product-card.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

// Context configuration with strong fallbacks
$context = isset($args) && is_array($args) ? $args : [];

$category_slug = ! empty($context['categories']['addons'])
  ? sanitize_title($context['categories']['addons'])
  : 'orm-add-ons';

$contact_url = ! empty($context['contact_url'])
  ? esc_url_raw($context['contact_url'])
  : home_url('/contact/?type=pricing-help');

$services_url = ! empty($context['services_page_url'])
  ? esc_url_raw($context['services_page_url'])
  : home_url('/services/');

$products = [];

// Fetch products safely only if WooCommerce is active
if (class_exists('WooCommerce') && function_exists('wc_get_products')) {
  $products = wc_get_products(
    [
      'status'   => 'publish',
      'limit'    => -1,
      'category' => [$category_slug],
      'orderby'  => 'menu_order',
      'order'    => 'ASC',
      'return'   => 'objects',
    ]
  );
}

$product_count = is_array($products) ? count($products) : 0;
?>

<style>
  .rsp-pricing-addons-reveal {
    opacity: 0;
    transform: translateY(20px);
    will-change: transform, opacity;
    transition: opacity 720ms cubic-bezier(0.16, 1, 0.3, 1), transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-pricing-addons-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-pricing-addons-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-pricing-addons-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background: radial-gradient(circle at 10% 0%, rgba(37, 99, 235, 0.08), transparent 35%),
      radial-gradient(circle at 90% 100%, rgba(0, 200, 83, 0.08), transparent 35%);
    pointer-events: none;
    transition: opacity 300ms ease;
    z-index: 1;
  }

  .rsp-pricing-addons-card:hover::before {
    opacity: 1;
  }

  .rsp-pricing-addons-beam {
    animation: rspPricingAddonsBeam 6s cubic-bezier(0.4, 0, 0.2, 1) infinite;
  }

  @keyframes rspPricingAddonsBeam {
    0% {
      transform: translateX(-100%);
    }

    100% {
      transform: translateX(100%);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-pricing-addons-reveal {
      opacity: 1 !important;
      transform: none !important;
      transition: none !important;
    }

    .rsp-pricing-addons-beam {
      animation: none !important;
      display: none !important;
    }
  }
</style>

<section
  id="pricing-add-ons"
  class="relative overflow-hidden bg-slate-50/50 px-4 py-16 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="pricing-add-ons-title">

  <!-- Modern Background Gradients & Grid Pattern -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.03)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
  <div class="pointer-events-none absolute -left-40 bottom-10 z-0 h-[600px] w-[600px] rounded-full bg-blue-500/[0.07] blur-[130px]"></div>
  <div class="pointer-events-none absolute -right-40 top-10 z-0 h-[600px] w-[600px] rounded-full bg-emerald-500/[0.07] blur-[130px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- Header Section -->
    <div class="rsp-pricing-addons-reveal mx-auto max-w-3xl text-center" data-rsp-pricing-addons-reveal>
      <span class="inline-flex items-center gap-2 rounded-full border border-teal-200/40 bg-teal-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-teal-800 shadow-sm">
        <i data-lucide="plus-circle" class="h-4 w-4 text-teal-600" aria-hidden="true"></i>
        <?php esc_html_e('ORM Add-ons & Small Services', 'reviewservicepro'); ?>
      </span>

      <h2
        id="pricing-add-ons-title"
        class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl lg:leading-[1.15]">
        <?php esc_html_e('Add focused support when you need something extra.', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-4 max-w-2xl text-base font-normal leading-relaxed text-slate-600 sm:text-lg">
        <?php esc_html_e('Use small ORM add-ons for extra review response drafts, additional platform checks, response tone guidance, or lightweight reputation support without starting a full monthly plan.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Strategy Perks Strip -->
    <div
      class="rsp-pricing-addons-card rsp-pricing-addons-reveal mt-12 overflow-hidden rounded-3xl border border-slate-200/80 bg-white p-6 shadow-sm backdrop-blur-md sm:p-8"
      data-rsp-pricing-addons-reveal>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-[2px] overflow-hidden bg-slate-100" aria-hidden="true">
        <div class="rsp-pricing-addons-beam h-full w-1/2 bg-gradient-to-r from-transparent via-blue-500 to-emerald-500"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
        <!-- Card Item 1 -->
        <div class="group rounded-2xl border border-blue-100 bg-blue-50/40 p-5 transition-all duration-300 hover:bg-blue-50">
          <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl border border-blue-200 bg-white text-blue-600 shadow-sm transition-transform group-hover:scale-105">
            <i data-lucide="message-square-text" class="h-5 w-5" aria-hidden="true"></i>
          </div>
          <h3 class="text-base font-semibold text-slate-900">
            <?php esc_html_e('Extra response support', 'reviewservicepro'); ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600">
            <?php esc_html_e('Order additional review response drafts or tone guidance when needed.', 'reviewservicepro'); ?>
          </p>
        </div>

        <!-- Card Item 2 -->
        <div class="group rounded-2xl border border-emerald-100 bg-emerald-50/40 p-5 transition-all duration-300 hover:bg-emerald-50">
          <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl border border-emerald-200 bg-white text-emerald-600 shadow-sm transition-transform group-hover:scale-105">
            <i data-lucide="layers-3" class="h-5 w-5" aria-hidden="true"></i>
          </div>
          <h3 class="text-base font-semibold text-slate-900">
            <?php esc_html_e('Additional platform scope', 'reviewservicepro'); ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600">
            <?php esc_html_e('Add another platform review when your reputation presence expands.', 'reviewservicepro'); ?>
          </p>
        </div>

        <!-- Card Item 3 -->
        <div class="group rounded-2xl border border-amber-100 bg-amber-50/40 p-5 transition-all duration-300 hover:bg-amber-50 sm:col-span-2 md:col-span-1">
          <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl border border-amber-200 bg-white text-amber-600 shadow-sm transition-transform group-hover:scale-105">
            <i data-lucide="shield-alert" class="h-5 w-5" aria-hidden="true"></i>
          </div>
          <h3 class="text-base font-semibold text-slate-900">
            <?php esc_html_e('Safe service boundaries', 'reviewservicepro'); ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600">
            <?php esc_html_e('Every add-on follows ethical, platform-compliant ORM standards.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </div>

    <!-- Conditionals Content -->
    <?php if (! class_exists('WooCommerce')) : ?>

      <div class="rsp-pricing-addons-reveal mt-12 rounded-2xl border border-amber-200 bg-amber-50/60 p-8 text-center backdrop-blur-sm" data-rsp-pricing-addons-reveal>
        <h3 class="text-xl font-bold text-slate-900">
          <?php esc_html_e('WooCommerce is not active', 'reviewservicepro'); ?>
        </h3>
        <p class="mx-auto mt-2 max-w-xl text-sm text-slate-600">
          <?php esc_html_e('Activate WooCommerce to load ORM add-on products dynamically.', 'reviewservicepro'); ?>
        </p>
      </div>

    <?php elseif (empty($products)) : ?>

      <div class="rsp-pricing-addons-reveal mt-12 rounded-2xl border border-blue-100 bg-blue-50/30 p-6 sm:p-8" data-rsp-pricing-addons-reveal>
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
          <div class="flex items-start gap-4">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-blue-200 bg-white text-blue-600 shadow-sm">
              <i data-lucide="package-plus" class="h-6 w-6" aria-hidden="true"></i>
            </span>
            <div>
              <h3 class="text-xl font-bold text-slate-900">
                <?php esc_html_e('No ORM add-ons found yet.', 'reviewservicepro'); ?>
              </h3>
              <p class="mt-1 text-sm text-slate-600">
                <?php
                printf(
                  esc_html__('Create WooCommerce products and assign them to the category slug: %s.', 'reviewservicepro'),
                  '<code class="rounded bg-blue-100 px-1.5 py-0.5 font-mono text-xs text-blue-800">' . esc_html($category_slug) . '</code>'
                );
                ?>
              </p>
            </div>
          </div>
          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-600/10 transition-all hover:bg-blue-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <?php esc_html_e('Ask for Help', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    <?php else : ?>

      <!-- Header Meta / Active State -->
      <div class="mt-12 flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-4">
        <div class="rsp-pricing-addons-reveal" data-rsp-pricing-addons-reveal>
          <p class="text-sm font-medium text-slate-500">
            <?php
            printf(
              esc_html(_n('%d add-on available', '%d add-ons available', $product_count, 'reviewservicepro')),
              absint($product_count)
            );
            ?>
          </p>
        </div>

        <a
          href="<?php echo esc_url($services_url); ?>"
          class="rsp-pricing-addons-reveal inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-blue-300 hover:bg-blue-50/50 hover:text-blue-700 data-rsp-pricing-addons-reveal">
          <?php esc_html_e('Need monthly support?', 'reviewservicepro'); ?>
          <i data-lucide="arrow-up-right" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
        </a>
      </div>

      <!-- Dynamic Product Grid -->
      <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($products as $index => $product) :
          $delay = min($index * 60, 360); // Fine-tuned staggered load animation duration
        ?>
          <div
            class="rsp-pricing-addons-reveal"
            data-rsp-pricing-addons-reveal
            style="transition-delay: <?php echo esc_attr($delay . 'ms'); ?>;">

            <?php
            get_template_part(
              'template-parts/components/pricing-product-card',
              null,
              [
                'product'       => $product,
                'fallback_url'  => $contact_url,
                'section_label' => __('ORM Add-on', 'reviewservicepro'),
              ]
            );
            ?>
          </div>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

    <!-- Bottom Call-To-Action (CTA) -->
    <div
      class="rsp-pricing-addons-card rsp-pricing-addons-reveal mt-12 rounded-3xl border border-slate-200 bg-slate-900 p-6 shadow-md sm:p-8"
      data-rsp-pricing-addons-reveal>

      <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="max-w-3xl">
          <h3 class="text-xl font-bold text-white! sm:text-2xl">
            <?php esc_html_e('Need an add-on that is not listed yet?', 'reviewservicepro'); ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-400 sm:text-base">
            <?php esc_html_e('Tell us what you need. If it fits our ethical ORM service scope, we can guide you to the right package, add-on, or monthly plan.', 'reviewservicepro'); ?>
          </p>
        </div>

        <a
          href="<?php echo esc_url($contact_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition-all hover:bg-blue-500 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-900 shrink-0">
          <?php esc_html_e('Request Custom Add-on', 'reviewservicepro'); ?>
          <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
        </a>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    'use strict';

    function initRspPricingAddons() {
      // Trigger Lucide Icons Rendering safely
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      // Scroll Intersection Reveal Logic
      var revealItems = document.querySelectorAll('[data-rsp-pricing-addons-reveal]');
      if ('IntersectionObserver' in window && revealItems.length > 0) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('rsp-is-visible');
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.08,
          rootMargin: '0px 0px -20px 0px'
        });

        revealItems.forEach(function(item) {
          observer.observe(item);
        });
      } else {
        revealItems.forEach(function(item) {
          item.classList.add('rsp-is-visible');
        });
      }

      // Interactive Mouse Glow Move effect for cards
      var cards = document.querySelectorAll('[data-rsp-pricing-card]');
      cards.forEach(function(card) {
        if (card.dataset.rspPricingMouseReady === 'true') {
          return;
        }
        card.dataset.rspPricingMouseReady = 'true';

        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-card-x', x.toFixed(2) + '%');
          card.style.setProperty('--rsp-card-y', y.toFixed(2) + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPricingAddons);
    } else {
      initRspPricingAddons();
    }
  })();
</script>