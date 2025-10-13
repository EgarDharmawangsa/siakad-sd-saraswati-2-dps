@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-button-group">
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('kelas.edit', $kelas->id_kelas) }}"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil me-2"></i>Edit</a>
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
