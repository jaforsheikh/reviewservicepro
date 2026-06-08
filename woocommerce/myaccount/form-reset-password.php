<?php

/**
 * Reset Password Form
 *
 * File: woocommerce/myaccount/form-reset-password.php
 *
 * ReviewService.Pro custom WooCommerce reset password page.
 *
 * Purpose:
 * - Premium client portal password reset UI.
 * - Preserve WooCommerce reset password hooks, nonce, key/login fields, and save flow.
 * - Keep comfortable spacing, secure messaging, and responsive layout.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_reset_password_form');

$login_url   = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$support_url = home_url('/contact/?type=password-reset-help');

$reset_key   = isset($args['key']) ? $args['key'] : '';
$reset_login = isset($args['login']) ? $args['login'] : '';

?>

<style>
  .rsp-reset-password {
    color: #ffffff;
  }

  .rsp-reset-password-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-reset-password-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-reset-password-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-reset-password-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-reset-x, 50%) var(--rsp-reset-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-reset-x, 50%) var(--rsp-reset-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-reset-password-card:hover::before {
    opacity: 1;
  }

  .rsp-reset-password-beam {
    animation: rspResetPasswordBeam 8s ease-in-out infinite;
  }

  @keyframes rspResetPasswordBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-reset-password label {
    display: block;
    margin-bottom: 9px;
    color: #ffffff;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.45;
  }

  .rsp-reset-password .required {
    color: #EF4444;
    text-decoration: none;
  }

  .rsp-reset-password .form-row {
    margin: 0;
    padding: 0;
  }

  .rsp-reset-password input.input-text,
  .rsp-reset-password input[type="password"] {
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

  .rsp-reset-password input.input-text:focus,
  .rsp-reset-password input[type="password"]:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-reset-password a {
    color: #60A5FA;
    text-decoration: none;
    transition: color 180ms ease;
  }

  .rsp-reset-password a:hover {
    color: #93C5FD;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-reset-password-reveal,
    .rsp-reset-password-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-reset-password relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-reset-password-card rsp-reset-password-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-reset-password-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-reset-password-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="key-round" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Set New Password', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Create a new password for your client portal.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Choose a strong password to protect your ReviewService.Pro account, service orders, billing details, and support communication.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a
            href="<?php echo esc_url($login_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700">

            <?php esc_html_e('Back to Login', 'reviewservicepro'); ?>
            <i data-lucide="log-in" class="h-4 w-4" aria-hidden="true"></i>
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

    <!-- Security Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-reset-password-card rsp-reset-password-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-reset-password-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="lock-keyhole" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Strong password', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Use a mix of uppercase letters, lowercase letters, numbers, and symbols for stronger protection.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-reset-password-card rsp-reset-password-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-reset-password-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Secure portal access', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('After reset, you can safely access your orders, account details, and service information.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-reset-password-card rsp-reset-password-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-reset-password-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="shield-alert" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Keep it private', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Do not share your password with anyone outside your trusted business team.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <!-- Reset Form -->
    <section class="mt-8 grid grid-cols-1 gap-8 xl:grid-cols-[1.05fr_0.95fr]">

      <article class="rsp-reset-password-card rsp-reset-password-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-reset-password-card>
        <div class="relative z-10">
          <div class="mb-8">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
              <i data-lucide="key-square" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Enter your new password', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Enter your new password twice to confirm it correctly.', 'reviewservicepro'); ?>
            </p>
          </div>

          <form method="post" class="woocommerce-ResetPassword lost_reset_password">

            <div class="grid grid-cols-1 gap-6">
              <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                <label for="password_1">
                  <?php esc_html_e('New password', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="password"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="password_1"
                  id="password_1"
                  autocomplete="new-password">
              </p>

              <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                <label for="password_2">
                  <?php esc_html_e('Re-enter new password', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  type="password"
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  name="password_2"
                  id="password_2"
                  autocomplete="new-password">
              </p>
            </div>

            <?php do_action('woocommerce_resetpassword_form'); ?>

            <input type="hidden" name="reset_key" value="<?php echo esc_attr($reset_key); ?>">
            <input type="hidden" name="reset_login" value="<?php echo esc_attr($reset_login); ?>">

            <div class="mt-8">
              <?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

              <button
                type="submit"
                class="woocommerce-Button button inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700"
                value="<?php esc_attr_e('Save', 'reviewservicepro'); ?>"
                name="save_password">

                <?php esc_html_e('Save New Password', 'reviewservicepro'); ?>
                <i data-lucide="save" class="h-4 w-4" aria-hidden="true"></i>
              </button>
            </div>

          </form>
        </div>
      </article>

      <aside class="rsp-reset-password-card rsp-reset-password-reveal rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-reset-password-card style="transition-delay: 90ms;">
        <div class="relative z-10">
          <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
            <i data-lucide="circle-help" class="h-6 w-6" aria-hidden="true"></i>
          </span>

          <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Password reset tips', 'reviewservicepro'); ?>
          </h2>

          <ul class="mt-5 space-y-4" role="list">
            <li class="flex gap-3 text-sm font-normal leading-7 text-slate-300">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <?php esc_html_e('Avoid using your business name, phone number, or simple words as your password.', 'reviewservicepro'); ?>
            </li>

            <li class="flex gap-3 text-sm font-normal leading-7 text-slate-300">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <?php esc_html_e('Use a password manager if you manage multiple business accounts.', 'reviewservicepro'); ?>
            </li>

            <li class="flex gap-3 text-sm font-normal leading-7 text-slate-300">
              <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
              <?php esc_html_e('After saving, return to login and access your client portal.', 'reviewservicepro'); ?>
            </li>
          </ul>

          <div class="mt-8 rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-5">
            <div class="flex gap-3">
              <i data-lucide="shield-alert" class="mt-0.5 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

              <p class="text-sm font-normal leading-7 text-slate-300">
                <?php esc_html_e('For security, ReviewService.Pro support will never ask for your password. Only use the official password reset flow.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>

          <a
            href="<?php echo esc_url($support_url); ?>"
            class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

            <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
            <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </aside>

    </section>

  </div>
</section>

<script>
  (function() {
    function initRspResetPasswordPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-reset-password-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-reset-password-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-reset-x', x + '%');
          card.style.setProperty('--rsp-reset-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspResetPasswordPage);
    } else {
      initRspResetPasswordPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_reset_password_form'); ?>