<?php

/**
 * Template Name: Privacy Policy
 * Description: Premium privacy policy page for ReviewService.Pro
 */
if (! defined('ABSPATH')) exit;
get_header();

$effective_date = 'January 1, 2025';
$last_updated   = date('F j, Y');
$company        = 'ReviewService.Pro';
$address        = '30 N Gould St Ste N, Sheridan, WY 82801';
$contact_email  = get_theme_mod('cta_email', 'privacy@reviewservice.pro');

$nav_sections = [
  'pp-intro'       => 'Introduction',
  'pp-collect'     => 'Data We Collect',
  'pp-use'         => 'How We Use It',
  'pp-security'    => 'Security',
  'pp-third-party' => 'Third Parties',
  'pp-ai'          => 'AI & Automation',
  'pp-cookies'     => 'Cookies',
  'pp-rights'      => 'Your Rights',
  'pp-compliance'  => 'Compliance',
  'pp-retention'   => 'Data Retention',
  'pp-disclaimer'  => 'Disclaimer',
  'pp-faq'         => 'FAQ',
];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Privacy Policy | ReviewService.Pro</title>
  <meta name="description" content="ReviewService.Pro's full privacy policy. Learn how we collect, use, and protect your data as an ethical online reputation management agency.">
  <?php wp_head(); ?>
</head>

<body <?php body_class('legal-page privacy-policy-page'); ?>>
  <?php wp_body_open(); ?>
  <?php get_header(); ?>

  <main id="main-content">

    <!-- ── STICKY SIDE NAV ── -->
    <nav class="hidden xl:flex fixed left-6 top-1/2 -translate-y-1/2 z-50
             flex-col gap-2"
      aria-label="Privacy policy navigation">
      <?php foreach ($nav_sections as $id => $label) : ?>
        <a href="#<?php echo esc_attr($id); ?>"
          class="group flex items-center gap-2"
          aria-label="<?php echo esc_attr($label); ?>">
          <span class="w-1.5 h-1.5 rounded-full bg-white/15
                      group-hover:bg-blue-400 transition-colors duration-200"></span>
          <span class="text-[10px] text-slate-700 group-hover:text-slate-500
                      transition-colors duration-200 whitespace-nowrap">
            <?php echo esc_html($label); ?>
          </span>
        </a>
      <?php endforeach; ?>
    </nav>

    <!-- ════════════════════════════════════
     HERO
════════════════════════════════════ -->
    <section class="relative bg-[#020817] overflow-hidden pt-28 pb-20 md:pt-36 md:pb-24"
      role="banner">
      <div class="absolute inset-0 pointer-events-none z-0"
        style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-44 pointer-events-none z-0"
        style="background:linear-gradient(to bottom,rgba(37,99,235,0.5),transparent)"></div>
      <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[700px] h-[400px]
                bg-blue-600/[0.12] blur-[130px] rounded-full pointer-events-none z-0"></div>

      <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <span class="inline-flex items-center gap-2
                      bg-blue-600/10 border border-blue-500/30
                      text-blue-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                      px-4 py-1.5 rounded-full mb-5">
          <i data-lucide="lock" class="w-3.5 h-3.5" aria-hidden="true"></i>
          Privacy Policy
        </span>

        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white
                    leading-[1.08] mb-5">
          Your Data. Your Trust.<br>
          <span class="bg-gradient-to-r from-blue-400 via-blue-300 to-blue-400
                          bg-clip-text text-transparent">
            Our Responsibility.
          </span>
        </h1>

        <p class="text-sm md:text-base text-slate-500 leading-relaxed max-w-xl mx-auto mb-8">
          We believe transparency about how we handle your data is a fundamental part of being a trustworthy reputation management agency. This policy explains exactly what we collect, why we need it, and how we protect it.
        </p>

        <div class="flex flex-wrap justify-center gap-3 mb-8">
          <?php
          $badges = [
            ['icon' => 'shield-check', 'text' => 'GDPR-Aware',          'c' => 'emerald'],
            ['icon' => 'lock',         'text' => 'Data Encrypted',       'c' => 'blue'],
            ['icon' => 'eye-off',      'text' => 'Never Sold',           'c' => 'emerald'],
            ['icon' => 'check-circle', 'text' => 'FTC Compliant',        'c' => 'blue'],
          ];
          foreach ($badges as $b) :
            $cls = $b['c'] === 'emerald'
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

        <div class="flex flex-wrap justify-center gap-3 text-[11px] text-slate-600">
          <span>Effective: <?php echo esc_html($effective_date); ?></span>
          <span>·</span>
          <span>Last updated: <?php echo esc_html($last_updated); ?></span>
          <span>·</span>
          <span><?php echo esc_html($company); ?> · <?php echo esc_html($address); ?></span>
        </div>

      </div>
    </section>

    <!-- ════════════════════════════════════
     TABLE OF CONTENTS
════════════════════════════════════ -->
    <div class="bg-[#07111F] border-t border-white/[0.05] py-8">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-[10px] font-bold uppercase tracking-[0.1em] text-slate-600 mb-4">Table of Contents</p>
        <div class="flex flex-wrap gap-2">
          <?php foreach ($nav_sections as $id => $label) : ?>
            <a href="#<?php echo esc_attr($id); ?>"
              class="text-[11px] text-slate-600 hover:text-slate-400
                       bg-white/[0.03] border border-white/[0.07]
                       hover:border-white/[0.15] hover:bg-white/[0.06]
                       rounded-lg px-3 py-1.5 transition-all duration-200">
              <?php echo esc_html($label); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- ════════════════════════════════════
     CONTENT WRAPPER
════════════════════════════════════ -->
    <div class="bg-[#07111F]">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">

        <!-- 1. INTRODUCTION -->
        <section id="pp-intro" aria-labelledby="pp-intro-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">01</span>
            <h2 id="pp-intro-h" class="text-xl font-bold text-white">Introduction</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7 space-y-4">
            <p class="text-[13px] text-slate-400 leading-relaxed">
              <?php echo esc_html($company); ?> ("we", "us", "our") is an ethical online reputation management agency registered at <?php echo esc_html($address); ?>. This Privacy Policy explains how we collect, use, protect, and handle personal information when you use our website (<a href="/" class="text-blue-400 hover:underline">reviewservice.pro</a>) or engage our ORM services.
            </p>
            <p class="text-[13px] text-slate-400 leading-relaxed">
              By using our website or services, you agree to the practices described in this policy. If you do not agree, please do not use our services. We encourage you to read this policy in full — it is written in plain language, not legal jargon.
            </p>
            <div class="bg-blue-600/[0.07] border border-blue-500/[0.18] rounded-xl p-4">
              <p class="text-[12px] text-blue-300 leading-relaxed">
                <strong>ORM context:</strong> As a reputation management agency, we handle data about your business, your customers' reviews, and your online platform presence. We take this responsibility seriously. Your client data is never used for any purpose other than delivering your agreed ORM services.
              </p>
            </div>
          </div>
        </section>

        <!-- 2. INFORMATION WE COLLECT -->
        <section id="pp-collect" aria-labelledby="pp-collect-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">02</span>
            <h2 id="pp-collect-h" class="text-xl font-bold text-white">Information We Collect</h2>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php
            $collect_items = [
              [
                'icon'  => 'user',
                'color' => '#2563eb',
                'title' => 'Client & Business Data',
                'items' => [
                  'Business name, address, and contact details',
                  'Name and email of account holder',
                  'Business category and industry',
                  'Platform account information (profile URLs)',
                  'Billing and payment information (processed securely)',
                ],
              ],
              [
                'icon'  => 'star',
                'color' => '#10b981',
                'title' => 'Review & Platform Data',
                'items' => [
                  'Public review content from monitored platforms',
                  'Review dates, star ratings, and reviewer names (public)',
                  'Platform performance metrics',
                  'Competitor public review data (for benchmarking)',
                  'Platform profile health information',
                ],
              ],
              [
                'icon'  => 'message-square',
                'color' => '#d6a84f',
                'title' => 'Communication Data',
                'items' => [
                  'Emails, messages, and consultation notes',
                  'Form submissions from this website',
                  'Newsletter subscription email addresses',
                  'WhatsApp messages (where you contact us)',
                  'Consultation call notes and agreed action items',
                ],
              ],
              [
                'icon'  => 'bar-chart-2',
                'color' => '#8b5cf6',
                'title' => 'Website & Analytics Data',
                'items' => [
                  'IP address and approximate location',
                  'Browser type and device information',
                  'Pages visited and time spent on site',
                  'Referral source (how you found us)',
                  'Cookie and session data (see Cookies section)',
                ],
              ],
            ];
            foreach ($collect_items as $item) :
            ?>
              <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-9 h-9 rounded-xl flex items-center justify-center
                             bg-white/[0.05] border border-white/[0.08]">
                    <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="w-4 h-4"
                      style="color:<?php echo esc_attr($item['color']); ?>;" aria-hidden="true"></i>
                  </div>
                  <h3 class="text-[13px] font-bold text-white"><?php echo esc_html($item['title']); ?></h3>
                </div>
                <ul class="space-y-1.5">
                  <?php foreach ($item['items'] as $li) : ?>
                    <li class="flex items-start gap-2 text-[11px] text-slate-500">
                      <i data-lucide="dot" class="w-3 h-3 text-slate-700 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                      <?php echo esc_html($li); ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- 3. HOW WE USE INFORMATION -->
        <section id="pp-use" aria-labelledby="pp-use-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">03</span>
            <h2 id="pp-use-h" class="text-xl font-bold text-white">How We Use Your Information</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
            <?php
            $use_items = [
              ['icon' => 'monitor',       'color' => '#2563eb', 'title' => 'Review Monitoring',           'desc' => 'To track and analyse your reviews across platforms and provide timely alerts and responses.'],
              ['icon' => 'file-text',     'color' => '#10b981', 'title' => 'Monthly Reporting',           'desc' => 'To prepare your reputation intelligence report with accurate metrics, trends, and KPIs.'],
              ['icon' => 'message-square', 'color' => '#d6a84f', 'title' => 'Client Communication',        'desc' => 'To respond to enquiries, send service updates, and deliver your consultation outputs.'],
              ['icon' => 'mail',          'color' => '#8b5cf6', 'title' => 'Newsletter (if subscribed)',  'desc' => 'To send weekly ORM tips and strategy content — only if you explicitly opted in. Unsubscribe anytime.'],
              ['icon' => 'trending-up',   'color' => '#06b6d4', 'title' => 'Service Improvement',        'desc' => 'To understand how our clients use our services and improve our platform strategies.'],
              ['icon' => 'shield',        'color' => '#f97316', 'title' => 'Legal & Compliance',         'desc' => 'To comply with applicable laws, enforce our Terms of Service, and protect against fraud or abuse.'],
            ];
            foreach ($use_items as $u) :
            ?>
              <div class="flex items-start gap-4 py-4 border-b border-white/[0.05] last:border-0">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0
                         bg-white/[0.04] border border-white/[0.07]">
                  <i data-lucide="<?php echo esc_attr($u['icon']); ?>" class="w-4 h-4"
                    style="color:<?php echo esc_attr($u['color']); ?>;" aria-hidden="true"></i>
                </div>
                <div>
                  <p class="text-[12px] font-semibold text-white mb-1"><?php echo esc_html($u['title']); ?></p>
                  <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($u['desc']); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="mt-4 bg-emerald-900/[0.08] border border-emerald-700/[0.18] rounded-xl p-4">
            <p class="text-[12px] text-emerald-300 leading-relaxed">
              <strong>We will never:</strong> sell your data to third parties, use your business information for advertising unrelated to your services, or share client review strategy with any competitor or unauthorised party.
            </p>
          </div>
        </section>

        <!-- 4. DATA SECURITY -->
        <section id="pp-security" aria-labelledby="pp-security-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">04</span>
            <h2 id="pp-security-h" class="text-xl font-bold text-white">Data Protection &amp; Security</h2>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $security_items = [
              ['icon' => 'lock',        'color' => '#2563eb', 'title' => 'SSL Encryption',        'desc' => 'All data transmitted to and from our website is encrypted via SSL/TLS.'],
              ['icon' => 'server',      'color' => '#10b981', 'title' => 'Secure Storage',        'desc' => 'Client data is stored on secured servers with restricted access controls.'],
              ['icon' => 'users',       'color' => '#d6a84f', 'title' => 'Access Controls',       'desc' => 'Only authorised team members with a legitimate need can access client data.'],
              ['icon' => 'eye',         'color' => '#8b5cf6', 'title' => 'Human Oversight',       'desc' => 'All AI-assisted processes are reviewed by a human before client-facing use.'],
              ['icon' => 'shield-check', 'color' => '#06b6d4', 'title' => 'Confidentiality',       'desc' => 'All team members are bound by confidentiality agreements covering client data.'],
              ['icon' => 'alert-triangle', 'color' => '#f97316', 'title' => 'Breach Protocol',      'desc' => 'In the unlikely event of a data breach, affected clients will be notified promptly.'],
            ];
            foreach ($security_items as $s) :
            ?>
              <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-3
                         bg-white/[0.05] border border-white/[0.08]">
                  <i data-lucide="<?php echo esc_attr($s['icon']); ?>" class="w-4 h-4"
                    style="color:<?php echo esc_attr($s['color']); ?>;" aria-hidden="true"></i>
                </div>
                <h3 class="text-[12px] font-bold text-white mb-2"><?php echo esc_html($s['title']); ?></h3>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($s['desc']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="mt-4 bg-white/[0.02] border border-white/[0.06] rounded-xl p-4">
            <p class="text-[12px] text-slate-600 leading-relaxed">
              <strong class="text-slate-500">Important:</strong> While we implement strong security measures, no system is 100% secure. We cannot guarantee absolute security of data transmitted over the internet. We encourage you to protect your own credentials and notify us immediately if you suspect any unauthorised access.
            </p>
          </div>
        </section>

        <!-- 5. THIRD-PARTY PLATFORMS -->
        <section id="pp-third-party" aria-labelledby="pp-third-party-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">05</span>
            <h2 id="pp-third-party-h" class="text-xl font-bold text-white">Third-Party Platforms</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
            <p class="text-[13px] text-slate-400 leading-relaxed mb-6">
              Our ORM services require us to interact with third-party review platforms on your behalf. We access only publicly available review data and authorised platform features. We are bound by each platform's terms of service.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <?php
              $platforms = [
                ['name' => 'Google',      'color' => '#4285F4', 'note' => 'Google Business Profile, Google Maps reviews — monitored under Google\'s API and terms.'],
                ['name' => 'Trustpilot',  'color' => '#00b67a', 'note' => 'Review monitoring and response — compliant with Trustpilot\'s AFS and guidelines.'],
                ['name' => 'Yelp',        'color' => '#d32323', 'note' => 'Public review monitoring — Yelp\'s terms prohibit direct solicitation.'],
                ['name' => 'Facebook',    'color' => '#1877f2', 'note' => 'Facebook page recommendations — Meta\'s review integrity policies apply.'],
                ['name' => 'Tripadvisor', 'color' => '#34967c', 'note' => 'Hospitality review monitoring — Tripadvisor fraud detection standards observed.'],
                ['name' => 'Glassdoor',   'color' => '#0f9d58', 'note' => 'Employer review monitoring — Glassdoor community guidelines complied with fully.'],
              ];
              foreach ($platforms as $p) :
              ?>
                <div class="flex items-start gap-3 bg-white/[0.02] border border-white/[0.05]
                         rounded-xl p-4">
                  <span class="w-2 h-2 rounded-full flex-shrink-0 mt-1.5"
                    style="background:<?php echo esc_attr($p['color']); ?>"></span>
                  <div>
                    <p class="text-[11px] font-semibold text-white mb-0.5"><?php echo esc_html($p['name']); ?></p>
                    <p class="text-[11px] text-slate-600 leading-relaxed"><?php echo esc_html($p['note']); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <p class="text-[12px] text-slate-600 mt-5 leading-relaxed">
              Each platform has its own privacy policy and terms of service. We encourage you to review them independently. We do not share your personal data with these platforms beyond what is necessary to deliver your ORM services.
            </p>
          </div>
        </section>

        <!-- 6. AI & AUTOMATION -->
        <section id="pp-ai" aria-labelledby="pp-ai-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">06</span>
            <h2 id="pp-ai-h" class="text-xl font-bold text-white">AI &amp; Automation Transparency</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
            <p class="text-[13px] text-slate-400 leading-relaxed mb-6">
              We use AI tools to assist with drafting, analysis, and reporting — always under human editorial oversight. Here is exactly how AI does and does not interact with your data.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div class="bg-emerald-900/[0.08] border border-emerald-700/[0.18] rounded-xl p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-500 mb-3">AI Is Used For</p>
                <?php
                $ai_do = [
                  'Drafting review response suggestions (human-reviewed before publishing)',
                  'Sentiment pattern analysis across your review data',
                  'Identifying gaps and opportunities in your reputation strategy',
                  'Assisting with monthly report preparation (data verified by our team)',
                ];
                foreach ($ai_do as $item) : ?>
                  <div class="flex items-start gap-2 py-1.5 border-b border-emerald-700/[0.1] last:border-0">
                    <i data-lucide="check-circle" class="w-3 h-3 text-emerald-400 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                    <span class="text-[11px] text-emerald-300/80"><?php echo esc_html($item); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="bg-red-900/[0.06] border border-red-700/[0.15] rounded-xl p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-red-400 mb-3">AI Is Never Used For</p>
                <?php
                $ai_never = [
                  'Generating fake or synthetic reviews (FTC-banned since August 2024)',
                  'Automated review submission without human authorisation',
                  'Processing client data for AI model training',
                  'Any unverified AI output published directly without review',
                ];
                foreach ($ai_never as $item) : ?>
                  <div class="flex items-start gap-2 py-1.5 border-b border-red-700/[0.08] last:border-0">
                    <i data-lucide="x-circle" class="w-3 h-3 text-red-400/70 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                    <span class="text-[11px] text-red-300/60"><?php echo esc_html($item); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </section>

        <!-- 7. COOKIES -->
        <section id="pp-cookies" aria-labelledby="pp-cookies-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">07</span>
            <h2 id="pp-cookies-h" class="text-xl font-bold text-white">Cookies &amp; Tracking</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
            <p class="text-[13px] text-slate-400 leading-relaxed mb-6">
              We use cookies to make our website function correctly and to understand how visitors use it. We do not use tracking cookies for advertising or third-party data sharing.
            </p>
            <?php
            $cookie_types = [
              ['type' => 'Essential Cookies',    'color' => '#10b981', 'required' => true,  'desc' => 'Required for the website to function — login sessions, form security (CSRF tokens), and WordPress core functionality. Cannot be disabled.'],
              ['type' => 'Analytics Cookies',    'color' => '#2563eb', 'required' => false, 'desc' => 'Google Analytics cookies help us understand how visitors use our site — which pages are most visited, how long visitors stay, and how they arrived. Data is anonymised. You can opt out via browser settings or the Google Analytics Opt-Out Add-on.'],
              ['type' => 'Performance Cookies',  'color' => '#d6a84f', 'required' => false, 'desc' => 'Used to measure page load times and site performance. Helps us improve the user experience. No personally identifiable information is collected.'],
            ];
            foreach ($cookie_types as $ct) :
              $req_badge = $ct['required']
                ? '<span class="text-[9px] bg-emerald-900/20 border border-emerald-700/25 text-emerald-400 rounded-full px-2 py-0.5 ml-2">Required</span>'
                : '<span class="text-[9px] bg-white/[0.05] border border-white/[0.1] text-slate-500 rounded-full px-2 py-0.5 ml-2">Optional</span>';
            ?>
              <div class="py-4 border-b border-white/[0.05] last:border-0">
                <div class="flex items-center gap-2 mb-2">
                  <span class="w-2 h-2 rounded-full flex-shrink-0"
                    style="background:<?php echo esc_attr($ct['color']); ?>"></span>
                  <span class="text-[12px] font-semibold text-white"><?php echo esc_html($ct['type']); ?></span>
                  <?php echo $req_badge; ?>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed pl-4"><?php echo esc_html($ct['desc']); ?></p>
              </div>
            <?php endforeach; ?>
            <p class="text-[11px] text-slate-600 mt-4">
              For full details, see our <a href="/cookie-policy/" class="text-blue-400 hover:underline">Cookie Policy</a>.
              To manage your preferences, adjust your browser settings or use our cookie consent tool.
            </p>
          </div>
        </section>

        <!-- 8. CLIENT RIGHTS -->
        <section id="pp-rights" aria-labelledby="pp-rights-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">08</span>
            <h2 id="pp-rights-h" class="text-xl font-bold text-white">Your Data Rights</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
            <p class="text-[13px] text-slate-400 leading-relaxed mb-6">
              Regardless of where you are located, we respect your rights over your personal data. Here is how to exercise them.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <?php
              $rights = [
                ['icon' => 'eye',          'color' => '#2563eb', 'right' => 'Right to Access',      'desc' => 'Request a copy of all personal data we hold about you or your business.'],
                ['icon' => 'edit',         'color' => '#10b981', 'right' => 'Right to Correction',  'desc' => 'Ask us to correct any inaccurate or incomplete personal data we hold.'],
                ['icon' => 'trash-2',      'color' => '#ef4444', 'right' => 'Right to Deletion',    'desc' => 'Request deletion of your personal data, subject to any legal retention requirements.'],
                ['icon' => 'mail-x',       'color' => '#d6a84f', 'right' => 'Right to Opt Out',     'desc' => 'Unsubscribe from our newsletter or opt out of non-essential data processing at any time.'],
                ['icon' => 'download',     'color' => '#8b5cf6', 'right' => 'Right to Portability', 'desc' => 'Request your data in a portable, machine-readable format where technically feasible.'],
                ['icon' => 'shield',       'color' => '#06b6d4', 'right' => 'Right to Object',      'desc' => 'Object to how we process your data in certain circumstances, including for marketing.'],
              ];
              foreach ($rights as $r) :
              ?>
                <div class="flex items-start gap-3 bg-white/[0.02] border border-white/[0.05] rounded-xl p-4">
                  <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                             bg-white/[0.04] border border-white/[0.07]">
                    <i data-lucide="<?php echo esc_attr($r['icon']); ?>" class="w-3.5 h-3.5"
                      style="color:<?php echo esc_attr($r['color']); ?>;" aria-hidden="true"></i>
                  </div>
                  <div>
                    <p class="text-[11px] font-semibold text-white mb-1"><?php echo esc_html($r['right']); ?></p>
                    <p class="text-[11px] text-slate-600 leading-relaxed"><?php echo esc_html($r['desc']); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="mt-5 bg-blue-600/[0.07] border border-blue-500/[0.18] rounded-xl p-4">
              <p class="text-[12px] text-blue-300 leading-relaxed">
                To exercise any of these rights, contact us at
                <a href="mailto:<?php echo esc_attr($contact_email); ?>"
                  class="underline hover:no-underline"><?php echo esc_html($contact_email); ?></a>.
                We will respond within 30 days. We may need to verify your identity before processing your request.
              </p>
            </div>
          </div>
        </section>

        <!-- 9. COMPLIANCE -->
        <section id="pp-compliance" aria-labelledby="pp-compliance-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">09</span>
            <h2 id="pp-compliance-h" class="text-xl font-bold text-white">Industry Compliance</h2>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php
            $compliance_items = [
              ['icon' => 'shield-check', 'color' => '#10b981', 'title' => 'FTC Compliance',          'desc' => 'We comply fully with FTC guidelines on endorsements, testimonials, and review practices — including the August 2024 fake review ban.'],
              ['icon' => 'globe',        'color' => '#2563eb', 'title' => 'GDPR-Aligned Practices',  'desc' => 'While a US company, we apply GDPR principles to all EU visitors — lawful basis, data minimisation, and right to erasure.'],
              ['icon' => 'map-pin',      'color' => '#d6a84f', 'title' => 'CCPA Awareness',          'desc' => 'California residents have additional rights under CCPA. We do not sell personal information. Contact us to exercise CCPA rights.'],
              ['icon' => 'check-square', 'color' => '#8b5cf6', 'title' => 'Platform Policy Compliance', 'desc' => 'All ORM activities comply with the individual terms of service of Google, Trustpilot, Yelp, Facebook, and all monitored platforms.'],
            ];
            foreach ($compliance_items as $c) :
            ?>
              <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-3">
                  <i data-lucide="<?php echo esc_attr($c['icon']); ?>" class="w-4 h-4"
                    style="color:<?php echo esc_attr($c['color']); ?>;" aria-hidden="true"></i>
                  <h3 class="text-[12px] font-bold text-white"><?php echo esc_html($c['title']); ?></h3>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($c['desc']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- 10. DATA RETENTION -->
        <section id="pp-retention" aria-labelledby="pp-retention-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">10</span>
            <h2 id="pp-retention-h" class="text-xl font-bold text-white">Data Retention</h2>
          </div>
          <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
            <?php
            $retention_items = [
              ['label' => 'Active client data',       'period' => 'Duration of engagement + 12 months',  'reason' => 'Service delivery and continuity'],
              ['label' => 'Analytics data',           'period' => 'Up to 26 months',                     'reason' => 'Industry standard for analytics platforms'],
              ['label' => 'Communication records',    'period' => '3 years from last contact',           'reason' => 'Legal protection and dispute resolution'],
              ['label' => 'Newsletter subscriber data', 'period' => 'Until unsubscribed + 30 days',       'reason' => 'Consent-based retention only'],
              ['label' => 'Invoice & billing records', 'period' => '7 years',                             'reason' => 'US tax and legal requirements'],
              ['label' => 'Website visitor logs',     'period' => '90 days',                             'reason' => 'Security monitoring and abuse prevention'],
            ];
            foreach ($retention_items as $r) :
            ?>
              <div class="grid grid-cols-3 gap-4 py-3 border-b border-white/[0.05] last:border-0 items-start">
                <span class="text-[11px] font-medium text-white"><?php echo esc_html($r['label']); ?></span>
                <span class="text-[11px] text-blue-400"><?php echo esc_html($r['period']); ?></span>
                <span class="text-[11px] text-slate-600"><?php echo esc_html($r['reason']); ?></span>
              </div>
            <?php endforeach; ?>
            <p class="text-[11px] text-slate-600 mt-4 leading-relaxed">
              After the retention period, data is securely deleted or anonymised. You may request earlier deletion by contacting us at <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="text-blue-400 hover:underline"><?php echo esc_html($contact_email); ?></a>.
            </p>
          </div>
        </section>

        <!-- 11. DISCLAIMER -->
        <section id="pp-disclaimer" aria-labelledby="pp-disclaimer-h">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-[#D6A84F]/15 border border-[#D6A84F]/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-[#D6A84F]">11</span>
            <h2 id="pp-disclaimer-h" class="text-xl font-bold text-white">ORM-Specific Disclaimer</h2>
          </div>
          <div class="bg-[#D6A84F]/[0.06] border border-[#D6A84F]/[0.2] rounded-2xl p-7">
            <p class="text-[13px] text-slate-400 leading-relaxed mb-5">
              As an online reputation management agency, we are required to make the following specific disclosures about the nature of our services and the limits of what we can achieve.
            </p>
            <?php
            $disclaimers = [
              'We do not guarantee specific star ratings, review counts, or platform rankings.',
              'We do not guarantee removal of any specific review — only platform owners can remove content.',
              'We do not guarantee approval of review responses by any platform.',
              'Results from our ORM services vary by industry, platform, business type, and review volume.',
              'We do not guarantee improvements to Google search rankings as a result of our services.',
              'Case studies presented on this website are scenario-based illustrations, not guaranteed outcomes.',
              'Testimonials reflect individual client experiences and are not representative of all results.',
              'All ORM services are subject to the evolving policies of third-party review platforms.',
            ];
            foreach ($disclaimers as $d) :
            ?>
              <div class="flex items-start gap-3 py-2.5 border-b border-[#D6A84F]/[0.1] last:border-0">
                <i data-lucide="info" class="w-3.5 h-3.5 text-[#D6A84F] flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                <span class="text-[12px] text-slate-400 leading-relaxed"><?php echo esc_html($d); ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- 12. FAQ -->
        <section id="pp-faq" aria-labelledby="pp-faq-h"
          x-data="{}">
          <div class="flex items-center gap-3 mb-6">
            <span class="w-6 h-6 rounded-lg bg-blue-600/15 border border-blue-500/25
                      flex items-center justify-center text-[10px] font-bold font-mono text-blue-400">12</span>
            <h2 id="pp-faq-h" class="text-xl font-bold text-white">Privacy FAQ</h2>
          </div>
          <div class="space-y-3">
            <?php
            $faqs = [
              [
                'q' => 'Do you sell my personal data?',
                'a' => 'No. We never sell, rent, or trade your personal data to any third party for any purpose. Your data is used solely to deliver your ORM services and communicate with you about them.'
              ],
              [
                'q' => 'Who can access my client data within your team?',
                'a' => 'Only team members with a legitimate need to access your data to deliver your ORM service can do so. All team members are bound by confidentiality agreements. Access logs are maintained.'
              ],
              [
                'q' => 'Do you use my data to train AI models?',
                'a' => 'No. Your client data is never used to train AI models, shared with AI companies, or processed in ways that would expose it outside our service delivery tools.'
              ],
              [
                'q' => 'Can I request deletion of my data?',
                'a' => 'Yes. Contact us at ' . $contact_email . ' and we will delete your personal data within 30 days, except where we are legally required to retain it (e.g. billing records for 7 years).'
              ],
              [
                'q' => 'Do you transfer data outside the US?',
                'a' => 'Our primary operations are based in the US. We use third-party tools (such as Google Analytics) that may process data internationally. All such tools comply with applicable data transfer regulations.'
              ],
              [
                'q' => 'How do you protect client review strategy data?',
                'a' => 'Your ORM strategy, report data, and platform performance information are treated as strictly confidential. They are stored on secured, access-controlled systems and never shared with third parties without your explicit consent.'
              ],
              [
                'q' => 'What happens to my data if I cancel my ORM service?',
                'a' => 'We will retain your data for 12 months after your engagement ends in case you return, then securely delete it unless legal retention requirements apply. You may request immediate deletion.'
              ],
              [
                'q' => 'How do you handle data from review platforms?',
                'a' => 'We only collect publicly visible review data from platforms (review text, rating, date, reviewer name) as part of your monitoring service. We do not access any private reviewer data or attempt to identify anonymous reviewers.'
              ],
            ];
            foreach ($faqs as $i => $faq) :
            ?>
              <div class="border border-white/[0.07] rounded-xl overflow-hidden bg-white/[0.02]
                     transition-all duration-250"
                x-data="{ open: <?php echo $i === 0 ? 'true' : 'false'; ?> }"
                :class="open ? 'border-blue-500/30 bg-blue-600/[0.04]' : ''">
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
                  <p class="text-[12px] text-slate-500 leading-relaxed px-5 pb-4 pl-10">
                    <?php echo esc_html($faq['a']); ?>
                  </p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </section>

      </div><!-- /max-w content -->
    </div><!-- /bg wrapper -->

    <!-- ════════════════════════════════════
     FINAL CTA
════════════════════════════════════ -->
    <section class="relative bg-[#020817] py-20 border-t border-white/[0.05] overflow-hidden"
      aria-label="Contact about privacy">
      <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[600px] h-[400px]
                bg-blue-600/[0.09] blur-[120px] rounded-full pointer-events-none"></div>
      <div class="relative z-10 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <i data-lucide="mail" class="w-10 h-10 text-blue-400 mx-auto mb-5" aria-hidden="true"></i>
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
          Questions About Your Privacy?
        </h2>
        <p class="text-sm text-slate-500 leading-relaxed mb-6">
          If you have any questions about this policy, want to exercise your data rights, or simply want to understand how we handle your information — we're here to help.
        </p>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>"
          class="inline-flex items-center gap-2
                   bg-blue-600 hover:bg-blue-700
                   text-white font-semibold text-sm
                   px-7 py-3.5 rounded-xl
                   transition-all duration-200 hover:-translate-y-0.5">
          <i data-lucide="mail" class="w-4 h-4" aria-hidden="true"></i>
          <?php echo esc_html($contact_email); ?>
        </a>
        <p class="text-[11px] text-slate-700 mt-5">
          <?php echo esc_html($company); ?> · <?php echo esc_html($address); ?><br>
          Effective: <?php echo esc_html($effective_date); ?> · Last updated: <?php echo esc_html($last_updated); ?>
        </p>
      </div>
    </section>

  </main>
  <?php get_footer(); ?>
  <?php
  /*
 * TEMPLATE   : Privacy Policy
 * FILE       : page-templates/privacy-policy.php
 *              (or assign via page.php with a custom template)
 * URL        : /privacy-policy/
 * SECTIONS   : Hero, TOC, Introduction, Collect, Use, Security,
 *              Third-Party, AI, Cookies, Rights, Compliance,
 *              Retention, Disclaimer, FAQ, CTA
 * REQUIRES   : Alpine.js (FAQ accordion)
 *              Lucide icons
 * LEGAL NOTE : This is a starting template. Review with a qualified
 *              attorney before publishing for legal compliance.
 * EDITABLE   : $effective_date, $contact_email, $address above
 * LINKED FROM: footer.php, cookie-policy.php, trust-center.php
 */
  ?>