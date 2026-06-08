<?php

/**
 * My Account Navigation
 *
 * File: woocommerce/myaccount/navigation.php
 *
 * ReviewService.Pro custom WooCommerce My Account navigation.
 *
 * Purpose:
 * - Turn default WooCommerce account navigation into a premium client portal sidebar.
 * - Preserve WooCommerce endpoint URLs and active states.
 * - Keep responsive mobile layout.
 * - Keep enough negative space and premium visual hierarchy.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$menu_items = function_exists('wc_get_account_menu_items') ? wc_get_account_menu_items() : [];

$current_user = wp_get_current_user();

$display_name = $current_user instanceof WP_User && $current_user->exists()
  ? $current_user->display_name
  : __('Client', 'reviewservicepro');

$user_email = $current_user instanceof WP_User && $current_user->exists()
  ? $current_user->user_email
  : '';

$pricing_url = home_url('/pricing/');
$support_url = home_url('/contact/?type=client-support');

$endpoint_icons = [
  'dashboard'       => 'layout-dashboard',
  'orders'          => 'package-check',
  'downloads'       => 'file-down',
  'edit-address'    => 'map-pin',
  'payment-methods' => 'credit-card',
  'edit-account'    => 'user-cog',
  'customer-logout' => 'log-out',

  /**
   * Future ReviewService.Pro custom endpoints.
   */
  'my-project'            => 'folder-kanban',
  'onboarding'            => 'clipboard-list',
  'reputation-snapshot'   => 'activity',
  'local-seo'             => 'map',
  'review-responses'      => 'message-square-text',
  'negative-review-cases' => 'shield-alert',
  'review-request-system' => 'send',
  'reports'               => 'file-text',
  'support'               => 'life-buoy',
];

?>

<style>
  .rsp-account-navigation {
    color: #ffffff;
  }

  .rsp-account-navigation-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-account-navigation-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(380px circle at var(--rsp-nav-x, 50%) var(--rsp-nav-y, 50%), rgba(37, 99, 235, 0.14), transparent 42%),
      radial-gradient(300px circle at var(--rsp-nav-x, 50%) var(--rsp-nav-y, 50%), rgba(0, 200, 83, 0.10), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-account-navigation-card:hover::before {
    opacity: 1;
  }

  .rsp-account-navigation-beam {
    animation: rspAccountNavigationBeam 8s ease-in-out infinite;
  }

  @keyframes rspAccountNavigationBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-account-navigation-beam {
      animation: none;
    }
  }
</style>

<nav
  class="woocommerce-MyAccount-navigation rsp-account-navigation mb-8 lg:mb-10"
  aria-label="<?php esc_attr_e('Account pages', 'reviewservicepro'); ?>">

  <div
    class="rsp-account-navigation-card rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl sm:p-6 lg:p-7"
    data-rsp-account-navigation-card>

    <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
      <div class="rsp-account-navigation-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
    </div>

    <div class="relative z-10">

      <!-- Client profile summary -->
      <div class="rounded-[1.5rem] border border-white/[0.08] bg-white/[0.045] p-5">
        <div class="flex items-center gap-4">
          <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-[#00C853]/10 text-lg font-semibold text-[#6DFFB0]">
            <?php echo esc_html(mb_strtoupper(mb_substr($display_name, 0, 1))); ?>
          </div>

          <div class="min-w-0">
            <p class="truncate text-base font-semibold tracking-[-0.025em] text-white">
              <?php echo esc_html($display_name); ?>
            </p>

            <?php if ($user_email) : ?>
              <p class="mt-1 truncate text-sm font-normal text-slate-400">
                <?php echo esc_html($user_email); ?>
              </p>
            <?php endif; ?>
          </div>
        </div>

        <div class="mt-5 rounded-2xl border border-blue-400/20 bg-blue-500/[0.08] p-4">
          <p class="text-xs font-medium uppercase tracking-[0.14em] text-blue-200">
            <?php esc_html_e('Client Portal', 'reviewservicepro'); ?>
          </p>

          <p class="mt-2 text-sm font-normal leading-6 text-slate-300">
            <?php esc_html_e('Track orders, onboarding, support, and reputation service progress.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>

      <!-- Navigation links -->
      <ul class="mt-5 grid grid-cols-1 gap-2 p-0 lg:gap-3" role="list">
        <?php foreach ($menu_items as $endpoint => $label) : ?>
          <?php
          $classes = function_exists('wc_get_account_menu_item_classes')
            ? wc_get_account_menu_item_classes($endpoint)
            : '';

          $is_active = false !== strpos((string) $classes, 'is-active');

          $icon = isset($endpoint_icons[$endpoint])
            ? $endpoint_icons[$endpoint]
            : 'circle';

          $url = function_exists('wc_get_account_endpoint_url')
            ? wc_get_account_endpoint_url($endpoint)
            : '#';

          $base_classes = 'group flex items-center justify-between gap-3 rounded-2xl border px-4 py-3.5 text-sm font-medium transition-all duration-300';

          $state_classes = $is_active
            ? 'border-[#00C853]/25 bg-[#00C853]/10 text-white shadow-[0_12px_34px_rgba(0,200,83,0.10)]'
            : 'border-white/[0.08] bg-white/[0.035] text-slate-300 hover:-translate-y-0.5 hover:border-blue-400/25 hover:bg-blue-500/[0.08] hover:text-white';

          if ('customer-logout' === $endpoint) {
            $state_classes = $is_active
              ? 'border-red-300/25 bg-red-400/10 text-white'
              : 'border-red-300/15 bg-red-400/[0.055] text-red-100 hover:-translate-y-0.5 hover:border-red-300/25 hover:bg-red-400/10';
          }
          ?>

          <li class="<?php echo esc_attr($classes); ?> m-0 list-none">
            <a
              href="<?php echo esc_url($url); ?>"
              class="<?php echo esc_attr($base_classes . ' ' . $state_classes); ?>">

              <span class="flex min-w-0 items-center gap-3">
                <span class="<?php echo esc_attr($is_active ? 'border-[#00C853]/25 bg-[#00C853]/10 text-[#6DFFB0]' : 'border-white/[0.08] bg-white/[0.045] text-slate-300 group-hover:border-blue-400/25 group-hover:bg-blue-500/10 group-hover:text-blue-200'); ?> flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border transition-all duration-300">
                  <i data-lucide="<?php echo esc_attr($icon); ?>" class="h-4.5 w-4.5" aria-hidden="true"></i>
                </span>

                <span class="truncate">
                  <?php echo esc_html($label); ?>
                </span>
              </span>

              <?php if ($is_active) : ?>
                <span class="h-2 w-2 shrink-0 rounded-full bg-[#00C853] shadow-[0_0_18px_rgba(0,200,83,0.7)]"></span>
              <?php else : ?>
                <i data-lucide="chevron-right" class="h-4 w-4 shrink-0 opacity-60 transition-all duration-300 group-hover:translate-x-0.5 group-hover:opacity-100" aria-hidden="true"></i>
              <?php endif; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Portal actions -->
      <div class="mt-6 grid grid-cols-1 gap-3">
        <a
          href="<?php echo esc_url($pricing_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3.5 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

          <?php esc_html_e('Order New Service', 'reviewservicepro'); ?>
          <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
        </a>

        <a
          href="<?php echo esc_url($support_url); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.045] px-5 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

          <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
          <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
        </a>
      </div>

      <!-- Compliance note -->
      <div class="mt-6 rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-4">
        <div class="flex gap-3">
          <i data-lucide="shield-alert" class="mt-0.5 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

          <p class="text-sm font-normal leading-6 text-slate-300">
            <?php esc_html_e('Ethical ORM only: no fake reviews, paid review incentives, rating manipulation, guaranteed removals, or ranking guarantees.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>

    </div>
  </div>
</nav>

<script>
  (function() {
    function initRspAccountNavigation() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var cards = document.querySelectorAll('[data-rsp-account-navigation-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-nav-x', x + '%');
          card.style.setProperty('--rsp-nav-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspAccountNavigation);
    } else {
      initRspAccountNavigation();
    }
  })();
</script>