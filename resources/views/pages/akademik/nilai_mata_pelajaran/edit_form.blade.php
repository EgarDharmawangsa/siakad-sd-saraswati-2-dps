@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Hapus {{ $judul }}</h5>
        <hr>

        <form action="{{ route('nilai-mata-pelajaran.update-form') }}" method="POST">
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
                                {{ old('id_kelas') == $_kelas->id_kelas ? 'selected' : '' }}>
                                {{ $_kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mt-0">
                    <hr class="text-muted opacity-25">
                </div>
                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Data Sebelumnya</label></div>

                <div class="col-md-6">
                    <label for="id-semester" class="form-label">Semester</label>
                    <select class="form-select @error('id_semester') is-invalid @enderror" id="id-semester"
                        name="id_semester" {{ $semester->isEmpty() ? 'disabled' : '' }} required>
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

                <div class="col-md-6">
                    <label for="id-mata-pelajaran" class="form-label">Mata Pelajaran</label>
                    <select class="form-select" id="id-mata-pelajaran" name="id_mata_pelajaran"
                        {{ $mata_pelajaran->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">
                            {{ $mata_pelajaran->isNotEmpty() ? '-- Pilih Mata Pelajaran --' : '-- Mata Pelajaran Tidak Tersedia --' }}
                        </option>
                        @foreach ($mata_pelajaran as $_mata_pelajaran)
                            <option value="{{ $_mata_pelajaran->id_mata_pelajaran }}"
                                {{ old('id_mata_pelajaran') == $_mata_pelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                                {{ $_mata_pelajaran->nama_mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_mata_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Data Baru</label></div>

                <div class="col-md-6">
                    <label for="id-semester-new" class="form-label">Semester</label>
                    <select class="form-select @error('id_semester') is-invalid @enderror" id="id-semester-new"
                        name="id_semester_new" {{ $semester->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">
                            {{ $semester->isNotEmpty() ? '-- Pilih Semester --' : '-- Semester Tidak Tersedia --' }}
                        </option>
                        @foreach ($semester as $_semester)
                            <option value="{{ $_semester->id_semester }}"
                                {{ old('id_semester_new') == $_semester->id_semester ? 'selected' : '' }}>
                                {{ "{$_semester->getTahunAjaran(true)} ({$_semester->getStatus()})" }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_semester_new')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="id-mata-pelajaran-new" class="form-label">Mata Pelajaran</label>
                    <select class="form-select" id="id-mata-pelajaran-new" name="id_mata_pelajaran_new"
                        {{ $mata_pelajaran->isEmpty() ? 'disabled' : '' }} required>
                        <option value="">
                            {{ $mata_pelajaran->isNotEmpty() ? '-- Pilih Mata Pelajaran --' : '-- Mata Pelajaran Tidak Tersedia --' }}
                        </option>
                        @foreach ($mata_pelajaran as $_mata_pelajaran)
                            <option value="{{ $_mata_pelajaran->id_mata_pelajaran }}"
                                {{ old('id_mata_pelajaran_new') == $_mata_pelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                                {{ $_mata_pelajaran->nama_mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_mata_pelajaran_new')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('nilai-mata-pelajaran.index') }}" data-bs-toggle="modal"
                    data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
