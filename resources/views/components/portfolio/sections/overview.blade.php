<section id="overview" class="section-wrap intro-section">
    <div>
        <div class="eyebrow">DOZER / FULLSTACK ENGINEER</div>
        <h1 class="intro-title">I build software that keeps real teams moving.</h1>
        <p class="intro-copy">
            Web apps, APIs, mobile workflows, and dashboards for the messy middle of a business—the place where good software saves time every day.
        </p>
        <div class="intro-actions">
            <a class="action-primary" href="#work">Explore the work <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            <a class="action-secondary" href="#contact">Start a conversation</a>
        </div>
        <div class="hero-stack" aria-label="Primary stack">
            <span>Laravel</span>
            <span>ASP.NET</span>
            <span>Flutter</span>
            <span>SQL Server / MySQL</span>
            <span>REST APIs</span>
        </div>
    </div>

    <div class="intro-panel">
        <div class="portrait-block">
            <img src="{{ asset('images/profile/dozer.png') }}" alt="Portrait of Dozer Napitupulu" width="640" height="800" loading="eager" decoding="async">
        </div>
        <div class="proof-strip" aria-label="Portfolio summary">
            <div class="proof-item">
                <div class="proof-top">
                    <span class="proof-value">5+</span>
                    <span class="proof-icon"><i class="fas fa-briefcase" aria-hidden="true"></i></span>
                </div>
                <span class="proof-label">Years in production code</span>
                <span class="proof-note">Cafe POS, banking modules, internal HR, seller finance.</span>
            </div>
            <div class="proof-item">
                <div class="proof-top">
                    <span class="proof-value">20+</span>
                    <span class="proof-icon"><i class="fas fa-diagram-project" aria-hidden="true"></i></span>
                </div>
                <span class="proof-label">Delivered projects</span>
                <span class="proof-note">Dashboards, mobile ops, integrations, CMS-backed sites.</span>
            </div>
            <div class="proof-item">
                <div class="proof-top">
                    <span class="proof-value">{{ $skills->count() }}+</span>
                    <span class="proof-icon"><i class="fas fa-code-branch" aria-hidden="true"></i></span>
                </div>
                <span class="proof-label">Skills in CMS</span>
                <span class="proof-note">
                    @foreach($skills->take(4) as $skill)
                        {{ $skill->name }}@if(!$loop->last), @endif
                    @endforeach
                </span>
            </div>
        </div>
    </div>
</section>
