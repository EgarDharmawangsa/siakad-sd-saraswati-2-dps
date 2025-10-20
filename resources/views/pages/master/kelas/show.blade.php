@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-button-group">
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('kelas.edit', $kelas->id_kelas) }}"
                class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
            <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')

                <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                    data-bs-target="#delete-modal">
                    <i class="bi bi-trash me-2"></i>Hapus</button>
            </form>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama-kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama-kelas"
                    value="{{ $kelas->nama_kelas }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="wali-kelas" class="form-label">Wali Kelas</label>
                <input type="text" class="form-control" id="wali-kelas"
                    value="{{ $kelas->pegawai->getPegawai() }}" readonly>
            </div>
        </div>
    </div>
@endsection
