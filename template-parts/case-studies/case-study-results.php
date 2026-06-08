<?php

/**
 * Case Study Results Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id         = get_the_ID();
$case_title      = get_the_title();
$starting_rating = get_post_meta($post_id, 'rsp_starting_rating', true);
$final_rating    = get_post_meta($post_id, 'rsp_final_rating', true);
$review_growth   = get_post_meta($post_id, 'rsp_review_growth', true);
$timeline        = get_post_meta($post_id, 'rsp_timeline', true);
$result          = get_post_meta($post_id, 'rsp_result', true);

$before_after = [
  [
    'label' => __('Before', 'reviewservicepro'),
    'title' => __('Starting Rating', 'reviewservicepro'),
    'value' => $starting_rating ? $starting_rating : '—',
    'icon'  => 'star-half',
    'tone'  => 'red',
  ],
  [
    'label' => __('After', 'reviewservicepro'),
    'title' => __('Final Rating', 'reviewservicepro'),
    'value' => $final_rating ? $final_rating : '—',
    'icon'  => 'badge-check',
    'tone'  => 'emerald',
  ],
];

$result_metrics = [
  [
    'icon'  => 'trending-up',
    'label' => __('Review Growth', 'reviewservicepro'),
    'value' => $review_growth ? $review_growth : __('Measured improvement', 'reviewservicepro'),
  ],
  [
    'icon'  => 'clock-3',
    'label' => __('Timeline', 'reviewservicepro'),
    'value' => $timeline ? $timeline : __('Tracked period', 'reviewservicepro'),
  ],
  [
    'icon'  => 'shield-check',
    'label' => __('Method', 'reviewservicepro'),
    'value' => __('Ethical ORM workflow', 'reviewservicepro'),
  ],
];

$trust_improvements = [
  [
    'icon'  => 'message-square-text',
    'title' => __('Better Response Quality', 'reviewservicepro'),
    'text'  => __('Review responses became clearer, calmer, more professional, and more trust-focused.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'radar',
    'title' => __('Improved Monitoring', 'reviewservicepro'),
    'text'  => __('The business gained better visibility into new reviews, recurring complaints, and customer sentiment.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'users-round',
    'title' => __('Stronger Customer Trust', 'reviewservicepro'),
    'text'  => __('The public review profile became easier for customers to understand and trust.', 'reviewservicepro'),
  ],
];
?>

<section
  class="relative overflow-hidden border-b border-white/[0.05] bg-[#07111F] py-20 md:py-24"
  data-gsap="case-study-results"
  aria-labelledby="case-study-results-title">
  <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.045) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.045) 1px,transparent 1px);background-size:48px 48px;"></div>
  <div class="pointer-events-none absolute -left-24 top-20 z-0 h-[420px] w-[520px] rounded-full bg-blue-600/[0.10] blur-[120px]"></div>
  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.08] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mb-14 max-w-3xl">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('chart-column-big', 'h-3.5 w-3.5')) : ''; ?>
        <?php esc_html_e('Results & Metrics', 'reviewservicepro'); ?>
      </span>

      <h2 id="case-study-results-title" class="text-3xl font-extrabold leading-tight tracking-tight text-white md:text-5xl">
        <?php esc_html_e('Measurable reputation improvements from a trust-safe workflow.', 'reviewservicepro'); ?>
      </h2>

      <p class="mt-5 text-base leading-8 text-slate-400">
        <?php
        printf(
          esc_html__('This results section summarizes the visible reputation improvements connected to %s using ethical online reputation management methods.', 'reviewservicepro'),
          esc_html($case_title)
        );
        ?>
      </p>
    </div>

    <div class="mb-12 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_0.35fr_1fr] lg:items-center">

      <?php foreach ($before_after as $item) : ?>
        <?php
        $tone_classes = [
          'red'     => 'border-red-500/[0.18] bg-red-500/[0.05] text-red-300',
          'emerald' => 'border-emerald-500/[0.22] bg-emerald-500/[0.07] text-emerald-300',
        ];

        $tone_class = isset($tone_classes[$item['tone']]) ? $tone_classes[$item['tone']] : $tone_classes['emerald'];
        ?>

        <div class="rounded-[2rem] border <?php echo esc_attr($tone_class); ?> p-7 md:p-8">
          <div class="mb-6 flex items-center justify-between gap-4">
            <span class="rounded-full border border-current/20 bg-current/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em]">
              <?php echo esc_html($item['label']); ?>
            </span>

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-current/20 bg-current/10">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($item['icon'], 'h-5 w-5')) : ''; ?>
            </div>
          </div>

          <p class="text-sm font-bold uppercase tracking-[0.12em] text-slate-500">
            <?php echo esc_html($item['title']); ?>
          </p>

          <p class="mt-3 text-5xl font-extrabold tracking-tight text-white">
            <?php echo esc_html($item['value']); ?>
          </p>
        </div>
      <?php endforeach; ?>

      <div class="hidden items-center justify-center lg:flex">
        <div class="flex h-16 w-16 items-center justify-center rounded-full border border-blue-500/25 bg-blue-600/10 text-blue-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-7 w-7')) : ''; ?>
        </div>
      </div>

    </div>

    <div class="mb-12 grid grid-cols-1 gap-5 md:grid-cols-3">
      <?php foreach ($result_metrics as $metric) : ?>
        <div class="rounded-[2rem] border border-blue-500/[0.18] bg-blue-600/[0.07] p-6">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($metric['icon'], 'h-5 w-5')) : ''; ?>
          </div>

          <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
            <?php echo esc_html($metric['label']); ?>
          </p>

          <p class="mt-2 text-2xl font-extrabold text-white">
            <?php echo esc_html($metric['value']); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_0.85fr]">
      <div class="rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-7 md:p-8">
        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('sparkles', 'h-5 w-5')) : ''; ?>
        </div>

        <h3 class="mb-4 text-2xl font-extrabold text-white">
          <?php esc_html_e('Result summary', 'reviewservicepro'); ?>
        </h3>

        <p class="text-sm leading-7 text-slate-300 md:text-base md:leading-8">
          <?php
          echo esc_html(
            $result
              ? $result
              : __('The business gained a clearer reputation workflow, stronger response quality, better review monitoring, and improved trust signals through ethical ORM practices.', 'reviewservicepro')
          );
          ?>
        </p>
      </div>

      <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-7 md:p-8">
        <h3 class="mb-6 text-2xl font-extrabold text-white">
          <?php esc_html_e('Trust improvements observed', 'reviewservicepro'); ?>
        </h3>

        <div class="space-y-4">
          <?php foreach ($trust_improvements as $item) : ?>
            <div class="flex gap-4 rounded-2xl border border-white/[0.07] bg-white/[0.035] p-4">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($item['icon'], 'h-4 w-4')) : ''; ?>
              </div>

              <div>
                <h4 class="mb-1 text-sm font-extrabold text-white">
                  <?php echo esc_html($item['title']); ?>
                </h4>

                <p class="text-sm leading-6 text-slate-400">
                  <?php echo esc_html($item['text']); ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="mt-12 rounded-[2rem] border border-amber-500/[0.20] bg-amber-500/[0.06] p-6 md:p-8">
      <div class="flex flex-col gap-5 md:flex-row md:items-start">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-amber-500/20 bg-amber-500/10 text-amber-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('info', 'h-5 w-5')) : ''; ?>
        </div>

        <div>
          <h3 class="text-2xl font-extrabold text-white">
            <?php esc_html_e('Important results disclaimer', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-3 text-sm leading-7 text-slate-300">
            <?php esc_html_e('Case study results can vary by industry, platform, review volume, customer activity, competition, starting reputation, and business operations. ReviewService.Pro does not guarantee specific ratings, review counts, or search positions. We use ethical, platform-compliant reputation management practices only.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>