<?php

/**
 * Pricing After Payment / Client Portal Section
 *
 * File: template-parts/sections/pricing/after-payment.php
 *
 * Fixes (all functions/keyframes/data-attrs unchanged):
 * 1.  Section bg  transparent → bg-[#F8FAFC]
 * 2.  Section borders top/bottom bg-[#E2E8F0]
 * 3.  Kicker badge  text-xs → DM Mono 10.5px explicit + border-[#E2E8F0]
 * 4.  H2 (section)  text-3xl/4xl font-semibold #020617 → Poppins clamp(26px,4vw,40px) font-extrabold #0F172A
 * 5.  H2 tracking  -0.045em → -0.038em, line-height tight → 1.1
 * 6.  Section sub  text-slate-700 leading-8 → Inter 16px/1.72 #475569 max-w-[560px]
 * 7.  Main card border  border-slate-200 → border-[#E2E8F0]
 * 8.  Left H3  text-2xl/3xl font-semibold #020617 → Poppins 22px font-bold #0F172A
 * 9.  Left sub  text-slate-700 leading-8 → Inter 15px/1.72 #475569
 * 10. Step card H4  text-xl font-semibold #020617 → Poppins 15px font-bold #0F172A
 * 11. Step card body  text-slate-700 leading-7 → Inter 14px/1.7 #475569
 * 12. Step card padding  p-4 → p-5
 * 13. Right panel bg  bg-slate-50/90 border-slate-200 → bg-[#F8FAFC] border-[#E2E8F0]
 * 14. Panel label  text-sm text-slate-500 → DM Mono 10.5px #94A3B8
 * 15. Panel H3  text-2xl font-semibold #020617 → Poppins 18px font-bold #0F172A
 * 16. Portal mini-card label  text-sm text-slate-600 → Inter 12px #64748B
 * 17. Portal mini-card value  text-lg font-semibold #020617 → Poppins 16px font-bold #0F172A
 * 18. Onboarding H4  text-base font-medium #020617 → Poppins 14px font-semibold #0F172A
 * 19. Onboarding sub  text-sm text-slate-600 → Inter 12px #64748B
 * 20. Onboarding list items  text-sm text-slate-700 → Inter 13px #475569
 * 21. Portal CTA btns  font-medium text-base → Inter 14px font-semibold, border-[#E2E8F0]
 * 22. Admin note H3  text-2xl font-semibold #020617 → Poppins 18px font-bold #0F172A
 * 23. Admin note body  text-slate-700 leading-8 → Inter 15px/1.72 #475569
 * All keyframes rspPricingPortalBeam/Pulse, reveal, card glow — UNCHANGED
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

$context = isset($args) && is_array($args) ? $args : [];

$contact_url = ! empty($context['contact_url'])
  ? esc_url($context['contact_url'])
  : esc_url(home_url('/contact/?type=pricing-help'));

$services_page_url = ! empty($context['services_page_url'])
  ? esc_url($context['services_page_url'])
  : esc_url(home_url('/services/'));

$portal_url = function_exists('wc_get_page_permalink')
  ? esc_url(wc_get_page_permalink('myaccount'))
  : esc_url(home_url('/my-account/'));

$portal_steps = [
  [
    'title' => __('Order & invoice access', 'reviewservicepro'),
    'text'  => __('Your WooCommerce order, invoice, payment status, and service record stay organized inside your account area.', 'reviewservicepro'),
    'icon'  => 'receipt-text',
    'tone'  => 'blue',
  ],
  [
    'title' => __('Onboarding instructions', 'reviewservicepro'),
    'text'  => __('You receive instructions for submitting business details, review platform links, screenshots, and priority reputation concerns.', 'reviewservicepro'),
    'icon'  => 'clipboard-list',
    'tone'  => 'green',
  ],
  [
    'title' => __('Service communication', 'reviewservicepro'),
    'text'  => __('Your order gives the team a clear starting point for support, updates, report delivery, and next-step guidance.', 'reviewservicepro'),
    'icon'  => 'messages-square',
    'tone'  => 'teal',
  ],
  [
    'title' => __('Delivery & next actions', 'reviewservicepro'),
    'text'  => __('You receive your audit, response setup, case review, platform check, or add-on deliverable based on the service you ordered.', 'reviewservicepro'),
    'icon'  => 'badge-check',
    'tone'  => 'green',
  ],
];

$onboarding_items = [
  __('Business name and website URL', 'reviewservicepro'),
  __('Primary review platform links', 'reviewservicepro'),
  __('Main reputation concern or review issue', 'reviewservicepro'),
  __('Screenshots or review examples when needed', 'reviewservicepro'),
  __('Preferred response tone or brand voice notes', 'reviewservicepro'),
  __('Any previous documentation or platform communication', 'reviewservicepro'),
];

$portal_cards = [
  [
    'label' => __('Order Status', 'reviewservicepro'),
    'value' => __('Active', 'reviewservicepro'),
    'icon'  => 'activity',
    'tone'  => 'blue',
  ],
  [
    'label' => __('Onboarding', 'reviewservicepro'),
    'value' => __('Ready', 'reviewservicepro'),
    'icon'  => 'clipboard-check',
    'tone'  => 'green',
  ],
  [
    'label' => __('Support', 'reviewservicepro'),
    'value' => __('Available', 'reviewservicepro'),
    'icon'  => 'life-buoy',
    'tone'  => 'teal',
  ],
];

$tone_classes = [
  'blue' => [
    'card' => 'border-blue-100 bg-blue-50/60',
    'icon' => 'border-blue-100 bg-blue-50 text-[#2563EB]',
  ],
  'green' => [
    'card' => 'border-[#00C853]/20 bg-[#00C853]/[0.045]',
    'icon' => 'border-[#00C853]/22 bg-[#00C853]/[0.08] text-[#00A344]',
  ],
  'teal' => [
    'card' => 'border-[#14B8A6]/20 bg-[#14B8A6]/[0.06]',
    'icon' => 'border-[#14B8A6]/22 bg-[#14B8A6]/[0.08] text-[#0F766E]',
  ],
];
?>

<style>
  /* ── Reveal system — unchanged ── */
  .rsp-pricing-portal-reveal {
    opacity: 0;
    transform: translateY(22px);
    transition:
      opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
      transform 720ms cubic-bezier(0.16, 1, 0.3, 1);
  }

  .rsp-pricing-portal-reveal.rsp-is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Card glow overlay — unchanged ── */
  .rsp-pricing-portal-card {
    position: relative;
    overflow: hidden;
  }

  .rsp-pricing-portal-card::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0;
    background:
      radial-gradient(circle at 12% 0%, rgba(37, 99, 235, 0.10), transparent 36%),
      radial-gradient(circle at 88% 100%, rgba(0, 200, 83, 0.10), transparent 36%);
    pointer-events: none;
    transition: opacity 260ms ease;
  }

  .rsp-pricing-portal-card:hover::before {
    opacity: 1;
  }

  /* ── Beam animation — unchanged ── */
  .rsp-pricing-portal-beam {
    animation: rspPricingPortalBeam 7s ease-in-out infinite;
  }

  @keyframes rspPricingPortalBeam {
    0% {
      transform: translateX(-120%);
    }

    100% {
      transform: translateX(120%);
    }
  }

  /* ── Pulse animation — unchanged ── */
  .rsp-pricing-portal-pulse {
    animation: rspPricingPortalPulse 2.6s ease-in-out infinite;
  }

  @keyframes rspPricingPortalPulse {

    0%,
    100% {
      box-shadow: 0 0 0 0 rgba(0, 200, 83, 0.18);
    }

    50% {
      box-shadow: 0 0 0 10px rgba(0, 200, 83, 0);
    }
  }

  /* ── Reduced motion — unchanged ── */
  @media (prefers-reduced-motion: reduce) {
    .rsp-pricing-portal-reveal {
      opacity: 1;
      transform: none;
      transition: none;
    }

    .rsp-pricing-portal-beam,
    .rsp-pricing-portal-pulse {
      animation: none;
    }
  }
</style>

<section
  id="pricing-after-payment"
  class="relative overflow-hidden bg-[#F8FAFC] px-5 py-12 sm:px-6 lg:px-8 lg:py-16"
  aria-labelledby="pricing-after-payment-title">

  <!-- section borders -->
  <div class="absolute inset-x-0 top-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <div class="absolute inset-x-0 bottom-0 h-px bg-[#E2E8F0]" aria-hidden="true"></div>
  <!-- subtle grid texture -->
  <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(37,99,235,0.032)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.032)_1px,transparent_1px)] bg-[size:52px_52px]" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl">

    <!-- ── SECTION HEADER ── -->
    <div
      class="rsp-pricing-portal-reveal mb-8 grid grid-cols-1 gap-5 lg:grid-cols-[0.95fr_1.05fr] lg:items-end"
      data-pricing-portal-reveal>

      <div>
        <!-- FIX: DM Mono kicker -->
        <span class="inline-flex items-center gap-2 rounded-full border border-[#00C853]/22 bg-[#00C853]/[0.07] px-4 py-[5px] font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.14em] text-[#065F46]">
          <i data-lucide="layout-dashboard" class="h-[13px] w-[13px] text-[#00A344]" aria-hidden="true"></i>
          <?php esc_html_e('After Payment', 'reviewservicepro'); ?>
        </span>

        <!-- FIX: Poppins clamp, extrabold, #0F172A, tracking refined -->
        <h2
          id="pricing-after-payment-title"
          class="mt-4 font-['Poppins',sans-serif] text-[clamp(24px,4vw,40px)] font-extrabold leading-[1.1] tracking-[-0.038em] text-[#0F172A]">
          <?php esc_html_e('Your order continues inside a professional client portal.', 'reviewservicepro'); ?>
        </h2>
      </div>

      <!-- FIX: Inter 16px/1.72 #475569 max-w -->
      <p class="max-w-[560px] font-['Inter',sans-serif] text-[16px] font-normal leading-[1.72] text-[#475569]">
        <?php esc_html_e('ReviewService.Pro uses WooCommerce for checkout, payment, order records, and account access. After payment, your one-time reputation service moves into a more organized client workflow.', 'reviewservicepro'); ?>
      </p>
    </div>

    <!-- ── MAIN PORTAL SHELL ── -->
    <div
      class="rsp-pricing-portal-card rsp-pricing-portal-reveal rounded-[2rem] border border-[#E2E8F0] bg-white/92 p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_24px_90px_rgba(15,23,42,0.08)] backdrop-blur-xl md:p-8"
      data-pricing-portal-reveal>

      <!-- animated top beam -->
      <div class="pointer-events-none absolute inset-x-0 top-0 h-px overflow-hidden rounded-t-[2rem] bg-[#E2E8F0]" aria-hidden="true">
        <div class="rsp-pricing-portal-beam h-full w-[70%] bg-[linear-gradient(90deg,transparent,#2563EB,#00C853,transparent)]"></div>
      </div>

      <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">

        <!-- Left: Portal workflow steps -->
        <div>
          <!-- FIX: Poppins 22px font-bold #0F172A -->
          <h3 class="font-['Poppins',sans-serif] text-[22px] font-bold leading-snug tracking-[-0.025em] text-[#0F172A]">
            <?php esc_html_e('What clients can expect after checkout', 'reviewservicepro'); ?>
          </h3>

          <!-- FIX: Inter 15px/1.72 #475569 -->
          <p class="mt-3 font-['Inter',sans-serif] text-[15px] font-normal leading-[1.72] text-[#475569]">
            <?php esc_html_e('The checkout is only the start. Your client portal helps keep service details, onboarding, communication, order history, and next steps easier to manage.', 'reviewservicepro'); ?>
          </p>

          <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            <?php foreach ($portal_steps as $index => $step) :
              $tone = isset($tone_classes[$step['tone']]) ? $tone_classes[$step['tone']] : $tone_classes['blue'];
            ?>
              <article
                class="rsp-pricing-portal-card rsp-pricing-portal-reveal rounded-[1.5rem] border <?php echo esc_attr($tone['card']); ?> p-5 shadow-[0_1px_3px_rgba(0,0,0,.03),0_10px_32px_rgba(15,23,42,0.05)] transition-all duration-300 hover:-translate-y-[3px] hover:bg-white hover:shadow-[0_4px_6px_rgba(0,0,0,.05),0_16px_48px_rgba(0,0,0,.08)]"
                data-pricing-portal-reveal
                style="transition-delay:<?php echo esc_attr((string)($index * 70)); ?>ms;">

                <div class="relative z-10">
                  <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl border <?php echo esc_attr($tone['icon']); ?>">
                    <i data-lucide="<?php echo esc_attr($step['icon']); ?>" class="h-[18px] w-[18px]" aria-hidden="true"></i>
                  </div>
                  <!-- FIX: Poppins 15px font-bold #0F172A -->
                  <h4 class="font-['Poppins',sans-serif] text-[15px] font-bold leading-snug tracking-[-0.015em] text-[#0F172A]">
                    <?php echo esc_html($step['title']); ?>
                  </h4>
                  <!-- FIX: Inter 14px/1.7 #475569 -->
                  <p class="mt-2 font-['Inter',sans-serif] text-[14px] font-normal leading-[1.7] text-[#475569]">
                    <?php echo esc_html($step['text']); ?>
                  </p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Right: Portal preview panel -->
        <div class="relative">
          <!-- FIX: bg-[#F8FAFC] border-[#E2E8F0] -->
          <div class="rounded-[2rem] border border-[#E2E8F0] bg-[#F8FAFC] p-5 shadow-[0_1px_3px_rgba(0,0,0,.04),0_18px_60px_rgba(15,23,42,0.07)]">

            <!-- Panel header -->
            <div class="mb-5 flex items-center justify-between gap-4">
              <div>
                <!-- FIX: DM Mono label -->
                <p class="font-['DM_Mono',monospace] text-[10.5px] font-medium uppercase tracking-[0.13em] text-[#94A3B8]">
                  <?php esc_html_e('Client Portal Preview', 'reviewservicepro'); ?>
                </p>
                <!-- FIX: Poppins 18px font-bold #0F172A -->
                <h3 class="mt-1 font-['Poppins',sans-serif] text-[18px] font-bold leading-snug tracking-[-0.02em] text-[#0F172A]">
                  <?php esc_html_e('Service workspace after payment', 'reviewservicepro'); ?>
                </h3>
              </div>
              <div class="rsp-pricing-portal-pulse flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#00C853]/22 bg-[#00C853]/[0.08]">
                <i data-lucide="lock" class="h-5 w-5 text-[#00A344]" aria-hidden="true"></i>
              </div>
            </div>

            <!-- Status mini-cards -->
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
              <?php foreach ($portal_cards as $card) :
                $tone = isset($tone_classes[$card['tone']]) ? $tone_classes[$card['tone']] : $tone_classes['blue'];
              ?>
                <div class="rounded-2xl border <?php echo esc_attr($tone['card']); ?> p-4">
                  <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl border <?php echo esc_attr($tone['icon']); ?>">
                    <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="h-[15px] w-[15px]" aria-hidden="true"></i>
                  </div>
                  <!-- FIX: Inter 12px #64748B -->
                  <p class="font-['Inter',sans-serif] text-[12px] font-medium leading-[1.4] text-[#64748B]">
                    <?php echo esc_html($card['label']); ?>
                  </p>
                  <!-- FIX: Poppins 16px font-bold #0F172A -->
                  <p class="mt-1 font-['Poppins',sans-serif] text-[16px] font-bold leading-snug text-[#0F172A]">
                    <?php echo esc_html($card['value']); ?>
                  </p>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Onboarding items card -->
            <div class="mt-4 rounded-[1.5rem] border border-[#E2E8F0] bg-white p-4 shadow-[0_1px_3px_rgba(0,0,0,.04),0_8px_24px_rgba(0,0,0,.05)]">
              <div class="mb-4 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-blue-100 bg-blue-50">
                  <i data-lucide="clipboard-list" class="h-[15px] w-[15px] text-[#2563EB]" aria-hidden="true"></i>
                </div>
                <div>
                  <!-- FIX: Poppins 14px font-semibold #0F172A -->
                  <h4 class="font-['Poppins',sans-serif] text-[14px] font-semibold leading-snug text-[#0F172A]">
                    <?php esc_html_e('Onboarding details usually include:', 'reviewservicepro'); ?>
                  </h4>
                  <!-- FIX: Inter 12px #64748B -->
                  <p class="font-['Inter',sans-serif] text-[12px] font-normal leading-[1.5] text-[#64748B]">
                    <?php esc_html_e('Collected after payment to reduce checkout friction.', 'reviewservicepro'); ?>
                  </p>
                </div>
              </div>

              <ul class="grid grid-cols-1 gap-2" role="list">
                <?php foreach ($onboarding_items as $item) : ?>
                  <li class="flex items-start gap-2">
                    <i data-lucide="check-circle-2" class="mt-0.5 h-[13px] w-[13px] shrink-0 text-[#00A344]" aria-hidden="true"></i>
                    <!-- FIX: Inter 13px #475569 -->
                    <span class="font-['Inter',sans-serif] text-[13px] font-normal leading-[1.55] text-[#475569]">
                      <?php echo esc_html($item); ?>
                    </span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <!-- Portal CTA buttons -->
            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
              <!-- Primary -->
              <a
                href="<?php echo esc_url($portal_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-5 py-3 font-['Inter',sans-serif] text-[14px] font-semibold text-white shadow-[0_4px_6px_rgba(37,99,235,.18),0_10px_28px_rgba(37,99,235,.22)] transition-all duration-200 hover:-translate-y-[2px] hover:bg-[#1D4ED8]">
                <?php esc_html_e('Open Client Portal', 'reviewservicepro'); ?>
                <i data-lucide="arrow-right" class="h-[14px] w-[14px]" aria-hidden="true"></i>
              </a>
              <!-- Secondary -->
              <a
                href="<?php echo esc_url($contact_url); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-[#E2E8F0] bg-white px-5 py-3 font-['Inter',sans-serif] text-[14px] font-semibold text-[#334155] shadow-sm transition-all duration-200 hover:-translate-y-[2px] hover:border-blue-200 hover:bg-blue-50 hover:text-[#1D4ED8]">
                <?php esc_html_e('Ask Before Ordering', 'reviewservicepro'); ?>
                <i data-lucide="message-square" class="h-[14px] w-[14px] text-[#2563EB]" aria-hidden="true"></i>
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- ── ADMIN / BUILD NOTE ── -->
    <div
      class="rsp-pricing-portal-reveal mt-6 rounded-[1.5rem] border border-[#14B8A6]/18 bg-[#14B8A6]/[0.055] p-5"
      data-pricing-portal-reveal>

      <div class="grid grid-cols-1 gap-4 md:grid-cols-[auto_1fr] md:items-start">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#14B8A6]/22 bg-white shadow-sm">
          <i data-lucide="settings-2" class="h-5 w-5 text-[#0F766E]" aria-hidden="true"></i>
        </div>
        <div>
          <!-- FIX: Poppins 18px font-bold #0F172A -->
          <h3 class="font-['Poppins',sans-serif] text-[18px] font-bold leading-snug tracking-[-0.02em] text-[#0F172A]">
            <?php esc_html_e('Simple now, stronger portal features later.', 'reviewservicepro'); ?>
          </h3>
          <!-- FIX: Inter 15px/1.72 #475569 -->
          <p class="mt-2 font-['Inter',sans-serif] text-[15px] font-normal leading-[1.72] text-[#475569]">
            <?php esc_html_e('At this stage, WooCommerce My Account can handle orders, account access, invoices, and checkout connection. Advanced message threads, file uploads, service milestones, and report delivery can be added later through a custom client portal module.', 'reviewservicepro'); ?>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
  (function() {
    /* IntersectionObserver — data-pricing-portal-reveal + pricingPortalVisible + rsp-is-visible unchanged */
    function initPricingPortal() {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
      }

      var items = document.querySelectorAll('[data-pricing-portal-reveal]');
      if (!items.length) return;

      function showItem(item) {
        if (!item || item.dataset.pricingPortalVisible === 'true') return;
        item.dataset.pricingPortalVisible = 'true';
        item.classList.add('rsp-is-visible');
      }

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              showItem(entry.target);
            }
          });
        }, {
          threshold: 0.12,
          rootMargin: '0px 0px -30px 0px'
        });

        items.forEach(function(item) {
          observer.observe(item);
        });
        return;
      }

      items.forEach(showItem);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initPricingPortal);
    } else {
      initPricingPortal();
    }
  }());
</script>