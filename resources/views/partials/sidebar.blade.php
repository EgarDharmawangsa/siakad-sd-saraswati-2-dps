<div id="sidebar" class="position-fixed top-0 start-0 vh-100">
  <button class="btn btn-sm d-lg-none d-block ms-auto mb-3 close-sidebar-button" id="closeSidebar">
    <i class="bi bi-x-lg fs-4"></i>
  </button>

  <ul class="nav flex-column">
    <!-- Beranda -->
    <li class="nav-item">
      <a href="{{ route('beranda') }}"
        class="nav-link {{ request()->routeIs('beranda') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-house-door me-2"></i>Beranda
      </a>
    </li>

    <!-- Pegawai -->
    <li class="nav-item">
      <a href="{{ route('pegawai.index') }}"
        class="nav-link {{ request()->routeIs('pegawai.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-person-badge me-2"></i>Pegawai
      </a>
    </li>

    <!-- Siswa -->
    <li class="nav-item">
      <a href="{{ route('siswa.index') }}"
        class="nav-link {{ request()->routeIs('siswa.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-people me-2"></i>Siswa
      </a>
    </li>

    <!-- Kelas -->
    <li class="nav-item">
      <a href="{{ route('kelas.index') }}"
        class="nav-link {{ request()->routeIs('kelas.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-door-open me-2"></i>Kelas
      </a>
    </li>

    <!-- Semester -->
    <li class="nav-item">
      <a href="{{ route('semester.index') }}"
        class="nav-link {{ request()->routeIs('semester.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-calendar-range me-2"></i>Semester
      </a>
    </li>

    <!-- Mata Pelajaran -->
    <li class="nav-item">
      <a href="{{ route('mata-pelajaran.index') }}"
        class="nav-link {{ request()->routeIs('mata-pelajaran.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-book me-2"></i>Mata Pelajaran
      </a>
    </li>

    <!-- Jadwal Pelajaran -->
    <li class="nav-item">
      <a href="{{ route('jadwal-pelajaran.index') }}"
        class="nav-link {{ request()->routeIs('jadwal-pelajaran.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-calendar3 me-2"></i>Jadwal Pelajaran
      </a>
    </li>

    <!-- Ekstrakurikuler -->
    <li class="nav-item">
      <a href="{{ route('ekstrakurikuler.index') }}"
        class="nav-link {{ request()->routeIs('ekstrakurikuler.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-person-up me-2"></i>Ekstrakurikuler
      </a>
    </li>

    <!-- Menu Nilai (dropdown) -->
    <li class="nav-item">
      <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#nilaiMenu"
        role="button"
        aria-expanded="{{ request()->routeIs('nilai-mata-pelajaran.') || request()->routeIs('nilai-ekstrakurikuler.') ? 'true' : 'false' }}"
        aria-controls="nilaiMenu">
        <span><i class="bi bi-clipboard-data me-2"></i>Nilai</span>
        <i class="bi bi-triangle-fill nilai-menu-icon"></i>
      </a>

      <div
        class="collapse {{ request()->routeIs('nilai-mata-pelajaran.') || request()->routeIs('nilai-ekstrakurikuler.') ? 'show' : '' }}"
        id="nilaiMenu">
        <ul class="nav flex-column ms-3">
          <li class="nav-item">
            <a href="{{ route('nilai-mata-pelajaran.index') }}"
              class="nav-link {{ request()->routeIs('nilai-mata-pelajaran.*') ? 'active-sidebar-link' : '' }}">
              <i class="bi bi-clipboard-data me-2"></i>Mata Pelajaran
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('nilai-ekstrakurikuler.index') }}"
              class="nav-link {{ request()->routeIs('nilai-ekstrakurikuler.*') ? 'active-sidebar-link' : '' }}">
              <i class="bi bi-clipboard-data me-2"></i>Ekstrakurikuler
            </a>
          </li>
        </ul>
      </div>
    </li>

    <!-- Kehadiran -->
    <li class="nav-item">
      <a href="{{ route('kehadiran.index') }}"
        class="nav-link {{ request()->routeIs('kehadiran.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-check2-square me-2"></i>Kehadiran
      </a>
    </li>

    <!-- Prestasi -->
    <li class="nav-item">
      <a href="{{ route('prestasi.index') }}"
        class="nav-link {{ request()->routeIs('prestasi.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-award me-2"></i>Prestasi
      </a>
    </li>

    <!-- Pengumuman -->
    <li class="nav-item">
      <a href="{{ route('pengumuman.index') }}"
        class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active-sidebar-link' : '' }}">
        <i class="bi bi-megaphone me-2"></i>Pengumuman
      </a>
    </li>
  </ul>
</div>