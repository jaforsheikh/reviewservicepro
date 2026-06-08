<?php

/**
 * Home Section: Final CTA
 *
 * White SaaS premium final CTA section for ReviewService.Pro.
 *
 * Preserved hooks/targets:
 * - id="final-cta"
 * - data-gsap="cta-animate"
 * - data-gsap-item="cta-card"
 * - data-gsap-item="cta-trust"
 * - data-gsap-item="cta-steps"
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$audit_url   = get_theme_mod('cta_audit_url', home_url('/contact/?type=free-audit'));
$consult_url = get_theme_mod('cta_consult_url', home_url('/contact/?type=consultation'));

if (empty($audit_url)) {
  $audit_url = home_url('/contact/?type=free-audit');
}

if (empty($consult_url)) {
  $consult_url = home_url('/contact/?type=consultation');
}

$trust_items = array(
  array(
    'icon' => 'shield-check',
    'text' => __('Ethical ORM', 'reviewservicepro'),
  ),
  array(
    'icon' => 'check-circle',
    'text' => __('Platform-compliant', 'reviewservicepro'),
  ),
  array(
    'icon' => 'ban',
    'text' => __('No fake reviews', 'reviewservicepro'),
  ),
  array(
    'icon' => 'clipboard-check',
    'text' => __('Clear next steps', 'reviewservicepro'),
  ),
);

$steps = array(
  array(
    'num'   => '01',
    'icon'  => 'search-check',
    'title' => __('Audit', 'reviewservicepro'),
    'desc'  => __('We check your review profile, platform coverage, response gaps, and visible reputation risks.', 'reviewservicepro'),
  ),
  array(
    'num'   => '02',
    'icon'  => 'clipboard-list',
    'title' => __('Strategy', 'reviewservicepro'),
    'desc'  => __('You get a clear action plan focused on ethical review monitoring, response support, and trust signals.', 'reviewservicepro'),
  ),
  array(
    'num'   => '03',
    'icon'  => 'trending-up',
    'title' => __('Improve', 'reviewservicepro'),
    'desc'  => __('We help build a long-term reputation workflow with documentation, reporting, and genuine feedback systems.', 'reviewservicepro'),
  ),
);
?>

<section
  id="final-cta"
  class="rsp-final-cta-section relative overflow-hidden border-t border-slate-200 bg-[#F8FAFC] py-24 md:py-32"
  role="region"
  aria-label="<?php esc_attr_e('Start your reputation audit', 'reviewservicepro'); ?>"
  data-gsap="cta-animate">
  <style>
    #final-cta {
      --cta-navy: #07111F;
      --cta-blue: #2563EB;
      --cta-green: #00C853;
      --cta-teal: #14B8A6;
      --cta-slate: #475569;
      --cta-border: rgba(15, 23, 42, 0.10);
    }

    #final-cta .rsp-cta-main-text {
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
    }

    #final-cta .rsp-cta-motion-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      transform: translateY(0) scale(1);
      transition:
        transform 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 420ms cubic-bezier(0.2, 0.9, 0.2, 1),
        border-color 320ms ease,
        background-color 320ms ease;
    }

    #final-cta .rsp-cta-motion-card::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.10),
          rgba(0, 200, 83, 0.32),
          rgba(20, 184, 166, 0.22),
          rgba(37, 99, 235, 0.30),
          rgba(37, 99, 235, 0.10));
      opacity: 0;
      transform: rotate(0deg);
      transition: opacity 280ms ease;
      animation: rspCtaBorderSpin 7s linear infinite;
    }

    #final-cta .rsp-cta-motion-card::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: #ffffff;
    }

    #final-cta .rsp-cta-motion-card:hover {
      transform: translateY(-8px) scale(1.006);
      border-color: rgba(37, 99, 235, 0.20);
      box-shadow: 0 30px 90px rgba(15, 23, 42, 0.14);
    }

    #final-cta .rsp-cta-motion-card:hover::before {
      opacity: 1;
    }

    #final-cta .rsp-cta-main-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #final-cta .rsp-cta-main-card::before {
      content: "";
      position: absolute;
      inset: -120px;
      z-index: -1;
      background:
        radial-gradient(circle at 16% 14%, rgba(37, 99, 235, 0.16), transparent 30%),
        radial-gradient(circle at 76% 20%, rgba(0, 200, 83, 0.14), transparent 30%),
        radial-gradient(circle at 70% 88%, rgba(20, 184, 166, 0.12), transparent 32%);
      animation: rspCtaGlowMove 9s ease-in-out infinite alternate;
    }

    #final-cta .rsp-cta-main-card::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -1;
      background-image:
        linear-gradient(rgba(15, 23, 42, 0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(15, 23, 42, 0.035) 1px, transparent 1px);
      background-size: 42px 42px;
      mask-image: linear-gradient(to bottom, black, transparent 92%);
      opacity: 0.8;
    }

    #final-cta .rsp-cta-visual {
      position: relative;
      animation: rspCtaFloat 7s ease-in-out infinite;
    }

    #final-cta .rsp-cta-visual::before {
      content: "";
      position: absolute;
      inset: -1px;
      border-radius: 2rem;
      background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.42), rgba(0, 200, 83, 0.32), transparent);
      background-size: 220% 100%;
      animation: rspCtaBeam 5.5s ease-in-out infinite;
      opacity: 0.88;
      pointer-events: none;
    }

    #final-cta .rsp-cta-visual-inner {
      position: relative;
      z-index: 1;
    }

    #final-cta .rsp-cta-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        background-color 260ms ease,
        border-color 260ms ease;
    }

    #final-cta .rsp-cta-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.32), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
    }

    #final-cta .rsp-cta-btn:hover {
      transform: translateY(-3px);
    }

    #final-cta .rsp-cta-btn:hover::before {
      left: 135%;
    }

    #final-cta .rsp-cta-trust-item {
      transition:
        transform 280ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 280ms ease,
        border-color 280ms ease,
        background-color 280ms ease;
    }

    #final-cta .rsp-cta-trust-item:hover {
      transform: translateY(-4px);
      border-color: rgba(0, 200, 83, 0.22);
      background: #ECFDF5;
      box-shadow: 0 16px 40px rgba(0, 200, 83, 0.10);
    }

    #final-cta .rsp-cta-step-icon {
      transition:
        transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 280ms ease;
    }

    #final-cta .rsp-cta-motion-card:hover .rsp-cta-step-icon {
      transform: rotate(-4deg) scale(1.08);
      box-shadow: 0 16px 40px rgba(37, 99, 235, 0.12);
    }

    #final-cta .cta-underline {
      transform-origin: left;
    }

    #final-cta:hover .cta-underline {
      transform: scaleX(1);
    }

    #final-cta .rsp-cta-progress {
      transform-origin: left;
      animation: rspCtaProgress 2.2s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
    }

    #final-cta .rsp-cta-pulse-dot {
      animation: rspCtaPulse 1.4s ease-in-out infinite;
    }

    @keyframes rspCtaBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspCtaGlowMove {
      from {
        transform: translate3d(-20px, -10px, 0) scale(1);
      }

      to {
        transform: translate3d(20px, 14px, 0) scale(1.04);
      }
    }

    @keyframes rspCtaFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes rspCtaBeam {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    @keyframes rspCtaProgress {
      from {
        transform: scaleX(0.46);
      }

      to {
        transform: scaleX(0.92);
      }
    }

    @keyframes rspCtaPulse {

      0%,
      100% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.55);
        opacity: 0.55;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #final-cta *,
      #final-cta *::before,
      #final-cta *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }
    }
  </style>

  <!-- White SaaS background. -->
  <div
    class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.10),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.10),transparent_32%)]"
    aria-hidden="true"></div>

  <div
    class="pointer-events-none absolute left-1/2 top-0 z-0 h-px w-full max-w-6xl -translate-x-1/2 bg-gradient-to-r from-transparent via-slate-300 to-transparent"
    aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

    <!-- Main CTA -->
    <div
      class="rsp-cta-main-card rounded-[2.25rem] border border-slate-200 bg-white p-6 shadow-[0_28px_100px_rgba(15,23,42,0.11)] sm:p-8 lg:p-10"
      data-gsap-item="cta-card">
      <div class="grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(360px,0.72fr)] lg:gap-12">

        <div class="max-w-3xl">
          <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-emerald-700 shadow-sm">
            <span class="rsp-cta-pulse-dot h-1.5 w-1.5 rounded-full bg-[#00C853]" aria-hidden="true"></span>
            <?php esc_html_e('Free Reputation Audit', 'reviewservicepro'); ?>
          </span>

          <h2 class="mb-5 font-['Poppins',sans-serif] text-[clamp(34px,5vw,64px)] font-extrabold leading-[1.04] tracking-[-0.055em] text-[#07111F]">
            <?php esc_html_e('Build trust before', 'reviewservicepro'); ?>
            <span class="relative inline-block">
              <span class="relative z-10 bg-gradient-to-r from-blue-600 via-[#00C853] to-blue-500 bg-clip-text text-transparent">
                <?php esc_html_e('customers decide', 'reviewservicepro'); ?>
              </span>
              <span class="absolute inset-[-4px_-10px] z-0 rounded-lg border border-blue-200 bg-blue-50" aria-hidden="true"></span>
              <span class="cta-underline absolute -bottom-1 left-0 right-0 z-10 h-[2.5px] origin-left scale-x-0 rounded-full bg-gradient-to-r from-blue-600 via-[#00C853] to-transparent transition-transform duration-700" aria-hidden="true"></span>
            </span>
          </h2>

          <p class="rsp-cta-main-text mb-7 max-w-2xl font-['Inter',sans-serif] text-slate-600">
            <?php esc_html_e('See where your business stands across review platforms, then get a clear ethical plan to improve review monitoring, response quality, platform coverage, and customer trust signals.', 'reviewservicepro'); ?>
          </p>

          <div class="mb-7 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a
              href="<?php echo esc_url($audit_url); ?>"
              class="rsp-cta-btn inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 py-4 font-['Inter',sans-serif] text-[16px] font-extrabold text-white no-underline shadow-[0_18px_50px_rgba(37,99,235,0.28)] hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-200 sm:w-auto">
              <span class="relative z-10 inline-flex items-center gap-2">
                <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
                <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
              </span>
            </a>

            <a
              href="<?php echo esc_url($consult_url); ?>"
              class="rsp-cta-btn inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-7 py-4 font-['Inter',sans-serif] text-[16px] font-bold text-slate-700 no-underline hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 sm:w-auto">
              <span class="relative z-10 inline-flex items-center gap-2">
                <i data-lucide="messages-square" class="h-5 w-5" aria-hidden="true"></i>
                <?php esc_html_e('Talk to Specialist', 'reviewservicepro'); ?>
              </span>
            </a>
          </div>

          <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4" data-gsap-item="cta-trust">
            <?php foreach ($trust_items as $item) : ?>
              <div class="rsp-cta-trust-item flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 font-['Inter',sans-serif] text-[15px] font-bold text-slate-700 shadow-sm">
                <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-4 w-4 flex-shrink-0 text-emerald-600" aria-hidden="true"></i>
                <?php echo esc_html($item['text']); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Visual preview card -->
        <div class="rsp-cta-visual rounded-[2rem] bg-white p-[2px] shadow-[0_24px_80px_rgba(15,23,42,0.12)]">
          <div class="rsp-cta-visual-inner overflow-hidden rounded-[calc(2rem-2px)] border border-slate-200 bg-slate-50">
            <div class="flex items-center justify-between border-b border-slate-200 bg-white px-5 py-4">
              <div class="flex items-center gap-1.5" aria-hidden="true">
                <span class="h-2.5 w-2.5 rounded-full bg-[#ff5f57]"></span>
                <span class="h-2.5 w-2.5 rounded-full bg-[#ffbd2e]"></span>
                <span class="h-2.5 w-2.5 rounded-full bg-[#28c840]"></span>
              </div>

              <span class="font-['Inter',sans-serif] text-[11px] font-bold uppercase tracking-[0.12em] text-slate-500">
                <?php esc_html_e('Audit Preview', 'reviewservicepro'); ?>
              </span>
            </div>

            <div class="p-5">
              <div class="mb-4 rounded-2xl border border-slate-200 bg-white p-4">
                <div class="mb-3 flex items-center justify-between gap-4">
                  <div>
                    <p class="font-['Inter',sans-serif] text-[13px] font-bold uppercase tracking-[0.08em] text-slate-500">
                      <?php esc_html_e('Trust Signal Score', 'reviewservicepro'); ?>
                    </p>
                    <p class="mt-2 font-['Poppins',sans-serif] text-[34px] font-extrabold leading-none text-[#07111F]">
                      87<span class="text-[16px] text-slate-400">/100</span>
                    </p>
                  </div>

                  <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
                  </div>
                </div>

                <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                  <div class="rsp-cta-progress h-full rounded-full bg-gradient-to-r from-blue-600 via-[#00C853] to-[#14B8A6]"></div>
                </div>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                  <p class="font-['Inter',sans-serif] text-[13px] font-semibold text-slate-500">
                    <?php esc_html_e('Review gaps', 'reviewservicepro'); ?>
                  </p>
                  <p class="mt-2 font-['Poppins',sans-serif] text-[28px] font-extrabold leading-none text-red-500">
                    3
                  </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                  <p class="font-['Inter',sans-serif] text-[13px] font-semibold text-slate-500">
                    <?php esc_html_e('Platforms', 'reviewservicepro'); ?>
                  </p>
                  <p class="mt-2 font-['Poppins',sans-serif] text-[28px] font-extrabold leading-none text-blue-600">
                    10+
                  </p>
                </div>
              </div>

              <div class="mt-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                <div class="flex gap-3">
                  <span class="mt-1 h-2 w-2 flex-shrink-0 rounded-full bg-[#00C853]"></span>
                  <p class="rsp-cta-main-text font-['Inter',sans-serif] text-emerald-950">
                    <?php esc_html_e('Audit focuses on monitoring, documentation, response quality, and ethical improvement opportunities.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Process Cards -->
    <div class="mt-7 grid grid-cols-1 gap-5 md:grid-cols-3" data-gsap-item="cta-steps">
      <?php foreach ($steps as $step) : ?>
        <div class="rsp-cta-motion-card rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_14px_44px_rgba(15,23,42,0.06)]">
          <div class="relative z-10">
            <div class="mb-5 flex items-center justify-between">
              <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 font-['DM_Mono',monospace] text-[12px] font-bold text-slate-500">
                <?php echo esc_html($step['num']); ?>
              </span>

              <span class="rsp-cta-step-icon flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
                <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
              </span>
            </div>

            <h3 class="mb-3 font-['Poppins',sans-serif] text-[22px] font-extrabold tracking-[-0.03em] text-[#07111F]">
              <?php echo esc_html($step['title']); ?>
            </h3>

            <p class="rsp-cta-main-text font-['Inter',sans-serif] text-slate-600">
              <?php echo esc_html($step['desc']); ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="rsp-cta-main-text mt-7 text-center font-['Inter',sans-serif] text-slate-500">
      <?php esc_html_e('No pressure. No fake reviews. Just a clear path to stronger customer trust.', 'reviewservicepro'); ?>
    </p>

  </div>
</section>