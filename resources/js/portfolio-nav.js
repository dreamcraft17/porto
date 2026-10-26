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

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolioNav);
} else {
    initPortfolioNav();
}
