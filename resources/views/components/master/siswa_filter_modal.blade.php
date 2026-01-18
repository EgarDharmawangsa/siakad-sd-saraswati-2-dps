<div class="modal fade" id="filter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="filter-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filter-modal-label">Filter Siswa</h5>
                <button type="button" id="filter-modal-close-button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filter-modal-form" action="{{ route('siswa.index') }}">
                    <div class="mb-3">
                        <label for="kelas-filter" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas-filter" name="kelas_filter"
                            {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                            <option value="">
                                {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}
                            </option>
                            @foreach ($kelas as $_kelas)
                                <option value="{{ $_kelas->id_kelas }}"
                                    {{ request('kelas_filter') == $_kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $_kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nisn-filter" class="form-label">NISN</label>
                        <input type="number" class="form-control" id="nisn-filter" name="nisn_filter" value="{{ request('nisn_filter') }}"
                            placeholder="Masukkan NISN">
                    </div>

                    <div class="mb-3">
                        <label for="nama-siswa-filter" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama-siswa-filter" name="nama_siswa_filter" value="{{ request('nama_siswa_filter') }}"
                            placeholder="Masukkan nama siswa">
                    </div>

                    <div class="mb-3">
                        <label for="jenis-kelamin-filter" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis-kelamin-filter" name="jenis_kelamin_filter">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki"
                                {{ request('jenis_kelamin_filter') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ request('jenis_kelamin_filter') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="agama-filter" class="form-label">Agama</label>
                        <select class="form-select" id="agama-filter" name="agama_filter">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam" {{ request('agama_filter') == 'Islam' ? 'selected' : '' }}>
                                Islam</option>
                            <option value="Kristen"
                                {{ request('agama_filter') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen
                            </option>
                            <option value="Katolik"
                                {{ request('agama_filter') == 'Kristen Katolik' ? 'selected' : '' }}>Katolik
                            </option>
                            <option value="Hindu" {{ request('agama_filter') == 'Hindu' ? 'selected' : '' }}>
                                Hindu</option>
                            <option value="Budha" {{ request('agama_filter') == 'Budha' ? 'selected' : '' }}>
                                Budha</option>
                            <option value="Konghucu"
                                {{ request('agama_filter') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="no-telepon-seluler-filter" class="form-label">No. HP (WA)</label>
                        <input type="number" class="form-control" id="no-telepon-seluler-filter" name="no_telepon_seluler_filter"
                            value="{{ request('no_telepon_seluler_filter') }}" placeholder="Masukkan no. hp">
                    </div>

                    <div class="mb-3">
                        <label for="alamat-filter" class="form-label">Alamat</label>
                        <input type="text" id="alamat-filter" class="form-control" name="alamat_filter"
                            value="{{ request('alamat_filter') }}" placeholder="Masukkan alamat">
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label">Ekstrakurikuler</label>
                        <select class="form-select" name="ekstrakurikuler_filter"
                            {{ $ekstrakurikuler->isEmpty() ? 'disabled' : '' }}>
                            <option value="">
                                {{ $ekstrakurikuler->isNotEmpty() ? '-- Pilih Ekstrakurikuler --' : '-- Ekstrakurikuler Tidak Tersedia --' }}
                            </option>
                            @foreach ($ekstrakurikuler as $_ekstrakurikuler)
                                <option value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}"
                                    {{ request('ekstrakurikuler_filter') == $_ekstrakurikuler->id_ekstrakurikuler ? 'selected' : '' }}>
                                    {{ $_ekstrakurikuler->nama_ekstrakurikuler }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <ul class="nav nav-tabs mt-2" id="siswa-filter-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-pribadi-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-pribadi" type="button">Pribadi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-alamat-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-alamat" type="button">Alamat</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-pendamping-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-pendamping" type="button">Pendamping</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-pendidikan-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-pendidikan" type="button">Pendidikan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-bantuan-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-bantuan" type="button">Bantuan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-akademik-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-akademik" type="button">Akademik</button>
                        </li>
                    </ul> --}}

                    {{-- <div class="tab-content mb-0" id="siswa-tab-content">
                        <div class="tab-pane fade show active" id="tab-pribadi" role="tabpanel">
                            <div class="row g-3 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        value="{{ request('username') }}" placeholder="Masukkan username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <input type="number" class="form-control" name="nik"
                                        value="{{ request('nik') }}" placeholder="Masukkan NIK">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. KK</label>
                                    <input type="number" class="form-control" name="no_kk"
                                        value="{{ request('no_kk') }}" placeholder="Masukkan no. KK">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NISN</label>
                                    <input type="number" class="form-control" name="nisn"
                                        value="{{ request('nisn') }}" placeholder="Masukkan NISN">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIPD</label>
                                    <input type="number" class="form-control" name="nipd"
                                        value="{{ request('nipd') }}" placeholder="Masukkan NIPD">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa"
                                        value="{{ request('nama_siswa') }}" placeholder="Masukkan nama siswa">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ request('tempat_lahir') }}" placeholder="Masukkan tempat lahir">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ request('tanggal_lahir') }}" placeholder="Masukkan tanggal lahir">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki"
                                            {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Agama</label>
                                    <select class="form-select" name="agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="Kristen"
                                            {{ request('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen
                                        </option>
                                        <option value="Katolik"
                                            {{ request('agama') == 'Kristen Katolik' ? 'selected' : '' }}>Katolik
                                        </option>
                                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="Budha" {{ request('agama') == 'Budha' ? 'selected' : '' }}>
                                            Budha</option>
                                        <option value="Konghucu"
                                            {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Disabilitas</label>
                                    <select class="form-select" name="disabilitas">
                                        @foreach (['Tidak', 'Netra', 'Rungu', 'Grahita', 'Daksa', 'Laras', 'Wicara', 'Tuna Ganda', 'Hiperaktif', 'Cerdas Istimewa', 'Bakat Istimewa', 'Kesulitan Belajar', 'Lainnya'] as $dis)
                                            <option value="{{ $dis }}"
                                                {{ request('disabilitas') === $dis ? 'selected' : '' }}>
                                                {{ $dis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Tinggal</label>
                                    <select class="form-select" name="jenis_tinggal">
                                        <option value="">-- Pilih Jenis Tinggal --</option>
                                        <option value="Bersama Orang Tua"
                                            {{ request('jenis_tinggal') == 'Bersama Orang Tua' ? 'selected' : '' }}>
                                            Bersama Orang Tua
                                        </option>
                                        <option value="Wali"
                                            {{ request('jenis_tinggal') == 'Wali' ? 'selected' : '' }}>Wali
                                        </option>
                                        <option value="Kos"
                                            {{ request('jenis_tinggal') == 'Kos' ? 'selected' : '' }}>Kos</option>
                                        <option value="Asrama"
                                            {{ request('jenis_tinggal') == 'Asrama' ? 'selected' : '' }}>Asrama
                                        </option>
                                        <option value="Panti Asuhan"
                                            {{ request('jenis_tinggal') == 'Panti Asuhan' ? 'selected' : '' }}>Panti
                                            Asuhan</option>
                                        <option value="Lainnya"
                                            {{ request('jenis_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alat Transportasi</label>
                                    <select class="form-select" name="alat_transportasi">
                                        <option value="">-- Pilih Alat Transportasi --</option>
                                        <option value="">-- Pilih Alat Transportasi --</option>
                                        @foreach (['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Angkutan Umum', 'Antar Jemput Sekolah', 'Ojek', 'Lainnya'] as $trp)
                                            <option value="{{ $trp }}"
                                                {{ request('alat_transportasi') == $trp ? 'selected' : '' }}>
                                                {{ $trp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telp. Rumah</label>
                                    <input type="number" class="form-control" name="no_telepon_rumah"
                                        value="{{ request('no_telepon_rumah') }}"
                                        placeholder="Masukkan no. telp. rumah">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. HP (WA)</label>
                                    <input type="number" class="form-control" name="no_telepon_seluler"
                                        value="{{ request('no_telepon_seluler') }}" placeholder="Masukkan no. hp">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">E-Mail</label>
                                    <input type="text" class="form-control" name="e_mail"
                                        value="{{ request('e_mail') }}" placeholder="Masukkan e-mail">
                                </div>
                                <div class="col-md-12 mt-0">
                                    <hr class="text-muted opacity-25">
                                </div>
                                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Fisik &
                                        Disabilitas</label></div>
                                <div class="col-md-4">
                                    <label class="form-label">Berat Badan (kg)</label>
                                    <input type="number" step="0.01" class="form-control" name="berat_badan"
                                        value="{{ request('berat_badan') }}" placeholder="Masukkan berat badan">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" step="0.01" class="form-control" name="tinggi_badan"
                                        value="{{ request('tinggi_badan') }}" placeholder="Masukkan tinggi badan">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Lingkar Kepala (cm)</label>
                                    <input type="number" step="0.01" class="form-control" name="lingkar_kepala"
                                        value="{{ request('lingkar_kepala') }}"
                                        placeholder="Masukkan lingkar kepala">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Saudara Kandung</label>
                                    <input type="number" class="form-control" name="jumlah_saudara_kandung"
                                        value="{{ request('jumlah_saudara_kandung') }}"
                                        placeholder="Masukkan jumlah saudara kandung">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Anak Ke-</label>
                                    <input type="number" class="form-control" name="anak_ke_berapa"
                                        value="{{ request('anak_ke_berapa') }}"
                                        placeholder="Masukkan anak ke berapa">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Reg. Akta Lahir</label>
                                    <input type="text" class="form-control" name="no_registrasi_akta_lahir"
                                        value="{{ request('no_registrasi_akta_lahir') }}"
                                        placeholder="Masukkan no. reg. akta lahir">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Disabilitas</label>
                                    <select class="form-select" name="disabilitas">
                                        @foreach (['Tidak', 'Netra', 'Rungu', 'Grahita', 'Daksa', 'Laras', 'Wicara', 'Tuna Ganda', 'Hiperaktif', 'Cerdas Istimewa', 'Bakat Istimewa', 'Kesulitan Belajar', 'Lainnya'] as $dis)
                                            <option value="{{ $dis }}"
                                                {{ request('disabilitas') === $dis ? 'selected' : '' }}>
                                                {{ $dis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Keterangan Disabilitas</label>
                                    <input type="text" class="form-control" name="keterangan_disabilitas"
                                        value="{{ request('keterangan_disabilitas') }}"
                                        placeholder="Masukkan keterangan disabilitas">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-alamat" role="tabpanel">
                            <div class="row g-3 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat"
                                        value="{{ request('alamat') }}" placeholder="Masukkan alamat">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RT</label>
                                    <input type="text" class="form-control" name="rt"
                                        value="{{ request('rt') }}" placeholder="Masukkan RT">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RW</label>
                                    <input type="text" class="form-control" name="rw"
                                        value="{{ request('rw') }}" placeholder="Masukkan RW">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Dusun</label>
                                    <input type="text" class="form-control" name="dusun"
                                        value="{{ request('dusun') }}" placeholder="Masukkan dusun">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan"
                                        value="{{ request('kelurahan') }}" placeholder="Masukkan kelurahan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan"
                                        value="{{ request('kecamatan') }}" placeholder="Masukkan kecamatan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos"
                                        value="{{ request('kode_pos') }}" placeholder="Masukkan kode pos">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
                                    <input type="number" step="0.01" class="form-control"
                                        name="jarak_rumah_ke_sekolah" value="{{ request('jarak_rumah_ke_sekolah') }}"
                                        placeholder="Masukkan jarak (contoh: 1.5)">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-pendamping" role="tabpanel">
                            <ul class="nav nav-tabs mb-3" id="pendampingTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                        href="#detail-ayah">Ayah</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#detail-ibu">Ibu</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#detail-wali">Wali</a>
                                </li>
                            </ul>
                            <div class="tab-content border px-3 pt-0 pb-3 rounded bg-white shadow-sm mb-3"
                                id="pendampingTabContent">
                                <div class="tab-pane fade show active" id="detail-ayah">
                                    <div class="row g-3 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Ayah</label>
                                            <input type="text" class="form-control" name="nama_ayah"
                                                value="{{ request('nama_ayah') }}" placeholder="Masukkan nama ayah">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIK Ayah</label>
                                            <input type="number" class="form-control" name="nik_ayah"
                                                value="{{ request('nik_ayah') }}" placeholder="Masukkan NIK ayah">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tahun Lahir Ayah</label>
                                            <input type="number" class="form-control" name="tahun_lahir_ayah"
                                                value="{{ request('tahun_lahir_ayah') }}"
                                                placeholder="Masukkan tahun lahir ayah">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jenjang Pendidikan</label>
                                            <select class="form-select" name="jenjang_pendidikan_ayah">
                                                <option value="">-- Pilih Jenjang Pendidikan --</option>
                                                @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                                    <option value="{{ $p }}"
                                                        {{ request('jenjang_pendidikan_ayah') == $p ? 'selected' : '' }}>
                                                        {{ $p }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan_ayah"
                                                value="{{ request('pekerjaan_ayah') }}"
                                                placeholder="Masukkan pekerjaan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Penghasilan</label>
                                            <select class="form-select" name="penghasilan_ayah">
                                                <option value="">-- Pilih Penghasilan --</option>
                                                @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                                    <option value="{{ $g }}"
                                                        {{ request('penghasilan_ayah') == $g ? 'selected' : '' }}>
                                                        {{ $g }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="detail-ibu">
                                    <div class="row g-3 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Ibu</label>
                                            <input type="text" class="form-control" name="nama_ibu"
                                                value="{{ request('nama_ibu') }}" placeholder="Masukkan nama ibu">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIK Ibu</label>
                                            <input type="number" class="form-control" name="nik_ibu"
                                                value="{{ request('nik_ibu') }}" placeholder="Masukkan NIK ibu">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tahun Lahir Ibu</label>
                                            <input type="number" class="form-control" name="tahun_lahir_ibu"
                                                value="{{ request('tahun_lahir_ibu') }}"
                                                placeholder="Masukkan tahun lahir ibu">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jenjang Pendidikan</label>
                                            <select class="form-select" name="jenjang_pendidikan_ibu">
                                                <option value="">-- Pilih Jenjang Pendidikan --</option>
                                                @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                                    <option value="{{ $p }}"
                                                        {{ request('jenjang_pendidikan_ibu') == $p ? 'selected' : '' }}>
                                                        {{ $p }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan_ibu"
                                                value="{{ request('pekerjaan_ibu') }}"
                                                placeholder="Masukkan pekerjaan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Penghasilan</label>
                                            <select class="form-select" name="penghasilan_ibu">
                                                <option value="">-- Pilih Penghasilan --</option>
                                                @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                                    <option value="{{ $g }}"
                                                        {{ request('penghasilan_ibu') == $g ? 'selected' : '' }}>
                                                        {{ $g }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="detail-wali">
                                    <div class="row g-3 mb-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Ayah</label>
                                            <input type="text" class="form-control" name="nama_wali"
                                                value="{{ request('nama_wali') }}" placeholder="Masukkan nama wali">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIK wali</label>
                                            <input type="number" class="form-control" name="nik_wali"
                                                value="{{ request('nik_wali') }}" placeholder="Masukkan NIK wali">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tahun Lahir Wali</label>
                                            <input type="number" class="form-control" name="tahun_lahir_wali"
                                                value="{{ request('tahun_lahir_wali') }}"
                                                placeholder="Masukkan tahun lahir wali">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jenjang Pendidikan</label>
                                            <select class="form-select" name="jenjang_pendidikan_wali">
                                                <option value="">-- Pilih Jenjang Pendidikan --</option>
                                                @foreach (['Tidak Sekolah', 'SD Sederajat', 'SMP Sederajat', 'SMA Sederajat', 'D3', 'S1', 'S2'] as $p)
                                                    <option value="{{ $p }}"
                                                        {{ request('jenjang_pendidikan_wali') == $p ? 'selected' : '' }}>
                                                        {{ $p }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan_wali"
                                                value="{{ request('pekerjaan_wali') }}"
                                                placeholder="Masukkan pekerjaan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Penghasilan</label>
                                            <select class="form-select" name="penghasilan_wali">
                                                <option value="">-- Pilih Penghasilan --</option>
                                                @foreach (['Kurang dari 500.000', '500.000 - 999.999', '1jt - 2jt', '2jt - 5jt', '> 5jt'] as $g)
                                                    <option value="{{ $g }}"
                                                        {{ request('penghasilan_wali') == $g ? 'selected' : '' }}>
                                                        {{ $g }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-pendidikan" role="tabpanel">
                            <div class="row g-3 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Sekolah Asal</label>
                                    <input type="text" class="form-control" name="sekolah_asal"
                                        value="{{ request('sekolah_asal') }}" placeholder="Masukkan sekolah asal">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Peserta UN</label>
                                    <input type="number" class="form-control" name="no_peserta_un"
                                        value="{{ request('no_peserta_un') }}" placeholder="Masukkan no. peserta UN">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Seri Ijazah</label>
                                    <input type="number" class="form-control" name="no_seri_ijazah"
                                        value="{{ request('no_seri_ijazah') }}"
                                        placeholder="Masukkan no. seri ijazah">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-bantuan" role="tabpanel">
                            <div class="row g-3 mb-2">
                                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KPS</label>
                                </div></select>
                                <div class="col-md-6">
                                    <label class="form-label">Penerima KPS</label>
                                    <select class="form-select" name="penerima_kps">
                                        <option value="">-- Pilih --</option>
                                        <option value="Ya"
                                            {{ request('penerima_kps') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak"
                                            {{ request('penerima_kps') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. KPS</label>
                                    <input type="number" class="form-control" name="no_kps"
                                        value="{{ request('no_kps') }}" placeholder="Masukkan no. KPS">
                                </div>

                                <div class="col-md-12 mt-0">
                                    <hr class="text-muted opacity-25">
                                </div>
                                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KKS</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. KKS</label>
                                    <input type="number" class="form-control" name="no_kks"
                                        value="{{ request('no_kks') }}" placeholder="Masukkan no. KKS">
                                </div>

                                <div class="col-md-12 mt-0">
                                    <hr class="text-muted opacity-25">
                                </div>
                                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KIP</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Penerima KIP</label>
                                    <select class="form-select" name="penerima_kip">
                                        <option value="">-- Pilih --</option>
                                        <option value="Ya"
                                            {{ request('penerima_kip') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak"
                                            {{ request('penerima_kip') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. KIP</label>
                                    <input type="number" class="form-control" name="no_kip"
                                        value="{{ request('no_kip') }}" placeholder="Masukkan no. KIP">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama KIP</label>
                                    <input type="text" class="form-control" name="nama_kip"
                                        value="{{ request('nama_kip') }}" placeholder="Masukkan nama KIP">
                                </div>

                                <div class="col-md-12 mt-0">
                                    <hr class="text-muted opacity-25">
                                </div>
                                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">PIP</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Layak PIP</label>
                                    <select class="form-select" name="layak_pip">
                                        <option value="">-- Pilih --</option>
                                        <option value="Ya" {{ request('layak_pip') == 'Ya' ? 'selected' : '' }}>
                                            Ya</option>
                                        <option value="Tidak"
                                            {{ request('layak_pip') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alasan Layak PIP</label>
                                    <input type="text" class="form-control" name="alasan_layak_pip"
                                        value="{{ request('alasan_layak_pip') }}"
                                        placeholder="Masukkan alasan layak PIP">
                                </div>

                                <div class="col-md-12 mt-0">
                                    <hr class="text-muted opacity-25">
                                </div>
                                <div class="col-12"><label
                                        class="form-label fw-bold text-muted mt-1 mb-0">Bank</label></div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Bank</label>
                                    <input type="text" class="form-control" name="nama_bank"
                                        value="{{ request('nama_bank') }}" placeholder="Masukkan nama bank">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Rekening</label>
                                    <input type="number" class="form-control" name="no_rekening"
                                        value="{{ request('no_rekening') }}" placeholder="Masukkan no. rekening">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" name="nama_rekening"
                                        value="{{ request('nama_rekening') }}" placeholder="Masukkan atas nama">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-akademik" role="tabpanel">
                            <div class="row g-3 mb-2">
                                <div class="col-12"><label
                                        class="form-label fw-bold text-muted mt-1 mb-0">Kelas</label></div>
                                <div class="col-md-6">
                                    <label for="kelas-filter" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas-filter" name="kelas"
                                        {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                                        <option value="">
                                            {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}
                                        </option>
                                        @foreach ($kelas as $_kelas)
                                            <option value="{{ $_kelas->id_kelas }}"
                                                {{ request('kelas') == $_kelas->id_kelas ? 'selected' : '' }}>
                                                {{ $_kelas->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor Urut</label>
                                    <input type="number" class="form-control" name="nomor_urut"
                                        value="{{ request('nomor_urut') }}" placeholder="Masukkan nomor_urut">
                                </div>
                                <div class="col-md-12 mt-0">
                                    <hr class="text-muted opacity-25">
                                </div>
                                <div class="col-12"><label
                                        class="form-label fw-bold text-muted mt-1 mb-0">Ekstrakurikuler</label></div>
                                <div class="col-md-6">
                                    <label class="form-label">Ekstrakurikuler</label>
                                    <select class="form-select" name="ekstrakurikuler"
                                        {{ $ekstrakurikuler->isEmpty() ? 'disabled' : '' }}>
                                        <option value="">
                                            {{ $ekstrakurikuler->isNotEmpty() ? '-- Pilih Ekstrakurikuler --' : '-- Ekstrakurikuler Tidak Tersedia --' }}
                                        </option>
                                        @foreach ($ekstrakurikuler as $_ekstrakurikuler)
                                            <option value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}"
                                                {{ request('ekstrakurikuler') == $_ekstrakurikuler->id_ekstrakurikuler ? 'selected' : '' }}>
                                                {{ $_ekstrakurikuler->nama_ekstrakurikuler }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer form-buttons justify-content-between mt-0">
                <button id="filter-modal-clear-button" class="btn btn-danger"><i
                        class="bi bi-eraser me-2"></i>Bersihkan</button>
                <button id="filter-modal-apply-button" class="btn btn-primary"><i
                        class="bi bi-check-lg me-2"></i>Terapkan</button>
            </div>
        </div>
    </div>
</div>
