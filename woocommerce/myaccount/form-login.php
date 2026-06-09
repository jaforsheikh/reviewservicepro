<?php

/**
 * Login Form
 *
 * ReviewService.Pro — Compact WooCommerce login/register form
 *
 * File: woocommerce/myaccount/form-login.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_customer_login_form');

$registration_enabled = 'yes' === get_option('woocommerce_enable_myaccount_registration');
$generate_username    = 'yes' === get_option('woocommerce_registration_generate_username');
$generate_password    = 'yes' === get_option('woocommerce_registration_generate_password');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$grid_class = $registration_enabled ? 'lg:grid-cols-2' : 'lg:grid-cols-[minmax(0,620px)] lg:justify-center';
?>

<section class="rsp-auth-endpoint">
  <div class="mb-6 text-center">
    <span class="rsp-eyebrow">
      <?php echo $render_icon('lock-keyhole', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
      ?>
      <?php esc_html_e('Secure Client Access', 'reviewservicepro'); ?>
    </span>

    <h2 class="rsp-endpoint-title mx-auto mt-3">
      <?php esc_html_e('Access your client portal', 'reviewservicepro'); ?>
    </h2>

    <p class="rsp-endpoint-subtitle mx-auto mt-3">
      <?php esc_html_e('Sign in to manage your orders, reputation service records, billing details, and client account settings.', 'reviewservicepro'); ?>
    </p>
  </div>

  <div class="grid grid-cols-1 gap-5 <?php echo esc_attr($grid_class); ?>">
    <div class="rsp-card p-5 md:p-6">
      <h3 class="rsp-account-heading mb-4 text-[24px] font-[800] leading-tight">
        <?php esc_html_e('Login', 'woocommerce'); ?>
      </h3>

      <form class="woocommerce-form woocommerce-form-login login" method="post">
        <?php do_action('woocommerce_login_form_start'); ?>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
          <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
        </p>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
          <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
        </p>

        <?php do_action('woocommerce_login_form'); ?>

        <div class="mt-4 flex flex-col gap-3">
          <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme inline-flex items-center gap-2 !mb-0 text-[14px] font-[700] text-[#64748B]">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
            <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
          </label>

          <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

          <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php echo $render_icon('log-in', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Log in', 'woocommerce'); ?>
            </span>
          </button>
        </div>

        <p class="woocommerce-LostPassword lost_password mt-4">
          <a class="text-[14px] font-[800] text-blue-700 hover:underline" href="<?php echo esc_url(wp_lostpassword_url()); ?>">
            <?php esc_html_e('Lost your password?', 'woocommerce'); ?>
          </a>
        </p>

        <?php do_action('woocommerce_login_form_end'); ?>
      </form>
    </div>

    <?php if ($registration_enabled) : ?>
      <div class="rsp-card p-5 md:p-6">
        <h3 class="rsp-account-heading mb-4 text-[24px] font-[800] leading-tight">
          <?php esc_html_e('Register', 'woocommerce'); ?>
        </h3>

        <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
          <?php do_action('woocommerce_register_form_start'); ?>

          <?php if (! $generate_username) : ?>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
              <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
            </p>
          <?php endif; ?>

          <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (! empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
          </p>

          <?php if (! $generate_password) : ?>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
              <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
              <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
            </p>
          <?php else : ?>
            <p class="text-[15px] leading-7 text-[#64748B]">
              <?php esc_html_e('A password setup link will be sent to your email address.', 'woocommerce'); ?>
            </p>
          <?php endif; ?>

          <?php do_action('woocommerce_register_form'); ?>

          <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

          <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit mt-4" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php echo $render_icon('user-plus', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Register', 'woocommerce'); ?>
            </span>
          </button>

          <?php do_action('woocommerce_register_form_end'); ?>
        </form>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php do_action('woocommerce_after_customer_login_form'); ?>