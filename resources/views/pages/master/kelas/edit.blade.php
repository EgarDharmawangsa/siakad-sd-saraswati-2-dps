@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama-kelas" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                        id="nama-kelas" name="nama_kelas" placeholder="Masukkan nama kelas"
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="text-muted d-block mini-label mt-1">Contoh: 1A</span>
                </div>

                <div class="col-md-6">
                    <label for="wali" class="form-label">Wali</label>
                    <select class="form-select @error('id_pegawai') is-invalid @enderror" id="wali" name="id_pegawai" {{ $guru->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">{{ $guru->isNotEmpty() ? '-- Pilih Guru --' : '-- Guru Tidak Tersedia --' }}</option>
                        @foreach ($guru as $_guru)
                            <option value="{{ $_guru->id_pegawai }}" {{ old('id_pegawai', $kelas->id_pegawai) == $_guru->id_pegawai ? 'selected' : '' }}>{{ $_guru->getPegawai() }}</option>
                        @endforeach
                    </select>
                    @error('id_pegawai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end input-button-group">
                <button type="button" class="btn btn-danger me-1" id="cancel-button"
                    data-route="{{ route('kelas.index') }}" data-bs-toggle="modal"
                    data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
