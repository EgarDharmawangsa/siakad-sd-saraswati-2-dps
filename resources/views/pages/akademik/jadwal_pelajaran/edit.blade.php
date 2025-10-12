@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Edit {{ $judul }}</h5>
        <hr>

        <form action="{{ route('jadwal-pelajaran.update', $jadwal_pelajaran->id_jadwal_pelajaran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-12">
                    <label for="id-kelas" class="form-label d-block">Kegiatan</label>
                    <div class="btn-group" id="kegiatan">
                        <input type="radio" class="btn-check" name="kegiatan" id="kegiatan-belajar-radio" value="Belajar"
                            {{ old('kegiatan', $jadwal_pelajaran->kegiatan) == 'Belajar' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="kegiatan-belajar-radio">Belajar</label>

                        <input type="radio" class="btn-check" name="kegiatan" id="kegiatan-istirahat-radio"
                            value="Istirahat"
                            {{ old('kegiatan', $jadwal_pelajaran->kegiatan) == 'Istirahat' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="kegiatan-istirahat-radio">Istirahat</label>
                    </div>
                </div>


                <div class="col-md-6">
                    <label for="id-kelas" class="form-label">Kelas</label>
                    <select class="form-select @error('id_kelas') is-invalid @enderror" id="id-kelas" name="id_kelas"
                        {{ $kelas->isEmpty() ? 'disabled' : '' }} required>
                        <option value="0">
                            {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}</option>
                        @foreach ($kelas as $_kelas)
                            <option value="{{ $_kelas->id_kelas }}"
                                {{ old('id_kelas', $jadwal_pelajaran->id_kelas) == $_kelas->id_kelas ? 'selected' : '' }}>
                                {{ $_kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                    <input type="text" class="form-control" id="mata-pelajaran"
                        value="{{ $jadwal_pelajaran->guruMataPelajaran->mataPelajaran->nama_mata_pelajaran ?? '' }}"
                        placeholder="Mata Pelajaran yang dipilih" disabled>
                </div>

                <div class="col-md-6">
                    <label for="id-guru-mata-pelajaran" class="form-label">Guru</label>
                    <select class="form-select @error('id_guru_mata_pelajaran') is-invalid @enderror"
                        id="id-guru-mata-pelajaran" name="id_guru_mata_pelajaran"
                        {{ $guru_mata_pelajaran->isEmpty() ? 'disabled' : '' }} required>
                        <option value="0">
                            {{ $guru_mata_pelajaran->isNotEmpty() ? '-- Pilih Guru --' : '-- Guru Tidak Tersedia --' }}
                        </option>
                        @foreach ($mata_pelajaran as $_mata_pelajaran)
                            @php
                                $guruUntukMapel = $guru_mata_pelajaran->where(
                                    'id_mata_pelajaran',
                                    $_mata_pelajaran->id_mata_pelajaran,
                                );
                            @endphp
                            @if ($guruUntukMapel->isNotEmpty())
                                <optgroup label="{{ $_mata_pelajaran->nama_mata_pelajaran }}">
                                    @foreach ($guruUntukMapel as $_guru_mata_pelajaran)
                                        <option value="{{ $_guru_mata_pelajaran->id_guru_mata_pelajaran }}"
                                            data-bs-mata-pelajaran="{{ $_guru_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}"
                                            {{ old('id_guru_mata_pelajaran', $jadwal_pelajaran->id_guru_mata_pelajaran) == $_guru_mata_pelajaran->id_guru_mata_pelajaran ? 'selected' : '' }}>
                                            {{ $_guru_mata_pelajaran->pegawai->getPegawai() }}
                                        </option>
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
                        <option value="Senin" {{ old('hari', $jadwal_pelajaran->hari) == 'Senin' ? 'selected' : '' }}>
                            Senin
                        </option>
                        <option value="Selasa" {{ old('hari', $jadwal_pelajaran->hari) == 'Selasa' ? 'selected' : '' }}>
                            Selasa</option>
                        <option value="Rabu" {{ old('hari', $jadwal_pelajaran->hari) == 'Rabu' ? 'selected' : '' }}>Rabu
                        </option>
                        <option value="Kamis" {{ old('hari', $jadwal_pelajaran->hari) == 'Kamis' ? 'selected' : '' }}>
                            Kamis
                        </option>
                        <option value="Jumat" {{ old('hari', $jadwal_pelajaran->hari) == 'Jumat' ? 'selected' : '' }}>
                            Jumat
                        </option>
                        <option value="Sabtu" {{ old('hari', $jadwal_pelajaran->hari) == 'Sabtu' ? 'selected' : '' }}>
                            Sabtu
                        </option>
                        <option value="Minggu" {{ old('hari', $jadwal_pelajaran->hari) == 'Minggu' ? 'selected' : '' }}>
                            Minggu</option>
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam-mulai" class="form-label">Jam Mulai (WITA)</label>
                    <input type="text" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam-mulai"
                        name="jam_mulai" placeholder="Pilih jam mulai"
                        value="{{ old('jam_mulai', $jadwal_pelajaran->jam_mulai) }}" required>
                    @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam-selesai" class="form-label">Jam Selesai (WITA)</label>
                    <input type="text" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam-selesai"
                        name="jam_selesai" placeholder="Pilih jam selesai"
                        value="{{ old('jam_selesai', $jadwal_pelajaran->jam_selesai) }}" required>
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
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Perbarui</button>
            </div>
        </form>
    </div>
@endsection
