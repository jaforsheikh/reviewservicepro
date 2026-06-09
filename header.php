<?php

/**
 * Theme Header
 *
 * ReviewService.Pro — Premium White SaaS Header with Resources Dropdown
 *
 * File: header.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$current_path = '/';

if (isset($_SERVER['REQUEST_URI'])) {
  $request_path = parse_url(wp_unslash((string) $_SERVER['REQUEST_URI']), PHP_URL_PATH);
  $current_path = trailingslashit($request_path ? $request_path : '/');
}

$header_url = function ($url) {
  $url = (string) $url;

  if ('' === $url) {
    return home_url('/');
  }

  if (0 === strpos($url, '#')) {
    return $url;
  }

  if (preg_match('#^https?://#i', $url)) {
    return $url;
  }

  return home_url($url);
};

$is_active_url = function ($url) use ($current_path) {
  $url = (string) $url;

  if ('/' === $url) {
    return is_front_page();
  }

  return 0 === strpos($current_path, trailingslashit($url));
};

$nav_items = [
  [
    'label' => __('Home', 'reviewservicepro'),
    'url'   => '/',
  ],
  [
    'label' => __('Services', 'reviewservicepro'),
    'url'   => '/services/',
  ],
  [
    'label' => __('Pricing', 'reviewservicepro'),
    'url'   => '/pricing/',
  ],
  [
    'label' => __('Platforms', 'reviewservicepro'),
    'url'   => '/platforms/',
  ],
];

$resource_items = [
  [
    'label'       => __('ORM Academy', 'reviewservicepro'),
    'description' => __('Guides, frameworks, and review management education.', 'reviewservicepro'),
    'url'         => '/orm-academy/',
    'icon'        => 'book-open-check',
  ],
  [
    'label'       => __('Case Studies', 'reviewservicepro'),
    'description' => __('Trust-building examples and reputation strategy insights.', 'reviewservicepro'),
    'url'         => '/case-studies/',
    'icon'        => 'chart-no-axes-combined',
  ],
  [
    'label'       => __('Trust Center', 'reviewservicepro'),
    'description' => __('Ethical policy, compliance, and service transparency.', 'reviewservicepro'),
    'url'         => '/trust-center/',
    'icon'        => 'shield-check',
  ],
];

$resources_active = false;

foreach ($resource_items as $resource_item) {
  if ($is_active_url($resource_item['url'])) {
    $resources_active = true;
    break;
  }
}

$audit_url  = get_theme_mod('header_audit_url', '/contact/?type=audit');
$portal_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');

if (! $portal_url) {
  $portal_url = home_url('/my-account/');
}

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>

  <style>
    body.admin-bar #site-header {
      top: 32px;
    }

    @media screen and (max-width: 782px) {
      body.admin-bar #site-header {
        top: 46px;
      }
    }

    body:not(.admin-bar) #site-header {
      top: 0;
    }

    #site-header {
      --rsp-header-title: #334155;
      --rsp-header-heading: #3B4658;
      --rsp-header-body: #64748B;
      --rsp-header-blue: #2563EB;
      --rsp-header-green: #00C853;
      transform: translateY(-10px);
      opacity: 0;
      animation: rspHeaderEnter 650ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes rspHeaderEnter {
      0% {
        transform: translateY(-10px);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .rsp-header-logo {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      text-rendering: geometricPrecision;
      -webkit-font-smoothing: antialiased;
      animation: rspLogoSoftReveal 800ms cubic-bezier(0.16, 1, 0.3, 1) 130ms both;
    }

    @keyframes rspLogoSoftReveal {
      0% {
        opacity: 0;
        transform: translateX(-10px);
      }

      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .rsp-header-nav-item {
      position: relative;
      overflow: hidden;
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      white-space: nowrap;
    }

    .rsp-header-nav-item::after {
      content: "";
      position: absolute;
      left: 16px;
      right: 16px;
      bottom: 7px;
      height: 2px;
      transform: scaleX(0);
      transform-origin: left;
      border-radius: 999px;
      background: linear-gradient(90deg, #2563eb, #00c853);
      transition: transform 240ms ease;
    }

    .rsp-header-nav-item:hover::after,
    .rsp-header-nav-item:focus-visible::after,
    .rsp-header-nav-item.is-active::after {
      transform: scaleX(1);
    }

    .rsp-header-dropdown {
      position: relative;
      margin-top: -14px;
      margin-bottom: -14px;
      padding-top: 14px;
      padding-bottom: 14px;
    }

    .rsp-header-dropdown::after {
      content: "";
      position: absolute;
      left: -18px;
      right: -18px;
      top: 100%;
      height: 18px;
      pointer-events: auto;
    }

    .rsp-header-dropdown-panel {
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px) scale(0.985);
      pointer-events: none;
      transition:
        opacity 220ms ease,
        visibility 220ms ease,
        transform 220ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    .rsp-header-dropdown:hover .rsp-header-dropdown-panel,
    .rsp-header-dropdown:focus-within .rsp-header-dropdown-panel,
    .rsp-header-dropdown.is-open .rsp-header-dropdown-panel {
      opacity: 1;
      visibility: visible;
      transform: translateY(0) scale(1);
      pointer-events: auto;
    }

    .rsp-header-dropdown:hover .rsp-resources-chevron,
    .rsp-header-dropdown:focus-within .rsp-resources-chevron,
    .rsp-header-dropdown.is-open .rsp-resources-chevron {
      transform: rotate(180deg);
    }

    .rsp-header-dropdown-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    .rsp-header-dropdown-card::before {
      content: "";
      position: absolute;
      inset: -120%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.22),
          rgba(20, 184, 166, 0.16),
          rgba(37, 99, 235, 0.22),
          rgba(37, 99, 235, 0.08));
      opacity: 0;
      animation: rspHeaderBorderSpin 7s linear infinite;
      transition: opacity 220ms ease;
    }

    .rsp-header-dropdown-card::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: #ffffff;
    }

    .rsp-header-dropdown-card:hover::before,
    .rsp-header-dropdown-card:focus-visible::before {
      opacity: 1;
    }

    @keyframes rspHeaderBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    .rsp-header-cta {
      position: relative;
      overflow: hidden;
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      white-space: nowrap;
    }

    .rsp-header-cta::before {
      content: "";
      position: absolute;
      inset: 0;
      transform: translateX(-110%);
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.26),
          transparent);
      transition: transform 650ms ease;
    }

    .rsp-header-cta:hover::before {
      transform: translateX(110%);
    }

    .rsp-header-scrolled {
      border-color: rgba(226, 232, 240, 0.95) !important;
      background: rgba(255, 255, 255, 0.94) !important;
      box-shadow:
        0 18px 60px rgba(15, 23, 42, 0.10),
        0 0 0 1px rgba(37, 99, 235, 0.05);
    }

    .rsp-header-glow-line {
      position: absolute;
      left: 50%;
      bottom: -1px;
      width: min(760px, 76vw);
      height: 1px;
      transform: translateX(-50%);
      background: linear-gradient(90deg,
          transparent,
          rgba(37, 99, 235, 0.45),
          rgba(0, 200, 83, 0.50),
          transparent);
      opacity: 0.75;
      pointer-events: none;
    }

    @media (prefers-reduced-motion: reduce) {

      #site-header,
      .rsp-header-logo {
        opacity: 1;
        transform: none;
        animation: none;
      }

      .rsp-header-dropdown-panel,
      .rsp-header-cta,
      .rsp-header-nav-item::after,
      .rsp-header-dropdown-card::before {
        animation: none !important;
        transition-duration: 0.001ms !important;
      }

      .rsp-header-cta::before {
        display: none;
      }
    }
  </style>
</head>

<body <?php body_class('bg-white text-[#334155] antialiased font-sans'); ?>>
  <?php wp_body_open(); ?>

  <header
    id="site-header"
    class="fixed left-0 right-0 top-0 z-[999] border-b border-slate-200/80 bg-white/92 backdrop-blur-xl transition-all duration-300"
    data-rsp-header>

    <div class="rsp-header-glow-line" aria-hidden="true"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-[78px] items-center justify-between gap-5">

        <a
          href="<?php echo esc_url(home_url('/')); ?>"
          class="rsp-header-logo inline-flex items-baseline rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20"
          aria-label="<?php esc_attr_e('Go to ReviewService.Pro homepage', 'reviewservicepro'); ?>">
          <span class="text-[1.78rem] font-medium leading-none tracking-[-0.06em] text-[#334155] sm:text-[2rem]">
            ReviewService<span class="text-[#00C853]">.Pro</span>
          </span>
        </a>

        <nav
          class="hidden items-center gap-1 lg:flex"
          aria-label="<?php esc_attr_e('Primary navigation', 'reviewservicepro'); ?>">

          <?php foreach ($nav_items as $item) : ?>
            <?php
            $item_url  = $header_url($item['url']);
            $is_active = $is_active_url($item['url']);
            ?>
            <a
              href="<?php echo esc_url($item_url); ?>"
              class="rsp-header-nav-item <?php echo $is_active ? 'is-active bg-blue-50 text-blue-700' : 'text-[#3B4658]'; ?> rounded-full px-4 py-2.5 text-[15px] font-[700] leading-6 transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/15">
              <?php echo esc_html($item['label']); ?>
            </a>
          <?php endforeach; ?>

          <div class="rsp-header-dropdown" data-rsp-resources-dropdown>
            <button
              type="button"
              class="rsp-header-nav-item <?php echo $resources_active ? 'is-active bg-blue-50 text-blue-700' : 'text-[#3B4658]'; ?> inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-[15px] font-[700] leading-6 transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/15"
              aria-haspopup="true"
              aria-expanded="<?php echo $resources_active ? 'true' : 'false'; ?>"
              data-rsp-resources-toggle>
              <?php esc_html_e('Resources', 'reviewservicepro'); ?>
              <span class="rsp-resources-chevron inline-flex transition-transform duration-200">
                <?php echo $render_icon('chevron-down', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </button>

            <div class="rsp-header-dropdown-panel absolute left-1/2 top-full z-50 mt-0 w-[430px] -translate-x-1/2 rounded-[1.5rem] border border-slate-200 bg-white p-3 shadow-[0_24px_90px_rgba(15,23,42,0.14)]">
              <div class="mb-2 border-b border-slate-100 px-3 pb-3 pt-2">
                <p class="font-['DM_Mono',monospace] text-[10px] font-[800] uppercase tracking-[0.16em] text-blue-700">
                  <?php esc_html_e('Resources', 'reviewservicepro'); ?>
                </p>
                <p class="mt-1 font-['Inter',sans-serif] text-sm font-medium leading-6 text-[#64748B]">
                  <?php esc_html_e('Learn, compare, and build trust with ethical ORM insights.', 'reviewservicepro'); ?>
                </p>
              </div>

              <div class="grid gap-2">
                <?php foreach ($resource_items as $resource) : ?>
                  <a
                    href="<?php echo esc_url($header_url($resource['url'])); ?>"
                    class="rsp-header-dropdown-card group rounded-[1.1rem] border border-slate-200 bg-white p-3 no-underline transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-[0_14px_36px_rgba(15,23,42,0.08)] focus:outline-none focus:ring-4 focus:ring-blue-500/15">
                    <span class="relative z-10 flex gap-3">
                      <span class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600 transition-transform duration-200 group-hover:scale-105">
                        <?php echo $render_icon($resource['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                      </span>
                      <span>
                        <span class="block font-['Poppins',sans-serif] text-sm font-[800] leading-5 text-[#3B4658]">
                          <?php echo esc_html($resource['label']); ?>
                        </span>
                        <span class="mt-1 block font-['Inter',sans-serif] text-xs font-medium leading-5 text-[#64748B]">
                          <?php echo esc_html($resource['description']); ?>
                        </span>
                      </span>
                    </span>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
          <a
            href="<?php echo esc_url($portal_url); ?>"
            class="inline-flex min-h-[48px] items-center gap-2 whitespace-nowrap rounded-2xl border border-slate-200 bg-white px-4 py-3 font-['Inter',sans-serif] text-[15px] font-[800] text-[#3B4658] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/15">
            <?php echo $render_icon('layout-dashboard', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Portal', 'reviewservicepro'); ?>
          </a>

          <a
            href="<?php echo esc_url($header_url($audit_url)); ?>"
            class="rsp-header-cta inline-flex min-h-[48px] items-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3 font-['Inter',sans-serif] text-[15px] font-[800] text-white shadow-[0_14px_34px_rgba(37,99,235,0.24)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-500/20">
            <?php echo $render_icon('search-check', 'relative z-10 h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <span class="relative z-10 whitespace-nowrap"><?php esc_html_e('Free Audit', 'reviewservicepro'); ?></span>
          </a>
        </div>

        <button
          type="button"
          id="mobile-menu-toggle"
          class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-[#334155] shadow-sm transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 lg:hidden"
          aria-label="<?php esc_attr_e('Open mobile menu', 'reviewservicepro'); ?>"
          aria-expanded="false"
          aria-controls="mobile-menu">
          <?php echo $render_icon('menu', 'mobile-menu-open h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php echo $render_icon('x', 'mobile-menu-close hidden h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </button>

      </div>
    </div>

    <div
      id="mobile-menu"
      class="hidden border-t border-slate-200 bg-white/98 px-4 pb-5 pt-3 shadow-2xl shadow-slate-900/10 backdrop-blur-xl lg:hidden">

      <nav class="mx-auto flex max-w-7xl flex-col gap-2" aria-label="<?php esc_attr_e('Mobile navigation', 'reviewservicepro'); ?>">
        <?php foreach ($nav_items as $item) : ?>
          <a
            href="<?php echo esc_url($header_url($item['url'])); ?>"
            class="rounded-xl border border-slate-200 bg-white px-4 py-3 font-['Inter',sans-serif] text-base font-[700] leading-6 text-[#3B4658] shadow-sm transition-all duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
            <?php echo esc_html($item['label']); ?>
          </a>
        <?php endforeach; ?>

        <div class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-3">
          <p class="mb-2 px-1 font-['DM_Mono',monospace] text-[11px] font-[800] uppercase tracking-[0.16em] text-blue-700">
            <?php esc_html_e('Resources', 'reviewservicepro'); ?>
          </p>

          <div class="grid gap-2">
            <?php foreach ($resource_items as $resource) : ?>
              <a
                href="<?php echo esc_url($header_url($resource['url'])); ?>"
                class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 font-['Inter',sans-serif] text-base font-[700] text-[#3B4658] shadow-sm transition-all duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                  <?php echo $render_icon($resource['icon'], 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </span>
                <?php echo esc_html($resource['label']); ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="mt-2 grid gap-2 sm:grid-cols-2">
          <a
            href="<?php echo esc_url($portal_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 font-['Inter',sans-serif] text-base font-[800] text-[#3B4658] shadow-sm transition-all duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
            <?php echo $render_icon('layout-dashboard', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Client Portal', 'reviewservicepro'); ?>
          </a>

          <a
            href="<?php echo esc_url($header_url($audit_url)); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3 font-['Inter',sans-serif] text-base font-[800] text-white shadow-lg shadow-blue-900/15 transition-all duration-200 hover:bg-blue-700 hover:text-white">
            <?php echo $render_icon('search-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Free Audit', 'reviewservicepro'); ?>
          </a>
        </div>
      </nav>
    </div>
  </header>

  <script>
    (function() {
      function initReviewServiceHeader() {
        var header = document.querySelector('[data-rsp-header]');
        var toggle = document.getElementById('mobile-menu-toggle');
        var mobileMenu = document.getElementById('mobile-menu');
        var resourcesDropdown = document.querySelector('[data-rsp-resources-dropdown]');
        var resourcesToggle = document.querySelector('[data-rsp-resources-toggle]');

        if (window.lucide && typeof window.lucide.createIcons === 'function') {
          window.lucide.createIcons();
        }

        if (header) {
          var updateHeaderScroll = function() {
            if (window.scrollY > 8) {
              header.classList.add('rsp-header-scrolled');
            } else {
              header.classList.remove('rsp-header-scrolled');
            }
          };

          updateHeaderScroll();
          window.addEventListener('scroll', updateHeaderScroll, {
            passive: true
          });
        }

        if (resourcesDropdown && resourcesToggle) {
          resourcesToggle.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var isOpen = resourcesDropdown.classList.contains('is-open');

            resourcesDropdown.classList.toggle('is-open', !isOpen);
            resourcesToggle.setAttribute('aria-expanded', String(!isOpen));
          });

          document.addEventListener('click', function(event) {
            if (!resourcesDropdown.contains(event.target)) {
              resourcesDropdown.classList.remove('is-open');
              resourcesToggle.setAttribute('aria-expanded', 'false');
            }
          });

          document.addEventListener('keydown', function(event) {
            if ('Escape' === event.key) {
              resourcesDropdown.classList.remove('is-open');
              resourcesToggle.setAttribute('aria-expanded', 'false');
            }
          });
        }

        /*
         * Mobile menu is handled globally in assets/src/js/global.js.
         * Keeping only one mobile-menu controller prevents double-toggle conflicts
         * where the menu opens and immediately closes on the same click.
         */
      }

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initReviewServiceHeader);
      } else {
        initReviewServiceHeader();
      }
    })();
  </script>

  <main id="primary" class="pt-[78px]">