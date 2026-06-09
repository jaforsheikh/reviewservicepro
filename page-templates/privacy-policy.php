<?php

/**
 * Template Name: Privacy Policy
 *
 * ReviewService.Pro — Compact White SaaS Privacy Policy
 *
 * File: page-templates/privacy-policy.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$effective_date = 'January 1, 2025';
$last_updated   = date_i18n('F j, Y');
$company        = 'ReviewService.Pro';
$address        = '30 N Gould St Ste N, Sheridan, WY 82801';
$contact_email  = get_theme_mod('cta_email', 'privacy@reviewservice.pro');

$nav_sections = [
  'pp-intro'       => __('Introduction', 'reviewservicepro'),
  'pp-collect'     => __('Data We Collect', 'reviewservicepro'),
  'pp-use'         => __('How We Use Data', 'reviewservicepro'),
  'pp-security'    => __('Security', 'reviewservicepro'),
  'pp-third-party' => __('Third Parties', 'reviewservicepro'),
  'pp-ai'          => __('AI & Automation', 'reviewservicepro'),
  'pp-cookies'     => __('Cookies', 'reviewservicepro'),
  'pp-rights'      => __('Your Rights', 'reviewservicepro'),
  'pp-retention'   => __('Retention', 'reviewservicepro'),
  'pp-contact'     => __('Contact', 'reviewservicepro'),
];

$policy_sections = [
  [
    'id'    => 'pp-intro',
    'icon'  => 'shield-check',
    'title' => __('Introduction', 'reviewservicepro'),
    'body'  => sprintf(
      /* translators: 1: company name */
      __('This Privacy Policy explains how %1$s collects, uses, protects, and shares information when you visit our website, contact our team, purchase services, or use our client portal. Our work focuses on ethical online reputation management, review monitoring, review response support, reporting, platform profile support, and related trust-building services.', 'reviewservicepro'),
      $company
    ),
  ],
  [
    'id'    => 'pp-collect',
    'icon'  => 'database',
    'title' => __('Information We May Collect', 'reviewservicepro'),
    'body'  => __('We may collect contact details, business details, billing information, website URLs, review platform links, service requests, support messages, order data, account information, and technical data such as browser type, device information, IP address, analytics events, and cookie preferences. We may also process review-related business information that you provide for service delivery.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-use',
    'icon'  => 'workflow',
    'title' => __('How We Use Information', 'reviewservicepro'),
    'body'  => __('We use information to respond to inquiries, provide requested services, manage orders, operate the client portal, prepare reports, support review monitoring workflows, improve website performance, communicate with clients, prevent abuse, comply with legal obligations, and maintain a secure and professional service experience.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-security',
    'icon'  => 'lock-keyhole',
    'title' => __('Security and Confidentiality', 'reviewservicepro'),
    'body'  => __('We use reasonable administrative, technical, and organizational safeguards to protect information. No online system can be guaranteed completely secure, but we work to reduce risk through access control, secure workflows, limited data access, and responsible handling of client information.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-third-party',
    'icon'  => 'share-2',
    'title' => __('Third-Party Services', 'reviewservicepro'),
    'body'  => __('We may use trusted third-party tools for hosting, analytics, payments, email delivery, CRM, security, advertising measurement, automation, and service operations. These providers may process information only as needed to support our services or comply with their own legal obligations.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-ai',
    'icon'  => 'bot',
    'title' => __('AI-Assisted Workflows', 'reviewservicepro'),
    'body'  => __('Some internal workflows may use AI-assisted tools to help summarize information, draft response frameworks, organize reporting, or identify operational patterns. We do not use AI to create fake reviews, manipulate ratings, or bypass platform policies. Human review and client context remain important parts of our service process.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-cookies',
    'icon'  => 'cookie',
    'title' => __('Cookies and Tracking', 'reviewservicepro'),
    'body'  => __('Our website may use cookies and similar technologies to support essential functionality, analytics, security, preference management, and marketing measurement. You can learn more in our Cookie Policy and manage preferences through your browser or available cookie tools.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-rights',
    'icon'  => 'user-check',
    'title' => __('Your Privacy Rights', 'reviewservicepro'),
    'body'  => __('Depending on your location, you may have rights to request access, correction, deletion, restriction, portability, or objection to certain processing activities. You may also request that we stop sending non-essential communications. We may need to verify your identity before fulfilling certain requests.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-retention',
    'icon'  => 'archive',
    'title' => __('Data Retention', 'reviewservicepro'),
    'body'  => __('We retain information only as long as reasonably needed for service delivery, business records, security, legal compliance, dispute resolution, accounting, and legitimate operational needs. Retention periods may vary based on the type of information and service relationship.', 'reviewservicepro'),
  ],
  [
    'id'    => 'pp-contact',
    'icon'  => 'mail',
    'title' => __('Contact Us', 'reviewservicepro'),
    'body'  => sprintf(
      /* translators: 1: email, 2: address */
      __('For privacy questions or requests, contact us at %1$s. Business address: %2$s.', 'reviewservicepro'),
      $contact_email,
      $address
    ),
  ],
];

get_header();
?>

<div id="privacy-policy-page" class="rsp-page-shell relative overflow-hidden bg-[#F8FAFC] px-5 py-14 sm:px-6 lg:px-8 lg:py-16">

  <style>
    .rsp-page-shell {
      --rsp-title: #334155;
      --rsp-heading: #3B4658;
      --rsp-body: #64748B;
      --rsp-blue: #2563EB;
      --rsp-green: #00C853;
      --rsp-border: rgba(148, 163, 184, 0.24);
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .rsp-page-shell h1,
    .rsp-page-shell h2,
    .rsp-page-shell h3,
    .rsp-page-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-heading);
      letter-spacing: -0.035em;
    }

    .rsp-page-title {
      max-width: 860px;
      color: var(--rsp-title);
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(36px, 4.4vw, 48px);
      font-weight: 800;
      line-height: 1.08;
      letter-spacing: -0.05em;
      text-wrap: balance;
    }

    .rsp-page-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border-radius: 999px;
      border: 1px solid rgba(37, 99, 235, 0.20);
      background: rgba(37, 99, 235, 0.06);
      padding: 8px 14px;
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: #2563EB;
    }

    .rsp-page-text {
      color: var(--rsp-body);
      font-size: 16px;
      font-weight: 400;
      line-height: 1.78;
    }

    .rsp-page-card {
      border: 1px solid var(--rsp-border);
      border-radius: 24px;
      background: #ffffff;
      box-shadow: 0 16px 48px rgba(15, 23, 42, 0.06);
      transition:
        transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 240ms ease,
        border-color 240ms ease;
    }

    .rsp-page-card:hover {
      transform: translateY(-3px);
      border-color: rgba(37, 99, 235, 0.24);
      box-shadow: 0 22px 64px rgba(15, 23, 42, 0.09);
    }

    .rsp-page-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 240ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 240ms ease,
        background-color 240ms ease,
        border-color 240ms ease;
    }

    .rsp-page-btn::before {
      content: "";
      position: absolute;
      inset: 0;
      transform: translateX(-110%);
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.32), transparent);
      transition: transform 640ms ease;
    }

    .rsp-page-btn:hover {
      transform: translateY(-2px);
    }

    .rsp-page-btn:hover::before {
      transform: translateX(110%);
    }

    .rsp-page-reveal {
      opacity: 0;
      transform: translateY(18px);
      animation: rspPageReveal 680ms cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .rsp-page-prose h2 {
      margin-top: 0;
      margin-bottom: 14px;
      font-size: clamp(22px, 2.4vw, 30px);
      font-weight: 800;
      line-height: 1.18;
    }

    .rsp-page-prose h3 {
      margin-top: 22px;
      margin-bottom: 10px;
      font-size: 20px;
      font-weight: 800;
      line-height: 1.25;
    }

    .rsp-page-prose p,
    .rsp-page-prose li {
      color: #64748B;
      font-size: 16px;
      line-height: 1.78;
    }

    .rsp-page-prose ul,
    .rsp-page-prose ol {
      margin: 16px 0 0;
      padding-left: 22px;
    }

    .rsp-page-prose a {
      color: #2563EB;
      font-weight: 800;
      text-decoration: none;
    }

    .rsp-page-prose a:hover {
      text-decoration: underline;
    }

    @keyframes rspPageReveal {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 640px) {
      .rsp-page-title {
        font-size: clamp(34px, 10vw, 42px);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      .rsp-page-shell *,
      .rsp-page-shell *::before,
      .rsp-page-shell *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
      }

      .rsp-page-reveal {
        opacity: 1;
        transform: none;
      }

      .rsp-page-card:hover,
      .rsp-page-btn:hover {
        transform: none;
      }
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.028)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.028)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">
    <section class="rsp-page-reveal mx-auto max-w-4xl text-center">
      <span class="rsp-page-kicker">
        <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
        <?php esc_html_e('Privacy Policy', 'reviewservicepro'); ?>
      </span>

      <h1 class="rsp-page-title mx-auto mt-5">
        <?php esc_html_e('Privacy practices for responsible reputation management.', 'reviewservicepro'); ?>
      </h1>

      <p class="rsp-page-text mx-auto mt-5 max-w-3xl">
        <?php esc_html_e('Clear, practical information about how ReviewService.Pro handles website, client, service, and portal data.', 'reviewservicepro'); ?>
      </p>

      <div class="mt-6 flex flex-wrap justify-center gap-3">
        <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-[#64748B]">
          <?php esc_html_e('Effective:', 'reviewservicepro'); ?> <?php echo esc_html($effective_date); ?>
        </span>
        <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-[#64748B]">
          <?php esc_html_e('Updated:', 'reviewservicepro'); ?> <?php echo esc_html($last_updated); ?>
        </span>
      </div>
    </section>

    <div class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-[280px_1fr] lg:items-start">
      <aside class="rsp-page-reveal lg:sticky lg:top-28">
        <div class="rsp-page-card p-5">
          <h2 class="text-lg font-[800]"><?php esc_html_e('Policy Sections', 'reviewservicepro'); ?></h2>
          <nav class="mt-4 grid gap-2" aria-label="<?php echo esc_attr__('Privacy policy sections', 'reviewservicepro'); ?>">
            <?php foreach ($nav_sections as $id => $label) : ?>
              <a href="#<?php echo esc_attr($id); ?>" class="rounded-xl px-3 py-2 text-sm font-bold text-[#64748B] transition hover:bg-blue-50 hover:text-blue-700">
                <?php echo esc_html($label); ?>
              </a>
            <?php endforeach; ?>
          </nav>
        </div>
      </aside>

      <div class="grid gap-5">
        <?php foreach ($policy_sections as $index => $section) : ?>
          <section id="<?php echo esc_attr($section['id']); ?>" class="rsp-page-card rsp-page-prose rsp-page-reveal p-6 md:p-8" style="animation-delay: <?php echo esc_attr((string) min($index * 45, 360)); ?>ms;">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
              <i data-lucide="<?php echo esc_attr($section['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </div>
            <h2><?php echo esc_html($section['title']); ?></h2>
            <p><?php echo esc_html($section['body']); ?></p>
          </section>
        <?php endforeach; ?>

        <section class="rsp-page-card rsp-page-reveal border-blue-200 bg-blue-50/70 p-6 md:p-8">
          <h2 class="text-2xl font-[800]"><?php esc_html_e('Legal Review Recommended', 'reviewservicepro'); ?></h2>
          <p class="rsp-page-text mt-3">
            <?php esc_html_e('This page is a practical business privacy template. Review it with a qualified attorney before publishing if your business has specific legal, regional, or regulatory obligations.', 'reviewservicepro'); ?>
          </p>
        </section>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  })();
</script>

<?php
get_footer();
