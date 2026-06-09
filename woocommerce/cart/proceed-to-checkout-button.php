<?php

/**
 * Proceed to checkout button
 *
 * ReviewService.Pro — Compact checkout CTA
 *
 * File: woocommerce/cart/proceed-to-checkout-button.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$checkout_url = wc_get_checkout_url();
?>

<a
  href="<?php echo esc_url($checkout_url); ?>"
  class="checkout-button button alt wc-forward inline-flex min-h-[52px] w-full items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_14px_34px_rgba(37,99,235,0.22)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:text-white">
  <span class="relative z-10 inline-flex items-center gap-2">
    <?php esc_html_e('Proceed to checkout', 'woocommerce'); ?>
    <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
  </span>
</a>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>