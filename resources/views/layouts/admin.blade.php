<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection ('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bs/font/bootstrap-icons.min.css') }}">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --sidebar-bg: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.3);
            --shadow-glow: 0 10px 30px rgba(99, 102, 241, 0.2);
        }

        /* Navbar Modern */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }

        .navbar-brand, .nav-link {
            transition: all 0.3s ease !important;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(139,92,246,0.1));
            border-radius: 12px;
            margin-right: 1rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(99,102,241,0.2);
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(99,102,241,0.3);
        }

        /* Sidebar Modern */
        .main-sidebar {
            background: var(--sidebar-bg) !important;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            border-right: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
        }

        .brand-link {
            background: var(--primary-gradient) !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 1.25rem !important;
            transition: all 0.3s ease;
        }

        .brand-link:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .brand-text {
            font-weight: 700 !important;
            font-size: 1.3rem !important;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        /* Nav Items */
        .nav-sidebar .nav-link {
            padding: 0.875rem 1rem;
            border-radius: 12px;
            margin: 0.25rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15) !important;
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.3);
        }

        .nav-sidebar .nav-link.active {
            background: var(--primary-gradient) !important;
            box-shadow: var(--shadow-glow);
            transform: translateX(4px);
            border-color: rgba(255,255,255,0.3);
        }

        .nav-icon {
            width: 24px !important;
            margin-right: 12px !important;
            transition: transform 0.3s ease;
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* Content Wrapper */
        .content-wrapper {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 20px 20px 0 0;
            margin: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
        }

        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.5), transparent);
        }

        /* Buttons Modern */
        .btn {
            border-radius: 12px !important;
            font-weight: 600 !important;
            padding: 0.625rem 1.5rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            backdrop-filter: blur(10px);
            border: 2px solid transparent !important;
        }

        .btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }

        .btn-outline-secondary {
            background: rgba(255,255,255,0.9) !important;
            border-color: rgba(107,114,128,0.3) !important;
        }

        .btn-outline-danger {
            background: rgba(255,255,255,0.9) !important;
            border-color: rgba(239,68,68,0.3) !important;
            color: #dc2626 !important;
        }

        .btn-outline-danger:hover {
            background: rgba(239,68,68,0.1) !important;
            border-color: #ef4444 !important;
            color: #dc2626 !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .content-wrapper {
                margin: 1rem;
                border-radius: 16px;
            }
        }

        @media (max-width: 768px) {
            .profile-section {
                margin-right: 0.5rem;
                padding: 0.375rem 0.75rem;
            }
            
            .profile-avatar {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }
        }
    </style>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item profile-section">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth('admin')->user()->nama ?? 'A', 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline small fw-semibold" style="color: #374151;">
                        {{ auth('admin')->user()->nama ?? 'Admin' }}
                    </span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.akun') }}" class="btn btn-outline-secondary btn-sm mr-2 mt-1">
                        <i class="bi bi-person-circle"></i> Akun
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-1 d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p><span>Dashboard</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-card-checklist"></i>
                                <p><span>Laporan</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p><span>Kategori</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.lokasi.index') }}" class="nav-link {{ request()->routeIs('admin.lokasi.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-geo-alt"></i>
                                <p><span>Lokasi</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sarana.index') }}" class="nav-link {{ request()->routeIs('admin.sarana.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tools"></i>
                                <p><span>Sarana</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admin-data.index') }}" class="nav-link {{ request()->routeIs('admin.admin-data.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p><span>Admin</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.siswa-data.index') }}" class="nav-link {{ request()->routeIs('admin.siswa-data.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p><span>Mahasiswa</span></p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper pt-3">
            <section class="content">
                <div class="container-fluid p-3">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
</body>

</html>