<?php

/**
 * ACF Compatibility / Support Layer.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Check ACF active.
 */
function rsp_acf_is_active()
{
  return function_exists('get_field') || function_exists('acf_add_local_field_group');
}

/**
 * Safe ACF/get_post_meta fallback.
 */
function rsp_acf_get_field($key, $post_id = null, $default = '')
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  if (! $post_id || empty($key)) {
    return $default;
  }

  if (function_exists('get_field')) {
    $value = get_field($key, $post_id);

    if ('' !== $value && null !== $value && false !== $value) {
      return $value;
    }
  }

  $meta = get_post_meta($post_id, $key, true);

  return '' !== $meta && null !== $meta ? $meta : $default;
}

/**
 * Sanitize ready field value.
 */
function rsp_acf_clean_value($value, $type = 'text')
{
  if (is_array($value)) {
    $value = implode(', ', array_filter(array_map('sanitize_text_field', $value)));
  }

  if ('url' === $type || 'image' === $type) {
    return esc_url_raw($value);
  }

  if ('textarea' === $type) {
    return sanitize_textarea_field($value);
  }

  if ('key' === $type) {
    return sanitize_key($value);
  }

  return sanitize_text_field($value);
}

/**
 * Default ORM service data.
 */
function rsp_acf_get_default_orm_service_data()
{
  return [
    'service_name'        => __('Online Reputation Management', 'reviewservicepro'),
    'service_type'        => __('Ethical ORM, review monitoring, response strategy, and trust signal improvement.', 'reviewservicepro'),
    'primary_cta_text'    => __('Request Free Audit', 'reviewservicepro'),
    'primary_cta_url'     => home_url('/contact/?type=free-audit'),
    'secondary_cta_text'  => __('Book Consultation', 'reviewservicepro'),
    'secondary_cta_url'   => home_url('/contact/?type=consultation'),
    'ethical_note'        => __('We do not create fake reviews or manipulate review platforms. Our work focuses on ethical, platform-compliant reputation improvement.', 'reviewservicepro'),
    'response_time_note'  => function_exists('rsp_get_response_time_note') ? rsp_get_response_time_note() : __('Average first response: under 2 hours on business days.', 'reviewservicepro'),
  ];
}

/**
 * Platform default data.
 */
function rsp_acf_get_platform_data($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  return [
    'seo_title'          => rsp_acf_clean_value(rsp_acf_get_field('rsp_seo_title', $post_id, get_the_title($post_id)), 'text'),
    'meta_description'   => rsp_acf_clean_value(rsp_acf_get_field('rsp_meta_description', $post_id, ''), 'textarea'),
    'focus_keyword'      => rsp_acf_clean_value(rsp_acf_get_field('rsp_focus_keyword', $post_id, ''), 'text'),
    'secondary_keywords' => rsp_acf_clean_value(rsp_acf_get_field('rsp_secondary_keywords', $post_id, ''), 'textarea'),
    'aeo_short_answer'   => rsp_acf_clean_value(rsp_acf_get_field('rsp_aeo_short_answer', $post_id, ''), 'textarea'),
    'ai_summary'         => rsp_acf_clean_value(rsp_acf_get_field('rsp_ai_summary', $post_id, ''), 'textarea'),
    'related_entities'   => rsp_acf_clean_value(rsp_acf_get_field('rsp_related_entities', $post_id, ''), 'textarea'),
    'platform_url'       => rsp_acf_clean_value(rsp_acf_get_field('rsp_platform_url', $post_id, ''), 'url'),
    'platform_logo'      => rsp_acf_clean_value(rsp_acf_get_field('rsp_platform_logo', $post_id, ''), 'image'),
    'common_problems'    => rsp_acf_clean_value(rsp_acf_get_field('rsp_common_problems', $post_id, __('Review visibility, customer trust gaps, negative feedback, and weak response workflows.', 'reviewservicepro')), 'textarea'),
    'best_for'           => rsp_acf_clean_value(rsp_acf_get_field('rsp_best_for', $post_id, __('Businesses that need stronger online trust, better reviews, and ethical reputation management.', 'reviewservicepro')), 'textarea'),
    'cta_url'            => rsp_acf_clean_value(rsp_acf_get_field('rsp_cta_url', $post_id, home_url('/contact/?type=free-audit')), 'url'),
  ];
}

/**
 * Industry default data.
 */
function rsp_acf_get_industry_data($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  return [
    'seo_title'                => rsp_acf_clean_value(rsp_acf_get_field('rsp_seo_title', $post_id, get_the_title($post_id)), 'text'),
    'meta_description'         => rsp_acf_clean_value(rsp_acf_get_field('rsp_meta_description', $post_id, ''), 'textarea'),
    'focus_keyword'            => rsp_acf_clean_value(rsp_acf_get_field('rsp_focus_keyword', $post_id, ''), 'text'),
    'secondary_keywords'       => rsp_acf_clean_value(rsp_acf_get_field('rsp_secondary_keywords', $post_id, ''), 'textarea'),
    'aeo_short_answer'         => rsp_acf_clean_value(rsp_acf_get_field('rsp_aeo_short_answer', $post_id, ''), 'textarea'),
    'ai_summary'               => rsp_acf_clean_value(rsp_acf_get_field('rsp_ai_summary', $post_id, ''), 'textarea'),
    'related_entities'         => rsp_acf_clean_value(rsp_acf_get_field('rsp_related_entities', $post_id, ''), 'textarea'),
    'industry_icon'            => rsp_acf_clean_value(rsp_acf_get_field('rsp_industry_icon', $post_id, 'building-2'), 'key'),
    'trust_factors'            => rsp_acf_clean_value(rsp_acf_get_field('rsp_trust_factors', $post_id, __('Ratings, reviews, response quality, search visibility, and customer confidence.', 'reviewservicepro')), 'textarea'),
    'reputation_challenges'    => rsp_acf_clean_value(rsp_acf_get_field('rsp_reputation_challenges', $post_id, __('Negative reviews, weak review response, low ratings, poor visibility, and inconsistent customer feedback systems.', 'reviewservicepro')), 'textarea'),
    'recommended_platforms'    => rsp_acf_clean_value(rsp_acf_get_field('rsp_recommended_platforms', $post_id, __('Google Reviews, Facebook, Trustpilot, Yelp, BBB, and industry-specific review platforms.', 'reviewservicepro')), 'textarea'),
    'cta_url'                  => rsp_acf_clean_value(rsp_acf_get_field('rsp_cta_url', $post_id, home_url('/contact/?type=industry-audit')), 'url'),
  ];
}

/**
 * Case study default data.
 */
function rsp_acf_get_case_study_data($post_id = null)
{
  $post_id = $post_id ? absint($post_id) : get_the_ID();

  return [
    'seo_title'          => rsp_acf_clean_value(rsp_acf_get_field('rsp_seo_title', $post_id, get_the_title($post_id)), 'text'),
    'meta_description'   => rsp_acf_clean_value(rsp_acf_get_field('rsp_meta_description', $post_id, ''), 'textarea'),
    'focus_keyword'      => rsp_acf_clean_value(rsp_acf_get_field('rsp_focus_keyword', $post_id, ''), 'text'),
    'aeo_short_answer'   => rsp_acf_clean_value(rsp_acf_get_field('rsp_aeo_short_answer', $post_id, ''), 'textarea'),
    'ai_summary'         => rsp_acf_clean_value(rsp_acf_get_field('rsp_ai_summary', $post_id, ''), 'textarea'),
    'related_entities'   => rsp_acf_clean_value(rsp_acf_get_field('rsp_related_entities', $post_id, ''), 'textarea'),
    'client_type'        => rsp_acf_clean_value(rsp_acf_get_field('rsp_client_type', $post_id, __('Business Client', 'reviewservicepro')), 'text'),
    'platform_used'      => rsp_acf_clean_value(rsp_acf_get_field('rsp_platform_used', $post_id, __('Review Platform', 'reviewservicepro')), 'text'),
    'starting_rating'    => rsp_acf_clean_value(rsp_acf_get_field('rsp_starting_rating', $post_id, '—'), 'text'),
    'final_rating'       => rsp_acf_clean_value(rsp_acf_get_field('rsp_final_rating', $post_id, '—'), 'text'),
    'review_growth'      => rsp_acf_clean_value(rsp_acf_get_field('rsp_review_growth', $post_id, '—'), 'text'),
    'timeline'           => rsp_acf_clean_value(rsp_acf_get_field('rsp_timeline', $post_id, __('Tracked Period', 'reviewservicepro')), 'text'),
    'challenge'          => rsp_acf_clean_value(rsp_acf_get_field('rsp_challenge', $post_id, __('The business needed a clearer reputation workflow and stronger trust signals.', 'reviewservicepro')), 'textarea'),
    'strategy'           => rsp_acf_clean_value(rsp_acf_get_field('rsp_strategy', $post_id, __('The strategy focused on ethical review monitoring, response improvement, customer feedback systems, and trust growth.', 'reviewservicepro')), 'textarea'),
    'result'             => rsp_acf_clean_value(rsp_acf_get_field('rsp_result', $post_id, __('The business gained better reputation visibility, stronger response quality, and improved trust workflows.', 'reviewservicepro')), 'textarea'),
    'cta_url'            => rsp_acf_clean_value(rsp_acf_get_field('rsp_cta_url', $post_id, home_url('/contact/?type=free-audit')), 'url'),
  ];
}

/**
 * Optional ACF local field groups.
 * Disabled by default to avoid duplicate field UI with inc/cpt.php meta boxes.
 */
function rsp_register_acf_field_groups()
{
  if (! function_exists('acf_add_local_field_group')) {
    return;
  }

  if (! apply_filters('rsp_enable_acf_local_field_groups', false)) {
    return;
  }

  $shared_seo_fields = [
    [
      'key'          => 'field_rsp_seo_title',
      'label'        => 'SEO Title',
      'name'         => 'rsp_seo_title',
      'type'         => 'text',
      'instructions' => 'Optimized SEO title for Google and AI search engines.',
      'maxlength'    => 65,
    ],
    [
      'key'       => 'field_rsp_meta_description',
      'label'     => 'Meta Description',
      'name'      => 'rsp_meta_description',
      'type'      => 'textarea',
      'rows'      => 3,
      'maxlength' => 160,
    ],
    [
      'key'   => 'field_rsp_focus_keyword',
      'label' => 'Focus Keyword',
      'name'  => 'rsp_focus_keyword',
      'type'  => 'text',
    ],
    [
      'key'   => 'field_rsp_secondary_keywords',
      'label' => 'Secondary Keywords',
      'name'  => 'rsp_secondary_keywords',
      'type'  => 'textarea',
      'rows'  => 3,
    ],
    [
      'key'          => 'field_rsp_aeo_short_answer',
      'label'        => 'AEO Short Answer',
      'name'         => 'rsp_aeo_short_answer',
      'type'         => 'textarea',
      'rows'         => 4,
      'instructions' => 'Optimized short answer for AI Overview / featured snippets.',
    ],
    [
      'key'   => 'field_rsp_ai_summary',
      'label' => 'AI / GEO Summary',
      'name'  => 'rsp_ai_summary',
      'type'  => 'textarea',
      'rows'  => 5,
    ],
    [
      'key'          => 'field_rsp_related_entities',
      'label'        => 'Related Entities',
      'name'         => 'rsp_related_entities',
      'type'         => 'textarea',
      'rows'         => 3,
      'instructions' => 'Comma separated semantic entities.',
    ],
    [
      'key'   => 'field_rsp_canonical_url',
      'label' => 'Canonical URL',
      'name'  => 'rsp_canonical_url',
      'type'  => 'url',
    ],
    [
      'key'           => 'field_rsp_og_image',
      'label'         => 'Open Graph Image',
      'name'          => 'rsp_og_image',
      'type'          => 'image',
      'return_format' => 'url',
      'preview_size'  => 'medium',
      'library'       => 'all',
    ],
  ];

  acf_add_local_field_group(
    [
      'key'           => 'group_rsp_platform_fields',
      'title'         => 'Platform Intelligence',
      'fields'        => array_merge(
        $shared_seo_fields,
        [
          [
            'key'           => 'field_rsp_platform_logo',
            'label'         => 'Platform Logo',
            'name'          => 'rsp_platform_logo',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
          ],
          [
            'key'   => 'field_rsp_platform_url',
            'label' => 'Platform Website URL',
            'name'  => 'rsp_platform_url',
            'type'  => 'url',
          ],
          [
            'key'   => 'field_rsp_common_problems',
            'label' => 'Common Problems',
            'name'  => 'rsp_common_problems',
            'type'  => 'textarea',
            'rows'  => 5,
          ],
          [
            'key'   => 'field_rsp_best_for',
            'label' => 'Best For',
            'name'  => 'rsp_best_for',
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          [
            'key'   => 'field_rsp_cta_url_platform',
            'label' => 'CTA URL',
            'name'  => 'rsp_cta_url',
            'type'  => 'url',
          ],
        ]
      ),
      'location'      => [
        [
          [
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'platforms',
          ],
        ],
      ],
      'position'      => 'normal',
      'style'         => 'default',
      'active'        => true,
      'show_in_rest'  => 1,
    ]
  );
}
add_action('acf/init', 'rsp_register_acf_field_groups');
