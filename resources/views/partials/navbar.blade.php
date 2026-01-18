@auth
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed top-0 w-100">
        <div class="container-fluid">
            <button class="btn d-lg-none sidebar-toggle-button me-2" id="toggle-sidebar"><i
                    class="bi bi-list fs-2"></i></button>

            <a class="navbar-brand d-flex align-items-center" href="{{ route('beranda') }}">
                <img src="{{ asset('images/saraswati_logo.png') }}" alt="SD Saraswati 2 Denpasar" class="navbar-logo me-2">
                <div class="navbar-title-container">
                    <small class="navbar-small-title">SISTEM INFORMASI AKADEMIK</small>
                    <small class="navbar-title">SD SARASWATI 2 DENPASAR</small>
                </div>
            </a>

            <div class="dropdown profile-dropdown ms-auto">
                <div class="profile-divider"></div>
                <a class="profile-toggle dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ auth()->user()->pegawai?->foto
                        ? asset('storage/' . auth()->user()->pegawai->foto)
                        : (auth()->user()->siswa?->foto
                            ? asset('storage/' . auth()->user()->siswa->foto)
                            : asset('images/default_profile_photo.png')) }}"
                        alt="Profile" class="profile-avatar me-1">
                    <span
                        class="profile-name">{{ Str::limit(Auth::user()->pegawai?->nama_pegawai ?? Auth::user()->siswa?->nama_siswa, 20, '...') }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">Profil</a>
                    </li>

                    <li>
                        <hr class="profile-dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('log-out') }}" method="POST" id="log-out-form">
                            @csrf
                            <button type="button" class="dropdown-item" id="log-out-button" data-bs-toggle="modal"
                                data-bs-target="#log-out-modal"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endauth
