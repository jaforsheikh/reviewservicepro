<?php

/**
 * Industry Final CTA Section
 *
 * ReviewService.Pro — Premium White SaaS Industry CTA
 *
 * File: template-parts/industries/industry-cta.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id       = get_the_ID();
$industry_name = get_the_title($post_id);

if (function_exists('rsp_acf_get_industry_data')) {
  $industry_data = rsp_acf_get_industry_data($post_id);
} else {
  $industry_data = [
    'focus_keyword' => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'industry_icon' => get_post_meta($post_id, 'rsp_industry_icon', true),
    'cta_url'       => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword = $industry_data['focus_keyword'] ?? '';
$industry_icon = $industry_data['industry_icon'] ?? 'building-2';
$cta_url       = $industry_data['cta_url'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('industry') : home_url('/contact/?type=industry-audit');
}

$consultation_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('consultation') : home_url('/contact/?type=consultation');
$response_note    = function_exists('rsp_get_response_time_note') ? rsp_get_response_time_note() : __('Typical response time: within one business day.', 'reviewservicepro');
$icon             = ! empty($industry_icon) ? sanitize_key($industry_icon) : 'building-2';

$render_icon = function ($icon_name, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon_name, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon_name) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$trust_badges = [
  [
    'icon' => 'shield-check',
    'text' => __('Ethical ORM only', 'reviewservicepro'),
  ],
  [
    'icon' => 'badge-check',
    'text' => __('Platform-compliant methods', 'reviewservicepro'),
  ],
  [
    'icon' => 'radar',
    'text' => __('Review risk monitoring', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock-keyhole',
    'text' => __('Private consultation', 'reviewservicepro'),
  ],
];

$steps = [
  [
    'number' => '01',
    'title'  => __('Submit industry audit request', 'reviewservicepro'),
    'text'   => __('Share your business type, website, platforms, and reputation concerns.', 'reviewservicepro'),
  ],
  [
    'number' => '02',
    'title'  => __('We review your trust signals', 'reviewservicepro'),
    'text'   => __('We check reviews, responses, profile gaps, platform visibility, and customer-facing reputation risks.', 'reviewservicepro'),
  ],
  [
    'number' => '03',
    'title'  => __('Receive safe next steps', 'reviewservicepro'),
    'text'   => __('You get compliance-safe guidance focused on monitoring, response quality, documentation, and ethical trust-building.', 'reviewservicepro'),
  ],
];
?>

<section
  id="industry-cta"
  class="relative overflow-hidden bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="industry-cta-title">

  <style>
    #industry-cta {
      --rsp-cta-title: #334155;
      --rsp-cta-heading: #3B4658;
      --rsp-cta-body: #64748B;
    }

    #industry-cta .rsp-cta-title,
    #industry-cta .rsp-cta-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #industry-cta .rsp-cta-title {
      color: var(--rsp-cta-title);
      text-wrap: balance;
    }

    #industry-cta .rsp-cta-heading {
      color: var(--rsp-cta-heading);
    }

    #industry-cta .rsp-cta-text,
    #industry-cta .rsp-cta-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-cta-body);
    }

    #industry-cta .rsp-cta-text {
      font-weight: 500;
    }

    #industry-cta .rsp-cta-body {
      font-weight: 400;
    }

    #industry-cta .rsp-cta-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industry-cta .rsp-cta-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industry-cta .rsp-cta-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industry-cta .rsp-cta-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #industry-cta .rsp-cta-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.26),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.26),
          rgba(37, 99, 235, 0.08));
      opacity: 0.7;
      transform: rotate(0deg);
      animation: rspCtaBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #industry-cta .rsp-cta-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-cta-inner, #ffffff);
      pointer-events: none;
    }

    #industry-cta .rsp-cta-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #industry-cta .rsp-cta-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #industry-cta .rsp-cta-card:hover {
      transform: translateY(-5px);
      border-color: rgba(37, 99, 235, 0.22);
      box-shadow: 0 20px 60px rgba(15, 23, 42, 0.10);
    }

    #industry-cta .rsp-cta-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #industry-cta .rsp-cta-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      z-index: 0;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
      pointer-events: none;
    }

    #industry-cta .rsp-cta-btn:hover {
      transform: translateY(-3px);
    }

    #industry-cta .rsp-cta-btn:hover::before {
      left: 135%;
    }

    @keyframes rspCtaBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #industry-cta *,
      #industry-cta *::before,
      #industry-cta *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #industry-cta .rsp-cta-reveal {
        opacity: 1;
        transform: none;
      }

      #industry-cta .rsp-cta-card:hover,
      #industry-cta .rsp-cta-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="rsp-cta-reveal rsp-cta-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-cta-reveal style="--rsp-cta-inner:#ffffff;">
      <div class="relative z-10 grid grid-cols-1 gap-10 lg:grid-cols-[1fr_0.8fr] lg:items-center">

        <div>
          <span class="rsp-cta-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
            <?php echo $render_icon($icon, 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Industry Reputation Audit', 'reviewservicepro'); ?>
          </span>

          <h2 id="industry-cta-title" class="rsp-cta-title text-[clamp(32px,4.8vw,62px)] font-[800] leading-[1.06] tracking-[-0.058em]">
            <?php
            printf(
              esc_html__('Want to know where your %s reputation stands?', 'reviewservicepro'),
              esc_html($industry_name)
            );
            ?>
          </h2>

          <p class="rsp-cta-text mt-6 max-w-2xl">
            <?php
            printf(
              esc_html__('Get a practical reputation audit for your %s business. We review public trust signals, review risks, response gaps, platform consistency, and ethical improvement opportunities.', 'reviewservicepro'),
              esc_html($industry_name)
            );
            ?>
          </p>

          <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:flex-wrap">
            <a href="<?php echo esc_url($cta_url); ?>" class="rsp-cta-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Request Industry Audit', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>

            <a href="<?php echo esc_url($consultation_url); ?>" class="rsp-cta-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
                <?php echo $render_icon('calendar-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>
          </div>

          <div class="mt-7 flex flex-wrap gap-3">
            <?php foreach ($trust_badges as $badge) : ?>
              <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-slate-600">
                <?php echo $render_icon($badge['icon'], 'h-4 w-4 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php echo esc_html($badge['text']); ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="space-y-4">
          <?php foreach ($steps as $index => $step) : ?>
            <div class="rsp-cta-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-[0_14px_45px_rgba(15,23,42,0.06)]" style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
              <div class="flex gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 font-['DM_Mono',monospace] text-sm font-[800] text-blue-700">
                  <?php echo esc_html($step['number']); ?>
                </span>

                <div>
                  <h3 class="rsp-cta-heading text-xl font-[800] leading-tight tracking-[-0.035em]">
                    <?php echo esc_html($step['title']); ?>
                  </h3>

                  <p class="rsp-cta-body mt-2">
                    <?php echo esc_html($step['text']); ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <div class="rounded-[1.5rem] border border-emerald-200 bg-emerald-50/75 p-5">
            <div class="mb-3 flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-emerald-700">
              <?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Ethical and confidential', 'reviewservicepro'); ?>
            </div>

            <p class="rsp-cta-body">
              <?php esc_html_e('Your inquiry is private. We review your reputation situation professionally and never recommend fake reviews, spam, impersonation, or platform manipulation.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="rounded-[1.5rem] border border-blue-200 bg-blue-50/75 p-5">
            <div class="flex items-start gap-3">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                <?php echo $render_icon('clock-3', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>

              <p class="rsp-cta-body">
                <?php echo esc_html($response_note); ?>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspIndustryCta() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-cta-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspCtaVisible === 'true') {
          return;
        }

        item.dataset.rspCtaVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspIndustryCta);
    } else {
      initRspIndustryCta();
    }
  })();
</script>