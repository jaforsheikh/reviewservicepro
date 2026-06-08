<?php
if (! defined('ABSPATH')) {
  exit;
}

$academy_posts = [
  [
    'type'     => 'featured',
    'icon'     => '📝',
    'category' => 'Review Responses',
    'color'    => '#8b5cf6',
    'title'    => 'How to Respond to Negative Reviews: A Complete Guide for Business Owners',
    'desc'     => 'A step-by-step guide covering tone, timing, and strategy for every type of negative review — from Google to Trustpilot.',
    'meta'     => '5 min read',
    'url'      => home_url('/orm-academy/respond-to-negative-reviews/'),
  ],
  [
    'type'     => 'small',
    'icon'     => '🗺️',
    'category' => 'Platform Guides',
    'color'    => '#10b981',
    'title'    => 'Google Business Profile: The Complete ORM Guide for 2025',
    'desc'     => '',
    'meta'     => '4 min read',
    'url'      => home_url('/orm-academy/google-business-profile-orm-guide/'),
  ],
  [
    'type'     => 'small',
    'icon'     => '📋',
    'category' => 'Templates',
    'color'    => '#06b6d4',
    'title'    => 'Free Review Response Templates: Positive, Neutral & Negative',
    'desc'     => '',
    'meta'     => '3 min read',
    'url'      => home_url('/orm-academy/review-response-templates/'),
  ],
  [
    'type'     => 'small',
    'icon'     => '📊',
    'category' => 'Local SEO',
    'color'    => '#8b5cf6',
    'title'    => 'How Review Signals Directly Affect Your Google Local Ranking',
    'desc'     => '',
    'meta'     => '6 min read',
    'url'      => home_url('/orm-academy/review-signals-local-ranking/'),
  ],
];

$featured = $academy_posts[0];
$side_posts = array_slice($academy_posts, 1);
?>

<section
  id="academy-preview"
  class="relative overflow-hidden border-t border-white/[0.05] bg-[#07111F] py-20 md:py-28"
  role="region"
  aria-label="<?php esc_attr_e('ORM Academy Preview', 'reviewservicepro'); ?>"
  data-gsap="academy-animate">
  <!-- Background Dots -->
  <div
    class="pointer-events-none absolute inset-0 z-0"
    style="background-image:radial-gradient(rgba(139,92,246,0.16) 1px,transparent 1px);background-size:24px 24px;"></div>

  <!-- Glows -->
  <div class="pointer-events-none absolute -top-24 right-0 z-0 h-[420px] w-[520px] rounded-full bg-purple-600/[0.12] blur-[110px]"></div>
  <div class="pointer-events-none absolute bottom-0 left-0 z-0 h-[360px] w-[460px] rounded-full bg-blue-600/[0.08] blur-[100px]"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="mx-auto mb-8 max-w-3xl text-center" data-gsap-item="academy-heading">
      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-purple-500/30 bg-purple-500/10 px-4 py-1.5 text-[11px] font-semibold uppercase tracking-[0.1em] text-purple-400">
        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-purple-500"></span>
        <?php esc_html_e('ORM Academy', 'reviewservicepro'); ?>
      </span>

      <h2 class="mb-4 text-3xl font-extrabold leading-[1.12] tracking-tight text-white md:text-4xl lg:text-[42px]">
        <span class="mb-2 block text-base font-normal tracking-normal text-slate-500 md:text-lg">
          <?php esc_html_e('Free Knowledge to Help You', 'reviewservicepro'); ?>
        </span>

        <span class="relative inline-block">
          <span class="relative z-10 bg-gradient-to-r from-purple-300 via-purple-200 to-purple-400 bg-clip-text text-transparent">
            <?php esc_html_e('Master Your Reputation', 'reviewservicepro'); ?>
          </span>
          <span class="absolute inset-[-4px_-10px] z-0 rounded-lg border border-purple-500/[0.18] bg-purple-500/[0.12]"></span>
          <span class="academy-underline absolute -bottom-1 left-0 right-0 z-10 h-[2.5px] origin-left scale-x-0 rounded-full bg-gradient-to-r from-purple-500 via-purple-400 to-transparent transition-transform duration-700"></span>
        </span>
      </h2>

      <p class="mx-auto max-w-xl text-sm leading-relaxed text-slate-500">
        <?php esc_html_e('Guides, templates, response scripts, and platform strategies — built for business owners who want to understand and control their online reputation.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- Category Pills -->
    <div class="mb-10 flex flex-wrap justify-center gap-2" data-gsap-item="academy-cats">
      <?php
      $cats = [
        ['All Articles', '#94a3b8'],
        ['Reputation Basics', '#3b82f6'],
        ['Platform Guides', '#10b981'],
        ['Review Responses', '#d6a84f'],
        ['Local SEO', '#8b5cf6'],
        ['Templates', '#06b6d4'],
        ['Industry Insights', '#f97316'],
      ];

      foreach ($cats as $cat) :
      ?>
        <span
          class="inline-flex rounded-full border px-4 py-1.5 text-[11px] font-medium"
          style="border-color:<?php echo esc_attr($cat[1]); ?>55;color:<?php echo esc_attr($cat[1]); ?>;background:<?php echo esc_attr($cat[1]); ?>12;">
          <?php echo esc_html($cat[0]); ?>
        </span>
      <?php endforeach; ?>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1.25fr_0.75fr]" data-gsap-item="academy-cards">

      <!-- Featured Card -->
      <article class="group relative flex min-h-[520px] flex-col overflow-hidden rounded-3xl border border-white/[0.08] bg-white/[0.035] transition-all duration-300 hover:-translate-y-1 hover:border-purple-500/40">
        <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-purple-500 via-blue-500 to-transparent"></div>

        <div class="relative flex min-h-[230px] items-center justify-center overflow-hidden border-b border-white/[0.06] bg-gradient-to-br from-purple-900/40 via-blue-950/40 to-slate-950">
          <div class="absolute h-40 w-40 rounded-full bg-purple-500/20 blur-[70px]"></div>
          <div class="relative z-10 text-6xl">
            <?php echo esc_html($featured['icon']); ?>
          </div>
        </div>

        <div class="flex flex-1 flex-col p-7">
          <span
            class="mb-4 inline-flex w-fit rounded-full border px-3 py-1 text-[10px] font-semibold"
            style="border-color:<?php echo esc_attr($featured['color']); ?>55;color:<?php echo esc_attr($featured['color']); ?>;background:<?php echo esc_attr($featured['color']); ?>15;">
            <?php echo esc_html($featured['category']); ?>
          </span>

          <h3 class="mb-4 max-w-2xl text-2xl font-extrabold leading-tight text-white md:text-3xl">
            <?php echo esc_html($featured['title']); ?>
          </h3>

          <p class="mb-6 max-w-2xl text-sm leading-relaxed text-slate-400">
            <?php echo esc_html($featured['desc']); ?>
          </p>

          <div class="mt-auto flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-4 text-[11px] text-slate-500">
              <span class="inline-flex items-center gap-1.5">
                <i data-lucide="clock" class="h-3.5 w-3.5" aria-hidden="true"></i>
                <?php echo esc_html($featured['meta']); ?>
              </span>
              <span><?php echo esc_html($featured['category']); ?></span>
            </div>

            <a
              href="<?php echo esc_url($featured['url']); ?>"
              class="inline-flex items-center gap-2 text-sm font-semibold text-purple-400 transition-all duration-200 group-hover:gap-3">
              <?php esc_html_e('Read article', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </article>

      <!-- Side Cards -->
      <div class="flex flex-col gap-4">
        <?php foreach ($side_posts as $post) : ?>
          <article class="group flex min-h-[155px] gap-4 overflow-hidden rounded-2xl border border-white/[0.08] bg-white/[0.03] p-5 transition-all duration-300 hover:-translate-y-1 hover:border-white/[0.16]">
            <div
              class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl border text-2xl"
              style="border-color:<?php echo esc_attr($post['color']); ?>44;background:<?php echo esc_attr($post['color']); ?>14;">
              <?php echo esc_html($post['icon']); ?>
            </div>

            <div class="min-w-0 flex-1">
              <span
                class="mb-2 inline-flex rounded-full px-2.5 py-1 text-[9px] font-semibold"
                style="color:<?php echo esc_attr($post['color']); ?>;background:<?php echo esc_attr($post['color']); ?>14;">
                <?php echo esc_html($post['category']); ?>
              </span>

              <h3 class="mb-3 text-[14px] font-bold leading-snug text-white">
                <?php echo esc_html($post['title']); ?>
              </h3>

              <div class="flex items-center justify-between gap-3">
                <span class="inline-flex items-center gap-1.5 text-[10px] text-slate-500">
                  <i data-lucide="clock" class="h-3 w-3" aria-hidden="true"></i>
                  <?php echo esc_html($post['meta']); ?>
                </span>

                <a
                  href="<?php echo esc_url($post['url']); ?>"
                  class="text-[11px] font-semibold transition-all duration-200 group-hover:translate-x-1"
                  style="color:<?php echo esc_attr($post['color']); ?>;">
                  <?php esc_html_e('Read', 'reviewservicepro'); ?> →
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

    </div>

    <!-- CTA -->
    <div class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-white/[0.06] pt-6" data-gsap-item="academy-cta">
      <p class="text-sm text-slate-500">
        <?php esc_html_e('Explore guides, templates, and reputation growth resources built for modern businesses.', 'reviewservicepro'); ?>
      </p>

      <a
        href="<?php echo esc_url(home_url('/orm-academy/')); ?>"
        class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-6 py-3 text-sm font-semibold text-white transition-all duration-200 hover:-translate-y-0.5 hover:bg-purple-700">
        <i data-lucide="book-open" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Visit ORM Academy', 'reviewservicepro'); ?>
      </a>
    </div>

  </div>
</section>