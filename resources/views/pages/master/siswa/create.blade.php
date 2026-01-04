@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0 fw-bold">Tambah {{ $judul }}</h5>
            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button" data-route="{{ route('siswa.index') }}"
                    data-bs-toggle="modal" data-bs-target="#cancel-modal">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </button>
            </div>
        </div>
        <hr>
        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data" id="formSiswa" novalidate>
            @csrf
            <ul class="nav nav-tabs" id="siswa-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-pribadi" data-bs-toggle="tab" data-bs-target="#content-pribadi"
                        type="button" role="tab">
                        Data Pribadi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-alamat" data-bs-toggle="tab" data-bs-target="#content-alamat"
                        type="button" role="tab">
                        Alamat
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-ortu" data-bs-toggle="tab" data-bs-target="#content-ortu"
                        type="button" role="tab">
                        Orang Tua
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-pendidikan" data-bs-toggle="tab" data-bs-target="#content-pendidikan"
                        type="button" role="tab">
                        Pendidikan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-bantuan" data-bs-toggle="tab" data-bs-target="#content-bantuan"
                        type="button" role="tab">
                        Bantuan
                    </button>
                </li>
            </ul>
            <div class="tab-content mt-3 mb-4" id="siswa-tab-content">
                <div class="tab-pane show active" id="content-pribadi" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" placeholder="Username login" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" required placeholder="Min. 6 karakter">
                                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye"></i></button>
                            </div>
                            @error('password')
                                <div class="small text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Konfirmasi Pass</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="konfirmasi_password"
                                    id="konfirmasi_password" required placeholder="Ulangi password">
                                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="text-muted opacity-25 my-1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror"
                                name="nama_siswa" value="{{ old('nama_siswa') }}" required>
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelas</label>
                            <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                                <option value="">Pilih Kelas...</option>
                                @foreach ($kelas as $_kelas)
                                    <option value="{{ $_kelas->id_kelas }}"
                                        {{ old('kelas_id') == $_kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $_kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                value="{{ old('nik') }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                                value="{{ old('nisn') }}" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIPD</label>
                            <input type="text" class="form-control @error('nipd') is-invalid @enderror" name="nipd"
                                value="{{ old('nipd') }}" required>
                            @error('nipd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                id="jenis_kelamin" required>
                                <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror" name="agama" required>
                                <option value="">Pilih Agama...</option>
                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agm)
                                    <option value="{{ $agm }}" {{ old('agama') == $agm ? 'selected' : '' }}>
                                        {{ $agm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KK</label>
                            <input type="text" class="form-control @error('no_kk') is-invalid @enderror"
                                name="no_kk" value="{{ old('no_kk') }}" required>
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted small">DATA FISIK</label></div>
                        <div class="col-md-3"><label class="form-label">Berat (kg)</label><input type="number"
                                step="0.1" class="form-control" name="berat_badan"
                                value="{{ old('berat_badan') }}"></div>
                        <div class="col-md-3"><label class="form-label">Tinggi (cm)</label><input type="number"
                                class="form-control" name="tinggi_badan" value="{{ old('tinggi_badan') }}"></div>
                        <div class="col-md-3"><label class="form-label">Lingkar Kepala</label><input type="number"
                                class="form-control" name="lingkar_kepala" value="{{ old('lingkar_kepala') }}"></div>
                        <div class="col-md-3"><label class="form-label">Jumlah Saudara</label><input type="number"
                                class="form-control" name="jumlah_saudara_kandung"
                                value="{{ old('jumlah_saudara_kandung') }}"></div>
                        <div class="col-md-6"><label class="form-label">Anak Ke-</label><input type="number"
                                class="form-control" name="anak_ke_berapa" value="{{ old('anak_ke_berapa') }}"></div>
                        <div class="col-md-6"><label class="form-label">No. Reg Akta Lahir</label><input type="text"
                                class="form-control" name="no_registrasi_akta_lahir"
                                value="{{ old('no_registrasi_akta_lahir') }}"></div>
                        <div class="col-md-4">
                            <label class="form-label">Berkebutuhan Khusus</label>
                            <select class="form-select" name="disabilitas">
                                @foreach (['Tidak', 'Netra', 'Rungu', 'Grahita', 'Daksa', 'Laras', 'Wicara', 'Tuna Ganda', 'Hiperaktif', 'Cerdas Istimewa', 'Bakat Istimewa', 'Kesulitan Belajar', 'Lainnya'] as $dis)
                                    <option value="{{ $dis }}"
                                        {{ old('disabilitas') == $dis ? 'selected' : '' }}>{{ $dis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Keterangan Disabilitas (Jika ada)</label>
                            <input type="text" class="form-control" name="keterangan_disabilitas"
                                value="{{ old('keterangan_disabilitas') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <img class="foto mt-2 mb-3 d-none" id="image-preview">
                            <button type="button" class="btn btn-danger btn-sm d-block mx-auto mb-4 d-none"
                                id="image-delete-button"><i class="bi bi-trash me-2"></i> Hapus</button>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror image-input"
                                id="foto" name="foto">
                            <span class="text-muted d-block mini-label mt-1">Format .jpg/.png/.jpeg | Ukuran maksimal 2
                                MB</span>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="button" class="btn btn-primary px-4 btn-nav" data-next="#content-alamat">
                                Selanjutnya <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="content-alamat" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap (Jalan/Gang)</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">RT</label><input type="text"
                                class="form-control" name="rt" value="{{ old('rt') }}"></div>
                        <div class="col-md-6"><label class="form-label">RW</label><input type="text"
                                class="form-control" name="rw" value="{{ old('rw') }}"></div>
                        <div class="col-md-6"><label class="form-label">Dusun</label><input type="text"
                                class="form-control" name="dusun" value="{{ old('dusun') }}"></div>
                        <div class="col-md-6"><label class="form-label">Kelurahan</label><input type="text"
                                class="form-control" name="kelurahan" value="{{ old('kelurahan') }}"></div>
                        <div class="col-md-6"><label class="form-label">Kecamatan</label><input type="text"
                                class="form-control" name="kecamatan" value="{{ old('kecamatan') }}"></div>
                        <div class="col-md-6"><label class="form-label">Kode Pos</label><input type="text"
                                class="form-control" name="kode_pos" value="{{ old('kode_pos') }}"></div>
                        <div class="col-md-6"><label class="form-label">Lintang</label><input type="text"
                                class="form-control" name="lintang" value="{{ old('lintang') }}"></div>
                        <div class="col-md-6"><label class="form-label">Bujur</label><input type="text"
                                class="form-control" name="bujur" value="{{ old('bujur') }}"></div>
                        <div class="col-12">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_tinggal" class="form-label">Jenis Tinggal</label>
                            <select class="form-select @error('jenis_tinggal') is-invalid @enderror" name="jenis_tinggal"
                                id="jenis_tinggal" required>
                                <option value="" selected disabled>-- Pilih Jenis Tinggal --</option>
                                <option value="Bersama Orang Tua"
                                    {{ old('jenis_tinggal') == 'Bersama Orang Tua' ? 'selected' : '' }}>Bersama Orang Tua
                                </option>
                                <option value="Wali" {{ old('jenis_tinggal') == 'Wali' ? 'selected' : '' }}>Wali
                                </option>
                                <option value="Kos" {{ old('jenis_tinggal') == 'Kos' ? 'selected' : '' }}>Kos</option>
                                <option value="Asrama" {{ old('jenis_tinggal') == 'Asrama' ? 'selected' : '' }}>Asrama
                                </option>
                                <option value="Panti Asuhan"
                                    {{ old('jenis_tinggal') == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                                <option value="Lainnya" {{ old('jenis_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('jenis_tinggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_tinggal" class="form-label">Jenis Tinggal</label>
                            <select class="form-select @error('jenis_tinggal') is-invalid @enderror" name="jenis_tinggal"
                                id="jenis_tinggal" required>
                                <option value="" selected disabled>-- Pilih Jenis Tinggal --</option>
                                <option value="Bersama Orang Tua"
                                    {{ old('jenis_tinggal') == 'Bersama Orang Tua' ? 'selected' : '' }}>Bersama Orang Tua
                                </option>
                                <option value="Wali" {{ old('jenis_tinggal') == 'Wali' ? 'selected' : '' }}>Wali
                                </option>
                                <option value="Kos" {{ old('jenis_tinggal') == 'Kos' ? 'selected' : '' }}>Kos</option>
                                <option value="Asrama" {{ old('jenis_tinggal') == 'Asrama' ? 'selected' : '' }}>Asrama
                                </option>
                                <option value="Panti Asuhan"
                                    {{ old('jenis_tinggal') == 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                                <option value="Lainnya" {{ old('jenis_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('jenis_tinggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
                            <input type="number" step="0.01" name="jarak_rumah_ke_sekolah"
                                class="form-control @error('jarak_rumah_ke_sekolah') is-invalid @enderror"
                                value="{{ old('jarak_rumah_ke_sekolah') }}" placeholder="Contoh: 1.5">

                            @error('jarak_rumah_ke_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Telp Rumah</label>
                            <input type="text" class="form-control" name="no_telepon_rumah"
                                value="{{ old('no_telepon_rumah') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No HP (WA)</label>
                            <input type="text" class="form-control @error('no_telepon_seluler') is-invalid @enderror"
                                name="no_telepon_seluler" value="{{ old('no_telepon_seluler') }}" required>
                            @error('no_telepon_seluler')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">E-Mail</label>
                            <input type="email" class="form-control @error('e_mail') is-invalid @enderror"
                                name="e_mail" value="{{ old('e_mail') }}">
                            @error('e_mail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-2 btn-nav"
                                data-next="#content-pribadi">Sebelumnya</button>
                            <button type="button" class="btn btn-primary px-4 btn-nav"
                                data-next="#content-ortu">Selanjutnya <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="content-ortu" role="tabpanel">
                    <ul class="nav nav-tabs mb-3" id="ortuTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#form-ayah">Data
                                Ayah</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#form-ibu">Data Ibu</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#form-wali">Data Wali</a>
                        </li>
                    </ul>
                    <div class="tab-content border p-3 rounded bg-white shadow-sm mb-3" id="ortuTabContent">
                        <div class="tab-pane fade show active" id="form-ayah">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Ayah</label><input type="text"
                                        class="form-control" name="nama_ayah" value="{{ old('nama_ayah') }}"></div>
                                <div class="col-md-6"><label class="form-label">NIK Ayah</label><input type="text"
                                        class="form-control" name="nik_ayah" value="{{ old('nik_ayah') }}"></div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control" name="tahun_lahir_ayah"
                                        value="{{ old('tahun_lahir_ayah') }}"></div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}">
                                </div>
                                <div class="col-md-6"><label class="form-label">Pendidikan</label>
                                    <select class="form-select" name="jenjang_pendidikan_ayah">
                                        <option value="">Pilih...</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_ayah') == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select" name="penghasilan_ayah">
                                        <option value="">Pilih...</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_ayah') == $g ? 'selected' : '' }}>{{ $g }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="form-ibu">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Ibu</label><input type="text"
                                        class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}"></div>
                                <div class="col-md-6"><label class="form-label">NIK Ibu</label><input type="text"
                                        class="form-control" name="nik_ibu" value="{{ old('nik_ibu') }}"></div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control" name="tahun_lahir_ibu"
                                        value="{{ old('tahun_lahir_ibu') }}"></div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}">
                                </div>
                                <div class="col-md-6"><label class="form-label">Pendidikan</label>
                                    <select class="form-select" name="jenjang_pendidikan_ibu">
                                        <option value="">Pilih...</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_ibu') == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select" name="penghasilan_ibu">
                                        <option value="">Pilih...</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_ibu') == $g ? 'selected' : '' }}>{{ $g }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="form-wali">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Wali</label><input type="text"
                                        class="form-control" name="nama_wali" value="{{ old('nama_wali') }}"></div>
                                <div class="col-md-6"><label class="form-label">NIK Wali</label><input type="text"
                                        class="form-control" name="nik_wali" value="{{ old('nik_wali') }}"></div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control" name="tahun_lahir_wali"
                                        value="{{ old('tahun_lahir_wali') }}"></div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}">
                                </div>
                                <div class="col-md-6"><label class="form-label">Pendidikan</label>
                                    <select class="form-select" name="jenjang_pendidikan_wali">
                                        <option value="">Pilih...</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_wali') == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select" name="penghasilan_wali">
                                        <option value="">Pilih...</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_wali') == $g ? 'selected' : '' }}>{{ $g }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2 btn-nav"
                            data-next="#content-alamat">Sebelumnya</button>
                        <button type="button" class="btn btn-primary px-4 btn-nav"
                            data-next="#content-pendidikan">Selanjutnya <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
                <div class="tab-pane" id="content-pendidikan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Sekolah Asal</label>
                            <input type="text" class="form-control" name="sekolah_asal"
                                value="{{ old('sekolah_asal') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Peserta UN</label>
                            <input type="text" class="form-control" name="no_peserta_un"
                                value="{{ old('no_peserta_un') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Seri Ijazah</label>
                            <input type="text" class="form-control" name="no_seri_ijazah"
                                value="{{ old('no_seri_ijazah') }}">
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-2 btn-nav"
                                data-next="#content-ortu">Sebelumnya</button>
                            <button type="button" class="btn btn-primary px-4 btn-nav"
                                data-next="#content-bantuan">Selanjutnya <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="content-bantuan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Penerima KIP?</label>
                            <select class="form-select" name="penerima_kip">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. KIP</label>
                            <input type="text" class="form-control" name="no_kip" value="{{ old('no_kip') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama di KIP</label>
                            <input type="text" class="form-control" name="nama_kip" value="{{ old('nama_kip') }}">
                        </div>
                        <div class="col-md-12">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Layak PIP?</label>
                            <select class="form-select" name="layak_pip">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alasan Layak PIP</label>
                            <input type="text" class="form-control" name="alasan_layak_pip"
                                value="{{ old('alasan_layak_pip') }}">
                        </div>
                        <div class="col-md-12">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank"
                                value="{{ old('nama_bank') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Rekening</label>
                            <input type="text" class="form-control" name="no_rekening"
                                value="{{ old('no_rekening') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Atas Nama</label>
                            <input type="text" class="form-control" name="nama_rekening"
                                value="{{ old('nama_rekening') }}">
                        </div>
                        <input type="hidden" name="penerima_kps" value="Tidak">
                        <div class="col-12 text-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-2 btn-nav"
                                data-next="#content-pendidikan">Sebelumnya</button>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save me-2"></i> Simpan Data Siswa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                @vite('resources/js/pages/master/siswa.js')
            @endpush
        @endsection
