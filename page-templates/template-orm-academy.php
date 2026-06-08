<?php

/**
 * Template Name: ORM Academy Knowledge Hub
 *
 * File: wp-content/themes/reviewservicepro/page-templates/template-orm-academy.php
 *
 * ReviewService.Pro — Premium White SaaS Knowledge Hub & Blog Architecture
 * Targets: ORM Academy, online reputation management guides, reputation management blog, 
 * review management tips, customer trust strategy, ethical ORM education.
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

get_header();

// Setup foundational tracking strings and URLs safely
$search_query_val  = isset($_GET['s_academy']) ? sanitize_text_field(wp_unslash($_GET['s_academy'])) : '';
$contact_audit_url = home_url('/contact/?type=audit');

// Map semantic slug details for architectural components
$topic_hubs = [
  'reviews'             => [
    'icon'        => 'star',
    'title'       => __('Reviews', 'reviewservicepro'),
    'desc'        => __('Practical strategies for monitoring feedback, interpreting patterns, and processing native platform protocols.', 'reviewservicepro'),
    'target_slug' => 'reviews'
  ],
  'customer-experience' => [
    'icon'        => 'users',
    'title'       => __('Customer Experience', 'reviewservicepro'),
    'desc'        => __('Frameworks to align frontline service delivery with authentic customer satisfaction metrics and structural retention.', 'reviewservicepro'),
    'target_slug' => 'customer-experience'
  ],
  'industry-reputation' => [
    'icon'        => 'shield-check',
    'title'       => __('Industry Reputation', 'reviewservicepro'),
    'desc'        => __('Navigating regional market dynamics, competitive baseline positioning, and ecosystem Trust Signals safely.', 'reviewservicepro'),
    'target_slug' => 'industry-reputation'
  ],
  'case-studies'        => [
    'icon'        => 'file-text',
    'title'       => __('Case Studies', 'reviewservicepro'),
    'desc'        => __('Anonymized, real-world operational breakdowns illustrating complaint documentation and escalation paths.', 'reviewservicepro'),
    'target_slug' => 'case-studies'
  ],
];

// Dynamically augment the category meta counts and links
foreach ($topic_hubs as $slug => $data) {
  $cat = get_category_by_slug($data['target_slug']);
  if ($cat) {
    $topic_hubs[$slug]['count'] = $cat->count;
    $topic_hubs[$slug]['url']   = get_category_link($cat->term_id);
  } else {
    $topic_hubs[$slug]['count'] = 0;
    $topic_hubs[$slug]['url']   = esc_url(add_query_arg('category', $data['target_slug'], home_url('/academy/')));
  }
}

$learning_paths = [
  [
    'step'  => '01',
    'title' => __('Understand Your Review Profile', 'reviewservicepro'),
    'desc'  => __('Map your current baseline visibility across search environments to safely detect fragmentation.', 'reviewservicepro')
  ],
  [
    'step'  => '02',
    'title' => __('Monitor Customer Feedback', 'reviewservicepro'),
    'desc'  => __('Establish algorithmic, real-time alert mechanisms to verify immediate input delivery channels.', 'reviewservicepro')
  ],
  [
    'step'  => '03',
    'title' => __('Respond Professionally', 'reviewservicepro'),
    'desc'  => __('Deploy neutral structural response methodologies that preserve brand alignment without conflict.', 'reviewservicepro')
  ],
  [
    'step'  => '04',
    'title' => __('Build Ethical Feedback Workflow', 'reviewservicepro'),
    'desc'  => __('Provide un-incentivized pathways for your verified users to express authentic sentiment.', 'reviewservicepro')
  ],
  [
    'step'  => '05',
    'title' => __('Improve Long-Term Trust Signals', 'reviewservicepro'),
    'desc'  => __('Systematically address systemic service gaps to structurally elevate marketplace status.', 'reviewservicepro')
  ],
];
?>

<main id="primary" class="site-main">
  <style>
    #rsp-academy-hub {
      --rsp-ac-title: #334155;
      --rsp-ac-heading: #3B4658;
      --rsp-ac-body: #64748B;
      --rsp-ac-blue: #2563EB;
      --rsp-ac-green: #00C853;
      --rsp-ac-bg: #F8FAFC;
      font-feature-settings: "cv02", "cv03", "cv04", "cv11";
    }

    #rsp-academy-hub .font-poppins {
      font-family: "Poppins", system-ui, -apple-system, sans-serif;
    }

    #rsp-academy-hub .font-inter {
      font-family: "Inter", system-ui, -apple-system, sans-serif;
    }

    #rsp-academy-hub .rsp-ac-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 800ms cubic-bezier(0.16, 1, 0.3, 1), transform 800ms cubic-bezier(0.16, 1, 0.3, 1);
    }

    #rsp-academy-hub .rsp-ac-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #rsp-academy-hub .rsp-ac-card {
      transition: transform 400ms cubic-bezier(0.16, 1, 0.3, 1), box-shadow 400ms ease, border-color 300ms ease;
    }

    #rsp-academy-hub .rsp-ac-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(51, 65, 88, 0.06);
    }

    #rsp-academy-hub .rsp-ac-btn-shine {
      position: relative;
      overflow: hidden;
    }

    #rsp-academy-hub .rsp-ac-btn-shine::before {
      content: "";
      position: absolute;
      top: 0;
      left: -150%;
      width: 60%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
      transform: skewX(-20deg);
      transition: left 750ms cubic-bezier(0.16, 1, 0.3, 1);
    }

    #rsp-academy-hub .rsp-ac-btn-shine:hover::before {
      left: 150%;
    }

    #rsp-academy-hub .rsp-ac-border-motion {
      position: relative;
      background: #FFFFFF;
      border-radius: 1.25rem;
      z-index: 1;
    }

    #rsp-academy-hub .rsp-ac-border-motion::before {
      content: "";
      position: absolute;
      inset: -1.5px;
      border-radius: 1.35rem;
      background: conic-gradient(from 0deg, rgba(37, 99, 235, 0.05), rgba(0, 200, 83, 0.25), rgba(37, 99, 235, 0.25), rgba(37, 99, 235, 0.05));
      z-index: -1;
      animation: rspAcBorderSpin 12s linear infinite;
      opacity: 0.4;
      transition: opacity 0.3s ease;
    }

    #rsp-academy-hub .rsp-ac-border-motion:hover::before {
      opacity: 1;
      animation-duration: 6s;
    }

    @keyframes rspAcBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    #rsp-academy-hub .rsp-ac-glow {
      position: relative;
    }

    #rsp-academy-hub .rsp-ac-glow::after {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: inherit;
      box-shadow: 0 0 0 0px rgba(37, 99, 235, 0);
      transition: box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      pointer-events: none;
      z-index: 2;
    }

    #rsp-academy-hub .rsp-ac-glow:hover::after {
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.05);
    }

    @media (prefers-reduced-motion: reduce) {
      #rsp-academy-hub .rsp-ac-reveal {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
      }

      #rsp-academy-hub .rsp-ac-card:hover {
        transform: none !important;
      }

      #rsp-academy-hub .rsp-ac-border-motion::before {
        animation: none !important;
      }
    }
  </style>

  <div id="rsp-academy-hub" class="bg-[#F8FAFC] font-inter text-[16px] text-[#64748B] leading-relaxed relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.025)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.025)_1px,transparent_1px)] bg-[size:48px_48px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute top-0 left-1/4 w-[600px] h-[600px] bg-[radial-gradient(circle_at_top,rgba(37,99,235,0.06),transparent_50%)]" aria-hidden="true"></div>

    <section class="relative z-10 px-6 pt-20 pb-16 lg:pt-28 lg:pb-24 max-w-7xl mx-auto" aria-label="<?php esc_attr_e('Academy Hero Introduction', 'reviewservicepro'); ?>">
      <div class="text-center max-w-4xl mx-auto">
        <span class="inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-4 py-1.5 font-mono text-[11px] font-semibold uppercase tracking-wider text-slate-500 shadow-xs mb-6">
          <span class="h-1.5 w-1.5 rounded-full bg-[#00C853]" aria-hidden="true"></span>
          <?php esc_html_e('Verified ORM Resource Library', 'reviewservicepro'); ?>
        </span>

        <h1 class="font-poppins text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#334155] tracking-tight leading-[1.1] mb-6">
          <?php esc_html_e('ORM Academy for Ethical', 'reviewservicepro'); ?>
          <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-teal-600 to-emerald-600"><?php esc_html_e('Reputation Growth', 'reviewservicepro'); ?></span>
        </h1>

        <p class="font-poppins text-lg sm:text-xl font-medium text-[#64748B] max-w-2xl mx-auto mb-10 leading-relaxed">
          <?php esc_html_e('Learn practical review management, response strategy, customer trust, and platform-compliant reputation systems.', 'reviewservicepro'); ?>
        </p>

        <div class="max-w-xl mx-auto mb-8" id="academy-search-wrap">
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative flex items-center bg-white rounded-2xl border border-slate-200/80 p-2 shadow-sm focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-500/5 transition-all">
            <input type="hidden" name="post_type" value="post">
            <div class="pl-3 text-slate-400">
              <i data-lucide="search" class="w-5 h-5"></i>
            </div>
            <input type="search" name="s" value="<?php echo esc_attr($search_query_val); ?>" placeholder="<?php esc_attr_e('Search reputation guides, tools, rules...', 'reviewservicepro'); ?>" class="w-full bg-transparent border-0 outline-none px-3 py-2.5 font-medium text-slate-800 placeholder-slate-400 text-sm focus:ring-0">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs uppercase tracking-wider px-5 py-3 rounded-xl transition-colors shrink-0">
              <?php esc_html_e('Search', 'reviewservicepro'); ?>
            </button>
          </form>
        </div>

        <div class="flex flex-wrap justify-center gap-2 mb-10">
          <?php foreach ($topic_hubs as $hub_slug => $hub_info) : ?>
            <a href="<?php echo esc_url($hub_info['url']); ?>" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-white border border-slate-200 hover:border-blue-500 rounded-full text-xs font-semibold text-slate-600 hover:text-blue-600 transition-colors shadow-xs">
              <i data-lucide="<?php echo esc_attr($hub_info['icon']); ?>" class="w-3.5 h-3.5 text-slate-400"></i>
              <?php echo esc_html($hub_info['title']); ?>
            </a>
          <?php endforeach; ?>
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
          <a href="#featured-articles" class="rsp-ac-btn-shine w-full sm:w-auto inline-flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-sm transition-transform active:scale-95">
            <?php esc_html_e('Explore Guides', 'reviewservicepro'); ?>
            <i data-lucide="arrow-down" class="w-4 h-4 ml-2"></i>
          </a>
          <a href="<?php echo esc_url($contact_audit_url); ?>" class="rsp-ac-btn-shine w-full sm:w-auto inline-flex items-center justify-center bg-white border border-slate-200 hover:border-blue-200 text-blue-600 font-bold text-sm px-6 py-3.5 rounded-xl shadow-xs transition-transform active:scale-95">
            <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
          </a>
        </div>
      </div>
    </section>

    <section class="relative z-10 px-6 py-12 max-w-7xl mx-auto" aria-label="<?php esc_attr_e('Core Reputation Domains', 'reviewservicepro'); ?>">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($topic_hubs as $slug => $data) : ?>
          <article class="rsp-ac-border-motion rsp-ac-card p-6 flex flex-col justify-between border border-transparent shadow-xs">
            <div>
              <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center mb-5">
                <i data-lucide="<?php echo esc_attr($data['icon']); ?>" class="w-5 h-5"></i>
              </div>
              <h3 class="font-poppins text-lg font-bold text-[#3B4658] mb-2 tracking-tight">
                <?php echo esc_html($data['title']); ?>
              </h3>
              <p class="font-inter text-xs text-[#64748B] leading-relaxed mb-6">
                <?php echo esc_html($data['desc']); ?>
              </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
              <span class="text-slate-400 font-mono">
                <?php echo esc_html(sprintf(_n('%s Guide', '%s Guides', $data['count'], 'reviewservicepro'), $data['count'])); ?>
              </span>
              <a href="<?php echo esc_url($data['url']); ?>" class="text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                <?php esc_html_e('View Hub', 'reviewservicepro'); ?>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="featured-articles" class="relative z-10 px-6 py-16 max-w-7xl mx-auto" aria-label="<?php esc_attr_e('Primary Resource Queries', 'reviewservicepro'); ?>">
      <div class="mb-10">
        <h2 class="font-poppins text-2xl sm:text-3xl font-extrabold text-[#3B4658] tracking-tight">
          <?php esc_html_e('Featured & Recent Knowledge Insights', 'reviewservicepro'); ?>
        </h2>
        <p class="text-sm text-[#64748B] mt-2">
          <?php esc_html_e('Deep-dive operational assets drafted by specialized compliance data engineers.', 'reviewservicepro'); ?>
        </p>
      </div>

      <?php
      $args_main = [
        'post_type'           => 'post',
        'posts_per_page'      => 4,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 0,
      ];
      $query_main = new WP_Query($args_main);

      if ($query_main->have_posts()) :
        $counter = 0;
      ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <?php
          while ($query_main->have_posts()) :
            $query_main->the_post();
            $counter++;

            if (1 === $counter) :
          ?>
              <div class="lg:col-span-3 bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden rsp-ac-card rsp-ac-glow flex flex-col md:flex-row">
                <div class="md:w-1/2 relative bg-slate-100 min-h-[260px] md:min-h-full overflow-hidden">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', ['class' => 'absolute inset-0 w-full h-full object-cover transition-transform duration-500 hover:scale-105']); ?>
                  <?php else : ?>
                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 text-slate-300 p-6">
                      <i data-lucide="book-open" class="w-12 h-12 stroke-[1] mb-2 text-blue-500/40"></i>
                      <span class="text-xs font-mono tracking-widest uppercase text-slate-400"><?php esc_html_e('ReviewService.Pro Asset', 'reviewservicepro'); ?></span>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="md:w-1/2 p-6 sm:p-8 lg:p-10 flex flex-col justify-between">
                  <div>
                    <div class="flex items-center gap-3 mb-4">
                      <?php
                      $categories = get_the_category();
                      if (! empty($categories)) :
                      ?>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 text-blue-600 font-bold text-[11px] rounded-md uppercase tracking-wider">
                          <?php echo esc_html($categories[0]->name); ?>
                        </span>
                      <?php endif; ?>
                      <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-xs text-slate-400 font-mono">
                        <?php echo esc_html(get_the_date()); ?>
                      </time>
                    </div>
                    <h3 class="font-poppins text-xl sm:text-2xl font-bold text-[#3B4658] tracking-tight mb-4 hover:text-blue-600 transition-colors">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="font-inter text-sm text-[#64748B] leading-relaxed mb-6">
                      <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 28, '...')); ?>
                    </div>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-700 group">
                    <?php esc_html_e('Analyze Complete Guide', 'reviewservicepro'); ?>
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1"></i>
                  </a>
                </div>
              </div>
            <?php else : ?>
              <article class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden rsp-ac-card flex flex-col justify-between">
                <div>
                  <div class="h-44 bg-slate-50 relative overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('medium_large', ['class' => 'absolute inset-0 w-full h-full object-cover']); ?>
                    <?php else : ?>
                      <div class="absolute inset-0 flex items-center justify-center bg-slate-50/80 text-slate-300">
                        <i data-lucide="file-text" class="w-8 h-8 text-slate-400/30"></i>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="p-5">
                    <div class="flex items-center gap-2 mb-3">
                      <?php $cats = get_the_category();
                      if (! empty($cats)) : ?>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-teal-600 bg-teal-50 border border-teal-100 px-2 py-0.5 rounded">
                          <?php echo esc_html($cats[0]->name); ?>
                        </span>
                      <?php endif; ?>
                      <span class="text-[11px] font-mono text-slate-400"><?php echo esc_html(get_the_date()); ?></span>
                    </div>
                    <h4 class="font-poppins text-base font-bold text-[#3B4658] tracking-tight leading-snug mb-3 hover:text-blue-600 transition-colors">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <p class="font-inter text-xs text-[#64748B] leading-relaxed">
                      <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 15, '...')); ?>
                    </p>
                  </div>
                </div>
                <div class="p-5 pt-0">
                  <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-700">
                    <?php esc_html_e('Read Report', 'reviewservicepro'); ?>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 ml-1"></i>
                  </a>
                </div>
              </article>
          <?php
            endif;
          endwhile;
          ?>
        </div>
      <?php
        wp_reset_postdata();
      else :
      ?>
        <div class="bg-white rounded-2xl border border-dashed border-slate-200 p-12 text-center">
          <i data-lucide="help-circle" class="w-8 h-8 mx-auto text-slate-300 mb-3"></i>
          <p class="text-slate-500 font-medium"><?php esc_html_e('No knowledge base records discovered matching initialization queries.', 'reviewservicepro'); ?></p>
        </div>
      <?php endif; ?>
    </section>

    <section class="relative z-10 bg-white border-y border-slate-200/60 px-6 py-16 lg:py-20" aria-label="<?php esc_attr_e('Ethical Framework Milestones', 'reviewservicepro'); ?>">
      <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 border border-slate-200 rounded-full text-[10px] font-mono tracking-widest uppercase text-slate-500">
            <?php esc_html_e('Strategic Progression Flow', 'reviewservicepro'); ?>
          </span>
          <h2 class="font-poppins text-2xl sm:text-3xl font-extrabold text-[#3B4658] tracking-tight mt-4">
            <?php esc_html_e('Your Professional Trust Optimization Blueprint', 'reviewservicepro'); ?>
          </h2>
          <p class="text-sm text-[#64748B] mt-2">
            <?php esc_html_e('Systematic sequential pillars required to stabilize business integrity across open channels.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 relative">
          <?php foreach ($learning_paths as $idx => $step) : ?>
            <div class="rsp-ac-card bg-[#F8FAFC] border border-slate-200/70 rounded-2xl p-5 relative">
              <div class="font-mono text-3xl font-black text-blue-500/20 mb-3">
                <?php echo esc_html($step['step']); ?>
              </div>
              <h3 class="font-poppins text-sm font-bold text-[#3B4658] tracking-tight mb-2">
                <?php echo esc_html($step['title']); ?>
              </h3>
              <p class="font-inter text-xs text-[#64748B] leading-relaxed">
                <?php echo esc_html($step['desc']); ?>
              </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="relative z-10 px-6 py-16 max-w-7xl mx-auto" aria-label="<?php esc_attr_e('Target Category Feeds', 'reviewservicepro'); ?>">
      <?php
      $monitored_slugs = ['reviews', 'customer-experience', 'industry-reputation', 'case-studies'];

      foreach ($monitored_slugs as $current_slug) :
        $target_cat = get_category_by_slug($current_slug);
        if (! $target_cat) {
          continue;
        }

        $args_cat = [
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'cat'            => $target_cat->term_id,
          'post_status'    => 'publish',
        ];
        $query_cat = new WP_Query($args_cat);

        if ($query_cat->have_posts()) :
      ?>
          <div class="mb-14 last:mb-0">
            <div class="flex items-center justify-between border-b border-slate-200/60 pb-4 mb-6">
              <div>
                <h3 class="font-poppins text-lg sm:text-xl font-bold text-[#3B4658] tracking-tight">
                  <?php echo esc_html($target_cat->name); ?>
                </h3>
                <p class="text-xs text-slate-400 mt-0.5">
                  <?php echo esc_html(sprintf(_n('Analyzing %s structural deep-dive asset', 'Analyzing %s structural deep-dive assets', $target_cat->count, 'reviewservicepro'), $target_cat->count)); ?>
                </p>
              </div>
              <a href="<?php echo esc_url(get_category_link($target_cat->term_id)); ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1">
                <?php esc_html_e('View All Category Frameworks', 'reviewservicepro'); ?>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
              </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <?php
              while ($query_cat->have_posts()) :
                $query_cat->the_post();
              ?>
                <article class="bg-white border border-slate-200/70 rounded-2xl p-5 shadow-xs flex flex-col justify-between transition-all hover:border-slate-300">
                  <div>
                    <span class="text-[10px] font-mono text-slate-400 block mb-2"><?php echo esc_html(get_the_date()); ?></span>
                    <h4 class="font-poppins text-sm font-bold text-[#3B4658] tracking-tight mb-2 hover:text-blue-600 transition-colors">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <p class="font-inter text-xs text-[#64748B] leading-relaxed">
                      <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 18, '...')); ?>
                    </p>
                  </div>
                  <div class="pt-4 mt-4 border-t border-slate-50">
                    <a href="<?php the_permalink(); ?>" class="text-xs font-bold text-slate-600 hover:text-blue-600 inline-flex items-center gap-1">
                      <?php esc_html_e('Access Manual', 'reviewservicepro'); ?>
                      <i data-lucide="arrow-right" class="w-3 h-3"></i>
                    </a>
                  </div>
                </article>
              <?php endwhile; ?>
            </div>
          </div>
      <?php
        endif;
        wp_reset_postdata();
      endforeach;
      ?>
    </section>

    <section class="relative z-10 px-6 py-12 max-w-7xl mx-auto" aria-label="<?php esc_attr_e('Intellectual Brief Updates', 'reviewservicepro'); ?>">
      <div class="bg-gradient-to-br from-slate-900 to-slate-950 rounded-[2.5rem] p-8 sm:p-12 lg:p-16 text-center text-white relative overflow-hidden shadow-xl">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,rgba(37,99,235,0.15),transparent_45%)]" aria-hidden="true"></div>

        <div class="relative z-10 max-w-2xl mx-auto">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 border border-white/10 rounded-full text-[10px] font-mono uppercase tracking-wider text-blue-300 mb-6">
            <i data-lucide="mail" class="w-3.5 h-3.5"></i>
            <?php esc_html_e('Encrypted Operations Report', 'reviewservicepro'); ?>
          </span>

          <h2 class="font-poppins text-3xl sm:text-4xl font-extrabold tracking-tight mb-4 text-white">
            <?php esc_html_e('Get Weekly ORM Tips', 'reviewservicepro'); ?>
          </h2>

          <p class="font-inter text-slate-400 text-sm sm:text-base mb-8 max-w-lg mx-auto">
            <?php esc_html_e('Receive review monitoring tips, response frameworks, and ethical reputation growth insights directly to your workspace.', 'reviewservicepro'); ?>
          </p>

          <div class="max-w-md mx-auto flex flex-col sm:flex-row items-center gap-2.5 bg-white/5 border border-white/10 p-2 rounded-2xl">
            <div class="w-full pl-3 flex items-center gap-2 text-slate-400">
              <i data-lucide="lock" class="w-4 h-4 text-slate-500"></i>
              <input type="email" placeholder="<?php esc_attr_e('Enter operational email corporate link', 'reviewservicepro'); ?>" class="w-full bg-transparent border-0 outline-none p-2 text-sm text-white placeholder-slate-500 focus:ring-0">
            </div>
            <button type="button" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase tracking-wider px-6 py-3.5 rounded-xl transition-colors shrink-0 whitespace-nowrap">
              <?php esc_html_e('Subscribe Securely', 'reviewservicepro'); ?>
            </button>
          </div>

          <p class="text-[11px] font-mono text-slate-500 mt-4">
            <?php esc_html_e('Compliance Note: Safeguarded system validation. No spam protocols active. Unsubscribe anytime.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </section>

    <section class="relative z-10 px-6 py-16 lg:py-24 max-w-5xl mx-auto text-center" aria-label="<?php esc_attr_e('Final Audit Conversion Prompt', 'reviewservicepro'); ?>">
      <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 sm:p-12 lg:p-16 shadow-xs relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(0,200,83,0.03),transparent_40%)]" aria-hidden="true"></div>

        <h2 class="font-poppins text-2xl sm:text-4xl font-extrabold text-[#3B4658] tracking-tight mb-4">
          <?php esc_html_e('Want to know where your reputation stands?', 'reviewservicepro'); ?>
        </h2>

        <p class="font-inter text-sm sm:text-base text-[#64748B] max-w-xl mx-auto mb-8">
          <?php esc_html_e('Get a free reputation audit and discover review gaps, platform risks, and trust-building opportunities.', 'reviewservicepro'); ?>
        </p>

        <a href="<?php echo esc_url($contact_audit_url); ?>" class="rsp-ac-btn-shine inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm px-8 py-4 rounded-xl shadow-md transition-transform active:scale-95">
          <i data-lucide="search-check" class="w-4 h-4 mr-2"></i>
          <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
        </a>
      </div>
    </section>
  </div>

  <script>
    (function() {
      'use strict';
      document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('rsp-academy-hub');
        if (!container) return;

        // Global Scroll Reveal Initialization logic
        if ('IntersectionObserver' in window) {
          var revealElements = container.querySelectorAll('.rsp-ac-reveal, .rsp-ac-card');
          var obs = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                entry.target.classList.add('rsp-visible');
                observer.unobserve(entry.target);
              }
            });
          }, {
            threshold: 0.05,
            rootMargin: '0px 0px -20px 0px'
          });

          revealElements.forEach(function(el) {
            obs.observe(el);
          });
        } else {
          var fallbackEls = container.querySelectorAll('.rsp-ac-reveal');
          fallbackEls.forEach(function(el) {
            el.classList.add('rsp-visible');
          });
        }

        // Structural safe invocation wrapper for asset icons render
        function rspRefreshAcademyIcons() {
          if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons({
              attrs: {
                class: 'lucide-icon'
              },
              nameAttr: 'data-lucide'
            });
          }
        }
        rspRefreshAcademyIcons();

        // Delayed safety loops for asynchronous template variations
        window.setTimeout(rspRefreshAcademyIcons, 600);
        window.setTimeout(rspRefreshAcademyIcons, 1400);
      });
    })();
  </script>
</main>

<?php
get_footer();
