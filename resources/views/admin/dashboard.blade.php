@extends('layouts.admin')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap');

    :root {
        --ink: #15213a;
        --paper: #faf7f1;
        --paper-dim: #efe9dd;
        --orange: #e8622c;
        --orange-soft: #fdece3;
        --green: #2f8f5b;
        --green-soft: #e6f4ec;
        --slate: #5b6b7c;
        --slate-light: #93a1b0;
        --slate-soft: #eef1f4;
        --border: #e7e2d6;
    }

    .dashboard-container {
        background: var(--paper);
        padding: 1.5rem 0 2rem;
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }

    .dash-title {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--ink);
        margin-bottom: 1.2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #fff;
        border: 1px solid var(--border);
        border-left: 4px solid var(--slate-light);
        border-radius: 12px;
        padding: 1.3rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(21,33,58,0.08);
    }

    .stat-card.tone-info { border-left-color: var(--ink); }
    .stat-card.tone-pending { border-left-color: var(--slate-light); }
    .stat-card.tone-progress { border-left-color: var(--orange); }
    .stat-card.tone-done { border-left-color: var(--green); }

    .stat-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .tone-info .stat-icon { background: var(--slate-soft); }
    .tone-pending .stat-icon { background: var(--slate-soft); }
    .tone-progress .stat-icon { background: var(--orange-soft); }
    .tone-done .stat-icon { background: var(--green-soft); }

    .stat-content h3 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--ink);
        margin: 0;
        line-height: 1.2;
    }

    .stat-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--slate);
        margin: 0.15rem 0 0;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.75rem;
        }

        .stat-content h3 { font-size: 1.3rem; }

        .stat-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            font-size: 1.05rem;
        }
    }
</style>

<div class="dashboard-container">
    <div class="container">

        <h4 class="dash-title">Ringkasan</h4>

        <div class="stats-grid">

            <!-- Total Siswa -->
            <div class="stat-card tone-info">
                <div class="stat-icon">🎓</div>
                <div class="stat-content">
                    <h3>{{ $totalSiswa ?? 0 }}</h3>
                    <p class="stat-label">Total MahaSiswa</p>
                </div>
            </div>

            <!-- Total Laporan -->
            <div class="stat-card tone-info">
                <div class="stat-icon">🎫</div>
                <div class="stat-content">
                    <h3>{{ $totalLaporan ?? 0 }}</h3>
                    <p class="stat-label">Total Laporan</p>
                </div>
            </div>

            <!-- Menunggu -->
            <div class="stat-card tone-pending">
                <div class="stat-icon">⏳</div>
                <div class="stat-content">
                    <h3>{{ $laporanMenunggu ?? 0 }}</h3>
                    <p class="stat-label">Menunggu</p>
                </div>
            </div>

            <!-- Diproses -->
            <div class="stat-card tone-progress">
                <div class="stat-icon">🔧</div>
                <div class="stat-content">
                    <h3>{{ $laporanProses ?? 0 }}</h3>
                    <p class="stat-label">Diproses</p>
                </div>
            </div>

            <!-- Selesai -->
            <div class="stat-card tone-done">
                <div class="stat-icon">✅</div>
                <div class="stat-content">
                    <h3>{{ $laporanSelesai ?? 0 }}</h3>
                    <p class="stat-label">Selesai</p>
                </div>
            </div>

        </div>

        <!-- Recent Reports -->
        <div>
            @include('admin.list-laporan')
        </div>

    </div>
</div>
@endsection