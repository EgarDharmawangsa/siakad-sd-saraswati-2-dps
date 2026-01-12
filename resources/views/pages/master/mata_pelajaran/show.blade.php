@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
                    
            @can('staf-tata-usaha')
                <a href="{{ route('mata-pelajaran.edit', $mata_pelajaran->id_mata_pelajaran) }}"
                    class="btn btn-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
                <form action="{{ route('mata-pelajaran.destroy', $mata_pelajaran->id_mata_pelajaran) }}" method="POST"
                    class="d-inline delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal"
                        data-bs-target="#delete-modal">
                        <i class="bi bi-trash me-2"></i>Hapus</button>
                </form>
            @endcan
        </div>

        <div class="mata-pelajaran-input-group">
            <label for="nama-mata-pelajaran" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" id="nama-mata-pelajaran"
                value="{{ $mata_pelajaran->nama_mata_pelajaran }}" readonly>
        </div>
    </div>
@endsection
