@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Tambah / Sinkronkan {{ $judul }}</h5>
        <hr>

        <form action="{{ route('nilai-ekstrakurikuler.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id-ekstrakurikuler" class="form-label">Ekstrakurikuler</label>
                    <select class="form-select @error('id_ekstrakurikuler') is-invalid @enderror" id="id-ekstrakurikuler" name="id_ekstrakurikuler"
                        {{ $ekstrakurikuler->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">
                            {{ $ekstrakurikuler->isNotEmpty() ? '-- Pilih Ekstrakurikuler --' : '-- Ekstrakurikuler Tidak Tersedia --' }}
                        </option>
                        @foreach ($ekstrakurikuler as $_ekstrakurikuler)
                            <option value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}"
                                {{ old('id_ekstrakurikuler') == $_ekstrakurikuler->id_ekstrakurikuler ? 'selected' : '' }}>
                                {{ $_ekstrakurikuler->nama_ekstrakurikuler }}</option>
                        @endforeach
                    </select>
                    @error('id_ekstrakurikuler')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="id-semester" class="form-label">Semester</label>
                    <select class="form-select @error('id_semester') is-invalid @enderror" id="id-semester" name="id_semester"
                        {{ $semester->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">
                            {{ $semester->isNotEmpty() ? '-- Pilih Semester --' : '-- Semester Tidak Tersedia --' }}
                        </option>
                        @foreach ($semester as $_semester)
                            <option value="{{ $_semester->id_semester }}"
                                {{ old('id_semester') == $_semester->id_semester ? 'selected' : '' }}>
                                {{ "{$_semester->getTahunAjaran(true)} ({$_semester->getStatus()})" }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('nilai-ekstrakurikuler.index') }}" data-bs-toggle="modal"
                    data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah<span class="mx-2">/</span><i class="bi bi-arrow-repeat me-2"></i>Sinkronkan</button>
            </div>
        </form>
    </div>
@endsection
