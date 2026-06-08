<?php

/**
 * Advanced WordPress Security Hardening.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Disable theme/plugin file editor.
 */
if (! defined('DISALLOW_FILE_EDIT')) {
  define('DISALLOW_FILE_EDIT', true);
}

/**
 * Check WooCommerce sensitive pages.
 */
function rsp_security_is_woocommerce_sensitive_page()
{
  if (! class_exists('WooCommerce')) {
    return false;
  }

  return is_cart() || is_checkout() || is_account_page();
}

/**
 * Hide WordPress version.
 */
function rsp_security_remove_wp_version()
{
  return '';
}
add_filter('the_generator', 'rsp_security_remove_wp_version');

/**
 * Clean unnecessary head links.
 */
function rsp_security_clean_head()
{
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'rsp_security_clean_head');

/**
 * Disable XML-RPC.
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Block XML-RPC requests.
 */
function rsp_security_block_xmlrpc_requests()
{
  if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) {
    status_header(403);
    exit;
  }
}
add_action('init', 'rsp_security_block_xmlrpc_requests');

/**
 * Remove X-Pingback header.
 */
function rsp_security_remove_x_pingback($headers)
{
  if (isset($headers['X-Pingback'])) {
    unset($headers['X-Pingback']);
  }

  unset($headers['X-Powered-By']);

  return $headers;
}
add_filter('wp_headers', 'rsp_security_remove_x_pingback');

/**
 * Disable pingbacks safely.
 */
function rsp_security_disable_pingbacks(&$links)
{
  foreach ($links as $key => $link) {
    if (false !== strpos($link, 'xmlrpc.php')) {
      unset($links[$key]);
    }
  }
}
add_action('pre_ping', 'rsp_security_disable_pingbacks');

/**
 * Hide detailed login errors.
 */
function rsp_security_hide_login_errors()
{
  return __('Invalid login details.', 'reviewservicepro');
}
add_filter('login_errors', 'rsp_security_hide_login_errors');

/**
 * Block author enumeration.
 */
function rsp_security_block_author_enumeration()
{
  if (is_admin() || wp_doing_ajax() || wp_is_json_request()) {
    return;
  }

  if (isset($_GET['author'])) {
    wp_safe_redirect(home_url('/'), 301);
    exit;
  }
}
add_action('template_redirect', 'rsp_security_block_author_enumeration');

/**
 * Reduce REST API user exposure without disabling REST API.
 */
function rsp_security_protect_rest_users($prepared_args, $request)
{
  if (is_user_logged_in() && current_user_can('list_users')) {
    return $prepared_args;
  }

  $prepared_args['include'] = [0];

  return $prepared_args;
}
add_filter('rest_user_query', 'rsp_security_protect_rest_users', 10, 2);

/**
 * Remove REST API discovery links only.
 */
function rsp_security_remove_rest_links()
{
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('init', 'rsp_security_remove_rest_links');

/**
 * Safe security headers.
 */
function rsp_security_headers()
{
  if (headers_sent() || is_admin()) {
    return;
  }

  header('X-Content-Type-Options: nosniff');
  header('X-Frame-Options: SAMEORIGIN');
  header('Referrer-Policy: strict-origin-when-cross-origin');
  header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

  if (is_ssl()) {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
  }
}
add_action('send_headers', 'rsp_security_headers', 15);

/**
 * Block sensitive file probing.
 */
function rsp_security_block_sensitive_requests()
{
  if (is_admin() || wp_doing_ajax()) {
    return;
  }

  $request_uri = isset($_SERVER['REQUEST_URI'])
    ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']))
    : '';

  if (empty($request_uri)) {
    return;
  }

  $blocked_patterns = [
    'wp-config.php',
    '.env',
    'composer.json',
    'composer.lock',
    'package.json',
    'package-lock.json',
    'yarn.lock',
    'phpinfo.php',
    'readme.html',
    'license.txt',
    '.git',
    '.svn',
    '.sql',
    '.bak',
    '.zip',
  ];

  foreach ($blocked_patterns as $pattern) {
    if (false !== stripos($request_uri, $pattern)) {
      status_header(403);
      nocache_headers();
      exit;
    }
  }
}
add_action('init', 'rsp_security_block_sensitive_requests');

/**
 * Remove file editing capabilities.
 */
function rsp_security_remove_file_edit_capability($allcaps)
{
  $blocked_caps = [
    'edit_themes',
    'edit_plugins',
    'edit_files',
    'update_themes',
    'update_plugins',
  ];

  foreach ($blocked_caps as $cap) {
    if (isset($allcaps[$cap])) {
      $allcaps[$cap] = false;
    }
  }

  return $allcaps;
}
add_filter('user_has_cap', 'rsp_security_remove_file_edit_capability');

/**
 * Safe upload MIME hardening.
 */
function rsp_security_allowed_mime_types($mimes)
{
  if (! current_user_can('upload_files')) {
    return [];
  }

  unset($mimes['exe']);
  unset($mimes['scr']);
  unset($mimes['bat']);
  unset($mimes['cmd']);
  unset($mimes['com']);
  unset($mimes['pif']);
  unset($mimes['php']);
  unset($mimes['php3']);
  unset($mimes['php4']);
  unset($mimes['php5']);
  unset($mimes['phtml']);
  unset($mimes['sh']);
  unset($mimes['pl']);
  unset($mimes['py']);
  unset($mimes['jsp']);
  unset($mimes['asp']);
  unset($mimes['aspx']);

  return $mimes;
}
add_filter('upload_mimes', 'rsp_security_allowed_mime_types');

/**
 * Disable application passwords for non-admins.
 */
function rsp_security_disable_application_passwords_for_non_admins($available, $user)
{
  if ($user instanceof WP_User && user_can($user, 'manage_options')) {
    return $available;
  }

  return false;
}
add_filter('wp_is_application_passwords_available_for_user', 'rsp_security_disable_application_passwords_for_non_admins', 10, 2);

/**
 * Basic bad query protection.
 */
function rsp_security_basic_bad_query_blocker()
{
  if (is_admin() || wp_doing_ajax() || rsp_security_is_woocommerce_sensitive_page()) {
    return;
  }

  $request_uri = isset($_SERVER['REQUEST_URI'])
    ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']))
    : '';

  $query_string = isset($_SERVER['QUERY_STRING'])
    ? sanitize_text_field(wp_unslash($_SERVER['QUERY_STRING']))
    : '';

  $combined = strtolower($request_uri . ' ' . $query_string);

  $bad_patterns = [
    'base64_encode',
    'base64_decode',
    'eval(',
    'GLOBALS[',
    '_REQUEST',
    '_SERVER',
    'wp-config',
    '<script',
    '%3cscript',
    '../',
    '..%2f',
  ];

  foreach ($bad_patterns as $pattern) {
    if (false !== strpos($combined, strtolower($pattern))) {
      status_header(403);
      nocache_headers();
      exit;
    }
  }
}
add_action('init', 'rsp_security_basic_bad_query_blocker', 9);

/**
 * Disable user sitemap exposure only when no SEO plugin controls it.
 */
function rsp_security_disable_user_sitemap($provider, $name)
{
  if ('users' === $name) {
    return false;
  }

  return $provider;
}
add_filter('wp_sitemaps_add_provider', 'rsp_security_disable_user_sitemap', 10, 2);

/**
 * Prevent public author archives.
 */
function rsp_security_redirect_author_archives()
{
  if (is_author() && ! is_admin()) {
    wp_safe_redirect(home_url('/'), 301);
    exit;
  }
}
add_action('template_redirect', 'rsp_security_redirect_author_archives');

/**
 * Protect login page from very basic empty bot submissions.
 */
function rsp_security_basic_login_bot_check($user, $username, $password)
{
  if (is_wp_error($user)) {
    return $user;
  }

  if (empty($username) || empty($password)) {
    return new WP_Error(
      'rsp_empty_login',
      __('Invalid login details.', 'reviewservicepro')
    );
  }

  return $user;
}
add_filter('authenticate', 'rsp_security_basic_login_bot_check', 20, 3);

/**
 * Remove comment-related REST exposure if comments are disabled.
 */
function rsp_security_remove_comment_rest_links($response, $post, $request)
{
  if (! $response instanceof WP_REST_Response) {
    return $response;
  }

  $response->remove_link('replies');

  return $response;
}
add_filter('rest_prepare_post', 'rsp_security_remove_comment_rest_links', 10, 3);
add_filter('rest_prepare_page', 'rsp_security_remove_comment_rest_links', 10, 3);
