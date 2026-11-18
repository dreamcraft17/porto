{{--
  Epic Design techniques applied:
  1. 6-layer depth parallax
  2. Pinned sticky + scrub timeline
  3. Split converge (headline words)
  4. Word-by-word scroll lighting (lead)
  5. Float-loop (portrait)
  6. Companion scatter on scroll-out (domain chips)
--}}
<section
    id="overview"
    class="scene scene--hero hero intro-section"
    data-scene="hero"
    style="--scene-height: 220vh"
    aria-label="Introduction"
>
    {{-- DEPTH 0 — far background --}}
    <div class="layer depth-0" data-depth="0" aria-hidden="true">
        <div class="hero-bg" style="background-image: url('{{ asset('hero_bg.png') }}')"></div>
    </div>

    {{-- DEPTH 1 — atmosphere / glow --}}
    <div class="layer depth-1" data-depth="1" aria-hidden="true">
        <span class="glow-blob glow-blob--a"></span>
        <span class="glow-blob glow-blob--b"></span>
        <div class="hero-scrim"></div>
    </div>

    {{-- DEPTH 2 — mid decorations / companions --}}
    <div class="layer depth-2" data-depth="2" aria-hidden="true">
        <span class="hero-accent hero-accent--brace">{ }</span>
        <span class="hero-accent hero-accent--api">API</span>
        <span class="hero-accent hero-accent--db">DB</span>
    </div>

    {{-- DEPTH 5 — foreground FX (behind text in stacking via order; visual front via scale) --}}
    <div class="layer depth-5" data-depth="5" aria-hidden="true">
        <span class="fx-particle" style="--fx-x: 12%; --fx-y: 28%"></span>
        <span class="fx-particle" style="--fx-x: 78%; --fx-y: 18%"></span>
        <span class="fx-particle" style="--fx-x: 88%; --fx-y: 62%"></span>
        <span class="fx-particle" style="--fx-x: 22%; --fx-y: 72%"></span>
        <span class="fx-particle" style="--fx-x: 64%; --fx-y: 80%"></span>
    </div>

    {{-- DEPTH 3 + 4 — sticky stage: portrait + copy --}}
    <div class="hero-stage">
        <div class="hero-inner">
            <div class="layer depth-4 hero-copy" data-depth="4">
                <p class="hero-meta" data-animate="fade-up">Fullstack Software Engineer · Technical Consultant</p>
                <h1 class="intro-title split-text" data-animate="converge">I build the software behind everyday operations.</h1>
                <p class="hero-lead" data-animate="word-light">
                    From cafe POS and banking modules to internal HR and seller finance, I work across the layers that make a workflow hold together: interface, API, data, and the people using it.
                </p>
                <div class="hero-actions" data-animate="fade-up">
                    <a class="btn btn-light" href="#work">See selected work</a>
                    <a class="btn btn-ghost-light" href="#contact">Send a brief →</a>
                </div>
                <ul class="hero-domains" aria-label="Domains" data-animate="companions">
                    <li data-companion>POS &amp; retail</li>
                    <li data-companion>Banking modules</li>
                    <li data-companion>HR &amp; payroll</li>
                    <li data-companion>Seller finance</li>
                </ul>
            </div>

            <figure class="layer depth-3 hero-portrait" data-depth="3">
                <img
                    class="product-hero float-loop"
                    src="{{ asset('images/profile/dozer.png') }}"
                    alt="Portrait of Dozer Napitupulu"
                    width="400"
                    height="400"
                    loading="eager"
                    decoding="async"
                >
            </figure>
        </div>
    </div>
</section>
