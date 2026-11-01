function initSiteNav() {
    const header = document.querySelector('[data-site-header]');
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!header || !toggle || !panel) {
        return;
    }

    header.classList.add('has-js');

    const setOpen = (open) => {
        panel.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.textContent = open ? 'Close' : 'Menu';
    };

    const close = (restoreFocus = false) => {
        if (!panel.classList.contains('is-open')) {
            return;
        }
        setOpen(false);
        if (restoreFocus) {
            toggle.focus();
        }
    };

    toggle.addEventListener('click', () => {
        setOpen(!panel.classList.contains('is-open'));
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => close());
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close(true);
        }
    });

    document.addEventListener('click', (event) => {
        if (!header.contains(event.target)) {
            close();
        }
    });

    window.matchMedia('(min-width: 861px)').addEventListener('change', (event) => {
        if (event.matches) {
            close();
        }
    });
}

function initScrollSpy() {
    const panel = document.querySelector('[data-nav-panel]');
    if (!panel || !document.getElementById('overview')) {
        return;
    }

    const sections = [...panel.querySelectorAll('a[href^="#"]')]
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
        sections.forEach(({ link }) => {
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
            setActive(match ? match.link : null);
        },
        {
            root: null,
            rootMargin: '-20% 0px -55% 0px',
            threshold: [0, 0.15, 0.35, 0.55],
        },
    );

    sections.forEach(({ section }) => observer.observe(section));
}

function initPortfolioChrome() {
    initSiteNav();
    initScrollSpy();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolioChrome);
} else {
    initPortfolioChrome();
}
