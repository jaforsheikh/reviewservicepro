<?php

/**
 * Services Page FAQ Section
 *
 * File: template-parts/sections/services/faq.php
 *
 * ReviewService.Pro — Online Reputation Management FAQ
 *
 * Physics Role:
 * - Objection Handling
 * - Trust Friction Reduction
 * - Final Decision Support
 *
 * Purpose:
 * Answer the most important buyer questions before the final CTA:
 * negative review removal, monthly plans, supported platforms, checkout,
 * one-time packages, compliance, and client portal workflow.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$faqs = [
  [
    'icon'     => 'shield-alert',
    'question' => __('Do you remove negative reviews?', 'reviewservicepro'),
    'answer'   => __('We do not guarantee negative review removal. We help identify reviews that may violate platform policies, document the issue, prepare professional response direction, and guide platform reporting when appropriate.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'monitor',
    'question' => __('Which review platforms do you monitor?', 'reviewservicepro'),
    'answer'   => __('We can support major review platforms including Google Business Profile, Google Maps, Facebook Reviews, Trustpilot, Yelp, Tripadvisor, BBB, G2, Capterra, Sitejabber, Reviews.io, Clutch, Glassdoor, Houzz, HomeAdvisor, Yellow Pages, Bark, Checkatrade, Trustindex, Birdeye, Reputation.com, ConsumerAffairs, Angi, Zillow, ProductReview, and more depending on your business type.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'list-checks',
    'question' => __('Can I choose only 2 or 3 platforms?', 'reviewservicepro'),
    'answer'   => __('Yes. Every business does not need every platform. We select the most relevant platforms based on your industry, customer journey, reputation goals, and selected monthly plan.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'calendar-check',
    'question' => __('Do you offer monthly reputation management subscriptions?', 'reviewservicepro'),
    'answer'   => __('Yes. Monthly ORM plans are designed for ongoing review monitoring, response support, negative review case tracking, reporting, and client portal access. Basic, Growth, and Premium plans are structured around platform count and response support level.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'package-check',
    'question' => __('Can I start with a one-time package first?', 'reviewservicepro'),
    'answer'   => __('Yes. You can start with a Reputation Audit Package, Review Response Setup Package, Review Request System Setup, or Negative Review Case Review before moving into monthly management.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'credit-card',
    'question' => __('What happens after payment?', 'reviewservicepro'),
    'answer'   => __('After checkout, your order is created and you get access to the client portal. We collect your business name, website URL, platform links, reputation concerns, response tone preferences, and onboarding information before starting the service workflow.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'lock',
    'question' => __('What is included in the client portal?', 'reviewservicepro'),
    'answer'   => __('The client portal can show active plan details, selected platforms, response usage, monthly reports, negative review cases, client actions required, support access, orders, invoices, and account details. Advanced messaging, file upload, report upload, and case workflow should be added later through a custom plugin.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'badge-check',
    'question' => __('Is your ORM process platform-compliant?', 'reviewservicepro'),
    'answer'   => __('Our approach focuses on ethical review monitoring, professional responses, genuine customer feedback requests, documentation, transparent reporting, and platform-compliant practices. We do not offer fake reviews, paid review incentives, rating manipulation, or guaranteed removal claims.', 'reviewservicepro'),
  ],
  [
    'icon'     => 'trending-up',
    'question' => __('Do you guarantee better ratings or local rankings?', 'reviewservicepro'),
    'answer'   => __('No. We do not guarantee ratings, review volume, platform decisions, customer behavior, or local ranking outcomes. We help improve controllable reputation signals such as response quality, review freshness, profile completeness, platform consistency, and transparent reporting.', 'reviewservicepro'),
  ],
];

$quick_answers = [
  [
    'icon'  => 'shield-check',
    'title' => __('Ethical only', 'reviewservicepro'),
    'text'  => __('No fake reviews, no paid review incentives, and no rating manipulation.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'radar',
    'title' => __('Ongoing monitoring', 'reviewservicepro'),
    'text'  => __('Monthly plans support selected review platforms based on your business needs.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'file-text',
    'title' => __('Clear reporting', 'reviewservicepro'),
    'text'  => __('Reports show response work, platform activity, risks, and next actions.', 'reviewservicepro'),
  ],
];

$cta_url = '#monthly-plans';
?>

<section
  id="orm-faq"
  class="relative overflow-hidden border-b border-slate-200 bg-slate-50 py-20 md:py-28"
  aria-labelledby="orm-faq-title"
  data-gsap="services-faq">

  <!-- Background Pattern -->
  <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(37,99,235,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.045)_1px,transparent_1px)] bg-[size:56px_56px]"></div>
  <div class="pointer-events-none absolute -left-24 top-16 h-[440px] w-[560px] rounded-full bg-blue-200/50 blur-[130px]"></div>
  <div class="pointer-events-none absolute -right-24 bottom-0 h-[440px] w-[560px] rounded-full bg-emerald-200/50 blur-[130px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Heading + Quick Answer Cards -->
    <div class="mb-14 grid grid-cols-1 gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-end">

      <div data-gsap-item="faq-heading">
        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 text-xs font-extrabold uppercase tracking-[0.14em] text-blue-700 shadow-sm">
          <i data-lucide="help-circle" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('FAQ', 'reviewservicepro'); ?>
        </span>

        <h2
          id="orm-faq-title"
          class="max-w-4xl text-3xl font-extrabold leading-tight tracking-tight text-slate-950 md:text-4xl lg:text-5xl">
          <?php esc_html_e('Questions businesses ask before starting ORM.', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-600">
          <?php esc_html_e('Online reputation management can feel confusing because it involves reviews, platforms, responses, customer feedback, and compliance. These answers clarify what we do, what we avoid, and what happens after checkout.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-3" data-gsap-item="faq-quick-cards">
        <?php foreach ($quick_answers as $answer) : ?>
          <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
              <i data-lucide="<?php echo esc_attr($answer['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <h3 class="text-lg font-extrabold text-slate-950">
              <?php echo esc_html($answer['title']); ?>
            </h3>

            <p class="mt-2 text-base leading-8 text-slate-600">
              <?php echo esc_html($answer['text']); ?>
            </p>
          </article>
        <?php endforeach; ?>
      </div>

    </div>

    <!-- FAQ Layout -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1fr_380px] lg:items-start">

      <!-- FAQ Accordions -->
      <div class="space-y-4" data-gsap-item="faq-accordion-list">
        <?php foreach ($faqs as $index => $faq) : ?>
          <details
            class="group overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm transition-all duration-300 open:border-blue-200 open:shadow-xl open:shadow-blue-900/5"
            <?php echo 0 === $index ? 'open' : ''; ?>>

            <summary class="flex cursor-pointer list-none items-start justify-between gap-5 p-5 md:p-6">
              <span class="flex gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
                  <i data-lucide="<?php echo esc_attr($faq['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
                </span>

                <span>
                  <span class="block text-xl font-extrabold leading-snug text-slate-950">
                    <?php echo esc_html($faq['question']); ?>
                  </span>
                </span>
              </span>

              <span class="mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-500 transition-all duration-300 group-open:rotate-45 group-open:border-blue-200 group-open:bg-blue-50 group-open:text-blue-600">
                <i data-lucide="plus" class="h-5 w-5" aria-hidden="true"></i>
              </span>
            </summary>

            <div class="border-t border-slate-200 px-5 pb-5 pt-5 md:px-6 md:pb-6">
              <p class="text-base leading-8 text-slate-600">
                <?php echo esc_html($faq['answer']); ?>
              </p>
            </div>
          </details>
        <?php endforeach; ?>
      </div>

      <!-- Sidebar CTA / Support Panel -->
      <aside class="lg:sticky lg:top-24" data-gsap-item="faq-sidebar">
        <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">

          <div class="border-b border-slate-200 bg-gradient-to-br from-blue-50 via-white to-emerald-50 p-6">
            <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/20">
              <i data-lucide="message-square" class="h-6 w-6" aria-hidden="true"></i>
            </div>

            <h3 class="text-2xl font-extrabold leading-tight text-slate-950">
              <?php esc_html_e('Still unsure which ORM plan fits your business?', 'reviewservicepro'); ?>
            </h3>

            <p class="mt-3 text-base leading-8 text-slate-600">
              <?php esc_html_e('Start with the plan section or request a custom quote if your business has multiple platforms, multiple locations, or a sensitive reputation situation.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="p-6">
            <div class="space-y-4">
              <a
                href="<?php echo esc_url($cta_url); ?>"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-4 text-sm font-extrabold text-white shadow-lg shadow-blue-600/20 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                <?php esc_html_e('Compare Monthly Plans', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
              </a>

              <a
                href="<?php echo esc_url(home_url('/contact/?type=orm-question')); ?>"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-6 py-4 text-sm font-extrabold text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
                <?php esc_html_e('Ask a Question', 'reviewservicepro'); ?>
                <i data-lucide="help-circle" class="h-5 w-5" aria-hidden="true"></i>
              </a>
            </div>

            <div class="mt-6 rounded-[1.5rem] border border-emerald-200 bg-emerald-50 p-5">
              <div class="mb-3 flex items-center gap-2 text-base font-extrabold text-emerald-800">
                <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
                <?php esc_html_e('Compliance reminder', 'reviewservicepro'); ?>
              </div>

              <p class="text-base leading-8 text-emerald-900">
                <?php esc_html_e('We work with ethical ORM methods only: monitoring, response support, documentation, genuine feedback workflows, reporting, and platform-safe guidance.', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>

        </div>
      </aside>

    </div>

    <!-- FAQ Schema JSON-LD -->
    <?php
    $schema_entities = [];

    foreach ($faqs as $faq) {
      $schema_entities[] = [
        '@type' => 'Question',
        'name'  => wp_strip_all_tags($faq['question']),
        'acceptedAnswer' => [
          '@type' => 'Answer',
          'text'  => wp_strip_all_tags($faq['answer']),
        ],
      ];
    }

    $faq_schema = [
      '@context'   => 'https://schema.org',
      '@type'      => 'FAQPage',
      'mainEntity' => $schema_entities,
    ];
    ?>

    <script type="application/ld+json">
      <?php echo wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>

  </div>
</section>