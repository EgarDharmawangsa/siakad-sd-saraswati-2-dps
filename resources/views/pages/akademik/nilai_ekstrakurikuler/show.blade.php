@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('nilai-ekstrakurikuler.index') }}" class="btn btn-secondary"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="siswa" class="form-label">Siswa</label>
                <input type="text" class="form-control" id="siswa"
                    value="{{ $nilai_ekstrakurikuler->pesertaEkstrakurikuler->siswa->getFormatedNamaSiswa() }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="ekstrakurikuler" class="form-label">Ekstrakurikuler</label>
                <input type="text" class="form-control" id="ekstrakurikuler"
                    value="{{ $nilai_ekstrakurikuler->pesertaEkstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester"
                    value="{{ $nilai_ekstrakurikuler->semester->getTahunAjaranFormated(true) }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai" class="form-label">Nilai</label>
                <input type="text" class="form-control" id="nilai" value="{{ $nilai_ekstrakurikuler->nilai }}"
                    readonly>
            </div>
        </div>
    </div>
@endsection
