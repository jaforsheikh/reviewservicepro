<?php

/**
 * Home Section: Case Studies Preview
 *
 * File: template-parts/sections/home/case-studies-preview.php
 *
 * ReviewService.Pro — Premium White SaaS Case Studies Preview
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$case_studies_url = home_url('/case-studies/');
$audit_url        = home_url('/contact/?type=audit');

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};

$case_query = new WP_Query(
  [
    'post_type'           => 'case_studies',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
  ]
);

$fallback_cards = [
  [
    'label' => __('Local Service Business', 'reviewservicepro'),
    'title' => __('Review monitoring helped reveal trust gaps before customers contacted the business.', 'reviewservicepro'),
    'text'  => __('A structured review monitoring workflow made it easier to identify unanswered feedback, platform visibility issues, and response opportunities.', 'reviewservicepro'),
    'icon'  => 'search-check',
    'tone'  => 'blue',
  ],
  [
    'label' => __('Clinic Reputation Support', 'reviewservicepro'),
    'title' => __('Professional response support improved public communication consistency.', 'reviewservicepro'),
    'text'  => __('The focus was on calm, brand-safe review responses, documentation, and clear internal next steps without making unrealistic promises.', 'reviewservicepro'),
    'icon'  => 'message-square-check',
    'tone'  => 'green',
  ],
  [
    'label' => __('Multi-Platform ORM', 'reviewservicepro'),
    'title' => __('Platform profile checks helped organize reputation improvement priorities.', 'reviewservicepro'),
    'text'  => __('The review process highlighted profile gaps, response needs, and reporting priorities across important customer trust platforms.', 'reviewservicepro'),
    'icon'  => 'layout-dashboard',
    'tone'  => 'teal',
  ],
];

$tone_classes = [
  'blue' => [
    'badge' => 'border-blue-200 bg-blue-50 text-blue-700',
    'icon'  => 'border-blue-100 bg-blue-50 text-blue-600',
    'line'  => 'from-blue-500 via-blue-400 to-transparent',
  ],
  'green' => [
    'badge' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
    'icon'  => 'border-emerald-100 bg-emerald-50 text-emerald-600',
    'line'  => 'from-emerald-500 via-emerald-400 to-transparent',
  ],
  'teal' => [
    'badge' => 'border-teal-200 bg-teal-50 text-teal-700',
    'icon'  => 'border-teal-100 bg-teal-50 text-teal-600',
    'line'  => 'from-teal-500 via-teal-400 to-transparent',
  ],
];
?>

<style>
  #home-case-studies-preview {
    --rsp-case-title: #334155;
    --rsp-case-heading: #3B4658;
    --rsp-case-body: #64748B;
    --rsp-case-blue: #2563EB;
    --rsp-case-green: #00C853;
    --rsp-case-border: rgba(148, 163, 184, 0.26);
  }

  #home-case-studies-preview .rsp-case-title,
  #home-case-studies-preview .rsp-case-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  #home-case-studies-preview .rsp-case-title {
    color: var(--rsp-case-title);
    text-wrap: balance;
  }

  #home-case-studies-preview .rsp-case-heading {
    color: var(--rsp-case-heading);
  }

  #home-case-studies-preview .rsp-case-text,
  #home-case-studies-preview .rsp-case-body {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    line-height: 1.78;
    color: var(--rsp-case-body);
  }

  #home-case-studies-preview .rsp-case-text {
    font-weight: 500;
  }

  #home-case-studies-preview .rsp-case-body {
    font-weight: 400;
  }

  #home-case-studies-preview .rsp-case-eyebrow {
    font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
  }

  #home-case-studies-preview .rsp-case-reveal {
    opacity: 0;
    transform: translateY(24px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
      box-shadow 320ms ease,
      border-color 320ms ease;
  }

  #home-case-studies-preview .rsp-case-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  #home-case-studies-preview .rsp-case-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease,
      border-color 260ms ease;
  }

  #home-case-studies-preview .rsp-case-card::before {
    content: "";
    position: absolute;
    inset: -90%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.08),
        rgba(0, 200, 83, 0.24),
        rgba(20, 184, 166, 0.18),
        rgba(37, 99, 235, 0.22),
        rgba(37, 99, 235, 0.08));
    opacity: 0;
    transform: rotate(0deg);
    animation: rspCaseBorderSpin 8s linear infinite;
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  #home-case-studies-preview .rsp-case-card::after {
    content: "";
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: #ffffff;
    pointer-events: none;
  }

  #home-case-studies-preview .rsp-case-card:hover {
    transform: translateY(-5px);
    border-color: rgba(37, 99, 235, 0.24);
    box-shadow: 0 24px 70px rgba(15, 23, 42, 0.11);
  }

  #home-case-studies-preview .rsp-case-card:hover::before {
    opacity: 1;
  }

  #home-case-studies-preview .rsp-case-image img {
    transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
  }

  #home-case-studies-preview .rsp-case-card:hover .rsp-case-image img {
    transform: scale(1.06);
  }

  #home-case-studies-preview .rsp-case-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #home-case-studies-preview .rsp-case-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -120%;
    z-index: 0;
    width: 70%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
    transform: skewX(-18deg);
    transition: left 720ms ease;
    pointer-events: none;
  }

  #home-case-studies-preview .rsp-case-btn:hover {
    transform: translateY(-3px);
  }

  #home-case-studies-preview .rsp-case-btn:hover::before {
    left: 135%;
  }

  @keyframes rspCaseBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  @media (max-width: 640px) {
    #home-case-studies-preview .rsp-case-title {
      letter-spacing: -0.035em;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #home-case-studies-preview *,
    #home-case-studies-preview *::before,
    #home-case-studies-preview *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.001ms !important;
    }

    #home-case-studies-preview .rsp-case-reveal {
      opacity: 1;
      transform: none;
    }

    #home-case-studies-preview .rsp-case-card:hover,
    #home-case-studies-preview .rsp-case-btn:hover {
      transform: none;
    }

    #home-case-studies-preview .rsp-case-card:hover .rsp-case-image img {
      transform: none;
    }
  }
</style>

<section
  id="home-case-studies-preview"
  class="relative overflow-hidden border-b border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8 lg:py-24"
  aria-labelledby="home-case-studies-title"
  data-rsp-case-section>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.03)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[480px] w-[480px] rounded-full bg-blue-200/30 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[480px] w-[480px] rounded-full bg-emerald-200/35 blur-[130px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <div class="mx-auto max-w-3xl text-center rsp-case-reveal" data-rsp-case-reveal>
      <span class="rsp-case-eyebrow inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm">
        <?php echo $render_icon('chart-no-axes-combined', 'h-4 w-4'); ?>
        <?php esc_html_e('Case Study Preview', 'reviewservicepro'); ?>
      </span>

      <h2
        id="home-case-studies-title"
        class="rsp-case-title mx-auto mt-6 max-w-3xl text-[30px] font-[700] leading-[1.06] tracking-[-0.035em] sm:text-[36px] lg:text-[42px]">
        <?php esc_html_e('Proof-focused reputation workflows built around real trust signals.', 'reviewservicepro'); ?>
      </h2>

      <p class="rsp-case-text mx-auto mt-5 max-w-2xl">
        <?php esc_html_e('Explore practical examples of review monitoring, response support, platform checks, reporting, and ethical customer feedback systems used to improve reputation visibility and customer confidence.', 'reviewservicepro'); ?>
      </p>
    </div>

    <?php if ($case_query->have_posts()) : ?>
      <div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        <?php
        $case_index = 0;

        while ($case_query->have_posts()) :
          $case_query->the_post();

          $case_terms = get_the_terms(get_the_ID(), 'case_study_type');
          $delay      = min($case_index * 80, 320);
        ?>

          <article
            <?php post_class('rsp-case-card rsp-case-reveal rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
            data-rsp-case-reveal
            style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">

            <a href="<?php the_permalink(); ?>" class="relative z-10 block h-full no-underline">
              <div class="rsp-case-image h-60 overflow-hidden rounded-t-[1.75rem] bg-slate-100">
                <?php if (has_post_thumbnail()) : ?>
                  <?php
                  the_post_thumbnail(
                    'large',
                    [
                      'class'    => 'h-full w-full object-cover',
                      'loading'  => 'lazy',
                      'decoding' => 'async',
                    ]
                  );
                  ?>
                <?php else : ?>
                  <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                      <?php echo $render_icon('chart-no-axes-combined', 'h-8 w-8'); ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <div class="p-6">
                <div class="mb-4 flex flex-wrap items-center gap-2">
                  <?php if (! empty($case_terms) && ! is_wp_error($case_terms)) : ?>
                    <?php foreach (array_slice($case_terms, 0, 2) as $term) : ?>
                      <span class="rsp-case-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                        <?php echo esc_html($term->name); ?>
                      </span>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <span class="rsp-case-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
                      <?php esc_html_e('Reputation Workflow', 'reviewservicepro'); ?>
                    </span>
                  <?php endif; ?>
                </div>

                <h3 class="rsp-case-heading text-[21px] font-[700] leading-tight tracking-[-0.03em]">
                  <?php the_title(); ?>
                </h3>

                <p class="rsp-case-body mt-4">
                  <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?>
                </p>

                <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                  <span class="font-['Inter',sans-serif] text-sm font-medium text-slate-500">
                    <?php echo esc_html(get_the_date()); ?>
                  </span>

                  <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[700] text-blue-700">
                    <?php esc_html_e('View case study', 'reviewservicepro'); ?>
                    <?php echo $render_icon('arrow-right', 'h-4 w-4'); ?>
                  </span>
                </div>
              </div>
            </a>
          </article>

        <?php
          $case_index++;
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
    <?php else : ?>
      <div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        <?php foreach ($fallback_cards as $index => $card) : ?>
          <?php
          $tone  = $tone_classes[$card['tone']] ?? $tone_classes['blue'];
          $delay = min($index * 80, 320);
          ?>

          <article
            class="rsp-case-card rsp-case-reveal rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-[0_16px_48px_rgba(15,23,42,0.07)]"
            data-rsp-case-reveal
            style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">

            <div class="absolute inset-x-0 top-0 h-[3px] rounded-t-[1.75rem] bg-gradient-to-r <?php echo esc_attr($tone['line']); ?>" aria-hidden="true"></div>

            <div class="relative z-10">
              <div class="<?php echo esc_attr($tone['icon']); ?> mb-6 flex h-14 w-14 items-center justify-center rounded-2xl border shadow-sm">
                <?php echo $render_icon($card['icon'], 'h-6 w-6'); ?>
              </div>

              <span class="<?php echo esc_attr($tone['badge']); ?> rsp-case-eyebrow inline-flex rounded-full border px-3 py-1.5">
                <?php echo esc_html($card['label']); ?>
              </span>

              <h3 class="rsp-case-heading mt-5 text-[21px] font-[700] leading-tight tracking-[-0.03em]">
                <?php echo esc_html($card['title']); ?>
              </h3>

              <p class="rsp-case-body mt-4">
                <?php echo esc_html($card['text']); ?>
              </p>

              <div class="mt-6 border-t border-slate-200 pt-5">
                <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[700] text-blue-700">
                  <?php esc_html_e('Case study coming soon', 'reviewservicepro'); ?>
                  <?php echo $render_icon('clock', 'h-4 w-4'); ?>
                </span>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div
      class="rsp-case-reveal mx-auto mt-12 flex max-w-5xl flex-col items-start justify-between gap-6 rounded-[1.75rem] border border-slate-200 bg-white/95 p-6 shadow-[0_18px_60px_rgba(15,23,42,0.07)] backdrop-blur-xl md:flex-row md:items-center"
      data-rsp-case-reveal>

      <div>
        <h3 class="rsp-case-heading text-[22px] font-[700] leading-tight tracking-[-0.03em]">
          <?php esc_html_e('Want to understand where your reputation gaps are?', 'reviewservicepro'); ?>
        </h3>

        <p class="rsp-case-text mt-2 max-w-2xl">
          <?php esc_html_e('Start with a practical audit of review visibility, response gaps, platform profiles, and reporting opportunities.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
        <a
          href="<?php echo esc_url($case_studies_url); ?>"
          class="rsp-case-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[700] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('View Case Studies', 'reviewservicepro'); ?>
            <?php echo $render_icon('arrow-right', 'h-4 w-4'); ?>
          </span>
        </a>

        <a
          href="<?php echo esc_url($audit_url); ?>"
          class="rsp-case-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[700] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
            <?php echo $render_icon('search-check', 'h-4 w-4'); ?>
          </span>
        </a>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    function initRspHomeCaseStudies() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var section = document.querySelector('[data-rsp-case-section]');

      if (!section) {
        return;
      }

      var items = section.querySelectorAll('[data-rsp-case-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspCaseVisible === 'true') {
          return;
        }

        item.dataset.rspCaseVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspHomeCaseStudies);
    } else {
      initRspHomeCaseStudies();
    }
  })();
</script>