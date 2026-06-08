<?php

/**
 * Page Template
 *
 * ReviewService.Pro — Premium White SaaS Default Page Template
 *
 * File: page.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$page_id        = get_queried_object_id();
$page_content   = get_post_field('post_content', $page_id);
$has_thumbnail  = has_post_thumbnail($page_id);
$page_excerpt   = has_excerpt($page_id) ? get_the_excerpt($page_id) : '';

$has_checkout_shortcode = has_shortcode($page_content, 'woocommerce_checkout');
$has_cart_shortcode     = has_shortcode($page_content, 'woocommerce_cart');
$has_account_shortcode  = has_shortcode($page_content, 'woocommerce_my_account');

$is_checkout_page = (
  (function_exists('is_checkout') && is_checkout()) ||
  is_page('checkout') ||
  $has_checkout_shortcode
);

$is_cart_page = (
  (function_exists('is_cart') && is_cart()) ||
  is_page('cart') ||
  $has_cart_shortcode
);

$is_account_page = (
  (function_exists('is_account_page') && is_account_page()) ||
  is_page('my-account') ||
  $has_account_shortcode
);

$is_woocommerce_flow_page = $is_checkout_page || $is_cart_page || $is_account_page;

$content_container_class = $is_woocommerce_flow_page
  ? 'max-w-7xl'
  : 'max-w-4xl';

$content_card_class = $is_woocommerce_flow_page
  ? 'rsp-page-woo-card'
  : 'rsp-page-content-card';

$content_inner_class = $is_woocommerce_flow_page
  ? 'page-content rsp-page-woo-content'
  : 'page-content rsp-page-content';

$audit_url = home_url('/contact/?type=audit');
?>

<main
  id="rsp-page-template"
  class="relative overflow-hidden bg-white"
  role="main">

  <style>
    #rsp-page-template {
      --rsp-page-title: #334155;
      --rsp-page-heading: #3B4658;
      --rsp-page-body: #64748B;
      --rsp-page-blue: #2563EB;
      --rsp-page-green: #00C853;
      --rsp-page-border: rgba(148, 163, 184, 0.26);
    }

    #rsp-page-template .rsp-page-title,
    #rsp-page-template .rsp-page-heading {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    #rsp-page-template .rsp-page-title {
      color: var(--rsp-page-title);
      text-wrap: balance;
    }

    #rsp-page-template .rsp-page-heading {
      color: var(--rsp-page-heading);
    }

    #rsp-page-template .rsp-page-text,
    #rsp-page-template .rsp-page-body {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-size: 16px;
      line-height: 1.78;
      color: var(--rsp-page-body);
    }

    #rsp-page-template .rsp-page-text {
      font-weight: 500;
    }

    #rsp-page-template .rsp-page-body {
      font-weight: 400;
    }

    #rsp-page-template .rsp-page-eyebrow {
      font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    #rsp-page-template .rsp-page-reveal {
      opacity: 0;
      transform: translateY(24px);
      transition:
        opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
        transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
        box-shadow 320ms ease,
        border-color 320ms ease;
    }

    #rsp-page-template .rsp-page-reveal.rsp-visible {
      opacity: 1;
      transform: translateY(0);
    }

    #rsp-page-template .rsp-page-motion-border {
      position: relative;
      isolation: isolate;
      overflow: hidden;
    }

    #rsp-page-template .rsp-page-motion-border::before {
      content: "";
      position: absolute;
      inset: -80%;
      z-index: -2;
      border-radius: inherit;
      background: conic-gradient(from 0deg,
          rgba(37, 99, 235, 0.08),
          rgba(0, 200, 83, 0.24),
          rgba(20, 184, 166, 0.18),
          rgba(37, 99, 235, 0.26),
          rgba(37, 99, 235, 0.08));
      opacity: 0.68;
      transform: rotate(0deg);
      animation: rspPageBorderSpin 8s linear infinite;
      pointer-events: none;
      transition: opacity 260ms ease;
    }

    #rsp-page-template .rsp-page-motion-border::after {
      content: "";
      position: absolute;
      inset: 1px;
      z-index: -1;
      border-radius: inherit;
      background: var(--rsp-page-inner, #ffffff);
      pointer-events: none;
    }

    #rsp-page-template .rsp-page-motion-border:hover::before {
      opacity: 1;
      animation-duration: 4.2s;
    }

    #rsp-page-template .rsp-page-btn {
      position: relative;
      overflow: hidden;
      transition:
        transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
        box-shadow 260ms ease,
        border-color 260ms ease,
        background-color 260ms ease;
    }

    #rsp-page-template .rsp-page-btn::before {
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

    #rsp-page-template .rsp-page-btn:hover {
      transform: translateY(-3px);
    }

    #rsp-page-template .rsp-page-btn:hover::before {
      left: 135%;
    }

    #rsp-page-template .rsp-page-content-card,
    #rsp-page-template .rsp-page-woo-card {
      border: 1px solid rgba(148, 163, 184, 0.22);
      border-radius: 2rem;
      background: #ffffff;
      box-shadow: 0 18px 60px rgba(15, 23, 42, 0.07);
    }

    #rsp-page-template .rsp-page-content-card {
      padding: clamp(1.5rem, 4vw, 3rem);
    }

    #rsp-page-template .rsp-page-woo-card {
      padding: clamp(1.25rem, 3vw, 2.5rem);
    }

    #rsp-page-template .rsp-page-content {
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-page-body);
    }

    #rsp-page-template .rsp-page-content p {
      margin-top: 1.2rem;
      margin-bottom: 1.2rem;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.88;
      color: var(--rsp-page-body);
    }

    #rsp-page-template .rsp-page-content h2,
    #rsp-page-template .rsp-page-content h3,
    #rsp-page-template .rsp-page-content h4 {
      font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--rsp-page-heading);
    }

    #rsp-page-template .rsp-page-content h2 {
      margin-top: 3rem;
      margin-bottom: 1rem;
      font-size: clamp(26px, 3vw, 36px);
      font-weight: 800;
      line-height: 1.16;
      letter-spacing: -0.04em;
    }

    #rsp-page-template .rsp-page-content h3 {
      margin-top: 2.25rem;
      margin-bottom: 0.8rem;
      font-size: clamp(20px, 2vw, 26px);
      font-weight: 800;
      line-height: 1.22;
      letter-spacing: -0.03em;
    }

    #rsp-page-template .rsp-page-content a {
      color: #2563EB;
      font-weight: 700;
      text-decoration: none;
    }

    #rsp-page-template .rsp-page-content a:hover {
      color: #1D4ED8;
      text-decoration: underline;
    }

    #rsp-page-template .rsp-page-content ul,
    #rsp-page-template .rsp-page-content ol {
      margin-top: 1.25rem;
      margin-bottom: 1.25rem;
      padding-left: 1.35rem;
      color: var(--rsp-page-body);
    }

    #rsp-page-template .rsp-page-content li {
      margin-top: 0.7rem;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.8;
      color: var(--rsp-page-body);
    }

    #rsp-page-template .rsp-page-content li::marker {
      color: #2563EB;
    }

    #rsp-page-template .rsp-page-content figure.wp-block-image {
      overflow: hidden;
      border-radius: 1.5rem;
      border: 1px solid rgba(148, 163, 184, 0.22);
      background: #ffffff;
      padding: 0.5rem;
      box-shadow: 0 18px 60px rgba(15, 23, 42, 0.08);
    }

    #rsp-page-template .rsp-page-content figure.wp-block-image img {
      display: block;
      width: 100%;
      height: auto;
      border-radius: 1.1rem;
    }

    #rsp-page-template .rsp-page-content figcaption {
      margin-top: 0.85rem;
      padding: 0 0.5rem 0.35rem;
      text-align: center;
      font-size: 14px;
      font-weight: 500;
      line-height: 1.6;
      color: #64748B;
    }

    #rsp-page-template .rsp-page-content .wp-block-button__link {
      border-radius: 1rem;
      background: #2563EB;
      padding: 0.95rem 1.4rem;
      font-family: "Inter", sans-serif;
      font-size: 16px;
      font-weight: 800;
      color: #ffffff;
      box-shadow: 0 14px 34px rgba(37, 99, 235, 0.22);
      transition: all 260ms ease;
    }

    #rsp-page-template .rsp-page-content .wp-block-button__link:hover {
      transform: translateY(-2px);
      background: #1D4ED8;
      color: #ffffff;
      text-decoration: none;
      box-shadow: 0 18px 44px rgba(37, 99, 235, 0.30);
    }

    /** WooCommerce flow pages. */
    #rsp-page-template.rsp-woocommerce-template .woocommerce,
    #rsp-page-template .rsp-woocommerce-template .woocommerce,
    #rsp-page-template .rsp-page-woo-content .woocommerce {
      width: 100% !important;
      max-width: none !important;
      margin: 0 !important;
      color: #64748B;
      font-family: "Inter", sans-serif;
      font-size: 16px;
      line-height: 1.65;
    }

    #rsp-page-template .woocommerce h2,
    #rsp-page-template .woocommerce h3,
    #rsp-page-template .woocommerce legend {
      font-family: "Poppins", sans-serif;
      color: #3B4658;
      font-weight: 800;
      letter-spacing: -0.03em;
    }

    #rsp-page-template .woocommerce a {
      color: #2563EB;
      font-weight: 700;
      text-decoration: none;
    }

    #rsp-page-template .woocommerce a:hover {
      color: #1D4ED8;
      text-decoration: underline;
    }

    #rsp-page-template .woocommerce-info,
    #rsp-page-template .woocommerce-message,
    #rsp-page-template .woocommerce-error {
      border-radius: 1rem;
      border: 1px solid rgba(37, 99, 235, 0.22);
      border-top: 3px solid #2563EB;
      background: #ffffff;
      color: #334155;
      padding: 1.15rem 1.35rem;
      box-shadow: 0 14px 40px rgba(15, 23, 42, 0.06);
    }

    #rsp-page-template .woocommerce form.checkout {
      display: grid !important;
      grid-template-columns: minmax(0, 680px) minmax(360px, 420px);
      justify-content: center;
      align-items: start;
      gap: 44px;
      width: 100%;
      max-width: 1144px;
      margin-inline: auto;
    }

    #rsp-page-template #customer_details {
      grid-column: 1;
      grid-row: 1 / span 2;
      width: 100%;
      min-width: 0;
    }

    #rsp-page-template #customer_details .col-1,
    #rsp-page-template #customer_details .col-2 {
      float: none !important;
      width: 100% !important;
      max-width: none !important;
      margin: 0 !important;
      padding: 0 !important;
      box-sizing: border-box;
    }

    #rsp-page-template #customer_details .col-2 {
      margin-top: 2.25rem !important;
    }

    #rsp-page-template #order_review_heading {
      grid-column: 2;
      grid-row: 1;
      margin: 0 0 1rem !important;
      color: #3B4658;
      font-size: 24px;
      font-weight: 800;
      line-height: 1.25;
    }

    #rsp-page-template #order_review {
      grid-column: 2;
      grid-row: 2;
      width: 100%;
      min-width: 0;
      margin: 0;
    }

    #rsp-page-template .woocommerce form .form-row {
      margin: 0 0 1.35rem;
      padding: 0;
      box-sizing: border-box;
    }

    #rsp-page-template .woocommerce form .form-row label {
      display: block;
      margin: 0 0 0.55rem;
      color: #3B4658;
      font-size: 16px;
      font-weight: 700;
      line-height: 1.4;
    }

    #rsp-page-template .woocommerce form .form-row-first,
    #rsp-page-template .woocommerce form .form-row-last {
      float: left !important;
      width: calc(50% - 10px) !important;
      max-width: calc(50% - 10px) !important;
      clear: none !important;
    }

    #rsp-page-template .woocommerce form .form-row-first {
      margin-right: 20px !important;
    }

    #rsp-page-template .woocommerce form .form-row-wide {
      clear: both !important;
      width: 100% !important;
      max-width: 100% !important;
    }

    #rsp-page-template .woocommerce form .form-row input.input-text,
    #rsp-page-template .woocommerce form .form-row textarea,
    #rsp-page-template .woocommerce form .form-row select,
    #rsp-page-template .select2-container--default .select2-selection--single {
      display: block;
      width: 100% !important;
      max-width: none !important;
      min-height: 56px;
      border: 1px solid rgba(148, 163, 184, 0.36);
      border-radius: 14px;
      background: #ffffff;
      color: #020617;
      padding: 14px 16px;
      box-sizing: border-box;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.45;
      outline: none;
      box-shadow: none;
    }

    #rsp-page-template .woocommerce form .form-row textarea {
      min-height: 150px;
      resize: vertical;
    }

    #rsp-page-template .woocommerce form .form-row input.input-text:focus,
    #rsp-page-template .woocommerce form .form-row textarea:focus,
    #rsp-page-template .woocommerce form .form-row select:focus {
      border-color: #2563EB;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
    }

    #rsp-page-template .select2-container {
      width: 100% !important;
      max-width: none !important;
    }

    #rsp-page-template .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #020617;
      line-height: 56px;
      padding-left: 0;
      padding-right: 34px;
    }

    #rsp-page-template .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 56px;
    }

    #rsp-page-template .woocommerce table.shop_table {
      width: 100%;
      margin: 0 0 1.4rem;
      border: 1px solid rgba(148, 163, 184, 0.24);
      border-collapse: separate;
      border-spacing: 0;
      border-radius: 16px;
      overflow: hidden;
      background: #ffffff;
      color: #334155;
      box-shadow: 0 14px 40px rgba(15, 23, 42, 0.05);
    }

    #rsp-page-template .woocommerce table.shop_table th,
    #rsp-page-template .woocommerce table.shop_table td {
      padding: 16px;
      border-color: rgba(148, 163, 184, 0.20);
      color: #475569;
      font-size: 15px;
      line-height: 1.5;
      vertical-align: top;
    }

    #rsp-page-template .woocommerce table.shop_table th,
    #rsp-page-template .woocommerce table.shop_table tfoot th,
    #rsp-page-template .woocommerce table.shop_table tfoot td {
      color: #334155;
      font-weight: 800;
    }

    #rsp-page-template .woocommerce-checkout #payment {
      border: 1px solid rgba(148, 163, 184, 0.24);
      border-radius: 18px;
      background: #F8FAFC;
      color: #334155;
      overflow: hidden;
    }

    #rsp-page-template .woocommerce-checkout #payment ul.payment_methods {
      padding: 20px;
      border-bottom: 1px solid rgba(148, 163, 184, 0.22);
    }

    #rsp-page-template .woocommerce-checkout #payment div.payment_box {
      margin: 12px 0 0;
      padding: 16px;
      border-radius: 12px;
      background: #ffffff;
      color: #334155;
      font-size: 15px;
      line-height: 1.65;
    }

    #rsp-page-template .woocommerce #payment #place_order,
    #rsp-page-template .woocommerce-page #payment #place_order,
    #rsp-page-template .woocommerce button.button,
    #rsp-page-template .woocommerce a.button,
    #rsp-page-template .woocommerce input.button {
      min-height: 52px;
      border: 0;
      border-radius: 14px;
      background: #2563EB;
      color: #ffffff;
      padding: 14px 22px;
      font-size: 16px;
      font-weight: 800;
      line-height: 1.2;
      box-shadow: 0 16px 36px rgba(37, 99, 235, 0.22);
      transition: all 0.2s ease;
    }

    #rsp-page-template .woocommerce #payment #place_order:hover,
    #rsp-page-template .woocommerce-page #payment #place_order:hover,
    #rsp-page-template .woocommerce button.button:hover,
    #rsp-page-template .woocommerce a.button:hover,
    #rsp-page-template .woocommerce input.button:hover {
      background: #1D4ED8;
      color: #ffffff;
      transform: translateY(-2px);
    }

    #rsp-page-template .woocommerce-MyAccount-navigation,
    #rsp-page-template .woocommerce-MyAccount-content,
    #rsp-page-template .woocommerce-cart-form,
    #rsp-page-template .cart-collaterals {
      width: 100%;
      color: #64748B;
    }

    @keyframes rspPageBorderSpin {
      to {
        transform: rotate(360deg);
      }
    }

    @media (max-width: 1100px) {
      #rsp-page-template .woocommerce form.checkout {
        grid-template-columns: 1fr;
        max-width: 760px;
        gap: 32px;
      }

      #rsp-page-template #customer_details,
      #rsp-page-template #order_review_heading,
      #rsp-page-template #order_review {
        grid-column: 1;
        grid-row: auto;
      }
    }

    @media (max-width: 768px) {

      #rsp-page-template .rsp-page-content-card,
      #rsp-page-template .rsp-page-woo-card {
        border-radius: 1.5rem;
        padding: 1.25rem;
      }

      #rsp-page-template .woocommerce form .form-row-first,
      #rsp-page-template .woocommerce form .form-row-last {
        float: none !important;
        width: 100% !important;
        max-width: 100% !important;
        margin-right: 0 !important;
      }

      #rsp-page-template .woocommerce table.shop_table th,
      #rsp-page-template .woocommerce table.shop_table td {
        padding: 12px;
        font-size: 14px;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      #rsp-page-template *,
      #rsp-page-template *::before,
      #rsp-page-template *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important;
        transition-duration: 0.001ms !important;
      }

      #rsp-page-template .rsp-page-reveal {
        opacity: 1;
        transform: none;
      }

      #rsp-page-template .rsp-page-btn:hover {
        transform: none;
      }
    }
  </style>

  <?php while (have_posts()) : the_post(); ?>

    <article
      id="page-<?php the_ID(); ?>"
      <?php post_class('relative overflow-hidden bg-white' . ($is_woocommerce_flow_page ? ' rsp-woocommerce-template' : '')); ?>>

      <!-- Page Hero -->
      <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-14 pt-20 sm:px-6 lg:px-8 lg:pb-16 lg:pt-24">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto max-w-5xl text-center">
          <nav class="rsp-page-reveal mb-8 flex flex-wrap items-center justify-center gap-2 font-['Inter',sans-serif] text-sm font-medium text-slate-500" aria-label="<?php esc_attr_e('Breadcrumb', 'reviewservicepro'); ?>" data-rsp-page-reveal>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="transition-colors duration-200 hover:text-blue-600">
              <?php esc_html_e('Home', 'reviewservicepro'); ?>
            </a>
            <span>/</span>
            <span class="text-slate-600">
              <?php the_title(); ?>
            </span>
          </nav>

          <span class="rsp-page-eyebrow rsp-page-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-page-reveal>
            <i data-lucide="file-text" class="h-4 w-4" aria-hidden="true"></i>
            <?php esc_html_e('ReviewService.Pro', 'reviewservicepro'); ?>
          </span>

          <h1 class="rsp-page-title rsp-page-reveal mx-auto max-w-4xl text-[clamp(36px,5vw,66px)] font-[800] leading-[1.05] tracking-[-0.058em]" data-rsp-page-reveal>
            <?php the_title(); ?>
          </h1>

          <?php if (! empty($page_excerpt)) : ?>
            <p class="rsp-page-text rsp-page-reveal mx-auto mt-6 max-w-3xl" data-rsp-page-reveal>
              <?php echo esc_html($page_excerpt); ?>
            </p>
          <?php endif; ?>
        </div>
      </section>

      <?php if ($has_thumbnail) : ?>
        <section class="relative bg-white px-5 py-10 sm:px-6 lg:px-8">
          <div class="rsp-page-reveal mx-auto max-w-6xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-2 shadow-[0_24px_90px_rgba(15,23,42,0.10)]" data-rsp-page-reveal>
            <?php the_post_thumbnail('full', ['class' => 'h-auto w-full rounded-[1.55rem] object-cover']); ?>
          </div>
        </section>
      <?php endif; ?>

      <!-- Content -->
      <section class="relative overflow-hidden bg-white px-5 py-14 sm:px-6 lg:px-8 lg:py-16">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_10%_20%,rgba(37,99,235,0.05),transparent_28%),radial-gradient(circle_at_90%_70%,rgba(0,200,83,0.05),transparent_28%)]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto <?php echo esc_attr($content_container_class); ?>">
          <div class="rsp-page-reveal <?php echo esc_attr($content_card_class); ?>" data-rsp-page-reveal>
            <div class="<?php echo esc_attr($content_inner_class); ?>">
              <?php
              the_content();

              wp_link_pages(
                [
                  'before' => '<div class="mt-10 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-slate-600">' . esc_html__('Pages:', 'reviewservicepro'),
                  'after'  => '</div>',
                ]
              );
              ?>
            </div>
          </div>
        </div>
      </section>

      <?php if (! $is_woocommerce_flow_page) : ?>
        <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
          <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

          <div class="relative z-10 mx-auto max-w-5xl text-center">
            <div class="rsp-page-reveal rsp-page-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-page-reveal style="--rsp-page-inner:#ffffff;">
              <div class="relative z-10">
                <h2 class="rsp-page-title mx-auto max-w-3xl text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
                  <?php esc_html_e('Need help improving online trust?', 'reviewservicepro'); ?>
                </h2>

                <p class="rsp-page-text mx-auto mt-5 max-w-2xl">
                  <?php esc_html_e('Get a free reputation audit and discover what is affecting your reviews, trust signals, and local visibility.', 'reviewservicepro'); ?>
                </p>

                <a href="<?php echo esc_url($audit_url); ?>" class="rsp-page-btn mt-8 inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-8 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
                  <span class="relative z-10 inline-flex items-center gap-2">
                    <i data-lucide="search-check" class="h-5 w-5" aria-hidden="true"></i>
                    <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>

    </article>

  <?php endwhile; ?>

</main>

<script>
  (function() {
    function initRspPageTemplate() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-rsp-page-reveal]');

      function reveal(item) {
        if (!item || item.dataset.rspPageVisible === 'true') {
          return;
        }

        item.dataset.rspPageVisible = 'true';
        item.classList.add('rsp-visible');
      }

      if ('IntersectionObserver' in window && items.length) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              reveal(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -40px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });

        return;
      }

      items.forEach(reveal);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initRspPageTemplate);
    } else {
      initRspPageTemplate();
    }
  })();
</script>

<?php
get_footer();
