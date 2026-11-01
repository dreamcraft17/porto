<section id="about" class="split-section" aria-labelledby="about-heading">
    <h2 class="split-heading" id="about-heading">About</h2>

    <div class="about-copy">
        <p>
            From cafe POS and banking modules to internal HR and seller finance, I work across the layers that make a workflow hold together: interface, API, data, and the people using it.
        </p>
        <p>
            I work across backend, frontend, mobile, and database layers, with experience supporting real company operations in cafe systems, banking modules, internal employee tools, reporting, and product development workflows.
        </p>
        <p>
            My focus is not only making screens work, but shaping the data model, integration points, and daily user flow behind them.
        </p>
    </div>

    <ol class="approach-list" aria-label="How the work is shaped">
        <li class="proof-item">
            <span class="proof-value">01</span>
            <div>
                <h3 class="proof-label">Start with the workflow</h3>
                <p class="proof-note">Who uses it, where it breaks, and what should happen next.</p>
            </div>
        </li>
        <li class="proof-item">
            <span class="proof-value">02</span>
            <div>
                <h3 class="proof-label">Connect the moving parts</h3>
                <p class="proof-note">A usable screen is only useful when the API and data agree.</p>
            </div>
        </li>
        <li class="proof-item">
            <span class="proof-value">03</span>
            <div>
                <h3 class="proof-label">Make it maintainable</h3>
                <p class="proof-note">Clear ownership, predictable data, and a handoff your team can use.</p>
            </div>
        </li>
    </ol>

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
</section>
