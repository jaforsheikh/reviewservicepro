<?php

/**
 * 404 Error Page Template
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$quick_links = [
  [
    'label' => __('Home', 'reviewservicepro'),
    'url'   => home_url('/'),
    'icon'  => 'home',
  ],
  [
    'label' => __('Services', 'reviewservicepro'),
    'url'   => home_url('/services/'),
    'icon'  => 'briefcase-business',
  ],
  [
    'label' => __('Platforms', 'reviewservicepro'),
    'url'   => home_url('/platforms/'),
    'icon'  => 'star',
  ],
  [
    'label' => __('Industries', 'reviewservicepro'),
    'url'   => home_url('/industries/'),
    'icon'  => 'building-2',
  ],
  [
    'label' => __('Case Studies', 'reviewservicepro'),
    'url'   => home_url('/case-studies/'),
    'icon'  => 'chart-column-big',
  ],
  [
    'label' => __('Contact', 'reviewservicepro'),
    'url'   => home_url('/contact/'),
    'icon'  => 'message-circle',
  ],
];

$popular_resources = new WP_Query(
  [
    'post_type'           => ['platforms', 'industries', 'case_studies', 'post'],
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    'orderby'             => 'date',
    'order'               => 'DESC',
  ]
);
?>

<main id="primary" class="relative overflow-hidden bg-[#07111F] text-white" role="main">

  <section class="relative overflow-hidden border-b border-white/[0.05] bg-[#07111F] py-20 md:py-28">
    <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="pointer-events-none absolute -top-24 left-1/2 z-0 h-[560px] w-[940px] -translate-x-1/2 rounded-full bg-blue-600/[0.16] blur-[140px]"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.09] blur-[120px]"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">

        <span class="mb-6 inline-flex items-center gap-2 rounded-full border border-red-500/25 bg-red-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-red-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('triangle-alert', 'h-3.5 w-3.5')) : ''; ?>
          <?php esc_html_e('Page Not Found', 'reviewservicepro'); ?>
        </span>

        <div class="pointer-events-none select-none text-[7rem] font-black leading-none tracking-[-0.08em] text-white/5 sm:text-[10rem] md:text-[13rem]">
          404
        </div>

        <h1 class="-mt-10 text-4xl font-extrabold leading-tight tracking-tight text-white md:-mt-16 md:text-6xl">
          <?php esc_html_e('This page seems to be missing.', 'reviewservicepro'); ?>
        </h1>

        <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-slate-400 md:text-lg">
          <?php esc_html_e('The page may have been moved, renamed, or removed. Search below or use the quick links to find reputation management services, platform guides, industry resources, or case studies.', 'reviewservicepro'); ?>
        </p>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mx-auto mt-10 max-w-2xl">
          <label for="rsp-404-search" class="sr-only">
            <?php esc_html_e('Search ReviewService.Pro', 'reviewservicepro'); ?>
          </label>

          <div class="flex flex-col gap-3 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.04] p-3 sm:flex-row">
            <div class="relative flex-1">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search', 'pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-500')) : ''; ?>

              <input
                id="rsp-404-search"
                type="search"
                name="s"
                placeholder="<?php esc_attr_e('Search reputation guides, services, platforms...', 'reviewservicepro'); ?>"
                class="h-14 w-full rounded-2xl border border-white/[0.08] bg-[#07111F] pl-12 pr-5 text-sm text-white outline-none placeholder:text-slate-600 focus:border-blue-500/40 focus:ring-4 focus:ring-blue-500/10">
            </div>

            <button
              type="submit"
              class="inline-flex h-14 items-center justify-center gap-2 rounded-2xl bg-blue-600 px-7 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search-check', 'h-4 w-4')) : ''; ?>
              <?php esc_html_e('Search', 'reviewservicepro'); ?>
            </button>
          </div>
        </form>

      </div>
    </div>
  </section>

  <section class="relative border-b border-white/[0.05] bg-[#0B1220] py-16 md:py-20" aria-labelledby="quick-links-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

      <div class="mb-10 text-center">
        <h2 id="quick-links-title" class="text-3xl font-extrabold text-white md:text-4xl">
          <?php esc_html_e('Quick navigation', 'reviewservicepro'); ?>
        </h2>

        <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-400">
          <?php esc_html_e('Jump to the most useful sections of ReviewService.Pro.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($quick_links as $link) : ?>
          <a
            href="<?php echo esc_url($link['url']); ?>"
            class="group flex items-center gap-4 rounded-[1.5rem] border border-white/[0.08] bg-white/[0.035] p-5 transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/35 hover:bg-white/[0.06]">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($link['icon'], 'h-5 w-5')) : ''; ?>
            </span>

            <span class="flex-1 text-base font-extrabold text-white">
              <?php echo esc_html($link['label']); ?>
            </span>

            <span class="text-blue-300 transition-transform duration-300 group-hover:translate-x-1">
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4')) : ''; ?>
            </span>
          </a>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <?php if ($popular_resources->have_posts()) : ?>
    <section class="relative bg-[#07111F] py-20 md:py-24" aria-labelledby="popular-resources-title">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-10 max-w-3xl">
          <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('sparkles', 'h-3.5 w-3.5')) : ''; ?>
            <?php esc_html_e('Helpful Resources', 'reviewservicepro'); ?>
          </span>

          <h2 id="popular-resources-title" class="text-3xl font-extrabold tracking-tight text-white md:text-4xl">
            <?php esc_html_e('Explore recent reputation resources', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 text-sm leading-7 text-slate-400">
            <?php esc_html_e('These resources can help you continue learning about online reputation management, review platforms, customer trust, and ethical ORM strategy.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          while ($popular_resources->have_posts()) :
            $popular_resources->the_post();

            $post_type = get_post_type();

            if ('platforms' === $post_type) {
              get_template_part('template-parts/cards/platform', 'card');
            } elseif ('industries' === $post_type) {
              get_template_part('template-parts/cards/industry', 'card');
            } elseif ('case_studies' === $post_type) {
              get_template_part('template-parts/cards/case-study', 'card');
            } else {
              get_template_part('template-parts/cards/blog', 'card');
            }
          endwhile;

          wp_reset_postdata();
          ?>
        </div>

      </div>
    </section>
  <?php endif; ?>

  <section class="relative overflow-hidden border-t border-white/[0.05] bg-[#031827] py-20 md:py-24">
    <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">

      <h2 class="text-3xl font-extrabold leading-tight text-white md:text-5xl">
        <?php esc_html_e('Need help finding the right reputation solution?', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-slate-300">
        <?php esc_html_e('Get a free reputation audit and discover what is hurting your online trust, visibility, reviews, and customer conversion rate.', 'reviewservicepro'); ?>
      </p>

      <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
        <a
          href="<?php echo esc_url(home_url('/contact/?type=free-audit')); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-8 py-4 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('shield-check', 'h-5 w-5')) : ''; ?>
          <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
        </a>

        <a
          href="<?php echo esc_url(home_url('/services/')); ?>"
          class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.04] px-8 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40 hover:bg-white/[0.07]">
          <?php esc_html_e('View Services', 'reviewservicepro'); ?>
        </a>
      </div>

    </div>
  </section>

</main>

<?php
get_footer();
