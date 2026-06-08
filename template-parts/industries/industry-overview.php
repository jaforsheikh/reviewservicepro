<?php

/**
 * Industry Overview Section
 *
 * ReviewService.Pro — Premium White SaaS Industry Overview
 *
 * File: template-parts/industries/industry-overview.php
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
    'focus_keyword'              => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'aeo_short_answer'           => get_post_meta($post_id, 'rsp_aeo_short_answer', true),
    'ai_summary'                 => get_post_meta($post_id, 'rsp_ai_summary', true),
    'trust_factors'              => get_post_meta($post_id, 'rsp_trust_factors', true),
    'reputation_challenges'      => get_post_meta($post_id, 'rsp_reputation_challenges', true),
    'recommended_platforms'      => get_post_meta($post_id, 'rsp_recommended_platforms', true),
    'customer_decision_triggers' => get_post_meta($post_id, 'rsp_customer_decision_triggers', true),
    'local_global_angle'         => get_post_meta($post_id, 'rsp_local_global_angle', true),
    'cta_url'                    => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword              = $industry_data['focus_keyword'] ?? '';
$aeo_short_answer           = $industry_data['aeo_short_answer'] ?? '';
$ai_summary                 = $industry_data['ai_summary'] ?? '';
$trust_factors              = $industry_data['trust_factors'] ?? '';
$reputation_challenges      = $industry_data['reputation_challenges'] ?? '';
$recommended_platforms      = $industry_data['recommended_platforms'] ?? '';
$customer_decision_triggers = $industry_data['customer_decision_triggers'] ?? get_post_meta($post_id, 'rsp_customer_decision_triggers', true);
$local_global_angle         = $industry_data['local_global_angle'] ?? get_post_meta($post_id, 'rsp_local_global_angle', true);
$cta_url                    = $industry_data['cta_url'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('industry') : home_url('/contact/?type=industry-audit');
}

$render_icon = function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$split_items = function ($value) {
  if (empty($value)) {
    return [];
  }

  if (is_array($value)) {
    $raw_items = $value;
  } else {
    $raw_items = preg_split('/\r\n|\r|\n|,/', (string) $value);
  }

  $items = [];

  foreach ($raw_items as $item) {
    $item = trim(wp_strip_all_tags((string) $item));

    if (! empty($item)) {
      $items[] = $item;
    }
  }

  return array_values(array_unique($items));
};

$platform_items = $split_items($recommended_platforms);
$trust_items    = $split_items($trust_factors);
$challenge_items = $split_items($reputation_challenges);

$overview_intro = $focus_keyword
  ? sprintf(
    /* translators: 1: industry name, 2: focus keyword */
    __('For %1$s businesses, %2$s is not just a marketing activity. It is a trust system that influences how customers compare options, judge credibility, and decide who deserves their attention.', 'reviewservicepro'),
    $industry_name,
    $focus_keyword
  )
  : sprintf(
    /* translators: %s: industry name */
    __('For %s businesses, online reputation is often the first proof customers see before they call, book, visit, or request a quote.', 'reviewservicepro'),
    $industry_name
  );

$overview_cards = [
  [
    'icon'  => 'search-check',
    'title' => __('Review visibility', 'reviewservicepro'),
    'text'  => __('Monitor where reviews appear, which platforms matter most, and what customers see before they contact you.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-square-text',
    'title' => __('Response quality', 'reviewservicepro'),
    'text'  => __('Build calm, professional, brand-safe response workflows for positive, neutral, and negative reviews.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'bar-chart-3',
    'title' => __('Trust reporting', 'reviewservicepro'),
    'text'  => __('Track reputation signals, review trends, response gaps, profile issues, and practical next steps over time.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
];

$tone_classes = [
  'blue' => [
    'card' => 'border-blue-200 bg-blue-50/80',
    'icon' => 'border-blue-200 bg-white text-blue-600',
  ],
  'green' => [
    'card' => 'border-emerald-200 bg-emerald-50/80',
    'icon' => 'border-emerald-200 bg-white text-emerald-600',
  ],
  'teal' => [
    'card' => 'border-teal-200 bg-teal-50/80',
    'icon' => 'border-teal-200 bg-white text-teal-600',
  ],
];
?>

<section
  id="industry-overview"
  class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-16 sm:px-6 lg:px-8 lg:py-20"
  aria-labelledby="industry-overview-title">

  <style>
    #industry-overview {
      --rsp-overview-title: #334155;
      --rsp-overview-heading: #3B4658;
      --rsp-overview-body: #64748B;
    }

    #industry-overview .rsp-overview-title,
    #industry-overview .rsp-overview-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #industry-overview .rsp-overview-title {
      color: var(--rsp-overview-title);
      text-wrap: balance;
    }

    #industry-overview .rsp-overview-heading {
      color: var(--rsp-overview-heading);
    }

    #industry-overview .rsp-overview-text,
    #industry-overview .rsp-overview-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-overview-body);
    }

    #industry-overview .rsp-overview-text {
      font-weight: 500;
    }

    #industry-overview .rsp-overview-body {
      font-weight: 400;
    }

    #industry-overview .rsp-overview-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industry-overview .rsp-overview-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industry-overview .rsp-overview-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industry-overview .rsp-overview-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #industry-overview .rsp-overview-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.10);
    }

    #industry-overview .rsp-overview-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #industry-overview .rsp-overview-motion-border::before {
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
      animation: rspOverviewBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #industry-overview .rsp-overview-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-overview-inner, #ffffff);
      pointer-events: none;
    }

    #industry-overview .rsp-overview-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #industry-overview .rsp-overview-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #industry-overview .rsp-overview-btn::before {
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

    #industry-overview .rsp-overview-btn:hover {
      transform: translateY(-3px);
    }

    #industry-overview .rsp-overview-btn:hover::before {
      left: 135%;
    }

    @keyframes rspOverviewBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #industry-overview *,
      #industry-overview *::before,
      #industry-overview *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #industry-overview .rsp-overview-reveal {
        opacity: 1;
        transform: none;
      }

      #industry-overview .rsp-overview-card:hover,
      #industry-overview .rsp-overview-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.88fr_1.12fr] lg:items-start">

      <div class="rsp-overview-reveal lg:sticky lg:top-28" data-rsp-overview-reveal>
        <span class="rsp-overview-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
          <?php echo $render_icon('compass', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Industry ORM Overview', 'reviewservicepro'); ?>
        </span>

        <h2
          id="industry-overview-title"
          class="rsp-overview-title text-[clamp(30px,4.2vw,54px)] font-[800] leading-[1.08] tracking-[-0.055em]">
          <?php
          printf(
            esc_html__('How reputation shapes %s customer decisions', 'reviewservicepro'),
            esc_html($industry_name)
          );
          ?>
        </h2>

        <p class="rsp-overview-text mt-5 max-w-2xl">
          <?php echo esc_html($overview_intro); ?>
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row lg:flex-col">
          <a href="<?php echo esc_url($cta_url); ?>" class="rsp-overview-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Get Industry Audit', 'reviewservicepro'); ?>
              <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </span>
          </a>
        </div>
      </div>

      <div class="space-y-6">
        <div class="rsp-overview-reveal rsp-overview-motion-border rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-overview-reveal style="--rsp-overview-inner:#ffffff;">
          <div class="relative z-10">
            <p class="rsp-overview-eyebrow mb-4 text-blue-700">
              <?php esc_html_e('Answer Engine Summary', 'reviewservicepro'); ?>
            </p>

            <p class="rsp-overview-body">
              <?php
              if (! empty($aeo_short_answer)) {
                echo esc_html(wp_strip_all_tags($aeo_short_answer));
              } else {
                printf(
                  esc_html__('%s businesses need reputation management because reviews, response quality, profile accuracy, and trust signals can influence whether customers choose them or a competitor.', 'reviewservicepro'),
                  esc_html($industry_name)
                );
              }
              ?>
            </p>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
          <?php foreach ($overview_cards as $index => $card) : ?>
            <?php $tone = $tone_classes[$card['tone']] ?? $tone_classes['blue']; ?>

            <div
              class="rsp-overview-card rsp-overview-reveal rounded-[1.4rem] border <?php echo esc_attr($tone['card']); ?> p-5"
              data-rsp-overview-reveal
              style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
              <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl border <?php echo esc_attr($tone['icon']); ?> shadow-sm">
                <?php echo $render_icon($card['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>

              <h3 class="rsp-overview-heading text-lg font-[800] leading-tight tracking-[-0.03em]">
                <?php echo esc_html($card['title']); ?>
              </h3>

              <p class="mt-3 font-['Inter',sans-serif] text-sm font-medium leading-7 text-[#64748B]">
                <?php echo esc_html($card['text']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div class="rsp-overview-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_16px_50px_rgba(15,23,42,0.06)]" data-rsp-overview-reveal>
            <p class="rsp-overview-eyebrow mb-4 text-emerald-700">
              <?php esc_html_e('Trust Factors', 'reviewservicepro'); ?>
            </p>

            <?php if (! empty($trust_items)) : ?>
              <ul class="space-y-3">
                <?php foreach (array_slice($trust_items, 0, 6) as $item) : ?>
                  <li class="flex gap-3 font-['Inter',sans-serif] text-[16px] font-medium leading-7 text-[#64748B]">
                    <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                    <span><?php echo esc_html($item); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else : ?>
              <p class="rsp-overview-body">
                <?php esc_html_e('Review freshness, response tone, platform profile accuracy, service consistency, and transparent communication are key trust signals.', 'reviewservicepro'); ?>
              </p>
            <?php endif; ?>
          </div>

          <div class="rsp-overview-reveal rounded-[2rem] border border-blue-200 bg-blue-50/70 p-6 shadow-[0_16px_50px_rgba(15,23,42,0.05)]" data-rsp-overview-reveal>
            <p class="rsp-overview-eyebrow mb-4 text-blue-700">
              <?php esc_html_e('Recommended Platforms', 'reviewservicepro'); ?>
            </p>

            <?php if (! empty($platform_items)) : ?>
              <div class="flex flex-wrap gap-2">
                <?php foreach (array_slice($platform_items, 0, 12) as $platform) : ?>
                  <span class="rounded-xl border border-blue-200 bg-white px-3 py-2 font-['Inter',sans-serif] text-xs font-[800] text-blue-700 shadow-sm">
                    <?php echo esc_html($platform); ?>
                  </span>
                <?php endforeach; ?>
              </div>
            <?php else : ?>
              <p class="rsp-overview-body">
                <?php esc_html_e('Google Business Profile, Facebook, Trustpilot, Yelp, BBB, Sitejabber, G2, Capterra, and industry-specific review platforms may matter depending on the business model.', 'reviewservicepro'); ?>
              </p>
            <?php endif; ?>
          </div>
        </div>

        <?php if (! empty($ai_summary) || ! empty($customer_decision_triggers) || ! empty($local_global_angle)) : ?>
          <div class="rsp-overview-reveal rounded-[2rem] border border-emerald-200 bg-emerald-50/70 p-6 shadow-[0_16px_50px_rgba(15,23,42,0.05)] md:p-8" data-rsp-overview-reveal>
            <p class="rsp-overview-eyebrow mb-4 text-emerald-700">
              <?php esc_html_e('Strategic Insight', 'reviewservicepro'); ?>
            </p>

            <div class="space-y-4">
              <?php if (! empty($ai_summary)) : ?>
                <p class="rsp-overview-body"><?php echo esc_html(wp_strip_all_tags($ai_summary)); ?></p>
              <?php endif; ?>

              <?php if (! empty($customer_decision_triggers)) : ?>
                <p class="rsp-overview-body"><?php echo esc_html(wp_strip_all_tags($customer_decision_triggers)); ?></p>
              <?php endif; ?>

              <?php if (! empty($local_global_angle)) : ?>
                <p class="rsp-overview-body"><?php echo esc_html(wp_strip_all_tags($local_global_angle)); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

    </div>

  </div>
</section>

<script>
  (function() {
    function initRspIndustryOverview() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-overview-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspOverviewVisible === 'true') {
          return;
        }

        item.dataset.rspOverviewVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspIndustryOverview);
    } else {
      initRspIndustryOverview();
    }
  })();
</script>