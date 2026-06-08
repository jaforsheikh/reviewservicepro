<?php

/**
 * Template Name: Cookie Policy Page
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
  exit;
}

get_header();

$last_updated = date_i18n('F Y');

$cookie_categories = [
  [
    'id'    => 'essential',
    'icon'  => 'lock',
    'color' => '#10b981',
    'title' => __('Essential Cookies', 'reviewservicepro'),
    'desc'  => __('These cookies help the website work properly. They support security, basic page functionality, form protection, session handling, and core site features.', 'reviewservicepro'),
    'items' => [
      __('Website security and fraud prevention', 'reviewservicepro'),
      __('Basic page loading and navigation', 'reviewservicepro'),
      __('Contact form and session functionality', 'reviewservicepro'),
    ],
  ],
  [
    'id'    => 'analytics',
    'icon'  => 'bar-chart-3',
    'color' => '#2563eb',
    'title' => __('Analytics Cookies', 'reviewservicepro'),
    'desc'  => __('Analytics cookies help us understand how visitors use our website so we can improve page performance, content quality, user experience, and conversion paths.', 'reviewservicepro'),
    'items' => [
      __('Google Analytics visitor insights', 'reviewservicepro'),
      __('Traffic source and page performance analysis', 'reviewservicepro'),
      __('Aggregated website usage reporting', 'reviewservicepro'),
    ],
  ],
  [
    'id'    => 'marketing',
    'icon'  => 'megaphone',
    'color' => '#8b5cf6',
    'title' => __('Marketing & Advertising Cookies', 'reviewservicepro'),
    'desc'  => __('Marketing cookies may help us measure campaign performance, understand attribution, and show relevant ads to people who have interacted with our website.', 'reviewservicepro'),
    'items' => [
      __('Meta/Facebook Pixel and Google Ads tracking', 'reviewservicepro'),
      __('Retargeting and conversion measurement', 'reviewservicepro'),
      __('Campaign optimization and attribution', 'reviewservicepro'),
    ],
  ],
  [
    'id'    => 'preferences',
    'icon'  => 'sliders-horizontal',
    'color' => '#06b6d4',
    'title' => __('Preference Cookies', 'reviewservicepro'),
    'desc'  => __('Preference cookies may remember choices you make on the website, such as form preferences, interface settings, language preferences, or consent choices.', 'reviewservicepro'),
    'items' => [
      __('Consent and preference settings', 'reviewservicepro'),
      __('Language or interface choices', 'reviewservicepro'),
      __('Personalized browsing preferences', 'reviewservicepro'),
    ],
  ],
  [
    'id'    => 'performance',
    'icon'  => 'gauge',
    'color' => '#d6a84f',
    'title' => __('Performance Cookies', 'reviewservicepro'),
    'desc'  => __('Performance cookies and similar tools may help us monitor page speed, detect technical errors, improve loading experience, and make the website more reliable.', 'reviewservicepro'),
    'items' => [
      __('Site speed and performance checks', 'reviewservicepro'),
      __('Error monitoring and UX improvements', 'reviewservicepro'),
      __('Page stability and technical diagnostics', 'reviewservicepro'),
    ],
  ],
];

$tools = [
  [
    'icon'  => 'activity',
    'title' => __('Google Analytics', 'reviewservicepro'),
    'desc'  => __('Used to understand visitor behavior, traffic sources, page performance, and engagement patterns in aggregated form.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'target',
    'title' => __('Meta Pixel', 'reviewservicepro'),
    'desc'  => __('May be used to measure campaign performance, retarget visitors, and understand advertising effectiveness.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'linkedin',
    'title' => __('LinkedIn Insight Tag', 'reviewservicepro'),
    'desc'  => __('May help measure professional audience engagement and campaign attribution for LinkedIn advertising.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'mouse-pointer-click',
    'title' => __('Microsoft Clarity', 'reviewservicepro'),
    'desc'  => __('May help us understand website interaction patterns, usability issues, and page experience improvements.', 'reviewservicepro'),
  ],
];

$browser_controls = [
  [
    'icon'  => 'chrome',
    'title' => __('Chrome', 'reviewservicepro'),
    'desc'  => __('Open Settings → Privacy and security → Third-party cookies or Site settings to manage cookie permissions.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'compass',
    'title' => __('Safari', 'reviewservicepro'),
    'desc'  => __('Open Safari Settings → Privacy to block or manage cookies and website tracking preferences.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'flame',
    'title' => __('Firefox', 'reviewservicepro'),
    'desc'  => __('Open Settings → Privacy & Security to manage enhanced tracking protection and cookie settings.', 'reviewservicepro'),
  ],
  [
    'icon'  => 'monitor',
    'title' => __('Microsoft Edge', 'reviewservicepro'),
    'desc'  => __('Open Settings → Cookies and site permissions to control cookie storage and tracking preferences.', 'reviewservicepro'),
  ],
];

$third_parties = [
  __('Google', 'reviewservicepro'),
  __('Meta / Facebook', 'reviewservicepro'),
  __('LinkedIn', 'reviewservicepro'),
  __('YouTube embeds', 'reviewservicepro'),
  __('Analytics providers', 'reviewservicepro'),
  __('CRM and form tools', 'reviewservicepro'),
  __('Advertising platforms', 'reviewservicepro'),
  __('Security and performance tools', 'reviewservicepro'),
];

$faqs = [
  [
    'q' => __('What are cookies?', 'reviewservicepro'),
    'a' => __('Cookies are small text files stored on your device when you visit a website. They help websites remember information, improve functionality, measure performance, and support analytics or marketing tools.', 'reviewservicepro'),
  ],
  [
    'q' => __('Do you use cookies for analytics?', 'reviewservicepro'),
    'a' => __('Yes. We may use analytics tools such as Google Analytics or similar services to understand aggregated website usage, traffic sources, and page performance.', 'reviewservicepro'),
  ],
  [
    'q' => __('Do you use marketing pixels?', 'reviewservicepro'),
    'a' => __('We may use marketing pixels such as Meta Pixel, Google Ads tags, or LinkedIn Insight Tag to measure campaign performance, attribution, and retargeting effectiveness.', 'reviewservicepro'),
  ],
  [
    'q' => __('Can I disable cookies?', 'reviewservicepro'),
    'a' => __('Yes. You can manage cookies through your browser settings or any cookie consent tools provided on the website. Some features may not work properly if essential cookies are disabled.', 'reviewservicepro'),
  ],
  [
    'q' => __('Do cookies collect sensitive personal information?', 'reviewservicepro'),
    'a' => __('Our website cookies are not designed to collect sensitive personal information. Analytics and marketing data is generally used for aggregated insights, performance measurement, and campaign improvement.', 'reviewservicepro'),
  ],
  [
    'q' => __('Do third-party platforms manage their own cookies?', 'reviewservicepro'),
    'a' => __('Yes. Third-party services such as Google, Meta, LinkedIn, YouTube, analytics providers, and CRM tools may set or manage their own cookies according to their own policies.', 'reviewservicepro'),
  ],
  [
    'q' => __('Why do you use tracking tools?', 'reviewservicepro'),
    'a' => __('We use tracking tools to improve website experience, understand content performance, measure campaign results, and make our marketing more relevant and transparent.', 'reviewservicepro'),
  ],
  [
    'q' => __('How often is this Cookie Policy updated?', 'reviewservicepro'),
    'a' => __('We may update this Cookie Policy when our tools, tracking technologies, consent systems, or legal requirements change. The latest version will be posted on this page.', 'reviewservicepro'),
  ],
];

$nav_items = [
  'introduction'   => __('Introduction', 'reviewservicepro'),
  'types'          => __('Cookie Types', 'reviewservicepro'),
  'analytics'      => __('Analytics & Pixels', 'reviewservicepro'),
  'consent'        => __('Consent', 'reviewservicepro'),
  'browser'        => __('Browser Control', 'reviewservicepro'),
  'third-party'    => __('Third Parties', 'reviewservicepro'),
  'security'       => __('Security', 'reviewservicepro'),
  'orm-trust'      => __('ORM Trust', 'reviewservicepro'),
  'updates'        => __('Updates', 'reviewservicepro'),
  'cookie-faq'     => __('FAQ', 'reviewservicepro'),
];
?>

<section class="relative overflow-hidden bg-[#020817] py-24 md:py-32">
  <div class="pointer-events-none absolute inset-0 z-0" style="background-image:linear-gradient(rgba(37,99,235,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,0.05) 1px,transparent 1px);background-size:48px 48px;"></div>
  <div class="pointer-events-none absolute -top-24 left-1/2 z-0 h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-blue-600/[0.14] blur-[140px]"></div>
  <div class="pointer-events-none absolute bottom-0 right-0 z-0 h-[420px] w-[520px] rounded-full bg-emerald-500/[0.08] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
    <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.12em] text-emerald-400">
      <i data-lucide="cookie" class="h-4 w-4" aria-hidden="true"></i>
      <?php esc_html_e('Cookie Policy', 'reviewservicepro'); ?>
    </span>

    <h1 class="mb-6 text-4xl font-extrabold leading-tight tracking-tight text-white md:text-6xl">
      <?php esc_html_e('Transparent Tracking.', 'reviewservicepro'); ?>
      <span class="block bg-gradient-to-r from-blue-400 via-cyan-300 to-emerald-300 bg-clip-text text-transparent">
        <?php esc_html_e('Privacy-First Experience.', 'reviewservicepro'); ?>
      </span>
    </h1>

    <p class="mx-auto mb-7 max-w-2xl text-base leading-8 text-slate-400">
      <?php esc_html_e('This Cookie Policy explains how ReviewService.Pro may use cookies, analytics tools, marketing pixels, and similar technologies to improve website performance, measure campaigns, and deliver a better user experience.', 'reviewservicepro'); ?>
    </p>

    <div class="flex flex-wrap justify-center gap-3">
      <span class="rounded-full border border-emerald-500/25 bg-emerald-500/10 px-4 py-2 text-xs font-bold text-emerald-300"><?php esc_html_e('Consent Friendly', 'reviewservicepro'); ?></span>
      <span class="rounded-full border border-blue-500/25 bg-blue-600/10 px-4 py-2 text-xs font-bold text-blue-300"><?php esc_html_e('Analytics Transparency', 'reviewservicepro'); ?></span>
      <span class="rounded-full border border-amber-500/25 bg-amber-500/10 px-4 py-2 text-xs font-bold text-amber-300"><?php echo esc_html(sprintf(__('Last Updated: %s', 'reviewservicepro'), $last_updated)); ?></span>
    </div>
  </div>
</section>

<section class="border-t border-white/[0.05] bg-[#0B1220] py-20 md:py-24">
  <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 sm:px-6 lg:grid-cols-[280px_1fr] lg:px-8">
    <aside class="hidden lg:block">
      <div class="sticky top-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-5">
        <p class="mb-4 text-[11px] font-bold uppercase tracking-[0.14em] text-blue-400">
          <?php esc_html_e('On This Page', 'reviewservicepro'); ?>
        </p>

        <nav class="space-y-1" aria-label="<?php esc_attr_e('Cookie policy navigation', 'reviewservicepro'); ?>">
          <?php foreach ($nav_items as $id => $label) : ?>
            <a href="#<?php echo esc_attr($id); ?>" class="block rounded-xl px-3 py-2 text-sm font-semibold text-slate-400 transition-all duration-200 hover:bg-white/[0.05] hover:text-white">
              <?php echo esc_html($label); ?>
            </a>
          <?php endforeach; ?>
        </nav>
      </div>
    </aside>

    <div class="space-y-6">
      <section id="introduction" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('What Cookies Are & Why We Use Them', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-4 text-base leading-8 text-slate-400">
          <?php esc_html_e('Cookies are small files stored on your device when you visit a website. Similar technologies such as pixels, tags, scripts, and local storage may also be used to help websites function, remember preferences, understand visitor behavior, and measure marketing performance.', 'reviewservicepro'); ?>
        </p>

        <p class="text-base leading-8 text-slate-400">
          <?php esc_html_e('For an ethical ORM agency, transparency matters. We use cookies and tracking technologies to improve our website experience, measure content performance, understand demand for our services, and make our marketing more relevant — not to mislead users or collect sensitive information unnecessarily.', 'reviewservicepro'); ?>
        </p>
      </section>

      <section id="types" class="scroll-mt-28">
        <div class="mb-6">
          <h2 class="mb-3 text-3xl font-extrabold text-white">
            <?php esc_html_e('Types of Cookies We May Use', 'reviewservicepro'); ?>
          </h2>
          <p class="text-sm leading-7 text-slate-400">
            <?php esc_html_e('Different cookies serve different purposes. Some are required for the website to work, while others help us improve performance, reporting, and marketing transparency.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
          <?php foreach ($cookie_categories as $category) : ?>
            <article class="rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6">
              <div class="mb-5 flex items-center gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl border" style="border-color:<?php echo esc_attr($category['color']); ?>44;background:<?php echo esc_attr($category['color']); ?>14;color:<?php echo esc_attr($category['color']); ?>;">
                  <i data-lucide="<?php echo esc_attr($category['icon']); ?>" class="h-6 w-6" aria-hidden="true"></i>
                </div>

                <h3 class="text-xl font-extrabold text-white">
                  <?php echo esc_html($category['title']); ?>
                </h3>
              </div>

              <p class="mb-5 text-sm leading-7 text-slate-400">
                <?php echo esc_html($category['desc']); ?>
              </p>

              <ul class="space-y-2">
                <?php foreach ($category['items'] as $item) : ?>
                  <li class="flex gap-2 text-sm text-slate-300">
                    <i data-lucide="check-circle" class="mt-0.5 h-4 w-4 flex-shrink-0 text-emerald-400" aria-hidden="true"></i>
                    <?php echo esc_html($item); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </article>
          <?php endforeach; ?>
        </div>
      </section>

      <section id="analytics" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('Analytics, Pixels & Campaign Measurement', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-6 text-base leading-8 text-slate-400">
          <?php esc_html_e('We may use analytics and pixel technologies to understand website traffic, user behavior, campaign attribution, conversion activity, and page performance. These tools help us improve the website and measure which content or campaigns are useful to visitors.', 'reviewservicepro'); ?>
        </p>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <?php foreach ($tools as $tool) : ?>
            <article class="rounded-2xl border border-white/[0.08] bg-[#07111F]/80 p-5">
              <div class="mb-3 flex items-center gap-3">
                <i data-lucide="<?php echo esc_attr($tool['icon']); ?>" class="h-5 w-5 text-blue-400" aria-hidden="true"></i>
                <h3 class="text-base font-bold text-white"><?php echo esc_html($tool['title']); ?></h3>
              </div>
              <p class="text-sm leading-7 text-slate-400"><?php echo esc_html($tool['desc']); ?></p>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="mt-6 rounded-2xl border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-5">
          <p class="text-sm leading-7 text-emerald-100/80">
            <?php esc_html_e('These tools are used for aggregated insight, performance improvement, and campaign measurement. They are not intended for sensitive personal spying, fake engagement, or deceptive tracking.', 'reviewservicepro'); ?>
          </p>
        </div>
      </section>

      <section id="consent" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('Cookie Consent & Preference Management', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-6 text-base leading-8 text-slate-400">
          <?php esc_html_e('Where required, we may use a cookie consent banner or preference tool that allows visitors to accept, reject, or customize non-essential cookies. Essential cookies may remain active because they are needed for security and core website functionality.', 'reviewservicepro'); ?>
        </p>

        <div class="rounded-3xl border border-blue-500/[0.18] bg-[#07111F]/90 p-5">
          <p class="mb-4 text-sm font-bold text-white">
            <?php esc_html_e('Example Consent Flow', 'reviewservicepro'); ?>
          </p>

          <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.04] p-4">
              <p class="mb-2 text-sm font-bold text-emerald-300"><?php esc_html_e('Accept', 'reviewservicepro'); ?></p>
              <p class="text-xs leading-6 text-slate-400"><?php esc_html_e('Allows approved analytics, marketing, and preference cookies where applicable.', 'reviewservicepro'); ?></p>
            </div>

            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.04] p-4">
              <p class="mb-2 text-sm font-bold text-amber-300"><?php esc_html_e('Customize', 'reviewservicepro'); ?></p>
              <p class="text-xs leading-6 text-slate-400"><?php esc_html_e('Lets visitors choose which cookie categories they want to allow.', 'reviewservicepro'); ?></p>
            </div>

            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.04] p-4">
              <p class="mb-2 text-sm font-bold text-blue-300"><?php esc_html_e('Reject', 'reviewservicepro'); ?></p>
              <p class="text-xs leading-6 text-slate-400"><?php esc_html_e('Disables non-essential cookies where legally and technically possible.', 'reviewservicepro'); ?></p>
            </div>
          </div>
        </div>
      </section>

      <section id="browser" class="scroll-mt-28">
        <div class="mb-6">
          <h2 class="mb-3 text-3xl font-extrabold text-white">
            <?php esc_html_e('Browser-Level Cookie Controls', 'reviewservicepro'); ?>
          </h2>
          <p class="text-sm leading-7 text-slate-400">
            <?php esc_html_e('You can also manage cookies directly through your browser. Blocking some cookies may affect forms, preferences, analytics, or website functionality.', 'reviewservicepro'); ?>
          </p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <?php foreach ($browser_controls as $browser) : ?>
            <article class="rounded-2xl border border-white/[0.08] bg-white/[0.035] p-5">
              <div class="mb-3 flex items-center gap-3">
                <i data-lucide="<?php echo esc_attr($browser['icon']); ?>" class="h-5 w-5 text-emerald-400" aria-hidden="true"></i>
                <h3 class="text-base font-bold text-white"><?php echo esc_html($browser['title']); ?></h3>
              </div>
              <p class="text-sm leading-7 text-slate-400"><?php echo esc_html($browser['desc']); ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      </section>

      <section id="third-party" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('Third-Party Services', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-6 text-base leading-8 text-slate-400">
          <?php esc_html_e('Some third-party services may set or manage their own cookies, pixels, or tracking technologies. These platforms operate independently and maintain their own privacy and cookie policies.', 'reviewservicepro'); ?>
        </p>

        <div class="flex flex-wrap gap-3">
          <?php foreach ($third_parties as $party) : ?>
            <span class="rounded-full border border-white/[0.10] bg-white/[0.04] px-4 py-2 text-sm font-bold text-slate-300">
              <?php echo esc_html($party); ?>
            </span>
          <?php endforeach; ?>
        </div>
      </section>

      <section id="security" class="scroll-mt-28 rounded-3xl border border-emerald-500/[0.18] bg-emerald-500/[0.06] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('Data, Security & Responsible Tracking', 'reviewservicepro'); ?>
        </h2>

        <p class="mb-5 text-base leading-8 text-emerald-100/80">
          <?php esc_html_e('We use tracking tools responsibly and only to support better website performance, marketing measurement, service improvement, and user experience. We do not use cookies for deceptive tracking, fake engagement, review manipulation, or unethical profiling.', 'reviewservicepro'); ?>
        </p>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
          <div class="rounded-2xl border border-emerald-500/[0.18] bg-[#07111F]/50 p-5">
            <h3 class="mb-2 text-sm font-bold text-emerald-300"><?php esc_html_e('Secure Systems', 'reviewservicepro'); ?></h3>
            <p class="text-xs leading-6 text-emerald-100/70"><?php esc_html_e('We use reasonable safeguards to protect website and form data.', 'reviewservicepro'); ?></p>
          </div>

          <div class="rounded-2xl border border-emerald-500/[0.18] bg-[#07111F]/50 p-5">
            <h3 class="mb-2 text-sm font-bold text-emerald-300"><?php esc_html_e('No Deceptive Tracking', 'reviewservicepro'); ?></h3>
            <p class="text-xs leading-6 text-emerald-100/70"><?php esc_html_e('Tracking is used for transparency, UX improvement, and campaign measurement.', 'reviewservicepro'); ?></p>
          </div>

          <div class="rounded-2xl border border-emerald-500/[0.18] bg-[#07111F]/50 p-5">
            <h3 class="mb-2 text-sm font-bold text-emerald-300"><?php esc_html_e('Privacy-Aware ORM', 'reviewservicepro'); ?></h3>
            <p class="text-xs leading-6 text-emerald-100/70"><?php esc_html_e('Our ethical reputation standards also apply to our digital marketing practices.', 'reviewservicepro'); ?></p>
          </div>
        </div>
      </section>

      <section id="orm-trust" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-[#07111F] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('Our ORM-Specific Digital Ethics', 'reviewservicepro'); ?>
        </h2>

        <p class="text-base leading-8 text-slate-400">
          <?php esc_html_e('As an online reputation management agency, we believe trust must be consistent across everything we do — from review strategy to website analytics. Our cookie and tracking practices are designed to support transparency, platform-compliant marketing, honest measurement, and long-term client confidence.', 'reviewservicepro'); ?>
        </p>
      </section>

      <section id="updates" class="scroll-mt-28 rounded-3xl border border-white/[0.08] bg-white/[0.035] p-6 md:p-8">
        <h2 class="mb-4 text-3xl font-extrabold text-white">
          <?php esc_html_e('Cookie Policy Updates', 'reviewservicepro'); ?>
        </h2>

        <p class="text-base leading-8 text-slate-400">
          <?php esc_html_e('Cookies, analytics tools, marketing pixels, browser rules, and third-party platform policies may change over time. We may update this Cookie Policy to reflect new tools, operational changes, legal requirements, or platform updates. The latest version will always be available on this page.', 'reviewservicepro'); ?>
        </p>
      </section>
    </div>
  </div>
</section>

<section id="cookie-faq" class="border-t border-white/[0.05] bg-[#07111F] py-20 md:py-24">
  <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
    <div class="mb-10 text-center">
      <h2 class="mb-4 text-3xl font-extrabold text-white md:text-5xl">
        <?php esc_html_e('Cookie Policy FAQs', 'reviewservicepro'); ?>
      </h2>
      <p class="text-sm text-slate-400">
        <?php esc_html_e('Simple answers about cookies, analytics, marketing pixels, consent, and browser controls.', 'reviewservicepro'); ?>
      </p>
    </div>

    <div class="space-y-3">
      <?php foreach ($faqs as $faq) : ?>
        <details class="group rounded-2xl border border-white/[0.08] bg-white/[0.035] p-5">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left text-base font-bold text-white">
            <?php echo esc_html($faq['q']); ?>
            <i data-lucide="chevron-down" class="h-5 w-5 flex-shrink-0 text-slate-400 transition-transform duration-300 group-open:rotate-180" aria-hidden="true"></i>
          </summary>

          <p class="mt-4 border-t border-white/[0.08] pt-4 text-sm leading-7 text-slate-400">
            <?php echo esc_html($faq['a']); ?>
          </p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="relative overflow-hidden border-t border-white/[0.05] bg-[#020817] py-20 md:py-24">
  <div class="pointer-events-none absolute -top-24 left-1/2 h-[420px] w-[700px] -translate-x-1/2 rounded-full bg-emerald-500/[0.10] blur-[120px]"></div>

  <div class="relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
    <h2 class="mb-5 text-3xl font-extrabold leading-tight text-white md:text-5xl">
      <?php esc_html_e('Questions about privacy or cookies?', 'reviewservicepro'); ?>
    </h2>

    <p class="mx-auto mb-8 max-w-2xl text-base leading-8 text-slate-400">
      <?php esc_html_e('We aim to make our tracking practices clear, responsible, and easy to understand. You can contact us, view our Privacy Policy, or learn more about our ethical standards.', 'reviewservicepro'); ?>
    </p>

    <div class="flex flex-col justify-center gap-3 sm:flex-row">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-7 py-4 text-sm font-extrabold text-[#031827] transition-all duration-300 hover:-translate-y-1 hover:bg-emerald-400">
        <i data-lucide="mail" class="h-5 w-5" aria-hidden="true"></i>
        <?php esc_html_e('Contact Our Team', 'reviewservicepro'); ?>
      </a>

      <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.14] bg-white/[0.04] px-7 py-4 text-sm font-bold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.08]">
        <?php esc_html_e('View Privacy Policy', 'reviewservicepro'); ?>
        <i data-lucide="arrow-right" class="h-5 w-5" aria-hidden="true"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/trust-center/')); ?>" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/[0.14] bg-white/[0.04] px-7 py-4 text-sm font-bold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.08]">
        <?php esc_html_e('Trust Center', 'reviewservicepro'); ?>
        <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</section>

<?php
get_footer();
