<?php

/**
 * Industry Related Resources Section
 *
 * ReviewService.Pro — Premium White SaaS Related Resources
 *
 * File: template-parts/industries/industry-related.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id       = get_the_ID();
$industry_name = get_the_title($post_id);

$recommended_platforms = get_post_meta($post_id, 'rsp_recommended_platforms', true);

$render_icon = function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$industry_terms = wp_get_post_terms(
  $post_id,
  'industry_type',
  [
    'fields' => 'ids',
  ]
);

$industry_terms = ! is_wp_error($industry_terms) ? $industry_terms : [];

$platform_search = '';

if (! empty($recommended_platforms)) {
  $platform_items = array_filter(
    array_map(
      'trim',
      explode(',', wp_strip_all_tags($recommended_platforms))
    )
  );

  if (! empty($platform_items)) {
    $platform_search = implode(' ', array_slice($platform_items, 0, 4));
  }
}

$platform_args = [
  'post_type'           => 'platforms',
  'post_status'         => 'publish',
  'posts_per_page'      => 3,
  'ignore_sticky_posts' => true,
  'no_found_rows'       => true,
];

if (! empty($platform_search)) {
  $platform_args['s'] = $platform_search;
}

$related_platforms = new WP_Query($platform_args);

if (! $related_platforms->have_posts() && ! empty($platform_search)) {
  wp_reset_postdata();

  $related_platforms = new WP_Query(
    [
      'post_type'           => 'platforms',
      'post_status'         => 'publish',
      'posts_per_page'      => 3,
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
      'orderby'             => 'date',
      'order'               => 'DESC',
    ]
  );
}

$case_study_args = [
  'post_type'           => 'case_studies',
  'post_status'         => 'publish',
  'posts_per_page'      => 3,
  'ignore_sticky_posts' => true,
  'no_found_rows'       => true,
];

if (! empty($industry_terms)) {
  $case_study_args['tax_query'] = [
    [
      'taxonomy' => 'industry_type',
      'field'    => 'term_id',
      'terms'    => $industry_terms,
    ],
  ];
}

$related_case_studies = new WP_Query($case_study_args);

$academy_args = [
  'post_type'           => 'post',
  'post_status'         => 'publish',
  'posts_per_page'      => 3,
  'ignore_sticky_posts' => true,
  'no_found_rows'       => true,
  's'                   => $industry_name . ' reputation reviews',
];

$related_posts = new WP_Query($academy_args);

if (! $related_posts->have_posts()) {
  wp_reset_postdata();

  $related_posts = new WP_Query(
    [
      'post_type'           => 'post',
      'post_status'         => 'publish',
      'posts_per_page'      => 3,
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
      'orderby'             => 'date',
      'order'               => 'DESC',
    ]
  );
}

$has_resources = $related_platforms->have_posts() || $related_case_studies->have_posts() || $related_posts->have_posts();

$render_card = function ($badge, $icon) use ($render_icon) {
?>
  <article
    id="related-<?php the_ID(); ?>"
    <?php post_class('rsp-related-card rsp-related-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
    data-rsp-related-reveal>

    <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
      <div class="rsp-related-card-image h-52 overflow-hidden bg-slate-100">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
        <?php else : ?>
          <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
              <?php echo $render_icon($icon, 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <div class="p-6">
        <span class="rsp-related-eyebrow mb-4 inline-flex rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
          <?php echo esc_html($badge); ?>
        </span>

        <h3 class="rsp-related-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
          <?php the_title(); ?>
        </h3>

        <p class="rsp-related-body mt-4">
          <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?>
        </p>

        <div class="mt-6 border-t border-slate-200 pt-5">
          <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
            <?php esc_html_e('Open resource', 'reviewservicepro'); ?>
            <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </span>
        </div>
      </div>
    </a>
  </article>
<?php
};
?>

<section
  id="industry-related"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="industry-related-title">

  <style>
    #industry-related {
      --rsp-related-title: #334155;
      --rsp-related-heading: #3B4658;
      --rsp-related-body: #64748B;
    }

    #industry-related .rsp-related-title,
    #industry-related .rsp-related-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #industry-related .rsp-related-title {
      color: var(--rsp-related-title);
      text-wrap: balance;
    }

    #industry-related .rsp-related-heading {
      color: var(--rsp-related-heading);
    }

    #industry-related .rsp-related-text,
    #industry-related .rsp-related-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-related-body);
    }

    #industry-related .rsp-related-text {
      font-weight: 500;
    }

    #industry-related .rsp-related-body {
      font-weight: 400;
    }

    #industry-related .rsp-related-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #industry-related .rsp-related-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #industry-related .rsp-related-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #industry-related .rsp-related-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease;
    }

    #industry-related .rsp-related-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #industry-related .rsp-related-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #industry-related .rsp-related-card:hover .rsp-related-card-image img {
      transform: scale(1.06);
    }

    @media (prefers-reduced-motion: reduce) {

      #industry-related *,
      #industry-related *::before,
      #industry-related *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #industry-related .rsp-related-reveal {
        opacity: 1;
        transform: none;
      }

      #industry-related .rsp-related-card:hover,
      #industry-related .rsp-related-card:hover .rsp-related-card-image img {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="rsp-related-reveal mb-12 max-w-3xl" data-rsp-related-reveal>
      <span class="rsp-related-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
        <?php echo $render_icon('folder-search', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Related Resources', 'reviewservicepro'); ?>
      </span>

      <h2 id="industry-related-title" class="rsp-related-title mt-4 text-[clamp(32px,4.5vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
        <?php
        printf(
          esc_html__('More resources for %s reputation growth', 'reviewservicepro'),
          esc_html($industry_name)
        );
        ?>
      </h2>

      <p class="rsp-related-text mt-5 max-w-2xl">
        <?php esc_html_e('Explore related platform guides, case studies, and ORM Academy articles to build a stronger reputation system.', 'reviewservicepro'); ?>
      </p>
    </div>

    <?php if ($has_resources) : ?>

      <?php if ($related_platforms->have_posts()) : ?>
        <div class="mb-14">
          <div class="mb-6 flex items-center justify-between gap-4">
            <h3 class="rsp-related-heading text-2xl font-[800] tracking-[-0.04em]">
              <?php esc_html_e('Recommended platform guides', 'reviewservicepro'); ?>
            </h3>
          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <?php
            while ($related_platforms->have_posts()) :
              $related_platforms->the_post();
              $render_card(__('Platform Guide', 'reviewservicepro'), 'monitor-check');
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($related_case_studies->have_posts()) : ?>
        <div class="mb-14">
          <div class="mb-6 flex items-center justify-between gap-4">
            <h3 class="rsp-related-heading text-2xl font-[800] tracking-[-0.04em]">
              <?php esc_html_e('Relevant case studies', 'reviewservicepro'); ?>
            </h3>
          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <?php
            while ($related_case_studies->have_posts()) :
              $related_case_studies->the_post();
              $render_card(__('Case Study', 'reviewservicepro'), 'file-chart-column');
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($related_posts->have_posts()) : ?>
        <div>
          <div class="mb-6 flex items-center justify-between gap-4">
            <h3 class="rsp-related-heading text-2xl font-[800] tracking-[-0.04em]">
              <?php esc_html_e('ORM Academy articles', 'reviewservicepro'); ?>
            </h3>
          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <?php
            while ($related_posts->have_posts()) :
              $related_posts->the_post();
              $render_card(__('ORM Academy', 'reviewservicepro'), 'book-open');
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </div>
      <?php endif; ?>

    <?php else : ?>

      <div class="rsp-related-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-related-reveal>
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
          <?php echo $render_icon('folder-search', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </div>

        <h3 class="rsp-related-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
          <?php esc_html_e('Related resources are coming soon.', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-related-text mx-auto mt-4 max-w-2xl">
          <?php esc_html_e('As your platform guides, case studies, and ORM Academy articles grow, related resources will appear here automatically.', 'reviewservicepro'); ?>
        </p>
      </div>

    <?php endif; ?>

  </div>
</section>

<script>
  (function() {
    function initRspIndustryRelated() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-related-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspRelatedVisible === 'true') {
          return;
        }

        item.dataset.rspRelatedVisible = 'true';
        item.classList.add('rsp-visible');
      }

      if ('IntersectionObserver' in window && items.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              reveal(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });

        return;
      }

      items.forEach(reveal);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspIndustryRelated);
    } else {
      initRspIndustryRelated();
    }
  })();
</script>