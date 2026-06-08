<?php

/**
 * Safe Performance Optimization.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Check WooCommerce sensitive pages.
 */
function rsp_is_sensitive_woocommerce_page()
{
  if (! class_exists('WooCommerce')) {
    return false;
  }

  return is_cart() || is_checkout() || is_account_page();
}

/**
 * Disable WordPress emoji assets.
 */
function rsp_performance_disable_emojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'rsp_performance_disable_emojis');

/**
 * Remove emoji TinyMCE plugin.
 */
function rsp_performance_disable_tinymce_emojis($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, ['wpemoji']);
  }

  return [];
}
add_filter('tiny_mce_plugins', 'rsp_performance_disable_tinymce_emojis');

/**
 * Clean unnecessary WordPress head output.
 */
function rsp_performance_clean_head()
{
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
}
add_action('init', 'rsp_performance_clean_head');

/**
 * Disable embeds safely on frontend only.
 */
function rsp_performance_disable_embeds()
{
  if (is_admin() || rsp_is_sensitive_woocommerce_page()) {
    return;
  }

  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'rsp_performance_disable_embeds');

/**
 * Add async decoding and lazy loading to images where safe.
 */
function rsp_performance_image_attributes($attr, $attachment, $size)
{
  if (is_admin()) {
    return $attr;
  }

  if (empty($attr['loading'])) {
    $attr['loading'] = 'lazy';
  }

  if (empty($attr['decoding'])) {
    $attr['decoding'] = 'async';
  }

  return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'rsp_performance_image_attributes', 10, 3);

/**
 * Keep first content image safer for LCP.
 */
function rsp_performance_content_image_loading($value, $image, $context)
{
  if (is_admin()) {
    return $value;
  }

  if ('the_content' === $context && is_singular()) {
    static $content_image_count = 0;

    $content_image_count++;

    if (1 === $content_image_count) {
      return false;
    }
  }

  return $value;
}
add_filter('wp_img_tag_add_loading_attr', 'rsp_performance_content_image_loading', 10, 3);

/**
 * Add async decoding to rendered image tags.
 */
function rsp_performance_add_decoding_attr($filtered_image)
{
  if (is_admin() || empty($filtered_image)) {
    return $filtered_image;
  }

  if (false === strpos($filtered_image, ' decoding=')) {
    $filtered_image = str_replace('<img ', '<img decoding="async" ', $filtered_image);
  }

  return $filtered_image;
}
add_filter('wp_content_img_tag', 'rsp_performance_add_decoding_attr');

/**
 * Resource hints.
 */
function rsp_performance_resource_hints($urls, $relation_type)
{
  if ('preconnect' === $relation_type) {
    $urls[] = [
      'href'        => 'https://cdn.jsdelivr.net',
      'crossorigin' => 'anonymous',
    ];

    $urls[] = [
      'href'        => 'https://unpkg.com',
      'crossorigin' => 'anonymous',
    ];

    $urls[] = [
      'href' => 'https://fonts.googleapis.com',
    ];

    $urls[] = [
      'href'        => 'https://fonts.gstatic.com',
      'crossorigin' => 'anonymous',
    ];
  }

  if ('dns-prefetch' === $relation_type) {
    $urls[] = '//cdn.jsdelivr.net';
    $urls[] = '//unpkg.com';
    $urls[] = '//fonts.googleapis.com';
    $urls[] = '//fonts.gstatic.com';
  }

  return $urls;
}
add_filter('wp_resource_hints', 'rsp_performance_resource_hints', 10, 2);

/**
 * Heartbeat optimization.
 */
function rsp_performance_heartbeat_settings($settings)
{
  if (! is_admin()) {
    $settings['interval'] = 60;
    return $settings;
  }

  $screen = function_exists('get_current_screen') ? get_current_screen() : null;

  if ($screen && 'post' === $screen->base) {
    $settings['interval'] = 30;
  } else {
    $settings['interval'] = 60;
  }

  return $settings;
}
add_filter('heartbeat_settings', 'rsp_performance_heartbeat_settings');

/**
 * Dequeue heartbeat on frontend except WooCommerce sensitive pages.
 */
function rsp_performance_maybe_dequeue_heartbeat()
{
  if (is_admin() || rsp_is_sensitive_woocommerce_page()) {
    return;
  }

  wp_deregister_script('heartbeat');
}
add_action('wp_enqueue_scripts', 'rsp_performance_maybe_dequeue_heartbeat', 100);

/**
 * Safe query string handling for theme local static assets only.
 */
function rsp_performance_static_asset_versioning($src)
{
  if (is_admin() || empty($src)) {
    return $src;
  }

  $theme_uri = get_template_directory_uri();

  if (0 !== strpos($src, $theme_uri)) {
    return $src;
  }

  if (false === strpos($src, 'ver=')) {
    return $src;
  }

  return $src;
}
add_filter('script_loader_src', 'rsp_performance_static_asset_versioning', 10, 1);
add_filter('style_loader_src', 'rsp_performance_static_asset_versioning', 10, 1);

/**
 * Add fetchpriority high to singular featured image when WordPress outputs it.
 */
function rsp_performance_featured_image_priority($attr, $attachment, $size)
{
  if (! is_singular() || is_admin()) {
    return $attr;
  }

  static $done = false;

  if ($done) {
    return $attr;
  }

  $thumbnail_id = get_post_thumbnail_id();

  if ($thumbnail_id && isset($attachment->ID) && (int) $thumbnail_id === (int) $attachment->ID) {
    $attr['loading']       = 'eager';
    $attr['fetchpriority'] = 'high';
    $attr['decoding']      = 'async';
    $done                  = true;
  }

  return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'rsp_performance_featured_image_priority', 20, 3);

/**
 * WooCommerce safe fragment handling.
 */
function rsp_performance_woocommerce_scripts()
{
  if (! class_exists('WooCommerce')) {
    return;
  }

  if (is_cart() || is_checkout() || is_account_page()) {
    return;
  }

  if (! is_woocommerce()) {
    wp_dequeue_script('wc-cart-fragments');
  }
}
add_action('wp_enqueue_scripts', 'rsp_performance_woocommerce_scripts', 99);

/**
 * Disable dashicons for logged-out frontend visitors.
 */
function rsp_performance_disable_dashicons_for_guests()
{
  if (is_admin() || is_user_logged_in()) {
    return;
  }

  wp_deregister_style('dashicons');
}
add_action('wp_enqueue_scripts', 'rsp_performance_disable_dashicons_for_guests', 100);

/**
 * Add sane cache headers for non-admin frontend pages.
 * Server/CDN cache rules should still be managed at hosting level.
 */
function rsp_performance_cache_headers()
{
  if (is_admin() || is_user_logged_in() || rsp_is_sensitive_woocommerce_page()) {
    return;
  }

  if (headers_sent()) {
    return;
  }

  header('Cache-Control: public, max-age=600, stale-while-revalidate=86400');
}
add_action('send_headers', 'rsp_performance_cache_headers', 20);
