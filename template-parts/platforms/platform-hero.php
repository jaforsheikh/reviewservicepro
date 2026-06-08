<?php

/**
 * Platform Hero Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id = get_the_ID();

if (function_exists('rsp_acf_get_platform_data')) {
  $platform_data = rsp_acf_get_platform_data($post_id);
} else {
  $platform_data = [
    'seo_title'        => get_post_meta($post_id, 'rsp_seo_title', true),
    'meta_description' => get_post_meta($post_id, 'rsp_meta_description', true),
    'focus_keyword'    => get_post_meta($post_id, 'rsp_focus_keyword', true),
    'aeo_short_answer' => get_post_meta($post_id, 'rsp_aeo_short_answer', true),
    'ai_summary'       => get_post_meta($post_id, 'rsp_ai_summary', true),
    'related_entities' => get_post_meta($post_id, 'rsp_related_entities', true),
    'platform_url'     => get_post_meta($post_id, 'rsp_platform_url', true),
    'platform_logo'    => get_post_meta($post_id, 'rsp_platform_logo', true),
    'common_problems'  => get_post_meta($post_id, 'rsp_common_problems', true),
    'best_for'         => get_post_meta($post_id, 'rsp_best_for', true),
    'cta_url'          => get_post_meta($post_id, 'rsp_cta_url', true),
  ];
}

$seo_title        = $platform_data['seo_title'] ?? '';
$meta_description = $platform_data['meta_description'] ?? '';
$focus_keyword    = $platform_data['focus_keyword'] ?? '';
$aeo_short_answer = $platform_data['aeo_short_answer'] ?? '';
$ai_summary       = $platform_data['ai_summary'] ?? '';
$related_entities = $platform_data['related_entities'] ?? '';
$platform_url     = $platform_data['platform_url'] ?? '';
$platform_logo    = function_exists('rsp_get_platform_logo') ? rsp_get_platform_logo($post_id) : ($platform_data['platform_logo'] ?? '');
$common_problems  = $platform_data['common_problems'] ?? '';
$best_for         = $platform_data['best_for'] ?? '';
$cta_url          = $platform_data['cta_url'] ?? '';

$page_title = get_the_title($post_id);

$title = $seo_title ? $seo_title : $page_title;

$description = $meta_description
  ? $meta_description
  : get_the_excerpt($post_id);

if (empty($description)) {
  $description = sprintf(
    /* translators: %s: platform name */
    __('Improve reputation, monitor reviews, respond professionally, and build customer trust on %s using ethical, platform-compliant ORM systems.', 'reviewservicepro'),
    $page_title
  );
}

if (empty($cta_url)) {
  $cta_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('audit') : home_url('/contact/?type=free-audit');
}

$consultation_url = function_exists('rsp_get_cta_url') ? rsp_get_cta_url('consultation') : home_url('/contact/?type=consultation');

$trust_badges = [
  __('Platform-Compliant ORM', 'reviewservicepro'),
  __('Ethical Reputation Strategy', 'reviewservicepro'),
  __('Enterprise Review Intelligence', 'reviewservicepro'),
];

$entities = [];

if (! empty($related_entities)) {
  $entities = array_filter(
    array_map(
      'trim',
      explode(',', wp_strip_all_tags($related_entities))
    )
  );
}

$quick_answer = $aeo_short_answer
  ? wp_trim_words(wp_strip_all_tags($aeo_short_answer), 38)
  : sprintf(
    /* translators: %s: platform name */
    __('%s reputation management helps businesses monitor reviews, respond professionally, improve trust signals, and protect credibility using ethical methods.', 'reviewservicepro'),
    $page_title
  );

$semantic_summary = $ai_summary
  ? wp_trim_words(wp_strip_all_tags($ai_summary), 38)
  : __('This platform guide explains review risks, customer trust signals, response strategy, platform-specific challenges, and ethical ORM workflows.', 'reviewservicepro');

$best_for_summary = $best_for
  ? wp_trim_words(wp_strip_all_tags($best_for), 28)
  : __('Businesses that depend on customer reviews, public trust, search visibility, and credible platform presence.', 'reviewservicepro');

$problem_summary = $common_problems
  ? wp_trim_words(wp_strip_all_tags($common_problems), 30)
  : __('Common challenges include low rating confidence, unanswered reviews, weak response systems, and unclear review monitoring workflows.', 'reviewservicepro');
?>

<section
  class="relative overflow-hidden border-b border-white/[0.06] bg-[#07111F] py-16 md:py-24"
  data-gsap="platform-hero"
  aria-labelledby="platform-hero-title">
  <div
    class="pointer-events-none absolute inset-0 z-0"
    style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px, transparent 1px),linear-gradient(90deg, rgba(37,99,235,0.05) 1px, transparent 1px);background-size:48px 48px;"></div>

  <div class="pointer-events-none absolute left-1/2 top-0 z-0 h-[500px] w-[850px] -translate-x-1/2 rounded-full bg-blue-600/[0.14] blur-[140px]"></div>
  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[260px] w-[260px] rounded-full bg-emerald-500/[0.08] blur-[90px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <?php if (function_exists('rsp_breadcrumb')) : ?>
      <div class="mb-8">
        <?php rsp_breadcrumb(); ?>
      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-[1.1fr_0.9fr]">

      <div data-gsap-item="platform-hero-left">

        <div class="mb-6 flex flex-wrap items-center gap-3">
          <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
            <span class="h-2 w-2 rounded-full bg-blue-500"></span>
            <?php echo esc_html($focus_keyword ? $focus_keyword : __('Platform Reputation Management', 'reviewservicepro')); ?>
          </span>

          <?php if (! empty($platform_url)) : ?>
            <a
              href="<?php echo esc_url($platform_url); ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-full border border-white/[0.08] bg-white/[0.04] px-4 py-1.5 text-[11px] font-semibold text-slate-300 transition-all duration-200 hover:border-blue-500/30 hover:text-white">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('external-link', 'h-3.5 w-3.5')) : ''; ?>
              <?php esc_html_e('Visit Platform', 'reviewservicepro'); ?>
            </a>
          <?php endif; ?>
        </div>

        <?php if (! empty($platform_logo)) : ?>
          <div class="mb-8">
            <div class="inline-flex items-center justify-center rounded-3xl border border-white/[0.08] bg-white/[0.04] p-5 shadow-[0_0_50px_rgba(37,99,235,0.12)]">
              <img
                src="<?php echo esc_url($platform_logo); ?>"
                alt="<?php echo esc_attr(sprintf(__('%s logo', 'reviewservicepro'), $page_title)); ?>"
                class="h-14 w-auto object-contain md:h-16"
                loading="lazy"
                decoding="async">
            </div>
          </div>
        <?php endif; ?>

        <h1 id="platform-hero-title" class="max-w-4xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white md:text-5xl lg:text-6xl">
          <?php echo esc_html($title); ?>
        </h1>

        <p class="mt-6 max-w-2xl text-base leading-8 text-slate-400 md:text-lg">
          <?php echo esc_html(wp_strip_all_tags($description)); ?>
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
          <?php foreach ($trust_badges as $badge) : ?>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-emerald-500/[0.15] bg-emerald-500/[0.06] px-4 py-2 text-sm text-emerald-300">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-4 w-4')) : ''; ?>
              <span><?php echo esc_html($badge); ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="mt-10 flex flex-wrap gap-4">
          <a
            href="<?php echo esc_url($cta_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-4 text-sm font-extrabold text-white shadow-[0_0_40px_rgba(37,99,235,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search-check', 'h-5 w-5')) : ''; ?>
            <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
          </a>

          <a
            href="<?php echo esc_url($consultation_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.08] bg-white/[0.04] px-6 py-4 text-sm font-bold text-slate-300 transition-all duration-300 hover:border-blue-500/30 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-500/20">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('calendar-check', 'h-5 w-5')) : ''; ?>
            <?php esc_html_e('Talk to ORM Specialist', 'reviewservicepro'); ?>
          </a>
        </div>

      </div>

      <div data-gsap-item="platform-hero-right">

        <div class="relative overflow-hidden rounded-[32px] border border-white/[0.08] bg-white/[0.04] p-6 shadow-[0_0_60px_rgba(37,99,235,0.08)] backdrop-blur-xl md:p-8">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-blue-600/[0.06] to-emerald-500/[0.03]"></div>

          <div class="relative z-10">
            <div class="mb-6 flex items-center gap-3">
              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600/15 text-blue-400">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('sparkles', 'h-5 w-5')) : ''; ?>
              </div>

              <div>
                <p class="text-sm font-bold uppercase tracking-[0.12em] text-blue-400">
                  <?php esc_html_e('AI Search Summary', 'reviewservicepro'); ?>
                </p>

                <p class="mt-1 text-xs text-slate-500">
                  <?php esc_html_e('Entity & Answer Engine Optimized', 'reviewservicepro'); ?>
                </p>
              </div>
            </div>

            <div class="rounded-2xl border border-blue-500/[0.15] bg-blue-600/[0.07] p-5">
              <p class="text-sm font-bold uppercase tracking-[0.08em] text-blue-300">
                <?php esc_html_e('Quick Answer', 'reviewservicepro'); ?>
              </p>

              <p class="mt-3 text-sm leading-7 text-slate-300">
                <?php echo esc_html($quick_answer); ?>
              </p>
            </div>

            <div class="mt-5 rounded-2xl border border-white/[0.06] bg-[#0F172A]/80 p-5">
              <p class="text-sm font-bold uppercase tracking-[0.08em] text-emerald-300">
                <?php esc_html_e('Semantic Overview', 'reviewservicepro'); ?>
              </p>

              <p class="mt-3 text-sm leading-7 text-slate-400">
                <?php echo esc_html($semantic_summary); ?>
              </p>
            </div>

            <?php if (! empty($entities)) : ?>
              <div class="mt-6">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
                  <?php esc_html_e('Related Entities', 'reviewservicepro'); ?>
                </p>

                <div class="flex flex-wrap gap-2">
                  <?php foreach (array_slice($entities, 0, 10) as $entity) : ?>
                    <span class="rounded-xl border border-white/[0.06] bg-white/[0.03] px-3 py-2 text-xs text-slate-400">
                      <?php echo esc_html($entity); ?>
                    </span>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>

            <div class="mt-6 rounded-2xl border border-emerald-500/[0.14] bg-emerald-500/[0.05] p-5">
              <p class="text-xs font-bold uppercase tracking-[0.12em] text-emerald-300">
                <?php esc_html_e('Best For', 'reviewservicepro'); ?>
              </p>

              <p class="mt-3 text-sm leading-7 text-slate-300">
                <?php echo esc_html($best_for_summary); ?>
              </p>
            </div>

            <div class="mt-6">
              <p class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-slate-500">
                <?php esc_html_e('Common Reputation Challenges', 'reviewservicepro'); ?>
              </p>

              <p class="text-sm leading-7 text-slate-400">
                <?php echo esc_html($problem_summary); ?>
              </p>
            </div>

          </div>
        </div>

      </div>

    </div>

  </div>
</section>