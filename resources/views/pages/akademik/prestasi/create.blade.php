@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama-prestasi" class="form-label">Nama Prestasi</label>
                    <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror" id="nama-prestasi"
                        name="nama_prestasi" placeholder="Masukkan nama prestasi" value="{{ old('nama_prestasi') }}"
                        required>
                    @error('nama_prestasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="peraih" class="form-label">Peraih</label>
                    <select class="form-select @error('id_siswa') is-invalid @enderror" id="peraih" name="id_siswa"
                        {{ $siswa->count() == 0 ? 'disabled' : '' }} required>
                        <option value="0">{{ $siswa->isNotEmpty() ? 'Pilih Siswa' : 'Siswa Tidak Tersedia' }}</option>
                        @foreach ($siswa as $_siswa)
                            <option value="{{ $_siswa->id_siswa }}"
                                {{ old('id_siswa') == $_siswa->id_siswa ? 'selected' : '' }}>{{ $_siswa->nisn }} |
                                {{ $_siswa->nama_siswa }}</option>
                        @endforeach
                    </select>
                    @error('id_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="penyelenggara" class="form-label">Penyelenggara</label>
                    <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror"
                        id="penyelenggara" name="penyelenggara" placeholder="Masukkan penyelenggara"
                        value="{{ old('penyelenggara') }}" required>
                    @error('penyelenggara')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                        <option value="default">-- Pilih Jenis --</option>
                        <option value="Akademik" {{ old('jenis') == '1' ? 'selected' : '' }}>Akademik</option>
                        <option value="Non-Akademik" {{ old('jenis') == '2' ? 'selected' : '' }}>Non-Akademik</option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="peringkat" class="form-label">Peringkat</label>
                    <select class="form-select @error('peringkat') is-invalid @enderror" id="peringkat" name="peringkat"
                        required>
                        <option value="default">-- Pilih Peringkat --</option>
                        <option value="1 (Pertama)" {{ old('peringkat') == '1 (Pertama)' ? 'selected' : '' }}>1 (Pertama)</option>
                        <option value="2 (Kedua)" {{ old('peringkat') == '2 (Kedua)' ? 'selected' : '' }}>2 (Kedua)</option>
                        <option value="3 (Ketiga)" {{ old('peringkat') == '3' ? 'selected' : '' }}>3 (Ketiga)</option>
                        <option value="Harapan 1" {{ old('peringkat') == 'Harapan 1' ? 'selected' : '' }}>Harapan 1</option>
                        <option value="Harapan 2" {{ old('peringkat') == 'Harapan 2' ? 'selected' : '' }}>Harapan 2</option>
                        <option value="Harapan 3" {{ old('peringkat') == 'Harapan 3' ? 'selected' : '' }}>Harapan 3</option>
                        <option value="Lainnya" {{ old('peringkat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('peringkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="peringkat-lainnya" class="form-label">Peringkat Lainnya</label>
                    <input type="text" class="form-control @error('peringkat_lainnya') is-invalid @enderror"
                        id="peringkat-lainnya" name="peringkat_lainnya"
                        placeholder="Masukkan peringkat lainnya"
                        value="{{ old('peringkat_lainnya') }}" required disabled>
                    @error('peringkat_lainnya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tingkat" class="form-label">Tingkat</label>
                    <select class="form-select @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat"
                        required>
                        <option value="default">-- Pilih Tingkat --</option>
                        <option value="Sekolah" {{ old('tingkat') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                        <option value="Desa" {{ old('tingkat') == 'Desa' ? 'selected' : '' }}>Desa</option>
                        <option value="Kecamatan" {{ old('tingkat') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        <option value="Kabupaten/Kota" {{ old('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                        <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                    </select>
                    @error('tingkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nama-wilayah" class="form-label">Nama Wilayah</label>
                    <input type="text" class="form-control @error('nama_wilayah') is-invalid @enderror" id="nama-wilayah"
                        name="nama_wilayah" placeholder="Masukkan nama wilayah" value="{{ old('nama_wilayah') }}" required>
                    @error('nama_wilayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                        name="tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="dokumentasi" class="form-label">Dokumentasi<span
                            class="text-muted mini-label ms-1">(Opsional)</span></label>
                    <img class="dokumentasi mt-2 mb-3 rounded d-none" id="image-preview">
                    <button type="button" class="btn btn-danger btn-sm d-block mx-auto mb-4 d-none"
                        id="image-delete-button"><i class="bi bi-trash me-2"></i>Hapus</button>
                    <input type="file" class="form-control @error('dokumentasi') is-invalid @enderror image-input"
                        id="dokumentasi" name="dokumentasi">
                    @error('dokumentasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="text-muted d-block mini-label mt-1">Format .jpg/.png/.jpeg | Ukuran maksimal 10 MB</span>
                </div>
            </div>

            <div class="text-end input-button-group">
                <button type="button" class="btn btn-danger me-1" id="cancel-button"
                    data-route="{{ route('prestasi.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah</button>
            </div>
        </form>
    </div>
@endsection
