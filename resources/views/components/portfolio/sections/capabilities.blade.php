<section id="capabilities" class="block capability-section">
    <div class="section-head">
        <p class="section-label">Capabilities</p>
        <h2 class="section-title">Software that turns a manual handoff into a working system.</h2>
    </div>

    <div class="capability-grid">
        @forelse($services as $service)
            <article class="capability-item">
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->description }}</p>
            </article>
        @empty
            <article class="capability-item">
                <h3>Web applications</h3>
                <p>Operational dashboards, admin systems, CMS workflows, and line-of-business applications using Laravel and ASP.NET MVC.</p>
            </article>
            <article class="capability-item">
                <h3>Mobile workflows</h3>
                <p>Flutter-based mobile applications for ordering, employee operations, task handling, and backend-connected workflows.</p>
            </article>
            <article class="capability-item">
                <h3>Data and integration</h3>
                <p>REST APIs, database design, SQL Server/MySQL maintenance, reporting logic, and integration between business systems.</p>
            </article>
        @endforelse
    </div>
</section>
