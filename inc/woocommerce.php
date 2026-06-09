<?php

/**
 * ReviewServicePro WooCommerce Base Integration
 *
 * File: inc/woocommerce.php
 *
 * Purpose:
 * - Add WooCommerce theme support.
 * - Remove WooCommerce sidebar.
 * - Keep checkout fields/default WooCommerce behavior clean.
 * - Do NOT add checkout layout CSS here.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

if (! function_exists('rsp_woocommerce_setup')) {
  /**
   * Add WooCommerce theme support.
   *
   * @return void
   */
  function rsp_woocommerce_setup()
  {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
  }
}
add_action('after_setup_theme', 'rsp_woocommerce_setup');

if (! function_exists('rsp_woocommerce_remove_sidebar')) {
  /**
   * Remove WooCommerce sidebar from theme WooCommerce pages.
   *
   * @return void
   */
  function rsp_woocommerce_remove_sidebar()
  {
    if (! class_exists('WooCommerce')) {
      return;
    }

    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
  }
}
add_action('wp', 'rsp_woocommerce_remove_sidebar');

if (! function_exists('rsp_woocommerce_service_button_text')) {
  /**
   * Rename WooCommerce add-to-cart button text for service products.
   *
   * This does not affect checkout layout, checkout fields, validation,
   * payment methods, or WooCommerce order flow.
   *
   * @param string     $text    Button text.
   * @param WC_Product $product Product object.
   * @return string
   */
  function rsp_woocommerce_service_button_text($text, $product = null)
  {
    if (is_admin()) {
      return $text;
    }

    return esc_html__('Order Now', 'reviewservicepro');
  }
}
add_filter('woocommerce_product_single_add_to_cart_text', 'rsp_woocommerce_service_button_text', 20, 2);
add_filter('woocommerce_product_add_to_cart_text', 'rsp_woocommerce_service_button_text', 20, 2);

if (! function_exists('rsp_woocommerce_checkout_wrapper_css')) {
  /**
   * Inline CSS to neutralize WooCommerce's .woocommerce shortcode wrapper width.
   *
   * WooCommerce wraps [woocommerce_checkout] in a <div class="woocommerce">
   * which can inherit or compute a bloated width, causing margin:auto to
   * push content off-screen. This forces it to be a neutral full-width block.
   */
  function rsp_woocommerce_checkout_wrapper_css()
  {
    if (! is_checkout() && ! is_cart() && ! is_account_page()) {
      return;
    }

    echo '<style id="rsp-woo-wrapper-fix">
      .woocommerce,
      .woocommerce-page .woocommerce {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        float: none !important;
        box-sizing: border-box !important;
      }
    </style>';
  }
}
add_action('wp_head', 'rsp_woocommerce_checkout_wrapper_css', 5);
