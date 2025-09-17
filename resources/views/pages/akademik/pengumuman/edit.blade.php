@extends('layouts.main')

@section('container')
    <div class="content-card">
        <form action="{{ route('pengumuman.update', $pengumuman->id_pengumuman) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Ketikkan judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi</label>
                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="10" placeholder="Ketikkan isi" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar" class="form-label">Gambar <span class="text-muted mini-label ms-1">(Opsional)</span></label>
                <img src="{{ $pengumuman->gambar ? asset('storage/' . $pengumuman->gambar) : '' }}" class="gambar my-4 rounded {{ $pengumuman->gambar ? '' : 'd-none' }}" id="image-preview">
                <button type="button" class="btn btn-danger btn-sm d-block mx-auto mb-5 {{ $pengumuman->gambar ? '' : 'd-none' }}" id="image-delete-button" onclick="imageDelete()"><i class="bi bi-trash"></i> Hapus</button>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror image-input" id="gambar" name="gambar" onchange="imagePreview()">
                <span class="text-muted d-block mini-label my-2">Format .jpg/.png/.jpeg | Ukuran maksimal 10 MB</span>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="hidden" name="old_gambar" value="{{ $pengumuman->gambar }}">
                <input type="hidden" name="gambar_delete" id="image-delete" value="0">
            </div>

            <div class="text-end">
                <a href="{{ route('pengumuman.index') }}" class="btn btn-danger m-1"><i
                        class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection