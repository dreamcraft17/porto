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
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --neon-cyan: #00ffff;
            --neon-purple: #a855f7;
            --neon-pink: #ec4899;
            --dark-bg: #0a0a0f;
            --dark-surface: #1a1a2e;
            --dark-card: #16213e;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --accent-gradient: linear-gradient(135deg, #00ffff, #a855f7, #ec4899);
            --border-glow: rgba(0, 255, 255, 0.3);
            --primary-color: #00ffff;
            --sidebar-width: 250px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--dark-bg);
            min-height: 100vh;
            overflow-x: hidden;
            color: var(--text-primary);
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark-surface) 0%, var(--dark-card) 100%);
            color: var(--text-primary);
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            transition: all 0.3s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            border-right: 1px solid var(--border-glow);
        }
        
        .sidebar .nav-link {
            color: var(--text-secondary);
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s;
            margin-bottom: 5px;
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .sidebar .nav-link:hover::before {
            left: 100%;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--text-primary);
            background: rgba(0, 255, 255, 0.1);
            border-left-color: var(--neon-cyan);
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
            background: var(--dark-bg);
        }
        
        .navbar-top {
            background: var(--dark-surface);
            box-shadow: 0 2px 10px rgba(0, 255, 255, 0.1);
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 999;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            border-bottom: 1px solid var(--border-glow);
        }
        
        .stat-card {
            background: var(--dark-surface);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 255, 255, 0.1);
            transition: all 0.3s;
            border: 1px solid var(--border-glow);
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, var(--neon-cyan), transparent, var(--neon-purple), transparent);
            animation: rotate 15s linear infinite;
            opacity: 0.05;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 255, 255, 0.2);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 15px;
        }
        
        .table-responsive {
            background: var(--dark-surface);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 255, 255, 0.1);
            overflow: hidden;
            border: 1px solid var(--border-glow);
        }
        
        .btn-primary {
            background: var(--accent-gradient);
            border: none;
            color: white;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 255, 255, 0.4);
        }
        
        .form-control {
            background: var(--dark-surface);
            border: 1px solid var(--border-glow);
            color: var(--text-primary);
        }
        
        .form-control:focus {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 0 0.2rem rgba(0, 255, 255, 0.25);
            background: var(--dark-surface);
            color: var(--text-primary);
        }
        
        .alert {
            border-radius: 12px;
            border: 1px solid var(--border-glow);
            background: var(--dark-surface);
            color: var(--text-primary);
        }
        
        .sidebar-header {
            border-bottom: 1px solid var(--border-glow);
            padding: 20px;
            text-align: center;
        }
        
        .sidebar-header h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .sidebar-footer {
            border-top: 1px solid var(--border-glow);
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
        
        .sidebar-footer p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin: 0;
        }
        
        /* Mobile styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 80%;
                max-width: 300px;
            }
            
            .sidebar.active {
                transform: translateX(0);
                box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            }
            
            .main-content,
            .navbar-top {
                margin-left: 0 !important;
                width: 100%;
            }
            
            .navbar-top {
                padding: 10px 15px;
            }
            
            .main-content {
                padding: 15px;
            }
            
            /* Overlay when sidebar is open */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
            
            .sidebar-overlay.active {
                display: block;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 769px) {
            .sidebar {
                transform: translateX(0) !important;
            }
            
            #sidebarToggle {
                display: none;
            }
            
            .sidebar-overlay {
                display: none !important;
            }
        }
        
        /* Table styles */
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: var(--text-primary);
            background-color: var(--dark-card);
            border-bottom: 1px solid var(--border-glow);
        }
        
        .table td {
            border-bottom: 1px solid rgba(0, 255, 255, 0.1);
            color: var(--text-secondary);
        }
        
        .table tbody tr:hover {
            background: rgba(0, 255, 255, 0.05);
        }
        
        .table td {
            vertical-align: middle;
        }
        
        /* Form container */
        .form-container {
            background: var(--dark-surface);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 255, 255, 0.1);
            border: 1px solid var(--border-glow);
        }
        
        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(10, 10, 15, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            display: none;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--dark-card);
            border-top: 5px solid var(--neon-cyan);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Badge styles */
        .badge {
            font-weight: 500;
            padding: 5px 10px;
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
        <div class="sidebar-header p-4">
            <h3 class="mb-0">
                <i class="fas fa-terminal me-2"></i>Portfolio Admin
            </h3>
            <p class="small mb-0">Dashboard Management</p>
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