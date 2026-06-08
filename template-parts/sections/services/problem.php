<?php

/**
 * Services Section: Reputation Problems
 *
 * File: template-parts/sections/services/problem.php
 *
 * ReviewService.Pro — Premium White SaaS Problem Section
 *
 * Purpose:
 * - Explain the hidden problems businesses face when online reputation is not monitored.
 * - Use full-width card images instead of icons.
 * - Keep copy compliance-safe.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$monthly_plans_url = '#monthly-plans';
$fix_this_url      = '#services-overview';

$problem_cards = [
  [
    'number'    => '01',
    'tone'      => 'red',
    'title'     => __('Negative Reviews Shape First Impressions', 'reviewservicepro'),
    'text'      => __('A few visible negative reviews can influence customer trust before people visit your website, call your business, or request a quote.', 'reviewservicepro'),
    'tag'       => __('Trust risk before contact', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/negative-reviews-first-impressions.webp',
    'image_alt' => __('Negative customer review affecting first impression of a business online', 'reviewservicepro'),
  ],
  [
    'number'    => '02',
    'tone'      => 'amber',
    'title'     => __('Low Rating Confidence Reduces Conversions', 'reviewservicepro'),
    'text'      => __('When average ratings look weak or inconsistent, potential customers may compare your business against competitors with stronger review profiles.', 'reviewservicepro'),
    'tag'       => __('Lower buyer confidence', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/low-rating-confidence.webp',
    'image_alt' => __('Low rating confidence reducing business conversions dashboard visual', 'reviewservicepro'),
  ],
  [
    'number'    => '03',
    'tone'      => 'blue',
    'title'     => __('Unanswered Reviews Make Businesses Look Inactive', 'reviewservicepro'),
    'text'      => __('Customers often notice whether a business responds professionally. Unanswered reviews can make your brand look careless or disconnected.', 'reviewservicepro'),
    'tag'       => __('Weak public communication', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/unanswered-reviews.webp',
    'image_alt' => __('Unanswered reviews making a business look inactive online', 'reviewservicepro'),
  ],
  [
    'number'    => '04',
    'tone'      => 'teal',
    'title'     => __('No Review Monitoring System Means Problems Grow Quietly', 'reviewservicepro'),
    'text'      => __('Reviews can appear across Google Business Profile, Facebook, Trustpilot, Yelp, Tripadvisor, BBB, and other platforms. Without monitoring, important feedback can be missed.', 'reviewservicepro'),
    'tag'       => __('Slow issue detection', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/no-review-monitoring-system.webp',
    'image_alt' => __('No review monitoring system causing reputation issues to grow quietly', 'reviewservicepro'),
  ],
  [
    'number'    => '05',
    'tone'      => 'purple',
    'title'     => __('Weak Response Process Can Increase Reputation Risk', 'reviewservicepro'),
    'text'      => __('A rushed or emotional response can create more damage. Professional review responses should be calm, brand-safe, and customer-focused.', 'reviewservicepro'),
    'tag'       => __('Response quality risk', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/weak-response-process.webp',
    'image_alt' => __('Weak review response process increasing online reputation risk', 'reviewservicepro'),
  ],
  [
    'number'    => '06',
    'tone'      => 'orange',
    'title'     => __('Poor Platform Visibility Creates Trust Gaps', 'reviewservicepro'),
    'text'      => __('Incomplete profiles, outdated details, weak review freshness, and inconsistent platform presence can reduce customer confidence.', 'reviewservicepro'),
    'tag'       => __('Weak platform signals', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/poor-platform-visibility.webp',
    'image_alt' => __('Poor review platform visibility creating customer trust gaps', 'reviewservicepro'),
  ],
  [
    'number'    => '07',
    'tone'      => 'emerald',
    'title'     => __('Happy Customers Often Stay Silent', 'reviewservicepro'),
    'text'      => __('Many satisfied customers do not leave feedback unless the business has a clear, ethical, and simple genuine feedback request workflow.', 'reviewservicepro'),
    'tag'       => __('Positive feedback stays hidden', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/happy-customers-stay-silent.webp',
    'image_alt' => __('Happy customers staying silent without an ethical feedback workflow', 'reviewservicepro'),
  ],
  [
    'number'    => '08',
    'tone'      => 'slate',
    'title'     => __('No Reporting Means No Clear Direction', 'reviewservicepro'),
    'text'      => __('Without monthly reputation reporting, businesses may not know which platforms need attention, which risks are growing, or what actions should happen next.', 'reviewservicepro'),
    'tag'       => __('No progress visibility', 'reviewservicepro'),
    'image'     => 'assets/images/services/problem/no-reporting-clear-direction.webp',
    'image_alt' => __('No reputation reporting causing unclear business direction', 'reviewservicepro'),
  ],
];

$tone_classes = [
  'red' => [
    'border'   => 'border-red-300',
    'line'     => 'from-red-500 via-red-400 to-transparent',
    'image'    => 'border-red-100 bg-red-50',
    'fallback' => 'from-red-50 via-white to-red-100 text-red-700',
    'tag'      => 'border-red-100 bg-red-50 text-red-700',
  ],
  'amber' => [
    'border'   => 'border-amber-300',
    'line'     => 'from-amber-500 via-amber-400 to-transparent',
    'image'    => 'border-amber-100 bg-amber-50',
    'fallback' => 'from-amber-50 via-white to-amber-100 text-amber-700',
    'tag'      => 'border-amber-100 bg-amber-50 text-amber-700',
  ],
  'blue' => [
    'border'   => 'border-blue-300',
    'line'     => 'from-blue-600 via-blue-400 to-transparent',
    'image'    => 'border-blue-100 bg-blue-50',
    'fallback' => 'from-blue-50 via-white to-blue-100 text-blue-700',
    'tag'      => 'border-blue-100 bg-blue-50 text-blue-700',
  ],
  'teal' => [
    'border'   => 'border-teal-300',
    'line'     => 'from-teal-500 via-teal-400 to-transparent',
    'image'    => 'border-teal-100 bg-teal-50',
    'fallback' => 'from-teal-50 via-white to-teal-100 text-teal-700',
    'tag'      => 'border-teal-100 bg-teal-50 text-teal-700',
  ],
  'purple' => [
    'border'   => 'border-violet-300',
    'line'     => 'from-violet-500 via-violet-400 to-transparent',
    'image'    => 'border-violet-100 bg-violet-50',
    'fallback' => 'from-violet-50 via-white to-violet-100 text-violet-700',
    'tag'      => 'border-violet-100 bg-violet-50 text-violet-700',
  ],
  'orange' => [
    'border'   => 'border-orange-300',
    'line'     => 'from-orange-500 via-orange-400 to-transparent',
    'image'    => 'border-orange-100 bg-orange-50',
    'fallback' => 'from-orange-50 via-white to-orange-100 text-orange-700',
    'tag'      => 'border-orange-100 bg-orange-50 text-orange-700',
  ],
  'emerald' => [
    'border'   => 'border-emerald-300',
    'line'     => 'from-emerald-500 via-emerald-400 to-transparent',
    'image'    => 'border-emerald-100 bg-emerald-50',
    'fallback' => 'from-emerald-50 via-white to-emerald-100 text-emerald-700',
    'tag'      => 'border-emerald-100 bg-emerald-50 text-emerald-700',
  ],
  'slate' => [
    'border'   => 'border-slate-300',
    'line'     => 'from-slate-500 via-slate-400 to-transparent',
    'image'    => 'border-slate-100 bg-slate-50',
    'fallback' => 'from-slate-50 via-white to-slate-100 text-slate-700',
    'tag'      => 'border-slate-100 bg-slate-50 text-slate-700',
  ],
];
?>

<style>
  #services-problem-section {
    --rsp-problem-title: #334155;
    --rsp-problem-heading: #3B4658;
    --rsp-problem-body: #64748B;
    --rsp-problem-blue: #2563EB;
    --rsp-problem-green: #00C853;
  }

  #services-problem-section .rsp-problem-eyebrow {
    font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
  }

  #services-problem-section .rsp-problem-title {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: clamp(34px, 4.6vw, 58px);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.055em;
    color: var(--rsp-problem-title);
  }

  #services-problem-section .rsp-problem-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-problem-heading);
  }

  #services-problem-section .rsp-problem-text {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.78;
    color: var(--rsp-problem-body);
  }

  #services-problem-section .rsp-problem-body {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.78;
    color: var(--rsp-problem-body);
  }

  #services-problem-section .rsp-problem-reveal {
    opacity: 0;
    transform: translateY(28px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
      box-shadow 320ms ease,
      border-color 320ms ease;
  }

  #services-problem-section .rsp-problem-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  #services-problem-section .rsp-problem-motion-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 360ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 360ms ease,
      border-color 280ms ease,
      background-color 280ms ease;
  }

  #services-problem-section .rsp-problem-motion-card::before {
    content: "";
    position: absolute;
    inset: -80%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.08),
        rgba(0, 200, 83, 0.26),
        rgba(20, 184, 166, 0.20),
        rgba(139, 92, 246, 0.20),
        rgba(37, 99, 235, 0.08));
    opacity: 0.72;
    transform: rotate(0deg);
    animation: rspServicesProblemBorderSpin 8s linear infinite;
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  #services-problem-section .rsp-problem-motion-card::after {
    content: "";
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: #ffffff;
    pointer-events: none;
  }

  #services-problem-section .rsp-problem-motion-card:hover {
    transform: translateY(-8px);
    border-color: rgba(37, 99, 235, 0.22);
    box-shadow: 0 26px 80px rgba(15, 23, 42, 0.12);
  }

  #services-problem-section .rsp-problem-motion-card:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  #services-problem-section .rsp-problem-card-image {
    width: 100%;
    aspect-ratio: 16 / 10;
    border-radius: 1.15rem;
    transition:
      transform 520ms cubic-bezier(0.2, 0.9, 0.2, 1),
      filter 320ms ease,
      box-shadow 320ms ease;
  }

  #services-problem-section .rsp-problem-card-image img {
    display: block;
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 680ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #services-problem-section .rsp-problem-motion-card:hover .rsp-problem-card-image {
    transform: translateY(-3px) scale(1.015);
    filter: saturate(1.06);
    box-shadow: 0 18px 42px rgba(15, 23, 42, 0.10);
  }

  #services-problem-section .rsp-problem-motion-card:hover .rsp-problem-card-image img {
    transform: scale(1.08);
  }

  #services-problem-section .rsp-problem-fallback {
    display: flex;
    height: 100%;
    width: 100%;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  #services-problem-section .rsp-problem-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #services-problem-section .rsp-problem-btn::before {
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

  #services-problem-section .rsp-problem-btn:hover {
    transform: translateY(-3px);
  }

  #services-problem-section .rsp-problem-btn:hover::before {
    left: 135%;
  }

  @keyframes rspServicesProblemBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @media (max-width: 1024px) {
    #services-problem-section .rsp-problem-card-image {
      aspect-ratio: 16 / 9;
    }
  }

  @media (max-width: 640px) {
    #services-problem-section .rsp-problem-card-image {
      aspect-ratio: 16 / 9;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #services-problem-section *,
    #services-problem-section *::before,
    #services-problem-section *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      scroll-behavior: auto !important;
      transition-duration: 0.001ms !important;
    }

    #services-problem-section .rsp-problem-reveal {
      opacity: 1;
      transform: none;
    }

    #services-problem-section .rsp-problem-motion-card:hover,
    #services-problem-section .rsp-problem-btn:hover,
    #services-problem-section .rsp-problem-motion-card:hover .rsp-problem-card-image {
      transform: none;
    }

    #services-problem-section .rsp-problem-motion-card:hover .rsp-problem-card-image img {
      transform: none;
    }
  }
</style>

<section
  id="services-problem-section"
  class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="services-problem-title"
  data-rsp-services-problem-section>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/40 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="rsp-problem-reveal mx-auto max-w-4xl text-center" data-rsp-services-problem-reveal>
      <span class="rsp-problem-eyebrow inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700 shadow-sm">
        <i data-lucide="info" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Why Reputation Problems Grow', 'reviewservicepro'); ?>
      </span>

      <h2
        id="services-problem-title"
        class="rsp-problem-title mx-auto mt-6 max-w-4xl">
        <?php esc_html_e('8 silent ways your reputation loses ground every day', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-problem-text mx-auto mt-5 max-w-2xl">
        <?php esc_html_e('Each issue compounds. Left unmanaged, weak review monitoring, poor response quality, and unclear reporting can quietly reduce the trust customers need before they contact you.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
      <?php foreach ($problem_cards as $index => $card) : ?>
        <?php
        $tone       = $tone_classes[$card['tone']] ?? $tone_classes['blue'];
        $image_path = get_theme_file_path($card['image']);
        $image_url  = get_theme_file_uri($card['image']);
        $has_image  = file_exists($image_path);
        ?>

        <article
          class="rsp-problem-motion-card rsp-problem-reveal rounded-[1.75rem] border <?php echo esc_attr($tone['border']); ?> bg-white p-4 shadow-[0_16px_48px_rgba(15,23,42,0.07)]"
          data-rsp-services-problem-reveal
          style="transition-delay: <?php echo esc_attr((string) min($index * 70, 420)); ?>ms;">

          <div class="absolute inset-x-0 top-0 h-[3px] rounded-t-[1.75rem] bg-gradient-to-r <?php echo esc_attr($tone['line']); ?>" aria-hidden="true"></div>

          <div class="relative z-10">
            <div class="rsp-problem-card-image mb-5 overflow-hidden border <?php echo esc_attr($tone['image']); ?>">
              <?php if ($has_image) : ?>
                <img
                  src="<?php echo esc_url($image_url); ?>"
                  alt="<?php echo esc_attr($card['image_alt']); ?>"
                  loading="lazy"
                  decoding="async"
                  width="800"
                  height="520">
              <?php else : ?>
                <span class="rsp-problem-fallback bg-gradient-to-br <?php echo esc_attr($tone['fallback']); ?> px-4 font-['DM_Mono',monospace] text-[13px] font-[800] uppercase tracking-[0.12em]">
                  <?php echo esc_html($card['number']); ?>
                </span>
              <?php endif; ?>
            </div>

            <div class="mb-4 flex items-center justify-between gap-4">
              <span class="font-['DM_Mono',monospace] text-[12px] font-[800] uppercase tracking-[0.16em] text-slate-300">
                <?php echo esc_html($card['number']); ?>
              </span>
            </div>

            <h3 class="rsp-problem-heading text-[21px] font-[800] leading-[1.18] tracking-[-0.035em]">
              <?php echo esc_html($card['title']); ?>
            </h3>

            <p class="rsp-problem-body mt-4">
              <?php echo esc_html($card['text']); ?>
            </p>

            <div class="mt-5">
              <span class="<?php echo esc_attr($tone['tag']); ?> inline-flex items-center rounded-full border px-3 py-1.5 font-['Inter',sans-serif] text-[12px] font-[800]">
                <?php echo esc_html($card['tag']); ?>
              </span>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="rsp-problem-reveal mx-auto mt-12 flex max-w-4xl flex-col items-center justify-between gap-5 rounded-[1.75rem] border border-slate-200 bg-white/90 p-6 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)] backdrop-blur-xl md:flex-row md:text-left" data-rsp-services-problem-reveal>
      <div>
        <h3 class="rsp-problem-heading text-[24px] font-[800] leading-tight tracking-[-0.04em]">
          <?php esc_html_e('These issues are fixable with a structured ORM system.', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-problem-text mt-2">
          <?php esc_html_e('Start with monitoring, professional responses, ethical feedback workflows, and clear monthly reporting.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="flex flex-col gap-3 sm:flex-row">
        <a
          href="<?php echo esc_url($monthly_plans_url); ?>"
          class="rsp-problem-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,.24)] hover:bg-blue-700 hover:text-white">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('See Monthly Plans', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </span>
        </a>

        <a
          href="<?php echo esc_url($fix_this_url); ?>"
          class="rsp-problem-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('How We Fix This', 'reviewservicepro'); ?>
            <i data-lucide="search-check" class="h-4 w-4" aria-hidden="true"></i>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspServicesProblemSection() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var section = document.querySelector('[data-rsp-services-problem-section]');

      if (!section) {
        return;
      }

      var items = section.querySelectorAll('[data-rsp-services-problem-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspProblemVisible === 'true') {
          return;
        }

        item.dataset.rspProblemVisible = 'true';
        item.classList.add('rsp-visible');
      }

      if ('IntersectionObserver' in window) {
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
      document.addEventListener('DOMContentLoaded', initRspServicesProblemSection);
    } else {
      initRspServicesProblemSection();
    }
  })();
</script>