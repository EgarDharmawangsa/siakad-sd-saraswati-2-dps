@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>{{ $judul }}</h5>
        <hr>

        <form action="{{ route('pengumuman.update', $pengumuman->id_pengumuman) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-9">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                        placeholder="Masukkan judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                        name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal->format('Y-m-d')) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="isi" class="form-label">Isi</label>
                    <input id="isi" type="hidden" name="isi" value="{{ old('isi', $pengumuman->isi) }}">
                    <trix-editor input="isi"></trix-editor>
                </div>

                <div class="col-md-12 mb-4">
                    <label for="gambar" class="form-label">Gambar<span
                            class="text-muted mini-label ms-1">(Opsional)</span></label>
                    <img src="{{ $pengumuman->gambar ? asset('storage/' . $pengumuman->gambar) : '' }}"
                        class="gambar mt-2 mb-3 rounded {{ $pengumuman->gambar ? '' : 'd-none' }}" id="image-preview">
                    <button type="button"
                        class="btn btn-danger btn-sm d-block mx-auto mb-4 {{ $pengumuman->gambar ? '' : 'd-none' }}"
                        id="image-delete-button"><i class="bi bi-trash me-2"></i>Hapus</button>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror image-input" id="gambar"
                        name="gambar">
                    <span class="text-muted d-block mini-label mt-1">Format .jpg/.png/.jpeg | Ukuran maksimal 10 MB</span>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="hidden" name="old_gambar" value="{{ $pengumuman->gambar }}">
                    <input type="hidden" name="gambar_delete" id="image-delete" value="0">
                </div>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-danger me-1" id="cancel-button" data-route="{{ route('pengumuman.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
