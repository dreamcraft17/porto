/**
 * Porto epic scroll — parallax hero + in-view reveals
 * Author: Dozer
 */

function motionAllowed() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return false;
  if (window.matchMedia('(pointer: coarse)').matches) return false;
  return true;
}

function splitTitle(el) {
  if (!el || el.dataset.epicSplit === '1') return;
  const text = el.textContent.trim();
  const words = text.split(/\s+/);
  el.textContent = '';
  el.classList.add('epic-split');
  words.forEach((word, i) => {
    const wrap = document.createElement('span');
    wrap.className = 'epic-word';
    wrap.style.setProperty('--i', String(i));
    const inner = document.createElement('span');
    inner.className = 'epic-word-inner';
    inner.style.setProperty('--i', String(i));
    inner.textContent = word + (i < words.length - 1 ? '\u00a0' : '');
    wrap.appendChild(inner);
    el.appendChild(wrap);
  });
  el.dataset.epicSplit = '1';
}

function initRevealObserver(root) {
  const targets = root.querySelectorAll('.epic-reveal, .epic-stagger');
  if (!targets.length) return;

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    },
    { root: null, rootMargin: '0px 0px -12% 0px', threshold: 0.12 },
  );

  targets.forEach((el) => io.observe(el));
}

async function initHeroParallax(scene) {
  const depth0 = scene.querySelector('[data-depth="0"]');
  const depth3 = scene.querySelector('[data-depth="3"]');
  if (!depth0 && !depth3) return;

  try {
    const { gsap } = await import('gsap');
    const { ScrollTrigger } = await import('gsap/ScrollTrigger');
    gsap.registerPlugin(ScrollTrigger);

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: scene,
        start: 'top top',
        end: 'bottom top',
        scrub: 0.6,
      },
    });

    if (depth0) tl.to(depth0, { y: 48, scale: 1.02, ease: 'none' }, 0);
    if (depth3) tl.to(depth3, { y: -32, ease: 'none' }, 0);

    const copy = scene.querySelector('.epic-copy');
    if (copy) tl.to(copy, { y: 16, opacity: 0.92, ease: 'none' }, 0);
  } catch {
    /* GSAP unavailable — static layout is fine */
  }
}

function initPortfolioEpic() {
  const shell = document.querySelector('.portfolio-shell--epic');
  if (!shell) return;

  const title = shell.querySelector('.intro-title');
  splitTitle(title);
  shell.classList.add('is-ready');

  initRevealObserver(shell);

  const stagger = shell.querySelector('.stat-row.epic-stagger');
  if (stagger) {
    stagger.querySelectorAll('.proof-item').forEach((item, i) => {
      item.style.setProperty('--i', String(i));
    });
  }

  if (motionAllowed()) {
    const hero = shell.querySelector('.scene-hero');
    if (hero) void initHeroParallax(hero);
  } else {
    shell.querySelectorAll('.epic-reveal, .epic-stagger').forEach((el) => el.classList.add('is-visible'));
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initPortfolioEpic);
} else {
  initPortfolioEpic();
}
