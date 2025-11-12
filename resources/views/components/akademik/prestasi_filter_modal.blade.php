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
                <form id="filter-modal-form" action="{{ route('prestasi.index') }}">
                    <div class="mb-3">
                        <label for="nama-prestasi-filter" class="form-label">Nama Prestasi</label>
                        <input type="text" class="form-control" id="nama-prestasi-filter" name="nama_prestasi_filter"
                            value="{{ request('nama_prestasi_filter') }}" placeholder="Masukkan nama prestasi">
                    </div>

                    <div class="mb-3">
                        <label for="peraih-filter" class="form-label">Peraih</label>
                        <input type="text" class="form-control" id="peraih-filter" name="peraih_filter"
                            value="{{ request('peraih_filter') }}" placeholder="Masukkan peraih">
                    </div>

                    <div class="mb-3">
                        <label for="penyelenggara-filter" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="penyelenggara-filter" name="penyelenggara_filter"
                            value="{{ request('penyelenggara_filter') }}" placeholder="Masukkan penyelenggara">
                    </div>

                    <div class="mb-3">
                        <label for="jenis-filter" class="form-label">Jenis</label>
                        <select class="form-select" id="jenis-filter" name="jenis_filter">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="akademik" {{ request('jenis_filter') === 'akademik' ? 'selected' : '' }}>
                                Akademik</option>
                            <option value="non-akademik"
                                {{ request('jenis_filter') === 'non-akademik' ? 'selected' : '' }}>Non-Akademik
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="peringkat-filter" class="form-label">Peringkat</label>
                        <select class="form-select" id="peringkat-filter" name="peringkat_filter">
                            <option value="">-- Pilih Peringkat --</option>
                            <option value="1 (pertama)"
                                {{ request('peringkat_filter') === '1 (pertama)' ? 'selected' : '' }}>
                                1 (Pertama)</option>
                            <option value="2 (kedua)"
                                {{ request('peringkat_filter') === '2 (kedua)' ? 'selected' : '' }}>
                                2 (Kedua)</option>
                            <option value="3 (ketiga)"
                                {{ request('peringkat_filter') === '3 (ketiga)' ? 'selected' : '' }}>
                                3 (Ketiga)</option>
                            <option value="harapan 1"
                                {{ request('peringkat_filter') === 'harapan 1' ? 'selected' : '' }}>
                                Harapan 1</option>
                            <option value="harapan 2"
                                {{ request('peringkat_filter') === 'harapan 2' ? 'selected' : '' }}>
                                Harapan 2</option>
                            <option value="harapan 3"
                                {{ request('peringkat_filter') === 'harapan 3' ? 'selected' : '' }}>
                                Harapan 3</option>
                            <option value="lainnya" {{ request('peringkat_filter') === 'lainnya' ? 'selected' : '' }}>
                                Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="peringkat-lainnya-filter" class="form-label">Peringkat Lainnya</label>
                        <input type="text" class="form-control" id="peringkat-lainnya-filter"
                            name="peringkat_lainnya_filter" value="{{ request('peringkat_lainnya_filter') }}"
                            placeholder="Masukkan peringkat lainnya" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="tingkat-filter" class="form-label">Tingkat</label>
                        <select class="form-select" id="tingkat-filter" name="tingkat_filter">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="sekolah" {{ request('tingkat_filter') === 'sekolah' ? 'selected' : '' }}>
                                Sekolah</option>
                            <option value="desa" {{ request('tingkat_filter') === 'desa' ? 'selected' : '' }}>
                                Desa</option>
                            <option value="kecamatan"
                                {{ request('tingkat_filter') === 'kecamatan' ? 'selected' : '' }}>
                                Kecamatan</option>
                            <option value="kabupaten/kota"
                                {{ request('tingkat_filter') === 'kabupaten/kota' ? 'selected' : '' }}>
                                kabupaten/Kota</option>
                            <option value="provinsi" {{ request('tingkat_filter') === 'provinsi' ? 'selected' : '' }}>
                                Provinsi</option>
                            <option value="nasional" {{ request('tingkat_filter') === 'nasional' ? 'selected' : '' }}>
                                Nasional</option>
                            <option value="internasional"
                                {{ request('tingkat_filter') === 'internasional' ? 'selected' : '' }}>
                                Internasional</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama-wilayah-filter" class="form-label">Nama Wilayah</label>
                        <input type="text" class="form-control" id="nama-wilayah-filter" name="nama_wilayah_filter"
                            value="{{ request('nama_wilayah_filter') }}" placeholder="Masukkan nama wilayah">
                    </div>

                    <div class="mb-2">
                        <label for="tanggal-filter" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal-filter" name="tanggal_filter"
                            value="{{ request('tanggal_filter') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer form-buttons justify-content-between mt-0">
                <button id="filter-modal-clear-button" class="btn btn-danger">Bersihkan</button>
                <button id="filter-modal-apply-button" class="btn btn-primary">Terapkan</button>
            </div>
        </div>
    </div>
</div>
