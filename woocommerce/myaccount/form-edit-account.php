<?php

/**
 * Edit account form
 *
 * ReviewService.Pro — Compact client portal account settings
 *
 * File: woocommerce/myaccount/form-edit-account.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form');

$user = wp_get_current_user();

$support_url = home_url('/contact/?type=account-support');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section class="rsp-edit-account-endpoint">
  <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <span class="rsp-eyebrow">
        <?php echo $render_icon('user-cog', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Account Settings', 'reviewservicepro'); ?>
      </span>

      <h2 class="rsp-endpoint-title mt-3">
        <?php esc_html_e('Profile and login details', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-endpoint-subtitle mt-3">
        <?php esc_html_e('Update your client profile, email address, display name, and password information used for your ReviewService.Pro client portal.', 'reviewservicepro'); ?>
      </p>
    </div>

    <a href="<?php echo esc_url($support_url); ?>" class="rsp-btn rsp-btn-secondary">
      <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
      ?>
      <?php esc_html_e('Account Support', 'reviewservicepro'); ?>
    </a>
  </div>

  <form class="woocommerce-EditAccountForm edit-account rsp-card p-5 md:p-6" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>
    <?php do_action('woocommerce_edit_account_form_start'); ?>

    <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2">
      <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="account_first_name"><?php esc_html_e('First name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
        <label for="account_last_name"><?php esc_html_e('Last name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
      </p>
    </div>

    <div class="clear"></div>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label for="account_display_name"><?php esc_html_e('Display name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
      <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" />
      <span class="mt-2 block text-[13px] leading-6 text-[#64748B]">
        <?php esc_html_e('This will be how your name appears in the client portal and account area.', 'reviewservicepro'); ?>
      </span>
    </p>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
      <label for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
      <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
    </p>

    <div class="mt-6 rounded-[20px] border border-slate-200 bg-[#F8FAFC] p-5">
      <div class="mb-5">
        <h3 class="rsp-account-heading text-[22px] font-[800] leading-tight">
          <?php esc_html_e('Password update', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-account-text mt-2">
          <?php esc_html_e('Leave these fields blank if you do not want to change your current password.', 'reviewservicepro'); ?>
        </p>
      </div>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_current"><?php esc_html_e('Current password', 'woocommerce'); ?></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
      </p>

      <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2">
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="password_1"><?php esc_html_e('New password', 'woocommerce'); ?></label>
          <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
        </p>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
          <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
        </p>
      </div>
    </div>

    <?php do_action('woocommerce_edit_account_form'); ?>

    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
      <input type="hidden" name="action" value="save_account_details" />

      <button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>">
        <span class="relative z-10 inline-flex items-center gap-2">
          <?php echo $render_icon('save', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Save changes', 'woocommerce'); ?>
        </span>
      </button>
    </div>

    <?php do_action('woocommerce_edit_account_form_end'); ?>
  </form>
</section>

<?php do_action('woocommerce_after_edit_account_form'); ?>