<div class="modal fade" id="filter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="filter-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"> <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filter-modal-label">Filter Siswa</h5>
                <button type="button" id="filter-modal-close-button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filter-modal-form" action="{{ route('siswa.index') }}">
                    
                    <ul class="nav nav-tabs mt-2" id="siswa-filter-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-pribadi-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-pribadi" type="button">Pribadi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-alamat-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-alamat" type="button">Alamat & Kontak</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-fisik-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-fisik" type="button">Fisik</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-ortu-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-ortu" type="button">Orang Tua</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-wali-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-wali" type="button">Wali</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-akademik-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-akademik" type="button">KIP & Akademik</button>
                        </li>
                    </ul>

                    <div class="tab-content mb-0" id="siswa-tab-content">
                        
                        <div class="tab-pane fade show active" id="tab-pribadi" role="tabpanel">
                            <div class="mt-3 row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa" value="{{ request('nama_siswa') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">-- Semua --</option>
                                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control" name="nisn" value="{{ request('nisn') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">NIPD</label>
                                    <input type="text" class="form-control" name="nipd" value="{{ request('nipd') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" name="nik" value="{{ request('nik') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" value="{{ request('tempat_lahir') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ request('tanggal_lahir') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Agama</label>
                                    <select class="form-select" name="agama">
                                        <option value="">-- Semua --</option>
                                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ request('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kewarganegaraan</label>
                                    <input type="text" class="form-control" name="kewarganegaraan" value="{{ request('kewarganegaraan') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">No. Registrasi Akta Lahir</label>
                                    <input type="text" class="form-control" name="no_registrasi_akta_lahir" value="{{ request('no_registrasi_akta_lahir') }}">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-alamat" role="tabpanel">
                            <div class="mt-3 row g-3">
                                <div class="col-12">
                                    <label class="form-label">Alamat Jalan</label>
                                    <input type="text" class="form-control" name="alamat" value="{{ request('alamat') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" class="form-control" name="rt" value="{{ request('rt') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" class="form-control" name="rw" value="{{ request('rw') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="kode_pos" value="{{ request('kode_pos') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Dusun</label>
                                    <input type="text" class="form-control" name="dusun" value="{{ request('dusun') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan" value="{{ request('kelurahan') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan" value="{{ request('kecamatan') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Tinggal</label>
                                    <input type="text" class="form-control" name="jenis_tinggal" value="{{ request('jenis_tinggal') }}" placeholder="Misal: Bersama Orang Tua">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alat Transportasi</label>
                                    <input type="text" class="form-control" name="alat_transportasi" value="{{ request('alat_transportasi') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jarak ke Sekolah (km)</label>
                                    <input type="number" step="0.01" class="form-control" name="jarak_rumah_ke_sekolah" value="{{ request('jarak_rumah_ke_sekolah') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Telp Rumah</label>
                                    <input type="text" class="form-control" name="no_telepon_rumah" value="{{ request('no_telepon_rumah') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" class="form-control" name="no_telepon_seluler" value="{{ request('no_telepon_seluler') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="e_mail" value="{{ request('e_mail') }}">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-fisik" role="tabpanel">
                            <div class="mt-3 row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Berat Badan (kg)</label>
                                    <input type="number" step="0.01" class="form-control" name="berat_badan" value="{{ request('berat_badan') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" step="0.01" class="form-control" name="tinggi_badan" value="{{ request('tinggi_badan') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Lingkar Kepala (cm)</label>
                                    <input type="number" step="0.01" class="form-control" name="lingkar_kepala" value="{{ request('lingkar_kepala') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Saudara</label>
                                    <input type="number" class="form-control" name="jumlah_saudara_kandung" value="{{ request('jumlah_saudara_kandung') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Anak Ke-</label>
                                    <input type="number" class="form-control" name="anak_ke_berapa" value="{{ request('anak_ke_berapa') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Disabilitas</label>
                                    <select class="form-select" name="disabilitas">
                                        <option value="">-- Semua --</option>
                                        <option value="Tidak" {{ request('disabilitas') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                        <option value="Netra" {{ request('disabilitas') == 'Netra' ? 'selected' : '' }}>Netra</option>
                                        <option value="Rungu" {{ request('disabilitas') == 'Rungu' ? 'selected' : '' }}>Rungu</option>
                                        <option value="Grahita" {{ request('disabilitas') == 'Grahita' ? 'selected' : '' }}>Grahita</option>
                                        <option value="Daksa" {{ request('disabilitas') == 'Daksa' ? 'selected' : '' }}>Daksa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-ortu" role="tabpanel">
                            <div class="mt-3 row g-3">
                                <div class="col-12"><h6 class="text-primary border-bottom pb-2">Data Ayah</h6></div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" name="nama_ayah" value="{{ request('nama_ayah') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK Ayah</label>
                                    <input type="text" class="form-control" name="nik_ayah" value="{{ request('nik_ayah') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pendidikan Ayah</label>
                                    <input type="text" class="form-control" name="jenjang_pendidikan_ayah" value="{{ request('jenjang_pendidikan_ayah') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ request('pekerjaan_ayah') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Penghasilan Ayah</label>
                                    <input type="text" class="form-control" name="penghasilan_ayah" value="{{ request('penghasilan_ayah') }}">
                                </div>

                                <div class="col-12 mt-4"><h6 class="text-primary border-bottom pb-2">Data Ibu</h6></div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" name="nama_ibu" value="{{ request('nama_ibu') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK Ibu</label>
                                    <input type="text" class="form-control" name="nik_ibu" value="{{ request('nik_ibu') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pendidikan Ibu</label>
                                    <input type="text" class="form-control" name="jenjang_pendidikan_ibu" value="{{ request('jenjang_pendidikan_ibu') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ request('pekerjaan_ibu') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Penghasilan Ibu</label>
                                    <input type="text" class="form-control" name="penghasilan_ibu" value="{{ request('penghasilan_ibu') }}">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-wali" role="tabpanel">
                            <div class="mt-3 row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control" name="nama_wali" value="{{ request('nama_wali') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK Wali</label>
                                    <input type="text" class="form-control" name="nik_wali" value="{{ request('nik_wali') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pendidikan Wali</label>
                                    <input type="text" class="form-control" name="jenjang_pendidikan_wali" value="{{ request('jenjang_pendidikan_wali') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" name="pekerjaan_wali" value="{{ request('pekerjaan_wali') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Penghasilan Wali</label>
                                    <input type="text" class="form-control" name="penghasilan_wali" value="{{ request('penghasilan_wali') }}">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-akademik" role="tabpanel">
                            <div class="mt-3 row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Penerima KIP?</label>
                                    <select class="form-select" name="penerima_kip">
                                        <option value="">-- Semua --</option>
                                        <option value="Ya" {{ request('penerima_kip') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ request('penerima_kip') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. KIP</label>
                                    <input type="text" class="form-control" name="no_kip" value="{{ request('no_kip') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Layak PIP?</label>
                                    <select class="form-select" name="layak_pip">
                                        <option value="">-- Semua --</option>
                                        <option value="Ya" {{ request('layak_pip') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ request('layak_pip') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Penerima KPS?</label>
                                    <select class="form-select" name="penerima_kps">
                                        <option value="">-- Semua --</option>
                                        <option value="Ya" {{ request('penerima_kps') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ request('penerima_kps') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nama Bank</label>
                                    <input type="text" class="form-control" name="nama_bank" value="{{ request('nama_bank') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Rekening</label>
                                    <input type="text" class="form-control" name="no_rekening" value="{{ request('no_rekening') }}">
                                </div>

                                <div class="col-12 mt-3"><h6 class="text-primary border-bottom pb-2">Akademik Lama</h6></div>
                                <div class="col-md-6">
                                    <label class="form-label">Sekolah Asal</label>
                                    <input type="text" class="form-control" name="sekolah_asal" value="{{ request('sekolah_asal') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Peserta UN</label>
                                    <input type="text" class="form-control" name="no_peserta_un" value="{{ request('no_peserta_un') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">No. Seri Ijazah</label>
                                    <input type="text" class="form-control" name="no_seri_ijazah" value="{{ request('no_seri_ijazah') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer form-buttons justify-content-between mt-0">
                <button id="filter-modal-clear-button" class="btn btn-danger"><i class="bi bi-eraser me-2"></i>Bersihkan</button>
                <button id="filter-modal-apply-button" class="btn btn-primary"><i class="bi bi-check-lg me-2"></i>Terapkan</button>
            </div>
        </div>
    </div>
</div>