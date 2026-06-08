<?php

/**
 * ReviewService.Pro WooCommerce Checkout Polish
 *
 * Adds safe checkout UI polish for the classic WooCommerce checkout page.
 * This file does not add custom checkout fields and does not modify checkout validation,
 * payment gateways, order creation, taxes, shipping, or WooCommerce checkout logic.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (! function_exists('reviewservicepro_is_checkout_polish_page')) {
  /**
   * Check whether the current page should receive checkout polish.
   *
   * @return bool
   */
  function reviewservicepro_is_checkout_polish_page()
  {
    if (! function_exists('is_checkout') || ! is_checkout()) {
      return false;
    }

    if (function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('order-received')) {
      return false;
    }

    return true;
  }
}

if (! function_exists('reviewservicepro_checkout_body_classes')) {
  /**
   * Add checkout-specific body classes.
   *
   * @param array $classes Body classes.
   * @return array
   */
  function reviewservicepro_checkout_body_classes($classes)
  {
    if (reviewservicepro_is_checkout_polish_page()) {
      $classes[] = 'rsp-checkout-polish-page';

      if (function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('order-pay')) {
        $classes[] = 'rsp-checkout-pay-page';
      }
    }

    return $classes;
  }
}
add_filter('body_class', 'reviewservicepro_checkout_body_classes');

if (! function_exists('reviewservicepro_checkout_order_button_text')) {
  /**
   * Improve the order button label without changing payment/order logic.
   *
   * @param string $button_text Default button text.
   * @return string
   */
  function reviewservicepro_checkout_order_button_text($button_text)
  {
    if (reviewservicepro_is_checkout_polish_page()) {
      return esc_html__('Place secure service order', 'reviewservicepro');
    }

    return $button_text;
  }
}
add_filter('woocommerce_order_button_text', 'reviewservicepro_checkout_order_button_text', 20);

if (! function_exists('reviewservicepro_checkout_intro_panel')) {
  /**
   * Output premium checkout intro panel.
   *
   * @param WC_Checkout $checkout Checkout object.
   * @return void
   */
  function reviewservicepro_checkout_intro_panel($checkout)
  {
    if (! reviewservicepro_is_checkout_polish_page()) {
      return;
    }

    $cart_count = 0;

    if (function_exists('WC') && WC()->cart) {
      $cart_count = WC()->cart->get_cart_contents_count();
    }
?>
    <section class="rsp-checkout-hero" aria-label="<?php echo esc_attr__('Secure service checkout overview', 'reviewservicepro'); ?>">
      <div class="rsp-checkout-hero__glow" aria-hidden="true"></div>

      <div class="rsp-checkout-hero__content">
        <div class="rsp-checkout-hero__copy">
          <p class="rsp-checkout-eyebrow">
            <span class="rsp-checkout-eyebrow__dot" aria-hidden="true"></span>
            <?php esc_html_e('Secure ReviewService.Pro checkout', 'reviewservicepro'); ?>
          </p>

          <h1 class="rsp-checkout-title">
            <?php esc_html_e('Complete your reputation management service order', 'reviewservicepro'); ?>
          </h1>

          <p class="rsp-checkout-description">
            <?php esc_html_e('Your order will be processed through WooCommerce, then saved inside your account area for onboarding, order tracking, and service documentation.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rsp-checkout-hero__summary">
          <p class="rsp-checkout-mini-label">
            <?php esc_html_e('Selected service items', 'reviewservicepro'); ?>
          </p>
          <p class="rsp-checkout-mini-number">
            <?php echo esc_html(number_format_i18n($cart_count)); ?>
          </p>
          <p class="rsp-checkout-mini-note">
            <?php esc_html_e('Review details before placing your secure service order.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>

      <div class="rsp-checkout-trust-grid">
        <div class="rsp-checkout-trust-card">
          <span class="rsp-checkout-trust-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" focusable="false">
              <path d="M12 3 5 6v5.6c0 4.3 2.8 7.4 7 8.9 4.2-1.5 7-4.6 7-8.9V6l-7-3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
              <path d="M9.2 12.1l1.8 1.8 3.9-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <div>
            <strong><?php esc_html_e('Secure payment', 'reviewservicepro'); ?></strong>
            <span><?php esc_html_e('Payment and order records stay inside WooCommerce.', 'reviewservicepro'); ?></span>
          </div>
        </div>

        <div class="rsp-checkout-trust-card">
          <span class="rsp-checkout-trust-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" focusable="false">
              <path d="M4.5 6.5A2.5 2.5 0 0 1 7 4h10a2.5 2.5 0 0 1 2.5 2.5v11A2.5 2.5 0 0 1 17 20H7a2.5 2.5 0 0 1-2.5-2.5v-11Z" stroke="currentColor" stroke-width="2" />
              <path d="M8 9h8M8 13h8M8 17h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </span>
          <div>
            <strong><?php esc_html_e('Client portal ready', 'reviewservicepro'); ?></strong>
            <span><?php esc_html_e('Order details appear inside your account after checkout.', 'reviewservicepro'); ?></span>
          </div>
        </div>

        <div class="rsp-checkout-trust-card">
          <span class="rsp-checkout-trust-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" focusable="false">
              <path d="M8 11.5 10.5 14 16 8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2" />
            </svg>
          </span>
          <div>
            <strong><?php esc_html_e('Ethical ORM scope', 'reviewservicepro'); ?></strong>
            <span><?php esc_html_e('No fake reviews, paid incentives, or guaranteed removal claims.', 'reviewservicepro'); ?></span>
          </div>
        </div>
      </div>
    </section>
  <?php
  }
}
add_action('woocommerce_before_checkout_form', 'reviewservicepro_checkout_intro_panel', 4);

if (! function_exists('reviewservicepro_checkout_customer_details_note')) {
  /**
   * Output a small helper note before customer details.
   *
   * @return void
   */
  function reviewservicepro_checkout_customer_details_note()
  {
    if (! reviewservicepro_is_checkout_polish_page()) {
      return;
    }
  ?>
    <div class="rsp-checkout-section-note">
      <div class="rsp-checkout-section-note__icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" focusable="false">
          <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" />
          <path d="M4 21a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
      </div>
      <div>
        <strong><?php esc_html_e('Client and billing details', 'reviewservicepro'); ?></strong>
        <span><?php esc_html_e('Use accurate details so onboarding, invoices, and order updates can be connected to the right account.', 'reviewservicepro'); ?></span>
      </div>
    </div>
  <?php
  }
}
add_action('woocommerce_checkout_before_customer_details', 'reviewservicepro_checkout_customer_details_note', 5);

if (! function_exists('reviewservicepro_checkout_after_customer_details_note')) {
  /**
   * Output compliance guidance after customer details.
   *
   * @return void
   */
  function reviewservicepro_checkout_after_customer_details_note()
  {
    if (! reviewservicepro_is_checkout_polish_page()) {
      return;
    }
  ?>
    <div class="rsp-checkout-compliance-note">
      <div class="rsp-checkout-compliance-note__icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" focusable="false">
          <path d="M12 9v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
          <path d="M12 17h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
          <path d="M10.3 4.3 2.8 17.5A2 2 0 0 0 4.5 20.5h15a2 2 0 0 0 1.7-3L13.7 4.3a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
        </svg>
      </div>
      <div>
        <strong><?php esc_html_e('Ethical service boundary', 'reviewservicepro'); ?></strong>
        <span><?php esc_html_e('ReviewService.Pro focuses on review monitoring, professional response support, documentation, policy violation checks, and genuine customer feedback workflows. We do not offer fake reviews, paid review incentives, guaranteed 5-star ratings, guaranteed removals, or ranking guarantees.', 'reviewservicepro'); ?></span>
      </div>
    </div>
  <?php
  }
}
add_action('woocommerce_checkout_after_customer_details', 'reviewservicepro_checkout_after_customer_details_note', 20);

if (! function_exists('reviewservicepro_checkout_order_review_note')) {
  /**
   * Output note before the order review area.
   *
   * @return void
   */
  function reviewservicepro_checkout_order_review_note()
  {
    if (! reviewservicepro_is_checkout_polish_page()) {
      return;
    }
  ?>
    <div class="rsp-checkout-order-note">
      <p>
        <?php esc_html_e('Final review: confirm your selected service, total, and payment method before placing the order.', 'reviewservicepro'); ?>
      </p>
    </div>
<?php
  }
}
add_action('woocommerce_checkout_before_order_review', 'reviewservicepro_checkout_order_review_note', 5);

if (! function_exists('reviewservicepro_enqueue_checkout_polish_styles')) {
  /**
   * Enqueue checkout polish styles.
   *
   * @return void
   */
  function reviewservicepro_enqueue_checkout_polish_styles()
  {
    if (! reviewservicepro_is_checkout_polish_page()) {
      return;
    }

    wp_register_style(
      'reviewservicepro-checkout-polish',
      false,
      array(),
      '1.0.0'
    );

    wp_enqueue_style('reviewservicepro-checkout-polish');

    $custom_css = '
			body.rsp-checkout-polish-page {
				background: #F8FAFC;
			}

			body.rsp-checkout-polish-page .site-main,
			body.rsp-checkout-polish-page main,
			body.rsp-checkout-polish-page .entry-content {
				overflow: visible;
			}

			body.rsp-checkout-polish-page .woocommerce {
				width: min(1180px, calc(100% - 32px));
				margin: 0 auto;
				padding: clamp(40px, 6vw, 84px) 0;
				color: #07111F;
			}

			body.rsp-checkout-polish-page .woocommerce::before,
			body.rsp-checkout-polish-page .woocommerce::after {
				content: "";
				display: table;
				clear: both;
			}

			body.rsp-checkout-polish-page .rsp-checkout-hero {
				position: relative;
				overflow: hidden;
				margin: 0 0 clamp(28px, 4vw, 48px);
				padding: clamp(26px, 4vw, 48px);
				border: 1px solid rgba(148, 163, 184, 0.22);
				border-radius: clamp(28px, 4vw, 44px);
				background:
					radial-gradient(circle at 10% 0%, rgba(0, 200, 83, 0.20), transparent 34%),
					radial-gradient(circle at 92% 10%, rgba(37, 99, 235, 0.22), transparent 36%),
					linear-gradient(135deg, #07111F 0%, #0D0F12 50%, #10223A 100%);
				box-shadow: 0 34px 95px rgba(7, 17, 31, 0.22);
				color: #ffffff;
			}

			body.rsp-checkout-polish-page .rsp-checkout-hero__glow {
				position: absolute;
				right: -160px;
				top: -180px;
				width: 360px;
				height: 360px;
				border-radius: 999px;
				background: rgba(20, 184, 166, 0.22);
				filter: blur(18px);
				pointer-events: none;
			}

			body.rsp-checkout-polish-page .rsp-checkout-hero__content {
				position: relative;
				z-index: 2;
				display: grid;
				grid-template-columns: minmax(0, 1fr) minmax(220px, 300px);
				gap: clamp(24px, 4vw, 48px);
				align-items: center;
			}

			body.rsp-checkout-polish-page .rsp-checkout-eyebrow {
				display: inline-flex;
				align-items: center;
				gap: 10px;
				margin: 0 0 18px;
				padding: 9px 13px;
				border: 1px solid rgba(255, 255, 255, 0.14);
				border-radius: 999px;
				background: rgba(255, 255, 255, 0.08);
				color: rgba(255, 255, 255, 0.86);
				font-size: 12px;
				font-weight: 800;
				line-height: 1.2;
				letter-spacing: 0.14em;
				text-transform: uppercase;
			}

			body.rsp-checkout-polish-page .rsp-checkout-eyebrow__dot {
				width: 8px;
				height: 8px;
				border-radius: 999px;
				background: #00C853;
				box-shadow: 0 0 0 6px rgba(0, 200, 83, 0.14);
			}

			body.rsp-checkout-polish-page .rsp-checkout-title {
				max-width: 780px;
				margin: 0;
				color: #ffffff;
				font-size: clamp(34px, 5vw, 64px);
				font-weight: 950;
				line-height: 0.98;
				letter-spacing: -0.06em;
			}

			body.rsp-checkout-polish-page .rsp-checkout-description {
				max-width: 680px;
				margin: 22px 0 0;
				color: rgba(255, 255, 255, 0.74);
				font-size: 17px;
				font-weight: 400;
				line-height: 1.75;
			}

			body.rsp-checkout-polish-page .rsp-checkout-hero__summary {
				position: relative;
				z-index: 2;
				padding: 24px;
				border: 1px solid rgba(255, 255, 255, 0.14);
				border-radius: 28px;
				background: rgba(255, 255, 255, 0.08);
				backdrop-filter: blur(16px);
			}

			body.rsp-checkout-polish-page .rsp-checkout-mini-label {
				margin: 0;
				color: rgba(255, 255, 255, 0.66);
				font-size: 12px;
				font-weight: 800;
				line-height: 1.2;
				letter-spacing: 0.14em;
				text-transform: uppercase;
			}

			body.rsp-checkout-polish-page .rsp-checkout-mini-number {
				margin: 10px 0 8px;
				color: #ffffff;
				font-size: 52px;
				font-weight: 950;
				line-height: 1;
				letter-spacing: -0.06em;
			}

			body.rsp-checkout-polish-page .rsp-checkout-mini-note {
				margin: 0;
				color: rgba(255, 255, 255, 0.70);
				font-size: 14px;
				font-weight: 400;
				line-height: 1.65;
			}

			body.rsp-checkout-polish-page .rsp-checkout-trust-grid {
				position: relative;
				z-index: 2;
				display: grid;
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 16px;
				margin-top: clamp(24px, 4vw, 38px);
			}

			body.rsp-checkout-polish-page .rsp-checkout-trust-card {
				display: flex;
				gap: 14px;
				padding: 18px;
				border: 1px solid rgba(255, 255, 255, 0.12);
				border-radius: 24px;
				background: rgba(255, 255, 255, 0.07);
			}

			body.rsp-checkout-polish-page .rsp-checkout-trust-icon {
				display: inline-flex;
				flex: 0 0 auto;
				align-items: center;
				justify-content: center;
				width: 38px;
				height: 38px;
				border-radius: 14px;
				background: rgba(0, 200, 83, 0.12);
				color: #5EF29A;
			}

			body.rsp-checkout-polish-page .rsp-checkout-trust-icon svg {
				width: 19px;
				height: 19px;
			}

			body.rsp-checkout-polish-page .rsp-checkout-trust-card strong {
				display: block;
				margin: 0 0 5px;
				color: #ffffff;
				font-size: 14px;
				font-weight: 850;
				line-height: 1.25;
			}

			body.rsp-checkout-polish-page .rsp-checkout-trust-card span {
				display: block;
				color: rgba(255, 255, 255, 0.66);
				font-size: 13px;
				font-weight: 400;
				line-height: 1.55;
			}

			body.rsp-checkout-polish-page .woocommerce-form-login-toggle,
			body.rsp-checkout-polish-page .woocommerce-form-coupon-toggle {
				margin: 0 0 18px;
			}

			body.rsp-checkout-polish-page .woocommerce-info,
			body.rsp-checkout-polish-page .woocommerce-message,
			body.rsp-checkout-polish-page .woocommerce-error {
				margin: 0 0 20px;
				padding: 18px 20px;
				border: 1px solid rgba(148, 163, 184, 0.20);
				border-radius: 20px;
				background: #ffffff;
				box-shadow: 0 18px 44px rgba(15, 23, 42, 0.07);
				color: #334155;
				font-size: 15px;
				font-weight: 500;
				line-height: 1.65;
			}

			body.rsp-checkout-polish-page .woocommerce-info::before,
			body.rsp-checkout-polish-page .woocommerce-message::before,
			body.rsp-checkout-polish-page .woocommerce-error::before {
				display: none;
			}

			body.rsp-checkout-polish-page .woocommerce-info a,
			body.rsp-checkout-polish-page .woocommerce-message a,
			body.rsp-checkout-polish-page .woocommerce-error a {
				color: #2563EB;
				font-weight: 800;
				text-decoration: none;
			}

			body.rsp-checkout-polish-page .woocommerce-info a:hover,
			body.rsp-checkout-polish-page .woocommerce-message a:hover,
			body.rsp-checkout-polish-page .woocommerce-error a:hover {
				color: #1D4ED8;
				text-decoration: underline;
			}

			body.rsp-checkout-polish-page form.checkout_coupon,
			body.rsp-checkout-polish-page form.login {
				margin: 0 0 26px;
				padding: clamp(22px, 3vw, 30px);
				border: 1px solid rgba(148, 163, 184, 0.18);
				border-radius: 28px;
				background: #ffffff;
				box-shadow: 0 18px 46px rgba(15, 23, 42, 0.06);
			}

			body.rsp-checkout-polish-page form.checkout.woocommerce-checkout {
				display: grid;
				grid-template-columns: minmax(0, 1.12fr) minmax(360px, 0.88fr);
				gap: clamp(24px, 4vw, 44px);
				align-items: start;
			}

			body.rsp-checkout-polish-page .rsp-checkout-section-note,
			body.rsp-checkout-polish-page .rsp-checkout-compliance-note,
			body.rsp-checkout-polish-page .rsp-checkout-order-note {
				grid-column: 1 / -1;
			}

			body.rsp-checkout-polish-page #customer_details {
				min-width: 0;
			}

			body.rsp-checkout-polish-page #customer_details.col2-set {
				width: 100%;
				margin: 0;
			}

			body.rsp-checkout-polish-page #customer_details .col-1,
			body.rsp-checkout-polish-page #customer_details .col-2 {
				float: none;
				width: 100%;
				padding: 0;
			}

			body.rsp-checkout-polish-page #customer_details .col-2 {
				margin-top: 24px;
			}

			body.rsp-checkout-polish-page .woocommerce-billing-fields,
			body.rsp-checkout-polish-page .woocommerce-shipping-fields,
			body.rsp-checkout-polish-page .woocommerce-additional-fields,
			body.rsp-checkout-polish-page #order_review {
				position: relative;
				overflow: hidden;
				padding: clamp(24px, 3.4vw, 34px);
				border: 1px solid rgba(148, 163, 184, 0.18);
				border-radius: 30px;
				background: #ffffff;
				box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
			}

			body.rsp-checkout-polish-page #order_review {
				position: sticky;
				top: 28px;
			}

			body.admin-bar.rsp-checkout-polish-page #order_review {
				top: 60px;
			}

			body.rsp-checkout-polish-page .woocommerce-billing-fields h3,
			body.rsp-checkout-polish-page .woocommerce-shipping-fields h3,
			body.rsp-checkout-polish-page .woocommerce-additional-fields h3,
			body.rsp-checkout-polish-page #order_review_heading {
				margin: 0 0 22px;
				color: #07111F;
				font-size: clamp(22px, 2.4vw, 30px);
				font-weight: 950;
				line-height: 1.08;
				letter-spacing: -0.04em;
			}

			body.rsp-checkout-polish-page #order_review_heading {
				align-self: start;
				margin: 0 0 -18px;
				padding: 0 4px;
				grid-column: 2 / 3;
			}

			body.rsp-checkout-polish-page .rsp-checkout-section-note,
			body.rsp-checkout-polish-page .rsp-checkout-compliance-note,
			body.rsp-checkout-polish-page .rsp-checkout-order-note {
				display: flex;
				gap: 15px;
				margin: 0 0 22px;
				padding: 18px 20px;
				border-radius: 24px;
				border: 1px solid rgba(148, 163, 184, 0.18);
				background: #ffffff;
				box-shadow: 0 14px 34px rgba(15, 23, 42, 0.05);
			}

			body.rsp-checkout-polish-page .rsp-checkout-compliance-note {
				margin-top: 24px;
				border-color: rgba(245, 158, 11, 0.32);
				background: #FFFBEB;
			}

			body.rsp-checkout-polish-page .rsp-checkout-order-note {
				grid-column: 2 / 3;
				margin: -6px 0 18px;
				background: #F8FAFC;
			}

			body.rsp-checkout-polish-page .rsp-checkout-section-note__icon,
			body.rsp-checkout-polish-page .rsp-checkout-compliance-note__icon {
				display: inline-flex;
				flex: 0 0 auto;
				align-items: center;
				justify-content: center;
				width: 42px;
				height: 42px;
				border-radius: 16px;
				background: rgba(37, 99, 235, 0.10);
				color: #2563EB;
			}

			body.rsp-checkout-polish-page .rsp-checkout-compliance-note__icon {
				background: rgba(245, 158, 11, 0.14);
				color: #B45309;
			}

			body.rsp-checkout-polish-page .rsp-checkout-section-note svg,
			body.rsp-checkout-polish-page .rsp-checkout-compliance-note svg {
				width: 20px;
				height: 20px;
			}

			body.rsp-checkout-polish-page .rsp-checkout-section-note strong,
			body.rsp-checkout-polish-page .rsp-checkout-compliance-note strong {
				display: block;
				margin: 0 0 5px;
				color: #07111F;
				font-size: 15px;
				font-weight: 850;
				line-height: 1.3;
			}

			body.rsp-checkout-polish-page .rsp-checkout-section-note span,
			body.rsp-checkout-polish-page .rsp-checkout-compliance-note span,
			body.rsp-checkout-polish-page .rsp-checkout-order-note p {
				display: block;
				margin: 0;
				color: #475569;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.65;
			}

			body.rsp-checkout-polish-page .rsp-checkout-compliance-note span {
				color: rgba(120, 53, 15, 0.86);
			}

			body.rsp-checkout-polish-page .form-row {
				margin: 0 0 18px;
				padding: 0;
			}

			body.rsp-checkout-polish-page .form-row-first,
			body.rsp-checkout-polish-page .form-row-last {
				width: calc(50% - 8px);
			}

			body.rsp-checkout-polish-page .form-row-first {
				margin-right: 16px;
			}

			body.rsp-checkout-polish-page .form-row-wide {
				clear: both;
			}

			body.rsp-checkout-polish-page label {
				margin: 0 0 8px;
				color: #0F172A;
				font-size: 14px;
				font-weight: 750;
				line-height: 1.35;
			}

			body.rsp-checkout-polish-page .required {
				color: #2563EB;
				text-decoration: none;
			}

			body.rsp-checkout-polish-page .woocommerce-input-wrapper {
				display: block;
				width: 100%;
			}

			body.rsp-checkout-polish-page input.input-text,
			body.rsp-checkout-polish-page input[type="text"],
			body.rsp-checkout-polish-page input[type="email"],
			body.rsp-checkout-polish-page input[type="tel"],
			body.rsp-checkout-polish-page input[type="password"],
			body.rsp-checkout-polish-page textarea,
			body.rsp-checkout-polish-page select,
			body.rsp-checkout-polish-page .select2-container .select2-selection--single {
				min-height: 52px;
				width: 100%;
				border: 1px solid rgba(15, 23, 42, 0.13);
				border-radius: 16px;
				background: #F8FAFC;
				color: #07111F;
				font-size: 15px;
				font-weight: 500;
				line-height: 1.45;
				box-shadow: none;
				outline: none;
				transition: border-color 160ms ease, box-shadow 160ms ease, background-color 160ms ease;
			}

			body.rsp-checkout-polish-page input.input-text,
			body.rsp-checkout-polish-page input[type="text"],
			body.rsp-checkout-polish-page input[type="email"],
			body.rsp-checkout-polish-page input[type="tel"],
			body.rsp-checkout-polish-page input[type="password"],
			body.rsp-checkout-polish-page textarea,
			body.rsp-checkout-polish-page select {
				padding: 13px 15px;
			}

			body.rsp-checkout-polish-page textarea {
				min-height: 128px;
				resize: vertical;
			}

			body.rsp-checkout-polish-page .select2-container .select2-selection--single {
				display: flex;
				align-items: center;
				padding: 0 15px;
			}

			body.rsp-checkout-polish-page .select2-container .select2-selection--single .select2-selection__rendered {
				padding: 0;
				color: #07111F;
				line-height: 1.45;
			}

			body.rsp-checkout-polish-page .select2-container .select2-selection--single .select2-selection__arrow {
				top: 50%;
				right: 12px;
				transform: translateY(-50%);
			}

			body.rsp-checkout-polish-page input.input-text:focus,
			body.rsp-checkout-polish-page input[type="text"]:focus,
			body.rsp-checkout-polish-page input[type="email"]:focus,
			body.rsp-checkout-polish-page input[type="tel"]:focus,
			body.rsp-checkout-polish-page input[type="password"]:focus,
			body.rsp-checkout-polish-page textarea:focus,
			body.rsp-checkout-polish-page select:focus,
			body.rsp-checkout-polish-page .select2-container--focus .select2-selection--single,
			body.rsp-checkout-polish-page .select2-container--open .select2-selection--single {
				border-color: rgba(37, 99, 235, 0.52);
				background: #ffffff;
				box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
			}

			body.rsp-checkout-polish-page .woocommerce-invalid input.input-text,
			body.rsp-checkout-polish-page .woocommerce-invalid select,
			body.rsp-checkout-polish-page .woocommerce-invalid .select2-selection {
				border-color: rgba(220, 38, 38, 0.55);
				box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.08);
			}

			body.rsp-checkout-polish-page .woocommerce-validated input.input-text,
			body.rsp-checkout-polish-page .woocommerce-validated select,
			body.rsp-checkout-polish-page .woocommerce-validated .select2-selection {
				border-color: rgba(0, 200, 83, 0.38);
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table {
				width: 100%;
				margin: 0 0 24px;
				border: 0;
				border-collapse: separate;
				border-spacing: 0;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table thead th {
				padding: 0 0 16px;
				border: 0;
				color: #64748B;
				font-size: 12px;
				font-weight: 850;
				letter-spacing: 0.12em;
				text-transform: uppercase;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tbody td,
			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot th,
			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot td {
				padding: 17px 0;
				border-width: 1px 0 0;
				border-style: solid;
				border-color: rgba(148, 163, 184, 0.18);
				color: #07111F;
				font-size: 15px;
				font-weight: 650;
				line-height: 1.55;
				vertical-align: top;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table .product-name {
				padding-right: 18px;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table .product-total,
			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot td {
				text-align: right;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table .cart_item .product-name {
				font-weight: 800;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table .product-quantity {
				color: #64748B;
				font-weight: 700;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot .order-total th,
			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot .order-total td {
				padding-top: 22px;
				color: #07111F;
				font-size: 17px;
				font-weight: 950;
			}

			body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table .order-total .woocommerce-Price-amount {
				font-size: clamp(24px, 3vw, 32px);
				font-weight: 950;
				letter-spacing: -0.045em;
			}

			body.rsp-checkout-polish-page #payment,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment {
				border: 1px solid rgba(148, 163, 184, 0.18);
				border-radius: 26px;
				background: #F8FAFC;
			}

			body.rsp-checkout-polish-page #payment ul.payment_methods,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment ul.payment_methods {
				margin: 0;
				padding: 18px;
				border: 0;
			}

			body.rsp-checkout-polish-page #payment ul.payment_methods li,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment ul.payment_methods li {
				margin: 0 0 12px;
				padding: 16px;
				border: 1px solid rgba(148, 163, 184, 0.18);
				border-radius: 18px;
				background: #ffffff;
				color: #334155;
				font-size: 14px;
				font-weight: 500;
				line-height: 1.6;
			}

			body.rsp-checkout-polish-page #payment ul.payment_methods li:last-child,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment ul.payment_methods li:last-child {
				margin-bottom: 0;
			}

			body.rsp-checkout-polish-page #payment ul.payment_methods li input[type="radio"],
			body.rsp-checkout-polish-page .woocommerce-checkout-payment ul.payment_methods li input[type="radio"] {
				margin-right: 8px;
				accent-color: #2563EB;
			}

			body.rsp-checkout-polish-page #payment ul.payment_methods li label,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment ul.payment_methods li label {
				margin: 0;
				color: #07111F;
				font-size: 15px;
				font-weight: 850;
			}

			body.rsp-checkout-polish-page #payment div.payment_box,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment div.payment_box {
				margin: 14px 0 0;
				padding: 15px;
				border-radius: 16px;
				background: #EFF6FF;
				color: #334155;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.65;
			}

			body.rsp-checkout-polish-page #payment div.payment_box::before,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment div.payment_box::before {
				display: none;
			}

			body.rsp-checkout-polish-page #payment .place-order,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment .place-order {
				margin: 0;
				padding: 18px;
			}

			body.rsp-checkout-polish-page #payment .woocommerce-privacy-policy-text,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment .woocommerce-privacy-policy-text {
				margin: 0 0 18px;
				color: #64748B;
				font-size: 13px;
				font-weight: 400;
				line-height: 1.7;
			}

			body.rsp-checkout-polish-page #payment .woocommerce-terms-and-conditions-wrapper,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment .woocommerce-terms-and-conditions-wrapper {
				margin-bottom: 18px;
				color: #64748B;
				font-size: 13px;
				font-weight: 400;
				line-height: 1.7;
			}

			body.rsp-checkout-polish-page #payment a,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment a {
				color: #2563EB;
				font-weight: 750;
				text-decoration: none;
			}

			body.rsp-checkout-polish-page #payment a:hover,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment a:hover {
				color: #1D4ED8;
				text-decoration: underline;
			}

			body.rsp-checkout-polish-page #place_order,
			body.rsp-checkout-polish-page button#place_order,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment .button.alt {
				position: relative;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				min-height: 58px;
				width: 100%;
				overflow: hidden;
				border: 0;
				border-radius: 20px;
				background: linear-gradient(135deg, #2563EB, #3B82F6);
				color: #ffffff;
				font-size: 16px;
				font-weight: 900;
				line-height: 1.1;
				letter-spacing: -0.01em;
				text-align: center;
				text-decoration: none;
				box-shadow: 0 20px 46px rgba(37, 99, 235, 0.28);
				transition: transform 180ms ease, box-shadow 180ms ease, filter 180ms ease;
			}

			body.rsp-checkout-polish-page #place_order:hover,
			body.rsp-checkout-polish-page button#place_order:hover,
			body.rsp-checkout-polish-page .woocommerce-checkout-payment .button.alt:hover {
				background: linear-gradient(135deg, #1D4ED8, #2563EB);
				color: #ffffff;
				box-shadow: 0 26px 60px rgba(37, 99, 235, 0.36);
				filter: saturate(1.06);
				transform: translateY(-2px);
			}

			body.rsp-checkout-polish-page #place_order:focus-visible,
			body.rsp-checkout-polish-page button#place_order:focus-visible {
				outline: 3px solid rgba(20, 184, 166, 0.38);
				outline-offset: 4px;
			}

			body.rsp-checkout-polish-page .blockUI.blockOverlay {
				border-radius: 28px;
				background: rgba(255, 255, 255, 0.78) !important;
			}

			body.rsp-checkout-polish-page .woocommerce-NoticeGroup {
				grid-column: 1 / -1;
			}

			body.rsp-checkout-polish-page .woocommerce-NoticeGroup-checkout {
				grid-column: 1 / -1;
			}

			body.rsp-checkout-polish-page .woocommerce-NoticeGroup-checkout .woocommerce-error {
				border-color: rgba(220, 38, 38, 0.24);
				background: #FEF2F2;
				color: #7F1D1D;
			}

			body.rsp-checkout-polish-page .woocommerce-NoticeGroup-checkout .woocommerce-error li {
				margin: 0 0 7px;
			}

			body.rsp-checkout-polish-page .woocommerce-NoticeGroup-checkout .woocommerce-error li:last-child {
				margin-bottom: 0;
			}

			.select2-dropdown {
				border-color: rgba(15, 23, 42, 0.14) !important;
				border-radius: 16px !important;
				overflow: hidden;
				box-shadow: 0 18px 44px rgba(15, 23, 42, 0.12);
			}

			.select2-results__option {
				padding: 10px 14px;
				font-size: 14px;
				line-height: 1.45;
			}

			.select2-results__option--highlighted[aria-selected] {
				background-color: #2563EB !important;
			}

			@media (max-width: 980px) {
				body.rsp-checkout-polish-page .woocommerce {
					width: min(100% - 24px, 760px);
					padding: 34px 0 64px;
				}

				body.rsp-checkout-polish-page .rsp-checkout-hero__content,
				body.rsp-checkout-polish-page .rsp-checkout-trust-grid,
				body.rsp-checkout-polish-page form.checkout.woocommerce-checkout {
					grid-template-columns: 1fr;
				}

				body.rsp-checkout-polish-page #order_review_heading,
				body.rsp-checkout-polish-page .rsp-checkout-order-note {
					grid-column: 1 / -1;
				}

				body.rsp-checkout-polish-page #order_review {
					position: relative;
					top: auto;
				}

				body.admin-bar.rsp-checkout-polish-page #order_review {
					top: auto;
				}
			}

			@media (max-width: 640px) {
				body.rsp-checkout-polish-page .woocommerce {
					width: min(100% - 20px, 100%);
					padding: 28px 0 54px;
				}

				body.rsp-checkout-polish-page .rsp-checkout-hero,
				body.rsp-checkout-polish-page .woocommerce-billing-fields,
				body.rsp-checkout-polish-page .woocommerce-shipping-fields,
				body.rsp-checkout-polish-page .woocommerce-additional-fields,
				body.rsp-checkout-polish-page #order_review {
					border-radius: 24px;
				}

				body.rsp-checkout-polish-page .rsp-checkout-trust-card,
				body.rsp-checkout-polish-page .rsp-checkout-section-note,
				body.rsp-checkout-polish-page .rsp-checkout-compliance-note {
					flex-direction: column;
				}

				body.rsp-checkout-polish-page .form-row-first,
				body.rsp-checkout-polish-page .form-row-last {
					float: none;
					width: 100%;
					margin-right: 0;
				}

				body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table thead {
					display: none;
				}

				body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tbody td,
				body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot th,
				body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot td {
					display: block;
					width: 100%;
					text-align: left;
				}

				body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table .product-total,
				body.rsp-checkout-polish-page .woocommerce-checkout-review-order-table tfoot td {
					padding-top: 0;
					text-align: left;
				}
			}

			@media (prefers-reduced-motion: reduce) {
				body.rsp-checkout-polish-page *,
				body.rsp-checkout-polish-page *::before,
				body.rsp-checkout-polish-page *::after {
					scroll-behavior: auto !important;
					transition-duration: 0.001ms !important;
					animation-duration: 0.001ms !important;
					animation-iteration-count: 1 !important;
				}
			}
		';

    wp_add_inline_style('reviewservicepro-checkout-polish', $custom_css);
  }
}
add_action('wp_enqueue_scripts', 'reviewservicepro_enqueue_checkout_polish_styles', 30);
