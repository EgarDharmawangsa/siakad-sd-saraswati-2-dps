@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>{{ $judul }}</h5>
        <hr>

        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="pegawai-tab" role="tablist">
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
            <div class="tab-content" id="pegawai-tab-content">
                <!-- DATA PRIBADI -->
                <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
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
                                <option value="2">-- Pilih Jenis Kelamin --</option>
                                <option value="0" {{ old('jenis_kelamin') == '0' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="1" {{ old('jenis_kelamin') == '1' ? 'selected' : '' }}>
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
                                <option value="0">-- Pilih Agama --</option>
                                <option value="1" {{ old('agama') == '1' ? 'selected' : '' }}>Islam</option>
                                <option value="2" {{ old('agama') == '2' ? 'selected' : '' }}>Kristen Protestan
                                </option>
                                <option value="3" {{ old('agama') == '3' ? 'selected' : '' }}>Kristen Katolik
                                </option>
                                <option value="4" {{ old('agama') == '4' ? 'selected' : '' }}>Hindu</option>
                                <option value="5" {{ old('agama') == '5' ? 'selected' : '' }}>Buddha</option>
                                <option value="6" {{ old('agama') == '6' ? 'selected' : '' }}>Konghucu
                                </option>
                                <option value="7" {{ old('agama') == '7' ? 'selected' : '' }}>Tidak Beragama
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
                                <option value="0">-- Pilih Status Perkawinan --</option>
                                <option value="1" {{ old('status_perkawinan') == '1' ? 'selected' : '' }}>Sudah
                                </option>
                                <option value="2" {{ old('status_perkawinan') == '2' ? 'selected' : '' }}>Pernah
                                </option>
                                <option value="3" {{ old('status_perkawinan') == '3' ? 'selected' : '' }}>Belum
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
                            <input type="text" class="form-control @error('no_telepon_rumah') is-invalid @enderror"
                                id="no_telepon_rumah" name="no_telepon_rumah" placeholder="Masukkan no. telepon rumah"
                                value="{{ old('no_telepon_rumah') }}">
                            @error('no_telepon_rumah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_telepon_seluler" class="form-label">No. Telepon Seluler</label>
                            <input type="text" class="form-control @error('no_telepon_seluler') is-invalid @enderror"
                                id="no_telepon_seluler" name="no_telepon_seluler"
                                placeholder="Masukkan no. telepon seluler" value="{{ old('no_telepon_seluler') }}"
                                required>
                            @error('no_telepon_seluler')
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
                            <label for="e_mail" class="form-label">E-Mail<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="email" class="form-control @error('e_mail') is-invalid @enderror"
                                id="e_mail" name="e_mail" placeholder="Masukkan e-mail"
                                value="{{ old('e_mail') }}">
                            @error('e_mail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="foto" class="form-label">Foto<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <img class="foto mt-2 mb-3 rounded d-none" id="image-preview">
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
                                <option value="0">-- Pilih Posisi --</option>
                                <option value="1" {{ old('posisi') == '1' ? 'selected' : '' }}>Staf Tata Usaha
                                </option>
                                <option value="2" {{ old('posisi') == '2' ? 'selected' : '' }}>Guru
                                </option>
                                <option value="3" {{ old('posisi') == '3' ? 'selected' : '' }}>Pegawai Perpustakaan
                                </option>
                                <option value="4" {{ old('posisi') == '4' ? 'selected' : '' }}>Pegawai Kebersihan
                                </option>
                                <option value="5" {{ old('posisi') == '5' ? 'selected' : '' }}>Satuan Pengamanan
                                </option>
                            </select>
                            @error('posisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="guru-mata-pelajaran" class="form-label">Guru Mata Pelajaran</label>

                            <div class="dropdown" id="guru-mata-pelajaran">
                                <button class="form-select text-start" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" id="guru-mata-pelajaran-dropdown-button">
                                    -- Pilih Mata Pelajaran --
                                </button>
                                <ul class="dropdown-menu w-100 p-2 guru-mata-pelajaran-dropdown-menu"
                                    aria-labelledby="guru-mata-pelajaran-dropdown-button">
                                    @forelse ($mata_pelajaran as $_mata_pelajaran)
                                        <li><label class="dropdown-item"><input type="checkbox"
                                                    value="{{ $_mata_pelajaran->id_mata_pelajaran }}"
                                                    class="form-check-input me-2 guru-mata-pelajaran-item">{{ $_mata_pelajaran->nama_mata_pelajaran }}</label>
                                        </li>
                                    @empty
                                        <li><label class="dropdown-item">Belum ada data Mata Pelajaran.</label></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="status_kepegawaian" class="form-label">Status Kepegawaian<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <select class="form-select @error('status_kepegawaian') is-invalid @enderror"
                                id="status_kepegawaian" name="status_kepegawaian" required>
                                <option value="0">-- Pilih Status Kepegawaian --</option>
                                <option value="1" {{ old('status_kepegawaian') == '1' ? 'selected' : '' }}>PNS
                                </option>
                                <option value="2" {{ old('status_kepegawaian') == '2' ? 'selected' : '' }}>PPPK
                                </option>
                                <option value="3" {{ old('status_kepegawaian') == '3' ? 'selected' : '' }}>Honorer
                                </option>
                                <option value="4" {{ old('status_kepegawaian') == '4' ? 'selected' : '' }}>Kontrak
                                </option>
                                <option value="5" {{ old('status_kepegawaian') == '5' ? 'selected' : '' }}>Tetap
                                </option>
                                <option value="6" {{ old('status_kepegawaian') == '6' ? 'selected' : '' }}>Tidak
                                    Tetap
                                </option>

                            </select>
                            @error('status_kepegawaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}">
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="nipppk" class="form-label">NIPPPK<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
                        <input type="text" class="form-control @error('nipppk') is-invalid @enderror" id="nipppk"
                            name="nipppk" placeholder="Masukkan NIPPPK" value="{{ old('nipppk') }}">
                        @error('nipppk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
                        <select class="form-select @error('jabatan') is-invalid @enderror" id="jabatan"
                            name="jabatan">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="1" {{ old('jabatan') == 'II/a' ? 'selected' : '' }}>II/a | Pengatur Muda
                            </option>
                            <option value="2" {{ old('jabatan') == 'II/b' ? 'selected' : '' }}>II/b | Pengatur Muda
                                Tk.
                                I</option>
                            <option value="3" {{ old('jabatan') == 'II/c' ? 'selected' : '' }}>II/c | Pengatur
                            </option>
                            <option value="4" {{ old('jabatan') == 'II/d' ? 'selected' : '' }}>II/d | Pengatur Tk. I
                            </option>
                            <option value="5" {{ old('jabatan') == 'III/a' ? 'selected' : '' }}>III/a | Penata Muda
                            </option>
                            <option value="6" {{ old('jabatan') == 'III/b' ? 'selected' : '' }}>III/b | Penata Muda
                                Tk. I
                            </option>
                            <option value="7" {{ old('jabatan') == 'III/c' ? 'selected' : '' }}>III/c | Penata
                            </option>
                            <option value="8" {{ old('jabatan') == 'III/d' ? 'selected' : '' }}>III/d | Penata Tk. I
                            </option>
                            <option value="9" {{ old('jabatan') == 'IV/a' ? 'selected' : '' }}>IV/a | Pembina
                            </option>
                            <option value="10" {{ old('jabatan') == 'IV/b' ? 'selected' : '' }}>IV/b | Pembina Tk. I
                            </option>
                            <option value="11" {{ old('jabatan') == 'IV/c' ? 'selected' : '' }}>IV/c | Pembina Utama
                                Muda
                            </option>
                            <option value="12" {{ old('jabatan') == 'IV/d' ? 'selected' : '' }}>IV/d | Pembina Utama
                                Madya</option>
                            <option value="13" {{ old('jabatan') == 'IV/e' ? 'selected' : '' }}>IV/e | Pembina Utama
                            </option>
                        </select>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="permulaan_kerja" class="form-label">Tgl. Permulaan Kerja</label>
                        <input type="date" class="form-control @error('permulaan_kerja') is-invalid @enderror"
                            id="permulaan_kerja" name="permulaan_kerja" value="{{ old('permulaan_kerja') }}" required>
                        @error('permulaan_kerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="permulaan_kerja_sds2" class="form-label">Tgl. Permulaan Kerja (RASDA)</label>
                        <input type="date" class="form-control @error('permulaan_kerja_sds2') is-invalid @enderror"
                            id="permulaan_kerja_sds2" name="permulaan_kerja_sds2"
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
                        <label for="gelar_ijazah" class="form-label">Gelar Ijazah<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
                        <input type="text" class="form-control @error('gelar_ijazah') is-invalid @enderror"
                            id="gelar_ijazah" name="gelar_ijazah" placeholder="Masukkan gelar ijazah"
                            value="{{ old('gelar_ijazah') }}">
                        @error('gelar_ijazah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tahun_ijazah" class="form-label">Tahun Ijazah<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
                        <input type="number" class="form-control @error('tahun_ijazah') is-invalid @enderror"
                            id="tahun_ijazah" name="tahun_ijazah" placeholder="Masukkan tahun ijazah"
                            value="{{ old('tahun_ijazah') }}" min="1900" max="{{ date('Y') }}">
                        @error('tahun_ijazah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status_sertifikasi" class="form-label">Status Sertifikasi</label>
                        <select class="form-select @error('status_sertifikasi') is-invalid @enderror"
                            id="status_sertifikasi" name="status_sertifikasi" required>
                            <option value="0">-- Pilih Status Sertifikasi --</option>
                            <option value="1" {{ old('status_sertifikasi') == '1' ? 'selected' : '' }}>Sudah
                            </option>
                            <option value="2" {{ old('status_sertifikasi') == '2' ? 'selected' : '' }}>Belum
                            </option>
                        </select>
                        @error('status_sertifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tahun_sertifikasi" class="form-label">Tahun Sertifikasi<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
                        <input type="number" class="form-control @error('tahun_sertifikasi') is-invalid @enderror"
                            id="tahun_sertifikasi" name="tahun_sertifikasi" placeholder="Masukkan tahun sertifikasi"
                            value="{{ old('tahun_sertifikasi') }}" min="1900" max="{{ date('Y') }}">
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
                        <label for="no_sk" class="form-label">Nomor SK Terakhir<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
                        <input type="text" class="form-control @error('no_sk') is-invalid @enderror" id="no_sk"
                            name="no_sk" placeholder="Masukkan no. SK terakhir" value="{{ old('no_sk') }}">
                        @error('no_sk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tanggal_sk_terakhir" class="form-label">Tanggal SK Terakhir<span
                                class="text-muted mini-label ms-1">(Opsional)</span></label>
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
    <div class="text-end">
        <button type="button" class="btn btn-danger me-1" id="cancel-button" data-route="{{ route('pegawai.index') }}"
            data-bs-toggle="modal" data-bs-target="#cancel-modal">
            <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tambah
        </button>
    </div>
    </form>
    </div>
@endsection
