<?php

/**
 * Platform Long-form Content Section
 *
 * ReviewService.Pro — Premium White SaaS Platform Content
 *
 * File: template-parts/platforms/platform-content.php
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
    'related_entities' => get_post_meta($post_id, 'rsp_related_entities', true),
    'platform_url'     => get_post_meta($post_id, 'rsp_platform_url', true),
    'platform_logo'    => get_post_meta($post_id, 'rsp_platform_logo', true),
    'cta_url'          => get_post_meta($post_id, 'rsp_cta_url', true),
    'best_for'         => get_post_meta($post_id, 'rsp_best_for', true),
  ];
}

$focus_keyword    = $platform_data['focus_keyword'] ?? '';
$related_entities = $platform_data['related_entities'] ?? '';
$platform_url     = $platform_data['platform_url'] ?? '';
$platform_logo    = function_exists('rsp_get_platform_logo') ? rsp_get_platform_logo($post_id) : ($platform_data['platform_logo'] ?? '');
$cta_url          = $platform_data['cta_url'] ?? '';
$best_for         = $platform_data['best_for'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('audit') : home_url('/contact/?type=free-audit');
}

$entities = [];

if (! empty($related_entities)) {
  if (is_array($related_entities)) {
    $entities = array_filter(array_map('trim', array_map('wp_strip_all_tags', $related_entities)));
  } else {
    $entities = array_filter(
      array_map(
        'trim',
        explode(',', wp_strip_all_tags((string) $related_entities))
      )
    );
  }
}

$trust_items = [
  [
    'icon'  => 'shield-check',
    'title' => __('Ethical review support', 'reviewservicepro'),
    'text'  => __('No fake reviews, no paid review incentives, no rating manipulation, and no guaranteed removal claims.', 'reviewservicepro'),
    'tone'  => 'green',
  ],
  [
    'icon'  => 'file-search',
    'title' => __('Audit-first workflow', 'reviewservicepro'),
    'text'  => __('Identify visible gaps before creating response systems, feedback workflows, and monthly reporting plans.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-square-text',
    'title' => __('Professional responses', 'reviewservicepro'),
    'text'  => __('Build calm, brand-safe response direction that protects trust instead of escalating public conversations.', 'reviewservicepro'),
    'tone'  => 'teal',
  ],
  [
    'icon'  => 'bar-chart-3',
    'title' => __('Clear reporting', 'reviewservicepro'),
    'text'  => __('Track progress, open issues, review patterns, and the next actions your team should prioritize.', 'reviewservicepro'),
    'tone'  => 'amber',
  ],
];

$tone_classes = [
  'green' => ['card' => 'border-emerald-200 bg-emerald-50/80', 'icon' => 'border-emerald-200 bg-white text-emerald-600'],
  'blue'  => ['card' => 'border-blue-200 bg-blue-50/80', 'icon' => 'border-blue-200 bg-white text-blue-600'],
  'teal'  => ['card' => 'border-teal-200 bg-teal-50/80', 'icon' => 'border-teal-200 bg-white text-teal-600'],
  'amber' => ['card' => 'border-amber-200 bg-amber-50/80', 'icon' => 'border-amber-200 bg-white text-amber-600'],
];

$render_icon = static function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<section
  id="platform-content"
  class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  data-gsap="platform-content"
  aria-labelledby="platform-content-title">

  <style>
    #platform-content {
      --rsp-platform-content-title: #334155;
      --rsp-platform-content-heading: #3B4658;
      --rsp-platform-content-body: #64748B;
    }

    #platform-content .rsp-platform-content-title,
    #platform-content .rsp-platform-content-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #platform-content .rsp-platform-content-title {
      color: var(--rsp-platform-content-title);
      text-wrap: balance;
    }

    #platform-content .rsp-platform-content-heading {
      color: var(--rsp-platform-content-heading);
    }

    #platform-content .rsp-platform-content-text,
    #platform-content .rsp-platform-content-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-platform-content-body);
    }

    #platform-content .rsp-platform-content-text {
      font-weight: 500;
    }

    #platform-content .rsp-platform-content-body {
      font-weight: 400;
    }

    #platform-content .rsp-platform-content-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #platform-content .rsp-platform-content-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #platform-content .rsp-platform-content-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #platform-content .rsp-platform-content-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #platform-content .rsp-platform-content-motion-border::before {
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
      animation: rspPlatformContentBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #platform-content .rsp-platform-content-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-platform-content-inner, #ffffff);
      pointer-events: none;
    }

    #platform-content .rsp-platform-content-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #platform-content .rsp-platform-content-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-content .rsp-platform-content-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #platform-content .rsp-platform-content-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-content .rsp-platform-content-btn::before {
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

    #platform-content .rsp-platform-content-btn:hover {
      transform: translateY(-3px);
    }

    #platform-content .rsp-platform-content-btn:hover::before {
      left: 135%;
    }

    #platform-content .rsp-platform-content-main {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: #64748B;
    }

    #platform-content .rsp-platform-content-main p {
      margin-top: 1.25rem;
      margin-bottom: 1.25rem;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.9;
      color: #64748B;
    }

    #platform-content .rsp-platform-content-main h2 {
      margin-top: 2.7rem;
      margin-bottom: 1rem;
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(26px, 3vw, 34px);
      font-weight: 800;
      line-height: 1.18;
      letter-spacing: -0.035em;
      color: #3B4658;
    }

    #platform-content .rsp-platform-content-main h3 {
      margin-top: 2.15rem;
      margin-bottom: 0.85rem;
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(20px, 2vw, 24px);
      font-weight: 800;
      line-height: 1.25;
      letter-spacing: -0.025em;
      color: #3B4658;
    }

    #platform-content .rsp-platform-content-main ul,
    #platform-content .rsp-platform-content-main ol {
      margin-top: 1.25rem;
      margin-bottom: 1.25rem;
      padding-left: 1.4rem;
    }

    #platform-content .rsp-platform-content-main li {
      margin-top: 0.72rem;
      font-size: 16px;
      line-height: 1.85;
      color: #64748B;
    }

    #platform-content .rsp-platform-content-main strong {
      font-weight: 800;
      color: #3B4658;
    }

    #platform-content .rsp-platform-content-main a {
      color: #2563EB;
      font-weight: 700;
      text-decoration: none;
    }

    #platform-content .rsp-platform-content-main a:hover {
      text-decoration: underline;
    }

    #platform-content .rsp-platform-content-main figure.wp-block-image {
      overflow: hidden;
      border-radius: 1.5rem;
      border: 1px solid rgba(148, 163, 184, 0.22);
      background: #ffffff;
      padding: 0.5rem;
      box-shadow: 0 18px 60px rgba(15, 23, 42, 0.08);
    }

    #platform-content .rsp-platform-content-main figure.wp-block-image img {
      border-radius: 1.1rem;
    }

    @keyframes rspPlatformContentBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #platform-content *,
      #platform-content *::before,
      #platform-content *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #platform-content .rsp-platform-content-reveal {
        opacity: 1;
        transform: none;
      }

      #platform-content .rsp-platform-content-card:hover,
      #platform-content .rsp-platform-content-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.055),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.055),transparent_28%)]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="mb-12 grid grid-cols-1 gap-8 lg:grid-cols-[0.88fr_1.12fr] lg:items-end">
      <div class="rsp-platform-content-reveal" data-rsp-platform-content-reveal>
        <span class="rsp-platform-content-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
          <?php echo $render_icon('book-open-check', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Platform Guide', 'reviewservicepro'); ?>
        </span>

        <h2 id="platform-content-title" class="rsp-platform-content-title text-[clamp(32px,4.5vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
          <?php
          printf(
            esc_html__('A practical guide to managing %s reputation', 'reviewservicepro'),
            esc_html($platform_name)
          );
          ?>
        </h2>
      </div>

      <div class="rsp-platform-content-reveal rsp-platform-content-motion-border rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platform-content-reveal style="--rsp-platform-content-inner:#ffffff;">
        <p class="relative z-10 rsp-platform-content-text">
          <?php
          printf(
            esc_html__('Use this section to understand how %s review visibility, response quality, platform policies, and customer trust signals work together in a complete ORM workflow.', 'reviewservicepro'),
            esc_html($platform_name)
          );
          ?>
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,820px)_330px] lg:items-start">

      <main class="rsp-platform-content-reveal min-w-0" data-rsp-platform-content-reveal>
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_20px_70px_rgba(15,23,42,0.075)] md:p-8">
          <div class="rsp-platform-content-main">
            <?php
            $content = apply_filters('the_content', get_the_content());

            if (! empty(trim(wp_strip_all_tags($content)))) {
              echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            } else {
            ?>
              <h2>
                <?php
                printf(
                  esc_html__('Why %s reputation management matters', 'reviewservicepro'),
                  esc_html($platform_name)
                );
                ?>
              </h2>

              <p>
                <?php
                printf(
                  esc_html__('%s can influence how customers compare your business before making contact. A strong ORM workflow helps you monitor public feedback, identify trust gaps, respond professionally, and keep your platform presence consistent.', 'reviewservicepro'),
                  esc_html($platform_name)
                );
                ?>
              </p>

              <h2><?php esc_html_e('What to monitor', 'reviewservicepro'); ?></h2>

              <ul>
                <li><?php esc_html_e('Recent review activity and overall review freshness.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Unanswered reviews and weak response quality.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Repeated customer concerns that may require operational attention.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Profile details, visibility signals, and trust-building opportunities.', 'reviewservicepro'); ?></li>
              </ul>

              <h2><?php esc_html_e('Ethical ORM approach', 'reviewservicepro'); ?></h2>

              <p>
                <?php esc_html_e('ReviewService.Pro focuses on real customer feedback, professional responses, documentation, platform-safe reporting, and clear next steps. We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, or guaranteed ranking outcomes.', 'reviewservicepro'); ?>
              </p>
            <?php
            }
            ?>
          </div>
        </div>
      </main>

      <aside class="space-y-5 lg:sticky lg:top-28">
        <div class="rsp-platform-content-reveal rsp-platform-content-motion-border rounded-[2rem] border border-blue-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platform-content-reveal style="--rsp-platform-content-inner:#ffffff;">
          <div class="relative z-10">
            <?php if (! empty($platform_logo)) : ?>
              <div class="mb-5 inline-flex rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                <img
                  src="<?php echo esc_url($platform_logo); ?>"
                  alt="<?php echo esc_attr(sprintf(__('%s logo', 'reviewservicepro'), $platform_name)); ?>"
                  class="h-10 w-auto object-contain"
                  loading="lazy"
                  decoding="async">
              </div>
            <?php else : ?>
              <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
                <?php echo $render_icon('monitor-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>
            <?php endif; ?>

            <h3 class="rsp-platform-content-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
              <?php esc_html_e('Quick platform action plan', 'reviewservicepro'); ?>
            </h3>

            <ul class="mt-5 space-y-3 font-['Inter',sans-serif] text-sm font-semibold leading-7 text-slate-600">
              <li class="flex gap-3">
                <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Audit review visibility and profile trust signals.', 'reviewservicepro'); ?>
              </li>
              <li class="flex gap-3">
                <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Improve response quality and consistency.', 'reviewservicepro'); ?>
              </li>
              <li class="flex gap-3">
                <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Document review issues and policy concerns.', 'reviewservicepro'); ?>
              </li>
              <li class="flex gap-3">
                <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Set up monthly monitoring and reporting.', 'reviewservicepro'); ?>
              </li>
            </ul>

            <a href="<?php echo esc_url($cta_url); ?>" class="rsp-platform-content-btn mt-6 inline-flex w-full min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php esc_html_e('Request Audit', 'reviewservicepro'); ?>
                <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </span>
            </a>
          </div>
        </div>

        <?php if (! empty($entities)) : ?>
          <div class="rsp-platform-content-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-platform-content-reveal>
            <p class="rsp-platform-content-eyebrow mb-4 text-slate-500">
              <?php esc_html_e('Related Entities', 'reviewservicepro'); ?>
            </p>

            <div class="flex flex-wrap gap-2">
              <?php foreach (array_slice($entities, 0, 14) as $entity) : ?>
                <span class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 font-['Inter',sans-serif] text-xs font-semibold text-slate-600">
                  <?php echo esc_html($entity); ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (! empty($best_for)) : ?>
          <div class="rsp-platform-content-reveal rsp-platform-content-card rounded-[2rem] border border-teal-200 bg-teal-50/75 p-6 shadow-[0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-platform-content-reveal>
            <h3 class="rsp-platform-content-heading text-xl font-[800] leading-tight tracking-[-0.035em]">
              <?php esc_html_e('Best for', 'reviewservicepro'); ?>
            </h3>

            <p class="rsp-platform-content-body mt-4">
              <?php echo esc_html(wp_trim_words(wp_strip_all_tags($best_for), 42)); ?>
            </p>
          </div>
        <?php endif; ?>

        <?php if (! empty($platform_url)) : ?>
          <div class="rsp-platform-content-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.06)]" data-rsp-platform-content-reveal>
            <p class="rsp-platform-content-body">
              <?php esc_html_e('Official platform reference:', 'reviewservicepro'); ?>
              <a href="<?php echo esc_url($platform_url); ?>" target="_blank" rel="noopener noreferrer" class="font-[800] text-blue-700 transition-colors duration-200 hover:text-blue-800">
                <?php echo esc_html($platform_name); ?>
              </a>
            </p>
          </div>
        <?php endif; ?>
      </aside>

    </div>

    <div class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($trust_items as $index => $item) : ?>
        <?php $tone = $tone_classes[$item['tone']] ?? $tone_classes['blue']; ?>

        <div class="rsp-platform-content-card rsp-platform-content-reveal rounded-[1.5rem] border <?php echo esc_attr($tone['card']); ?> p-5 shadow-[0_14px_45px_rgba(15,23,42,0.055)]" data-rsp-platform-content-reveal style="transition-delay: <?php echo esc_attr((string) min($index * 70, 280)); ?>ms;">
          <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?> shadow-sm">
            <?php echo $render_icon($item['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h3 class="rsp-platform-content-heading text-lg font-[800] leading-tight tracking-[-0.03em]">
            <?php echo esc_html($item['title']); ?>
          </h3>

          <p class="rsp-platform-content-body mt-3 text-sm leading-7">
            <?php echo esc_html($item['text']); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspPlatformContent() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-platform-content-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformContentVisible === 'true') {
          return;
        }

        item.dataset.rspPlatformContentVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspPlatformContent);
    } else {
      initRspPlatformContent();
    }
  })();
</script>