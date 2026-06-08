<?php

/**
 * Template Name: Trust Center / Ethical Policy
 * Description: Premium ethical policy page for ReviewService.Pro
 */
if (! defined('ABSPATH')) exit;

get_header();
?>

<?php
/* ── Page data ─────────────────────────────────────────────────── */

$what_we_do = [
  ['icon' => 'eye',           'color' => '#2563eb', 'title' => 'Real-Time Review Monitoring',       'desc' => 'We monitor your reviews across 26+ platforms 24/7. Every review — positive or negative — is captured, logged, and flagged for action within hours.'],
  ['icon' => 'message-square', 'color' => '#10b981', 'title' => 'Professional Review Response',       'desc' => 'Every review receives a thoughtful, brand-aligned response written by a human ORM specialist — not an automated script or AI chatbot.'],
  ['icon' => 'users',         'color' => '#d6a84f', 'title' => 'Ethical Feedback Collection',        'desc' => 'We help you build a structured post-service feedback flow that invites genuine customers to share their real experiences — fully compliant with platform guidelines.'],
  ['icon' => 'map-pin',       'color' => '#8b5cf6', 'title' => 'Local Trust & Visibility',           'desc' => 'We optimise your Google Business Profile and local reputation signals using only platform-approved methods that improve visibility ethically.'],
  ['icon' => 'bar-chart-2',   'color' => '#06b6d4', 'title' => 'Transparent Reputation Reporting',  'desc' => 'Every month you receive an honest intelligence report covering real metrics — rating trends, sentiment analysis, response rates, and platform performance.'],
  ['icon' => 'shield-check',  'color' => '#f97316', 'title' => 'Platform-Compliant Strategy',        'desc' => 'Every tactic we use has been assessed against platform terms of service. We never advise or execute any action that risks your account or violates community guidelines.'],
];

$what_we_never_do = [
  'Generate, purchase, or distribute fake reviews',
  'Pay customers to leave positive reviews',
  'Threaten or incentivise customers to remove negative reviews',
  'Create fake business profiles or identities',
  'Use review gating to filter out negative feedback',
  'Engage in astroturfing or impersonation campaigns',
  'Deploy bots or automated spam to inflate review counts',
  'Use black-hat tactics that violate platform terms of service',
  'Make false claims about competitors',
  'Promise guaranteed star ratings or guaranteed review removal',
];

$platforms = [
  ['name' => 'Google',      'color' => '#4285F4', 'rule' => 'Google prohibits fake reviews, incentivised reviews, and review gating. All our feedback collection methods are compliant with Google\'s review policies and business profile guidelines.'],
  ['name' => 'Trustpilot',  'color' => '#00b67a', 'rule' => 'Trustpilot\'s Transparency Report and AFS system actively detect fake reviews. We comply fully with Trustpilot\'s guidelines — every review we help generate is from a genuine service recipient.'],
  ['name' => 'Yelp',        'color' => '#d32323', 'rule' => 'Yelp explicitly bans asking customers for reviews and penalises businesses that do. Our Yelp strategy focuses on visibility, professional response, and organic trust — never solicitation.'],
  ['name' => 'Facebook',    'color' => '#1877f2', 'rule' => 'Meta\'s review integrity policies prohibit fake recommendations and coordinated inauthentic behaviour. We support genuine customer engagement only.'],
  ['name' => 'Tripadvisor', 'color' => '#34967c', 'rule' => 'Tripadvisor uses fraud detection to identify and penalise fake reviews. Our hospitality clients receive ethical response strategy and genuine feedback system support only.'],
  ['name' => 'Glassdoor',   'color' => '#0f9d58', 'rule' => 'Glassdoor\'s Community Guidelines prohibit fake employer reviews and review manipulation. We help employers respond professionally to genuine employee feedback.'],
];

$commitments = [
  ['num' => '01', 'title' => 'We tell you the truth',         'desc' => 'We will never tell you what you want to hear if it isn\'t accurate. Our reports reflect real data. Our recommendations reflect what will genuinely help your business.'],
  ['num' => '02', 'title' => 'We respect platform rules',     'desc' => 'Every action we take on your behalf has been checked against platform terms of service. If a tactic crosses a line — even slightly — we don\'t use it.'],
  ['num' => '03', 'title' => 'We never overpromise',          'desc' => 'We do not guarantee specific star ratings, specific review counts, or removal of genuine reviews. We guarantee ethical, consistent effort and transparent reporting.'],
  ['num' => '04', 'title' => 'We protect your long-term brand', 'desc' => 'Short-term tactics that risk your account or brand integrity are never worth it. Every decision we make is designed to compound your reputation over years — not weeks.'],
  ['num' => '05', 'title' => 'We use AI responsibly',         'desc' => 'We use AI as a writing and analysis tool — always under human editorial review. No AI-generated reviews. No automated spam. No unverified AI outputs sent to clients without review.'],
];

$faqs = [
  [
    'q' => 'Do you sell or generate fake reviews?',
    'a' => 'No — never. Generating, purchasing, or distributing fake reviews is illegal under FTC guidelines (2024 rule, up to $51,744 per violation) and violates every major platform\'s terms of service. We have a zero-tolerance policy. Any client who requests fake reviews will have their engagement terminated immediately.'
  ],
  [
    'q' => 'Can you guarantee a specific star rating?',
    'a' => 'No. Any ORM agency that guarantees a specific rating is either lying or using methods that will eventually get your account penalised. We guarantee ethical effort, transparent reporting, and a strategy designed to improve your rating over time — but we cannot control how many reviews come in or what rating each customer gives.'
  ],
  [
    'q' => 'Can you remove negative reviews?',
    'a' => 'We cannot — and would not — remove genuine customer reviews. What we do is: respond professionally to reduce their impact, build positive review volume so your overall rating improves, and where reviews genuinely violate platform policies (spam, fake, or abusive), guide you through the official flagging process.'
  ],
  [
    'q' => 'Are your methods compliant with Google\'s review policies?',
    'a' => 'Yes. Our feedback collection methods comply fully with Google\'s guidelines. We do not use review gating, paid incentives, or any method that Google explicitly prohibits. Our post-service feedback flows are designed specifically to be platform-safe.'
  ],
  [
    'q' => 'How do you handle Trustpilot\'s strict guidelines?',
    'a' => 'Trustpilot operates an active fraud detection system (AFS). Our Trustpilot strategy involves only genuine post-service review invitations sent to real customers — fully compliant with their guidelines. We never attempt to game their algorithm or submit reviews outside their verified invitation system.'
  ],
  [
    'q' => 'Do you use AI to write reviews?',
    'a' => 'No. We use AI as a drafting and analysis assistance tool — but always under human editorial oversight. AI-generated reviews are explicitly banned by the FTC (August 2024 rule) and all major platforms. Every review response we craft is reviewed and approved by a human ORM specialist before it goes live.'
  ],
  [
    'q' => 'What happens if a client asks us to do something unethical?',
    'a' => 'We will clearly explain why the requested action is not something we can do — and provide an ethical alternative strategy. If a client insists on tactics that violate our ethical policy or platform guidelines, we will terminate the engagement. Our reputation depends on our ethics.'
  ],
  [
    'q' => 'How transparent are your reports?',
    'a' => 'Completely. Our monthly intelligence reports show real data — actual review counts, real sentiment percentages, genuine rating trends, and honest KPI performance. We do not inflate numbers, cherry-pick metrics, or present misleading summaries.'
  ],
  [
    'q' => 'Do you share client data with third parties?',
    'a' => 'No. Client business data, review information, and strategy details are treated as strictly confidential. We do not sell data, share it with third parties without consent, or use it for any purpose outside delivering your ORM service. Full details are in our Privacy Policy.'
  ],
  [
    'q' => 'What if my industry has specific review regulations?',
    'a' => 'We adapt our strategy to your industry\'s regulatory environment. Healthcare clients (HIPAA considerations), legal professionals (bar association guidelines), and financial services clients (FCA/FTC rules) each receive a compliance-adjusted ORM strategy. We flag any industry-specific constraints before we begin work.'
  ],
];

$industries = [
  ['icon' => '🍽️', 'name' => 'Restaurants',       'note' => 'Google, Yelp, Tripadvisor'],
  ['icon' => '🏥', 'name' => 'Clinics',            'note' => 'HIPAA-aware strategy'],
  ['icon' => '⚖️', 'name' => 'Law Firms',          'note' => 'Bar-compliant methods'],
  ['icon' => '🏠', 'name' => 'Real Estate',        'note' => 'Google, Zillow, Rightmove'],
  ['icon' => '🔧', 'name' => 'Home Services',      'note' => 'Checkatrade, Bark, Google'],
  ['icon' => '🛒', 'name' => 'Ecommerce',          'note' => 'Trustpilot, G2, Capterra'],
  ['icon' => '🏨', 'name' => 'Hotels',             'note' => 'Booking, TripAdvisor'],
  ['icon' => '🦷', 'name' => 'Dental Practices',   'note' => 'Patient trust strategy'],
];
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trust Center &amp; Ethical Policy | ReviewService.Pro</title>
  <meta name="description" content="ReviewService.Pro's complete ethical ORM policy. We never create fake reviews. Platform-compliant, transparent, and honest reputation management.">
  <?php wp_head(); ?>
</head>

<body <?php body_class('trust-center-page'); ?>>
  <?php wp_body_open(); ?>

  <?php get_header(); ?>

  <main id="main-content">

    <!-- ════════════════════════════════════════════════════════════════
     STICKY SIDE NAV (desktop)
════════════════════════════════════════════════════════════════ -->
    <nav class="hidden xl:flex fixed left-6 top-1/2 -translate-y-1/2 z-50
             flex-col gap-2 items-center"
      aria-label="Trust Center section navigation">
      <?php
      $nav_sections = [
        'tc-why'        => 'Why Ethics',
        'tc-commitment' => 'Commitment',
        'tc-do'         => 'What We Do',
        'tc-never'      => 'Never Do',
        'tc-platforms'  => 'Platforms',
        'tc-reporting'  => 'Reporting',
        'tc-ai'         => 'AI Ethics',
        'tc-client'     => 'Clients',
        'tc-industries' => 'Industries',
        'tc-faq'        => 'FAQ',
      ];
      foreach ($nav_sections as $id => $label) : ?>
        <a href="#<?php echo esc_attr($id); ?>"
          class="tc-nav-dot group flex items-center gap-2"
          aria-label="<?php echo esc_attr($label); ?>">
          <span class="w-1.5 h-1.5 rounded-full bg-white/20
                      group-hover:bg-blue-400 transition-colors duration-200"></span>
          <span class="opacity-0 group-hover:opacity-100 text-[10px] text-slate-500
                      transition-opacity duration-200 whitespace-nowrap">
            <?php echo esc_html($label); ?>
          </span>
        </a>
      <?php endforeach; ?>
    </nav>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 1: HERO
════════════════════════════════════════════════════════════════ -->
    <section class="relative bg-[#020817] overflow-hidden pt-28 pb-20 md:pt-36 md:pb-28"
      role="banner" aria-label="Trust Center hero">

      <div class="absolute inset-0 pointer-events-none z-0"
        style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-48 pointer-events-none z-0"
        style="background:linear-gradient(to bottom,rgba(37,99,235,0.6),transparent)"></div>
      <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[800px] h-[500px]
                bg-blue-600/[0.14] blur-[140px] rounded-full pointer-events-none z-0"></div>

      <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <span class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30
                      text-emerald-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                      px-4 py-1.5 rounded-full mb-6">
          <i data-lucide="shield-check" class="w-3.5 h-3.5" aria-hidden="true"></i>
          <?php esc_html_e('Trust Center &amp; Ethical Policy', 'reviewservicepro'); ?>
        </span>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.08]
                    tracking-tight text-white mb-6">
          We Build Trust.<br>
          <span class="bg-gradient-to-r from-emerald-400 via-emerald-300 to-emerald-400
                          bg-clip-text text-transparent">
            We Don't Manufacture It.
          </span>
        </h1>

        <p class="text-base md:text-lg text-slate-400 leading-relaxed max-w-2xl mx-auto mb-8">
          This page explains exactly how ReviewService.Pro operates — what we do, what we never do, and why our ethical commitment to platform-compliant reputation management is the foundation of everything we build for our clients.
        </p>

        <div class="flex flex-wrap justify-center gap-3 mb-10">
          <?php
          $hero_badges = [
            ['icon' => 'shield-check', 'text' => 'Zero Fake Reviews',         'color' => 'emerald'],
            ['icon' => 'check-circle', 'text' => 'Platform-Compliant',         'color' => 'blue'],
            ['icon' => 'eye',          'text' => 'Fully Transparent',          'color' => 'emerald'],
            ['icon' => 'lock',         'text' => 'FTC Compliant (2024)',        'color' => 'blue'],
          ];
          foreach ($hero_badges as $b) :
            $cls = $b['color'] === 'emerald'
              ? 'bg-emerald-900/20 border-emerald-700/25 text-emerald-300'
              : 'bg-blue-600/10 border-blue-500/25 text-blue-400';
          ?>
            <span class="inline-flex items-center gap-2 text-[11px] font-medium
                          border rounded-full px-4 py-1.5 <?php echo esc_attr($cls); ?>">
              <i data-lucide="<?php echo esc_attr($b['icon']); ?>" class="w-3.5 h-3.5" aria-hidden="true"></i>
              <?php echo esc_html($b['text']); ?>
            </span>
          <?php endforeach; ?>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
          <a href="/contact/"
            class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700
                       text-white font-semibold text-sm px-6 py-3 rounded-xl
                       transition-all duration-200 hover:-translate-y-0.5">
            <i data-lucide="calendar" class="w-4 h-4" aria-hidden="true"></i>
            Book a Free Audit
          </a>
          <a href="#tc-never"
            class="inline-flex items-center gap-2 border border-white/10
                       hover:border-white/25 text-slate-400 hover:text-white
                       font-medium text-sm px-6 py-3 rounded-xl transition-all duration-200">
            See What We Never Do
            <i data-lucide="arrow-down" class="w-4 h-4" aria-hidden="true"></i>
          </a>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 2: WHY ETHICS MATTER
════════════════════════════════════════════════════════════════ -->
    <section id="tc-why"
      class="relative bg-[#07111F] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Why ethics matter in ORM">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="inline-flex items-center gap-2 bg-red-500/10 border border-red-500/25
                          text-red-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                          px-4 py-1.5 rounded-full mb-4">
            <i data-lucide="alert-triangle" class="w-3.5 h-3.5" aria-hidden="true"></i>
            The Problem With The ORM Industry
          </span>
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Why Ethics Matter More Than Ever in Reputation Management
          </h2>
          <p class="text-sm text-slate-500 leading-relaxed">
            The online reputation industry has a serious problem. Dozens of agencies sell fake reviews, manufacture ratings, and make promises they cannot keep. Here's what that costs businesses.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
          <?php
          $problems = [
            ['icon' => 'ban',          'color' => '#ef4444', 'title' => 'FTC Fines Up To $51,744',     'desc' => 'The FTC\'s August 2024 rule explicitly bans fake reviews — including AI-generated ones. Each violation can result in fines up to $51,744 per infraction.'],
            ['icon' => 'x-circle',     'color' => '#f97316', 'title' => 'Platform Account Penalties',  'desc' => 'Google, Trustpilot, and Yelp actively detect fake reviews and penalise businesses — suspending profiles, removing all reviews, or banning accounts permanently.'],
            ['icon' => 'trending-down', 'color' => '#d6a84f', 'title' => 'Long-Term Brand Damage',      'desc' => 'When fake reviews are exposed — and they often are — the reputational damage is far worse than the original problem the business was trying to hide.'],
            ['icon' => 'eye-off',      'color' => '#8b5cf6', 'title' => 'Consumer Trust Erosion',      'desc' => 'Consumers are increasingly sceptical of online reviews. Manufactured ratings erode the trust of the very customers you\'re trying to attract.'],
          ];
          foreach ($problems as $p) :
          ?>
            <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6 relative overflow-hidden">
              <div class="absolute inset-x-0 top-0 h-[2px] opacity-60"
                style="background:<?php echo esc_attr($p['color']); ?>"></div>
              <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4
                             bg-white/[0.05] border border-white/[0.08]">
                <i data-lucide="<?php echo esc_attr($p['icon']); ?>" class="w-5 h-5"
                  style="color:<?php echo esc_attr($p['color']); ?>;" aria-hidden="true"></i>
              </div>
              <h3 class="text-[13px] font-bold text-white mb-2"><?php echo esc_html($p['title']); ?></h3>
              <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($p['desc']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="mt-8 bg-emerald-900/[0.08] border border-emerald-700/[0.2] rounded-2xl p-6 max-w-3xl mx-auto text-center">
          <p class="text-sm text-emerald-300 leading-relaxed">
            <strong class="font-semibold">Our position is simple:</strong> ethical, platform-compliant ORM delivers better long-term results than any shortcut. We have built our entire business on this principle.
          </p>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 3: OUR COMMITMENT
════════════════════════════════════════════════════════════════ -->
    <section id="tc-commitment"
      class="relative bg-[#0F1A2E] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Our ethical commitment">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Our Ethical Commitment
          </h2>
          <p class="text-sm text-slate-500 leading-relaxed">
            These are not marketing statements. They are operational commitments that every member of our team is held to on every client engagement.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 max-w-5xl mx-auto">
          <?php foreach ($commitments as $c) : ?>
            <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6
                         hover:border-emerald-500/25 transition-all duration-300 hover:-translate-y-1">
              <span class="text-[10px] font-bold font-mono text-emerald-500/40 mb-4 block">
                <?php echo esc_html($c['num']); ?>
              </span>
              <h3 class="text-[14px] font-bold text-white mb-3"><?php echo esc_html($c['title']); ?></h3>
              <p class="text-[12px] text-slate-500 leading-relaxed"><?php echo esc_html($c['desc']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 4: WHAT WE DO
════════════════════════════════════════════════════════════════ -->
    <section id="tc-do"
      class="relative bg-[#07111F] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="What we do">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/25
                          text-emerald-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                          px-4 py-1.5 rounded-full mb-4">
            <i data-lucide="check-circle" class="w-3.5 h-3.5" aria-hidden="true"></i>
            Ethical ORM Services
          </span>
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">What We Do</h2>
          <p class="text-sm text-slate-500 leading-relaxed">
            Every service we offer is designed to build genuine, sustainable reputation growth — using only methods that comply with platform guidelines and respect your customers.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
          <?php foreach ($what_we_do as $s) : ?>
            <div class="group bg-white/[0.025] border border-white/[0.07]
                         hover:border-[<?php echo esc_attr($s['color']); ?>]/40
                         rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1">
              <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4
                             bg-white/[0.05] border border-white/[0.08]
                             group-hover:scale-105 group-hover:rotate-3 transition-transform duration-300">
                <i data-lucide="<?php echo esc_attr($s['icon']); ?>" class="w-5 h-5"
                  style="color:<?php echo esc_attr($s['color']); ?>;" aria-hidden="true"></i>
              </div>
              <h3 class="text-[13px] font-bold text-white mb-2"><?php echo esc_html($s['title']); ?></h3>
              <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($s['desc']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 5: WHAT WE NEVER DO
════════════════════════════════════════════════════════════════ -->
    <section id="tc-never"
      class="relative bg-[#0F1A2E] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="What we never do">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
          <span class="inline-flex items-center gap-2 bg-red-500/10 border border-red-500/25
                          text-red-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                          px-4 py-1.5 rounded-full mb-4">
            <i data-lucide="x-circle" class="w-3.5 h-3.5" aria-hidden="true"></i>
            Clear Boundaries
          </span>
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">What We Never Do</h2>
          <p class="text-sm text-slate-500 leading-relaxed">
            We believe trust is built on what you refuse to do as much as what you choose to do. These are hard lines we will never cross — for any client, at any price.
          </p>
        </div>

        <!-- Green vs Red comparison -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto mb-12">

          <!-- What ethical ORM looks like -->
          <div class="bg-emerald-900/[0.08] border border-emerald-700/[0.2] rounded-2xl p-7">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-8 h-8 rounded-full bg-emerald-500/20
                         flex items-center justify-center">
                <i data-lucide="check" class="w-4 h-4 text-emerald-400"
                  aria-hidden="true"></i>
              </div>
              <h3 class="text-sm font-bold text-emerald-300">
                What Ethical ORM Looks Like
              </h3>
            </div>
            <?php
            $ethical_items = [
              'Invite genuine customers to share real experiences',
              'Respond professionally to all reviews — positive and negative',
              'Monitor your reputation across 26+ platforms in real time',
              'Analyse sentiment and provide honest monthly reporting',
              'Optimise your platform profiles using approved methods',
              'Flag reviews that genuinely violate platform policies',
              'Build a long-term reputation that compounds over time',
            ];
            foreach ($ethical_items as $item) : ?>
              <div class="flex items-start gap-3 py-2
                     border-b border-emerald-700/[0.12] last:border-0">
                <i data-lucide="check-circle"
                  class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0 mt-0.5"
                  aria-hidden="true"></i>
                <span class="text-[12px] text-emerald-300/80">
                  <?php echo esc_html($item); ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- What we never do -->
          <div class="bg-red-900/[0.06] border border-red-700/[0.18] rounded-2xl p-7">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-8 h-8 rounded-full bg-red-500/15
                         flex items-center justify-center">
                <i data-lucide="x" class="w-4 h-4 text-red-400"
                  aria-hidden="true"></i>
              </div>
              <h3 class="text-sm font-bold text-red-300">
                What We Will Never Do
              </h3>
            </div>
            <?php foreach ($what_we_never_do as $item) : ?>
              <div class="flex items-start gap-3 py-2
                     border-b border-red-700/[0.1] last:border-0">
                <i data-lucide="x-circle"
                  class="w-3.5 h-3.5 text-red-400/70 flex-shrink-0 mt-0.5"
                  aria-hidden="true"></i>
                <span class="text-[12px] text-red-300/60">
                  <?php echo esc_html($item); ?>
                </span>
              </div>
            <?php endforeach; ?>
          </div>

        </div>

        <div class="bg-[#D6A84F]/[0.06] border border-[#D6A84F]/[0.18] rounded-2xl p-6 max-w-3xl mx-auto text-center">
          <p class="text-[12px] text-[#D6A84F] leading-relaxed">
            <strong>Important:</strong> If any client requests tactics that fall into the "Never Do" list above, we will decline the request, explain why, and offer an ethical alternative. Clients who insist on unethical tactics will have their engagement terminated without refund of service fees already rendered.
          </p>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 6: PLATFORM COMPLIANCE
════════════════════════════════════════════════════════════════ -->
    <section id="tc-platforms"
      class="relative bg-[#07111F] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Platform compliance">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Platform Compliance</h2>
          <p class="text-sm text-slate-500 leading-relaxed">
            Every major review platform has explicit rules about what businesses can and cannot do. We know these rules inside-out — and we design every client strategy around strict compliance.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
          <?php foreach ($platforms as $p) : ?>
            <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6
                         hover:border-white/[0.15] transition-all duration-300">
              <div class="flex items-center gap-3 mb-4">
                <span class="w-2 h-2 rounded-full flex-shrink-0"
                  style="background:<?php echo esc_attr($p['color']); ?>"></span>
                <h3 class="text-[13px] font-bold text-white"><?php echo esc_html($p['name']); ?></h3>
              </div>
              <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($p['rule']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 7: TRANSPARENCY & REPORTING
════════════════════════════════════════════════════════════════ -->
    <section id="tc-reporting"
      class="relative bg-[#0F1A2E] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Transparency and reporting">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

          <div>
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">
              Transparency &amp; Reporting
            </h2>
            <p class="text-sm text-slate-500 leading-relaxed mb-8">
              You will always know exactly what we have done, what is working, and what the numbers actually say. We do not produce reports designed to make us look good — we produce reports designed to give you accurate intelligence.
            </p>
            <?php
            $reporting_items = [
              ['icon' => 'bar-chart-2', 'text' => 'Real rating and review volume data — never inflated'],
              ['icon' => 'trending-up', 'text' => 'Honest sentiment trend analysis per platform'],
              ['icon' => 'check-square', 'text' => 'Full response log — every action taken on your behalf'],
              ['icon' => 'clock',        'text' => 'Response time tracking and SLA performance'],
              ['icon' => 'eye',          'text' => 'Platform health status — flags, gaps, opportunities'],
              ['icon' => 'users',        'text' => 'Competitor reputation benchmark comparison'],
            ];
            foreach ($reporting_items as $r) : ?>
              <div class="flex items-center gap-3 py-2.5 border-b border-white/[0.05] last:border-0">
                <i data-lucide="<?php echo esc_attr($r['icon']); ?>"
                  class="w-4 h-4 text-emerald-400 flex-shrink-0" aria-hidden="true"></i>
                <span class="text-[12px] text-slate-400"><?php echo esc_html($r['text']); ?></span>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="bg-white/[0.02] border border-white/[0.07] rounded-2xl p-7">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/[0.06]">
              <span class="text-xs font-semibold text-slate-500 tracking-wider uppercase">Monthly Report Includes</span>
            </div>
            <?php
            $report_items = [
              ['label' => 'Reputation Score',   'value' => 'Real index, not estimated',   'color' => '#2563eb'],
              ['label' => 'Avg. Star Rating',   'value' => 'Per platform + combined',     'color' => '#d6a84f'],
              ['label' => 'Review Volume',      'value' => 'New + total + platform split', 'color' => '#10b981'],
              ['label' => 'Sentiment %',        'value' => 'Positive / Neutral / Negative', 'color' => '#8b5cf6'],
              ['label' => 'Response Rate',      'value' => '% of reviews responded to',  'color' => '#06b6d4'],
              ['label' => 'Response Time',      'value' => 'Average hours to respond',   'color' => '#f97316'],
              ['label' => 'Platform Health',    'value' => 'Status check all platforms', 'color' => '#10b981'],
              ['label' => 'Next Month Actions', 'value' => 'Prioritised strategy items', 'color' => '#2563eb'],
            ];
            foreach ($report_items as $r) : ?>
              <div class="flex items-center justify-between py-2.5 border-b border-white/[0.04] last:border-0">
                <span class="text-[11px] font-medium text-white flex items-center gap-2">
                  <span class="w-1.5 h-1.5 rounded-full flex-shrink-0"
                    style="background:<?php echo esc_attr($r['color']); ?>"></span>
                  <?php echo esc_html($r['label']); ?>
                </span>
                <span class="text-[10px] text-slate-600"><?php echo esc_html($r['value']); ?></span>
              </div>
            <?php endforeach; ?>
          </div>

        </div>
      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 8: AI & AUTOMATION ETHICS
════════════════════════════════════════════════════════════════ -->
    <section id="tc-ai"
      class="relative bg-[#07111F] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="AI and automation ethics">

      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            AI &amp; Automation Ethics
          </h2>
          <p class="text-sm text-slate-500 leading-relaxed">
            We use AI as a tool to work more effectively for our clients — never as a replacement for human judgement, and never for anything that would compromise review integrity.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <?php
          $ai_items = [
            [
              'icon' => 'check-circle',
              'color' => '#10b981',
              'type' => 'do',
              'title' => 'How We Use AI',
              'items' => [
                'AI-assisted response drafting — always human-reviewed before publishing',
                'Sentiment analysis to identify patterns across review data',
                'Content gap identification for ORM strategy planning',
                'Report generation assistance — data verified by our team',
                'Platform monitoring alert triage and prioritisation',
              ]
            ],
            [
              'icon' => 'x-circle',
              'color' => '#ef4444',
              'type' => 'never',
              'title' => 'What AI Is Never Used For',
              'items' => [
                'Generating fake or synthetic reviews — explicitly FTC-banned since 2024',
                'Automated review submission without human oversight',
                'Spam outreach or mass automated review requests',
                'Impersonating customers or creating false identities',
                'Any output published directly without human editorial review',
              ]
            ],
          ];
          foreach ($ai_items as $ai) :
            $bg  = $ai['type'] === 'do' ? 'bg-emerald-900/[0.08] border-emerald-700/[0.2]' : 'bg-red-900/[0.06] border-red-700/[0.18]';
            $ic  = $ai['type'] === 'do' ? 'text-emerald-400' : 'text-red-400/70';
            $tc  = $ai['type'] === 'do' ? 'text-emerald-300' : 'text-red-300';
            $bd  = $ai['type'] === 'do' ? 'border-emerald-700/[0.12]' : 'border-red-700/[0.1]';
            $txt = $ai['type'] === 'do' ? 'text-emerald-300/80' : 'text-red-300/60';
          ?>
            <div class="<?php echo esc_attr($bg); ?> border rounded-2xl p-7">
              <div class="flex items-center gap-3 mb-5">
                <i data-lucide="<?php echo esc_attr($ai['icon']); ?>"
                  class="w-5 h-5 <?php echo esc_attr($ic); ?>" aria-hidden="true"></i>
                <h3 class="text-sm font-bold <?php echo esc_attr($tc); ?>"><?php echo esc_html($ai['title']); ?></h3>
              </div>
              <?php foreach ($ai['items'] as $item) : ?>
                <div class="flex items-start gap-2.5 py-2 border-b <?php echo esc_attr($bd); ?> last:border-0">
                  <i data-lucide="<?php echo esc_attr($ai['icon']); ?>"
                    class="w-3 h-3 <?php echo esc_attr($ic); ?> flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                  <span class="text-[11px] <?php echo esc_attr($txt); ?>"><?php echo esc_html($item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 9: CLIENT RESPONSIBILITIES
════════════════════════════════════════════════════════════════ -->
    <section id="tc-client"
      class="relative bg-[#0F1A2E] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Client responsibilities">

      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Client Responsibilities</h2>
        <p class="text-sm text-slate-500 leading-relaxed max-w-2xl mx-auto mb-12">
          Ethical reputation management is a partnership. We hold ourselves to the highest standards — and we ask our clients to do the same. Our ORM services are only effective when they reflect the genuine quality of your business.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-left">
          <?php
          $client_items = [
            ['icon' => 'users',        'title' => 'Deliver Genuine Customer Experiences',    'desc' => 'Our feedback system only works if you\'re actually serving customers well. ORM cannot substitute for product or service quality — it amplifies what already exists.'],
            ['icon' => 'message-square', 'title' => 'Respond to Concerns Honestly',           'desc' => 'When our team flags customer issues identified through review monitoring, we ask that you address them genuinely — not just respond to the review.'],
            ['icon' => 'shield',        'title' => 'Never Request Unethical Actions',         'desc' => 'If you ask us to use tactics we\'ve identified as unethical — fake reviews, manipulation, or platform violations — we will decline and it may end our engagement.'],
            ['icon' => 'trending-up',   'title' => 'Commit to Long-Term Trust Building',      'desc' => 'Reputation growth is not a sprint. Clients who commit to a consistent long-term strategy see compounding results. Short-term thinking rarely delivers lasting reputation improvement.'],
          ];
          foreach ($client_items as $c) :
          ?>
            <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6">
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-600/10 border border-blue-500/20
                                 flex items-center justify-center flex-shrink-0">
                  <i data-lucide="<?php echo esc_attr($c['icon']); ?>"
                    class="w-4 h-4 text-blue-400" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="text-[13px] font-bold text-white mb-2"><?php echo esc_html($c['title']); ?></h3>
                  <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($c['desc']); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 10: INDUSTRIES
════════════════════════════════════════════════════════════════ -->
    <section id="tc-industries"
      class="relative bg-[#07111F] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Industries we protect">

      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Industries We Protect</h2>
        <p class="text-sm text-slate-500 leading-relaxed max-w-xl mx-auto mb-10">
          We work with businesses across industries where customer trust and online reviews directly impact revenue and reputation.
        </p>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
          <?php foreach ($industries as $ind) : ?>
            <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-5 text-center
                         hover:border-white/[0.15] transition-all duration-300 hover:-translate-y-1">
              <span class="text-3xl block mb-3" role="img" aria-label="<?php echo esc_attr($ind['name']); ?>">
                <?php echo $ind['icon']; ?>
              </span>
              <p class="text-[12px] font-semibold text-white mb-1"><?php echo esc_html($ind['name']); ?></p>
              <p class="text-[10px] text-slate-600"><?php echo esc_html($ind['note']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 11: TRUST SIGNALS
════════════════════════════════════════════════════════════════ -->
    <section class="relative bg-[#0F1A2E] py-16 border-t border-white/[0.05]"
      aria-label="Trust signals">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
          <?php
          $trust_stats = [
            ['num' => '500+',  'label' => 'Businesses helped ethically',    'color' => '#2563eb'],
            ['num' => '26+',   'label' => 'Platforms monitored',            'color' => '#10b981'],
            ['num' => '100%',  'label' => 'Platform-compliant methods',     'color' => '#d6a84f'],
            ['num' => '0',     'label' => 'Fake reviews ever generated',    'color' => '#ef4444'],
          ];
          foreach ($trust_stats as $s) :
          ?>
            <div class="text-center bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6">
              <div class="text-3xl font-extrabold mb-2"
                style="color:<?php echo esc_attr($s['color']); ?>">
                <?php echo esc_html($s['num']); ?>
              </div>
              <p class="text-[11px] text-slate-500"><?php echo esc_html($s['label']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 12: FAQ
════════════════════════════════════════════════════════════════ -->
    <section id="tc-faq"
      class="relative bg-[#07111F] py-20 md:py-24 border-t border-white/[0.05]"
      aria-label="Frequently asked questions about our ethical policy"
      x-data="{ open: 0 }">

      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Ethical ORM — Your Questions Answered
          </h2>
          <p class="text-sm text-slate-500">
            Honest answers to the questions clients most commonly ask about how we operate.
          </p>
        </div>

        <div class="space-y-3">
          <?php foreach ($faqs as $i => $faq) : ?>
            <div class="border border-white/[0.07] rounded-xl overflow-hidden
                         transition-all duration-250"
              :class="<?php echo $i; ?> === open
                     ? 'border-blue-500/30 bg-blue-600/[0.04]'
                     : 'bg-white/[0.02]'"
              x-data="{ open: <?php echo $i === 0 ? 'true' : 'false'; ?> }">

              <button class="w-full flex items-center gap-3 px-5 py-4 text-left transition-all"
                :class="open ? 'border-l-2 border-blue-500 pl-4' : ''"
                @click="open = !open"
                :aria-expanded="open.toString()">
                <span class="text-[12px] font-semibold flex-1 leading-snug transition-colors"
                  :class="open ? 'text-white' : 'text-slate-400'">
                  <?php echo esc_html($faq['q']); ?>
                </span>
                <i data-lucide="chevron-down"
                  class="w-4 h-4 flex-shrink-0 transition-all duration-300"
                  :class="open ? 'rotate-180 text-blue-400' : 'text-slate-700'"
                  aria-hidden="true"></i>
              </button>

              <div x-show="open"
                x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-end="opacity-0">
                <p class="text-[12px] text-slate-500 leading-relaxed px-5 pb-5 pl-10">
                  <?php echo esc_html($faq['a']); ?>
                </p>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════
     SECTION 13: FINAL CTA
════════════════════════════════════════════════════════════════ -->
    <section class="relative bg-[#020817] py-24 border-t border-white/[0.05] overflow-hidden"
      aria-label="Work with an ethical ORM agency">

      <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[700px] h-[500px]
                bg-emerald-500/[0.08] blur-[120px] rounded-full pointer-events-none"></div>

      <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <span class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/25
                      text-emerald-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                      px-4 py-1.5 rounded-full mb-6">
          <i data-lucide="shield-check" class="w-3.5 h-3.5" aria-hidden="true"></i>
          Work With an ORM Agency You Can Trust
        </span>

        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white
                    leading-tight tracking-tight mb-5">
          Your reputation is too important<br>
          <span class="text-emerald-400">for shortcuts.</span>
        </h2>

        <p class="text-sm md:text-base text-slate-500 leading-relaxed max-w-xl mx-auto mb-8">
          If you've read this page, you already know the difference between what we do and what the industry too often offers. Start with a free reputation audit — no obligation, no pressure, no misleading promises.
        </p>

        <div class="flex flex-wrap justify-center gap-4">
          <a href="/contact/?type=audit"
            class="inline-flex items-center gap-2
                       bg-emerald-600 hover:bg-emerald-700
                       text-white font-semibold text-sm
                       px-7 py-3.5 rounded-xl
                       transition-all duration-200 hover:-translate-y-0.5
                       shadow-[0_8px_32px_rgba(16,185,129,0.25)]">
            <i data-lucide="search" class="w-4 h-4" aria-hidden="true"></i>
            Get My Free Reputation Audit
          </a>
          <a href="/services/"
            class="inline-flex items-center gap-2 border border-white/[0.12]
                       hover:border-white/[0.25] text-slate-400 hover:text-white
                       font-medium text-sm px-7 py-3.5 rounded-xl
                       transition-all duration-200">
            View Our Services
            <i data-lucide="arrow-right" class="w-4 h-4" aria-hidden="true"></i>
          </a>
        </div>

        <p class="text-[11px] text-slate-700 mt-6">
          Reviewed and updated regularly · Last reviewed <?php echo date('F Y'); ?>
        </p>

      </div>
    </section>

  </main>

  <?php get_footer(); ?>

  <?php
  /*
 * TEMPLATE   : Trust Center / Ethical Policy
 * FILE       : page-templates/template-trust-center.php
 * URL        : /trust-center/
 * SECTIONS   : Hero, Why Ethics, Commitment (×5), What We Do (×6),
 *              What We Never Do (×10), Platform Compliance (×6),
 *              Transparency, AI Ethics, Client Responsibilities,
 *              Industries (×8), Trust Stats, FAQ (×10), Final CTA
 * REQUIRES   : Alpine.js for FAQ accordion (enqueued via inc/enqueue.php)
 *              Lucide icons (lucide.createIcons() in footer.php)
 * SEO        : H1 in hero, H2 per section, structured content
 *              FAQPage schema output via inc/schema.php
 * SCHEMA     : Add orm_schema_faq() call targeting trust center FAQs
 * INTERNAL LINKS: Links to /contact/, /services/, /privacy-policy/
 * LINKED FROM: footer.php, faq.php, final-cta.php, hero.php (ethical badge)
 */
  ?>