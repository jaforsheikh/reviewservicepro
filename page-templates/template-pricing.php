<?php

/**
 * Template Name: Pricing Page
 * Template Post Type: page
 *
 * File: page-templates/template-pricing.php
 *
 * ReviewService.Pro — Pricing Page Template
 *
 * Purpose:
 * - Pricing page is for One-Time ORM Packages, Platform Checks, ORM Add-ons,
 *   and smaller orderable reputation services.
 * - Services page remains for Monthly ORM subscription plans.
 * - Product cards will be loaded dynamically from WooCommerce products by category.
 *
 * Pricing Page UI:
 * - White / light premium SaaS layout
 * - Dark navy text
 * - Blue CTA
 * - Green trust accent
 * - Clean card grid support
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

/**
 * Helper: safely render pricing section template part.
 *
 * This allows us to build the Pricing page section-by-section without fatal errors.
 *
 * @param string $section Section file name without .php.
 * @param array  $args    Arguments passed to the section.
 *
 * @return void
 */
if (! function_exists('rsp_render_pricing_section')) {
  function rsp_render_pricing_section($section, $args = [])
  {
    $section = sanitize_file_name((string) $section);

    if ('' === $section) {
      return;
    }

    $template_path = 'template-parts/sections/pricing/' . $section . '.php';

    if (locate_template($template_path)) {
      get_template_part(
        'template-parts/sections/pricing/' . $section,
        null,
        is_array($args) ? $args : []
      );

      return;
    }

    if (defined('WP_DEBUG') && WP_DEBUG) {
      echo "\n" . '<!-- Missing pricing section: ' . esc_html($template_path) . ' -->' . "\n";
    }
  }
}

/**
 * Shared Pricing Page Context
 *
 * These values will be available inside all pricing section files.
 */
$pricing_context = [
  'page_type' => 'one_time_pricing',

  /**
   * Page direction:
   * Pricing page = one-time packages / platform checks / small orderable services.
   * Services page = monthly ORM subscriptions.
   */
  'services_page_url' => home_url('/services/'),
  'contact_url'       => home_url('/contact/?type=pricing-help'),
  'audit_url'         => home_url('/contact/?type=audit'),

  /**
   * WooCommerce category slugs.
   *
   * Products assigned to these categories will be shown dynamically later.
   */
  'categories' => [
    'one_time_packages'          => 'one-time-orm-packages',
    'platform_checks'            => 'platform-checks',
    'addons'                     => 'orm-add-ons',
    'small_reputation_services'  => 'small-reputation-services',
  ],

  /**
   * Core compliance-safe note.
   */
  'compliance_note' => __(
    'ReviewService.Pro provides ethical online reputation management services. We do not offer fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or guaranteed ranking outcomes. Our work focuses on review monitoring, professional response support, documentation, genuine feedback workflows, platform-compliant reporting, and transparent reputation improvement.',
    'reviewservicepro'
  ),

  /**
   * Brand colors for consistency across section files.
   */
  'colors' => [
    'dark_text'    => '#020617',
    'navy_text'    => '#07111F',
    'blue'         => '#2563EB',
    'blue_light'   => '#3B82F6',
    'green'        => '#00C853',
    'teal'         => '#14B8A6',
    'amber'        => '#FFC107',
    'light_bg'     => '#F8FAFC',
    'white'        => '#FFFFFF',
  ],
];

/**
 * WebPage schema for Pricing page.
 */
$pricing_schema = [
  '@context'    => 'https://schema.org',
  '@type'       => 'WebPage',
  'name'        => get_the_title() ? get_the_title() : 'Pricing',
  'url'         => get_permalink(),
  'description' => 'One-time online reputation management packages, platform checks, and small orderable reputation services from ReviewService.Pro.',
  'isPartOf'    => [
    '@type' => 'WebSite',
    'name'  => 'ReviewService.Pro',
    'url'   => home_url('/'),
  ],
  'about'       => [
    '@type' => 'Service',
    'name'  => 'One-Time Online Reputation Management Packages',
  ],
];

/**
 * Breadcrumb schema.
 */
$breadcrumb_schema = [
  '@context'        => 'https://schema.org',
  '@type'           => 'BreadcrumbList',
  'itemListElement' => [
    [
      '@type'    => 'ListItem',
      'position' => 1,
      'name'     => 'Home',
      'item'     => home_url('/'),
    ],
    [
      '@type'    => 'ListItem',
      'position' => 2,
      'name'     => 'Pricing',
      'item'     => get_permalink(),
    ],
  ],
];
?>

<style>
  /**
   * ReviewService.Pro Pricing Page Base Styles
   * White / light SaaS UI.
   */

  #pricing-page {
    color: #020617;
    background:
      radial-gradient(circle at 16% 8%, rgba(37, 99, 235, 0.10), transparent 34%),
      radial-gradient(circle at 86% 18%, rgba(0, 200, 83, 0.10), transparent 30%),
      linear-gradient(180deg, #ffffff 0%, #f8fafc 48%, #ffffff 100%);
  }

  .rsp-pricing-page-grid {
    background-image:
      linear-gradient(rgba(37, 99, 235, 0.055) 1px, transparent 1px),
      linear-gradient(90deg, rgba(37, 99, 235, 0.055) 1px, transparent 1px);
    background-size: 52px 52px;
    mask-image: linear-gradient(to bottom, black 0%, black 78%, transparent 100%);
    -webkit-mask-image: linear-gradient(to bottom, black 0%, black 78%, transparent 100%);
  }

  .rsp-pricing-page-glow-blue {
    animation: rspPricingPageGlowMoveBlue 10s ease-in-out infinite alternate;
  }

  .rsp-pricing-page-glow-green {
    animation: rspPricingPageGlowMoveGreen 11s ease-in-out infinite alternate;
  }

  @keyframes rspPricingPageGlowMoveBlue {
    0% {
      transform: translate3d(0, 0, 0) scale(1);
      opacity: 0.72;
    }

    100% {
      transform: translate3d(18px, 12px, 0) scale(1.05);
      opacity: 0.95;
    }
  }

  @keyframes rspPricingPageGlowMoveGreen {
    0% {
      transform: translate3d(0, 0, 0) scale(1);
      opacity: 0.6;
    }

    100% {
      transform: translate3d(-18px, 16px, 0) scale(1.06);
      opacity: 0.88;
    }
  }

  .rsp-pricing-section-shell {
    position: relative;
    z-index: 10;
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-pricing-page-glow-blue,
    .rsp-pricing-page-glow-green {
      animation: none;
    }
  }
</style>

<section
  id="pricing-page"
  class="relative overflow-hidden font-sans"
  aria-label="<?php esc_attr_e('ReviewService.Pro pricing page', 'reviewservicepro'); ?>">

  <!-- White pricing page background system -->
  <div class="rsp-pricing-page-grid pointer-events-none absolute inset-0 z-0"></div>

  <div
    class="rsp-pricing-page-glow-blue pointer-events-none absolute -left-40 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-500/[0.12] blur-[125px]"
    aria-hidden="true"></div>

  <div
    class="rsp-pricing-page-glow-green pointer-events-none absolute -right-40 top-72 z-0 h-[520px] w-[520px] rounded-full bg-[#00C853]/[0.12] blur-[125px]"
    aria-hidden="true"></div>

  <div
    class="pointer-events-none absolute bottom-32 left-1/2 z-0 h-[420px] w-[720px] -translate-x-1/2 rounded-full bg-[#14B8A6]/[0.08] blur-[135px]"
    aria-hidden="true"></div>

  <div class="rsp-pricing-section-shell">

    <?php
    /**
     * Pricing page sections.
     *
     * We will update/build these one by one using the white UI system:
     *
     * template-parts/sections/pricing/hero.php
     * template-parts/sections/pricing/trust-bar.php
     * template-parts/sections/pricing/main-packages.php
     * template-parts/sections/pricing/platform-checks.php
     * template-parts/sections/pricing/add-ons.php
     * template-parts/sections/pricing/help-choosing.php
     * template-parts/sections/pricing/how-it-works.php
     * template-parts/sections/pricing/after-payment.php
     * template-parts/sections/pricing/ethical-policy.php
     * template-parts/sections/pricing/faq.php
     * template-parts/sections/pricing/final-cta.php
     */

    rsp_render_pricing_section('hero', $pricing_context);
    rsp_render_pricing_section('trust-bar', $pricing_context);
    rsp_render_pricing_section('main-packages', $pricing_context);
    rsp_render_pricing_section('platform-checks', $pricing_context);
    rsp_render_pricing_section('add-ons', $pricing_context);
    rsp_render_pricing_section('help-choosing', $pricing_context);
    rsp_render_pricing_section('how-it-works', $pricing_context);
    rsp_render_pricing_section('after-payment', $pricing_context);
    rsp_render_pricing_section('ethical-policy', $pricing_context);
    rsp_render_pricing_section('faq', $pricing_context);
    rsp_render_pricing_section('final-cta', $pricing_context);
    ?>

  </div>
</section>

<script type="application/ld+json">
  <?php echo wp_json_encode($pricing_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script type="application/ld+json">
  <?php echo wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<?php
/**
 * header.php opens <main id="primary">, so this template closes it.
 */
?>
</main>

<?php get_footer(); ?>