<?php

/**
 * Services Page One-Time ORM Packages Section
 *
 * File: template-parts/sections/services/one-time-packages.php
 *
 * ReviewService.Pro — 3 Focused One-Time ORM Packages
 *
 * Purpose:
 * - Keep services page simple and conversion-focused
 * - Show only 3 high-intent one-time packages
 * - Move advanced add-ons / detailed pricing to separate Pricing page later
 *
 * Package Strategy:
 * 1. AI-Driven Reputation Audit Package
 * 2. Review Response Setup Package
 * 3. Negative Review Case Review Package
 *
 * Stack:
 * - WordPress PHP
 * - WooCommerce checkout links
 * - Tailwind CSS
 * - Lucide Icons
 * - Poppins headings, body font inherited
 *
 * Compliance:
 * - No fake reviews
 * - No paid/incentivized reviews
 * - No guaranteed 5-star ratings
 * - No guaranteed review removal
 * - No guaranteed ranking outcomes
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * WooCommerce Product IDs
 *
 * Later, after creating WooCommerce simple virtual products,
 * add product IDs through Customizer/theme mods or replace with fixed IDs.
 *
 * Direct checkout example:
 * /checkout/?add-to-cart=123
 */
$audit_product_id         = absint(get_theme_mod('rsp_reputation_audit_package_product_id', 0));
$response_setup_product_id = absint(get_theme_mod('rsp_response_setup_package_product_id', 0));
$negative_case_product_id = absint(get_theme_mod('rsp_negative_case_package_product_id', 0));

/**
 * Pricing values.
 *
 * These can be changed later through Customizer/theme mods.
 */
$audit_price         = get_theme_mod('rsp_reputation_audit_package_price', '$149');
$response_price      = get_theme_mod('rsp_response_setup_package_price', '$197');
$negative_case_price = get_theme_mod('rsp_negative_case_package_price', '$199');

/**
 * Checkout URL helper.
 */
$checkout_url = function ($product_id, $fallback_type = 'one-time-orm-package') {
  if ($product_id > 0 && function_exists('wc_get_checkout_url')) {
    return add_query_arg(
      [
        'add-to-cart' => $product_id,
      ],
      wc_get_checkout_url()
    );
  }

  return add_query_arg(
    [
      'type' => rawurlencode($fallback_type),
    ],
    home_url('/contact/')
  );
};

$pricing_page_url = home_url('/pricing/');
$contact_url      = home_url('/contact/?type=orm-package-help');
$monthly_plan_url = '#monthly-plans';

$packages = [
  [
    'number'       => '01',
    'icon'         => 'search-check',
    'badge'        => __('Best First Step', 'reviewservicepro'),
    'title'        => __('AI-Driven Reputation Audit Package', 'reviewservicepro'),
    'hook'         => __('Know exactly where your online reputation needs attention.', 'reviewservicepro'),
    'description'  => __('A focused reputation audit that reviews your rating profile, review visibility, response gaps, negative review risks, platform quality, and priority trust signals across selected review platforms.', 'reviewservicepro'),
    'price'        => $audit_price,
    'timeline'     => __('3–5 business days', 'reviewservicepro'),
    'platforms'    => __('Up to 3 priority platforms', 'reviewservicepro'),
    'best_for'     => __('Businesses that want clear direction before choosing monthly reputation management.', 'reviewservicepro'),
    'outcome'      => __('You get a clear reputation roadmap before committing to ongoing ORM.', 'reviewservicepro'),
    'product_id'   => $audit_product_id,
    'fallback'     => 'ai-driven-reputation-audit',
    'cta'          => __('Buy Reputation Audit', 'reviewservicepro'),
    'tone'         => 'blue',
    'featured'     => false,
    'deliverables' => [
      __('Review profile health check', 'reviewservicepro'),
      __('Response quality audit', 'reviewservicepro'),
      __('Negative review risk notes', 'reviewservicepro'),
      __('Platform visibility review', 'reviewservicepro'),
      __('Google / Facebook / Trustpilot / Yelp snapshot where relevant', 'reviewservicepro'),
      __('Priority action roadmap', 'reviewservicepro'),
    ],
    'not_included' => [
      __('Ongoing monthly review monitoring', 'reviewservicepro'),
      __('Unlimited response writing', 'reviewservicepro'),
      __('Guaranteed review removal', 'reviewservicepro'),
    ],
    'upgrade'      => __('Audit fee may be credited toward your first monthly ORM plan if you upgrade within 7 days.', 'reviewservicepro'),
  ],
  [
    'number'       => '02',
    'icon'         => 'message-square',
    'badge'        => __('Practical Quick Win', 'reviewservicepro'),
    'title'        => __('Review Response Setup Package', 'reviewservicepro'),
    'hook'         => __('Build a professional review response system before unanswered reviews create more risk.', 'reviewservicepro'),
    'description'  => __('A response setup package that gives your business clear, brand-safe review response frameworks for positive, neutral, and negative customer reviews.', 'reviewservicepro'),
    'price'        => $response_price,
    'timeline'     => __('3–7 business days', 'reviewservicepro'),
    'platforms'    => __('Works for major review platforms', 'reviewservicepro'),
    'best_for'     => __('Businesses with unanswered reviews, inconsistent response tone, or no professional reply system.', 'reviewservicepro'),
    'outcome'      => __('You get a response framework that helps your business communicate calmly and professionally.', 'reviewservicepro'),
    'product_id'   => $response_setup_product_id,
    'fallback'     => 'review-response-setup',
    'cta'          => __('Buy Response Setup', 'reviewservicepro'),
    'tone'         => 'emerald',
    'featured'     => true,
    'deliverables' => [
      __('Brand response tone guide', 'reviewservicepro'),
      __('Positive review response templates', 'reviewservicepro'),
      __('Neutral review response templates', 'reviewservicepro'),
      __('Negative review response framework', 'reviewservicepro'),
      __('Escalation response guidance', 'reviewservicepro'),
      __('Custom sample response drafts', 'reviewservicepro'),
    ],
    'not_included' => [
      __('Posting responses on your behalf unless agreed separately', 'reviewservicepro'),
      __('Legal advice or legal dispute handling', 'reviewservicepro'),
      __('Guaranteed customer sentiment change', 'reviewservicepro'),
    ],
    'upgrade'      => __('Upgrade later to monthly review response management for ongoing monitoring and response support.', 'reviewservicepro'),
  ],
  [
    'number'       => '03',
    'icon'         => 'shield-alert',
    'badge'        => __('Urgent Case Support', 'reviewservicepro'),
    'title'        => __('Negative Review Case Review Package', 'reviewservicepro'),
    'hook'         => __('Handle a sensitive negative review with calm, compliant direction.', 'reviewservicepro'),
    'description'  => __('A focused review of one negative review case with issue analysis, documentation guidance, response direction, and platform reporting notes when appropriate.', 'reviewservicepro'),
    'price'        => $negative_case_price,
    'timeline'     => __('2–5 business days', 'reviewservicepro'),
    'platforms'    => __('One priority negative review case', 'reviewservicepro'),
    'best_for'     => __('Businesses dealing with one urgent, unfair, confusing, or sensitive negative review situation.', 'reviewservicepro'),
    'outcome'      => __('You get safe next-step direction instead of reacting emotionally or making the issue worse.', 'reviewservicepro'),
    'product_id'   => $negative_case_product_id,
    'fallback'     => 'negative-review-case-review',
    'cta'          => __('Review My Negative Case', 'reviewservicepro'),
    'tone'         => 'amber',
    'featured'     => false,
    'deliverables' => [
      __('Review issue analysis', 'reviewservicepro'),
      __('Platform policy concern check', 'reviewservicepro'),
      __('Documentation checklist', 'reviewservicepro'),
      __('Professional public response direction', 'reviewservicepro'),
      __('Platform report guidance when appropriate', 'reviewservicepro'),
      __('Safe next-step recommendation', 'reviewservicepro'),
    ],
    'not_included' => [
      __('Guaranteed negative review removal', 'reviewservicepro'),
      __('Legal action or legal advice', 'reviewservicepro'),
      __('Fake reporting or policy abuse', 'reviewservicepro'),
    ],
    'upgrade'      => __('Upgrade to monthly ORM if you need ongoing negative review case tracking and response support.', 'reviewservicepro'),
  ],
];

$trust_points = [
  [
    'icon' => 'shield-check',
    'text' => __('No fake reviews', 'reviewservicepro'),
  ],
  [
    'icon' => 'ban',
    'text' => __('No paid incentives', 'reviewservicepro'),
  ],
  [
    'icon' => 'badge-check',
    'text' => __('Platform-compliant methods', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock',
    'text' => __('Secure checkout and onboarding', 'reviewservicepro'),
  ],
];

$micro_faqs = [
  [
    'question' => __('Can I buy a one-time package without a monthly plan?', 'reviewservicepro'),
    'answer'   => __('Yes. These packages are designed as a low-risk first step before monthly reputation management.', 'reviewservicepro'),
  ],
  [
    'question' => __('What happens after checkout?', 'reviewservicepro'),
    'answer'   => __('Your order is created, then we collect your business details, platform links, review concerns, and onboarding information.', 'reviewservicepro'),
  ],
  [
    'question' => __('Do you remove negative reviews?', 'reviewservicepro'),
    'answer'   => __('We do not guarantee removal. We help identify, document, respond to, and report reviews that may violate platform policies when appropriate.', 'reviewservicepro'),
  ],
];

$tone_classes = [
  'blue' => [
    'card_top'     => 'border-t-[#1E3A8A]',
    'badge'        => 'border-blue-200 bg-blue-50 text-blue-700',
    'icon'         => 'border-blue-200 bg-blue-50 text-blue-700',
    'button'       => 'bg-[#1E3A8A] hover:bg-blue-800 text-white shadow-blue-900/20',
    'soft'         => 'bg-blue-50 text-blue-800 border-blue-200',
    'glow'         => 'bg-blue-300/20',
    'highlight'    => 'text-blue-700',
  ],
  'emerald' => [
    'card_top'     => 'border-t-[#00C853]',
    'badge'        => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'icon'         => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'button'       => 'bg-[#00C853] hover:bg-emerald-600 text-white shadow-emerald-900/20',
    'soft'         => 'bg-emerald-50 text-emerald-800 border-emerald-200',
    'glow'         => 'bg-emerald-300/20',
    'highlight'    => 'text-emerald-700',
  ],
  'amber' => [
    'card_top'     => 'border-t-[#FFC107]',
    'badge'        => 'border-amber-200 bg-amber-50 text-amber-700',
    'icon'         => 'border-amber-200 bg-amber-50 text-amber-700',
    'button'       => 'bg-[#FFC107] hover:bg-amber-500 text-slate-950 shadow-amber-900/20',
    'soft'         => 'bg-amber-50 text-amber-800 border-amber-200',
    'glow'         => 'bg-amber-300/20',
    'highlight'    => 'text-amber-700',
  ],
];
?>

<style>
  .rsp-one-time-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition: opacity 650ms ease, transform 650ms ease, box-shadow 280ms ease, border-color 280ms ease;
  }

  .rsp-one-time-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-one-time-card:nth-child(1) {
    transition-delay: 0ms;
  }

  .rsp-one-time-card:nth-child(2) {
    transition-delay: 100ms;
  }

  .rsp-one-time-card:nth-child(3) {
    transition-delay: 200ms;
  }

  @media (prefers-reduced-motion: reduce) {
    .rsp-one-time-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }
  }
</style>

<section
  id="one-time-packages"
  class="relative overflow-hidden border-b border-slate-200 bg-white py-20 md:py-28"
  aria-labelledby="one-time-packages-title"
  data-rsp-one-time-section>

  <!-- Background -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle,rgba(30,58,138,0.06)_1px,transparent_1px)] bg-[size:30px_30px]"></div>
  <div class="pointer-events-none absolute -left-28 -top-28 z-0 h-[440px] w-[440px] rounded-full bg-blue-200/45 blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-28 bottom-0 z-0 h-[440px] w-[520px] rounded-full bg-emerald-200/50 blur-[120px]"></div>
  <div class="pointer-events-none absolute right-[12%] top-[38%] z-0 h-[260px] w-[260px] rounded-full bg-amber-200/30 blur-[110px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Section Heading -->
    <div class="rsp-one-time-reveal mx-auto max-w-4xl text-center" data-rsp-one-time-animate>
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.14em] text-amber-700 shadow-sm">
        <i data-lucide="package-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('One-Time ORM Packages', 'reviewservicepro'); ?>
      </span>

      <h2
        id="one-time-packages-title"
        class="font-['Poppins'] text-3xl font-extrabold leading-tight tracking-[-0.03em] text-slate-950 md:text-4xl lg:text-5xl">
        <?php esc_html_e('Start with a focused reputation package before monthly management.', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-5 max-w-3xl text-base leading-8 text-slate-600">
        <?php esc_html_e('Not ready for a monthly ORM plan yet? Choose a focused one-time package to audit your reputation, improve your review response system, or handle a sensitive negative review case with ethical, platform-compliant guidance.', 'reviewservicepro'); ?>
      </p>

      <!-- Trust Points -->
      <div class="mt-8 flex flex-wrap justify-center gap-3">
        <?php foreach ($trust_points as $point) : ?>
          <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-600 shadow-sm">
            <i data-lucide="<?php echo esc_attr($point['icon']); ?>" class="h-4 w-4 text-emerald-600" aria-hidden="true"></i>
            <?php echo esc_html($point['text']); ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Package Cards -->
    <div class="mt-14 grid grid-cols-1 gap-6 lg:grid-cols-3">
      <?php foreach ($packages as $package) : ?>
        <?php
        $tone = $tone_classes[$package['tone']] ?? $tone_classes['blue'];
        $package_link = $checkout_url($package['product_id'], $package['fallback']);
        ?>

        <article
          class="rsp-one-time-reveal rsp-one-time-card <?php echo esc_attr($tone['card_top']); ?> group relative flex h-full flex-col overflow-hidden rounded-[2rem] border border-t-[4px] border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-slate-300 hover:shadow-2xl hover:shadow-slate-900/10 <?php echo ! empty($package['featured']) ? 'lg:-translate-y-4 lg:shadow-xl lg:shadow-emerald-900/10' : ''; ?>"
          data-rsp-one-time-animate>

          <!-- Glow -->
          <div class="<?php echo esc_attr($tone['glow']); ?> pointer-events-none absolute -right-16 -top-16 h-52 w-52 rounded-full opacity-0 blur-3xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <!-- Featured Badge -->
          <?php if (! empty($package['featured'])) : ?>
            <div class="absolute right-5 top-5 z-10">
              <span class="inline-flex rounded-full bg-[#00C853] px-3 py-1 text-xs font-extrabold uppercase tracking-[0.10em] text-white shadow-lg shadow-emerald-900/20">
                <?php esc_html_e('Most Practical', 'reviewservicepro'); ?>
              </span>
            </div>
          <?php endif; ?>

          <!-- Top -->
          <div class="relative z-10">
            <span class="<?php echo esc_attr($tone['badge']); ?> mb-5 inline-flex rounded-full border px-3 py-1 text-xs font-extrabold uppercase tracking-[0.10em]">
              <?php echo esc_html($package['badge']); ?>
            </span>

            <div class="mb-5 flex items-start justify-between gap-4">
              <div class="<?php echo esc_attr($tone['icon']); ?> flex h-14 w-14 items-center justify-center rounded-2xl border transition-all duration-300 group-hover:scale-105 group-hover:-rotate-3">
                <i data-lucide="<?php echo esc_attr($package['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
              </div>

              <span class="font-mono text-xs font-bold text-slate-300">
                <?php echo esc_html($package['number']); ?>
              </span>
            </div>

            <h3 class="font-['Poppins'] text-2xl font-extrabold leading-tight tracking-[-0.02em] text-slate-950">
              <?php echo esc_html($package['title']); ?>
            </h3>

            <p class="<?php echo esc_attr($tone['highlight']); ?> mt-3 text-base font-extrabold leading-7">
              <?php echo esc_html($package['hook']); ?>
            </p>

            <p class="mt-3 text-base leading-8 text-slate-600">
              <?php echo esc_html($package['description']); ?>
            </p>
          </div>

          <!-- Price Box -->
          <div class="relative z-10 mt-6 rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5">
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-500">
                  <?php esc_html_e('Starting at', 'reviewservicepro'); ?>
                </p>

                <p class="mt-2 font-['Poppins'] text-4xl font-extrabold tracking-[-0.04em] text-slate-950">
                  <?php echo esc_html($package['price']); ?>
                </p>
              </div>

              <div class="text-right">
                <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-500">
                  <?php esc_html_e('Timeline', 'reviewservicepro'); ?>
                </p>

                <p class="mt-2 text-sm font-extrabold leading-6 text-slate-700">
                  <?php echo esc_html($package['timeline']); ?>
                </p>
              </div>
            </div>

            <div class="<?php echo esc_attr($tone['soft']); ?> mt-4 rounded-2xl border p-4">
              <p class="text-sm font-extrabold">
                <?php esc_html_e('Best for:', 'reviewservicepro'); ?>
              </p>

              <p class="mt-1 text-sm leading-6">
                <?php echo esc_html($package['best_for']); ?>
              </p>
            </div>
          </div>

          <!-- Quick Meta -->
          <div class="relative z-10 mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-4">
              <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-400">
                <?php esc_html_e('Platform Scope', 'reviewservicepro'); ?>
              </p>

              <p class="mt-1 text-sm font-bold leading-6 text-slate-700">
                <?php echo esc_html($package['platforms']); ?>
              </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4">
              <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-400">
                <?php esc_html_e('Upgrade Path', 'reviewservicepro'); ?>
              </p>

              <p class="mt-1 text-sm font-bold leading-6 text-slate-700">
                <?php esc_html_e('Monthly ORM ready', 'reviewservicepro'); ?>
              </p>
            </div>
          </div>

          <!-- Deliverables -->
          <div class="relative z-10 mt-6">
            <h4 class="font-['Poppins'] text-lg font-extrabold text-slate-950">
              <?php esc_html_e('What you receive', 'reviewservicepro'); ?>
            </h4>

            <ul class="mt-4 space-y-3">
              <?php foreach ($package['deliverables'] as $deliverable) : ?>
                <li class="flex gap-3 text-base leading-7 text-slate-600">
                  <span class="<?php echo esc_attr($tone['icon']); ?> mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-lg border">
                    <i data-lucide="check" class="h-3.5 w-3.5" aria-hidden="true"></i>
                  </span>
                  <?php echo esc_html($deliverable); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <!-- Outcome -->
          <div class="relative z-10 mt-6 rounded-[1.5rem] border border-emerald-200 bg-emerald-50 p-5">
            <p class="flex items-center gap-2 font-['Poppins'] text-base font-extrabold text-slate-950">
              <i data-lucide="target" class="h-5 w-5 text-emerald-700" aria-hidden="true"></i>
              <?php esc_html_e('Expected outcome', 'reviewservicepro'); ?>
            </p>

            <p class="mt-2 text-base leading-8 text-emerald-900">
              <?php echo esc_html($package['outcome']); ?>
            </p>
          </div>

          <!-- Not Included -->
          <details class="relative z-10 mt-5 rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4">
            <summary class="cursor-pointer text-sm font-extrabold text-slate-700">
              <?php esc_html_e('What is not included?', 'reviewservicepro'); ?>
            </summary>

            <ul class="mt-4 space-y-2">
              <?php foreach ($package['not_included'] as $excluded) : ?>
                <li class="flex gap-2 text-sm leading-6 text-slate-600">
                  <i data-lucide="x" class="mt-1 h-4 w-4 shrink-0 text-red-500" aria-hidden="true"></i>
                  <?php echo esc_html($excluded); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </details>

          <!-- Spacer -->
          <div class="flex-1"></div>

          <!-- Upgrade + CTA -->
          <div class="relative z-10 mt-6">
            <div class="mb-5 rounded-[1.5rem] border border-amber-200 bg-amber-50 p-4">
              <p class="flex items-start gap-2 text-sm font-bold leading-6 text-amber-900">
                <i data-lucide="arrow-up-right" class="mt-0.5 h-4 w-4 shrink-0 text-amber-700" aria-hidden="true"></i>
                <?php echo esc_html($package['upgrade']); ?>
              </p>
            </div>

            <a
              href="<?php echo esc_url($package_link); ?>"
              class="<?php echo esc_attr($tone['button']); ?> inline-flex w-full items-center justify-center gap-2 rounded-2xl px-6 py-4 text-sm font-extrabold shadow-lg transition-all duration-300 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
              <?php echo esc_html($package['cta']); ?>
              <i data-lucide="shopping-cart" class="h-5 w-5" aria-hidden="true"></i>
            </a>

            <?php if ($package['product_id'] <= 0) : ?>
              <p class="mt-3 text-center text-xs leading-6 text-slate-500">
                <?php esc_html_e('Product ID not connected yet. This button currently opens the inquiry flow.', 'reviewservicepro'); ?>
              </p>
            <?php else : ?>
              <p class="mt-3 text-center text-xs leading-6 text-slate-500">
                <?php esc_html_e('Secure checkout. Onboarding starts after payment.', 'reviewservicepro'); ?>
              </p>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Pricing Page Bridge -->
    <div class="rsp-one-time-reveal mt-12 overflow-hidden rounded-[2rem] border border-blue-200 bg-blue-50 shadow-sm" data-rsp-one-time-animate>
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_390px]">

        <div class="p-6 md:p-8">
          <span class="mb-5 inline-flex rounded-full border border-blue-200 bg-white px-3 py-1 text-xs font-extrabold uppercase tracking-[0.10em] text-blue-700">
            <?php esc_html_e('Need more options?', 'reviewservicepro'); ?>
          </span>

          <h3 class="font-['Poppins'] text-3xl font-extrabold leading-tight tracking-[-0.03em] text-slate-950">
            <?php esc_html_e('Advanced add-ons and detailed pricing will be available on the Pricing page.', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-4 max-w-3xl text-base leading-8 text-blue-900">
            <?php esc_html_e('The services page stays simple with three focused one-time packages. The full Pricing page can include platform-specific add-ons, Google Business Profile reputation audits, Trustpilot reputation management add-ons, Yelp review monitoring checks, ethical review request setup, custom ORM plans, and enterprise options.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex items-center border-t border-blue-200 bg-white p-6 md:p-8 lg:border-l lg:border-t-0">
          <div class="w-full rounded-[1.5rem] border border-slate-200 bg-slate-50 p-5">
            <h4 class="font-['Poppins'] text-xl font-extrabold text-slate-950">
              <?php esc_html_e('Detailed pricing page will include:', 'reviewservicepro'); ?>
            </h4>

            <ul class="mt-4 space-y-3">
              <li class="flex gap-3 text-base leading-7 text-slate-600">
                <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-blue-700" aria-hidden="true"></i>
                <?php esc_html_e('Monthly ORM plan comparison', 'reviewservicepro'); ?>
              </li>
              <li class="flex gap-3 text-base leading-7 text-slate-600">
                <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-blue-700" aria-hidden="true"></i>
                <?php esc_html_e('Platform-specific add-ons', 'reviewservicepro'); ?>
              </li>
              <li class="flex gap-3 text-base leading-7 text-slate-600">
                <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-blue-700" aria-hidden="true"></i>
                <?php esc_html_e('Custom and enterprise ORM options', 'reviewservicepro'); ?>
              </li>
            </ul>

            <a
              href="<?php echo esc_url($pricing_page_url); ?>"
              class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#1E3A8A] px-6 py-4 text-sm font-extrabold text-white shadow-lg shadow-blue-900/20 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
              <?php esc_html_e('View Full Pricing', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- Micro FAQ + Compliance -->
    <div class="mt-10 grid grid-cols-1 gap-6 lg:grid-cols-[1fr_0.85fr]">

      <!-- FAQ -->
      <div class="rsp-one-time-reveal rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm md:p-8" data-rsp-one-time-animate>
        <span class="mb-5 inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-extrabold uppercase tracking-[0.10em] text-slate-600">
          <?php esc_html_e('Quick Answers', 'reviewservicepro'); ?>
        </span>

        <h3 class="font-['Poppins'] text-2xl font-extrabold text-slate-950">
          <?php esc_html_e('Before you buy a one-time package', 'reviewservicepro'); ?>
        </h3>

        <div class="mt-5 space-y-4">
          <?php foreach ($micro_faqs as $faq) : ?>
            <details class="rounded-[1.25rem] border border-slate-200 bg-slate-50 p-4">
              <summary class="cursor-pointer font-bold text-slate-800">
                <?php echo esc_html($faq['question']); ?>
              </summary>

              <p class="mt-3 text-base leading-8 text-slate-600">
                <?php echo esc_html($faq['answer']); ?>
              </p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Compliance Note -->
      <div class="rsp-one-time-reveal rounded-[2rem] border border-emerald-200 bg-emerald-50 p-6 shadow-sm md:p-8" data-rsp-one-time-animate>
        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-emerald-700 shadow-sm">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>

        <h3 class="font-['Poppins'] text-2xl font-extrabold text-slate-950">
          <?php esc_html_e('Ethical ORM only.', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-4 text-base leading-8 text-emerald-900">
          <?php esc_html_e('ReviewService.Pro does not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, or guaranteed ranking outcomes. One-time packages focus on audits, response systems, documentation, ethical guidance, and clear next steps.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-6 flex flex-col gap-3">
          <a
            href="<?php echo esc_url($monthly_plan_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-6 py-4 text-sm font-extrabold text-white shadow-lg shadow-emerald-900/20 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-600">
            <?php esc_html_e('Compare Monthly Plans', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-6 py-4 text-sm font-extrabold text-emerald-700 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-100">
            <?php esc_html_e('Need Help Choosing?', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-5 w-5" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    </div>

  </div>
</section>

<script>
  (function() {
    function initOneTimePackages() {
      var items = document.querySelectorAll('[data-rsp-one-time-animate]');

      if (!items.length) {
        return;
      }

      function reveal(item) {
        if (!item || item.dataset.rspOneTimeRevealed === 'true') {
          return;
        }

        item.dataset.rspOneTimeRevealed = 'true';
        item.classList.add('rsp-visible');
      }

      if (!('IntersectionObserver' in window)) {
        items.forEach(reveal);
        return;
      }

      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            reveal(entry.target);
          }
        });
      }, {
        threshold: 0.13
      });

      items.forEach(function(item) {
        observer.observe(item);
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initOneTimePackages);
    } else {
      initOneTimePackages();
    }
  })();
</script>