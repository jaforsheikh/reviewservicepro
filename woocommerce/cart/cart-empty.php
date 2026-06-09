<?php

/**
 * Empty cart page
 *
 * ReviewService.Pro — Compact empty cart state
 *
 * File: woocommerce/cart/cart-empty.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_cart_is_empty');

if (wc_get_page_id('shop') > 0) :
  $pricing_url = home_url('/pricing/');
  $services_url = home_url('/services/');
  $audit_url = home_url('/contact/?type=audit');

  $render_icon = static function ($icon, $classes = 'h-4 w-4') {
    if (function_exists('rsp_icon')) {
      return wp_kses_post(rsp_icon($icon, $classes));
    }

    return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
  };
?>

  <section class="relative bg-[#F8FAFC] px-4 py-14 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-3xl text-center">
      <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-[0_18px_55px_rgba(15,23,42,0.07)] md:p-8">
        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
          <?php echo $render_icon('shopping-cart', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </div>

        <h1 class="font-['Poppins',sans-serif] text-[clamp(30px,4vw,44px)] font-[800] leading-tight tracking-[-0.04em] text-[#334155]">
          <?php esc_html_e('Your service cart is empty', 'reviewservicepro'); ?>
        </h1>

        <p class="mx-auto mt-4 max-w-xl font-['Inter',sans-serif] text-[16px] leading-7 text-[#64748B]">
          <?php esc_html_e('Choose a reputation management package, platform check, or ORM add-on to begin a secure service order.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
          <a class="inline-flex min-h-[48px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[15px] font-[800] text-white no-underline shadow-[0_12px_28px_rgba(37,99,235,0.18)] transition hover:-translate-y-0.5 hover:bg-blue-700 hover:text-white" href="<?php echo esc_url($pricing_url); ?>">
            <?php esc_html_e('View Pricing', 'reviewservicepro'); ?>
            <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </a>

          <a class="inline-flex min-h-[48px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[15px] font-[800] text-[#3B4658] no-underline shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700" href="<?php echo esc_url($audit_url); ?>">
            <?php echo $render_icon('search-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
          </a>
        </div>

        <a class="mt-5 inline-flex text-[14px] font-[800] text-blue-700 hover:underline" href="<?php echo esc_url($services_url); ?>">
          <?php esc_html_e('Explore ORM Services', 'reviewservicepro'); ?>
        </a>
      </div>
    </div>
  </section>

  <script>
    (function() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
    })();
  </script>
<?php endif; ?>