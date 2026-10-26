<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman tidak ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600;700&family=Syne:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --page-bg: #f1f5f9;
            --ink: #272b32;
            --muted: #64748b;
            --accent: #1e3a8a;
            --surface: #ffffff;
            --line: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; }
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 2rem;
            font-family: "IBM Plex Sans", system-ui, sans-serif;
            background: var(--page-bg);
            color: var(--ink);
        }
        .card {
            max-width: 28rem;
            padding: 2rem;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
            text-align: center;
        }
        .code {
            font-family: Syne, system-ui, sans-serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--accent);
            line-height: 1;
        }
        h1 { margin-top: 0.75rem; font-size: 1.35rem; }
        p { margin: 0.75rem 0 1.5rem; color: var(--muted); line-height: 1.6; }
        a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 1.1rem;
            border-radius: 10px;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }
        a:hover { background: #1e40af; }
    </style>
</head>
<body>
    <div class="card">
        <p class="code">404</p>
        <h1>Halaman tidak ditemukan</h1>
        <p>Link mungkin sudah pindah atau belum dipublish dari CMS.</p>
        <a href="{{ url('/') }}">Kembali ke portfolio</a>
    </div>
</body>
</html>
