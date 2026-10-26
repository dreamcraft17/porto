function initPortfolioNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!toggle || !panel) {
        return;
    }

    const setOpen = (open) => {
        panel.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        panel.setAttribute('aria-hidden', open ? 'false' : 'true');
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
        link.addEventListener('click', close);
    });

    document.addEventListener('click', (event) => {
        if (!panel.contains(event.target) && !toggle.contains(event.target)) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close(true);
        }
    });

    setOpen(false);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolioNav);
} else {
    initPortfolioNav();
}
