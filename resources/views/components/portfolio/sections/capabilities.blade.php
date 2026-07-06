<section id="capabilities" class="section-wrap capability-section">
    <div class="section-head">
        <div class="section-kicker">Capabilities</div>
        <h2 class="section-title">Development services for internal teams, product workflows, and business platforms.</h2>
    </div>

    <div class="capability-grid">
        @forelse($services as $service)
        <article class="capability-card">
            <i class="fas {{ $service->icon ?: 'fa-layer-group' }}"></i>
            <h3>{{ $service->title }}</h3>
            <p>{{ $service->description }}</p>
        </article>
        @empty
        <article class="capability-card">
            <i class="fas fa-layer-group"></i>
            <h3>Web Applications</h3>
            <p>Operational dashboards, admin systems, CMS workflows, and line-of-business applications using Laravel and ASP.NET MVC.</p>
        </article>
        <article class="capability-card">
            <i class="fas fa-mobile-screen-button"></i>
            <h3>Mobile Workflows</h3>
            <p>Flutter-based mobile applications for ordering, employee operations, task handling, and backend-connected workflows.</p>
        </article>
        <article class="capability-card">
            <i class="fas fa-database"></i>
            <h3>Data and Integration</h3>
            <p>REST APIs, database design, SQL Server/MySQL maintenance, reporting logic, and integration between business systems.</p>
        </article>
        @endforelse
    </div>
</section>
