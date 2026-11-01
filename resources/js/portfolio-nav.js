function initPortfolioNav() {
    const toggle = document.querySelector('[data-rail-toggle]');
    const panel = document.querySelector('[data-rail-panel]');
    const overlay = document.querySelector('[data-rail-overlay]');
    if (!toggle || !panel) {
        return;
    }

    const setOpen = (open) => {
        panel.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        if (overlay) {
            overlay.hidden = !open;
            overlay.classList.toggle('is-visible', open);
        }
        document.body.style.overflow = open ? 'hidden' : '';
    };

    const close = (restoreFocus = false) => {
        setOpen(false);
        if (restoreFocus) {
            toggle.focus();
        }
    };

    toggle.addEventListener('click', () => {
        setOpen(!panel.classList.contains('is-open'));
    });

    panel.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', () => close());
    });

    if (overlay) {
        overlay.addEventListener('click', () => close(true));
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close(true);
        }
    });

    setOpen(false);
}

function initRailScrollSpy() {
    const panel = document.querySelector('[data-rail-panel]');
    if (!panel || !document.getElementById('overview')) {
        return;
    }

    const links = [...panel.querySelectorAll('.rail-nav a[href^="#"]')];
    if (!links.length) {
        return;
    }

    const sections = links
        .map((link) => {
            const id = link.getAttribute('href')?.slice(1);
            const section = id ? document.getElementById(id) : null;
            return section ? { link, section } : null;
        })
        .filter(Boolean);

    if (!sections.length) {
        return;
    }

    const setActive = (activeLink) => {
        links.forEach((link) => {
            const isActive = link === activeLink;
            link.classList.toggle('is-active', isActive);
            if (isActive) {
                link.setAttribute('aria-current', 'location');
            } else {
                link.removeAttribute('aria-current');
            }
        });
    };

    const observer = new IntersectionObserver(
        (entries) => {
            const visible = entries
                .filter((entry) => entry.isIntersecting)
                .sort((a, b) => b.intersectionRatio - a.intersectionRatio);
            if (!visible.length) {
                return;
            }
            const match = sections.find(({ section }) => section === visible[0].target);
            if (match) {
                setActive(match.link);
            }
        },
        {
            root: null,
            rootMargin: '-20% 0px -55% 0px',
            threshold: [0, 0.15, 0.35, 0.55],
        },
    );

    sections.forEach(({ section }) => observer.observe(section));
    setActive(links[0]);
}

function initPortfolioChrome() {
    initPortfolioNav();
    initRailScrollSpy();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolioChrome);
} else {
    initPortfolioChrome();
}
