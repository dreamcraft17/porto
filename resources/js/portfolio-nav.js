function initPortfolioNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!toggle || !panel) {
        return;
    }

    const close = () => {
        panel.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
    };

    toggle.addEventListener('click', () => {
        const open = panel.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
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
            close();
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolioNav);
} else {
    initPortfolioNav();
}
