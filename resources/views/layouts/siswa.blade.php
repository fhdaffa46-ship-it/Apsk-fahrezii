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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #15213a;
            --ink-soft: #26365a;
            --paper: #faf7f1;
            --paper-dim: #efe9dd;
            --orange: #e8622c;
            --orange-soft: #f2946b;
            --green: #2f8f5b;
            --slate: #5b6b7c;
            --slate-light: #93a1b0;
            --ease-float: cubic-bezier(.22, 1, .36, 1);
        }

        /* ---------- KEYFRAMES ---------- */
        @keyframes floatY      { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-7px); } }
        @keyframes floatYSoft  { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }
        @keyframes riseIn      { from { opacity: 0; transform: translateY(34px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-26px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes menuIn      { from { opacity: 0; translate: 0 14px; scale: .96; } to { opacity: 1; translate: 0 0; scale: 1; } }
        @keyframes orbDrift    { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(40px,-30px) scale(1.12); } }
        @keyframes gridDrift   { from { background-position: 0 0; } to { background-position: 40px 40px; } }
        @keyframes pulseRing   { 0% { box-shadow: 0 0 0 0 rgba(232,98,44,.5); } 100% { box-shadow: 0 0 0 12px rgba(232,98,44,0); } }

        /* ---------- BASE ---------- */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--paper);
            color: var(--ink);
        }

        h1, h2, h3, h4, h5, h6, .brand-text, .user-name {
            font-family: 'Space Grotesk', sans-serif;
        }

        .wrapper { position: relative; z-index: 1; }

        /* orb latar yang melayang pelan */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            filter: blur(30px);
            animation: orbDrift 14s ease-in-out infinite;
        }
        .bg-orb.o1 { width: 460px; height: 460px; top: -120px; right: -100px; background: radial-gradient(circle, rgba(232,98,44,.20), rgba(232,98,44,0) 68%); }
        .bg-orb.o2 { width: 520px; height: 520px; bottom: -180px; left: 20%; background: radial-gradient(circle, rgba(38,54,90,.16), rgba(38,54,90,0) 68%); animation-delay: -6s; }

        /* progress bar tipis di atas halaman */
        #topbar {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            width: 0;
            opacity: 0;
            z-index: 2000;
            background: linear-gradient(90deg, var(--orange), var(--orange-soft));
            box-shadow: 0 0 10px rgba(232,98,44,.7);
            transition: width .7s var(--ease-float), opacity .35s ease;
        }

        /* ---------- NAVBAR ---------- */
        .navbar-clean {
            background: rgba(255,255,255,.82) !important;
            -webkit-backdrop-filter: blur(14px);
            backdrop-filter: blur(14px);
            box-shadow: 0 8px 30px rgba(21,33,58,.06);
            border-bottom: 1px solid rgba(21,33,58,.06);
        }

        .navbar-clean .nav-link { color: var(--ink-soft); }

        .nav-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: transform .4s var(--ease-float), background .25s ease, color .25s ease;
        }
        .nav-icon-btn:hover {
            background: #fdece3;
            color: var(--orange) !important;
            transform: translateY(-3px);
        }

        .nav-greeting {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            color: var(--ink);
            margin-left: .6rem;
        }
        .nav-greeting small {
            display: block;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            color: var(--slate);
            font-size: .72rem;
            line-height: 1.1;
        }

        .navbar-user-menu {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .4rem .9rem .4rem .4rem;
            border-radius: 999px;
            background: #fff;
            border: 1px solid #ece5d6;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(21,33,58,.05);
            transition: transform .4s var(--ease-float), box-shadow .4s var(--ease-float), border-color .25s ease;
        }
        .navbar-user-menu:hover {
            transform: translateY(-3px);
            border-color: var(--orange-soft);
            box-shadow: 0 14px 28px rgba(21,33,58,.12);
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px var(--orange-soft);
            transition: transform .4s var(--ease-float);
        }
        .profile-avatar:hover { transform: scale(1.08) rotate(-4deg); }

        /* dropdown profil */
        .dropdown-menu.menu-float {
            border: 1px solid #ece5d6;
            border-radius: 18px;
            padding: .5rem;
            box-shadow: 0 30px 60px rgba(21,33,58,.18);
            min-width: 270px;
        }
        .dropdown-menu.menu-float.show { animation: menuIn .38s var(--ease-float) both; }

        .dd-user {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .9rem;
            margin-bottom: .4rem;
            border-radius: 14px;
            background: var(--ink);
            color: #fff;
        }
        .dd-user .profile-avatar { width: 48px; height: 48px; flex-shrink: 0; }
        .dd-user .dd-name { font-family: 'Space Grotesk', sans-serif; font-weight: 600; line-height: 1.2; }
        .dd-user .dd-class { color: #b7c1d4; font-size: .8rem; }

        .dd-item {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .7rem .9rem;
            border-radius: 12px;
            border: 0;
            background: transparent;
            width: 100%;
            text-align: left;
            color: var(--ink);
            transition: transform .35s var(--ease-float), background .2s ease;
        }
        .dd-item:hover { background: var(--paper); transform: translateX(5px); color: var(--ink); }
        .dd-item i { font-size: 1.3rem; }
        .dd-item small { display: block; color: var(--slate); }
        .dd-item.danger:hover { background: #fdecea; }

        /* ---------- SIDEBAR ---------- */
        .sidebar-enhanced {
            background-color: var(--ink) !important;
            background-image:
                linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px),
                radial-gradient(circle at 0% 100%, rgba(232,98,44,.22), transparent 55%);
            background-size: 40px 40px, 40px 40px, 100% 100%;
            animation: gridDrift 20s linear infinite;
            box-shadow: 8px 0 40px rgba(21,33,58,.18);
        }

        .brand-link-enhanced {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            background: transparent !important;
            border-bottom: 1px solid rgba(255,255,255,.08) !important;
            padding: 1.4rem 1rem !important;
            text-decoration: none;
        }

        .brand-mark {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--orange), var(--orange-soft));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: .7rem;
            box-shadow: 0 14px 28px rgba(232,98,44,.45);
            animation: floatY 5s ease-in-out infinite;
            transition: transform .5s var(--ease-float);
        }
        .brand-link-enhanced:hover .brand-mark { transform: rotate(-10deg) scale(1.08); }

        .brand-text-wrap {
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: -.01em;
            text-align: center;
        }

        .user-panel-clean {
            background: rgba(255,255,255,.06);
            border-radius: 16px;
            margin: 1.25rem 1rem 1rem;
            padding: 1rem;
            border: 1px solid rgba(255,255,255,.1);
            -webkit-backdrop-filter: blur(6px);
            backdrop-filter: blur(6px);
            animation: floatYSoft 6s ease-in-out infinite;
            transition: border-color .3s ease, background .3s ease;
        }
        .user-panel-clean:hover { background: rgba(255,255,255,.1); border-color: rgba(242,148,107,.5); }

        .user-panel-clean .profile-avatar { width: 46px; height: 46px; border-color: var(--ink); }

        .user-name { font-weight: 600; color: #fff; font-size: .95rem; }
        .user-class { color: #93a1b0; font-size: .78rem; font-weight: 500; }

        .btn-edit-mini {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border: 1px solid rgba(255,255,255,.25);
            transition: transform .4s var(--ease-float), background .25s ease, border-color .25s ease;
        }
        .btn-edit-mini:hover { background: var(--orange); border-color: var(--orange); color: #fff; transform: rotate(-12deg) scale(1.1); }

        /* menu navigasi */
        .nav-item-enhanced {
            opacity: 0;
            animation: slideInLeft .7s var(--ease-float) forwards;
            animation-delay: calc(.15s + var(--i, 0) * .09s);
        }

        .sidebar-enhanced .nav-item-enhanced > .nav-link {
            position: relative;
            border-radius: 14px;
            margin: .35rem 1rem;
            padding: .85rem 1.1rem;
            color: #b7c1d4;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            transition: transform .4s var(--ease-float), background .25s ease, color .25s ease, box-shadow .4s var(--ease-float), border-color .25s ease;
        }

        .sidebar-enhanced .nav-item-enhanced > .nav-link p { margin: 0; font-weight: 500; }

        .nav-icon-enhanced {
            width: 22px;
            margin-right: 12px;
            font-size: 1.15rem;
            transition: transform .4s var(--ease-float);
        }

        .sidebar-enhanced .nav-item-enhanced > .nav-link:hover {
            background: rgba(255,255,255,.08);
            border-color: rgba(255,255,255,.14);
            color: #fff;
            transform: translate(6px, -2px);
            box-shadow: 0 12px 24px rgba(0,0,0,.25);
        }
        .sidebar-enhanced .nav-item-enhanced > .nav-link:hover .nav-icon-enhanced {
            transform: translateY(-3px) rotate(-8deg) scale(1.15);
        }

        .sidebar-enhanced .nav-item-enhanced > .nav-link.active {
            background: linear-gradient(135deg, var(--orange), #f07a45);
            color: #fff;
            border-color: rgba(255,255,255,.2);
            box-shadow: 0 14px 28px rgba(232,98,44,.4);
            animation: floatYSoft 4.5s ease-in-out infinite;
        }

        /* kartu ajakan di bawah sidebar */
        .sidebar-cta {
            margin: 1.6rem 1rem 1.5rem;
            padding: 1.2rem;
            border-radius: 18px;
            background: var(--paper);
            color: var(--ink);
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,.3);
            transform: rotate(-2deg);
            animation: riseIn .9s var(--ease-float) .6s both;
            transition: transform .5s var(--ease-float);
        }
        .sidebar-cta:hover { transform: rotate(0deg) translateY(-4px); }
        .sidebar-cta .cta-icon { font-size: 1.6rem; display: inline-block; animation: floatY 4s ease-in-out infinite; }
        .sidebar-cta h6 { font-weight: 700; margin: .5rem 0 .25rem; font-size: .98rem; }
        .sidebar-cta p { color: var(--slate); font-size: .8rem; line-height: 1.5; margin-bottom: .9rem; }
        .sidebar-cta .btn-cta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            background: var(--orange);
            color: #fff;
            border-radius: 10px;
            padding: .55rem;
            font-weight: 600;
            font-size: .85rem;
            text-decoration: none;
            transition: background .25s ease, transform .4s var(--ease-float), box-shadow .4s var(--ease-float);
            box-shadow: 0 8px 18px rgba(232,98,44,.35);
        }
        .sidebar-cta .btn-cta:hover { background: #d1531e; color: #fff; transform: translateY(-2px); box-shadow: 0 14px 24px rgba(232,98,44,.45); }

        /* ---------- KONTEN ---------- */
        .content-wrapper { background: transparent !important; }

        .page-head {
            margin-bottom: 1.2rem;
            animation: riseIn .8s var(--ease-float) both;
        }
        .page-head h1 { font-size: 1.7rem; font-weight: 700; letter-spacing: -.02em; margin: 0; }

        .content-card-clean {
            background: #fff;
            border-radius: 22px;
            border: 1px solid #ece5d6;
            box-shadow: 0 2px 4px rgba(21,33,58,.03), 0 30px 60px rgba(21,33,58,.08);
            overflow: hidden;
            animation: riseIn .9s var(--ease-float) .12s both;
        }

        .content-card-clean .btn { border-radius: 10px; font-weight: 500; transition: transform .4s var(--ease-float), box-shadow .4s var(--ease-float); }
        .content-card-clean .btn:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(21,33,58,.15); }
        .content-card-clean .card { border-radius: 16px; border: 1px solid #ece5d6; transition: transform .45s var(--ease-float), box-shadow .45s var(--ease-float); }
        .content-card-clean .card:hover { transform: translateY(-5px); box-shadow: 0 22px 40px rgba(21,33,58,.1); }
        .content-card-clean .form-control:focus,
        .content-card-clean .form-select:focus { border-color: var(--orange-soft); box-shadow: 0 0 0 .22rem rgba(232,98,44,.15); }

        .btn-modern {
            border-radius: 10px;
            font-weight: 500;
            padding: .625rem 1.5rem;
            transition: transform .4s var(--ease-float), box-shadow .4s var(--ease-float);
        }
        .btn-modern:hover { transform: translateY(-3px); box-shadow: 0 14px 26px rgba(21,33,58,.18); }

        .breadcrumb-clean { background: transparent; padding: 0; margin: 0 0 1.5rem 0; }
        .breadcrumb-clean .breadcrumb-item a { color: var(--slate); text-decoration: none; font-weight: 500; }
        .breadcrumb-clean .breadcrumb-item a:hover { color: var(--orange); }
        .breadcrumb-clean .breadcrumb-item.active { color: var(--ink); font-weight: 600; }

        .main-footer {
            background: transparent !important;
            border-top: 0 !important;
            color: var(--slate);
            font-size: .82rem;
        }

        /* fokus keyboard terlihat jelas */
        a:focus-visible, button:focus-visible {
            outline: 3px solid var(--orange-soft);
            outline-offset: 2px;
        }

        /* sidebar terlipat: panel & kartu ajakan disembunyikan */
        .sidebar-collapse:not(.sidebar-open) .main-sidebar:not(:hover) .user-panel-clean,
        .sidebar-collapse:not(.sidebar-open) .main-sidebar:not(:hover) .sidebar-cta { display: none; }

        @media (max-width: 768px) {
            .content-wrapper { padding: 1rem; }
            .content-wrapper .content { padding-left: .5rem !important; padding-right: .5rem !important; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition-duration: .01ms !important; }
            .nav-item-enhanced { opacity: 1; }
        }
    </style>
    @stack('css')
</head>

@php
    $siswa = auth('siswa')->user();
    $namaSiswa = $siswa->nama ?? 'Siswa';
    $fotoSiswa = ($siswa && $siswa->foto_profil)
        ? asset('storage/' . $siswa->foto_profil)
        : 'https://ui-avatars.com/api/?name=' . urlencode($namaSiswa) . '&background=e8622c&color=fff&size=96';
@endphp

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="topbar"></div>
    <div class="bg-orb o1"></div>
    <div class="bg-orb o2"></div>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-clean">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link nav-icon-btn" data-widget="pushmenu" href="#" role="button" aria-label="Buka atau tutup menu">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link nav-icon-btn" aria-label="Dashboard">
                        <i class="bi bi-house-door-fill"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <div class="nav-greeting">
                        Halo, {{ Str::words($namaSiswa, 1, '') }}
                        <small>Ada fasilitas yang perlu dilaporkan?</small>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-user-menu" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $fotoSiswa }}" class="profile-avatar" alt="Foto profil">
                        <span class="d-none d-md-inline fw-semibold text-sm">{{ Str::limit($namaSiswa, 15) }}</span>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end menu-float mt-2">
                        <div class="dd-user">
                            <img src="{{ $fotoSiswa }}" class="profile-avatar" alt="Foto profil">
                            <div>
                                <div class="dd-name">{{ $namaSiswa }}</div>
                                <div class="dd-class">{{ $siswa->kelas ?? '-' }}</div>
                            </div>
                        </div>
                        <a href="{{ route('siswa.akun.edit') }}" class="dd-item text-decoration-none">
                            <i class="bi bi-person-gear text-primary"></i>
                            <div>
                                <div class="fw-semibold">Profil Saya</div>
                                <small>Kelola data pribadi</small>
                            </div>
                        </a>
                        <a href="{{ route('siswa.laporan.create') }}" class="dd-item text-decoration-none">
                            <i class="bi bi-plus-circle text-success"></i>
                            <div>
                                <div class="fw-semibold">Buat Pengaduan</div>
                                <small>Laporkan masalah</small>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('siswa.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dd-item danger">
                                <i class="bi bi-box-arrow-right text-danger"></i>
                                <span class="fw-semibold">Keluar</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary sidebar-enhanced elevation-0">
            <a href="{{ route('siswa.dashboard') }}" class="brand-link brand-link-enhanced">
                <span class="brand-mark"><i class="bi bi-building-gear"></i></span>
                <span class="brand-text brand-text-wrap">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">
                <!-- User Panel -->
                <div class="user-panel-clean">
                    <div class="d-flex align-items-center">
                        <div class="image">
                            <img src="{{ $fotoSiswa }}" class="profile-avatar" alt="Foto profil">
                        </div>
                        <div class="info flex-grow-1 ms-3">
                            <div class="user-name d-block">{{ Str::limit($namaSiswa, 14) }}</div>
                            <div class="user-class">{{ $siswa->kelas ?? '-' }}</div>
                        </div>
                        <a href="{{ route('siswa.akun.edit') }}" class="btn-edit-mini" aria-label="Edit profil">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact nav-legacy" data-widget="treeview" role="menu">
                        <li class="nav-item-enhanced" style="--i:0">
                            <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon nav-icon-enhanced bi bi-speedometer2"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item-enhanced" style="--i:1">
                            <a href="{{ route('siswa.akun.edit') }}" class="nav-link {{ request()->routeIs('siswa.akun.*') ? 'active' : '' }}">
                                <i class="nav-icon nav-icon-enhanced bi bi-person-vcard"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item-enhanced" style="--i:2">
                            <a href="{{ route('siswa.laporan.create') }}" class="nav-link {{ request()->routeIs('siswa.laporan.create') ? 'active' : '' }}">
                                <i class="nav-icon nav-icon-enhanced bi bi-plus-circle"></i>
                                <p>Buat Pengaduan</p>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Kartu ajakan -->
                <div class="sidebar-cta">
                    <span class="cta-icon">🔧</span>
                    <h6>Ada yang rusak?</h6>
                    <p>Foto, pilih ruangan, kirim. Selesai dalam 30 detik.</p>
                    <a href="{{ route('siswa.laporan.create') }}" class="btn-cta">
                        <i class="bi bi-camera"></i> Lapor sekarang
                    </a>
                </div>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content pt-3 px-4">
                <div class="container-fluid">
                    @hasSection ('page_title')
                        <div class="page-head">
                            <h1>@yield('page_title')</h1>
                        </div>
                    @endif

                    <div class="content-card-clean p-4 p-md-5">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }} &middot; Sistem Pengaduan Sarana Kampus
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        (function () {
            var bar = document.getElementById('topbar');
            if (!bar) return;

            // progress bar saat halaman selesai dimuat
            window.addEventListener('pageshow', function () {
                bar.style.opacity = '1';
                bar.style.width = '100%';
                setTimeout(function () { bar.style.opacity = '0'; }, 450);
                setTimeout(function () { bar.style.width = '0'; }, 900);
            });

            // progress bar saat pindah halaman
            document.addEventListener('click', function (e) {
                var a = e.target.closest ? e.target.closest('a[href]') : null;
                if (!a) return;
                var href = a.getAttribute('href');
                if (!href || href.charAt(0) === '#' || a.target === '_blank' || a.host !== location.host) return;
                if (a.hasAttribute('data-widget') || a.hasAttribute('data-bs-toggle') || e.metaKey || e.ctrlKey) return;
                bar.style.opacity = '1';
                bar.style.width = '80%';
            });
        })();
    </script>
    @stack('js')
</body>
</html>