<?php

/**
 * Cart Page
 *
 * ReviewService.Pro — Compact white SaaS WooCommerce cart
 *
 * File: woocommerce/cart/cart.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');

$cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
$pricing_url  = home_url('/pricing/');
$support_url  = home_url('/contact/?type=cart-support');
$item_count   = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section id="rsp-cart" class="relative bg-[#F8FAFC] px-4 py-10 sm:px-6 lg:px-8">
  <style>
    #rsp-cart {
      --rsp-cart-title: #334155;
      --rsp-cart-heading: #3B4658;
      --rsp-cart-body: #64748B;
    }

    #rsp-cart,
    #rsp-cart p,
    #rsp-cart a,
    #rsp-cart button,
    #rsp-cart input,
    #rsp-cart td,
    #rsp-cart th {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #rsp-cart h1,
    #rsp-cart h2,
    #rsp-cart h3 {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-cart-heading);
      letter-spacing: -0.035em;
    }

    #rsp-cart .rsp-cart-title {
      max-width: 760px;
      color: var(--rsp-cart-title);
      font-size: clamp(34px, 4vw, 46px);
      font-weight: 800;
      line-height: 1.08;
    }

    #rsp-cart .rsp-cart-text {
      color: var(--rsp-cart-body);
      font-size: 16px;
      line-height: 1.72;
    }

    #rsp-cart .rsp-cart-btn,
    #rsp-cart .button,
    #rsp-cart button.button {
      position: relative;
      overflow: hidden;
      display: inline-flex !important;
      min-height: 48px;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      border-radius: 14px !important;
      padding: 0.75rem 1.1rem !important;
      font-size: 15px !important;
      font-weight: 800 !important;
      line-height: 1.2 !important;
      text-decoration: none !important;
      transition: transform 220ms ease, box-shadow 220ms ease, background-color 220ms ease, border-color 220ms ease, color 220ms ease;
    }

    #rsp-cart .rsp-cart-btn-primary,
    #rsp-cart button.button[name="update_cart"],
    #rsp-cart button.button[name="apply_coupon"] {
      border: 1px solid #2563EB !important;
      background: #2563EB !important;
      color: #ffffff !important;
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.18);
    }

    #rsp-cart .rsp-cart-btn-secondary {
      border: 1px solid #E2E8F0 !important;
      background: #ffffff !important;
      color: #3B4658 !important;
      box-shadow: 0 8px 22px rgba(15, 23, 42, 0.05);
    }

    #rsp-cart .rsp-cart-btn:hover,
    #rsp-cart .button:hover,
    #rsp-cart button.button:hover {
      transform: translateY(-2px);
    }

    #rsp-cart input.input-text,
    #rsp-cart input[type="text"],
    #rsp-cart input[type="number"] {
      min-height: 48px;
      border: 1px solid #CBD5E1;
      border-radius: 14px;
      background: #ffffff;
      padding: 0.75rem 0.95rem;
      color: #334155;
      font-size: 15px;
      font-weight: 500;
      outline: none;
    }

    #rsp-cart input:focus {
      border-color: #2563EB;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }

    @media (prefers-reduced-motion: reduce) {
      #rsp-cart * {
        transition-duration: 0.001ms !important;
      }
    }
  </style>

  <div class="mx-auto max-w-7xl">
    <div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
      <div>
        <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.13em] text-blue-700">
          <?php echo $render_icon('shopping-cart', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Service Cart', 'reviewservicepro'); ?>
        </span>

        <h1 class="rsp-cart-title mt-4">
          <?php esc_html_e('Review your reputation service order', 'reviewservicepro'); ?>
        </h1>

        <p class="rsp-cart-text mt-4 max-w-2xl">
          <?php esc_html_e('Confirm your selected reputation management package, platform check, or ORM add-on before checkout.', 'reviewservicepro'); ?>
        </p>
      </div>

      <a href="<?php echo esc_url($pricing_url); ?>" class="rsp-cart-btn rsp-cart-btn-secondary">
        <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Continue Shopping', 'woocommerce'); ?>
      </a>
    </div>

    <form class="woocommerce-cart-form" action="<?php echo esc_url($cart_url); ?>" method="post">
      <?php do_action('woocommerce_before_cart_table'); ?>

      <div class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">
        <div class="rounded-[24px] border border-slate-200 bg-white p-4 shadow-[0_18px_55px_rgba(15,23,42,0.07)] md:p-5">
          <div class="mb-4 flex items-center justify-between border-b border-slate-200 pb-4">
            <h2 class="text-[22px] font-[800] leading-tight">
              <?php
              printf(
                /* translators: %d: cart item count */
                esc_html(_n('%d item in cart', '%d items in cart', $item_count, 'reviewservicepro')),
                esc_html((string) $item_count)
              );
              ?>
            </h2>

            <span class="rounded-full bg-emerald-50 px-3 py-1 text-[12px] font-[800] text-emerald-700">
              <?php esc_html_e('Secure checkout', 'reviewservicepro'); ?>
            </span>
          </div>

          <?php do_action('woocommerce_before_cart_contents'); ?>

          <div class="grid gap-4">
            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
              $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
              $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

              if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>
                <article class="rounded-[20px] border border-slate-200 bg-[#F8FAFC] p-4">
                  <div class="grid grid-cols-1 gap-4 md:grid-cols-[96px_minmax(0,1fr)_auto] md:items-center">
                    <div class="h-24 w-24 overflow-hidden rounded-2xl border border-slate-200 bg-white">
                      <?php
                      $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', ['class' => 'h-full w-full object-cover']), $cart_item, $cart_item_key);

                      if (! $product_permalink) {
                        echo wp_kses_post($thumbnail);
                      } else {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), wp_kses_post($thumbnail));
                      }
                      ?>
                    </div>

                    <div class="min-w-0">
                      <h3 class="text-[20px] font-[800] leading-tight">
                        <?php
                        if (! $product_permalink) {
                          echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                        } else {
                          echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="text-[#3B4658] no-underline hover:text-blue-700" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                        }

                        do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                        echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                          echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                        }
                        ?>
                      </h3>

                      <div class="mt-3 flex flex-wrap gap-3 text-[14px] font-[700] text-[#64748B]">
                        <span><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key)); ?></span>
                        <span><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key)); ?></span>
                      </div>

                      <div class="mt-3 max-w-[160px]">
                        <?php
                        if ($_product->is_sold_individually()) {
                          $min_quantity = 1;
                          $max_quantity = 1;
                        } else {
                          $min_quantity = 0;
                          $max_quantity = $_product->get_max_purchase_quantity();
                        }

                        $product_quantity = woocommerce_quantity_input(
                          [
                            'input_name'   => "cart[{$cart_item_key}][qty]",
                            'input_value'  => $cart_item['quantity'],
                            'max_value'    => $max_quantity,
                            'min_value'    => $min_quantity,
                            'product_name' => $_product->get_name(),
                          ],
                          $_product,
                          false
                        );

                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                      </div>
                    </div>

                    <div class="flex justify-start md:justify-end">
                      <?php
                      echo apply_filters(
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                          '<a href="%s" class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-red-200 bg-red-50 text-red-600 transition hover:-translate-y-0.5 hover:bg-red-100" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
                          esc_url(wc_get_cart_remove_url($cart_item_key)),
                          esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($_product->get_name()))),
                          esc_attr($product_id),
                          esc_attr($_product->get_sku()),
                          $render_icon('trash-2', 'h-4 w-4')
                        ),
                        $cart_item_key
                      ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                      ?>
                    </div>
                  </div>
                </article>
            <?php
              }
            }
            ?>
          </div>

          <?php do_action('woocommerce_cart_contents'); ?>

          <div class="mt-5 rounded-[20px] border border-slate-200 bg-white p-4">
            <?php if (wc_coupons_enabled()) : ?>
              <div class="coupon grid grid-cols-1 gap-3 sm:grid-cols-[1fr_auto]">
                <label for="coupon_code" class="sr-only"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                  <span class="relative z-10"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></span>
                </button>
                <?php do_action('woocommerce_cart_coupon'); ?>
              </div>
            <?php endif; ?>

            <div class="mt-4 flex justify-end">
              <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
                <span class="relative z-10"><?php esc_html_e('Update cart', 'woocommerce'); ?></span>
              </button>
            </div>

            <?php do_action('woocommerce_cart_actions'); ?>
            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
          </div>

          <?php do_action('woocommerce_after_cart_contents'); ?>
        </div>

        <aside class="lg:sticky lg:top-[110px]">
          <?php do_action('woocommerce_before_cart_collaterals'); ?>
          <div class="cart-collaterals">
            <?php do_action('woocommerce_cart_collaterals'); ?>
          </div>
        </aside>
      </div>

      <?php do_action('woocommerce_after_cart_table'); ?>
    </form>

    <?php do_action('woocommerce_after_cart'); ?>
  </div>
</section>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>