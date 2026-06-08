<?php

/**
 * Services Page Final CTA Section
 *
 * File: template-parts/sections/services/final-cta.php
 *
 * ReviewService.Pro — Ultra Compact Final CTA
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$monthly_plans_url    = '#monthly-plans';
$one_time_package_url = '#one-time-packages';
$contact_url          = home_url('/contact/?type=custom-orm-quote');
$pricing_url          = home_url('/pricing/');

$trust_pills = [
  [
    'icon' => 'shield-check',
    'text' => __('No fake reviews', 'reviewservicepro'),
  ],
  [
    'icon' => 'badge-check',
    'text' => __('Platform-compliant', 'reviewservicepro'),
  ],
  [
    'icon' => 'file-text',
    'text' => __('Monthly reports', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock',
    'text' => __('Secure portal', 'reviewservicepro'),
  ],
];

$stats = [
  [
    'icon'  => 'monitor-check',
    'value' => __('25+', 'reviewservicepro'),
    'label' => __('Platforms', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'calendar-check',
    'value' => __('3', 'reviewservicepro'),
    'label' => __('Monthly plans', 'reviewservicepro'),
    'tone'  => 'emerald',
  ],
  [
    'icon'  => 'package-check',
    'value' => __('3', 'reviewservicepro'),
    'label' => __('One-time packages', 'reviewservicepro'),
    'tone'  => 'purple',
  ],
];

$tone_classes = [
  'blue'    => 'border-blue-400/25 bg-blue-400/10 text-blue-200',
  'emerald' => 'border-emerald-400/25 bg-emerald-400/10 text-emerald-200',
  'purple'  => 'border-violet-400/25 bg-violet-400/10 text-violet-200',
];
?>

<style>
  .rsp-final-cta-reveal {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity 600ms ease, transform 600ms ease;
  }

  .rsp-final-cta-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-final-cta-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }
  }
</style>

<section
  id="services-final-cta"
  class="relative overflow-hidden bg-[linear-gradient(160deg,#030712_0%,#0F172A_50%,#0C1A2E_100%)] py-10 font-sans md:py-14"
  aria-labelledby="services-final-cta-title"
  data-rsp-final-cta-section>

  <!-- Background -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(255,255,255,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.035)_1px,transparent_1px)] bg-[size:56px_56px]"></div>
  <div class="pointer-events-none absolute -left-24 -top-32 z-0 h-[420px] w-[420px] rounded-full bg-blue-500/20 blur-[120px]"></div>
  <div class="pointer-events-none absolute -bottom-32 -right-20 z-0 h-[380px] w-[380px] rounded-full bg-emerald-400/15 blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

    <div
      class="rsp-final-cta-reveal overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/[0.045] shadow-2xl shadow-blue-950/25 backdrop-blur-2xl"
      data-rsp-final-cta-animate>

      <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px]">

        <!-- Left -->
        <div class="relative p-6 md:p-8">
          <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(135deg,rgba(255,255,255,0.06),transparent_55%,rgba(16,185,129,0.05))]"></div>

          <div class="relative z-10">
            <span class="mb-4 inline-flex w-fit items-center gap-2 rounded-full border border-indigo-300/25 bg-indigo-400/10 px-3.5 py-1.5 text-[11px] font-black uppercase tracking-[0.14em] text-indigo-100">
              <i data-lucide="sparkles" class="h-3.5 w-3.5" aria-hidden="true"></i>
              <?php esc_html_e('Start Your ORM System', 'reviewservicepro'); ?>
            </span>

            <h2
              id="services-final-cta-title"
              class="max-w-3xl font-sans text-3xl font-black leading-[1.08] tracking-[-0.045em] text-white md:text-4xl lg:text-[2.8rem]">
              <?php esc_html_e('Ready to build a stronger online reputation system?', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-4 max-w-2xl text-sm leading-7 text-white/65 md:text-base">
              <?php esc_html_e('Choose a monthly ORM plan or start with a one-time package. We help monitor, respond, document, report, and improve reputation using ethical, platform-compliant methods.', 'reviewservicepro'); ?>
            </p>

            <!-- Buttons -->
            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
              <a
                href="<?php echo esc_url($monthly_plans_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#3B82F6] px-5 py-3 text-sm font-black text-white shadow-lg shadow-blue-900/30 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-400/25">
                <?php esc_html_e('Start My Project', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
              </a>

              <a
                href="<?php echo esc_url($one_time_package_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-black text-white/90 transition-all duration-300 hover:-translate-y-1 hover:bg-white/15 focus:outline-none focus:ring-4 focus:ring-white/10">
                <?php esc_html_e('One-Time Packages', 'reviewservicepro'); ?>
                <i data-lucide="package-check" class="h-4 w-4" aria-hidden="true"></i>
              </a>

              <a
                href="<?php echo esc_url($contact_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/15 bg-transparent px-5 py-3 text-sm font-black text-white/75 transition-all duration-300 hover:-translate-y-1 hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-white/10">
                <?php esc_html_e('Custom Quote', 'reviewservicepro'); ?>
                <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            </div>

            <!-- Trust Pills -->
            <div class="mt-6 flex flex-wrap gap-2" role="list">
              <?php foreach ($trust_pills as $pill) : ?>
                <span
                  class="inline-flex items-center gap-1.5 rounded-full border border-white/15 bg-white/[0.05] px-3 py-1.5 text-[11px] font-bold text-slate-200"
                  role="listitem">
                  <i data-lucide="<?php echo esc_attr($pill['icon']); ?>" class="h-3.5 w-3.5 text-emerald-300" aria-hidden="true"></i>
                  <?php echo esc_html($pill['text']); ?>
                </span>
              <?php endforeach; ?>
            </div>

            <!-- Short Compliance -->
            <p class="mt-5 max-w-3xl rounded-2xl border border-emerald-300/20 bg-emerald-400/10 px-4 py-3 text-xs font-semibold leading-6 text-emerald-100/80">
              <span class="font-black text-emerald-200">
                <?php esc_html_e('Ethical ORM:', 'reviewservicepro'); ?>
              </span>
              <?php esc_html_e('No fake reviews, no paid incentives, no rating manipulation, no guaranteed removals, and no ranking guarantees.', 'reviewservicepro'); ?>
            </p>
          </div>
        </div>

        <!-- Right Compact Panel -->
        <div class="border-t border-white/10 bg-slate-950/45 p-5 backdrop-blur-xl lg:border-l lg:border-t-0">

          <div class="grid grid-cols-3 gap-2 lg:grid-cols-1">
            <?php foreach ($stats as $stat) : ?>
              <?php $tone = $tone_classes[$stat['tone']] ?? $tone_classes['blue']; ?>

              <div class="rounded-2xl border border-white/10 bg-white/[0.05] p-3 transition-all duration-300 hover:border-white/20 hover:bg-white/[0.08]">
                <div class="flex flex-col items-center text-center lg:flex-row lg:items-center lg:gap-3 lg:text-left">
                  <div class="<?php echo esc_attr($tone); ?> mb-2 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border lg:mb-0">
                    <i data-lucide="<?php echo esc_attr($stat['icon']); ?>" class="h-4 w-4" aria-hidden="true"></i>
                  </div>

                  <div>
                    <p class="font-sans text-2xl font-black leading-none tracking-[-0.04em] text-white">
                      <?php echo esc_html($stat['value']); ?>
                    </p>

                    <p class="mt-1 text-[11px] font-semibold leading-4 text-white/55">
                      <?php echo esc_html($stat['label']); ?>
                    </p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="mt-4 rounded-2xl border border-white/10 bg-slate-950/55 p-4">
            <h3 class="font-sans text-base font-black text-white">
              <?php esc_html_e('Next step', 'reviewservicepro'); ?>
            </h3>

            <p class="mt-2 text-xs leading-6 text-white/55">
              <?php esc_html_e('Choose a plan, complete checkout, and access your client portal for onboarding, reports, support, orders, and invoices.', 'reviewservicepro'); ?>
            </p>
          </div>

          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/[0.06] px-4 py-3 text-xs font-black text-white/80 transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.1]">
            <?php esc_html_e('View Full Pricing', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

        </div>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspFinalCtaSection() {
      var root = document.querySelector('[data-rsp-final-cta-section]');

      if (!root) {
        return;
      }

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = root.querySelectorAll('[data-rsp-final-cta-animate]');

      function reveal(item) {
        if (!item || item.dataset.rspFinalCtaRevealed === 'true') {
          return;
        }

        item.dataset.rspFinalCtaRevealed = 'true';
        item.classList.add('rsp-visible');
      }

      if (!('IntersectionObserver' in window)) {
        revealItems.forEach(reveal);
        return;
      }

      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            reveal(entry.target);
          }
        });
      }, {
        threshold: 0.08,
        rootMargin: '0px 0px -20px 0px'
      });

      revealItems.forEach(function(item) {
        observer.observe(item);
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspFinalCtaSection);
    } else {
      initRspFinalCtaSection();
    }
  })();
</script>