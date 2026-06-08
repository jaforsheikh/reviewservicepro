<?php

/**
 * Search Results Template
 *
 * ReviewService.Pro — Premium White SaaS Search Results
 *
 * File: search.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

global $wp_query;

$search_query  = get_search_query();
$total_results = isset($wp_query->found_posts) ? (int) $wp_query->found_posts : 0;
$audit_url     = home_url('/contact/?type=audit');
$academy_url   = home_url('/orm-academy/');

$render_icon = function ($icon, $classes = 'h-4 w-4') {
  if (function_exists('rsp_icon')) {
    return wp_kses_post(rsp_icon($icon, $classes));
  }

  return '<i data-lucide="' . esc_attr($icon) . '" class="' . esc_attr($classes) . '" aria-hidden="true"></i>';
};
?>

<main
  id="rsp-search-page"
  class="relative overflow-hidden bg-white"
  role="main">

  <style>
    #rsp-search-page {
      --rsp-search-title: #334155;
      --rsp-search-heading: #3B4658;
      --rsp-search-body: #64748B;
      --rsp-search-blue: #2563EB;
      --rsp-search-green: #00C853;
    }

    #rsp-search-page .rsp-search-title,
    #rsp-search-page .rsp-search-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #rsp-search-page .rsp-search-title {
      color: var(--rsp-search-title);
      text-wrap: balance;
    }

    #rsp-search-page .rsp-search-heading {
      color: var(--rsp-search-heading);
    }

    #rsp-search-page .rsp-search-text,
    #rsp-search-page .rsp-search-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-search-body);
    }

    #rsp-search-page .rsp-search-text {
      font-weight: 500;
    }

    #rsp-search-page .rsp-search-body {
      font-weight: 400;
    }

    #rsp-search-page .rsp-search-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #rsp-search-page .rsp-search-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #rsp-search-page .rsp-search-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #rsp-search-page .rsp-search-card {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 320ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #rsp-search-page .rsp-search-card:hover {
      transform: translateY(-6px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
    }

    #rsp-search-page .rsp-search-card-image img {
      transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
    }

    #rsp-search-page .rsp-search-card:hover .rsp-search-card-image img {
      transform: scale(1.06);
    }

    #rsp-search-page .rsp-search-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #rsp-search-page .rsp-search-btn::before {
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

    #rsp-search-page .rsp-search-btn:hover {
      transform: translateY(-3px);
    }

    #rsp-search-page .rsp-search-btn:hover::before {
      left: 135%;
    }

    #rsp-search-page .rsp-search-pagination .nav-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.75rem;
    }

    #rsp-search-page .rsp-search-pagination .page-numbers {
      display: inline-flex;
      min-width: 44px;
      height: 44px;
      align-items: center;
      justify-content: center;
      border-radius: 0.9rem;
      border: 1px solid rgba(148, 163, 184, 0.26);
      background: #ffffff;
      padding: 0 0.9rem;
      font-family: "Inter", sans-serif;
      font-size: 14px;
      font-weight: 800;
      color: #475569;
      box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
      transition:
        transform 220ms ease,
        background-color 220ms ease,
        border-color 220ms ease,
        color 220ms ease;
    }

    #rsp-search-page .rsp-search-pagination .page-numbers:hover,
    #rsp-search-page .rsp-search-pagination .page-numbers.current {
      transform: translateY(-2px);
      border-color: rgba(37, 99, 235, 0.28);
      background: #2563EB;
      color: #ffffff;
    }

    @media (prefers-reduced-motion: reduce) {

      #rsp-search-page *,
      #rsp-search-page *::before,
      #rsp-search-page *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
      }

      #rsp-search-page .rsp-search-reveal {
        opacity: 1;
        transform: none;
      }

      #rsp-search-page .rsp-search-card:hover,
      #rsp-search-page .rsp-search-btn:hover {
        transform: none;
      }
    }
  </style>

  <!-- Hero -->
  <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">
      <div class="mx-auto max-w-4xl text-center">
        <?php if (function_exists('rsp_breadcrumb')) : ?>
          <div class="rsp-search-reveal mb-8 flex justify-center" data-rsp-search-reveal>
            <?php rsp_breadcrumb(); ?>
          </div>
        <?php endif; ?>

        <span class="rsp-search-eyebrow rsp-search-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-search-reveal>
          <?php echo $render_icon('search', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>
          <?php esc_html_e('Search Results', 'reviewservicepro'); ?>
        </span>

        <h1 class="rsp-search-title rsp-search-reveal mx-auto text-[clamp(36px,5.5vw,72px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-search-reveal>
          <?php esc_html_e('Results for', 'reviewservicepro'); ?>
          <span class="block bg-gradient-to-r from-blue-600 via-[#00C853] to-blue-500 bg-clip-text text-transparent">
            “<?php echo esc_html($search_query); ?>”
          </span>
        </h1>

        <p class="rsp-search-text rsp-search-reveal mx-auto mt-6 max-w-3xl" data-rsp-search-reveal>
          <?php
          printf(
            /* translators: %s: search results count */
            esc_html__('We found %s results related to reputation management, reviews, local SEO, customer trust, and ORM strategy.', 'reviewservicepro'),
            esc_html((string) $total_results)
          );
          ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Results -->
  <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-16 sm:px-6 lg:px-8 lg:py-20">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl">

      <div class="rsp-search-reveal mb-10 rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.07)] md:p-7" data-rsp-search-reveal>
        <?php get_search_form(); ?>
      </div>

      <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
          <?php
          $result_index = 0;

          while (have_posts()) :
            the_post();

            $post_type   = get_post_type();
            $post_type_o = get_post_type_object($post_type);
            $type_label  = $post_type_o && ! empty($post_type_o->labels->singular_name) ? $post_type_o->labels->singular_name : __('Resource', 'reviewservicepro');
            $terms       = [];

            if ('post' === $post_type) {
              $terms = get_the_category();
            } elseif ('platforms' === $post_type) {
              $terms = get_the_terms(get_the_ID(), 'platform_type');
            } elseif ('industries' === $post_type) {
              $terms = get_the_terms(get_the_ID(), 'industry_type');
            } elseif ('case_studies' === $post_type) {
              $terms = get_the_terms(get_the_ID(), 'case_study_type');
            }

            $delay = min($result_index * 70, 420);
          ?>

            <article
              id="post-<?php the_ID(); ?>"
              <?php post_class('rsp-search-card rsp-search-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
              data-rsp-search-reveal
              style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">

              <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                <div class="rsp-search-card-image h-56 overflow-hidden bg-slate-100">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                  <?php else : ?>
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                      <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                        <?php echo $render_icon('file-text', 'h-8 w-8'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <div class="p-6">
                  <div class="mb-4 flex flex-wrap items-center gap-2">
                    <span class="rsp-search-eyebrow rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-emerald-700">
                      <?php echo esc_html($type_label); ?>
                    </span>

                    <?php if (! empty($terms) && ! is_wp_error($terms)) : ?>
                      <?php foreach (array_slice($terms, 0, 1) as $term) : ?>
                        <span class="rsp-search-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                          <?php echo esc_html($term->name); ?>
                        </span>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                  <h2 class="rsp-search-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                    <?php the_title(); ?>
                  </h2>

                  <p class="rsp-search-body mt-4">
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?>
                  </p>

                  <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                    <span class="font-['Inter',sans-serif] text-sm font-semibold text-slate-500">
                      <?php echo esc_html(get_the_date()); ?>
                    </span>

                    <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                      <?php esc_html_e('Open result', 'reviewservicepro'); ?>
                      <?php echo $render_icon('arrow-right', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                      ?>
                    </span>
                  </div>
                </div>
              </a>
            </article>

          <?php
            $result_index++;
          endwhile;
          ?>
        </div>

        <div class="rsp-search-pagination mt-12">
          <?php
          the_posts_pagination(
            [
              'mid_size'           => 2,
              'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
              'next_text'          => esc_html__('Next', 'reviewservicepro'),
              'screen_reader_text' => esc_html__('Search navigation', 'reviewservicepro'),
            ]
          );
          ?>
        </div>

      <?php else : ?>
        <div class="rsp-search-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-search-reveal>
          <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
            <?php echo $render_icon('search-x', 'h-10 w-10'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
          </div>

          <h2 class="rsp-search-heading text-3xl font-[800] leading-tight tracking-[-0.045em]">
            <?php esc_html_e('No results found.', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-search-text mx-auto mt-4 max-w-2xl">
            <?php esc_html_e('Try searching for Google reviews, Trustpilot strategy, customer feedback, local SEO, ORM, reputation monitoring, or review response tips.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a href="<?php echo esc_url($academy_url); ?>" class="rsp-search-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php echo $render_icon('book-open', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Browse ORM Academy', 'reviewservicepro'); ?>
              </span>
            </a>

            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="rsp-search-btn inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-[#3B4658] no-underline shadow-sm hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
              <span class="relative z-10 inline-flex items-center gap-2">
                <?php echo $render_icon('message-circle', 'h-4 w-4'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
                <?php esc_html_e('Contact Us', 'reviewservicepro'); ?>
              </span>
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Final CTA -->
  <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-5xl text-center">
      <div class="rsp-search-reveal rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-search-reveal>
        <h2 class="rsp-search-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
          <?php esc_html_e('Need help improving your reputation?', 'reviewservicepro'); ?>
        </h2>

        <p class="rsp-search-text mx-auto mt-5 max-w-2xl">
          <?php esc_html_e('Get a free reputation audit and discover what is hurting your online trust, visibility, and customer conversion rate.', 'reviewservicepro'); ?>
        </p>

        <a href="<?php echo esc_url($audit_url); ?>" class="rsp-search-btn mt-8 inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-8 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php echo $render_icon('shield-check', 'h-5 w-5'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
            ?>
            <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
          </span>
        </a>
      </div>
    </div>
  </section>

</main>

<script>
  (function() {
    function initRspSearchPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-search-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspSearchVisible === 'true') {
          return;
        }

        item.dataset.rspSearchVisible = 'true';
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
      document.addEventListener('DOMContentLoaded', initRspSearchPage);
    } else {
      initRspSearchPage();
    }
  })();
</script>

<?php
get_footer();
