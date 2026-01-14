@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('kehadiran.index') }}" class="btn btn-secondary"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="siswa" class="form-label">Siswa</label>
                <input type="text" class="form-control" id="siswa"
                    value="{{ $kehadiran->siswa->getFormatedNamaSiswa() }}" readonly>
            </div>

            @canany(['staf-tata-usaha', 'guru'])
                <div class="col-md-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas"
                        value="{{ $kehadiran->siswa->kelas?->nama_kelas ?? '-' }}" readonly>
                </div>
            @endcanany

            <div class="col-md-6">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester"
                    value="{{ $kehadiran->semester->getTahunAjaranFormated(true) }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" value="{{ $kehadiran->status }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" value="{{ $kehadiran->keterangan }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="tanggal"
                    value="{{ $kehadiran->getFormatedTanggal() }}" readonly>
            </div>
        </div>
    </div>
@endsection
