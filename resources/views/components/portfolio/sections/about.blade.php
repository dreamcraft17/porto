<section id="about" class="section-wrap profile-section">
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
            @foreach($skills->groupBy('category') as $category => $categorySkills)
            <div class="skill-group">
                <h3>{{ ucfirst($category) }}</h3>
                <div class="skill-list">
                    @foreach($categorySkills->take(8) as $skill)
                    <span>{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
