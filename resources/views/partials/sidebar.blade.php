<div id="sidebar" class="position-fixed top-0 start-0 vh-100">
  <button class="btn btn-sm d-lg-none d-block ms-auto mb-3 close-sidebar-button" id="closeSidebar"><i class="bi bi-x-lg fs-4"></i></button>

  <ul class="nav flex-column">
    <li class="nav-item"><a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active-sidebar-link' : '' }}">Beranda</a></li>
    <li class="nav-item"><a href="{{ route('pegawai.index') }}" class="nav-link {{ request()->routeIs('pegawai.*') ? 'active-sidebar-link' : '' }}">Pegawai</a></li>
    <li class="nav-item"><a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.*') ? 'active-sidebar-link' : ''  }}">Siswa</a></li>
    <li class="nav-item"><a href="{{ route('kelas.index') }}" class="nav-link {{ request()->routeIs('kelas.*') ? 'active-sidebar-link' : '' }}">Kelas</a></li>
    <li class="nav-item"><a href="{{ route('semester.index') }}" class="nav-link {{ request()->routeIs('semester.*') ? 'active-sidebar-link' : '' }}">Semester</a></li>
    <li class="nav-item"><a href="{{ route('mata-pelajaran.index') }}" class="nav-link {{ request()->routeIs('mata-pelajaran.*') ? 'active-sidebar-link' : '' }}">Mata Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('jadwal-pelajaran.index') }}" class="nav-link {{ request()->routeIs('jadwal-pelajaran.*') ? 'active-sidebar-link' : '' }}">Jadwal Pelajaran</a></li>
    <li class="nav-item"><a href="{{ route('ekstrakurikuler.index') }}" class="nav-link {{ request()->routeIs('ekstrakurikuler.*') ? 'active-sidebar-link' : '' }}">Ekstrakurikuler</a></li>

    <li class="nav-item">
      <a class="nav-link d-flex justify-content-between align-items-center" 
         data-bs-toggle="collapse" href="#nilaiMenu" role="button" aria-expanded="{{ request()->routeIs('nilai-mata-pelajaran.*') || request()->routeIs('nilai-ekstrakurikuler.*') ? 'true' : 'false' }}" aria-controls="nilaiMenu">
        Nilai
        <i class="bi bi-triangle-fill nilai-menu-icon"></i>
      </a>
      <div class="collapse {{ request()->routeIs('nilai-mata-pelajaran.*') || request()->routeIs('nilai-ekstrakurikuler.*') ? 'show' : '' }}" id="nilaiMenu">
        <ul class="nav flex-column ms-3">
          <li class="nav-item"><a href="{{ route('nilai-mata-pelajaran.index') }}" class="nav-link {{ request()->routeIs('nilai-mata-pelajaran.*') ? 'active-sidebar-link' : '' }}">Mata Pelajaran</a></li>
          <li class="nav-item"><a href="{{ route('nilai-ekstrakurikuler.index') }}" class="nav-link {{ request()->routeIs('nilai-ekstrakurikuler.*') ? 'active-sidebar-link' : '' }}">Ekstrakurikuler</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item"><a href="{{ route('kehadiran.index') }}" class="nav-link {{ request()->routeIs('kehadiran.*') ? 'active-sidebar-link' : '' }}">Kehadiran</a></li>
    <li class="nav-item"><a href="{{ route('prestasi.index') }}" class="nav-link {{ request()->routeIs('prestasi.*') ? 'active-sidebar-link' : '' }}">Prestasi</a></li>
    <li class="nav-item"><a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active-sidebar-link' : '' }}">Pengumuman</a></li>
  </ul>
</div>
