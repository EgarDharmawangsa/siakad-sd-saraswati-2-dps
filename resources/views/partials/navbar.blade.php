<nav class="navbar navbar-expand-lg navbar-dark position-fixed top-0 w-100 z-1">
    <div class="container-fluid px-3">
        <button class="btn d-lg-none sidebar-toggle-button me-2" id="toggle-sidebar"><i class="bi bi-list fs-2"></i></button>
        <a class="navbar-brand" href="{{ route('beranda') }}">SIAKAD RASDA</a>

        <div class="dropdown profile-dropdown ms-auto">
            <div class="profile-divider"></div>
            <a class="profile-toggle dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('profil/IMG_4251.jpg') }}" alt="Profile" class="profile-avatar me-1">
                <span class="profile-name">{{ Str::limit('I Komang Egar Suarama Dharmawangsa', 20, '...') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><hr class="profile-dropdown-divider"></li>
                <li>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="dropdown-item profile-logout-button">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>