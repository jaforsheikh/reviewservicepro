<?php

/**
 * Theme assets enqueue.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Return theme version.
 */
function rsp_asset_version()
{
  return defined('RSP_THEME_VERSION') ? RSP_THEME_VERSION : wp_get_theme()->get('Version');
}

/**
 * Return filemtime version when file exists.
 */
function rsp_asset_file_version($relative_path)
{
  $path = get_template_directory() . $relative_path;

  return file_exists($path) ? filemtime($path) : rsp_asset_version();
}

/**
 * Enqueue a local script safely.
 */
function rsp_enqueue_local_script($handle, $relative_path, $deps = [])
{
  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();
  $file_path = $theme_dir . $relative_path;

  if (! file_exists($file_path)) {
    return false;
  }

  wp_enqueue_script(
    $handle,
    $theme_uri . $relative_path,
    $deps,
    filemtime($file_path),
    true
  );

  return true;
}

/**
 * Global typography and motion foundation.
 *
 * Purpose:
 * - Force Poppins for headings/title system.
 * - Force Inter for body/UI text.
 * - Prevent unwanted serif fallback across homepage/sections.
 * - Provide reusable typography utility classes.
 */
function rsp_global_foundation_css()
{
  return '
    :root {
      --rsp-font-heading: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      --rsp-font-body: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;

      --rsp-color-title: #334155;
      --rsp-color-heading: #3B4658;
      --rsp-color-body: #64748B;

      --rsp-blue: #2563EB;
      --rsp-green: #00C853;
      --rsp-teal: #14B8A6;
      --rsp-dark: #07111F;
    }

    html {
      text-rendering: optimizeLegibility;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    body {
      font-family: var(--rsp-font-body);
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
      color: var(--rsp-color-body);
    }

    body button,
    body input,
    body select,
    body textarea {
      font-family: var(--rsp-font-body);
    }

    body h1,
    body h2,
    body h3,
    body h4,
    body h5,
    body h6,
    body .rsp-title,
    body .rsp-section-title,
    body .rsp-card-title,
    body .entry-title,
    body .page-title,
    body .site-title {
      font-family: var(--rsp-font-heading);
    }

    body h1,
    body .rsp-title {
      color: var(--rsp-color-title);
      font-weight: 800;
      letter-spacing: -0.055em;
    }

    body h2,
    body .rsp-section-title {
      color: var(--rsp-color-title);
      font-weight: 800;
      letter-spacing: -0.048em;
    }

    body h3,
    body h4,
    body .rsp-card-title {
      color: var(--rsp-color-heading);
      font-weight: 800;
      letter-spacing: -0.035em;
    }

    body .rsp-body {
      font-family: var(--rsp-font-body);
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
      color: var(--rsp-color-body);
    }

    body .rsp-subtitle {
      font-family: var(--rsp-font-body);
      font-size: 16px;
      font-weight: 500;
      line-height: 1.8;
      color: var(--rsp-color-body);
    }

    body .rsp-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    body .rsp-h1 {
      font-family: var(--rsp-font-heading);
      font-size: clamp(42px, 6.8vw, 80px);
      font-weight: 800;
      line-height: 0.98;
      letter-spacing: -0.065em;
      color: var(--rsp-color-title);
    }

    body .rsp-h2 {
      font-family: var(--rsp-font-heading);
      font-size: clamp(32px, 4.8vw, 60px);
      font-weight: 800;
      line-height: 1.04;
      letter-spacing: -0.055em;
      color: var(--rsp-color-title);
    }

    body .rsp-h3 {
      font-family: var(--rsp-font-heading);
      font-size: clamp(22px, 2.4vw, 30px);
      font-weight: 800;
      line-height: 1.15;
      letter-spacing: -0.04em;
      color: var(--rsp-color-heading);
    }

    body .rsp-soft-title {
      color: var(--rsp-color-title);
    }

    body .rsp-soft-heading {
      color: var(--rsp-color-heading);
    }

    body .rsp-soft-text {
      color: var(--rsp-color-body);
    }

    body .rsp-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    body .rsp-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      z-index: 0;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
      pointer-events: none;
    }

    body .rsp-btn:hover {
      transform: translateY(-3px);
    }

    body .rsp-btn:hover::before {
      left: 135%;
    }

    body .rsp-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    body .rsp-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(
        from 0deg,
        rgba(37, 99, 235, 0.07),
        rgba(0, 200, 83, 0.24),
        rgba(20, 184, 166, 0.18),
        rgba(37, 99, 235, 0.24),
        rgba(37, 99, 235, 0.07)
      );
      transform: rotate(0deg);
      animation: rspGlobalBorderSpin 8s linear infinite;
      opacity: 0.70;
      transition: opacity 260ms ease;
      pointer-events: none;
    }

    body .rsp-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-motion-inner, #ffffff);
      pointer-events: none;
    }

    body .rsp-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    @keyframes rspGlobalBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      body .rsp-btn,
      body .rsp-btn::before,
      body .rsp-motion-border::before {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      body .rsp-btn:hover {
        transform: none;
      }
    }
  ';
}

/**
 * Enqueue theme assets.
 */
function rsp_enqueue_assets()
{
  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();

  /**
   * Global fonts.
   *
   * Poppins = headings/titles
   * Inter = body/UI text
   */
  wp_enqueue_style(
    'rsp-google-fonts',
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap',
    [],
    null
  );

  $css_file = '/assets/dist/css/app.css';
  $main_style_handle = 'rsp-app-style';

  if (file_exists($theme_dir . $css_file)) {
    wp_enqueue_style(
      $main_style_handle,
      $theme_uri . $css_file,
      ['rsp-google-fonts'],
      filemtime($theme_dir . $css_file)
    );
  } else {
    $main_style_handle = 'rsp-style';

    wp_enqueue_style(
      $main_style_handle,
      get_stylesheet_uri(),
      ['rsp-google-fonts'],
      rsp_asset_version()
    );
  }

  wp_add_inline_style(
    $main_style_handle,
    rsp_global_foundation_css()
  );

  /**
   * Lucide Icons.
   *
   * Prefer local vendor file if available.
   * Fallback to CDN if local file does not exist.
   */
  $local_lucide = '/assets/src/vendor/lucide/lucide.min.js';

  if (file_exists($theme_dir . $local_lucide)) {
    wp_enqueue_script(
      'lucide-icons',
      $theme_uri . $local_lucide,
      [],
      filemtime($theme_dir . $local_lucide),
      true
    );
  } else {
    wp_enqueue_script(
      'lucide-icons',
      'https://unpkg.com/lucide@latest/dist/umd/lucide.js',
      [],
      null,
      true
    );
  }

  wp_enqueue_script(
    'gsap',
    'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
    [],
    '3.12.5',
    true
  );

  wp_enqueue_script(
    'gsap-scrolltrigger',
    'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
    ['gsap'],
    '3.12.5',
    true
  );

  $needs_swiper = is_front_page()
    || is_page_template('page-templates/template-services.php')
    || is_singular(['platforms', 'industries', 'case_studies']);

  if ($needs_swiper) {
    wp_enqueue_style(
      'swiper',
      'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
      [],
      '11.0.0'
    );

    wp_enqueue_script(
      'swiper',
      'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
      [],
      '11.0.0',
      true
    );
  }

  if (apply_filters('rsp_enqueue_alpine', false)) {
    wp_enqueue_script(
      'alpinejs',
      'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
      [],
      null,
      true
    );

    wp_script_add_data('alpinejs', 'defer', true);
  }

  $app_loaded = rsp_enqueue_local_script(
    'rsp-app',
    '/assets/src/js/app.js',
    ['lucide-icons']
  );

  $global_loaded = rsp_enqueue_local_script(
    'rsp-global',
    '/assets/src/js/global.js',
    ['lucide-icons']
  );

  $animations_loaded = rsp_enqueue_local_script(
    'rsp-animations',
    '/assets/src/js/animations.js',
    ['gsap', 'gsap-scrolltrigger', 'lucide-icons']
  );

  rsp_enqueue_local_script(
    'rsp-sliders',
    '/assets/src/js/sliders.js',
    $needs_swiper ? ['swiper'] : []
  );

  rsp_enqueue_local_script(
    'rsp-forms',
    '/assets/src/js/forms.js',
    []
  );

  rsp_enqueue_local_script(
    'rsp-industries',
    '/assets/src/js/industries.js',
    []
  );

  $page_deps = [];

  if ($global_loaded) {
    $page_deps[] = 'rsp-global';
  }

  if ($animations_loaded) {
    $page_deps[] = 'rsp-animations';
  }

  if (is_front_page()) {
    rsp_enqueue_local_script(
      'rsp-home',
      '/assets/src/js/pages/home.js',
      $page_deps
    );
  }

  if (is_page_template('page-templates/template-contact.php') || is_page('contact')) {
    $contact_deps = $global_loaded ? ['rsp-global'] : [];

    if (wp_script_is('rsp-forms', 'enqueued')) {
      $contact_deps[] = 'rsp-forms';
    }

    rsp_enqueue_local_script(
      'rsp-contact',
      '/assets/src/js/pages/contact.js',
      $contact_deps
    );
  }

  if (is_page_template('page-templates/template-services.php') || is_page('services')) {
    rsp_enqueue_local_script(
      'rsp-services',
      '/assets/src/js/pages/services.js',
      $page_deps
    );
  }

  if (is_post_type_archive('platforms') || is_singular('platforms')) {
    rsp_enqueue_local_script(
      'rsp-platforms',
      '/assets/src/js/pages/platforms.js',
      $page_deps
    );
  }

  if (is_post_type_archive('industries') || is_singular('industries')) {
    rsp_enqueue_local_script(
      'rsp-industry-pages',
      '/assets/src/js/pages/industries.js',
      $page_deps
    );
  }

  if (is_post_type_archive('case_studies') || is_singular('case_studies')) {
    rsp_enqueue_local_script(
      'rsp-case-studies',
      '/assets/src/js/pages/case-studies.js',
      $page_deps
    );
  }

  if (
    class_exists('WooCommerce')
    && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())
  ) {
    $woo_deps = $global_loaded ? ['rsp-global'] : [];

    if (wp_script_is('rsp-forms', 'enqueued')) {
      $woo_deps[] = 'rsp-forms';
    }

    rsp_enqueue_local_script(
      'rsp-woocommerce',
      '/assets/src/js/pages/woocommerce.js',
      $woo_deps
    );
  }

  if ($global_loaded) {
    wp_localize_script(
      'rsp-global',
      'rspTheme',
      [
        'ajaxUrl'    => esc_url_raw(admin_url('admin-ajax.php')),
        'homeUrl'    => esc_url_raw(home_url('/')),
        'themeUrl'   => esc_url_raw($theme_uri),
        'nonce'      => wp_create_nonce('rsp_nonce'),
        'isLoggedIn' => is_user_logged_in(),
      ]
    );
  }

  /**
   * Robust Lucide initialization.
   *
   * Keeps existing icon classes intact.
   * Does not override class attributes.
   */
  wp_add_inline_script(
    'lucide-icons',
    '
      (function () {
        function rspInitLucideIcons() {
          if (window.lucide && typeof window.lucide.createIcons === "function") {
            window.lucide.createIcons();
          }
        }

        if (document.readyState === "loading") {
          document.addEventListener("DOMContentLoaded", rspInitLucideIcons);
        } else {
          rspInitLucideIcons();
        }

        window.addEventListener("load", rspInitLucideIcons);
        window.setTimeout(rspInitLucideIcons, 800);
      })();
    '
  );
}
add_action('wp_enqueue_scripts', 'rsp_enqueue_assets');

/**
 * Defer frontend scripts.
 */
function rsp_defer_scripts($tag, $handle, $src)
{
  $defer_handles = [
    'lucide-icons',
    'gsap',
    'gsap-scrolltrigger',
    'swiper',
    'alpinejs',
    'rsp-app',
    'rsp-global',
    'rsp-sliders',
    'rsp-forms',
    'rsp-industries',
    'rsp-animations',
    'rsp-home',
    'rsp-contact',
    'rsp-services',
    'rsp-platforms',
    'rsp-industry-pages',
    'rsp-case-studies',
    'rsp-woocommerce',
  ];

  if (in_array($handle, $defer_handles, true) && false === strpos($tag, ' defer')) {
    return str_replace(' src', ' defer src', $tag);
  }

  return $tag;
}
add_filter('script_loader_tag', 'rsp_defer_scripts', 10, 3);
