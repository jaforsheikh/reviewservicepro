<?php

/**
 * ReviewServicePro Theme Functions
 *
 * File: functions.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Theme constants.
 */
if (! defined('RSP_THEME_VERSION')) {
  define('RSP_THEME_VERSION', '1.0.0');
}

if (! defined('RSP_THEME_DIR')) {
  define('RSP_THEME_DIR', get_template_directory());
}

if (! defined('RSP_THEME_URI')) {
  define('RSP_THEME_URI', get_template_directory_uri());
}

/**
 * Load required theme files safely.
 *
 * Keep this list centralized so optional modules can be added without
 * breaking the theme when a file is missing during development.
 */
function rsp_load_theme_files()
{
  $includes = [
    '/inc/setup.php',
    '/inc/helpers.php',
    '/inc/cpt.php',
    '/inc/acf.php',
    '/inc/enqueue.php',
    '/inc/seo.php',
    '/inc/schema.php',
    '/inc/security.php',
    '/inc/performance.php',
    '/inc/woocommerce.php',

    /**
     * Admin utilities.
     */
    '/inc/admin-post-duplicate.php',

    /**
     * ReviewService.Pro safe SEO cluster system.
     */
    '/inc/seo-cluster-meta.php',

    /**
     * Optional WooCommerce product card/meta fields.
     */
    '/inc/woocommerce-product-meta.php',
  ];

  $includes = apply_filters('rsp_theme_includes', $includes);

  foreach ($includes as $file) {
    $filepath = RSP_THEME_DIR . $file;

    if (file_exists($filepath)) {
      require_once $filepath;
    }
  }
}
rsp_load_theme_files();

/**
 * Ensure Lucide icons are available once.
 *
 * inc/enqueue.php already enqueues the main theme assets. This fallback only
 * loads Lucide when another handle has not already loaded it, avoiding duplicate
 * requests while keeping icons reliable across templates and admin-preview states.
 */
function rsp_ensure_lucide_icons()
{
  if (wp_script_is('lucide-icons', 'enqueued') || wp_script_is('rsp-lucide-icons', 'enqueued')) {
    return;
  }

  $local_lucide_path = RSP_THEME_DIR . '/assets/vendor/lucide/lucide.min.js';
  $local_lucide_uri  = RSP_THEME_URI . '/assets/vendor/lucide/lucide.min.js';

  $lucide_src = file_exists($local_lucide_path)
    ? $local_lucide_uri
    : 'https://unpkg.com/lucide@latest/dist/umd/lucide.min.js';

  $lucide_version = file_exists($local_lucide_path)
    ? (string) filemtime($local_lucide_path)
    : null;

  wp_enqueue_script(
    'rsp-lucide-icons',
    $lucide_src,
    [],
    $lucide_version,
    true
  );

  wp_add_inline_script(
    'rsp-lucide-icons',
    '(function(){function r(){if(window.lucide&&typeof window.lucide.createIcons==="function"){window.lucide.createIcons();}}if(document.readyState==="loading"){document.addEventListener("DOMContentLoaded",r);}else{r();}window.addEventListener("load",r);})();'
  );
}
add_action('wp_enqueue_scripts', 'rsp_ensure_lucide_icons', 30);

/**
 * Disable comments support site-wide.
 */
function rsp_disable_comments_support()
{
  $post_types = get_post_types([], 'names');

  foreach ($post_types as $post_type) {
    if (post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
    }

    if (post_type_supports($post_type, 'trackbacks')) {
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
}
add_action('init', 'rsp_disable_comments_support', 100);

/**
 * Close comments and pings everywhere.
 *
 * @return bool
 */
function rsp_disable_comments_status()
{
  return false;
}
add_filter('comments_open', 'rsp_disable_comments_status', 20);
add_filter('pings_open', 'rsp_disable_comments_status', 20);

/**
 * Hide existing comments from frontend.
 *
 * @param array $comments Existing comments.
 * @return array
 */
function rsp_hide_existing_comments($comments)
{
  return [];
}
add_filter('comments_array', 'rsp_hide_existing_comments', 10);

/**
 * Remove comments admin menu.
 */
function rsp_remove_comments_admin_menu()
{
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'rsp_remove_comments_admin_menu');

/**
 * Redirect comments admin page.
 */
function rsp_redirect_comments_admin_page()
{
  global $pagenow;

  if ('edit-comments.php' === $pagenow) {
    wp_safe_redirect(admin_url());
    exit;
  }
}
add_action('admin_init', 'rsp_redirect_comments_admin_page');

/**
 * Remove comments from admin bar.
 */
function rsp_remove_comments_admin_bar()
{
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}
add_action('init', 'rsp_remove_comments_admin_bar');

/**
 * Remove comments dashboard widget.
 */
function rsp_remove_comments_dashboard_widget()
{
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'rsp_remove_comments_dashboard_widget');

/**
 * Remove comments column from admin list tables.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function rsp_remove_comments_admin_columns($columns)
{
  if (isset($columns['comments'])) {
    unset($columns['comments']);
  }

  return $columns;
}
add_filter('manage_posts_columns', 'rsp_remove_comments_admin_columns');
add_filter('manage_pages_columns', 'rsp_remove_comments_admin_columns');

/**
 * Remove extra comment feed links.
 */
function rsp_remove_comment_feed_links()
{
  remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('init', 'rsp_remove_comment_feed_links');
