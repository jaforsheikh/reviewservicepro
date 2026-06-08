<?php

/**
 * ReviewService.Pro WooCommerce Product Meta Fields
 *
 * File: inc/woocommerce-product-meta.php
 *
 * Purpose:
 * - Add product-specific service fields for ReviewService.Pro WooCommerce products.
 * - Control pricing card content.
 * - Control product details page content.
 * - Do NOT handle SEO, AEO, schema, meta title, meta description, or keyword cluster fields here.
 *
 * SEO/AEO fields are handled separately by:
 * inc/seo-cluster-meta.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Get product meta value with fallback.
 *
 * @param int    $post_id Product ID.
 * @param string $key     Meta key.
 * @param string $default Default value.
 * @return string
 */
function rsp_product_meta_get_value($post_id, $key, $default = '')
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
 * Add ReviewService.Pro service product meta box.
 *
 * @return void
 */
function rsp_add_service_product_meta_box()
{
  add_meta_box(
    'rsp_service_product_meta',
    __('ReviewService.Pro Service Card & Product Details', 'reviewservicepro'),
    'rsp_render_service_product_meta_box',
    'product',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'rsp_add_service_product_meta_box');

/**
 * Render service product meta box.
 *
 * @param WP_Post $post Product post object.
 * @return void
 */
function rsp_render_service_product_meta_box($post)
{
  if (! $post instanceof WP_Post) {
    return;
  }

  wp_nonce_field('rsp_save_service_product_meta', 'rsp_service_product_meta_nonce');

  /**
   * Pricing card fields.
   */
  $card_badge = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_card_badge',
    __('Service Package', 'reviewservicepro')
  );

  $platform_scope = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_platform_scope',
    __('Based on package scope', 'reviewservicepro')
  );

  $best_for = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_best_for',
    __('Businesses that want a focused, ethical reputation service.', 'reviewservicepro')
  );

  $card_deliverables = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_card_deliverables',
    "Clear service scope\nProfessional recommendations\nClient portal access after payment"
  );

  /**
   * Product page fields.
   */
  $service_timeline = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_service_timeline',
    __('Timeline shown after order confirmation', 'reviewservicepro')
  );

  $primary_cta_label = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_cta_label',
    __('Order Now', 'reviewservicepro')
  );

  $secondary_cta_label = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_secondary_cta_label',
    __('Ask Before Ordering', 'reviewservicepro')
  );

  $included_items = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_included_items',
    "Clear service scope and reputation review\nProfessional recommendations based on visible trust signals\nClient portal access after payment"
  );

  $not_included_items = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_not_included',
    "Fake reviews or paid review incentives\nGuaranteed negative review removal\nGuaranteed 5-star ratings or ranking outcomes"
  );

  $onboarding_items = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_onboarding_items',
    "Business name and website URL\nReview platform links you want checked\nMain reputation concern or review issue\nScreenshots or review examples if needed"
  );

  $upgrade_note_title = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_upgrade_note_title',
    __('Upgrade path', 'reviewservicepro')
  );

  $upgrade_note_text = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_upgrade_note_text',
    __('If ongoing monitoring, response management, and reporting are needed, this service can help you decide whether a monthly ORM plan is the right next step.', 'reviewservicepro')
  );

  $related_monthly_note = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_related_monthly_note',
    __('Monthly ORM plans are available on the Services page.', 'reviewservicepro')
  );

  $compliance_note = rsp_product_meta_get_value(
    $post->ID,
    '_rsp_product_compliance_note',
    __('ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on ethical monitoring, response support, documentation, platform-compliant reporting, and transparent reputation improvement.', 'reviewservicepro')
  );
?>

  <style>
    .rsp-product-meta-box {
      display: grid;
      gap: 22px;
      padding: 8px 0;
    }

    .rsp-product-meta-section {
      overflow: hidden;
      border: 1px solid #dbe3ef;
      border-radius: 14px;
      background: #ffffff;
    }

    .rsp-product-meta-section-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 14px;
      border-bottom: 1px solid #e5eaf2;
      background: #f8fafc;
      padding: 14px 16px;
    }

    .rsp-product-meta-section-header h3 {
      margin: 0;
      color: #0f172a;
      font-size: 15px;
      font-weight: 700;
      line-height: 1.4;
    }

    .rsp-product-meta-section-header p {
      margin: 3px 0 0;
      color: #64748b;
      font-size: 12px;
      line-height: 1.5;
    }

    .rsp-product-meta-section-body {
      display: grid;
      gap: 18px;
      padding: 16px;
    }

    .rsp-product-meta-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .rsp-product-meta-field label {
      display: block;
      margin-bottom: 7px;
      color: #111827;
      font-weight: 600;
    }

    .rsp-product-meta-field input[type="text"],
    .rsp-product-meta-field textarea {
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

    .rsp-product-meta-field textarea {
      min-height: 115px;
      resize: vertical;
    }

    .rsp-product-meta-help {
      margin-top: 6px;
      color: #64748b;
      font-size: 13px;
      line-height: 1.5;
    }

    .rsp-product-meta-note {
      border-left: 4px solid #2563eb;
      border-radius: 8px;
      background: #eff6ff;
      padding: 12px 14px;
      color: #334155;
      font-size: 13px;
      line-height: 1.6;
    }

    .rsp-product-meta-warning {
      border-left: 4px solid #f59e0b;
      border-radius: 8px;
      background: #fffbeb;
      padding: 12px 14px;
      color: #78350f;
      font-size: 13px;
      line-height: 1.6;
    }

    @media (max-width: 960px) {
      .rsp-product-meta-grid {
        grid-template-columns: 1fr;
      }

      .rsp-product-meta-section-header {
        display: block;
      }
    }
  </style>

  <div class="rsp-product-meta-box">

    <div class="rsp-product-meta-note">
      <?php esc_html_e('These fields control how this service product appears on the Pricing page and product details page. SEO cluster fields are handled separately in the Safe SEO Cluster System box.', 'reviewservicepro'); ?>
    </div>

    <!-- Pricing Card Fields -->
    <div class="rsp-product-meta-section">
      <div class="rsp-product-meta-section-header">
        <div>
          <h3><?php esc_html_e('1. Pricing Card Fields', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Shown on the Pricing page product cards.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-product-meta-section-body">
        <div class="rsp-product-meta-grid">
          <div class="rsp-product-meta-field">
            <label for="rsp_card_badge">
              <?php esc_html_e('Card badge', 'reviewservicepro'); ?>
            </label>

            <input
              type="text"
              id="rsp_card_badge"
              name="rsp_card_badge"
              value="<?php echo esc_attr($card_badge); ?>"
              placeholder="<?php esc_attr_e('Example: One-Time Package', 'reviewservicepro'); ?>">

            <p class="rsp-product-meta-help">
              <?php esc_html_e('Small badge label for this product card.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="rsp-product-meta-field">
            <label for="rsp_platform_scope">
              <?php esc_html_e('Platform scope', 'reviewservicepro'); ?>
            </label>

            <input
              type="text"
              id="rsp_platform_scope"
              name="rsp_platform_scope"
              value="<?php echo esc_attr($platform_scope); ?>"
              placeholder="<?php esc_attr_e('Example: 1 primary platform', 'reviewservicepro'); ?>">

            <p class="rsp-product-meta-help">
              <?php esc_html_e('Shown as the small scope badge on pricing cards and product page.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>

        <div class="rsp-product-meta-field">
          <label for="rsp_best_for">
            <?php esc_html_e('Best for', 'reviewservicepro'); ?>
          </label>

          <input
            type="text"
            id="rsp_best_for"
            name="rsp_best_for"
            value="<?php echo esc_attr($best_for); ?>"
            placeholder="<?php esc_attr_e('Example: Businesses that want a clear reputation starting point.', 'reviewservicepro'); ?>">

          <p class="rsp-product-meta-help">
            <?php esc_html_e('Shown inside the pricing card under “Best for”. Keep it one short sentence.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rsp-product-meta-field">
          <label for="rsp_card_deliverables">
            <?php esc_html_e('Card deliverables', 'reviewservicepro'); ?>
          </label>

          <textarea
            id="rsp_card_deliverables"
            name="rsp_card_deliverables"
            placeholder="<?php esc_attr_e('Write one deliverable per line. Pricing card will show the first 3.', 'reviewservicepro'); ?>"><?php echo esc_textarea($card_deliverables); ?></textarea>

          <p class="rsp-product-meta-help">
            <?php esc_html_e('Write one deliverable per line. The pricing card displays maximum 3 deliverables.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </div>

    <!-- Product Page Functionality -->
    <div class="rsp-product-meta-section">
      <div class="rsp-product-meta-section-header">
        <div>
          <h3><?php esc_html_e('2. Product Page Functionality', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Shown on the single product details page.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-product-meta-section-body">
        <div class="rsp-product-meta-grid">
          <div class="rsp-product-meta-field">
            <label for="rsp_service_timeline">
              <?php esc_html_e('Service timeline', 'reviewservicepro'); ?>
            </label>

            <input
              type="text"
              id="rsp_service_timeline"
              name="rsp_service_timeline"
              value="<?php echo esc_attr($service_timeline); ?>"
              placeholder="<?php esc_attr_e('Example: 2–4 business days after onboarding', 'reviewservicepro'); ?>">
          </div>

          <div class="rsp-product-meta-field">
            <label for="rsp_cta_label">
              <?php esc_html_e('Primary CTA label', 'reviewservicepro'); ?>
            </label>

            <input
              type="text"
              id="rsp_cta_label"
              name="rsp_cta_label"
              value="<?php echo esc_attr($primary_cta_label); ?>"
              placeholder="<?php esc_attr_e('Example: Order Now', 'reviewservicepro'); ?>">
          </div>
        </div>

        <div class="rsp-product-meta-field">
          <label for="rsp_secondary_cta_label">
            <?php esc_html_e('Secondary CTA label', 'reviewservicepro'); ?>
          </label>

          <input
            type="text"
            id="rsp_secondary_cta_label"
            name="rsp_secondary_cta_label"
            value="<?php echo esc_attr($secondary_cta_label); ?>"
            placeholder="<?php esc_attr_e('Example: Ask Before Ordering', 'reviewservicepro'); ?>">
        </div>

        <div class="rsp-product-meta-field">
          <label for="rsp_included_items">
            <?php esc_html_e('What’s included items', 'reviewservicepro'); ?>
          </label>

          <textarea
            id="rsp_included_items"
            name="rsp_included_items"
            placeholder="<?php esc_attr_e('Write one included item per line.', 'reviewservicepro'); ?>"><?php echo esc_textarea($included_items); ?></textarea>

          <p class="rsp-product-meta-help">
            <?php esc_html_e('Shown in the “What’s included” section on the product page.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rsp-product-meta-grid">
          <div class="rsp-product-meta-field">
            <label for="rsp_not_included">
              <?php esc_html_e('Not included items', 'reviewservicepro'); ?>
            </label>

            <textarea
              id="rsp_not_included"
              name="rsp_not_included"
              placeholder="<?php esc_attr_e('Write one not-included item per line.', 'reviewservicepro'); ?>"><?php echo esc_textarea($not_included_items); ?></textarea>

            <p class="rsp-product-meta-help">
              <?php esc_html_e('Shown in the “Not included” section on the product page.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="rsp-product-meta-field">
            <label for="rsp_onboarding_items">
              <?php esc_html_e('After payment / onboarding items', 'reviewservicepro'); ?>
            </label>

            <textarea
              id="rsp_onboarding_items"
              name="rsp_onboarding_items"
              placeholder="<?php esc_attr_e('Write one onboarding item per line.', 'reviewservicepro'); ?>"><?php echo esc_textarea($onboarding_items); ?></textarea>

            <p class="rsp-product-meta-help">
              <?php esc_html_e('Shown in the “After Payment / Onboarding” section on the product page.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Conversion Notes -->
    <div class="rsp-product-meta-section">
      <div class="rsp-product-meta-section-header">
        <div>
          <h3><?php esc_html_e('3. Conversion Notes & Compliance', 'reviewservicepro'); ?></h3>
          <p><?php esc_html_e('Shown as safe guidance blocks on the product page.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-product-meta-section-body">
        <div class="rsp-product-meta-grid">
          <div class="rsp-product-meta-field">
            <label for="rsp_upgrade_note_title">
              <?php esc_html_e('Upgrade note title', 'reviewservicepro'); ?>
            </label>

            <input
              type="text"
              id="rsp_upgrade_note_title"
              name="rsp_upgrade_note_title"
              value="<?php echo esc_attr($upgrade_note_title); ?>"
              placeholder="<?php esc_attr_e('Example: Upgrade path', 'reviewservicepro'); ?>">
          </div>

          <div class="rsp-product-meta-field">
            <label for="rsp_related_monthly_note">
              <?php esc_html_e('Related monthly note', 'reviewservicepro'); ?>
            </label>

            <input
              type="text"
              id="rsp_related_monthly_note"
              name="rsp_related_monthly_note"
              value="<?php echo esc_attr($related_monthly_note); ?>"
              placeholder="<?php esc_attr_e('Example: Monthly ORM plans are available on the Services page.', 'reviewservicepro'); ?>">
          </div>
        </div>

        <div class="rsp-product-meta-field">
          <label for="rsp_upgrade_note_text">
            <?php esc_html_e('Upgrade note text', 'reviewservicepro'); ?>
          </label>

          <textarea
            id="rsp_upgrade_note_text"
            name="rsp_upgrade_note_text"
            placeholder="<?php esc_attr_e('Short explanation for upgrade path.', 'reviewservicepro'); ?>"><?php echo esc_textarea($upgrade_note_text); ?></textarea>
        </div>

        <div class="rsp-product-meta-warning">
          <?php esc_html_e('Keep compliance wording safe. Do not promise fake reviews, paid incentives, guaranteed removals, guaranteed 5-star ratings, or guaranteed ranking outcomes.', 'reviewservicepro'); ?>
        </div>

        <div class="rsp-product-meta-field">
          <label for="rsp_product_compliance_note">
            <?php esc_html_e('Product compliance note', 'reviewservicepro'); ?>
          </label>

          <textarea
            id="rsp_product_compliance_note"
            name="rsp_product_compliance_note"
            placeholder="<?php esc_attr_e('Compliance-safe note shown on product page.', 'reviewservicepro'); ?>"><?php echo esc_textarea($compliance_note); ?></textarea>
        </div>
      </div>
    </div>

  </div>

<?php
}

/**
 * Save service product meta fields.
 *
 * @param int $post_id Product post ID.
 * @return void
 */
function rsp_save_service_product_meta($post_id)
{
  $post_id = absint($post_id);

  if (! $post_id) {
    return;
  }

  if (! isset($_POST['rsp_service_product_meta_nonce'])) {
    return;
  }

  $nonce = sanitize_text_field(wp_unslash($_POST['rsp_service_product_meta_nonce']));

  if (! wp_verify_nonce($nonce, 'rsp_save_service_product_meta')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if ('product' !== get_post_type($post_id)) {
    return;
  }

  if (! current_user_can('edit_post', $post_id)) {
    return;
  }

  $text_fields = [
    '_rsp_card_badge'          => 'rsp_card_badge',
    '_rsp_platform_scope'      => 'rsp_platform_scope',
    '_rsp_best_for'            => 'rsp_best_for',
    '_rsp_service_timeline'    => 'rsp_service_timeline',
    '_rsp_cta_label'           => 'rsp_cta_label',
    '_rsp_secondary_cta_label' => 'rsp_secondary_cta_label',
    '_rsp_upgrade_note_title'  => 'rsp_upgrade_note_title',
    '_rsp_related_monthly_note' => 'rsp_related_monthly_note',
  ];

  foreach ($text_fields as $meta_key => $post_key) {
    if (isset($_POST[$post_key])) {
      update_post_meta(
        $post_id,
        $meta_key,
        sanitize_text_field(wp_unslash($_POST[$post_key]))
      );
    }
  }

  $textarea_fields = [
    '_rsp_card_deliverables'       => 'rsp_card_deliverables',
    '_rsp_included_items'          => 'rsp_included_items',
    '_rsp_not_included'            => 'rsp_not_included',
    '_rsp_onboarding_items'        => 'rsp_onboarding_items',
    '_rsp_upgrade_note_text'       => 'rsp_upgrade_note_text',
    '_rsp_product_compliance_note' => 'rsp_product_compliance_note',
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
}
add_action('save_post_product', 'rsp_save_service_product_meta');
