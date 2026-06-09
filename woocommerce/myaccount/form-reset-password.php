<?php

/**
 * Reset Password Form
 *
 * ReviewService.Pro — Compact new password form
 *
 * File: woocommerce/myaccount/form-reset-password.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_reset_password_form');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-reset-password-endpoint">
  <div class="mx-auto max-w-2xl">
    <div class="mb-6 text-center">
      <span class="rsp-eyebrow">
        <?php echo $render_icon('lock-keyhole', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Secure Reset', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mx-auto mt-3">
        <?php esc_html_e('Create a new password', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mx-auto mt-3">
        <?php esc_html_e('Choose a strong password to protect your client portal access.', 'reviewservicepro'); ?>
      </p>
    </div>

    <form method="post" class="woocommerce-ResetPassword reset_password rsp-card p-5 md:p-6">
      <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="password_1"><?php esc_html_e('New password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="new-password" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
        <label for="password_2"><?php esc_html_e('Re-enter new password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="new-password" />
      </p>

      <input type="hidden" name="reset_key" value="<?php echo esc_attr($args['key']); ?>" />
      <input type="hidden" name="reset_login" value="<?php echo esc_attr($args['login']); ?>" />

      <?php do_action('woocommerce_resetpassword_form'); ?>

      <div class="clear"></div>

      <?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

      <button type="submit" class="woocommerce-Button button mt-4" value="<?php esc_attr_e('Save', 'woocommerce'); ?>">
        <span class="relative z-10 inline-flex items-center gap-2">
          <?php echo $render_icon('save', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Save', 'woocommerce'); ?>
        </span>
      </button>
    </form>
  </div>
</section>

<?php do_action('woocommerce_after_reset_password_form'); ?>