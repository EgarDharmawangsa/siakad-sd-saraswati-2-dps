@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-button-group">
            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('ekstrakurikuler.edit', $ekstrakurikuler->id_ekstrakurikuler) }}"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil me-2"></i>Edit</a>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama-ekstrakurikuler" class="form-label">Nama Ekstrakurikuler</label>
                <input type="text" class="form-control" id="nama-ekstrakurikuler"
                    value="{{ $ekstrakurikuler->nama_ekstrakurikuler }}" disabled>
            </div>

            <div class="col-md-6">
                <label for="nama-pembina" class="form-label">Nama Pembina</label>
                <input type="text" class="form-control" id="nama-pembina" value="{{ $ekstrakurikuler->nama_pembina }}"
                    disabled>
            </div>

            <div class="col-md-6">
                <label for="alamat-pembina" class="form-label">Alamat Pembina</label>
                <input type="text" class="form-control" id="alamat-pembina"
                    value="{{ $ekstrakurikuler->alamat_pembina }}" disabled>
            </div>

            <div class="col-md-6">
                <label for="no-telepon" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="no-telepon" value="{{ $ekstrakurikuler->no_telepon }}"
                    disabled>
            </div>

            <div class="col-md-6">
                <label for="hari" class="form-label">Hari</label>
                <input type="text" class="form-control" id="hari" value="{{ $ekstrakurikuler->hari }}"
                    disabled>
            </div>

            <div class="col-md-6">
                <label for="jam-mulai" class="form-label">Jam Mulai</label>
                <input type="text" class="form-control" id="jam-mulai" value="{{ $ekstrakurikuler->jam_mulai }}"
                    disabled>
            </div>

            <div class="col-md-6">
                <label for="jam-selesai" class="form-label">Jam Selesai</label>
                <input type="text" class="form-control" id="jam-selesai" value="{{ $ekstrakurikuler->jam_selesai }}"
                    disabled>
            </div>
        </div>
    </div>
@endsection
