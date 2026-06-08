<?php

/**
 * Case Study Strategy Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id          = get_the_ID();
$case_title       = get_the_title();

$strategy         = get_post_meta($post_id, 'rsp_strategy', true);
$challenge        = get_post_meta($post_id, 'rsp_challenge', true);
$result           = get_post_meta($post_id, 'rsp_result', true);
$platform_used    = get_post_meta($post_id, 'rsp_platform_used', true);
$ai_summary       = get_post_meta($post_id, 'rsp_ai_summary', true);
$aeo_short_answer = get_post_meta($post_id, 'rsp_aeo_short_answer', true);

$workflow_steps = [
  [
    'icon'  => 'search-check',
    'label' => __('Audit & Discovery', 'reviewservicepro'),
    'title' => __('Reputation risk analysis', 'reviewservicepro'),
    'text'  => __('Review signals, customer sentiment, unanswered reviews, trust gaps, and visibility issues were analyzed to identify the highest-impact reputation risks.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'radar',
    'label' => __('Monitoring Setup', 'reviewservicepro'),
    'title' => __('Review monitoring workflow', 'reviewservicepro'),
    'text'  => __('A structured monitoring process was established to track new reviews, customer feedback trends, and reputation changes across the platform.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'message-square-share',
    'label' => __('Response Strategy', 'reviewservicepro'),
    'title' => __('Professional response improvement', 'reviewservicepro'),
    'text'  => __('Customer response quality was improved using calm, trust-focused communication that aligned with platform guidelines and customer expectations.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'shield-check',
    'label' => __('Trust Optimization', 'reviewservicepro'),
    'title' => __('Long-term trust growth', 'reviewservicepro'),
    'text'  => __('The workflow focused on sustainable reputation improvement using ethical ORM methods instead of manipulative or risky review practices.', 'reviewservicepro'),
  ],
];

$solution_cards = [
  [
    'icon'  => 'activity',
    'title' => __('Continuous Monitoring', 'reviewservicepro'),
    'text'  => __('Track new reviews, identify patterns, and detect reputation risks before they escalate.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'messages-square',
    'title' => __('Response Workflow', 'reviewservicepro'),
    'text'  => __('Build trust using professional review responses and customer communication strategies.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'chart-column-big',
    'title' => __('Reputation Reporting', 'reviewservicepro'),
    'text'  => __('Use measurable reporting to monitor trust improvement and review ecosystem health.', 'reviewservicepro'),
  ],
];
?>

<section
  class="relative overflow-hidden border-b border-white/[0.05] bg-[#0B1220] py-20 md:py-24"
  data-gsap="case-study-strategy"
  aria-labelledby="case-study-strategy-title">
  <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.10),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.08),transparent_34%)]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mb-14 max-w-4xl">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('workflow', 'h-3.5 w-3.5')) : ''; ?>
        <?php esc_html_e('ORM Strategy Workflow', 'reviewservicepro'); ?>
      </span>

      <h2
        id="case-study-strategy-title"
        class="text-3xl font-extrabold leading-tight tracking-tight text-white md:text-5xl">
        <?php esc_html_e('The reputation strategy behind the improvement process.', 'reviewservicepro'); ?>
      </h2>

      <p class="mt-5 max-w-3xl text-base leading-8 text-slate-400">
        <?php
        echo esc_html(
          $aeo_short_answer
            ? $aeo_short_answer
            : __('This section explains the ethical ORM workflow used to improve monitoring, customer response quality, trust signals, and reputation visibility.', 'reviewservicepro')
        );
        ?>
      </p>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.82fr_1.18fr]">

      <div class="lg:sticky lg:top-28 lg:self-start">

        <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-7 md:p-8">

          <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('sparkles', 'h-6 w-6')) : ''; ?>
          </div>

          <h3 class="text-2xl font-extrabold text-white">
            <?php esc_html_e('Strategy Summary', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-5 text-sm leading-7 text-slate-300 md:text-base md:leading-8">
            <?php
            echo esc_html(
              $strategy
                ? $strategy
                : __('The ORM strategy focused on ethical review monitoring, trust-focused response workflows, customer sentiment analysis, and long-term reputation stabilization.', 'reviewservicepro')
            );
            ?>
          </p>

          <div class="mt-8 rounded-2xl border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-5">
            <div class="mb-3 flex items-center gap-3">
              <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-4 w-4')) : ''; ?>
              </div>

              <p class="text-sm font-extrabold text-white">
                <?php esc_html_e('Ethical ORM Promise', 'reviewservicepro'); ?>
              </p>
            </div>

            <p class="text-sm leading-7 text-slate-300">
              <?php esc_html_e('ReviewService.Pro does not generate fake reviews, manipulate customers, or violate platform rules. The workflow is designed around ethical reputation improvement and trust-building practices.', 'reviewservicepro'); ?>
            </p>
          </div>

          <?php if (! empty($platform_used)) : ?>
            <div class="mt-6 flex items-center gap-3 rounded-2xl border border-white/[0.08] bg-white/[0.035] p-4">
              <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('star', 'h-4 w-4')) : ''; ?>
              </div>

              <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
                  <?php esc_html_e('Platform Focus', 'reviewservicepro'); ?>
                </p>

                <p class="mt-1 text-sm font-bold text-white">
                  <?php echo esc_html($platform_used); ?>
                </p>
              </div>
            </div>
          <?php endif; ?>

        </div>

      </div>

      <div>

        <div class="space-y-6">

          <?php foreach ($workflow_steps as $index => $step) : ?>
            <article class="relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-6 md:p-7">

              <div class="absolute left-8 top-20 hidden h-full w-px bg-gradient-to-b from-blue-500/30 to-transparent lg:block"></div>

              <div class="relative flex flex-col gap-6 md:flex-row">

                <div class="flex items-start gap-4 md:w-[210px] md:flex-col md:gap-5">

                  <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                    <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($step['icon'], 'h-5 w-5')) : ''; ?>
                  </div>

                  <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
                      <?php echo esc_html(sprintf(__('Step %d', 'reviewservicepro'), $index + 1)); ?>
                    </p>

                    <h3 class="mt-2 text-xl font-extrabold text-white">
                      <?php echo esc_html($step['label']); ?>
                    </h3>
                  </div>

                </div>

                <div class="flex-1">

                  <h4 class="text-2xl font-extrabold text-white">
                    <?php echo esc_html($step['title']); ?>
                  </h4>

                  <p class="mt-4 text-sm leading-7 text-slate-300 md:text-base md:leading-8">
                    <?php echo esc_html($step['text']); ?>
                  </p>

                </div>

              </div>

            </article>
          <?php endforeach; ?>

        </div>

        <div class="mt-10 grid grid-cols-1 gap-5 md:grid-cols-3">

          <?php foreach ($solution_cards as $card) : ?>
            <div class="rounded-[2rem] border border-blue-500/[0.18] bg-blue-600/[0.07] p-6">

              <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($card['icon'], 'h-5 w-5')) : ''; ?>
              </div>

              <h3 class="text-xl font-extrabold text-white">
                <?php echo esc_html($card['title']); ?>
              </h3>

              <p class="mt-4 text-sm leading-7 text-slate-300">
                <?php echo esc_html($card['text']); ?>
              </p>

            </div>
          <?php endforeach; ?>

        </div>

        <?php if (! empty($challenge) || ! empty($result)) : ?>
          <div class="mt-10 grid grid-cols-1 gap-6 lg:grid-cols-2">

            <div class="rounded-[2rem] border border-red-500/[0.16] bg-red-500/[0.05] p-6 md:p-7">
              <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-red-500/20 bg-red-500/10 text-red-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('triangle-alert', 'h-5 w-5')) : ''; ?>
              </div>

              <h3 class="text-2xl font-extrabold text-white">
                <?php esc_html_e('Challenge', 'reviewservicepro'); ?>
              </h3>

              <p class="mt-4 text-sm leading-7 text-slate-300">
                <?php
                echo esc_html(
                  $challenge
                    ? $challenge
                    : __('The business faced trust visibility issues, inconsistent review responses, and customer perception risks.', 'reviewservicepro')
                );
                ?>
              </p>
            </div>

            <div class="rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-7">
              <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('badge-check', 'h-5 w-5')) : ''; ?>
              </div>

              <h3 class="text-2xl font-extrabold text-white">
                <?php esc_html_e('Outcome', 'reviewservicepro'); ?>
              </h3>

              <p class="mt-4 text-sm leading-7 text-slate-300">
                <?php
                echo esc_html(
                  $result
                    ? $result
                    : __('The ORM workflow improved trust visibility, monitoring consistency, and customer communication quality.', 'reviewservicepro')
                );
                ?>
              </p>
            </div>

          </div>
        <?php endif; ?>

        <?php if (! empty($ai_summary)) : ?>
          <div class="mt-10 rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-8">

            <div class="mb-5 flex items-center gap-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('bot', 'h-5 w-5')) : ''; ?>
              </div>

              <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
                  <?php esc_html_e('AI Search Summary', 'reviewservicepro'); ?>
                </p>

                <h3 class="mt-1 text-xl font-extrabold text-white">
                  <?php esc_html_e('How AI systems may summarize this case study', 'reviewservicepro'); ?>
                </h3>
              </div>
            </div>

            <p class="text-sm leading-7 text-slate-300 md:text-base md:leading-8">
              <?php echo esc_html($ai_summary); ?>
            </p>

          </div>
        <?php endif; ?>

      </div>

    </div>

  </div>
</section>