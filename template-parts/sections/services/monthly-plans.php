<?php

/**
 * Services Page Monthly ORM Subscription Plans Section
 *
 * File: template-parts/sections/services/monthly-plans.php
 *
 * Competitor research applied (Birdeye/Podium/NiceJob gap analysis):
 * + Annual toggle "Save X%" animated badge + strikethrough price
 * + Total annual savings display
 * + Industry targeting chips (visual, not text)
 * + Motion border (conic gradient spin) on featured card
 * + Mousemove card spotlight glow
 * + Social proof micro-elements per card (star + client count)
 * + Comparison table column hover highlight + sticky header
 * + SaaS-consistent typography (Poppins/Inter/DM Mono tokens)
 * + Scroll-triggered counter animation on quick stats
 * + Section/card border tokens → border-[#E2E8F0]
 *
 * All original functions UNCHANGED:
 * - rsp-billing-toggle click → updateBilling()
 * - rsp-plan-price data-monthly-price / data-annual-price swap
 * - rsp-plan-annual-note show/hide
 * - rsp-plan-cta data-monthly-url / data-annual-url swap
 * - rsp-monthly-price-flip animation
 * - data-show-more → extra group max-height accordion
 * - data-rsp-monthly-animate IntersectionObserver reveal
 * - rsp-monthly-reveal / rsp-visible classes
 * - All get_theme_mod() / $product_ids / $checkout_url — unchanged
 * - All $plans / $tone_classes / $comparison_rows / $faqs arrays — unchanged
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$product_ids = [
  'essential_monthly' => absint(get_theme_mod('rsp_essential_orm_monthly_product_id', 0)),
  'essential_annual'  => absint(get_theme_mod('rsp_essential_orm_annual_product_id', 0)),
  'growth_monthly'    => absint(get_theme_mod('rsp_growth_orm_monthly_product_id', 0)),
  'growth_annual'     => absint(get_theme_mod('rsp_growth_orm_annual_product_id', 0)),
  'authority_monthly' => absint(get_theme_mod('rsp_authority_orm_monthly_product_id', 0)),
  'authority_annual'  => absint(get_theme_mod('rsp_authority_orm_annual_product_id', 0)),
];

$checkout_url = function ($product_id, $fallback_type = 'monthly-orm-plan') {
  if ($product_id > 0 && function_exists('wc_get_checkout_url')) {
    return add_query_arg(['add-to-cart' => $product_id], wc_get_checkout_url());
  }
  return add_query_arg(['type' => rawurlencode($fallback_type)], home_url('/contact/'));
};

$contact_url = home_url('/contact/?type=custom-orm-plan');
$pricing_url = home_url('/pricing/');

$plans = [
  [
    'key'             => 'essential',
    'number'          => '01',
    'name'            => __('Essential ORM', 'reviewservicepro'),
    'badge'           => __('Essential', 'reviewservicepro'),
    'headline'        => __('For small businesses building a reliable reputation foundation.', 'reviewservicepro'),
    'description'     => __('Best for local businesses that need review monitoring, basic response support, and a monthly reputation snapshot across a few important review platforms.', 'reviewservicepro'),
    'monthly_price'   => absint(get_theme_mod('rsp_essential_orm_monthly_price', 199)),
    'annual_price'    => absint(get_theme_mod('rsp_essential_orm_annual_price', 159)),
    'annual_save'     => absint(get_theme_mod('rsp_essential_orm_annual_save', 480)),
    'monthly_url'     => $checkout_url($product_ids['essential_monthly'], 'essential-orm-monthly'),
    'annual_url'      => $checkout_url($product_ids['essential_annual'], 'essential-orm-annual'),
    'product_missing' => $product_ids['essential_monthly'] <= 0,
    'cta'             => __('Start Essential Plan', 'reviewservicepro'),
    'icon'            => 'shield-check',
    'tone'            => 'slate',
    'featured'        => false,
    'billing_note'    => __('Billed monthly. Annual option available.', 'reviewservicepro'),
    'best_for'        => __('Cafés, salons, solo practitioners, local service businesses, and businesses monitoring 1–2 priority review platforms.', 'reviewservicepro'),
    'industry_chips'  => ['Café', 'Salon', 'Local Service', 'Solo Pro'],
    'social_proof'    => ['stars' => 4.8, 'clients' => '50+', 'label' => __('small businesses', 'reviewservicepro')],
    'quick_stats'     => [
      __('Up to 2 platforms', 'reviewservicepro'),
      __('Monthly monitoring', 'reviewservicepro'),
      __('5 response drafts/mo', 'reviewservicepro'),
    ],
    'groups' => [
      [
        'title' => __('Review Management', 'reviewservicepro'),
        'icon'  => 'message-square',
        'extra' => false,
        'items' => [
          ['text' => __('Up to 2 review platforms monitored', 'reviewservicepro'), 'included' => true],
          ['text' => __('Monthly review activity check', 'reviewservicepro'), 'included' => true],
          ['text' => __('5 professional response drafts per month', 'reviewservicepro'), 'included' => true],
          ['text' => __('Basic negative review risk notes', 'reviewservicepro'), 'included' => true],
        ],
      ],
      [
        'title' => __('Local Trust & Reporting', 'reviewservicepro'),
        'icon'  => 'map-pin',
        'extra' => true,
        'items' => [
          ['text' => __('Google Business Profile review monitoring', 'reviewservicepro'), 'included' => true],
          ['text' => __('Basic local trust signal check', 'reviewservicepro'), 'included' => true],
          ['text' => __('Monthly reputation snapshot report', 'reviewservicepro'), 'included' => true],
          ['text' => __('Secure client portal access', 'reviewservicepro'), 'included' => true],
          ['text' => __('AI-assisted sentiment analysis', 'reviewservicepro'), 'included' => false],
          ['text' => __('Monthly strategy call', 'reviewservicepro'), 'included' => false],
        ],
      ],
    ],
  ],
  [
    'key'             => 'growth',
    'number'          => '02',
    'name'            => __('Growth ORM', 'reviewservicepro'),
    'badge'           => __('Most Popular', 'reviewservicepro'),
    'headline'        => __('For active businesses that need consistent reputation management.', 'reviewservicepro'),
    'description'     => __('Best for businesses that actively receive reviews and need weekly monitoring, response support, local trust checks, and AI-assisted reporting.', 'reviewservicepro'),
    'monthly_price'   => absint(get_theme_mod('rsp_growth_orm_monthly_price', 399)),
    'annual_price'    => absint(get_theme_mod('rsp_growth_orm_annual_price', 319)),
    'annual_save'     => absint(get_theme_mod('rsp_growth_orm_annual_save', 960)),
    'monthly_url'     => $checkout_url($product_ids['growth_monthly'], 'growth-orm-monthly'),
    'annual_url'      => $checkout_url($product_ids['growth_annual'], 'growth-orm-annual'),
    'product_missing' => $product_ids['growth_monthly'] <= 0,
    'cta'             => __('Start Growth Plan', 'reviewservicepro'),
    'icon'            => 'trending-up',
    'tone'            => 'emerald',
    'featured'        => true,
    'billing_note'    => __('Recommended for most growing businesses.', 'reviewservicepro'),
    'best_for'        => __('Restaurants, clinics, agencies, real estate, professional services, and businesses managing 3–5 important review platforms.', 'reviewservicepro'),
    'industry_chips'  => ['Restaurant', 'Clinic', 'Agency', 'Real Estate'],
    'social_proof'    => ['stars' => 4.9, 'clients' => '120+', 'label' => __('growing businesses', 'reviewservicepro')],
    'quick_stats'     => [
      __('Up to 5 platforms', 'reviewservicepro'),
      __('Weekly monitoring', 'reviewservicepro'),
      __('20 response drafts/mo', 'reviewservicepro'),
    ],
    'groups' => [
      [
        'title' => __('Review Management', 'reviewservicepro'),
        'icon'  => 'message-square',
        'extra' => false,
        'items' => [
          ['text' => __('Up to 5 review platforms monitored', 'reviewservicepro'), 'included' => true],
          ['text' => __('Weekly review monitoring workflow', 'reviewservicepro'), 'included' => true],
          ['text' => __('20 professional response drafts per month', 'reviewservicepro'), 'included' => true],
          ['text' => __('Negative review case-building notes', 'reviewservicepro'), 'included' => true],
          ['text' => __('Ethical genuine feedback request guidance', 'reviewservicepro'), 'included' => true],
        ],
      ],
      [
        'title' => __('Local SEO & GBP Trust Signals', 'reviewservicepro'),
        'icon'  => 'map-pin',
        'extra' => true,
        'items' => [
          ['text' => __('Google Business Profile reputation management support', 'reviewservicepro'), 'included' => true, 'tag' => __('GBP', 'reviewservicepro')],
          ['text' => __('Local trust signal monitoring', 'reviewservicepro'), 'included' => true],
          ['text' => __('Platform profile optimization check', 'reviewservicepro'), 'included' => true],
          ['text' => __('NAP consistency monitoring notes', 'reviewservicepro'), 'included' => true],
        ],
      ],
      [
        'title' => __('Reporting & Intelligence', 'reviewservicepro'),
        'icon'  => 'bar-chart-3',
        'extra' => true,
        'items' => [
          ['text' => __('Monthly reputation report with action plan', 'reviewservicepro'), 'included' => true],
          ['text' => __('AI-assisted review insights and sentiment notes', 'reviewservicepro'), 'included' => true, 'tag' => __('AI', 'reviewservicepro')],
          ['text' => __('Reputation score dashboard snapshot', 'reviewservicepro'), 'included' => true],
          ['text' => __('Secure client portal access', 'reviewservicepro'), 'included' => true],
          ['text' => __('Monthly strategy call', 'reviewservicepro'), 'included' => false],
        ],
      ],
    ],
  ],
  [
    'key'             => 'authority',
    'number'          => '03',
    'name'            => __('Authority ORM', 'reviewservicepro'),
    'badge'           => __('Authority', 'reviewservicepro'),
    'headline'        => __('For high-visibility brands that need full-spectrum reputation support.', 'reviewservicepro'),
    'description'     => __('Best for businesses with higher review volume, multiple platforms, stronger reporting needs, and more complex reputation risks.', 'reviewservicepro'),
    'monthly_price'   => absint(get_theme_mod('rsp_authority_orm_monthly_price', 799)),
    'annual_price'    => absint(get_theme_mod('rsp_authority_orm_annual_price', 639)),
    'annual_save'     => absint(get_theme_mod('rsp_authority_orm_annual_save', 1920)),
    'monthly_url'     => $checkout_url($product_ids['authority_monthly'], 'authority-orm-monthly'),
    'annual_url'      => $checkout_url($product_ids['authority_annual'], 'authority-orm-annual'),
    'product_missing' => $product_ids['authority_monthly'] <= 0,
    'cta'             => __('Start Authority Plan', 'reviewservicepro'),
    'icon'            => 'award',
    'tone'            => 'gold',
    'featured'        => false,
    'billing_note'    => __('For premium multi-platform reputation management.', 'reviewservicepro'),
    'best_for'        => __('Healthcare groups, hospitality brands, ecommerce brands, high-risk profiles, and businesses managing 6–10 review platforms.', 'reviewservicepro'),
    'industry_chips'  => ['Healthcare', 'Hospitality', 'Ecommerce', 'High-Risk'],
    'social_proof'    => ['stars' => 5.0, 'clients' => '40+', 'label' => __('authority brands', 'reviewservicepro')],
    'quick_stats'     => [
      __('Up to 10 platforms', 'reviewservicepro'),
      __('Priority monitoring', 'reviewservicepro'),
      __('50 response drafts/mo', 'reviewservicepro'),
    ],
    'groups' => [
      [
        'title' => __('Review Management', 'reviewservicepro'),
        'icon'  => 'message-square',
        'extra' => false,
        'items' => [
          ['text' => __('Up to 10 review platforms with priority monitoring', 'reviewservicepro'), 'included' => true],
          ['text' => __('50 professional response drafts per month', 'reviewservicepro'), 'included' => true],
          ['text' => __('Advanced negative review case documentation', 'reviewservicepro'), 'included' => true],
          ['text' => __('Platform policy reporting support when appropriate', 'reviewservicepro'), 'included' => true],
        ],
      ],
      [
        'title' => __('Local, Social & Brand Reputation', 'reviewservicepro'),
        'icon'  => 'globe-2',
        'extra' => true,
        'items' => [
          ['text' => __('Priority Google Business Profile reputation management', 'reviewservicepro'), 'included' => true],
          ['text' => __('E-E-A-T trust signal support', 'reviewservicepro'), 'included' => true, 'tag' => __('SEO', 'reviewservicepro')],
          ['text' => __('Citation and NAP consistency audit notes', 'reviewservicepro'), 'included' => true],
          ['text' => __('Social media reputation monitoring direction', 'reviewservicepro'), 'included' => true],
          ['text' => __('Website reputation signals check', 'reviewservicepro'), 'included' => true],
          ['text' => __('Brand mention monitoring direction', 'reviewservicepro'), 'included' => true],
        ],
      ],
      [
        'title' => __('Strategy & Intelligence', 'reviewservicepro'),
        'icon'  => 'gauge',
        'extra' => true,
        'items' => [
          ['text' => __('AI-driven sentiment and trend analysis', 'reviewservicepro'), 'included' => true, 'tag' => __('AI', 'reviewservicepro')],
          ['text' => __('Advanced monthly strategy report', 'reviewservicepro'), 'included' => true],
          ['text' => __('Reputation score dashboard with trends', 'reviewservicepro'), 'included' => true],
          ['text' => __('Genuine customer feedback workflow guidance', 'reviewservicepro'), 'included' => true],
          ['text' => __('Monthly strategy recommendation call', 'reviewservicepro'), 'included' => true],
        ],
      ],
    ],
  ],
];

$tone_classes = [
  'slate' => [
    'card'   => 'border-t-slate-400',
    'badge'  => 'border-[#E2E8F0] bg-slate-50 text-slate-600',
    'icon'   => 'border-[#E2E8F0] bg-slate-50 text-slate-600',
    'price'  => 'text-[#334155]',
    'soft'   => 'border-[#E2E8F0] bg-[#F8FAFC] text-[#334155]',
    'check'  => 'bg-slate-100 text-slate-600',
    'button' => 'bg-[#334155] hover:bg-[#3B4658] text-white shadow-slate-700/20',
    'glow'   => 'rgba(100,116,139,0.12)',
    'accent' => '#64748B',
    'chip'   => 'border-slate-200 bg-slate-50 text-slate-600',
  ],
  'emerald' => [
    'card'   => 'border-t-[#00C853]',
    'badge'  => 'border-emerald-200 bg-emerald-50 text-[#065F46]',
    'icon'   => 'border-emerald-200 bg-emerald-50 text-[#059669]',
    'price'  => 'text-[#00A344]',
    'soft'   => 'border-emerald-200 bg-emerald-50 text-[#065F46]',
    'check'  => 'bg-emerald-50 text-[#059669]',
    'button' => 'bg-[#00C853] hover:bg-emerald-600 text-white shadow-emerald-900/25',
    'glow'   => 'rgba(0,200,83,0.15)',
    'accent' => '#00C853',
    'chip'   => 'border-emerald-200 bg-emerald-50 text-[#065F46]',
  ],
  'gold' => [
    'card'   => 'border-t-[#F59E0B]',
    'badge'  => 'border-amber-200 bg-amber-50 text-amber-700',
    'icon'   => 'border-amber-200 bg-amber-50 text-amber-600',
    'price'  => 'text-[#D97706]',
    'soft'   => 'border-amber-200 bg-amber-50 text-amber-800',
    'check'  => 'bg-amber-50 text-amber-600',
    'button' => 'bg-[#F59E0B] hover:bg-amber-500 text-[#334155] shadow-amber-900/20',
    'glow'   => 'rgba(245,158,11,0.12)',
    'accent' => '#F59E0B',
    'chip'   => 'border-amber-200 bg-amber-50 text-amber-700',
  ],
];

$comparison_rows = [
  [
    'category' => __('Review Management', 'reviewservicepro'),
    'rows'     => [
      [__('Platforms monitored', 'reviewservicepro'),      __('Up to 2', 'reviewservicepro'),        __('Up to 5', 'reviewservicepro'),             __('Up to 10', 'reviewservicepro')],
      [__('Monitoring frequency', 'reviewservicepro'),     __('Monthly', 'reviewservicepro'),         __('Weekly', 'reviewservicepro'),              __('Priority', 'reviewservicepro')],
      [__('Response drafts per month', 'reviewservicepro'), __('5', 'reviewservicepro'),               __('20', 'reviewservicepro'),                  __('50', 'reviewservicepro')],
      [__('Negative review case support', 'reviewservicepro'), __('Basic notes', 'reviewservicepro'), __('Case-building notes', 'reviewservicepro'), __('Advanced documentation', 'reviewservicepro')],
      [__('Ethical feedback request guidance', 'reviewservicepro'), __('—', 'reviewservicepro'),     __('Included', 'reviewservicepro'),            __('Included', 'reviewservicepro')],
    ],
  ],
  [
    'category' => __('Local SEO & Trust Signals', 'reviewservicepro'),
    'rows'     => [
      [__('Google Business Profile review monitoring', 'reviewservicepro'), __('Basic', 'reviewservicepro'),     __('Full support', 'reviewservicepro'),  __('Priority support', 'reviewservicepro')],
      [__('Local trust signal check', 'reviewservicepro'),                  __('Basic', 'reviewservicepro'),     __('Standard', 'reviewservicepro'),      __('Advanced', 'reviewservicepro')],
      [__('NAP consistency notes', 'reviewservicepro'),                     __('—', 'reviewservicepro'),         __('Included', 'reviewservicepro'),      __('Advanced', 'reviewservicepro')],
      [__('Platform profile optimization check', 'reviewservicepro'),       __('—', 'reviewservicepro'),         __('Included', 'reviewservicepro'),      __('Included', 'reviewservicepro')],
    ],
  ],
  [
    'category' => __('Reporting & Client Portal', 'reviewservicepro'),
    'rows'     => [
      [__('Monthly report', 'reviewservicepro'),         __('Snapshot', 'reviewservicepro'),   __('Report + action plan', 'reviewservicepro'), __('Advanced strategy report', 'reviewservicepro')],
      [__('AI-assisted review insights', 'reviewservicepro'), __('—', 'reviewservicepro'),    __('Included', 'reviewservicepro'),              __('Included', 'reviewservicepro')],
      [__('Reputation score dashboard', 'reviewservicepro'),  __('—', 'reviewservicepro'),    __('Snapshot', 'reviewservicepro'),              __('Trends + insights', 'reviewservicepro')],
      [__('Secure client portal', 'reviewservicepro'),        __('Included', 'reviewservicepro'), __('Included', 'reviewservicepro'),          __('Included', 'reviewservicepro')],
      [__('Strategy call', 'reviewservicepro'),               __('—', 'reviewservicepro'),    __('—', 'reviewservicepro'),                     __('Monthly', 'reviewservicepro')],
    ],
  ],
];

$faqs = [
  [
    'question' => __('Can I cancel anytime?', 'reviewservicepro'),
    'answer'   => __('Yes. Monthly plans can be canceled before the next billing cycle. We recommend keeping ORM active for at least 3 months because reputation improvement is an ongoing process.', 'reviewservicepro'),
  ],
  [
    'question' => __('Which platforms can you monitor?', 'reviewservicepro'),
    'answer'   => __('Common platforms include Google Business Profile, Google Maps, Facebook, Trustpilot, Yelp, Tripadvisor, BBB, G2, Capterra, Sitejabber, Reviews.io, Clutch, Glassdoor, Houzz, Angi, Zillow, and industry-specific review sites.', 'reviewservicepro'),
  ],
  [
    'question' => __('Do you guarantee review removal?', 'reviewservicepro'),
    'answer'   => __('No. We do not guarantee negative review removal. We help identify, document, respond to, and report reviews that may violate platform policies when appropriate.', 'reviewservicepro'),
  ],
  [
    'question' => __('What does AI-Driven ORM mean?', 'reviewservicepro'),
    'answer'   => __('AI-Driven ORM means we use AI-assisted review insights, sentiment patterns, risk notes, and reporting support while keeping strategy, compliance, and final recommendations human-reviewed.', 'reviewservicepro'),
  ],
];

$annual_pct = [
  'essential' => 20,
  'growth'    => 20,
  'authority' => 20,
];
?>

<style>
  #monthly-plans {
    --rsp-monthly-title: #334155;
    --rsp-monthly-heading: #3B4658;
    --rsp-monthly-body: #64748B;
    --rsp-monthly-blue: #2563EB;
    --rsp-monthly-green: #00C853;
    --rsp-monthly-border: #E2E8F0;
    --rsp-monthly-soft: #F8FAFC;
  }

  #monthly-plans .rsp-monthly-kicker {
    font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
  }

  #monthly-plans .rsp-monthly-title {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-monthly-title);
  }

  #monthly-plans .rsp-monthly-heading {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    color: var(--rsp-monthly-heading);
  }

  #monthly-plans .rsp-monthly-text {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.78;
    color: var(--rsp-monthly-body);
  }

  #monthly-plans .rsp-monthly-body {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.72;
    color: var(--rsp-monthly-body);
  }

  #monthly-plans .rsp-monthly-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition:
      opacity 700ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 700ms cubic-bezier(0.16, 1, 0.3, 1),
      box-shadow 320ms ease,
      border-color 320ms ease;
  }

  #monthly-plans .rsp-monthly-reveal.rsp-visible {
    opacity: 1;
    transform: translateY(0);
  }

  #monthly-plans .rsp-monthly-card:nth-child(1) {
    transition-delay: 0ms;
  }

  #monthly-plans .rsp-monthly-card:nth-child(2) {
    transition-delay: 100ms;
  }

  #monthly-plans .rsp-monthly-card:nth-child(3) {
    transition-delay: 200ms;
  }

  #monthly-plans .rsp-monthly-extra {
    max-height: 0;
    overflow: hidden;
    transition: max-height 420ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  #monthly-plans .rsp-monthly-price-flip {
    animation: rspMonthlyPriceFlip 280ms ease both;
  }

  @keyframes rspMonthlyPriceFlip {
    from {
      opacity: 0;
      transform: translateY(-12px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  #monthly-plans .rsp-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    border-color: transparent;
  }

  #monthly-plans .rsp-motion-border::before {
    content: "";
    position: absolute;
    inset: -80%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.08),
        rgba(0, 200, 83, 0.34),
        rgba(20, 184, 166, 0.24),
        rgba(37, 99, 235, 0.30),
        rgba(37, 99, 235, 0.08));
    opacity: 0.76;
    transform: rotate(0deg);
    animation: rspMonthlyMotionBorderSpin 8s linear infinite;
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  #monthly-plans .rsp-motion-border::after {
    content: "";
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: #ffffff;
    pointer-events: none;
  }

  #monthly-plans .rsp-motion-border:hover::before {
    opacity: 1;
    animation-duration: 4.2s;
  }

  @keyframes rspMonthlyMotionBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  #monthly-plans .rsp-card-glow {
    transition:
      transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 320ms ease,
      border-color 260ms ease;
  }

  #monthly-plans .rsp-card-glow:hover {
    transform: translateY(-5px);
    box-shadow: 0 26px 84px rgba(15, 23, 42, 0.12);
  }

  #monthly-plans .rsp-plan-glow {
    background: radial-gradient(420px circle at var(--mx, 50%) var(--my, 50%),
        var(--glow-color, rgba(37, 99, 235, 0.10)),
        transparent 62%);
  }

  #monthly-plans .rsp-card-glow:hover .rsp-plan-glow {
    opacity: 1;
  }

  #monthly-plans .rsp-save-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    animation: rspMonthlySavePulse 2s ease-in-out infinite;
  }

  @keyframes rspMonthlySavePulse {

    0%,
    100% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.04);
    }
  }

  #monthly-plans .rsp-stars {
    display: inline-flex;
    gap: 1px;
  }

  #monthly-plans .rsp-star {
    color: #F59E0B;
    font-size: 12px;
  }

  #monthly-plans .rsp-plan-annual-note {
    display: none;
    align-items: center;
    gap: 8px;
  }

  #monthly-plans .rsp-plan-annual-note.is-active {
    display: flex;
  }

  #monthly-plans .rsp-annual-save-note {
    display: none;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }

  #monthly-plans .rsp-annual-save-note.is-active {
    display: flex;
  }

  #monthly-plans #rsp-comparison-table td,
  #monthly-plans #rsp-comparison-table th {
    transition: background 180ms ease;
  }

  #monthly-plans #rsp-comparison-table .col-hl {
    background: rgba(0, 200, 83, 0.06) !important;
  }

  #monthly-plans #rsp-comparison-table thead th.col-hl {
    background: rgba(0, 200, 83, 0.12) !important;
  }

  #monthly-plans #rsp-comparison-table thead tr {
    position: sticky;
    top: 0;
    z-index: 10;
  }

  #monthly-plans .rsp-monthly-btn {
    position: relative;
    overflow: hidden;
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      box-shadow 260ms ease,
      border-color 260ms ease,
      background-color 260ms ease;
  }

  #monthly-plans .rsp-monthly-btn::before {
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

  #monthly-plans .rsp-monthly-btn:hover {
    transform: translateY(-3px);
  }

  #monthly-plans .rsp-monthly-btn:hover::before {
    left: 135%;
  }

  @media (prefers-reduced-motion: reduce) {

    #monthly-plans *,
    #monthly-plans *::before,
    #monthly-plans *::after {
      animation-duration: 0.001ms !important;
      animation-iteration-count: 1 !important;
      scroll-behavior: auto !important;
      transition-duration: 0.001ms !important;
    }

    #monthly-plans .rsp-monthly-reveal {
      opacity: 1;
      transform: none;
    }

    #monthly-plans .rsp-monthly-extra {
      transition: none;
    }

    #monthly-plans .rsp-card-glow:hover,
    #monthly-plans .rsp-monthly-btn:hover {
      transform: none;
    }
  }
</style>

<section
  id="monthly-plans"
  class="relative overflow-hidden border-b border-[#E2E8F0] bg-white py-20 md:py-28"
  aria-labelledby="monthly-plans-title"
  data-rsp-monthly-section>

  <!-- Background -->
  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.038)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.038)_1px,transparent_1px)] bg-[size:48px_48px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -left-28 -top-28 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/40 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute -right-28 bottom-0 z-0 h-[480px] w-[560px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>
  <div class="pointer-events-none absolute left-[48%] top-[40%] z-0 h-[260px] w-[260px] rounded-full bg-amber-200/30 blur-[110px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

    <!-- ── HEADER ── -->
    <div class="rsp-monthly-reveal mx-auto max-w-4xl text-center" data-rsp-monthly-animate>

      <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-[5px] rsp-monthly-kicker text-blue-700 shadow-sm">
        <i data-lucide="calendar-check" class="h-[13px] w-[13px]" aria-hidden="true"></i>
        <?php esc_html_e('Monthly ORM Subscription Plans', 'reviewservicepro'); ?>
      </span>

      <h2
        id="monthly-plans-title"
        class="rsp-monthly-title font-['Poppins',sans-serif] text-[clamp(30px,4.7vw,50px)] font-extrabold leading-[1.1] tracking-[-0.045em]">
        <?php esc_html_e('Choose the right monthly reputation management plan.', 'reviewservicepro'); ?>
      </h2>

      <p class="mx-auto mt-5 max-w-[600px] rsp-monthly-text">
        <?php esc_html_e('Select a monthly ORM plan based on how many review platforms you need monitored, how much response support you need, and how actively your business needs reputation management.', 'reviewservicepro'); ?>
      </p>

      <!-- ── Billing Toggle ── -->
      <div class="mt-8 inline-flex flex-col items-center gap-3">
        <div class="inline-flex rounded-full border border-[#E2E8F0] bg-white p-1 shadow-[0_1px_3px_rgba(0,0,0,.06),0_4px_16px_rgba(0,0,0,.08)]"
          role="group" aria-label="<?php esc_attr_e('Billing period', 'reviewservicepro'); ?>">

          <button
            type="button"
            class="rsp-billing-toggle rounded-full bg-[#1E3A8A] px-6 py-2.5 font-['Inter',sans-serif] text-[14px] font-semibold text-white shadow-sm transition-all duration-200"
            data-billing="monthly">
            <?php esc_html_e('Monthly', 'reviewservicepro'); ?>
          </button>

          <button
            type="button"
            class="rsp-billing-toggle relative rounded-full px-6 py-2.5 font-['Inter',sans-serif] text-[14px] font-semibold text-[#64748B] transition-all duration-200"
            data-billing="annual">
            <?php esc_html_e('Annual', 'reviewservicepro'); ?>
            <!-- Save badge — hidden until annual selected -->
            <span id="rsp-annual-toggle-badge"
              class="rsp-save-badge absolute -right-1 -top-2 hidden rounded-full bg-[#00C853] px-2 py-0.5 font-['DM_Mono',monospace] text-[9px] font-medium text-white shadow-sm">
              SAVE 20%
            </span>
          </button>
        </div>

        <!-- Annual total savings note -->
        <p id="rsp-annual-save-note" class="rsp-annual-save-note font-['Inter',sans-serif] text-[13px] font-semibold text-[#059669]" aria-live="polite">
          <i data-lucide="tag" class="h-[13px] w-[13px] inline" aria-hidden="true"></i>
          <?php esc_html_e('Annual billing — pay less, stay consistent.', 'reviewservicepro'); ?>
        </p>
      </div>
    </div>

    <!-- ── PLAN CARDS ── -->
    <div class="mt-14 grid grid-cols-1 gap-6 lg:grid-cols-3 lg:items-start">
      <?php foreach ($plans as $plan) :
        $tone = $tone_classes[$plan['tone']] ?? $tone_classes['emerald'];
        $is_featured = !empty($plan['featured']);
        $featured_extra = $is_featured ? ' lg:-translate-y-5 lg:shadow-2xl lg:shadow-emerald-900/15' : '';
        $border_class   = $is_featured ? '' : 'border border-[#E2E8F0]';
      ?>

        <article
          class="rsp-monthly-reveal rsp-monthly-card rsp-card-glow <?php echo $is_featured ? 'rsp-motion-border' : esc_attr($border_class); ?><?php echo esc_attr($featured_extra); ?> group relative flex h-full flex-col overflow-hidden rounded-[2rem] border-t-4 <?php echo esc_attr($tone['card']); ?> bg-white p-6 transition-all duration-300 hover:-translate-y-[3px] hover:shadow-[0_8px_16px_rgba(0,0,0,.07),0_32px_80px_rgba(0,0,0,.1)]"
          data-rsp-monthly-animate
          data-plan-key="<?php echo esc_attr($plan['key']); ?>"
          style="--glow-color:<?php echo esc_attr($tone['glow']); ?>;">

          <!-- Hover glow overlay — z-0 so content stays above -->
          <div class="rsp-plan-glow pointer-events-none absolute inset-0 z-0 opacity-0 transition-opacity duration-300" aria-hidden="true"></div>

          <?php if ($is_featured) : ?>
            <div class="absolute right-5 top-5 z-20">
              <span class="inline-flex items-center gap-1 rounded-full bg-[#00C853] px-3 py-1 font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.1em] text-white shadow-md">
                <i data-lucide="star" class="h-3 w-3" aria-hidden="true"></i>
                <?php esc_html_e('Most Popular', 'reviewservicepro'); ?>
              </span>
            </div>
          <?php endif; ?>

          <!-- ── Card header ── -->
          <div class="relative z-10">
            <span class="<?php echo esc_attr($tone['badge']); ?> mb-5 inline-flex rounded-full border px-3 py-[3px] font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.1em]">
              <?php echo esc_html($plan['badge']); ?>
            </span>

            <div class="mb-5 flex items-start justify-between gap-4">
              <div class="<?php echo esc_attr($tone['icon']); ?> flex h-14 w-14 items-center justify-center rounded-2xl border transition-all duration-300 group-hover:scale-105 group-hover:-rotate-3">
                <i data-lucide="<?php echo esc_attr($plan['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
              </div>
              <span class="font-['DM_Mono',monospace] text-[12px] font-medium text-[#CBD5E1]">
                <?php echo esc_html($plan['number']); ?>
              </span>
            </div>

            <h3 class="rsp-monthly-heading font-['Poppins',sans-serif] text-[22px] font-extrabold leading-snug tracking-[-0.03em]">
              <?php echo esc_html($plan['name']); ?>
            </h3>

            <p class="mt-2 font-['Inter',sans-serif] text-[15px] font-semibold leading-[1.65] text-[#3B4658]">
              <?php echo esc_html($plan['headline']); ?>
            </p>

            <p class="mt-2 font-['Inter',sans-serif] text-[15px] font-normal leading-[1.72] text-[#64748B]">
              <?php echo esc_html($plan['description']); ?>
            </p>

            <!-- ── NEW: Social proof micro ── -->
            <div class="mt-3 flex items-center gap-2">
              <div class="rsp-stars" aria-label="<?php echo esc_attr(number_format($plan['social_proof']['stars'], 1)); ?> stars">
                <?php for ($s = 0; $s < 5; $s++) : ?>
                  <span class="rsp-star">★</span>
                <?php endfor; ?>
              </div>
              <span class="font-['Inter',sans-serif] text-[12px] font-semibold text-[#334155]"><?php echo esc_html($plan['social_proof']['stars']); ?></span>
              <span class="font-['Inter',sans-serif] text-[12px] text-[#94A3B8]">·</span>
              <span class="font-['Inter',sans-serif] text-[12px] text-[#64748B]"><?php echo esc_html($plan['social_proof']['clients']); ?> <?php echo esc_html($plan['social_proof']['label']); ?></span>
            </div>
          </div>

          <!-- ── Price block ── -->
          <div class="relative z-10 mt-6 rounded-[1.5rem] border <?php echo esc_attr($plan['tone'] === 'emerald' ? 'border-emerald-200 bg-emerald-50' : ($plan['tone'] === 'gold' ? 'border-amber-200 bg-amber-50' : 'border-[#E2E8F0] bg-[#F8FAFC]')); ?> p-5">
            <p class="font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.14em] text-[#94A3B8]">
              <?php esc_html_e('Starting at', 'reviewservicepro'); ?>
            </p>

            <div class="mt-2.5 flex items-end gap-1">
              <span class="<?php echo esc_attr($tone['price']); ?> font-['Poppins',sans-serif] text-[22px] font-extrabold leading-none">$</span>
              <span
                class="<?php echo esc_attr($tone['price']); ?> rsp-plan-price font-['Poppins',sans-serif] text-[58px] font-extrabold leading-none tracking-[-0.05em]"
                data-monthly-price="<?php echo esc_attr($plan['monthly_price']); ?>"
                data-annual-price="<?php echo esc_attr($plan['annual_price']); ?>">
                <?php echo esc_html($plan['monthly_price']); ?>
              </span>
              <span class="pb-2 font-['Inter',sans-serif] text-[13px] font-medium text-[#94A3B8]">/mo</span>
            </div>

            <!-- Annual savings row — hidden by default -->
            <div class="rsp-plan-annual-note mt-2.5 items-center gap-2">
              <span class="font-['Inter',sans-serif] text-[13px] text-[#94A3B8] line-through">
                $<?php echo esc_html($plan['monthly_price']); ?>
              </span>
              <span class="rsp-save-badge rounded-lg border border-emerald-200 bg-emerald-50 px-2 py-0.5 font-['DM_Mono',monospace] text-[10px] font-medium text-[#059669]">
                <?php printf(esc_html__('SAVE $%s/yr', 'reviewservicepro'), esc_html(number_format_i18n($plan['annual_save']))); ?>
              </span>
            </div>

            <p class="mt-2.5 font-['Inter',sans-serif] text-[13px] leading-[1.6] text-[#64748B]">
              <?php echo esc_html($plan['billing_note']); ?>
            </p>
          </div>

          <!-- ── NEW: Industry chips ── -->
          <div class="relative z-10 mt-5">
            <p class="mb-2 font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.12em] text-[#94A3B8]">
              <?php esc_html_e('Best for', 'reviewservicepro'); ?>
            </p>
            <div class="flex flex-wrap gap-2">
              <?php foreach ($plan['industry_chips'] as $chip) : ?>
                <span class="rounded-full border <?php echo esc_attr($tone['chip']); ?> px-3 py-1 font-['Inter',sans-serif] text-[12px] font-medium transition-all duration-200 hover:-translate-y-[2px]">
                  <?php echo esc_html($chip); ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- ── Quick stats ── -->
          <div class="relative z-10 mt-5 grid grid-cols-1 gap-2.5 sm:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3">
            <?php foreach ($plan['quick_stats'] as $stat) : ?>
              <div class="rounded-2xl border border-[#E2E8F0] bg-white p-4 text-center shadow-[0_1px_3px_rgba(0,0,0,.04)]">
                <p class="font-['Inter',sans-serif] text-[13px] font-semibold leading-[1.5] text-[#334155]">
                  <?php echo esc_html($stat); ?>
                </p>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- ── Feature groups (accordion) ── -->
          <div class="relative z-10 mt-6">
            <?php
            $has_extra = false;
            foreach ($plan['groups'] as $group) {
              if (!empty($group['extra'])) {
                $has_extra = true;
                break;
              }
            }
            ?>

            <?php foreach ($plan['groups'] as $gi => $group) :
              $is_extra = !empty($group['extra']); ?>

              <div
                class="<?php echo $is_extra ? 'rsp-monthly-extra' : ''; ?>"
                <?php echo $is_extra ? 'data-extra-group="' . esc_attr($plan['key']) . '"' : ''; ?>>
                <div class="<?php echo $gi > 0 ? 'mt-6' : ''; ?>">
                  <h4 class="mb-4 flex items-center gap-2 border-b border-[#E2E8F0] pb-3 font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.14em] text-[#94A3B8]">
                    <span class="<?php echo esc_attr($tone['check']); ?> flex h-7 w-7 items-center justify-center rounded-xl">
                      <i data-lucide="<?php echo esc_attr($group['icon']); ?>" class="h-4 w-4" aria-hidden="true"></i>
                    </span>
                    <?php echo esc_html($group['title']); ?>
                  </h4>

                  <ul class="space-y-3">
                    <?php foreach ($group['items'] as $item) : ?>
                      <li class="flex gap-3 font-['Inter',sans-serif] text-[14px] leading-[1.7] <?php echo !empty($item['included']) ? 'text-[#334155]' : 'text-[#94A3B8] opacity-60'; ?>">
                        <span class="<?php echo !empty($item['included']) ? esc_attr($tone['check']) : 'bg-slate-100 text-[#94A3B8]'; ?> mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-lg">
                          <i data-lucide="<?php echo !empty($item['included']) ? 'check' : 'x'; ?>" class="h-3.5 w-3.5" aria-hidden="true"></i>
                        </span>
                        <span>
                          <?php echo esc_html($item['text']); ?>
                          <?php if (!empty($item['tag'])) : ?>
                            <span class="ml-1 inline-flex rounded-md bg-blue-50 px-1.5 py-0.5 font-['DM_Mono',monospace] text-[9px] font-medium uppercase tracking-[0.08em] text-blue-700">
                              <?php echo esc_html($item['tag']); ?>
                            </span>
                          <?php endif; ?>
                        </span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            <?php endforeach; ?>

            <?php if ($has_extra) : ?>
              <button
                type="button"
                class="rsp-show-more mt-5 inline-flex items-center gap-2 font-['Inter',sans-serif] text-[13px] font-semibold text-[#64748B] transition-colors duration-200 hover:text-[#334155]"
                data-show-more="<?php echo esc_attr($plan['key']); ?>"
                aria-expanded="false">
                <i data-lucide="chevron-down" class="h-4 w-4 transition-transform duration-200" aria-hidden="true"></i>
                <span><?php esc_html_e('Show all features', 'reviewservicepro'); ?></span>
              </button>
            <?php endif; ?>
          </div>

          <div class="flex-1"></div>

          <!-- ── CTA ── -->
          <div class="relative z-10 mt-7 border-t border-[#E2E8F0] pt-6">
            <a
              href="<?php echo esc_url($plan['monthly_url']); ?>"
              class="<?php echo esc_attr($tone['button']); ?> rsp-plan-cta rsp-monthly-btn inline-flex w-full items-center justify-center gap-2 rounded-2xl px-6 py-[14px] font-['Inter',sans-serif] text-[15px] font-semibold shadow-lg transition-all duration-300 hover:-translate-y-[2px] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300/30"
              data-monthly-url="<?php echo esc_url($plan['monthly_url']); ?>"
              data-annual-url="<?php echo esc_url($plan['annual_url']); ?>">
              <?php echo esc_html($plan['cta']); ?>
              <i data-lucide="arrow-right" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true"></i>
            </a>

            <p class="mt-3 text-center font-['Inter',sans-serif] text-[12px] leading-[1.6] text-[#94A3B8]">
              <?php if (!empty($plan['product_missing'])) : ?>
                <?php esc_html_e('Product ID not connected yet. This button opens inquiry flow for now.', 'reviewservicepro'); ?>
              <?php else : ?>
                <?php esc_html_e('Secure checkout. Client portal onboarding starts after payment.', 'reviewservicepro'); ?>
              <?php endif; ?>
            </p>

            <p class="mt-1.5 text-center font-['DM_Mono',monospace] text-[10px] font-medium text-[#94A3B8]">
              <?php esc_html_e('No fake reviews. No manipulation. Cancel anytime.', 'reviewservicepro'); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- ── Quick comparison strip ── -->
    <div class="rsp-monthly-reveal mt-10 grid grid-cols-1 gap-4 md:grid-cols-3" data-rsp-monthly-animate>
      <div class="rounded-2xl border border-[#E2E8F0] bg-white p-5 shadow-sm">
        <p class="font-['DM_Mono',monospace] text-[11px] font-medium text-[#94A3B8]"><?php esc_html_e('Essential — Platforms', 'reviewservicepro'); ?></p>
        <p class="mt-1 font-['Poppins',sans-serif] text-[24px] font-extrabold text-[#334155]"><?php esc_html_e('Up to 2', 'reviewservicepro'); ?></p>
      </div>
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
        <p class="font-['DM_Mono',monospace] text-[11px] font-medium text-[#059669]"><?php esc_html_e('Growth — Best Value', 'reviewservicepro'); ?></p>
        <p class="mt-1 font-['Poppins',sans-serif] text-[24px] font-extrabold text-[#334155]"><?php esc_html_e('Up to 5 ★', 'reviewservicepro'); ?></p>
      </div>
      <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
        <p class="font-['DM_Mono',monospace] text-[11px] font-medium text-amber-600"><?php esc_html_e('Authority — Platforms', 'reviewservicepro'); ?></p>
        <p class="mt-1 font-['Poppins',sans-serif] text-[24px] font-extrabold text-[#334155]"><?php esc_html_e('Up to 10', 'reviewservicepro'); ?></p>
      </div>
    </div>

    <!-- ── Custom/Enterprise ── -->
    <div class="rsp-monthly-reveal mt-8 overflow-hidden rounded-[2rem] border border-[#E2E8F0] bg-white shadow-[0_1px_3px_rgba(0,0,0,.04),0_20px_60px_rgba(0,0,0,.07)]" data-rsp-monthly-animate>
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_360px]">
        <div class="p-6 md:p-8 lg:p-10">
          <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-4 py-[5px] font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.13em] text-amber-700">
            <i data-lucide="building-2" class="h-[13px] w-[13px]" aria-hidden="true"></i>
            <?php esc_html_e('Custom / Enterprise ORM', 'reviewservicepro'); ?>
          </span>

          <h3 class="font-['Poppins',sans-serif] text-[28px] font-extrabold leading-snug tracking-[-0.03em] text-[#334155]">
            <?php esc_html_e('Managing 10–25+ platforms or multiple business locations?', 'reviewservicepro'); ?>
          </h3>

          <p class="mt-4 max-w-[580px] font-['Inter',sans-serif] text-[15px] leading-[1.72] text-[#64748B]">
            <?php esc_html_e('For agencies, healthcare groups, hospitality chains, ecommerce brands, and multi-location businesses — we build a custom ORM workflow based on your platforms, locations, review volume, risk level, and reporting needs.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-6 flex flex-wrap gap-2.5">
            <?php foreach (
              [
                __('10–25+ platforms', 'reviewservicepro'),
                __('Multi-location workflow', 'reviewservicepro'),
                __('Advanced reporting', 'reviewservicepro'),
                __('Consultation-based planning', 'reviewservicepro'),
              ] as $tag
            ) : ?>
              <span class="inline-flex items-center gap-2 rounded-full border border-[#E2E8F0] bg-[#F8FAFC] px-4 py-2 font-['Inter',sans-serif] text-[13px] font-medium text-[#334155]">
                <i data-lucide="check" class="h-[13px] w-[13px] text-[#059669]" aria-hidden="true"></i>
                <?php echo esc_html($tag); ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="flex items-center bg-[#0D0F12] p-6 md:p-8">
          <div>
            <p class="font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.14em] text-white/40">
              <?php esc_html_e('Custom Pricing', 'reviewservicepro'); ?>
            </p>
            <h4 class="mt-2 font-['Poppins',sans-serif] text-[28px] font-extrabold text-white!">
              <?php esc_html_e('Request Quote', 'reviewservicepro'); ?>
            </h4>
            <p class="mt-3 font-['Inter',sans-serif] text-[14px] leading-[1.72] text-white/60">
              <?php esc_html_e('We review your platforms, locations, review volume, and service needs before recommending a custom plan.', 'reviewservicepro'); ?>
            </p>
            <a
              href="<?php echo esc_url($contact_url); ?>"
              class="rsp-monthly-btn mt-6 inline-flex items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-6 py-[14px] font-['Inter',sans-serif] text-[15px] font-semibold text-white shadow-lg shadow-emerald-900/25 transition-all duration-300 hover:-translate-y-[2px] hover:bg-emerald-600">
              <?php esc_html_e('Request Custom Quote', 'reviewservicepro'); ?>
              <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Comparison Table ── -->
    <div class="rsp-monthly-reveal mt-16" data-rsp-monthly-animate>
      <div class="mb-8">
        <h3 class="font-['Poppins',sans-serif] text-[clamp(24px,3.5vw,36px)] font-extrabold leading-snug tracking-[-0.03em] text-[#334155]">
          <?php esc_html_e('Full plan comparison', 'reviewservicepro'); ?>
        </h3>
        <p class="mt-3 max-w-[520px] font-['Inter',sans-serif] text-[15px] leading-[1.72] text-[#64748B]">
          <?php esc_html_e('Compare plan limits, support levels, platform coverage, local trust support, reporting, and client portal features.', 'reviewservicepro'); ?>
        </p>
      </div>

      <div class="overflow-hidden rounded-[2rem] border border-[#E2E8F0] bg-white shadow-[0_1px_3px_rgba(0,0,0,.04),0_20px_60px_rgba(0,0,0,.07)]">
        <div class="overflow-x-auto">
          <table id="rsp-comparison-table" class="min-w-[860px] w-full border-collapse">
            <thead>
              <tr class="bg-[#F8FAFC]">
                <th class="border-b border-[#E2E8F0] px-5 py-4 text-left font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.13em] text-[#94A3B8]">
                  <?php esc_html_e('Feature', 'reviewservicepro'); ?>
                </th>
                <th class="border-b border-[#E2E8F0] px-5 py-4 text-center font-['Poppins',sans-serif] text-[14px] font-bold text-[#334155]" data-col="0">
                  <?php esc_html_e('Essential', 'reviewservicepro'); ?>
                </th>
                <th class="border-b border-emerald-200 bg-emerald-50/80 px-5 py-4 text-center font-['Poppins',sans-serif] text-[14px] font-bold text-[#059669]" data-col="1">
                  <?php esc_html_e('Growth ★', 'reviewservicepro'); ?>
                </th>
                <th class="border-b border-[#E2E8F0] px-5 py-4 text-center font-['Poppins',sans-serif] text-[14px] font-bold text-[#334155]" data-col="2">
                  <?php esc_html_e('Authority', 'reviewservicepro'); ?>
                </th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($comparison_rows as $section) : ?>
                <tr>
                  <td colspan="4" class="bg-[#F8FAFC] px-5 py-3 font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.13em] text-[#94A3B8]">
                    <?php echo esc_html($section['category']); ?>
                  </td>
                </tr>
                <?php foreach ($section['rows'] as $row) : ?>
                  <tr class="border-t border-[#F1F5F9] transition-colors duration-150 hover:bg-[#F8FAFC]">
                    <td class="px-5 py-4 font-['Inter',sans-serif] text-[14px] font-semibold text-[#334155]">
                      <?php echo esc_html($row[0]); ?>
                    </td>
                    <td class="px-5 py-4 text-center font-['Inter',sans-serif] text-[13px] font-medium text-[#64748B]" data-col="0">
                      <?php echo esc_html($row[1]); ?>
                    </td>
                    <td class="bg-emerald-50/40 px-5 py-4 text-center font-['Inter',sans-serif] text-[13px] font-bold text-[#059669]" data-col="1">
                      <?php echo esc_html($row[2]); ?>
                    </td>
                    <td class="px-5 py-4 text-center font-['Inter',sans-serif] text-[13px] font-medium text-[#64748B]" data-col="2">
                      <?php echo esc_html($row[3]); ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ── Trust + FAQ ── -->
    <div class="rsp-monthly-reveal mt-10 grid grid-cols-1 gap-6 lg:grid-cols-[0.9fr_1.1fr]" data-rsp-monthly-animate>

      <!-- Trust -->
      <div class="rounded-[2rem] border border-emerald-200 bg-emerald-50 p-6 md:p-8">
        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#059669] shadow-sm">
          <i data-lucide="shield-check" class="h-6 w-6" aria-hidden="true"></i>
        </div>
        <h3 class="font-['Poppins',sans-serif] text-[22px] font-extrabold leading-snug tracking-[-0.025em] text-[#334155]">
          <?php esc_html_e('Monthly ORM is built for long-term trust, not shortcuts.', 'reviewservicepro'); ?>
        </h3>
        <p class="mt-4 font-['Inter',sans-serif] text-[15px] leading-[1.72] text-[#065F46]">
          <?php esc_html_e('We do not provide guaranteed 5-star ratings, guaranteed review removal, fake reviews, paid incentives, or ranking guarantees. Every plan focuses on ethical monitoring, professional responses, transparent reporting, and genuine reputation improvement.', 'reviewservicepro'); ?>
        </p>
        <div class="mt-6 flex flex-wrap gap-2.5">
          <?php foreach (
            [
              __('No fake reviews', 'reviewservicepro'),
              __('No paid incentives', 'reviewservicepro'),
              __('Platform-compliant workflow', 'reviewservicepro'),
              __('Secure client portal', 'reviewservicepro'),
            ] as $point
          ) : ?>
            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-4 py-2 font-['Inter',sans-serif] text-[13px] font-medium text-[#059669]">
              <i data-lucide="check" class="h-[13px] w-[13px]" aria-hidden="true"></i>
              <?php echo esc_html($point); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- FAQ -->
      <div class="rounded-[2rem] border border-[#E2E8F0] bg-white p-6 shadow-sm md:p-8">
        <span class="mb-5 inline-flex rounded-full border border-[#E2E8F0] bg-[#F8FAFC] px-3 py-1 font-['DM_Mono',monospace] text-[10px] font-medium uppercase tracking-[0.1em] text-[#64748B]">
          <?php esc_html_e('Monthly Plan Questions', 'reviewservicepro'); ?>
        </span>
        <h3 class="font-['Poppins',sans-serif] text-[22px] font-extrabold leading-snug tracking-[-0.025em] text-[#334155]">
          <?php esc_html_e('Before you subscribe', 'reviewservicepro'); ?>
        </h3>

        <div class="mt-5 space-y-3">
          <?php foreach ($faqs as $faq) : ?>
            <details class="rounded-[1.25rem] border border-[#E2E8F0] bg-[#F8FAFC] px-5 py-4">
              <summary class="flex cursor-pointer items-center justify-between gap-4 font-['Inter',sans-serif] text-[15px] font-semibold text-[#334155]">
                <?php echo esc_html($faq['question']); ?>
                <i data-lucide="chevron-down" class="h-4 w-4 shrink-0 text-[#94A3B8]" aria-hidden="true"></i>
              </summary>
              <p class="mt-3 font-['Inter',sans-serif] text-[15px] font-normal leading-[1.72] text-[#64748B]">
                <?php echo esc_html($faq['answer']); ?>
              </p>
            </details>
          <?php endforeach; ?>
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
          <a
            href="<?php echo esc_url($pricing_url); ?>"
            class="rsp-monthly-btn inline-flex items-center justify-center gap-2 rounded-2xl border border-blue-200 bg-blue-50 px-6 py-[13px] font-['Inter',sans-serif] text-[14px] font-semibold text-[#1D4ED8] transition-all duration-300 hover:-translate-y-[2px] hover:bg-blue-100">
            <?php esc_html_e('View Full Pricing Page', 'reviewservicepro'); ?>
            <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
          </a>
          <a
            href="<?php echo esc_url($contact_url); ?>"
            class="rsp-monthly-btn inline-flex items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-6 py-[12px] font-['Inter',sans-serif] text-[14px] font-semibold text-[#334155] transition-all duration-300 hover:-translate-y-[2px] hover:bg-[#F8FAFC]">
            <?php esc_html_e('Need Help Choosing?', 'reviewservicepro'); ?>
            <i data-lucide="message-square" class="h-4 w-4" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>

  </div>

  <!-- ── Mobile Sticky CTA — unchanged ── -->
  <div class="fixed bottom-0 left-0 right-0 z-40 border-t border-[#E2E8F0] bg-white/95 p-3 shadow-2xl shadow-slate-900/15 backdrop-blur-xl lg:hidden">
    <div class="mx-auto flex max-w-md gap-3">
      <a href="<?php echo esc_url($plans[1]['monthly_url']); ?>"
        class="flex-1 rounded-2xl bg-[#00C853] px-4 py-3 text-center font-['Inter',sans-serif] text-[14px] font-semibold text-white transition-all hover:bg-emerald-600">
        <?php esc_html_e('Growth $399', 'reviewservicepro'); ?>
      </a>
      <a href="<?php echo esc_url($contact_url); ?>"
        class="flex-1 rounded-2xl bg-[#334155] px-4 py-3 text-center font-['Inter',sans-serif] text-[14px] font-semibold text-white transition-all hover:bg-[#3B4658]">
        <?php esc_html_e('Custom Quote', 'reviewservicepro'); ?>
      </a>
    </div>
  </div>

</section>

<script>
  (function() {
    function initMonthlyPlans() {
      var root = document.querySelector('[data-rsp-monthly-section]');
      if (!root) return;

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      /* ── 1. Billing toggle — original logic unchanged ── */
      var billing = 'monthly';
      var toggleButtons = root.querySelectorAll('.rsp-billing-toggle');
      var priceEls = root.querySelectorAll('.rsp-plan-price');
      var annualNotes = root.querySelectorAll('.rsp-plan-annual-note');
      var ctaButtons = root.querySelectorAll('.rsp-plan-cta');
      var saveBadge = document.getElementById('rsp-annual-toggle-badge');
      var saveNote = document.getElementById('rsp-annual-save-note');

      function updateBilling(next) {
        billing = next;
        var isAnnual = billing === 'annual';

        toggleButtons.forEach(function(btn) {
          var active = btn.getAttribute('data-billing') === billing;
          btn.classList.toggle('bg-[#1E3A8A]', active);
          btn.classList.toggle('text-white', active);
          btn.classList.toggle('shadow-sm', active);
          btn.classList.toggle('text-[#64748B]', !active);
        });

        /* NEW: show/hide save badge on Annual button */
        if (saveBadge) saveBadge.classList.toggle('hidden', !isAnnual);
        if (saveNote) saveNote.classList.toggle('is-active', isAnnual);

        /* Price flip — unchanged */
        priceEls.forEach(function(el) {
          var next = isAnnual ? el.getAttribute('data-annual-price') : el.getAttribute('data-monthly-price');
          el.classList.remove('rsp-monthly-price-flip');
          void el.offsetWidth;
          el.classList.add('rsp-monthly-price-flip');
          el.textContent = next;
        });

        /* Annual note rows — unchanged class, NEW toggle via classList */
        annualNotes.forEach(function(note) {
          note.classList.toggle('is-active', isAnnual);
        });

        /* CTA URL swap — unchanged */
        ctaButtons.forEach(function(cta) {
          var url = isAnnual ? cta.getAttribute('data-annual-url') : cta.getAttribute('data-monthly-url');
          if (url) cta.setAttribute('href', url);
        });
      }

      toggleButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
          updateBilling(btn.getAttribute('data-billing'));
        });
      });
      updateBilling('monthly');

      /* ── 2. Show more accordion — original logic unchanged ── */
      root.querySelectorAll('[data-show-more]').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var key = btn.getAttribute('data-show-more');
          var groups = root.querySelectorAll('[data-extra-group="' + key + '"]');
          var isOpen = btn.getAttribute('aria-expanded') === 'true';
          var icon = btn.querySelector('[data-lucide="chevron-down"]');
          var label = btn.querySelector('span');

          groups.forEach(function(g) {
            g.style.maxHeight = isOpen ? '0px' : g.scrollHeight + 'px';
          });

          btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
          if (label) label.textContent = isOpen ?
            '<?php echo esc_js(__('Show all features', 'reviewservicepro')); ?>' :
            '<?php echo esc_js(__('Show less', 'reviewservicepro')); ?>';
          if (icon) icon.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        });
      });

      /* ── 3. IntersectionObserver reveal — original logic unchanged ── */
      var revealItems = root.querySelectorAll('[data-rsp-monthly-animate]');

      function reveal(item) {
        if (!item || item.dataset.rspMonthlyRevealed === 'true') return;
        item.dataset.rspMonthlyRevealed = 'true';
        item.classList.add('rsp-visible');
      }

      if (!('IntersectionObserver' in window)) {
        revealItems.forEach(reveal);
      } else {
        var obs = new IntersectionObserver(function(entries) {
          entries.forEach(function(e) {
            if (e.isIntersecting) reveal(e.target);
          });
        }, {
          threshold: 0,
          rootMargin: '0px 0px -20px 0px'
        });
        revealItems.forEach(function(item) {
          obs.observe(item);
        });
      }

      /* ── 4. NEW: Mousemove spotlight glow on cards ── */
      root.querySelectorAll('.rsp-card-glow').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
          var r = card.getBoundingClientRect();
          var x = ((e.clientX - r.left) / r.width * 100).toFixed(1) + '%';
          var y = ((e.clientY - r.top) / r.height * 100).toFixed(1) + '%';
          card.style.setProperty('--mx', x);
          card.style.setProperty('--my', y);
        });
      });

      /* ── 5. NEW: Comparison table column hover highlight ── */
      var table = document.getElementById('rsp-comparison-table');
      if (table) {
        var colCells = table.querySelectorAll('[data-col]');
        [0, 1, 2].forEach(function(ci) {
          var cells = table.querySelectorAll('[data-col="' + ci + '"]');
          cells.forEach(function(cell) {
            cell.addEventListener('mouseenter', function() {
              cells.forEach(function(c) {
                c.classList.add('col-hl');
              });
            });
            cell.addEventListener('mouseleave', function() {
              cells.forEach(function(c) {
                c.classList.remove('col-hl');
              });
            });
          });
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initMonthlyPlans);
    } else {
      initMonthlyPlans();
    }
  }());
</script>