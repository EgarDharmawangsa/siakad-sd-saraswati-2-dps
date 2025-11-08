<div class="modal fade" id="filter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="filter-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filter-modal-label">Filter {{ $judul }}</h5>
                <button type="button" id="filter-modal-close-button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filter-modal-form" action="{{ route('pegawai.index') }}">
                    <ul class="nav nav-tabs mt-2" id="pegawai-filter-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-pribadi-filter-tab-button" data-bs-toggle="tab"
                                data-bs-target="#data-pribadi-filter-tab" type="button">Data pribadi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-kepegawaian-filter-tab-button" data-bs-toggle="tab"
                                data-bs-target="#data-kepegawaian-filter-tab" type="button">Data Kepegawaian</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-pendidikan-filter-tab-button" data-bs-toggle="tab"
                                data-bs-target="#data-pendidikan-filter-tab" type="button">Pendidikan &
                                Sertifikasi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-sk-filter-tab-button" data-bs-toggle="tab"
                                data-bs-target="#data-sk-filter-tab" type="button">Data SK</button>
                        </li>
                    </ul>

                    <div class="tab-content mb-0" id="pegawai-tab-content">
                        <div class="tab-pane fade show active" id="data-pribadi-filter-tab" role="tabpanel">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label for="nik-filter" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik-filter" name="nik_filter"
                                        value="{{ request('nik_filter') }}" placeholder="Masukkan NIK">
                                </div>

                                <div class="mb-3">
                                    <label for="nama-pegawai-filter" class="form-label">Nama Pegawai</label>
                                    <input type="text" class="form-control" id="nama-pegawai-filter"
                                        name="nama_pegawai_filter" value="{{ request('nama_pegawai_filter') }}"
                                        placeholder="Masukkan nama pegawai">
                                </div>

                                <div class="mb-3">
                                    <label for="jenis-kelamin-filter" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis-kelamin-filter" name="jenis_kelamin_filter">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="laki-laki"
                                            {{ request('jenis_kelamin_filter') === 'laki-laki' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="perempuan"
                                            {{ request('jenis_kelamin_filter') === 'perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tempat-lahir-filter" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat-lahir-filter"
                                        name="tempat_lahir_filter" value="{{ request('tempat_lahir_filter') }}"
                                        placeholder="Masukkan tempat lahir">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal-lahir-filter" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal-lahir-filter"
                                        name="tanggal_lahir_filter" value="{{ request('tanggal_lahir_filter') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="agama-filter" class="form-label">Agama</label>
                                    <select class="form-select" id="agama-filter" name="agama_filter">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="islam"
                                            {{ request('agama_filter') === 'islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="kristen protestan"
                                            {{ request('agama_filter') === 'kristen protestan' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="kristen katolik"
                                            {{ request('agama_filter') === 'kristen katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="hindu"
                                            {{ request('agama_filter') === 'hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="budha"
                                            {{ request('agama_filter') === 'budha' ? 'selected' : '' }}>
                                            Budha</option>
                                        <option value="konghucu"
                                            {{ request('agama_filter') === 'konghucu' ? 'selected' : '' }}>
                                            Konghucu</option>
                                        <option value="tidak beragama"
                                            {{ request('agama_filter') === 'tidak beragama' ? 'selected' : '' }}>
                                            Tidak Beragama</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status-perkawinan-filter" class="form-label">Status Perkawinan</label>
                                    <select class="form-select" id="status-perkawinan-filter"
                                        name="status_perkawinan_filter">
                                        <option value="">-- Pilih Status Perkawinan --</option>
                                        <option value="sudah"
                                            {{ request('status_perkawinan_filter') === 'sudah' ? 'selected' : '' }}>
                                            Sudah</option>
                                        <option value="pernah"
                                            {{ request('status_perkawinan_filter') === 'pernah' ? 'selected' : '' }}>
                                            Pernah
                                        </option>
                                        <option value="belum"
                                            {{ request('status_perkawinan_filter') === 'belum' ? 'selected' : '' }}>
                                            Belum
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat-filter" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat-filter"
                                        name="alamat_filter" value="{{ request('alamat_filter') }}"
                                        placeholder="Masukkan alamat">
                                </div>

                                <div class="mb-3">
                                    <label for="no-telepon-rumah-filter" class="form-label">No. Telepon Rumah</label>
                                    <input type="number" class="form-control" id="no-telepon-rumah-filter"
                                        name="no_telepon_rumah_filter" placeholder="Masukkan no. telepon rumah"
                                        value="{{ request('no_telepon_rumah_filter') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="no-telepon-seluler-filter" class="form-label">No. Telepon
                                        Seluler</label>
                                    <input type="number" class="form-control" id="no-telepon-seluler-filter"
                                        name="no_telepon_seluler_filter" placeholder="Masukkan no. telepon seluler"
                                        value="{{ request('no_telepon_seluler_filter') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="e-mail-filter" class="form-label">E-Mail</label>
                                    <input type="email" class="form-control" id="e-mail-filter"
                                        name="e_mail_filter" placeholder="Masukkan e-mail"
                                        value="{{ request('e_mail_filter') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="username-filter" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username-filter"
                                        name="username_filter" value="{{ request('username_filter') }}"
                                        placeholder="Masukkan username">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data-kepegawaian-filter-tab" role="tabpanel">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label for="posisi-filter" class="form-label">Posisi</label>
                                    <select class="form-select" id="posisi-filter" name="posisi_filter">
                                        <option value="">-- Pilih Posisi --</option>
                                        <option value="staf tata usaha"
                                            {{ request('posisi_filter') === 'staf tata usaha' ? 'selected' : '' }}>
                                            Staf Tata Usaha</option>
                                        <option value="guru"
                                            {{ request('posisi_filter') === 'guru' ? 'selected' : '' }}>
                                            Guru
                                        </option>
                                        <option value="pegawai perpustakaan"
                                            {{ request('posisi_filter') === 'pegawai perpustakaan' ? 'selected' : '' }}>
                                            Pegawai Perpustkaan
                                        </option>
                                        <option value="satuan keamanan"
                                            {{ request('posisi_filter') === 'satuan keamanan' ? 'selected' : '' }}>
                                            Satuan Keamanan
                                        </option>
                                        <option value="pegawai kebersihan"
                                            {{ request('posisi_filter') === 'pegawai kebersihan' ? 'selected' : '' }}>
                                            Pegawai Kebersihan
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="guru-mata-pelajaran-filter" class="form-label">Guru Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="guru-mata-pelajaran-filter" name="guru_mata_pelajaran_filter"
                                        value="{{ request('guru_mata_pelajaran_filter') }}" placeholder="Masukkan mata pelajaran">
                                </div>

                                <div class="mb-3">
                                    <label for="status-kepegawaian-filter" class="form-label">Status
                                        Kepegawaian</label>
                                    <select class="form-select" id="status-kepegawaian-filter"
                                        name="status_kepegawaian_filter">
                                        <option value="">-- Pilih Status Kepegawaian --</option>
                                        <option value="pns"
                                            {{ request('status_kepegawaian_filter') === 'pns' ? 'selected' : '' }}>
                                            PNS</option>
                                        <option value="pppk"
                                            {{ request('status_kepegawaian_filter') === 'pppk' ? 'selected' : '' }}>
                                            PPPK</option>
                                        <option value="honorer"
                                            {{ request('status_kepegawaian_filter') === 'honorer' ? 'selected' : '' }}>
                                            Honorer</option>
                                        <option value="kontrak"
                                            {{ request('status_kepegawaian_filter') === 'kontrak' ? 'selected' : '' }}>
                                            Kontrak</option>
                                        <option value="tetap"
                                            {{ request('status_kepegawaian_filter') === 'tetap' ? 'selected' : '' }}>
                                            Tetap</option>
                                        <option value="tidak tetap"
                                            {{ request('status_kepegawaian_filter') === 'tidak tetap' ? 'selected' : '' }}>
                                            Tidak Tetap</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nip-filter" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip-filter" name="nip_filter"
                                        value="{{ request('nip_filter') }}" placeholder="Masukkan NIP">
                                </div>

                                <div class="mb-3">
                                    <label for="nipppk-filter" class="form-label">NIPPPK</label>
                                    <input type="text" class="form-control" id="nipppk-filter"
                                        name="nipppk_filter" value="{{ request('nipppk_filter') }}"
                                        placeholder="Masukkan NIPPPK">
                                </div>

                                <div class="mb-3">
                                    <label for="jabatan-filter" class="form-label">Jabatan</label>
                                    <select class="form-select" id="jabatan-filter" name="jabatan_filter">
                                        <option value="">-- Pilih Jabatan --</option>
                                        <option value="pengatur muda | ii/a"
                                            {{ old('jabatan_filter') === 'pengatur muda | ii/a' ? 'selected' : '' }}>
                                            Pengatur
                                            Muda | II/a
                                        </option>
                                        <option value="pengatur muda tk. I | ii/b"
                                            {{ old('jabatan_filter') === 'pengatur muda tk. I | ii/b' ? 'selected' : '' }}>
                                            Pengatur Muda
                                            Tk. I | II/b</option>
                                        <option value="pengatur | ii/c"
                                            {{ old('jabatan_filter') === 'pengatur | ii/c' ? 'selected' : '' }}>
                                            Pengatur |
                                            II/c</option>
                                        <option value="pengatur tk. I | ii/d"
                                            {{ old('jabatan_filter') === 'pengatur tk. I | ii/d' ? 'selected' : '' }}>
                                            Pengatur
                                            Tk. I |
                                            II/d
                                        </option>
                                        <option value="penata muda | iii/a"
                                            {{ old('jabatan_filter') === 'penata muda | iii/a' ? 'selected' : '' }}>
                                            Penata
                                            Muda | III/a
                                        </option>
                                        <option value="penata muda tk. i | iii/b"
                                            {{ old('jabatan_filter') === 'penata muda tk. i | iii/b' ? 'selected' : '' }}>
                                            Penata Muda Tk.
                                            I
                                            | III/b</option>
                                        <option value="penata | iii/c"
                                            {{ old('jabatan_filter') === 'penata | iii/c' ? 'selected' : '' }}>
                                            Penata | III/c</option>
                                        <option value="penata tk. i | iii/d"
                                            {{ old('jabatan_filter') === 'penata tk. i | iii/d' ? 'selected' : '' }}>
                                            Penata
                                            Tk. I | III/d
                                        </option>
                                        <option value="pembina | iv/a"
                                            {{ old('jabatan_filter') === 'pembina | iv/a' ? 'selected' : '' }}>
                                            Pembina | IV/a</option>
                                        <option value="pembina tk. i | iv/b"
                                            {{ old('jabatan_filter') === 'pembina tk. i | iv/b' ? 'selected' : '' }}>
                                            Pembina
                                            Tk. I | IV/b
                                        </option>
                                        <option value="pembina utama muda | iv/c"
                                            {{ old('jabatan_filter') === 'pembina utama muda | iv/c' ? 'selected' : '' }}>
                                            Pembina Utama
                                            Muda | IV/c</option>
                                        <option value="pembina utama madya | iv/d"
                                            {{ old('jabatan_filter') === 'pembina utama madya | iv/d' ? 'selected' : '' }}>
                                            Pembina Utama
                                            Madya | IV/d</option>
                                        <option value="pembina utama | iv/e"
                                            {{ old('jabatan_filter') === 'pembina utama | iv/e' ? 'selected' : '' }}>
                                            Pembina
                                            Utama | IV/e
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="permulaan-kerja-filter" class="form-label">Permulaan Kerja</label>
                                    <input type="date" class="form-control" id="permulaan-kerja-filter"
                                        name="permulaan_kerja_filter"
                                        value="{{ request('permulaan_kerja_filter') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="permulaan-kerja-sds2-filter" class="form-label">Permulaan Kerja
                                        (RASDA)</label>
                                    <input type="date" class="form-control" id="permulaan-kerja-sds2-filter"
                                        name="permulaan_kerja_sds2_filter"
                                        value="{{ request('permulaan_kerja_sds2_filter') }}">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data-pendidikan-filter-tab" role="tabpanel">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label for="ijazah-terakhir-filter" class="form-label">Ijazah Terakhir</label>
                                    <input type="text" class="form-control" id="ijazah-terakhir-filter"
                                        name="ijazah_terakhir_filter" value="{{ request('ijazah_terakhir_filter') }}"
                                        placeholder="Masukkan ijazah terakhir">
                                </div>

                                <div class="mb-3">
                                    <label for="tahun-ijazah-filter" class="form-label">Tahun Ijazah</label>
                                    <input type="text" class="form-control" id="tahun-ijazah-filter"
                                        name="tahun_ijazah_filter" value="{{ request('tahun_ijazah_filter') }}"
                                        placeholder="Masukkan tahun ijazah">
                                </div>

                                <div class="mb-3">
                                    <label for="status-sertifikasi-filter" class="form-label">Status
                                        Sertifikasi</label>
                                    <select class="form-select" id="status-sertifikasi-filter"
                                        name="status_sertifikasi_filter">
                                        <option value="">-- Pilih Status Sertifikasi --</option>
                                        <option value="sudah"
                                            {{ request('status_sertifikasi_filter') === 'sudah' ? 'selected' : '' }}>
                                            Sudah</option>
                                        <option value="belum"
                                            {{ request('status_sertifikasi_filter') === 'belum' ? 'selected' : '' }}>
                                            Belum
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tahun-sertifikasi-filter" class="form-label">Tahun Sertifikasi</label>
                                    <input type="text" class="form-control" id="tahun-sertifikasi-filter"
                                        name="tahun_sertifikasi_filter"
                                        value="{{ request('tahun_sertifikasi_filter') }}"
                                        placeholder="Masukkan tahun sertifikasi">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data-sk-filter-tab" role="tabpanel">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label for="no-sk-filter" class="form-label">Nomor SK</label>
                                    <input type="text" class="form-control" id="no-sk-filter" name="no_sk_filter"
                                        value="{{ request('no_sk_filter') }}" placeholder="Masukkan nomor SK">
                                </div>

                                <div class="mb-3">
                                    <label for="tgl-sk-terakhir-filter" class="form-label">Tanggal SK Terakhir</label>
                                    <input type="text" class="form-control" id="tgl-sk-terakhir-filter"
                                        name="tanggal_sk_terakhir_filter"
                                        value="{{ request('tanggal_sk_terakhir_filter') }}"
                                        placeholder="Masukkan tanggal SK terakhir">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-buttons justify-content-between">
                        <button type="button" id="filter-modal-clear-button" class="btn btn-danger">Bersihkan</button>
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
