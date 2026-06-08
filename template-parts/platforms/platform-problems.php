<?php

/**
 * Platform Problems Section
 *
 * ReviewService.Pro — Premium White SaaS Platform Problems
 *
 * File: template-parts/platforms/platform-problems.php
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
    'focus_keyword'   => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'common_problems' => get_post_meta($post_id, 'rsp_common_problems', true),
    'cta_url'         => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword         = $platform_data['focus_keyword'] ?? '';
$common_problems       = $platform_data['common_problems'] ?? '';
$cta_url               = $platform_data['cta_url'] ?? '';
$platform_policy_notes = get_post_meta($post_id, 'rsp_platform_policy_notes', true);

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('audit') : home_url('/contact/?type=free-audit');
}

$default_problems = [
  [
    'icon'  => 'star-off',
    'title' => __('Low rating confidence', 'reviewservicepro'),
    'text'  => __('A weak average rating can create hesitation before customers visit your website, call your business, or request a quote.', 'reviewservicepro'),
    'tone'  => 'red',
  ],
  [
    'icon'  => 'message-square-warning',
    'title' => __('Unanswered reviews', 'reviewservicepro'),
    'text'  => __('When reviews go unanswered, customers may assume the business is inactive, careless, or not serious about customer feedback.', 'reviewservicepro'),
    'tone'  => 'amber',
  ],
  [
    'icon'  => 'triangle-alert',
    'title' => __('Negative review visibility', 'reviewservicepro'),
    'text'  => __('Negative reviews can shape buyer perception quickly, especially when they appear near the top or remain without a professional response.', 'reviewservicepro'),
    'tone'  => 'red',
  ],
  [
    'icon'  => 'shield-alert',
    'title' => __('Policy confusion', 'reviewservicepro'),
    'text'  => __('Businesses often do not know which reviews may violate policy, what can be reported, or what should be handled through response strategy.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'radar',
    'title' => __('No monitoring system', 'reviewservicepro'),
    'text'  => __('Without review monitoring, reputation problems can grow quietly until they affect visibility, trust, conversion, and customer confidence.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
  [
    'icon'  => 'users-round',
    'title' => __('Customer trust loss', 'reviewservicepro'),
    'text'  => __('Reputation gaps can reduce customer trust even when the business provides a strong product or service offline.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
];

$tone_classes = [
  'red'   => ['card' => 'border-red-200 bg-red-50/80', 'icon' => 'border-red-200 bg-white text-red-600'],
  'amber' => ['card' => 'border-amber-200 bg-amber-50/80', 'icon' => 'border-amber-200 bg-white text-amber-600'],
  'blue'  => ['card' => 'border-blue-200 bg-blue-50/80', 'icon' => 'border-blue-200 bg-white text-blue-600'],
  'teal'  => ['card' => 'border-teal-200 bg-teal-50/80', 'icon' => 'border-teal-200 bg-white text-teal-600'],
  'green' => ['card' => 'border-emerald-200 bg-emerald-50/80', 'icon' => 'border-emerald-200 bg-white text-emerald-600'],
];

$custom_problem_items = [];

if (! empty($common_problems)) {
  $raw_problems = is_array($common_problems) ? $common_problems : preg_split('/\r\n|\r|\n|,/', (string) $common_problems);

  foreach ($raw_problems as $problem) {
    $problem = trim(wp_strip_all_tags((string) $problem));

    if (! empty($problem)) {
      $custom_problem_items[] = $problem;
    }
  }
}

$intro_text = $focus_keyword
  ? sprintf(
    /* translators: %s: focus keyword */
    __('If your %s strategy is weak, customers may see risk before they see value. A structured reputation workflow helps identify problems, respond professionally, and protect long-term trust.', 'reviewservicepro'),
    $focus_keyword
  )
  : sprintf(
    /* translators: %s: platform name */
    __('If your %s presence is unmanaged, customers may see outdated reviews, unanswered feedback, low ratings, or trust gaps before they ever contact your business.', 'reviewservicepro'),
    $platform_name
  );

$policy_text = $platform_policy_notes
  ? wp_trim_words(wp_strip_all_tags($platform_policy_notes), 52)
  : __('The safest reputation strategy is to monitor feedback, respond professionally, improve customer experience, request genuine feedback responsibly, and follow official platform guidelines. We do not use fake reviews, paid review incentives, rating manipulation, or guaranteed removal claims.', 'reviewservicepro');

$render_icon = static function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section
  id="platform-problems"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  data-gsap="platform-problems"
  aria-labelledby="platform-problems-title">

  <style>
    #platform-problems {
      --rsp-platform-problems-title: #334155;
      --rsp-platform-problems-heading: #3B4658;
      --rsp-platform-problems-body: #64748B;
    }

    #platform-problems .rsp-platform-problems-title,
    #platform-problems .rsp-platform-problems-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #platform-problems .rsp-platform-problems-title {
      color: var(--rsp-platform-problems-title);
      text-wrap: balance;
    }

    #platform-problems .rsp-platform-problems-heading {
      color: var(--rsp-platform-problems-heading);
    }

    #platform-problems .rsp-platform-problems-text,
    #platform-problems .rsp-platform-problems-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-platform-problems-body);
    }

    #platform-problems .rsp-platform-problems-text {
      font-weight: 500;
    }

    #platform-problems .rsp-platform-problems-body {
      font-weight: 400;
    }

    #platform-problems .rsp-platform-problems-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #platform-problems .rsp-platform-problems-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #platform-problems .rsp-platform-problems-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #platform-problems .rsp-platform-problems-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #platform-problems .rsp-platform-problems-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(239, 68, 68, 0.08),
          rgba(37, 99, 235, 0.24),
          rgba(0, 200, 83, 0.18),
          rgba(245, 158, 11, 0.23),
          rgba(239, 68, 68, 0.08));
      opacity: 0.68;
      transform: rotate(0deg);
      animation: rspPlatformProblemsBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #platform-problems .rsp-platform-problems-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-platform-problems-inner, #ffffff);
      pointer-events: none;
    }

    #platform-problems .rsp-platform-problems-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #platform-problems .rsp-platform-problems-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-problems .rsp-platform-problems-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #platform-problems .rsp-platform-problems-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-problems .rsp-platform-problems-btn::before {
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

    #platform-problems .rsp-platform-problems-btn:hover {
      transform: translateY(-3px);
    }

    #platform-problems .rsp-platform-problems-btn:hover::before {
      left: 135%;
    }

    @keyframes rspPlatformProblemsBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #platform-problems *,
      #platform-problems *::before,
      #platform-problems *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #platform-problems .rsp-platform-problems-reveal {
        opacity: 1;
        transform: none;
      }

      #platform-problems .rsp-platform-problems-card:hover,
      #platform-problems .rsp-platform-problems-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-red-100/70 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="mb-12 grid grid-cols-1 gap-8 lg:grid-cols-[0.92fr_1.08fr] lg:items-end">
      <div class="rsp-platform-problems-reveal" data-rsp-platform-problems-reveal>
        <span class="rsp-platform-problems-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-4 py-2 text-red-700 shadow-sm">
          <?php echo $render_icon('triangle-alert', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Reputation Problems', 'reviewservicepro'); ?>
        </span>

        <h2 id="platform-problems-title" class="rsp-platform-problems-title text-[clamp(32px,4.5vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
          <?php
          printf(
            esc_html__('Common %s reputation problems businesses face', 'reviewservicepro'),
            esc_html($platform_name)
          );
          ?>
        </h2>
      </div>

      <div class="rsp-platform-problems-reveal rsp-platform-problems-motion-border rounded-[1.75rem] border border-red-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platform-problems-reveal style="--rsp-platform-problems-inner:#ffffff;">
        <p class="relative z-10 rsp-platform-problems-text">
          <?php echo esc_html(wp_strip_all_tags($intro_text)); ?>
        </p>
      </div>
    </div>

    <?php if (! empty($custom_problem_items)) : ?>
      <div class="rsp-platform-problems-reveal mb-10 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-platform-problems-reveal>
        <div class="mb-6 flex items-start gap-4">
          <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-red-200 bg-red-50 text-red-600 shadow-sm">
            <?php echo $render_icon('list-alerts', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <div>
            <p class="rsp-platform-problems-eyebrow text-red-700">
              <?php esc_html_e('Platform-Specific Issues', 'reviewservicepro'); ?>
            </p>

            <h3 class="rsp-platform-problems-heading mt-1 text-2xl font-[800] leading-tight tracking-[-0.04em]">
              <?php esc_html_e('Issues to review first', 'reviewservicepro'); ?>
            </h3>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <?php foreach (array_slice($custom_problem_items, 0, 8) as $index => $problem) : ?>
            <div class="rsp-platform-problems-card flex gap-3 rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4">
              <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-red-200 bg-red-50 font-['Inter',sans-serif] text-xs font-[800] text-red-700">
                <?php echo esc_html((string) ($index + 1)); ?>
              </span>

              <p class="rsp-platform-problems-body text-sm leading-7">
                <?php echo esc_html($problem); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($default_problems as $index => $problem) : ?>
        <?php $tone = $tone_classes[$problem['tone']] ?? $tone_classes['blue']; ?>

        <article class="rsp-platform-problems-card rsp-platform-problems-reveal rounded-[2rem] border <?php echo esc_attr($tone['card']); ?> p-6 shadow-[0_14px_45px_rgba(15,23,42,0.055)]" data-rsp-platform-problems-reveal style="transition-delay: <?php echo esc_attr((string) min($index * 70, 420)); ?>ms;">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?> shadow-sm">
            <?php echo $render_icon($problem['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h3 class="rsp-platform-problems-heading text-xl font-[800] leading-tight tracking-[-0.035em]">
            <?php echo esc_html($problem['title']); ?>
          </h3>

          <p class="rsp-platform-problems-body mt-3 text-sm leading-7">
            <?php echo esc_html($problem['text']); ?>
          </p>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_0.72fr]">

      <div class="rsp-platform-problems-reveal rounded-[2rem] border border-emerald-200 bg-emerald-50/80 p-7 shadow-[0_18px_60px_rgba(15,23,42,0.06)] md:p-8" data-rsp-platform-problems-reveal>
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-200 bg-white text-emerald-600 shadow-sm">
          <?php echo $render_icon('shield-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </div>

        <h3 class="rsp-platform-problems-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
          <?php esc_html_e('Trust-safe reputation management matters', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-platform-problems-body mt-4">
          <?php echo esc_html($policy_text); ?>
        </p>
      </div>

      <div class="rsp-platform-problems-reveal rsp-platform-problems-motion-border rounded-[2rem] border border-blue-200 bg-white p-7 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" data-rsp-platform-problems-reveal style="--rsp-platform-problems-inner:#ffffff;">
        <div class="relative z-10">
          <p class="rsp-platform-problems-eyebrow mb-3 text-blue-700">
            <?php esc_html_e('Need help?', 'reviewservicepro'); ?>
          </p>

          <h3 class="rsp-platform-problems-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
            <?php
            printf(
              esc_html__('Fix %s trust gaps before they cost leads', 'reviewservicepro'),
              esc_html($platform_name)
            );
            ?>
          </h3>

          <p class="rsp-platform-problems-body mt-4">
            <?php esc_html_e('Get a free audit and see which review issues, response gaps, and trust signals need attention first.', 'reviewservicepro'); ?>
          </p>

          <a href="<?php echo esc_url($cta_url); ?>" class="rsp-platform-problems-btn mt-6 inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Fix Platform Issues', 'reviewservicepro'); ?>
              <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </span>
          </a>
        </div>
      </div>

    </div>

  </div>
</section>

<script>
  (function() {
    function initRspPlatformProblems() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-platform-problems-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformProblemsVisible === 'true') {
          return;
        }

        item.dataset.rspPlatformProblemsVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspPlatformProblems);
    } else {
      initRspPlatformProblems();
    }
  })();
</script>