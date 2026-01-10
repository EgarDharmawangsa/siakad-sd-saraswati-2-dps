@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="d-flex justify-content-between mb-2 title-form-container">
            <h5 class="d-flex align-items-center mb-0">Tambah {{ $judul }}</h5>
            <button type="button" class="btn btn-danger" id="cancel-button" data-route="{{ route('siswa.index') }}"
                data-bs-toggle="modal" data-bs-target="#cancel-modal">
                <i class="bi bi-x-lg me-2"></i>Batal</button>
        </div>
        <hr>
        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data" id="formSiswa" novalidate>
            @csrf
            <ul class="nav nav-tabs" id="siswa-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-pribadi" data-bs-toggle="tab" data-bs-target="#content-pribadi"
                        type="button" role="tab">
                        Pribadi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-alamat" data-bs-toggle="tab" data-bs-target="#content-alamat"
                        type="button" role="tab">
                        Alamat
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-pendamping" data-bs-toggle="tab" data-bs-target="#content-pendamping"
                        type="button" role="tab">
                        Pendamping
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
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-akademik" data-bs-toggle="tab" data-bs-target="#content-akademik"
                        type="button" role="tab">
                        Akademik
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="siswa-tab-content">
                <div class="tab-pane fade show active" id="content-pribadi" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" required placeholder="Masukkan password (Min. 6 karakter)">
                                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye"></i></button>
                            </div>
                            @error('password')
                                <div class="small text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror"
                                name="nama_siswa" value="{{ old('nama_siswa') }}" placeholder="Masukkan nama siswa" required>
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                value="{{ old('nik') }}" placeholder="Masukkan NIK" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KK</label>
                            <input type="number" class="form-control @error('no_kk') is-invalid @enderror"
                                name="no_kk" value="{{ old('no_kk') }}" placeholder="Masukkan no. KK" required>
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NISN</label>
                            <input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                                value="{{ old('nisn') }}" placeholder="Masukkan NISN" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIPD</label>
                            <input type="number" class="form-control @error('nipd') is-invalid @enderror" name="nipd"
                                value="{{ old('nipd') }}" placeholder="Masukkan NIPD">
                            @error('nipd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Masukkan tanggal lahir" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                id="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror" name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                @foreach (['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agm)
                                    <option value="{{ $agm }}" {{ old('agama') == $agm ? 'selected' : '' }}>
                                        {{ $agm }}</option>
                                @endforeach
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_tinggal" class="form-label">Jenis Tinggal</label>
                            <select class="form-select @error('jenis_tinggal') is-invalid @enderror" name="jenis_tinggal"
                                id="jenis_tinggal" required>
                                <option value="">-- Pilih Jenis Tinggal --</option>
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
                            <label class="form-label">Alat Transportasi</label>
                            <select class="form-select @error('alat_transportasi') is-invalid @enderror" name="alat_transportasi" required>
                                <option value="">-- Pilih Alat Transportasi --</option>
                                @foreach (['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Angkutan Umum', 'Antar Jemput Sekolah', 'Ojek', 'Lainnya'] as $trp)
                                    <option value="{{ $trp }}" {{ old('alat_transportasi') == $trp ? 'selected' : '' }}>{{ $trp }}</option>
                                @endforeach
                            </select>
                            @error('alat_transportasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telp Rumah</label>
                            <input type="number" class="form-control @error('no_telepon_rumah') is-invalid @enderror" name="no_telepon_rumah"
                                value="{{ old('no_telepon_rumah') }}" placeholder="Masukkan no. telp rumah">
                            @error('no_telepon_rumah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. HP (WA)</label>
                            <input type="number" class="form-control @error('no_telepon_seluler') is-invalid @enderror"
                                name="no_telepon_seluler" value="{{ old('no_telepon_seluler') }}" placeholder="Masukkan no. HP" required>
                            @error('no_telepon_seluler')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">E-Mail</label>
                            <input type="email" class="form-control @error('e_mail') is-invalid @enderror"
                                name="e_mail" value="{{ old('e_mail') }}" placeholder="Masukkan e-mail">
                            @error('e_mail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Fisik & Disabilitas</label></div>
                        <div class="col-md-6"><label class="form-label">Berat Badan (kg)</label><input type="number"
                                step="0.1" class="form-control @error('berat_badan') is-invalid @enderror" name="berat_badan"
                                value="{{ old('berat_badan') }}" placeholder="Masukkan berat badan">
                            @error('berat_badan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Tinggi Badan (cm)</label><input type="number"
                                class="form-control @error('tinggi_badan') is-invalid @enderror" name="tinggi_badan" value="{{ old('tinggi_badan') }}" placeholder="Masukkan tinggi badan">
                        </div>
                            @error('tinggi_badan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        <div class="col-md-6"><label class="form-label">Lingkar Kepala (cm)</label><input type="number"
                                class="form-control @error('lingkar_kepala') is-invalid @enderror" name="lingkar_kepala" value="{{ old('lingkar_kepala') }}" placeholder="Masukkan lingkar kepala">
                            @error('lingkar_kepala')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Jumlah Saudara Kandung</label><input type="number"
                                class="form-control @error('jumlah_saudara_kandung') is-invalid @enderror" name="jumlah_saudara_kandung"
                                value="{{ old('jumlah_saudara_kandung') }}" placeholder="Masukkan jumlah saudara kandung">
                            @error('jumlah_saudara_kandung')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Anak Ke-</label><input type="number"
                                class="form-control @error('anak_ke_berapa') is-invalid @enderror" name="anak_ke_berapa" value="{{ old('anak_ke_berapa') }}" placeholder="Masukkan anak ke berapa">
                            @error('anak_ke_berapa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">No. Reg. Akta Lahir</label><input type="text"
                                class="form-control @error('no_registrasi_akta_lahir') is-invalid @enderror" name="no_registrasi_akta_lahir"
                                value="{{ old('no_registrasi_akta_lahir') }}" placeholder="Masukkan no. reg. akta lahir">
                            @error('no_registrasi_akta_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Disabilitas</label>
                            <select class="form-select @error('disabilitas') is-invalid @enderror" name="disabilitas" required>
                                @foreach (['Tidak', 'Netra', 'Rungu', 'Grahita', 'Daksa', 'Laras', 'Wicara', 'Tuna Ganda', 'Hiperaktif', 'Cerdas Istimewa', 'Bakat Istimewa', 'Kesulitan Belajar', 'Lainnya'] as $dis)
                                    <option value="{{ $dis }}"
                                        {{ old('disabilitas') === $dis ? 'selected' : '' }}>{{ $dis }}</option>
                                @endforeach
                            </select>
                            @error('disabilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Keterangan Disabilitas<span class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="text" class="form-control @error('keterangan_disabilitas') is-invalid @enderror" name="keterangan_disabilitas"
                                value="{{ old('keterangan_disabilitas') }}" placeholder="Masukkan keterangan disabilitas">
                        </div>
                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto<span
                                    class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <img class="foto mt-2 mb-3 d-none" id="image-preview">
                            <button type="button" class="btn btn-danger btn-sm d-block mx-auto mb-4 d-none"
                                id="image-delete-button"><i class="bi bi-trash me-2"></i> Hapus</button>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror image-input"
                                id="foto" name="foto">
                            <span class="text-muted d-block mini-label mt-1">Format .jpg/.png/.jpeg | Ukuran maksimal 2 MB</span>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-alamat">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="content-alamat" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap (Jalan/Gang)</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">RT</label><input type="text"
                                class="form-control @error('rt') is-invalid @enderror" name="rt" value="{{ old('rt') }}" placeholder="Masukkan RT">
                        @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">RW</label><input type="text"
                                class="form-control @error('rw') is-invalid @enderror" name="rw" value="{{ old('rw') }}" placeholder="Masukkan RW">
                        @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Dusun</label><input type="text"
                                class="form-control @error('dusun') is-invalid @enderror" name="dusun" value="{{ old('dusun') }}" placeholder="Masukkan dusun">
                        @error('dusun')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Kelurahan</label><input type="text"
                                class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ old('kelurahan') }}" placeholder="Masukkan kelurahan">
                        @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Kecamatan</label><input type="text"
                                class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ old('kecamatan') }}" placeholder="Masukkan kecamatan">
                        @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Kode Pos</label><input type="number"
                                class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}" placeholder="Masukkan kode pos">
                        @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Lintang</label><input type="number"
                                class="form-control @error('lintang') is-invalid @enderror" name="lintang" value="{{ old('lintang') }}" placeholder="Masukkan lintang">
                        @error('lintang')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">Bujur</label><input type="number"
                                class="form-control @error('bujur') is-invalid @enderror" name="bujur" value="{{ old('bujur') }}" placeholder="Masukkan bujur">
                        @error('bujur')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
                            <input type="number" step="0.01" name="jarak_rumah_ke_sekolah"
                            class="form-control @error('jarak_rumah_ke_sekolah') is-invalid @enderror"
                            value="{{ old('jarak_rumah_ke_sekolah') }}" placeholder="Masukkan jarak (contoh: 1.5)">
                            @error('jarak_rumah_ke_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-pribadi">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-pendamping">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="content-pendamping" role="tabpanel">
                    <ul class="nav nav-tabs mb-3" id="pendampingTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#form-ayah">Ayah</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#form-ibu">Ibu</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#form-wali">Wali</a>
                        </li>
                    </ul>
                    <div class="tab-content border px-3 pt-0 pb-3 rounded bg-white shadow-sm mb-3" id="pendampingTabContent">
                        <div class="tab-pane fade show active" id="form-ayah">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Ayah</label><input type="text"
                                        class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Masukkan nama ayah">
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror</div>
                                <div class="col-md-6"><label class="form-label">NIK Ayah</label><input type="number"
                                        class="form-control @error('nik_ayah') is-invalid @enderror" name="nik_ayah" value="{{ old('nik_ayah') }}" placeholder="Masukkan NIK ayah">
                                    @error('nik_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror</div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control @error('tahun_lahir_ayah') is-invalid @enderror" name="tahun_lahir_ayah"
                                        value="{{ old('tahun_lahir_ayah') }}" placeholder="Masukkan tahun lahir">
                                    @error('tahun_lahir_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror</div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="Masukkan pekerjaan">
                                    @error('pekerjaan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Jenjang Pendidikan</label>
                                    <select class="form-select @error('jenjang_pendidikan_ayah') is-invalid @enderror" name="jenjang_pendidikan_ayah">
                                        <option value="">-- Pilih Jenjang Pendidikan --</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_ayah') == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenjang_pendidikan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select @error('penghasilan_ayah') is-invalid @enderror" name="penghasilan_ayah">
                                        <option value="">-- Pilih Penghasilan --</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_ayah') == $g ? 'selected' : '' }}>{{ $g }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('penghasilan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="form-ibu">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Ibu</label><input type="text"
                                        class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Masukkan nama ibu">
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">NIK Ibu</label><input type="number"
                                        class="form-control @error('nik_ibu') is-invalid @enderror" name="nik_ibu" value="{{ old('nik_ibu') }}" placeholder="Masukkan NIK ibu">
                                    @error('nik_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror    
                                </div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control @error('tahun_lahir_ibu') is-invalid @enderror" name="tahun_lahir_ibu"
                                        value="{{ old('tahun_lahir_ibu') }}" placeholder="Masukkan tahun lahir">
                                    @error('tahun_lahir_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror    
                                </div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="Masukkan pekerjaan">
                                    @error('pekerjaan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Jenjang Pendidikan</label>
                                    <select class="form-select @error('jenjang_pendidikan_ibu') is-invalid @enderror" name="jenjang_pendidikan_ibu">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_ibu') == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenjang_pendidikan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select @error('penghasilan_ibu') is-invalid @enderror" name="penghasilan_ibu">
                                        <option value="">-- Pilih Penghasilan --</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_ibu') == $g ? 'selected' : '' }}>{{ $g }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('penghasilan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="form-wali">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Wali</label><input type="text"
                                        class="form-control @error('nama_wali') is-invalid @enderror" name="nama_wali" value="{{ old('nama_wali') }}" placeholder="Masukkan nama wali">
                                    @error('nama_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror    
                                </div>
                                <div class="col-md-6"><label class="form-label">NIK Wali</label><input type="number"
                                        class="form-control @error('nik_wali') is-invalid @enderror" name="nik_wali" value="{{ old('nik_wali') }}" placeholder="Masukkan NIK wali">
                                    @error('nik_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>  
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control @error('tahun_lahir_wali') is-invalid @enderror" name="tahun_lahir_wali"
                                        value="{{ old('tahun_lahir_wali') }}" placeholder="Masukkan tahun lahir">
                                    @error('tahun_lahir_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control @error('pekerjaan_wali') is-invalid @enderror" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}" placeholder="Masukkan pekerjaan">
                                    @error('pekerjaan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Jenjang Pendidikan</label>
                                    <select class="form-select @error('jenjang_pendidikan_wali') is-invalid @enderror" name="jenjang_pendidikan_wali">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_wali') == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenjang_pendidikan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select @error('penghasilan_wali') is-invalid @enderror" name="penghasilan_wali">
                                        <option value="">-- Pilih Penghasilan --</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_wali') == $g ? 'selected' : '' }}>{{ $g }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('penghasilan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-alamat">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-pendidikan">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="content-pendidikan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Sekolah Asal</label>
                            <input type="text" class="form-control @error('sekolah_asal') is-invalid @enderror" name="sekolah_asal"
                                value="{{ old('sekolah_asal') }}" placeholder="Masukkan sekolah asal">
                            @error('sekolah_asal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Peserta UN</label>
                            <input type="number" class="form-control @error('no_peserta_un') is-invalid @enderror" name="no_peserta_un"
                                value="{{ old('no_peserta_un') }}" placeholder="Masukkan no. peserta UN">
                            @error('no_peserta_un')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Seri Ijazah</label>
                            <input type="number" class="form-control @error('no_seri_ijazah') is-invalid @enderror" name="no_seri_ijazah"
                                value="{{ old('no_seri_ijazah') }}" placeholder="Masukkan no. seri ijazah">
                            @error('no_seri_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-pendamping">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-bantuan">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="content-bantuan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KPS</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Penerima KPS</label>
                            <select class="form-select @error('penerima_kps') is-invalid @enderror" name="penerima_kps" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tidak" {{ old('penerima_kps') === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                <option value="Ya" {{ old('penerima_kps') === 'Ya' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KPS</label>
                            <input type="number" class="form-control @error('no_kps') is-invalid @enderror" name="no_kps" value="{{ old('no_kps') }}" placeholder="Masukkan no. KPS">
                        </div>
                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KKS</label></div>
                        <div class="col-md-6">
                            <label class="form-label">No. KKS</label>
                            <input type="number" class="form-control @error('no_kks') is-invalid @enderror" name="no_kks" value="{{ old('no_kks') }}" placeholder="Masukkan no. KKS">
                        </div>
                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KIP</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Penerima KIP</label>
                            <select class="form-select @error('penerima_kip') is-invalid @enderror" name="penerima_kip" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tidak" {{ old('penerima_kip') === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                <option value="Ya" {{ old('penerima_kip') === 'Ya' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KIP</label>
                            <input type="number" class="form-control @error('no_kip') is-invalid @enderror" name="no_kip" value="{{ old('no_kip') }}" placeholder="Masukkan no. KIP">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama di KIP</label>
                            <input type="text" class="form-control @error('nama_kip') is-invalid @enderror" name="nama_kip" value="{{ old('nama_kip') }}" placeholder="Masukkan nama di KIP">
                        </div>
                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">PIP</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Layak PIP</label>
                            <select class="form-select @error('layak_pip') is-invalid @enderror" name="layak_pip" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tidak" {{ old('layak_pip') === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                <option value="Ya" {{ old('layak_pip') === 'Ya' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alasan Layak PIP</label>
                            <input type="text" class="form-control @error('alasan_layak_pip') is-invalid @enderror" name="alasan_layak_pip"
                                value="{{ old('alasan_layak_pip') }}" placeholder="Masukkan alasan layak PIP">
                        </div>
                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Bank</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Bank</label>
                            <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank"
                                value="{{ old('nama_bank') }}" placeholder="Masukkan nama bank">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Rekening</label>
                            <input type="number" class="form-control @error('no_rekening') is-invalid @enderror" name="no_rekening"
                                value="{{ old('no_rekening') }}" placeholder="Masukkan no. rekening">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Atas Nama</label>
                            <input type="text" class="form-control @error('nama_rekening') is-invalid @enderror" name="nama_rekening"
                                value="{{ old('nama_rekening') }}" placeholder="Masukkan atas nama">
                        </div>
                        <input type="hidden" name="penerima_kps" value="Tidak">
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-pendidikan">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-akademik">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="content-akademik" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Kelas</label></div>
                        <div class="col-md-4">
                            <label for="id-kelas" class="form-label">Kelas</label>
                            <select class="form-select @error('id_kelas') is-invalid @enderror" id="id-kelas" name="id_kelas"
                                {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                                <option value="">
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
                        <div class="col-md-4">
                            <label for="nomor-urut" class="form-label">Nomor Urut</label>
                            <input type="number" class="form-control @error('nomor_urut') is-invalid @enderror"
                                id="nomor-urut" name="nomor_urut" placeholder="Masukkan nomor urut"
                                value="{{ old('nomor_urut') }}" min="1" max="60">
                            @error('nomor_urut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-0">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Ekstrakurikuler</label></div>
                        <div class="col-md-4">
                            <label for="id-ekstrakurikuler" class="form-label">Ekstrakurikuler</label>
                            <div class="dropdown" id="id-ekstrakurikuler">
                                <button class="form-select text-start @error('id_ekstrakurikuler') is-invalid @enderror"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    id="id-ekstrakurikuler-dropdown-button"
                                    {{ $ekstrakurikuler->isEmpty() ? 'disabled' : '' }}>
                                    {{ $ekstrakurikuler->isNotEmpty() ? '-- Pilih Ekstrakurikuler --' : '-- Ekstrakurikuler Tidak Tersedia --' }}
                                </button>
                                <ul class="dropdown-menu w-100 p-2 dropdown-options-container"
                                    aria-labelledby="id-ekstrakurikuler-dropdown-button">
                                    @forelse ($ekstrakurikuler as $_ekstrakurikuler)
                                        <li><label class="dropdown-item"><input type="checkbox"
                                                    name="id_ekstrakurikuler[]"
                                                    class="form-check-input me-2 id-ekstrakurikuler-checkbox"
                                                    value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}"
                                                    {{ in_array($_ekstrakurikuler->id_ekstrakurikuler, old('id_ekstrakurikuler', [])) ? 'checked' : '' }}>{{ $_ekstrakurikuler->nama_ekstrakurikuler }}</label>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                            @error('id_ekstrakurikuler')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-bantuan">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="bi bi-plus-lg me-2"></i>Tambah
                        </button>
                    </div>
                </div>
            </div>
    </div>
    @push('scripts')
        @vite('resources/js/pages/master/siswa.js')
    @endpush
@endsection
