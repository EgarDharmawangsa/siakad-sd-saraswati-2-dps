@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>{{ $judul }}</h5>
        <hr>

        <div class="mb-4">
            <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('mata-pelajaran.edit', $mata_pelajaran->id_mata_pelajaran) }}" class="btn btn-warning btn-sm"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
        </div>

        <div>
            <label for="nama-mata-pelajaran" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" id="nama-mata-pelajaran" value="{{ $mata_pelajaran->nama_mata_pelajaran }}" disabled>
        </div>
    </div>
@endsection