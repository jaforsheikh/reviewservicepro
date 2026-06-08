<?php

/**
 * ReviewServicePro Advanced Schema System.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Check if major SEO plugin is active.
 */
function rsp_schema_has_seo_plugin()
{
  return defined('WPSEO_VERSION')
    || defined('RANK_MATH_VERSION')
    || defined('AIOSEO_VERSION')
    || class_exists('WPSEO_Frontend')
    || class_exists('RankMath')
    || class_exists('AIOSEO\Plugin\AIOSEO');
}

/**
 * Output JSON-LD safely.
 */
function rsp_output_schema($schema)
{
  if (empty($schema) || ! is_array($schema)) {
    return;
  }

  echo '<script type="application/ld+json">' . wp_json_encode(
    $schema,
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
  ) . '</script>' . "\n";
}

/**
 * Organization ID.
 */
function rsp_schema_org_id()
{
  return home_url('/') . '#organization';
}

/**
 * Website ID.
 */
function rsp_schema_website_id()
{
  return home_url('/') . '#website';
}

/**
 * Get schema image.
 */
function rsp_schema_image($post_id = null)
{
  $post_id = $post_id ? $post_id : get_the_ID();

  if ($post_id && has_post_thumbnail($post_id)) {
    return get_the_post_thumbnail_url($post_id, 'full');
  }

  return get_template_directory_uri() . '/screenshot.png';
}

/**
 * Get clean description.
 */
function rsp_schema_description($post_id = null)
{
  $post_id = $post_id ? $post_id : get_the_ID();

  if (! $post_id) {
    return get_bloginfo('description');
  }

  $meta_description = get_post_meta($post_id, 'rsp_meta_description', true);
  $aeo_answer       = get_post_meta($post_id, 'rsp_aeo_short_answer', true);
  $ai_summary       = get_post_meta($post_id, 'rsp_ai_summary', true);

  if (! empty($meta_description)) {
    return wp_strip_all_tags($meta_description);
  }

  if (! empty($aeo_answer)) {
    return wp_strip_all_tags(wp_trim_words($aeo_answer, 35));
  }

  if (! empty($ai_summary)) {
    return wp_strip_all_tags(wp_trim_words($ai_summary, 35));
  }

  $excerpt = get_the_excerpt($post_id);

  if (! empty($excerpt)) {
    return wp_strip_all_tags(wp_trim_words($excerpt, 35));
  }

  return get_bloginfo('description');
}

/**
 * Organization schema.
 */
function rsp_schema_organization()
{
  if (rsp_schema_has_seo_plugin()) {
    return;
  }

  $site_url  = home_url('/');
  $site_name = get_bloginfo('name');
  $logo_url  = get_template_directory_uri() . '/screenshot.png';

  rsp_output_schema(
    [
      '@context'    => 'https://schema.org',
      '@type'       => 'Organization',
      '@id'         => rsp_schema_org_id(),
      'name'        => $site_name,
      'url'         => $site_url,
      'logo'        => [
        '@type' => 'ImageObject',
        'url'   => esc_url_raw($logo_url),
      ],
      'description' => 'ReviewService.Pro helps businesses improve online trust, monitor reviews, manage customer feedback, improve visibility, and build ethical long-term reputation growth.',
      'sameAs'      => [
        'https://www.facebook.com/reviewservice.pro/',
        'https://www.linkedin.com/company/reviewservicepro',
        'https://www.instagram.com/reviewservice.pro/',
      ],
    ]
  );
}
add_action('wp_head', 'rsp_schema_organization', 5);

/**
 * WebSite schema.
 */
function rsp_schema_website()
{
  if (rsp_schema_has_seo_plugin()) {
    return;
  }

  rsp_output_schema(
    [
      '@context'        => 'https://schema.org',
      '@type'           => 'WebSite',
      '@id'             => rsp_schema_website_id(),
      'name'            => get_bloginfo('name'),
      'url'             => home_url('/'),
      'publisher'       => [
        '@id' => rsp_schema_org_id(),
      ],
      'potentialAction' => [
        '@type'       => 'SearchAction',
        'target'      => home_url('/?s={search_term_string}'),
        'query-input' => 'required name=search_term_string',
      ],
    ]
  );
}
add_action('wp_head', 'rsp_schema_website', 6);

/**
 * Homepage service ItemList schema.
 */
function rsp_schema_homepage_services()
{
  if (rsp_schema_has_seo_plugin() || ! is_front_page()) {
    return;
  }

  $services = [
    'Online Reputation Management',
    'Reputation Audit',
    'Review Monitoring',
    'Review Response Strategy',
    'Customer Feedback System',
    'Local Trust Growth',
    'Reputation Reporting',
  ];

  $items = [];

  foreach ($services as $index => $service) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => $index + 1,
      'item'     => [
        '@type'       => 'Service',
        'name'        => $service,
        'provider'    => [
          '@id' => rsp_schema_org_id(),
        ],
        'areaServed'  => 'Global',
        'serviceType' => 'Ethical Online Reputation Management',
        'url'         => home_url('/services/'),
      ],
    ];
  }

  rsp_output_schema(
    [
      '@context'        => 'https://schema.org',
      '@type'           => 'ItemList',
      '@id'             => home_url('/') . '#service-cluster',
      'name'            => 'ReviewService.Pro Reputation Management Services',
      'description'     => 'Core service cluster for ethical online reputation management, review monitoring, customer feedback, review response, and reputation reporting.',
      'itemListElement' => $items,
    ]
  );
}
add_action('wp_head', 'rsp_schema_homepage_services', 10);

/**
 * FAQ schema.
 */
function rsp_schema_faq()
{
  if (rsp_schema_has_seo_plugin()) {
    return;
  }

  if (! is_front_page() && ! is_page() && ! is_singular(['platforms', 'industries'])) {
    return;
  }

  $faqs = [
    [
      'q' => 'What is Online Reputation Management?',
      'a' => 'Online Reputation Management is the process of monitoring, managing, and improving how a business appears online across review platforms, search results, and social media.',
    ],
    [
      'q' => 'Does ReviewService.Pro use fake reviews?',
      'a' => 'No. ReviewService.Pro uses ethical and platform-compliant methods only. We do not buy, generate, or manipulate fake reviews.',
    ],
    [
      'q' => 'Which platforms do you support?',
      'a' => 'We support reputation management across platforms such as Google, Trustpilot, Yelp, Facebook, Tripadvisor, BBB, Sitejabber, G2, Capterra, and other industry-specific platforms.',
    ],
    [
      'q' => 'Can you remove negative reviews?',
      'a' => 'We cannot remove genuine customer reviews. If a review violates platform policy, we can guide businesses through the official reporting process and help reduce negative impact through professional responses.',
    ],
    [
      'q' => 'How long does reputation management take?',
      'a' => 'Many businesses begin seeing measurable improvements within 60 to 90 days. Larger reputation improvements usually take 3 to 6 months depending on review volume, starting rating, and customer activity.',
    ],
  ];

  $entities = [];

  foreach ($faqs as $faq) {
    $entities[] = [
      '@type'          => 'Question',
      'name'           => wp_strip_all_tags($faq['q']),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => wp_strip_all_tags($faq['a']),
      ],
    ];
  }

  rsp_output_schema(
    [
      '@context'   => 'https://schema.org',
      '@type'      => 'FAQPage',
      '@id'        => is_singular() ? get_permalink() . '#faq' : home_url('/') . '#faq',
      'mainEntity' => $entities,
    ]
  );
}
add_action('wp_head', 'rsp_schema_faq', 20);

/**
 * Breadcrumb schema.
 */
function rsp_schema_breadcrumb()
{
  if (rsp_schema_has_seo_plugin() || is_front_page()) {
    return;
  }

  $items = [
    [
      '@type'    => 'ListItem',
      'position' => 1,
      'name'     => 'Home',
      'item'     => home_url('/'),
    ],
  ];

  if (is_singular('post')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'ORM Academy',
      'item'     => home_url('/orm-academy/'),
    ];

    $items[] = [
      '@type'    => 'ListItem',
      'position' => 3,
      'name'     => get_the_title(),
      'item'     => get_permalink(),
    ];
  } elseif (is_singular('platforms')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Platforms',
      'item'     => home_url('/platforms/'),
    ];

    $items[] = [
      '@type'    => 'ListItem',
      'position' => 3,
      'name'     => get_the_title(),
      'item'     => get_permalink(),
    ];
  } elseif (is_singular('industries')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Industries',
      'item'     => home_url('/industries/'),
    ];

    $items[] = [
      '@type'    => 'ListItem',
      'position' => 3,
      'name'     => get_the_title(),
      'item'     => get_permalink(),
    ];
  } elseif (is_singular('case_studies')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Case Studies',
      'item'     => home_url('/case-studies/'),
    ];

    $items[] = [
      '@type'    => 'ListItem',
      'position' => 3,
      'name'     => get_the_title(),
      'item'     => get_permalink(),
    ];
  } elseif (is_post_type_archive('platforms')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Platforms',
      'item'     => home_url('/platforms/'),
    ];
  } elseif (is_post_type_archive('industries')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Industries',
      'item'     => home_url('/industries/'),
    ];
  } elseif (is_post_type_archive('case_studies')) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Case Studies',
      'item'     => home_url('/case-studies/'),
    ];
  } elseif (is_category()) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => single_cat_title('', false),
      'item'     => get_category_link(get_queried_object_id()),
    ];
  } elseif (is_page() || is_singular()) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => get_the_title(),
      'item'     => get_permalink(),
    ];
  } elseif (is_archive()) {
    $items[] = [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => wp_strip_all_tags(get_the_archive_title()),
      'item'     => home_url(add_query_arg([], $GLOBALS['wp']->request ?? '')),
    ];
  }

  rsp_output_schema(
    [
      '@context'        => 'https://schema.org',
      '@type'           => 'BreadcrumbList',
      'itemListElement' => $items,
    ]
  );
}
add_action('wp_head', 'rsp_schema_breadcrumb', 30);

/**
 * Blog Article schema.
 */
function rsp_schema_article()
{
  if (rsp_schema_has_seo_plugin() || ! is_singular('post')) {
    return;
  }

  $post_id = get_the_ID();

  rsp_output_schema(
    [
      '@context'         => 'https://schema.org',
      '@type'            => 'Article',
      '@id'              => get_permalink() . '#article',
      'headline'         => wp_strip_all_tags(get_the_title()),
      'description'      => rsp_schema_description($post_id),
      'url'              => get_permalink(),
      'image'            => rsp_schema_image($post_id),
      'datePublished'    => get_the_date('c'),
      'dateModified'     => get_the_modified_date('c'),
      'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id'   => get_permalink(),
      ],
      'author'           => [
        '@type' => 'Organization',
        'name'  => get_bloginfo('name'),
        'url'   => home_url('/'),
      ],
      'publisher'        => [
        '@id' => rsp_schema_org_id(),
      ],
    ]
  );
}
add_action('wp_head', 'rsp_schema_article', 40);

/**
 * Platform Service schema.
 */
function rsp_schema_platform_service()
{
  if (rsp_schema_has_seo_plugin() || ! is_singular('platforms')) {
    return;
  }

  $post_id       = get_the_ID();
  $seo_title     = get_post_meta($post_id, 'rsp_seo_title', true);
  $focus_keyword = get_post_meta($post_id, 'rsp_focus_keyword', true);
  $best_for      = get_post_meta($post_id, 'rsp_best_for', true);
  $platform_url  = get_post_meta($post_id, 'rsp_platform_url', true);

  $name = $seo_title ? $seo_title : get_the_title() . ' Reputation Management';

  $schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    '@id'         => get_permalink() . '#platform-service',
    'name'        => wp_strip_all_tags($name),
    'description' => rsp_schema_description($post_id),
    'serviceType' => $focus_keyword ? wp_strip_all_tags($focus_keyword) : 'Platform Reputation Management',
    'provider'    => [
      '@id' => rsp_schema_org_id(),
    ],
    'areaServed'  => 'Global',
    'audience'    => [
      '@type' => 'BusinessAudience',
      'name'  => $best_for ? wp_strip_all_tags($best_for) : 'Businesses needing ethical online reputation management',
    ],
    'url'         => get_permalink(),
    'isPartOf'    => [
      '@id' => rsp_schema_website_id(),
    ],
  ];

  if (! empty($platform_url)) {
    $schema['sameAs'] = [esc_url_raw($platform_url)];
  }

  rsp_output_schema($schema);
}
add_action('wp_head', 'rsp_schema_platform_service', 45);

/**
 * Industry Service schema.
 */
function rsp_schema_industry_service()
{
  if (rsp_schema_has_seo_plugin() || ! is_singular('industries')) {
    return;
  }

  $post_id       = get_the_ID();
  $seo_title     = get_post_meta($post_id, 'rsp_seo_title', true);
  $focus_keyword = get_post_meta($post_id, 'rsp_focus_keyword', true);
  $trust_factors = get_post_meta($post_id, 'rsp_trust_factors', true);

  $name = $seo_title ? $seo_title : 'Reputation Management for ' . get_the_title();

  rsp_output_schema(
    [
      '@context'    => 'https://schema.org',
      '@type'       => 'Service',
      '@id'         => get_permalink() . '#industry-service',
      'name'        => wp_strip_all_tags($name),
      'description' => rsp_schema_description($post_id),
      'serviceType' => $focus_keyword ? wp_strip_all_tags($focus_keyword) : 'Industry-Specific Online Reputation Management',
      'provider'    => [
        '@id' => rsp_schema_org_id(),
      ],
      'areaServed'  => 'Global',
      'audience'    => [
        '@type' => 'BusinessAudience',
        'name'  => get_the_title() . ' businesses',
      ],
      'about'       => $trust_factors ? wp_strip_all_tags($trust_factors) : 'Review trust, reputation risks, customer experience, and platform visibility.',
      'url'         => get_permalink(),
      'isPartOf'    => [
        '@id' => rsp_schema_website_id(),
      ],
    ]
  );
}
add_action('wp_head', 'rsp_schema_industry_service', 46);

/**
 * Case Study schema.
 */
function rsp_schema_case_study()
{
  if (rsp_schema_has_seo_plugin() || ! is_singular('case_studies')) {
    return;
  }

  $post_id         = get_the_ID();
  $client_type     = get_post_meta($post_id, 'rsp_client_type', true);
  $platform_used   = get_post_meta($post_id, 'rsp_platform_used', true);
  $challenge       = get_post_meta($post_id, 'rsp_challenge', true);
  $strategy        = get_post_meta($post_id, 'rsp_strategy', true);
  $result          = get_post_meta($post_id, 'rsp_result', true);
  $starting_rating = get_post_meta($post_id, 'rsp_starting_rating', true);
  $final_rating    = get_post_meta($post_id, 'rsp_final_rating', true);
  $review_growth   = get_post_meta($post_id, 'rsp_review_growth', true);
  $timeline        = get_post_meta($post_id, 'rsp_timeline', true);

  rsp_output_schema(
    [
      '@context'         => 'https://schema.org',
      '@type'            => 'Article',
      '@id'              => get_permalink() . '#case-study',
      'headline'         => wp_strip_all_tags(get_the_title()),
      'description'      => rsp_schema_description($post_id),
      'image'            => rsp_schema_image($post_id),
      'url'              => get_permalink(),
      'datePublished'    => get_the_date('c'),
      'dateModified'     => get_the_modified_date('c'),
      'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id'   => get_permalink(),
      ],
      'author'           => [
        '@type' => 'Organization',
        'name'  => get_bloginfo('name'),
        'url'   => home_url('/'),
      ],
      'publisher'        => [
        '@id' => rsp_schema_org_id(),
      ],
      'about'            => array_values(
        array_filter(
          [
            $client_type,
            $platform_used,
            'Online Reputation Management',
            'Review Monitoring',
            'Review Response Strategy',
          ]
        )
      ),
      'keywords'         => implode(
        ', ',
        array_filter(
          [
            $client_type,
            $platform_used,
            $starting_rating,
            $final_rating,
            $review_growth,
            $timeline,
          ]
        )
      ),
      'articleSection'   => 'Reputation Management Case Study',
      'abstract'         => wp_strip_all_tags(
        trim(
          implode(
            ' ',
            array_filter(
              [
                $challenge ? 'Challenge: ' . $challenge : '',
                $strategy ? 'Strategy: ' . $strategy : '',
                $result ? 'Result: ' . $result : '',
              ]
            )
          )
        )
      ),
    ]
  );
}
add_action('wp_head', 'rsp_schema_case_study', 47);

/**
 * CollectionPage schema for CPT archives.
 */
function rsp_schema_cpt_archives()
{
  if (rsp_schema_has_seo_plugin() || ! is_post_type_archive(['platforms', 'industries', 'case_studies'])) {
    return;
  }

  if (is_post_type_archive('platforms')) {
    $name        = 'Review Platform Reputation Management Hub';
    $description = 'Platform-specific reputation management guides for Google Reviews, Trustpilot, Yelp, Facebook, BBB, Sitejabber, G2, Capterra, and more.';
    $url         = home_url('/platforms/');
  } elseif (is_post_type_archive('industries')) {
    $name        = 'Industry Reputation Management Hub';
    $description = 'Industry-specific online reputation management strategies for businesses where trust, reviews, and visibility influence growth.';
    $url         = home_url('/industries/');
  } else {
    $name        = 'Online Reputation Management Case Studies';
    $description = 'Proof-based reputation management case studies showing review monitoring, response strategy, feedback systems, and trust outcomes.';
    $url         = home_url('/case-studies/');
  }

  rsp_output_schema(
    [
      '@context'    => 'https://schema.org',
      '@type'       => 'CollectionPage',
      '@id'         => $url . '#collection',
      'name'        => $name,
      'description' => $description,
      'url'         => $url,
      'publisher'   => [
        '@id' => rsp_schema_org_id(),
      ],
      'isPartOf'    => [
        '@id' => rsp_schema_website_id(),
      ],
    ]
  );
}
add_action('wp_head', 'rsp_schema_cpt_archives', 48);
