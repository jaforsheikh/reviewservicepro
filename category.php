<?php

/**
 * Category Archive Template
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$category        = get_queried_object();
$category_name   = single_cat_title('', false);
$category_desc   = category_description();
$posts_count     = isset($category->count) ? (int) $category->count : 0;
?>

<section class="relative overflow-hidden bg-[#07111F] py-20 md:py-28">
  <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
  <div class="pointer-events-none absolute -top-24 left-1/2 z-0 h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-blue-600/[0.16] blur-[140px]"></div>
  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.08] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl text-center">
      <a href="<?php echo esc_url(home_url('/orm-academy/')); ?>" class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/30 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400 transition-all duration-200 hover:bg-blue-600/20">
        <i data-lucide="arrow-left" class="h-3.5 w-3.5" aria-hidden="true"></i>
        <?php esc_html_e('Back to ORM Academy', 'reviewservicepro'); ?>
      </a>

      <h1 class="mb-6 text-4xl font-extrabold leading-tight tracking-tight text-white md:text-6xl">
        <?php echo esc_html($category_name); ?>
        <span class="block bg-gradient-to-r from-blue-400 via-cyan-300 to-emerald-300 bg-clip-text text-transparent">
          <?php esc_html_e('Guides & Insights', 'reviewservicepro'); ?>
        </span>
      </h1>

      <?php if ($category_desc) : ?>
        <div class="mx-auto mb-8 max-w-2xl text-base leading-8 text-slate-400 md:text-lg">
          <?php echo wp_kses_post($category_desc); ?>
        </div>
      <?php else : ?>
        <p class="mx-auto mb-8 max-w-2xl text-base leading-8 text-slate-400 md:text-lg">
          <?php esc_html_e('Explore practical reputation management articles, review strategies, customer trust frameworks, and business growth insights.', 'reviewservicepro'); ?>
        </p>
      <?php endif; ?>

      <div class="flex flex-wrap items-center justify-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-4 py-2 text-xs font-bold text-emerald-300">
          <i data-lucide="file-text" class="h-4 w-4" aria-hidden="true"></i>
          <?php echo esc_html($posts_count); ?>
          <?php esc_html_e('Articles', 'reviewservicepro'); ?>
        </span>

        <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-600/10 px-4 py-2 text-xs font-bold text-blue-300">
          <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Ethical ORM Focused', 'reviewservicepro'); ?>
        </span>
      </div>
    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-white/[0.05] bg-[#0B1220] py-20 md:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php while (have_posts()) : the_post(); ?>
          <article class="group overflow-hidden rounded-3xl border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/35">
            <a href="<?php the_permalink(); ?>" class="block">
              <div class="h-52 overflow-hidden bg-[#07111F]">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover opacity-85 transition-transform duration-500 group-hover:scale-105']); ?>
                <?php else : ?>
                  <div class="flex h-full items-center justify-center bg-gradient-to-br from-blue-600/[0.18] to-emerald-500/[0.08]">
                    <i data-lucide="book-open" class="h-12 w-12 text-blue-400" aria-hidden="true"></i>
                  </div>
                <?php endif; ?>
              </div>

              <div class="p-6">
                <div class="mb-3 flex flex-wrap gap-2">
                  <?php foreach (get_the_category() as $cat) : ?>
                    <span class="rounded-full border border-blue-500/20 bg-blue-600/10 px-3 py-1 text-[10px] font-bold text-blue-300">
                      <?php echo esc_html($cat->name); ?>
                    </span>
                  <?php endforeach; ?>
                </div>

                <h2 class="mb-3 text-xl font-extrabold leading-tight text-white">
                  <?php the_title(); ?>
                </h2>

                <p class="mb-5 text-sm leading-7 text-slate-400">
                  <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?>
                </p>

                <div class="flex items-center justify-between border-t border-white/[0.06] pt-4">
                  <span class="text-xs text-slate-500">
                    <?php echo esc_html(get_the_date()); ?>
                  </span>

                  <span class="inline-flex items-center gap-2 text-sm font-bold text-blue-400">
                    <?php esc_html_e('Read guide', 'reviewservicepro'); ?>
                    <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </a>
          </article>
        <?php endwhile; ?>
      </div>

      <div class="mt-12 flex justify-center">
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.035] px-5 py-3 text-sm text-slate-300">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => __('Previous', 'reviewservicepro'),
              'next_text'          => __('Next', 'reviewservicepro'),
              'screen_reader_text' => __('Posts navigation', 'reviewservicepro'),
            ]
          );
          ?>
        </div>
      </div>

    <?php else : ?>
      <div class="mx-auto max-w-2xl rounded-3xl border border-white/[0.08] bg-white/[0.035] p-8 text-center">
        <h2 class="mb-3 text-2xl font-extrabold text-white">
          <?php esc_html_e('No articles found yet.', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-6 text-slate-400">
          <?php esc_html_e('Publish posts in this category to build your ORM Academy content hub.', 'reviewservicepro'); ?>
        </p>

        <a href="<?php echo esc_url(home_url('/orm-academy/')); ?>" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white">
          <i data-lucide="arrow-left" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Back to Academy', 'reviewservicepro'); ?>
        </a>
      </div>
    <?php endif; ?>

  </div>
</section>

<section class="relative overflow-hidden border-t border-white/[0.05] bg-[#031827] py-20 md:py-24">
  <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
    <h2 class="mb-5 text-3xl font-extrabold leading-tight text-white md:text-5xl">
      <?php esc_html_e('Need help applying these strategies?', 'reviewservicepro'); ?>
    </h2>

    <p class="mx-auto mb-8 max-w-2xl text-base leading-8 text-slate-300">
      <?php esc_html_e('Get a free reputation audit and learn what your business should improve first.', 'reviewservicepro'); ?>
    </p>

    <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="inline-flex items-center gap-2 rounded-2xl bg-emerald-500 px-8 py-4 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
      <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
      <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
    </a>
  </div>
</section>

<?php
get_footer();
