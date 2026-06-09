<?php

/**
 * My Account page wrapper
 *
 * ReviewService.Pro — Compact White SaaS Client Portal Layout
 *
 * File: woocommerce/myaccount/my-account.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$current_user = wp_get_current_user();

$display_name = ($current_user instanceof WP_User && $current_user->exists())
  ? $current_user->display_name
  : __('Client', 'reviewservicepro');

$support_url = home_url('/contact/?type=support');
$audit_url   = home_url('/contact/?type=audit');

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section
  id="rsp-myaccount-shell"
  class="relative bg-[#F8FAFC] px-4 py-8 sm:px-6 lg:px-8 lg:py-10"
  aria-label="<?php echo esc_attr__('Client portal', 'reviewservicepro'); ?>">

  <style>
    body.woocommerce-account .rsp-page-woo-card,
    body.woocommerce-account .rsp-page-woo-card.rsp-visible {
      width: 100% !important;
      max-width: 1280px !important;
      margin-left: auto !important;
      margin-right: auto !important;
      padding: 0 !important;
      border: 0 !important;
      border-radius: 0 !important;
      background: transparent !important;
      box-shadow: none !important;
    }

    body.woocommerce-account .rsp-page-woo-card::before,
    body.woocommerce-account .rsp-page-woo-card::after {
      display: none !important;
      content: none !important;
    }

    body.woocommerce-account .rsp-page-content,
    body.woocommerce-account .rsp-page-content>.woocommerce {
      width: 100% !important;
      max-width: none !important;
      padding: 0 !important;
      margin: 0 !important;
    }

    #rsp-myaccount-shell {
      --rsp-account-title: #334155;
      --rsp-account-heading: #3B4658;
      --rsp-account-body: #64748B;
      --rsp-account-blue: #2563EB;
      --rsp-account-green: #00C853;
      --rsp-account-border: rgba(148, 163, 184, 0.25);
    }

    #rsp-myaccount-shell,
    #rsp-myaccount-shell p,
    #rsp-myaccount-shell span,
    #rsp-myaccount-shell a,
    #rsp-myaccount-shell button,
    #rsp-myaccount-shell input,
    #rsp-myaccount-shell label,
    #rsp-myaccount-shell td,
    #rsp-myaccount-shell th,
    #rsp-myaccount-shell select,
    #rsp-myaccount-shell textarea {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #rsp-myaccount-shell h1,
    #rsp-myaccount-shell h2,
    #rsp-myaccount-shell h3,
    #rsp-myaccount-shell h4,
    #rsp-myaccount-shell .rsp-account-title,
    #rsp-myaccount-shell .rsp-account-heading,
    #rsp-myaccount-shell .rsp-endpoint-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-account-heading);
      letter-spacing: -0.035em;
    }

    #rsp-myaccount-shell .rsp-endpoint-title {
      max-width: 720px;
      font-size: clamp(28px, 3vw, 36px);
      font-weight: 800;
      line-height: 1.12;
    }

    #rsp-myaccount-shell .rsp-endpoint-subtitle,
    #rsp-myaccount-shell .rsp-account-text {
      max-width: 720px;
      color: var(--rsp-account-body);
      font-size: 16px;
      font-weight: 400;
      line-height: 1.72;
    }

    #rsp-myaccount-shell .rsp-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      border: 1px solid #BFDBFE;
      border-radius: 999px;
      background: #EFF6FF;
      padding: 0.45rem 0.8rem;
      color: #2563EB;
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 0.13em;
      line-height: 1;
      text-transform: uppercase;
    }

    #rsp-myaccount-shell .woocommerce {
      width: 100%;
      max-width: none;
    }

    #rsp-myaccount-shell .woocommerce::before,
    #rsp-myaccount-shell .woocommerce::after {
      display: none !important;
      content: none !important;
    }

    #rsp-myaccount-shell .woocommerce-MyAccount-navigation,
    #rsp-myaccount-shell .woocommerce-MyAccount-content {
      float: none !important;
      width: auto !important;
      max-width: none !important;
      margin: 0 !important;
    }

    #rsp-myaccount-shell .woocommerce-MyAccount-content {
      min-width: 0;
      padding: 0 !important;
    }

    #rsp-myaccount-shell .rsp-account-layout {
      display: grid;
      grid-template-columns: minmax(280px, 310px) minmax(0, 1fr);
      gap: 24px;
      align-items: start;
      width: 100%;
    }

    #rsp-myaccount-shell .rsp-account-sidebar {
      position: sticky;
      top: calc(var(--rsp-header-height, 78px) + 24px);
    }

    #rsp-myaccount-shell .rsp-account-content-panel {
      min-width: 0;
      border: 1px solid var(--rsp-account-border);
      border-radius: 24px;
      background: #ffffff;
      box-shadow: 0 18px 55px rgba(15, 23, 42, 0.07);
      overflow: hidden;
    }

    #rsp-myaccount-shell .rsp-account-content-topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      padding: 22px 24px;
      border-bottom: 1px solid #E2E8F0;
      background: linear-gradient(135deg, #ffffff 0%, #F8FAFC 58%, #ECFDF5 100%);
    }

    #rsp-myaccount-shell .rsp-account-content-body {
      padding: 24px;
    }

    #rsp-myaccount-shell .rsp-dashboard-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: flex-end;
    }

    #rsp-myaccount-shell .rsp-btn,
    #rsp-myaccount-shell .button,
    #rsp-myaccount-shell button.button,
    #rsp-myaccount-shell input.button,
    #rsp-myaccount-shell .woocommerce-button,
    #rsp-myaccount-shell .woocommerce-Button {
      position: relative;
      overflow: hidden;
      display: inline-flex !important;
      min-height: 46px;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      border-radius: 14px !important;
      border: 1px solid transparent !important;
      padding: 0.72rem 1.05rem !important;
      font-size: 15px !important;
      font-weight: 800 !important;
      line-height: 1.2 !important;
      text-decoration: none !important;
      transition:
        transform 220ms cubic-bezier(0.2, 0.9, 0.2, 1),
        background-color 220ms ease,
        border-color 220ms ease,
        color 220ms ease,
        box-shadow 220ms ease;
    }

    #rsp-myaccount-shell .rsp-btn-primary,
    #rsp-myaccount-shell .button,
    #rsp-myaccount-shell button.button,
    #rsp-myaccount-shell input.button,
    #rsp-myaccount-shell .woocommerce-button,
    #rsp-myaccount-shell .woocommerce-Button {
      background: #2563EB !important;
      color: #ffffff !important;
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.18);
    }

    #rsp-myaccount-shell .rsp-btn-secondary {
      border-color: #E2E8F0 !important;
      background: #ffffff !important;
      color: #3B4658 !important;
      box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
    }

    #rsp-myaccount-shell .rsp-btn:hover,
    #rsp-myaccount-shell .button:hover,
    #rsp-myaccount-shell button.button:hover,
    #rsp-myaccount-shell input.button:hover,
    #rsp-myaccount-shell .woocommerce-button:hover,
    #rsp-myaccount-shell .woocommerce-Button:hover {
      transform: translateY(-2px);
      color: #ffffff !important;
      box-shadow: 0 16px 36px rgba(37, 99, 235, 0.22);
    }

    #rsp-myaccount-shell .rsp-btn-secondary:hover {
      border-color: #BFDBFE !important;
      background: #EFF6FF !important;
      color: #2563EB !important;
      box-shadow: 0 12px 30px rgba(37, 99, 235, 0.10);
    }

    #rsp-myaccount-shell .rsp-btn-primary::before,
    #rsp-myaccount-shell .button::before,
    #rsp-myaccount-shell .woocommerce-button::before,
    #rsp-myaccount-shell .woocommerce-Button::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 70%;
      height: 100%;
      transform: skewX(-18deg);
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.28), transparent);
      transition: left 650ms ease;
      pointer-events: none;
    }

    #rsp-myaccount-shell .rsp-btn-primary:hover::before,
    #rsp-myaccount-shell .button:hover::before,
    #rsp-myaccount-shell .woocommerce-button:hover::before,
    #rsp-myaccount-shell .woocommerce-Button:hover::before {
      left: 130%;
    }

    #rsp-myaccount-shell input.input-text,
    #rsp-myaccount-shell input[type="text"],
    #rsp-myaccount-shell input[type="email"],
    #rsp-myaccount-shell input[type="password"],
    #rsp-myaccount-shell input[type="tel"],
    #rsp-myaccount-shell select,
    #rsp-myaccount-shell textarea,
    #rsp-myaccount-shell .select2-container--default .select2-selection--single {
      width: 100% !important;
      min-height: 50px;
      border: 1px solid rgba(148, 163, 184, 0.34);
      border-radius: 14px;
      background: #ffffff;
      padding: 0.78rem 0.95rem;
      color: #334155;
      font-size: 16px;
      font-weight: 500;
      outline: none;
      box-shadow: none;
      transition:
        border-color 180ms ease,
        box-shadow 180ms ease,
        background-color 180ms ease;
    }

    #rsp-myaccount-shell .select2-container--default .select2-selection--single {
      display: flex;
      align-items: center;
      height: 50px;
      padding: 0 0.95rem;
    }

    #rsp-myaccount-shell input.input-text:focus,
    #rsp-myaccount-shell input[type="text"]:focus,
    #rsp-myaccount-shell input[type="email"]:focus,
    #rsp-myaccount-shell input[type="password"]:focus,
    #rsp-myaccount-shell input[type="tel"]:focus,
    #rsp-myaccount-shell select:focus,
    #rsp-myaccount-shell textarea:focus {
      border-color: rgba(37, 99, 235, 0.48);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
      background: #ffffff;
    }

    #rsp-myaccount-shell label {
      display: block;
      margin-bottom: 8px;
      color: #3B4658;
      font-size: 14px;
      font-weight: 800;
      line-height: 1.4;
    }

    #rsp-myaccount-shell .required {
      color: #EF4444;
      text-decoration: none;
    }

    #rsp-myaccount-shell .form-row,
    #rsp-myaccount-shell .woocommerce-form-row {
      margin: 0 0 18px !important;
      padding: 0 !important;
    }

    #rsp-myaccount-shell .form-row-first,
    #rsp-myaccount-shell .form-row-last {
      float: none !important;
      width: 100% !important;
    }

    #rsp-myaccount-shell table.shop_table {
      overflow: hidden;
      border: 1px solid rgba(148, 163, 184, 0.24) !important;
      border-radius: 18px;
      background: #ffffff;
      box-shadow: 0 12px 36px rgba(15, 23, 42, 0.05);
    }

    #rsp-myaccount-shell table.shop_table th {
      border-bottom: 1px solid #E2E8F0 !important;
      background: #F8FAFC;
      color: #3B4658;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    #rsp-myaccount-shell table.shop_table td {
      border-bottom: 1px solid #F1F5F9 !important;
      color: #64748B;
      font-size: 15px;
      line-height: 1.65;
    }

    #rsp-myaccount-shell mark,
    #rsp-myaccount-shell .rsp-status-pill {
      display: inline-flex;
      align-items: center;
      border-radius: 999px;
      background: #ECFDF5;
      padding: 0.25rem 0.65rem;
      color: #047857;
      font-size: 12px;
      font-weight: 800;
      line-height: 1;
    }

    #rsp-myaccount-shell .rsp-card {
      border: 1px solid #E2E8F0;
      border-radius: 20px;
      background: #ffffff;
      box-shadow: 0 12px 36px rgba(15, 23, 42, 0.05);
      transition:
        transform 220ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 220ms ease,
        box-shadow 220ms ease;
    }

    #rsp-myaccount-shell .rsp-card:hover {
      transform: translateY(-2px);
      border-color: #BFDBFE;
      box-shadow: 0 18px 44px rgba(15, 23, 42, 0.08);
    }

    #rsp-myaccount-shell .rsp-reveal {
      opacity: 0;
      transform: translateY(16px);
      animation: rspAccountReveal 560ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes rspAccountReveal {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 1024px) {
      #rsp-myaccount-shell .rsp-account-layout {
        grid-template-columns: 1fr;
      }

      #rsp-myaccount-shell .rsp-account-sidebar {
        position: relative;
        top: auto;
      }

      #rsp-myaccount-shell .rsp-account-content-topbar {
        align-items: flex-start;
        flex-direction: column;
      }

      #rsp-myaccount-shell .rsp-dashboard-actions {
        width: 100%;
        justify-content: flex-start;
      }
    }

    @media (max-width: 640px) {
      #rsp-myaccount-shell {
        padding-left: 1rem;
        padding-right: 1rem;
      }

      #rsp-myaccount-shell .rsp-account-content-body,
      #rsp-myaccount-shell .rsp-account-content-topbar {
        padding: 18px;
      }

      #rsp-myaccount-shell .rsp-endpoint-title {
        font-size: 28px;
      }

      #rsp-myaccount-shell .rsp-btn,
      #rsp-myaccount-shell .button,
      #rsp-myaccount-shell .woocommerce-button,
      #rsp-myaccount-shell .woocommerce-Button {
        width: 100%;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #rsp-myaccount-shell *,
      #rsp-myaccount-shell *::before,
      #rsp-myaccount-shell *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #rsp-myaccount-shell .rsp-reveal {
        opacity: 1;
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-slate-200" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-40 top-4 h-[360px] w-[360px] rounded-full bg-blue-100/55 blur-[120px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-40 bottom-8 h-[360px] w-[360px] rounded-full bg-emerald-100/60 blur-[120px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">
    <div class="woocommerce">
      <?php do_action('woocommerce_before_account_navigation'); ?>

      <div class="rsp-account-layout">
        <aside class="rsp-account-sidebar rsp-reveal" aria-label="<?php echo esc_attr__('Client portal navigation', 'reviewservicepro'); ?>">
          <?php do_action('woocommerce_account_navigation'); ?>
        </aside>

        <section class="rsp-account-main rsp-reveal" aria-label="<?php echo esc_attr__('Client portal content', 'reviewservicepro'); ?>">
          <div class="rsp-account-content-panel">
            <div class="rsp-account-content-topbar">
              <div>
                <span class="rsp-eyebrow">
                  <?php echo $render_icon('layout-dashboard', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                  <?php esc_html_e('Client workspace', 'reviewservicepro'); ?>
                </span>

                <h2 class="rsp-account-heading mt-3 text-[24px] font-[800] leading-tight tracking-[-0.035em] sm:text-[28px]">
                  <?php
                  printf(
                    /* translators: %s: user display name */
                    esc_html__('Welcome back, %s', 'reviewservicepro'),
                    esc_html($display_name)
                  );
                  ?>
                </h2>

                <p class="rsp-account-text mt-2">
                  <?php esc_html_e('Manage orders, billing, saved payment methods, addresses, and account settings from one clean workspace.', 'reviewservicepro'); ?>
                </p>
              </div>

              <div class="rsp-dashboard-actions">
                <a href="<?php echo esc_url($audit_url); ?>" class="rsp-btn rsp-btn-primary">
                  <span class="relative z-10 inline-flex items-center gap-2">
                    <?php echo $render_icon('search-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                    <?php esc_html_e('Free Audit', 'reviewservicepro'); ?>
                  </span>
                </a>

                <a href="<?php echo esc_url($support_url); ?>" class="rsp-btn rsp-btn-secondary">
                  <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                  <?php esc_html_e('Support', 'reviewservicepro'); ?>
                </a>
              </div>
            </div>

            <div class="rsp-account-content-body">
              <?php do_action('woocommerce_account_content'); ?>
            </div>
          </div>
        </section>
      </div>

      <?php do_action('woocommerce_after_account_navigation'); ?>
    </div>
  </div>
</section>

<script>
  (function() {
    function initRspMyAccountShell() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspMyAccountShell);
    } else {
      initRspMyAccountShell();
    }
  })();
</script>