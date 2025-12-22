@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Edit {{ $judul }}</h5>
        <hr>

        <form action="{{ route('nilai-mata-pelajaran.edit', $nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
            method="POST">
            @csrf
            <div class="row g-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="siswa" class="form-label">Siswa</label>
                        <input type="text" class="form-control" id="siswa"
                            value="{{ $nilai_ekstrakurikuler->pesertaEkstrakurikuler->siswa->getFormatedNamaSiswa() }}"
                            disabled>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="ekstrakurikuler" class="form-label">Ekstrakurikuler</label>
                        <input type="text" class="form-control" id="ekstrakurikuler"
                            value="{{ $nilai_ekstrakurikuler->pesertaEkstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}"
                            disabled>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester"
                            value="{{ $nilai_ekstrakurikuler->semester->getTahunAjaranFormated(true) }}" disabled>
                    </div>
                </div>

                {{-- Nanti disini untuk logika nilai portofolio --}}

                <div class="col-md-6">
                    <label for="nilai-ub" class="form-label">Nilai UB</label>
                    <input type="text" class="form-control @error('nilai_ub') is-invalid @enderror" id="nilai-ub"
                        name="nilai_ub" placeholder="Masukkan nilai UB"
                        value="{{ old('nilai_ub', $nilai_mata_pelajaran->nilai_ub) }}" required>
                    @error('nilai_ub')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nilai-uts" class="form-label">Nilai UTS</label>
                    <input type="text" class="form-control @error('nilai_uts') is-invalid @enderror" id="nilai-uts"
                        name="nilai_uts" placeholder="Masukkan nilai UTS"
                        value="{{ old('nilai_uts', $nilai_mata_pelajaran->nilai_uts) }}" required>
                    @error('nilai_uts')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nilai-uas" class="form-label">Nilai UAS</label>
                    <input type="text" class="form-control @error('nilai_uas') is-invalid @enderror" id="nilai-uas"
                        name="nilai_uas" placeholder="Masukkan nilai UAS"
                        value="{{ old('nilai_uas', $nilai_mata_pelajaran->nilai_uas) }}" required>
                    @error('nilai_uas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('ekstrakurikuler.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
