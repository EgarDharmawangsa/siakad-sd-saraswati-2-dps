@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('nilai-mata-pelajaran.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="siswa" class="form-label">Siswa</label>
                <input type="text" class="form-control" id="siswa"
                    value="{{ $nilai_mata_pelajaran->siswa->getFormatedNamaSiswa() }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control" id="mata-pelajaran"
                    value="{{ $nilai_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester"
                    value="{{ $nilai_mata_pelajaran->semester->getTahunAjaranFormated(true) }}" readonly>
            </div>

            @foreach ($nilai_mata_pelajaran->nilai_portofolio as $judul => $nilai)
                <div class="col-md-6">
                    <label for="nilai-portofolio" class="form-label">{{ $judul }}</label>
                    <input type="text" class="form-control" id="nilai-portofolio"
                        value="{{ $nilai }}" readonly>
                </div>
            @endforeach

            <div class="col-md-6">
                <label for="nilai-ub-1" class="form-label">Nilai UB 1</label>
                <input type="text" class="form-control" id="nilai-ub-1" value="{{ $nilai_mata_pelajaran->nilai_ub_1 }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-ub-2" class="form-label">Nilai UB 2</label>
                <input type="text" class="form-control" id="nilai-ub-2" value="{{ $nilai_mata_pelajaran->nilai_ub_2 }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-uts" class="form-label">Nilai UTS</label>
                <input type="text" class="form-control" id="nilai-uts" value="{{ $nilai_mata_pelajaran->nilai_uts }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-uas" class="form-label">Nilai UAS</label>
                <input type="text" class="form-control" id="nilai-uas" value="{{ $nilai_mata_pelajaran->nilai_uas }}"
                    readonly>
            </div>
        </div>
    </div>
@endsection
