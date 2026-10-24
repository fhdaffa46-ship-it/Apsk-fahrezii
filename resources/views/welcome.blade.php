@extends('layouts.welcome')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap');

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

    * { box-sizing: border-box; }
    body { overflow-x: hidden; }

    /* ---------- KEYFRAMES ---------- */
    @keyframes floatY {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-14px); }
    }
    @keyframes floatYSoft {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-8px); }
    }
    @keyframes gridDrift {
        from { background-position: 0 0; }
        to   { background-position: 48px 48px; }
    }
    @keyframes ticketIn {
        from { opacity: 0; transform: translateY(70px) rotate(-9deg) scale(.94); }
        to   { opacity: 1; transform: translateY(0) rotate(-3deg) scale(1); }
    }
    @keyframes chipIn {
        from { opacity: 0; transform: translateY(30px) scale(.85); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes riseIn {
        from { opacity: 0; transform: translateY(36px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulseRing {
        0%   { box-shadow: 0 0 0 0 rgba(232,98,44,.45); }
        100% { box-shadow: 0 0 0 14px rgba(232,98,44,0); }
    }
    @keyframes glowShift {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50%      { transform: translate(30px, -24px) scale(1.12); }
    }

    /* ---------- HERO ---------- */
    .hero-section {
        min-height: 100vh;
        background: var(--ink);
        background-image:
            linear-gradient(var(--ink-soft) 1px, transparent 1px),
            linear-gradient(90deg, var(--ink-soft) 1px, transparent 1px);
        background-size: 48px 48px;
        background-position: center;
        animation: gridDrift 14s linear infinite;
        position: relative;
        display: flex;
        align-items: center;
        padding: 6rem 0 4rem;
        overflow: hidden;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 30% 40%, rgba(21,33,58,0) 0%, var(--ink) 75%);
        pointer-events: none;
    }

    .hero-glow {
        position: absolute;
        width: 520px;
        height: 520px;
        right: -120px;
        top: 8%;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(232,98,44,.35) 0%, rgba(232,98,44,0) 68%);
        filter: blur(20px);
        animation: glowShift 11s ease-in-out infinite;
        z-index: 1;
        pointer-events: none;
    }

    .hero-content { position: relative; z-index: 2; }

    .hero-content > * {
        opacity: 0;
        animation: riseIn .9s var(--ease-float) forwards;
    }
    .hero-content > *:nth-child(1) { animation-delay: .1s; }
    .hero-content > *:nth-child(2) { animation-delay: .25s; }
    .hero-content > *:nth-child(3) { animation-delay: .4s; }
    .hero-content > *:nth-child(4) { animation-delay: .55s; }

    .hero-eyebrow {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.8rem;
        letter-spacing: 0.14em;
        color: var(--orange-soft);
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
    }

    .hero-eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--orange);
        animation: pulseRing 1.8s ease-out infinite;
    }

    .hero-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2.2rem, 4.2vw, 3.4rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin-bottom: 1.4rem;
    }

    .hero-title span { color: var(--orange-soft); }

    .hero-desc {
        font-size: 1.1rem;
        color: #b7c1d4;
        line-height: 1.7;
        margin-bottom: 2.4rem;
        max-width: 460px;
    }

    .btn-modern {
        padding: 14px 30px;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        transition: transform .35s var(--ease-float), box-shadow .35s var(--ease-float), background .25s ease, border-color .25s ease, color .25s ease;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255,255,255,.28), transparent);
        transform: skewX(-20deg);
        transition: left .7s var(--ease-float);
    }
    .btn-modern:hover::before { left: 130%; }

    .btn-primary-modern {
        background: var(--orange);
        color: #fff;
        box-shadow: 0 8px 20px rgba(232,98,44,0.35);
    }

    .btn-primary-modern:hover {
        background: #d1531e;
        transform: translateY(-5px);
        box-shadow: 0 18px 32px rgba(232,98,44,0.45);
        color: #fff;
    }

    .btn-outline-custom {
        background: transparent;
        color: #e7ebf2;
        border: 1.5px solid #3a4a6b;
    }

    .btn-outline-custom:hover {
        border-color: var(--orange-soft);
        color: var(--orange-soft);
        transform: translateY(-5px);
    }

    .btn-modern:focus-visible {
        outline: 3px solid var(--orange-soft);
        outline-offset: 3px;
    }

    /* ---------- TICKET MOCKUP (signature element) ---------- */
    .hero-right {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 460px;
    }

    /* tiga lapis: parallax (JS) > float (CSS) > elemen */
    .layer {
        position: absolute;
        transition: transform .5s var(--ease-float);
        will-change: transform;
    }
    .layer.main { position: relative; width: 100%; max-width: 380px; }

    .float-a { animation: floatY 6.5s ease-in-out infinite; }
    .float-b { animation: floatYSoft 5s ease-in-out infinite -1.2s; }
    .float-c { animation: floatYSoft 7.5s ease-in-out infinite -3s; }

    .ticket-mock {
        width: 100%;
        background: var(--paper);
        border-radius: 16px;
        padding: 1.6rem;
        box-shadow: 0 40px 70px rgba(0,0,0,0.4);
        transform: rotate(-3deg);
        opacity: 0;
        animation: ticketIn 1.1s var(--ease-float) .35s forwards;
        transition: transform .5s var(--ease-float), box-shadow .5s var(--ease-float);
        font-family: 'Inter', sans-serif;
    }

    .ticket-mock:hover {
        transform: rotate(0deg) scale(1.02);
        box-shadow: 0 50px 90px rgba(0,0,0,0.45);
    }

    .ticket-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px dashed #d8d0bf;
    }

    .ticket-id {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.78rem;
        color: var(--slate);
        letter-spacing: 0.03em;
    }

    .ticket-status {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        transition: background .5s ease, color .5s ease;
    }

    .ticket-status.pending  { background: #eef0f3; color: var(--slate); }
    .ticket-status.progress { background: #fdece3; color: var(--orange); }
    .ticket-status.done     { background: #e1f3e9; color: var(--green); }

    .ticket-room {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--ink);
        margin-bottom: 0.4rem;
    }

    .ticket-issue {
        font-size: 0.92rem;
        color: var(--slate);
        line-height: 1.55;
        margin-bottom: 1rem;
    }

    .ticket-photo {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--paper-dim);
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.8rem;
        color: var(--slate);
        margin-bottom: 1.3rem;
    }

    .ticket-steps {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .ticket-steps .step {
        flex: 1;
        text-align: center;
        font-size: 0.68rem;
        font-weight: 600;
        color: var(--slate-light);
        position: relative;
        padding-top: 14px;
        transition: color .5s ease;
    }

    .ticket-steps .step::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #e2ddd0;
        border: 2px solid var(--paper);
        transition: background .5s ease, transform .5s var(--ease-float);
        z-index: 1;
    }

    .ticket-steps .step::after {
        content: '';
        position: absolute;
        top: 4px;
        left: 100%;
        width: 100%;
        height: 2px;
        background: #e2ddd0;
        transition: background .6s ease;
    }

    .ticket-steps .step:last-child::after { display: none; }

    .ticket-steps .step.done { color: var(--green); }
    .ticket-steps .step.done::before { background: var(--green); }
    .ticket-steps .step.done::after { background: var(--green); }

    .ticket-steps .step.active { color: var(--orange); }
    .ticket-steps .step.active::before { background: var(--orange); transform: translateX(-50%) scale(1.5); animation: pulseRing 1.6s ease-out infinite; }

    .ticket-foot {
        font-size: 0.76rem;
        color: var(--slate-light);
        text-align: right;
    }

    /* chip & toast melayang di sekitar tiket */
    .chip {
        background: #fff;
        border-radius: 12px;
        padding: 10px 16px;
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--ink);
        box-shadow: 0 16px 32px rgba(0,0,0,0.25);
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        opacity: 0;
        animation: chipIn .8s var(--ease-float) forwards;
    }

    .layer.chip-room  { top: 6%;  left: 0;   animation-delay: .9s; }
    .layer.chip-notif { top: 20%; right: -2%; }
    .layer.chip-toast { bottom: 2%; left: 8%; }

    .layer.chip-room  .chip { animation-delay: .9s; }
    .layer.chip-notif .chip { animation-delay: 1.15s; }
    .layer.chip-toast .chip { animation-delay: 1.4s; color: var(--green); }

    .chip-toast .chip.pop { animation: chipIn .5s var(--ease-float); }

    @media (max-width: 992px) {
        .hero-right { margin-top: 3rem; min-height: 420px; }
        .layer.chip-room, .layer.chip-notif { display: none; }
        .hero-glow { right: -240px; }
    }

    /* ---------- SCROLL REVEAL ---------- */
    .reveal {
        opacity: 0;
        transform: translateY(48px);
        transition: opacity .9s var(--ease-float), transform .9s var(--ease-float);
        transition-delay: var(--d, 0s);
    }
    .reveal.in { opacity: 1; transform: translateY(0); }

    /* ---------- FEATURES ---------- */
    .features-section {
        padding: 110px 0;
        background: var(--paper);
        position: relative;
    }

    .section-eyebrow {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.78rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--orange);
        text-align: center;
        display: block;
        margin-bottom: 0.8rem;
    }

    .section-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(1.8rem, 3.4vw, 2.6rem);
        font-weight: 700;
        color: var(--ink);
        text-align: center;
        margin-bottom: 3.5rem;
    }

    .feature-card {
        background: #fff;
        border: 1px solid #ece5d6;
        border-left: 4px solid var(--orange);
        border-radius: 10px;
        padding: 2rem 1.8rem;
        height: 100%;
        box-shadow: 0 10px 24px rgba(21,33,58,0.05);
        animation: floatYSoft 6s ease-in-out infinite;
        animation-delay: var(--fd, 0s);
        transition: box-shadow .45s var(--ease-float), border-color .3s ease;
    }

    .feature-card:hover {
        animation-play-state: paused;
        box-shadow: 0 30px 55px rgba(21,33,58,0.14);
    }

    .feature-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        font-size: 1.8rem;
        background: #fdece3;
        border-radius: 14px;
        margin-bottom: 1.2rem;
        transition: transform .5s var(--ease-float), background .3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: translateY(-6px) rotate(-8deg) scale(1.1);
        background: #fbd9c8;
    }

    .feature-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 0.7rem;
    }

    .feature-desc {
        font-family: 'Inter', sans-serif;
        color: var(--slate);
        line-height: 1.65;
        font-size: 0.98rem;
        margin: 0;
    }

    /* ---------- ALUR (urutan nyata: 1 → 2 → 3) ---------- */
    .flow-section {
        padding: 100px 0;
        background: var(--paper-dim);
    }

    .flow-track {
        position: relative;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .flow-track::before {
        content: '';
        position: absolute;
        top: 34px;
        left: 16%;
        right: 16%;
        height: 2px;
        background: repeating-linear-gradient(90deg, var(--orange-soft) 0 8px, transparent 8px 16px);
        opacity: .6;
    }

    .flow-step { text-align: center; position: relative; }

    .flow-num {
        width: 68px;
        height: 68px;
        margin: 0 auto 1.3rem;
        border-radius: 50%;
        background: var(--ink);
        color: #fff;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 14px 28px rgba(21,33,58,.3);
        animation: floatY 5.5s ease-in-out infinite;
        animation-delay: var(--fd, 0s);
        transition: background .3s ease;
    }

    .flow-step:hover .flow-num { background: var(--orange); }

    .flow-step h5 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--ink);
        margin-bottom: .5rem;
    }

    .flow-step p {
        font-family: 'Inter', sans-serif;
        color: var(--slate);
        line-height: 1.6;
        font-size: .95rem;
        max-width: 260px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .flow-track { grid-template-columns: 1fr; gap: 2.6rem; }
        .flow-track::before { display: none; }
    }

    /* ---------- CTA ---------- */
    .cta-section {
        padding: 100px 0 110px;
        background: var(--ink);
        background-image:
            linear-gradient(var(--ink-soft) 1px, transparent 1px),
            linear-gradient(90deg, var(--ink-soft) 1px, transparent 1px);
        background-size: 48px 48px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .cta-section::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(21,33,58,.2) 0%, var(--ink) 80%);
        pointer-events: none;
    }

    .cta-inner { position: relative; z-index: 2; }

    .cta-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(1.8rem, 3.6vw, 2.8rem);
        font-weight: 700;
        color: #fff;
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
    }

    .cta-desc {
        color: #b7c1d4;
        font-size: 1.05rem;
        margin-bottom: 2.2rem;
    }

    .cta-inner .btn-modern { animation: floatYSoft 4.5s ease-in-out infinite; }
    .cta-inner .btn-modern:hover { animation-play-state: paused; }

    @media (max-width: 768px) {
        .btn-modern { width: 100%; justify-content: center; margin-bottom: 1rem; }
        .features-section, .flow-section { padding: 70px 0; }
        .feature-card { padding: 1.7rem 1.4rem; }
    }

    /* ---------- AKSESIBILITAS ---------- */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation: none !important;
            transition-duration: .01ms !important;
        }
        .reveal, .hero-content > *, .ticket-mock, .chip { opacity: 1 !important; transform: none; }
        .ticket-mock { transform: rotate(-3deg); }
    }
</style>

<div class="container-fluid px-lg-4 px-xl-5">
    <!-- HERO -->
    <div class="hero-section" id="hero">
        <div class="hero-glow"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <span class="hero-eyebrow">APSK · Sistem Pengaduan Sarana kampus</span>
                    <h1 class="hero-title">Fasilitas rusak?<br>Laporkan dalam <span>30 detik.</span></h1>
                    <p class="hero-desc">
                        Foto kerusakan, pilih ruangan, kirim. Laporan langsung masuk ke tim sarana
                        dan bisa kamu pantau statusnya sampai selesai — tanpa perlu ke ruang TU.
                    </p>

                    @guest('siswa')
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('siswa.login') }}" class="btn btn-modern btn-primary-modern">
                                Masuk Mahasiswa
                            </a>
                            <a href="{{ route('siswa.register') }}" class="btn btn-modern btn-outline-custom">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endguest
                </div>

                <div class="col-lg-6 hero-right" id="heroRight">
                    <!-- tiket utama -->
                    <div class="layer main" data-depth="14">
                        <div class="float-a">
                            <div class="ticket-mock">
                                <div class="ticket-head">
                                    <span class="ticket-id">TIKET #APS-2847</span>
                                    <span class="ticket-status progress" id="tStatus">Diproses</span>
                                </div>
                                <div class="ticket-room">Ruangan C.2.1</div>
                                <p class="ticket-issue">Keran wastafel bocor, air menggenang di lantai dekat pintu.</p>
                                <div class="ticket-photo">📎 1 foto terlampir</div>
                                <div class="ticket-steps" id="tSteps">
                                    <div class="step done">Pending</div>
                                    <div class="step active">Diproses</div>
                                    <div class="step">Selesai</div>
                                </div>
                                <div class="ticket-foot">Dilaporkan 2 jam lalu · Tim Sarana</div>
                            </div>
                        </div>
                    </div>

                    <!-- chip melayang -->
                    <div class="layer chip-room" data-depth="30">
                        <div class="float-b"><div class="chip">📍 Gedung C · Lantai 2</div></div>
                    </div>
                    <div class="layer chip-notif" data-depth="-26">
                        <div class="float-c"><div class="chip">🔔 Tim sarana menerima laporan</div></div>
                    </div>
                    <div class="layer chip-toast" data-depth="-34">
                        <div class="float-b"><div class="chip" id="tToast">✅ Status diperbarui</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FEATURES -->
    <div class="features-section">
        <div class="container">
            <span class="section-eyebrow reveal">Kenapa APSK</span>
            <h2 class="section-title reveal" style="--d:.1s">Dari laporan sampai selesai, satu alur yang jelas</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 reveal" style="--d:.1s">
                    <div class="feature-card" style="--fd:0s">
                        <span class="feature-icon">🎫</span>
                        <h5 class="feature-title">Laporan jadi tiket</h5>
                        <p class="feature-desc">
                            Setiap laporan dapat nomor tiket sendiri, lengkap dengan foto dan lokasi ruangan,
                            jadi tidak ada laporan yang terlewat atau dobel.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 reveal" style="--d:.25s">
                    <div class="feature-card" style="--fd:-1.6s">
                        <span class="feature-icon">🔧</span>
                        <h5 class="feature-title">Langsung ke tim sarana</h5>
                        <p class="feature-desc">
                            Tiket otomatis diteruskan ke tim maintenance yang sesuai, tanpa perlu
                            bolak-balik lapor manual ke petugas.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 reveal" style="--d:.4s">
                    <div class="feature-card" style="--fd:-3.2s">
                        <span class="feature-icon">📊</span>
                        <h5 class="feature-title">Status selalu jelas</h5>
                        <p class="feature-desc">
                            Pantau progres laporanmu dari <strong>Pending → Diproses → Selesai</strong>,
                            lengkap dengan notifikasi setiap ada update.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ALUR -->
    <div class="flow-section">
        <div class="container">
            <span class="section-eyebrow reveal">Cara kerja</span>
            <h2 class="section-title reveal" style="--d:.1s">Tiga langkah, tanpa antre</h2>
            <div class="flow-track">
                <div class="flow-step reveal" style="--d:.1s">
                    <div class="flow-num" style="--fd:0s">1</div>
                    <h5>Foto &amp; pilih ruangan</h5>
                    <p>Ambil foto kerusakan lalu tentukan ruangan yang bermasalah.</p>
                </div>
                <div class="flow-step reveal" style="--d:.25s">
                    <div class="flow-num" style="--fd:-1.8s">2</div>
                    <h5>Kirim laporan</h5>
                    <p>Tiket langsung diterima tim sarana saat itu juga.</p>
                </div>
                <div class="flow-step reveal" style="--d:.4s">
                    <div class="flow-num" style="--fd:-3.6s">3</div>
                    <h5>Pantau sampai selesai</h5>
                    <p>Lihat status berubah dan dapatkan notifikasi tiap update.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    @guest('siswa')
        <div class="cta-section">
            <div class="container cta-inner">
                <h2 class="cta-title reveal">Ada yang rusak di kampus? Laporkan sekarang.</h2>
                <p class="cta-desc reveal" style="--d:.1s">Daftar sekali, lalu kirim laporan kapan saja dari ponselmu.</p>
                <div class="reveal" style="--d:.2s">
                    <a href="{{ route('siswa.register') }}" class="btn btn-modern btn-primary-modern">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    @endguest
</div>

<script>
(function () {
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* 1. Scroll reveal */
    var items = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && !reduce) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
            });
        }, { threshold: 0.18, rootMargin: '0px 0px -40px 0px' });
        items.forEach(function (el) { io.observe(el); });
    } else {
        items.forEach(function (el) { el.classList.add('in'); });
    }

    if (reduce) return;

    /* 2. Parallax halus mengikuti kursor di hero */
    var hero = document.getElementById('hero');
    var layers = document.querySelectorAll('#heroRight .layer');
    if (hero && window.matchMedia('(pointer: fine)').matches) {
        hero.addEventListener('mousemove', function (ev) {
            var r = hero.getBoundingClientRect();
            var x = (ev.clientX - r.left) / r.width - 0.5;
            var y = (ev.clientY - r.top) / r.height - 0.5;
            layers.forEach(function (l) {
                var d = parseFloat(l.dataset.depth || 0);
                l.style.transform = 'translate3d(' + (x * d).toFixed(1) + 'px,' + (y * d).toFixed(1) + 'px,0)';
            });
        });
        hero.addEventListener('mouseleave', function () {
            layers.forEach(function (l) { l.style.transform = 'translate3d(0,0,0)'; });
        });
    }

    /* 3. Simulasi status tiket: Pending → Diproses → Selesai (berulang) */
    var status = document.getElementById('tStatus');
    var steps = document.querySelectorAll('#tSteps .step');
    var toast = document.getElementById('tToast');
    if (!status || steps.length < 3) return;

    var stages = [
        { cls: 'pending',  label: 'Pending',  idx: 0 },
        { cls: 'progress', label: 'Diproses', idx: 1 },
        { cls: 'done',     label: 'Selesai',  idx: 2 }
    ];
    var cur = 1;

    function render(i) {
        var s = stages[i];
        status.className = 'ticket-status ' + s.cls;
        status.textContent = s.label;
        steps.forEach(function (el, n) {
            el.classList.remove('done', 'active');
            if (n < s.idx || (i === 2 && n === 2)) el.classList.add('done');
            else if (n === s.idx) el.classList.add('active');
        });
        if (toast) {
            toast.textContent = '✅ Status diperbarui: ' + s.label;
            toast.classList.remove('pop');
            void toast.offsetWidth;
            toast.classList.add('pop');
        }
    }

    setInterval(function () {
        cur = (cur + 1) % stages.length;
        render(cur);
    }, 3600);
})();
</script>
@endsection