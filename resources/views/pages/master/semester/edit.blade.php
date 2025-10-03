@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Edit {{ $judul }}</h5>
        <hr>

        <form action="{{ route('semester.update', $semester->id_semester) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="jenis-semester" class="form-label">Jenis Semester</label>
                    <select class="form-select @error('jenis_semester') is-invalid @enderror" id="jenis-semester" name="jenis_semester" required>
                        <option value="default">-- Pilih Jenis Semester --</option>
                        <option value="Ganjil" {{ old('jenis_semester', $semester->jenis_semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil
                        </option>
                        <option value="Genap" {{ old('jenis_semester', $semester->jenis_semester) == 'Genap' ? 'selected' : '' }}>Genap
                        </option>
                    </select>
                    @error('jenis_semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="tanggal-mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal-mulai"
                        name="tanggal_mulai" value="{{ old('tanggal_mulai', $semester->tanggal_mulai->format('Y-m-d')) }}" required>
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="tanggal-selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal-selesai"
                        name="tanggal_selesai" value="{{ old('tanggal_selesai', $semester->tanggal_selesai->format('Y-m-d')) }}" required>
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end input-button-group">
                <button type="button" class="btn btn-danger me-1" id="cancel-button"
                    data-route="{{ route('semester.index') }}" data-bs-toggle="modal"
                    data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
