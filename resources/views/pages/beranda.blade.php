@extends('layouts.main')

@section('container')
    <div class="row g-3 mb-4">
        <div class="col-sm-3">
            <div class="content-card">Pegawai</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Siswa</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Mata Pelajaran</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Kelas</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Semester</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Mata Pelajaran</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Ekstrakurikuler</div>
        </div>
        <div class="col-sm-3">
            <div class="content-card">Prestasi</div>
        </div>
    </div>

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
@endsection
