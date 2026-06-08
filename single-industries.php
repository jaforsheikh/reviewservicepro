<?php

/**
 * Single Industry Template
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
  class="relative overflow-hidden bg-[#07111F] text-white"
  role="main">
  <?php if (have_posts()) : ?>

    <?php
    while (have_posts()) :
      the_post();

      $post_id = get_the_ID();
    ?>

      <article
        id="post-<?php echo esc_attr($post_id); ?>"
        <?php post_class('single-industry-page relative overflow-hidden', $post_id); ?>>
        <?php
        get_template_part('template-parts/industries/industry', 'hero');
        get_template_part('template-parts/industries/industry', 'overview');
        get_template_part('template-parts/industries/industry', 'problems');
        get_template_part('template-parts/industries/industry', 'content');
        get_template_part('template-parts/industries/industry', 'related');
        get_template_part('template-parts/industries/industry', 'cta');
        ?>
      </article>

    <?php endwhile; ?>

  <?php else : ?>

    <section class="relative py-24" aria-labelledby="industry-not-found-title">
      <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">

        <div class="mx-auto max-w-2xl rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-10">
          <div class="mb-6 inline-flex h-16 w-16 items-center justify-center rounded-2xl border border-red-500/20 bg-red-500/10 text-red-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('triangle-alert', 'h-7 w-7')) : ''; ?>
          </div>

          <h1 id="industry-not-found-title" class="text-3xl font-extrabold tracking-tight text-white md:text-4xl">
            <?php esc_html_e('Industry not found', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 text-base leading-8 text-slate-400">
            <?php esc_html_e('The requested industry page could not be found or may no longer be available.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-8">
            <a
              href="<?php echo esc_url(home_url('/industries/')); ?>"
              class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-left', 'h-4 w-4')) : ''; ?>
              <?php esc_html_e('Browse Industries', 'reviewservicepro'); ?>
            </a>
          </div>
        </div>

      </div>
    </section>

  <?php endif; ?>
</main>

<?php
get_footer();
