@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Tambah {{ $judul }}</h5>
        <hr>

        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="pegawai-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="data-pribadi-tab" data-bs-toggle="tab" data-bs-target="#data-pribadi"
                        type="button">Data pribadi</button>
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
            <div class="tab-content mb-0" id="pegawai-tab-content">
                <!-- DATA PRIBADI -->
                <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" placeholder="Masukkan NIK" value="{{ old('nik') }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror"
                                id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan nama pegawai"
                                value="{{ old('nama_pegawai') }}" required>
                            @error('nama_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') === 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir"
                                value="{{ old('tempat_lahir') }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir"
                                value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama"
                                required>
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('agama') === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen Protestan"
                                    {{ old('agama') === 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan
                                </option>
                                <option value="Kristen Katolik"
                                    {{ old('agama') === 'Kristen Katolik' ? 'selected' : '' }}>
                                    Kristen Katolik
                                </option>
                                <option value="Hindu" {{ old('agama') === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') === 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                                <option value="Tidak Beragama" {{ old('agama') === 'Tidak Beragama' ? 'selected' : '' }}>
                                    Tidak Beragama
                                </option>
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <select class="form-select @error('status_perkawinan') is-invalid @enderror"
                                id="status_perkawinan" name="status_perkawinan" required>
                                <option value="">-- Pilih Status Perkawinan --</option>
                                <option value="Sudah" {{ old('status_perkawinan') === 'Sudah' ? 'selected' : '' }}>Sudah
                                </option>
                                <option value="Pernah" {{ old('status_perkawinan') === 'Pernah' ? 'selected' : '' }}>
                                    Pernah
                                </option>
                                <option value="Belum" {{ old('status_perkawinan') === 'Belum' ? 'selected' : '' }}>Belum
                                </option>
                            </select>
                            @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" placeholder="Masukkan alamat" value="{{ old('alamat') }}"
                                required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_telepon_rumah" class="form-label">No. Telepon Rumah<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="number" class="form-control @error('no_telepon_rumah') is-invalid @enderror"
                                id="no_telepon_rumah" name="no_telepon_rumah" placeholder="Masukkan no. telepon rumah"
                                value="{{ old('no_telepon_rumah') }}">
                            @error('no_telepon_rumah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_telepon_seluler" class="form-label">No. Telepon Seluler</label>
                            <input type="number" class="form-control @error('no_telepon_seluler') is-invalid @enderror"
                                id="no_telepon_seluler" name="no_telepon_seluler"
                                placeholder="Masukkan no. telepon seluler" value="{{ old('no_telepon_seluler') }}"
                                required>
                            @error('no_telepon_seluler')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="e_mail" class="form-label">E-Mail<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="email" class="form-control @error('e_mail') is-invalid @enderror"
                                id="e_mail" name="e_mail" placeholder="Masukkan e-mail"
                                value="{{ old('e_mail') }}">
                            @error('e_mail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="Masukkan username"
                                value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan password"
                                value="{{ old('password') }}" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <img class="foto mt-2 mb-3 rounded-circle d-none" id="image-preview">
                            <button type="button" class="btn btn-danger btn-sm d-block mx-auto mb-4 d-none"
                                id="image-delete-button"><i class="bi bi-trash me-2"></i> Hapus</button>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror image-input"
                                id="foto" name="foto">
                            <span class="text-muted d-block mini-label mt-1">Format .jpg/.png/.jpeg | Ukuran maksimal 10
                                MB</span>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- DATA KEPEGAWAIAN -->
                <div class="tab-pane fade" id="data-kepegawaian" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="posisi" class="form-label">Posisi</label>
                            <select class="form-select @error('posisi') is-invalid @enderror" id="posisi"
                                name="posisi" required>
                                <option value="">-- Pilih Posisi --</option>
                                <option value="Staf Tata Usaha"
                                    {{ old('posisi') === 'Staf Tata Usaha' ? 'selected' : '' }}>Staf Tata Usaha
                                </option>
                                <option value="Guru" {{ old('posisi') === 'Guru' ? 'selected' : '' }}>Guru
                                </option>
                                <option value="Pegawai Perpustakaan"
                                    {{ old('posisi') === 'Pegawai Perpustakaan' ? 'selected' : '' }}>Pegawai Perpustakaan
                                </option>
                                <option value="Pegawai Kebersihan"
                                    {{ old('posisi') === 'Pegawai Kebersihan' ? 'selected' : '' }}>Pegawai Kebersihan
                                </option>
                                <option value="Satuan Pengamanan"
                                    {{ old('posisi') === 'Satuan Pengamanan' ? 'selected' : '' }}>Satuan Pengamanan
                                </option>
                            </select>
                            @error('posisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="id-mata-pelajaran" class="form-label">Guru Mata Pelajaran</label>
                            <div class="dropdown" id="id-mata-pelajaran">
                                <button class="form-select text-start @error('id_mata_pelajaran') is-invalid @enderror"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    id="id-mata-pelajaran-dropdown-button"
                                    {{ $mata_pelajaran->isEmpty() ? 'disabled' : '' }}>
                                    {{ $mata_pelajaran->isNotEmpty() ? '-- Pilih Mata Pelajaran --' : '-- Mata Pelajaran Tidak Tersedia --' }}
                                </button>
                                <ul class="dropdown-menu w-100 p-2 id-mata-pelajaran-dropdown-menu"
                                    aria-labelledby="id-mata-pelajaran-dropdown-button">
                                    @foreach ($mata_pelajaran as $_mata_pelajaran)
                                        <li><label class="dropdown-item"><input type="checkbox"
                                                    name="id_mata_pelajaran[]"
                                                    class="form-check-input me-2 id-mata-pelajaran-checkbox"
                                                    value="{{ $_mata_pelajaran->id_mata_pelajaran }}"
                                                    {{ in_array($_mata_pelajaran->id_mata_pelajaran, old('id_mata_pelajaran', [])) ? 'checked' : '' }}>{{ $_mata_pelajaran->nama_mata_pelajaran }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('id_mata_pelajaran')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status-kepegawaian" class="form-label">Status Kepegawaian</label>
                            <select class="form-select @error('status_kepegawaian') is-invalid @enderror"
                                id="status-kepegawaian" name="status_kepegawaian" required>
                                <option value="">-- Pilih Status Kepegawaian --</option>
                                <option value="PNS" {{ old('status_kepegawaian') === 'PNS' ? 'selected' : '' }}>PNS
                                </option>
                                <option value="PPPK" {{ old('status_kepegawaian') === 'PPPK' ? 'selected' : '' }}>PPPK
                                </option>
                                <option value="Honorer" {{ old('status_kepegawaian') === 'Honorer' ? 'selected' : '' }}>
                                    Honorer</option>
                                <option value="Kontrak" {{ old('status_kepegawaian') === 'Kontrak' ? 'selected' : '' }}>
                                    Kontrak</option>
                                <option value="Tetap" {{ old('status_kepegawaian') === 'Tetap' ? 'selected' : '' }}>Tetap
                                </option>
                                <option value="Tidak Tetap"
                                    {{ old('status_kepegawaian') === 'Tidak Tetap' ? 'selected' : '' }}>Tidak Tetap
                                </option>
                            </select>
                            @error('status_kepegawaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}" required>
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nipppk" class="form-label">NIPPPK</label>
                            <input type="number" class="form-control @error('nipppk') is-invalid @enderror"
                                id="nipppk" name="nipppk" placeholder="Masukkan NIPPPK" value="{{ old('nipppk') }}"
                                required>
                            @error('nipppk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select @error('jabatan') is-invalid @enderror" id="jabatan"
                                name="jabatan" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Pengatur Muda | II/a"
                                    {{ old('jabatan') === 'Pengatur Muda | II/a' ? 'selected' : '' }}>Pengatur Muda | II/a
                                </option>
                                <option value="Pengatur Muda Tk. I | II/b"
                                    {{ old('jabatan') === 'Pengatur Muda Tk. I | II/b' ? 'selected' : '' }}>Pengatur Muda
                                    Tk. I | II/b</option>
                                <option value="Pengatur | II/c"
                                    {{ old('jabatan') === 'Pengatur | II/c' ? 'selected' : '' }}>Pengatur | II/c</option>
                                <option value="Pengatur Tk. I | II/d"
                                    {{ old('jabatan') === 'Pengatur Tk. I | II/d' ? 'selected' : '' }}>Pengatur Tk. I |
                                    II/d
                                </option>
                                <option value="Penata Muda | III/a"
                                    {{ old('jabatan') === 'Penata Muda | III/a' ? 'selected' : '' }}>Penata Muda | III/a
                                </option>
                                <option value="Penata Muda Tk. I | III/b"
                                    {{ old('jabatan') === 'Penata Muda Tk. I | III/b' ? 'selected' : '' }}>Penata Muda Tk.
                                    I
                                    | III/b</option>
                                <option value="Penata | III/c"
                                    {{ old('jabatan') === 'Penata | III/c' ? 'selected' : '' }}>
                                    Penata | III/c</option>
                                <option value="Penata Tk. I | III/d"
                                    {{ old('jabatan') === 'Penata Tk. I | III/d' ? 'selected' : '' }}>Penata Tk. I | III/d
                                </option>
                                <option value="Pembina | IV/a"
                                    {{ old('jabatan') === 'Pembina | IV/a' ? 'selected' : '' }}>
                                    Pembina | IV/a</option>
                                <option value="Pembina Tk. I | IV/b"
                                    {{ old('jabatan') === 'Pembina Tk. I | IV/b' ? 'selected' : '' }}>Pembina Tk. I | IV/b
                                </option>
                                <option value="Pembina Utama Muda | IV/c"
                                    {{ old('jabatan') === 'Pembina Utama Muda | IV/c' ? 'selected' : '' }}>Pembina Utama
                                    Muda | IV/c</option>
                                <option value="Pembina Utama Madya | IV/d"
                                    {{ old('jabatan') === 'Pembina Utama Madya | IV/d' ? 'selected' : '' }}>Pembina Utama
                                    Madya | IV/d</option>
                                <option value="Pembina Utama | IV/e"
                                    {{ old('jabatan') === 'Pembina Utama | IV/e' ? 'selected' : '' }}>Pembina Utama | IV/e
                                </option>
                            </select>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="permulaan-kerja" class="form-label">Tanggal Permulaan Kerja</label>
                            <input type="date" class="form-control @error('permulaan_kerja') is-invalid @enderror"
                                id="permulaan-kerja" name="permulaan_kerja" value="{{ old('permulaan_kerja') }}"
                                required>
                            @error('permulaan_kerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="permulaan-kerja-sds2" class="form-label">Tanggal Permulaan Kerja (RASDA)</label>
                            <input type="date"
                                class="form-control @error('permulaan_kerja_sds2') is-invalid @enderror"
                                id="permulaan-kerja-sds2" name="permulaan_kerja_sds2"
                                value="{{ old('permulaan_kerja_sds2') }}" required>
                            @error('permulaan_kerja_sds2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- PENDIDIKAN & SERTIFIKASI -->
                <div class="tab-pane fade" id="data-pendidikan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ijazah-terakhir" class="form-label">Ijazah Terakhir<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="text" class="form-control @error('ijazah_terakhir') is-invalid @enderror"
                                id="ijazah-terakhir" name="ijazah_terakhir" placeholder="Masukkan ijazah terakhir"
                                value="{{ old('ijazah_terakhir') }}">
                            @error('ijazah_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tahun-ijazah" class="form-label">Tahun Ijazah<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="number" class="form-control @error('tahun_ijazah') is-invalid @enderror"
                                id="tahun-ijazah" name="tahun_ijazah" placeholder="Masukkan tahun ijazah"
                                value="{{ old('tahun_ijazah') }}" min="1900" max="{{ date('Y') }}">
                            @error('tahun_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status-sertifikasi" class="form-label">Status Sertifikasi</label>
                            <select class="form-select @error('status_sertifikasi') is-invalid @enderror"
                                id="status-sertifikasi" name="status_sertifikasi" required>
                                <option value="">-- Pilih Status Sertifikasi --</option>
                                <option value="Sudah" {{ old('status_sertifikasi') === 'Sudah' ? 'selected' : '' }}>Sudah
                                </option>
                                <option value="Belum" {{ old('status_sertifikasi') === 'Belum' ? 'selected' : '' }}>Belum
                                </option>
                            </select>
                            @error('status_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tahun-sertifikasi" class="form-label">Tahun Sertifikasi</label>
                            <input type="number" class="form-control @error('tahun_sertifikasi') is-invalid @enderror"
                                id="tahun-sertifikasi" name="tahun_sertifikasi" placeholder="Masukkan tahun sertifikasi"
                                value="{{ old('tahun_sertifikasi') }}" min="1900" max="{{ date('Y') }}"
                                required>
                            @error('tahun_sertifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- DATA SK -->
                <div class="tab-pane fade" id="data-sk" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="no-sk" class="form-label">Nomor SK</label>
                            <input type="text" class="form-control @error('no_sk') is-invalid @enderror"
                                id="no-sk" name="no_sk" placeholder="Masukkan no. SK terakhir"
                                value="{{ old('no_sk') }}" required>
                            @error('no_sk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal-sk-terakhir" class="form-label">Tanggal SK Terakhir</label>
                            <input type="date" class="form-control @error('tanggal_sk_terakhir') is-invalid @enderror"
                                id="tanggal-sk-terakhir" name="tanggal_sk_terakhir"
                                value="{{ old('tanggal_sk_terakhir') }}" required>
                            @error('tanggal_sk_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-end input-button-group">
                <button type="button" class="btn btn-danger me-1" id="cancel-button"
                    data-route="{{ route('pegawai.index') }}" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>Tambah
                </button>
            </div>
        </form>
    </div>
@endsection
