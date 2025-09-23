@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h3 class="mb-4">Tambah Data Pegawai Baru</h3>

        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary mb-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
        </a>

        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="pegawaiTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="data-pribadi-tab" data-bs-toggle="tab"
                        data-bs-target="#data-pribadi" type="button">Data Pribadi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="data-kepegawaian-tab" data-bs-toggle="tab"
                        data-bs-target="#data-kepegawaian" type="button">Data Kepegawaian</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="data-pendidikan-tab" data-bs-toggle="tab" data-bs-target="#data-pendidikan"
                        type="button">Pendidikan & Sertifikasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="data-sk-tab" data-bs-toggle="tab" data-bs-target="#data-sk"
                        type="button">Data SK</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="pegawaiTabContent">

                <!-- DATA PRIBADI -->
                <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik') }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                name="nip" value="{{ old('nip') }}" required>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_pegawai" class="form-label">Nama Pegawai <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror"
                                id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required>
                            @error('nama_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror" id="agama"
                                name="agama">
                                <option value="">-- Pilih --</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <select class="form-select @error('status_perkawinan') is-invalid @enderror"
                                id="status_perkawinan" name="status_perkawinan">
                                <option value="">-- Pilih --</option>
                                <option value="Belum Kawin"
                                    {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin
                                </option>
                                <option value="Cerai Hidup"
                                    {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati"
                                    {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_telepon_rumah" class="form-label">No. Telepon Rumah</label>
                            <input type="text" class="form-control @error('no_telepon_rumah') is-invalid @enderror"
                                id="no_telepon_rumah" name="no_telepon_rumah" value="{{ old('no_telepon_rumah') }}">
                            @error('no_telepon_rumah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_telepon_seluler" class="form-label">No. Telepon Seluler</label>
                            <input type="text" class="form-control @error('no_telepon_seluler') is-invalid @enderror"
                                id="no_telepon_seluler" name="no_telepon_seluler"
                                value="{{ old('no_telepon_seluler') }}">
                            @error('no_telepon_seluler')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="e_mail" class="form-label">E-Mail</label>
                            <input type="email" class="form-control @error('e_mail') is-invalid @enderror"
                                id="e_mail" name="e_mail" value="{{ old('e_mail') }}">
                            @error('e_mail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- DATA KEPEGAWAIAN -->
                <div class="tab-pane fade" id="data-kepegawaian" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <input type="text" class="form-control @error('pangkat') is-invalid @enderror"
                                id="pangkat" name="pangkat" value="{{ old('pangkat') }}">
                            @error('pangkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status_kepegawaian" class="form-label">Status Kepegawaian</label>
                            <select class="form-select @error('status_kepegawaian') is-invalid @enderror"
                                id="status_kepegawaian" name="status_kepegawaian">
                                <option value="">-- Pilih --</option>
                                <option value="PNS" {{ old('status_kepegawaian') == 'PNS' ? 'selected' : '' }}>PNS
                                </option>
                                <option value="Honorer" {{ old('status_kepegawaian') == 'Honorer' ? 'selected' : '' }}>
                                    Honorer</option>
                                <option value="Kontrak" {{ old('status_kepegawaian') == 'Kontrak' ? 'selected' : '' }}>
                                    Kontrak</option>
                            </select>
                            @error('status_kepegawaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="posisi" class="form-label">Posisi/Jabatan</label>
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror"
                                id="posisi" name="posisi" value="{{ old('posisi') }}">
                            @error('posisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="permulaan_kerja" class="form-label">Tgl. Permulaan Kerja</label>
                            <input type="date" class="form-control @error('permulaan_kerja') is-invalid @enderror"
                                id="permulaan_kerja" name="permulaan_kerja" value="{{ old('permulaan_kerja') }}">
                            @error('permulaan_kerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="permulaan_kerja_sds2" class="form-label">Tgl. Permulaan Kerja (RASDA)</label>
                            <input type="date"
                                class="form-control @error('permulaan_kerja_sds2') is-invalid @enderror"
                                id="permulaan_kerja_sds2" name="permulaan_kerja_sds2"
                                value="{{ old('permulaan_kerja_sds2') }}">
                            @error('permulaan_kerja_sds2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="golongan_ruang" class="form-label">Golongan Ruang</label>
                            <input type="text" class="form-control @error('golongan_ruang') is-invalid @enderror"
                                id="golongan_ruang" name="golongan_ruang" value="{{ old('golongan_ruang') }}">
                            @error('golongan_ruang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- PENDIDIKAN & SERTIFIKASI -->
                <div class="tab-pane fade" id="data-pendidikan" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gelar_ijazah" class="form-label">Gelar Ijazah</label>
                            <input type="text" class="form-control @error('gelar_ijazah') is-invalid @enderror"
                                id="gelar_ijazah" name="gelar_ijazah" value="{{ old('gelar_ijazah') }}">
                            @error('gelar_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tahun_ijazah" class="form-label">Tahun Ijazah</label>
                            <input type="number" class="form-control @error('tahun_ijazah') is-invalid @enderror"
                                id="tahun_ijazah" name="tahun_ijazah" value="{{ old('tahun_ijazah') }}" min="1900"
                                max="{{ date('Y') }}">
                            @error('tahun_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status_sertifikasi" class="form-label">Status Sertifikasi</label>
                            <select class="form-select @error('status_sertifikasi') is-invalid @enderror"
                                id="status_sertifikasi" name="status_sertifikasi">
                                <option value="">-- Pilih --</option>
                                <option value="Sudah" {{ old('status_sertifikasi') == 'Sudah' ? 'selected' : '' }}>Sudah
                                </option>
                                <option value="Belum" {{ old('status_sertifikasi') == 'Belum' ? 'selected' : '' }}>Belum
                                </option>
                            </select>
                            @error('status_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tahun_sertifikasi" class="form-label">Tahun Sertifikasi</label>
                            <input type="number" class="form-control @error('tahun_sertifikasi') is-invalid @enderror"
                                id="tahun_sertifikasi" name="tahun_sertifikasi" value="{{ old('tahun_sertifikasi') }}"
                                min="1900" max="{{ date('Y') }}">
                            @error('tahun_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- DATA SK -->
                <div class="tab-pane fade" id="data-sk" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_sk" class="form-label">Nomor SK Terakhir</label>
                            <input type="text" class="form-control @error('no_sk') is-invalid @enderror"
                                id="no_sk" name="no_sk" value="{{ old('no_sk') }}">
                            @error('no_sk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_sk_terakhir" class="form-label">Tanggal SK Terakhir</label>
                            <input type="date" class="form-control @error('tanggal_sk_terakhir') is-invalid @enderror"
                                id="tanggal_sk_terakhir" name="tanggal_sk_terakhir"
                                value="{{ old('tanggal_sk_terakhir') }}">
                            @error('tanggal_sk_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-end mt-4">
                <button type="button" class="btn btn-danger me-2" id="cancel-button"
                    data-route="{{ route('pegawai.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal
                </button>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah
                </button>
            </div>

            @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const cancelButton = document.getElementById('cancel-button');
                        const confirmCancel = document.getElementById('confirm-cancel');
                        const cancelModal = document.getElementById('cancel-modal');

                        if (cancelButton && confirmCancel && cancelModal) {
                            cancelButton.addEventListener('click', function() {
                                const targetUrl = this.getAttribute('data-route');
                                confirmCancel.setAttribute('href', targetUrl);
                            });
                        }

                        // Tetap aktifkan tab error jika ada
                        @if ($errors->any())
                            let firstError = document.querySelector('.is-invalid');
                            if (firstError) {
                                let tabPane = firstError.closest('.tab-pane');
                                if (tabPane) {
                                    let tabId = tabPane.id;
                                    let tabTrigger = document.querySelector(`button[data-bs-target="#${tabId}"]`);
                                    if (tabTrigger) {
                                        bootstrap.Tab.getOrCreateInstance(tabTrigger).show();
                                    }
                                }
                            }
                        @endif
                    });
                </script>
            @endpush
        @endsection
