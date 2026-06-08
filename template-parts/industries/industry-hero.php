<?php

/**
 * Industry Hero Section
 *
 * ReviewService.Pro — Premium White SaaS Single Industry Hero
 *
 * File: template-parts/industries/industry-hero.php
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
    'seo_title'                  => get_post_meta($post_id, 'rsp_seo_title', true),
    'meta_description'           => get_post_meta($post_id, 'rsp_meta_description', true),
    'focus_keyword'              => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'aeo_short_answer'           => get_post_meta($post_id, 'rsp_aeo_short_answer', true),
    'ai_summary'                 => get_post_meta($post_id, 'rsp_ai_summary', true),
    'related_entities'           => get_post_meta($post_id, 'rsp_related_entities', true),
    'recommended_platforms'      => get_post_meta($post_id, 'rsp_recommended_platforms', true),
    'trust_factors'              => get_post_meta($post_id, 'rsp_trust_factors', true),
    'reputation_challenges'      => get_post_meta($post_id, 'rsp_reputation_challenges', true),
    'customer_decision_triggers' => get_post_meta($post_id, 'rsp_customer_decision_triggers', true),
    'local_global_angle'         => get_post_meta($post_id, 'rsp_local_global_angle', true),
    'industry_icon'              => get_post_meta($post_id, 'rsp_industry_icon', true),
    'cta_url'                    => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$seo_title                  = $industry_data['seo_title'] ?? '';
$meta_description           = $industry_data['meta_description'] ?? '';
$focus_keyword              = $industry_data['focus_keyword'] ?? '';
$aeo_short_answer           = $industry_data['aeo_short_answer'] ?? '';
$ai_summary                 = $industry_data['ai_summary'] ?? '';
$related_entities           = $industry_data['related_entities'] ?? '';
$recommended_platforms      = $industry_data['recommended_platforms'] ?? '';
$reputation_challenges      = $industry_data['reputation_challenges'] ?? '';
$customer_decision_triggers = $industry_data['customer_decision_triggers'] ?? get_post_meta($post_id, 'rsp_customer_decision_triggers', true);
$local_global_angle         = $industry_data['local_global_angle'] ?? get_post_meta($post_id, 'rsp_local_global_angle', true);
$industry_icon              = $industry_data['industry_icon'] ?? 'building-2';
$cta_url                    = $industry_data['cta_url'] ?? '';

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('industry') : home_url('/contact/?type=industry-audit');
}

$consultation_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('consultation') : home_url('/contact/?type=consultation');
$industries_url   = get_post_type_archive_link('industries');
$industries_url   = $industries_url ? $industries_url : home_url('/industries/');

$title = ! empty($seo_title)
  ? $seo_title
  : sprintf(
    /* translators: %s: industry name */
    __('%s Reputation Management Services', 'reviewservicepro'),
    $industry_name
  );

$description = ! empty($meta_description)
  ? $meta_description
  : get_the_excerpt($post_id);

if (empty($description)) {
  $description = sprintf(
    /* translators: %s: industry name */
    __('Build customer trust, monitor reviews, improve response quality, and protect credibility for %s businesses with ethical, platform-compliant online reputation management.', 'reviewservicepro'),
    $industry_name
  );
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

$entities        = $split_items($related_entities);
$platform_items  = $split_items($recommended_platforms);
$challenge_items = $split_items($reputation_challenges);

$quick_answer = ! empty($aeo_short_answer)
  ? wp_trim_words(wp_strip_all_tags($aeo_short_answer), 40)
  : sprintf(
    /* translators: %s: industry name */
    __('%s reputation management helps businesses monitor reviews, respond professionally, improve platform trust signals, and build credibility through ethical ORM systems.', 'reviewservicepro'),
    $industry_name
  );

$semantic_summary = ! empty($ai_summary)
  ? wp_trim_words(wp_strip_all_tags($ai_summary), 40)
  : __('This industry guide explains review risks, customer decision triggers, local trust signals, platform visibility, response strategy, and ethical reputation growth workflows.', 'reviewservicepro');

$decision_trigger_summary = ! empty($customer_decision_triggers)
  ? wp_trim_words(wp_strip_all_tags($customer_decision_triggers), 30)
  : __('Customers often compare reviews, response quality, profile completeness, and recent feedback before contacting a business.', 'reviewservicepro');

$local_angle_summary = ! empty($local_global_angle)
  ? wp_trim_words(wp_strip_all_tags($local_global_angle), 30)
  : __('Local visibility, review freshness, platform consistency, and professional communication can strongly influence trust before customers call or book.', 'reviewservicepro');

$featured_image_id = get_post_thumbnail_id($post_id);

$trust_badges = [
  [
    'icon' => 'shield-check',
    'text' => __('Ethical ORM Only', 'reviewservicepro'),
  ],
  [
    'icon' => 'message-square-text',
    'text' => __('Professional Response Support', 'reviewservicepro'),
  ],
  [
    'icon' => 'radar',
    'text' => __('Review Risk Monitoring', 'reviewservicepro'),
  ],
];
?>

<section
  id="industry-hero"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24"
  aria-labelledby="industry-hero-title">

  <style>
    #industry-hero {
      --rsp-industry-title: #334155;
      --rsp-industry-heading: #3B4658;
      --rsp-industry-body: #64748B;
      --rsp-industry-blue: #2563EB;
      --rsp-industry-green: #00C853;
      --rsp-industry-teal: #14B8A6;
    }

    #industry-hero .rsp-industry-title,
    #industry-hero .rsp-industry-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #industry-hero .rsp-industry-title {
      color: var(--rsp-industry-title);
      text-wrap: balance;
    }

    #industry-hero .rsp-industry-heading {
      color: var(--rsp-industry-heading);
    }

    #industry-hero .rsp-industry-text,
    #industry-hero .rsp-industry-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-industry-body);
    }

    #industry-hero .rsp-industry-text {
      font-weight: 500;
    }

    #industry-hero .rsp-industry-body {
      font-weight: 400;
    }

    #industry-hero .rsp-industry-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industry-hero .rsp-industry-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industry-hero .rsp-industry-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industry-hero .rsp-industry-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #industry-hero .rsp-industry-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.25),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.27),
          rgba(37, 99, 235, 0.08));
      opacity: 0.68;
      transform: rotate(0deg);
      animation: rspIndustryHeroBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #industry-hero .rsp-industry-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-industry-inner, #ffffff);
      pointer-events: none;
    }

    #industry-hero .rsp-industry-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #industry-hero .rsp-industry-card {
      transition:
        transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 340ms ease,
        border-color 280ms ease,
        background-color 280ms ease;
    }

    #industry-hero .rsp-industry-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 24px 76px rgba(15, 23, 42, 0.12);
    }

    #industry-hero .rsp-industry-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #industry-hero .rsp-industry-btn::before {
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

    #industry-hero .rsp-industry-btn:hover {
      transform: translateY(-3px);
    }

    #industry-hero .rsp-industry-btn:hover::before {
      left: 135%;
    }

    #industry-hero .rsp-industry-image img {
      transition: transform 720ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #industry-hero .rsp-industry-card:hover .rsp-industry-image img {
      transform: scale(1.055);
    }

    #industry-hero .rsp-industry-float {
      animation: rspIndustryHeroFloat 7s ease-in-out infinite;
    }

    #industry-hero .rsp-industry-pulse {
      animation: rspIndustryHeroPulse 1.65s ease-in-out infinite;
    }

    @keyframes rspIndustryHeroBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspIndustryHeroFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes rspIndustryHeroPulse {

      0%,
      100% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.45);
        opacity: 0.55;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #industry-hero *,
      #industry-hero *::before,
      #industry-hero *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #industry-hero .rsp-industry-reveal {
        opacity: 1;
        transform: none;
      }

      #industry-hero .rsp-industry-card:hover,
      #industry-hero .rsp-industry-btn:hover,
      #industry-hero .rsp-industry-float {
        transform: none;
      }

      #industry-hero .rsp-industry-card:hover .rsp-industry-image img {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute left-1/2 top-0 z-0 h-px w-full max-w-6xl -translate-x-1/2 bg-gradient-to-r from-transparent via-slate-300 to-transparent" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <?php if (function_exists('rsp_breadcrumb')) : ?>
      <div class="rsp-industry-reveal mb-8" data-rsp-industry-reveal>
        <?php rsp_breadcrumb(); ?>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-[1.04fr_0.96fr] lg:gap-14">

      <div>
        <div class="rsp-industry-reveal mb-6 flex flex-wrap items-center gap-3" data-rsp-industry-reveal>
          <span class="rsp-industry-eyebrow inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
            <span class="rsp-industry-pulse h-2 w-2 rounded-full bg-[#2563EB]" aria-hidden="true"></span>
            <?php echo esc_html($focus_keyword ? $focus_keyword : __('Industry Reputation Management', 'reviewservicepro')); ?>
          </span>

          <a
            href="<?php echo esc_url($industries_url); ?>"
            class="rsp-industry-eyebrow inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-slate-600 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
            <?php echo $render_icon('arrow-left', 'h-3.5 w-3.5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('All Industries', 'reviewservicepro'); ?>
          </a>
        </div>

        <div class="rsp-industry-reveal mb-7" data-rsp-industry-reveal>
          <div class="inline-flex h-16 w-16 items-center justify-center rounded-[1.5rem] border border-blue-200 bg-white text-blue-600 shadow-[0_18px_50px_rgba(15,23,42,0.08)]">
            <?php echo $render_icon($icon, 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>
        </div>

        <h1
          id="industry-hero-title"
          class="rsp-industry-title rsp-industry-reveal max-w-4xl text-[clamp(38px,5.3vw,72px)] font-[800] leading-[1.04] tracking-[-0.06em]"
          data-rsp-industry-reveal>
          <?php echo esc_html($title); ?>
        </h1>

        <p class="rsp-industry-text rsp-industry-reveal mt-6 max-w-2xl" data-rsp-industry-reveal>
          <?php echo esc_html(wp_strip_all_tags($description)); ?>
        </p>

        <div class="rsp-industry-reveal mt-8 flex flex-wrap gap-3" data-rsp-industry-reveal>
          <?php foreach ($trust_badges as $badge) : ?>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-2 font-['Inter',sans-serif] text-sm font-semibold text-emerald-700 shadow-sm">
              <?php echo $render_icon($badge['icon'], 'h-4 w-4 text-[#00A344]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <span><?php echo esc_html($badge['text']); ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="rsp-industry-reveal mt-10 flex flex-col gap-4 sm:flex-row sm:flex-wrap" data-rsp-industry-reveal>
          <a
            href="<?php echo esc_url($cta_url); ?>"
            class="rsp-industry-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_18px_44px_rgba(37,99,235,0.26)] hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-100">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php echo $render_icon('search-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Get Industry Reputation Audit', 'reviewservicepro'); ?>
            </span>
          </a>

          <a
            href="<?php echo esc_url($consultation_url); ?>"
            class="rsp-industry-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php echo $render_icon('calendar-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
              <?php esc_html_e('Talk to ORM Specialist', 'reviewservicepro'); ?>
            </span>
          </a>
        </div>
      </div>

      <div class="rsp-industry-reveal" data-rsp-industry-reveal>
        <div class="rsp-industry-float">
          <div class="rsp-industry-card rsp-industry-motion-border rounded-[2rem] border border-slate-200 bg-white p-2 shadow-[0_30px_100px_rgba(15,23,42,0.12)]" style="--rsp-industry-inner:#ffffff;">

            <div class="relative z-10 overflow-hidden rounded-[calc(2rem-0.5rem)] border border-slate-200 bg-white">

              <?php if ($featured_image_id) : ?>
                <div class="rsp-industry-image h-56 overflow-hidden bg-slate-100 md:h-64">
                  <?php
                  echo wp_get_attachment_image(
                    $featured_image_id,
                    'large',
                    false,
                    [
                      'class'    => 'h-full w-full object-cover',
                      'loading'  => 'eager',
                      'decoding' => 'async',
                      'alt'      => esc_attr(sprintf(__('%s reputation management visual', 'reviewservicepro'), $industry_name)),
                    ]
                  );
                  ?>
                </div>
              <?php else : ?>
                <div class="flex h-56 items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 via-white to-emerald-50 md:h-64">
                  <div class="relative">
                    <div class="absolute -inset-10 rounded-full bg-blue-200/60 blur-3xl" aria-hidden="true"></div>
                    <div class="relative flex h-24 w-24 items-center justify-center rounded-[2rem] border border-blue-200 bg-white text-blue-600 shadow-[0_18px_60px_rgba(37,99,235,0.18)]">
                      <?php echo $render_icon($icon, 'h-11 w-11'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                      ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <div class="p-5 md:p-6">
                <div class="mb-5 flex items-center gap-3">
                  <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600 shadow-sm">
                    <?php echo $render_icon('sparkles', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                  </div>

                  <div>
                    <p class="rsp-industry-eyebrow text-blue-700">
                      <?php esc_html_e('AI Search Summary', 'reviewservicepro'); ?>
                    </p>

                    <p class="mt-1 font-['Inter',sans-serif] text-sm font-medium text-slate-500">
                      <?php esc_html_e('Industry & Answer Engine Optimized', 'reviewservicepro'); ?>
                    </p>
                  </div>
                </div>

                <div class="rounded-2xl border border-blue-200 bg-blue-50/80 p-5">
                  <p class="rsp-industry-eyebrow text-blue-700">
                    <?php esc_html_e('Quick Answer', 'reviewservicepro'); ?>
                  </p>

                  <p class="rsp-industry-body mt-3">
                    <?php echo esc_html($quick_answer); ?>
                  </p>
                </div>

                <div class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50/75 p-5">
                  <p class="rsp-industry-eyebrow text-emerald-700">
                    <?php esc_html_e('Decision Triggers', 'reviewservicepro'); ?>
                  </p>

                  <p class="rsp-industry-body mt-3">
                    <?php echo esc_html($decision_trigger_summary); ?>
                  </p>
                </div>

                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
                  <div class="rounded-2xl border border-teal-200 bg-teal-50/75 p-5">
                    <p class="rsp-industry-eyebrow text-teal-700">
                      <?php esc_html_e('Local Trust Angle', 'reviewservicepro'); ?>
                    </p>

                    <p class="mt-3 font-['Inter',sans-serif] text-sm font-medium leading-7 text-slate-600">
                      <?php echo esc_html($local_angle_summary); ?>
                    </p>
                  </div>

                  <div class="rounded-2xl border border-amber-200 bg-amber-50/80 p-5">
                    <p class="rsp-industry-eyebrow text-amber-700">
                      <?php esc_html_e('Common Risks', 'reviewservicepro'); ?>
                    </p>

                    <p class="mt-3 font-['Inter',sans-serif] text-sm font-medium leading-7 text-slate-600">
                      <?php echo esc_html(! empty($challenge_items) ? wp_trim_words(implode(', ', array_slice($challenge_items, 0, 4)), 24) : __('Unanswered reviews, weak ratings, outdated profiles, and unclear customer feedback workflows.', 'reviewservicepro')); ?>
                    </p>
                  </div>
                </div>

                <?php if (! empty($entities) || ! empty($platform_items)) : ?>
                  <div class="mt-5 border-t border-slate-200 pt-5">
                    <p class="rsp-industry-eyebrow mb-3 text-slate-500">
                      <?php esc_html_e('Relevant Signals', 'reviewservicepro'); ?>
                    </p>

                    <div class="flex flex-wrap gap-2">
                      <?php foreach (array_slice(array_merge($platform_items, $entities), 0, 10) as $item) : ?>
                        <span class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 font-['Inter',sans-serif] text-xs font-semibold text-slate-600">
                          <?php echo esc_html($item); ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>

              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<script>
  (function() {
    function initRspIndustryHero() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-industry-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspIndustryVisible === 'true') {
          return;
        }

        item.dataset.rspIndustryVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspIndustryHero);
    } else {
      initRspIndustryHero();
    }
  })();
</script>