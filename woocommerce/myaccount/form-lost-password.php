<?php

/**
 * Lost Password Form
 *
 * ReviewService.Pro — Compact password reset request
 *
 * File: woocommerce/myaccount/form-lost-password.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');

$login_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-lost-password-endpoint">
  <div class="mx-auto max-w-2xl">
    <div class="mb-6 text-center">
      <span class="rsp-eyebrow">
        <?php echo $render_icon('key-round', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Password Recovery', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mx-auto mt-3">
        <?php esc_html_e('Reset your password', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mx-auto mt-3">
        <?php esc_html_e('Enter your username or email address. You will receive a secure link to create a new password.', 'woocommerce'); ?>
      </p>
    </div>

    <form method="post" class="woocommerce-ResetPassword lost_reset_password rsp-card p-5 md:p-6">
      <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="user_login"><?php esc_html_e('Username or email', 'woocommerce'); ?></label>
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
      </p>

      <div class="clear"></div>

      <?php do_action('woocommerce_lostpassword_form'); ?>

      <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <input type="hidden" name="wc_reset_password" value="true" />
        <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

        <button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php echo $render_icon('send', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Reset password', 'woocommerce'); ?>
          </span>
        </button>

        <a class="rsp-btn rsp-btn-secondary" href="<?php echo esc_url($login_url); ?>">
          <?php echo $render_icon('arrow-left', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Back to login', 'reviewservicepro'); ?>
        </a>
      </div>
    </form>
  </div>
</section>

<?php do_action('woocommerce_after_lost_password_form'); ?>