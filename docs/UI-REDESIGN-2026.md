# Porto UI redesign — Studio Ledger (2026-09)

> **Author:** Dozer  
> **Date:** 2026-09-27

## Intent

Personal portfolio for **recruiters and clients hiring Dozer the engineer** — not DN Tech company compro. Primary action: **review work → send a brief**.

## Design system

| Layer | Location |
|-------|----------|
| JSON tokens | `design-tokens.json` |
| CSS variables | `resources/css/portfolio-tokens.css` |
| Page styles | `resources/css/portfolio-home.css` |

**Typography:** Syne (display) + IBM Plex Sans (body) + IBM Plex Mono (labels). Replaces Inter / Space Grotesk on the public home layout.

**Color:** Warm paper background, ink navy type, copper accent (`#b45309`). No purple gradients, glass nav, or decorative teal blobs.

## Anti-slop gate (passed)

- Tokens drive surfaces; no template indigo/purple.
- Headline states an outcome (ops-ready systems), not “welcome to my portfolio”.
- Hero is asymmetric split (copy + portrait + proof strip), not three icon cards.
- Footer clarifies personal vs DN Tech company site.
- Motion limited to hover on actions; no stagger animations.

## PM / prioritization (RICE sketch)

| Initiative | Reach | Impact | Confidence | Effort | Notes |
|------------|-------|--------|------------|--------|-------|
| Home token + typography | High | High | High | S | Done |
| Mobile nav | High | Med | High | S | Done |
| Project detail pages parity | Med | Med | Med | M | Next |
| Admin UI refresh | Low | Low | High | L | Defer |

## CTO review (summary)

| Question | Answer |
|----------|--------|
| Scaling cliff | Static Blade + Vite assets; breaks on traffic only at host/DB — same as before |
| Tech debt | Dual CSS paths (portfolio vs legacy Bootstrap) — acceptable until admin redesign |
| Build vs buy | Custom CMS stays core (content ownership) |
| SLO | Personal site; best-effort uptime on existing host |
| Security | No change to auth surface; contact form unchanged |

**Verdict:** 🟢 SHIP for public home; sharpen project/case pages next.

## CMO review (summary)

| Question | Answer |
|----------|--------|
| ICP | Hiring manager or founder needing a **builder** for internal/ops software |
| JTBD | “I need someone who has shipped Laravel/.NET/Flutter in real businesses.” |
| Positioning | For teams with operational software needs, Dozer is a **fullstack engineer** who ships integrated web/mobile systems — unlike generic agency landing pages |
| Channel | LinkedIn/GitHub → portfolio URL → contact form |
| Defensibility | Case studies from real domains (POS, banking, seller finance), not stock visuals |

**Verdict:** 🟢 Narrative aligned; add real project screenshots when available.

## Case study pages (2026-09-27)

| Route | CSS |
|-------|-----|
| `/projects`, `/project/{slug}` | `portfolio-case.css` |
| `/personal-projects`, `/personal-project/{slug}` | `portfolio-case.css` |

Removed purple gradient / glass hero templates from project blades. Shared `case-header`, `project-card`, portfolio footer.

## Local verify

```bash
cd porto && npm run build && composer test
php artisan serve
# http://localhost:8000
```
