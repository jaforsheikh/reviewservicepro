<?php

/**
 * Edit account form
 *
 * File: woocommerce/myaccount/form-edit-account.php
 *
 * ReviewService.Pro custom WooCommerce edit account page.
 *
 * Purpose:
 * - Premium client portal account settings UI.
 * - Preserve WooCommerce account update hooks, nonce, and save action.
 * - Keep spacing, negative space, field height, and responsive layout clean.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form');

$user = wp_get_current_user();

$dashboard_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$support_url   = home_url('/contact/?type=account-support');

?>

<style>
  .rsp-edit-account {
    color: #ffffff;
  }

  .rsp-edit-account-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-edit-account-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-edit-account-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-edit-account-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-edit-x, 50%) var(--rsp-edit-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-edit-x, 50%) var(--rsp-edit-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-edit-account-card:hover::before {
    opacity: 1;
  }

  .rsp-edit-account-beam {
    animation: rspEditAccountBeam 8s ease-in-out infinite;
  }

  @keyframes rspEditAccountBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-edit-account .woocommerce-Input,
  .rsp-edit-account input[type="text"],
  .rsp-edit-account input[type="email"],
  .rsp-edit-account input[type="password"] {
    min-height: 56px;
    width: 100%;
    border: 1px solid rgba(148, 163, 184, 0.42);
    border-radius: 14px;
    background: #ffffff;
    color: #020617;
    padding: 14px 16px;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.45;
    outline: none;
    box-shadow: none;
    transition:
      border-color 180ms ease,
      box-shadow 180ms ease;
  }

  .rsp-edit-account .woocommerce-Input:focus,
  .rsp-edit-account input[type="text"]:focus,
  .rsp-edit-account input[type="email"]:focus,
  .rsp-edit-account input[type="password"]:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-edit-account label {
    display: block;
    margin-bottom: 9px;
    color: #ffffff;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.45;
  }

  .rsp-edit-account .required {
    color: #EF4444;
    text-decoration: none;
  }

  .rsp-edit-account .woocommerce-form-row {
    margin: 0;
    padding: 0;
  }

  .rsp-edit-account em {
    display: block;
    margin-top: 8px;
    color: rgb(148 163 184);
    font-size: 13px;
    font-style: normal;
    line-height: 1.6;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-edit-account-reveal,
    .rsp-edit-account-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-edit-account relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-edit-account-card rsp-edit-account-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-account-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-edit-account-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="user-cog" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Account Settings', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Manage your client account details.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Keep your name, display name, email address, and password up to date so your ReviewService.Pro service communication stays accurate and secure.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($dashboard_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Back to Portal', 'reviewservicepro'); ?>
            <i data-lucide="layout-dashboard" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-5 py-3 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Need Help?', 'reviewservicepro'); ?>
            <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Form -->
    <form
      class="woocommerce-EditAccountForm edit-account mt-8"
      action=""
      method="post"
      <?php do_action('woocommerce_edit_account_form_tag'); ?>>

      <?php do_action('woocommerce_edit_account_form_start'); ?>

      <section class="grid grid-cols-1 gap-8 xl:grid-cols-[1.05fr_0.95fr]">

        <!-- Profile details -->
        <article class="rsp-edit-account-card rsp-edit-account-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-account-card>
          <div class="relative z-10">
            <div class="mb-8">
              <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
                <i data-lucide="user-round" class="h-6 w-6" aria-hidden="true"></i>
              </span>

              <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
                <?php esc_html_e('Profile information', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-3 text-base font-normal leading-8 text-slate-300">
                <?php esc_html_e('This information helps us identify your service orders and communicate with the right account owner.', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                <label for="account_first_name">
                  <?php esc_html_e('First name', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="account_first_name"
                  id="account_first_name"
                  autocomplete="given-name"
                  value="<?php echo esc_attr($user->first_name); ?>">
              </p>

              <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                <label for="account_last_name">
                  <?php esc_html_e('Last name', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="account_last_name"
                  id="account_last_name"
                  autocomplete="family-name"
                  value="<?php echo esc_attr($user->last_name); ?>">
              </p>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6">
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="account_display_name">
                  <?php esc_html_e('Display name', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="account_display_name"
                  id="account_display_name"
                  value="<?php echo esc_attr($user->display_name); ?>">

                <em>
                  <?php esc_html_e('This will be how your name appears in your account area and service communication.', 'reviewservicepro'); ?>
                </em>
              </p>

              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="account_email">
                  <?php esc_html_e('Email address', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="email"
                  class="woocommerce-Input woocommerce-Input--email input-text"
                  name="account_email"
                  id="account_email"
                  autocomplete="email"
                  value="<?php echo esc_attr($user->user_email); ?>">
              </p>
            </div>
          </div>
        </article>

        <!-- Password -->
        <article class="rsp-edit-account-card rsp-edit-account-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-account-card style="transition-delay: 90ms;">
          <div class="relative z-10">
            <div class="mb-8">
              <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
                <i data-lucide="lock-keyhole" class="h-6 w-6" aria-hidden="true"></i>
              </span>

              <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
                <?php esc_html_e('Password security', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-3 text-base font-normal leading-8 text-slate-300">
                <?php esc_html_e('Leave these fields blank if you do not want to change your password.', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="grid grid-cols-1 gap-6">
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_current">
                  <?php esc_html_e('Current password', 'reviewservicepro'); ?>
                </label>

                <input
                  type="password"
                  class="woocommerce-Input woocommerce-Input--password input-text"
                  name="password_current"
                  id="password_current"
                  autocomplete="off">
              </p>

              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_1">
                  <?php esc_html_e('New password', 'reviewservicepro'); ?>
                </label>

                <input
                  type="password"
                  class="woocommerce-Input woocommerce-Input--password input-text"
                  name="password_1"
                  id="password_1"
                  autocomplete="off">
              </p>

              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password_2">
                  <?php esc_html_e('Confirm new password', 'reviewservicepro'); ?>
                </label>

                <input
                  type="password"
                  class="woocommerce-Input woocommerce-Input--password input-text"
                  name="password_2"
                  id="password_2"
                  autocomplete="off">
              </p>
            </div>

            <div class="mt-8 rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-5">
              <div class="flex gap-3">
                <i data-lucide="shield-alert" class="mt-0.5 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

                <p class="text-sm font-normal leading-7 text-slate-300">
                  <?php esc_html_e('For account security, use a strong password and avoid sharing your login details with others. Your service orders and support communication stay inside your client account.', 'reviewservicepro'); ?>
                </p>
              </div>
            </div>
          </div>
        </article>

      </section>

      <!-- Extra WooCommerce hook content -->
      <div class="mt-8">
        <?php do_action('woocommerce_edit_account_form'); ?>
      </div>

      <!-- Submit -->
      <section class="rsp-edit-account-card rsp-edit-account-reveal mt-8 rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl md:p-8 lg:p-10" data-rsp-edit-account-card>
        <div class="relative z-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_auto] lg:items-center">
          <div>
            <h2 class="text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Save your account updates.', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 max-w-3xl text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('After saving, your updated details will be used for client portal access, order communication, and service support.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div>
            <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>

            <button
              type="submit"
              class="woocommerce-Button button inline-flex min-h-[56px] items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700"
              name="save_account_details"
              value="<?php esc_attr_e('Save changes', 'reviewservicepro'); ?>">

              <?php esc_html_e('Save Changes', 'reviewservicepro'); ?>
              <i data-lucide="save" class="h-4 w-4" aria-hidden="true"></i>
            </button>

            <input type="hidden" name="action" value="save_account_details">
          </div>
        </div>
      </section>

      <?php do_action('woocommerce_edit_account_form_end'); ?>

    </form>

  </div>
</section>

<script>
  (function() {
    function initRspEditAccountPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-edit-account-reveal');

      if ('IntersectionObserver' in window && revealItems.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('rsp-is-visible');
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        revealItems.forEach(function(item) {
          observer.observe(item);
        });
      } else {
        revealItems.forEach(function(item) {
          item.classList.add('rsp-is-visible');
        });
      }

      var cards = document.querySelectorAll('[data-rsp-edit-account-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-edit-x', x + '%');
          card.style.setProperty('--rsp-edit-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspEditAccountPage);
    } else {
      initRspEditAccountPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_edit_account_form'); ?>