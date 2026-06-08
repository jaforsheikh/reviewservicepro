<?php

/**
 * ReviewService.Pro Safe SEO Cluster Meta System
 *
 * File: inc/seo-cluster-meta.php
 *
 * Purpose:
 * - Add safe SEO cluster planning fields to Pages, Products, Posts, and supported CPTs.
 * - Support SEO title/meta description fallback when no major SEO plugin is active.
 * - Support safe Service/WebPage schema fallback.
 * - Support FAQ schema only when FAQ content is visible on frontend.
 * - Support visible related cluster links block.
 *
 * Important Safety Rules:
 * - No hidden keyword output.
 * - No display:none keyword stuffing.
 * - No meta keywords output.
 * - No duplicate SEO meta when major SEO plugins are active.
 * - Backend keywords are for planning, internal linking, and content strategy.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Detect major SEO plugin.
 *
 * @return bool
 */
function rsp_cluster_has_active_seo_plugin()
{
  return (
    defined('WPSEO_VERSION') ||
    defined('RANK_MATH_VERSION') ||
    defined('SEOPRESS_VERSION') ||
    defined('AIOSEO_VERSION')
  );
}

/**
 * Supported post types for SEO Cluster Meta System.
 *
 * @return array
 */
function rsp_cluster_supported_post_types()
{
  $post_types = [
    'page',
    'post',
    'product',
  ];

  $optional_post_types = [
    'case_study',
    'case-studies',
    'service',
    'services',
  ];

  foreach ($optional_post_types as $post_type) {
    if (post_type_exists($post_type)) {
      $post_types[] = $post_type;
    }
  }

  return apply_filters('rsp_cluster_supported_post_types', array_values(array_unique($post_types)));
}

/**
 * Get safe meta value.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key.
 * @param string $default Default value.
 * @return string
 */
function rsp_cluster_get_meta($post_id, $key, $default = '')
{
  $post_id = absint($post_id);
  $key     = sanitize_key($key);

  if (! $post_id || ! $key) {
    return $default;
  }

  $value = get_post_meta($post_id, $key, true);

  if ('' === $value || null === $value) {
    return $default;
  }

  return is_string($value) ? $value : $default;
}

/**
 * Convert textarea lines into clean array.
 *
 * @param string $raw Raw textarea value.
 * @return array
 */
function rsp_cluster_lines_to_array($raw)
{
  $raw = (string) $raw;

  if ('' === trim($raw)) {
    return [];
  }

  $lines = preg_split('/\r\n|\r|\n/', $raw);
  $items = [];

  foreach ($lines as $line) {
    $line = trim(wp_strip_all_tags((string) $line));

    if ('' !== $line) {
      $items[] = $line;
    }
  }

  return array_values(array_unique($items));
}

/**
 * Parse related links.
 *
 * Format:
 * Label | URL
 *
 * @param string $raw Raw links text.
 * @return array
 */
function rsp_cluster_parse_related_links($raw)
{
  $lines = rsp_cluster_lines_to_array($raw);
  $links = [];

  foreach ($lines as $line) {
    $parts = array_map('trim', explode('|', $line, 2));

    if (count($parts) < 2) {
      continue;
    }

    $label = sanitize_text_field($parts[0]);
    $url   = esc_url_raw($parts[1]);

    if (! $label || ! $url) {
      continue;
    }

    $links[] = [
      'label' => $label,
      'url'   => $url,
    ];
  }

  return $links;
}

/**
 * Add meta box.
 *
 * @return void
 */
function rsp_cluster_add_meta_boxes()
{
  foreach (rsp_cluster_supported_post_types() as $post_type) {
    add_meta_box(
      'rsp_safe_seo_cluster_meta',
      __('ReviewService.Pro Safe SEO Cluster System', 'reviewservicepro'),
      'rsp_cluster_render_meta_box',
      $post_type,
      'normal',
      'high'
    );
  }
}
add_action('add_meta_boxes', 'rsp_cluster_add_meta_boxes');

/**
 * Render meta box.
 *
 * @param WP_Post $post Post object.
 * @return void
 */
function rsp_cluster_render_meta_box($post)
{
  if (! $post instanceof WP_Post) {
    return;
  }

  wp_nonce_field('rsp_cluster_save_meta', 'rsp_cluster_meta_nonce');

  $seo_plugin_active = rsp_cluster_has_active_seo_plugin();

  $primary_keyword     = rsp_cluster_get_meta($post->ID, '_rsp_cluster_primary_keyword');
  $secondary_keywords  = rsp_cluster_get_meta($post->ID, '_rsp_cluster_secondary_keywords');
  $semantic_topics     = rsp_cluster_get_meta($post->ID, '_rsp_cluster_semantic_topics');
  $search_intent       = rsp_cluster_get_meta($post->ID, '_rsp_cluster_search_intent', 'commercial');
  $cluster_role        = rsp_cluster_get_meta($post->ID, '_rsp_cluster_role', 'supporting');
  $cluster_parent      = rsp_cluster_get_meta($post->ID, '_rsp_cluster_parent');
  $anchor_ideas        = rsp_cluster_get_meta($post->ID, '_rsp_cluster_anchor_ideas');

  $enable_seo_fallback = rsp_cluster_get_meta($post->ID, '_rsp_cluster_enable_seo_fallback', 'no');
  $seo_title           = rsp_cluster_get_meta($post->ID, '_rsp_cluster_seo_title');
  $meta_description    = rsp_cluster_get_meta($post->ID, '_rsp_cluster_meta_description');
  $canonical_url       = rsp_cluster_get_meta($post->ID, '_rsp_cluster_canonical_url');

  $frontend_title      = rsp_cluster_get_meta($post->ID, '_rsp_cluster_frontend_title');
  $frontend_intro      = rsp_cluster_get_meta($post->ID, '_rsp_cluster_frontend_intro');
  $show_related_links  = rsp_cluster_get_meta($post->ID, '_rsp_cluster_show_related_links', 'no');
  $related_links       = rsp_cluster_get_meta($post->ID, '_rsp_cluster_related_links');

  $enable_schema       = rsp_cluster_get_meta($post->ID, '_rsp_cluster_enable_schema', 'no');
  $schema_type         = rsp_cluster_get_meta($post->ID, '_rsp_cluster_schema_type', 'Service');
  $service_type        = rsp_cluster_get_meta($post->ID, '_rsp_cluster_service_type', 'Online Reputation Management Service');
  $area_served         = rsp_cluster_get_meta($post->ID, '_rsp_cluster_area_served', 'United States');

  $show_frontend_faq   = rsp_cluster_get_meta($post->ID, '_rsp_cluster_show_frontend_faq', 'no');
  $faq_1_question      = rsp_cluster_get_meta($post->ID, '_rsp_cluster_faq_1_question');
  $faq_1_answer        = rsp_cluster_get_meta($post->ID, '_rsp_cluster_faq_1_answer');
  $faq_2_question      = rsp_cluster_get_meta($post->ID, '_rsp_cluster_faq_2_question');
  $faq_2_answer        = rsp_cluster_get_meta($post->ID, '_rsp_cluster_faq_2_answer');
  $faq_3_question      = rsp_cluster_get_meta($post->ID, '_rsp_cluster_faq_3_question');
  $faq_3_answer        = rsp_cluster_get_meta($post->ID, '_rsp_cluster_faq_3_answer');

  $search_intents = [
    'informational' => __('Informational', 'reviewservicepro'),
    'commercial'   => __('Commercial Investigation', 'reviewservicepro'),
    'transactional' => __('Transactional', 'reviewservicepro'),
    'local'         => __('Local Intent', 'reviewservicepro'),
    'navigational'  => __('Navigational', 'reviewservicepro'),
  ];

  $cluster_roles = [
    'pillar'     => __('Pillar Page', 'reviewservicepro'),
    'supporting' => __('Supporting Cluster Page', 'reviewservicepro'),
    'platform'   => __('Platform-Specific Page', 'reviewservicepro'),
    'product'    => __('Product / Package Page', 'reviewservicepro'),
    'faq'        => __('FAQ / AEO Page', 'reviewservicepro'),
    'case_study' => __('Case Study', 'reviewservicepro'),
  ];

  $schema_types = [
    'Service' => __('Service', 'reviewservicepro'),
    'WebPage' => __('WebPage', 'reviewservicepro'),
  ];
?>

  <style>
    .rsp-cluster-box {
      display: grid;
      gap: 22px;
      padding: 8px 0;
    }

    .rsp-cluster-section {
      overflow: hidden;
      border: 1px solid #dbe3ef;
      border-radius: 14px;
      background: #ffffff;
    }

    .rsp-cluster-section-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 14px;
      border-bottom: 1px solid #e5eaf2;
      background: #f8fafc;
      padding: 14px 16px;
    }

    .rsp-cluster-section-header h3 {
      margin: 0;
      color: #0f172a;
      font-size: 15px;
      font-weight: 700;
      line-height: 1.4;
    }

    .rsp-cluster-section-header p {
      margin: 3px 0 0;
      color: #64748b;
      font-size: 12px;
      line-height: 1.5;
    }

    .rsp-cluster-section-body {
      display: grid;
      gap: 18px;
      padding: 16px;
    }

    .rsp-cluster-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .rsp-cluster-field label {
      display: block;
      margin-bottom: 7px;
      color: #111827;
      font-weight: 600;
    }

    .rsp-cluster-field input[type="text"],
    .rsp-cluster-field input[type="url"],
    .rsp-cluster-field textarea,
    .rsp-cluster-field select {
      width: 100%;
      max-width: 100%;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      padding: 10px 12px;
      color: #0f172a;
      font-size: 14px;
      line-height: 1.5;
      box-sizing: border-box;
      background: #ffffff;
    }

    .rsp-cluster-field textarea {
      min-height: 110px;
      resize: vertical;
    }

    .rsp-cluster-field input[type="checkbox"] {
      margin-right: 6px;
    }

    .rsp-cluster-help {
      margin-top: 6px;
      color: #64748b;
      font-size: 13px;
      line-height: 1.5;
    }

    .rsp-cluster-note {
      border-left: 4px solid #2563eb;
      border-radius: 8px;
      background: #eff6ff;
      padding: 12px 14px;
      color: #334155;
      font-size: 13px;
      line-height: 1.6;
    }

    .rsp-cluster-warning {
      border-left: 4px solid #f59e0b;
      border-radius: 8px;
      background: #fffbeb;
      padding: 12px 14px;
      color: #78350f;
      font-size: 13px;
      line-height: 1.6;
    }

    .rsp-cluster-danger {
      border-left: 4px solid #ef4444;
      border-radius: 8px;
      background: #fef2f2;
      padding: 12px 14px;
      color: #7f1d1d;
      font-size: 13px;
      line-height: 1.6;
    }

    @media (max-width: 960px) {
      .rsp-cluster-grid {
        grid-template-columns: 1fr;
      }

      .rsp-cluster-section-header {
        display: block;
      }
    }
  </style>

  <div class="rsp-cluster-box">

    <div class="rsp-cluster-danger">
      <?php esc_html_e('Safety rule: this system does not output hidden keywords, hidden links, meta keywords, or keyword-stuffed invisible content. Backend keywords are for strategy, internal linking, schema planning, and content guidance only.', 'reviewservicepro'); ?>
    </div>

    <?php if ($seo_plugin_active) : ?>
      <div class="rsp-cluster-warning">
        <?php esc_html_e('A major SEO plugin appears to be active. This system will not output duplicate SEO title/meta/schema unless you use the visible blocks or your templates manually use these fields.', 'reviewservicepro'); ?>
      </div>
    <?php endif; ?>

    <!-- Cluster Strategy -->
    <div class="rsp-cluster-section">
      <div class="rsp-cluster-section-header">
        <div>
          <h3><?php esc_html_e('1. Backend SEO Cluster Strategy', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Admin-only planning fields. These are not dumped into frontend as hidden keywords.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-cluster-section-body">
        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_primary_keyword"><?php esc_html_e('Primary SEO keyword', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_primary_keyword" name="rsp_cluster_primary_keyword" value="<?php echo esc_attr($primary_keyword); ?>" placeholder="<?php esc_attr_e('Example: online reputation management services', 'reviewservicepro'); ?>">
            <p class="rsp-cluster-help"><?php esc_html_e('Main keyword for this page/product. Use it naturally in visible content, not hidden text.', 'reviewservicepro'); ?></p>
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_search_intent"><?php esc_html_e('Search intent', 'reviewservicepro'); ?></label>
            <select id="rsp_cluster_search_intent" name="rsp_cluster_search_intent">
              <?php foreach ($search_intents as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($search_intent, $value); ?>>
                  <?php echo esc_html($label); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_cluster_role"><?php esc_html_e('Cluster role', 'reviewservicepro'); ?></label>
            <select id="rsp_cluster_cluster_role" name="rsp_cluster_role">
              <?php foreach ($cluster_roles as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($cluster_role, $value); ?>>
                  <?php echo esc_html($label); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_parent"><?php esc_html_e('Cluster parent / pillar URL', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_parent" name="rsp_cluster_parent" value="<?php echo esc_attr($cluster_parent); ?>" placeholder="<?php esc_attr_e('/services/ or /services/online-reputation-management/', 'reviewservicepro'); ?>">
          </div>
        </div>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_secondary_keywords"><?php esc_html_e('Secondary keywords', 'reviewservicepro'); ?></label>
          <textarea id="rsp_cluster_secondary_keywords" name="rsp_cluster_secondary_keywords" placeholder="<?php esc_attr_e('One keyword per line. Admin planning only.', 'reviewservicepro'); ?>"><?php echo esc_textarea($secondary_keywords); ?></textarea>
          <p class="rsp-cluster-help"><?php esc_html_e('Examples: review monitoring service, Google Business Profile reputation management, review response management. These are not output as hidden frontend text.', 'reviewservicepro'); ?></p>
        </div>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_semantic_topics"><?php esc_html_e('Semantic topics / entities', 'reviewservicepro'); ?></label>
          <textarea id="rsp_cluster_semantic_topics" name="rsp_cluster_semantic_topics" placeholder="<?php esc_attr_e('One topic/entity per line.', 'reviewservicepro'); ?>"><?php echo esc_textarea($semantic_topics); ?></textarea>
          <p class="rsp-cluster-help"><?php esc_html_e('Use this to plan natural sections, FAQs, examples, platform mentions, and internal links.', 'reviewservicepro'); ?></p>
        </div>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_anchor_ideas"><?php esc_html_e('Internal link anchor ideas', 'reviewservicepro'); ?></label>
          <textarea id="rsp_cluster_anchor_ideas" name="rsp_cluster_anchor_ideas" placeholder="<?php esc_attr_e('Example: Google Business Profile reputation management | /services/google-business-profile-reputation-management/', 'reviewservicepro'); ?>"><?php echo esc_textarea($anchor_ideas); ?></textarea>
          <p class="rsp-cluster-help"><?php esc_html_e('Planning only. Use these ideas to build visible internal links inside helpful content sections.', 'reviewservicepro'); ?></p>
        </div>
      </div>
    </div>

    <!-- SEO Output -->
    <div class="rsp-cluster-section">
      <div class="rsp-cluster-section-header">
        <div>
          <h3><?php esc_html_e('2. SEO Title / Meta Fallback', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Outputs only when enabled and no major SEO plugin is active.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-cluster-section-body">
        <label>
          <input type="checkbox" name="rsp_cluster_enable_seo_fallback" value="yes" <?php checked($enable_seo_fallback, 'yes'); ?>>
          <?php esc_html_e('Enable ReviewService.Pro fallback SEO title/meta for this item', 'reviewservicepro'); ?>
        </label>

        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_seo_title"><?php esc_html_e('SEO title', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_seo_title" name="rsp_cluster_seo_title" value="<?php echo esc_attr($seo_title); ?>" placeholder="<?php esc_attr_e('AI-Driven Online Reputation Management Services | ReviewService.Pro', 'reviewservicepro'); ?>">
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_canonical_url"><?php esc_html_e('Canonical URL', 'reviewservicepro'); ?></label>
            <input type="url" id="rsp_cluster_canonical_url" name="rsp_cluster_canonical_url" value="<?php echo esc_attr($canonical_url); ?>" placeholder="<?php echo esc_attr(get_permalink($post->ID)); ?>">
          </div>
        </div>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_meta_description"><?php esc_html_e('Meta description', 'reviewservicepro'); ?></label>
          <textarea id="rsp_cluster_meta_description" name="rsp_cluster_meta_description" placeholder="<?php esc_attr_e('Write a clear, service-focused meta description. Avoid fake review, guaranteed removal, or guaranteed ranking claims.', 'reviewservicepro'); ?>"><?php echo esc_textarea($meta_description); ?></textarea>
          <p class="rsp-cluster-help"><?php esc_html_e('Recommended: 140–160 characters. Keep it visible-service aligned and compliance-safe.', 'reviewservicepro'); ?></p>
        </div>
      </div>
    </div>

    <!-- Visible Frontend Support -->
    <div class="rsp-cluster-section">
      <div class="rsp-cluster-section-header">
        <div>
          <h3><?php esc_html_e('3. Visible Frontend SEO Support', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Safe visible content helpers. Nothing hidden.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-cluster-section-body">
        <div class="rsp-cluster-field">
          <label for="rsp_cluster_frontend_title"><?php esc_html_e('Frontend display title / alternate H1', 'reviewservicepro'); ?></label>
          <input type="text" id="rsp_cluster_frontend_title" name="rsp_cluster_frontend_title" value="<?php echo esc_attr($frontend_title); ?>" placeholder="<?php esc_attr_e('Example: AI-Driven Reputation Support for Trust-Focused Businesses', 'reviewservicepro'); ?>">
          <p class="rsp-cluster-help"><?php esc_html_e('Templates can use this instead of the normal title. You can also show it with shortcode: [rsp_cluster_title]', 'reviewservicepro'); ?></p>
        </div>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_frontend_intro"><?php esc_html_e('Visible intro snippet', 'reviewservicepro'); ?></label>
          <textarea id="rsp_cluster_frontend_intro" name="rsp_cluster_frontend_intro" placeholder="<?php esc_attr_e('Short helpful intro that can be shown on frontend.', 'reviewservicepro'); ?>"><?php echo esc_textarea($frontend_intro); ?></textarea>
          <p class="rsp-cluster-help"><?php esc_html_e('Use shortcode: [rsp_cluster_intro] if you want to display this in content/templates.', 'reviewservicepro'); ?></p>
        </div>

        <label>
          <input type="checkbox" name="rsp_cluster_show_related_links" value="yes" <?php checked($show_related_links, 'yes'); ?>>
          <?php esc_html_e('Automatically show visible related cluster links after content', 'reviewservicepro'); ?>
        </label>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_related_links"><?php esc_html_e('Related cluster links', 'reviewservicepro'); ?></label>
          <textarea id="rsp_cluster_related_links" name="rsp_cluster_related_links" placeholder="<?php esc_attr_e("Label | URL\nGoogle Business Profile Reputation Management | /services/google-business-profile-reputation-management/", 'reviewservicepro'); ?>"><?php echo esc_textarea($related_links); ?></textarea>
          <p class="rsp-cluster-help"><?php esc_html_e('Use one link per line: Label | URL. These links are visible when enabled.', 'reviewservicepro'); ?></p>
        </div>
      </div>
    </div>

    <!-- Schema -->
    <div class="rsp-cluster-section">
      <div class="rsp-cluster-section-header">
        <div>
          <h3><?php esc_html_e('4. Safe Schema Fallback', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Outputs only when enabled and no major SEO plugin is active.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-cluster-section-body">
        <label>
          <input type="checkbox" name="rsp_cluster_enable_schema" value="yes" <?php checked($enable_schema, 'yes'); ?>>
          <?php esc_html_e('Enable safe schema fallback for this item', 'reviewservicepro'); ?>
        </label>

        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_schema_type"><?php esc_html_e('Schema type', 'reviewservicepro'); ?></label>
            <select id="rsp_cluster_schema_type" name="rsp_cluster_schema_type">
              <?php foreach ($schema_types as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($schema_type, $value); ?>>
                  <?php echo esc_html($label); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_service_type"><?php esc_html_e('Service type', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_service_type" name="rsp_cluster_service_type" value="<?php echo esc_attr($service_type); ?>" placeholder="<?php esc_attr_e('Online Reputation Management Service', 'reviewservicepro'); ?>">
          </div>
        </div>

        <div class="rsp-cluster-field">
          <label for="rsp_cluster_area_served"><?php esc_html_e('Area served', 'reviewservicepro'); ?></label>
          <input type="text" id="rsp_cluster_area_served" name="rsp_cluster_area_served" value="<?php echo esc_attr($area_served); ?>" placeholder="<?php esc_attr_e('United States', 'reviewservicepro'); ?>">
        </div>
      </div>
    </div>

    <!-- FAQ / AEO -->
    <div class="rsp-cluster-section">
      <div class="rsp-cluster-section-header">
        <div>
          <h3><?php esc_html_e('5. Visible FAQ / AEO Block', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('FAQ schema is output only when these FAQs are visible on frontend.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-cluster-section-body">
        <label>
          <input type="checkbox" name="rsp_cluster_show_frontend_faq" value="yes" <?php checked($show_frontend_faq, 'yes'); ?>>
          <?php esc_html_e('Automatically show visible FAQ block after content', 'reviewservicepro'); ?>
        </label>

        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_faq_1_question"><?php esc_html_e('FAQ 1 Question', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_faq_1_question" name="rsp_cluster_faq_1_question" value="<?php echo esc_attr($faq_1_question); ?>">
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_faq_1_answer"><?php esc_html_e('FAQ 1 Answer', 'reviewservicepro'); ?></label>
            <textarea id="rsp_cluster_faq_1_answer" name="rsp_cluster_faq_1_answer"><?php echo esc_textarea($faq_1_answer); ?></textarea>
          </div>
        </div>

        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_faq_2_question"><?php esc_html_e('FAQ 2 Question', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_faq_2_question" name="rsp_cluster_faq_2_question" value="<?php echo esc_attr($faq_2_question); ?>">
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_faq_2_answer"><?php esc_html_e('FAQ 2 Answer', 'reviewservicepro'); ?></label>
            <textarea id="rsp_cluster_faq_2_answer" name="rsp_cluster_faq_2_answer"><?php echo esc_textarea($faq_2_answer); ?></textarea>
          </div>
        </div>

        <div class="rsp-cluster-grid">
          <div class="rsp-cluster-field">
            <label for="rsp_cluster_faq_3_question"><?php esc_html_e('FAQ 3 Question', 'reviewservicepro'); ?></label>
            <input type="text" id="rsp_cluster_faq_3_question" name="rsp_cluster_faq_3_question" value="<?php echo esc_attr($faq_3_question); ?>">
          </div>

          <div class="rsp-cluster-field">
            <label for="rsp_cluster_faq_3_answer"><?php esc_html_e('FAQ 3 Answer', 'reviewservicepro'); ?></label>
            <textarea id="rsp_cluster_faq_3_answer" name="rsp_cluster_faq_3_answer"><?php echo esc_textarea($faq_3_answer); ?></textarea>
          </div>
        </div>
      </div>
    </div>

  </div>

<?php
}

/**
 * Save meta fields.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function rsp_cluster_save_meta($post_id)
{
  $post_id = absint($post_id);

  if (! $post_id) {
    return;
  }

  $post_type = get_post_type($post_id);

  if (! in_array($post_type, rsp_cluster_supported_post_types(), true)) {
    return;
  }

  if (! isset($_POST['rsp_cluster_meta_nonce'])) {
    return;
  }

  $nonce = sanitize_text_field(wp_unslash($_POST['rsp_cluster_meta_nonce']));

  if (! wp_verify_nonce($nonce, 'rsp_cluster_save_meta')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (! current_user_can('edit_post', $post_id)) {
    return;
  }

  $text_fields = [
    '_rsp_cluster_primary_keyword'     => 'rsp_cluster_primary_keyword',
    '_rsp_cluster_search_intent'       => 'rsp_cluster_search_intent',
    '_rsp_cluster_role'                => 'rsp_cluster_role',
    '_rsp_cluster_parent'              => 'rsp_cluster_parent',
    '_rsp_cluster_seo_title'           => 'rsp_cluster_seo_title',
    '_rsp_cluster_canonical_url'       => 'rsp_cluster_canonical_url',
    '_rsp_cluster_frontend_title'      => 'rsp_cluster_frontend_title',
    '_rsp_cluster_schema_type'         => 'rsp_cluster_schema_type',
    '_rsp_cluster_service_type'        => 'rsp_cluster_service_type',
    '_rsp_cluster_area_served'         => 'rsp_cluster_area_served',
    '_rsp_cluster_faq_1_question'      => 'rsp_cluster_faq_1_question',
    '_rsp_cluster_faq_2_question'      => 'rsp_cluster_faq_2_question',
    '_rsp_cluster_faq_3_question'      => 'rsp_cluster_faq_3_question',
  ];

  foreach ($text_fields as $meta_key => $post_key) {
    if (isset($_POST[$post_key])) {
      $value = sanitize_text_field(wp_unslash($_POST[$post_key]));

      if ('_rsp_cluster_canonical_url' === $meta_key) {
        $value = esc_url_raw($value);
      }

      update_post_meta($post_id, $meta_key, $value);
    }
  }

  $textarea_fields = [
    '_rsp_cluster_secondary_keywords' => 'rsp_cluster_secondary_keywords',
    '_rsp_cluster_semantic_topics'    => 'rsp_cluster_semantic_topics',
    '_rsp_cluster_anchor_ideas'       => 'rsp_cluster_anchor_ideas',
    '_rsp_cluster_meta_description'   => 'rsp_cluster_meta_description',
    '_rsp_cluster_frontend_intro'     => 'rsp_cluster_frontend_intro',
    '_rsp_cluster_related_links'      => 'rsp_cluster_related_links',
    '_rsp_cluster_faq_1_answer'       => 'rsp_cluster_faq_1_answer',
    '_rsp_cluster_faq_2_answer'       => 'rsp_cluster_faq_2_answer',
    '_rsp_cluster_faq_3_answer'       => 'rsp_cluster_faq_3_answer',
  ];

  foreach ($textarea_fields as $meta_key => $post_key) {
    if (isset($_POST[$post_key])) {
      update_post_meta(
        $post_id,
        $meta_key,
        sanitize_textarea_field(wp_unslash($_POST[$post_key]))
      );
    }
  }

  $checkbox_fields = [
    '_rsp_cluster_enable_seo_fallback' => 'rsp_cluster_enable_seo_fallback',
    '_rsp_cluster_show_related_links'  => 'rsp_cluster_show_related_links',
    '_rsp_cluster_enable_schema'       => 'rsp_cluster_enable_schema',
    '_rsp_cluster_show_frontend_faq'   => 'rsp_cluster_show_frontend_faq',
  ];

  foreach ($checkbox_fields as $meta_key => $post_key) {
    $value = isset($_POST[$post_key]) && 'yes' === $_POST[$post_key] ? 'yes' : 'no';
    update_post_meta($post_id, $meta_key, $value);
  }
}
add_action('save_post', 'rsp_cluster_save_meta');

/**
 * Get SEO fallback data for current singular item.
 *
 * @return array|null
 */
function rsp_cluster_get_current_data()
{
  if (! is_singular()) {
    return null;
  }

  $post_id = get_the_ID();

  if (! $post_id) {
    return null;
  }

  $post_type = get_post_type($post_id);

  if (! in_array($post_type, rsp_cluster_supported_post_types(), true)) {
    return null;
  }

  return [
    'post_id'             => $post_id,
    'seo_enabled'         => rsp_cluster_get_meta($post_id, '_rsp_cluster_enable_seo_fallback', 'no'),
    'seo_title'           => rsp_cluster_get_meta($post_id, '_rsp_cluster_seo_title'),
    'meta_description'    => rsp_cluster_get_meta($post_id, '_rsp_cluster_meta_description'),
    'canonical_url'       => rsp_cluster_get_meta($post_id, '_rsp_cluster_canonical_url'),
    'schema_enabled'      => rsp_cluster_get_meta($post_id, '_rsp_cluster_enable_schema', 'no'),
    'schema_type'         => rsp_cluster_get_meta($post_id, '_rsp_cluster_schema_type', 'Service'),
    'service_type'        => rsp_cluster_get_meta($post_id, '_rsp_cluster_service_type', 'Online Reputation Management Service'),
    'area_served'         => rsp_cluster_get_meta($post_id, '_rsp_cluster_area_served', 'United States'),
    'show_frontend_faq'   => rsp_cluster_get_meta($post_id, '_rsp_cluster_show_frontend_faq', 'no'),
    'faq_1_q'             => rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_1_question'),
    'faq_1_a'             => rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_1_answer'),
    'faq_2_q'             => rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_2_question'),
    'faq_2_a'             => rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_2_answer'),
    'faq_3_q'             => rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_3_question'),
    'faq_3_a'             => rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_3_answer'),
  ];
}

/**
 * Fallback SEO title.
 *
 * @param array $title_parts Title parts.
 * @return array
 */
function rsp_cluster_document_title_parts($title_parts)
{
  if (rsp_cluster_has_active_seo_plugin()) {
    return $title_parts;
  }

  $data = rsp_cluster_get_current_data();

  if (! $data || 'yes' !== $data['seo_enabled'] || empty($data['seo_title'])) {
    return $title_parts;
  }

  $title_parts['title'] = sanitize_text_field($data['seo_title']);

  return $title_parts;
}
add_filter('document_title_parts', 'rsp_cluster_document_title_parts', 20);

/**
 * Output fallback meta/schema.
 *
 * @return void
 */
function rsp_cluster_output_head_meta()
{
  if (rsp_cluster_has_active_seo_plugin()) {
    return;
  }

  $data = rsp_cluster_get_current_data();

  if (! $data) {
    return;
  }

  $post_id = absint($data['post_id']);

  if ('yes' === $data['seo_enabled']) {
    $description = $data['meta_description'] ? sanitize_textarea_field($data['meta_description']) : wp_strip_all_tags(get_the_excerpt($post_id));
    $title       = $data['seo_title'] ? sanitize_text_field($data['seo_title']) : get_the_title($post_id);
    $canonical   = $data['canonical_url'] ? esc_url($data['canonical_url']) : get_permalink($post_id);

    if ($description) {
      echo "\n" . '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
      echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    }

    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink($post_id)) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
  }

  if ('yes' === $data['schema_enabled']) {
    $description = $data['meta_description'] ? sanitize_textarea_field($data['meta_description']) : wp_strip_all_tags(get_the_excerpt($post_id));
    $schema_type = in_array($data['schema_type'], ['Service', 'WebPage'], true) ? $data['schema_type'] : 'Service';

    $schema = [
      '@context'    => 'https://schema.org',
      '@type'       => $schema_type,
      'name'        => get_the_title($post_id),
      'description' => $description ? $description : wp_strip_all_tags(get_the_title($post_id)),
      'url'         => get_permalink($post_id),
      'isPartOf'    => [
        '@type' => 'WebSite',
        'name'  => 'ReviewService.Pro',
        'url'   => home_url('/'),
      ],
    ];

    if ('Service' === $schema_type) {
      $schema['serviceType'] = sanitize_text_field($data['service_type']);
      $schema['provider']    = [
        '@type' => 'Organization',
        'name'  => 'ReviewService.Pro',
        'url'   => home_url('/'),
      ];
      $schema['areaServed']  = [
        '@type' => 'Country',
        'name'  => sanitize_text_field($data['area_served']),
      ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
  }

  /**
   * FAQ schema only when FAQ block is visible.
   */
  if ('yes' === $data['show_frontend_faq']) {
    $faq_items = [];

    for ($i = 1; $i <= 3; $i++) {
      $q_key = 'faq_' . $i . '_q';
      $a_key = 'faq_' . $i . '_a';

      if (! empty($data[$q_key]) && ! empty($data[$a_key])) {
        $faq_items[] = [
          '@type'          => 'Question',
          'name'           => sanitize_text_field($data[$q_key]),
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => sanitize_textarea_field($data[$a_key]),
          ],
        ];
      }
    }

    if (! empty($faq_items)) {
      $faq_schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_items,
      ];

      echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
  }
}
add_action('wp_head', 'rsp_cluster_output_head_meta', 30);

/**
 * Render visible related links block.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function rsp_cluster_render_related_links($post_id)
{
  $raw_links = rsp_cluster_get_meta($post_id, '_rsp_cluster_related_links');
  $links     = rsp_cluster_parse_related_links($raw_links);

  if (empty($links)) {
    return '';
  }

  ob_start();
?>

  <section class="rsp-seo-cluster-related-links mt-10 rounded-2xl border border-white/[0.08] bg-white/[0.04] p-6">
    <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
      <?php esc_html_e('Related reputation management topics', 'reviewservicepro'); ?>
    </h2>

    <p class="mt-2 text-base leading-7 text-slate-300">
      <?php esc_html_e('Explore related service areas that can help you understand and improve your online trust signals.', 'reviewservicepro'); ?>
    </p>

    <div class="mt-5 flex flex-wrap gap-3">
      <?php foreach ($links as $link) : ?>
        <a
          href="<?php echo esc_url($link['url']); ?>"
          class="inline-flex items-center rounded-xl border border-white/[0.10] bg-white/[0.05] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-400/30 hover:bg-blue-500/10">

          <?php echo esc_html($link['label']); ?>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

<?php
  return ob_get_clean();
}

/**
 * Render visible FAQ block.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function rsp_cluster_render_faq_block($post_id)
{
  $faqs = [];

  for ($i = 1; $i <= 3; $i++) {
    $question = rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_' . $i . '_question');
    $answer   = rsp_cluster_get_meta($post_id, '_rsp_cluster_faq_' . $i . '_answer');

    if ($question && $answer) {
      $faqs[] = [
        'question' => $question,
        'answer'   => $answer,
      ];
    }
  }

  if (empty($faqs)) {
    return '';
  }

  ob_start();
?>

  <section class="rsp-seo-cluster-faq mt-10 rounded-2xl border border-white/[0.08] bg-white/[0.04] p-6">
    <h2 class="text-2xl font-semibold tracking-[-0.04em] text-white">
      <?php esc_html_e('Frequently asked questions', 'reviewservicepro'); ?>
    </h2>

    <div class="mt-5 space-y-4">
      <?php foreach ($faqs as $faq) : ?>
        <details class="rounded-xl border border-white/[0.08] bg-white/[0.035] p-4">
          <summary class="cursor-pointer text-base font-medium text-white">
            <?php echo esc_html($faq['question']); ?>
          </summary>

          <p class="mt-3 text-base leading-7 text-slate-300">
            <?php echo esc_html($faq['answer']); ?>
          </p>
        </details>
      <?php endforeach; ?>
    </div>
  </section>

<?php
  return ob_get_clean();
}

/**
 * Append visible safe SEO helper blocks.
 *
 * @param string $content Post content.
 * @return string
 */
function rsp_cluster_append_visible_blocks($content)
{
  if (is_admin() || ! is_singular() || ! in_the_loop() || ! is_main_query()) {
    return $content;
  }

  $post_id = get_the_ID();

  if (! $post_id) {
    return $content;
  }

  $post_type = get_post_type($post_id);

  if (! in_array($post_type, rsp_cluster_supported_post_types(), true)) {
    return $content;
  }

  $append = '';

  if ('yes' === rsp_cluster_get_meta($post_id, '_rsp_cluster_show_related_links', 'no')) {
    $append .= rsp_cluster_render_related_links($post_id);
  }

  if ('yes' === rsp_cluster_get_meta($post_id, '_rsp_cluster_show_frontend_faq', 'no')) {
    $append .= rsp_cluster_render_faq_block($post_id);
  }

  return $content . $append;
}
add_filter('the_content', 'rsp_cluster_append_visible_blocks', 20);

/**
 * Shortcode: [rsp_cluster_title]
 *
 * @return string
 */
function rsp_cluster_title_shortcode()
{
  $post_id = get_the_ID();

  if (! $post_id) {
    return '';
  }

  $title = rsp_cluster_get_meta($post_id, '_rsp_cluster_frontend_title');

  if (! $title) {
    return '';
  }

  return '<span class="rsp-cluster-title">' . esc_html($title) . '</span>';
}
add_shortcode('rsp_cluster_title', 'rsp_cluster_title_shortcode');

/**
 * Shortcode: [rsp_cluster_intro]
 *
 * @return string
 */
function rsp_cluster_intro_shortcode()
{
  $post_id = get_the_ID();

  if (! $post_id) {
    return '';
  }

  $intro = rsp_cluster_get_meta($post_id, '_rsp_cluster_frontend_intro');

  if (! $intro) {
    return '';
  }

  return '<div class="rsp-cluster-intro">' . wp_kses_post(wpautop($intro)) . '</div>';
}
add_shortcode('rsp_cluster_intro', 'rsp_cluster_intro_shortcode');

/**
 * Shortcode: [rsp_cluster_links]
 *
 * @return string
 */
function rsp_cluster_links_shortcode()
{
  $post_id = get_the_ID();

  if (! $post_id) {
    return '';
  }

  return rsp_cluster_render_related_links($post_id);
}
add_shortcode('rsp_cluster_links', 'rsp_cluster_links_shortcode');

/**
 * Shortcode: [rsp_cluster_faq]
 *
 * @return string
 */
function rsp_cluster_faq_shortcode()
{
  $post_id = get_the_ID();

  if (! $post_id) {
    return '';
  }

  return rsp_cluster_render_faq_block($post_id);
}
add_shortcode('rsp_cluster_faq', 'rsp_cluster_faq_shortcode');
