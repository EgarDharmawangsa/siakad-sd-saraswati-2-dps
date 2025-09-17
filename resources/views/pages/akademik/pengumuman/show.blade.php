@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="mb-4">
            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary btn-sm me-1"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('pengumuman.edit', $pengumuman->id_pengumuman) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil me-2"></i>Edit</a>
        </div>
        <h2 class="mb-2">{{ $pengumuman->judul }}</h2>
        <small class="text-muted mb-3 d-block">Diterbitkan pada {{ $pengumuman->tanggal->translatedFormat('l, d-m-Y') }}</small>

        @if ($pengumuman->gambar)
            <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}"class="gambar my-5 rounded">
        @endif

        <p>{!! nl2br(e($pengumuman->isi)) !!}</p>
    </div>
@endsection