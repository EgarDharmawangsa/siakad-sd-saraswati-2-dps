@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="d-flex justify-content-between mb-2 title-form-container">
            <h5 class="d-flex align-items-center mb-0">Edit {{ $judul }}</h5>
            <button type="button" class="btn btn-danger" id="cancel-button" data-route="{{ route('siswa.index') }}"
                data-bs-toggle="modal" data-bs-target="#cancel-modal">
                <i class="bi bi-x-lg me-2"></i>Batal</button>
        </div>
        <hr>
        <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST" enctype="multipart/form-data"
            id="formSiswa" novalidate>
            @csrf
            @method('PUT')

            {{-- Navigasi Tab --}}
            <ul class="nav nav-tabs" id="siswa-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-pribadi" data-bs-toggle="tab" data-bs-target="#content-pribadi"
                        type="button" role="tab" aria-controls="content-pribadi" aria-selected="true">
                        Pribadi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-alamat" data-bs-toggle="tab" data-bs-target="#content-alamat"
                        type="button" role="tab" aria-controls="content-alamat" aria-selected="false">
                        Alamat
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-ortu" data-bs-toggle="tab" data-bs-target="#content-ortu"
                        type="button" role="tab" aria-controls="content-ortu" aria-selected="false">
                        Orang Tua
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-pendidikan" data-bs-toggle="tab" data-bs-target="#content-pendidikan"
                        type="button" role="tab" aria-controls="content-pendidikan" aria-selected="false">
                        Pendidikan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-bantuan" data-bs-toggle="tab" data-bs-target="#content-bantuan"
                        type="button" role="tab" aria-controls="content-bantuan" aria-selected="false">
                        Bantuan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-bantuan" data-bs-toggle="tab" data-bs-target="#content-akademik"
                        type="button" role="tab" aria-controls="content-akademik" aria-selected="false">
                        Akademik
                    </button>
                </li>
            </ul>

            {{-- Isi Konten Tab --}}
            <div class="tab-content" id="siswa-tab-content">

                {{-- 1. DATA PRIBADI --}}
                <div class="tab-pane fade show active" id="content-pribadi" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username', $siswa->userAuth->username ?? '') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Kosongkan jika tetap">
                                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye"></i></button>
                            </div>
                            @error('password')
                                <div class="small text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="konfirmasi_password"
                                    id="konfirmasi_password" placeholder="Ulangi password baru">
                                <button class="btn btn-outline-secondary" type="button"><i
                                        class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror"
                                name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                value="{{ old('nik', $siswa->nik) }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KK</label>
                            <input type="text" class="form-control @error('no_kk') is-invalid @enderror"
                                name="no_kk" value="{{ old('no_kk', $siswa->no_kk) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                                value="{{ old('nisn', $siswa->nisn) }}" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIPD</label>
                            <input type="text" class="form-control @error('nipd') is-invalid @enderror" name="nipd"
                                value="{{ old('nipd', $siswa->nipd) }}" required>
                            @error('nipd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                required>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror" name="agama" required>
                                <option value="">Pilih Agama</option>
                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agm)
                                    <option value="{{ $agm }}"
                                        {{ old('agama', $siswa->agama) == $agm ? 'selected' : '' }}>{{ $agm }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Tinggal</label>
                            <select class="form-select" name="jenis_tinggal" required>
                                @foreach (['Bersama Orang Tua', 'Wali', 'Asrama', 'Kost', 'Panti Asuhan', 'Lainnya'] as $jns)
                                    <option value="{{ $jns }}"
                                        {{ old('jenis_tinggal', $siswa->jenis_tinggal) == $jns ? 'selected' : '' }}>
                                        {{ $jns }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alat Transportasi</label>
                            <select class="form-select" name="alat_transportasi" required>
                                @foreach (['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Angkutan Umum', 'Antar Jemput Sekolah', 'Ojek', 'Lainnya'] as $trp)
                                    <option value="{{ $trp }}"
                                        {{ old('alat_transportasi', $siswa->alat_transportasi) == $trp ? 'selected' : '' }}>
                                        {{ $trp }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telp Rumah</label>
                            <input type="text" class="form-control" name="no_telepon_rumah"
                                value="{{ old('no_telepon_rumah', $siswa->no_telepon_rumah) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No HP (WA)</label>
                            <input type="text" class="form-control @error('no_telepon_seluler') is-invalid @enderror"
                                name="no_telepon_seluler"
                                value="{{ old('no_telepon_seluler', $siswa->no_telepon_seluler) }}" required>
                            @error('no_telepon_seluler')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">E-Mail</label>
                            <input type="email" class="form-control @error('e_mail') is-invalid @enderror"
                                name="e_mail" value="{{ old('e_mail', $siswa->e_mail) }}">
                            @error('e_mail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Fisik & Disabilitas</label></div>
                        <div class="col-md-3"><label class="form-label">Berat (kg)</label><input type="number"
                                step="0.1" class="form-control" name="berat_badan"
                                value="{{ old('berat_badan', $siswa->berat_badan) }}"></div>
                        <div class="col-md-3"><label class="form-label">Tinggi (cm)</label><input type="number"
                                class="form-control" name="tinggi_badan"
                                value="{{ old('tinggi_badan', $siswa->tinggi_badan) }}"></div>
                        <div class="col-md-3"><label class="form-label">Lingkar Kepala (cm)</label><input type="number"
                                class="form-control" name="lingkar_kepala"
                                value="{{ old('lingkar_kepala', $siswa->lingkar_kepala) }}"></div>
                        <div class="col-md-3"><label class="form-label">Jml Saudara</label><input type="number"
                                class="form-control" name="jumlah_saudara_kandung"
                                value="{{ old('jumlah_saudara_kandung', $siswa->jumlah_saudara_kandung) }}"></div>
                        <div class="col-md-6"><label class="form-label">Anak Ke-</label><input type="number"
                                class="form-control" name="anak_ke_berapa"
                                value="{{ old('anak_ke_berapa', $siswa->anak_ke_berapa) }}"></div>
                        <div class="col-md-6"><label class="form-label">No. Reg Akta Lahir</label><input type="text"
                                class="form-control" name="no_registrasi_akta_lahir"
                                value="{{ old('no_registrasi_akta_lahir', $siswa->no_registrasi_akta_lahir) }}"></div>

                        <div class="col-md-4">
                            <label class="form-label">Disabilitas</label>
                            <select class="form-select" name="disabilitas">
                                @foreach (['Tidak', 'Netra', 'Rungu', 'Grahita', 'Daksa', 'Laras', 'Wicara', 'Tuna Ganda', 'Hiperaktif', 'Cerdas Istimewa', 'Bakat Istimewa', 'Kesulitan Belajar', 'Lainnya'] as $dis)
                                    <option value="{{ $dis }}"
                                        {{ old('disabilitas', $siswa->disabilitas) == $dis ? 'selected' : '' }}>
                                        {{ $dis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Keterangan Disabilitas<span class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <input type="text" class="form-control" name="keterangan_disabilitas"
                                value="{{ old('keterangan_disabilitas', $siswa->keterangan_disabilitas) }}">
                        </div>

                        {{-- INPUT FOTO (DIPINDAHKAN KE SINI) --}}
                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto<span class="text-muted mini-label ms-1">(Opsional)</span></label>
                            <img src='{{ $siswa->foto ? asset("storage/{$siswa->foto}") : '' }}'
                                class="foto mt-2 mb-3 {{ $siswa->foto ? '' : 'd-none' }}" id="image-preview">
                            <button type="button"
                                class="btn btn-danger btn-sm d-block mx-auto mb-4 {{ $siswa->foto ? '' : 'd-none' }}"
                                id="image-delete-button"><i class="bi bi-trash me-2"></i>Hapus Foto</button>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror image-input"
                                id="foto" name="foto">
                            <span class="text-muted d-block mini-label mt-1">Format .jpg/.png/.jpeg | Ukuran maksimal 10 MB</span>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <input type="hidden" name="image_delete" id="image-delete" value="0">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-alamat">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                {{-- 2. ALAMAT --}}
                <div class="tab-pane fade" id="content-alamat" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap (Jalan/Gang)</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="form-label">RT</label><input type="text"
                                class="form-control" name="rt" value="{{ old('rt', $siswa->rt) }}"></div>
                        <div class="col-md-6"><label class="form-label">RW</label><input type="text"
                                class="form-control" name="rw" value="{{ old('rw', $siswa->rw) }}"></div>
                        <div class="col-md-6"><label class="form-label">Dusun</label><input type="text"
                                class="form-control" name="dusun" value="{{ old('dusun', $siswa->dusun) }}"></div>
                        <div class="col-md-6"><label class="form-label">Kelurahan</label><input type="text"
                                class="form-control" name="kelurahan" value="{{ old('kelurahan', $siswa->kelurahan) }}">
                        </div>
                        <div class="col-md-6"><label class="form-label">Kecamatan</label><input type="text"
                                class="form-control" name="kecamatan" value="{{ old('kecamatan', $siswa->kecamatan) }}">
                        </div>
                        <div class="col-md-6"><label class="form-label">Kode Pos</label><input type="text"
                                class="form-control" name="kode_pos" value="{{ old('kode_pos', $siswa->kode_pos) }}">
                        </div>
                        <div class="col-md-6"><label class="form-label">Lintang</label><input type="text"
                                class="form-control" name="lintang" value="{{ old('lintang', $siswa->lintang) }}"></div>
                        <div class="col-md-6"><label class="form-label">Bujur</label><input type="text"
                                class="form-control" name="bujur" value="{{ old('bujur', $siswa->bujur) }}"></div>
                        <div class="col-md-6">
                            <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
                            <input type="number" step="0.01" name="jarak_rumah_ke_sekolah"
                                class="form-control @error('jarak_rumah_ke_sekolah') is-invalid @enderror"
                                value="{{ old('jarak_rumah_ke_sekolah', $siswa->jarak_rumah_ke_sekolah) }}"
                                placeholder="Contoh: 1.5">
                            @error('jarak_rumah_ke_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-pribadi">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-ortu">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                {{-- 3. ORANG TUA --}}
                <div class="tab-pane fade" id="content-ortu" role="tabpanel">
                    <ul class="nav nav-tabs mb-3" id="ortuTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#form-ayah">Data
                                Ayah</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#form-ibu">Data Ibu</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#form-wali">Data Wali</a>
                        </li>
                    </ul>
                    <div class="tab-content border px-3 pt-0 pb-3 rounded bg-white shadow-sm mb-3" id="ortuTabContent">
                        {{-- Form Ayah --}}
                        <div class="tab-pane fade show active" id="form-ayah">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Ayah</label><input type="text"
                                        class="form-control" name="nama_ayah"
                                        value="{{ old('nama_ayah', $siswa->nama_ayah) }}"></div>
                                <div class="col-md-6"><label class="form-label">NIK Ayah</label><input type="text"
                                        class="form-control" name="nik_ayah"
                                        value="{{ old('nik_ayah', $siswa->nik_ayah) }}"></div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control" name="tahun_lahir_ayah"
                                        value="{{ old('tahun_lahir_ayah', $siswa->tahun_lahir_ayah) }}"></div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control" name="pekerjaan_ayah"
                                        value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}"></div>
                                <div class="col-md-6"><label class="form-label">Pendidikan</label>
                                    <select class="form-select" name="jenjang_pendidikan_ayah">
                                        <option value="">Pilih...</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2', 'S3'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_ayah', $siswa->jenjang_pendidikan_ayah) == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select" name="penghasilan_ayah">
                                        <option value="">Pilih...</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_ayah', $siswa->penghasilan_ayah) == $g ? 'selected' : '' }}>
                                                {{ $g }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Form Ibu --}}
                        <div class="tab-pane fade" id="form-ibu">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Ibu</label><input type="text"
                                        class="form-control" name="nama_ibu"
                                        value="{{ old('nama_ibu', $siswa->nama_ibu) }}"></div>
                                <div class="col-md-6"><label class="form-label">NIK Ibu</label><input type="text"
                                        class="form-control" name="nik_ibu"
                                        value="{{ old('nik_ibu', $siswa->nik_ibu) }}"></div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control" name="tahun_lahir_ibu"
                                        value="{{ old('tahun_lahir_ibu', $siswa->tahun_lahir_ibu) }}"></div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control" name="pekerjaan_ibu"
                                        value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}"></div>
                                <div class="col-md-6"><label class="form-label">Pendidikan</label>
                                    <select class="form-select" name="jenjang_pendidikan_ibu">
                                        <option value="">Pilih...</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2', 'S3'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_ibu', $siswa->jenjang_pendidikan_ibu) == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select" name="penghasilan_ibu">
                                        <option value="">Pilih...</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_ibu', $siswa->penghasilan_ibu) == $g ? 'selected' : '' }}>
                                                {{ $g }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Form Wali --}}
                        <div class="tab-pane fade" id="form-wali">
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Nama Wali</label><input type="text"
                                        class="form-control" name="nama_wali"
                                        value="{{ old('nama_wali', $siswa->nama_wali) }}"></div>
                                <div class="col-md-6"><label class="form-label">NIK Wali</label><input type="text"
                                        class="form-control" name="nik_wali"
                                        value="{{ old('nik_wali', $siswa->nik_wali) }}"></div>
                                <div class="col-md-6"><label class="form-label">Tahun Lahir</label><input type="number"
                                        class="form-control" name="tahun_lahir_wali"
                                        value="{{ old('tahun_lahir_wali', $siswa->tahun_lahir_wali) }}"></div>
                                <div class="col-md-6"><label class="form-label">Pekerjaan</label><input type="text"
                                        class="form-control" name="pekerjaan_wali"
                                        value="{{ old('pekerjaan_wali', $siswa->pekerjaan_wali) }}"></div>
                                <div class="col-md-6"><label class="form-label">Pendidikan</label>
                                    <select class="form-select" name="jenjang_pendidikan_wali">
                                        <option value="">Pilih...</option>
                                        @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2', 'S3'] as $p)
                                            <option value="{{ $p }}"
                                                {{ old('jenjang_pendidikan_wali', $siswa->jenjang_pendidikan_wali) == $p ? 'selected' : '' }}>
                                                {{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6"><label class="form-label">Penghasilan</label>
                                    <select class="form-select" name="penghasilan_wali">
                                        <option value="">Pilih...</option>
                                        @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                            <option value="{{ $g }}"
                                                {{ old('penghasilan_wali', $siswa->penghasilan_wali) == $g ? 'selected' : '' }}>
                                                {{ $g }}</option>
                                        @endforeach
                                    </select>
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

                {{-- 4. PENDIDIKAN --}}
                <div class="tab-pane fade" id="content-pendidikan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Sekolah Asal</label>
                            <input type="text" class="form-control" name="sekolah_asal"
                                value="{{ old('sekolah_asal', $siswa->sekolah_asal) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Peserta UN</label>
                            <input type="text" class="form-control" name="no_peserta_un"
                                value="{{ old('no_peserta_un', $siswa->no_peserta_un) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Seri Ijazah</label>
                            <input type="text" class="form-control" name="no_seri_ijazah"
                                value="{{ old('no_seri_ijazah', $siswa->no_seri_ijazah) }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-ortu">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-primary btn-nav" data-next="#content-bantuan">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                {{-- 5. BANTUAN --}}
                <div class="tab-pane fade" id="content-bantuan" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KIP</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Penerima KIP?</label>
                            <select class="form-select" name="penerima_kip">
                                <option value="Tidak"
                                    {{ old('penerima_kip', $siswa->penerima_kip) == 'Tidak' ? 'selected' : '' }}>Tidak
                                </option>
                                <option value="Ya"
                                    {{ old('penerima_kip', $siswa->penerima_kip) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KIP</label>
                            <input type="text" class="form-control" name="no_kip"
                                value="{{ old('no_kip', $siswa->no_kip) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama di KIP</label>
                            <input type="text" class="form-control" name="nama_kip"
                                value="{{ old('nama_kip', $siswa->nama_kip) }}">
                        </div>

                        <div class="col-md-12">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">PIP</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Layak PIP?</label>
                            <select class="form-select" name="layak_pip">
                                <option value="Tidak"
                                    {{ old('layak_pip', $siswa->layak_pip) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                <option value="Ya"
                                    {{ old('layak_pip', $siswa->layak_pip) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alasan Layak PIP</label>
                            <input type="text" class="form-control" name="alasan_layak_pip"
                                value="{{ old('alasan_layak_pip', $siswa->alasan_layak_pip) }}">
                        </div>
                        <div class="col-md-12">
                            <hr class="text-muted opacity-25">
                        </div>
                        <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Bank</label></div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank"
                                value="{{ old('nama_bank', $siswa->nama_bank) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Rekening</label>
                            <input type="text" class="form-control" name="no_rekening"
                                value="{{ old('no_rekening', $siswa->no_rekening) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Atas Nama</label>
                            <input type="text" class="form-control" name="nama_rekening"
                                value="{{ old('nama_rekening', $siswa->nama_rekening) }}">
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

                {{-- 5. BANTUAN --}}
                <div class="tab-pane fade" id="content-akademik" role="tabpanel">
                    <div class="row g-3">
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
                                    @php
                                        $selected_ekstrakurikuler = old('id_ekstrakurikuler', $siswa->pesertaEkstrakurikuler?->pluck('id_ekstrakurikuler')->toArray() ?? []);
                                    @endphp
                                    @forelse ($ekstrakurikuler as $_ekstrakurikuler)
                                        <li><label class="dropdown-item"><input type="checkbox"
                                                    name="id_ekstrakurikuler[]"
                                                    class="form-check-input me-2 id-ekstrakurikuler-checkbox"
                                                    value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}"
                                                    {{ in_array($_ekstrakurikuler->id_ekstrakurikuler, $selected_ekstrakurikuler) ? 'checked' : '' }}>{{ $_ekstrakurikuler->nama_ekstrakurikuler }}</label>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                            @error('id_ekstrakurikuler')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="id-kelas" class="form-label">Kelas</label>
                            <select class="form-select @error('id_kelas') is-invalid @enderror" id="id-kelas" name="id_kelas"
                                {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                                <option value="">
                                    {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}</option>
                                @foreach ($kelas as $_kelas)
                                    <option value="{{ $_kelas->id_kelas }}"
                                        {{ old('id_kelas', $siswa->id_kelas) == $_kelas->id_kelas ? 'selected' : '' }}>{{ $_kelas->nama_kelas }}
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
                                value="{{ old('nomor_urut', $siswa->nomor_urut) }}" min="1" max="60">
                            @error('nomor_urut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-nav" data-next="#content-bantuan">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="submit" class="btn btn-primary ms-2">
                            <i class="bi bi-pencil me-2"></i>Perbarui
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Inline Script untuk Handle Foto di Halaman Ini --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtn = document.getElementById('image-delete-button');
            const deleteInput = document.getElementById('image-delete');
            const fileInput = document.getElementById('foto');
            const preview = document.getElementById('image-preview');

            // Handle Tombol Hapus
            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    if (deleteInput) deleteInput.value = '1';
                    if (fileInput) fileInput.value = '';
                    if (preview) {
                        preview.src = '';
                        preview.classList.add('d-none');
                    }
                    this.classList.add('d-none');
                });
            }

            // Handle Input File Change (Preview)
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    const [file] = this.files;
                    if (file) {
                        if (preview) {
                            preview.src = URL.createObjectURL(file);
                            preview.classList.remove('d-none');
                        }
                        if (deleteBtn) deleteBtn.classList.remove('d-none');
                        if (deleteInput) deleteInput.value = '0';
                    }
                });
            }
        });
    </script>
@endsection

@push('scripts')
    @vite('resources/js/pages/master/siswa.js')
@endpush
