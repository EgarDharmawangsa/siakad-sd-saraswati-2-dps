@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Tambah / Sinkronkan {{ $judul }}</h5>
        <hr>

        <form action="{{ route('kehadiran.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id-kelas" class="form-label">Kelas</label>
                    <select class="form-select" id="id-kelas" name="id_kelas" {{ $kelas->isEmpty() ? 'disabled' : '' }}
                        required>
                        <option value="">
                            {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}
                        </option>
                        @foreach ($kelas as $_kelas)
                            <option value="{{ $_kelas->id_kelas }}"
                                {{ old('id_kelas') === $_kelas->id_kelas ? 'selected' : '' }}>
                                {{ $_kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="id-semester" class="form-label">Semester</label>
                    <select class="form-select" id="id-semester" name="id_semester"
                        {{ $semester->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">
                            {{ $semester->isNotEmpty() ? '-- Pilih Semester --' : '-- Semester Tidak Tersedia --' }}
                        </option>
                        @foreach ($semester as $_semester)
                            <option value="{{ $_semester->id_semester }}"
                                {{ request('id_semester') === $_semester->id_semester ? 'selected' : '' }}>
                                {{ "{$_semester->getTahunAjaran(true)} ({$_semester->getStatus()})" }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                        name="tanggal" placeholder="Masukkan tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('kehadiran.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah<span
                        class="mx-2">/</span><i class="bi bi-arrow-repeat me-2"></i>Sinkronisasi</button>
            </div>
        </form>
    </div>
@endsection
