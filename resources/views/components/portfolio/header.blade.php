<header class="site-headbar">
    <a class="head-brand" href="#overview">
        <span class="brand-mark">DN</span>
        <span>
            <span class="brand-name">Dozer Napitupulu</span>
            <span class="brand-role">Fullstack engineer</span>
        </span>
    </a>

    <button
        type="button"
        class="head-nav-toggle"
        data-nav-toggle
        aria-expanded="false"
        aria-controls="site-nav-panel"
        aria-label="Open menu"
    >
        <i class="fas fa-bars" aria-hidden="true"></i>
    </button>

    <nav class="head-nav" id="site-nav-panel" data-nav-panel aria-label="Primary navigation">
        <a href="#overview">Overview</a>
        <a href="#about">Profile</a>
        <a href="#work">Work</a>
        <a href="#experience">History</a>
        @if(isset($certifications) && $certifications->count())
            <a href="#certifications">Certs</a>
        @endif
        <a class="head-cta" href="#contact">Email or brief</a>
    </nav>
</header>
