<style>
    .nav-link-custom {
        font-weight: 500;
        color: #555;
        transition: 0.3s;
        position: relative;
    }

    .nav-link-custom:hover {
        color: #4e73df;
    }

    .nav-btn {
        padding: 6px 18px;
        border-radius: 50px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-login {
        color: #4e73df;
        border: 1px solid #4e73df;
    }

    .btn-login:hover {
        background: #4e73df;
        color: white;
    }

    .btn-register {
        background: #4e73df;
        color: white;
        border: none;
    }

    .btn-register:hover {
        background: #2e59d9;
    }
</style>

@guest('siswa')
    <li class="nav-item">
        <a class="nav-link nav-link-custom" href="{{ route('siswa.login') }}">
            Login
        </a>
    </li>

    <li class="nav-item ms-2">
        <a class="nav-link nav-btn btn-login" href="{{ route('siswa.login') }}">
            Masuk
        </a>
    </li>

    <li class="nav-item ms-2">
        <a class="nav-link nav-btn btn-register" href="{{ route('siswa.register') }}">
            Daftar
        </a>
    </li>
@endguest