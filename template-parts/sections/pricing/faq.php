<?php

/**
 * Pricing FAQ Section
 *
 * File: template-parts/sections/pricing/faq.php
 *
 * ReviewService.Pro — Pricing Page FAQ
 *
 * Purpose:
 * - Answer buyer objections.
 * - Improve SEO/AEO with pricing/package questions.
 * - Keep compliance-safe ORM messaging.
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

$faqs = [
  [
    'question' => __('Can I buy a one-time package without a monthly plan?', 'reviewservicepro'),
    'answer'   => __('Yes. The Pricing page is designed for one-time ORM packages, platform checks, add-ons, and small orderable reputation services. Monthly ORM plans are handled separately on the Services page.', 'reviewservicepro'),
  ],
  [
    'question' => __('What happens after checkout?', 'reviewservicepro'),
    'answer'   => __('After checkout, your WooCommerce order is created and your account/client portal access is available. You can review your order, invoice, and onboarding instructions, then submit the business and platform details needed for the service.', 'reviewservicepro'),
  ],
  [
    'question' => __('Do you remove negative reviews?', 'reviewservicepro'),
    'answer'   => __('We do not guarantee negative review removal. We can help review the situation, document possible policy issues, prepare professional response direction, and guide platform-compliant reporting when a review may violate platform rules.', 'reviewservicepro'),
  ],
  [
    'question' => __('Do these packages include fake reviews or paid reviews?', 'reviewservicepro'),
    'answer'   => __('No. ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed 5-star ratings, or misleading review generation tactics.', 'reviewservicepro'),
  ],
  [
    'question' => __('Can I choose only Google, Trustpilot, or Yelp?', 'reviewservicepro'),
    'answer'   => __('Yes. Platform-specific checks can be ordered for individual review platforms such as Google Business Profile, Trustpilot, Yelp, and other supported platforms when those products are available.', 'reviewservicepro'),
  ],
  [
    'question' => __('Can I upgrade to monthly ORM later?', 'reviewservicepro'),
    'answer'   => __('Yes. A one-time package is a practical first step. If you later need ongoing monitoring, response management, monthly reporting, and reputation support, you can move into a monthly ORM plan from the Services page.', 'reviewservicepro'),
  ],
  [
    'question' => __('Do you write review responses?', 'reviewservicepro'),
    'answer'   => __('Depending on the package, we may provide professional response drafts, response templates, tone guidance, or response strategy. All response work is written to be calm, brand-safe, and platform-compliant.', 'reviewservicepro'),
  ],
  [
    'question' => __('Which package should I start with?', 'reviewservicepro'),
    'answer'   => __('If you are unsure, start with a Reputation Audit Package. If your issue is mostly unanswered reviews, choose Review Response Setup. If you have one sensitive review situation, choose Negative Review Case Review. You can also request a recommendation before ordering.', 'reviewservicepro'),
  ],
];

$faq_schema_items = [];

foreach ($faqs as $faq) {
  $faq_schema_items[] = [
    '@type'          => 'Question',
    'name'           => wp_strip_all_tags($faq['question']),
    'acceptedAnswer' => [
      '@type' => 'Answer',
      'text'  => wp_strip_all_tags($faq['answer']),
    ],
  ];
}

$faq_schema = [
  '@context'   => 'https://schema.org',
  '@type'      => 'FAQPage',
  'mainEntity' => $faq_schema_items,
];
?>

<style>
  .rsp-pricing-faq-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-pricing-faq-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-pricing-faq-item {
    position: relative;
    overflow: hidden;
  }

  .rsp-pricing-faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 260ms ease;
  }

  .rsp-pricing-faq-item.is-open .rsp-pricing-faq-answer {
    max-height: 420px;
  }

  .rsp-pricing-faq-item.is-open .rsp-pricing-faq-icon {
    transform: rotate(45deg);
  }

  .rsp-pricing-faq-beam {
    animation: rspPricingFaqBeam 7s ease-in-out infinite;
  }

  @keyframes rspPricingFaqBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-pricing-faq-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-pricing-faq-answer {
      transition: none;
    }

    .rsp-pricing-faq-beam {
      animation: none;
    }
  }
</style>

<section
  id="pricing-faq"
  class="relative px-5 py-12 sm:px-6 lg:px-8 lg:py-16"
  aria-labelledby="pricing-faq-title">

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- Section Header -->
    <div
      class="rsp-pricing-faq-reveal mb-8 grid grid-cols-1 gap-5 lg:grid-cols-[0.9fr_1.1fr] lg:items-end"
      data-pricing-faq-reveal>

      <div>
        <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-medium uppercase tracking-[0.14em] text-blue-700">
          <i data-lucide="help-circle" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
          <?php esc_html_e('Pricing FAQ', 'reviewservicepro'); ?>
        </span>

        <h2
          id="pricing-faq-title"
          class="mt-4 text-3xl font-semibold leading-tight tracking-[-0.045em] text-[#020617] md:text-4xl">

          <?php esc_html_e('Questions before ordering a one-time reputation service?', 'reviewservicepro'); ?>
        </h2>
      </div>

      <p class="text-base font-normal leading-8 text-slate-700">
        <?php esc_html_e('These answers explain how one-time packages work, what happens after checkout, and how ReviewService.Pro keeps ORM work ethical and platform-compliant.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[0.72fr_0.28fr]">

      <!-- FAQ List -->
      <div
        class="rsp-pricing-faq-reveal relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white/92 p-4 shadow-[0_24px_90px_rgba(15,23,42,0.09)] backdrop-blur-xl md:p-5"
        data-pricing-faq-reveal>

        <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-slate-200" aria-hidden="true">
          <div class="rsp-pricing-faq-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
        </div>

        <div class="space-y-3">
          <?php foreach ($faqs as $index => $faq) : ?>
            <article
              class="rsp-pricing-faq-item rounded-[1.25rem] border border-slate-200 bg-slate-50/80 transition-all duration-200 hover:bg-white"
              data-pricing-faq-item>

              <button
                type="button"
                class="flex w-full items-start justify-between gap-4 p-4 text-left"
                aria-expanded="<?php echo 0 === $index ? 'true' : 'false'; ?>">

                <span class="text-base font-medium leading-7 text-[#020617] md:text-lg">
                  <?php echo esc_html($faq['question']); ?>
                </span>

                <span class="rsp-pricing-faq-icon mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-blue-600 transition-transform duration-200">
                  <i data-lucide="plus" class="h-4 w-4" aria-hidden="true"></i>
                </span>
              </button>

              <div class="rsp-pricing-faq-answer">
                <div class="px-4 pb-4">
                  <p class="text-base font-normal leading-8 text-slate-700">
                    <?php echo esc_html($faq['answer']); ?>
                  </p>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Side CTA -->
      <aside
        class="rsp-pricing-faq-reveal rounded-[2rem] border border-[#00C853]/20 bg-[#00C853]/[0.055] p-5 shadow-[0_18px_60px_rgba(15,23,42,0.065)]"
        data-pricing-faq-reveal>

        <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-[#00C853]/25 bg-white">
          <i data-lucide="message-square" class="h-6 w-6 text-[#00A344]" aria-hidden="true"></i>
        </div>

        <h3 class="mt-5 text-2xl font-semibold leading-tight tracking-[-0.04em] text-[#020617]">
          <?php esc_html_e('Still not sure what to order?', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-3 text-base font-normal leading-8 text-slate-700">
          <?php esc_html_e('Tell us your review platform, business type, and main reputation concern. We will guide you to the right package or tell you if a monthly ORM plan makes more sense.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-6 flex flex-col gap-3">
          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3 text-base font-medium text-white shadow-lg shadow-blue-600/25 transition-all duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-blue-600/35">

            <?php esc_html_e('Ask for Recommendation', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($services_page_url); ?>#monthly-plans"
            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-base font-medium text-[#020617] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#00C853]/25 hover:bg-[#00C853]/[0.055]">

            <?php esc_html_e('View Monthly Plans', 'reviewservicepro'); ?>
            <i data-lucide="calendar-check" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
          </a>
        </div>
      </aside>

    </div>

  </div>
</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
  (function() {
    function initPricingFAQ() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = document.querySelectorAll('[data-pricing-faq-reveal]');
      var faqItems = document.querySelectorAll('[data-pricing-faq-item]');

      function showItem(item) {
        if (!item || item.dataset.pricingFaqVisible === 'true') {
          return;
        }

        item.dataset.pricingFaqVisible = 'true';
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

        revealItems.forEach(function(item) {
          observer.observe(item);
        });
      } else {
        revealItems.forEach(showItem);
      }

      faqItems.forEach(function(item, index) {
        var button = item.querySelector('button');

        if (index === 0) {
          item.classList.add('is-open');
        }

        if (!button) {
          return;
        }

        button.addEventListener('click', function() {
          var isOpen = item.classList.contains('is-open');

          faqItems.forEach(function(otherItem) {
            var otherButton = otherItem.querySelector('button');
            otherItem.classList.remove('is-open');

            if (otherButton) {
              otherButton.setAttribute('aria-expanded', 'false');
            }
          });

          if (!isOpen) {
            item.classList.add('is-open');
            button.setAttribute('aria-expanded', 'true');
          }
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initPricingFAQ);
    } else {
      initPricingFAQ();
    }
  })();
</script>