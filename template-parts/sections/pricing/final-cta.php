<?php

/**
 * Pricing Final CTA Section
 *
 * File: template-parts/sections/pricing/final-cta.php
 *
 * Fixes (all functions/keyframes unchanged):
 * 1.  Section bg  none → bg-[#F8FAFC] for consistency
 * 2.  Main card border  border-slate-200 → border-[#E2E8F0]
 * 3.  Kicker badge  DM Mono, explicit font tokens
 * 4.  H2  text-4xl/5xl font-semibold → Poppins clamp(28px,4vw,42px) font-extrabold
 * 5.  H2 color  #020617 → #0F172A (design system token)
 * 6.  H2 tracking  -0.055em → -0.038em
 * 7.  Sub paragraph  text-slate-700 → #475569 Inter 16px/1.72, max-w 560px
 * 8.  CTA primary  font-medium → font-semibold Inter 15px, shadow refined
 * 9.  CTA secondary  border-slate-200 → border-[#E2E8F0] Inter 15px font-semibold
 * 10. Trust point labels  text-slate-700 → #334155 Inter 14px font-medium
 * 11. Trust point borders  border-slate-200 → border-[#E2E8F0]
 * 12. Right panel bg  bg-slate-50/90 border-slate-200 → bg-[#F8FAFC] border-[#E2E8F0]
 * 13. Panel label  text-slate-500 → DM Mono 10.5px #94A3B8
 * 14. Panel H3  text-2xl font-semibold → Poppins 20px font-bold
 * 15. Step card border  border-slate-200 → border-[#E2E8F0]
 * 16. Step number  font-mono → DM Mono explicit
 * 17. Step H4  text-lg font-medium → Poppins 15px font-bold
 * 18. Step body  text-slate-700 → #475569 Inter 14px/1.7
 * 19. Compliance note  text-sm text-slate-700 → Inter 13px #78350F
 * 20. Monthly ORM link  border-slate-200 font-medium → border-[#E2E8F0] font-semibold Inter 14px
 * 21. Section top/bottom borders bg-[#E2E8F0]
 * All keyframes rspPricingFinalBeam/Float, IntersectionObserver — UNCHANGED
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$context = isset($args) && is_array($args) ? $args : [];

$contact_url = ! empty($context['contact_url'])
  ? esc_url($context['contact_url'])
  : esc_url(home_url('/contact/?type=pricing-help'));

$services_page_url = ! empty($context['services_page_url'])
  ? esc_url($context['services_page_url'])
  : esc_url(home_url('/services/'));

$trust_points = [
  ['label' => __('One-time packages',    'reviewservicepro'), 'icon' => 'package-check'],
  ['label' => __('Secure checkout',      'reviewservicepro'), 'icon' => 'credit-card'],
  ['label' => __('Client portal access', 'reviewservicepro'), 'icon' => 'layout-dashboard'],
  ['label' => __('Ethical ORM only',     'reviewservicepro'), 'icon' => 'shield-check'],
];

$next_steps = [
  [
    'number' => '01',
    'title'  => __('Pick a small starting service', 'reviewservicepro'),
    'text'   => __('Choose a one-time package, platform check, or add-on based on your current reputation concern.', 'reviewservicepro'),
  ],
  [
    'number' => '02',
    'title'  => __('Review details before checkout', 'reviewservicepro'),
    'text'   => __('Use the product details page to understand scope, timeline, and included deliverables.', 'reviewservicepro'),
  ],
  [
    'number' => '03',
    'title'  => __('Continue in your portal', 'reviewservicepro'),
    'text'   => __('After payment, your onboarding and order workflow continue inside the client portal.', 'reviewservicepro'),
  ],
];
?>

<style>
  /* ── Reveal system — unchanged ── */
  .rsp-pricing-final-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-pricing-final-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Main card background — unchanged ── */
  .rsp-pricing-final-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-pricing-final-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(circle at 10% 10%, rgba(37, 99, 235, 0.12), transparent 34%),
      radial-gradient(circle at 90% 20%, rgba(0, 200, 83, 0.12), transparent 34%),
      linear-gradient(135deg, rgba(255, 255, 255, 0.96), rgba(248, 250, 252, 0.92));
    pointer-events: none;
  }

  /* ── Beam animation — unchanged ── */
  .rsp-pricing-final-beam {
    animation: rspPricingFinalBeam 7s ease-in-out infinite;
  }

  @keyframes rspPricingFinalBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Float animation — unchanged ── */
  .rsp-pricing-final-float {
    animation: rspPricingFinalFloat 4.6s ease-in-out infinite;
  }

  @keyframes rspPricingFinalFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-6px);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {
    .rsp-pricing-final-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-pricing-final-beam,
    .rsp-pricing-final-float {
      animation: none;
    }
  }
</style>

<section
  id="pricing-final-cta"
  class="relative overflow-hidden bg-[#F8FAFC] px-5 pb-20 pt-12 sm:px-6 lg:px-8 lg:pb-24 lg:pt-16"
  aria-labelledby="pricing-final-cta-title">

  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>

  <!-- subtle bg texture -->
  <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(37,99,235,0.032)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.032)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div
      class="rsp-pricing-final-card rsp-pricing-final-reveal rounded-[2.25rem] border border-[#E2E8F0] bg-white p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_28px_100px_rgba(15,23,42,0.10)] md:p-8 lg:p-10"
      data-pricing-final-reveal>

      <!-- animated top beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 z-10 h-px overflow-hidden rounded-t-[2.25rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-final-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">

        <!-- ── LEFT: Headline + CTAs + Trust points ── -->
        <div>

          <!-- Kicker badge -->
          <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/22 bg-[#00C853]/[0.07] px-4 py-[5px] font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.14em] text-[#065F46]">
            <i data-lucide="sparkles" class="h-[13px] w-[13px] text-[#00A344]" aria-hidden="true"></i>
            <?php esc_html_e('Start Small. Build Trust.', 'reviewservicepro'); ?>
          </span>

          <!-- H2 — FIX: Poppins clamp, tracking, color -->
          <h2
            id="pricing-final-cta-title"
            class="mt-5 font-['Poppins',sans-serif] text-[clamp(26px,4vw,42px)] font-extrabold leading-[1.1] tracking-[-0.038em] text-[#0F172A]">
            <?php esc_html_e('Start with a focused reputation package today.', 'reviewservicepro'); ?>
          </h2>

          <!-- Sub paragraph — FIX: Inter 16px #475569 -->
          <p class="mt-5 max-w-[560px] font-['Inter',sans-serif] text-[16px] font-normal leading-[1.72] text-[#475569]">
            <?php esc_html_e('Order a one-time reputation audit, review response setup, negative review case review, platform check, or small ORM add-on. Start with clarity before committing to ongoing monthly management.', 'reviewservicepro'); ?>
          </p>

          <!-- CTAs — FIX: Inter 15px font-semibold -->
          <div class="mt-7 flex flex-col gap-3 sm:flex-row">
            <a
              href="#pricing-main-packages"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-[13px] font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_32px_rgba(37,99,235,.22)] transition-all duration-200 hover:-translate-y-[2px] hover:bg-[#1D4ED8] hover:shadow-[0_6px_8px_rgba(37,99,235,.22),0_18px_44px_rgba(37,99,235,.3)]">
              <?php esc_html_e('View Packages', 'reviewservicepro'); ?>
              <i data-lucide="arrow-up" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-6 py-[12px] font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155] shadow-sm transition-all duration-200 hover:-translate-y-[2px] hover:border-blue-200 hover:bg-blue-50 hover:text-[#1D4ED8]">
              <?php esc_html_e('Need Recommendation?', 'reviewservicepro'); ?>
              <i data-lucide="message-square" class="h-4 w-4 text-[#2563EB]" aria-hidden="true"></i>
            </a>
          </div>

          <!-- Trust point grid — FIX: Inter 14px, border-[#E2E8F0] -->
          <div class="mt-7 grid grid-cols-1 gap-3 sm:grid-cols-2">
            <?php foreach ($trust_points as $point) : ?>
              <div class="flex items-center gap-3 rounded-2xl border border-[#E2E8F0] bg-white p-3 shadow-[0_1px_3px_rgba(0,0,0,.04),0_6px_20px_rgba(0,0,0,.05)]">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#00C853]/22 bg-[#00C853]/[0.07]">
                  <i data-lucide="<?php echo esc_attr($point['icon']); ?>" class="h-[16px] w-[16px] text-[#00A344]" aria-hidden="true"></i>
                </div>
                <p class="font-['Inter',sans-serif] text-[14px] font-medium leading-[1.5] text-[#334155]">
                  <?php echo esc_html($point['label']); ?>
                </p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- ── RIGHT: Steps panel + compliance ── -->
        <div class="rsp-pricing-final-float rounded-[2rem] border border-[#E2E8F0] bg-[#F8FAFC] p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_65px_rgba(15,23,42,0.07)]">

          <!-- Panel header -->
          <div class="mb-5 flex items-center justify-between gap-4">
            <div>
              <!-- FIX: DM Mono label -->
              <p class="font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.13em] text-[#94A3B8]">
                <?php esc_html_e('Best Next Step', 'reviewservicepro'); ?>
              </p>
              <!-- FIX: Poppins 20px font-bold -->
              <h3 class="mt-1 font-['Poppins',sans-serif] text-[20px] font-bold leading-snug tracking-[-0.025em] text-[#0F172A]">
                <?php esc_html_e('Choose clarity before commitment.', 'reviewservicepro'); ?>
              </h3>
            </div>
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50">
              <i data-lucide="route" class="h-5 w-5 text-[#2563EB]" aria-hidden="true"></i>
            </div>
          </div>

          <!-- Step cards -->
          <div class="space-y-3">
            <?php foreach ($next_steps as $step) : ?>
              <article class="rounded-[1.25rem] border border-[#E2E8F0] bg-white p-4 shadow-[0_1px_3px_rgba(0,0,0,.04),0_8px_24px_rgba(0,0,0,.05)]">
                <div class="flex items-start gap-4">
                  <!-- FIX: DM Mono explicit -->
                  <span class="font-['DM_Mono',monospace] text-[12px] font-medium tracking-[0.16em] text-[#2563EB]">
                    <?php echo esc_html($step['number']); ?>
                  </span>
                  <div>
                    <!-- FIX: Poppins 15px font-bold -->
                    <h4 class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug tracking-[-0.015em] text-[#0F172A]">
                      <?php echo esc_html($step['title']); ?>
                    </h4>
                    <!-- FIX: Inter 14px/1.7 #475569 -->
                    <p class="mt-1.5 font-['Inter',sans-serif] text-[14px] font-normal leading-[1.7] text-[#475569]">
                      <?php echo esc_html($step['text']); ?>
                    </p>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

          <!-- Compliance note — FIX: Inter 13px #78350F -->
          <div class="mt-4 rounded-[1.25rem] border border-amber-100 bg-amber-50/80 p-4">
            <div class="flex items-start gap-3">
              <i data-lucide="shield-alert" class="mt-0.5 h-[15px] w-[15px] shrink-0 text-amber-600" aria-hidden="true"></i>
              <p class="font-['Inter',sans-serif] text-[13px] font-normal leading-[1.65] text-[#78350F]">
                <?php esc_html_e('ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>

          <!-- Monthly ORM link — FIX: Inter 14px font-semibold, border-[#E2E8F0] -->
          <a
            href="<?php echo esc_url($services_page_url); ?>#monthly-plans"
            class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 font-['Inter',sans-serif] text-[14px] font-semibold text-[#334155] shadow-sm transition-all duration-200 hover:-translate-y-[2px] hover:border-[#00C853]/25 hover:bg-[#00C853]/[0.045] hover:text-[#065F46]">
            <?php esc_html_e('Looking for Monthly ORM?', 'reviewservicepro'); ?>
            <i data-lucide="calendar-check" class="h-[15px] w-[15px] text-[#00A344]" aria-hidden="true"></i>
          </a>

        </div>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    /* IntersectionObserver — data-pricing-final-reveal + pricingFinalVisible + rsp-is-visible unchanged */
    function initPricingFinalCTA() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-pricing-final-reveal]');
      if (!items.length) return;

      function showItem(item) {
        if (!item || item.dataset.pricingFinalVisible === 'true') return;
        item.dataset.pricingFinalVisible = 'true';
        item.classList.add('rsp-is-visible');
      }

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              showItem(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -30px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });
        return;
      }

      items.forEach(showItem);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initPricingFinalCTA);
    } else {
      initPricingFinalCTA();
    }
  }());
</script>