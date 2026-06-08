<?php

/**
 * Platform Final CTA Section
 *
 * ReviewService.Pro — Premium White SaaS Platform CTA
 *
 * File: template-parts/platforms/platform-cta.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id       = get_the_ID();
$platform_name = get_the_title($post_id);

if (function_exists('rsp_acf_get_platform_data')) {
  $platform_data = rsp_acf_get_platform_data($post_id);
} else {
  $platform_data = [
    'focus_keyword' => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'platform_logo' => get_post_meta($post_id, 'rsp_platform_logo', true),
    'platform_url'  => get_post_meta($post_id, 'rsp_platform_url', true),
    'cta_url'       => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword = $platform_data['focus_keyword'] ?? '';
$platform_logo = function_exists('rsp_get_platform_logo') ? rsp_get_platform_logo($post_id) : ($platform_data['platform_logo'] ?? '');
$platform_url  = $platform_data['platform_url'] ?? '';
$cta_url       = $platform_data['cta_url'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('audit') : home_url('/contact/?type=free-audit');
}

$consultation_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('consultation') : home_url('/contact/?type=consultation');
$response_note    = function_exists('rsp_get_response_time_note') ? rsp_get_response_time_note() : __('Typical response time: within one business day.', 'reviewservicepro');

$trust_badges = [
  [
    'icon' => 'shield-check',
    'text' => __('Ethical ORM only', 'reviewservicepro'),
  ],
  [
    'icon' => 'ban',
    'text' => __('No fake reviews', 'reviewservicepro'),
  ],
  [
    'icon' => 'badge-check',
    'text' => __('Platform-compliant support', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock',
    'text' => __('Secure communication', 'reviewservicepro'),
  ],
];

$steps = [
  [
    'number' => '01',
    'title'  => __('Audit your current reputation', 'reviewservicepro'),
    'text'   => __('We review visible trust signals, reviews, profile consistency, response gaps, and platform-specific issues.', 'reviewservicepro'),
    'icon'   => 'search-check',
  ],
  [
    'number' => '02',
    'title'  => __('Prioritize safe next actions', 'reviewservicepro'),
    'text'   => __('You receive clear guidance for monitoring, response quality, documentation, feedback workflows, and reporting.', 'reviewservicepro'),
    'icon'   => 'list-checks',
  ],
  [
    'number' => '03',
    'title'  => __('Build long-term trust', 'reviewservicepro'),
    'text'   => __('We help strengthen customer confidence through ethical, transparent, platform-compliant reputation systems.', 'reviewservicepro'),
    'icon'   => 'trending-up',
  ],
];

$render_icon = static function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section
  id="platform-cta"
  class="relative overflow-hidden bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  data-gsap="platform-cta"
  aria-labelledby="platform-cta-title">

  <style>
    #platform-cta {
      --rsp-platform-cta-title: #334155;
      --rsp-platform-cta-heading: #3B4658;
      --rsp-platform-cta-body: #64748B;
    }

    #platform-cta .rsp-platform-cta-title,
    #platform-cta .rsp-platform-cta-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #platform-cta .rsp-platform-cta-title {
      color: var(--rsp-platform-cta-title);
      text-wrap: balance;
    }

    #platform-cta .rsp-platform-cta-heading {
      color: var(--rsp-platform-cta-heading);
    }

    #platform-cta .rsp-platform-cta-text,
    #platform-cta .rsp-platform-cta-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-platform-cta-body);
    }

    #platform-cta .rsp-platform-cta-text {
      font-weight: 500;
    }

    #platform-cta .rsp-platform-cta-body {
      font-weight: 400;
    }

    #platform-cta .rsp-platform-cta-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #platform-cta .rsp-platform-cta-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #platform-cta .rsp-platform-cta-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #platform-cta .rsp-platform-cta-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #platform-cta .rsp-platform-cta-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.26),
          rgba(20, 184, 166, 0.20),
          rgba(37, 99, 235, 0.28),
          rgba(37, 99, 235, 0.08));
      opacity: 0.76;
      transform: rotate(0deg);
      animation: rspPlatformCtaBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #platform-cta .rsp-platform-cta-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-platform-cta-inner, #ffffff);
      pointer-events: none;
    }

    #platform-cta .rsp-platform-cta-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #platform-cta .rsp-platform-cta-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-cta .rsp-platform-cta-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #platform-cta .rsp-platform-cta-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-cta .rsp-platform-cta-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      z-index: 0;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
      pointer-events: none;
    }

    #platform-cta .rsp-platform-cta-btn:hover {
      transform: translateY(-3px);
    }

    #platform-cta .rsp-platform-cta-btn:hover::before {
      left: 135%;
    }

    @keyframes rspPlatformCtaBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #platform-cta *,
      #platform-cta *::before,
      #platform-cta *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #platform-cta .rsp-platform-cta-reveal {
        opacity: 1;
        transform: none;
      }

      #platform-cta .rsp-platform-cta-card:hover,
      #platform-cta .rsp-platform-cta-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.08),transparent_30%)]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="rsp-platform-cta-reveal rsp-platform-cta-motion-border rounded-[2.25rem] border border-slate-200 bg-white p-6 shadow-[0_30px_100px_rgba(15,23,42,0.10)] md:p-10" data-rsp-platform-cta-reveal style="--rsp-platform-cta-inner:#ffffff;">
      <div class="relative z-10 grid grid-cols-1 gap-10 lg:grid-cols-[1.04fr_0.96fr] lg:items-center">

        <div>
          <div class="mb-6 flex flex-wrap items-center gap-3">
            <?php if (! empty($platform_logo)) : ?>
              <div class="inline-flex rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                <img
                  src="<?php echo esc_url($platform_logo); ?>"
                  alt="<?php echo esc_attr(sprintf(__('%s logo', 'reviewservicepro'), $platform_name)); ?>"
                  class="h-10 w-auto object-contain"
                  loading="lazy"
                  decoding="async">
              </div>
            <?php endif; ?>

            <span class="rsp-platform-cta-eyebrow inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
              <?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Ethical Platform ORM', 'reviewservicepro'); ?>
            </span>
          </div>

          <h2 id="platform-cta-title" class="rsp-platform-cta-title text-[clamp(34px,5vw,66px)] font-[800] leading-[1.04] tracking-[-0.06em]">
            <?php
            printf(
              esc_html__('Ready to improve your %s reputation system?', 'reviewservicepro'),
              esc_html($platform_name)
            );
            ?>
          </h2>

          <p class="rsp-platform-cta-text mt-6 max-w-2xl">
            <?php
            printf(
              esc_html__('Start with a practical audit. We will review your %s visibility, response gaps, review risks, profile consistency, and trust-building opportunities using ethical, platform-compliant ORM methods.', 'reviewservicepro'),
              esc_html($focus_keyword ? $focus_keyword : $platform_name)
            );
            ?>
          </p>

          <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:flex-wrap">
            <a href="<?php echo esc_url($cta_url); ?>" class="rsp-platform-cta-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_18px_44px_rgba(37,99,235,0.26)] hover:bg-blue-700 hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php echo $render_icon('search-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
              </span>
            </a>

            <a href="<?php echo esc_url($consultation_url); ?>" class="rsp-platform-cta-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php echo $render_icon('calendar-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
              </span>
            </a>
          </div>

          <p class="mt-5 font-['Inter',sans-serif] text-sm font-semibold leading-7 text-slate-500">
            <?php echo esc_html($response_note); ?>
          </p>

          <?php if (! empty($platform_url)) : ?>
            <a href="<?php echo esc_url($platform_url); ?>" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700 hover:text-blue-800">
              <?php esc_html_e('View official platform reference', 'reviewservicepro'); ?>
              <?php echo $render_icon('external-link', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </a>
          <?php endif; ?>
        </div>

        <div class="space-y-5">
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <?php foreach ($trust_badges as $index => $badge) : ?>
              <div class="rsp-platform-cta-card rounded-[1.5rem] border border-emerald-200 bg-emerald-50/75 p-5" style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl border border-emerald-200 bg-white text-emerald-600 shadow-sm">
                  <?php echo $render_icon($badge['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </div>

                <p class="font-['Inter',sans-serif] text-sm font-[800] leading-6 text-emerald-800">
                  <?php echo esc_html($badge['text']); ?>
                </p>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="rounded-[1.75rem] border border-slate-200 bg-[#F8FAFC] p-5">
            <p class="rsp-platform-cta-eyebrow mb-4 text-slate-500">
              <?php esc_html_e('Audit workflow', 'reviewservicepro'); ?>
            </p>

            <div class="space-y-4">
              <?php foreach ($steps as $step) : ?>
                <div class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                  <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-200 bg-blue-50 text-blue-600">
                    <?php echo $render_icon($step['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                  </div>

                  <div>
                    <div class="mb-1 flex items-center gap-2">
                      <span class="font-['DM_Mono',monospace] text-xs font-[800] text-blue-700">
                        <?php echo esc_html($step['number']); ?>
                      </span>

                      <h3 class="rsp-platform-cta-heading text-base font-[800] leading-tight tracking-[-0.02em]">
                        <?php echo esc_html($step['title']); ?>
                      </h3>
                    </div>

                    <p class="font-['Inter',sans-serif] text-sm font-medium leading-7 text-slate-600">
                      <?php echo esc_html($step['text']); ?>
                    </p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspPlatformCta() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-platform-cta-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformCtaVisible === 'true') {
          return;
        }

        item.dataset.rspPlatformCtaVisible = 'true';
        item.classList.add('rsp-visible');
      }

      if ('IntersectionObserver' in window && items.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              reveal(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });

        return;
      }

      items.forEach(reveal);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPlatformCta);
    } else {
      initRspPlatformCta();
    }
  })();
</script>