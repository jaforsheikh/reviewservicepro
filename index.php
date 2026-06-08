<?php

/**
 * Main Index Template
 *
 * ReviewService.Pro — Premium White SaaS Blog Fallback
 *
 * File: index.php
 *
 * @package ReviewServicePro
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main
    id="primary"
    class="relative overflow-hidden bg-white"
    role="main">

    <style>
        #primary {
            --rsp-index-title: #334155;
            --rsp-index-heading: #3B4658;
            --rsp-index-body: #64748B;
            --rsp-index-blue: #2563EB;
            --rsp-index-green: #00C853;
            --rsp-index-teal: #14B8A6;
        }

        #primary .rsp-index-title,
        #primary .rsp-index-heading {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        #primary .rsp-index-title {
            color: var(--rsp-index-title);
            text-wrap: balance;
        }

        #primary .rsp-index-heading {
            color: var(--rsp-index-heading);
        }

        #primary .rsp-index-text,
        #primary .rsp-index-body {
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 16px;
            line-height: 1.78;
            color: var(--rsp-index-body);
        }

        #primary .rsp-index-text {
            font-weight: 500;
        }

        #primary .rsp-index-body {
            font-weight: 400;
        }

        #primary .rsp-index-eyebrow {
            font-family: "DM Mono", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        #primary .rsp-index-reveal {
            opacity: 0;
            transform: translateY(24px);
            transition:
                opacity 720ms cubic-bezier(0.16, 1, 0.3, 1),
                transform 720ms cubic-bezier(0.16, 1, 0.3, 1),
                box-shadow 320ms ease,
                border-color 320ms ease;
        }

        #primary .rsp-index-reveal.rsp-visible {
            opacity: 1;
            transform: translateY(0);
        }

        #primary .rsp-index-motion-border {
            position: relative;
            isolation: isolate;
            overflow: hidden;
        }

        #primary .rsp-index-motion-border::before {
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
            animation: rspIndexBorderSpin 8s linear infinite;
            pointer-events: none;
            transition: opacity 260ms ease;
        }

        #primary .rsp-index-motion-border::after {
            content: "";
            position: absolute;
            inset: 1px;
            z-index: -1;
            border-radius: inherit;
            background: var(--rsp-index-inner, #ffffff);
            pointer-events: none;
        }

        #primary .rsp-index-motion-border:hover::before {
            opacity: 1;
            animation-duration: 4.2s;
        }

        #primary .rsp-index-card {
            transition:
                transform 320ms cubic-bezier(0.2, 0.9, 0.2, 1),
                box-shadow 320ms ease,
                border-color 260ms ease,
                background-color 260ms ease;
        }

        #primary .rsp-index-card:hover {
            transform: translateY(-6px);
            border-color: rgba(37, 99, 235, 0.24);
            box-shadow: 0 22px 70px rgba(15, 23, 42, 0.11);
        }

        #primary .rsp-index-card-image img {
            transition: transform 620ms cubic-bezier(0.2, 0.9, 0.2, 1);
        }

        #primary .rsp-index-card:hover .rsp-index-card-image img {
            transform: scale(1.06);
        }

        #primary .rsp-index-btn {
            position: relative;
            overflow: hidden;
            transition:
                transform 260ms cubic-bezier(0.2, 0.9, 0.2, 1),
                box-shadow 260ms ease,
                border-color 260ms ease,
                background-color 260ms ease;
        }

        #primary .rsp-index-btn::before {
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

        #primary .rsp-index-btn:hover {
            transform: translateY(-3px);
        }

        #primary .rsp-index-btn:hover::before {
            left: 135%;
        }

        #primary .rsp-index-pagination .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
        }

        #primary .rsp-index-pagination .page-numbers {
            display: inline-flex;
            min-width: 44px;
            height: 44px;
            align-items: center;
            justify-content: center;
            border-radius: 0.9rem;
            border: 1px solid rgba(148, 163, 184, 0.26);
            background: #ffffff;
            padding: 0 0.9rem;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 800;
            color: #475569;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
            transition:
                transform 220ms ease,
                background-color 220ms ease,
                border-color 220ms ease,
                color 220ms ease;
        }

        #primary .rsp-index-pagination .page-numbers:hover,
        #primary .rsp-index-pagination .page-numbers.current {
            transform: translateY(-2px);
            border-color: rgba(37, 99, 235, 0.28);
            background: #2563EB;
            color: #ffffff;
        }

        @keyframes rspIndexBorderSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            #primary *,
            #primary *::before,
            #primary *::after {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.001ms !important;
            }

            #primary .rsp-index-reveal {
                opacity: 1;
                transform: none;
            }

            #primary .rsp-index-card:hover,
            #primary .rsp-index-btn:hover {
                transform: none;
            }

            #primary .rsp-index-card:hover .rsp-index-card-image img {
                transform: none;
            }
        }
    </style>

    <!-- Hero -->
    <section class="relative overflow-hidden border-b border-slate-200 bg-[#F8FAFC] px-5 pb-16 pt-20 sm:px-6 lg:px-8 lg:pb-20 lg:pt-24">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.04)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -left-32 top-10 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/45 blur-[130px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-32 bottom-0 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/45 blur-[130px]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto max-w-7xl">
            <div class="mx-auto max-w-4xl text-center">
                <span class="rsp-index-eyebrow rsp-index-reveal mb-5 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-blue-700 shadow-sm" data-rsp-index-reveal>
                    <i data-lucide="book-open" class="h-4 w-4" aria-hidden="true"></i>
                    <?php esc_html_e('ReviewService.Pro Blog', 'reviewservicepro'); ?>
                </span>

                <h1 class="rsp-index-title rsp-index-reveal mx-auto text-[clamp(38px,5.6vw,74px)] font-[800] leading-[1.04] tracking-[-0.06em]" data-rsp-index-reveal>
                    <?php esc_html_e('Reputation Management Insights & Articles', 'reviewservicepro'); ?>
                </h1>

                <p class="rsp-index-text rsp-index-reveal mx-auto mt-6 max-w-3xl" data-rsp-index-reveal>
                    <?php esc_html_e('Explore practical guides on reviews, customer trust, local visibility, customer experience, and ethical online reputation management.', 'reviewservicepro'); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="relative overflow-hidden bg-[#F8FAFC] px-5 py-20 sm:px-6 lg:px-8 lg:py-24">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[linear-gradient(rgba(37,99,235,0.035)_1px,transparent_1px),linear-gradient(90deg,rgba(37,99,235,0.035)_1px,transparent_1px)] bg-[size:56px_56px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -left-32 top-20 z-0 h-[520px] w-[520px] rounded-full bg-blue-200/35 blur-[130px]" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-32 bottom-20 z-0 h-[520px] w-[520px] rounded-full bg-emerald-200/40 blur-[130px]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto max-w-7xl">

            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php
                    $post_index = 0;

                    while (have_posts()) :
                        the_post();

                        $categories = get_the_category();
                        $delay      = min($post_index * 70, 420);
                    ?>
                        <article
                            <?php post_class('rsp-index-card rsp-index-reveal overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)]'); ?>
                            data-rsp-index-reveal
                            style="transition-delay: <?php echo esc_attr((string) $delay); ?>ms;">

                            <a href="<?php the_permalink(); ?>" class="block h-full no-underline">
                                <div class="rsp-index-card-image h-56 overflow-hidden bg-slate-100">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', ['class' => 'h-full w-full object-cover']); ?>
                                    <?php else : ?>
                                        <div class="flex h-full items-center justify-center bg-gradient-to-br from-blue-50 via-white to-emerald-50">
                                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-white text-blue-600 shadow-sm">
                                                <i data-lucide="file-text" class="h-8 w-8" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="p-6">
                                    <?php if ($categories) : ?>
                                        <div class="mb-4 flex flex-wrap gap-2">
                                            <?php foreach (array_slice($categories, 0, 2) as $category) : ?>
                                                <span class="rsp-index-eyebrow rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-blue-700">
                                                    <?php echo esc_html($category->name); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h2 class="rsp-index-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                                        <?php the_title(); ?>
                                    </h2>

                                    <p class="rsp-index-body mt-4">
                                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?>
                                    </p>

                                    <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                                        <span class="inline-flex items-center gap-1.5 font-['Inter',sans-serif] text-sm font-semibold text-slate-500">
                                            <i data-lucide="calendar" class="h-4 w-4" aria-hidden="true"></i>
                                            <?php echo esc_html(get_the_date()); ?>
                                        </span>

                                        <span class="inline-flex items-center gap-2 font-['Inter',sans-serif] text-sm font-[800] text-blue-700">
                                            <?php esc_html_e('Read Article', 'reviewservicepro'); ?>
                                            <i data-lucide="arrow-right" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php
                        $post_index++;
                    endwhile;
                    ?>
                </div>

                <div class="rsp-index-pagination mt-12">
                    <?php
                    the_posts_pagination(
                        [
                            'mid_size'           => 2,
                            'prev_text'          => esc_html__('Previous', 'reviewservicepro'),
                            'next_text'          => esc_html__('Next', 'reviewservicepro'),
                            'screen_reader_text' => esc_html__('Posts navigation', 'reviewservicepro'),
                        ]
                    );
                    ?>
                </div>

            <?php else : ?>

                <div class="rsp-index-reveal mx-auto max-w-3xl rounded-[2rem] border border-slate-200 bg-white p-10 text-center shadow-[0_18px_60px_rgba(15,23,42,0.07)]" data-rsp-index-reveal>
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 text-blue-600">
                        <i data-lucide="file-x" class="h-7 w-7" aria-hidden="true"></i>
                    </div>

                    <h2 class="rsp-index-heading text-2xl font-[800] leading-tight tracking-[-0.04em]">
                        <?php esc_html_e('No posts found.', 'reviewservicepro'); ?>
                    </h2>

                    <p class="rsp-index-text mx-auto mt-4 max-w-xl">
                        <?php esc_html_e('Start publishing posts to build your ORM Academy and reputation management content hub.', 'reviewservicepro'); ?>
                    </p>

                    <a href="<?php echo esc_url(home_url('/orm-academy/')); ?>" class="rsp-index-btn mt-7 inline-flex min-h-[52px] items-center justify-center gap-2 rounded-2xl bg-[#2563EB] px-6 py-3 font-['Inter',sans-serif] text-[16px] font-[800] text-white no-underline shadow-[0_16px_36px_rgba(37,99,235,0.24)] hover:bg-blue-700 hover:text-white">
                        <span class="relative z-10 inline-flex items-center gap-2">
                            <i data-lucide="book-open" class="h-4 w-4" aria-hidden="true"></i>
                            <?php esc_html_e('Browse ORM Academy', 'reviewservicepro'); ?>
                        </span>
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <!-- CTA -->
    <section class="relative overflow-hidden border-t border-slate-200 bg-white px-5 py-20 sm:px-6 lg:px-8">
        <div class="pointer-events-none absolute inset-0 z-0 bg-[radial-gradient(circle_at_12%_20%,rgba(37,99,235,0.07),transparent_30%),radial-gradient(circle_at_88%_70%,rgba(0,200,83,0.07),transparent_30%)]" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto max-w-7xl">
            <div class="rsp-index-reveal rsp-index-motion-border rounded-[2rem] border border-slate-200 bg-white p-7 text-center shadow-[0_24px_90px_rgba(15,23,42,0.09)] md:p-10" data-rsp-index-reveal style="--rsp-index-inner:#ffffff;">
                <div class="relative z-10 mx-auto max-w-4xl">
                    <span class="rsp-index-eyebrow mb-4 inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-emerald-700">
                        <i data-lucide="shield-check" class="h-4 w-4" aria-hidden="true"></i>
                        <?php esc_html_e('Free Reputation Audit', 'reviewservicepro'); ?>
                    </span>

                    <h2 class="rsp-index-title text-[clamp(30px,4vw,52px)] font-[800] leading-[1.08] tracking-[-0.055em]">
                        <?php esc_html_e('Need help improving your reputation?', 'reviewservicepro'); ?>
                    </h2>

                    <p class="rsp-index-text mx-auto mt-5 max-w-2xl">
                        <?php esc_html_e('Get a free reputation audit and discover what is hurting your online trust, visibility, and customer conversion rate.', 'reviewservicepro'); ?>
                    </p>

                    <a href="<?php echo esc_url(home_url('/contact/?type=audit')); ?>" class="rsp-index-btn mt-8 inline-flex min-h-[56px] items-center justify-center gap-2 rounded-2xl bg-[#00C853] px-7 py-4 font-['Inter',sans-serif] text-[16px] font-[800] text-[#062012] no-underline shadow-[0_16px_36px_rgba(0,200,83,0.20)] hover:bg-emerald-400 hover:text-[#062012]">
                        <span class="relative z-10 inline-flex items-center gap-2">
                            <i data-lucide="shield-check" class="h-5 w-5" aria-hidden="true"></i>
                            <?php esc_html_e('Get Free Reputation Audit', 'reviewservicepro'); ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    (function() {
        function initRspIndexPage() {
            if (window.lucide && typeof window.lucide.createIcons === 'function') {
                window.lucide.createIcons();
            }

            var items = document.querySelectorAll('[data-rsp-index-reveal]');

            function reveal(item) {
                if (!item || item.dataset.rspIndexVisible === 'true') {
                    return;
                }

                item.dataset.rspIndexVisible = 'true';
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
            document.addEventListener('DOMContentLoaded', initRspIndexPage);
        } else {
            initRspIndexPage();
        }
    })();
</script>

<?php
get_footer();
