@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="siswa" class="form-label">Siswa</label>
                <input type="text" class="form-control" id="siswa"
                    value="{{ $nilai_ekstrakurikuler->siswa->getFormatedNamaSiswa() }}" readonly>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama-ekstrakurikuler" class="form-label">Nama Ekstrakurikuler</label>
                <input type="text" class="form-control" id="nama-ekstrakurikuler"
                    value="{{ $nilai_ekstrakurikuler->nama_ekstrakurikuler }}" readonly>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester"
                    value="{{ $nilai_ekstrakurikuler->semester->getTahunAjaranFormated(true) }}" readonly>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nilai" class="form-label">Nilai</label>
                <input type="text" class="form-control" id="nilai"
                    value="{{ $nilai_ekstrakurikuler->nilai }}" readonly>
            </div>
        </div>
    </div>
@endsection
