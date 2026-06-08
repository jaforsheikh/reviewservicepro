<?php

/**
 * Industry Problems Section
 *
 * ReviewService.Pro — Premium White SaaS Industry Problems
 *
 * File: template-parts/industries/industry-problems.php
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
    'reputation_challenges'      => get_post_meta($post_id, 'rsp_reputation_challenges', true),
    'customer_decision_triggers' => get_post_meta($post_id, 'rsp_customer_decision_triggers', true),
    'cta_url'                    => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword              = $industry_data['focus_keyword'] ?? '';
$reputation_challenges      = $industry_data['reputation_challenges'] ?? '';
$customer_decision_triggers = $industry_data['customer_decision_triggers'] ?? get_post_meta($post_id, 'rsp_customer_decision_triggers', true);
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

$custom_challenges = $split_items($reputation_challenges);

$problem_cards = [
  [
    'icon'  => 'star-off',
    'title' => __('Low Rating Confidence', 'reviewservicepro'),
    'text'  => __('Weak ratings can make customers hesitate, compare competitors, or leave before contacting the business.', 'reviewservicepro'),
    'tone'  => 'amber',
  ],
  [
    'icon'  => 'message-square-warning',
    'title' => __('Unanswered Reviews', 'reviewservicepro'),
    'text'  => __('When reviews remain unanswered, customers may assume the business does not care about feedback or service quality.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'users-round',
    'title' => __('Customer Trust Loss', 'reviewservicepro'),
    'text'  => __('Poor public feedback signals can reduce trust before customers visit your website, call, book, or request a quote.', 'reviewservicepro'),
    'tone'  => 'red',
  ],
  [
    'icon'  => 'radar',
    'title' => __('No Monitoring System', 'reviewservicepro'),
    'text'  => __('Review problems can grow quietly when a business does not monitor important platforms consistently.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
  [
    'icon'  => 'file-warning',
    'title' => __('Weak Documentation', 'reviewservicepro'),
    'text'  => __('Sensitive review situations need calm documentation, platform-safe action, and clear response planning.', 'reviewservicepro'),
    'tone'  => 'purple',
  ],
  [
    'icon'  => 'map-pin-off',
    'title' => __('Incomplete Local Signals', 'reviewservicepro'),
    'text'  => __('Outdated profile details, missing service context, and inconsistent platform information can create trust gaps.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
];

$tone_classes = [
  'amber' => [
    'card' => 'border-amber-200 bg-amber-50/80',
    'icon' => 'border-amber-200 bg-white text-amber-600',
    'line' => 'from-amber-500 via-amber-400 to-transparent',
  ],
  'blue' => [
    'card' => 'border-blue-200 bg-blue-50/80',
    'icon' => 'border-blue-200 bg-white text-blue-600',
    'line' => 'from-blue-600 via-blue-400 to-transparent',
  ],
  'red' => [
    'card' => 'border-red-200 bg-red-50/80',
    'icon' => 'border-red-200 bg-white text-red-600',
    'line' => 'from-red-500 via-red-400 to-transparent',
  ],
  'teal' => [
    'card' => 'border-teal-200 bg-teal-50/80',
    'icon' => 'border-teal-200 bg-white text-teal-600',
    'line' => 'from-teal-500 via-teal-400 to-transparent',
  ],
  'purple' => [
    'card' => 'border-violet-200 bg-violet-50/80',
    'icon' => 'border-violet-200 bg-white text-violet-600',
    'line' => 'from-violet-500 via-violet-400 to-transparent',
  ],
  'green' => [
    'card' => 'border-emerald-200 bg-emerald-50/80',
    'icon' => 'border-emerald-200 bg-white text-emerald-600',
    'line' => 'from-emerald-500 via-emerald-400 to-transparent',
  ],
];
?>

<section
  id="industry-problems"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="industry-problems-title">

  <style>
    #industry-problems {
      --rsp-problem-title: #334155;
      --rsp-problem-heading: #3B4658;
      --rsp-problem-body: #64748B;
    }

    #industry-problems .rsp-problem-title,
    #industry-problems .rsp-problem-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #industry-problems .rsp-problem-title {
      color: var(--rsp-problem-title);
      text-wrap: balance;
    }

    #industry-problems .rsp-problem-heading {
      color: var(--rsp-problem-heading);
    }

    #industry-problems .rsp-problem-text,
    #industry-problems .rsp-problem-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-problem-body);
    }

    #industry-problems .rsp-problem-text {
      font-weight: 500;
    }

    #industry-problems .rsp-problem-body {
      font-weight: 400;
    }

    #industry-problems .rsp-problem-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industry-problems .rsp-problem-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industry-problems .rsp-problem-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industry-problems .rsp-problem-card {
      position: relative;
      overflow: hidden;
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #industry-problems .rsp-problem-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.10);
    }

    #industry-problems .rsp-problem-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #industry-problems .rsp-problem-motion-border::before {
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
      animation: rspProblemBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #industry-problems .rsp-problem-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-problem-inner, #ffffff);
      pointer-events: none;
    }

    #industry-problems .rsp-problem-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #industry-problems .rsp-problem-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #industry-problems .rsp-problem-btn::before {
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

    #industry-problems .rsp-problem-btn:hover {
      transform: translateY(-3px);
    }

    #industry-problems .rsp-problem-btn:hover::before {
      left: 135%;
    }

    @keyframes rspProblemBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #industry-problems *,
      #industry-problems *::before,
      #industry-problems *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #industry-problems .rsp-problem-reveal {
        opacity: 1;
        transform: none;
      }

      #industry-problems .rsp-problem-card:hover,
      #industry-problems .rsp-problem-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="rsp-problem-reveal mx-auto max-w-4xl text-center" data-rsp-problem-reveal>
      <span class="rsp-problem-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-4 py-2 text-red-700 shadow-sm">
        <?php echo $render_icon('triangle-alert', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Industry Reputation Risks', 'reviewservicepro'); ?>
      </span>

      <h2
        id="industry-problems-title"
        class="rsp-problem-title text-[clamp(32px,4.6vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
        <?php
        printf(
          esc_html__('Common reputation problems for %s businesses', 'reviewservicepro'),
          esc_html($industry_name)
        );
        ?>
      </h2>

      <p class="rsp-problem-text mx-auto mt-5 max-w-2xl">
        <?php
        if (! empty($customer_decision_triggers)) {
          echo esc_html(wp_trim_words(wp_strip_all_tags($customer_decision_triggers), 36));
        } else {
          esc_html_e('Reputation problems often grow quietly. A weak review profile, poor response process, or unclear monitoring workflow can reduce customer confidence before your team ever speaks to the customer.', 'reviewservicepro');
        }
        ?>
      </p>
    </div>

    <div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
      <?php foreach ($problem_cards as $index => $card) : ?>
        <?php $tone = $tone_classes[$card['tone']] ?? $tone_classes['blue']; ?>

        <article
          class="rsp-problem-card rsp-problem-reveal rounded-[1.75rem] border <?php echo esc_attr($tone['card']); ?> p-6 shadow-[0_16px_48px_rgba(15,23,42,0.07)]"
          data-rsp-problem-reveal
          style="transition-delay: <?php echo esc_attr((string) min($index * 70, 420)); ?>ms;">

          <div class="absolute inset-x-0 top-0 h-[3px] rounded-t-[1.75rem] bg-gradient-to-r <?php echo esc_attr($tone['line']); ?>" aria-hidden="true"></div>

          <div class="relative z-10">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?> shadow-sm">
              <?php echo $render_icon($card['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </div>

            <h3 class="rsp-problem-heading text-xl font-[800] leading-tight tracking-[-0.035em]">
              <?php echo esc_html($card['title']); ?>
            </h3>

            <p class="rsp-problem-body mt-4">
              <?php echo esc_html($card['text']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if (! empty($custom_challenges)) : ?>
      <div class="rsp-problem-reveal mt-12 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-problem-reveal>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.75fr_1.25fr] lg:items-start">
          <div>
            <span class="rsp-problem-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-amber-700">
              <?php echo $render_icon('file-warning', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Custom Industry Challenges', 'reviewservicepro'); ?>
            </span>

            <h3 class="rsp-problem-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-3xl">
              <?php esc_html_e('Specific gaps to watch', 'reviewservicepro'); ?>
            </h3>
          </div>

          <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            <?php foreach (array_slice($custom_challenges, 0, 8) as $challenge) : ?>
              <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <span class="font-['Inter',sans-serif] text-[15px] font-medium leading-7 text-[#64748B]">
                  <?php echo esc_html($challenge); ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="rsp-problem-reveal rsp-problem-motion-border mt-12 rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-problem-reveal style="--rsp-problem-inner:#ffffff;">
      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.48fr] lg:items-center">
        <div>
          <span class="rsp-problem-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
            <?php echo $render_icon('shield-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Safe Reputation Fix', 'reviewservicepro'); ?>
          </span>

          <h3 class="rsp-problem-heading text-2xl font-[800] leading-tight tracking-[-0.04em] md:text-4xl">
            <?php esc_html_e('Fix trust gaps without risky shortcuts.', 'reviewservicepro'); ?>
          </h3>

          <p class="rsp-problem-text mt-5 max-w-2xl">
            <?php esc_html_e('We focus on real customer feedback, professional responses, monitoring, reporting, and platform-compliant reputation improvement. No fake reviews, paid review incentives, or rating manipulation.', 'reviewservicepro'); ?>
          </p>
        </div>

        <a href="<?php echo esc_url($cta_url); ?>" class="rsp-problem-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Get Industry Audit', 'reviewservicepro'); ?>
            <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspIndustryProblems() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-problem-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspProblemVisible === 'true') {
          return;
        }

        item.dataset.rspProblemVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspIndustryProblems);
    } else {
      initRspIndustryProblems();
    }
  })();
</script>