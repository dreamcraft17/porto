<section id="about" class="block profile-section">
    <div class="section-head">
        <p class="section-label">About</p>
        <h2 class="section-title">Fullstack engineer focused on practical business systems.</h2>
    </div>

    <div class="about-grid">
        <div class="about-copy">
            <p>
                I work across backend, frontend, mobile, and database layers, with experience supporting real company operations in cafe systems, banking modules, internal employee tools, reporting, and product development workflows.
            </p>
            <p>
                My focus is not only making screens work, but shaping the data model, integration points, and daily user flow behind them.
            </p>
        </div>

        <dl class="skill-board">
            @forelse($skills->groupBy('category') as $category => $categorySkills)
                <div class="skill-group">
                    <dt>{{ ucfirst($category) }}</dt>
                    <dd>{{ $categorySkills->take(8)->pluck('name')->implode(', ') }}</dd>
                </div>
            @empty
                <div class="skill-group">
                    <dt>Backend</dt>
                    <dd>Laravel, ASP.NET MVC, REST APIs</dd>
                </div>
                <div class="skill-group">
                    <dt>Frontend &amp; mobile</dt>
                    <dd>Blade / React, Flutter, TypeScript</dd>
                </div>
                <div class="skill-group">
                    <dt>Data</dt>
                    <dd>MySQL, SQL Server, PostgreSQL</dd>
                </div>
            @endforelse
        </dl>
    </div>

    <ol class="approach-list" aria-label="How the work is shaped">
        <li class="proof-item">
            <span class="proof-value">01</span>
            <h3 class="proof-label">Start with the workflow</h3>
            <p class="proof-note">Who uses it, where it breaks, and what should happen next.</p>
        </li>
        <li class="proof-item">
            <span class="proof-value">02</span>
            <h3 class="proof-label">Connect the moving parts</h3>
            <p class="proof-note">A usable screen is only useful when the API and data agree.</p>
        </li>
        <li class="proof-item">
            <span class="proof-value">03</span>
            <h3 class="proof-label">Make it maintainable</h3>
            <p class="proof-note">Clear ownership, predictable data, and a handoff your team can use.</p>
        </li>
    </ol>
</section>
