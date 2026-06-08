<?php

/**
 * Services Page Trust & Compliance Section
 *
 * File: template-parts/sections/services/trust-compliance.php
 *
 * ReviewService.Pro — Ethical ORM Trust & Compliance Section
 *
 * Physics Role:
 * - Trust Friction Reduction
 * - Risk Reversal
 * - Ethical Authority
 *
 * Purpose:
 * Reduce buyer hesitation by clearly explaining that ReviewService.Pro does not
 * use fake reviews, paid incentives, rating manipulation, guaranteed removals,
 * or risky shortcuts. This section builds trust through compliance-safe language.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$trust_badges = [
  [
    'icon'  => 'shield-check',
    'title' => __('No Fake Reviews', 'reviewservicepro'),
    'text'  => __('We do not create, sell, post, or encourage fake customer reviews.', 'reviewservicepro'),
    'tone'  => 'emerald',
  ],
  [
    'icon'  => 'badge-check',
    'title' => __('Platform-Compliant Methods', 'reviewservicepro'),
    'text'  => __('Our workflow focuses on monitoring, documentation, response quality, and safe reporting direction.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'users',
    'title' => __('Ethical Review Requests', 'reviewservicepro'),
    'text'  => __('We help request genuine customer feedback without pressure, incentives, or manipulation.', 'reviewservicepro'),
    'tone'  => 'emerald',
  ],
  [
    'icon'  => 'file-text',
    'title' => __('Transparent Reporting', 'reviewservicepro'),
    'text'  => __('Clients receive clear reporting on review activity, response work, risks, and next actions.', 'reviewservicepro'),
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'lock',
    'title' => __('Secure Client Portal', 'reviewservicepro'),
    'text'  => __('Service details, reports, required actions, support, orders, and invoices stay organized.', 'reviewservicepro'),
    'tone'  => 'violet',
  ],
  [
    'icon'  => 'life-buoy',
    'title' => __('Human Support', 'reviewservicepro'),
    'text'  => __('Clients can request support, updates, review guidance, and billing help when needed.', 'reviewservicepro'),
    'tone'  => 'amber',
  ],
];

$what_we_do = [
  __('Monitor selected review platforms based on your plan and business needs.', 'reviewservicepro'),
  __('Prepare professional response drafts for positive, neutral, and negative reviews.', 'reviewservicepro'),
  __('Document sensitive review issues and identify possible platform policy concerns.', 'reviewservicepro'),
  __('Help request genuine customer feedback using ethical, pressure-free workflows.', 'reviewservicepro'),
  __('Provide monthly reports with progress, risks, response work, and next actions.', 'reviewservicepro'),
  __('Improve controllable trust signals such as response quality, review freshness, profile consistency, and platform completeness.', 'reviewservicepro'),
];

$what_we_do_not_do = [
  __('We do not sell fake reviews.', 'reviewservicepro'),
  __('We do not promise guaranteed 5-star ratings.', 'reviewservicepro'),
  __('We do not guarantee negative review removal.', 'reviewservicepro'),
  __('We do not use paid or incentivized review manipulation.', 'reviewservicepro'),
  __('We do not impersonate customers or businesses.', 'reviewservicepro'),
  __('We do not promise guaranteed local rankings or platform outcomes.', 'reviewservicepro'),
];

$compliance_steps = [
  [
    'number' => '01',
    'icon'   => 'search-check',
    'title'  => __('Identify', 'reviewservicepro'),
    'text'   => __('We review your reputation situation, platform links, customer feedback patterns, and visible trust gaps.', 'reviewservicepro'),
  ],
  [
    'number' => '02',
    'icon'   => 'file-search',
    'title'  => __('Document', 'reviewservicepro'),
    'text'   => __('For sensitive reviews, we help organize issue context, evidence notes, response direction, and possible policy concerns.', 'reviewservicepro'),
  ],
  [
    'number' => '03',
    'icon'   => 'message-square',
    'title'  => __('Respond', 'reviewservicepro'),
    'text'   => __('We prepare calm, professional, brand-safe public response drafts that show customers your business listens and cares.', 'reviewservicepro'),
  ],
  [
    'number' => '04',
    'icon'   => 'bar-chart',
    'title'  => __('Report', 'reviewservicepro'),
    'text'   => __('Monthly reports show what was monitored, what was responded to, what risks remain, and what should happen next.', 'reviewservicepro'),
  ],
];

$cta_primary_url   = '#monthly-plans';
$cta_secondary_url = home_url('/contact/?type=compliance-question');
?>

<section
  id="trust-compliance"
  class="relative overflow-hidden border-b border-slate-200 bg-white py-20 md:py-28"
  aria-labelledby="trust-compliance-title"
  data-gsap="services-trust-compliance">

  <!-- Background Glow -->
  <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(16,185,129,0.08),transparent_32%),radial-gradient(circle_at_bottom_right,rgba(37,99,235,0.08),transparent_32%)]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Heading + Main Compliance Panel -->
    <div class="mb-14 grid grid-cols-1 gap-10 lg:grid-cols-[0.92fr_1.08fr] lg:items-center">

      <div data-gsap-item="trust-compliance-heading">
        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.14em] text-emerald-700">
          <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Trust & Compliance', 'reviewservicepro'); ?>
        </span>

        <h2
          id="trust-compliance-title"
          class="max-w-4xl text-3xl font-extrabold leading-tight tracking-tight text-slate-950 md:text-4xl lg:text-5xl">
          <?php esc_html_e('Ethical reputation management built for long-term trust — not shortcuts.', 'reviewservicepro'); ?>
        </h2>

        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-600">
          <?php esc_html_e('Online reputation management should protect your brand, not create more risk. Our approach focuses on genuine customer feedback, professional response strategy, documentation, transparent reporting, and platform-compliant reputation improvement.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
          <a
            href="<?php echo esc_url($cta_primary_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 py-4 text-sm font-extrabold text-white shadow-lg shadow-blue-600/20 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
            <?php esc_html_e('Choose an Ethical ORM Plan', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
          </a>

          <a
            href="<?php echo esc_url($cta_secondary_url); ?>"
            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-7 py-4 text-sm font-extrabold text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/10">
            <?php esc_html_e('Ask Compliance Question', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-5 w-5" aria-hidden="true"></i>
          </a>
        </div>
      </div>

      <!-- Compliance Visual Card -->
      <div data-gsap-item="trust-compliance-visual" class="relative">
        <div class="absolute -inset-6 rounded-[2.5rem] bg-emerald-100 blur-3xl"></div>

        <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-50 p-5 shadow-2xl shadow-slate-900/10">

          <div class="mb-5 rounded-[1.75rem] border border-emerald-200 bg-emerald-50 p-5">
            <div class="flex items-start gap-4">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm">
                <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
              </div>

              <div>
                <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-emerald-700">
                  <?php esc_html_e('Ethical ORM Promise', 'reviewservicepro'); ?>
                </p>

                <h3 class="mt-2 text-2xl font-extrabold text-slate-950">
                  <?php esc_html_e('We build trust. We do not manufacture it.', 'reviewservicepro'); ?>
                </h3>

                <p class="mt-3 text-base leading-8 text-emerald-900">
                  <?php esc_html_e('Our work focuses on real customer feedback, better communication, documentation, reporting, and long-term reputation systems.', 'reviewservicepro'); ?>
                </p>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-5">
              <div class="mb-4 flex items-center gap-2 text-lg font-extrabold text-slate-950">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                  <i data-lucide="check" class="h-4 w-4" aria-hidden="true"></i>
                </span>
                <?php esc_html_e('What we do', 'reviewservicepro'); ?>
              </div>

              <ul class="space-y-3">
                <?php foreach (array_slice($what_we_do, 0, 4) as $item) : ?>
                  <li class="flex gap-3 text-base leading-7 text-slate-600">
                    <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                      <i data-lucide="check" class="h-3.5 w-3.5" aria-hidden="true"></i>
                    </span>
                    <?php echo esc_html($item); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div class="rounded-[1.75rem] border border-red-200 bg-red-50 p-5">
              <div class="mb-4 flex items-center gap-2 text-lg font-extrabold text-slate-950">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white text-red-600">
                  <i data-lucide="ban" class="h-4 w-4" aria-hidden="true"></i>
                </span>
                <?php esc_html_e('What we avoid', 'reviewservicepro'); ?>
              </div>

              <ul class="space-y-3">
                <?php foreach (array_slice($what_we_do_not_do, 0, 4) as $item) : ?>
                  <li class="flex gap-3 text-base leading-7 text-red-900">
                    <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white text-red-600">
                      <i data-lucide="x" class="h-3.5 w-3.5" aria-hidden="true"></i>
                    </span>
                    <?php echo esc_html($item); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- Trust Badge Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" data-gsap-item="trust-badge-grid">
      <?php foreach ($trust_badges as $badge) : ?>
        <?php
        $tone_class = 'border-blue-200 bg-blue-50 text-blue-700';

        if ('emerald' === $badge['tone']) {
          $tone_class = 'border-emerald-200 bg-emerald-50 text-emerald-700';
        } elseif ('violet' === $badge['tone']) {
          $tone_class = 'border-violet-200 bg-violet-50 text-violet-700';
        } elseif ('amber' === $badge['tone']) {
          $tone_class = 'border-amber-200 bg-amber-50 text-amber-700';
        }
        ?>

        <article class="group rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5">
          <div class="<?php echo esc_attr($tone_class); ?> mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border transition-all duration-300">
            <i data-lucide="<?php echo esc_attr($badge['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <h3 class="text-xl font-extrabold leading-snug text-slate-950">
            <?php echo esc_html($badge['title']); ?>
          </h3>

          <p class="mt-3 text-base leading-8 text-slate-600">
            <?php echo esc_html($badge['text']); ?>
          </p>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Do / Don't Full Lists -->
    <div class="mt-10 grid grid-cols-1 gap-6 lg:grid-cols-2" data-gsap-item="trust-do-dont">

      <div class="rounded-[2rem] border border-emerald-200 bg-emerald-50 p-6 md:p-8">
        <div class="mb-6 flex items-center gap-4">
          <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm">
            <i data-lucide="check-circle-2" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <div>
            <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-emerald-700">
              <?php esc_html_e('Safe ORM Work', 'reviewservicepro'); ?>
            </p>

            <h3 class="mt-1 text-2xl font-extrabold text-slate-950">
              <?php esc_html_e('What ReviewService.Pro helps with', 'reviewservicepro'); ?>
            </h3>
          </div>
        </div>

        <ul class="space-y-4">
          <?php foreach ($what_we_do as $item) : ?>
            <li class="flex gap-3 text-base leading-8 text-emerald-950">
              <span class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white text-emerald-600">
                <i data-lucide="check" class="h-4 w-4" aria-hidden="true"></i>
              </span>

              <?php echo esc_html($item); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="rounded-[2rem] border border-red-200 bg-red-50 p-6 md:p-8">
        <div class="mb-6 flex items-center gap-4">
          <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-red-600 shadow-sm">
            <i data-lucide="ban" class="h-5 w-5" aria-hidden="true"></i>
          </div>

          <div>
            <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-red-700">
              <?php esc_html_e('Risky Shortcuts Avoided', 'reviewservicepro'); ?>
            </p>

            <h3 class="mt-1 text-2xl font-extrabold text-slate-950">
              <?php esc_html_e('What ReviewService.Pro does not promise', 'reviewservicepro'); ?>
            </h3>
          </div>
        </div>

        <ul class="space-y-4">
          <?php foreach ($what_we_do_not_do as $item) : ?>
            <li class="flex gap-3 text-base leading-8 text-red-950">
              <span class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white text-red-600">
                <i data-lucide="x" class="h-4 w-4" aria-hidden="true"></i>
              </span>

              <?php echo esc_html($item); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>

    <!-- Compliance Steps -->
    <div class="mt-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-50 shadow-sm" data-gsap-item="trust-compliance-steps">
      <div class="border-b border-slate-200 bg-white p-6 md:p-8">
        <span class="mb-4 inline-flex rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-extrabold uppercase tracking-[0.10em] text-blue-700">
          <?php esc_html_e('Compliance-Safe Workflow', 'reviewservicepro'); ?>
        </span>

        <h3 class="text-3xl font-extrabold leading-tight text-slate-950">
          <?php esc_html_e('How we handle reputation issues safely.', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-3 max-w-3xl text-base leading-8 text-slate-600">
          <?php esc_html_e('The goal is not to hide every negative comment. The goal is to respond professionally, document issues, improve customer communication, and manage reputation risks in a platform-safe way.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2 md:p-8 lg:grid-cols-4">
        <?php foreach ($compliance_steps as $step) : ?>
          <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <span class="mb-5 inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-extrabold text-slate-500">
              <?php echo esc_html($step['number']); ?>
            </span>

            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
              <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>

            <h4 class="text-xl font-extrabold text-slate-950">
              <?php echo esc_html($step['title']); ?>
            </h4>

            <p class="mt-3 text-base leading-8 text-slate-600">
              <?php echo esc_html($step['text']); ?>
            </p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Bottom Disclaimer -->
    <div class="mt-10 rounded-[2rem] border border-amber-200 bg-amber-50 p-6 md:flex md:items-start md:gap-5">
      <div class="mb-4 flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-amber-600 shadow-sm md:mb-0">
        <i data-lucide="alert-triangle" class="h-5 w-5" aria-hidden="true"></i>
      </div>

      <div>
        <h3 class="text-2xl font-extrabold text-slate-950">
          <?php esc_html_e('Important compliance note.', 'reviewservicepro'); ?>
        </h3>

        <p class="mt-2 text-base leading-8 text-amber-900">
          <?php esc_html_e('ReviewService.Pro provides ethical online reputation management support. We do not guarantee specific ratings, review removals, platform decisions, ranking outcomes, or customer behavior. Our work focuses on responsible monitoring, professional response support, documentation, reporting, and trust-building systems.', 'reviewservicepro'); ?>
        </p>
      </div>
    </div>

  </div>
</section>