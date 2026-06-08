<?php

/**
 * Single Platform Template
 *
 * ReviewService.Pro — Premium White SaaS Single Platform Wrapper
 *
 * File: single-platforms.php
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
  class="relative overflow-hidden bg-white text-[#334155]"
  role="main">

  <?php
  if (have_posts()) :

    while (have_posts()) :
      the_post();
  ?>

      <article
        id="post-<?php the_ID(); ?>"
        <?php post_class('single-platform-page relative overflow-hidden bg-white'); ?>>

        <?php
        get_template_part('template-parts/platforms/platform', 'hero');
        get_template_part('template-parts/platforms/platform', 'overview');
        get_template_part('template-parts/platforms/platform', 'problems');
        get_template_part('template-parts/platforms/platform', 'content');
        get_template_part('template-parts/platforms/platform', 'related');
        get_template_part('template-parts/platforms/platform', 'cta');
        ?>

      </article>

    <?php
    endwhile;

  else :
    ?>

    <section
      class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 py-24 sm:px-6 lg:px-8"
      aria-labelledby="platform-not-found-title">

      <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
      <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[420px] w-[420px] rounded-full bg-blue-200/45 blur-[120px]" aria-hidden="true"></div>
      <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[420px] w-[420px] rounded-full bg-emerald-200/45 blur-[120px]" aria-hidden="true"></div>

      <div class="relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_24px_80px_rgba(15,23,42,0.08)] md:p-10">

          <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-red-200 bg-red-50 text-red-600">
            <?php
            if (function_exists('rsp_icon')) {
              echo wp_kses_post(rsp_icon('triangle-alert', 'h-7 w-7'));
            } else {
              echo '<i data-lucide="triangle-alert" class="h-7 w-7" aria-hidden="true"></i>';
            }
            ?>
          </div>

          <h1
            id="platform-not-found-title"
            class="font-['Poppins',sans-serif] text-3xl font-[800] leading-tight tracking-[-0.045em] text-[#334155] md:text-4xl">
            <?php esc_html_e('Platform guide not found', 'reviewservicepro'); ?>
          </h1>

          <p class="mt-5 font-['Inter',sans-serif] text-[16px] font-medium leading-8 text-[#64748B]">
            <?php esc_html_e('The requested platform guide could not be found or may no longer be available.', 'reviewservicepro'); ?>
          </p>

          <a
            href="<?php echo esc_url(home_url('/platforms/')); ?>"
            class="mt-8 inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-100">

            <span class="inline-flex items-center gap-2">
              <?php esc_html_e('Browse Platforms', 'reviewservicepro'); ?>

              <?php
              if (function_exists('rsp_icon')) {
                echo wp_kses_post(rsp_icon('arrow-right', 'h-4 w-4'));
              } else {
                echo '<i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>';
              }
              ?>
            </span>
          </a>

        </div>
      </div>
    </section>

  <?php endif; ?>

</main>

<script>
  (function() {
    function initSinglePlatformPage() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initSinglePlatformPage);
    } else {
      initSinglePlatformPage();
    }
  })();
</script>

<?php
get_footer();
