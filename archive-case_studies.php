<?php

/**
 * Case Studies Archive Template
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$case_count      = wp_count_posts('case_studies');
$published_count = isset($case_count->publish) ? (int) $case_count->publish : 0;

$archive_title = get_the_archive_title();

if (empty($archive_title) || false !== strpos($archive_title, ':')) {
  $archive_title = __('Reputation Management Case Studies', 'reviewservicepro');
}

$proof_stats = [
  [
    'icon'  => 'shield-check',
    'value' => __('Ethical', 'reviewservicepro'),
    'label' => __('ORM workflows only', 'reviewservicepro'),
  ],
  [
    'icon'  => 'chart-column-big',
    'value' => $published_count ? $published_count . '+' : '0',
    'label' => __('published case studies', 'reviewservicepro'),
  ],
  [
    'icon'  => 'radar',
    'value' => __('Audit', 'reviewservicepro'),
    'label' => __('review risks & trust gaps', 'reviewservicepro'),
  ],
];

$filter_terms = get_terms(
  [
    'taxonomy'   => 'industry_type',
    'hide_empty' => true,
    'number'     => 8,
  ]
);
?>

<main id="primary" class="relative overflow-hidden bg-[#07111F] text-white" role="main">

  <section class="relative overflow-hidden border-b border-white/[0.05] bg-[#07111F] py-20 md:py-28">
    <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="pointer-events-none absolute -top-24 left-1/2 z-0 h-[540px] w-[920px] -translate-x-1/2 rounded-full bg-blue-600/[0.16] blur-[140px]"></div>
    <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.09] blur-[120px]"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">

        <?php if (function_exists('rsp_breadcrumb')) : ?>
          <div class="mb-8 flex justify-center">
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-300">
          <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('chart-column-big', 'h-3.5 w-3.5')) : ''; ?>
          <?php esc_html_e('Proof & Results Library', 'reviewservicepro'); ?>
        </span>

        <h1 class="text-4xl font-extrabold leading-tight tracking-tight text-white md:text-6xl">
          <?php echo esc_html($archive_title); ?>
        </h1>

        <p class="mx-auto mt-6 max-w-3xl text-base leading-8 text-slate-400 md:text-lg">
          <?php esc_html_e('Explore reputation management case studies showing review monitoring, response strategy, rating improvement, customer trust workflows, and ethical ORM execution across different industries and platforms.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-8 flex flex-wrap justify-center gap-3">
          <?php foreach ($proof_stats as $stat) : ?>
            <div class="inline-flex items-center gap-3 rounded-2xl border border-white/[0.08] bg-white/[0.04] px-4 py-3">
              <span class="flex h-9 w-9 items-center justify-center rounded-xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon($stat['icon'], 'h-4 w-4')) : ''; ?>
              </span>

              <span class="text-left">
                <span class="block text-sm font-extrabold text-white">
                  <?php echo esc_html($stat['value']); ?>
                </span>

                <span class="block text-xs text-slate-400">
                  <?php echo esc_html($stat['label']); ?>
                </span>
              </span>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>

  <section class="relative border-b border-white/[0.05] bg-[#0B1220] py-14">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_0.7fr]">

        <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
          <h2 class="text-2xl font-extrabold text-white">
            <?php esc_html_e('Proof-focused reputation strategy', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 text-sm leading-7 text-slate-400">
            <?php esc_html_e('Each case study is designed to show the reputation problem, strategy, workflow, measurable signals, and trust-focused outcome. This helps businesses understand how ethical ORM can support visibility, credibility, and customer confidence.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rounded-[2rem] border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-8">
          <h2 class="text-2xl font-extrabold text-white">
            <?php esc_html_e('Need similar reputation growth?', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 text-sm leading-7 text-slate-300">
            <?php esc_html_e('Start with a free audit to find review gaps, response risks, platform weaknesses, and trust-building opportunities.', 'reviewservicepro'); ?>
          </p>

          <a href="<?php echo esc_url(home_url('/contact/?type=free-audit')); ?>" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-emerald-500 px-6 py-3 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
            <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4')) : ''; ?>
          </a>
        </div>

      </div>
    </div>
  </section>

  <section class="relative bg-[#07111F] py-20 md:py-24" aria-labelledby="case-studies-grid-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

      <div class="mb-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('layout-grid', 'h-3.5 w-3.5')) : ''; ?>
            <?php esc_html_e('Case Study Library', 'reviewservicepro'); ?>
          </span>

          <h2 id="case-studies-grid-title" class="text-3xl font-extrabold tracking-tight text-white md:text-4xl">
            <?php esc_html_e('Browse reputation case studies', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-400">
            <?php esc_html_e('Review real examples of reputation audits, platform strategies, response workflows, monitoring improvements, and measurable trust-building outcomes.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row lg:justify-end">
          <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="w-full sm:w-[320px]">
            <label for="case-study-search" class="sr-only">
              <?php esc_html_e('Search case studies', 'reviewservicepro'); ?>
            </label>

            <div class="relative">
              <input
                id="case-study-search"
                type="search"
                name="s"
                placeholder="<?php esc_attr_e('Search case studies...', 'reviewservicepro'); ?>"
                class="w-full rounded-2xl border border-white/[0.10] bg-white/[0.04] px-5 py-4 pr-14 text-sm text-white placeholder:text-slate-500 focus:border-blue-500/50 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
              <input type="hidden" name="post_type" value="case_studies">
              <button type="submit" class="absolute right-2 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-xl bg-blue-600 text-white transition-colors duration-200 hover:bg-blue-700">
                <span class="sr-only"><?php esc_html_e('Search', 'reviewservicepro'); ?></span>
                <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('search', 'h-4 w-4')) : ''; ?>
              </button>
            </div>
          </form>
        </div>
      </div>

      <?php if (! empty($filter_terms) && ! is_wp_error($filter_terms)) : ?>
        <div class="mb-10 flex flex-wrap gap-3">
          <?php foreach ($filter_terms as $term) : ?>
            <a
              href="<?php echo esc_url(get_term_link($term)); ?>"
              class="inline-flex items-center gap-2 rounded-full border border-white/[0.08] bg-white/[0.04] px-4 py-2 text-xs font-bold text-slate-300 transition-colors duration-200 hover:border-blue-500/30 hover:bg-blue-600/10 hover:text-blue-300">
              <?php echo esc_html($term->name); ?>
              <span class="text-slate-500"><?php echo esc_html($term->count); ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          while (have_posts()) :
            the_post();

            get_template_part(
              'template-parts/cards/case-study',
              'card'
            );

          endwhile;
          ?>
        </div>

        <div class="mt-12">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
              'next_text'          => esc_html__('Next', 'reviewservicepro'),
              'screen_reader_text' => esc_html__('Case studies pagination', 'reviewservicepro'),
              'class'              => 'rsp-pagination',
            ]
          );
          ?>
        </div>
      <?php else : ?>
        <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-10 text-center">
          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-red-500/20 bg-red-500/10 text-red-300">
            <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('folder-search', 'h-7 w-7')) : ''; ?>
          </div>

          <h2 class="text-2xl font-extrabold text-white">
            <?php esc_html_e('No case studies found', 'reviewservicepro'); ?>
          </h2>

          <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-slate-400">
            <?php esc_html_e('No reputation case studies are available yet. Add case studies from the WordPress dashboard to build your proof library.', 'reviewservicepro'); ?>
          </p>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <section class="relative bg-[#031827] py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="relative overflow-hidden rounded-[2rem] border border-white/[0.09] bg-white/[0.04] p-8 md:p-10">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.12),transparent_35%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.10),transparent_35%)]"></div>

        <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_0.55fr] lg:items-center">
          <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-white md:text-4xl">
              <?php esc_html_e('Want a reputation strategy built around your business?', 'reviewservicepro'); ?>
            </h2>

            <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 md:text-base">
              <?php esc_html_e('Get a free audit and discover which review platforms, customer trust signals, response gaps, and reputation risks should be prioritized first.', 'reviewservicepro'); ?>
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
            <a href="<?php echo esc_url(home_url('/contact/?type=free-audit')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-7 py-4 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
              <?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?>
              <?php echo function_exists('rsp_icon') ? wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4')) : ''; ?>
            </a>

            <a href="<?php echo esc_url(home_url('/contact/?type=consultation')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.12] bg-white/[0.04] px-7 py-4 text-sm font-extrabold text-white transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/40 hover:bg-white/[0.07]">
              <?php esc_html_e('Book Consultation', 'reviewservicepro'); ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
