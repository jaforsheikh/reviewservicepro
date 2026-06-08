<?php

/**
 * Theme helper functions.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Safe meta / ACF-like getter.
 */
function rsp_get_meta($key, $post_id = null, $default = '')
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  if (! $post_id || empty($key)) {
    return $default;
  }

  $value = get_post_meta($post_id, $key, true);

  return '' !== $value && null !== $value ? $value : $default;
}

/**
 * Safe fallback value.
 */
function rsp_fallback($value, $fallback = '')
{
  return '' !== $value && null !== $value ? $value : $fallback;
}

/**
 * Safe HTML output whitelist.
 */
function rsp_safe_html($html)
{
  return wp_kses(
    $html,
    [
      'a'      => [
        'href'   => [],
        'target' => [],
        'rel'    => [],
        'class'  => [],
        'aria-label' => [],
      ],
      'br'     => [],
      'em'     => [],
      'strong' => [],
      'span'   => [
        'class' => [],
        'aria-hidden' => [],
      ],
      'i'      => [
        'data-lucide' => [],
        'class'       => [],
        'aria-hidden' => [],
      ],
    ]
  );
}

/**
 * Estimated reading time.
 */
function rsp_get_reading_time($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();
  $content = get_post_field('post_content', $post_id);

  if (empty($content)) {
    return 1;
  }

  $word_count = str_word_count(wp_strip_all_tags($content));

  return (int) max(1, ceil($word_count / 220));
}

/**
 * Reading time label.
 */
function rsp_reading_time($post_id = null)
{
  return sprintf(
    esc_html__('%s min read', 'reviewservicepro'),
    esc_html(rsp_get_reading_time($post_id))
  );
}

/**
 * Safe excerpt.
 */
function rsp_get_excerpt($post_id = null, $words = 24)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();
  $excerpt = get_the_excerpt($post_id);

  if (empty($excerpt)) {
    $excerpt = wp_strip_all_tags(get_post_field('post_content', $post_id));
  }

  return wp_trim_words($excerpt, absint($words));
}

/**
 * Thumbnail with fallback.
 */
function rsp_get_thumbnail_url($post_id = null, $size = 'large', $fallback = '')
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  if ($post_id && has_post_thumbnail($post_id)) {
    return get_the_post_thumbnail_url($post_id, $size);
  }

  if (! empty($fallback)) {
    return $fallback;
  }

  return get_template_directory_uri() . '/assets/images/placeholder-blog.jpg';
}

/**
 * Platform logo helper.
 */
function rsp_get_platform_logo($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  return esc_url_raw(rsp_get_meta('rsp_platform_logo', $post_id, ''));
}

/**
 * Industry icon helper.
 */
function rsp_get_industry_icon($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  return sanitize_key(rsp_get_meta('rsp_industry_icon', $post_id, 'building-2'));
}

/**
 * Format rating.
 */
function rsp_format_rating($rating, $fallback = '—')
{
  if ('' === $rating || null === $rating) {
    return $fallback;
  }

  if (is_numeric($rating)) {
    return number_format_i18n((float) $rating, 1);
  }

  return sanitize_text_field($rating);
}

/**
 * Format number.
 */
function rsp_format_number($number, $fallback = '—')
{
  if ('' === $number || null === $number) {
    return $fallback;
  }

  if (is_numeric($number)) {
    return number_format_i18n((float) $number);
  }

  return sanitize_text_field($number);
}

/**
 * Case study metrics helper.
 */
function rsp_get_case_study_metrics($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  return [
    'client_type'     => rsp_get_meta('rsp_client_type', $post_id, __('Business Client', 'reviewservicepro')),
    'platform_used'   => rsp_get_meta('rsp_platform_used', $post_id, __('Review Platform', 'reviewservicepro')),
    'starting_rating' => rsp_format_rating(rsp_get_meta('rsp_starting_rating', $post_id, '')),
    'final_rating'    => rsp_format_rating(rsp_get_meta('rsp_final_rating', $post_id, '')),
    'review_growth'   => rsp_get_meta('rsp_review_growth', $post_id, '—'),
    'timeline'        => rsp_get_meta('rsp_timeline', $post_id, __('Tracked Period', 'reviewservicepro')),
  ];
}

/**
 * Primary category.
 */
function rsp_get_primary_category($post_id = null)
{
  $post_id    = $post_id ? absint($post_id) : get_the_ID();
  $categories = get_the_category($post_id);

  if (empty($categories) || is_wp_error($categories)) {
    return null;
  }

  return $categories[0];
}

/**
 * Primary category name.
 */
function rsp_get_primary_category_name($post_id = null)
{
  $category = rsp_get_primary_category($post_id);

  return $category ? $category->name : esc_html__('ORM Academy', 'reviewservicepro');
}

/**
 * Primary category link.
 */
function rsp_get_primary_category_link($post_id = null)
{
  $category = rsp_get_primary_category($post_id);

  return $category ? get_category_link($category->term_id) : home_url('/orm-academy/');
}

/**
 * External URL check.
 */
function rsp_is_external_url($url)
{
  if (empty($url)) {
    return false;
  }

  $home_host = wp_parse_url(home_url(), PHP_URL_HOST);
  $url_host  = wp_parse_url($url, PHP_URL_HOST);

  return $url_host && $home_host !== $url_host;
}

/**
 * Normalize URL.
 */
function rsp_normalize_url($url)
{
  if (empty($url)) {
    return '#';
  }

  $url = trim($url);

  if (
    0 === strpos($url, 'http://') ||
    0 === strpos($url, 'https://') ||
    0 === strpos($url, 'mailto:') ||
    0 === strpos($url, 'tel:') ||
    0 === strpos($url, 'sms:')
  ) {
    return $url;
  }

  if (0 === strpos($url, '/')) {
    return home_url($url);
  }

  return home_url('/' . ltrim($url, '/'));
}

/**
 * Link attributes.
 */
function rsp_link_attrs($url)
{
  $url = rsp_normalize_url($url);

  if (rsp_is_external_url($url)) {
    return ' target="_blank" rel="noopener noreferrer"';
  }

  return '';
}

/**
 * Clean phone.
 */
function rsp_clean_phone($phone)
{
  return preg_replace('/\D+/', '', (string) $phone);
}

/**
 * Current year.
 */
function rsp_current_year()
{
  return date_i18n('Y');
}

/**
 * Active URL check.
 */
function rsp_is_active_url($url)
{
  $current_url = home_url(add_query_arg(null, null));
  $target_url  = rsp_normalize_url($url);

  return trailingslashit($current_url) === trailingslashit($target_url);
}

/**
 * Active nav class.
 */
function rsp_active_class($url, $active = 'text-white bg-white/[0.06]', $inactive = 'text-slate-300')
{
  return rsp_is_active_url($url) ? $active : $inactive;
}

/**
 * Lucide icon render.
 */
function rsp_icon($icon, $classes = 'h-4 w-4', $attrs = '')
{
  if (empty($icon)) {
    return '';
  }

  return sprintf(
    '<i data-lucide="%1$s" class="%2$s" aria-hidden="true" %3$s></i>',
    esc_attr(sanitize_key($icon)),
    esc_attr($classes),
    rsp_safe_html($attrs)
  );
}

/**
 * Archive URL by post type.
 */
function rsp_get_post_type_archive_url($post_type)
{
  $archive = get_post_type_archive_link($post_type);

  if ($archive) {
    return $archive;
  }

  $fallbacks = [
    'platforms'    => home_url('/platforms/'),
    'industries'   => home_url('/industries/'),
    'case_studies' => home_url('/case-studies/'),
    'post'         => home_url('/orm-academy/'),
  ];

  return isset($fallbacks[$post_type]) ? $fallbacks[$post_type] : home_url('/');
}

/**
 * Breadcrumb items.
 */
function rsp_get_breadcrumb_items()
{
  $items = [
    [
      'label' => __('Home', 'reviewservicepro'),
      'url'   => home_url('/'),
    ],
  ];

  if (is_singular('post')) {
    $items[] = [
      'label' => __('ORM Academy', 'reviewservicepro'),
      'url'   => home_url('/orm-academy/'),
    ];

    $category = rsp_get_primary_category();

    if ($category) {
      $items[] = [
        'label' => $category->name,
        'url'   => get_category_link($category->term_id),
      ];
    }

    $items[] = [
      'label' => get_the_title(),
      'url'   => get_permalink(),
    ];
  } elseif (is_singular('platforms')) {
    $items[] = [
      'label' => __('Platforms', 'reviewservicepro'),
      'url'   => rsp_get_post_type_archive_url('platforms'),
    ];

    $items[] = [
      'label' => get_the_title(),
      'url'   => get_permalink(),
    ];
  } elseif (is_singular('industries')) {
    $items[] = [
      'label' => __('Industries', 'reviewservicepro'),
      'url'   => rsp_get_post_type_archive_url('industries'),
    ];

    $items[] = [
      'label' => get_the_title(),
      'url'   => get_permalink(),
    ];
  } elseif (is_singular('case_studies')) {
    $items[] = [
      'label' => __('Case Studies', 'reviewservicepro'),
      'url'   => rsp_get_post_type_archive_url('case_studies'),
    ];

    $items[] = [
      'label' => get_the_title(),
      'url'   => get_permalink(),
    ];
  } elseif (is_post_type_archive('platforms')) {
    $items[] = [
      'label' => __('Platforms', 'reviewservicepro'),
      'url'   => rsp_get_post_type_archive_url('platforms'),
    ];
  } elseif (is_post_type_archive('industries')) {
    $items[] = [
      'label' => __('Industries', 'reviewservicepro'),
      'url'   => rsp_get_post_type_archive_url('industries'),
    ];
  } elseif (is_post_type_archive('case_studies')) {
    $items[] = [
      'label' => __('Case Studies', 'reviewservicepro'),
      'url'   => rsp_get_post_type_archive_url('case_studies'),
    ];
  } elseif (is_page()) {
    $items[] = [
      'label' => get_the_title(),
      'url'   => get_permalink(),
    ];
  } elseif (is_category()) {
    $items[] = [
      'label' => single_cat_title('', false),
      'url'   => get_category_link(get_queried_object_id()),
    ];
  } elseif (is_search()) {
    $items[] = [
      'label' => __('Search Results', 'reviewservicepro'),
      'url'   => '',
    ];
  } elseif (is_404()) {
    $items[] = [
      'label' => __('404 Not Found', 'reviewservicepro'),
      'url'   => '',
    ];
  }

  return apply_filters('rsp_breadcrumb_items', $items);
}

/**
 * Render breadcrumb.
 */
function rsp_breadcrumb()
{
  $items = rsp_get_breadcrumb_items();

  if (empty($items)) {
    return;
  }

  echo '<nav class="flex flex-wrap items-center gap-2 text-xs text-slate-500" aria-label="' . esc_attr__('Breadcrumb', 'reviewservicepro') . '">';

  foreach ($items as $index => $item) {
    if ($index > 0) {
      echo '<span aria-hidden="true">/</span>';
    }

    if (! empty($item['url']) && $index < count($items) - 1) {
      echo '<a href="' . esc_url($item['url']) . '" class="transition-colors duration-200 hover:text-slate-300">' . esc_html($item['label']) . '</a>';
    } else {
      echo '<span class="text-slate-400" aria-current="page">' . esc_html($item['label']) . '</span>';
    }
  }

  echo '</nav>';
}

/**
 * Related posts.
 */
function rsp_get_related_posts($post_id = null, $posts_per_page = 3)
{
  $post_id    = $post_id ? absint($post_id) : get_the_ID();
  $categories = get_the_category($post_id);

  $args = [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => absint($posts_per_page),
    'post__not_in'        => [$post_id],
    'ignore_sticky_posts' => true,
  ];

  if (! empty($categories) && ! is_wp_error($categories)) {
    $args['category__in'] = wp_list_pluck($categories, 'term_id');
  }

  return new WP_Query($args);
}

/**
 * Theme URL setting.
 */
function rsp_get_theme_url_setting($key, $fallback = '#')
{
  return rsp_normalize_url(get_theme_mod($key, $fallback));
}

/**
 * CTA URL helper.
 */
function rsp_get_cta_url($type = 'audit')
{
  if ('consultation' === $type) {
    return rsp_get_theme_url_setting('cta_consult_url', '/contact/?type=consultation');
  }

  if ('industry' === $type) {
    return home_url('/contact/?type=industry-audit');
  }

  return rsp_get_theme_url_setting('cta_audit_url', '/contact/?type=free-audit');
}

/**
 * Social links.
 */
function rsp_get_social_links()
{
  $links = [
    [
      'label' => 'Facebook',
      'url'   => get_theme_mod('rsp_facebook_url', 'https://www.facebook.com/reviewservice.pro/'),
      'icon'  => 'facebook',
    ],
    [
      'label' => 'LinkedIn',
      'url'   => get_theme_mod('rsp_linkedin_url', 'https://www.linkedin.com/company/reviewservicepro'),
      'icon'  => 'linkedin',
    ],
    [
      'label' => 'Instagram',
      'url'   => get_theme_mod('rsp_instagram_url', 'https://www.instagram.com/reviewservice.pro/'),
      'icon'  => 'instagram',
    ],
    [
      'label' => 'YouTube',
      'url'   => get_theme_mod('rsp_youtube_url', ''),
      'icon'  => 'youtube',
    ],
    [
      'label' => 'X',
      'url'   => get_theme_mod('rsp_x_url', ''),
      'icon'  => 'twitter',
    ],
    [
      'label' => 'WhatsApp',
      'url'   => get_theme_mod('rsp_whatsapp_url', 'https://wa.me/18077980758'),
      'icon'  => 'message-circle',
    ],
  ];

  return array_values(
    array_filter(
      $links,
      function ($link) {
        return ! empty($link['url']);
      }
    )
  );
}

/**
 * Placeholder card.
 */
function rsp_placeholder_card($icon = 'file-text', $text = 'ReviewService.Pro')
{
?>
  <div class="flex h-full w-full flex-col items-center justify-center bg-gradient-to-br from-blue-600/[0.15] to-emerald-500/[0.08]">
    <?php echo wp_kses_post(rsp_icon($icon, 'mb-3 h-12 w-12 text-blue-400')); ?>
    <span class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
      <?php echo esc_html($text); ?>
    </span>
  </div>
<?php
}

/**
 * Contact email.
 */
function rsp_get_contact_email()
{
  return sanitize_email(get_theme_mod('rsp_contact_email', get_option('admin_email')));
}

/**
 * Business address.
 */
function rsp_get_business_address()
{
  return sanitize_textarea_field(get_theme_mod('rsp_business_address', '30 N Gould St Ste N, Sheridan, WY 82801'));
}

/**
 * Response time note.
 */
function rsp_get_response_time_note()
{
  return sanitize_text_field(get_theme_mod('rsp_response_time', 'Average first response: under 2 hours on business days.'));
}

/**
 * Archive intro helper.
 */
function rsp_get_archive_intro($post_type = '')
{
  $post_type = $post_type ? $post_type : get_post_type();

  $intros = [
    'platforms'    => __('Explore platform-specific reputation management guides for review visibility, customer trust, response quality, and ethical ORM workflows.', 'reviewservicepro'),
    'industries'   => __('Explore industry-specific reputation management guides for businesses that depend on ratings, reviews, visibility, and customer confidence.', 'reviewservicepro'),
    'case_studies' => __('Explore proof-based reputation management case studies showing review monitoring, response strategy, trust workflows, and measurable outcomes.', 'reviewservicepro'),
    'post'         => __('Learn practical online reputation management strategies, review response methods, customer trust tactics, and ethical ORM systems.', 'reviewservicepro'),
  ];

  return isset($intros[$post_type]) ? $intros[$post_type] : get_bloginfo('description');
}
