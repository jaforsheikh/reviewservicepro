<?php

/**
 * Industry Long-form Content Section
 *
 * ReviewService.Pro — Premium White SaaS Industry Content
 *
 * File: template-parts/industries/industry-content.php
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
    'focus_keyword'         => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'related_entities'      => get_post_meta($post_id, 'rsp_related_entities', true),
    'recommended_platforms' => get_post_meta($post_id, 'rsp_recommended_platforms', true),
    'trust_factors'         => get_post_meta($post_id, 'rsp_trust_factors', true),
    'industry_icon'         => get_post_meta($post_id, 'rsp_industry_icon', true),
    'cta_url'               => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$focus_keyword         = $industry_data['focus_keyword'] ?? '';
$related_entities      = $industry_data['related_entities'] ?? '';
$recommended_platforms = $industry_data['recommended_platforms'] ?? '';
$trust_factors         = $industry_data['trust_factors'] ?? '';
$industry_icon         = $industry_data['industry_icon'] ?? 'building-2';
$cta_url               = $industry_data['cta_url'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('industry') : home_url('/contact/?type=industry-audit');
}

$icon = ! empty($industry_icon) ? sanitize_key($industry_icon) : 'building-2';

$render_icon = function ($icon_name, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon_name, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon_name) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
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

$entities       = $split_items($related_entities);
$platform_items = $split_items($recommended_platforms);
$trust_items    = $split_items($trust_factors);

$content_raw = trim(get_the_content(null, false, $post_id));

$quick_facts = [
  [
    'label' => __('Industry', 'reviewservicepro'),
    'value' => $industry_name,
  ],
  [
    'label' => __('Main Topic', 'reviewservicepro'),
    'value' => $focus_keyword ? $focus_keyword : __('Online Reputation Management', 'reviewservicepro'),
  ],
  [
    'label' => __('Best Starting Point', 'reviewservicepro'),
    'value' => __('Reputation Audit', 'reviewservicepro'),
  ],
  [
    'label' => __('Core Focus', 'reviewservicepro'),
    'value' => __('Reviews, trust signals, responses, reporting', 'reviewservicepro'),
  ],
];
?>

<section
  id="industry-content"
  class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="industry-content-title">

  <style>
    #industry-content {
      --rsp-content-title: #334155;
      --rsp-content-heading: #3B4658;
      --rsp-content-body: #64748B;
    }

    #industry-content .rsp-content-title,
    #industry-content .rsp-content-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #industry-content .rsp-content-title {
      color: var(--rsp-content-title);
      text-wrap: balance;
    }

    #industry-content .rsp-content-heading {
      color: var(--rsp-content-heading);
    }

    #industry-content .rsp-content-text,
    #industry-content .rsp-content-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-content-body);
    }

    #industry-content .rsp-content-text {
      font-weight: 500;
    }

    #industry-content .rsp-content-body {
      font-weight: 400;
    }

    #industry-content .rsp-content-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industry-content .rsp-content-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industry-content .rsp-content-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industry-content .rsp-content-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #industry-content .rsp-content-card:hover {
      transform: translateY(-5px);
      border-color: rgba(37, 99, 235, 0.22);
      box-shadow: 0 20px 60px rgba(15, 23, 42, 0.10);
    }

    #industry-content .rsp-content-article {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-content-body);
    }

    #industry-content .rsp-content-article p {
      margin-top: 1.25rem;
      margin-bottom: 1.25rem;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.9;
      color: var(--rsp-content-body);
    }

    #industry-content .rsp-content-article h2 {
      margin-top: 3rem;
      margin-bottom: 1rem;
      font-family: "Poppins", sans-serif;
      font-size: clamp(26px, 3vw, 34px);
      font-weight: 800;
      line-height: 1.18;
      letter-spacing: -0.035em;
      color: var(--rsp-content-heading);
    }

    #industry-content .rsp-content-article h3 {
      margin-top: 2.25rem;
      margin-bottom: 0.85rem;
      font-family: "Poppins", sans-serif;
      font-size: clamp(20px, 2vw, 24px);
      font-weight: 800;
      line-height: 1.25;
      letter-spacing: -0.025em;
      color: var(--rsp-content-heading);
    }

    #industry-content .rsp-content-article ul,
    #industry-content .rsp-content-article ol {
      margin-top: 1.35rem;
      margin-bottom: 1.35rem;
      padding-left: 1.35rem;
    }

    #industry-content .rsp-content-article li {
      margin-top: 0.75rem;
      padding-left: 0.25rem;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.85;
      color: var(--rsp-content-body);
    }

    #industry-content .rsp-content-article li::marker {
      color: #2563EB;
    }

    #industry-content .rsp-content-article strong {
      font-weight: 800;
      color: var(--rsp-content-heading);
    }

    #industry-content .rsp-content-article a {
      color: #2563EB;
      font-weight: 800;
      text-decoration: none;
    }

    #industry-content .rsp-content-article a:hover {
      color: #1D4ED8;
      text-decoration: underline;
    }

    #industry-content .rsp-content-article figure.wp-block-image {
      overflow: hidden;
      border-radius: 1.5rem;
      border: 1px solid rgba(148, 163, 184, 0.22);
      background: #ffffff;
      padding: 0.5rem;
      box-shadow: 0 18px 60px rgba(15, 23, 42, 0.08);
    }

    #industry-content .rsp-content-article figure.wp-block-image img {
      width: 100%;
      border-radius: 1.1rem;
    }

    #industry-content .rsp-content-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #industry-content .rsp-content-motion-border::before {
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
      animation: rspContentBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #industry-content .rsp-content-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-content-inner, #ffffff);
      pointer-events: none;
    }

    #industry-content .rsp-content-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #industry-content .rsp-content-btn::before {
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

    #industry-content .rsp-content-btn:hover {
      transform: translateY(-3px);
    }

    #industry-content .rsp-content-btn:hover::before {
      left: 135%;
    }

    @keyframes rspContentBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #industry-content *,
      #industry-content *::before,
      #industry-content *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #industry-content .rsp-content-reveal {
        opacity: 1;
        transform: none;
      }

      #industry-content .rsp-content-card:hover,
      #industry-content .rsp-content-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.055),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.055),transparent_30%)]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="mb-12 max-w-3xl rsp-content-reveal" data-rsp-content-reveal>
      <span class="rsp-content-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
        <?php echo $render_icon($icon, 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Industry ORM Guide', 'reviewservicepro'); ?>
      </span>

      <h2 id="industry-content-title" class="rsp-content-title mt-4 text-[clamp(32px,4.5vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
        <?php
        printf(
          esc_html__('Complete reputation guide for %s businesses', 'reviewservicepro'),
          esc_html($industry_name)
        );
        ?>
      </h2>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,820px)_320px] lg:items-start">

      <main class="min-w-0 rsp-content-reveal" data-rsp-content-reveal>
        <div class="rsp-content-motion-border rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-8" style="--rsp-content-inner:#ffffff;">
          <div class="relative z-10 rsp-content-article">
            <?php if (! empty($content_raw)) : ?>
              <?php the_content(); ?>
            <?php else : ?>
              <h2>
                <?php
                printf(
                  esc_html__('Why reputation matters for %s businesses', 'reviewservicepro'),
                  esc_html($industry_name)
                );
                ?>
              </h2>

              <p>
                <?php
                printf(
                  esc_html__('%s businesses rely on customer confidence. Reviews, response quality, business profile accuracy, and platform visibility can shape the customer decision before the first call, visit, or booking.', 'reviewservicepro'),
                  esc_html($industry_name)
                );
                ?>
              </p>

              <h2><?php esc_html_e('What an ethical ORM system should include', 'reviewservicepro'); ?></h2>

              <ul>
                <li><?php esc_html_e('Review monitoring across the platforms customers actually use.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Professional response support for positive, neutral, and negative reviews.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Platform profile checks to identify incomplete or inconsistent public information.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Clear reporting so business owners can see risks, trends, and next steps.', 'reviewservicepro'); ?></li>
                <li><?php esc_html_e('Ethical customer feedback workflows based on genuine customer experiences.', 'reviewservicepro'); ?></li>
              </ul>

              <h2><?php esc_html_e('Compliance-safe reputation growth', 'reviewservicepro'); ?></h2>

              <p>
                <?php esc_html_e('Ethical reputation management does not mean fake reviews, paid review incentives, rating manipulation, guaranteed removals, or guaranteed rankings. It means better monitoring, better communication, stronger documentation, and transparent trust-building systems.', 'reviewservicepro'); ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </main>

      <aside class="rsp-content-reveal lg:sticky lg:top-28" data-rsp-content-reveal>
        <div class="space-y-5">

          <div class="rsp-content-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-[0_14px_45px_rgba(15,23,42,0.06)]">
            <p class="rsp-content-eyebrow mb-4 text-blue-700">
              <?php esc_html_e('Quick Facts', 'reviewservicepro'); ?>
            </p>

            <div class="space-y-4">
              <?php foreach ($quick_facts as $fact) : ?>
                <div class="border-b border-slate-200 pb-3 last:border-b-0 last:pb-0">
                  <p class="font-['Inter',sans-serif] text-xs font-[800] uppercase tracking-[0.12em] text-slate-400">
                    <?php echo esc_html($fact['label']); ?>
                  </p>
                  <p class="mt-1 font-['Inter',sans-serif] text-sm font-semibold leading-6 text-[#3B4658]">
                    <?php echo esc_html($fact['value']); ?>
                  </p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <?php if (! empty($trust_items)) : ?>
            <div class="rsp-content-card rounded-[1.5rem] border border-emerald-200 bg-emerald-50/70 p-5 shadow-[0_14px_45px_rgba(15,23,42,0.05)]">
              <p class="rsp-content-eyebrow mb-4 text-emerald-700">
                <?php esc_html_e('Trust Factors', 'reviewservicepro'); ?>
              </p>

              <ul class="space-y-3">
                <?php foreach (array_slice($trust_items, 0, 6) as $item) : ?>
                  <li class="flex gap-2 font-['Inter',sans-serif] text-sm font-semibold leading-6 text-slate-700">
                    <?php echo $render_icon('check-circle-2', 'mt-1 h-4 w-4 shrink-0 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                    <span><?php echo esc_html($item); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <?php if (! empty($platform_items)) : ?>
            <div class="rsp-content-card rounded-[1.5rem] border border-blue-200 bg-blue-50/70 p-5 shadow-[0_14px_45px_rgba(15,23,42,0.05)]">
              <p class="rsp-content-eyebrow mb-4 text-blue-700">
                <?php esc_html_e('Platforms to Monitor', 'reviewservicepro'); ?>
              </p>

              <div class="flex flex-wrap gap-2">
                <?php foreach (array_slice($platform_items, 0, 12) as $platform) : ?>
                  <span class="rounded-xl border border-blue-200 bg-white px-3 py-2 font-['Inter',sans-serif] text-xs font-[800] text-blue-700 shadow-sm">
                    <?php echo esc_html($platform); ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if (! empty($entities)) : ?>
            <div class="rsp-content-card rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-[0_14px_45px_rgba(15,23,42,0.06)]">
              <p class="rsp-content-eyebrow mb-4 text-slate-500">
                <?php esc_html_e('Related Entities', 'reviewservicepro'); ?>
              </p>

              <div class="flex flex-wrap gap-2">
                <?php foreach (array_slice($entities, 0, 12) as $entity) : ?>
                  <span class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 font-['Inter',sans-serif] text-xs font-semibold text-slate-600">
                    <?php echo esc_html($entity); ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>

          <div class="rsp-content-motion-border rounded-[1.5rem] border border-blue-200 bg-white p-5 shadow-[0_14px_45px_rgba(15,23,42,0.06)]" style="--rsp-content-inner:#ffffff;">
            <div class="relative z-10">
              <p class="rsp-content-eyebrow mb-3 text-blue-700">
                <?php esc_html_e('Need clarity?', 'reviewservicepro'); ?>
              </p>

              <h3 class="rsp-content-heading mb-3 text-xl font-[800] leading-tight tracking-[-0.035em]">
                <?php esc_html_e('Request an industry audit', 'reviewservicepro'); ?>
              </h3>

              <p class="rsp-content-body mb-5">
                <?php esc_html_e('Find review gaps, platform risks, trust signals, and action steps for your business type.', 'reviewservicepro'); ?>
              </p>

              <a href="<?php echo esc_url($cta_url); ?>" class="rsp-content-btn inline-flex w-full min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_14px_34px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <?php esc_html_e('Get Audit', 'reviewservicepro'); ?>
                  <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                </span>
              </a>
            </div>
          </div>

        </div>
      </aside>

    </div>

  </div>
</section>

<script>
  (function() {
    function initRspIndustryContent() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-content-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspContentVisible === 'true') {
          return;
        }

        item.dataset.rspContentVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspIndustryContent);
    } else {
      initRspIndustryContent();
    }
  })();
</script>