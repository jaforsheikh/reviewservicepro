<?php

/**
 * Platform Related Resources Section
 *
 * ReviewService.Pro — Premium White SaaS Platform Related Resources
 *
 * File: template-parts/platforms/platform-related.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$post_id       = get_the_ID();
$platform_name = get_the_title($post_id);

$platform_terms = wp_get_post_terms(
  $post_id,
  'platform_type',
  [
    'fields' => 'ids',
  ]
);

$platform_terms = ! is_wp_error($platform_terms) ? $platform_terms : [];

$related_platform_args = [
  'post_type'           => 'platforms',
  'post_status'         => 'publish',
  'posts_per_page'      => 3,
  'post__not_in'        => [$post_id],
  'ignore_sticky_posts' => true,
  'no_found_rows'       => true,
];

if (! empty($platform_terms)) {
  $related_platform_args['tax_query'] = [
    [
      'taxonomy' => 'platform_type',
      'field'    => 'term_id',
      'terms'    => $platform_terms,
    ],
  ];
}

$related_platforms = new WP_Query($related_platform_args);

$related_industries = new WP_Query(
  [
    'post_type'           => 'industries',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    'orderby'             => 'date',
    'order'               => 'DESC',
  ]
);

$related_case_studies = new WP_Query(
  [
    'post_type'           => 'case_studies',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    'meta_query'          => [
      [
        'key'     => 'rsp_platform_used',
        'value'   => $platform_name,
        'compare' => 'LIKE',
      ],
    ],
  ]
);

if (! $related_case_studies->have_posts()) {
  wp_reset_postdata();

  $related_case_studies = new WP_Query(
    [
      'post_type'           => 'case_studies',
      'post_status'         => 'publish',
      'posts_per_page'      => 3,
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
      'orderby'             => 'date',
      'order'               => 'DESC',
    ]
  );
}

$related_articles = new WP_Query(
  [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    's'                   => $platform_name,
  ]
);

if (! $related_articles->have_posts()) {
  wp_reset_postdata();

  $related_articles = new WP_Query(
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

$has_platforms    = $related_platforms->have_posts();
$has_industries   = $related_industries->have_posts();
$has_case_studies = $related_case_studies->have_posts();
$has_articles     = $related_articles->have_posts();
$has_any_related  = $has_platforms || $has_industries || $has_case_studies || $has_articles;

$section_groups = [
  [
    'title' => __('Related Platform Guides', 'reviewservicepro'),
    'type'  => 'platforms',
    'query' => $related_platforms,
    'show'  => $has_platforms,
    'icon'  => 'monitor-check',
  ],
  [
    'title' => __('Industry Reputation Guides', 'reviewservicepro'),
    'type'  => 'industries',
    'query' => $related_industries,
    'show'  => $has_industries,
    'icon'  => 'briefcase-business',
  ],
  [
    'title' => __('Related Case Studies', 'reviewservicepro'),
    'type'  => 'case_studies',
    'query' => $related_case_studies,
    'show'  => $has_case_studies,
    'icon'  => 'chart-no-axes-combined',
  ],
  [
    'title' => __('ORM Academy Articles', 'reviewservicepro'),
    'type'  => 'post',
    'query' => $related_articles,
    'show'  => $has_articles,
    'icon'  => 'book-open',
  ],
];

$render_icon = static function ($icon, $classes = 'h-5 w-5') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$render_related_card = static function ($card_type, $render_icon) {
  $current_id = get_the_ID();

  $type_label = __('Guide', 'reviewservicepro');
  $fallback_icon = 'file-text';
  $read_label = __('Read guide', 'reviewservicepro');

  if ('platforms' === $card_type) {
    $type_label = __('Platform Guide', 'reviewservicepro');
    $fallback_icon = 'monitor-check';
    $read_label = __('View platform', 'reviewservicepro');
  } elseif ('industries' === $card_type) {
    $type_label = __('Industry Guide', 'reviewservicepro');
    $fallback_icon = 'briefcase-business';
    $read_label = __('View industry', 'reviewservicepro');
  } elseif ('case_studies' === $card_type) {
    $type_label = __('Case Study', 'reviewservicepro');
    $fallback_icon = 'chart-no-axes-combined';
    $read_label = __('Read case study', 'reviewservicepro');
  } elseif ('post' === $card_type) {
    $type_label = __('ORM Academy', 'reviewservicepro');
    $fallback_icon = 'book-open';
    $read_label = __('Read article', 'reviewservicepro');
  }

  $terms = [];

  if ('platforms' === $card_type) {
    $terms = get_the_terms($current_id, 'platform_type');
  } elseif ('industries' === $card_type) {
    $terms = get_the_terms($current_id, 'industry_type');
  } elseif ('case_studies' === $card_type) {
    $terms = get_the_terms($current_id, 'case_study_type');
  } else {
    $terms = get_the_category($current_id);
  }

  $terms = ! is_wp_error($terms) && ! empty($terms) ? $terms : [];
?>

  <article
    id="related-<?php echo esc_attr((string) $current_id); ?>"
    <?php post_class('rsp-platform-related-card rsp-platform-related-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
    data-rsp-platform-related-reveal>

    <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
      <div class="rsp-platform-related-card-image h-52 overflow-hidden bg-slate-100">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
        <?php else : ?>
          <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
              <?php echo $render_icon($fallback_icon, 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <div class="p-6">
        <div class="mb-4 flex flex-wrap items-center gap-2">
          <?php if (! empty($terms)) : ?>
            <?php foreach (array_slice($terms, 0, 2) as $term) : ?>
              <span class="rsp-platform-related-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                <?php echo esc_html($term->name); ?>
              </span>
            <?php endforeach; ?>
          <?php else : ?>
            <span class="rsp-platform-related-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
              <?php echo esc_html($type_label); ?>
            </span>
          <?php endif; ?>
        </div>

        <h4 class="rsp-platform-related-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
          <?php the_title(); ?>
        </h4>

        <p class="rsp-platform-related-body mt-4">
          <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?>
        </p>

        <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
          <span class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500">
            <?php echo esc_html(get_the_date()); ?>
          </span>

          <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
            <?php echo esc_html($read_label); ?>
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
  id="platform-related"
  class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  data-gsap="platform-related"
  aria-labelledby="platform-related-title">

  <style>
    #platform-related {
      --rsp-platform-related-title: #334155;
      --rsp-platform-related-heading: #3B4658;
      --rsp-platform-related-body: #64748B;
    }

    #platform-related .rsp-platform-related-title,
    #platform-related .rsp-platform-related-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #platform-related .rsp-platform-related-title {
      color: var(--rsp-platform-related-title);
      text-wrap: balance;
    }

    #platform-related .rsp-platform-related-heading {
      color: var(--rsp-platform-related-heading);
    }

    #platform-related .rsp-platform-related-text,
    #platform-related .rsp-platform-related-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-platform-related-body);
    }

    #platform-related .rsp-platform-related-text {
      font-weight: 500;
    }

    #platform-related .rsp-platform-related-body {
      font-weight: 400;
    }

    #platform-related .rsp-platform-related-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #platform-related .rsp-platform-related-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #platform-related .rsp-platform-related-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #platform-related .rsp-platform-related-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #platform-related .rsp-platform-related-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #platform-related .rsp-platform-related-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #platform-related .rsp-platform-related-card:hover .rsp-platform-related-card-image img {
      transform: scale(1.06);
    }

    @media (prefers-reduced-motion: reduce) {

      #platform-related *,
      #platform-related *::before,
      #platform-related *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #platform-related .rsp-platform-related-reveal {
        opacity: 1;
        transform: none;
      }

      #platform-related .rsp-platform-related-card:hover {
        transform: none;
      }

      #platform-related .rsp-platform-related-card:hover .rsp-platform-related-card-image img {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="rsp-platform-related-reveal mb-14 max-w-4xl" data-rsp-platform-related-reveal>
      <span class="rsp-platform-related-eyebrow mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
        <?php echo $render_icon('network', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
        <?php esc_html_e('Related Resources', 'reviewservicepro'); ?>
      </span>

      <h2 id="platform-related-title" class="rsp-platform-related-title text-[clamp(32px,4.5vw,58px)] font-[800] leading-[1.08] tracking-[-0.055em]">
        <?php
        printf(
          esc_html__('Explore more resources connected to %s', 'reviewservicepro'),
          esc_html($platform_name)
        );
        ?>
      </h2>

      <p class="rsp-platform-related-text mt-5 max-w-3xl">
        <?php esc_html_e('Continue learning with related platform guides, industry reputation resources, case studies, and ORM Academy articles that support better online trust and ethical review management.', 'reviewservicepro'); ?>
      </p>
    </div>

    <?php if ($has_any_related) : ?>
      <div class="space-y-16">

        <?php foreach ($section_groups as $group) : ?>
          <?php if (! $group['show'] || ! ($group['query'] instanceof WP_Query)) : ?>
            <?php continue; ?>
          <?php endif; ?>

          <div class="rsp-platform-related-reveal" data-rsp-platform-related-reveal>
            <div class="mb-8 flex items-center gap-4">
              <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600 shadow-sm">
                <?php echo $render_icon($group['icon'], 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              </div>

              <h3 class="rsp-platform-related-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                <?php echo esc_html($group['title']); ?>
              </h3>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
              <?php
              while ($group['query']->have_posts()) :
                $group['query']->the_post();
                $render_related_card($group['type'], $render_icon);
              endwhile;
              wp_reset_postdata();
              ?>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    <?php else : ?>
      <div class="rsp-platform-related-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-platform-related-reveal>
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
          <?php echo $render_icon('book-open', 'h-7 w-7'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
        </div>

        <h3 class="rsp-platform-related-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
          <?php esc_html_e('More resources coming soon', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-platform-related-text mx-auto mt-4 max-w-xl">
          <?php esc_html_e('We are building more platform-specific guides, industry resources, and ethical ORM case studies.', 'reviewservicepro'); ?>
        </p>
      </div>
    <?php endif; ?>

  </div>
</section>

<script>
  (function() {
    function initRspPlatformRelated() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-platform-related-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPlatformRelatedVisible === 'true') {
          return;
        }

        item.dataset.rspPlatformRelatedVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspPlatformRelated);
    } else {
      initRspPlatformRelated();
    }
  })();
</script>