/**
 * Porto epic scroll theatre
 * Techniques: multi-layer parallax, pinned scrub, split converge,
 * word lighting, companion scatter, section reveals, cascading work cards.
 * Author: Dozer
 */
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isCoarse = window.matchMedia('(pointer: coarse)').matches;

function splitWords(el, { wrap = 'span', className = 'word' } = {}) {
    if (!el || el.dataset.split === '1') {
        return Array.from(el?.querySelectorAll(`.${className}`) || []);
    }

    const text = el.textContent.trim();
    el.setAttribute('aria-label', text);
    el.innerHTML = '';

    const words = text.split(/\s+/);
    words.forEach((word, i) => {
        const span = document.createElement(wrap);
        span.className = className;
        span.textContent = word;
        span.setAttribute('aria-hidden', 'true');
        el.appendChild(span);
        if (i < words.length - 1) {
            el.appendChild(document.createTextNode(' '));
        }
    });

    el.dataset.split = '1';
    return Array.from(el.querySelectorAll(`.${className}`));
}

function initHeroScene() {
    const scene = document.querySelector('[data-scene="hero"]');
    if (!scene) {
        return;
    }

    const title = scene.querySelector('[data-animate="converge"]');
    const lead = scene.querySelector('[data-animate="word-light"]');
    const portrait = scene.querySelector('.hero-portrait');
    const companions = scene.querySelectorAll('[data-companion]');
    const accents = scene.querySelectorAll('.hero-accent');
    const meta = scene.querySelector('[data-animate="fade-up"].hero-meta');
    const actions = scene.querySelector('.hero-actions');
    const particles = scene.querySelectorAll('.fx-particle');
    const bg = scene.querySelector('.hero-bg');
    const glow = scene.querySelectorAll('.glow-blob');

    const titleWords = title ? splitWords(title) : [];
    const mid = Math.floor(titleWords.length / 2);
    const leftWords = titleWords.slice(0, mid);
    const rightWords = titleWords.slice(mid);

    if (lead) {
        lead.classList.add('word-light');
        splitWords(lead);
    }
    const leadWords = lead ? Array.from(lead.querySelectorAll('.word')) : [];

    if (prefersReduced) {
        titleWords.forEach((w) => {
            w.style.opacity = '1';
            w.style.transform = 'none';
        });
        leadWords.forEach((w) => w.classList.add('is-lit'));
        return;
    }

    const intensity = isCoarse ? 0.55 : 1;

    // Depth parallax on absolute layers
    [
        { el: bg, y: -12 * intensity },
        { el: glow, y: -8 * intensity },
        { el: accents, y: -18 * intensity },
        { el: particles, y: -28 * intensity },
    ].forEach(({ el, y }) => {
        const targets = el?.length !== undefined ? el : el ? [el] : [];
        if (!targets.length) {
            return;
        }
        gsap.to(targets, {
            yPercent: y,
            ease: 'none',
            scrollTrigger: {
                trigger: scene,
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            },
        });
    });

    // Load entrance (not scrubbed) — content visible without scrolling
    const intro = gsap.timeline({ defaults: { ease: 'power3.out' } });

    if (leftWords.length || rightWords.length) {
        intro.from(leftWords, { x: '-35vw', opacity: 0, duration: 0.85, stagger: 0.04 }, 0);
        intro.from(rightWords, { x: '35vw', opacity: 0, duration: 0.85, stagger: -0.04 }, 0);
    }
    if (meta) {
        intro.from(meta, { opacity: 0, y: 18, duration: 0.5 }, 0.15);
    }
    if (portrait) {
        intro.from(portrait, { scale: 0.9, opacity: 0, y: 36, duration: 0.9 }, 0.12);
    }
    if (actions) {
        intro.from(actions, { opacity: 0, y: 20, duration: 0.45 }, 0.35);
    }
    if (companions.length) {
        intro.from(companions, { opacity: 0, y: 14, duration: 0.4, stagger: 0.05 }, 0.4);
    }
    if (accents.length && !isCoarse) {
        intro.from(accents, { opacity: 0, scale: 0.9, duration: 0.5, stagger: 0.06 }, 0.3);
    }

    // Scrub while pinned — word lighting, grow, scatter exit
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: scene,
            start: 'top top',
            end: '+=160%',
            pin: true,
            scrub: isCoarse ? 0.6 : 1.1,
            anticipatePin: 1,
        },
    });

    if (leadWords.length) {
        leadWords.forEach((word, i) => {
            tl.call(() => word.classList.add('is-lit'), null, 0.08 + i * 0.04);
        });
    }

    if (portrait) {
        tl.fromTo(portrait, { scale: 1 }, { scale: 1.08, duration: 0.45, ease: 'none' }, 0.2);
    }

    if (companions.length) {
        const scatter = [
            { x: -80, y: -40 },
            { x: 90, y: -30 },
            { x: -70, y: 50 },
            { x: 100, y: 40 },
        ];
        companions.forEach((node, i) => {
            const s = scatter[i % scatter.length];
            tl.to(
                node,
                {
                    x: s.x * intensity,
                    y: s.y * intensity,
                    opacity: 0,
                    duration: 0.3,
                    ease: 'power2.in',
                },
                0.65,
            );
        });
    }

    if (accents.length) {
        tl.to(accents, { opacity: 0, scale: 0.85, duration: 0.25, stagger: 0.03 }, 0.68);
    }

    if (titleWords.length) {
        tl.to(titleWords, { opacity: 0.4, y: -18, duration: 0.3, stagger: 0.01 }, 0.72);
    }

    if (lead) {
        tl.to(lead, { opacity: 0.45, duration: 0.25 }, 0.75);
    }
}

function initSectionReveals() {
    if (prefersReduced) {
        document.querySelectorAll('[data-reveal], [data-reveal-stagger], [data-clip-birth]').forEach((el) => {
            el.classList.add('is-in');
        });
        return;
    }

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    io.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -12% 0px', threshold: 0.12 },
    );

    document.querySelectorAll('[data-reveal], [data-reveal-stagger], [data-clip-birth]').forEach((el) => {
        io.observe(el);
    });
}

function initWorkCascade() {
    // CSS data-reveal-stagger already handles enter — avoid GSAP opacity:0 that can stick
}

function initExperienceScrub() {
    if (prefersReduced || isCoarse) {
        return;
    }

    const entries = gsap.utils.toArray('.roadmap-entry');
    entries.forEach((entry) => {
        gsap.from(entry, {
            x: -24,
            duration: 0.55,
            ease: 'power2.out',
            clearProps: 'transform',
            scrollTrigger: {
                trigger: entry,
                start: 'top 90%',
                toggleActions: 'play none none none',
            },
        });
    });
}

function showStatic() {
    document.querySelectorAll('[data-reveal], [data-reveal-stagger], [data-clip-birth]').forEach((el) => {
        el.classList.add('is-in');
    });
}

function init() {
    const shell = document.querySelector('.portfolio-shell');
    if (!shell || !document.querySelector('[data-scene="hero"]')) {
        return;
    }

    shell.classList.add('portfolio-shell--epic');

    if (prefersReduced) {
        showStatic();
        ScrollTrigger.getAll().forEach((t) => t.kill());
        return;
    }

    try {
        // Attach reveals BEFORE hiding, then mark ready so CSS can hide unread items
        initSectionReveals();
        shell.classList.add('epic-ready');
        initHeroScene();
        initWorkCascade();
        initExperienceScrub();
        ScrollTrigger.refresh();

        // Anything already in (or near) the viewport — force visible now
        requestAnimationFrame(() => {
            document.querySelectorAll('[data-reveal], [data-reveal-stagger], [data-clip-birth]').forEach((el) => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.95 && rect.bottom > 0) {
                    el.classList.add('is-in');
                }
            });
        });
    } catch (err) {
        console.error('[porto-epic] init failed, showing static content', err);
        shell.classList.remove('epic-ready');
        showStatic();
        ScrollTrigger.getAll().forEach((t) => t.kill());
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
