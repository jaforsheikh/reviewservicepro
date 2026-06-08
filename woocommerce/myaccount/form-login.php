<?php

/**
 * Login Form
 *
 * File: woocommerce/myaccount/form-login.php
 *
 * ReviewService.Pro custom WooCommerce login/register page.
 *
 * Purpose:
 * - Premium client portal login/register UI.
 * - Preserve WooCommerce login/register hooks, nonce, validation, and account creation.
 * - Keep strong spacing, comfortable form fields, and responsive layout.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_customer_login_form');

$registration_enabled = 'yes' === get_option('woocommerce_enable_myaccount_registration');
$generate_username    = 'yes' === get_option('woocommerce_registration_generate_username');
$generate_password    = 'yes' === get_option('woocommerce_registration_generate_password');

$pricing_url = home_url('/pricing/');
$support_url = home_url('/contact/?type=account-help');
?>

<style>
  .rsp-auth-page {
    color: #ffffff;
  }

  .rsp-auth-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-auth-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-auth-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-auth-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-auth-x, 50%) var(--rsp-auth-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-auth-x, 50%) var(--rsp-auth-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-auth-card:hover::before {
    opacity: 1;
  }

  .rsp-auth-beam {
    animation: rspAuthBeam 8s ease-in-out infinite;
  }

  @keyframes rspAuthBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-auth-page label {
    display: block;
    margin-bottom: 9px;
    color: #ffffff;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.45;
  }

  .rsp-auth-page .required {
    color: #EF4444;
    text-decoration: none;
  }

  .rsp-auth-page .woocommerce-form-row,
  .rsp-auth-page .form-row {
    margin: 0;
    padding: 0;
  }

  .rsp-auth-page input.input-text,
  .rsp-auth-page input[type="text"],
  .rsp-auth-page input[type="email"],
  .rsp-auth-page input[type="password"] {
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
    box-sizing: border-box;
    transition:
      border-color 180ms ease,
      box-shadow 180ms ease;
  }

  .rsp-auth-page input.input-text:focus,
  .rsp-auth-page input[type="text"]:focus,
  .rsp-auth-page input[type="email"]:focus,
  .rsp-auth-page input[type="password"]:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-auth-page .woocommerce-form__label-for-checkbox {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    margin: 0;
    color: rgb(203 213 225);
    font-size: 14px;
    line-height: 1.6;
  }

  .rsp-auth-page input[type="checkbox"] {
    height: 16px;
    width: 16px;
    accent-color: #2563EB;
  }

  .rsp-auth-page .woocommerce-LostPassword a,
  .rsp-auth-page a {
    color: #60A5FA;
    text-decoration: none;
    transition: color 180ms ease;
  }

  .rsp-auth-page .woocommerce-LostPassword a:hover,
  .rsp-auth-page a:hover {
    color: #93C5FD;
  }

  .rsp-auth-page .woocommerce-privacy-policy-text {
    margin-top: 20px;
    color: rgb(203 213 225);
    font-size: 14px;
    line-height: 1.8;
  }

  .rsp-auth-page .woocommerce-privacy-policy-text p {
    margin: 0;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-auth-reveal,
    .rsp-auth-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-auth-page relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-auth-card rsp-auth-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-auth-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-auth-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Secure Client Portal', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Access your ReviewService.Pro client portal.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Log in to view service orders, onboarding details, billing information, and reputation management support from your secure account.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('View Packages', 'reviewservicepro'); ?>
            <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
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

    <!-- Trust Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-auth-card rsp-auth-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-auth-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="lock-keyhole" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Secure access', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Your orders, account details, and service communication are protected inside your client account.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-auth-card rsp-auth-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-auth-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="layout-dashboard" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Service portal', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Track reputation service orders, onboarding expectations, and support options from one place.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-auth-card rsp-auth-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-auth-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="shield-alert" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Ethical ORM only', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('No fake reviews, paid incentives, rating manipulation, guaranteed removals, or ranking guarantees.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <!-- Forms -->
    <section class="mt-8 grid grid-cols-1 gap-8 <?php echo $registration_enabled ? 'xl:grid-cols-2' : 'xl:grid-cols-[0.9fr_1.1fr]'; ?>">

      <!-- Login -->
      <article class="rsp-auth-card rsp-auth-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-auth-card>
        <div class="relative z-10">
          <div class="mb-8">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
              <i data-lucide="log-in" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Login to your portal', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Use your account email or username to access your client dashboard and service orders.', 'reviewservicepro'); ?>
            </p>
          </div>

          <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <div class="grid grid-cols-1 gap-6">
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username">
                  <?php esc_html_e('Username or email address', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="text"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="username"
                  id="username"
                  autocomplete="username"
                  value="<?php echo ! empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>">
              </p>

              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password">
                  <?php esc_html_e('Password', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  type="password"
                  name="password"
                  id="password"
                  autocomplete="current-password">
              </p>
            </div>

            <?php do_action('woocommerce_login_form'); ?>

            <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
              <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                <input
                  class="woocommerce-form__input woocommerce-form__input-checkbox"
                  name="rememberme"
                  type="checkbox"
                  id="rememberme"
                  value="forever">
                <span><?php esc_html_e('Remember me', 'reviewservicepro'); ?></span>
              </label>

              <p class="woocommerce-LostPassword lost_password text-sm">
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">
                  <?php esc_html_e('Lost your password?', 'reviewservicepro'); ?>
                </a>
              </p>
            </div>

            <div class="mt-8">
              <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

              <button
                type="submit"
                class="woocommerce-button button woocommerce-form-login__submit inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700"
                name="login"
                value="<?php esc_attr_e('Log in', 'reviewservicepro'); ?>">

                <?php esc_html_e('Log In', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </button>
            </div>

            <?php do_action('woocommerce_login_form_end'); ?>

          </form>
        </div>
      </article>

      <?php if ($registration_enabled) : ?>

        <!-- Register -->
        <article class="rsp-auth-card rsp-auth-reveal rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-auth-card style="transition-delay: 90ms;">
          <div class="relative z-10">
            <div class="mb-8">
              <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
                <i data-lucide="user-plus" class="h-6 w-6" aria-hidden="true"></i>
              </span>

              <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
                <?php esc_html_e('Create a client account', 'reviewservicepro'); ?>
              </h2>

              <p class="mt-3 text-base font-normal leading-8 text-slate-300">
                <?php esc_html_e('Create an account to manage service orders, billing details, and future onboarding information.', 'reviewservicepro'); ?>
              </p>
            </div>

            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>

              <?php do_action('woocommerce_register_form_start'); ?>

              <div class="grid grid-cols-1 gap-6">
                <?php if (! $generate_username) : ?>
                  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_username">
                      <?php esc_html_e('Username', 'reviewservicepro'); ?>
                      <span class="required">*</span>
                    </label>

                    <input
                      type="text"
                      class="woocommerce-Input woocommerce-Input--text input-text"
                      name="username"
                      id="reg_username"
                      autocomplete="username"
                      value="<?php echo ! empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>">
                  </p>
                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                  <label for="reg_email">
                    <?php esc_html_e('Email address', 'reviewservicepro'); ?>
                    <span class="required">*</span>
                  </label>

                  <input
                    type="email"
                    class="woocommerce-Input woocommerce-Input--text input-text"
                    name="email"
                    id="reg_email"
                    autocomplete="email"
                    value="<?php echo ! empty($_POST['email']) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>">
                </p>

                <?php if (! $generate_password) : ?>
                  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_password">
                      <?php esc_html_e('Password', 'reviewservicepro'); ?>
                      <span class="required">*</span>
                    </label>

                    <input
                      type="password"
                      class="woocommerce-Input woocommerce-Input--text input-text"
                      name="password"
                      id="reg_password"
                      autocomplete="new-password">
                  </p>
                <?php else : ?>
                  <div class="rounded-2xl border border-blue-400/20 bg-blue-500/[0.08] p-5">
                    <div class="flex gap-3">
                      <i data-lucide="mail-check" class="mt-0.5 h-5 w-5 shrink-0 text-blue-200" aria-hidden="true"></i>

                      <p class="text-sm font-normal leading-7 text-slate-300">
                        <?php esc_html_e('A password setup link will be sent to your email address after registration.', 'reviewservicepro'); ?>
                      </p>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <?php do_action('woocommerce_register_form'); ?>

              <div class="mt-6 rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-5">
                <div class="flex gap-3">
                  <i data-lucide="shield-alert" class="mt-0.5 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

                  <p class="text-sm font-normal leading-7 text-slate-300">
                    <?php esc_html_e('Your account is for ethical reputation management services only. We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed removals, or ranking guarantees.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>

              <div class="mt-6">
                <?php wc_get_template('checkout/terms.php'); ?>
              </div>

              <div class="mt-8">
                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

                <button
                  type="submit"
                  class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-xl bg-[#00C853] px-7 py-4 text-base font-semibold text-[#07111F] shadow-lg shadow-[#00C853]/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#00E676]"
                  name="register"
                  value="<?php esc_attr_e('Register', 'reviewservicepro'); ?>">

                  <?php esc_html_e('Create Account', 'reviewservicepro'); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </button>
              </div>

              <?php do_action('woocommerce_register_form_end'); ?>

            </form>
          </div>
        </article>

      <?php else : ?>

        <!-- Registration disabled info -->
        <article class="rsp-auth-card rsp-auth-reveal rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-auth-card style="transition-delay: 90ms;">
          <div class="relative z-10">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
              <i data-lucide="user-check" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('New client account access', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-4 text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('If you recently placed an order, your account access may be created during checkout. Need help accessing your portal? Contact support and include your order email.', 'reviewservicepro'); ?>
            </p>

            <a
              href="<?php echo esc_url($support_url); ?>"
              class="mt-8 inline-flex items-center justify-center gap-2 rounded-xl bg-[#00C853] px-6 py-3.5 text-base font-semibold text-[#07111F] shadow-lg shadow-[#00C853]/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#00E676]">

              <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
              <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </article>

      <?php endif; ?>

    </section>

  </div>
</section>

<script>
  (function() {
    function initRspAuthPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-auth-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-auth-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-auth-x', x + '%');
          card.style.setProperty('--rsp-auth-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspAuthPage);
    } else {
      initRspAuthPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_customer_login_form'); ?>