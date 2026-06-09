<?php

/**
 * Template Name: ORM Services Page
 * Template Post Type: page
 *
 * ReviewService.Pro — Online Reputation Management Services Page
 *
 * Funnel:
 * Services Page
 * → Monthly Plan / One-Time Package
 * → Direct Checkout
 * → Payment
 * → Client Portal
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();
?>

<div id="services-page" class="site-main bg-white">

  <?php
  /**
   * Section 01: Hero
   *
   * Purpose:
   * - Attention Gravity
   * - Trust Friction Reduction
   * - Action Force
   */
  get_template_part('template-parts/sections/services/hero');
  get_template_part('template-parts/sections/services/trust-bar');
  get_template_part('template-parts/sections/services/problem');
  get_template_part('template-parts/sections/services/orm-system');
  get_template_part('template-parts/sections/services/monthly-plans');
  get_template_part('template-parts/sections/services/platforms');
  get_template_part('template-parts/sections/services/process');
  get_template_part('template-parts/sections/services/client-portal-preview');
  get_template_part('template-parts/sections/services/trust-compliance');
  get_template_part('template-parts/sections/services/faq');
  get_template_part('template-parts/sections/services/final-cta');


  /**
   * Next sections will be added one by one:
   *
   * get_template_part('template-parts/sections/services/trust-bar');
   * get_template_part('template-parts/sections/services/problem');
   * get_template_part('template-parts/sections/services/orm-system');
   * get_template_part('template-parts/sections/services/monthly-plans');
   * get_template_part('template-parts/sections/services/one-time-packages');
   * get_template_part('template-parts/sections/services/platforms');
   * get_template_part('template-parts/sections/services/process');
   * get_template_part('template-parts/sections/services/client-portal-preview');
   * get_template_part('template-parts/sections/services/trust-compliance');
   * get_template_part('template-parts/sections/services/faq');
   * get_template_part('template-parts/sections/services/final-cta');
   */
  ?>

</div>

<?php
get_footer();
