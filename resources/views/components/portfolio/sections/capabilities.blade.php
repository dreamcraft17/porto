<section id="services" class="block capability-section">
    <div class="section-head">
        <p class="section-label">Services</p>
        <h2 class="section-title">Software that turns a manual handoff into a working system.</h2>
    </div>

    <div class="capability-grid">
        @forelse($services as $service)
            <article class="capability-item">
                <span class="capability-icon" aria-hidden="true"><i class="fas {{ $service->icon ?: 'fa-layer-group' }}"></i></span>
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->description }}</p>
                @if(!empty($service->features))
                    <ul class="capability-features">
                        @foreach($service->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                @endif
            </article>
        @empty
            <article class="capability-item">
                <span class="capability-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <h3>Web applications</h3>
                <p>Operational dashboards, admin systems, CMS workflows, and line-of-business applications using Laravel and ASP.NET MVC.</p>
            </article>
            <article class="capability-item">
                <span class="capability-icon" aria-hidden="true"><i class="fas fa-mobile-screen-button"></i></span>
                <h3>Mobile applications</h3>
                <p>Flutter-based mobile applications for ordering, employee operations, task handling, and backend-connected workflows.</p>
            </article>
            <article class="capability-item">
                <span class="capability-icon" aria-hidden="true"><i class="fas fa-plug"></i></span>
                <h3>API and system integration</h3>
                <p>REST APIs, database design, SQL Server/MySQL maintenance, reporting logic, and integration between business systems.</p>
            </article>
        @endforelse
    </div>
</section>
