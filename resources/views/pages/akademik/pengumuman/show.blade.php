@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('nilai-mata-pelajaran.index') }}" class="btn btn-secondary btn-sm me-1"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            @endcan

            @canany(['guru', 'siswa'])
                <a href="{{ route('beranda') }}" class="btn btn-secondary btn-sm me-1"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            @endcan
            
            @can('staf-tata-usaha')
                <a href="{{ route('pengumuman.edit', $pengumuman->id_pengumuman) }}" class="btn btn-warning btn-sm me-1"><i
                        class="bi bi-pencil me-2"></i>Edit</a>
                <form action="{{ route('pengumuman.destroy', $pengumuman->id_pengumuman) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                        data-bs-target="#delete-modal">
                        <i class="bi bi-trash me-2"></i>Hapus</button>
                </form>
            @endcan
        </div>

        <h4 class="mb-2 mt-3">{{ $pengumuman->judul }}</h4>

        <div class="d-flex align-items-center mb-3">
            <small class="text-muted me-2 d-block">Diterbitkan pada {{ $pengumuman->getFormatedTanggal(true) }}</small>
            @can('staf-tata-usaha')
                <span
                    class="badge bg-{{ $pengumuman->getStatus() === 'Terbit' ? 'success' : 'primary' }}">
                    {{ $pengumuman->getStatus() }}
                </span>
            @endcan
        </div>

        @if ($pengumuman->gambar)
            <img src="{{ asset("storage/{$pengumuman->gambar}") }}" alt="Gambar Pengumuman"
                class="image-content my-4 rounded">
        @endif

        <p>{!! $pengumuman->isi !!}</p>
    </div>
@endsection

