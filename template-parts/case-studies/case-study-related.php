<?php

/**
 * Case Study Related Resources Section
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id = get_the_ID();

/**
 * Current taxonomy terms
 */
$industry_terms = wp_get_post_terms($post_id, 'industry_type', ['fields' => 'ids']);

$current_platform = get_post_meta($post_id, 'rsp_platform_used', true);

/**
 * Related Case Studies
 */
$related_case_studies = new WP_Query(
  [
    'post_type'           => 'case_studies',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'post__not_in'        => [$post_id],
    'ignore_sticky_posts' => true,
    'tax_query'           => ! empty($industry_terms)
      ? [
        [
          'taxonomy' => 'industry_type',
          'field'    => 'term_id',
          'terms'    => $industry_terms,
        ],
      ]
      : [],
  ]
);

/**
 * Related Industries
 */
$related_industries = new WP_Query(
  [
    'post_type'           => 'industries',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'tax_query'           => ! empty($industry_terms)
      ? [
        [
          'taxonomy' => 'industry_type',
          'field'    => 'term_id',
          'terms'    => $industry_terms,
        ],
      ]
      : [],
  ]
);

/**
 * Related Platforms
 */
$platform_meta_query = [];

if (! empty($current_platform)) {
  $platform_meta_query[] = [
    'key'     => 'rsp_platform_url',
    'compare' => 'EXISTS',
  ];
}

$related_platforms = new WP_Query(
  [
    'post_type'           => 'platforms',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'meta_query'          => $platform_meta_query,
  ]
);

/**
 * Related ORM Academy Articles
 */
$related_articles = new WP_Query(
  [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
  ]
);

/**
 * Reusable card renderer
 */
function rsp_case_related_card($post_object, $type_label = '')
{

  if (! $post_object instanceof WP_Post) {
    return;
  }

  $post_id = $post_object->ID;

  $title   = get_the_title($post_id);
  $excerpt = get_the_excerpt($post_id);
  $url     = get_permalink($post_id);

  $image = '';

  if (has_post_thumbnail($post_id)) {
    $image = get_the_post_thumbnail_url($post_id, 'large');
  }

  if (empty($image) && function_exists('rsp_get_thumbnail_url')) {
    $image = rsp_get_thumbnail_url($post_id, 'large');
  }
?>

  <article class="group relative overflow-hidden rounded-[2rem] border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/30 hover:bg-white/[0.05]">

    <a
      href="<?php echo esc_url($url); ?>"
      class="absolute inset-0 z-10"
      aria-label="<?php echo esc_attr($title); ?>"></a>

    <div class="aspect-[16/10] overflow-hidden border-b border-white/[0.06] bg-[#0B1220]">

      <?php if (! empty($image)) : ?>
        <img
          src="<?php echo esc_url($image); ?>"
          alt="<?php echo esc_attr($title); ?>"
          class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
          loading="lazy">
      <?php else : ?>

        <div class="flex h-full items-center justify-center bg-gradient-to-br from-blue-600/[0.14] to-emerald-500/[0.08]">
          <?php
          if (function_exists('rsp_icon')) {
            echo wp_kses_post(
              rsp_icon(
                'layout-template',
                'h-10 w-10 text-blue-300'
              )
            );
          }
          ?>
        </div>

      <?php endif; ?>

    </div>

    <div class="p-6 md:p-7">

      <?php if (! empty($type_label)) : ?>
        <span class="inline-flex items-center rounded-full border border-blue-500/20 bg-blue-600/10 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-blue-300">
          <?php echo esc_html($type_label); ?>
        </span>
      <?php endif; ?>

      <h3 class="mt-4 text-xl font-extrabold leading-tight text-white">
        <?php echo esc_html($title); ?>
      </h3>

      <?php if (! empty($excerpt)) : ?>
        <p class="mt-4 text-sm leading-7 text-slate-300">
          <?php echo esc_html(wp_trim_words($excerpt, 20)); ?>
        </p>
      <?php endif; ?>

      <div class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-blue-300">
        <?php esc_html_e('Explore Resource', 'reviewservicepro'); ?>

        <?php
        if (function_exists('rsp_icon')) {
          echo wp_kses_post(
            rsp_icon(
              'arrow-right',
              'h-4 w-4 transition-transform duration-300 group-hover:translate-x-1'
            )
          );
        }
        ?>
      </div>

    </div>

  </article>

<?php
}
?>

<section
  class="relative overflow-hidden border-b border-white/[0.05] bg-[#0B1220] py-20 md:py-24"
  data-gsap="case-study-related"
  aria-labelledby="case-study-related-title">
  <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.08),transparent_32%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.06),transparent_32%)]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <div class="mb-14 max-w-4xl">

      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-blue-400">
        <?php
        if (function_exists('rsp_icon')) {
          echo wp_kses_post(
            rsp_icon(
              'network',
              'h-3.5 w-3.5'
            )
          );
        }
        ?>

        <?php esc_html_e('Related Resources', 'reviewservicepro'); ?>
      </span>

      <h2
        id="case-study-related-title"
        class="text-3xl font-extrabold leading-tight tracking-tight text-white md:text-5xl">
        <?php esc_html_e('Continue exploring related reputation resources.', 'reviewservicepro'); ?>
      </h2>

      <p class="mt-5 max-w-3xl text-base leading-8 text-slate-400">
        <?php esc_html_e('Discover additional case studies, platform guides, industry reputation insights, and ORM Academy resources connected to this reputation management workflow.', 'reviewservicepro'); ?>
      </p>

    </div>

    <div class="space-y-16">

      <?php if ($related_case_studies->have_posts()) : ?>

        <div>

          <div class="mb-8 flex items-center justify-between gap-4">

            <h3 class="text-2xl font-extrabold text-white">
              <?php esc_html_e('Related Case Studies', 'reviewservicepro'); ?>
            </h3>

          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

            <?php
            while ($related_case_studies->have_posts()) :
              $related_case_studies->the_post();

              rsp_case_related_card(
                get_post(),
                __('Case Study', 'reviewservicepro')
              );

            endwhile;
            ?>

          </div>

        </div>

      <?php endif; ?>

      <?php if ($related_industries->have_posts()) : ?>

        <div>

          <div class="mb-8 flex items-center justify-between gap-4">

            <h3 class="text-2xl font-extrabold text-white">
              <?php esc_html_e('Industry Reputation Guides', 'reviewservicepro'); ?>
            </h3>

          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

            <?php
            while ($related_industries->have_posts()) :
              $related_industries->the_post();

              rsp_case_related_card(
                get_post(),
                __('Industry Guide', 'reviewservicepro')
              );

            endwhile;
            ?>

          </div>

        </div>

      <?php endif; ?>

      <?php if ($related_platforms->have_posts()) : ?>

        <div>

          <div class="mb-8 flex items-center justify-between gap-4">

            <h3 class="text-2xl font-extrabold text-white">
              <?php esc_html_e('Review Platform Resources', 'reviewservicepro'); ?>
            </h3>

          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

            <?php
            while ($related_platforms->have_posts()) :
              $related_platforms->the_post();

              rsp_case_related_card(
                get_post(),
                __('Platform Guide', 'reviewservicepro')
              );

            endwhile;
            ?>

          </div>

        </div>

      <?php endif; ?>

      <?php if ($related_articles->have_posts()) : ?>

        <div>

          <div class="mb-8 flex items-center justify-between gap-4">

            <h3 class="text-2xl font-extrabold text-white">
              <?php esc_html_e('ORM Academy Articles', 'reviewservicepro'); ?>
            </h3>

          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

            <?php
            while ($related_articles->have_posts()) :
              $related_articles->the_post();

              rsp_case_related_card(
                get_post(),
                __('ORM Academy', 'reviewservicepro')
              );

            endwhile;
            ?>

          </div>

        </div>

      <?php endif; ?>

      <?php
      if (
        ! $related_case_studies->have_posts()
        && ! $related_industries->have_posts()
        && ! $related_platforms->have_posts()
        && ! $related_articles->have_posts()
      ) :
      ?>

        <div class="rounded-[2rem] border border-white/[0.08] bg-white/[0.035] p-10 text-center">

          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10 text-blue-300">
            <?php
            if (function_exists('rsp_icon')) {
              echo wp_kses_post(
                rsp_icon(
                  'folder-search',
                  'h-7 w-7'
                )
              );
            }
            ?>
          </div>

          <h3 class="mt-6 text-2xl font-extrabold text-white">
            <?php esc_html_e('More resources coming soon.', 'reviewservicepro'); ?>
          </h3>

          <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-400">
            <?php esc_html_e('Additional related reputation management resources, case studies, and platform insights will appear here as the ORM knowledge base expands.', 'reviewservicepro'); ?>
          </p>

        </div>

      <?php endif; ?>

    </div>

  </div>
</section>

<?php
wp_reset_postdata();
?>