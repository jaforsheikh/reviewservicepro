<?php

/**
 * Theme Footer
 *
 * File: footer.php
 *
 * ReviewService.Pro — Premium Dark Footer
 *
 * Includes:
 * - Footer PHP data arrays
 * - Footer-specific inline CSS
 * - Footer markup
 * - Vanilla JS animation
 * - Organization schema
 * - wp_footer()
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Safe footer URL helper.
 */
$footer_url = function ($url) {
  $url = (string) $url;

  if ('' === $url) {
    return home_url('/');
  }

  if (0 === strpos($url, '#')) {
    return $url;
  }

  if (preg_match('#^https?://#i', $url)) {
    return $url;
  }

  return home_url($url);
};

$address = get_theme_mod(
  'footer_address',
  '30 N Gould St Ste N, Sheridan, WY 82801'
);

$whatsapp_url = get_theme_mod(
  'footer_whatsapp_url',
  'https://wa.me/18077980758'
);

$audit_url = get_theme_mod(
  'footer_audit_url',
  '/contact/?type=audit'
);

$newsletter_shortcode = get_theme_mod(
  'footer_newsletter_shortcode',
  ''
);

$schema_logo_url = get_theme_mod(
  'footer_schema_logo_url',
  ''
);

$services = [
  [
    'label' => __('Reputation Audit', 'reviewservicepro'),
    'url'   => '/services/#one-time-packages',
    'icon'  => 'search-check',
  ],
  [
    'label' => __('Review Monitoring', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
    'icon'  => 'radar',
  ],
  [
    'label' => __('Review Response Management', 'reviewservicepro'),
    'url'   => '/services/#orm-system',
    'icon'  => 'message-square',
  ],
  [
    'label' => __('Negative Review Case Support', 'reviewservicepro'),
    'url'   => '/services/#one-time-packages',
    'icon'  => 'shield-alert',
  ],
  [
    'label' => __('Local Trust & SEO', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
    'icon'  => 'map-pin',
  ],
  [
    'label' => __('Monthly ORM Plans', 'reviewservicepro'),
    'url'   => '/services/#monthly-plans',
    'icon'  => 'calendar-check',
  ],
];

$company_links = [
  [
    'label' => __('About Us', 'reviewservicepro'),
    'url'   => '/about/',
  ],
  [
    'label' => __('Case Studies', 'reviewservicepro'),
    'url'   => '/case-studies/',
  ],
  [
    'label' => __('ORM Academy', 'reviewservicepro'),
    'url'   => '/orm-academy/',
    'badge' => __('Free', 'reviewservicepro'),
  ],
  [
    'label' => __('Pricing', 'reviewservicepro'),
    'url'   => '/pricing/',
  ],
  [
    'label' => __('Contact', 'reviewservicepro'),
    'url'   => '/contact/',
  ],
];

$legal_links = [
  [
    'label' => __('Privacy Policy', 'reviewservicepro'),
    'url'   => '/privacy-policy/',
  ],
  [
    'label' => __('Terms of Service', 'reviewservicepro'),
    'url'   => '/terms-of-service/',
  ],
  [
    'label' => __('Cookie Policy', 'reviewservicepro'),
    'url'   => '/cookie-policy/',
  ],
  [
    'label' => __('Ethical Policy', 'reviewservicepro'),
    'url'   => '/trust-center/',
    'badge' => __('Read', 'reviewservicepro'),
  ],
  [
    'label' => __('Disclaimer', 'reviewservicepro'),
    'url'   => '/disclaimer/',
  ],
];

$platform_links = [
  [
    'label' => __('Google & GBP', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
  ],
  [
    'label' => __('Trustpilot', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
  ],
  [
    'label' => __('Yelp', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
  ],
  [
    'label' => __('Facebook Reviews', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
  ],
  [
    'label' => __('25+ Review Platforms', 'reviewservicepro'),
    'url'   => '/services/#platforms-we-monitor',
  ],
];

$quick_links = [
  [
    'label' => __('Client Portal', 'reviewservicepro'),
    'url'   => '/my-account/',
    'icon'  => 'lock',
  ],
  [
    'label' => __('Free Audit', 'reviewservicepro'),
    'url'   => '/contact/?type=audit',
    'icon'  => 'search',
  ],
  [
    'label' => __('Monthly ORM Plans', 'reviewservicepro'),
    'url'   => '/services/#monthly-plans',
    'icon'  => 'calendar-check',
  ],
];

$trust_badges = [
  [
    'icon'  => 'shield-check',
    'label' => __('Ethical ORM', 'reviewservicepro'),
    'class' => 'border-[#00C853]/30 bg-[#00C853]/10 text-emerald-50',
  ],
  [
    'icon'  => 'badge-check',
    'label' => __('Platform-Compliant', 'reviewservicepro'),
    'class' => 'border-blue-400/30 bg-blue-500/10 text-blue-50',
  ],
  [
    'icon'  => 'ban',
    'label' => __('No Fake Reviews', 'reviewservicepro'),
    'class' => 'border-[#00C853]/30 bg-[#00C853]/10 text-emerald-50',
  ],
  [
    'icon'  => 'lock',
    'label' => __('Secure Portal', 'reviewservicepro'),
    'class' => 'border-blue-400/30 bg-blue-500/10 text-blue-50',
  ],
];

/**
 * WhatsApp intentionally removed from social row.
 * WhatsApp stays only inside contact/support block.
 */
$social_links = [
  [
    'label' => __('Facebook', 'reviewservicepro'),
    'url'   => 'https://www.facebook.com/reviewservice.pro/',
    'color' => '#1877F2',
    'svg'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12.06C22 6.48 17.52 2 11.94 2S2 6.48 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.84c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56v1.89h2.78l-.44 2.91h-2.34V22C18.34 21.24 22 17.08 22 12.06z"/></svg>',
  ],
  [
    'label' => __('LinkedIn', 'reviewservicepro'),
    'url'   => 'https://www.linkedin.com/company/reviewservicepro',
    'color' => '#0A66C2',
    'svg'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.58c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.13 1.44-2.13 2.94v5.68H9.35V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zm1.78 13.02H3.56V9h3.56v11.45zM22.22 0H1.77C.8 0 0 .77 0 1.72v20.56C0 23.23.8 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.72V1.72C24 .77 23.2 0 22.22 0z"/></svg>',
  ],
  [
    'label' => __('Instagram', 'reviewservicepro'),
    'url'   => 'https://www.instagram.com/reviewservice.pro/',
    'color' => '#E1306C',
    'svg'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.75 2h8.5A5.76 5.76 0 0 1 22 7.75v8.5A5.76 5.76 0 0 1 16.25 22h-8.5A5.76 5.76 0 0 1 2 16.25v-8.5A5.76 5.76 0 0 1 7.75 2zm0 2A3.75 3.75 0 0 0 4 7.75v8.5A3.75 3.75 0 0 0 7.75 20h8.5A3.75 3.75 0 0 0 20 16.25v-8.5A3.75 3.75 0 0 0 16.25 4h-8.5zm8.75 2.05a1.45 1.45 0 1 1 0 2.9 1.45 1.45 0 0 1 0-2.9zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/></svg>',
  ],
];

$bottom_legal = [
  __('Privacy', 'reviewservicepro')      => '/privacy-policy/',
  __('Terms', 'reviewservicepro')        => '/terms-of-service/',
  __('Cookies', 'reviewservicepro')      => '/cookie-policy/',
  __('Trust Center', 'reviewservicepro') => '/trust-center/',
  __('Disclaimer', 'reviewservicepro')   => '/disclaimer/',
];

$organization_schema = [
  '@context'    => 'https://schema.org',
  '@type'       => 'Organization',
  'name'        => 'ReviewService.Pro',
  'url'         => home_url('/'),
  'description' => 'ReviewService.Pro provides ethical AI-Driven Online Reputation Management services including review monitoring, review response management, reputation audit, negative review case support, and local trust signal support.',
  'address'     => [
    '@type'           => 'PostalAddress',
    'streetAddress'   => '30 N Gould St Ste N',
    'addressLocality' => 'Sheridan',
    'addressRegion'   => 'WY',
    'postalCode'      => '82801',
    'addressCountry'  => 'US',
  ],
  'sameAs'      => array_values(array_map(
    static function ($social) {
      return esc_url_raw($social['url']);
    },
    $social_links
  )),
];

if (! empty($schema_logo_url)) {
  $organization_schema['logo'] = esc_url_raw($schema_logo_url);
}
?>

<style>
  /**
   * ReviewService.Pro footer-only effects.
   * Background gradient stays unchanged; this only improves typography, motion, hover and spacing.
   */
  #site-footer {
    --rsp-footer-title: #ffffff;
    --rsp-footer-heading: #e2e8f0;
    --rsp-footer-body: #cbd5e1;
    --rsp-footer-muted: #94a3b8;
    --rsp-footer-blue: #2563EB;
    --rsp-footer-green: #00C853;
    --rsp-footer-card: rgba(255, 255, 255, 0.065);
    --rsp-footer-border: rgba(255, 255, 255, 0.11);
    isolation: isolate;
  }

  #site-footer,
  #site-footer p,
  #site-footer a,
  #site-footer li,
  #site-footer address,
  #site-footer input,
  #site-footer button {
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    text-rendering: geometricPrecision;
    -webkit-font-smoothing: antialiased;
  }

  #site-footer h2,
  #site-footer h3,
  #site-footer .rsp-footer-logo-text {
    font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  }

  #site-footer .rsp-footer-eyebrow,
  #site-footer .rsp-footer-column-title {
    font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
  }

  .rsp-footer-beam {
    animation: rspFooterBeamRun 6s ease-in-out infinite;
  }

  @keyframes rspFooterBeamRun {
    0% {
      left: -75%;
    }

    100% {
      left: 135%;
    }
  }

  .rsp-footer-separator-glow {
    position: absolute;
    left: 50%;
    top: 0;
    width: min(980px, 82vw);
    height: 1px;
    transform: translateX(-50%);
    background: linear-gradient(90deg,
        transparent,
        rgba(37, 99, 235, 0.95),
        rgba(0, 200, 83, 0.95),
        transparent);
    box-shadow:
      0 0 28px rgba(37, 99, 235, 0.52),
      0 0 48px rgba(0, 200, 83, 0.32);
  }

  .rsp-footer-top-vignette {
    position: absolute;
    inset: 0 0 auto 0;
    height: 180px;
    pointer-events: none;
    background:
      radial-gradient(circle at 22% 0%, rgba(37, 99, 235, 0.2), transparent 34%),
      radial-gradient(circle at 78% 0%, rgba(0, 200, 83, 0.14), transparent 32%),
      linear-gradient(180deg, rgba(2, 6, 23, 0.25), transparent);
  }

  .rsp-footer-aurora {
    position: absolute;
    inset: auto -22% -45% -22%;
    height: 440px;
    pointer-events: none;
    background:
      radial-gradient(circle at 28% 42%, rgba(37, 99, 235, 0.18), transparent 34%),
      radial-gradient(circle at 72% 45%, rgba(0, 200, 83, 0.13), transparent 32%),
      radial-gradient(circle at 50% 65%, rgba(20, 184, 166, 0.09), transparent 36%);
    filter: blur(50px);
    opacity: 0.78;
    animation: rspFooterAuroraMove 9s ease-in-out infinite alternate;
  }

  @keyframes rspFooterAuroraMove {
    0% {
      transform: translateX(-2%) translateY(0) scale(1);
      opacity: 0.55;
    }

    100% {
      transform: translateX(2%) translateY(-18px) scale(1.05);
      opacity: 0.92;
    }
  }

  .rsp-footer-grid-fade {
    mask-image: linear-gradient(to bottom, black 0%, black 72%, transparent 100%);
    -webkit-mask-image: linear-gradient(to bottom, black 0%, black 72%, transparent 100%);
  }

  .rsp-footer-reveal {
    opacity: 0;
    transform: translateY(26px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
      border-color 260ms ease,
      background-color 260ms ease,
      box-shadow 260ms ease;
  }

  .rsp-footer-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .rsp-footer-link {
    position: relative;
    width: fit-content;
  }

  .rsp-footer-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 2px;
    width: 0;
    height: 1px;
    border-radius: 999px;
    background: linear-gradient(90deg, #2563EB, #00C853);
    transition: width 260ms ease;
  }

  .rsp-footer-link:hover::after,
  .rsp-footer-link:focus-visible::after {
    width: 100%;
  }

  .rsp-footer-link-icon {
    transition:
      transform 240ms ease,
      color 240ms ease,
      opacity 240ms ease;
  }

  .rsp-footer-link:hover .rsp-footer-link-icon,
  .rsp-footer-link:focus-visible .rsp-footer-link-icon {
    transform: translateX(3px);
    color: var(--rsp-footer-green);
    opacity: 1;
  }

  .rsp-footer-motion-border {
    position: relative;
    isolation: isolate;
    overflow: hidden;
  }

  .rsp-footer-motion-border::before {
    content: "";
    position: absolute;
    inset: -115%;
    z-index: -2;
    border-radius: inherit;
    background: conic-gradient(from 0deg,
        rgba(37, 99, 235, 0.12),
        rgba(0, 200, 83, 0.34),
        rgba(20, 184, 166, 0.20),
        rgba(37, 99, 235, 0.30),
        rgba(37, 99, 235, 0.12));
    opacity: 0;
    transform: rotate(0deg);
    animation: rspFooterBorderSpin 7s linear infinite;
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  .rsp-footer-motion-border::after {
    content: "";
    position: absolute;
    inset: 1px;
    z-index: -1;
    border-radius: inherit;
    background: var(--rsp-footer-motion-inner, rgba(255, 255, 255, 0.065));
    pointer-events: none;
  }

  .rsp-footer-motion-border:hover::before,
  .rsp-footer-motion-border:focus-within::before {
    opacity: 1;
  }

  @keyframes rspFooterBorderSpin {
    to {
      transform: rotate(360deg);
    }
  }

  .rsp-footer-shine {
    position: relative;
    overflow: hidden;
  }

  .rsp-footer-shine::before {
    content: "";
    position: absolute;
    top: 0;
    left: -120%;
    z-index: 0;
    width: 72%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.34), transparent);
    transform: skewX(-18deg);
    transition: left 720ms ease;
    pointer-events: none;
  }

  .rsp-footer-shine:hover::before,
  .rsp-footer-shine:focus-visible::before {
    left: 135%;
  }

  .rsp-footer-social svg {
    width: 18px;
    height: 18px;
    display: block;
  }

  .rsp-footer-hover-card {
    transition:
      transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
      border-color 260ms ease,
      background-color 260ms ease,
      box-shadow 260ms ease;
  }

  .rsp-footer-hover-card:hover,
  .rsp-footer-hover-card:focus-within {
    transform: translateY(-4px);
    border-color: rgba(37, 99, 235, 0.38);
    background-color: rgba(255, 255, 255, 0.09);
    box-shadow: 0 20px 60px rgba(2, 6, 23, 0.24);
  }

  .rsp-footer-float {
    animation: rspFooterFloat 4s ease-in-out infinite;
  }

  @keyframes rspFooterFloat {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-4px);
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .rsp-footer-beam,
    .rsp-footer-float,
    .rsp-footer-aurora,
    .rsp-footer-motion-border::before {
      animation: none !important;
    }

    .rsp-footer-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-footer-shine::before {
      display: none;
    }
  }
</style>

</main>

<footer
  id="site-footer"
  class="relative overflow-hidden bg-[linear-gradient(180deg,#020617_0%,#020817_34%,#03111f_72%,#020617_100%)] font-sans text-white"
  role="contentinfo"
  aria-label="<?php esc_attr_e('ReviewService.Pro site footer', 'reviewservicepro'); ?>"
  data-rsp-footer>

  <!-- Background / visual separation -->
  <div class="rsp-footer-separator-glow z-[1]" aria-hidden="true"></div>
  <div class="rsp-footer-top-vignette z-0" aria-hidden="true"></div>
  <div class="rsp-footer-aurora z-0" aria-hidden="true"></div>

  <div class="rsp-footer-grid-fade pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.03)_1px,transparent_1px)] bg-[size:48px_48px]"></div>

  <div class="pointer-events-none absolute -left-36 -top-44 z-0 h-[560px] w-[560px] rounded-full bg-blue-600/[0.11] blur-[125px]"></div>
  <div class="pointer-events-none absolute -bottom-28 -right-28 z-0 h-[500px] w-[500px] rounded-full bg-[#00C853]/[0.10] blur-[125px]"></div>

  <div
    id="rsp-footer-mouse-glow"
    class="pointer-events-none absolute left-1/2 top-1/2 z-0 h-[540px] w-[540px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-[radial-gradient(circle,rgba(37,99,235,0.075),transparent_65%)] transition-[left,top] duration-150 ease-linear"
    aria-hidden="true"></div>

  <!-- Moving top beam -->
  <div class="relative z-10 h-px overflow-hidden bg-white/[0.08]" aria-hidden="true">
    <div class="rsp-footer-beam absolute top-0 h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
  </div>

  <!-- Newsletter -->
  <section
    class="relative z-10 border-b border-white/[0.08] bg-[linear-gradient(90deg,rgba(37,99,235,0.04),transparent_62%,rgba(0,200,83,0.03))] py-8 md:py-9"
    aria-label="<?php esc_attr_e('Newsletter signup', 'reviewservicepro'); ?>">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
      <div class="rsp-footer-motion-border grid gap-6 rounded-[1.5rem] border border-white/[0.10] bg-white/[0.045] p-5 shadow-[0_18px_70px_rgba(2,6,23,0.24)] md:p-6 lg:grid-cols-[1fr_0.9fr] lg:items-center" style="--rsp-footer-motion-inner:rgba(255,255,255,0.045);">

        <div class="rsp-footer-reveal max-w-2xl" data-rsp-footer-reveal>
          <span class="rsp-footer-eyebrow mb-3 inline-flex items-center gap-2 rounded-full border border-blue-400/25 bg-blue-500/10 px-3 py-1.5 text-[11px] font-[800] uppercase tracking-[0.14em] text-blue-200">
            <i data-lucide="mail-check" class="h-3.5 w-3.5" aria-hidden="true"></i>
            <?php esc_html_e('Weekly trust insights', 'reviewservicepro'); ?>
          </span>

          <h2 class="text-[1.25rem] font-[800] leading-7 tracking-[-0.035em] text-white! md:text-[1.55rem]">
            <?php esc_html_e('Get Weekly ORM Tips — Free', 'reviewservicepro'); ?>
          </h2>

          <p class="mt-2 max-w-2xl text-[16px] font-medium leading-8 text-slate-300">
            <?php esc_html_e('Reputation strategies, platform updates, and response templates. Straight to your inbox.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rsp-footer-reveal lg:justify-self-end" data-rsp-footer-reveal>
          <?php if (! empty($newsletter_shortcode)) : ?>
            <?php echo do_shortcode(wp_kses_post($newsletter_shortcode)); ?>
          <?php else : ?>
            <form
              class="flex flex-col gap-3 sm:flex-row"
              action="<?php echo esc_url(home_url('/contact/')); ?>"
              method="get"
              aria-label="<?php esc_attr_e('Subscribe to ORM tips newsletter', 'reviewservicepro'); ?>">

              <input type="hidden" name="type" value="newsletter">

              <label class="sr-only" for="footer-newsletter-email">
                <?php esc_html_e('Email address', 'reviewservicepro'); ?>
              </label>

              <input
                id="footer-newsletter-email"
                type="email"
                name="email"
                placeholder="<?php esc_attr_e('Your business email address', 'reviewservicepro'); ?>"
                autocomplete="email"
                required
                class="min-h-[52px] w-full rounded-2xl border border-white/[0.16] bg-white/[0.085] px-4 text-[16px] font-medium text-white outline-none transition-all duration-200 placeholder:text-slate-400 hover:border-white/35 focus:border-blue-400 focus:bg-blue-600/[0.10] focus:ring-4 focus:ring-blue-500/15 sm:w-[330px]">

              <button
                type="submit"
                class="rsp-footer-shine inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 text-[16px] font-[800] text-white shadow-[0_14px_34px_rgba(37,99,235,0.26)] transition-all duration-200 hover:-translate-y-1 hover:bg-blue-700 hover:shadow-blue-900/45 focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <i data-lucide="mail" class="h-4 w-4" aria-hidden="true"></i>
                  <?php esc_html_e('Subscribe', 'reviewservicepro'); ?>
                </span>
              </button>
            </form>
          <?php endif; ?>

          <p class="mt-3 text-sm font-medium leading-6 text-slate-400">
            <?php esc_html_e('✓ Free · No spam · Unsubscribe anytime', 'reviewservicepro'); ?>
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- Main Footer -->
  <div class="relative z-10 py-14 md:py-16">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-[1.55fr_1fr_1fr_1fr] lg:gap-12 xl:gap-14">

        <!-- Brand -->
        <div class="rsp-footer-reveal" data-rsp-footer-reveal>
          <a
            href="<?php echo esc_url(home_url('/')); ?>"
            class="inline-flex items-baseline rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/25"
            aria-label="<?php esc_attr_e('Go to ReviewService.Pro homepage', 'reviewservicepro'); ?>">

            <span class="rsp-footer-logo-text text-[2rem] font-medium leading-none tracking-[-0.06em] text-white sm:text-[2.35rem]">
              ReviewService<span class="text-[#00C853]">.Pro</span>
            </span>
          </a>

          <p class="mt-5 inline-block rounded-2xl border border-[#00C853]/30 bg-[#00C853]/10 px-4 py-3 text-[16px] font-medium italic leading-8 text-emerald-50 shadow-lg shadow-emerald-950/10">
            <?php esc_html_e('Ethical Online Reputation Management for businesses that grow through trust.', 'reviewservicepro'); ?>
          </p>

          <p class="mt-5 max-w-sm text-[16px] font-normal leading-8 text-slate-300">
            <?php esc_html_e('We help businesses build trust, improve visibility, and grow through ethical reputation management — no fake reviews, no manipulation, no shortcuts.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-5 flex items-start gap-2 text-[16px] font-medium leading-7 text-slate-300">
            <i data-lucide="map-pin" class="mt-1 h-4 w-4 shrink-0 text-[#00C853]" aria-hidden="true"></i>
            <address class="not-italic">
              <?php echo esc_html($address); ?>
            </address>
          </div>

          <div class="mt-6 flex flex-wrap gap-2" role="list" aria-label="<?php esc_attr_e('Service commitments', 'reviewservicepro'); ?>">
            <?php foreach ($trust_badges as $badge) : ?>
              <span
                class="<?php echo esc_attr($badge['class']); ?> rsp-footer-hover-card inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-[800]"
                role="listitem">

                <i data-lucide="<?php echo esc_attr($badge['icon']); ?>" class="h-3.5 w-3.5" aria-hidden="true"></i>
                <?php echo esc_html($badge['label']); ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Services + Company -->
        <div class="rsp-footer-reveal" data-rsp-footer-reveal>
          <h3 class="rsp-footer-column-title mb-4 border-b border-white/[0.12] pb-3 text-[11px] font-[800] uppercase tracking-[0.18em] text-blue-300">
            <?php esc_html_e('Services', 'reviewservicepro'); ?>
          </h3>

          <nav aria-label="<?php esc_attr_e('ORM services navigation', 'reviewservicepro'); ?>">
            <ul class="space-y-2" role="list">
              <?php foreach ($services as $service) : ?>
                <li>
                  <a
                    href="<?php echo esc_url($footer_url($service['url'])); ?>"
                    class="rsp-footer-link group inline-flex items-center gap-2 py-1.5 text-[16px] font-medium leading-7 text-slate-300 transition-colors duration-200 hover:text-[#00C853] focus:outline-none focus:text-[#00C853]">

                    <i data-lucide="<?php echo esc_attr($service['icon']); ?>" class="rsp-footer-link-icon h-4 w-4 shrink-0 text-slate-400" aria-hidden="true"></i>
                    <?php echo esc_html($service['label']); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>

          <h3 class="rsp-footer-column-title mb-4 mt-9 border-b border-white/[0.12] pb-3 text-[11px] font-[800] uppercase tracking-[0.18em] text-blue-300">
            <?php esc_html_e('Company', 'reviewservicepro'); ?>
          </h3>

          <nav aria-label="<?php esc_attr_e('Company navigation', 'reviewservicepro'); ?>">
            <ul class="space-y-2" role="list">
              <?php foreach ($company_links as $link) : ?>
                <li>
                  <a
                    href="<?php echo esc_url($footer_url($link['url'])); ?>"
                    class="rsp-footer-link inline-flex items-center gap-2 py-1.5 text-[16px] font-medium leading-7 text-slate-300 transition-colors duration-200 hover:text-[#00C853] focus:outline-none focus:text-[#00C853]">

                    <?php echo esc_html($link['label']); ?>

                    <?php if (! empty($link['badge'])) : ?>
                      <span class="rounded-full border border-[#00C853]/35 bg-[#00C853]/15 px-2 py-0.5 text-xs font-[800] text-emerald-50">
                        <?php echo esc_html($link['badge']); ?>
                      </span>
                    <?php endif; ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        </div>

        <!-- Legal + Platforms + Quick Access -->
        <div class="rsp-footer-reveal" data-rsp-footer-reveal>
          <h3 class="rsp-footer-column-title mb-4 border-b border-white/[0.12] pb-3 text-[11px] font-[800] uppercase tracking-[0.18em] text-blue-300">
            <?php esc_html_e('Legal', 'reviewservicepro'); ?>
          </h3>

          <nav aria-label="<?php esc_attr_e('Legal navigation', 'reviewservicepro'); ?>">
            <ul class="space-y-2" role="list">
              <?php foreach ($legal_links as $link) : ?>
                <li>
                  <a
                    href="<?php echo esc_url($footer_url($link['url'])); ?>"
                    class="rsp-footer-link inline-flex items-center gap-2 py-1.5 text-[16px] font-medium leading-7 text-slate-300 transition-colors duration-200 hover:text-[#00C853] focus:outline-none focus:text-[#00C853]">

                    <?php echo esc_html($link['label']); ?>

                    <?php if (! empty($link['badge'])) : ?>
                      <span class="rounded-full border border-[#00C853]/35 bg-[#00C853]/15 px-2 py-0.5 text-xs font-[800] text-emerald-50">
                        <?php echo esc_html($link['badge']); ?>
                      </span>
                    <?php endif; ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>

          <h3 class="rsp-footer-column-title mb-4 mt-9 border-b border-white/[0.12] pb-3 text-[11px] font-[800] uppercase tracking-[0.18em] text-blue-300">
            <?php esc_html_e('Platforms', 'reviewservicepro'); ?>
          </h3>

          <nav aria-label="<?php esc_attr_e('Review platform links', 'reviewservicepro'); ?>">
            <ul class="space-y-2" role="list">
              <?php foreach ($platform_links as $link) : ?>
                <li>
                  <a
                    href="<?php echo esc_url($footer_url($link['url'])); ?>"
                    class="rsp-footer-link inline-flex items-center gap-2 py-1.5 text-[16px] font-medium leading-7 text-slate-300 transition-colors duration-200 hover:text-[#00C853] focus:outline-none focus:text-[#00C853]">

                    <?php echo esc_html($link['label']); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>

          <h3 class="rsp-footer-column-title mb-4 mt-9 border-b border-white/[0.12] pb-3 text-[11px] font-[800] uppercase tracking-[0.18em] text-blue-300">
            <?php esc_html_e('Quick Access', 'reviewservicepro'); ?>
          </h3>

          <nav aria-label="<?php esc_attr_e('Quick access links', 'reviewservicepro'); ?>">
            <ul class="space-y-2" role="list">
              <?php foreach ($quick_links as $link) : ?>
                <li>
                  <a
                    href="<?php echo esc_url($footer_url($link['url'])); ?>"
                    class="rsp-footer-link group inline-flex items-center gap-2 py-1.5 text-[16px] font-medium leading-7 text-slate-300 transition-colors duration-200 hover:text-[#00C853] focus:outline-none focus:text-[#00C853]">

                    <i data-lucide="<?php echo esc_attr($link['icon']); ?>" class="rsp-footer-link-icon h-4 w-4 shrink-0 text-slate-400" aria-hidden="true"></i>
                    <?php echo esc_html($link['label']); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        </div>

        <!-- CTA + WhatsApp + Social -->
        <div class="rsp-footer-reveal" data-rsp-footer-reveal>
          <div
            id="rsp-footer-cta-card"
            class="rsp-footer-motion-border rsp-footer-float relative mb-5 rounded-2xl border border-blue-400/30 bg-white/[0.065] p-5 shadow-2xl shadow-blue-950/10 transition-all duration-300 hover:border-blue-400/50 hover:bg-white/[0.085] hover:shadow-blue-900/20"
            style="--rsp-footer-motion-inner:rgba(255,255,255,0.065);">

            <div class="relative z-10">
              <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)] opacity-80"></div>

              <h3 class="text-[1.05rem] font-[800] leading-snug tracking-[-0.025em] text-white!">
                <?php esc_html_e('Need help improving your reputation?', 'reviewservicepro'); ?>
              </h3>

              <p class="mt-3 text-[16px] font-normal leading-8 text-slate-300">
                <?php esc_html_e("Book a free reputation audit — no obligation, no hard sell. We'll show you exactly where you stand and what to fix first.", 'reviewservicepro'); ?>
              </p>

              <a
                href="<?php echo esc_url($footer_url($audit_url)); ?>"
                class="rsp-footer-shine mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#2563EB] px-5 py-3.5 text-[16px] font-[800] text-white shadow-lg shadow-blue-900/30 transition-all duration-200 hover:-translate-y-1 hover:bg-blue-700 hover:shadow-blue-900/45 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                aria-label="<?php esc_attr_e('Get a free reputation audit', 'reviewservicepro'); ?>">

                <span class="relative z-10 inline-flex items-center gap-2">
                  <i data-lucide="search" class="h-4 w-4" aria-hidden="true"></i>
                  <?php esc_html_e('Get Free Audit', 'reviewservicepro'); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </div>

          <!-- WhatsApp is contact/support block only, not social row -->
          <div class="rsp-footer-hover-card mb-5 flex items-center gap-3 rounded-2xl border border-[#25D366]/30 bg-[#25D366]/10 p-4 shadow-lg shadow-emerald-950/10">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#25D366]/30 bg-[#25D366]/10 text-white">
              <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" aria-hidden="true">
                <path d="M17.47 14.382c-.294-.148-1.74-.857-2.01-.955-.27-.099-.467-.148-.663.148-.196.295-.76.956-.932 1.152-.172.197-.344.222-.638.074-1.74-.87-2.882-1.552-4.027-3.52-.304-.524.304-.487.868-1.622.099-.196.05-.37-.025-.518-.074-.148-.663-1.597-.908-2.186-.24-.573-.483-.494-.663-.503-.172-.009-.37-.011-.567-.011-.197 0-.517.074-.787.37-.27.295-1.032 1.009-1.032 2.458 0 1.449 1.056 2.848 1.203 3.045.148.196 2.076 3.168 5.034 4.44.703.304 1.252.485 1.68.62.706.224 1.348.192 1.856.116.566-.083 1.74-.71 1.987-1.396.246-.686.246-1.275.172-1.398-.074-.123-.27-.197-.566-.345zm-5.42 7.403h-.004c-1.545-.001-3.065-.415-4.393-1.2l-.315-.187-3.267.856.872-3.185-.205-.327c-.86-1.367-1.315-2.948-1.313-4.572.002-4.731 3.856-8.583 8.59-8.583 2.294.001 4.451.895 6.073 2.519 1.622 1.624 2.514 3.782 2.513 6.077-.002 4.732-3.856 8.583-8.59 8.583zm7.31-15.891C17.208 4.139 14.85 3.2 12.322 3.2c-4.78 0-8.671 3.887-8.673 8.666-.001 1.526.398 3.016 1.157 4.33L3.2 20.8l4.724-1.239c1.265.69 2.69 1.054 4.139 1.054h.004c4.78 0 8.671-3.887 8.673-8.666.001-2.317-.898-4.495-2.532-6.131z" />
              </svg>
            </div>

            <div>
              <p class="text-[16px] font-[800] leading-6 text-white">
                <?php esc_html_e('WhatsApp Support', 'reviewservicepro'); ?>
              </p>

              <a
                href="<?php echo esc_url($whatsapp_url); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="text-[16px] font-medium leading-7 text-slate-300 transition-colors duration-200 hover:text-[#00C853]"
                aria-label="<?php esc_attr_e('Chat with ReviewService.Pro on WhatsApp', 'reviewservicepro'); ?>">

                <?php esc_html_e('+1 (807) 798-0758', 'reviewservicepro'); ?>
              </a>
            </div>
          </div>

          <h3 class="rsp-footer-column-title mb-3 text-[11px] font-[800] uppercase tracking-[0.18em] text-blue-300">
            <?php esc_html_e('Follow', 'reviewservicepro'); ?>
          </h3>

          <div class="flex flex-wrap items-center gap-3" role="list" aria-label="<?php esc_attr_e('Social media links', 'reviewservicepro'); ?>">
            <?php foreach ($social_links as $social) : ?>
              <a
                href="<?php echo esc_url($social['url']); ?>"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?php echo esc_attr($social['label']); ?>"
                class="rsp-footer-social rsp-footer-hover-card flex h-11 w-11 items-center justify-center rounded-xl border border-white/[0.16] bg-white/[0.07] shadow-lg shadow-black/10 transition-all duration-300 hover:-translate-y-1 hover:scale-105 hover:border-white/30 hover:bg-white/[0.14] focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                role="listitem">

                <span
                  class="flex h-5 w-5 items-center justify-center"
                  style="color: <?php echo esc_attr($social['color']); ?>;"
                  aria-hidden="true">
                  <?php
                  echo wp_kses(
                    $social['svg'],
                    [
                      'svg' => [
                        'viewBox'     => true,
                        'fill'        => true,
                        'aria-hidden' => true,
                        'class'       => true,
                        'xmlns'       => true,
                      ],
                      'path' => [
                        'd'    => true,
                        'fill' => true,
                      ],
                    ]
                  );
                  ?>
                </span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Compliance Strip -->
  <div
    class="relative z-10 border-t border-amber-400/[0.14] bg-amber-400/[0.028] py-4"
    role="note"
    aria-label="<?php esc_attr_e('Service compliance disclaimer', 'reviewservicepro'); ?>">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
      <p class="mx-auto max-w-5xl text-center text-sm font-medium leading-7 text-slate-300">
        <?php esc_html_e('ReviewService.Pro provides ethical online reputation management services. We do not offer, sell, or facilitate fake reviews, paid review incentives, rating manipulation, guaranteed negative review removal, guaranteed 5-star ratings, or any practice that violates platform terms of service. Case study results are scenario-based illustrations and are not guaranteed outcomes.', 'reviewservicepro'); ?>
      </p>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="relative z-10 border-t border-white/[0.08] py-5">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
      <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <p class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm font-medium leading-6 text-slate-400">
          <span>&copy; <?php echo esc_html(date_i18n('Y')); ?></span>

          <a href="<?php echo esc_url(home_url('/')); ?>" class="font-[800] text-white transition-colors duration-200 hover:text-[#00C853]">
            <?php esc_html_e('ReviewService.Pro', 'reviewservicepro'); ?>
          </a>

          <span class="text-white/40">·</span>
          <span><?php esc_html_e('All rights reserved', 'reviewservicepro'); ?></span>
          <span class="text-white/40">·</span>
          <span><?php esc_html_e('Sheridan, WY 82801, USA', 'reviewservicepro'); ?></span>
        </p>

        <nav aria-label="<?php esc_attr_e('Bottom legal links', 'reviewservicepro'); ?>">
          <ul class="flex flex-wrap gap-x-5 gap-y-2" role="list">
            <?php foreach ($bottom_legal as $label => $url) : ?>
              <li>
                <a
                  href="<?php echo esc_url($footer_url($url)); ?>"
                  class="text-sm font-medium text-slate-400 transition-colors duration-200 hover:text-[#00C853]">
                  <?php echo esc_html($label); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</footer>

<script type="application/ld+json">
  <?php echo wp_json_encode($organization_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
  (function() {
    function initReviewServiceFooter() {
      var footer = document.querySelector('[data-rsp-footer]');

      if (!footer) {
        return;
      }

      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var revealItems = footer.querySelectorAll('[data-rsp-footer-reveal]');

      function revealItem(item) {
        if (!item || item.dataset.rspFooterVisible === 'true') {
          return;
        }

        item.dataset.rspFooterVisible = 'true';
        item.classList.add('rsp-is-visible');
      }

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              revealItem(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -30px 0px'
        });

        revealItems.forEach(function(item, index) {
          item.style.transitionDelay = Math.min(index * 70, 420) + 'ms';
          observer.observe(item);
        });
      } else {
        revealItems.forEach(revealItem);
      }

      var mouseGlow = document.getElementById('rsp-footer-mouse-glow');
      var reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      if (mouseGlow && !reducedMotion) {
        var rafId = null;
        var nextX = '50%';
        var nextY = '50%';

        function updateGlow() {
          mouseGlow.style.left = nextX;
          mouseGlow.style.top = nextY;
          rafId = null;
        }

        footer.addEventListener('mousemove', function(event) {
          var rect = footer.getBoundingClientRect();
          nextX = (event.clientX - rect.left) + 'px';
          nextY = (event.clientY - rect.top) + 'px';

          if (!rafId) {
            rafId = window.requestAnimationFrame(updateGlow);
          }
        }, {
          passive: true
        });

        footer.addEventListener('mouseleave', function() {
          nextX = '50%';
          nextY = '50%';

          if (!rafId) {
            rafId = window.requestAnimationFrame(updateGlow);
          }
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initReviewServiceFooter);
    } else {
      initReviewServiceFooter();
    }
  })();
</script>

<?php wp_footer(); ?>

</body>

</html>