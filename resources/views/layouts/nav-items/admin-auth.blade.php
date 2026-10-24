@auth('admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>
    </li>

    <li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.laporan.index') }}">
                Laporan & Aspirasi
            </a>
        </li>
    
    <li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                Kategori
            </a>
        </li>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
           href="#" role="button"
           data-bs-toggle="dropdown">
            {{ auth('admin')->user()->nama }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
                <a class="dropdown-item" href="{{ route('admin.akun') }}">
                    <i class="bi bi-gear me-2"></i>
                    Akun Saya
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
</li>
@endauth
