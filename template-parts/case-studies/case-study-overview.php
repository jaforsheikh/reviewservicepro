<?php

/**
 * Case Study Overview Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id          = get_the_ID();
$case_title       = get_the_title();
$client_type      = get_post_meta($post_id, 'rsp_client_type', true);
$platform_used    = get_post_meta($post_id, 'rsp_platform_used', true);
$starting_rating  = get_post_meta($post_id, 'rsp_starting_rating', true);
$final_rating     = get_post_meta($post_id, 'rsp_final_rating', true);
$review_growth    = get_post_meta($post_id, 'rsp_review_growth', true);
$timeline         = get_post_meta($post_id, 'rsp_timeline', true);
$challenge        = get_post_meta($post_id, 'rsp_challenge', true);
$strategy         = get_post_meta($post_id, 'rsp_strategy', true);
$result           = get_post_meta($post_id, 'rsp_result', true);
$aeo_short_answer = get_post_meta($post_id, 'rsp_aeo_short_answer', true);
$ai_summary       = get_post_meta($post_id, 'rsp_ai_summary', true);

$snapshot_items = [
  [
    'icon'  => 'briefcase-business',
    'label' => __('Client Type', 'reviewservicepro'),
    'value' => $client_type ? $client_type : __('Service business', 'reviewservicepro'),
  ],
  [
    'icon'  => 'star',
    'label' => __('Platform Used', 'reviewservicepro'),
    'value' => $platform_used ? $platform_used : __('Review platform', 'reviewservicepro'),
  ],
  [
    'icon'  => 'clock-3',
    'label' => __('Timeline', 'reviewservicepro'),
    'value' => $timeline ? $timeline : __('Measured period', 'reviewservicepro'),
  ],
];

$metric_items = [
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
    'value' => $review_growth ? $review_growth : '—',
  ],
];

$story_cards = [
  [
    'icon'  => 'alert-triangle',
    'label' => __('Challenge', 'reviewservicepro'),
    'title' => __('What needed improvement', 'reviewservicepro'),
    'text'  => $challenge ? $challenge : __('The business needed a clearer reputation workflow to identify review risks, response gaps, trust issues, and customer feedback patterns.', 'reviewservicepro'),
    'tone'  => 'red',
  ],
  [
    'icon'  => 'route',
    'label' => __('Strategy', 'reviewservicepro'),
    'title' => __('How the issue was handled', 'reviewservicepro'),
    'text'  => $strategy ? $strategy : __('We focused on review monitoring, professional response strategy, feedback workflow improvement, trust signal analysis, and transparent reporting.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'sparkles',
    'label' => __('Result', 'reviewservicepro'),
    'title' => __('What changed after execution', 'reviewservicepro'),
    'text'  => $result ? $result : __('The business gained clearer visibility into reputation risks, improved review response quality, and created a stronger foundation for long-term trust growth.', 'reviewservicepro'),
    'tone'  => 'emerald',
  ],
];
?>

<section
  class="relative overflow-hidden border-b border-white/[0.05] bg-[#0B1220] py-20 md:py-24"
  data-gsap="case-study-overview"
  aria-labelledby="case-study-overview-title">
  <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.10),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.08),transparent_34%)]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mb-14 grid grid-cols-1 gap-8 lg:grid-cols-[0.85fr_1.15fr]">
      <div data-gsap-item="case-study-overview-left">
        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('clipboard-check', 'h-3.5 w-3.5')) : ''; ?>
          <?php esc_html_e('Project Snapshot', 'reviewservicepro'); ?>
        </span>

        <h2 id="case-study-overview-title" class="text-3xl font-extrabold leading-tight tracking-tight text-white md:text-5xl">
          <?php esc_html_e('A clear look at the reputation challenge, strategy, and result.', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-5 text-base leading-8 text-slate-400">
          <?php
          echo esc_html(
            $aeo_short_answer
              ? $aeo_short_answer
              : sprintf(
                __('This case study explains how an ethical online reputation management workflow helped improve trust signals for %s.', 'reviewservicepro'),
                $case_title
              )
          );
          ?>
        </p>
      </div>

      <div class="grid grid-cols-1 gap-5 sm:grid-cols-3" data-gsap-item="case-study-overview-right">
        <?php foreach ($snapshot_items as $item) : ?>
          <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-5">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($item['icon'], 'h-5 w-5')) : ''; ?>
            </div>

            <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
              <?php echo esc_html($item['label']); ?>
            </p>

            <p class="mt-2 text-sm font-extrabold leading-6 text-white">
              <?php echo esc_html($item['value']); ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if (! empty($ai_summary)) : ?>
      <div class="mb-12 rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-8">
        <div class="mb-4 flex items-center gap-3">
          <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('bot', 'h-5 w-5')) : ''; ?>
          </div>

          <p class="text-xs font-bold uppercase tracking-[0.12em] text-emerald-300">
            <?php esc_html_e('AI Search Summary', 'reviewservicepro'); ?>
          </p>
        </div>

        <p class="text-sm leading-7 text-slate-300 md:text-base md:leading-8">
          <?php echo esc_html($ai_summary); ?>
        </p>
      </div>
    <?php endif; ?>

    <div class="mb-12 grid grid-cols-1 gap-5 md:grid-cols-3">
      <?php foreach ($metric_items as $metric) : ?>
        <div class="rounded-[2rem] border border-blue-500/[0.18] bg-blue-600/[0.07] p-6">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($metric['icon'], 'h-5 w-5')) : ''; ?>
          </div>

          <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
            <?php echo esc_html($metric['label']); ?>
          </p>

          <p class="mt-2 text-3xl font-extrabold text-white">
            <?php echo esc_html($metric['value']); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
      <?php foreach ($story_cards as $card) : ?>
        <?php
        $classes = [
          'red'     => 'border-red-500/[0.16] bg-red-500/[0.045] text-red-300',
          'blue'    => 'border-blue-500/[0.18] bg-blue-600/[0.07] text-blue-300',
          'emerald' => 'border-emerald-500/[0.18] bg-emerald-500/[0.06] text-emerald-300',
        ];

        $tone_class = isset($classes[$card['tone']]) ? $classes[$card['tone']] : $classes['blue'];
        ?>

        <article class="rounded-[2rem] border <?php echo esc_attr($tone_class); ?> p-7">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-current/20 bg-current/10">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($card['icon'], 'h-5 w-5')) : ''; ?>
          </div>

          <p class="mb-3 text-xs font-bold uppercase tracking-[0.12em]">
            <?php echo esc_html($card['label']); ?>
          </p>

          <h3 class="mb-4 text-2xl font-extrabold text-white">
            <?php echo esc_html($card['title']); ?>
          </h3>

          <p class="text-sm leading-7 text-slate-300">
            <?php echo esc_html($card['text']); ?>
          </p>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="mt-12 rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-8">
      <div class="flex flex-col gap-5 md:flex-row md:items-start">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-5 w-5')) : ''; ?>
        </div>

        <div>
          <h3 class="text-2xl font-extrabold text-white">
            <?php esc_html_e('Ethical ORM disclaimer', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-3 text-sm leading-7 text-slate-300">
            <?php esc_html_e('This case study focuses on ethical reputation management practices such as review monitoring, response strategy, customer feedback workflow, trust signal improvement, and transparent reporting. ReviewService.Pro does not sell fake reviews, impersonate customers, or manipulate review platforms.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>