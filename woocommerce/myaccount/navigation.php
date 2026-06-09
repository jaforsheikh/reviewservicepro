<?php

/**
 * My Account navigation
 *
 * ReviewService.Pro — Compact SaaS Client Portal Sidebar
 *
 * File: woocommerce/myaccount/navigation.php
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$current_user = wp_get_current_user();

$display_name = ($current_user instanceof WP_User && $current_user->exists())
  ? $current_user->display_name
  : __('Client', 'reviewservicepro');

$user_email = ($current_user instanceof WP_User && $current_user->exists())
  ? $current_user->user_email
  : '';

$menu_items = wc_get_account_menu_items();

$support_url = home_url('/contact/?type=support');
$audit_url   = home_url('/contact/?type=audit');

$icon_map = [
  'dashboard'       => 'layout-dashboard',
  'orders'          => 'package-check',
  'downloads'       => 'download',
  'edit-address'    => 'map-pin',
  'payment-methods' => 'credit-card',
  'edit-account'    => 'user-cog',
  'customer-logout' => 'log-out',
];

$render_icon = static function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<nav
  class="woocommerce-MyAccount-navigation rsp-account-nav"
  aria-label="<?php echo esc_attr__('Account pages', 'woocommerce'); ?>">

  <style>
    .rsp-account-nav {
      width: 100%;
    }

    .rsp-account-nav-shell {
      border: 1px solid rgba(148, 163, 184, 0.25);
      border-radius: 24px;
      background: #ffffff;
      padding: 14px;
      box-shadow: 0 18px 55px rgba(15, 23, 42, 0.07);
    }

    .rsp-account-nav-profile {
      border: 1px solid #DBEAFE;
      border-radius: 18px;
      background: linear-gradient(135deg, #EFF6FF 0%, #ffffff 55%, #ECFDF5 100%);
      padding: 16px;
    }

    .rsp-account-nav-profile-inner {
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 0;
    }

    .rsp-account-nav-avatar {
      display: inline-flex;
      width: 44px;
      height: 44px;
      flex: 0 0 auto;
      align-items: center;
      justify-content: center;
      border: 1px solid #BFDBFE;
      border-radius: 14px;
      background: #ffffff;
      color: #2563EB;
      box-shadow: 0 10px 24px rgba(37, 99, 235, 0.08);
    }

    .rsp-account-nav-kicker {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 0.14em;
      line-height: 1;
      text-transform: uppercase;
      color: #2563EB;
    }

    .rsp-account-nav-name {
      margin-top: 6px;
      overflow: hidden;
      color: #334155;
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 17px;
      font-weight: 800;
      line-height: 1.1;
      letter-spacing: -0.035em;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .rsp-account-nav-email {
      margin-top: 4px;
      overflow: hidden;
      color: #64748B;
      font-size: 13px;
      font-weight: 500;
      line-height: 1.3;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .rsp-account-nav ul {
      display: grid;
      gap: 8px;
      margin: 14px 0 0;
      padding: 0;
      list-style: none;
    }

    .rsp-account-nav li {
      margin: 0;
      padding: 0;
    }

    .rsp-account-nav-link {
      position: relative;
      display: flex;
      min-height: 48px;
      align-items: center;
      gap: 10px;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      background: #ffffff;
      padding: 10px 12px;
      color: #3B4658;
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 14px;
      font-weight: 800;
      line-height: 1.25;
      text-decoration: none;
      box-shadow: 0 8px 20px rgba(15, 23, 42, 0.035);
      transition:
        transform 200ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 200ms ease,
        background-color 200ms ease,
        color 200ms ease,
        box-shadow 200ms ease;
    }

    .rsp-account-nav-link:hover,
    .rsp-account-nav-link:focus-visible {
      transform: translateY(-2px);
      border-color: #BFDBFE;
      background: #EFF6FF;
      color: #2563EB;
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.08);
      outline: none;
    }

    .rsp-account-nav-link.is-active {
      border-color: #BFDBFE;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.10), rgba(20, 184, 166, 0.07));
      color: #2563EB;
      box-shadow: 0 12px 30px rgba(37, 99, 235, 0.10);
    }

    .rsp-account-nav-icon {
      display: inline-flex;
      width: 30px;
      height: 30px;
      flex: 0 0 auto;
      align-items: center;
      justify-content: center;
      border: 1px solid #E2E8F0;
      border-radius: 10px;
      background: #F8FAFC;
      color: #64748B;
      transition:
        transform 200ms ease,
        background-color 200ms ease,
        color 200ms ease,
        border-color 200ms ease;
    }

    .rsp-account-nav-link:hover .rsp-account-nav-icon,
    .rsp-account-nav-link.is-active .rsp-account-nav-icon {
      transform: scale(1.04);
      border-color: rgba(37, 99, 235, 0.16);
      background: #2563EB;
      color: #ffffff;
    }

    .rsp-account-nav-active-dot {
      margin-left: auto;
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: #00C853;
      box-shadow: 0 0 0 4px rgba(0, 200, 83, 0.12);
    }

    .rsp-account-nav-actions {
      display: grid;
      gap: 9px;
      margin-top: 14px;
    }

    .rsp-account-nav-support,
    .rsp-account-nav-audit {
      display: inline-flex;
      min-height: 46px;
      align-items: center;
      justify-content: center;
      gap: 8px;
      border-radius: 14px;
      padding: 10px 12px;
      font-size: 14px;
      font-weight: 800;
      line-height: 1.2;
      text-decoration: none;
      transition:
        transform 200ms ease,
        background-color 200ms ease,
        border-color 200ms ease,
        color 200ms ease,
        box-shadow 200ms ease;
    }

    .rsp-account-nav-support {
      border: 1px solid #E2E8F0;
      background: #ffffff;
      color: #3B4658;
      box-shadow: 0 8px 20px rgba(15, 23, 42, 0.035);
    }

    .rsp-account-nav-audit {
      position: relative;
      overflow: hidden;
      border: 1px solid #2563EB;
      background: #2563EB;
      color: #ffffff;
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.18);
    }

    .rsp-account-nav-audit::before {
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

    .rsp-account-nav-support:hover,
    .rsp-account-nav-audit:hover {
      transform: translateY(-2px);
    }

    .rsp-account-nav-support:hover {
      border-color: #BBF7D0;
      background: #ECFDF5;
      color: #047857;
    }

    .rsp-account-nav-audit:hover {
      background: #1D4ED8;
      color: #ffffff;
      box-shadow: 0 16px 34px rgba(37, 99, 235, 0.24);
    }

    .rsp-account-nav-audit:hover::before {
      left: 130%;
    }

    @media (max-width: 1024px) {
      .rsp-account-nav ul {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .rsp-account-nav-actions {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 640px) {

      .rsp-account-nav ul,
      .rsp-account-nav-actions {
        grid-template-columns: 1fr;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      .rsp-account-nav-link,
      .rsp-account-nav-icon,
      .rsp-account-nav-support,
      .rsp-account-nav-audit,
      .rsp-account-nav-audit::before {
        transition-duration: 0.001ms !important;
      }

      .rsp-account-nav-audit::before {
        display: none;
      }
    }
  </style>

  <div class="rsp-account-nav-shell">
    <div class="rsp-account-nav-profile">
      <div class="rsp-account-nav-profile-inner">
        <div class="rsp-account-nav-avatar">
          <?php echo $render_icon('user-round-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </div>

        <div class="min-w-0">
          <p class="rsp-account-nav-kicker">
            <?php esc_html_e('Client Portal', 'reviewservicepro'); ?>
          </p>

          <p class="rsp-account-nav-name">
            <?php echo esc_html($display_name); ?>
          </p>

          <?php if (! empty($user_email)) : ?>
            <p class="rsp-account-nav-email">
              <?php echo esc_html($user_email); ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <ul>
      <?php foreach ($menu_items as $endpoint => $label) : ?>
        <?php
        $classes      = wc_get_account_menu_item_classes($endpoint);
        $is_active    = false !== strpos($classes, 'is-active');
        $icon         = $icon_map[$endpoint] ?? 'circle-dot';
        $endpoint_url = wc_get_account_endpoint_url($endpoint);
        ?>

        <li class="<?php echo esc_attr($classes); ?>">
          <a
            href="<?php echo esc_url($endpoint_url); ?>"
            class="rsp-account-nav-link <?php echo $is_active ? 'is-active' : ''; ?>"
            aria-current="<?php echo $is_active ? 'page' : 'false'; ?>">
            <span class="rsp-account-nav-icon">
              <?php echo $render_icon($icon, 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </span>

            <span class="truncate">
              <?php echo esc_html($label); ?>
            </span>

            <?php if ($is_active) : ?>
              <span class="rsp-account-nav-active-dot" aria-hidden="true"></span>
            <?php endif; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="rsp-account-nav-actions">
      <a href="<?php echo esc_url($support_url); ?>" class="rsp-account-nav-support">
        <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Support', 'reviewservicepro'); ?>
      </a>

      <a href="<?php echo esc_url($audit_url); ?>" class="rsp-account-nav-audit">
        <span class="relative z-10 inline-flex items-center gap-2">
          <?php echo $render_icon('search-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Free Audit', 'reviewservicepro'); ?>
        </span>
      </a>
    </div>
  </div>
</nav>