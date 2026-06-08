<?php

/**
 * Empty cart page
 *
 * File: woocommerce/cart/cart-empty.php
 *
 * ReviewService.Pro custom WooCommerce empty cart page.
 *
 * Purpose:
 * - Premium empty cart experience for reputation service website.
 * - Guide users back to Pricing / Services / Support.
 * - Preserve WooCommerce empty cart hook.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$pricing_url  = home_url('/pricing/');
$services_url = home_url('/services/');
$support_url  = home_url('/contact/?type=service-help');

do_action('woocommerce_cart_is_empty');
?>

<style>
  .rsp-empty-cart {
    color: #ffffff;
  }

  .rsp-empty-cart-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-empty-cart-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-empty-cart-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-empty-cart-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-empty-cart-x, 50%) var(--rsp-empty-cart-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-empty-cart-x, 50%) var(--rsp-empty-cart-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-empty-cart-card:hover::before {
    opacity: 1;
  }

  .rsp-empty-cart-beam {
    animation: rspEmptyCartBeam 8s ease-in-out infinite;
  }

  @keyframes rspEmptyCartBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-empty-cart-reveal,
    .rsp-empty-cart-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-empty-cart relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Hero Empty State -->
    <section class="rsp-empty-cart-card rsp-empty-cart-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-8 text-center shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-12 lg:p-14" data-rsp-empty-cart-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-empty-cart-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 mx-auto max-w-4xl">
        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[1.5rem] border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="shopping-cart" class="h-10 w-10" aria-hidden="true"></i>
        </div>

        <span class="mt-8 inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
          <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Service Cart Empty', 'reviewservicepro'); ?>
        </span>

        <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-semibold leading-[1.05] tracking-[-0.055em] text-white md:text-6xl">
          <?php esc_html_e('Your reputation service cart is empty.', 'reviewservicepro'); ?>
        </h1>

        <p class="mx-auto mt-6 max-w-3xl text-base font-normal leading-8 text-slate-300 md:text-lg">
          <?php esc_html_e('Choose a one-time reputation package, platform check, or ORM add-on to start your secure service order with ReviewService.Pro.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="inline-flex min-h-[56px] items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Explore Pricing Packages', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($services_url); ?>"
            class="inline-flex min-h-[56px] items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-7 py-4 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('View Monthly Services', 'reviewservicepro'); ?>
            <i data-lucide="briefcase-business" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Helpful Service Direction -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-empty-cart-card rsp-empty-cart-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl md:p-7" data-rsp-empty-cart-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="search-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Start with an audit', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('A reputation audit package helps identify visible trust gaps, review response issues, and platform profile concerns.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-empty-cart-card rsp-empty-cart-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-7" data-rsp-empty-cart-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="star" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Choose platform checks', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Order Google Business Profile, Trustpilot, Yelp, Facebook, or other platform reputation checks when you need focused insight.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-empty-cart-card rsp-empty-cart-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl md:p-7" data-rsp-empty-cart-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="shield-alert" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Ethical ORM only', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('No fake reviews, paid review incentives, rating manipulation, guaranteed removals, guaranteed 5-star ratings, or ranking guarantees.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <!-- Bottom CTA -->
    <section class="rsp-empty-cart-card rsp-empty-cart-reveal mt-8 rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-empty-cart-card>
      <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Need help choosing the right service?', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('If you are unsure whether to start with an audit, platform check, response setup, or monthly ORM plan, contact us before ordering.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-6 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Ask Before Ordering', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Browse Packages', 'reviewservicepro'); ?>
            <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

  </div>
</section>

<script>
  (function() {
    function initRspEmptyCartPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-empty-cart-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-empty-cart-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-empty-cart-x', x + '%');
          card.style.setProperty('--rsp-empty-cart-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspEmptyCartPage);
    } else {
      initRspEmptyCartPage();
    }
  })();
</script>