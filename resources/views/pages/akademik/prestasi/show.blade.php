@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('prestasi.index') }}" class="btn btn-secondary"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            @can('staf-tata-usaha')
                <a href="{{ route('prestasi.edit', $prestasi->id_prestasi) }}" class="btn btn-warning"><i
                        class="bi bi-pencil me-2"></i>Edit</a>
                <form action="{{ route('prestasi.destroy', $prestasi->id_prestasi) }}" method="POST"
                    class="d-inline delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal"
                        data-bs-target="#delete-modal">
                        <i class="bi bi-trash me-2"></i>Hapus</button>
                </form>
            @endcan
        </div>

        <h4 class="mb-2 mt-3">{{ $prestasi->nama_prestasi }}</h4>

        <small class="text-muted mb-3">Diraih pada {{ $prestasi->getFormatedTanggalPeraihan() }}</small>

        @if ($prestasi->dokumentasi)
            <img src="{{ Storage::url($prestasi->dokumentasi) }}" alt="Dokumentasi Prestasi"
                class="image-content mt-4 mb-2 rounded">
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <div class="fw-bold">Penyelenggara:</div>
                <div>{{ $prestasi->penyelenggara }}</div>
            </div>
            <div class="col-md-6">
                <div class="fw-bold">Peraih:</div>
                <div>{{ $prestasi->siswa->getFormatedNamaSiswa() }}</div>
            </div>
            <div class="col-md-6">
                <div class="fw-bold">Jenis:</div>
                <div>{{ $prestasi->jenis }}</div>
            </div>
            <div class="col-md-6">
                <div class="fw-bold">Peringkat:</div>
                <div>{{ $prestasi->peringkat !== "Lainnya" ? $prestasi->peringkat : $prestasi->peringkat_lainnya }}</div>
            </div>
            <div class="col-md-6">
                <div class="fw-bold">Tingkat:</div>
                <div>{{ $prestasi->tingkat }}</div>
            </div>
            <div class="col-md-6">
                <div class="fw-bold">Wilayah:</div>
                <div>{{ $prestasi->wilayah }}</div>
            </div>
        </div>
    </div>
@endsection
