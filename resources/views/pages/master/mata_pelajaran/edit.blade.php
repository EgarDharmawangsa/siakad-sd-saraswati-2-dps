@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Edit {{ $judul }}</h5>
        <hr>

        <form action="{{ route('mata-pelajaran.update', $mata_pelajaran->id_mata_pelajaran) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mata-pelajaran-input-group">
                <label for="nama-mata-pelajaran" class="form-label">Nama Mata Pelajaran</label>
                <input type="text" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror"
                    id="nama-mata-pelajaran" name="nama_mata_pelajaran" placeholder="Masukkan nama mata pelajaran"
                    value="{{ old('nama_mata_pelajaran', $mata_pelajaran->nama_mata_pelajaran) }}" required>
                @error('nama_mata_pelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('mata-pelajaran.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
