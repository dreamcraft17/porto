@extends('layouts.app')

@section('title', 'Dozer Napitupulu - Fullstack Engineer')

@section('styles')
<style>
    :root {
        --page-bg: #f5f7f9;
        --surface: #ffffff;
        --ink: #172033;
        --muted: #687386;
        --line: #dce3ea;
        --accent: #0f766e;
        --accent-2: #24527a;
        --navy: #10243e;
        --soft: #eef5f4;
    }

    body {
        background: var(--page-bg);
        color: var(--ink);
    }

    .navbar-bold,
    .footer-bold {
        display: none;
    }

    main {
        padding-top: 0 !important;
    }

    .portfolio-shell {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 300px minmax(0, 1fr);
    }

    .site-rail {
        position: sticky;
        top: 0;
        height: 100vh;
        padding: 34px 30px;
        background: var(--navy);
        color: #e8eef5;
        display: flex;
        flex-direction: column;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
    }

    .rail-mark {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 8px;
        font-weight: 800;
        margin-bottom: 18px;
    }

    .rail-name {
        font-size: 1.3rem;
        line-height: 1.15;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .rail-role {
        color: #9fb1c6;
        font-size: 0.9rem;
    }

    .rail-nav {
        display: grid;
        gap: 10px;
        margin: 48px 0;
    }

    .rail-nav a {
        color: #c9d6e4;
        text-decoration: none;
        font-weight: 650;
        font-size: 0.95rem;
        padding: 8px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.09);
    }

    .rail-nav a:hover {
        color: #ffffff;
    }

    .rail-contact {
        margin-top: auto;
        font-size: 0.9rem;
        color: #aebed0;
        line-height: 1.7;
    }

    .rail-contact a {
        color: #ffffff;
        text-decoration: none;
    }

    .page-main {
        min-width: 0;
    }

    .section-wrap {
        padding: 72px clamp(28px, 5vw, 76px);
        border-bottom: 1px solid var(--line);
    }

    .intro-section {
        min-height: 720px;
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr);
        align-items: center;
        gap: 56px;
        background: #ffffff;
    }

    .eyebrow {
        margin-bottom: 18px;
        color: var(--accent);
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .intro-title {
        max-width: 820px;
        margin: 0 0 26px;
        font-size: clamp(3.2rem, 7vw, 7.4rem);
        line-height: 0.92;
        letter-spacing: 0;
        font-weight: 900;
        color: var(--ink);
    }

    .intro-copy {
        max-width: 720px;
        color: #536071;
        font-size: 1.16rem;
        line-height: 1.82;
        margin-bottom: 34px;
    }

    .intro-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .action-primary,
    .action-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 46px;
        padding: 0 18px;
        border-radius: 8px;
        font-weight: 750;
        text-decoration: none;
    }

    .action-primary {
        color: #ffffff;
        background: var(--navy);
        border: 1px solid var(--navy);
    }

    .action-secondary {
        color: var(--ink);
        background: #ffffff;
        border: 1px solid var(--line);
    }

    .intro-panel {
        align-self: stretch;
        display: grid;
        align-content: end;
        gap: 18px;
    }

    .portrait-block {
        background: #dfe8e6;
        border: 1px solid #c8d6d3;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 4 / 5;
    }

    .portrait-block img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        display: block;
    }

    .proof-strip {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        border: 1px solid var(--line);
        border-radius: 10px;
        background: var(--surface);
        overflow: hidden;
    }

    .proof-item {
        padding: 18px;
        border-right: 1px solid var(--line);
    }

    .proof-item:last-child {
        border-right: 0;
    }

    .proof-value {
        display: block;
        font-size: 1.6rem;
        font-weight: 850;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 6px;
    }

    .proof-label {
        color: var(--muted);
        font-size: 0.82rem;
        font-weight: 650;
    }

    .section-head {
        display: grid;
        grid-template-columns: 220px minmax(0, 1fr);
        gap: 40px;
        margin-bottom: 34px;
    }

    .section-kicker {
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.14em;
        font-size: 0.74rem;
        font-weight: 850;
        padding-top: 10px;
    }

    .section-title {
        margin: 0;
        max-width: 880px;
        font-size: clamp(2rem, 4vw, 3.8rem);
        line-height: 1.05;
        font-weight: 850;
        color: var(--ink);
    }

    .capability-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .capability-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 24px;
    }

    .capability-card i {
        color: var(--accent);
        font-size: 1.5rem;
        margin-bottom: 22px;
    }

    .capability-card h3 {
        font-size: 1.15rem;
        margin-bottom: 12px;
    }

    .capability-card p {
        color: var(--muted);
        line-height: 1.72;
        margin: 0;
    }

    .about-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
        gap: 34px;
    }

    .about-copy {
        color: #536071;
        font-size: 1.05rem;
        line-height: 1.84;
    }

    .skill-board {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .skill-group {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 18px;
    }

    .skill-group h3 {
        font-size: 0.95rem;
        margin-bottom: 12px;
        color: var(--ink);
        text-transform: capitalize;
    }

    .skill-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .skill-list span,
    .tech-list span {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 0 10px;
        border-radius: 999px;
        background: var(--soft);
        color: #2e5f5a;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .work-list {
        display: grid;
        gap: 16px;
    }

    .work-item {
        display: grid;
        grid-template-columns: 170px minmax(0, 1fr) 150px;
        gap: 24px;
        align-items: start;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 22px;
        text-decoration: none;
        color: inherit;
    }

    .work-item:hover {
        border-color: #b9c6d2;
    }

    .work-meta {
        color: var(--muted);
        font-size: 0.86rem;
        font-weight: 700;
    }

    .work-title {
        margin: 0 0 10px;
        color: var(--ink);
        font-size: 1.22rem;
    }

    .work-desc {
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 14px;
    }

    .tech-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .work-link {
        justify-self: end;
        color: var(--accent);
        font-weight: 800;
        font-size: 0.92rem;
    }

    .timeline-list {
        display: grid;
        gap: 18px;
        position: relative;
    }

    .timeline-entry {
        display: grid;
        grid-template-columns: 190px minmax(0, 1fr);
        gap: 0;
        padding: 0;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 18px;
        overflow: hidden;
    }

    .timeline-date {
        min-height: 100%;
        padding: 24px;
        color: #ffffff;
        font-weight: 850;
        font-size: 0.92rem;
        background:
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.18), transparent 30%),
            linear-gradient(160deg, #24527a, #0f766e);
    }

    .timeline-body {
        padding: 24px;
    }

    .timeline-entry h3 {
        margin-bottom: 8px;
        font-size: 1.28rem;
        line-height: 1.3;
    }

    .timeline-company {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 0 10px;
        border-radius: 999px;
        background: var(--soft);
        color: var(--accent-2);
        font-weight: 800;
        margin-bottom: 14px;
        font-size: 0.86rem;
    }

    .timeline-entry p {
        color: var(--muted);
        line-height: 1.72;
        margin: 0;
    }

    .credential-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
    }

    .credential-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 20px;
    }

    .credential-card h3 {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .credential-card p {
        margin: 0;
        color: var(--muted);
    }

    .contact-section {
        background: var(--navy);
        color: #ffffff;
    }

    .contact-section .section-kicker {
        color: #7bd7c9;
    }

    .contact-section .section-title {
        color: #ffffff;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
        gap: 42px;
        align-items: start;
    }

    .contact-note {
        color: #c7d4e2;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .contact-links {
        display: grid;
        gap: 12px;
        margin-top: 24px;
    }

    .contact-links a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 750;
    }

    .contact-form {
        display: grid;
        gap: 16px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 10px;
        padding: 22px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .contact-form label {
        color: #dce7f1;
        font-weight: 750;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.08);
        color: #ffffff;
        padding: 13px 14px;
        outline: none;
    }

    .contact-form textarea {
        min-height: 150px;
        resize: vertical;
    }

    .contact-form input::placeholder,
    .contact-form textarea::placeholder {
        color: #9fb1c6;
    }

    .submit-btn {
        border: 0;
        border-radius: 8px;
        background: #ffffff;
        color: var(--navy);
        min-height: 46px;
        padding: 0 18px;
        font-weight: 850;
    }

    @media (max-width: 1100px) {
        .portfolio-shell {
            grid-template-columns: 1fr;
        }

        .site-rail {
            position: static;
            height: auto;
            padding: 22px 28px;
        }

        .rail-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin: 24px 0 0;
        }

        .rail-nav a {
            border-bottom: 0;
            padding: 0;
        }

        .rail-contact {
            display: none;
        }

        .intro-section,
        .about-grid,
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .intro-panel {
            max-width: 440px;
        }
    }

    @media (max-width: 800px) {
        .section-wrap {
            padding: 54px 22px;
        }

        .section-head,
        .work-item,
        .timeline-entry {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .capability-grid,
        .skill-board,
        .form-row {
            grid-template-columns: 1fr;
        }

        .proof-strip {
            grid-template-columns: 1fr;
        }

        .proof-item {
            border-right: 0;
            border-bottom: 1px solid var(--line);
        }

        .proof-item:last-child {
            border-bottom: 0;
        }

        .work-link {
            justify-self: start;
        }
    }

    /* Visual lift: stronger compro-style presentation */
    .portfolio-shell {
        background:
            linear-gradient(180deg, #f7f9fb 0%, #edf3f6 42%, #f7f9fb 100%);
    }

    .site-rail {
        background:
            linear-gradient(180deg, #0b1b30 0%, #10243e 58%, #0f312f 100%);
    }

    .rail-mark {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.26);
    }

    .rail-nav a {
        position: relative;
        padding-left: 18px;
    }

    .rail-nav a::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #7bd7c9;
        transform: translateY(-50%);
        opacity: 0.55;
    }

    .intro-section {
        min-height: 760px;
        background:
            radial-gradient(circle at 85% 15%, rgba(15, 118, 110, 0.14), transparent 30%),
            linear-gradient(135deg, #ffffff 0%, #f1f6f8 100%);
        position: relative;
        overflow: hidden;
    }

    .intro-section::after {
        content: "";
        position: absolute;
        right: clamp(22px, 5vw, 76px);
        top: 72px;
        bottom: 72px;
        width: min(34vw, 420px);
        background: #dcebe8;
        border: 1px solid #c8dad6;
        border-radius: 18px;
        z-index: 0;
    }

    .intro-section > * {
        position: relative;
        z-index: 1;
    }

    .intro-section > div:first-child {
        background: #0d2239;
        color: #ffffff;
        border-radius: 18px;
        padding: clamp(28px, 4vw, 52px);
        box-shadow: 0 28px 70px rgba(16, 36, 62, 0.22);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .intro-section .eyebrow {
        color: #7bd7c9;
    }

    .intro-title {
        color: #ffffff;
        font-size: clamp(3rem, 6.5vw, 6.8rem);
    }

    .intro-copy {
        color: #cad7e4;
    }

    .intro-actions {
        margin-bottom: 24px;
    }

    .intro-section .action-primary {
        background: #ffffff;
        border-color: #ffffff;
        color: #10243e;
    }

    .intro-section .action-secondary {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.28);
        color: #ffffff;
    }

    .hero-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }

    .hero-tags span {
        display: inline-flex;
        align-items: center;
        min-height: 34px;
        padding: 0 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #d8e5f1;
        font-size: 0.84rem;
        font-weight: 700;
    }

    .intro-panel {
        align-self: center;
    }

    .portrait-block {
        border-radius: 18px;
        border: 8px solid #ffffff;
        box-shadow: 0 28px 58px rgba(16, 36, 62, 0.2);
        background: #e6efed;
    }

    .proof-strip {
        border: 0;
        box-shadow: 0 22px 44px rgba(16, 36, 62, 0.12);
    }

    .proof-item {
        background: #ffffff;
    }

    .section-wrap {
        background: transparent;
    }

    .capability-card,
    .skill-group,
    .work-item,
    .timeline-entry,
    .credential-card {
        box-shadow: 0 16px 40px rgba(16, 36, 62, 0.07);
        transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
    }

    .capability-card {
        position: relative;
        overflow: hidden;
    }

    .capability-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #0f766e, #24527a);
    }

    .capability-card:hover,
    .skill-group:hover,
    .work-item:hover,
    .timeline-entry:hover,
    .credential-card:hover {
        transform: translateY(-4px);
        border-color: #b9c9d5;
        box-shadow: 0 24px 58px rgba(16, 36, 62, 0.11);
    }

    .work-list {
        counter-reset: work;
    }

    .work-item {
        counter-increment: work;
        position: relative;
        overflow: hidden;
    }

    .work-item::before {
        content: "0" counter(work);
        position: absolute;
        right: 22px;
        bottom: -10px;
        color: rgba(16, 36, 62, 0.06);
        font-size: 5rem;
        font-weight: 900;
        line-height: 1;
    }

    .work-title {
        font-size: 1.32rem;
    }

    .work-link {
        background: var(--soft);
        color: var(--accent);
        padding: 9px 12px;
        border-radius: 999px;
        align-self: start;
    }

    .contact-section {
        background:
            radial-gradient(circle at 88% 18%, rgba(123, 215, 201, 0.2), transparent 32%),
            linear-gradient(135deg, #0b1b30, #10243e 58%, #0f312f);
    }

    .submit-btn:hover,
    .action-primary:hover,
    .action-secondary:hover {
        transform: translateY(-1px);
    }

    @media (max-width: 1100px) {
        .intro-section::after {
            display: none;
        }
    }

    @media (max-width: 800px) {
        .intro-section > div:first-child {
            padding: 28px;
        }

        .intro-title {
            font-size: clamp(2.7rem, 14vw, 4.3rem);
        }

        .hero-tags {
            display: grid;
        }
    }

    /* Headbar layout override */
    .portfolio-shell {
        display: block;
    }

    .site-headbar {
        position: sticky;
        top: 0;
        z-index: 80;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 16px clamp(22px, 5vw, 76px);
        background: rgba(255, 255, 255, 0.92);
        border-bottom: 1px solid var(--line);
        backdrop-filter: blur(14px);
    }

    .head-brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: var(--ink);
        text-decoration: none;
        min-width: fit-content;
    }

    .brand-mark {
        width: 44px;
        height: 44px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        background: var(--navy);
        color: #ffffff;
        font-weight: 850;
    }

    .brand-name,
    .brand-role {
        display: block;
    }

    .brand-name {
        color: var(--ink);
        font-size: 1rem;
        font-weight: 850;
        line-height: 1.1;
    }

    .brand-role {
        margin-top: 3px;
        color: var(--muted);
        font-size: 0.78rem;
        font-weight: 750;
    }

    .head-nav {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .head-nav a {
        display: inline-flex;
        align-items: center;
        min-height: 40px;
        padding: 0 11px;
        border-radius: 8px;
        color: #526071;
        text-decoration: none;
        font-size: 0.92rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .head-nav a:hover {
        background: #eef4f6;
        color: var(--ink);
    }

    .head-nav .head-cta {
        margin-left: 4px;
        background: var(--navy);
        color: #ffffff;
        padding: 0 15px;
    }

    .head-nav .head-cta:hover {
        background: var(--accent);
        color: #ffffff;
    }

    @media (max-width: 900px) {
        .site-headbar {
            align-items: flex-start;
            flex-direction: column;
            gap: 13px;
        }

        .head-nav {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 2px;
        }
    }

    /* Project cards upgrade */
    .work-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .work-item {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: auto 1fr auto;
        gap: 0;
        padding: 0;
        border-radius: 18px;
        overflow: hidden;
        background: #ffffff;
    }

    .work-item::before {
        display: none;
    }

    .work-visual {
        min-height: 138px;
        padding: 20px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        background:
            radial-gradient(circle at 85% 20%, rgba(255,255,255,0.22), transparent 28%),
            linear-gradient(135deg, #0f766e, #24527a);
        color: #ffffff;
    }

    .work-visual-icon {
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 1.4rem;
    }

    .work-index {
        color: rgba(255, 255, 255, 0.74);
        font-size: 0.78rem;
        font-weight: 900;
        letter-spacing: 0.14em;
    }

    .work-body {
        padding: 22px 22px 10px;
    }

    .work-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 14px;
    }

    .work-meta span {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 0 10px;
        border-radius: 999px;
        background: #f1f5f7;
        color: #536071;
        font-size: 0.8rem;
    }

    .work-title {
        font-size: 1.35rem;
        line-height: 1.25;
    }

    .work-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 0 22px 22px;
    }

    .work-link {
        justify-self: auto;
        white-space: nowrap;
    }

    @media (max-width: 900px) {
        .work-list {
            grid-template-columns: 1fr;
        }

        .timeline-entry {
            grid-template-columns: 1fr;
        }

        .timeline-date {
            min-height: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="portfolio-shell">
    <header class="site-headbar">
        <a class="head-brand" href="#overview">
            <span class="brand-mark">DN</span>
            <span>
                <span class="brand-name">Dozer Napitupulu</span>
                <span class="brand-role">Fullstack Engineer</span>
            </span>
        </a>

        <nav class="head-nav" aria-label="Primary navigation">
            <a href="#overview">Home</a>
            <a href="#about">About</a>
            <a href="#work">Projects</a>
            <a href="#experience">Experience</a>
            <a href="#certifications">Certifications</a>
            <a class="head-cta" href="#contact">Let's Connect</a>
        </nav>
    </header>

    <main class="page-main">
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
                        <span class="proof-value">3+</span>
                        <span class="proof-label">Years experience</span>
                    </div>
                    <div class="proof-item">
                        <span class="proof-value">20+</span>
                        <span class="proof-label">Projects delivered</span>
                    </div>
                    <div class="proof-item">
                        <span class="proof-value">4</span>
                        <span class="proof-label">Core stacks</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="capabilities" class="section-wrap">
            <div class="section-head">
                <div class="section-kicker">Capabilities</div>
                <h2 class="section-title">Development services for internal teams, product workflows, and business platforms.</h2>
            </div>

            <div class="capability-grid">
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
            </div>
        </section>

        <section id="about" class="section-wrap">
            <div class="section-head">
                <div class="section-kicker">Profile</div>
                <h2 class="section-title">A software engineer with a bias for systems that are usable, maintainable, and tied to business flow.</h2>
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

        <section id="work" class="section-wrap">
            <div class="section-head">
                <div class="section-kicker">Selected work</div>
                <h2 class="section-title">Projects shaped around transactions, reporting, operations, and multi-platform access.</h2>
            </div>

            <div class="work-list">
                @foreach($projects->take(6) as $project)
                <a class="work-item" href="{{ route('project.show', $project->slug) }}">
                    <div class="work-visual">
                        <div class="work-visual-icon">
                            @php
                                $icons = ['fa-cash-register', 'fa-mobile-screen-button', 'fa-chart-line', 'fa-users-gear', 'fa-building-columns', 'fa-chart-pie'];
                            @endphp
                            <i class="fas {{ $icons[$loop->index % count($icons)] }}"></i>
                        </div>
                        <div class="work-index">PROJECT {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    </div>

                    <div class="work-body">
                        <div class="work-meta">
                            <span>{{ $project->company ?: 'Project' }}</span>
                            @if($project->project_date)
                            <span>{{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="work-title">{{ $project->title }}</h3>
                        <p class="work-desc">{{ Str::limit($project->description, 150) }}</p>
                    </div>

                    <div class="work-footer">
                        @if($project->technologies)
                        <div class="tech-list">
                            @foreach(array_slice(json_decode($project->technologies, true) ?? [], 0, 4) as $tech)
                            <span>{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                        <div class="work-link">View case</div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-4">
                <a class="action-secondary" href="{{ route('projects.all') }}">Browse all projects</a>
            </div>
        </section>

        <section id="experience" class="section-wrap">
            <div class="section-head">
                <div class="section-kicker">Experience</div>
                <h2 class="section-title">Professional work across consulting, enterprise systems, and product development teams.</h2>
            </div>

            <div class="timeline-list">
                @foreach($experiences as $experience)
                <article class="timeline-entry">
                    <div class="timeline-date">
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                        @if($experience->current)
                            Present
                        @else
                            {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                        @endif
                    </div>
                    <div class="timeline-body">
                        <h3>{{ $experience->position }}</h3>
                        <div class="timeline-company">{{ $experience->company }}</div>
                        <p>{{ $experience->description }}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </section>

        @if($certifications->count())
        <section id="certifications" class="section-wrap">
            <div class="section-head">
                <div class="section-kicker">Credentials</div>
                <h2 class="section-title">Certifications and learning records that support the work.</h2>
            </div>

            <div class="credential-grid">
                @foreach($certifications as $certification)
                <article class="credential-card">
                    <h3>{{ $certification->name }}</h3>
                    <p>{{ $certification->issuer }}</p>
                    @if($certification->issued_date)
                    <p>{{ \Carbon\Carbon::parse($certification->issued_date)->format('M Y') }}</p>
                    @endif
                </article>
                @endforeach
            </div>
        </section>
        @endif

        <section id="contact" class="section-wrap contact-section">
            <div class="section-head">
                <div class="section-kicker">Contact</div>
                <h2 class="section-title">Need a system, dashboard, mobile workflow, or integration built properly?</h2>
            </div>

            <div class="contact-grid">
                <div>
                    <p class="contact-note">
                        Share the business flow, the users, and the problem you want to solve. I can help turn it into a web or mobile application with a practical technical foundation.
                    </p>
                    <div class="contact-links">
                        <a href="mailto:dozernapitupulu@gmail.com"><i class="fas fa-envelope me-2"></i>dozernapitupulu@gmail.com</a>
                        <a href="https://github.com/dreamcraft17" target="_blank"><i class="fab fa-github me-2"></i>GitHub</a>
                        <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank"><i class="fab fa-linkedin me-2"></i>LinkedIn</a>
                    </div>
                </div>

                <form class="contact-form" id="contactForm">
                    @csrf
                    <div class="form-row">
                        <div>
                            <label for="name">Full Name</label>
                            <input type="text" id="name" placeholder="Your name" required>
                        </div>
                        <div>
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="you@example.com" required>
                        </div>
                    </div>
                    <div>
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" placeholder="Project discussion" required>
                    </div>
                    <div>
                        <label for="message">Message</label>
                        <textarea id="message" placeholder="Tell me about your project..." required></textarea>
                    </div>
                    <button class="submit-btn" type="submit">Send Message</button>
                </form>
            </div>
        </section>
    </main>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const btn = this.querySelector('button[type="submit"]');
    const originalText = btn.textContent;
    btn.textContent = 'Sending...';
    btn.disabled = true;

    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value,
        _token: document.querySelector('input[name="_token"]').value
    };

    fetch('/contact', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': formData._token
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Message sent successfully.');
            document.getElementById('contactForm').reset();
        } else {
            alert('Sorry, there was an error sending your message.');
        }
    })
    .catch(() => {
        alert('Sorry, there was an error sending your message. Please try again or contact directly via email.');
    })
    .finally(() => {
        btn.textContent = originalText;
        btn.disabled = false;
    });
});
</script>
@endsection
