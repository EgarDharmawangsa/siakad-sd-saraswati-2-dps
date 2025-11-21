@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('semester.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="jenis" class="form-label">Jenis Semester</label>
                    <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Ganjil" {{ old('jenis') === 'Ganjil' ? 'selected' : '' }}>Ganjil
                        </option>
                        <option value="Genap" {{ old('jenis') === 'Genap' ? 'selected' : '' }}>Genap
                        </option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="tanggal-mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal-mulai"
                        name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="tanggal-selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal-selesai"
                        name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('semester.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-plus-lg me-2"></i>Tambah</button>
            </div>
        </form>
    </div>
@endsection
