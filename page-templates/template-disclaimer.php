<?php

/**
 * Template Name: Disclaimer Page
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$last_updated = date_i18n('F Y');

$summary_cards = [
  [
    'icon'  => 'trending-up',
    'title' => __('No Ranking Guarantees', 'reviewservicepro'),
    'desc'  => __('Search rankings and map visibility depend on third-party algorithms, competition, and business activity.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'trash-2',
    'title' => __('No Review Removal Guarantees', 'reviewservicepro'),
    'desc'  => __('Only review platforms decide whether a review qualifies for removal under their policies.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'star',
    'title' => __('No Rating Guarantees', 'reviewservicepro'),
    'desc'  => __('Customer ratings depend on real customer experiences and cannot be ethically controlled.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'ban',
    'title' => __('No Fake Reviews', 'reviewservicepro'),
    'desc'  => __('We do not create, sell, buy, or manipulate reviews. Our work is platform-compliant.', 'reviewservicepro'),
  ],
];

$disclaimer_sections = [
  [
    'id'    => 'rankings',
    'icon'  => 'map',
    'title' => __('No Guaranteed Rankings', 'reviewservicepro'),
    'text'  => __('ReviewService.Pro may provide local trust, review response, platform optimization, and reputation strategy support. However, we do not guarantee specific search engine rankings, Google Maps positions, Local Pack placement, organic search visibility, or traffic growth. Search engines and review platforms use complex systems that change frequently and are outside our control.', 'reviewservicepro'),
  ],
  [
    'id'    => 'review-removal',
    'icon'  => 'shield-alert',
    'title' => __('No Guaranteed Review Removal', 'reviewservicepro'),
    'text'  => __('We may help identify reviews that appear to violate platform policies and guide you through the official reporting process. However, we cannot guarantee that Google, Trustpilot, Yelp, Facebook, Tripadvisor, BBB, Sitejabber, or any third-party platform will remove a review. Genuine customer reviews cannot simply be deleted by our agency.', 'reviewservicepro'),
  ],
  [
    'id'    => 'ratings',
    'icon'  => 'star-half',
    'title' => __('No Guaranteed Star Ratings or Review Counts', 'reviewservicepro'),
    'text'  => __('We do not guarantee a specific star rating, number of reviews, review velocity, customer participation level, or rating improvement. Ethical reputation management depends on real customer behavior, actual service quality, industry conditions, geography, timing, and platform-specific rules.', 'reviewservicepro'),
  ],
  [
    'id'    => 'results',
    'icon'  => 'activity',
    'title' => __('Results May Vary', 'reviewservicepro'),
    'text'  => __('Reputation management outcomes vary by business, industry, location, competition, review history, customer experience, operational standards, and platform updates. Any examples, estimates, projections, or strategy recommendations are provided for planning purposes only and should not be interpreted as guaranteed outcomes.', 'reviewservicepro'),
  ],
  [
    'id'    => 'fake-reviews',
    'icon'  => 'x-circle',
    'title' => __('No Fake Reviews or Manipulation', 'reviewservicepro'),
    'text'  => __('ReviewService.Pro does not create fake reviews, purchase reviews, sell reviews, incentivize positive reviews, impersonate customers, use review gating, deploy bots, or participate in deceptive review manipulation. If a client requests unethical or platform-violating tactics, we reserve the right to refuse the work or terminate the engagement.', 'reviewservicepro'),
  ],
  [
    'id'    => 'platforms',
    'icon'  => 'globe-2',
    'title' => __('Third-Party Platform Disclaimer', 'reviewservicepro'),
    'text'  => __('Google, Trustpilot, Yelp, Facebook, Tripadvisor, BBB, Sitejabber, and other review platforms operate independently from ReviewService.Pro. We do not own, control, or influence their algorithms, moderation systems, policy decisions, account actions, review filtering, or enforcement outcomes.', 'reviewservicepro'),
  ],
  [
    'id'    => 'ai',
    'icon'  => 'bot',
    'title' => __('AI & Automation Disclaimer', 'reviewservicepro'),
    'text'  => __('We may use AI-assisted tools for internal drafting, sentiment analysis, workflow support, and reporting assistance. However, AI is not used to create fake reviews, impersonate customers, publish unreviewed outputs, or perform deceptive automation. Human review remains part of our quality control process.', 'reviewservicepro'),
  ],
  [
    'id'    => 'case-studies',
    'icon'  => 'file-text',
    'title' => __('Case Study Disclaimer', 'reviewservicepro'),
    'text'  => __('Case studies, examples, scenarios, screenshots, testimonials, or performance references are illustrative only. Past results do not guarantee future results. Each business has unique circumstances, and outcomes may differ significantly based on industry, market, competition, platform activity, and operational quality.', 'reviewservicepro'),
  ],
  [
    'id'    => 'business-responsibility',
    'icon'  => 'building-2',
    'title' => __('Business Responsibility Disclaimer', 'reviewservicepro'),
    'text'  => __('Clients remain responsible for their customer experience, service quality, staff behavior, product delivery, operational standards, communication, and compliance with applicable platform rules. ORM can support reputation visibility, but it cannot replace genuine business quality.', 'reviewservicepro'),
  ],
  [
    'id'    => 'legal-financial',
    'icon'  => 'scale',
    'title' => __('No Legal, Financial, or Professional Advice', 'reviewservicepro'),
    'text'  => __('Information on this website is provided for general educational and business purposes only. It should not be considered legal, financial, compliance, or professional advice. Businesses should consult qualified legal or professional advisors for advice specific to their situation.', 'reviewservicepro'),
  ],
];

$faqs = [
  [
    'q' => __('Can you guarantee review removal?', 'reviewservicepro'),
    'a' => __('No. We can help identify possible policy violations and guide the reporting process, but the platform makes the final decision.', 'reviewservicepro'),
  ],
  [
    'q' => __('Can you guarantee Google Maps rankings?', 'reviewservicepro'),
    'a' => __('No. Google rankings depend on many factors, including relevance, distance, prominence, competition, business data, and algorithm changes.', 'reviewservicepro'),
  ],
  [
    'q' => __('Do you provide fake reviews?', 'reviewservicepro'),
    'a' => __('No. We never create, buy, sell, or distribute fake reviews. Our reputation management work is ethical and platform-compliant.', 'reviewservicepro'),
  ],
  [
    'q' => __('Are case study results guaranteed?', 'reviewservicepro'),
    'a' => __('No. Case studies are examples only. Results vary by industry, starting reputation, customer behavior, location, and platform conditions.', 'reviewservicepro'),
  ],
  [
    'q' => __('Can ORM guarantee more revenue?', 'reviewservicepro'),
    'a' => __('No. Reputation improvements may support trust and conversion, but revenue depends on many business factors outside our control.', 'reviewservicepro'),
  ],
];

$nav_items = [
  'rankings'                => __('Rankings', 'reviewservicepro'),
  'review-removal'          => __('Review Removal', 'reviewservicepro'),
  'ratings'                 => __('Ratings', 'reviewservicepro'),
  'results'                 => __('Results', 'reviewservicepro'),
  'fake-reviews'            => __('Fake Reviews', 'reviewservicepro'),
  'platforms'               => __('Platforms', 'reviewservicepro'),
  'ai'                      => __('AI Use', 'reviewservicepro'),
  'case-studies'            => __('Case Studies', 'reviewservicepro'),
  'business-responsibility' => __('Client Role', 'reviewservicepro'),
  'legal-financial'         => __('Legal Advice', 'reviewservicepro'),
];
?>

<section class="relative overflow-hidden bg-[#020817] py-24 md:py-32">
  <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
  <div class="pointer-events-none absolute -top-24 left-1/2 z-0 h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-blue-600/[0.14] blur-[140px]"></div>
  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.08] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
    <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-amber-500/30 bg-amber-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-amber-300">
      <i data-lucide="alert-triangle" class="h-4 w-4" aria-hidden="true"></i>
      <?php esc_html_e('Disclaimer', 'reviewservicepro'); ?>
    </span>

    <h1 class="mb-6 text-4xl font-extrabold leading-tight tracking-tight text-white md:text-6xl">
      <?php esc_html_e('Clear Limits.', 'reviewservicepro'); ?>
      <span class="block bg-gradient-to-r from-blue-400 via-cyan-300 to-emerald-300 bg-clip-text text-transparent">
        <?php esc_html_e('Transparent Expectations.', 'reviewservicepro'); ?>
      </span>
    </h1>

    <p class="mx-auto mb-7 max-w-2xl text-base leading-8 text-slate-400">
      <?php esc_html_e('This disclaimer explains what ReviewService.Pro can and cannot guarantee, how third-party platforms affect outcomes, and why ethical reputation management requires realistic expectations.', 'reviewservicepro'); ?>
    </p>

    <div class="flex flex-wrap justify-center gap-3">
      <span class="rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-2 text-xs font-bold text-emerald-300"><?php esc_html_e('No Fake Reviews', 'reviewservicepro'); ?></span>
      <span class="rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-2 text-xs font-bold text-blue-300"><?php esc_html_e('No Ranking Guarantees', 'reviewservicepro'); ?></span>
      <span class="rounded-full border border-amber-500/25 bg-amber-500/10 px-4 py-2 text-xs font-bold text-amber-300"><?php echo esc_html(sprintf(__('Last Updated: %s', 'reviewservicepro'), $last_updated)); ?></span>
    </div>
  </div>
</section>

<section class="border-t border-white/[0.05] bg-[#07111F] py-16 md:py-20">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($summary_cards as $card) : ?>
        <article class="rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6">
          <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-500/25 bg-blue-600/10 text-blue-400">
            <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
          </div>
          <h2 class="mb-3 text-lg font-extrabold text-white"><?php echo esc_html($card['title']); ?></h2>
          <p class="text-sm leading-7 text-slate-400"><?php echo esc_html($card['desc']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="border-t border-white/[0.05] bg-[#0B1220] py-20 md:py-24">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 sm:px-6 lg:grid-cols-[280px_1fr] lg:px-8">
    <aside class="hidden lg:block">
      <div class="sticky top-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-5">
        <p class="mb-4 text-[11px] font-bold uppercase tracking-[0.14em] text-blue-400">
          <?php esc_html_e('On This Page', 'reviewservicepro'); ?>
        </p>

        <nav class="space-y-1" aria-label="<?php esc_attr_e('Disclaimer navigation', 'reviewservicepro'); ?>">
          <?php foreach ($nav_items as $id => $label) : ?>
            <a href="#<?php echo esc_attr($id); ?>" class="block rounded-xl px-3 py-2 text-sm font-semibold text-slate-400 transition-all duration-200 hover:bg-white/[0.05] hover:text-white">
              <?php echo esc_html($label); ?>
            </a>
          <?php endforeach; ?>
        </nav>
      </div>
    </aside>

    <div class="space-y-5">
      <div class="mb-8 rounded-3xl border border-amber-500/[0.18] bg-amber-500/[0.06] p-6">
        <h2 class="mb-3 text-2xl font-extrabold text-white">
          <?php esc_html_e('Important Notice', 'reviewservicepro'); ?>
        </h2>
        <p class="text-sm leading-7 text-amber-100/80">
          <?php esc_html_e('Our services are designed to support ethical reputation improvement, but we do not control customer opinions, platform decisions, search algorithms, review moderation systems, or business outcomes.', 'reviewservicepro'); ?>
        </p>
      </div>

      <?php foreach ($disclaimer_sections as $section) : ?>
        <article id="<?php echo esc_attr($section['id']); ?>" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
          <div class="mb-5 flex items-center gap-4">
            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl border border-blue-500/25 bg-blue-600/10 text-blue-400">
              <i data-lucide="<?php echo esc_attr($section['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
            </div>

            <h2 class="text-2xl font-extrabold text-white">
              <?php echo esc_html($section['title']); ?>
            </h2>
          </div>

          <p class="text-base leading-8 text-slate-400">
            <?php echo esc_html($section['text']); ?>
          </p>
        </article>
      <?php endforeach; ?>

      <article class="rounded-3xl border border-red-500/[0.18] bg-red-500/[0.06] p-6 md:p-8">
        <h2 class="mb-5 text-2xl font-extrabold text-white">
          <?php esc_html_e('Limitation of Liability', 'reviewservicepro'); ?>
        </h2>

        <p class="text-base leading-8 text-red-100/80">
          <?php esc_html_e('To the fullest extent permitted by applicable law, ReviewService.Pro shall not be liable for indirect, incidental, consequential, special, punitive, or business-related losses, including loss of revenue, ranking loss, review loss, business interruption, platform penalties, algorithm changes, or third-party platform decisions.', 'reviewservicepro'); ?>
        </p>
      </article>

      <article class="rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
        <h2 class="mb-5 text-2xl font-extrabold text-white">
          <?php esc_html_e('External Links & Policy Updates', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-4 text-base leading-8 text-slate-400">
          <?php esc_html_e('This website may contain links to third-party websites, platforms, policies, or resources. We are not responsible for third-party content, policy changes, security practices, or platform decisions.', 'reviewservicepro'); ?>
        </p>

        <p class="text-base leading-8 text-slate-400">
          <?php esc_html_e('We may update this disclaimer periodically to reflect changes in our services, legal requirements, platform policies, or business operations. The latest version will be published on this page.', 'reviewservicepro'); ?>
        </p>
      </article>
    </div>
  </div>
</section>

<section class="border-t border-white/[0.05] bg-[#07111F] py-20 md:py-24">
  <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
    <div class="mb-10 text-center">
      <h2 class="mb-4 text-3xl font-extrabold text-white md:text-5xl">
        <?php esc_html_e('Disclaimer FAQs', 'reviewservicepro'); ?>
      </h2>
      <p class="text-sm text-slate-400">
        <?php esc_html_e('Quick answers about guarantees, review removal, fake reviews, rankings, and case studies.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="space-y-3">
      <?php foreach ($faqs as $faq) : ?>
        <details class="group rounded-2xl border border-white/[0.08] bg-white/[0.035] p-5">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left text-base font-bold text-white">
            <?php echo esc_html($faq['q']); ?>
            <i data-lucide="chevron-down" class="h-5 w-5 flex-shrink-0 text-slate-400 transition-transform duration-300 group-open:rotate-180" aria-hidden="true"></i>
          </summary>

          <p class="mt-4 border-t border-white/[0.08] pt-4 text-sm leading-7 text-slate-400">
            <?php echo esc_html($faq['a']); ?>
          </p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-white/[0.05] bg-[#020817] py-20 md:py-24">
  <div class="pointer-events-none absolute -top-24 left-1/2 h-[420px] w-[700px] -translate-x-1/2 rounded-full bg-emerald-500/[0.10] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
    <h2 class="mb-5 text-3xl font-extrabold leading-tight text-white md:text-5xl">
      <?php esc_html_e('Want ethical ORM with clear expectations?', 'reviewservicepro'); ?>
    </h2>

    <p class="mx-auto mb-8 max-w-2xl text-base leading-8 text-slate-400">
      <?php esc_html_e('Start with a free reputation audit and learn what can realistically be improved without fake reviews, risky tactics, or false promises.', 'reviewservicepro'); ?>
    </p>

    <div class="flex flex-col justify-center gap-3 sm:flex-row">
      <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-7 py-4 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
        <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
        <?php esc_html_e('Book Free Audit', 'reviewservicepro'); ?>
      </a>

      <a href="<?php echo esc_url(home_url('/trust-center/')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.14] bg-white/[0.04] px-7 py-4 text-sm font-bold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.08]">
        <?php esc_html_e('View Trust Center', 'reviewservicepro'); ?>
        <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</section>

<?php
get_footer();
