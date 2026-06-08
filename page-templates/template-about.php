<?php

/**
 * Template Name: About Page - Premium Motion SaaS V2
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

// SEO Optimized Professional Data Arrays
$values = [
  ['icon' => 'shield-check', 'title' => __('Enterprise Trust Compliance', 'reviewservicepro'), 'desc' => __('100% platform-compliant frameworks. We prevent penalty risks by completely eliminating manipulative tactics.', 'reviewservicepro')],
  ['icon' => 'eye', 'title' => __('Real-Time Transparency', 'reviewservicepro'), 'desc' => __('Granular reporting dashboards with clear, measurable reputation analytics and absolute strategy clarity.', 'reviewservicepro')],
  ['icon' => 'users', 'title' => __('Human-Centric AI Sentiment', 'reviewservicepro'), 'desc' => __('We seamlessly combine high-end sentiment intelligence engines with nuanced human oversight and empathy.', 'reviewservicepro')],
  ['icon' => 'trending-up', 'title' => __('Compound Reputation Growth', 'reviewservicepro'), 'desc' => __('Building baseline defensive assets that organically turn digital trust into sustainable conversions.', 'reviewservicepro')],
];

$platforms = ['Google Business', 'Trustpilot', 'Yelp Enterprise', 'Meta for Business', 'Better Business Bureau', 'Tripadvisor', 'G2 Crowd', 'Capterra Insights'];

$industries = [
  __('Healthcare Clinics', 'reviewservicepro'),
  __('Corporate Law Firms', 'reviewservicepro'),
  __('Premium Real Estate', 'reviewservicepro'),
  __('Enterprise SaaS', 'reviewservicepro'),
  __('Multi-Location Retail', 'reviewservicepro'),
  __('E-commerce Brands', 'reviewservicepro'),
];

$process = [
  ['num' => '01', 'title' => __('Deep Reputation & Risk Audit', 'reviewservicepro'), 'desc' => __('We map structural sentiment gaps, review velocity trends, toxic profile patterns, and competitor exposure.', 'reviewservicepro')],
  ['num' => '02', 'title' => __('Compliant Growth Engineering', 'reviewservicepro'), 'desc' => __('We set up white-hat review generation funnels optimized to pull real customer feedback safely.', 'reviewservicepro')],
  ['num' => '03', 'title' => __('Crisis Interception & Monitoring', 'reviewservicepro'), 'desc' => __('Our systems flag and mitigate incoming velocity drops, managing brand safety around the clock.', 'reviewservicepro')],
  ['num' => '04', 'title' => __('Performance Intelligence', 'reviewservicepro'), 'desc' => __('Comprehensive conversion reporting showing clear growth metrics, search visibility gains, and brand trust lift.', 'reviewservicepro')],
];

$faqs = [
  [
    'q' => __('Do you sell or auto-generate business reviews?', 'reviewservicepro'),
    'a' => __('Absolutely not. ReviewService.Pro strictly deploys ethical, white-hat Online Reputation Management frameworks. We engineer platform-compliant feedback infrastructure that optimizes organic customer acquisition without violating guidelines.', 'reviewservicepro'),
  ],
  [
    'q' => __('How does your ORM system scale local search engine visibility?', 'reviewservicepro'),
    'a' => __('By optimizing organic review signals, response speed patterns, and semantic trust factors. This directly translates to improved visibility inside local map packs and high-intent organic search layouts.', 'reviewservicepro'),
  ],
];
?>

<style>
  /* ==========================================================================
	   HIGH-END SAAS BORDER MOTION & ANIMATION ENGINE
	   ========================================================================== */

  /* ১. স্ক্রোল রিভিল মোশন (কার্ডগুলো নিচ থেকে স্মুথলি ভেসে উঠবে) */
  .rsp-motion-reveal {
    opacity: 0;
    transform: translateY(30px);
    will-change: transform, opacity;
    transition: opacity 1000ms cubic-bezier(0.16, 1, 0.3, 1), transform 1000ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-motion-reveal.rsp-active {
    opacity: 1;
    transform: translateY(0);
  }

  /* ২. অনবরত ঘূর্ণায়মান বর্ডার মোশন (Continuous Border Animation) */
  .rsp-animated-border-card {
    position: relative;
    background: #ffffff;
    border-radius: 24px;
    z-index: 1;
    /* একটি লাইট ডিফল্ট বর্ডার যেন ব্যাকগ্রাউন্ডের সাথে মিশে না যায় */
    box-shadow: 0 0 0 1px rgba(226, 232, 240, 0.8);
    overflow: hidden;
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  }

  /* বর্ডারের ভেতরের কন্টেন্ট সেভ রাখার কন্টেইনার */
  .rsp-card-inner {
    position: relative;
    z-index: 3;
    height: 100%;
    width: 100%;
    background: #ffffff;
    border-radius: 23px;
  }

  /* মোশন বর্ডার ট্র্যাক তৈরি (ঘূর্ণায়মান লাইট) */
  .rsp-animated-border-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    /* ব্র্যান্ডের নীল ও সবুজ কালার দিয়ে নিয়ন বর্ডার লাইন */
    background: conic-gradient(from 0deg,
        transparent 40%,
        #2563eb 50%,
        #00c853 60%,
        transparent 70%);
    animation: rotateBorderBeam 4s linear infinite;
    z-index: -1;
    opacity: 0.4;
    /* সবসময় হালকা মোশন চলতে থাকবে */
    transition: opacity 0.3s ease;
  }

  /* হোভার করলে কার্ডের এনিমেশন আরও পপ করবে */
  .rsp-animated-border-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px -15px rgba(37, 99, 235, 0.12), 0 0 0 1px rgba(37, 99, 235, 0.2);
  }

  .rsp-animated-border-card:hover::before {
    opacity: 1;
    /* হোভার করলে বর্ডার লাইট আরও উজ্জ্বল হবে */
    animation-duration: 2.5s;
    /* স্পিড একটু বাড়বে */
  }

  /* বর্ডার ঘোরার কি-ফ্রেম */
  @keyframes rotateBorderBeam {
    100% {
      transform: rotate(360deg);
    }
  }

  /* ডট ম্যাট্রিক্স ব্যাকগ্রাউন্ড */
  .rsp-dot-matrix {
    background-image: radial-gradient(#e2e8f0 1.5px, transparent 1.5px);
    background-size: 24px 24px;
  }

  /* হিরো ইমেজ ফ্লোটিং অ্যানিমেশন */
  @keyframes floatDashboard {

    0%,
    100% {
      transform: translateY(0px) rotate(0deg);
    }

    50% {
      transform: translateY(-12px) rotate(0.5deg);
    }
  }

  .rsp-animate-float {
    animation: floatDashboard 6s ease-in-out infinite;
  }
</style>

<section class="relative overflow-hidden bg-[#fafbfc] px-4 py-20 lg:py-32" aria-labelledby="hero-heading">
  <div class="rsp-dot-matrix absolute inset-0 opacity-60"></div>
  <div class="pointer-events-none absolute -left-20 top-0 h-[600px] w-[600px] rounded-full bg-blue-500/[0.04] blur-[120px]"></div>
  <div class="pointer-events-none absolute -right-20 top-20 h-[600px] w-[600px] rounded-full bg-emerald-500/[0.04] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl">
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:items-center">

      <div class="rsp-motion-reveal lg:col-span-6" data-rsp-motion>
        <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50/70 px-4 py-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-700 shadow-sm">
          <span class="h-1.5 w-1.5 animate-ping rounded-full bg-blue-600"></span>
          <?php esc_html_e('Enterprise Reputation Infrastructure', 'reviewservicepro'); ?>
        </span>

        <h1 id="hero-heading" class="mb-6 text-4xl font-black leading-[1.1] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
          <?php esc_html_e('We Build Digital', 'reviewservicepro'); ?>
          <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-emerald-600 bg-clip-text text-transparent">
            <?php esc_html_e('Trust Architecture', 'reviewservicepro'); ?>
          </span>
          <?php esc_html_e('For Global Brands.', 'reviewservicepro'); ?>
        </h1>

        <p class="mb-8 text-base leading-relaxed text-slate-600 sm:text-lg">
          <?php esc_html_e('ReviewService.Pro engineers fully compliant, automated online reputation funnels. We empower businesses to seamlessly capture verified user reviews, streamline response metrics, and grow local visibility safely.', 'reviewservicepro'); ?>
        </p>

        <div class="flex flex-wrap items-center gap-4">
          <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="group inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-4 text-sm font-bold text-white shadow-xl shadow-blue-600/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-blue-600/30">
            <?php esc_html_e('Run Free Reputation Audit', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4 transition-transform group-hover:translate-x-1"></i>
          </a>
        </div>
      </div>

      <div class="rsp-motion-reveal lg:col-span-6" data-rsp-motion>
        <div class="rsp-animated-border-card rsp-animate-float p-[2px]">
          <div class="rsp-card-inner p-4 shadow-2xl">
            <div class="mb-4 flex items-center gap-1.5 border-b border-slate-100 pb-3">
              <span class="h-3 w-3 rounded-full bg-rose-400"></span>
              <span class="h-3 w-3 rounded-full bg-amber-400"></span>
              <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
              <span class="ml-4 text-[11px] font-semibold text-slate-400 tracking-wide">reviewservice.pro/dashboard/analytics</span>
            </div>

            <div class="relative overflow-hidden rounded-xl bg-slate-50">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/dashboard-mockup.png'); ?>"
                alt="ReviewService.Pro Dashboard Analytics"
                class="w-full h-auto object-cover min-h-[300px]"
                onerror="this.onerror=null; this.parentNode.innerHTML='<div class=\" w-full min-h-[300px] bg-slate-50 flex flex-col items-center justify-center p-8 text-center\"><i data-lucide=\"layout-dashboard\" class=\"h-12 w-12 text-blue-500 mb-3 animate-pulse\"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-white py-20 lg:py-28">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1fr_1.2fr] lg:items-start">

      <div class="rsp-motion-reveal" data-rsp-motion>
        <span class="mb-4 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-[11px] font-bold uppercase tracking-wider text-emerald-800">
          <?php esc_html_e('Our Operational Blueprint', 'reviewservicepro'); ?>
        </span>
        <h2 class="mb-6 text-3xl font-black tracking-wide text-slate-800 md:text-4xl">
          <?php esc_html_e('Replacing risky shortcuts with transparent growth architecture.', 'reviewservicepro'); ?>
        </h2>
        <p class="text-base leading-relaxed text-slate-600">
          <?php esc_html_e('ReviewService.Pro was established to counter dark-hat industry manipulation. We engineered a secure framework that protects local businesses from reviews deletion, platform blacklisting, and brand degradation.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

        <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion>
          <div class="rsp-card-inner p-6">
            <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><i data-lucide="crosshair" class="h-5 w-5"></i></div>
            <h3 class="mb-2 text-lg font-bold text-slate-900"><?php esc_html_e('Why We Exist', 'reviewservicepro'); ?></h3>
            <p class="text-xs leading-relaxed text-slate-600"><?php esc_html_e('To systematically defend local brands, optimize authentic user sentiment loops, and drive validated search conversions.', 'reviewservicepro'); ?></p>
          </div>
        </div>

        <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion>
          <div class="rsp-card-inner p-6">
            <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"><i data-lucide="compass" class="h-5 w-5"></i></div>
            <h3 class="mb-2 text-lg font-bold text-slate-900"><?php esc_html_e('What We Believe', 'reviewservicepro'); ?></h3>
            <p class="text-xs leading-relaxed text-slate-600"><?php esc_html_e('Brand authority must be compoundable, platform-safe, data-backed, and engineered for durable search visibility.', 'reviewservicepro'); ?></p>
          </div>
        </div>

        <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px] sm:col-span-2" data-rsp-motion>
          <div class="rsp-card-inner p-6">
            <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"><i data-lucide="award" class="h-5 w-5"></i></div>
            <h3 class="mb-2 text-lg font-bold text-slate-900"><?php esc_html_e('The Corporate Philosophy', 'reviewservicepro'); ?></h3>
            <p class="text-xs leading-relaxed text-slate-600"><?php esc_html_e('We ignore arbitrary quick-fixes. We focus entirely on launching sustainable capture funnels, continuous brand health monitoring, and enterprise-grade reporting frameworks.', 'reviewservicepro'); ?></p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-[#f8fafc] py-20 lg:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="rsp-motion-reveal mx-auto mb-16 max-w-3xl text-center" data-rsp-motion>
      <span class="mb-4 inline-flex rounded-full border border-blue-200 bg-blue-50 px-4 py-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-700">
        <?php esc_html_e('Strict Compliance Thresholds', 'reviewservicepro'); ?>
      </span>
      <h2 class="text-3xl font-black tracking-wide text-slate-800 md:text-4xl">
        <?php esc_html_e('Engineered Integrity vs Platform Abuse', 'reviewservicepro'); ?>
      </h2>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
      <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion>
        <div class="rsp-card-inner p-6 md:p-8">
          <div class="mb-6 flex items-center gap-3">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 shadow-inner">
              <i data-lucide="check-square" class="h-5 w-5"></i>
            </span>
            <h3 class="text-xl font-bold text-slate-900"><?php esc_html_e('Verified Growth Engineering', 'reviewservicepro'); ?></h3>
          </div>
          <ul class="space-y-4 text-sm font-medium text-slate-600">
            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">✓</span><span>Automated API review interception and velocity controls.</span></li>
            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">✓</span><span>First-party customer feedback filtering systems.</span></li>
            <li class="flex items-start gap-3"><span class="text-emerald-500 font-bold">✓</span><span>Semantic search optimization for organic local map-pack tracking.</span></li>
          </ul>
        </div>
      </div>

      <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion>
        <div class="rsp-card-inner p-6 md:p-8">
          <div class="mb-6 flex items-center gap-3">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600 shadow-inner">
              <i data-lucide="shield-alert" class="h-5 w-5"></i>
            </span>
            <h3 class="text-xl font-bold text-slate-900"><?php esc_html_e('Zero-Tolerance Prohibitions', 'reviewservicepro'); ?></h3>
          </div>
          <ul class="space-y-4 text-sm font-medium text-slate-600">
            <li class="flex items-start gap-3"><span class="text-rose-500 font-bold">✕</span><span>No simulated user interactions or profile farm purchases.</span></li>
            <li class="flex items-start gap-3"><span class="text-rose-500 font-bold">✕</span><span>No manipulative gating that violates federal regulatory guidelines.</span></li>
            <li class="flex items-start gap-3"><span class="text-rose-500 font-bold">✕</span><span>No fabricated ratings or deceptive search ranking shortcuts.</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-white py-20 lg:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="rsp-motion-reveal mb-12 max-w-3xl" data-rsp-motion>
      <span class="mb-4 inline-flex rounded-full border border-slate-200 bg-slate-50 px-4 py-1.5 text-[11px] font-bold uppercase tracking-wider text-slate-700">
        <?php esc_html_e('Operational Pillars', 'reviewservicepro'); ?>
      </span>
      <h2 class="text-3xl font-black tracking-wide text-slate-900 md:text-4xl">
        <?php esc_html_e('The compliance architecture behind every campaign.', 'reviewservicepro'); ?>
      </h2>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($values as $index => $value) : ?>
        <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion style="transition-delay: <?php echo esc_attr(($index * 50) . 'ms'); ?>;">
          <div class="rsp-card-inner p-6">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 shadow-sm">
              <i data-lucide="<?php echo esc_attr($value['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>
            <h3 class="mb-2 text-lg font-bold text-slate-900"><?php echo esc_html($value['title']); ?></h3>
            <p class="text-xs leading-relaxed text-slate-600"><?php echo esc_html($value['desc']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-[#f8fafc] py-20 lg:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">

      <div class="rsp-motion-reveal" data-rsp-motion>
        <h3 class="mb-3 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl"><?php esc_html_e('Supported Review Networks', 'reviewservicepro'); ?></h3>
        <p class="mb-6 text-sm text-slate-600"><?php esc_html_e('We deploy real-time monitoring and compliant funnel protocols across major global indexing nodes.', 'reviewservicepro'); ?></p>
        <div class="flex flex-wrap gap-2.5">
          <?php foreach ($platforms as $platform) : ?>
            <span class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-bold text-slate-700 shadow-sm transition-all hover:border-blue-400 hover:text-blue-600"><?php echo esc_html($platform); ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="rsp-motion-reveal" data-rsp-motion style="transition-delay: 80ms;">
        <h3 class="mb-3 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl"><?php esc_html_e('High-Intent Verticals Supported', 'reviewservicepro'); ?></h3>
        <p class="mb-6 text-sm text-slate-600"><?php esc_html_e('Our ORM engines scale sectors where organic star velocity directly dictating customer pipeline conversions.', 'reviewservicepro'); ?></p>
        <div class="flex flex-wrap gap-2.5">
          <?php foreach ($industries as $industry) : ?>
            <span class="rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-900 transition-all hover:bg-emerald-100/50"><?php echo esc_html($industry); ?></span>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-white py-20 lg:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-[0.85fr_1.15fr]">

      <div class="rsp-motion-reveal sticky top-24" data-rsp-motion>
        <span class="mb-4 inline-flex rounded-full border border-blue-200 bg-blue-50 px-4 py-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-700">
          <?php esc_html_e('Our Core Engine Workflow', 'reviewservicepro'); ?>
        </span>
        <h2 class="mb-5 text-3xl font-black tracking-tight text-slate-900 md:text-5xl"><?php esc_html_e('Algorithmic execution, not random tasks.', 'reviewservicepro'); ?></h2>
        <p class="text-base text-slate-600"><?php esc_html_e('Every optimization profile steps through four deliberate operational layers to guarantee long-term search engine integration and compliance safety.', 'reviewservicepro'); ?></p>
      </div>

      <div class="space-y-5">
        <?php foreach ($process as $index => $step) : ?>
          <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion style="transition-delay: <?php echo esc_attr(($index * 60) . 'ms'); ?>;">
            <div class="rsp-card-inner p-6">
              <div class="mb-3 flex items-center gap-4">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-xs font-black text-white shadow-inner"><?php echo esc_html($step['num']); ?></span>
                <h3 class="text-lg font-bold text-slate-900"><?php echo esc_html($step['title']); ?></h3>
              </div>
              <p class="pl-13 text-xs leading-relaxed text-slate-600"><?php echo esc_html($step['desc']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-slate-50/50 py-20 lg:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

      <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion>
        <div class="rsp-card-inner p-6">
          <h3 class="mb-2.5 text-xl font-bold text-slate-900"><?php esc_html_e('AI + Human Workflow', 'reviewservicepro'); ?></h3>
          <p class="text-sm leading-relaxed text-slate-600"><?php esc_html_e('We use AI-assisted insights for pattern detection, sentiment review, and reporting support — but human oversight protects tone, context, and brand safety.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion style="transition-delay: 60ms;">
        <div class="rsp-card-inner p-6">
          <h3 class="mb-2.5 text-xl font-bold text-slate-900"><?php esc_html_e('Transparency & Compliance', 'reviewservicepro'); ?></h3>
          <p class="text-sm leading-relaxed text-slate-600"><?php esc_html_e('Our work is built around honest reporting, platform guidelines, client clarity, and safe reputation practices.', 'reviewservicepro'); ?></p>
        </div>
      </div>

      <div class="rsp-animated-border-card rsp-motion-reveal p-[1.5px]" data-rsp-motion style="transition-delay: 120ms;">
        <div class="rsp-card-inner p-6">
          <h3 class="mb-2.5 text-xl font-bold text-slate-900"><?php esc_html_e('Agency Culture', 'reviewservicepro'); ?></h3>
          <p class="text-sm leading-relaxed text-slate-600"><?php esc_html_e('We operate like a trust partner, not a shortcut seller. Strategy, clarity, communication, and ethical execution guide our work.', 'reviewservicepro'); ?></p>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-slate-100 bg-white py-20 lg:py-24">
  <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
    <div class="rsp-motion-reveal mb-12 text-center" data-rsp-motion>
      <h2 class="mb-3 text-3xl font-black tracking-tight text-slate-900 md:text-5xl"><?php esc_html_e('Intelligence FAQ', 'reviewservicepro'); ?></h2>
      <p class="text-sm text-slate-600"><?php esc_html_e('Clear architectural answers regarding policy compliance, scaling, and system engineering.', 'reviewservicepro'); ?></p>
    </div>

    <div class="space-y-4">
      <?php foreach ($faqs as $faq) : ?>
        <details class="rsp-motion-reveal group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm [&_summary::-webkit-details-marker]:hidden" data-rsp-motion>
          <summary class="flex cursor-pointer items-center justify-between gap-4 text-base font-bold text-slate-900 focus:outline-none">
            <span><?php echo esc_html($faq['q']); ?></span>
            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-transform group-open:rotate-180">
              <i data-lucide="chevron-down" class="h-4 w-4"></i>
            </span>
          </summary>
          <div class="mt-4 border-t border-slate-100 pt-4 text-xs leading-relaxed text-slate-600">
            <p><?php echo esc_html($faq['a']); ?></p>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="relative overflow-hidden bg-slate-950 py-20 lg:py-28">
  <div class="absolute inset-0 opacity-10 bg-[linear-gradient(rgba(255,255,255,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.1)_1px,transparent_1px)] bg-[size:32px_32px]"></div>
  <div class="pointer-events-none absolute -bottom-20 -right-20 h-[400px] w-[400px] rounded-full bg-emerald-500/[0.1] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
    <div class="rsp-motion-reveal" data-rsp-motion>
      <h2 class="mb-4 text-3xl font-black leading-tight text-white! sm:text-4xl md:text-5xl">
        <?php esc_html_e('Scale Your Organic Trust Channels Now.', 'reviewservicepro'); ?>
      </h2>
      <p class="mx-auto mb-8 max-w-2xl text-sm leading-relaxed text-slate-400 sm:text-base">
        <?php esc_html_e('Map your structural search visibility gaps. Request an enterprise-grade trust network assessment completely free.', 'reviewservicepro'); ?>
      </p>
      <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-8 py-4 text-sm font-bold text-slate-950 shadow-2xl shadow-emerald-500/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-emerald-400">
        <i data-lucide="search-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Generate Free Trust Audit Report', 'reviewservicepro'); ?>
      </a>
    </div>
  </div>
</section>

<script>
  (function() {
    'use strict';

    function initRspPremiumEngine() {
      // Trigger Lucide Icons Rendering safely
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      // Clean Intersection Observer for High Speed Motion Reveal
      var revealItems = document.querySelectorAll('[data-rsp-motion]');
      if ('IntersectionObserver' in window && revealItems.length > 0) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('rsp-active');
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.02,
          rootMargin: '0px 0px -10px 0px'
        });

        revealItems.forEach(function(item) {
          observer.observe(item);
        });
      } else {
        revealItems.forEach(function(item) {
          item.classList.add('rsp-active');
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPremiumEngine);
    } else {
      initRspPremiumEngine();
    }
  })();
</script>

<?php
get_footer();
