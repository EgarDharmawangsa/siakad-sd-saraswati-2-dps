@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-button-group">
            <a href="{{ route('semester.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('semester.edit', $semester->id_semester) }}" class="btn btn-warning btn-sm"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="jenis-semester" class="form-label">Jenis Semester</label>
                <input type="text" class="form-control" id="jenis-semester" value="{{ $semester->jenis_semester }}"
                    disabled>
            </div>
            <div class="col-md-6">
                <label for="tahun-ajaran" class="form-label">Tahun Ajaran</label>
                <input type="text" class="form-control" id="tahun-ajaran" value="{{ $semester->getTahunAjaran() }}"
                    disabled>
            </div>
            <div class="col-md-6">
                <label for="tanggal-mulai" class="form-label">Tanggal Mulai</label>
                <input type="text" class="form-control" id="tanggal-mulai"
                    value="{{ $semester->tanggal_mulai->format('d-m-Y') }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="tanggal-selesai" class="form-label">Tanggal Selesai</label>
                <input type="text" class="form-control" id="tanggal-selesai"
                    value="{{ $semester->tanggal_selesai->format('d-m-Y') }}" disabled>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <div class="d-flex align-items-center">
                    <span
                        class="badge bg-{{ $semester->getStatus() == 'Berjalan' ? 'success' : ($semester->getStatus() == 'Menunggu' ? 'primary' : 'secondary') }}">
                        {{ $semester->getStatus() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
