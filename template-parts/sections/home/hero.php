<?php

/**
 * Home Hero Section
 *
 * Premium ReviewService.Pro homepage hero section.
 *
 * Purpose:
 * - Strong first impression.
 * - SEO-friendly H1.
 * - Safe image asset handling for local/live migration.
 * - Connected CTA buttons.
 * - Compliance-safe reputation management positioning.
 * - GSAP targets preserved.
 *
 * @package ReviewServicePro
 */

defined('ABSPATH') || exit;

$theme_uri = trailingslashit(get_template_directory_uri());

$slides = array(
  array(
    'url' => $theme_uri . 'assets/images/hero/hero-4.jpg',
    'alt' => esc_attr__('AI powered online reputation management dashboard preview', 'reviewservicepro'),
  ),
  array(
    'url' => $theme_uri . 'assets/images/hero/hero-3.jpg',
    'alt' => esc_attr__('Reputation monitoring command center for business reviews', 'reviewservicepro'),
  ),
  array(
    'url' => $theme_uri . 'assets/images/hero/hero-2.jpg',
    'alt' => esc_attr__('Customer review and feedback intelligence workflow', 'reviewservicepro'),
  ),
  array(
    'url' => $theme_uri . 'assets/images/hero/hero-1.jpg',
    'alt' => esc_attr__('Ethical reputation growth strategy for trust focused businesses', 'reviewservicepro'),
  ),
);

$cta1_url = get_theme_mod('hero_cta1_url', home_url('/contact/?type=free-audit'));
$cta2_url = get_theme_mod('hero_cta2_url', home_url('/services/'));

if (empty($cta1_url)) {
  $cta1_url = home_url('/contact/?type=free-audit');
}

if (empty($cta2_url)) {
  $cta2_url = home_url('/services/');
}

$trust_items = array(
  esc_html__('No fake reviews', 'reviewservicepro'),
  esc_html__('AI-assisted monitoring', 'reviewservicepro'),
  esc_html__('Platform-compliant support', 'reviewservicepro'),
  esc_html__('Transparent reporting', 'reviewservicepro'),
);

$hero_stats = array(
  array(
    'value'  => '10',
    'suffix' => '+',
    'label'  => esc_html__('Review platforms supported', 'reviewservicepro'),
  ),
  array(
    'value'  => '3',
    'suffix' => '',
    'label'  => esc_html__('Core ORM workflows', 'reviewservicepro'),
  ),
  array(
    'value'  => '0',
    'suffix' => '',
    'label'  => esc_html__('Fake-review tactics used', 'reviewservicepro'),
  ),
);
?>

<section
  id="hero"
  class="relative flex min-h-[92vh] items-center overflow-hidden bg-[#07111F] py-0"
  role="region"
  aria-label="<?php echo esc_attr__('ReviewService.Pro introduction', 'reviewservicepro'); ?>">
  <style>
    #hero {
      --hero-blue: #2563EB;
      --hero-blue-light: #3B82F6;
      --hero-green: #00C853;
      --hero-teal: #14B8A6;
      --hero-navy: #07111F;
      --hero-text: rgba(226, 232, 240, 0.94);
      --hero-muted: rgba(203, 213, 225, 0.88);
    }

    #hero .rsp-hero-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #hero .rsp-hero-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(42px, 6.45vw, 78px);
      font-weight: 800;
      line-height: 1.02;
      letter-spacing: -0.062em;
      color: #ffffff !important;
    }

    #hero .rsp-hero-title-solid {
      color: #ffffff !important;
      opacity: 1 !important;
      -webkit-text-fill-color: #ffffff !important;
    }

    #hero .rsp-hero-title-gradient {
      background-image: linear-gradient(90deg, #00C853 0%, #3B82F6 52%, #60A5FA 100%);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent !important;
      -webkit-text-fill-color: transparent !important;
    }

    #hero .rsp-hero-main-text {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.82;
      color: var(--hero-text);
    }

    #hero .rsp-hero-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #hero .rsp-hero-motion-border::before {
      content: "";
      position: absolute;
      inset: -85%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.10),
          rgba(0, 200, 83, 0.38),
          rgba(20, 184, 166, 0.26),
          rgba(59, 130, 246, 0.38),
          rgba(37, 99, 235, 0.10));
      opacity: 0.74;
      transform: rotate(0deg);
      animation: rspHeroBorderSpin 7.2s linear infinite;
      transition: opacity 260ms ease;
      pointer-events: none;
    }

    #hero .rsp-hero-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--hero-inner-bg, rgba(255, 255, 255, 0.10));
      backdrop-filter: blur(18px);
      pointer-events: none;
    }

    #hero .rsp-hero-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4s;
    }

    #hero .rsp-hero-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        background-color 260ms ease,
        border-color 260ms ease;
    }

    #hero .rsp-hero-btn::before {
      content: "";
      position: absolute;
      top: 0;
      left: -120%;
      z-index: 0;
      width: 70%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.30), transparent);
      transform: skewX(-18deg);
      transition: left 720ms ease;
      pointer-events: none;
    }

    #hero .rsp-hero-btn:hover {
      transform: translateY(-4px);
    }

    #hero .rsp-hero-btn:hover::before {
      left: 135%;
    }

    #hero .rsp-hero-primary {
      --hero-inner-bg: #2563EB;
    }

    #hero .rsp-hero-secondary {
      --hero-inner-bg: rgba(255, 255, 255, 0.085);
    }

    #hero .rsp-hero-primary:hover {
      box-shadow:
        0 8px 18px rgba(37, 99, 235, 0.28),
        0 26px 60px rgba(37, 99, 235, 0.48);
    }

    #hero .rsp-hero-secondary:hover {
      box-shadow:
        0 8px 18px rgba(255, 255, 255, 0.08),
        0 24px 56px rgba(37, 99, 235, 0.22);
    }

    /*
     * Clean static stat cards:
     * - No moving border
     * - No inner animation
     * - Premium static glass style
     */
    #hero .rsp-hero-stat {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      min-height: 118px;
      border: 1px solid rgba(255, 255, 255, 0.13);
      background:
        linear-gradient(135deg, rgba(255, 255, 255, 0.105), rgba(255, 255, 255, 0.055)),
        rgba(7, 17, 31, 0.34);
      box-shadow:
        0 1px 0 rgba(255, 255, 255, 0.08) inset,
        0 16px 44px rgba(0, 0, 0, 0.20);
      backdrop-filter: blur(18px);
      transition:
        border-color 240ms ease,
        box-shadow 240ms ease,
        background-color 240ms ease;
    }

    #hero .rsp-hero-stat::before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: 0;
      border-radius: inherit;
      background:
        radial-gradient(circle at 20% 18%, rgba(0, 200, 83, 0.16), transparent 34%),
        radial-gradient(circle at 86% 82%, rgba(37, 99, 235, 0.16), transparent 34%);
      opacity: 0.68;
      pointer-events: none;
    }

    #hero .rsp-hero-stat::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: 1;
      border-radius: inherit;
      border-top: 1px solid rgba(255, 255, 255, 0.18);
      pointer-events: none;
    }

    #hero .rsp-hero-stat:hover {
      border-color: rgba(255, 255, 255, 0.23);
      box-shadow:
        0 1px 0 rgba(255, 255, 255, 0.11) inset,
        0 22px 58px rgba(0, 0, 0, 0.24);
    }

    #hero .rsp-hero-stat,
    #hero .rsp-hero-stat *,
    #hero .rsp-hero-stat::before,
    #hero .rsp-hero-stat::after {
      animation: none !important;
      transform: none !important;
    }

    #hero .rsp-hero-stat-value {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      text-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
    }

    #hero .rsp-hero-stat-label {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: rgba(255, 255, 255, 0.92) !important;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.92) !important;
    }

    #hero .rsp-hero-title-line {
      transform-origin: left;
      animation: rspHeroTitleLine 2.7s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
    }

    #hero .rsp-hero-trust-item {
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        color 260ms ease;
    }

    #hero .rsp-hero-trust-item:hover {
      transform: translateY(-2px);
      color: #ffffff;
    }

    @keyframes rspHeroBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspHeroTitleLine {
      from {
        transform: scaleX(0.45);
        opacity: 0.42;
      }

      to {
        transform: scaleX(1);
        opacity: 1;
      }
    }

    @media (max-width: 767px) {
      #hero .rsp-hero-title {
        letter-spacing: -0.052em;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #hero *,
      #hero *::before,
      #hero *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      #hero .rsp-hero-btn:hover,
      #hero .rsp-hero-trust-item:hover {
        transform: none;
      }
    }
  </style>

  <!-- Background slides: GSAP/JS targets preserved. -->
  <div class="absolute inset-0 z-0 overflow-hidden" aria-hidden="true">
    <?php foreach ($slides as $index => $slide) : ?>
      <div
        class="hero-bg-slide absolute inset-0 scale-105 bg-cover bg-no-repeat opacity-0 transition-opacity duration-[1400ms] ease-out <?php echo 0 === $index ? 'is-active opacity-100' : ''; ?>"
        style="background-image: url('<?php echo esc_url($slide['url']); ?>'); background-position: 72% center;"
        data-slide-index="<?php echo esc_attr($index); ?>"></div>
    <?php endforeach; ?>
  </div>

  <!-- Premium readable overlay. -->
  <div class="absolute inset-0 z-[1] bg-[#07111F]/38" aria-hidden="true"></div>
  <div class="absolute inset-0 z-[1] bg-gradient-to-r from-[#07111F]/94 via-[#07111F]/74 via-56% to-[#07111F]/28" aria-hidden="true"></div>
  <div class="absolute inset-0 z-[1] bg-gradient-to-t from-[#07111F]/78 via-transparent to-[#07111F]/12" aria-hidden="true"></div>

  <!-- Glow orbs. -->
  <div class="absolute -left-32 top-24 z-[2] h-96 w-96 rounded-full bg-blue-500/28 blur-[120px]" aria-hidden="true"></div>
  <div class="absolute -right-32 bottom-12 z-[2] h-96 w-96 rounded-full bg-emerald-400/20 blur-[130px]" aria-hidden="true"></div>
  <div class="absolute left-1/2 top-1/3 z-[2] h-72 w-72 -translate-x-1/2 rounded-full bg-blue-400/12 blur-[110px]" aria-hidden="true"></div>

  <!-- Soft grid texture. -->
  <div
    class="absolute inset-0 z-[2] bg-[linear-gradient(rgba(255,255,255,0.024)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.024)_1px,transparent_1px)] bg-[size:64px_64px]"
    aria-hidden="true"></div>

  <!-- Content. -->
  <div class="relative z-[3] mx-auto w-full max-w-7xl px-5 pb-[clamp(76px,10vh,118px)] pt-[clamp(116px,14vh,154px)] sm:px-6 lg:px-8">
    <div class="max-w-[1020px]" data-gsap="hero-animate">

      <div data-gsap-item="eyebrow">
        <span class="rsp-hero-eyebrow mb-7 inline-flex items-center gap-2 rounded-full border border-emerald-400/28 bg-emerald-400/[0.09] px-4 py-[7px] text-emerald-200/90 shadow-[0_0_28px_rgba(0,200,83,0.18)] backdrop-blur-xl">
          <i data-lucide="sparkles" class="h-[13px] w-[13px]" aria-hidden="true"></i>
          <?php esc_html_e('AI-Driven ORM Platform', 'reviewservicepro'); ?>
        </span>
      </div>

      <h1
        data-gsap-item="headline"
        class="rsp-hero-title m-0 max-w-[980px]">
        <span class="rsp-hero-title-solid block"><?php esc_html_e('AI-Driven Online', 'reviewservicepro'); ?></span>

        <span class="relative inline-block">
          <span class="rsp-hero-title-gradient relative z-10">
            <?php esc_html_e('Reputation Management', 'reviewservicepro'); ?>
          </span>
          <span class="rsp-hero-title-line absolute bottom-2 left-0 right-0 h-[4px] rounded-full bg-gradient-to-r from-[#00C853]/35 via-[#3B82F6]/45 to-transparent" aria-hidden="true"></span>
        </span>

        <span class="rsp-hero-title-solid block"><?php esc_html_e('Services', 'reviewservicepro'); ?></span>
      </h1>

      <p
        data-gsap-item="subline"
        class="rsp-hero-main-text mt-7 max-w-[700px]">
        <?php esc_html_e('ReviewService.Pro helps businesses monitor reviews, respond professionally, document review issues, improve customer feedback workflows, and build long-term trust through ethical, platform-compliant online reputation management services.', 'reviewservicepro'); ?>
      </p>

      <div data-gsap-item="cta-row" class="mt-9 flex flex-wrap items-center gap-4">
        <a
          href="<?php echo esc_url($cta1_url); ?>"
          class="rsp-hero-btn rsp-hero-motion-border rsp-hero-primary group inline-flex min-h-[56px] items-center gap-2 rounded-[16px] border border-blue-400/25 bg-blue-600 px-7 py-[15px] font-['Inter',sans-serif] text-[16px] font-semibold text-white no-underline shadow-[0_4px_6px_rgba(37,99,235,0.2),0_14px_38px_rgba(37,99,235,0.34)] hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-400/25">
          <span class="relative z-10 inline-flex items-center gap-2">
            <i data-lucide="calendar-check" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Book Free Consultation', 'reviewservicepro'); ?>
          </span>
        </a>

        <a
          href="<?php echo esc_url($cta2_url); ?>"
          class="rsp-hero-btn rsp-hero-motion-border rsp-hero-secondary group inline-flex min-h-[56px] items-center gap-2 rounded-[16px] border border-white/15 bg-white/[0.07] px-7 py-[14px] font-['Inter',sans-serif] text-[16px] font-medium text-slate-100 no-underline backdrop-blur-xl hover:border-white/28 hover:bg-white/[0.11] hover:text-white focus:outline-none focus:ring-4 focus:ring-white/10">
          <span class="relative z-10 inline-flex items-center gap-2">
            <?php esc_html_e('Explore Services', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true"></i>
          </span>
        </a>
      </div>

      <dl data-gsap-item="stats" class="mt-12 grid max-w-[760px] grid-cols-1 gap-4 sm:grid-cols-3">
        <?php foreach ($hero_stats as $stat) : ?>
          <div class="rsp-hero-stat rounded-[18px] px-5 py-5 text-center">
            <dd class="rsp-hero-stat-value relative z-10 text-[34px] font-[800] leading-none tracking-[-0.035em]">
              <?php echo esc_html($stat['value']); ?><span class="ml-0.5 font-['Inter',sans-serif] text-[15px] font-[700] text-blue-300"><?php echo esc_html($stat['suffix']); ?></span>
            </dd>

            <dt class="rsp-hero-stat-label relative z-10 mx-auto mt-3 max-w-[150px] text-[15px] font-[600] leading-[1.45]">
              <?php echo esc_html($stat['label']); ?>
            </dt>
          </div>
        <?php endforeach; ?>
      </dl>

      <div
        data-gsap-item="trust-bar"
        class="mt-9 flex max-w-4xl flex-wrap gap-x-6 gap-y-3 border-t border-white/[0.08] pt-7">
        <?php foreach ($trust_items as $item) : ?>
          <span class="rsp-hero-trust-item flex items-center gap-2 font-['Inter',sans-serif] text-[16px] font-normal text-slate-200/95">
            <i data-lucide="check-circle-2" class="h-[16px] w-[16px] flex-shrink-0 text-emerald-400" aria-hidden="true"></i>
            <?php echo esc_html($item); ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Progress bar: JS target preserved. -->
  <div class="absolute bottom-8 left-1/2 z-[4] h-[3px] w-36 -translate-x-1/2 overflow-hidden rounded-full bg-white/10" aria-hidden="true">
    <div id="hero-progress" class="h-full w-0 rounded-full bg-blue-500 transition-none"></div>
  </div>

  <!-- Section boundary. -->
  <div class="absolute bottom-0 left-0 right-0 z-[4] h-px bg-gradient-to-r from-transparent via-white/[0.07] to-transparent" aria-hidden="true"></div>
</section>