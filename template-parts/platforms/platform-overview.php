<?php

/**
 * Platform Overview Section
 *
 * ReviewService.Pro — Premium White SaaS Platform Overview
 *
 * File: template-parts/platforms/platform-overview.php
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
    'focus_keyword'    => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'aeo_short_answer' => get_post_meta($post_id, 'rsp_aeo_short_answer', true),
    'ai_summary'       => get_post_meta($post_id, 'rsp_ai_summary', true),
    'common_problems'  => get_post_meta($post_id, 'rsp_common_problems', true),
    'best_for'         => get_post_meta($post_id, 'rsp_best_for', true),
    'platform_url'     => get_post_meta($post_id, 'rsp_platform_url', true),
    'cta_url'          => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword    = $platform_data['focus_keyword'] ?? '';
$aeo_short_answer = $platform_data['aeo_short_answer'] ?? '';
$ai_summary       = $platform_data['ai_summary'] ?? '';
$common_problems  = $platform_data['common_problems'] ?? '';
$best_for         = $platform_data['best_for'] ?? '';
$platform_url     = $platform_data['platform_url'] ?? '';
$cta_url          = $platform_data['cta_url'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('audit') : home_url('/contact/?type=free-audit');
}

$intro_text = $focus_keyword
  ? sprintf(
    /* translators: %s: focus keyword */
    __('A strong %s system helps businesses monitor reviews, respond professionally, identify platform risks, and build customer trust without unsafe review tactics.', 'reviewservicepro'),
    $focus_keyword
  )
  : sprintf(
    /* translators: %s: platform name */
    __('A strong %s reputation system helps businesses monitor reviews, respond professionally, identify platform risks, and build customer trust without unsafe review tactics.', 'reviewservicepro'),
    $platform_name
  );

$quick_answer = ! empty($aeo_short_answer)
  ? wp_trim_words(wp_strip_all_tags($aeo_short_answer), 42)
  : sprintf(
    /* translators: %s: platform name */
    __('%s reputation management focuses on monitoring real customer feedback, improving response quality, documenting issues, and strengthening trust signals using ethical, platform-compliant methods.', 'reviewservicepro'),
    $platform_name
  );

$ai_summary_text = ! empty($ai_summary)
  ? wp_trim_words(wp_strip_all_tags($ai_summary), 54)
  : __('This overview explains what customers notice, which reputation gaps matter, and how a structured ORM workflow can support better trust, visibility, and response consistency.', 'reviewservicepro');

$problem_text = ! empty($common_problems)
  ? wp_trim_words(wp_strip_all_tags($common_problems), 38)
  : __('Common issues include unanswered reviews, low rating confidence, outdated platform profiles, unclear policy handling, and no consistent review monitoring workflow.', 'reviewservicepro');

$best_for_text = ! empty($best_for)
  ? wp_trim_words(wp_strip_all_tags($best_for), 38)
  : __('Best for local businesses, service providers, ecommerce brands, agencies, clinics, restaurants, salons, and teams that depend on customer trust.', 'reviewservicepro');

$overview_cards = [
  [
    'icon'  => 'radar',
    'title' => __('Monitor reputation signals', 'reviewservicepro'),
    'text'  => __('Track visible feedback, response gaps, platform consistency, and review patterns that shape customer confidence.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-square-text',
    'title' => __('Improve response quality', 'reviewservicepro'),
    'text'  => __('Use calm, professional, brand-safe response direction for positive, neutral, and negative review situations.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'shield-check',
    'title' => __('Stay platform-compliant', 'reviewservicepro'),
    'text'  => __('Focus on ethical monitoring, documentation, genuine feedback workflows, and safe reporting where appropriate.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$tone_classes = [
  'blue'  => ['card' => 'border-blue-200 bg-blue-50/80', 'icon' => 'border-blue-200 bg-white text-blue-600'],
  'green' => ['card' => 'border-emerald-200 bg-emerald-50/80', 'icon' => 'border-emerald-200 bg-white text-emerald-600'],
  'teal'  => ['card' => 'border-teal-200 bg-teal-50/80', 'icon' => 'border-teal-200 bg-white text-teal-600'],
];

$render_icon = static function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section
  id="platform-overview"
  class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  data-gsap="platform-overview"
  aria-labelledby="platform-overview-title">

  <style>
    #platform-overview {
      --rsp-platform-overview-title: #334155;
      --rsp-platform-overview-heading: #3B4658;
      --rsp-platform-overview-body: #64748B;
    }

    #platform-overview .rsp-platform-overview-title,
    #platform-overview .rsp-platform-overview-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #platform-overview .rsp-platform-overview-title {
      color: var(--rsp-platform-overview-title);
      text-wrap: balance;
    }

    #platform-overview .rsp-platform-overview-heading {
      color: var(--rsp-platform-overview-heading);
    }

    #platform-overview .rsp-platform-overview-text,
    #platform-overview .rsp-platform-overview-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-platform-overview-body);
    }

    #platform-overview .rsp-platform-overview-text {
      font-weight: 500;
    }

    #platform-overview .rsp-platform-overview-body {
      font-weight: 400;
    }

    #platform-overview .rsp-platform-overview-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #platform-overview .rsp-platform-overview-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #platform-overview .rsp-platform-overview-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #platform-overview .rsp-platform-overview-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #platform-overview .rsp-platform-overview-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.24),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.26),
          rgba(37, 99, 235, 0.08));
      opacity: 0.68;
      transform: rotate(0deg);
      animation: rspPlatformOverviewBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #platform-overview .rsp-platform-overview-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-platform-overview-inner, #ffffff);
      pointer-events: none;
    }

    #platform-overview .rsp-platform-overview-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #platform-overview .rsp-platform-overview-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-overview .rsp-platform-overview-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #platform-overview .rsp-platform-overview-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-overview .rsp-platform-overview-btn::before {
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

    #platform-overview .rsp-platform-overview-btn:hover {
      transform: translateY(-3px);
    }

    #platform-overview .rsp-platform-overview-btn:hover::before {
      left: 135%;
    }

    @keyframes rspPlatformOverviewBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #platform-overview *,
      #platform-overview *::before,
      #platform-overview *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #platform-overview .rsp-platform-overview-reveal {
        opacity: 1;
        transform: none;
      }

      #platform-overview .rsp-platform-overview-card:hover,
      #platform-overview .rsp-platform-overview-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="mb-12 grid grid-cols-1 gap-8 lg:grid-cols-[0.92fr_1.08fr] lg:items-end">
      <div class="rsp-platform-overview-reveal" data-rsp-platform-overview-reveal>
        <span class="rsp-platform-overview-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
          <?php echo $render_icon('layout-dashboard', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Platform Overview', 'reviewservicepro'); ?>
        </span>

        <h2 id="platform-overview-title" class="rsp-platform-overview-title text-[clamp(32px,4.5vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
          <?php
          printf(
            esc_html__('How %s reputation management works', 'reviewservicepro'),
            esc_html($platform_name)
          );
          ?>
        </h2>
      </div>

      <div class="rsp-platform-overview-reveal rsp-platform-overview-motion-border rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platform-overview-reveal style="--rsp-platform-overview-inner:#ffffff;">
        <p class="relative z-10 rsp-platform-overview-text">
          <?php echo esc_html(wp_strip_all_tags($intro_text)); ?>
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_0.74fr]">

      <div class="rsp-platform-overview-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_20px_70px_rgba(15,23,42,0.075)] md:p-8" data-rsp-platform-overview-reveal>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
          <?php foreach ($overview_cards as $index => $card) : ?>
            <?php $tone = $tone_classes[$card['tone']] ?? $tone_classes['blue']; ?>

            <article class="rsp-platform-overview-card rounded-[1.4rem] border <?php echo esc_attr($tone['card']); ?> p-5" style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
              <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl border <?php echo esc_attr($tone['icon']); ?> shadow-sm">
                <?php echo $render_icon($card['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>

              <h3 class="rsp-platform-overview-heading text-lg font-[800] leading-tight tracking-[-0.03em]">
                <?php echo esc_html($card['title']); ?>
              </h3>

              <p class="rsp-platform-overview-body mt-3 text-sm leading-7">
                <?php echo esc_html($card['text']); ?>
              </p>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="mt-6 rounded-[1.5rem] border border-blue-200 bg-blue-50/80 p-6">
          <p class="rsp-platform-overview-eyebrow text-blue-700">
            <?php esc_html_e('AEO Short Answer', 'reviewservicepro'); ?>
          </p>

          <p class="rsp-platform-overview-body mt-3">
            <?php echo esc_html($quick_answer); ?>
          </p>
        </div>

        <div class="mt-5 rounded-[1.5rem] border border-emerald-200 bg-emerald-50/75 p-6">
          <p class="rsp-platform-overview-eyebrow text-emerald-700">
            <?php esc_html_e('AI Summary', 'reviewservicepro'); ?>
          </p>

          <p class="rsp-platform-overview-body mt-3">
            <?php echo esc_html($ai_summary_text); ?>
          </p>
        </div>
      </div>

      <aside class="space-y-5">
        <div class="rsp-platform-overview-reveal rsp-platform-overview-card rounded-[2rem] border border-amber-200 bg-amber-50/80 p-6 shadow-[0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-platform-overview-reveal>
          <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl border border-amber-200 bg-white text-amber-600 shadow-sm">
            <?php echo $render_icon('triangle-alert', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h3 class="rsp-platform-overview-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
            <?php esc_html_e('Common reputation gaps', 'reviewservicepro'); ?>
          </h3>

          <p class="rsp-platform-overview-body mt-4">
            <?php echo esc_html($problem_text); ?>
          </p>
        </div>

        <div class="rsp-platform-overview-reveal rsp-platform-overview-card rounded-[2rem] border border-teal-200 bg-teal-50/75 p-6 shadow-[0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-platform-overview-reveal>
          <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl border border-teal-200 bg-white text-teal-600 shadow-sm">
            <?php echo $render_icon('users-round', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h3 class="rsp-platform-overview-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
            <?php esc_html_e('Best fit', 'reviewservicepro'); ?>
          </h3>

          <p class="rsp-platform-overview-body mt-4">
            <?php echo esc_html($best_for_text); ?>
          </p>
        </div>

        <div class="rsp-platform-overview-reveal rsp-platform-overview-motion-border rounded-[2rem] border border-blue-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platform-overview-reveal style="--rsp-platform-overview-inner:#ffffff;">
          <div class="relative z-10">
            <h3 class="rsp-platform-overview-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
              <?php esc_html_e('Need a platform check?', 'reviewservicepro'); ?>
            </h3>

            <p class="rsp-platform-overview-body mt-4">
              <?php esc_html_e('Start with a reputation audit to identify response gaps, review risks, and trust signal opportunities.', 'reviewservicepro'); ?>
            </p>

            <div class="mt-6 flex flex-col gap-3">
              <a href="<?php echo esc_url($cta_url); ?>" class="rsp-platform-overview-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <?php esc_html_e('Request Audit', 'reviewservicepro'); ?>
                  <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </span>
              </a>

              <?php if (! empty($platform_url)) : ?>
                <a href="<?php echo esc_url($platform_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                  <?php esc_html_e('Visit Official Platform', 'reviewservicepro'); ?>
                  <?php echo $render_icon('external-link', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </aside>

    </div>

  </div>
</section>

<script>
  (function() {
    function initRspPlatformOverview() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-platform-overview-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformOverviewVisible === 'true') {
          return;
        }

        item.dataset.rspPlatformOverviewVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspPlatformOverview);
    } else {
      initRspPlatformOverview();
    }
  })();
</script>