<?php

/**
 * Template Name: Terms of Service
 * Description: Premium Terms of Service page for ReviewService.Pro
 */
if (! defined('ABSPATH')) exit;
get_header();

$effective_date = 'January 1, 2025';
$last_updated   = date('F j, Y');
$company        = 'ReviewService.Pro';
$address        = '30 N Gould St Ste N, Sheridan, WY 82801';
$governing_law  = 'Wyoming, United States';
$contact_email  = get_theme_mod('cta_email', 'legal@reviewservice.pro');

$nav_sections = [
  'tos-intro'       => 'Introduction',
  'tos-scope'       => 'Service Scope',
  'tos-ethical'     => 'Ethical Policy',
  'tos-client'      => 'Client Duties',
  'tos-payment'     => 'Payment Terms',
  'tos-cancel'      => 'Cancellation',
  'tos-refund'      => 'Refund Policy',
  'tos-guarantees'  => 'No Guarantees',
  'tos-ip'          => 'Intellectual Property',
  'tos-confidential' => 'Confidentiality',
  'tos-ai'          => 'AI & Automation',
  'tos-third-party' => 'Third Parties',
  'tos-liability'   => 'Liability',
  'tos-indemnity'   => 'Indemnification',
  'tos-law'         => 'Governing Law',
  'tos-faq'         => 'FAQ',
];
?>

<div id="main-content" class="legal-page terms-of-service-page bg-white text-[#334155]">

  <!-- ── STICKY SIDE NAV ── -->
  <nav class="hidden xl:flex fixed left-6 top-1/2 -translate-y-1/2 z-50 flex-col gap-2"
    aria-label="Terms of service navigation">
    <?php foreach ($nav_sections as $id => $label) : ?>
      <a href="#<?php echo esc_attr($id); ?>"
        class="group flex items-center gap-2" aria-label="<?php echo esc_attr($label); ?>">
        <span class="w-1.5 h-1.5 rounded-full bg-white/15
                      group-hover:bg-blue-400 transition-colors duration-200"></span>
        <span class="text-[10px] text-slate-700 group-hover:text-slate-500
                      transition-colors duration-200 whitespace-nowrap">
          <?php echo esc_html($label); ?>
        </span>
      </a>
    <?php endforeach; ?>
  </nav>

  <!-- ════════════════════════
     HERO
════════════════════════ -->
  <section class="relative bg-[#020817] overflow-hidden pt-28 pb-20 md:pt-36 md:pb-24">
    <div class="absolute inset-0 pointer-events-none z-0"
      style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-44 pointer-events-none z-0"
      style="background:linear-gradient(to bottom,rgba(37,99,235,0.5),transparent)"></div>
    <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[700px] h-[400px]
                bg-blue-600/[0.12] blur-[130px] rounded-full pointer-events-none z-0"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

      <span class="inline-flex items-center gap-2 bg-blue-600/10 border border-blue-500/30
                      text-blue-400 text-[11px] font-semibold tracking-[0.1em] uppercase
                      px-4 py-1.5 rounded-full mb-5">
        <i data-lucide="file-text" class="w-3.5 h-3.5" aria-hidden="true"></i>
        Terms of Service
      </span>

      <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white
                    leading-[1.08] mb-5">
        Clear Terms.<br>
        <span class="bg-gradient-to-r from-blue-400 via-blue-300 to-blue-400
                          bg-clip-text text-transparent">
          No Surprises.
        </span>
      </h1>

      <p class="text-sm md:text-base text-slate-500 leading-relaxed max-w-xl mx-auto mb-8">
        We believe in full transparency about how we work, what we deliver, and what we cannot control. These terms are written in plain language so both parties understand exactly what the engagement involves.
      </p>

      <div class="flex flex-wrap justify-center gap-3 mb-8">
        <?php
        $badges = [
          ['icon' => 'shield-check', 'text' => 'Ethical ORM Only',     'c' => 'emerald'],
          ['icon' => 'eye',          'text' => 'Fully Transparent',     'c' => 'blue'],
          ['icon' => 'check-circle', 'text' => 'No Fake Reviews',       'c' => 'emerald'],
          ['icon' => 'lock',         'text' => 'Wyoming Law Governed',  'c' => 'blue'],
        ];
        foreach ($badges as $b) :
          $cls = $b['c'] === 'emerald'
            ? 'bg-emerald-900/20 border-emerald-700/25 text-emerald-300'
            : 'bg-blue-600/10 border-blue-500/25 text-blue-400';
        ?>
          <span class="inline-flex items-center gap-2 text-[11px] font-medium border rounded-full
                          px-4 py-1.5 <?php echo esc_attr($cls); ?>">
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
        <span>Governed by <?php echo esc_html($governing_law); ?></span>
      </div>

    </div>
  </section>

  <!-- TABLE OF CONTENTS -->
  <div class="bg-[#07111F] border-t border-white/[0.05] py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <p class="text-[10px] font-bold uppercase tracking-[0.1em] text-slate-600 mb-4">Quick Navigation</p>
      <div class="flex flex-wrap gap-2">
        <?php foreach ($nav_sections as $id => $label) : ?>
          <a href="#<?php echo esc_attr($id); ?>"
            class="text-[11px] text-slate-600 hover:text-slate-400
                       bg-white/[0.03] border border-white/[0.07]
                       hover:border-white/[0.15] rounded-lg px-3 py-1.5
                       transition-all duration-200">
            <?php echo esc_html($label); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- ════════════════════════
     CONTENT
════════════════════════ -->
  <div class="bg-[#07111F]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">

      <?php
      /* Helper: section header */
      function tos_header($num, $id, $title, $color = 'blue')
      {
        $num_cls = $color === 'gold'
          ? 'bg-[#D6A84F]/15 border-[#D6A84F]/25 text-[#D6A84F]'
          : 'bg-blue-600/15 border-blue-500/25 text-blue-400';
        echo '<div class="flex items-center gap-3 mb-6">
        <span class="w-6 h-6 rounded-lg border flex items-center justify-center
                      text-[10px] font-bold font-mono ' . esc_attr($num_cls) . '">'
          . esc_html($num) . '</span>
        <h2 id="' . esc_attr($id) . '" class="text-xl font-bold text-white">'
          . esc_html($title) . '</h2>
    </div>';
      }
      ?>

      <!-- 1. INTRODUCTION -->
      <section aria-labelledby="tos-intro">
        <?php tos_header('01', 'tos-intro', 'Introduction'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7 space-y-4">
          <p class="text-[13px] text-slate-400 leading-relaxed">
            These Terms of Service ("Terms") govern the relationship between <?php echo esc_html($company); ?> ("we", "us", "our", "Agency") and any individual or business ("Client", "you") that engages our online reputation management services, accesses our website, or signs a service agreement with us.
          </p>
          <p class="text-[13px] text-slate-400 leading-relaxed">
            By engaging our services or using this website, you agree to these Terms in full. If you disagree with any part, please do not use our services. These Terms are designed to be fair, clear, and mutually protective — not one-sided.
          </p>
          <div class="bg-blue-600/[0.07] border border-blue-500/[0.18] rounded-xl p-4">
            <p class="text-[12px] text-blue-300 leading-relaxed">
              <strong>Plain language commitment:</strong> We have written these Terms to be understood by business owners — not just lawyers. If any section is unclear, contact us at <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="underline hover:no-underline"><?php echo esc_html($contact_email); ?></a> before engaging our services.
            </p>
          </div>
        </div>
      </section>

      <!-- 2. SERVICE SCOPE -->
      <section aria-labelledby="tos-scope">
        <?php tos_header('02', 'tos-scope', 'Service Scope'); ?>

        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7 mb-5">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-6">
            <?php echo esc_html($company); ?> provides ethical online reputation management services. The specific services delivered to each Client are defined in the individual service agreement or proposal. Our general service categories include:
          </p>
          <?php
          $services = [
            ['icon' => 'search',        'color' => '#2563eb', 'svc' => 'Reputation Audit & Intelligence',   'desc' => 'Analysis of your current online reputation including review scores, sentiment, platform coverage, and competitor benchmarking.'],
            ['icon' => 'eye',           'color' => '#10b981', 'svc' => 'Review Monitoring',                 'desc' => 'Real-time monitoring of reviews across agreed platforms with alert notifications and log reporting.'],
            ['icon' => 'message-square', 'color' => '#d6a84f', 'svc' => 'Review Response Assistance',       'desc' => 'Drafting and (where authorised) publishing professional, brand-aligned responses to reviews on agreed platforms.'],
            ['icon' => 'users',         'color' => '#8b5cf6', 'svc' => 'Customer Feedback Systems',        'desc' => 'Design and implementation of compliant post-service feedback flows to ethically collect genuine customer reviews.'],
            ['icon' => 'map-pin',       'color' => '#06b6d4', 'svc' => 'Local Trust & Visibility',         'desc' => 'Google Business Profile optimisation and local reputation signal strategies using platform-approved methods.'],
            ['icon' => 'bar-chart-2',   'color' => '#f97316', 'svc' => 'Reporting & Consultation',         'desc' => 'Monthly reputation intelligence reports and scheduled strategy consultation sessions with your ORM specialist.'],
          ];
          foreach ($services as $s) :
          ?>
            <div class="flex items-start gap-4 py-3.5 border-b border-white/[0.05] last:border-0">
              <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0
                         bg-white/[0.04] border border-white/[0.07]">
                <i data-lucide="<?php echo esc_attr($s['icon']); ?>" class="w-4 h-4"
                  style="color:<?php echo esc_attr($s['color']); ?>;" aria-hidden="true"></i>
              </div>
              <div>
                <p class="text-[12px] font-semibold text-white mb-1"><?php echo esc_html($s['svc']); ?></p>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($s['desc']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="bg-[#D6A84F]/[0.06] border border-[#D6A84F]/[0.2] rounded-2xl p-6">
          <p class="text-[11px] font-bold uppercase tracking-widest text-[#D6A84F] mb-3">
            What Our Services Do Not Include
          </p>
          <?php
          $not_included = [
            'Guaranteed removal of any specific review or content',
            'Guaranteed improvement to any specific star rating',
            'Guaranteed review volume, count, or frequency',
            'Guaranteed Google search ranking improvements',
            'Legal action against platforms or reviewers',
            'Management of any platform account not covered by your agreement',
          ];
          foreach ($not_included as $ni) : ?>
            <div class="flex items-start gap-2 py-1.5 border-b border-[#D6A84F]/[0.08] last:border-0">
              <i data-lucide="minus" class="w-3.5 h-3.5 text-[#D6A84F]/60 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <span class="text-[12px] text-slate-500"><?php echo esc_html($ni); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 3. ETHICAL ORM POLICY -->
      <section aria-labelledby="tos-ethical">
        <?php tos_header('03', 'tos-ethical', 'Ethical ORM Policy'); ?>
        <div class="bg-emerald-900/[0.08] border border-emerald-700/[0.2] rounded-2xl p-7">
          <p class="text-[13px] text-emerald-300/80 leading-relaxed mb-6">
            Our ethical policy is a core term of every service agreement. By engaging <?php echo esc_html($company); ?>, the Client acknowledges and agrees to all of the following.
          </p>
          <?php
          $ethical_items = [
            [
              'icon' => 'shield-check',
              'title' => 'No Fake Reviews — Ever',
              'desc' => 'We will never generate, purchase, distribute, or facilitate fake reviews under any circumstances. This is a non-negotiable operating principle and a legal requirement under FTC guidelines (2024 rule).'
            ],
            [
              'icon' => 'check-circle',
              'title' => 'Platform-Compliant Methods Only',
              'desc' => 'Every tactic we use complies with the terms of service of Google, Trustpilot, Yelp, Facebook, Tripadvisor, BBB, Glassdoor, and all other platforms we work with on your behalf.'
            ],
            [
              'icon' => 'users',
              'title' => 'Genuine Customer Feedback Only',
              'desc' => 'Our feedback collection systems are designed exclusively for genuine post-service customer outreach. We do not use incentivisation, review gating, or any method that violates platform guidelines.'
            ],
            [
              'icon' => 'x-circle',
              'title' => 'Immediate Termination for Unethical Requests',
              'desc' => 'If a Client requests actions that violate our ethical policy or platform terms of service, we will decline the request and may terminate the engagement without refund of services already delivered.'
            ],
          ];
          foreach ($ethical_items as $e) :
          ?>
            <div class="flex items-start gap-4 py-4 border-b border-emerald-700/[0.12] last:border-0">
              <i data-lucide="<?php echo esc_attr($e['icon']); ?>"
                class="w-4 h-4 text-emerald-400 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <div>
                <p class="text-[12px] font-bold text-emerald-300 mb-1.5"><?php echo esc_html($e['title']); ?></p>
                <p class="text-[11px] text-emerald-300/60 leading-relaxed"><?php echo esc_html($e['desc']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 4. CLIENT RESPONSIBILITIES -->
      <section aria-labelledby="tos-client">
        <?php tos_header('04', 'tos-client', 'Client Responsibilities'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-6">
            Effective reputation management depends on cooperation from both parties. By engaging our services, the Client agrees to the following responsibilities.
          </p>
          <?php
          $client_resp = [
            ['num' => '1', 'title' => 'Accurate Information',      'desc' => 'Provide accurate, current, and complete information about your business, platforms, and any existing reputation issues before and during the engagement.'],
            ['num' => '2', 'title' => 'Platform Access',           'desc' => 'Grant us necessary access to your review platform profiles, Google Business Profile, and any other platforms covered by your agreement. Access must be legitimate and authorised.'],
            ['num' => '3', 'title' => 'Genuine Service Quality',   'desc' => 'ORM is most effective when it reflects real business quality. The Client is responsible for maintaining the standard of products, services, and customer experience that supports reputation growth.'],
            ['num' => '4', 'title' => 'Timely Communication',      'desc' => 'Respond to our strategy queries, review approval requests, and monthly reports in a timely manner. Delays caused by the Client do not extend service timelines.'],
            ['num' => '5', 'title' => 'No Unethical Requests',     'desc' => 'The Client must not request fake reviews, manipulation of any platform, removal of genuine customer reviews, or any tactic that violates our ethical policy or applicable law.'],
            ['num' => '6', 'title' => 'Platform Compliance',       'desc' => 'The Client is responsible for maintaining their own compliance with platform terms of service. We advise on compliance but cannot be held responsible for Client-initiated policy violations.'],
          ];
          foreach ($client_resp as $r) :
          ?>
            <div class="flex items-start gap-4 py-3.5 border-b border-white/[0.05] last:border-0">
              <span class="w-6 h-6 rounded-lg bg-blue-600/10 border border-blue-500/20
                          flex items-center justify-center text-[10px] font-bold font-mono
                          text-blue-400 flex-shrink-0">
                <?php echo esc_html($r['num']); ?>
              </span>
              <div>
                <p class="text-[12px] font-semibold text-white mb-1"><?php echo esc_html($r['title']); ?></p>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($r['desc']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 5. PAYMENT TERMS -->
      <section aria-labelledby="tos-payment">
        <?php tos_header('05', 'tos-payment', 'Payment Terms'); ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
          <?php
          $payment_items = [
            ['icon' => 'file-text',  'color' => '#2563eb', 'title' => 'Invoice Structure',    'desc' => 'Invoices are issued at the start of each service period (monthly or as agreed). All fees are stated in USD unless otherwise agreed in writing.'],
            ['icon' => 'calendar',   'color' => '#10b981', 'title' => 'Payment Due Date',     'desc' => 'Payment is due within 14 days of invoice issue date unless a different payment schedule has been agreed in your service proposal.'],
            ['icon' => 'alert-circle', 'color' => '#f97316', 'title' => 'Late Payment',         'desc' => 'Invoices unpaid after 30 days may incur a late fee of 1.5% per month. We reserve the right to pause services on accounts more than 30 days overdue.'],
            ['icon' => 'percent',    'color' => '#8b5cf6', 'title' => 'Taxes & Fees',         'desc' => 'All fees are exclusive of applicable taxes. Clients are responsible for any sales tax, VAT, or similar taxes applicable in their jurisdiction.'],
          ];
          foreach ($payment_items as $p) :
          ?>
            <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-5">
              <div class="flex items-center gap-3 mb-3">
                <i data-lucide="<?php echo esc_attr($p['icon']); ?>" class="w-4 h-4"
                  style="color:<?php echo esc_attr($p['color']); ?>;" aria-hidden="true"></i>
                <h3 class="text-[12px] font-bold text-white"><?php echo esc_html($p['title']); ?></h3>
              </div>
              <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($p['desc']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="bg-[#D6A84F]/[0.06] border border-[#D6A84F]/[0.2] rounded-xl p-5">
          <p class="text-[12px] text-[#D6A84F] leading-relaxed">
            <strong>Non-refundable services:</strong> Strategy consultations, reputation audits, and completed monthly service periods are non-refundable once delivered, as the value is in the time, expertise, and work product already provided.
          </p>
        </div>
      </section>

      <!-- 6. CANCELLATION & TERMINATION -->
      <section aria-labelledby="tos-cancel">
        <?php tos_header('06', 'tos-cancel', 'Cancellation & Termination'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7 space-y-5">
          <div>
            <h3 class="text-[13px] font-bold text-white mb-3">Client-Initiated Cancellation</h3>
            <p class="text-[12px] text-slate-500 leading-relaxed">
              Clients may cancel ongoing services with 30 days written notice to <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="text-blue-400 hover:underline"><?php echo esc_html($contact_email); ?></a>. The current service period will continue and no new billing cycle will be initiated after the notice period expires. Services already invoiced and in progress are non-refundable.
            </p>
          </div>
          <div class="border-t border-white/[0.06] pt-5">
            <h3 class="text-[13px] font-bold text-white mb-3">Agency-Initiated Termination</h3>
            <p class="text-[12px] text-slate-500 leading-relaxed mb-3">
              We reserve the right to terminate the engagement immediately, without refund of services delivered, if the Client:
            </p>
            <?php
            $termination_grounds = [
              'Requests fake reviews, review manipulation, or any unethical ORM tactic',
              'Provides materially false information about their business or platform status',
              'Fails to make payment within 30 days of the due date after written notice',
              'Uses our services to harass, defame, or harm individuals or competitors',
              'Breaches any material term of these Terms of Service',
            ];
            foreach ($termination_grounds as $tg) : ?>
              <div class="flex items-start gap-2.5 py-2 border-b border-white/[0.04] last:border-0">
                <i data-lucide="x-circle" class="w-3.5 h-3.5 text-red-400/70 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                <span class="text-[12px] text-slate-500"><?php echo esc_html($tg); ?></span>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="border-t border-white/[0.06] pt-5">
            <h3 class="text-[13px] font-bold text-white mb-2">Upon Termination</h3>
            <p class="text-[12px] text-slate-500 leading-relaxed">
              Upon termination, we will provide a final report of completed work. Platform access granted to us will be revoked. Client data will be retained for 12 months then securely deleted per our Privacy Policy. Outstanding invoices remain payable.
            </p>
          </div>
        </div>
      </section>

      <!-- 7. REFUND POLICY -->
      <section aria-labelledby="tos-refund">
        <?php tos_header('07', 'tos-refund', 'Refund Policy'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-5">
            Our services are primarily time-based strategic work. The value is delivered through research, expertise, monitoring, and ongoing management — not a physical product that can be returned.
          </p>
          <?php
          $refund_items = [
            [
              'status' => 'Non-refundable',
              'color' => '#ef4444',
              'items' => [
                'Completed reputation audits and intelligence reports',
                'Monthly ORM management fees once the service period has begun',
                'Consultation sessions already delivered',
                'Onboarding fees and setup work',
              ]
            ],
            [
              'status' => 'Potentially refundable',
              'color' => '#10b981',
              'items' => [
                'Pre-paid future service periods not yet commenced, minus any setup work',
                'Services not started due to Agency error or failure to begin',
                'Duplicate or erroneous charges — corrected within 30 days of notification',
              ]
            ],
          ];
          foreach ($refund_items as $ri) : ?>
            <div class="mb-5 last:mb-0">
              <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full" style="background:<?php echo esc_attr($ri['color']); ?>"></span>
                <span class="text-[11px] font-bold uppercase tracking-wider"
                  style="color:<?php echo esc_attr($ri['color']); ?>">
                  <?php echo esc_html($ri['status']); ?>
                </span>
              </div>
              <?php foreach ($ri['items'] as $item) : ?>
                <div class="flex items-start gap-2.5 py-2 border-b border-white/[0.04] last:border-0 pl-4">
                  <i data-lucide="dot" class="w-3 h-3 text-slate-700 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                  <span class="text-[12px] text-slate-500"><?php echo esc_html($item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
          <div class="mt-5 bg-blue-600/[0.07] border border-blue-500/[0.18] rounded-xl p-4">
            <p class="text-[12px] text-blue-300 leading-relaxed">
              All refund requests must be submitted in writing to <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="underline hover:no-underline"><?php echo esc_html($contact_email); ?></a> within 14 days of the disputed charge. We will review and respond within 10 business days.
            </p>
          </div>
        </div>
      </section>

      <!-- 8. NO GUARANTEES DISCLAIMER -->
      <section aria-labelledby="tos-guarantees">
        <?php tos_header('08', 'tos-guarantees', 'No Guarantees — Important Disclaimer', 'gold'); ?>
        <div class="bg-[#D6A84F]/[0.06] border border-[#D6A84F]/[0.22] rounded-2xl p-7">
          <p class="text-[13px] text-[#D6A84F]/80 leading-relaxed mb-6">
            This section is critically important. ORM is a complex, multi-variable service affected by factors outside our control — including platform algorithm changes, customer behaviour, competitor activity, and the Client's own service quality. We are legally required to make the following disclosures, and we make them willingly because we believe in honesty.
          </p>
          <?php
          $no_guarantees = [
            'We do not guarantee any specific star rating on any platform at any time.',
            'We do not guarantee the removal of any specific review — only platform owners can remove content.',
            'We do not guarantee any specific number, volume, or frequency of new reviews.',
            'We do not guarantee improvement to Google local search rankings.',
            'We do not guarantee that any feedback request will result in a review being left.',
            'We do not guarantee platform approval of any review response we submit on your behalf.',
            'We do not guarantee that any platform will not change its policies in ways that affect our services.',
            'Results from our ORM services vary by industry, platform, business type, review history, and market conditions.',
            'Any statistics, case studies, or examples shown on our website illustrate possible outcomes — not guaranteed results.',
          ];
          foreach ($no_guarantees as $ng) : ?>
            <div class="flex items-start gap-3 py-2.5 border-b border-[#D6A84F]/[0.1] last:border-0">
              <i data-lucide="info" class="w-3.5 h-3.5 text-[#D6A84F]/60 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <span class="text-[12px] text-slate-400 leading-relaxed"><?php echo esc_html($ng); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 9. INTELLECTUAL PROPERTY -->
      <section aria-labelledby="tos-ip">
        <?php tos_header('09', 'tos-ip', 'Intellectual Property'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7 space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php
            $ip_items = [
              [
                'icon' => 'file-text',
                'color' => '#2563eb',
                'title' => 'Reports & Deliverables',
                'desc' => 'Monthly reports, audits, and strategy documents delivered to the Client are licensed for the Client\'s business use. The underlying methodologies, templates, and frameworks remain the property of ' . $company . '.'
              ],
              [
                'icon' => 'layout',
                'color' => '#10b981',
                'title' => 'Agency Materials',
                'desc' => 'Our website content, brand assets, ORM frameworks, and proprietary systems are the exclusive intellectual property of ' . $company . ' and may not be reproduced without written consent.'
              ],
              [
                'icon' => 'message-square',
                'color' => '#d6a84f',
                'title' => 'Response Templates',
                'desc' => 'Review response drafts created for the Client are for their exclusive business use. The generic response frameworks from which they are created remain Agency IP.'
              ],
              [
                'icon' => 'shield',
                'color' => '#8b5cf6',
                'title' => 'Client Brand Assets',
                'desc' => 'Any brand assets, logos, or materials provided by the Client remain the Client\'s property. We use them solely to deliver your ORM services and will not use them for any other purpose.'
              ],
            ];
            foreach ($ip_items as $ip) :
            ?>
              <div class="bg-white/[0.02] border border-white/[0.05] rounded-xl p-5">
                <div class="flex items-center gap-3 mb-3">
                  <i data-lucide="<?php echo esc_attr($ip['icon']); ?>" class="w-4 h-4"
                    style="color:<?php echo esc_attr($ip['color']); ?>;" aria-hidden="true"></i>
                  <h3 class="text-[12px] font-bold text-white"><?php echo esc_html($ip['title']); ?></h3>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($ip['desc']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- 10. CONFIDENTIALITY -->
      <section aria-labelledby="tos-confidential">
        <?php tos_header('10', 'tos-confidential', 'Confidentiality'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-5">
            Both parties agree to maintain the confidentiality of information disclosed during the engagement that is identified as confidential or that a reasonable person would recognise as confidential.
          </p>
          <?php
          $conf_items = [
            ['icon' => 'lock',     'title' => 'Client Business Data',   'desc' => 'Your business strategy, revenue information, customer data, and platform performance metrics are treated as strictly confidential.'],
            ['icon' => 'shield',   'title' => 'ORM Strategy Details',   'desc' => 'The specific reputation strategies we develop for you are confidential. We will not share your strategy with competitors.'],
            ['icon' => 'eye-off',  'title' => 'Mutual Obligation',       'desc' => 'The Client agrees not to disclose our proprietary frameworks, pricing structures, or internal methodologies to third parties.'],
            ['icon' => 'check',    'title' => 'Duration',               'desc' => 'Confidentiality obligations survive the termination of this agreement for a period of 2 years from the date of last disclosure.'],
          ];
          foreach ($conf_items as $c) :
          ?>
            <div class="flex items-start gap-4 py-3.5 border-b border-white/[0.05] last:border-0">
              <i data-lucide="<?php echo esc_attr($c['icon']); ?>" class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <div>
                <p class="text-[12px] font-semibold text-white mb-1"><?php echo esc_html($c['title']); ?></p>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($c['desc']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 11. AI & AUTOMATION -->
      <section aria-labelledby="tos-ai">
        <?php tos_header('11', 'tos-ai', 'AI & Automation Use'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-5">
            We use AI as a productivity and quality tool. The Client acknowledges and agrees to our AI usage policy as follows.
          </p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-emerald-900/[0.08] border border-emerald-700/[0.18] rounded-xl p-5">
              <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-500 mb-3">Permitted AI Use</p>
              <?php
              $ai_permitted = [
                'Drafting review responses (human-reviewed before publication)',
                'Sentiment analysis and pattern identification',
                'Report drafting assistance (data verified by our team)',
                'Strategy ideation and content gap analysis',
              ];
              foreach ($ai_permitted as $item) : ?>
                <div class="flex items-start gap-2 py-1.5 border-b border-emerald-700/[0.1] last:border-0">
                  <i data-lucide="check-circle" class="w-3 h-3 text-emerald-400 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
                  <span class="text-[11px] text-emerald-300/80"><?php echo esc_html($item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="bg-red-900/[0.06] border border-red-700/[0.15] rounded-xl p-5">
              <p class="text-[10px] font-bold uppercase tracking-widest text-red-400 mb-3">AI Never Used For</p>
              <?php
              $ai_never = [
                'Generating fake reviews (FTC-banned, August 2024)',
                'Automated review submission without human sign-off',
                'Processing client data for AI training',
                'Any output published without human editorial review',
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

      <!-- 12. THIRD-PARTY PLATFORMS -->
      <section aria-labelledby="tos-third-party">
        <?php tos_header('12', 'tos-third-party', 'Third-Party Platforms'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-5">
            Our ORM services operate across third-party platforms that we do not own or control. The Client acknowledges the following.
          </p>
          <?php
          $third_party = [
            'Review platforms (Google, Trustpilot, Yelp, Facebook, etc.) make all final decisions about review publication, removal, and account status.',
            'Platform policies may change without notice, potentially affecting the tactics available to us.',
            'We are not responsible for any platform decision to remove reviews, suspend profiles, or change algorithmic ranking factors.',
            'The Client is responsible for maintaining their own platform accounts in good standing.',
            'Access to platform features may be limited, modified, or discontinued by the platform at any time.',
            'Our services comply with each platform\'s current terms of service. Changes to platform policies may require strategy adjustments.',
          ];
          foreach ($third_party as $tp) : ?>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.05] last:border-0">
              <i data-lucide="info" class="w-3.5 h-3.5 text-blue-400/60 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <span class="text-[12px] text-slate-500 leading-relaxed"><?php echo esc_html($tp); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 13. LIMITATION OF LIABILITY -->
      <section aria-labelledby="tos-liability">
        <?php tos_header('13', 'tos-liability', 'Limitation of Liability', 'gold'); ?>
        <div class="bg-[#D6A84F]/[0.06] border border-[#D6A84F]/[0.22] rounded-2xl p-7">
          <p class="text-[13px] text-[#D6A84F]/80 leading-relaxed mb-5">
            To the maximum extent permitted by applicable law, <?php echo esc_html($company); ?>'s total liability to the Client for any claim arising from or related to these Terms or our services shall not exceed the total fees paid by the Client in the three months preceding the claim.
          </p>
          <p class="text-[13px] text-slate-400 leading-relaxed mb-5">
            In no event shall <?php echo esc_html($company); ?> be liable for any of the following:
          </p>
          <?php
          $liab_items = [
            'Indirect, incidental, consequential, or punitive damages of any kind',
            'Loss of revenue, profits, or business opportunities allegedly caused by our services',
            'Platform decisions to remove reviews, suspend accounts, or change ranking algorithms',
            'Damage arising from changes to third-party platform policies',
            'Actions taken by the Client that violate platform terms of service',
            'Any outcomes attributable to factors outside our direct control',
          ];
          foreach ($liab_items as $li) : ?>
            <div class="flex items-start gap-3 py-2.5 border-b border-[#D6A84F]/[0.1] last:border-0">
              <i data-lucide="minus" class="w-3.5 h-3.5 text-[#D6A84F]/50 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <span class="text-[12px] text-slate-400 leading-relaxed"><?php echo esc_html($li); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 14. INDEMNIFICATION -->
      <section aria-labelledby="tos-indemnity">
        <?php tos_header('14', 'tos-indemnity', 'Indemnification'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7">
          <p class="text-[13px] text-slate-400 leading-relaxed mb-4">
            The Client agrees to indemnify, defend, and hold harmless <?php echo esc_html($company); ?>, its team members, and affiliates from and against any claims, damages, costs, and expenses (including reasonable legal fees) arising from:
          </p>
          <?php
          $indemnity_items = [
            'The Client\'s breach of these Terms of Service',
            'The Client\'s violation of any applicable law or platform terms of service',
            'Any request by the Client for unethical ORM tactics that the Agency refused',
            'Content or information provided by the Client that is inaccurate, misleading, or unlawful',
            'Any claim by a third party arising from the Client\'s business operations',
          ];
          foreach ($indemnity_items as $ii) : ?>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.05] last:border-0">
              <i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-[#D6A84F]/60 flex-shrink-0 mt-0.5" aria-hidden="true"></i>
              <span class="text-[12px] text-slate-500 leading-relaxed"><?php echo esc_html($ii); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- 15. GOVERNING LAW -->
      <section aria-labelledby="tos-law">
        <?php tos_header('15', 'tos-law', 'Compliance & Governing Law'); ?>
        <div class="bg-white/[0.025] border border-white/[0.07] rounded-2xl p-7 space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php
            $law_items = [
              ['icon' => 'map-pin',  'color' => '#2563eb', 'title' => 'Governing Law',      'desc' => 'These Terms are governed by the laws of Wyoming, United States, without regard to conflict of law principles.'],
              ['icon' => 'briefcase', 'color' => '#10b981', 'title' => 'Dispute Resolution',  'desc' => 'Any disputes shall first be attempted to be resolved through good-faith negotiation. If unresolved, binding arbitration in Wyoming shall apply.'],
              ['icon' => 'globe',   'color' => '#d6a84f', 'title' => 'FTC Compliance',      'desc' => 'All services comply with US FTC guidelines on endorsements, reviews, and testimonials including the August 2024 fake review rule.'],
            ];
            foreach ($law_items as $l) :
            ?>
              <div class="bg-white/[0.02] border border-white/[0.05] rounded-xl p-5">
                <div class="flex items-center gap-2 mb-2">
                  <i data-lucide="<?php echo esc_attr($l['icon']); ?>" class="w-4 h-4"
                    style="color:<?php echo esc_attr($l['color']); ?>;" aria-hidden="true"></i>
                  <h3 class="text-[11px] font-bold text-white"><?php echo esc_html($l['title']); ?></h3>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo esc_html($l['desc']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="bg-blue-600/[0.07] border border-blue-500/[0.18] rounded-xl p-4">
            <p class="text-[12px] text-blue-300 leading-relaxed">
              <strong>Policy Updates:</strong> We may update these Terms from time to time. Material changes will be communicated by email with 30 days notice. Continued use of our services after the effective date constitutes acceptance of the updated Terms.
            </p>
          </div>
        </div>
      </section>

      <!-- 16. FAQ -->
      <section aria-labelledby="tos-faq" x-data="{}">
        <?php tos_header('16', 'tos-faq', 'Frequently Asked Questions'); ?>
        <div class="space-y-3">
          <?php
          $faqs = [
            [
              'q' => 'Is there a minimum contract length?',
              'a' => 'This depends on your service agreement. Most of our ongoing management services operate on a monthly rolling basis with 30 days cancellation notice. One-off services such as reputation audits are single engagements with no ongoing commitment.'
            ],
            [
              'q' => 'What happens if I request a fake review?',
              'a' => 'We will decline the request, explain why it violates our ethical policy and platform terms, and offer an ethical alternative. If a Client repeatedly insists on unethical tactics, we will terminate the engagement without refund of services already delivered.'
            ],
            [
              'q' => 'Can you guarantee my Google rating will improve?',
              'a' => 'No. No ethical ORM agency can guarantee specific star ratings. We implement strategies designed to improve your rating over time — but ratings are ultimately determined by your customers\' genuine experiences and their decision to leave a review.'
            ],
            [
              'q' => 'Can you remove a specific negative review?',
              'a' => 'We cannot remove genuine customer reviews — only the platform can. Where a review genuinely violates platform policies (fake, spam, or abusive), we will guide you through the official dispute process. There is no guarantee the platform will remove it.'
            ],
            [
              'q' => 'Do I own the reports you produce for me?',
              'a' => 'Yes. The reports and deliverables we produce for you are licensed for your business use. The underlying methodologies and frameworks we use to produce them remain our intellectual property.'
            ],
            [
              'q' => 'What if a platform changes its policies during my campaign?',
              'a' => 'Platform policy changes are outside our control. If a policy change affects our strategy, we will notify you promptly and adjust our approach. This does not constitute grounds for a refund if services were delivered according to the terms in place at the time.'
            ],
            [
              'q' => 'How do I cancel my ORM service?',
              'a' => 'Send a cancellation request in writing to ' . $contact_email . ' with 30 days notice. Your service will continue until the end of the current billing period. We\'ll provide a final report and securely hand back any platform access.'
            ],
            [
              'q' => 'What payment methods do you accept?',
              'a' => 'We accept payment via bank transfer, major credit cards, and other methods agreed in your service proposal. All payment details are communicated in your invoice.'
            ],
          ];
          foreach ($faqs as $i => $faq) :
          ?>
            <div class="border border-white/[0.07] rounded-xl overflow-hidden bg-white/[0.02]"
              x-data="{ open: <?php echo $i === 0 ? 'true' : 'false'; ?> }"
              :class="open ? 'border-blue-500/30 bg-blue-600/[0.04]' : ''">
              <button class="w-full flex items-center gap-3 px-5 py-4 text-left"
                :class="open ? 'border-l-2 border-blue-500 pl-4' : ''"
                @click="open = !open" :aria-expanded="open.toString()">
                <span class="text-[12px] font-semibold flex-1 leading-snug"
                  :class="open ? 'text-white' : 'text-slate-400'">
                  <?php echo esc_html($faq['q']); ?>
                </span>
                <i data-lucide="chevron-down" class="w-4 h-4 flex-shrink-0 transition-transform duration-300"
                  :class="open ? 'rotate-180 text-blue-400' : 'text-slate-700'" aria-hidden="true"></i>
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

    </div><!-- /content -->
  </div><!-- /bg -->

  <!-- FINAL CTA -->
  <section class="relative bg-[#020817] py-20 border-t border-white/[0.05] overflow-hidden">
    <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[600px] h-[400px]
                bg-blue-600/[0.09] blur-[120px] rounded-full pointer-events-none"></div>
    <div class="relative z-10 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <i data-lucide="file-text" class="w-10 h-10 text-blue-400 mx-auto mb-4" aria-hidden="true"></i>
      <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Questions About These Terms?</h2>
      <p class="text-sm text-slate-500 leading-relaxed max-w-lg mx-auto mb-6">
        If anything in these Terms is unclear, or you'd like to discuss them before engaging our services, we're happy to help. Transparency is important to us.
      </p>
      <a href="mailto:<?php echo esc_attr($contact_email); ?>"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                   text-white font-semibold text-sm px-7 py-3.5 rounded-xl
                   transition-all duration-200 hover:-translate-y-0.5">
        <i data-lucide="mail" class="w-4 h-4" aria-hidden="true"></i>
        <?php echo esc_html($contact_email); ?>
      </a>
      <p class="text-[11px] text-slate-700 mt-5">
        <?php echo esc_html($company); ?> · <?php echo esc_html($address); ?><br>
        Effective: <?php echo esc_html($effective_date); ?> · Last updated: <?php echo esc_html($last_updated); ?> · Governed by <?php echo esc_html($governing_law); ?>
      </p>
    </div>
  </section>
</div>
<?php get_footer(); ?>
<?php
/*
 * TEMPLATE   : Terms of Service
 * FILE       : page-templates/terms-of-service.php
 * URL        : /terms-of-service/
 * SECTIONS   : 16 sections + FAQ + CTA
 * REQUIRES   : Alpine.js (FAQ accordion), Lucide icons
 * LEGAL NOTE : Review with a qualified attorney before publishing.
 * EDITABLE   : $effective_date, $contact_email, $governing_law above
 * LINKED FROM: footer.php, privacy-policy.php, trust-center.php
 */
?>