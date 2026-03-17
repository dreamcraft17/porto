<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Portfolio Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Admin CSS - Light & clean -->
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-text: #e2e8f0;
            --sidebar-hover: #334155;
            --main-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text: #0f172a;
            --text-muted: #64748b;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --border: #e2e8f0;
            --sidebar-width: 240px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--main-bg);
            min-height: 100vh;
            color: var(--text);
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        
        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 10px 16px;
            margin: 0 8px 2px;
            border-radius: 8px;
            transition: background 0.2s;
            text-decoration: none;
            display: block;
            font-size: 0.9375rem;
        }
        
        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }
        
        .sidebar .nav-link.active {
            background: rgba(37, 99, 235, 0.2);
            color: #93c5fd;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            opacity: 0.9;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 24px;
            min-height: 100vh;
            background: var(--main-bg);
        }
        
        .navbar-top {
            background: var(--card-bg);
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 999;
            margin-left: var(--sidebar-width);
            border-bottom: 1px solid var(--border);
            color: var(--text);
        }
        
        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            height: 100%;
            transition: box-shadow 0.2s;
        }
        
        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }
        
        .stat-card::before { display: none; }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: #eff6ff;
            color: var(--primary);
            margin-bottom: 12px;
        }
        
        .table-responsive {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #fff;
        }
        
        .form-control {
            background: var(--card-bg);
            border: 1px solid var(--border);
            color: var(--text);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        
        .alert {
            border-radius: 10px;
            border: 1px solid var(--border);
        }
        
        .sidebar-header {
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 20px 16px;
        }
        
        .sidebar-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }
        
        .sidebar-header p {
            color: var(--sidebar-text);
            font-size: 0.8rem;
            margin: 4px 0 0;
            opacity: 0.8;
        }
        
        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 16px;
            margin-top: auto;
        }
        
        .sidebar-footer p {
            color: var(--sidebar-text);
            font-size: 0.8125rem;
            margin: 0;
            opacity: 0.8;
        }
        
        /* Table */
        .table th {
            border-top: none;
            font-weight: 600;
            color: var(--text);
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            padding: 12px 16px;
        }
        
        .table td {
            border-bottom: 1px solid var(--border);
            color: var(--text);
            padding: 12px 16px;
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background: #f8fafc;
        }
        
        .form-container {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            border: 1px solid var(--border);
        }
        
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(241, 245, 249, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin { to { transform: rotate(360deg); } }
        
        .btn-outline-primary { border-color: var(--primary); color: var(--primary); }
        .btn-outline-primary:hover { background: var(--primary); color: #fff; }
        .btn-outline-danger:hover { color: #fff; }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 80%;
                max-width: 280px;
            }
            .sidebar.active { transform: translateX(0); }
            .main-content, .navbar-top { margin-left: 0 !important; width: 100%; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 999;
            }
            .sidebar-overlay.active { display: block; }
        }
        
        @media (min-width: 769px) {
            .sidebar { transform: translateX(0) !important; }
            #sidebarToggle { display: none; }
            .sidebar-overlay { display: none !important; }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-briefcase me-2"></i>Portfolio Admin</h3>
            <p>Dashboard Management</p>
        </div>
        
        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                    <i class="fas fa-briefcase"></i> Projects
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.personal-projects.*') ? 'active' : '' }}" href="{{ route('admin.personal-projects.index') }}">
                    <i class="fas fa-code"></i> Personal Projects
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}" href="{{ route('admin.experiences.index') }}">
                    <i class="fas fa-history"></i> Experiences
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}" href="{{ route('admin.skills.index') }}">
                    <i class="fas fa-tools"></i> Skills
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}" href="{{ route('admin.education.index') }}">
                    <i class="fas fa-graduation-cap"></i> Education
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}" href="{{ route('admin.certifications.index') }}">
                    <i class="fas fa-award"></i> Certifications
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer p-4">
            <div class="d-flex align-items-center mb-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-circle fa-2x"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-0">{{ Auth::user()->name ?? 'Admin' }}</h6>
                    <small>Administrator</small>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.logout') }}" id="logoutForm">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </nav>
    
    <!-- Top Navigation -->
    <nav class="navbar-top">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-outline-primary d-md-none" id="sidebarToggle" type="button">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 d-none d-md-block">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield('content')
    </main>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script>
        // CSRF Token untuk AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Toggle sidebar on mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');
        
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        }
        
        function closeSidebar() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !sidebarToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Loading overlay for form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    if (this.id !== 'logoutForm') {
                        document.getElementById('loadingOverlay').style.display = 'flex';
                    }
                });
            });
            
            // Hide loading when page is fully loaded
            window.addEventListener('load', function() {
                document.getElementById('loadingOverlay').style.display = 'none';
            });
        });
        
        // Confirm delete actions
        document.addEventListener('submit', function(e) {
            if (e.target.matches('form[action*="destroy"]') || 
                e.target.matches('form[action*="delete"]')) {
                if (!confirm('Are you sure you want to delete this item?')) {
                    e.preventDefault();
                }
            }
        });
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        
        // Handle active sidebar links
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>