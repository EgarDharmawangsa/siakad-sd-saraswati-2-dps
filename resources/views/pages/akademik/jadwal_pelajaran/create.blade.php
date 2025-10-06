@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('jadwal-pelajaran.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id-kelas" class="form-label">Kelas</label>
                    <select class="form-select @error('id_kelas') is-invalid @enderror" id="id-kelas" name="id_kelas"
                        {{ $kelas->isEmpty() ? 'disabled' : '' }} required>
                        <option value="0">
                            {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}</option>
                        @foreach ($kelas as $_kelas)
                            <option value="{{ $_kelas->id_kelas }}"
                                {{ old('id_kelas') == $_kelas->id_kelas ? 'selected' : '' }}>{{ $_kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                    <input type="text" class="form-control" id="mata-pelajaran" value="" disabled>
                </div>

                <div class="col-md-6">
                    <label for="id-guru-mata-pelajaran" class="form-label">Guru</label>
                    <select class="form-select @error('id_guru_mata_pelajaran') is-invalid @enderror" id="id-guru-mata-pelajaran" name="id_guru_mata_pelajaran" {{ $guru_mata_pelajaran->isEmpty() ? 'disabled' : '' }} required>
                        <option value="0">{{ $guru_mata_pelajaran->isNotEmpty() ? '-- Pilih Guru --' : '-- Guru Tidak Tersedia --' }}</option>
                        @foreach ($mata_pelajaran as $_mata_pelajaran)
                            @if ($guru_mata_pelajaran->contains('id_mata_pelajaran', $_mata_pelajaran->id_mata_pelajaran))
                                <optgroup label="{{ $_mata_pelajaran->nama_mata_pelajaran }}">
                                    @foreach ($guru_mata_pelajaran as $_guru_mata_pelajaran)
                                        <option value="{{ $_guru_mata_pelajaran->id_guru_mata_pelajaran }}" {{ old('id_guru_mata_pelajaran') == $_guru_mata_pelajaran->id_guru_mata_pelajaran ? 'selected' : '' }}>{{ $_guru_mata_pelajaran->pegawai->nip ?? $_guru_mata_pelajaran->pegawai->nipppk ?? '-' }} | {{ $_guru_mata_pelajaran->pegawai->nama_pegawai }}</option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                    @error('id_guru_mata_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="hari" class="form-label">Hari</label>
                    <select class="form-select @error('hari') is-invalid @enderror" id="hari" name="hari" required>
                        <option value="default">-- Pilih Hari --</option>
                        <option value="Senin" {{ old('hari') == '1' ? 'selected' : '' }}>Senin
                        </option>
                        <option value="Selasa" {{ old('hari') == '2' ? 'selected' : '' }}>
                            Selasa</option>
                        <option value="Rabu" {{ old('hari') == '3' ? 'selected' : '' }}>Rabu
                        </option>
                        <option value="Kamis" {{ old('hari') == '4' ? 'selected' : '' }}>Kamis
                        </option>
                        <option value="Jumat" {{ old('hari') == '5' ? 'selected' : '' }}>Jumat
                        </option>
                        <option value="Sabtu" {{ old('hari') == '6' ? 'selected' : '' }}>Sabtu
                        </option>
                        <option value="Minggu" {{ old('hari') == '7' ? 'selected' : '' }}>
                            Minggu</option>
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam-mulai" class="form-label">Jam Mulai (WITA)</label>
                    <input type="text" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam-mulai"
                        name="jam_mulai" placeholder="Pilih jam mulai" value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam-selesai" class="form-label">Jam Selesai (WITA)</label>
                    <input type="text" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam-selesai"
                        name="jam_selesai" placeholder="Pilih jam selesai" value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end input-button-group">
                <button type="button" class="btn btn-danger me-1" id="cancel-button"
                    data-route="{{ route('jadwal-pelajaran.index') }}" data-bs-toggle="modal"
                    data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Tambah</button>
            </div>
        </form>
    </div>
@endsection
