<?php

/**
 * Default Archive Template
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$archive_title = get_the_archive_title();
$archive_desc  = get_the_archive_description();

if (empty($archive_title)) {
  $archive_title = __('ORM Academy Archive', 'reviewservicepro');
}
?>

<main id="primary" class="relative overflow-hidden bg-[#07111F] text-white" role="main">

  <section class="relative overflow-hidden border-b border-white/[0.05] bg-[#07111F] py-20 md:py-28">
    <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="pointer-events-none absolute -top-20 left-1/2 z-0 h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-blue-600/[0.15] blur-[140px]"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[400px] w-[500px] rounded-full bg-emerald-500/[0.08] blur-[120px]"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">

        <?php if (function_exists('rsp_breadcrumb')) : ?>
          <div class="mb-8 flex justify-center">
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('archive', 'h-3.5 w-3.5')) : ''; ?>
          <?php esc_html_e('Archive', 'reviewservicepro'); ?>
        </span>

        <h1 class="text-4xl font-extrabold leading-tight tracking-tight text-white md:text-6xl">
          <?php echo wp_kses_post($archive_title); ?>
        </h1>

        <?php if (! empty($archive_desc)) : ?>
          <div class="mx-auto mt-6 max-w-2xl text-base leading-8 text-slate-400 md:text-lg">
            <?php echo wp_kses_post($archive_desc); ?>
          </div>
        <?php else : ?>
          <p class="mx-auto mt-6 max-w-2xl text-base leading-8 text-slate-400 md:text-lg">
            <?php esc_html_e('Explore practical articles, guides, insights, and strategies from ReviewService.Pro about reputation management, reviews, customer trust, and ethical ORM systems.', 'reviewservicepro'); ?>
          </p>
        <?php endif; ?>

      </div>
    </div>
  </section>

  <section class="relative overflow-hidden border-t border-white/[0.05] bg-[#0B1220] py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

      <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('book-open-text', 'h-3.5 w-3.5')) : ''; ?>
            <?php esc_html_e('Knowledge Library', 'reviewservicepro'); ?>
          </span>

          <h2 class="text-3xl font-extrabold tracking-tight text-white md:text-4xl">
            <?php esc_html_e('Browse latest resources', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-400">
            <?php esc_html_e('Read practical ORM guides covering review platforms, response strategy, customer feedback systems, trust signals, and online reputation growth.', 'reviewservicepro'); ?>
          </p>
        </div>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="w-full max-w-md">
          <label for="archive-search" class="sr-only">
            <?php esc_html_e('Search articles', 'reviewservicepro'); ?>
          </label>

          <div class="relative">
            <input
              id="archive-search"
              type="search"
              name="s"
              placeholder="<?php esc_attr_e('Search ORM resources...', 'reviewservicepro'); ?>"
              class="w-full rounded-2xl border border-white/[0.10] bg-white/[0.04] px-5 py-4 pr-14 text-sm text-white placeholder:text-slate-500 focus:border-blue-500/50 focus:outline-none focus:ring-4 focus:ring-blue-500/10">

            <button type="submit" class="absolute right-2 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-xl bg-blue-600 text-white transition-colors duration-200 hover:bg-blue-700">
              <span class="sr-only"><?php esc_html_e('Search', 'reviewservicepro'); ?></span>
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search', 'h-4 w-4')) : ''; ?>
            </button>
          </div>
        </form>
      </div>

      <?php if (have_posts()) : ?>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          while (have_posts()) :
            the_post();

            get_template_part('template-parts/cards/blog', 'card');
          endwhile;
          ?>
        </div>

        <div class="mt-14">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
              'next_text'          => esc_html__('Next', 'reviewservicepro'),
              'screen_reader_text' => esc_html__('Archive navigation', 'reviewservicepro'),
              'class'              => 'rsp-pagination',
            ]
          );
          ?>
        </div>

      <?php else : ?>

        <div class="mx-auto max-w-3xl rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-10 text-center">
          <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full border border-blue-500/20 bg-blue-600/10">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('archive-x', 'h-10 w-10 text-blue-400')) : ''; ?>
          </div>

          <h2 class="text-3xl font-extrabold text-white">
            <?php esc_html_e('No posts found.', 'reviewservicepro'); ?>
          </h2>

          <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-slate-400">
            <?php esc_html_e('There are no articles available in this archive yet.', 'reviewservicepro'); ?>
          </p>

          <a
            href="<?php echo esc_url(home_url('/orm-academy/')); ?>"
            class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-6 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('book-open', 'h-4 w-4')) : ''; ?>
            <?php esc_html_e('Browse ORM Academy', 'reviewservicepro'); ?>
          </a>
        </div>

      <?php endif; ?>

    </div>
  </section>

  <section class="relative overflow-hidden border-t border-white/[0.05] bg-[#031827] py-20 md:py-24">
    <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
      <h2 class="text-3xl font-extrabold leading-tight text-white md:text-5xl">
        <?php esc_html_e('Need help improving your reputation?', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-slate-300">
        <?php esc_html_e('Get a free reputation audit and discover what is hurting your online trust, visibility, and customer conversion rate.', 'reviewservicepro'); ?>
      </p>

      <a
        href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>"
        class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-emerald-500 px-8 py-4 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
        <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-5 w-5')) : ''; ?>
        <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
      </a>
    </div>
  </section>

</main>

<?php
get_footer();
