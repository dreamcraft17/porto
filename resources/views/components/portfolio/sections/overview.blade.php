<section id="overview" class="section-wrap intro-section">
    <div>
        <div class="eyebrow">Portfolio and software profile</div>
        <h1 class="intro-title">Building web and mobile systems for real operations.</h1>
        <p class="intro-copy">
            I am Dozer Napitupulu, a Fullstack Engineer focused on practical application development across .NET, Laravel, Flutter, and relational databases. I build tools for teams, operations, reporting, and customer-facing workflows.
        </p>
        <div class="intro-actions">
            <a class="action-primary" href="#work">View Selected Work <i class="fas fa-arrow-right"></i></a>
            <a class="action-secondary" href="#contact">Start a Conversation</a>
        </div>
        <div class="hero-tags" aria-label="Core service areas">
            <span>Business web apps</span>
            <span>Mobile operations</span>
            <span>API integration</span>
            <span>Reporting systems</span>
        </div>
    </div>

    <div class="intro-panel">
        <div class="portrait-block">
            <img src="{{ asset('images/profile/dozer.png') }}" alt="Dozer Napitupulu">
        </div>
        <div class="proof-strip" aria-label="Portfolio summary">
            <div class="proof-item">
                <div class="proof-top">
                    <span class="proof-value">5+</span>
                    <span class="proof-icon"><i class="fas fa-briefcase"></i></span>
                </div>
                <span class="proof-label">Years building apps</span>
                <span class="proof-note">Operational tools, reports, and customer workflows.</span>
            </div>
            <div class="proof-item">
                <div class="proof-top">
                    <span class="proof-value">20+</span>
                    <span class="proof-icon"><i class="fas fa-rocket"></i></span>
                </div>
                <span class="proof-label">Projects delivered</span>
                <span class="proof-note">Dashboards, POS, APIs, banking modules, and mobile apps.</span>
            </div>
            <div class="proof-item">
                <div class="proof-top">
                    <span class="proof-value">{{ $skills->count() }}+</span>
                    <span class="proof-icon"><i class="fas fa-code-branch"></i></span>
                </div>
                <span class="proof-label">Technical skills</span>
                <span class="proof-note">
                    @foreach($skills->take(4) as $skill)
                        {{ $skill->name }}@if(!$loop->last), @endif
                    @endforeach
                </span>
            </div>
        </div>
    </div>
</section>
