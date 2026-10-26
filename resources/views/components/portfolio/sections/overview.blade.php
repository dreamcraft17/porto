<section id="overview" class="block block--hero intro-section">
    <div class="hero-grid">
        <div>
            <p class="eyebrow">Dozer · Fullstack engineer</p>
            <h1 class="intro-title">I build software that keeps real teams moving.</h1>
            <p class="intro-copy">
                Web apps, APIs, mobile workflows, and dashboards for the messy middle of a business—the place where good software saves time every day.
            </p>
            <div class="intro-actions">
                <a class="action-primary" href="#work">See selected work</a>
                <a class="action-secondary" href="#contact">Send a brief</a>
            </div>
            <div class="hero-stack" aria-label="Primary stack">
                <span>Laravel</span>
                <span>ASP.NET</span>
                <span>Flutter</span>
                <span>SQL Server / MySQL</span>
                <span>REST APIs</span>
            </div>
        </div>
        <figure class="hero-avatar">
            <img src="{{ asset('images/profile/dozer.png') }}" alt="Portrait of Dozer Napitupulu" width="400" height="400" loading="eager" decoding="async">
        </figure>
    </div>

    <div class="stat-row" aria-label="Portfolio summary">
        <div class="proof-item">
            <div class="proof-top">
                <span class="proof-value">5+</span>
                <span class="proof-icon"><i class="fas fa-briefcase" aria-hidden="true"></i></span>
            </div>
            <span class="proof-label">Years in production</span>
            <span class="proof-note">Cafe POS, banking modules, internal HR, seller finance.</span>
        </div>
        <div class="proof-item">
            <div class="proof-top">
                <span class="proof-value">20+</span>
                <span class="proof-icon"><i class="fas fa-diagram-project" aria-hidden="true"></i></span>
            </div>
            <span class="proof-label">Shipped projects</span>
            <span class="proof-note">Dashboards, mobile ops, integrations, CMS-backed sites.</span>
        </div>
        <div class="proof-item">
            <div class="proof-top">
                <span class="proof-value">{{ $skills->count() > 0 ? $skills->count().'+' : 'Full' }}</span>
                <span class="proof-icon"><i class="fas fa-code-branch" aria-hidden="true"></i></span>
            </div>
            <span class="proof-label">Stack breadth</span>
            <span class="proof-note">
                @if($skills->count() > 0)
                    @foreach($skills->take(4) as $skill)
                        {{ $skill->name }}@if(!$loop->last), @endif
                    @endforeach
                @else
                    Laravel, ASP.NET, Flutter, SQL, REST — add skills in CMS when ready.
                @endif
            </span>
        </div>
    </div>
</section>
