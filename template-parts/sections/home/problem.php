<?php

/**
 * Home Problem Section
 *
 * Premium white SaaS problem section for ReviewService.Pro.
 *
 * Purpose:
 * - Explain common reputation management problems.
 * - Use proper image-based content to reduce text-heavy feeling.
 * - Preserve existing GSAP/animation targets and theme mod options.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$theme_uri   = trailingslashit(get_template_directory_uri());
$image_base  = $theme_uri . 'assets/images/home/problem/';

$problems = array(
  array(
    'number' => '01',
    'icon'   => 'message-square-warning',
    'image'  => $image_base . 'negative-review-response-risk.webp',
    'alt'    => esc_attr__('Illustration of an unanswered negative review alert inside a reputation management dashboard', 'reviewservicepro'),
    'title'  => get_theme_mod('problem_1_title', 'Negative Reviews Going Unanswered'),
    'text'   => get_theme_mod('problem_1_text', 'Every unanswered negative review can damage trust before a customer ever contacts your business. A professional response system helps protect credibility and show that you care.'),
    'impact' => get_theme_mod('problem_1_impact', 'Lost trust before the first conversation'),
  ),
  array(
    'number' => '02',
    'icon'   => 'radar',
    'image'  => $image_base . 'review-monitoring-alert-dashboard.webp',
    'alt'    => esc_attr__('Illustration of review monitoring alerts across multiple platforms in a SaaS dashboard', 'reviewservicepro'),
    'title'  => get_theme_mod('problem_2_title', 'No Review Monitoring System'),
    'text'   => get_theme_mod('problem_2_text', 'Reviews can appear across Google, Facebook, Trustpilot, Yelp, and other platforms. Without monitoring, important customer feedback can stay unnoticed.'),
    'impact' => get_theme_mod('problem_2_impact', 'Slow response creates reputation risk'),
  ),
  array(
    'number' => '03',
    'icon'   => 'messages-square',
    'image'  => $image_base . 'customer-feedback-workflow-gap.webp',
    'alt'    => esc_attr__('Illustration of a broken customer feedback workflow and missing review request process', 'reviewservicepro'),
    'title'  => get_theme_mod('problem_3_title', 'No Customer Feedback Strategy'),
    'text'   => get_theme_mod('problem_3_text', 'Satisfied customers often need a clear and ethical process to share feedback. Without a structured system, positive experiences may never become public trust signals.'),
    'impact' => get_theme_mod('problem_3_impact', 'Positive feedback remains invisible'),
  ),
  array(
    'number' => '04',
    'icon'   => 'map-pinned',
    'image'  => $image_base . 'local-trust-signal-comparison.webp',
    'alt'    => esc_attr__('Illustration of weak local trust signals compared with stronger competitor reputation profiles', 'reviewservicepro'),
    'title'  => get_theme_mod('problem_4_title', 'Weak Local Trust Signals'),
    'text'   => get_theme_mod('problem_4_text', 'A weak review profile can reduce customer confidence and make your business look less reliable compared to competitors with stronger reputation systems.'),
    'impact' => get_theme_mod('problem_4_impact', 'Competitors look more trustworthy'),
  ),
);

$section_heading = get_theme_mod('problem_heading', 'Is Your Business Losing Trust Because Reviews Are Unmanaged?');
$section_subline = get_theme_mod('problem_subline', 'Most businesses do not need shortcuts. They need a clear, ethical system for monitoring feedback, responding professionally, and building long-term customer trust.');
$bottom_text     = get_theme_mod('problem_bottom_text', 'If any of these problems feel familiar, your reputation system needs attention.');
$bottom_cta_text = get_theme_mod('problem_cta_text', 'See How We Fix This');
$bottom_cta_url  = get_theme_mod('problem_cta_url', home_url('/services/'));
?>

<section
  id="problem"
  class="relative overflow-hidden border-t border-slate-200 bg-[#F8FAFC] py-20 md:py-28"
  role="region"
  aria-label="<?php echo esc_attr__('Common reputation management problems', 'reviewservicepro'); ?>"
  data-gsap="problem-animate">
  <!-- Soft SaaS background. -->
  <div
    class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.09),transparent_34%),radial-gradient(circle_at_bottom_right,rgba(0,200,83,0.10),transparent_32%)]"
    aria-hidden="true"></div>

  <div
    class="absolute left-1/2 top-0 h-px w-full max-w-6xl -translate-x-1/2 bg-gradient-to-r from-transparent via-slate-300 to-transparent"
    aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

    <div class="mx-auto mb-16 max-w-3xl text-center" data-gsap-item="problem-heading">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-red-600 shadow-sm">
        <i data-lucide="triangle-alert" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('The reputation problem', 'reviewservicepro'); ?>
      </span>

      <h2 class="mx-auto max-w-3xl font-['Poppins',sans-serif] text-[clamp(30px,4.6vw,52px)] font-extrabold leading-[1.08] tracking-[-0.045em] text-[#07111F]">
        <?php echo wp_kses_post($section_heading); ?>
      </h2>

      <p class="mx-auto mt-5 max-w-2xl font-['Inter',sans-serif] text-[16px] font-normal leading-[1.75] text-slate-600 md:text-[17px]">
        <?php echo esc_html($section_subline); ?>
      </p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2" data-gsap-item="problem-cards">
      <?php foreach ($problems as $problem) : ?>
        <article class="group relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-4 shadow-[0_18px_60px_rgba(15,23,42,0.08)] transition-all duration-300 hover:-translate-y-1 hover:border-red-200 hover:shadow-[0_28px_90px_rgba(15,23,42,0.12)]">
          <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-red-400/70 via-blue-400/30 to-transparent" aria-hidden="true"></div>

          <div class="grid gap-5 sm:grid-cols-[190px_minmax(0,1fr)] sm:items-stretch">
            <div class="relative min-h-[210px] overflow-hidden rounded-[1.5rem] border border-slate-100 bg-slate-50">
              <img
                src="<?php echo esc_url($problem['image']); ?>"
                alt="<?php echo esc_attr($problem['alt']); ?>"
                class="h-full min-h-[210px] w-full object-cover transition duration-500 group-hover:scale-[1.04]"
                loading="lazy"
                decoding="async">

              <div class="absolute inset-0 bg-gradient-to-t from-[#07111F]/55 via-transparent to-transparent" aria-hidden="true"></div>

              <span class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full border border-white/35 bg-white/88 px-3 py-1.5 font-['DM_Mono',monospace] text-[11px] font-bold text-red-600 shadow-sm backdrop-blur-md">
                <?php echo esc_html($problem['number']); ?>
              </span>

              <div class="absolute bottom-4 left-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-white/30 bg-white/90 text-red-600 shadow-sm backdrop-blur-md">
                <i data-lucide="<?php echo esc_attr($problem['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
              </div>
            </div>

            <div class="flex min-w-0 flex-col justify-between p-2 sm:p-3">
              <div>
                <div class="mb-4 flex items-start justify-between gap-4">
                  <h3 class="font-['Poppins',sans-serif] text-[21px] font-extrabold leading-[1.18] tracking-[-0.03em] text-[#07111F]">
                    <?php echo esc_html($problem['title']); ?>
                  </h3>

                  <span class="hidden shrink-0 rounded-full bg-red-50 px-2.5 py-1 font-['DM_Mono',monospace] text-[11px] font-bold text-red-500 sm:inline-flex">
                    <?php echo esc_html($problem['number']); ?>
                  </span>
                </div>

                <p class="font-['Inter',sans-serif] text-[15px] font-normal leading-[1.75] text-slate-600">
                  <?php echo esc_html($problem['text']); ?>
                </p>
              </div>

              <div class="mt-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-red-200 bg-red-50 px-3.5 py-2 font-['Inter',sans-serif] text-[12.5px] font-semibold text-red-700">
                  <i data-lucide="trending-down" class="h-3.5 w-3.5" aria-hidden="true"></i>
                  <?php echo esc_html($problem['impact']); ?>
                </span>
              </div>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="mx-auto mt-16 max-w-4xl rounded-[2rem] border border-slate-200 bg-white p-6 text-center shadow-[0_18px_60px_rgba(15,23,42,0.08)] sm:p-8" data-gsap-item="problem-cta">
      <div class="mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
        <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
      </div>

      <p class="mx-auto mb-6 max-w-2xl font-['Inter',sans-serif] text-[15px] font-normal leading-[1.7] text-slate-600">
        <?php echo esc_html($bottom_text); ?>
      </p>

      <a
        href="<?php echo esc_url($bottom_cta_url); ?>"
        class="inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3 font-['Inter',sans-serif] text-[14px] font-bold text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.28)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700 hover:text-white hover:shadow-[0_22px_48px_rgba(37,99,235,0.34)] focus:outline-none focus:ring-4 focus:ring-blue-200">
        <?php echo esc_html($bottom_cta_text); ?>
        <i data-lucide="arrow-right" class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
      </a>
    </div>

  </div>
</section>