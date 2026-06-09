<?php

/**
 * Order received / Thank you page
 *
 * ReviewService.Pro — Compact WooCommerce thank you template
 *
 * File: woocommerce/checkout/thankyou.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$account_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$support_url = home_url('/contact/?type=order-support');
?>

<section id="rsp-thankyou" class="relative bg-[#F8FAFC] px-4 py-12 sm:px-6 lg:px-8">
  <style>
    #rsp-thankyou,
    #rsp-thankyou p,
    #rsp-thankyou a,
    #rsp-thankyou li,
    #rsp-thankyou td,
    #rsp-thankyou th {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #rsp-thankyou h1,
    #rsp-thankyou h2,
    #rsp-thankyou h3 {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: #334155;
      letter-spacing: -0.04em;
    }

    #rsp-thankyou .rsp-thankyou-btn {
      display: inline-flex;
      min-height: 48px;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      border-radius: 14px;
      padding: 0.75rem 1.1rem;
      font-size: 15px;
      font-weight: 800;
      line-height: 1.2;
      text-decoration: none;
      transition: transform 220ms ease, background-color 220ms ease, border-color 220ms ease, color 220ms ease, box-shadow 220ms ease;
    }

    #rsp-thankyou .rsp-thankyou-btn:hover {
      transform: translateY(-2px);
    }

    #rsp-thankyou .woocommerce-order-details,
    #rsp-thankyou .woocommerce-customer-details {
      margin-top: 1.25rem;
      border: 1px solid #E2E8F0;
      border-radius: 20px;
      background: #ffffff;
      padding: 1.25rem;
      box-shadow: 0 12px 36px rgba(15, 23, 42, 0.05);
    }

    #rsp-thankyou table.shop_table {
      border: 1px solid #E2E8F0 !important;
      border-radius: 16px;
      overflow: hidden;
    }

    @media (prefers-reduced-motion: reduce) {
      #rsp-thankyou * {
        transition-duration: 0.001ms !important;
      }
    }
  </style>

  <div class="mx-auto max-w-5xl">
    <?php if ($order) : ?>
      <?php do_action('woocommerce_before_thankyou', $order->get_id()); ?>

      <?php if ($order->has_status('failed')) : ?>
        <div class="rounded-[24px] border border-red-200 bg-white p-6 text-center shadow-[0_18px_55px_rgba(15,23,42,0.07)] md:p-8">
          <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl border border-red-200 bg-red-50 text-red-600">
            <?php echo $render_icon('circle-alert', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h1 class="text-[clamp(30px,4vw,44px)] font-[800] leading-tight">
            <?php esc_html_e('Payment could not be completed', 'reviewservicepro'); ?>
          </h1>

          <p class="mx-auto mt-4 max-w-xl text-[16px] leading-7 text-[#64748B]">
            <?php esc_html_e('Your order is saved, but the payment was not successful. You can retry payment or contact support for help.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="rsp-thankyou-btn bg-[#2563EB] text-white shadow-[0_12px_28px_rgba(37,99,235,0.18)] hover:bg-blue-700 hover:text-white">
              <?php esc_html_e('Pay', 'woocommerce'); ?>
            </a>

            <?php if (is_user_logged_in()) : ?>
              <a href="<?php echo esc_url($account_url); ?>" class="rsp-thankyou-btn border border-slate-200 bg-white text-[#3B4658] shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                <?php esc_html_e('My account', 'woocommerce'); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php else : ?>
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-[0_18px_55px_rgba(15,23,42,0.07)] md:p-8">
          <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-start">
            <div>
              <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.13em] text-emerald-700">
                <?php echo $render_icon('check-circle-2', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Order received', 'reviewservicepro'); ?>
              </span>

              <h1 class="mt-4 text-[clamp(32px,4vw,46px)] font-[800] leading-tight">
                <?php esc_html_e('Thank you. Your order is confirmed.', 'reviewservicepro'); ?>
              </h1>

              <p class="mt-4 max-w-2xl text-[16px] leading-7 text-[#64748B]">
                <?php esc_html_e('Your reputation management order has been received. Use your client portal to review service records, orders, billing, and next steps.', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row lg:flex-col">
              <a href="<?php echo esc_url($account_url); ?>" class="rsp-thankyou-btn bg-[#2563EB] text-white shadow-[0_12px_28px_rgba(37,99,235,0.18)] hover:bg-blue-700 hover:text-white">
                <?php echo $render_icon('layout-dashboard', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Open Client Portal', 'reviewservicepro'); ?>
              </a>

              <a href="<?php echo esc_url($support_url); ?>" class="rsp-thankyou-btn border border-slate-200 bg-white text-[#3B4658] shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
                <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Support', 'reviewservicepro'); ?>
              </a>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
              <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400"><?php esc_html_e('Order', 'woocommerce'); ?></p>
              <p class="mt-1 text-[18px] font-[800] text-[#334155]">#<?php echo esc_html($order->get_order_number()); ?></p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
              <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400"><?php esc_html_e('Date', 'woocommerce'); ?></p>
              <p class="mt-1 text-[18px] font-[800] text-[#334155]"><?php echo esc_html(wc_format_datetime($order->get_date_created(), get_option('date_format'))); ?></p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
              <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400"><?php esc_html_e('Total', 'woocommerce'); ?></p>
              <p class="mt-1 text-[18px] font-[800] text-[#334155]"><?php echo wp_kses_post($order->get_formatted_order_total()); ?></p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
              <p class="text-[12px] font-[800] uppercase tracking-[0.10em] text-slate-400"><?php esc_html_e('Payment method', 'woocommerce'); ?></p>
              <p class="mt-1 text-[18px] font-[800] text-[#334155]"><?php echo esc_html($order->get_payment_method_title()); ?></p>
            </div>
          </div>

          <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-5 text-[15px] leading-7 text-emerald-800">
            <?php esc_html_e('Ethical ORM reminder: our work focuses on monitoring, professional response support, documentation, reporting, and compliant workflows. No fake reviews, no paid review incentives, and no guaranteed removals or rating outcomes.', 'reviewservicepro'); ?>
          </div>
        </div>

        <div class="woocommerce-order mt-6">
          <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
          <?php do_action('woocommerce_thankyou', $order->get_id()); ?>
        </div>
      <?php endif; ?>

    <?php else : ?>
      <div class="rounded-[24px] border border-slate-200 bg-white p-6 text-center shadow-[0_18px_55px_rgba(15,23,42,0.07)] md:p-8">
        <h1 class="text-[clamp(30px,4vw,44px)] font-[800] leading-tight">
          <?php esc_html_e('Thank you. Your order has been received.', 'woocommerce'); ?>
        </h1>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>