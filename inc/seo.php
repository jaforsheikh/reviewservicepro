<?php

/**
 * SEO Helpers
 *
 * File: inc/seo.php
 *
 * Purpose:
 * - Add SEO metadata for important theme pages
 * - Add ReviewService.Pro services page SEO title/meta/canonical
 * - Add safe Service/Breadcrumb/Organization schema
 *
 * Important:
 * - Safe for Online Reputation Management
 * - Uses AI-Driven wording without unsafe review claims
 * - Does not promise fake reviews, guaranteed rating, guaranteed removal, or ranking guarantees
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Check if current page is the ORM Services page.
 */
if (! function_exists('rsp_is_services_page')) {
  function rsp_is_services_page()
  {
    return is_page_template('page-templates/template-services.php') || is_page('services');
  }
}

/**
 * Services page SEO data.
 */
if (! function_exists('rsp_get_services_page_seo_data')) {
  function rsp_get_services_page_seo_data()
  {
    return [
      'title'       => __('AI-Driven Online Reputation Management Services | ReviewService.Pro', 'reviewservicepro'),
      'description' => __('AI-driven online reputation management services for review monitoring, review response management, reputation audits, negative review case support, genuine feedback workflows, and monthly reporting.', 'reviewservicepro'),
      'keywords'    => [
        'AI-Driven Online Reputation Management Services',
        'Online Reputation Management Services',
        'review monitoring service',
        'review response management',
        'negative review management',
        'negative review case support',
        'reputation audit',
        'monthly reputation management',
        'ethical reputation management',
        'AI-assisted review monitoring',
        'AI-supported reputation insights',
        'Google Business Profile reputation management',
        'Google My Business reputation management',
        'Google review monitoring',
        'Trustpilot reputation management',
        'Yelp review monitoring',
        'Facebook review management',
        'Tripadvisor reputation monitoring',
        'BBB reputation management',
        'G2 review monitoring',
        'Capterra reputation management',
        'Sitejabber review monitoring',
        'Reviews.io reputation management',
        'local trust signal support',
        'genuine customer feedback request system',
        'positive customer feedback workflow',
      ],
      'image'       => get_theme_file_uri('assets/images/services/orm-dashboard-monitoring.jpg'),
      'url'         => home_url('/services/'),
    ];
  }
}

/**
 * SEO title for services page.
 */
add_filter('pre_get_document_title', 'rsp_services_page_document_title', 20);

if (! function_exists('rsp_services_page_document_title')) {
  function rsp_services_page_document_title($title)
  {
    if (! rsp_is_services_page()) {
      return $title;
    }

    $seo = rsp_get_services_page_seo_data();

    return $seo['title'];
  }
}

/**
 * Add meta tags to wp_head.
 */
add_action('wp_head', 'rsp_services_page_meta_tags', 5);

if (! function_exists('rsp_services_page_meta_tags')) {
  function rsp_services_page_meta_tags()
  {
    if (! rsp_is_services_page()) {
      return;
    }

    $seo = rsp_get_services_page_seo_data();

    /**
     * If you later use Rank Math / Yoast / AIOSEO, you may disable these
     * by adding this filter in functions.php:
     *
     * add_filter('rsp_enable_services_meta_tags', '__return_false');
     */
    if (! apply_filters('rsp_enable_services_meta_tags', true)) {
      return;
    }

    $title       = $seo['title'];
    $description = $seo['description'];
    $canonical   = $seo['url'];
    $image       = $seo['image'];
    $keywords    = implode(', ', $seo['keywords']);
?>

    <meta name="description" content="<?php echo esc_attr($description); ?>">
    <meta name="keywords" content="<?php echo esc_attr($keywords); ?>">
    <link rel="canonical" href="<?php echo esc_url($canonical); ?>">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:url" content="<?php echo esc_url($canonical); ?>">
    <meta property="og:image" content="<?php echo esc_url($image); ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($image); ?>">

  <?php
  }
}

/**
 * Services page JSON-LD schema.
 *
 * Note:
 * FAQ schema is already generated inside:
 * template-parts/sections/services/faq.php
 *
 * So this function outputs:
 * - Organization
 * - WebPage
 * - Service
 * - BreadcrumbList
 */
add_action('wp_head', 'rsp_services_page_schema', 30);

if (! function_exists('rsp_services_page_schema')) {
  function rsp_services_page_schema()
  {
    if (! rsp_is_services_page()) {
      return;
    }

    if (! apply_filters('rsp_enable_services_schema', true)) {
      return;
    }

    $seo          = rsp_get_services_page_seo_data();
    $site_name    = get_bloginfo('name');
    $home_url     = home_url('/');
    $services_url = $seo['url'];
    $logo_url     = get_theme_file_uri('assets/images/logo.png');

    /**
     * If your logo file is in another path, update:
     * assets/images/logo.png
     */

    $organization_id = trailingslashit($home_url) . '#organization';
    $webpage_id      = trailingslashit($services_url) . '#webpage';
    $service_id      = trailingslashit($services_url) . '#service';
    $breadcrumb_id   = trailingslashit($services_url) . '#breadcrumb';

    $schema = [
      '@context' => 'https://schema.org',
      '@graph'   => [
        [
          '@type' => 'Organization',
          '@id'   => $organization_id,
          'name'  => 'ReviewService.Pro',
          'url'   => $home_url,
          'logo'  => [
            '@type' => 'ImageObject',
            'url'   => $logo_url,
          ],
          'description' => __('ReviewService.Pro provides ethical AI-driven online reputation management services including review monitoring, review response management, reputation audits, negative review case support, genuine customer feedback workflows, and monthly reporting.', 'reviewservicepro'),
          'sameAs' => [],
        ],
        [
          '@type'       => 'WebPage',
          '@id'         => $webpage_id,
          'url'         => $services_url,
          'name'        => $seo['title'],
          'description' => $seo['description'],
          'isPartOf'    => [
            '@id' => $organization_id,
          ],
          'breadcrumb'  => [
            '@id' => $breadcrumb_id,
          ],
          'about'       => [
            '@id' => $service_id,
          ],
          'primaryImageOfPage' => [
            '@type' => 'ImageObject',
            'url'   => $seo['image'],
          ],
        ],
        [
          '@type'       => 'Service',
          '@id'         => $service_id,
          'name'        => 'AI-Driven Online Reputation Management Services',
          'serviceType' => 'Online Reputation Management',
          'provider'    => [
            '@id' => $organization_id,
          ],
          'areaServed'  => [
            [
              '@type' => 'Country',
              'name'  => 'United States',
            ],
            [
              '@type' => 'Country',
              'name'  => 'United Kingdom',
            ],
            [
              '@type' => 'Country',
              'name'  => 'Canada',
            ],
            [
              '@type' => 'Country',
              'name'  => 'Australia',
            ],
            [
              '@type' => 'Place',
              'name'  => 'Global',
            ],
          ],
          'description' => __('AI-driven online reputation management services that help businesses monitor reviews, manage review responses, document reputation risks, request genuine customer feedback ethically, and receive transparent monthly reporting.', 'reviewservicepro'),
          'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name'  => 'Online Reputation Management Plans and Packages',
            'itemListElement' => [
              [
                '@type' => 'Offer',
                'name'  => 'Basic ORM Plan',
                'description' => __('Monthly reputation monitoring for up to 2 selected review platforms.', 'reviewservicepro'),
              ],
              [
                '@type' => 'Offer',
                'name'  => 'Growth ORM Plan',
                'description' => __('Monthly review monitoring, review response support, negative review case tracking, and reporting for up to 5 selected platforms.', 'reviewservicepro'),
              ],
              [
                '@type' => 'Offer',
                'name'  => 'Premium ORM Plan',
                'description' => __('Priority monthly reputation management with advanced response support, case documentation, and reporting for up to 10 selected platforms.', 'reviewservicepro'),
              ],
              [
                '@type' => 'Offer',
                'name'  => 'Reputation Audit Package',
                'description' => __('One-time reputation audit for review profile health, platform risks, response quality, and priority action recommendations.', 'reviewservicepro'),
              ],
              [
                '@type' => 'Offer',
                'name'  => 'Review Response Setup Package',
                'description' => __('One-time review response framework for positive, neutral, and negative customer reviews.', 'reviewservicepro'),
              ],
              [
                '@type' => 'Offer',
                'name'  => 'Negative Review Case Review',
                'description' => __('One-time negative review case support focused on documentation, response direction, and platform reporting guidance when appropriate.', 'reviewservicepro'),
              ],
            ],
          ],
          'termsOfService' => home_url('/terms-of-service/'),
          'audience' => [
            '@type' => 'BusinessAudience',
            'audienceType' => 'Local businesses, ecommerce brands, clinics, restaurants, law firms, agencies, service providers, and multi-platform businesses',
          ],
        ],
        [
          '@type' => 'BreadcrumbList',
          '@id'   => $breadcrumb_id,
          'itemListElement' => [
            [
              '@type'    => 'ListItem',
              'position' => 1,
              'name'     => 'Home',
              'item'     => $home_url,
            ],
            [
              '@type'    => 'ListItem',
              'position' => 2,
              'name'     => 'Online Reputation Management Services',
              'item'     => $services_url,
            ],
          ],
        ],
      ],
    ];

  ?>
    <script type="application/ld+json">
      <?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
<?php
  }
}
