<?php

/**
 * Front Page Template
 *
 * ReviewService.Pro — Home page section loader.
 *
 * File: front-page.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();
?>

<main
  id="primary"
  class="relative overflow-hidden bg-white text-[#334155]"
  role="main">

  <?php
  get_template_part('template-parts/sections/home/hero');
  get_template_part('template-parts/sections/home/trust-signals');
  get_template_part('template-parts/sections/home/problem');
  get_template_part('template-parts/sections/home/services-overview');
  get_template_part('template-parts/sections/home/industries');
  get_template_part('template-parts/sections/home/reporting-preview');
  get_template_part('template-parts/sections/home/case-studies-preview');
  get_template_part('template-parts/sections/home/academy-preview');
  get_template_part('template-parts/sections/home/faq');
  get_template_part('template-parts/sections/home/final-cta');
  ?>

</main>

<?php
get_footer();
