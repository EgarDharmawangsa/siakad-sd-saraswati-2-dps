@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            @can('staf-tata-usaha')
                <a href="{{ route('ekstrakurikuler.edit', $ekstrakurikuler->id_ekstrakurikuler) }}" class="btn btn-warning btn-sm me-1"><i
                        class="bi bi-pencil me-2"></i>Edit</a>
                <form action="{{ route('ekstrakurikuler.destroy', $ekstrakurikuler->id_ekstrakurikuler) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                        data-bs-target="#delete-modal">
                        <i class="bi bi-trash me-2"></i>Hapus</button>
                </form>
            @endcan
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama-ekstrakurikuler" class="form-label">Nama Ekstrakurikuler</label>
                <input type="text" class="form-control" id="nama-ekstrakurikuler"
                    value="{{ $ekstrakurikuler->nama_ekstrakurikuler }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="nama-pembina" class="form-label">Nama Pembina</label>
                <input type="text" class="form-control" id="nama-pembina" value="{{ $ekstrakurikuler->nama_pembina }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="alamat-pembina" class="form-label">Alamat Pembina</label>
                <input type="text" class="form-control" id="alamat-pembina"
                    value="{{ $ekstrakurikuler->alamat_pembina }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="no-telepon" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="no-telepon" value="{{ $ekstrakurikuler->no_telepon }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="hari" class="form-label">Hari</label>
                <input type="text" class="form-control" id="hari" value="{{ $ekstrakurikuler->hari }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="jam-mulai" class="form-label">Jam Mulai</label>
                <input type="text" class="form-control" id="jam-mulai" value="{{ $ekstrakurikuler->getFormatedJam('jam_mulai') }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="jam-selesai" class="form-label">Jam Selesai</label>
                <input type="text" class="form-control" id="jam-selesai" value="{{ $ekstrakurikuler->getFormatedJam('jam_selesai') }}"
                    readonly>
            </div>
        </div>
    </div>
@endsection
