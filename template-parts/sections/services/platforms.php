<?php

/**
 * Services Page Platforms We Monitor Section
 *
 * File: template-parts/sections/services/platforms.php
 *
 * ReviewService.Pro — Platforms We Monitor
 *
 * Purpose:
 * - Show review platforms monitored by ReviewService.Pro
 * - Support SEO keywords around Google Business Profile reputation management,
 *   Trustpilot reputation management, Yelp review monitoring, Facebook review management,
 *   and platform-based reputation monitoring
 * - Keep service-page funnel focused: Services → Monthly Plan / Package → Checkout → Client Portal
 *
 * Stack:
 * - WordPress PHP
 * - Tailwind CSS from theme build
 * - Lucide icons already enqueued by theme
 * - Sans-serif typography
 * - Minimal scoped CSS only for marquee animation
 *
 * Compliance:
 * - No fake reviews
 * - No paid/incentivized reviews
 * - No guaranteed review removal
 * - No guaranteed ranking outcomes
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Platform page link helper.
 *
 * If the "platforms" CPT has a matching single page, link to it.
 * Otherwise return false so we avoid accidental broken links.
 */
if (! function_exists('rsp_get_platform_page_link')) {
  function rsp_get_platform_page_link($slug)
  {
    $slug = sanitize_title($slug);

    if (post_type_exists('platforms')) {
      $platform_post = get_page_by_path($slug, OBJECT, 'platforms');

      if ($platform_post instanceof WP_Post) {
        return get_permalink($platform_post);
      }
    }

    return false;
  }
}

/**
 * CTA URL helper.
 *
 * If a WooCommerce platform audit product is connected, CTA can go to checkout.
 * Otherwise it goes to contact/inquiry flow.
 */
$platform_audit_product_id = absint(get_theme_mod('rsp_platform_audit_product_id', 0));

$platform_audit_url = add_query_arg(
  [
    'type' => rawurlencode('platform-audit'),
  ],
  home_url('/contact/')
);

if ($platform_audit_product_id > 0 && function_exists('wc_get_checkout_url')) {
  $platform_audit_url = add_query_arg(
    [
      'add-to-cart' => $platform_audit_product_id,
    ],
    wc_get_checkout_url()
  );
}

$monthly_plans_url = '#monthly-plans';
$pricing_url       = home_url('/pricing/');
$platform_archive  = post_type_exists('platforms') && get_post_type_archive_link('platforms')
  ? get_post_type_archive_link('platforms')
  : home_url('/platforms/');

/**
 * Platform list.
 *
 * Later this can be moved to CPT/ACF.
 * Current structure is static-array fallback for reliable frontend output.
 */
$platforms = [
  [
    'name'     => __('Google Business Profile', 'reviewservicepro'),
    'category' => __('Local Search', 'reviewservicepro'),
    'slug'     => 'google-business-profile',
    'icon'     => 'badge-check',
    'tone'     => 'blue',
    'keyword'  => __('Google Business Profile reputation management', 'reviewservicepro'),
  ],
  [
    'name'     => __('Google Maps', 'reviewservicepro'),
    'category' => __('Local SEO', 'reviewservicepro'),
    'slug'     => 'google-maps',
    'icon'     => 'map-pin',
    'tone'     => 'blue',
    'keyword'  => __('Google Maps review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Facebook Reviews', 'reviewservicepro'),
    'category' => __('Social Reviews', 'reviewservicepro'),
    'slug'     => 'facebook-reviews',
    'icon'     => 'facebook',
    'tone'     => 'blue',
    'keyword'  => __('Facebook review management', 'reviewservicepro'),
  ],
  [
    'name'     => __('Trustpilot', 'reviewservicepro'),
    'category' => __('Rating Platform', 'reviewservicepro'),
    'slug'     => 'trustpilot',
    'icon'     => 'star',
    'tone'     => 'emerald',
    'keyword'  => __('Trustpilot reputation management', 'reviewservicepro'),
  ],
  [
    'name'     => __('Yelp', 'reviewservicepro'),
    'category' => __('Rating Platform', 'reviewservicepro'),
    'slug'     => 'yelp',
    'icon'     => 'star',
    'tone'     => 'emerald',
    'keyword'  => __('Yelp review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Tripadvisor', 'reviewservicepro'),
    'category' => __('Hospitality', 'reviewservicepro'),
    'slug'     => 'tripadvisor',
    'icon'     => 'globe-2',
    'tone'     => 'emerald',
    'keyword'  => __('Tripadvisor reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('BBB', 'reviewservicepro'),
    'category' => __('Trust Bureau', 'reviewservicepro'),
    'slug'     => 'bbb',
    'icon'     => 'shield-check',
    'tone'     => 'blue',
    'keyword'  => __('BBB reputation management', 'reviewservicepro'),
  ],
  [
    'name'     => __('G2', 'reviewservicepro'),
    'category' => __('B2B Software', 'reviewservicepro'),
    'slug'     => 'g2',
    'icon'     => 'bar-chart-3',
    'tone'     => 'amber',
    'keyword'  => __('G2 review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Capterra', 'reviewservicepro'),
    'category' => __('Software Reviews', 'reviewservicepro'),
    'slug'     => 'capterra',
    'icon'     => 'bar-chart-3',
    'tone'     => 'amber',
    'keyword'  => __('Capterra reputation management', 'reviewservicepro'),
  ],
  [
    'name'     => __('Sitejabber', 'reviewservicepro'),
    'category' => __('Ecommerce', 'reviewservicepro'),
    'slug'     => 'sitejabber',
    'icon'     => 'message-square',
    'tone'     => 'purple',
    'keyword'  => __('Sitejabber review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Reviews.io', 'reviewservicepro'),
    'category' => __('Ecommerce', 'reviewservicepro'),
    'slug'     => 'reviews-io',
    'icon'     => 'message-square',
    'tone'     => 'blue',
    'keyword'  => __('Reviews.io reputation management', 'reviewservicepro'),
  ],
  [
    'name'     => __('Clutch', 'reviewservicepro'),
    'category' => __('Agencies', 'reviewservicepro'),
    'slug'     => 'clutch',
    'icon'     => 'award',
    'tone'     => 'emerald',
    'keyword'  => __('Clutch review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Birdeye', 'reviewservicepro'),
    'category' => __('Review Platform', 'reviewservicepro'),
    'slug'     => 'birdeye',
    'icon'     => 'radar',
    'tone'     => 'purple',
    'keyword'  => __('Birdeye reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Glassdoor', 'reviewservicepro'),
    'category' => __('Employer Brand', 'reviewservicepro'),
    'slug'     => 'glassdoor',
    'icon'     => 'briefcase-business',
    'tone'     => 'emerald',
    'keyword'  => __('Glassdoor reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Houzz', 'reviewservicepro'),
    'category' => __('Home Services', 'reviewservicepro'),
    'slug'     => 'houzz',
    'icon'     => 'home',
    'tone'     => 'emerald',
    'keyword'  => __('Houzz review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('HomeAdvisor', 'reviewservicepro'),
    'category' => __('Home Services', 'reviewservicepro'),
    'slug'     => 'homeadvisor',
    'icon'     => 'home',
    'tone'     => 'blue',
    'keyword'  => __('HomeAdvisor reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Yellow Pages', 'reviewservicepro'),
    'category' => __('Directory', 'reviewservicepro'),
    'slug'     => 'yellow-pages',
    'icon'     => 'book-open',
    'tone'     => 'amber',
    'keyword'  => __('Yellow Pages review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Bark', 'reviewservicepro'),
    'category' => __('Service Marketplace', 'reviewservicepro'),
    'slug'     => 'bark',
    'icon'     => 'users',
    'tone'     => 'amber',
    'keyword'  => __('Bark review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Checkatrade', 'reviewservicepro'),
    'category' => __('UK Trades', 'reviewservicepro'),
    'slug'     => 'checkatrade',
    'icon'     => 'check-circle-2',
    'tone'     => 'blue',
    'keyword'  => __('Checkatrade reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Trustindex', 'reviewservicepro'),
    'category' => __('Aggregator', 'reviewservicepro'),
    'slug'     => 'trustindex',
    'icon'     => 'trending-up',
    'tone'     => 'purple',
    'keyword'  => __('Trustindex review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Reputation.com', 'reviewservicepro'),
    'category' => __('Enterprise ORM', 'reviewservicepro'),
    'slug'     => 'reputation-com',
    'icon'     => 'activity',
    'tone'     => 'purple',
    'keyword'  => __('enterprise reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('ConsumerAffairs', 'reviewservicepro'),
    'category' => __('Consumer Reviews', 'reviewservicepro'),
    'slug'     => 'consumeraffairs',
    'icon'     => 'users',
    'tone'     => 'emerald',
    'keyword'  => __('ConsumerAffairs reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Angi', 'reviewservicepro'),
    'category' => __('Home Services', 'reviewservicepro'),
    'slug'     => 'angi',
    'icon'     => 'home',
    'tone'     => 'blue',
    'keyword'  => __('Angi review monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('Zillow', 'reviewservicepro'),
    'category' => __('Real Estate', 'reviewservicepro'),
    'slug'     => 'zillow',
    'icon'     => 'building-2',
    'tone'     => 'amber',
    'keyword'  => __('Zillow reputation monitoring', 'reviewservicepro'),
  ],
  [
    'name'     => __('ProductReview', 'reviewservicepro'),
    'category' => __('Product Reviews', 'reviewservicepro'),
    'slug'     => 'productreview',
    'icon'     => 'star',
    'tone'     => 'emerald',
    'keyword'  => __('ProductReview reputation monitoring', 'reviewservicepro'),
  ],
];

$platform_rows = [
  array_slice($platforms, 0, 13),
  array_slice($platforms, 13),
];

$platform_count = count($platforms);

$tone_classes = [
  'blue' => [
    'icon' => 'bg-blue-50 text-blue-700',
    'tag'  => 'bg-blue-50 text-blue-700',
  ],
  'emerald' => [
    'icon' => 'bg-emerald-50 text-emerald-700',
    'tag'  => 'bg-emerald-50 text-emerald-700',
  ],
  'amber' => [
    'icon' => 'bg-amber-50 text-amber-700',
    'tag'  => 'bg-amber-50 text-amber-700',
  ],
  'purple' => [
    'icon' => 'bg-violet-50 text-violet-700',
    'tag'  => 'bg-violet-50 text-violet-700',
  ],
];

$feature_cards = [
  [
    'number' => '01',
    'icon'   => 'search-check',
    'tone'   => 'blue',
    'title'  => __('Google & Local Search', 'reviewservicepro'),
    'text'   => __('Important for local discovery, customer trust, maps visibility, and business credibility across Google Business Profile and Google Maps.', 'reviewservicepro'),
    'tag'    => __('Local SEO trust signal', 'reviewservicepro'),
  ],
  [
    'number' => '02',
    'icon'   => 'star',
    'tone'   => 'emerald',
    'title'  => __('Review & Rating Platforms', 'reviewservicepro'),
    'text'   => __('Useful where customers compare ratings, comments, service quality, and public feedback — including Trustpilot, Yelp, Tripadvisor, G2, Capterra, and more.', 'reviewservicepro'),
    'tag'    => __('Conversion trust', 'reviewservicepro'),
  ],
  [
    'number' => '03',
    'icon'   => 'message-square',
    'tone'   => 'purple',
    'title'  => __('Social & Brand Reputation Channels', 'reviewservicepro'),
    'text'   => __('Helpful for monitoring public feedback, comments, brand perception, customer sentiment, and social proof across social and community-driven review channels.', 'reviewservicepro'),
    'tag'    => __('Brand sentiment', 'reviewservicepro'),
  ],
];

$schema_items = [];

foreach ($platforms as $index => $platform) {
  $linked_url = rsp_get_platform_page_link($platform['slug']);

  $schema_item = [
    '@type'    => 'ListItem',
    'position' => $index + 1,
    'name'     => wp_strip_all_tags($platform['name']),
  ];

  if ($linked_url) {
    $schema_item['url'] = esc_url_raw($linked_url);
  }

  $schema_items[] = $schema_item;
}

$platform_schema = [
  '@context'        => 'https://schema.org',
  '@type'           => 'ItemList',
  'name'            => 'Review platforms monitored by ReviewService.Pro',
  'description'     => 'ReviewService.Pro monitors selected review platforms for ethical online reputation management, review monitoring, review response management, and local trust signal support.',
  'itemListElement' => $schema_items,
];
?>

<style>
  .rsp-platform-track-left {
    animation: rspPlatformMoveLeft 44s linear infinite;
  }

  .rsp-platform-track-right {
    animation: rspPlatformMoveRight 50s linear infinite;
  }

  .rsp-platform-row:hover .rsp-platform-track-left,
  .rsp-platform-row:hover .rsp-platform-track-right {
    animation-play-state: paused;
  }

  @keyframes rspPlatformMoveLeft {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-50%);
    }
  }

  @keyframes rspPlatformMoveRight {
    0% {
      transform: translateX(-50%);
    }

    100% {
      transform: translateX(0);
    }
  }

  .rsp-platform-reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 650ms ease, transform 650ms ease, box-shadow 280ms ease, border-color 280ms ease;
  }

  .rsp-platform-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-platform-feature:nth-child(1) {
    transition-delay: 0ms;
  }

  .rsp-platform-feature:nth-child(2) {
    transition-delay: 100ms;
  }

  .rsp-platform-feature:nth-child(3) {
    transition-delay: 200ms;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-platform-track-left,
    .rsp-platform-track-right {
      animation: none;
      transform: none;
      flex-wrap: wrap;
      justify-content: center;
      width: auto;
    }

    .rsp-platform-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }
  }
</style>

<section
  id="platforms-we-monitor"
  class="relative overflow-hidden border-b border-slate-200 bg-[linear-gradient(160deg,#EEF2FF_0%,#E0F2FE_45%,#ECFDF5_100%)] py-20 font-sans md:py-28"
  aria-labelledby="platforms-we-monitor-title"
  data-rsp-platforms-section>

  <!-- Background -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.045)_1px,transparent_1px)] bg-[size:52px_52px]"></div>
  <div class="pointer-events-none absolute -left-36 -top-48 z-0 h-[580px] w-[580px] rounded-full bg-blue-300/20 blur-[120px]"></div>
  <div class="pointer-events-none absolute -bottom-32 -right-28 z-0 h-[500px] w-[500px] rounded-full bg-emerald-300/20 blur-[120px]"></div>
  <div class="pointer-events-none absolute left-[58%] top-[38%] z-0 h-[300px] w-[300px] rounded-full bg-violet-300/15 blur-[110px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="rsp-platform-reveal mx-auto max-w-4xl text-center" data-rsp-platform-animate>
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 text-xs font-extrabold uppercase tracking-[0.16em] text-blue-700 shadow-sm shadow-blue-900/5">
        <i data-lucide="monitor-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Platforms We Monitor', 'reviewservicepro'); ?>
      </span>

      <h2
        id="platforms-we-monitor-title"
        class="font-sans text-[2.35rem] font-black leading-[1.12] tracking-[-0.045em] text-slate-950 sm:text-5xl lg:text-[3.55rem]">
        <?php esc_html_e('Manage reputation across the review platforms that matter most.', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-slate-600 md:text-lg">
        <?php esc_html_e('Every business does not need every platform. We select the most relevant platforms based on your industry, customer journey, priority review profiles, and monthly reputation management plan.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Counter Pills -->
    <div class="rsp-platform-reveal mt-9 flex flex-wrap justify-center gap-3" data-rsp-platform-animate>
      <div class="inline-flex items-center gap-3 rounded-full border border-blue-200 bg-white px-5 py-3 shadow-sm">
        <span class="text-xl font-black leading-none text-blue-700"><?php echo esc_html($platform_count); ?>+</span>
        <span class="h-1.5 w-1.5 rounded-full bg-blue-200"></span>
        <span class="text-sm font-bold text-slate-500"><?php esc_html_e('Platforms monitored', 'reviewservicepro'); ?></span>
      </div>

      <div class="inline-flex items-center gap-3 rounded-full border border-emerald-200 bg-white px-5 py-3 shadow-sm">
        <span class="text-xl font-black leading-none text-emerald-700"><?php esc_html_e('100%', 'reviewservicepro'); ?></span>
        <span class="h-1.5 w-1.5 rounded-full bg-emerald-200"></span>
        <span class="text-sm font-bold text-slate-500"><?php esc_html_e('Ethical workflow', 'reviewservicepro'); ?></span>
      </div>

      <div class="inline-flex items-center gap-3 rounded-full border border-amber-200 bg-white px-5 py-3 shadow-sm">
        <span class="text-xl font-black leading-none text-amber-600"><?php esc_html_e('3', 'reviewservicepro'); ?></span>
        <span class="h-1.5 w-1.5 rounded-full bg-amber-200"></span>
        <span class="text-sm font-bold text-slate-500"><?php esc_html_e('Monthly plan tiers', 'reviewservicepro'); ?></span>
      </div>
    </div>

    <!-- AEO / SEO Answer Block -->
    <div class="rsp-platform-reveal mx-auto mt-8 max-w-4xl rounded-[1.75rem] border border-blue-200 bg-white/85 p-6 text-left shadow-sm backdrop-blur-xl" data-rsp-platform-animate>
      <h3 class="flex items-center gap-2 font-sans text-xl font-black tracking-[-0.02em] text-slate-950">
        <i data-lucide="search-check" class="h-5 w-5 text-blue-700" aria-hidden="true"></i>
        <?php esc_html_e('Which review platforms should a business monitor?', 'reviewservicepro'); ?>
      </h3>

      <p class="mt-3 text-base leading-8 text-slate-600">
        <?php esc_html_e('A business should monitor the review platforms that influence its customer decisions. Local businesses often prioritize Google Business Profile, Google Maps, Facebook, Yelp, and Tripadvisor. B2B and software brands may need Trustpilot, G2, Capterra, Clutch, or Reviews.io. ReviewService.Pro helps choose the right platform mix instead of using a generic checklist.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Marquee Rows -->
    <div class="rsp-platform-reveal mt-12 flex flex-col gap-4" data-rsp-platform-animate>
      <?php foreach ($platform_rows as $row_index => $row_platforms) : ?>
        <?php
        $direction_class = 0 === $row_index ? 'rsp-platform-track-left' : 'rsp-platform-track-right';
        $row_label       = 0 === $row_index
          ? __('Review platforms row one', 'reviewservicepro')
          : __('Review platforms row two', 'reviewservicepro');
        ?>

        <div
          class="rsp-platform-row overflow-hidden rounded-[1.75rem] border border-white/80 bg-white/75 py-4 shadow-sm backdrop-blur-xl [mask-image:linear-gradient(to_right,transparent,#000_9%,#000_91%,transparent)] [-webkit-mask-image:linear-gradient(to_right,transparent,#000_9%,#000_91%,transparent)]"
          role="list"
          aria-label="<?php echo esc_attr($row_label); ?>">

          <div class="<?php echo esc_attr($direction_class); ?> flex w-max gap-3 will-change-transform">
            <?php for ($copy = 0; $copy < 2; $copy++) : ?>
              <?php foreach ($row_platforms as $platform) : ?>
                <?php
                $tone          = $tone_classes[$platform['tone']] ?? $tone_classes['blue'];
                $platform_link = rsp_get_platform_page_link($platform['slug']);
                $is_duplicate  = $copy > 0;
                ?>

                <?php if ($platform_link && ! $is_duplicate) : ?>
                  <a
                    href="<?php echo esc_url($platform_link); ?>"
                    class="inline-flex items-center gap-3 whitespace-nowrap rounded-[1.1rem] border border-blue-900/10 bg-white px-4 py-3 transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-900/10"
                    role="listitem"
                    aria-label="<?php echo esc_attr($platform['keyword']); ?>">
                  <?php else : ?>
                    <span
                      class="inline-flex items-center gap-3 whitespace-nowrap rounded-[1.1rem] border border-blue-900/10 bg-white px-4 py-3 transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-900/10"
                      role="<?php echo $is_duplicate ? 'presentation' : 'listitem'; ?>"
                      <?php echo $is_duplicate ? 'aria-hidden="true"' : 'aria-label="' . esc_attr($platform['keyword']) . '"'; ?>>
                    <?php endif; ?>

                    <span class="<?php echo esc_attr($tone['icon']); ?> flex h-9 w-9 shrink-0 items-center justify-center rounded-xl">
                      <i data-lucide="<?php echo esc_attr($platform['icon']); ?>" class="h-4 w-4" aria-hidden="true"></i>
                    </span>

                    <span>
                      <span class="block text-sm font-black leading-tight text-slate-950">
                        <?php echo esc_html($platform['name']); ?>
                      </span>

                      <span class="block text-[10px] font-extrabold uppercase tracking-[0.10em] text-slate-400">
                        <?php echo esc_html($platform['category']); ?>
                      </span>
                    </span>

                    <?php if ($platform_link && ! $is_duplicate) : ?>
                  </a>
                <?php else : ?>
                  </span>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endfor; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Stats Bar -->
    <div class="rsp-platform-reveal mt-9 grid grid-cols-1 overflow-hidden rounded-[1.75rem] border border-blue-200 bg-white shadow-sm md:grid-cols-3" data-rsp-platform-animate>
      <div class="border-b border-blue-100 p-7 md:border-b-0 md:border-r">
        <p class="font-sans text-4xl font-black leading-none tracking-[-0.04em] text-blue-700">
          <?php echo esc_html($platform_count); ?>+
        </p>
        <p class="mt-2 text-base font-black text-slate-700">
          <?php esc_html_e('Review platforms covered', 'reviewservicepro'); ?>
        </p>
        <p class="mt-1 text-sm leading-6 text-slate-400">
          <?php esc_html_e('From Google to industry-specific review directories', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="border-b border-blue-100 p-7 md:border-b-0 md:border-r">
        <p class="font-sans text-4xl font-black leading-none tracking-[-0.04em] text-blue-700">
          <?php esc_html_e('3', 'reviewservicepro'); ?>
        </p>
        <p class="mt-2 text-base font-black text-slate-700">
          <?php esc_html_e('Platform categories', 'reviewservicepro'); ?>
        </p>
        <p class="mt-1 text-sm leading-6 text-slate-400">
          <?php esc_html_e('Local search · Rating platforms · Social/brand channels', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="p-7">
        <p class="font-sans text-4xl font-black leading-none tracking-[-0.04em] text-blue-700">
          <?php esc_html_e('1', 'reviewservicepro'); ?>
        </p>
        <p class="mt-2 text-base font-black text-slate-700">
          <?php esc_html_e('Strategy built around you', 'reviewservicepro'); ?>
        </p>
        <p class="mt-1 text-sm leading-6 text-slate-400">
          <?php esc_html_e('Not a generic checklist for every business', 'reviewservicepro'); ?>
        </p>
      </div>
    </div>

    <!-- Feature Cards -->
    <div class="mt-7 grid grid-cols-1 gap-5 lg:grid-cols-3">
      <?php foreach ($feature_cards as $card) : ?>
        <?php $tone = $tone_classes[$card['tone']] ?? $tone_classes['blue']; ?>

        <article
          class="rsp-platform-reveal rsp-platform-feature group relative overflow-hidden rounded-[1.75rem] border border-blue-900/10 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-900/10"
          data-rsp-platform-animate>

          <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-blue-300/20 opacity-0 blur-3xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <p class="text-xs font-extrabold uppercase tracking-[0.14em] text-slate-300">
            <?php echo esc_html($card['number']); ?>
          </p>

          <div class="<?php echo esc_attr($tone['icon']); ?> mt-5 flex h-14 w-14 items-center justify-center rounded-2xl transition-all duration-300 group-hover:scale-105 group-hover:-rotate-3">
            <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
          </div>

          <h3 class="mt-5 font-sans text-xl font-black leading-tight tracking-[-0.02em] text-slate-950">
            <?php echo esc_html($card['title']); ?>
          </h3>

          <p class="mt-3 text-base leading-8 text-slate-600">
            <?php echo esc_html($card['text']); ?>
          </p>

          <span class="<?php echo esc_attr($tone['tag']); ?> mt-5 inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-extrabold">
            <i data-lucide="check" class="h-3.5 w-3.5" aria-hidden="true"></i>
            <?php echo esc_html($card['tag']); ?>
          </span>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Strategy Band -->
    <div class="rsp-platform-reveal mt-8 overflow-hidden rounded-[2rem] bg-[linear-gradient(135deg,#1E3A8A_0%,#1D4ED8_55%,#2563EB_100%)] shadow-2xl shadow-blue-900/25" data-rsp-platform-animate>
      <div class="relative">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.10)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="pointer-events-none absolute right-[5%] top-[-160px] h-[420px] w-[420px] rounded-full bg-white/10 blur-[100px]"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-[1fr_360px]">
          <div class="p-6 md:p-10 lg:p-12">
            <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.12em] text-white/85">
              <i data-lucide="radar" class="h-4 w-4" aria-hidden="true"></i>
              <?php esc_html_e('Platform Selection Strategy', 'reviewservicepro'); ?>
            </span>

            <h3 class="max-w-2xl font-sans text-3xl font-black leading-tight tracking-[-0.03em] text-white md:text-4xl">
              <?php esc_html_e('We choose platforms based on your business, not a generic checklist.', 'reviewservicepro'); ?>
            </h3>

            <p class="mt-5 max-w-3xl text-base leading-8 text-white/70">
              <?php esc_html_e('A restaurant may need Google, Facebook, Yelp, and Tripadvisor. An ecommerce brand may need Trustpilot, Reviews.io, G2, or marketplace-related profiles. A clinic, law firm, agency, or local service business may need a different platform mix. Your plan should match your real customer journey.', 'reviewservicepro'); ?>
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
              <?php
              $industry_tags = [
                __('Restaurant & Hospitality', 'reviewservicepro'),
                __('Healthcare & Clinics', 'reviewservicepro'),
                __('Ecommerce & SaaS', 'reviewservicepro'),
                __('Agencies & Local Services', 'reviewservicepro'),
              ];
              ?>

              <?php foreach ($industry_tags as $tag) : ?>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-bold text-white/90">
                  <i data-lucide="shield-check" class="h-4 w-4 text-white/55" aria-hidden="true"></i>
                  <?php echo esc_html($tag); ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="border-t border-white/10 bg-white/10 p-6 backdrop-blur-lg md:p-8 lg:border-l lg:border-t-0 lg:p-10">
            <div class="border-b border-white/10 py-5">
              <p class="font-sans text-4xl font-black leading-none tracking-[-0.04em] text-white">
                <?php echo esc_html($platform_count); ?>+
              </p>
              <p class="mt-2 text-sm font-semibold text-white/60">
                <?php esc_html_e('Platforms we actively monitor', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="border-b border-white/10 py-5">
              <p class="font-sans text-4xl font-black leading-none tracking-[-0.04em] text-white">
                <?php esc_html_e('2–10', 'reviewservicepro'); ?>
              </p>
              <p class="mt-2 text-sm font-semibold text-white/60">
                <?php esc_html_e('Platforms per monthly plan', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="py-5">
              <p class="font-sans text-4xl font-black leading-none tracking-[-0.04em] text-white">
                <?php esc_html_e('100%', 'reviewservicepro'); ?>
              </p>
              <p class="mt-2 text-sm font-semibold text-white/60">
                <?php esc_html_e('Platform-compliant workflow', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="mt-3 flex flex-col gap-3">
              <a
                href="<?php echo esc_url($platform_audit_url); ?>"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-6 py-4 text-sm font-black text-blue-700 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:bg-blue-50">
                <?php esc_html_e('Request Platform Audit', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
              </a>

              <a
                href="<?php echo esc_url($monthly_plans_url); ?>"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/15 bg-white/10 px-6 py-4 text-sm font-black text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white/15">
                <?php esc_html_e('Compare Monthly Plans', 'reviewservicepro'); ?>
                <i data-lucide="calendar-check" class="h-5 w-5" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Compliance Note -->
    <div class="rsp-platform-reveal mt-8 rounded-[1.75rem] border border-emerald-200 bg-emerald-50 p-6 shadow-sm md:p-7" data-rsp-platform-animate>
      <div class="flex flex-col gap-4 md:flex-row md:items-start">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-emerald-700 shadow-sm">
          <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
        </div>

        <div>
          <h3 class="font-sans text-xl font-black text-slate-950">
            <?php esc_html_e('Ethical platform monitoring only.', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-2 text-base leading-8 text-emerald-900">
            <?php esc_html_e('ReviewService.Pro helps monitor, document, respond, report, and improve reputation signals using platform-compliant methods. We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed review removal, or guaranteed ranking outcomes.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-4 flex flex-wrap gap-3">
            <a
              href="<?php echo esc_url($pricing_url); ?>"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-black text-emerald-700 transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-100">
              <?php esc_html_e('View Pricing Options', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>

            <?php if ($platform_archive) : ?>
              <a
                href="<?php echo esc_url($platform_archive); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-700 transition-all duration-300 hover:-translate-y-1 hover:bg-slate-50">
                <?php esc_html_e('View Platform Guides', 'reviewservicepro'); ?>
                <i data-lucide="external-link" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($platform_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
  (function() {
    function initPlatformsSection() {
      var root = document.querySelector('[data-rsp-platforms-section]');

      if (!root) {
        return;
      }

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = root.querySelectorAll('[data-rsp-platform-animate]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformRevealed === 'true') {
          return;
        }

        item.dataset.rspPlatformRevealed = 'true';
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
      document.addEventListener('DOMContentLoaded', initPlatformsSection);
    } else {
      initPlatformsSection();
    }
  })();
</script>