<?php

/**
 * Template Name: ReviewService.Pro Contact Page
 *
 * File: page-templates/template-contact.php
 *
 * ReviewService.Pro — Premium White SaaS Contact Page
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Contact details.
 */
$support_email = 'support@reviewservice.pro';
$phone_display = '+1 (807) 798 0758';
$phone_tel     = '+18077980758';
$whatsapp_url  = 'https://wa.me/18077980758';
$address       = '30 N Gould St Ste N, Sheridan, WY 82801';

$instagram_url = 'https://www.instagram.com/reputation.management.pro/';
$facebook_url  = 'https://www.facebook.com/reviewservice.pro/';
$x_url         = 'https://x.com/reviewservicepr';
$linkedin_url  = 'https://www.linkedin.com/company/reviewservicepro';

$directions_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($address);

$current_page_url = get_permalink(get_queried_object_id());

if (! $current_page_url) {
  $current_page_url = home_url('/contact/');
}

$contact_form_url = $current_page_url . '#contact-form';
$audit_url        = add_query_arg('type', 'free-audit', $current_page_url) . '#contact-form';

/**
 * Form state.
 */
$form_notice_type = '';
$form_notice_text = '';

$form_values = [
  'full_name'        => '',
  'business_name'    => '',
  'email'            => '',
  'phone'            => '',
  'website_url'      => '',
  'service_interest' => '',
  'review_platform'  => '',
  'message'          => '',
];

if (isset($_GET['contact_status']) && 'success' === sanitize_text_field(wp_unslash($_GET['contact_status']))) {
  $form_notice_type = 'success';
  $form_notice_text = __('Thank you. Your request has been received. Our team will review your details and respond as soon as possible.', 'reviewservicepro');
}

/**
 * Handle form submission.
 */
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
      __('New ReviewService.Pro Contact Request%s', 'reviewservicepro'),
      ! empty($form_values['business_name']) ? ' — ' . $form_values['business_name'] : ''
    );

    $email_body  = "New contact request from ReviewService.Pro\n\n";
    $email_body .= "Name: " . $form_values['full_name'] . "\n";
    $email_body .= "Business Name: " . $form_values['business_name'] . "\n";
    $email_body .= "Email: " . $form_values['email'] . "\n";
    $email_body .= "Phone: " . $form_values['phone'] . "\n";
    $email_body .= "Website URL: " . $form_values['website_url'] . "\n";
    $email_body .= "Service Interest: " . $form_values['service_interest'] . "\n";
    $email_body .= "Review Platform: " . $form_values['review_platform'] . "\n\n";
    $email_body .= "Message:\n" . $form_values['message'] . "\n\n";
    $email_body .= "Submitted from: " . $current_page_url . "\n";

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

/**
 * Page content arrays.
 */
$trust_badges = [
  [
    'icon' => 'shield-check',
    'text' => __('Ethical ORM', 'reviewservicepro'),
  ],
  [
    'icon' => 'ban',
    'text' => __('No Fake Reviews', 'reviewservicepro'),
  ],
  [
    'icon' => 'badge-check',
    'text' => __('Platform-Compliant Support', 'reviewservicepro'),
  ],
  [
    'icon' => 'lock-keyhole',
    'text' => __('Secure Communication', 'reviewservicepro'),
  ],
];

$contact_options = [
  [
    'icon'  => 'calendar-check',
    'label' => __('Free Consultation', 'reviewservicepro'),
    'desc'  => __('Book a focused conversation about your current review profile, risks, and reputation opportunities.', 'reviewservicepro'),
    'meta'  => __('Best for strategy and audit requests', 'reviewservicepro'),
    'cta'   => __('Request Consultation', 'reviewservicepro'),
    'url'   => $audit_url,
    'tone'  => 'blue',
  ],
  [
    'icon'  => 'message-circle',
    'label' => __('WhatsApp Support', 'reviewservicepro'),
    'desc'  => __('Use WhatsApp for quick onboarding questions, package guidance, and direct communication.', 'reviewservicepro'),
    'meta'  => __('Fast support channel', 'reviewservicepro'),
    'cta'   => __('Open WhatsApp', 'reviewservicepro'),
    'url'   => $whatsapp_url,
    'tone'  => 'green',
  ],
  [
    'icon'  => 'mail',
    'label' => __('Email Support', 'reviewservicepro'),
    'desc'  => __('Send project requirements, platform links, screenshots, and business details securely by email.', 'reviewservicepro'),
    'meta'  => __('Best for detailed requirements', 'reviewservicepro'),
    'cta'   => __('Email Us', 'reviewservicepro'),
    'url'   => 'mailto:' . $support_email,
    'tone'  => 'purple',
  ],
  [
    'icon'  => 'map-pin',
    'label' => __('Business Address', 'reviewservicepro'),
    'desc'  => __('ReviewService.Pro operates as a professional reputation management service business.', 'reviewservicepro'),
    'meta'  => $address,
    'cta'   => __('Get Directions', 'reviewservicepro'),
    'url'   => $directions_url,
    'tone'  => 'amber',
  ],
];

$service_options = [
  ''                             => __('Select service interest', 'reviewservicepro'),
  'Free Reputation Audit'         => __('Free Reputation Audit', 'reviewservicepro'),
  'Online Reputation Management'  => __('Online Reputation Management', 'reviewservicepro'),
  'Review Monitoring'             => __('Review Monitoring', 'reviewservicepro'),
  'Review Response Support'       => __('Review Response Support', 'reviewservicepro'),
  'Negative Review Case Support'  => __('Negative Review Case Support', 'reviewservicepro'),
  'Platform Check'                => __('Platform Check', 'reviewservicepro'),
  'Monthly ORM Plan'              => __('Monthly ORM Plan', 'reviewservicepro'),
  'Other'                         => __('Other', 'reviewservicepro'),
];

$platform_options = [
  ''                        => __('Select review platform', 'reviewservicepro'),
  'Google Business Profile' => __('Google Business Profile', 'reviewservicepro'),
  'Trustpilot'              => __('Trustpilot', 'reviewservicepro'),
  'Yelp'                    => __('Yelp', 'reviewservicepro'),
  'Facebook Reviews'        => __('Facebook Reviews', 'reviewservicepro'),
  'Tripadvisor'             => __('Tripadvisor', 'reviewservicepro'),
  'BBB'                     => __('BBB', 'reviewservicepro'),
  'G2 / Capterra'           => __('G2 / Capterra', 'reviewservicepro'),
  'Multiple Platforms'      => __('Multiple Platforms', 'reviewservicepro'),
  'Other'                   => __('Other', 'reviewservicepro'),
];

$info_cards = [
  [
    'icon'  => 'mail',
    'title' => __('Email', 'reviewservicepro'),
    'text'  => $support_email,
    'url'   => 'mailto:' . $support_email,
    'cta'   => __('Send Email', 'reviewservicepro'),
  ],
  [
    'icon'  => 'phone',
    'title' => __('Phone', 'reviewservicepro'),
    'text'  => $phone_display,
    'url'   => 'tel:' . $phone_tel,
    'cta'   => __('Call Now', 'reviewservicepro'),
  ],
  [
    'icon'  => 'message-circle',
    'title' => __('WhatsApp', 'reviewservicepro'),
    'text'  => $phone_display,
    'url'   => $whatsapp_url,
    'cta'   => __('Message Us', 'reviewservicepro'),
  ],
  [
    'icon'  => 'map',
    'title' => __('Address', 'reviewservicepro'),
    'text'  => $address,
    'url'   => $directions_url,
    'cta'   => __('Get Directions', 'reviewservicepro'),
  ],
];

$ethical_items = [
  [
    'icon'  => 'ban',
    'title' => __('No fake reviews', 'reviewservicepro'),
    'text'  => __('We do not create, sell, request, or support fake customer reviews.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'shield-alert',
    'title' => __('No guaranteed removals', 'reviewservicepro'),
    'text'  => __('We can help document and report eligible issues, but platform decisions are not guaranteed.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'star-off',
    'title' => __('No rating manipulation', 'reviewservicepro'),
    'text'  => __('We do not promise guaranteed star ratings, ranking outcomes, or artificial reputation changes.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'badge-check',
    'title' => __('Platform-compliant support', 'reviewservicepro'),
    'text'  => __('Our work focuses on monitoring, response support, documentation, and genuine feedback workflows.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'file-check-2',
    'title' => __('Transparent communication', 'reviewservicepro'),
    'text'  => __('You get clear next steps, honest scope, and practical reputation guidance.', 'reviewservicepro'),
  ],
];

$faq_items = [
  [
    'q' => __('How fast will you respond?', 'reviewservicepro'),
    'a' => __('Most inquiries receive an initial review and response within one business day. Complex reputation cases may require additional review time.', 'reviewservicepro'),
  ],
  [
    'q' => __('What happens after I request a free reputation audit?', 'reviewservicepro'),
    'a' => __('We review your business details, public review presence, response gaps, and platform concerns, then recommend a practical next step.', 'reviewservicepro'),
  ],
  [
    'q' => __('Can you remove negative reviews?', 'reviewservicepro'),
    'a' => __('We cannot guarantee removal of genuine customer reviews. If a review appears to violate platform policy, we can help with documentation and platform-compliant reporting guidance.', 'reviewservicepro'),
  ],
  [
    'q' => __('Do you provide fake reviews?', 'reviewservicepro'),
    'a' => __('No. ReviewService.Pro does not create, sell, buy, or support fake reviews, paid review incentives, or rating manipulation.', 'reviewservicepro'),
  ],
  [
    'q' => __('Can you help with monthly ORM support?', 'reviewservicepro'),
    'a' => __('Yes. If ongoing monitoring, response support, reporting, and reputation strategy make sense, we can guide you toward a monthly ORM plan.', 'reviewservicepro'),
  ],
  [
    'q' => __('Which platforms can you review?', 'reviewservicepro'),
    'a' => __('We can help with Google Business Profile, Trustpilot, Yelp, Facebook Reviews, Tripadvisor, BBB, G2, Capterra, and other relevant platforms depending on your business type.', 'reviewservicepro'),
  ],
];

$social_links = [
  [
    'icon'  => 'instagram',
    'label' => __('Instagram', 'reviewservicepro'),
    'url'   => $instagram_url,
  ],
  [
    'icon'  => 'facebook',
    'label' => __('Facebook', 'reviewservicepro'),
    'url'   => $facebook_url,
  ],
  [
    'icon'  => 'twitter',
    'label' => __('X / Twitter', 'reviewservicepro'),
    'url'   => $x_url,
  ],
  [
    'icon'  => 'linkedin',
    'label' => __('LinkedIn', 'reviewservicepro'),
    'url'   => $linkedin_url,
  ],
  [
    'icon'  => 'message-circle',
    'label' => __('WhatsApp', 'reviewservicepro'),
    'url'   => $whatsapp_url,
  ],
];

$dashboard_items = [
  [
    'icon'  => 'search-check',
    'title' => __('Reputation Audit', 'reviewservicepro'),
    'text'  => __('Review risks, platform gaps, and next steps.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'radar',
    'title' => __('Review Monitoring', 'reviewservicepro'),
    'text'  => __('Track customer feedback across platforms.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'message-circle',
    'title' => __('Response Support', 'reviewservicepro'),
    'text'  => __('Improve tone, timing, and consistency.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'badge-check',
    'title' => __('Platform Check', 'reviewservicepro'),
    'text'  => __('Find visibility and compliance issues.', 'reviewservicepro'),
  ],
];

get_header();
?>

<main id="primary" class="site-main">
  <style>
    #rsp-contact-page {
      --rsp-contact-title: #334155;
      --rsp-contact-heading: #3B4658;
      --rsp-contact-subtitle: #64748B;
      --rsp-contact-text: #64748B;
      --rsp-contact-blue: #2563EB;
      --rsp-contact-green: #00C853;
      --rsp-contact-teal: #14B8A6;
      --rsp-contact-border: rgba(51, 65, 85, 0.12);
      font-feature-settings: "cv02", "cv03", "cv04", "cv11";
    }

    #rsp-contact-page .rsp-contact-text {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.75;
      color: var(--rsp-contact-text);
    }

    #rsp-contact-page .rsp-contact-subtitle {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 500;
      line-height: 1.8;
      color: var(--rsp-contact-subtitle);
    }

    #rsp-contact-page .rsp-contact-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(40px, 7vw, 82px);
      font-weight: 800;
      line-height: 0.98;
      letter-spacing: -0.065em;
      color: var(--rsp-contact-title);
    }

    #rsp-contact-page .rsp-contact-section-title {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: clamp(34px, 4.6vw, 64px);
      font-weight: 800;
      line-height: 1.04;
      letter-spacing: -0.058em;
      color: var(--rsp-contact-title);
    }

    #rsp-contact-page .rsp-contact-heading {
      color: var(--rsp-contact-heading);
    }

    #rsp-contact-page .rsp-contact-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
    }

    #rsp-contact-page .rsp-contact-reveal.rsp-is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #rsp-contact-page .rsp-contact-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #rsp-contact-page .rsp-contact-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.07),
          rgba(0, 200, 83, 0.25),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.25),
          rgba(37, 99, 235, 0.07));
      transform: rotate(0deg);
      animation: rspContactBorderSpin 8s linear infinite;
      opacity: 0.70;
      transition: opacity 260ms ease;
    }

    #rsp-contact-page .rsp-contact-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-contact-inner, #ffffff);
    }

    #rsp-contact-page .rsp-contact-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #rsp-contact-page .rsp-contact-panel {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #rsp-contact-page .rsp-contact-panel::before {
      content: "";
      position: absolute;
      inset: -120px;
      z-index: -1;
      background:
        radial-gradient(circle at 12% 18%, rgba(37, 99, 235, 0.09), transparent 30%),
        radial-gradient(circle at 88% 72%, rgba(0, 200, 83, 0.09), transparent 32%);
      animation: rspContactGlowMove 9s ease-in-out infinite alternate;
    }

    #rsp-contact-page .rsp-contact-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #rsp-contact-page .rsp-contact-btn::before {
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
    }

    #rsp-contact-page .rsp-contact-btn:hover {
      transform: translateY(-3px);
    }

    #rsp-contact-page .rsp-contact-btn:hover::before {
      left: 135%;
    }

    #rsp-contact-page .rsp-contact-card {
      transition:
        transform 340ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 340ms ease,
        border-color 280ms ease,
        background-color 280ms ease;
    }

    #rsp-contact-page .rsp-contact-card:hover {
      transform: translateY(-7px);
      box-shadow: 0 22px 70px rgba(15, 23, 42, 0.10);
    }

    #rsp-contact-page .rsp-contact-card-icon {
      transition:
        transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 280ms ease;
    }

    #rsp-contact-page .rsp-contact-card:hover .rsp-contact-card-icon {
      transform: rotate(-4deg) scale(1.08);
      box-shadow: 0 16px 38px rgba(37, 99, 235, 0.10);
    }

    #rsp-contact-page .rsp-contact-title-wrap {
      position: relative;
      isolation: isolate;
    }

    #rsp-contact-page .rsp-contact-title-wrap::before {
      content: "";
      position: absolute;
      left: 50%;
      top: 52%;
      z-index: -2;
      width: min(760px, 96vw);
      height: 260px;
      border-radius: 999px;
      background:
        radial-gradient(circle at 18% 40%, rgba(37, 99, 235, 0.10), transparent 34%),
        radial-gradient(circle at 82% 50%, rgba(0, 200, 83, 0.09), transparent 34%),
        rgba(255, 255, 255, 0.58);
      transform: translate(-50%, -50%) scaleX(0.92);
      filter: blur(2px);
      opacity: 0.82;
      animation: rspContactTitleSpotlight 5.8s ease-in-out infinite alternate;
    }

    #rsp-contact-page .rsp-contact-title-line {
      display: block;
      height: 3px;
      width: min(520px, 86vw);
      margin: 28px auto 0;
      border-radius: 999px;
      background: linear-gradient(90deg, transparent, rgba(51, 65, 85, 0.54), rgba(100, 116, 139, 0.22), transparent);
      transform-origin: center;
      animation: rspContactTitleLine 3s cubic-bezier(0.2, 0.9, 0.2, 1) infinite alternate;
    }

    #rsp-contact-page .rsp-contact-field {
      width: 100%;
      border-radius: 1rem;
      border: 1px solid rgba(148, 163, 184, 0.35);
      background: rgba(255, 255, 255, 0.92);
      padding: 0.95rem 1rem;
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      font-weight: 500;
      color: #334155;
      outline: none;
      transition:
        border-color 240ms ease,
        box-shadow 240ms ease,
        background-color 240ms ease;
    }

    #rsp-contact-page .rsp-contact-field::placeholder {
      color: #94A3B8;
    }

    #rsp-contact-page .rsp-contact-field:focus {
      border-color: rgba(37, 99, 235, 0.48);
      background: #ffffff;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }

    #rsp-contact-page .rsp-contact-beam {
      animation: rspContactBeam 7s ease-in-out infinite;
    }

    @keyframes rspContactBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes rspContactGlowMove {
      from {
        transform: translate3d(-18px, -10px, 0) scale(1);
      }

      to {
        transform: translate3d(18px, 12px, 0) scale(1.04);
      }
    }

    @keyframes rspContactTitleSpotlight {
      from {
        transform: translate(-50%, -50%) scaleX(0.86);
        opacity: 0.48;
      }

      to {
        transform: translate(-50%, -50%) scaleX(1.04);
        opacity: 0.88;
      }
    }

    @keyframes rspContactTitleLine {
      from {
        transform: scaleX(0.48);
        opacity: 0.42;
      }

      to {
        transform: scaleX(1);
        opacity: 0.82;
      }
    }

    @keyframes rspContactBeam {
      0% {
        transform: translateX(-120%);
      }

      100% {
        transform: translateX(120%);
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #rsp-contact-page *,
      #rsp-contact-page *::before,
      #rsp-contact-page *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
        scroll-behavior: auto !important;
      }

      #rsp-contact-page .rsp-contact-reveal {
        opacity: 1;
        transform: none;
      }
    }
  </style>

  <div id="rsp-contact-page" class="relative overflow-hidden bg-[#F8FAFC]">
    <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.038)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.038)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_top_left,rgba(37,99,235,0.09),transparent_34%),radial-gradient(circle_at_top_right,rgba(0,200,83,0.08),transparent_30%)]" aria-hidden="true"></div>

    <!-- Hero -->
    <section class="relative z-10 px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24" aria-labelledby="contact-hero-title">
      <div class="mx-auto max-w-7xl text-center">
        <div class="rsp-contact-reveal rsp-contact-title-wrap mx-auto max-w-5xl">
          <span class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-600 shadow-sm">
            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#00C853]" aria-hidden="true"></span>
            <?php esc_html_e('Contact ReviewService.Pro', 'reviewservicepro'); ?>
          </span>

          <h1 id="contact-hero-title" class="rsp-contact-title m-0">
            <?php esc_html_e('Let’s Improve Your', 'reviewservicepro'); ?>
            <span class="block"><?php esc_html_e('Online Reputation', 'reviewservicepro'); ?></span>
          </h1>

          <span class="rsp-contact-title-line" aria-hidden="true"></span>

          <p class="rsp-contact-subtitle mx-auto mt-7 max-w-2xl">
            <?php esc_html_e('Speak with our team about review monitoring, response support, platform visibility, reputation audits, and ethical customer feedback workflows.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="rsp-contact-reveal mt-8 flex flex-wrap justify-center gap-3">
          <?php foreach ($trust_badges as $badge) : ?>
            <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/90 px-4 py-2 font-['Inter',sans-serif] text-[14px] font-[700] text-[#334155] shadow-sm">
              <i data-lucide="<?php echo esc_attr($badge['icon']); ?>" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
              <?php echo esc_html($badge['text']); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Contact Options -->
    <section class="relative z-10 px-5 py-16 sm:px-6 lg:px-8 lg:py-20" aria-labelledby="contact-options-title">
      <div class="mx-auto max-w-7xl">
        <div class="rsp-contact-reveal mb-10 max-w-3xl">
          <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-600 shadow-sm">
            <i data-lucide="messages-square" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
            <?php esc_html_e('Contact Options', 'reviewservicepro'); ?>
          </span>

          <h2 id="contact-options-title" class="rsp-contact-section-title mt-5">
            <?php esc_html_e('Choose the best way to reach our team.', 'reviewservicepro'); ?>
          </h2>

          <p class="rsp-contact-subtitle mt-5 max-w-2xl">
            <?php esc_html_e('Start with the channel that fits your situation. We keep communication professional, secure, and compliance-safe.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
          <?php foreach ($contact_options as $index => $option) : ?>
            <?php
            $tone_icon = 'text-blue-600 bg-blue-50 border-blue-200';
            $inner    = '#ffffff';

            if ('green' === $option['tone']) {
              $tone_icon = 'text-[#00A344] bg-emerald-50 border-emerald-200';
              $inner    = '#F0FDF4';
            } elseif ('amber' === $option['tone']) {
              $tone_icon = 'text-amber-600 bg-amber-50 border-amber-200';
              $inner    = '#FFFBEB';
            } elseif ('purple' === $option['tone']) {
              $tone_icon = 'text-violet-600 bg-violet-50 border-violet-200';
              $inner    = '#F5F3FF';
            } else {
              $inner = '#EFF6FF';
            }
            ?>

            <article
              class="rsp-contact-card rsp-contact-motion-border rsp-contact-reveal rounded-[1.5rem] border border-slate-200 p-6 shadow-[0_16px_50px_rgba(15,23,42,0.06)]"
              style="--rsp-contact-inner: <?php echo esc_attr($inner); ?>; transition-delay: <?php echo esc_attr((string) ($index * 70)); ?>ms;">

              <div class="relative z-10">
                <div class="rsp-contact-card-icon mb-6 flex h-12 w-12 items-center justify-center rounded-2xl border <?php echo esc_attr($tone_icon); ?>">
                  <i data-lucide="<?php echo esc_attr($option['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
                </div>

                <h3 class="rsp-contact-heading font-['Poppins',sans-serif] text-[22px] font-[800] leading-tight tracking-[-0.04em]">
                  <?php echo esc_html($option['label']); ?>
                </h3>

                <p class="rsp-contact-text mt-3">
                  <?php echo esc_html($option['desc']); ?>
                </p>

                <div class="mt-5 rounded-2xl border border-white/80 bg-white/75 px-4 py-3">
                  <p class="font-['Inter',sans-serif] text-[13px] font-[700] leading-6 text-slate-500">
                    <?php echo esc_html($option['meta']); ?>
                  </p>
                </div>

                <a
                  href="<?php echo esc_url($option['url']); ?>"
                  class="mt-6 inline-flex items-center gap-2 font-['Inter',sans-serif] text-[16px] font-[800] text-blue-700 no-underline transition-all duration-200 hover:gap-3 hover:text-blue-800">
                  <?php echo esc_html($option['cta']); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Contact Form -->
    <section id="contact-form" class="relative z-10 px-5 py-16 sm:px-6 lg:px-8 lg:py-20" aria-labelledby="contact-form-title">
      <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-[0.92fr_1.08fr] lg:items-start">
          <div class="rsp-contact-reveal">
            <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-600 shadow-sm">
              <i data-lucide="clipboard-list" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
              <?php esc_html_e('Premium Consultation Form', 'reviewservicepro'); ?>
            </span>

            <h2 id="contact-form-title" class="rsp-contact-section-title mt-5">
              <?php esc_html_e('Tell us about your reputation challenges.', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-contact-subtitle mt-5 max-w-2xl">
              <?php esc_html_e('The more context you share, the easier it is for us to recommend the right audit, package, platform check, or monthly ORM path.', 'reviewservicepro'); ?>
            </p>

            <div class="mt-8 space-y-4">
              <div class="rsp-contact-motion-border rounded-2xl border border-slate-200 p-4" style="--rsp-contact-inner:#ffffff;">
                <div class="relative z-10 flex items-start gap-3">
                  <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i data-lucide="lock-keyhole" class="h-5 w-5" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h3 class="rsp-contact-heading font-['Poppins',sans-serif] text-[18px] font-[800] leading-tight">
                      <?php esc_html_e('Private & Secure', 'reviewservicepro'); ?>
                    </h3>
                    <p class="rsp-contact-text mt-1">
                      <?php esc_html_e('Your business information is handled securely and used only to review your request.', 'reviewservicepro'); ?>
                    </p>
                  </div>
                </div>
              </div>

              <div class="rsp-contact-motion-border rounded-2xl border border-slate-200 p-4" style="--rsp-contact-inner:#ffffff;">
                <div class="relative z-10 flex items-start gap-3">
                  <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-[#00A344]">
                    <i data-lucide="timer" class="h-5 w-5" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h3 class="rsp-contact-heading font-['Poppins',sans-serif] text-[18px] font-[800] leading-tight">
                      <?php esc_html_e('Fast Review', 'reviewservicepro'); ?>
                    </h3>
                    <p class="rsp-contact-text mt-1">
                      <?php esc_html_e('Most inquiries receive an initial review and response within one business day.', 'reviewservicepro'); ?>
                    </p>
                  </div>
                </div>
              </div>

              <div class="rsp-contact-panel rounded-[1.5rem] border border-slate-200 bg-white/90 p-5 shadow-[0_18px_60px_rgba(15,23,42,0.06)]">
                <div class="mb-5 flex items-center justify-between border-b border-slate-200 pb-4">
                  <div>
                    <p class="font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-500">
                      <?php esc_html_e('Audit Preview', 'reviewservicepro'); ?>
                    </p>
                    <h3 class="rsp-contact-heading mt-1 font-['Poppins',sans-serif] text-[22px] font-[800] tracking-[-0.04em]">
                      <?php esc_html_e('What we can review', 'reviewservicepro'); ?>
                    </h3>
                  </div>
                  <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="radar" class="h-5 w-5" aria-hidden="true"></i>
                  </span>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                  <?php foreach ($dashboard_items as $item) : ?>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/80 p-4">
                      <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm">
                          <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-4 w-4" aria-hidden="true"></i>
                        </span>
                        <div>
                          <h4 class="font-['Inter',sans-serif] text-[14px] font-[800] text-[#3B4658]">
                            <?php echo esc_html($item['title']); ?>
                          </h4>
                          <p class="mt-1 font-['Inter',sans-serif] text-[13px] font-medium leading-6 text-slate-500">
                            <?php echo esc_html($item['text']); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="rsp-contact-reveal">
            <div class="rsp-contact-panel rounded-[2rem] border border-slate-200 bg-white/92 p-5 shadow-[0_24px_90px_rgba(15,23,42,0.09)] backdrop-blur-xl md:p-8">
              <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden bg-slate-200" aria-hidden="true">
                <div class="rsp-contact-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
              </div>

              <?php if (! empty($form_notice_text)) : ?>
                <div class="mb-6 rounded-2xl border <?php echo 'success' === $form_notice_type ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-red-200 bg-red-50 text-red-800'; ?> px-4 py-3 font-['Inter',sans-serif] text-[16px] font-[700] leading-7">
                  <?php echo esc_html($form_notice_text); ?>
                </div>
              <?php endif; ?>

              <form method="post" action="<?php echo esc_url($contact_form_url); ?>" class="relative z-10 space-y-5">
                <input type="hidden" name="rsp_contact_action" value="submit_contact_request">
                <input type="text" name="rsp_company_site" value="" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
                <?php wp_nonce_field('rsp_contact_form_action', 'rsp_contact_nonce'); ?>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                  <div>
                    <label for="full_name" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                      <?php esc_html_e('Your Name', 'reviewservicepro'); ?> *
                    </label>
                    <input id="full_name" name="full_name" type="text" required class="rsp-contact-field" placeholder="<?php esc_attr_e('John Doe', 'reviewservicepro'); ?>" value="<?php echo esc_attr($form_values['full_name']); ?>">
                  </div>

                  <div>
                    <label for="business_name" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                      <?php esc_html_e('Business Name', 'reviewservicepro'); ?>
                    </label>
                    <input id="business_name" name="business_name" type="text" class="rsp-contact-field" placeholder="<?php esc_attr_e('Business Name', 'reviewservicepro'); ?>" value="<?php echo esc_attr($form_values['business_name']); ?>">
                  </div>

                  <div>
                    <label for="email" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                      <?php esc_html_e('Email Address', 'reviewservicepro'); ?> *
                    </label>
                    <input id="email" name="email" type="email" required class="rsp-contact-field" placeholder="<?php esc_attr_e('you@example.com', 'reviewservicepro'); ?>" value="<?php echo esc_attr($form_values['email']); ?>">
                  </div>

                  <div>
                    <label for="phone" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                      <?php esc_html_e('Phone', 'reviewservicepro'); ?>
                    </label>
                    <input id="phone" name="phone" type="tel" class="rsp-contact-field" placeholder="<?php esc_attr_e('+1...', 'reviewservicepro'); ?>" value="<?php echo esc_attr($form_values['phone']); ?>">
                  </div>

                  <div>
                    <label for="website_url" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                      <?php esc_html_e('Website URL', 'reviewservicepro'); ?>
                    </label>
                    <input id="website_url" name="website_url" type="url" class="rsp-contact-field" placeholder="<?php esc_attr_e('https://', 'reviewservicepro'); ?>" value="<?php echo esc_attr($form_values['website_url']); ?>">
                  </div>

                  <div>
                    <label for="service_interest" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                      <?php esc_html_e('Service Interest', 'reviewservicepro'); ?>
                    </label>
                    <select id="service_interest" name="service_interest" class="rsp-contact-field">
                      <?php foreach ($service_options as $value => $label) : ?>
                        <option value="<?php echo esc_attr($value); ?>" <?php selected($form_values['service_interest'], $value); ?>>
                          <?php echo esc_html($label); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div>
                  <label for="review_platform" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                    <?php esc_html_e('Main Review Platform', 'reviewservicepro'); ?>
                  </label>
                  <select id="review_platform" name="review_platform" class="rsp-contact-field">
                    <?php foreach ($platform_options as $value => $label) : ?>
                      <option value="<?php echo esc_attr($value); ?>" <?php selected($form_values['review_platform'], $value); ?>>
                        <?php echo esc_html($label); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div>
                  <label for="message" class="mb-2 block font-['Inter',sans-serif] text-[14px] font-[800] text-[#334155]">
                    <?php esc_html_e('Current Reputation Challenges', 'reviewservicepro'); ?> *
                  </label>
                  <textarea id="message" name="message" rows="6" required class="rsp-contact-field resize-y" placeholder="<?php esc_attr_e('Tell us about your reviews, platforms, visibility, or customer trust challenge...', 'reviewservicepro'); ?>"><?php echo esc_textarea($form_values['message']); ?></textarea>
                </div>

                <button type="submit" class="rsp-contact-btn inline-flex min-h-[56px] w-full items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-white shadow-lg shadow-blue-600/25 hover:bg-blue-700">
                  <span class="relative z-10 inline-flex items-center gap-2">
                    <i data-lucide="send" class="h-5 w-5" aria-hidden="true"></i>
                    <?php esc_html_e('Request Free Reputation Audit', 'reviewservicepro'); ?>
                  </span>
                </button>

                <p class="rsp-contact-text text-center text-[14px]">
                  <?php esc_html_e('By submitting this form, you agree to ethical, platform-compliant communication practices.', 'reviewservicepro'); ?>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Business Info -->
    <section class="relative z-10 px-5 py-16 sm:px-6 lg:px-8 lg:py-20" aria-labelledby="contact-info-title">
      <div class="mx-auto max-w-7xl">
        <div class="rsp-contact-reveal mx-auto mb-10 max-w-3xl text-center">
          <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-600 shadow-sm">
            <i data-lucide="building-2" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
            <?php esc_html_e('Business Contact Information', 'reviewservicepro'); ?>
          </span>

          <h2 id="contact-info-title" class="rsp-contact-section-title mt-5">
            <?php esc_html_e('Connect with ReviewService.Pro directly.', 'reviewservicepro'); ?>
          </h2>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
          <?php foreach ($info_cards as $index => $card) : ?>
            <article
              class="rsp-contact-card rsp-contact-motion-border rsp-contact-reveal rounded-[1.5rem] border border-slate-200 p-6 shadow-[0_16px_50px_rgba(15,23,42,0.06)]"
              style="--rsp-contact-inner:#ffffff; transition-delay: <?php echo esc_attr((string) ($index * 70)); ?>ms;">

              <div class="relative z-10">
                <div class="rsp-contact-card-icon mb-5 flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
                  <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
                </div>

                <h3 class="rsp-contact-heading font-['Poppins',sans-serif] text-[22px] font-[800] leading-tight tracking-[-0.04em]">
                  <?php echo esc_html($card['title']); ?>
                </h3>

                <p class="rsp-contact-subtitle mt-3 break-words">
                  <?php echo esc_html($card['text']); ?>
                </p>

                <a href="<?php echo esc_url($card['url']); ?>" class="mt-5 inline-flex items-center gap-2 font-['Inter',sans-serif] text-[16px] font-[800] text-blue-700 no-underline transition-all duration-200 hover:gap-3">
                  <?php echo esc_html($card['cta']); ?>
                  <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="rsp-contact-reveal mt-8 flex flex-wrap items-center justify-center gap-3">
          <?php foreach ($social_links as $social) : ?>
            <a href="<?php echo esc_url($social['url']); ?>" class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white text-[#334155] shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700" aria-label="<?php echo esc_attr($social['label']); ?>">
              <i data-lucide="<?php echo esc_attr($social['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Ethical ORM Trust -->
    <section class="relative z-10 px-5 py-16 sm:px-6 lg:px-8 lg:py-20" aria-labelledby="ethical-trust-title">
      <div class="mx-auto max-w-7xl">
        <div class="rsp-contact-panel rounded-[2rem] border border-slate-200 bg-white/92 p-6 shadow-[0_24px_90px_rgba(15,23,42,0.08)] backdrop-blur-xl md:p-8">
          <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.75fr_1.25fr] lg:items-center">
            <div class="rsp-contact-reveal">
              <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-600 shadow-sm">
                <i data-lucide="shield-check" class="h-4 w-4 text-[#00A344]" aria-hidden="true"></i>
                <?php esc_html_e('Ethical ORM Trust', 'reviewservicepro'); ?>
              </span>

              <h2 id="ethical-trust-title" class="rsp-contact-section-title mt-5">
                <?php esc_html_e('Built for trust, not shortcuts.', 'reviewservicepro'); ?>
              </h2>

              <p class="rsp-contact-subtitle mt-5">
                <?php esc_html_e('Our contact process keeps expectations clear from the first conversation. We focus on ethical monitoring, professional response support, documentation, and transparent reputation improvement.', 'reviewservicepro'); ?>
              </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
              <?php foreach ($ethical_items as $index => $item) : ?>
                <article class="rsp-contact-card rsp-contact-reveal rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" style="transition-delay: <?php echo esc_attr((string) ($index * 70)); ?>ms;">
                  <div class="flex items-start gap-4">
                    <span class="rsp-contact-card-icon flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-200 bg-emerald-50 text-[#00A344]">
                      <i data-lucide="<?php echo esc_attr($item['icon']); ?>" class="h-5 w-5" aria-hidden="true"></i>
                    </span>

                    <div>
                      <h3 class="rsp-contact-heading font-['Poppins',sans-serif] text-[18px] font-[800] leading-tight">
                        <?php echo esc_html($item['title']); ?>
                      </h3>

                      <p class="rsp-contact-text mt-2">
                        <?php echo esc_html($item['text']); ?>
                      </p>
                    </div>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="relative z-10 px-5 py-16 sm:px-6 lg:px-8 lg:py-20" aria-labelledby="contact-faq-title">
      <div class="mx-auto max-w-4xl">
        <div class="rsp-contact-reveal mx-auto mb-10 text-center">
          <span class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-white px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-slate-600 shadow-sm">
            <i data-lucide="circle-help" class="h-4 w-4 text-blue-600" aria-hidden="true"></i>
            <?php esc_html_e('Contact FAQ', 'reviewservicepro'); ?>
          </span>

          <h2 id="contact-faq-title" class="rsp-contact-section-title mt-5">
            <?php esc_html_e('Quick answers before you contact us.', 'reviewservicepro'); ?>
          </h2>
        </div>

        <div class="space-y-4">
          <?php foreach ($faq_items as $index => $faq) : ?>
            <article class="rsp-contact-reveal overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm" style="transition-delay: <?php echo esc_attr((string) ($index * 60)); ?>ms;">
              <button type="button" class="rsp-contact-faq-toggle flex w-full items-center justify-between gap-4 px-5 py-5 text-left transition-colors duration-200 hover:bg-slate-50" aria-expanded="false">
                <span class="font-['Poppins',sans-serif] text-[18px] font-[800] leading-snug tracking-[-0.03em] text-[#3B4658]">
                  <?php echo esc_html($faq['q']); ?>
                </span>

                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-[#334155]">
                  <i data-lucide="chevron-down" class="h-5 w-5 transition-transform duration-300" aria-hidden="true"></i>
                </span>
              </button>

              <div class="rsp-contact-faq-answer hidden border-t border-slate-200 px-5 pb-5 pt-4">
                <p class="rsp-contact-subtitle">
                  <?php echo esc_html($faq['a']); ?>
                </p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Final CTA -->
    <section class="relative z-10 px-5 py-16 sm:px-6 lg:px-8 lg:py-24" aria-labelledby="contact-final-cta-title">
      <div class="mx-auto max-w-6xl">
        <div class="rsp-contact-panel rsp-contact-motion-border rounded-[2rem] border border-slate-200 p-8 text-center shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-12" style="--rsp-contact-inner:#ffffff;">
          <div class="relative z-10">
            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 font-['DM_Mono',monospace] text-[11px] font-medium uppercase tracking-[0.14em] text-emerald-700">
              <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-[#00C853]" aria-hidden="true"></span>
              <?php esc_html_e('Start with clarity', 'reviewservicepro'); ?>
            </span>

            <h2 id="contact-final-cta-title" class="rsp-contact-section-title mx-auto mt-6 max-w-3xl">
              <?php esc_html_e('Not sure where your reputation stands?', 'reviewservicepro'); ?>
            </h2>

            <p class="rsp-contact-subtitle mx-auto mt-5 max-w-2xl">
              <?php esc_html_e('Request a free reputation audit or contact us through WhatsApp to understand your current review risks, response gaps, and trust-building opportunities.', 'reviewservicepro'); ?>
            </p>

            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
              <a href="<?php echo esc_url($audit_url); ?>" class="rsp-contact-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-white shadow-lg shadow-blue-600/25 hover:bg-blue-700">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
                  <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
                </span>
              </a>

              <a href="<?php echo esc_url($whatsapp_url); ?>" class="rsp-contact-btn inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-emerald-700 shadow-sm hover:bg-emerald-100">
                <span class="relative z-10 inline-flex items-center gap-2">
                  <i data-lucide="message-circle" class="h-5 w-5" aria-hidden="true"></i>
                  <?php esc_html_e('WhatsApp Support', 'reviewservicepro'); ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    (function() {
      var RSP_SVG_NS = 'http://www.w3.org/2000/svg';

      var rspIconMap = {
        'shield-check': '<path d="M20 13c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V5l8-3 8 3v8Z"/><path d="m9 12 2 2 4-4"/>',
        'ban': '<circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 14.14 14.14"/>',
        'badge-check': '<path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.77 4 4 0 0 1 0 6.76 4 4 0 0 1-4.78 4.77 4 4 0 0 1-6.74 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/>',
        'lock-keyhole': '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><circle cx="12" cy="16" r="1"/>',
        'calendar-check': '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="m9 16 2 2 4-4"/>',
        'message-circle': '<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>',
        'mail': '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-10 6L2 7"/>',
        'map-pin': '<path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'map': '<path d="M14.5 4.5 9.5 2 3 5.5v16l6.5-3.5 5 2.5 6.5-3.5v-16Z"/><path d="M9.5 2v16"/><path d="M14.5 4.5v16"/>',
        'messages-square': '<path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/>',
        'arrow-right': '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'clipboard-list': '<rect width="8" height="4" x="8" y="2" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/>',
        'timer': '<line x1="10" x2="14" y1="2" y2="2"/><line x1="12" x2="15" y1="14" y2="11"/><circle cx="12" cy="14" r="8"/>',
        'send': '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>',
        'building-2': '<path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v8h20v-8a2 2 0 0 0-2-2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/>',
        'phone': '<path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 3.11 5.18 2 2 0 0 1 5.09 3h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.6a2 2 0 0 1-.45 2.11L9 10.67a16 16 0 0 0 4.33 4.33l1.24-1.24a2 2 0 0 1 2.11-.45c.83.28 1.7.48 2.6.6A2 2 0 0 1 22 16.92Z"/>',
        'shield-alert': '<path d="M20 13c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V5l8-3 8 3v8Z"/><path d="M12 8v4"/><path d="M12 16h.01"/>',
        'star-off': '<path d="m2 2 20 20"/><path d="M8.5 8.5 12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88-6.16-3.24-6.18 3.25L7 14.14 2 9.27l6.5-.77Z"/>',
        'file-check-2': '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="m9 15 2 2 4-4"/>',
        'circle-help': '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><path d="M12 17h.01"/>',
        'chevron-down': '<path d="m6 9 6 6 6-6"/>',
        'search-check': '<path d="m8 11 2 2 4-4"/><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'radar': '<path d="M19.07 4.93A10 10 0 1 0 22 12h-4a6 6 0 1 1-1.76-4.24Z"/><path d="M12 12 19.07 4.93"/>',
        'facebook': '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3Z"/>',
        'instagram': '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"/><path d="M17.5 6.5h.01"/>',
        'linkedin': '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6Z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>',
        'twitter': '<path d="M4 4l11.5 16H20L8.5 4Z"/><path d="M4 20 20 4"/>',
        'fallback': '<circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="M8 12h8"/>'
      };

      function rspCreateFallbackSvg(iconElement) {
        if (!iconElement || iconElement.dataset.rspIconReady === 'true') {
          return;
        }

        var iconName = iconElement.getAttribute('data-lucide') || 'fallback';
        var svgPaths = rspIconMap[iconName] || rspIconMap.fallback;
        var oldClass = iconElement.getAttribute('class') || 'h-5 w-5';
        var oldAria = iconElement.getAttribute('aria-hidden') || 'true';

        var svg = document.createElementNS(RSP_SVG_NS, 'svg');
        svg.setAttribute('xmlns', RSP_SVG_NS);
        svg.setAttribute('viewBox', '0 0 24 24');
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.setAttribute('stroke-width', '2');
        svg.setAttribute('stroke-linecap', 'round');
        svg.setAttribute('stroke-linejoin', 'round');
        svg.setAttribute('class', oldClass);
        svg.setAttribute('aria-hidden', oldAria);
        svg.setAttribute('focusable', 'false');
        svg.innerHTML = svgPaths;

        iconElement.dataset.rspIconReady = 'true';
        iconElement.replaceWith(svg);
      }

      function rspForceIcons() {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
          try {
            window.lucide.createIcons();
          } catch (error) {}
        }

        window.setTimeout(function() {
          document.querySelectorAll('#rsp-contact-page i[data-lucide]').forEach(function(iconElement) {
            rspCreateFallbackSvg(iconElement);
          });
        }, 350);
      }

      function initReviewServiceContactPage() {
        rspForceIcons();

        var revealItems = document.querySelectorAll('#rsp-contact-page .rsp-contact-reveal');

        if ('IntersectionObserver' in window && revealItems.length) {
          var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                entry.target.classList.add('rsp-is-visible');
                observer.unobserve(entry.target);
              }
            });
          }, {
            threshold: 0.08,
            rootMargin: '0px 0px -30px 0px'
          });

          revealItems.forEach(function(item) {
            observer.observe(item);
          });
        } else {
          revealItems.forEach(function(item) {
            item.classList.add('rsp-is-visible');
          });
        }

        var faqButtons = document.querySelectorAll('#rsp-contact-page .rsp-contact-faq-toggle');

        faqButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            var currentArticle = button.closest('article');
            var currentAnswer = currentArticle ? currentArticle.querySelector('.rsp-contact-faq-answer') : null;
            var currentIcon = button.querySelector('svg, [data-lucide="chevron-down"]');
            var isOpen = button.getAttribute('aria-expanded') === 'true';

            faqButtons.forEach(function(otherButton) {
              var otherArticle = otherButton.closest('article');
              var otherAnswer = otherArticle ? otherArticle.querySelector('.rsp-contact-faq-answer') : null;
              var otherIcon = otherButton.querySelector('svg, [data-lucide="chevron-down"]');

              otherButton.setAttribute('aria-expanded', 'false');

              if (otherAnswer) {
                otherAnswer.classList.add('hidden');
              }

              if (otherIcon) {
                otherIcon.style.transform = 'rotate(0deg)';
              }
            });

            if (!isOpen) {
              button.setAttribute('aria-expanded', 'true');

              if (currentAnswer) {
                currentAnswer.classList.remove('hidden');
              }

              if (currentIcon) {
                currentIcon.style.transform = 'rotate(180deg)';
              }
            }
          });
        });

        window.setTimeout(rspForceIcons, 900);
        window.setTimeout(rspForceIcons, 1800);
      }

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initReviewServiceContactPage);
      } else {
        initReviewServiceContactPage();
      }

      window.addEventListener('load', rspForceIcons);
    })();
  </script>
</main>

<?php
get_footer();
