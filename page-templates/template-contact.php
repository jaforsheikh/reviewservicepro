<?php

/**
 * Template Name: ReviewService.Pro Contact Page
 *
 * ReviewService.Pro — Compact White SaaS Contact Page
 *
 * File: page-templates/template-contact.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$support_email = 'support@reviewservice.pro';
$phone_display = '+1 (807) 798 0758';
$phone_tel     = '+18077980758';
$whatsapp_url  = 'https://wa.me/18077980758';
$address       = '30 N Gould St Ste N, Sheridan, WY 82801';

$instagram_url = 'https://www.instagram.com/reputation.management.pro/';
$facebook_url  = 'https://www.facebook.com/reviewservice.pro/';
$x_url         = 'https://x.com/reviewservicepr';
$linkedin_url  = 'https://www.linkedin.com/company/reviewservicepro';

$current_page_url = get_permalink(get_queried_object_id());

if (! $current_page_url) {
  $current_page_url = home_url('/contact/');
}

$contact_form_url = $current_page_url . '#contact-form';
$audit_url        = add_query_arg('type', 'free-audit', $current_page_url) . '#contact-form';

$form_notice_type = '';
$form_notice_text = '';

$form_values = [
  'full_name'        => '',
  'business_name'    => '',
  'email'            => '',
  'phone'            => '',
  'website_url'      => '',
  'service_interest' => isset($_GET['type']) ? sanitize_text_field(wp_unslash($_GET['type'])) : '',
  'review_platform'  => '',
  'message'          => '',
];

if (isset($_GET['contact_status']) && 'success' === sanitize_text_field(wp_unslash($_GET['contact_status']))) {
  $form_notice_type = 'success';
  $form_notice_text = __('Thank you. Your request has been received. Our team will review your details and respond as soon as possible.', 'reviewservicepro');
}

if (
  'POST' === $_SERVER['REQUEST_METHOD']
  && isset($_POST['rsp_contact_action'])
  && 'submit_contact_request' === sanitize_text_field(wp_unslash($_POST['rsp_contact_action']))
) {
  $nonce = isset($_POST['rsp_contact_nonce']) ? sanitize_text_field(wp_unslash($_POST['rsp_contact_nonce'])) : '';

  $form_values = [
    'full_name'        => isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '',
    'business_name'    => isset($_POST['business_name']) ? sanitize_text_field(wp_unslash($_POST['business_name'])) : '',
    'email'            => isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '',
    'phone'            => isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '',
    'website_url'      => isset($_POST['website_url']) ? esc_url_raw(wp_unslash($_POST['website_url'])) : '',
    'service_interest' => isset($_POST['service_interest']) ? sanitize_text_field(wp_unslash($_POST['service_interest'])) : '',
    'review_platform'  => isset($_POST['review_platform']) ? sanitize_text_field(wp_unslash($_POST['review_platform'])) : '',
    'message'          => isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '',
  ];

  $honeypot = isset($_POST['rsp_company_site']) ? sanitize_text_field(wp_unslash($_POST['rsp_company_site'])) : '';

  if (! empty($honeypot)) {
    $form_notice_type = 'error';
    $form_notice_text = __('Something went wrong. Please try again.', 'reviewservicepro');
  } elseif (! wp_verify_nonce($nonce, 'rsp_contact_form_action')) {
    $form_notice_type = 'error';
    $form_notice_text = __('Security check failed. Please refresh the page and try again.', 'reviewservicepro');
  } elseif (empty($form_values['full_name']) || empty($form_values['email']) || empty($form_values['message'])) {
    $form_notice_type = 'error';
    $form_notice_text = __('Please fill in your name, email address, and message.', 'reviewservicepro');
  } elseif (! is_email($form_values['email'])) {
    $form_notice_type = 'error';
    $form_notice_text = __('Please enter a valid email address.', 'reviewservicepro');
  } else {
    $email_subject = sprintf(
      /* translators: %s: business name */
      __('New ReviewService.Pro inquiry from %s', 'reviewservicepro'),
      $form_values['business_name'] ? $form_values['business_name'] : $form_values['full_name']
    );

    $email_body  = "New contact request from ReviewService.Pro\n\n";
    $email_body .= "Name: " . $form_values['full_name'] . "\n";
    $email_body .= "Business: " . $form_values['business_name'] . "\n";
    $email_body .= "Email: " . $form_values['email'] . "\n";
    $email_body .= "Phone: " . $form_values['phone'] . "\n";
    $email_body .= "Website: " . $form_values['website_url'] . "\n";
    $email_body .= "Service Interest: " . $form_values['service_interest'] . "\n";
    $email_body .= "Review Platform: " . $form_values['review_platform'] . "\n\n";
    $email_body .= "Message:\n" . $form_values['message'] . "\n\n";
    $email_body .= "Page: " . $current_page_url . "\n";

    $headers = [
      'Content-Type: text/plain; charset=UTF-8',
      'Reply-To: ' . $form_values['full_name'] . ' <' . $form_values['email'] . '>',
    ];

    $sent = wp_mail($support_email, $email_subject, $email_body, $headers);

    if ($sent) {
      wp_safe_redirect(add_query_arg('contact_status', 'success', $current_page_url) . '#contact-form');
      exit;
    }

    $form_notice_type = 'error';
    $form_notice_text = __('Your message could not be sent right now. Please email us directly at support@reviewservice.pro.', 'reviewservicepro');
  }
}

$service_options = [
  ''                              => __('Select a service', 'reviewservicepro'),
  'free-audit'                    => __('Free Reputation Audit', 'reviewservicepro'),
  'online-reputation-management'  => __('Online Reputation Management', 'reviewservicepro'),
  'ai-review-monitoring'          => __('AI-Driven Review Monitoring', 'reviewservicepro'),
  'review-response-management'    => __('Review Response Management', 'reviewservicepro'),
  'negative-review-case-support'  => __('Negative Review Case Support', 'reviewservicepro'),
  'google-business-profile'       => __('Google Business Profile Support', 'reviewservicepro'),
  'monthly-reporting'             => __('Monthly ORM Reporting', 'reviewservicepro'),
  'wordpress-development'         => __('WordPress Website Design & Development', 'reviewservicepro'),
];

$platform_options = [
  ''                         => __('Select a platform', 'reviewservicepro'),
  'google-business-profile'  => __('Google Business Profile / Google Maps', 'reviewservicepro'),
  'facebook'                 => __('Facebook Reviews', 'reviewservicepro'),
  'trustpilot'               => __('Trustpilot', 'reviewservicepro'),
  'yelp'                     => __('Yelp', 'reviewservicepro'),
  'tripadvisor'              => __('Tripadvisor', 'reviewservicepro'),
  'bbb'                      => __('BBB', 'reviewservicepro'),
  'g2-capterra'              => __('G2 / Capterra', 'reviewservicepro'),
  'multiple-platforms'       => __('Multiple platforms', 'reviewservicepro'),
  'not-sure'                 => __('Not sure yet', 'reviewservicepro'),
];

$contact_cards = [
  [
    'icon'  => 'mail',
    'title' => __('Email Support', 'reviewservicepro'),
    'text'  => $support_email,
    'url'   => 'mailto:' . $support_email,
  ],
  [
    'icon'  => 'phone',
    'title' => __('Phone', 'reviewservicepro'),
    'text'  => $phone_display,
    'url'   => 'tel:' . $phone_tel,
  ],
  [
    'icon'  => 'message-circle',
    'title' => __('WhatsApp', 'reviewservicepro'),
    'text'  => __('Start a direct conversation', 'reviewservicepro'),
    'url'   => $whatsapp_url,
  ],
  [
    'icon'  => 'map-pin',
    'title' => __('Business Address', 'reviewservicepro'),
    'text'  => $address,
    'url'   => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($address),
  ],
];

$social_links = [
  ['label' => 'Instagram', 'url' => $instagram_url, 'icon' => 'instagram'],
  ['label' => 'Facebook', 'url' => $facebook_url, 'icon' => 'facebook'],
  ['label' => 'X', 'url' => $x_url, 'icon' => 'twitter'],
  ['label' => 'LinkedIn', 'url' => $linkedin_url, 'icon' => 'linkedin'],
];

get_header();
?>

<div id="contact-page" class="rsp-page-shell relative overflow-hidden bg-[#F8FAFC] px-5 py-14 sm:px-6 lg:px-8 lg:py-16">

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

  <style>
    #contact-page .rsp-contact-field {
      min-height: 52px;
      width: 100%;
      border-radius: 16px;
      border: 1px solid rgba(148, 163, 184, 0.30);
      background: #ffffff;
      padding: 13px 15px;
      color: #334155;
      font-size: 16px;
      font-weight: 500;
      outline: none;
      transition: border-color 220ms ease, box-shadow 220ms ease;
    }

    #contact-page .rsp-contact-field:focus {
      border-color: rgba(37, 99, 235, 0.42);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }

    #contact-page textarea.rsp-contact-field {
      min-height: 150px;
      resize: vertical;
    }
  </style>

  <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.028)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.028)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">
    <section class="rsp-page-reveal grid grid-cols-1 gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
      <div>
        <span class="rsp-page-kicker">
          <i data-lucide="send" class="h-4 w-4" aria-hidden="true"></i>
          <?php esc_html_e('Contact ReviewService.Pro', 'reviewservicepro'); ?>
        </span>

        <h1 class="rsp-page-title mt-5">
          <?php esc_html_e('Let’s review your reputation gaps and next steps.', 'reviewservicepro'); ?>
        </h1>

        <p class="rsp-page-text mt-5 max-w-3xl">
          <?php esc_html_e('Tell us about your business, review platforms, and current reputation concerns. We will respond with a practical, compliance-safe direction.', 'reviewservicepro'); ?>
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row">
          <a href="<?php echo esc_url($audit_url); ?>" class="rsp-page-btn inline-flex min-h-[50px] items-center justify-center rounded-2xl bg-[#2563EB] px-6 py-3 font-bold text-white no-underline shadow-[0_14px_34px_rgba(37,99,235,0.22)] hover:bg-blue-700 hover:text-white">
            <span class="relative z-10"><?php esc_html_e('Request Free Audit', 'reviewservicepro'); ?></span>
          </a>
          <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-[50px] items-center justify-center rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-3 font-bold text-emerald-700 no-underline hover:bg-emerald-100">
            <?php esc_html_e('WhatsApp Support', 'reviewservicepro'); ?>
          </a>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <?php foreach ($contact_cards as $index => $card) : ?>
          <a href="<?php echo esc_url($card['url']); ?>" class="rsp-page-card rsp-page-reveal block p-5 no-underline" style="animation-delay: <?php echo esc_attr((string) min($index * 60, 240)); ?>ms;" <?php echo 0 === strpos($card['url'], 'http') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
            <span class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-100 bg-blue-50 text-blue-600">
              <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </span>
            <span class="block font-['Poppins',sans-serif] text-lg font-[800] text-[#3B4658]"><?php echo esc_html($card['title']); ?></span>
            <span class="mt-2 block text-sm font-medium leading-6 text-[#64748B]"><?php echo esc_html($card['text']); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-[0.75fr_1.25fr] lg:items-start">
      <aside class="rsp-page-card rsp-page-reveal p-6 md:p-7">
        <h2 class="text-2xl font-[800] leading-tight"><?php esc_html_e('Before you submit', 'reviewservicepro'); ?></h2>
        <ul class="mt-5 grid gap-3">
          <li class="flex gap-2 text-[15px] font-medium leading-7 text-[#64748B]">
            <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 flex-shrink-0 text-emerald-500" aria-hidden="true"></i>
            <?php esc_html_e('Share your main review platform or business profile link.', 'reviewservicepro'); ?>
          </li>
          <li class="flex gap-2 text-[15px] font-medium leading-7 text-[#64748B]">
            <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 flex-shrink-0 text-emerald-500" aria-hidden="true"></i>
            <?php esc_html_e('Mention if the issue is monitoring, response support, reporting, or case documentation.', 'reviewservicepro'); ?>
          </li>
          <li class="flex gap-2 text-[15px] font-medium leading-7 text-[#64748B]">
            <i data-lucide="check-circle-2" class="mt-1 h-4 w-4 flex-shrink-0 text-emerald-500" aria-hidden="true"></i>
            <?php esc_html_e('We do not provide fake reviews, rating manipulation, or guaranteed review removal.', 'reviewservicepro'); ?>
          </li>
        </ul>

        <div class="mt-6 border-t border-slate-200 pt-5">
          <h3 class="text-lg font-[800]"><?php esc_html_e('Follow us', 'reviewservicepro'); ?></h3>
          <div class="mt-4 flex flex-wrap gap-3">
            <?php foreach ($social_links as $social) : ?>
              <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-[#64748B] transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                <span class="sr-only"><?php echo esc_html($social['label']); ?></span>
                <i data-lucide="<?php echo esc_attr($social['icon']); ?>" class="h-4 w-4" aria-hidden="true"></i>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </aside>

      <div id="contact-form" class="rsp-page-card rsp-page-reveal p-6 md:p-8">
        <div class="mb-7 border-b border-slate-200 pb-5">
          <span class="rsp-page-kicker">
            <i data-lucide="clipboard-check" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('Request Details', 'reviewservicepro'); ?>
          </span>
          <h2 class="mt-4 text-3xl font-[800] leading-tight md:text-4xl">
            <?php esc_html_e('Send your reputation inquiry.', 'reviewservicepro'); ?>
          </h2>
          <p class="rsp-page-text mt-3">
            <?php esc_html_e('Use the form below and our team will review your request.', 'reviewservicepro'); ?>
          </p>
        </div>

        <?php if (! empty($form_notice_text)) : ?>
          <div class="<?php echo 'success' === $form_notice_type ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-red-200 bg-red-50 text-red-800'; ?> mb-5 rounded-2xl border px-4 py-3 text-sm font-bold">
            <?php echo esc_html($form_notice_text); ?>
          </div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url($contact_form_url); ?>" class="grid gap-5" data-rsp-form>
          <input type="hidden" name="rsp_contact_action" value="submit_contact_request">
          <input type="text" name="rsp_company_site" value="" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
          <?php wp_nonce_field('rsp_contact_form_action', 'rsp_contact_nonce'); ?>

          <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
              <label for="full_name" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Your Name', 'reviewservicepro'); ?> *</label>
              <input id="full_name" name="full_name" type="text" required class="rsp-contact-field" value="<?php echo esc_attr($form_values['full_name']); ?>" placeholder="<?php esc_attr_e('John Doe', 'reviewservicepro'); ?>">
            </div>
            <div>
              <label for="business_name" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Business Name', 'reviewservicepro'); ?></label>
              <input id="business_name" name="business_name" type="text" class="rsp-contact-field" value="<?php echo esc_attr($form_values['business_name']); ?>" placeholder="<?php esc_attr_e('Your business', 'reviewservicepro'); ?>">
            </div>
          </div>

          <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
              <label for="email" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Email Address', 'reviewservicepro'); ?> *</label>
              <input id="email" name="email" type="email" required class="rsp-contact-field" value="<?php echo esc_attr($form_values['email']); ?>" placeholder="<?php esc_attr_e('you@example.com', 'reviewservicepro'); ?>">
            </div>
            <div>
              <label for="phone" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Phone / WhatsApp', 'reviewservicepro'); ?></label>
              <input id="phone" name="phone" type="tel" class="rsp-contact-field" value="<?php echo esc_attr($form_values['phone']); ?>" placeholder="<?php esc_attr_e('+1 000 000 0000', 'reviewservicepro'); ?>">
            </div>
          </div>

          <div>
            <label for="website_url" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Website or Business Profile URL', 'reviewservicepro'); ?></label>
            <input id="website_url" name="website_url" type="url" class="rsp-contact-field" value="<?php echo esc_attr($form_values['website_url']); ?>" placeholder="<?php esc_attr_e('https://example.com or Google profile link', 'reviewservicepro'); ?>">
          </div>

          <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
              <label for="service_interest" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Service Interest', 'reviewservicepro'); ?></label>
              <select id="service_interest" name="service_interest" class="rsp-contact-field">
                <?php foreach ($service_options as $value => $label) : ?>
                  <option value="<?php echo esc_attr($value); ?>" <?php selected($form_values['service_interest'], $value); ?>>
                    <?php echo esc_html($label); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label for="review_platform" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Main Review Platform', 'reviewservicepro'); ?></label>
              <select id="review_platform" name="review_platform" class="rsp-contact-field">
                <?php foreach ($platform_options as $value => $label) : ?>
                  <option value="<?php echo esc_attr($value); ?>" <?php selected($form_values['review_platform'], $value); ?>>
                    <?php echo esc_html($label); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div>
            <label for="message" class="mb-2 block text-sm font-[800] text-[#334155]"><?php esc_html_e('Tell us what you need', 'reviewservicepro'); ?> *</label>
            <textarea id="message" name="message" required class="rsp-contact-field" placeholder="<?php esc_attr_e('Briefly describe your reputation challenge, review platform, and goal.', 'reviewservicepro'); ?>"><?php echo esc_textarea($form_values['message']); ?></textarea>
          </div>

          <button type="submit" class="rsp-page-btn inline-flex min-h-[54px] items-center justify-center rounded-2xl bg-[#2563EB] px-7 py-4 font-bold text-white shadow-[0_14px_34px_rgba(37,99,235,0.22)] hover:bg-blue-700">
            <span class="relative z-10 inline-flex items-center gap-2">
              <?php esc_html_e('Submit Request', 'reviewservicepro'); ?>
              <i data-lucide="send" class="h-4 w-4" aria-hidden="true"></i>
            </span>
          </button>
        </form>
      </div>
    </section>
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
