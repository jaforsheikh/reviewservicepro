<?php

/**
 * Custom Post Types, Taxonomies, and Meta Fields.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Register Custom Post Types.
 */
function rsp_register_custom_post_types()
{
  $post_types = [
    'platforms'    => [
      'singular'      => __('Platform', 'reviewservicepro'),
      'plural'        => __('Platforms', 'reviewservicepro'),
      'menu_name'     => __('Platforms', 'reviewservicepro'),
      'menu_icon'     => 'dashicons-star-filled',
      'menu_position' => 22,
      'slug'          => 'platforms',
      'description'   => __('Platform-specific reputation management pages.', 'reviewservicepro'),
      'rest_base'     => 'platforms',
    ],
    'industries'   => [
      'singular'      => __('Industry', 'reviewservicepro'),
      'plural'        => __('Industries', 'reviewservicepro'),
      'menu_name'     => __('Industries', 'reviewservicepro'),
      'menu_icon'     => 'dashicons-building',
      'menu_position' => 23,
      'slug'          => 'industries',
      'description'   => __('Industry-specific reputation management pages.', 'reviewservicepro'),
      'rest_base'     => 'industries',
    ],
    'case_studies' => [
      'singular'      => __('Case Study', 'reviewservicepro'),
      'plural'        => __('Case Studies', 'reviewservicepro'),
      'menu_name'     => __('Case Studies', 'reviewservicepro'),
      'menu_icon'     => 'dashicons-chart-line',
      'menu_position' => 24,
      'slug'          => 'case-studies',
      'description'   => __('Proof-based reputation management case studies.', 'reviewservicepro'),
      'rest_base'     => 'case-studies',
    ],
  ];

  foreach ($post_types as $post_type => $args) {
    register_post_type(
      $post_type,
      [
        'labels'              => [
          'name'                  => $args['plural'],
          'singular_name'         => $args['singular'],
          'menu_name'             => $args['menu_name'],
          'name_admin_bar'        => $args['singular'],
          'add_new'               => __('Add New', 'reviewservicepro'),
          'add_new_item'          => sprintf(
            /* translators: %s: singular CPT name */
            __('Add New %s', 'reviewservicepro'),
            $args['singular']
          ),
          'edit_item'             => sprintf(
            /* translators: %s: singular CPT name */
            __('Edit %s', 'reviewservicepro'),
            $args['singular']
          ),
          'new_item'              => sprintf(
            /* translators: %s: singular CPT name */
            __('New %s', 'reviewservicepro'),
            $args['singular']
          ),
          'view_item'             => sprintf(
            /* translators: %s: singular CPT name */
            __('View %s', 'reviewservicepro'),
            $args['singular']
          ),
          'view_items'            => sprintf(
            /* translators: %s: plural CPT name */
            __('View %s', 'reviewservicepro'),
            $args['plural']
          ),
          'search_items'          => sprintf(
            /* translators: %s: plural CPT name */
            __('Search %s', 'reviewservicepro'),
            $args['plural']
          ),
          'not_found'             => sprintf(
            /* translators: %s: plural CPT name */
            __('No %s found', 'reviewservicepro'),
            strtolower($args['plural'])
          ),
          'not_found_in_trash'    => sprintf(
            /* translators: %s: plural CPT name */
            __('No %s found in trash', 'reviewservicepro'),
            strtolower($args['plural'])
          ),
          'all_items'             => sprintf(
            /* translators: %s: plural CPT name */
            __('All %s', 'reviewservicepro'),
            $args['plural']
          ),
          'archives'              => sprintf(
            /* translators: %s: singular CPT name */
            __('%s Archives', 'reviewservicepro'),
            $args['singular']
          ),
          'attributes'            => sprintf(
            /* translators: %s: singular CPT name */
            __('%s Attributes', 'reviewservicepro'),
            $args['singular']
          ),
          'featured_image'        => __('Featured Image', 'reviewservicepro'),
          'set_featured_image'    => __('Set featured image', 'reviewservicepro'),
          'remove_featured_image' => __('Remove featured image', 'reviewservicepro'),
          'use_featured_image'    => __('Use as featured image', 'reviewservicepro'),
        ],
        'description'         => $args['description'],
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'rest_base'           => $args['rest_base'],
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'menu_icon'           => $args['menu_icon'],
        'menu_position'       => $args['menu_position'],
        'has_archive'         => true,
        'rewrite'             => [
          'slug'       => $args['slug'],
          'with_front' => false,
          'feeds'      => false,
          'pages'      => true,
        ],
        'query_var'           => true,
        'can_export'          => true,
        'delete_with_user'    => false,
        'hierarchical'        => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'supports'            => [
          'title',
          'editor',
          'excerpt',
          'thumbnail',
          'revisions',
          'custom-fields',
        ],
      ]
    );
  }
}
add_action('init', 'rsp_register_custom_post_types', 5);

/**
 * Register Custom Taxonomies.
 */
function rsp_register_custom_taxonomies()
{
  $taxonomies = [
    'platform_type'   => [
      'post_types' => ['platforms'],
      'singular'   => __('Platform Type', 'reviewservicepro'),
      'plural'     => __('Platform Types', 'reviewservicepro'),
      'slug'       => 'platform-type',
      'rest_base'  => 'platform-type',
    ],
    'industry_type'   => [
      'post_types' => ['industries', 'case_studies'],
      'singular'   => __('Industry Type', 'reviewservicepro'),
      'plural'     => __('Industry Types', 'reviewservicepro'),
      'slug'       => 'industry-type',
      'rest_base'  => 'industry-type',
    ],
    'case_study_type' => [
      'post_types' => ['case_studies'],
      'singular'   => __('Case Study Type', 'reviewservicepro'),
      'plural'     => __('Case Study Types', 'reviewservicepro'),
      'slug'       => 'case-study-type',
      'rest_base'  => 'case-study-type',
    ],
  ];

  foreach ($taxonomies as $taxonomy => $args) {
    register_taxonomy(
      $taxonomy,
      $args['post_types'],
      [
        'labels'            => [
          'name'              => $args['plural'],
          'singular_name'     => $args['singular'],
          'search_items'      => sprintf(
            /* translators: %s: taxonomy plural label */
            __('Search %s', 'reviewservicepro'),
            $args['plural']
          ),
          'all_items'         => sprintf(
            /* translators: %s: taxonomy plural label */
            __('All %s', 'reviewservicepro'),
            $args['plural']
          ),
          'parent_item'       => sprintf(
            /* translators: %s: taxonomy singular label */
            __('Parent %s', 'reviewservicepro'),
            $args['singular']
          ),
          'parent_item_colon' => sprintf(
            /* translators: %s: taxonomy singular label */
            __('Parent %s:', 'reviewservicepro'),
            $args['singular']
          ),
          'edit_item'         => sprintf(
            /* translators: %s: taxonomy singular label */
            __('Edit %s', 'reviewservicepro'),
            $args['singular']
          ),
          'update_item'       => sprintf(
            /* translators: %s: taxonomy singular label */
            __('Update %s', 'reviewservicepro'),
            $args['singular']
          ),
          'add_new_item'      => sprintf(
            /* translators: %s: taxonomy singular label */
            __('Add New %s', 'reviewservicepro'),
            $args['singular']
          ),
          'new_item_name'     => sprintf(
            /* translators: %s: taxonomy singular label */
            __('New %s Name', 'reviewservicepro'),
            $args['singular']
          ),
          'menu_name'         => $args['plural'],
        ],
        'public'            => true,
        'publicly_queryable' => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
        'rest_base'         => $args['rest_base'],
        'query_var'         => true,
        'rewrite'           => [
          'slug'         => $args['slug'],
          'with_front'   => false,
          'hierarchical' => false,
        ],
      ]
    );
  }
}
add_action('init', 'rsp_register_custom_taxonomies', 6);

/**
 * Meta field config.
 */
function rsp_cpt_meta_fields()
{
  return [
    'platforms'    => [
      'seo'      => [
        'title'  => __('SEO / AEO / GEO Intelligence', 'reviewservicepro'),
        'fields' => [
          'rsp_seo_title'          => [
            'label'       => __('SEO Title', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => 'Google Reviews Reputation Management Services',
          ],
          'rsp_meta_description'   => [
            'label' => __('Meta Description', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_focus_keyword'      => [
            'label'       => __('Focus Keyword', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => 'Google reviews reputation management',
          ],
          'rsp_secondary_keywords' => [
            'label' => __('Secondary Keywords', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_aeo_short_answer'   => [
            'label' => __('AEO Short Answer', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_ai_summary'         => [
            'label' => __('AI Summary / GEO Summary', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_related_entities'   => [
            'label' => __('Related Entities', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_canonical_url'      => [
            'label' => __('Canonical URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
          'rsp_og_image'           => [
            'label' => __('Open Graph Image URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
        ],
      ],
      'platform' => [
        'title'  => __('Platform Details', 'reviewservicepro'),
        'fields' => [
          'rsp_platform_url'    => [
            'label' => __('Platform Website URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
          'rsp_platform_logo'   => [
            'label' => __('Platform Logo URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
          'rsp_common_problems' => [
            'label' => __('Common Platform Problems', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 5,
          ],
          'rsp_best_for'        => [
            'label' => __('Best For', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_cta_url'         => [
            'label' => __('CTA URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
        ],
      ],
    ],
    'industries'   => [
      'seo'      => [
        'title'  => __('SEO / AEO / GEO Intelligence', 'reviewservicepro'),
        'fields' => [
          'rsp_seo_title'          => [
            'label' => __('SEO Title', 'reviewservicepro'),
            'type'  => 'text',
          ],
          'rsp_meta_description'   => [
            'label' => __('Meta Description', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_focus_keyword'      => [
            'label' => __('Focus Keyword', 'reviewservicepro'),
            'type'  => 'text',
          ],
          'rsp_secondary_keywords' => [
            'label' => __('Secondary Keywords', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_aeo_short_answer'   => [
            'label' => __('AEO Short Answer', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_ai_summary'         => [
            'label' => __('AI Summary / GEO Summary', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_related_entities'   => [
            'label' => __('Related Entities', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_canonical_url'      => [
            'label' => __('Canonical URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
          'rsp_og_image'           => [
            'label' => __('Open Graph Image URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
        ],
      ],
      'industry' => [
        'title'  => __('Industry Details', 'reviewservicepro'),
        'fields' => [
          'rsp_industry_icon'         => [
            'label'       => __('Industry Icon Name', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => 'building-2',
          ],
          'rsp_trust_factors'         => [
            'label' => __('Key Trust Factors', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_reputation_challenges' => [
            'label' => __('Reputation Challenges', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 5,
          ],
          'rsp_recommended_platforms' => [
            'label' => __('Recommended Platforms', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_cta_url'               => [
            'label' => __('CTA URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
        ],
      ],
    ],
    'case_studies' => [
      'seo'  => [
        'title'  => __('SEO / AEO / GEO Intelligence', 'reviewservicepro'),
        'fields' => [
          'rsp_seo_title'          => [
            'label' => __('SEO Title', 'reviewservicepro'),
            'type'  => 'text',
          ],
          'rsp_meta_description'   => [
            'label' => __('Meta Description', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_focus_keyword'      => [
            'label' => __('Focus Keyword', 'reviewservicepro'),
            'type'  => 'text',
          ],
          'rsp_secondary_keywords' => [
            'label' => __('Secondary Keywords', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_aeo_short_answer'   => [
            'label' => __('AEO Short Answer', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_ai_summary'         => [
            'label' => __('AI Summary / GEO Summary', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_related_entities'   => [
            'label' => __('Related Entities', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 3,
          ],
          'rsp_canonical_url'      => [
            'label' => __('Canonical URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
          'rsp_og_image'           => [
            'label' => __('Open Graph Image URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
        ],
      ],
      'case' => [
        'title'  => __('Case Study Metrics', 'reviewservicepro'),
        'fields' => [
          'rsp_client_type'     => [
            'label'       => __('Client Type', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => 'Dental clinic, SaaS brand, restaurant',
          ],
          'rsp_platform_used'   => [
            'label'       => __('Platform Used', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => 'Google Reviews, Trustpilot',
          ],
          'rsp_starting_rating' => [
            'label'       => __('Starting Rating', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => '3.2',
          ],
          'rsp_final_rating'    => [
            'label'       => __('Final Rating', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => '4.7',
          ],
          'rsp_review_growth'   => [
            'label'       => __('Review Growth', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => '+240 reviews',
          ],
          'rsp_timeline'        => [
            'label'       => __('Timeline', 'reviewservicepro'),
            'type'        => 'text',
            'placeholder' => '90 days',
          ],
          'rsp_challenge'       => [
            'label' => __('Challenge', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_strategy'        => [
            'label' => __('Strategy', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_result'          => [
            'label' => __('Result', 'reviewservicepro'),
            'type'  => 'textarea',
            'rows'  => 4,
          ],
          'rsp_cta_url'         => [
            'label' => __('CTA URL', 'reviewservicepro'),
            'type'  => 'url',
          ],
        ],
      ],
    ],
  ];
}

/**
 * Flatten meta fields.
 */
function rsp_cpt_flat_meta_fields($post_type = '')
{
  $config = rsp_cpt_meta_fields();
  $flat   = [];

  foreach ($config as $type => $groups) {
    if ($post_type && $post_type !== $type) {
      continue;
    }

    foreach ($groups as $group) {
      foreach ($group['fields'] as $key => $field) {
        $flat[$key] = $field;
      }
    }
  }

  return $flat;
}

/**
 * Sanitize meta value.
 */
function rsp_sanitize_cpt_meta_value($value, $meta_key = '')
{
  if (is_array($value)) {
    $value = implode(', ', array_map('sanitize_text_field', $value));
  }

  $value = wp_unslash($value);

  if (
    false !== strpos($meta_key, 'url') ||
    false !== strpos($meta_key, 'logo') ||
    false !== strpos($meta_key, 'image')
  ) {
    return esc_url_raw($value);
  }

  return sanitize_textarea_field($value);
}

/**
 * Register meta fields.
 */
function rsp_register_cpt_meta()
{
  $config = rsp_cpt_meta_fields();

  foreach ($config as $post_type => $groups) {
    foreach ($groups as $group) {
      foreach ($group['fields'] as $key => $field) {
        register_post_meta(
          $post_type,
          $key,
          [
            'type'              => 'string',
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => 'rsp_sanitize_cpt_meta_value',
            'auth_callback'     => function () {
              return current_user_can('edit_posts');
            },
          ]
        );
      }
    }
  }
}
add_action('init', 'rsp_register_cpt_meta', 7);

/**
 * Add meta boxes.
 */
function rsp_add_cpt_meta_boxes()
{
  $config = rsp_cpt_meta_fields();

  foreach ($config as $post_type => $groups) {
    foreach ($groups as $group_key => $group) {
      add_meta_box(
        'rsp_cpt_meta_' . sanitize_key($group_key),
        $group['title'],
        'rsp_render_cpt_meta_box',
        $post_type,
        'normal',
        'high',
        [
          'post_type' => $post_type,
          'group_key' => $group_key,
          'group'     => $group,
        ]
      );
    }
  }
}
add_action('add_meta_boxes', 'rsp_add_cpt_meta_boxes');

/**
 * Render meta box.
 */
function rsp_render_cpt_meta_box($post, $box)
{
  $group = isset($box['args']['group']) ? $box['args']['group'] : [];

  if (empty($group['fields'])) {
    return;
  }

  wp_nonce_field('rsp_save_cpt_meta', 'rsp_cpt_meta_nonce');
?>
  <div class="rsp-admin-meta-box">
    <p class="description" style="margin:0 0 16px;color:#64748b;">
      <?php esc_html_e('Use these fields for SEO, answer engine optimization, AI search summaries, entity relationships, schema data, and conversion CTAs.', 'reviewservicepro'); ?>
    </p>

    <div style="display:grid;grid-template-columns:1fr;gap:16px;">
      <?php foreach ($group['fields'] as $key => $field) : ?>
        <?php
        $value       = get_post_meta($post->ID, $key, true);
        $type        = isset($field['type']) ? $field['type'] : 'text';
        $rows        = isset($field['rows']) ? absint($field['rows']) : 4;
        $placeholder = isset($field['placeholder']) ? $field['placeholder'] : '';
        ?>
        <div>
          <label for="<?php echo esc_attr($key); ?>" style="display:block;font-weight:700;margin-bottom:6px;">
            <?php echo esc_html($field['label']); ?>
          </label>

          <?php if ('textarea' === $type) : ?>
            <textarea
              id="<?php echo esc_attr($key); ?>"
              name="<?php echo esc_attr($key); ?>"
              rows="<?php echo esc_attr($rows); ?>"
              placeholder="<?php echo esc_attr($placeholder); ?>"
              style="width:100%;max-width:100%;"><?php echo esc_textarea($value); ?></textarea>
          <?php else : ?>
            <input
              type="<?php echo esc_attr($type); ?>"
              id="<?php echo esc_attr($key); ?>"
              name="<?php echo esc_attr($key); ?>"
              value="<?php echo esc_attr($value); ?>"
              placeholder="<?php echo esc_attr($placeholder); ?>"
              style="width:100%;max-width:100%;">
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php
}

/**
 * Save meta fields.
 */
function rsp_save_cpt_meta($post_id)
{
  if (! isset($_POST['rsp_cpt_meta_nonce'])) {
    return;
  }

  $nonce = sanitize_text_field(wp_unslash($_POST['rsp_cpt_meta_nonce']));

  if (! wp_verify_nonce($nonce, 'rsp_save_cpt_meta')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
    return;
  }

  if (! current_user_can('edit_post', $post_id)) {
    return;
  }

  $post_type = get_post_type($post_id);
  $fields    = rsp_cpt_flat_meta_fields($post_type);

  if (empty($fields)) {
    return;
  }

  foreach ($fields as $key => $field) {
    if (isset($_POST[$key])) {
      $value = rsp_sanitize_cpt_meta_value($_POST[$key], $key);
      update_post_meta($post_id, $key, $value);
    } else {
      delete_post_meta($post_id, $key);
    }
  }
}
add_action('save_post', 'rsp_save_cpt_meta');

/**
 * Admin columns for Platforms.
 */
function rsp_platforms_columns($columns)
{
  $new_columns = [];

  foreach ($columns as $key => $value) {
    $new_columns[$key] = $value;

    if ('title' === $key) {
      $new_columns['rsp_focus_keyword'] = __('Focus Keyword', 'reviewservicepro');
      $new_columns['rsp_best_for']      = __('Best For', 'reviewservicepro');
    }
  }

  return $new_columns;
}
add_filter('manage_platforms_posts_columns', 'rsp_platforms_columns');

/**
 * Admin columns for Industries.
 */
function rsp_industries_columns($columns)
{
  $new_columns = [];

  foreach ($columns as $key => $value) {
    $new_columns[$key] = $value;

    if ('title' === $key) {
      $new_columns['rsp_focus_keyword']         = __('Focus Keyword', 'reviewservicepro');
      $new_columns['rsp_recommended_platforms'] = __('Platforms', 'reviewservicepro');
    }
  }

  return $new_columns;
}
add_filter('manage_industries_posts_columns', 'rsp_industries_columns');

/**
 * Admin columns for Case Studies.
 */
function rsp_case_studies_columns($columns)
{
  $new_columns = [];

  foreach ($columns as $key => $value) {
    $new_columns[$key] = $value;

    if ('title' === $key) {
      $new_columns['rsp_platform_used'] = __('Platform', 'reviewservicepro');
      $new_columns['rsp_final_rating']  = __('Final Rating', 'reviewservicepro');
      $new_columns['rsp_result']        = __('Result', 'reviewservicepro');
    }
  }

  return $new_columns;
}
add_filter('manage_case_studies_posts_columns', 'rsp_case_studies_columns');

/**
 * Render admin columns.
 */
function rsp_render_cpt_custom_columns($column, $post_id)
{
  $value = get_post_meta($post_id, $column, true);

  if (empty($value)) {
    echo '<span style="color:#94a3b8;">—</span>';
    return;
  }

  if (in_array($column, ['rsp_best_for', 'rsp_recommended_platforms', 'rsp_result'], true)) {
    echo esc_html(wp_trim_words($value, 8));
    return;
  }

  echo esc_html($value);
}
add_action('manage_platforms_posts_custom_column', 'rsp_render_cpt_custom_columns', 10, 2);
add_action('manage_industries_posts_custom_column', 'rsp_render_cpt_custom_columns', 10, 2);
add_action('manage_case_studies_posts_custom_column', 'rsp_render_cpt_custom_columns', 10, 2);

/**
 * Sortable columns.
 */
function rsp_sortable_cpt_columns($columns)
{
  $columns['rsp_focus_keyword'] = 'rsp_focus_keyword';
  $columns['rsp_platform_used'] = 'rsp_platform_used';
  $columns['rsp_final_rating']  = 'rsp_final_rating';

  return $columns;
}
add_filter('manage_edit-platforms_sortable_columns', 'rsp_sortable_cpt_columns');
add_filter('manage_edit-industries_sortable_columns', 'rsp_sortable_cpt_columns');
add_filter('manage_edit-case_studies_sortable_columns', 'rsp_sortable_cpt_columns');

/**
 * Admin orderby by meta fields.
 */
function rsp_cpt_admin_orderby($query)
{
  if (! is_admin() || ! $query->is_main_query()) {
    return;
  }

  $orderby = $query->get('orderby');

  if (in_array($orderby, ['rsp_focus_keyword', 'rsp_platform_used', 'rsp_final_rating'], true)) {
    $query->set('meta_key', $orderby);
    $query->set('orderby', 'meta_value');
  }
}
add_action('pre_get_posts', 'rsp_cpt_admin_orderby');

/**
 * Flush rewrite rules on theme switch.
 */
function rsp_flush_cpt_rewrite_rules()
{
  rsp_register_custom_post_types();
  rsp_register_custom_taxonomies();
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'rsp_flush_cpt_rewrite_rules');
