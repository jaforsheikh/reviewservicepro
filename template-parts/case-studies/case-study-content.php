<?php

/**
 * Case Study Content Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id           = get_the_ID();

$client_type       = get_post_meta($post_id, 'rsp_client_type', true);
$platform_used     = get_post_meta($post_id, 'rsp_platform_used', true);
$starting_rating   = get_post_meta($post_id, 'rsp_starting_rating', true);
$final_rating      = get_post_meta($post_id, 'rsp_final_rating', true);
$review_growth     = get_post_meta($post_id, 'rsp_review_growth', true);
$timeline          = get_post_meta($post_id, 'rsp_timeline', true);
$related_entities  = get_post_meta($post_id, 'rsp_related_entities', true);

$cta_url = get_post_meta($post_id, 'rsp_cta_url', true);

if (empty($cta_url)) {
  $cta_url = home_url('/contact/?type=free-audit');
}

$quick_facts = [
  [
    'icon'  => 'briefcase-business',
    'label' => __('Client Type', 'reviewservicepro'),
    'value' => $client_type ? $client_type : __('Business Client', 'reviewservicepro'),
  ],
  [
    'icon'  => 'star',
    'label' => __('Platform', 'reviewservicepro'),
    'value' => $platform_used ? $platform_used : __('Review Platform', 'reviewservicepro'),
  ],
  [
    'icon'  => 'star-half',
    'label' => __('Starting Rating', 'reviewservicepro'),
    'value' => $starting_rating ? $starting_rating : '—',
  ],
  [
    'icon'  => 'badge-check',
    'label' => __('Final Rating', 'reviewservicepro'),
    'value' => $final_rating ? $final_rating : '—',
  ],
  [
    'icon'  => 'trending-up',
    'label' => __('Review Growth', 'reviewservicepro'),
    'value' => $review_growth ? $review_growth : __('Measured Growth', 'reviewservicepro'),
  ],
  [
    'icon'  => 'clock-3',
    'label' => __('Timeline', 'reviewservicepro'),
    'value' => $timeline ? $timeline : __('Tracked Period', 'reviewservicepro'),
  ],
];

$entities = [];

if (! empty($related_entities)) {
  $entities = array_filter(
    array_map(
      'trim',
      explode(',', $related_entities)
    )
  );
}
?>

<section
  class="relative overflow-hidden border-b border-white/[0.05] bg-[#07111F] py-20 md:py-24"
  data-gsap="case-study-content"
  aria-labelledby="case-study-content-title">
  <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.04) 1px,transparent 1px);background-size:48px 48px;"></div>

  <div class="pointer-events-none absolute left-0 top-20 z-0 h-[420px] w-[520px] rounded-full bg-blue-600/[0.08] blur-[120px]"></div>

  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.06] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mb-12 max-w-3xl">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('file-text', 'h-3.5 w-3.5')) : ''; ?>
        <?php esc_html_e('Detailed Case Study', 'reviewservicepro'); ?>
      </span>

      <h2
        id="case-study-content-title"
        class="text-3xl font-extrabold leading-tight tracking-tight text-white md:text-5xl">
        <?php esc_html_e('Complete breakdown of the reputation management workflow.', 'reviewservicepro'); ?>
      </h2>

      <p class="mt-5 text-base leading-8 text-slate-400">
        <?php esc_html_e('Explore the full strategy, customer trust improvements, monitoring workflow, and long-form ORM implementation details used in this case study.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="grid grid-cols-1 gap-10 lg:grid-cols-[minmax(0,1fr)_360px]">

      <article
        class="min-w-0 rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-7 md:p-10"
        itemprop="articleBody">

        <div class="rsp-content prose prose-invert max-w-none prose-headings:scroll-mt-32 prose-headings:font-extrabold prose-headings:text-white prose-p:text-slate-300 prose-p:leading-8 prose-li:text-slate-300 prose-strong:text-white prose-a:text-blue-300 hover:prose-a:text-blue-200 prose-blockquote:border-blue-500 prose-blockquote:text-slate-300">

          <?php
          the_content();

          wp_link_pages(
            [
              'before' => '<div class="mt-8 flex flex-wrap gap-2">',
              'after'  => '</div>',
            ]
          );
          ?>

        </div>

      </article>

      <aside class="lg:sticky lg:top-28 lg:self-start">

        <div class="space-y-6">

          <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-6 md:p-7">

            <div class="mb-6 flex items-center gap-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('layout-dashboard', 'h-5 w-5')) : ''; ?>
              </div>

              <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
                  <?php esc_html_e('Quick Snapshot', 'reviewservicepro'); ?>
                </p>

                <h3 class="mt-1 text-2xl font-extrabold text-white">
                  <?php esc_html_e('Case Metrics', 'reviewservicepro'); ?>
                </h3>
              </div>
            </div>

            <div class="space-y-4">

              <?php foreach ($quick_facts as $fact) : ?>
                <div class="flex items-start gap-4 rounded-2xl border border-white/[0.07] bg-white/[0.03] p-4">

                  <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                    <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($fact['icon'], 'h-4 w-4')) : ''; ?>
                  </div>

                  <div class="min-w-0 flex-1">
                    <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
                      <?php echo esc_html($fact['label']); ?>
                    </p>

                    <p class="mt-1 break-words text-sm font-bold leading-6 text-white">
                      <?php echo esc_html($fact['value']); ?>
                    </p>
                  </div>

                </div>
              <?php endforeach; ?>

            </div>

          </div>

          <div class="rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-7">

            <div class="mb-5 flex items-center gap-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-5 w-5')) : ''; ?>
              </div>

              <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
                  <?php esc_html_e('Trust-Safe ORM', 'reviewservicepro'); ?>
                </p>

                <h3 class="mt-1 text-xl font-extrabold text-white">
                  <?php esc_html_e('Ethical Reputation Process', 'reviewservicepro'); ?>
                </h3>
              </div>
            </div>

            <p class="text-sm leading-7 text-slate-300">
              <?php esc_html_e('ReviewService.Pro focuses on ethical reputation management methods such as review monitoring, customer communication improvement, response strategy, and trust signal optimization. We do not create fake reviews or manipulate review platforms.', 'reviewservicepro'); ?>
            </p>

          </div>

          <?php if (! empty($entities)) : ?>
            <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-6 md:p-7">

              <div class="mb-5 flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                  <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('network', 'h-5 w-5')) : ''; ?>
                </div>

                <div>
                  <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
                    <?php esc_html_e('Related Entities', 'reviewservicepro'); ?>
                  </p>

                  <h3 class="mt-1 text-xl font-extrabold text-white">
                    <?php esc_html_e('Connected Topics', 'reviewservicepro'); ?>
                  </h3>
                </div>
              </div>

              <div class="flex flex-wrap gap-3">

                <?php foreach ($entities as $entity) : ?>
                  <span class="inline-flex items-center rounded-full border border-white/[0.08] bg-white/[0.04] px-4 py-2 text-xs font-bold text-slate-300">
                    <?php echo esc_html($entity); ?>
                  </span>
                <?php endforeach; ?>

              </div>

            </div>
          <?php endif; ?>

          <div class="overflow-hidden rounded-[2rem] border border-blue-500/[0.18] bg-blue-600/[0.07] p-6 md:p-7">

            <div class="pointer-events-none absolute"></div>

            <div class="relative">

              <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('sparkles', 'h-5 w-5')) : ''; ?>
              </div>

              <h3 class="text-2xl font-extrabold text-white">
                <?php esc_html_e('Need reputation help?', 'reviewservicepro'); ?>
              </h3>

              <p class="mt-4 text-sm leading-7 text-slate-300">
                <?php esc_html_e('Get a professional audit of your review visibility, customer trust signals, monitoring workflow, and platform reputation health.', 'reviewservicepro'); ?>
              </p>

              <div class="mt-6 flex flex-col gap-3">

                <a
                  href="<?php echo esc_url($cta_url); ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700">
                  <?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?>

                  <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4')) : ''; ?>
                </a>

                <a
                  href="<?php echo esc_url(home_url('/contact/?type=consultation')); ?>"
                  class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.04] px-6 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40 hover:bg-white/[0.07]">
                  <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
                </a>

              </div>

            </div>

          </div>

        </div>

      </aside>

    </div>

  </div>
</section>