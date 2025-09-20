@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('mata-pelajaran.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama-mata-pelajaran" class="form-label">Nama Mata Pelajaran</label>
                <input type="text" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror"
                    id="nama-mata-pelajaran" name="nama_mata_pelajaran" placeholder="Ketikkan nama mata pelajaran"
                    value="{{ old('nama_mata_pelajaran') }}" required>
                @error('nama_mata_pelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-danger me-1"><i
                        class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah</button>
            </div>
        </form>
    </div>
@endsection