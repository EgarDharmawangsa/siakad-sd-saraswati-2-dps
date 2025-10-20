@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-button-group">
            <a href="{{ route('jadwal-pelajaran.index') }}" class="btn btn-secondary btn-sm"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('jadwal-pelajaran.edit', $jadwal_pelajaran->id_jadwal_pelajaran) }}"
                class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
            <form action="{{ route('jadwal-pelajaran.destroy', $jadwal_pelajaran->id_jadwal_pelajaran) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')

                <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                    data-bs-target="#delete-modal">
                    <i class="bi bi-trash me-2"></i>Hapus</button>
            </form>
        </div>

        <div class="row g-3">
            <div class="col-md-12">
                <label for="id-kelas" class="form-label d-block">Kegiatan</label>
                <div class="btn-group" id="kegiatan">
                    <input type="radio" class="btn-check" id="kegiatan-belajar-radio" {{ $jadwal_pelajaran->kegiatan === 'Belajar' ? 'checked' : '' }} disabled>
                    <label class="btn btn-outline-primary" for="kegiatan-belajar-radio">Belajar</label>

                    <input type="radio" class="btn-check" id="kegiatan-istirahat-radio" {{ $jadwal_pelajaran->kegiatan === 'Istirahat' ? 'checked' : '' }} disabled>
                    <label class="btn btn-outline-primary" for="kegiatan-istirahat-radio">Istirahat</label>
                </div>
            </div>

            <div class="col-md-6">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" value="{{ $jadwal_pelajaran->kelas->nama_kelas }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control" id="mata-pelajaran"
                    value="{{ $jadwal_pelajaran->guruMataPelajaran?->mataPelajaran->nama_mata_pelajaran ?? '-' }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="id_guru" class="form-label">Guru</label>
                <input type="text" class="form-control" id="id_guru"
                    value="{{ $jadwal_pelajaran->guruMataPelajaran?->pegawai->getPegawai() ?? '-' }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="hari" class="form-label">Hari</label>
                <input type="text" class="form-control" id="hari" value="{{ $jadwal_pelajaran->hari }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="jam-mulai" class="form-label">Jam Mulai</label>
                <input type="text" class="form-control" id="jam-mulai" value="{{ $jadwal_pelajaran->jam_mulai }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="jam-selesai" class="form-label">Jam Selesai</label>
                <input type="text" class="form-control" id="jam-selesai" value="{{ $jadwal_pelajaran->jam_selesai }}"
                    readonly>
            </div>
        </div>
    </div>
@endsection
