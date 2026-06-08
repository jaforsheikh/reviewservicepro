<?php

/**
 * Case Study Final CTA Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id         = get_the_ID();
$case_title      = get_the_title();
$platform_used   = get_post_meta($post_id, 'rsp_platform_used', true);
$cta_url         = get_post_meta($post_id, 'rsp_cta_url', true);

if (empty($cta_url)) {
  $cta_url = home_url('/contact/?type=free-audit');
}

$consultation_url = home_url('/contact/?type=consultation');

$trust_badges = [
  __('Ethical ORM Workflow', 'reviewservicepro'),
  __('Platform-Compliant Methods', 'reviewservicepro'),
  __('Human Reputation Specialists', 'reviewservicepro'),
  __('Monitoring & Reporting Support', 'reviewservicepro'),
];

$process_steps = [
  [
    'icon'  => 'search-check',
    'title' => __('Audit & Analysis', 'reviewservicepro'),
    'text'  => __('We analyze reviews, customer sentiment, trust signals, and platform visibility issues.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'workflow',
    'title' => __('Strategy Planning', 'reviewservicepro'),
    'text'  => __('A custom ORM workflow is prepared based on your business type and reputation risks.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'shield-check',
    'title' => __('Trust Growth Execution', 'reviewservicepro'),
    'text'  => __('We implement ethical reputation strategies focused on long-term trust improvement.', 'reviewservicepro'),
  ],
];
?>

<section
  class="relative overflow-hidden bg-[#07111F] py-20 md:py-24"
  data-gsap="case-study-cta"
  aria-labelledby="case-study-cta-title">
  <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.12),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.08),transparent_34%)]"></div>

  <div class="pointer-events-none absolute left-1/2 top-0 h-[480px] w-[780px] -translate-x-1/2 rounded-full bg-blue-600/[0.10] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="overflow-hidden rounded-[2.5rem] border border-white/[0.08] bg-white/[0.04]">

      <div class="grid grid-cols-1 gap-0 xl:grid-cols-[1.05fr_0.95fr]">

        <div class="relative overflow-hidden p-8 md:p-12 xl:p-14">

          <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.12),transparent_38%)]"></div>

          <div class="relative z-10">

            <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
              <?php
              if (function_exists('rsp_icon')) {
                echo wp_kses_post(
                  rsp_icon(
                    'sparkles',
                    'h-3.5 w-3.5'
                  )
                );
              }
              ?>

              <?php esc_html_e('Reputation Growth CTA', 'reviewservicepro'); ?>
            </span>

            <h2
              id="case-study-cta-title"
              class="max-w-3xl text-4xl font-extrabold leading-tight tracking-tight text-white md:text-5xl">
              <?php
              printf(
                esc_html__(
                  'Want results similar to %s?',
                  'reviewservicepro'
                ),
                esc_html($case_title)
              );
              ?>
            </h2>

            <p class="mt-6 max-w-2xl text-base leading-8 text-slate-300 md:text-lg">
              <?php
              printf(
                esc_html__(
                  'Build stronger trust, improve customer perception, and create a healthier reputation workflow%s using ethical ORM strategies.',
                  'reviewservicepro'
                ),
                ! empty($platform_used)
                  ? ' on ' . esc_html($platform_used)
                  : ''
              );
              ?>
            </p>

            <div class="mt-8 flex flex-wrap gap-3">

              <?php foreach ($trust_badges as $badge) : ?>

                <span class="inline-flex items-center rounded-full border border-white/[0.08] bg-white/[0.05] px-4 py-2 text-xs font-bold text-slate-200">
                  <?php echo esc_html($badge); ?>
                </span>

              <?php endforeach; ?>

            </div>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row">

              <a
                href="<?php echo esc_url($cta_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700">
                <?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?>

                <?php
                if (function_exists('rsp_icon')) {
                  echo wp_kses_post(
                    rsp_icon(
                      'arrow-right',
                      'h-4 w-4'
                    )
                  );
                }
                ?>
              </a>

              <a
                href="<?php echo esc_url($consultation_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.04] px-7 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40 hover:bg-white/[0.07]">
                <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
              </a>

            </div>

            <div class="mt-10 rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6">

              <div class="mb-4 flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300">
                  <?php
                  if (function_exists('rsp_icon')) {
                    echo wp_kses_post(
                      rsp_icon(
                        'shield-check',
                        'h-5 w-5'
                      )
                    );
                  }
                  ?>
                </div>

                <div>
                  <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
                    <?php esc_html_e('Ethical ORM Promise', 'reviewservicepro'); ?>
                  </p>

                  <h3 class="mt-1 text-xl font-extrabold text-white">
                    <?php esc_html_e('Trust-first reputation management', 'reviewservicepro'); ?>
                  </h3>
                </div>

              </div>

              <p class="text-sm leading-7 text-slate-300">
                <?php esc_html_e('ReviewService.Pro does not create fake reviews or manipulate platforms. Our workflow focuses on ethical reputation management, review monitoring, response quality, and customer trust improvement.', 'reviewservicepro'); ?>
              </p>

            </div>

          </div>

        </div>

        <div class="border-t border-white/[0.08] bg-[#0B1220] p-8 md:p-12 xl:border-l xl:border-t-0 xl:p-14">

          <div class="mb-8">

            <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
              <?php
              if (function_exists('rsp_icon')) {
                echo wp_kses_post(
                  rsp_icon(
                    'workflow',
                    'h-3.5 w-3.5'
                  )
                );
              }
              ?>

              <?php esc_html_e('Simple Next Steps', 'reviewservicepro'); ?>
            </span>

            <h3 class="mt-5 text-3xl font-extrabold text-white">
              <?php esc_html_e('How the process works', 'reviewservicepro'); ?>
            </h3>

            <p class="mt-4 text-base leading-8 text-slate-400">
              <?php esc_html_e('A professional ORM workflow focused on trust, visibility, customer confidence, and long-term brand protection.', 'reviewservicepro'); ?>
            </p>

          </div>

          <div class="space-y-5">

            <?php foreach ($process_steps as $index => $step) : ?>

              <div class="relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-6">

                <div class="flex gap-5">

                  <div class="flex flex-col items-center">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">

                      <?php
                      if (function_exists('rsp_icon')) {
                        echo wp_kses_post(
                          rsp_icon(
                            $step['icon'],
                            'h-5 w-5'
                          )
                        );
                      }
                      ?>

                    </div>

                    <?php if ($index !== count($process_steps) - 1) : ?>

                      <div class="mt-3 h-full w-px bg-gradient-to-b from-blue-500/30 to-transparent"></div>

                    <?php endif; ?>

                  </div>

                  <div class="flex-1">

                    <p class="text-[11px] font-bold uppercase tracking-[0.12em] text-blue-300">
                      <?php
                      printf(
                        esc_html__(
                          'Step %d',
                          'reviewservicepro'
                        ),
                        intval($index + 1)
                      );
                      ?>
                    </p>

                    <h4 class="mt-2 text-xl font-extrabold text-white">
                      <?php echo esc_html($step['title']); ?>
                    </h4>

                    <p class="mt-3 text-sm leading-7 text-slate-300">
                      <?php echo esc_html($step['text']); ?>
                    </p>

                  </div>

                </div>

              </div>

            <?php endforeach; ?>

          </div>

          <div class="mt-8 rounded-[2rem] border border-blue-500/[0.18] bg-blue-600/[0.07] p-6">

            <div class="flex items-start gap-4">

              <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">

                <?php
                if (function_exists('rsp_icon')) {
                  echo wp_kses_post(
                    rsp_icon(
                      'message-circle-heart',
                      'h-5 w-5'
                    )
                  );
                }
                ?>

              </div>

              <div>

                <h4 class="text-xl font-extrabold text-white">
                  <?php esc_html_e('Fast response reassurance', 'reviewservicepro'); ?>
                </h4>

                <p class="mt-3 text-sm leading-7 text-slate-300">
                  <?php esc_html_e('Most audit requests receive a response within 24 business hours with reputation insights, platform observations, and strategic next-step recommendations.', 'reviewservicepro'); ?>
                </p>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
</section>