<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dozer Napitupulu — Fullstack Engineer')</title>

    <meta name="description" content="@yield('meta_description', 'Dozer Napitupulu builds Laravel, ASP.NET, and Flutter systems for operations teams—POS, banking modules, dashboards, and integrations.')">
    <meta name="author" content="Dozer Napitupulu">
    <meta name="theme-color" content="#eee8dc">

    <meta property="og:title" content="@yield('og_title', 'Dozer Napitupulu — Fullstack Engineer')">
    <meta property="og:description" content="@yield('meta_description', 'Selected work and contact for Dozer Napitupulu — business web apps, mobile workflows, and API integration.')">
    <meta property="og:type" content="website">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/portfolio-base.css'])
    @stack('styles')
</head>
<body class="portfolio-body">
    <a class="skip-link" href="#main-content">Lewati ke konten</a>
    @yield('content')
    @stack('scripts')
</body>
</html>
