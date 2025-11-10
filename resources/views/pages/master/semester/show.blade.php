@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('semester.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('semester.edit', $semester->id_semester) }}" class="btn btn-warning btn-sm me-1"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
            <form action="{{ route('semester.destroy', $semester->id_semester) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')

                <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                    data-bs-target="#delete-modal">
                    <i class="bi bi-trash me-2"></i>Hapus</button>
            </form>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="jenis" class="form-label">Jenis Semester</label>
                <input type="text" class="form-control" id="jenis" value="{{ $semester->jenis }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="tahun-ajaran" class="form-label">Tahun Ajaran</label>
                <input type="text" class="form-control" id="tahun-ajaran" value="{{ $semester->getTahunAjaran() }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="tanggal-mulai" class="form-label">Tanggal Mulai</label>
                <input type="text" class="form-control" id="tanggal-mulai"
                    value="{{ $semester->getFormatedTanggal('tanggal_mulai') }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="tanggal-selesai" class="form-label">Tanggal Selesai</label>
                <input type="text" class="form-control" id="tanggal-selesai"
                    value="{{ $semester->getFormatedTanggal('tanggal_selesai') }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <div class="d-flex align-items-center">
                    <span
                        class="badge bg-{{ $semester->getStatus() === 'Berjalan' ? 'success' : ($semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }}">
                        {{ $semester->getStatus() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
