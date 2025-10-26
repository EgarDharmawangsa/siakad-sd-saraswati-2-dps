@extends('layouts.main')

@section('container')
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 pegawai-panel">
                <div class="p-3">
                    <i class="bi bi-person-badge icon-panel"></i>
                    <h3>{{ $counted_pegawai }}</h3>
                    <p class="m-0">Pegawai</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white pegawai-panel-link"
                    href="{{ route('pegawai.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 siswa-panel">
                <div class="p-3">
                    <i class="bi bi-people-fill icon-panel"></i>
                    <h3>{{ $counted_siswa }}</h3>
                    <p class="m-0">Siswa</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white siswa-panel-link"
                    href="{{ route('siswa.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 kelas-panel">
                <div class="p-3">
                    <i class="bi bi-door-open icon-panel"></i>
                    <h3>{{ $counted_kelas }}</h3>
                    <p class="m-0">Kelas</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white kelas-panel-link"
                    href="{{ route('kelas.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 semester-panel">
                <div class="p-3">
                    <i class="bi bi-calendar-range icon-panel"></i>
                    <h3>{{ $counted_semester }}</h3>
                    <p class="m-0">Semester</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white semester-panel-link"
                    href="{{ route('semester.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 mata-pelajaran-panel">
                <div class="p-3">
                    <i class="bi bi-book icon-panel"></i>
                    <h3>{{ $counted_mata_pelajaran }}</h3>
                    <p class="m-0">Mata Pelajaran</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white mata-pelajaran-panel-link"
                    href="{{ route('mata-pelajaran.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 ekstrakurikuler-panel">
                <div class="p-3">
                    <i class="bi bi-person-up icon-panel"></i>
                    <h3>{{ $counted_ekstrakurikuler }}</h3>
                    <p class="m-0">Ekstrakurikuler</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white ekstrakurikuler-panel-link"
                    href="{{ route('mata-pelajaran.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 prestasi-panel">
                <div class="p-3">
                    <i class="bi bi-award icon-panel"></i>
                    <h3>{{ $counted_prestasi }}</h3>
                    <p class="m-0">Prestasi</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white prestasi-panel-link"
                    href="{{ route('prestasi.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 pengumuman-panel">
                <div class="p-3">
                    <i class="bi bi-megaphone icon-panel"></i>
                    <h3>{{ $counted_pengumuman }}</h3>
                    <p class="m-0">Pengumuman</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white pengumuman-panel-link"
                    href="{{ route('pengumuman.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="content-card">
                <h5>Pengumuman</h5>
                <hr>

                @forelse ($pengumuman as $_pengumuman)
                    @if ($_pengumuman->getStatus() === 'Terbit')
                        <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}"
                            class="pengumuman-item text-decoration-none text-dark d-block p-3 rounded">
                            <h5 class="mb-2">{{ $_pengumuman->judul }}</h5>
                            <small class="text-muted mb-3 d-block">
                                Diterbitkan pada {{ $_pengumuman->tanggal->translatedFormat('l, d F Y') }}
                            </small>
                            <p class="mb-0">{{ Str::limit(strip_tags($_pengumuman->isi), 150, '...') }}</p>
                        </a>
                        <hr class="mt-0 pengumuman-divider">
                    @endif
                @empty
                    <p class="text-center">Belum ada Pengumuman.</p>
                @endforelse
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-card">
                <h5>Apa ya???</h5>
                <hr>
            </div>
        </div>
    </div>
@endsection
