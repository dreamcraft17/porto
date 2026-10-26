<section id="about" class="block profile-section">
    <div class="section-head">
        <div class="section-kicker">Profile</div>
        <h2 class="section-title">Fullstack engineer focused on practical business systems.</h2>
    </div>

    <div class="about-grid">
        <div class="about-copy">
            <p>
                I work across backend, frontend, mobile, and database layers, with experience supporting real company operations in cafe systems, banking modules, internal employee tools, reporting, and product development workflows.
            </p>
            <p class="profile-note">
                My focus is not only making screens work, but shaping the data model, integration points, and daily user flow behind them.
            </p>
        </div>

        <div class="skill-board">
            @forelse($skills->groupBy('category') as $category => $categorySkills)
            <div class="skill-group">
                <h3>{{ ucfirst($category) }}</h3>
                <div class="skill-list">
                    @foreach($categorySkills->take(8) as $skill)
                    <span>{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="skill-group">
                <h3>Backend</h3>
                <div class="skill-list">
                    <span>Laravel</span>
                    <span>ASP.NET MVC</span>
                    <span>REST APIs</span>
                </div>
            </div>
            <div class="skill-group">
                <h3>Frontend & mobile</h3>
                <div class="skill-list">
                    <span>Blade / React</span>
                    <span>Flutter</span>
                    <span>TypeScript</span>
                </div>
            </div>
            <div class="skill-group">
                <h3>Data</h3>
                <div class="skill-list">
                    <span>MySQL</span>
                    <span>SQL Server</span>
                    <span>PostgreSQL</span>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
