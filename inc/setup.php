<?php

/**
 * Theme setup and Customizer settings.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Theme setup.
 */
function rsp_theme_setup()
{
  load_theme_textdomain('reviewservicepro', get_template_directory() . '/languages');

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('responsive-embeds');
  add_theme_support('align-wide');
  add_theme_support('customize-selective-refresh-widgets');
  add_theme_support('editor-styles');
  add_editor_style('assets/dist/css/app.css');

  add_theme_support(
    'html5',
    [
      'search-form',
      'gallery',
      'caption',
      'style',
      'script',
      'navigation-widgets',
    ]
  );

  add_theme_support(
    'custom-logo',
    [
      'height'      => 80,
      'width'       => 240,
      'flex-height' => true,
      'flex-width'  => true,
    ]
  );

  add_image_size('rsp-blog-card', 800, 520, true);
  add_image_size('rsp-featured-large', 1400, 720, true);
  add_image_size('rsp-hero', 1920, 1080, true);
  add_image_size('rsp-square', 600, 600, true);
  add_image_size('rsp-card-wide', 900, 560, true);
  add_image_size('rsp-logo', 320, 160, false);

  register_nav_menus(
    [
      'primary' => __('Primary Menu', 'reviewservicepro'),
      'mobile'  => __('Mobile Menu', 'reviewservicepro'),
      'footer'  => __('Footer Menu', 'reviewservicepro'),
      'legal'   => __('Legal Menu', 'reviewservicepro'),
    ]
  );
}
add_action('after_setup_theme', 'rsp_theme_setup');

/**
 * Content width.
 */
function rsp_content_width()
{
  $GLOBALS['content_width'] = apply_filters('rsp_content_width', 1200);
}
add_action('after_setup_theme', 'rsp_content_width', 0);

/**
 * WooCommerce base support.
 */
function rsp_setup_woocommerce_support()
{
  if (! class_exists('WooCommerce')) {
    return;
  }

  add_theme_support(
    'woocommerce',
    [
      'thumbnail_image_width' => 500,
      'single_image_width'    => 700,
      'product_grid'          => [
        'default_rows'    => 3,
        'min_rows'        => 1,
        'max_rows'        => 6,
        'default_columns' => 3,
        'min_columns'     => 1,
        'max_columns'     => 4,
      ],
    ]
  );

  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'rsp_setup_woocommerce_support', 20);

/**
 * Sanitize textarea.
 */
function rsp_sanitize_textarea($value)
{
  return sanitize_textarea_field($value);
}

/**
 * Sanitize URL or relative path.
 */
function rsp_sanitize_url_or_path($value)
{
  $value = trim((string) $value);

  if (empty($value)) {
    return '';
  }

  if (0 === strpos($value, '/')) {
    return esc_url_raw(home_url($value));
  }

  return esc_url_raw($value);
}

/**
 * Customizer settings.
 */
function rsp_theme_customizer($wp_customize)
{

  $wp_customize->add_section(
    'rsp_brand_settings',
    [
      'title'    => __('Brand Settings', 'reviewservicepro'),
      'priority' => 30,
    ]
  );

  $brand_fields = [
    'rsp_brand_tagline' => [
      'default'  => 'Ethical Online Reputation Management for trust-driven businesses.',
      'label'    => __('Brand Tagline', 'reviewservicepro'),
      'type'     => 'textarea',
      'sanitize' => 'rsp_sanitize_textarea',
    ],
    'rsp_company_name'  => [
      'default'  => 'ReviewService.Pro',
      'label'    => __('Company Name', 'reviewservicepro'),
      'type'     => 'text',
      'sanitize' => 'sanitize_text_field',
    ],
  ];

  foreach ($brand_fields as $key => $field) {
    $wp_customize->add_setting(
      $key,
      [
        'default'           => $field['default'],
        'sanitize_callback' => $field['sanitize'],
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => $field['label'],
        'section' => 'rsp_brand_settings',
        'type'    => $field['type'],
      ]
    );
  }

  $wp_customize->add_section(
    'rsp_trust_signals',
    [
      'title'    => __('Trust Signals Section', 'reviewservicepro'),
      'priority' => 32,
    ]
  );

  $trust_fields = [
    'trust_stat1_num'       => '500',
    'trust_stat1_label'     => 'Businesses helped',
    'trust_stat2_num'       => '12000',
    'trust_stat2_label'     => 'Reviews monitored',
    'trust_stat3_num'       => '98',
    'trust_stat3_label'     => 'Client satisfaction rate',
    'trust_stat4_num'       => '24',
    'trust_stat4_label'     => 'Avg. response time',
    'trust_rating1_score'   => '4.8',
    'trust_rating1_label'   => 'Google avg.',
    'trust_rating2_score'   => '4.7',
    'trust_rating2_label'   => 'Trustpilot avg.',
    'trust_rating3_score'   => '4.6',
    'trust_rating3_label'   => 'Facebook avg.',
    'trust_compliance_note' => 'Ethical, transparent, and platform-compliant reputation management.',
  ];

  foreach ($trust_fields as $key => $default) {
    $wp_customize->add_setting(
      $key,
      [
        'default'           => $default,
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => ucwords(str_replace('_', ' ', str_replace('trust_', '', $key))),
        'section' => 'rsp_trust_signals',
        'type'    => 'text',
      ]
    );
  }

  $wp_customize->add_section(
    'rsp_header_settings',
    [
      'title'    => __('Header Settings', 'reviewservicepro'),
      'priority' => 33,
    ]
  );

  $header_fields = [
    'header_audit_url' => [
      'default' => '/contact/?type=audit',
      'label'   => __('Header Audit Button URL', 'reviewservicepro'),
    ],
    'header_login_url' => [
      'default' => '/my-account/',
      'label'   => __('Header Client Login URL', 'reviewservicepro'),
    ],
  ];

  foreach ($header_fields as $key => $field) {
    $wp_customize->add_setting(
      $key,
      [
        'default'           => $field['default'],
        'sanitize_callback' => 'rsp_sanitize_url_or_path',
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => $field['label'],
        'section' => 'rsp_header_settings',
        'type'    => 'url',
      ]
    );
  }

  $wp_customize->add_section(
    'rsp_contact_settings',
    [
      'title'    => __('Contact Settings', 'reviewservicepro'),
      'priority' => 34,
    ]
  );

  $contact_fields = [
    'rsp_contact_email'    => [
      'default'  => get_option('admin_email'),
      'label'    => __('Contact Email', 'reviewservicepro'),
      'type'     => 'email',
      'sanitize' => 'sanitize_email',
    ],
    'rsp_contact_phone'    => [
      'default'  => '',
      'label'    => __('Contact Phone', 'reviewservicepro'),
      'type'     => 'text',
      'sanitize' => 'sanitize_text_field',
    ],
    'rsp_whatsapp_url'     => [
      'default'  => 'https://wa.me/18077980758',
      'label'    => __('WhatsApp URL', 'reviewservicepro'),
      'type'     => 'url',
      'sanitize' => 'esc_url_raw',
    ],
    'rsp_business_address' => [
      'default'  => '30 N Gould St Ste N, Sheridan, WY 82801',
      'label'    => __('Business Address', 'reviewservicepro'),
      'type'     => 'textarea',
      'sanitize' => 'rsp_sanitize_textarea',
    ],
    'rsp_response_time'    => [
      'default'  => 'Average first response: under 2 hours on business days.',
      'label'    => __('Response Time Note', 'reviewservicepro'),
      'type'     => 'text',
      'sanitize' => 'sanitize_text_field',
    ],
  ];

  foreach ($contact_fields as $key => $field) {
    $wp_customize->add_setting(
      $key,
      [
        'default'           => $field['default'],
        'sanitize_callback' => $field['sanitize'],
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => $field['label'],
        'section' => 'rsp_contact_settings',
        'type'    => $field['type'],
      ]
    );
  }

  $wp_customize->add_section(
    'rsp_footer_settings',
    [
      'title'    => __('Footer Settings', 'reviewservicepro'),
      'priority' => 35,
    ]
  );

  $footer_fields = [
    'footer_tagline'              => [
      'default'  => 'Ethical reputation systems for businesses that want to grow trust, visibility, and customer confidence.',
      'label'    => __('Footer Tagline', 'reviewservicepro'),
      'type'     => 'textarea',
      'sanitize' => 'rsp_sanitize_textarea',
    ],
    'footer_audit_url'            => [
      'default'  => '/contact/?type=audit',
      'label'    => __('Footer Audit URL', 'reviewservicepro'),
      'type'     => 'url',
      'sanitize' => 'rsp_sanitize_url_or_path',
    ],
    'footer_whatsapp_url'         => [
      'default'  => 'https://wa.me/18077980758',
      'label'    => __('Footer WhatsApp URL', 'reviewservicepro'),
      'type'     => 'url',
      'sanitize' => 'esc_url_raw',
    ],
    'footer_address'              => [
      'default'  => '30 N Gould St Ste N, Sheridan, WY 82801',
      'label'    => __('Footer Address', 'reviewservicepro'),
      'type'     => 'textarea',
      'sanitize' => 'rsp_sanitize_textarea',
    ],
    'footer_newsletter_shortcode' => [
      'default'  => '',
      'label'    => __('Newsletter Form Shortcode', 'reviewservicepro'),
      'type'     => 'text',
      'sanitize' => 'sanitize_text_field',
    ],
  ];

  foreach ($footer_fields as $key => $field) {
    $wp_customize->add_setting(
      $key,
      [
        'default'           => $field['default'],
        'sanitize_callback' => $field['sanitize'],
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => $field['label'],
        'section' => 'rsp_footer_settings',
        'type'    => $field['type'],
      ]
    );
  }

  $wp_customize->add_section(
    'rsp_cta_settings',
    [
      'title'    => __('CTA Settings', 'reviewservicepro'),
      'priority' => 36,
    ]
  );

  $cta_fields = [
    'cta_audit_url'   => [
      'default' => '/contact/?type=free-audit',
      'label'   => __('CTA Free Audit URL', 'reviewservicepro'),
      'type'    => 'url',
    ],
    'cta_consult_url' => [
      'default' => '/contact/?type=consultation',
      'label'   => __('CTA Consultation URL', 'reviewservicepro'),
      'type'    => 'url',
    ],
    'cta_whatsapp'    => [
      'default' => '18077980758',
      'label'   => __('CTA WhatsApp Number', 'reviewservicepro'),
      'type'    => 'text',
    ],
    'cta_email'       => [
      'default' => get_option('admin_email'),
      'label'   => __('CTA Email Address', 'reviewservicepro'),
      'type'    => 'email',
    ],
  ];

  foreach ($cta_fields as $key => $field) {
    $sanitize = 'sanitize_text_field';

    if (false !== strpos($key, 'url')) {
      $sanitize = 'rsp_sanitize_url_or_path';
    }

    if (false !== strpos($key, 'email')) {
      $sanitize = 'sanitize_email';
    }

    $wp_customize->add_setting(
      $key,
      [
        'default'           => $field['default'],
        'sanitize_callback' => $sanitize,
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => $field['label'],
        'section' => 'rsp_cta_settings',
        'type'    => $field['type'],
      ]
    );
  }

  $wp_customize->add_section(
    'rsp_social_settings',
    [
      'title'    => __('Social Links', 'reviewservicepro'),
      'priority' => 37,
    ]
  );

  $social_fields = [
    'rsp_facebook_url'  => 'https://www.facebook.com/reviewservice.pro/',
    'rsp_linkedin_url'  => 'https://www.linkedin.com/company/reviewservicepro',
    'rsp_instagram_url' => 'https://www.instagram.com/reviewservice.pro/',
    'rsp_youtube_url'   => '',
    'rsp_x_url'         => '',
  ];

  foreach ($social_fields as $key => $default) {
    $wp_customize->add_setting(
      $key,
      [
        'default'           => $default,
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
      ]
    );

    $wp_customize->add_control(
      $key,
      [
        'label'   => ucwords(str_replace(['rsp_', '_url', '_'], ['', '', ' '], $key)),
        'section' => 'rsp_social_settings',
        'type'    => 'url',
      ]
    );
  }
}
add_action('customize_register', 'rsp_theme_customizer');

/**
 * Body classes.
 */
function rsp_body_classes($classes)
{
  $classes[] = 'reviewservicepro-theme';

  if (is_singular('platforms')) {
    $classes[] = 'rsp-single-platform';
  }

  if (is_singular('industries')) {
    $classes[] = 'rsp-single-industry';
  }

  if (is_singular('case_studies')) {
    $classes[] = 'rsp-single-case-study';
  }

  if (is_post_type_archive(['platforms', 'industries', 'case_studies'])) {
    $classes[] = 'rsp-cpt-archive';
  }

  if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
    $classes[] = 'rsp-woocommerce-page';
  }

  return $classes;
}
add_filter('body_class', 'rsp_body_classes');
