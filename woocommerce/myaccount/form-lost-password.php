<?php

/**
 * Lost Password Form
 *
 * File: woocommerce/myaccount/form-lost-password.php
 *
 * ReviewService.Pro custom WooCommerce lost password page.
 *
 * Purpose:
 * - Premium client portal password reset request UI.
 * - Preserve WooCommerce lost password hooks, nonce, validation, and reset email flow.
 * - Keep strong spacing, comfortable field size, and secure account messaging.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');

$login_url   = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
$support_url = home_url('/contact/?type=password-help');
$pricing_url = home_url('/pricing/');

?>

<style>
  .rsp-lost-password {
    color: #ffffff;
  }

  .rsp-lost-password-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 740ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 740ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-lost-password-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-lost-password-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-lost-password-card::before {
    content: "";
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(460px circle at var(--rsp-lost-x, 50%) var(--rsp-lost-y, 50%), rgba(37, 99, 235, 0.13), transparent 42%),
      radial-gradient(320px circle at var(--rsp-lost-x, 50%) var(--rsp-lost-y, 50%), rgba(0, 200, 83, 0.09), transparent 38%);
    transition: opacity 220ms ease;
    pointer-events: none;
  }

  .rsp-lost-password-card:hover::before {
    opacity: 1;
  }

  .rsp-lost-password-beam {
    animation: rspLostPasswordBeam 8s ease-in-out infinite;
  }

  @keyframes rspLostPasswordBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  .rsp-lost-password label {
    display: block;
    margin-bottom: 9px;
    color: #ffffff;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.45;
  }

  .rsp-lost-password .required {
    color: #EF4444;
    text-decoration: none;
  }

  .rsp-lost-password .form-row {
    margin: 0;
    padding: 0;
  }

  .rsp-lost-password input.input-text,
  .rsp-lost-password input[type="text"],
  .rsp-lost-password input[type="email"] {
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

  .rsp-lost-password input.input-text:focus,
  .rsp-lost-password input[type="text"]:focus,
  .rsp-lost-password input[type="email"]:focus {
    border-color: #2563EB;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.18);
  }

  .rsp-lost-password a {
    color: #60A5FA;
    text-decoration: none;
    transition: color 180ms ease;
  }

  .rsp-lost-password a:hover {
    color: #93C5FD;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-lost-password-reveal,
    .rsp-lost-password-beam {
      opacity: 1;
      transform: none;
      transition: none;
      animation: none;
    }
  }
</style>

<section class="rsp-lost-password relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-[#07111F] p-5 sm:p-7 lg:p-10">

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
  <div class="pointer-events-none absolute -left-32 top-16 z-0 h-[420px] w-[420px] rounded-full bg-blue-600/[0.12] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[420px] w-[420px] rounded-full bg-[#00C853]/[0.10] blur-[120px]"></div>

  <div class="relative z-10">

    <!-- Header -->
    <section class="rsp-lost-password-card rsp-lost-password-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.045] p-6 shadow-[0_24px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-lost-password-card>

      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-white/10">
        <div class="rsp-lost-password-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/25 bg-[#00C853]/10 px-4 py-2 text-xs font-medium uppercase tracking-[0.14em] text-[#6DFFB0]">
            <i data-lucide="lock-keyhole" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Password Recovery', 'reviewservicepro'); ?>
          </span>

          <h1 class="mt-6 max-w-4xl text-3xl font-semibold leading-[1.08] tracking-[-0.055em] text-white md:text-5xl">
            <?php esc_html_e('Reset access to your client portal.', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 max-w-3xl text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('Enter your account username or email address. We will send a secure password reset link so you can access your ReviewService.Pro client portal again.', 'reviewservicepro'); ?>
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

    <!-- Trust Cards -->
    <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">

      <article class="rsp-lost-password-card rsp-lost-password-reveal rounded-[1.5rem] border border-blue-400/20 bg-blue-500/[0.08] p-6 backdrop-blur-xl" data-rsp-lost-password-card>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
          <i data-lucide="mail-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Secure reset email', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('A reset link will be sent to the email address connected to your client account.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-lost-password-card rsp-lost-password-reveal rounded-[1.5rem] border border-[#00C853]/20 bg-[#00C853]/[0.07] p-6 backdrop-blur-xl" data-rsp-lost-password-card style="transition-delay: 80ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
          <i data-lucide="layout-dashboard" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Portal access', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('After resetting, you can view service orders, account details, onboarding notes, and support options.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rsp-lost-password-card rsp-lost-password-reveal rounded-[1.5rem] border border-amber-300/20 bg-amber-300/[0.05] p-6 backdrop-blur-xl" data-rsp-lost-password-card style="transition-delay: 160ms;">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-300/20 bg-amber-300/10 text-amber-200">
          <i data-lucide="shield-alert" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h2 class="text-xl font-semibold tracking-[-0.035em] text-white">
          <?php esc_html_e('Protect your account', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-3 text-sm font-normal leading-7 text-slate-300">
          <?php esc_html_e('Use a strong password and do not share your client portal login with anyone outside your business.', 'reviewservicepro'); ?>
        </p>
      </article>

    </section>

    <!-- Lost password form -->
    <section class="mt-8 grid grid-cols-1 gap-8 xl:grid-cols-[1.05fr_0.95fr]">

      <article class="rsp-lost-password-card rsp-lost-password-reveal rounded-[1.75rem] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-lost-password-card>
        <div class="relative z-10">
          <div class="mb-8">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-400/20 bg-blue-500/10 text-blue-200">
              <i data-lucide="key-round" class="h-6 w-6" aria-hidden="true"></i>
            </span>

            <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
              <?php esc_html_e('Request password reset', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-3 text-base font-normal leading-8 text-slate-300">
              <?php esc_html_e('Enter the username or email address you used for your client account.', 'reviewservicepro'); ?>
            </p>
          </div>

          <form method="post" class="woocommerce-ResetPassword lost_reset_password">

            <div class="grid grid-cols-1 gap-6">
              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="user_login">
                  <?php esc_html_e('Username or email address', 'reviewservicepro'); ?>
                  <span class="required">*</span>
                </label>

                <input
                  class="woocommerce-Input woocommerce-Input--text input-text"
                  type="text"
                  name="user_login"
                  id="user_login"
                  autocomplete="username"
                  value="<?php echo isset($_POST['user_login']) ? esc_attr(wp_unslash($_POST['user_login'])) : ''; ?>">
              </p>
            </div>

            <?php do_action('woocommerce_lostpassword_form'); ?>

            <div class="mt-8">
              <input type="hidden" name="wc_reset_password" value="true">

              <button
                type="submit"
                class="woocommerce-Button button inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-7 py-4 text-base font-semibold text-white shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700"
                value="<?php esc_attr_e('Reset password', 'reviewservicepro'); ?>">

                <?php esc_html_e('Send Reset Link', 'reviewservicepro'); ?>
                <i data-lucide="send" class="h-4 w-4" aria-hidden="true"></i>
              </button>
            </div>

            <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

          </form>
        </div>
      </article>

      <aside class="rsp-lost-password-card rsp-lost-password-reveal rounded-[1.75rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-6 shadow-[0_18px_70px_rgba(0,0,0,0.18)] backdrop-blur-xl md:p-8 lg:p-10" data-rsp-lost-password-card style="transition-delay: 90ms;">
        <div class="relative z-10">
          <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-[#00C853]/20 bg-[#00C853]/10 text-[#00C853]">
            <i data-lucide="circle-help" class="h-6 w-6" aria-hidden="true"></i>
          </span>

          <h2 class="mt-5 text-3xl font-semibold leading-tight tracking-[-0.05em] text-white md:text-4xl">
            <?php esc_html_e('Having trouble accessing your account?', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 text-base font-normal leading-8 text-slate-300">
            <?php esc_html_e('If you no longer have access to your account email or cannot find the reset email, contact support with your order email or order number.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-8 grid grid-cols-1 gap-3">
            <a
              href="<?php echo esc_url($support_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#00C853] px-6 py-3.5 text-base font-semibold text-[#07111F] shadow-lg shadow-[#00C853]/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#00E676]">

              <?php esc_html_e('Contact Support', 'reviewservicepro'); ?>
              <i data-lucide="life-buoy" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($pricing_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/[0.12] bg-white/[0.045] px-6 py-3.5 text-base font-medium text-white transition-all duration-300 hover:-translate-y-0.5 hover:bg-white/[0.075]">

              <?php esc_html_e('View Services', 'reviewservicepro'); ?>
              <i data-lucide="package-search" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>

          <div class="mt-8 rounded-2xl border border-amber-300/20 bg-amber-300/[0.055] p-5">
            <div class="flex gap-3">
              <i data-lucide="shield-alert" class="mt-0.5 h-5 w-5 shrink-0 text-amber-200" aria-hidden="true"></i>

              <p class="text-sm font-normal leading-7 text-slate-300">
                <?php esc_html_e('For security, we cannot verify account ownership from public comments or social messages. Use the account email, order email, or order number when contacting support.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>
        </div>
      </aside>

    </section>

  </div>
</section>

<script>
  (function() {
    function initRspLostPasswordPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('.rsp-lost-password-reveal');

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

      var cards = document.querySelectorAll('[data-rsp-lost-password-card]');

      cards.forEach(function(card) {
        card.addEventListener('mousemove', function(event) {
          var rect = card.getBoundingClientRect();
          var x = ((event.clientX - rect.left) / rect.width) * 100;
          var y = ((event.clientY - rect.top) / rect.height) * 100;

          card.style.setProperty('--rsp-lost-x', x + '%');
          card.style.setProperty('--rsp-lost-y', y + '%');
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspLostPasswordPage);
    } else {
      initRspLostPasswordPage();
    }
  })();
</script>

<?php do_action('woocommerce_after_lost_password_form'); ?>