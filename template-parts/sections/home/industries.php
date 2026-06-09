<?php

/**
 * Industries Section
 *
 * File: template-parts/sections/home/industries.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$industries = [
  [
    'number' => '01',
    'icon'   => '🍽️',
    'color'  => '#4285F4',
    'span'   => true,
    'title'  => get_theme_mod('ind_1_title', 'Restaurants & Food Businesses'),
    'desc'   => get_theme_mod('ind_1_desc', 'Reviews directly drive walk-ins and delivery orders. We help restaurants build consistent ratings across Google, Yelp, Tripadvisor and Facebook.'),
    'stat'   => get_theme_mod('ind_1_stat', 'Review trust growth'),
    'slug'   => 'restaurants',
  ],
  [
    'number' => '02',
    'icon'   => '🏨',
    'color'  => '#10b981',
    'span'   => false,
    'title'  => get_theme_mod('ind_2_title', 'Hotels & Hospitality'),
    'desc'   => get_theme_mod('ind_2_desc', 'OTA review management across Booking.com, Tripadvisor, Google Hotels, and hospitality review platforms.'),
    'stat'   => get_theme_mod('ind_2_stat', 'Review volume improved'),
    'slug'   => 'hotels',
  ],
  [
    'number' => '03',
    'icon'   => '🏥',
    'color'  => '#f97316',
    'span'   => false,
    'title'  => get_theme_mod('ind_3_title', 'Clinics & Healthcare'),
    'desc'   => get_theme_mod('ind_3_desc', 'Privacy-aware reputation management for clinics, healthcare practices, and patient-trust driven brands.'),
    'stat'   => get_theme_mod('ind_3_stat', 'Patient trust support'),
    'slug'   => 'clinics',
  ],
  [
    'number' => '04',
    'icon'   => '⚖️',
    'color'  => '#8b5cf6',
    'span'   => false,
    'title'  => get_theme_mod('ind_4_title', 'Law Firms'),
    'desc'   => get_theme_mod('ind_4_desc', 'Credibility-focused ORM strategies for legal professionals where trust and authority matter.'),
    'stat'   => get_theme_mod('ind_4_stat', 'Authority positioning'),
    'slug'   => 'law-firms',
  ],
  [
    'number' => '05',
    'icon'   => '🏠',
    'color'  => '#06b6d4',
    'span'   => false,
    'title'  => get_theme_mod('ind_5_title', 'Real Estate'),
    'desc'   => get_theme_mod('ind_5_desc', 'Build buyer, seller, and investor trust through strategic review visibility and reputation signals.'),
    'stat'   => get_theme_mod('ind_5_stat', 'Local trust visibility'),
    'slug'   => 'real-estate',
  ],
  [
    'number' => '06',
    'icon'   => '🛒',
    'color'  => '#d6a84f',
    'span'   => true,
    'title'  => get_theme_mod('ind_6_title', 'Ecommerce & Retail'),
    'desc'   => get_theme_mod('ind_6_desc', 'Trustpilot, Google Shopping, product review, marketplace, and multi-platform reputation systems.'),
    'stat'   => get_theme_mod('ind_6_stat', 'Review ecosystem support'),
    'slug'   => 'ecommerce',
  ],
];
?>

<section
  id="industries"
  class="relative overflow-hidden border-t border-white/[0.05] bg-[#07111F] py-20 md:py-28"
  role="region"
  aria-label="<?php echo esc_attr__('Industries We Serve', 'reviewservicepro'); ?>">
  <div
    class="pointer-events-none absolute inset-0 z-0"
    style="background-image: radial-gradient(rgba(37,99,235,0.16) 1px, transparent 1px); background-size:24px 24px;"></div>

  <div class="pointer-events-none absolute -top-20 left-1/2 z-0 h-[400px] w-[600px] -translate-x-1/2 rounded-full bg-blue-600/[0.12] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mx-auto mb-14 max-w-3xl text-center">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/30 bg-blue-600/10 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.12em] text-blue-400">
        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-blue-500"></span>
        <?php esc_html_e('Industries We Serve', 'reviewservicepro'); ?>
      </span>

      <h2 class="mb-5 text-3xl font-extrabold leading-tight tracking-tight text-white! md:text-5xl">
        <span class="block text-base font-normal text-slate-500 md:text-lg">
          <?php esc_html_e('Trusted by businesses across', 'reviewservicepro'); ?>
        </span>

        <?php esc_html_e('Every Industry That Values Trust', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto max-w-2xl text-sm leading-relaxed text-slate-400 md:text-base">
        <?php esc_html_e('From restaurants to law firms — we help brands strengthen visibility, customer trust, and long-term online reputation.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($industries as $industry) : ?>
        <?php
        $col_span = ! empty($industry['span']) ? 'lg:col-span-2' : 'lg:col-span-1';

        $industry_post = get_page_by_path(sanitize_title($industry['slug']), OBJECT, 'industries');
        $industry_url  = $industry_post ? get_permalink($industry_post->ID) : home_url('/industries/');
        ?>

        <a
          href="<?php echo esc_url($industry_url); ?>"
          class="<?php echo esc_attr($col_span); ?> group relative overflow-hidden rounded-3xl border border-white/[0.08] bg-white/[0.03] p-6 transition-all duration-300 hover:-translate-y-1 hover:border-white/[0.14]"
          aria-label="<?php echo esc_attr(sprintf(__('Learn more about %s reputation management', 'reviewservicepro'), $industry['title'])); ?>">
          <div
            class="absolute inset-x-0 top-0 h-[2px]"
            style="background:linear-gradient(to right, <?php echo esc_attr($industry['color']); ?>, transparent);"></div>

          <div
            class="absolute -bottom-10 -right-10 h-32 w-32 rounded-full opacity-20 blur-[50px]"
            style="background:<?php echo esc_attr($industry['color']); ?>;"></div>

          <div class="relative z-10">
            <div
              class="mb-4 text-4xl transition-transform duration-300 group-hover:scale-110"
              role="img"
              aria-label="<?php echo esc_attr($industry['title']); ?>">
              <?php echo esc_html($industry['icon']); ?>
            </div>

            <h3 class="mb-3 text-lg font-bold leading-snug text-white">
              <?php echo esc_html($industry['title']); ?>
            </h3>

            <p class="mb-5 text-sm leading-relaxed text-slate-400">
              <?php echo esc_html($industry['desc']); ?>
            </p>

            <div class="flex items-center justify-between gap-4">
              <span
                class="inline-flex rounded-full border border-white/[0.08] bg-white/[0.04] px-3 py-1 text-xs font-semibold"
                style="color:<?php echo esc_attr($industry['color']); ?>;">
                <?php echo esc_html($industry['stat']); ?>
              </span>

              <span
                class="text-sm font-medium"
                style="color:<?php echo esc_attr($industry['color']); ?>;"
                aria-hidden="true">
                <?php esc_html_e('Learn More', 'reviewservicepro'); ?> →
              </span>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="mt-12 text-center">
      <a href="<?php echo esc_url(home_url('/industries/')); ?>" class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.10] bg-white/[0.04] px-6 py-3 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40 hover:bg-white/[0.07]">
        <?php esc_html_e('View All Industries', 'reviewservicepro'); ?>
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4')) : ''; ?>
      </a>
    </div>

  </div>
</section>