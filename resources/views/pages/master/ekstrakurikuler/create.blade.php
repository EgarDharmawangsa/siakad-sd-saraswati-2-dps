@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('ekstrakurikuler.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama-ekstrakurikuler" class="form-label">Nama Ekstrakurikuler</label>
                    <input type="text" class="form-control @error('nama_ekstrakurikuler') is-invalid @enderror"
                        id="nama-ekstrakurikuler" name="nama_ekstrakurikuler" placeholder="Masukkan nama ekstrakurikuler"
                        value="{{ old('nama_ekstrakurikuler') }}" required>
                    @error('nama_ekstrakurikuler')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nama-pembina" class="form-label">Nama Pembina</label>
                    <input type="text" class="form-control @error('nama_pembina') is-invalid @enderror" id="nama-pembina"
                        name="nama_pembina" placeholder="Masukkan nama pembina" value="{{ old('nama_pembina') }}" required>
                    @error('nama_pembina')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="alamat-pembina" class="form-label">Alamat Pembina</label>
                    <input type="text" class="form-control @error('alamat_pembina') is-invalid @enderror"
                        id="alamat-pembina" name="alamat_pembina" placeholder="Masukkan alamat pembina"
                        value="{{ old('alamat_pembina') }}" required>
                    @error('alamat_pembina')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="no-telepon" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id="no-telepon"
                        name="no_telepon" placeholder="Masukkan no. telepon" value="{{ old('no_telepon') }}" required>
                    @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="hari" class="form-label">Hari</label>
                    <select class="form-select @error('hari') is-invalid @enderror" id="hari" name="hari" required>
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin" {{ old('hari') === 'Senin' ? 'selected' : '' }}>Senin
                        </option>
                        <option value="Selasa" {{ old('hari') === 'Selasa' ? 'selected' : '' }}>
                            Selasa</option>
                        <option value="Rabu" {{ old('hari') === 'Rabu' ? 'selected' : '' }}>Rabu
                        </option>
                        <option value="Kamis" {{ old('hari') === 'Kamis' ? 'selected' : '' }}>Kamis
                        </option>
                        <option value="Jumat" {{ old('hari') === 'Jumat' ? 'selected' : '' }}>Jumat
                        </option>
                        <option value="Sabtu" {{ old('hari') === 'Sabtu' ? 'selected' : '' }}>Sabtu
                        </option>
                        <option value="Minggu" {{ old('hari') === 'Minggu' ? 'selected' : '' }}>
                            Minggu</option>
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam-mulai" class="form-label">Jam Mulai (WITA)</label>
                    <input type="text" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam-mulai"
                        name="jam_mulai" placeholder="Tentukan jam mulai" value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam-selesai" class="form-label">Jam Selesai (WITA)</label>
                    <input type="text" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam-selesai"
                        name="jam_selesai" placeholder="Tentukan jam selesai" value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('ekstrakurikuler.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-plus-lg me-2"></i>Tambah</button>
            </div>
        </form>
    </div>
@endsection
