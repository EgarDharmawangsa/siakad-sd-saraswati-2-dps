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
                <form action="{{ route('prestasi.index') }}">
                    <div class="mb-3">
                        <label for="nama-prestasi-filter" class="form-label">Nama Prestasi</label>
                        <input type="text" class="form-control" id="nama-prestasi-filter" name="nama_prestasi_filter"
                            value="{{ request('nama_prestasi_filter') }}" placeholder="Masukkan nama prestasi">
                    </div>

                    <div class="mb-3">
                        <label for="peraih-filter" class="form-label">Peraih</label>
                        <input type="text" class="form-control" id="peraih-filter" name="peraih_filter"
                            value="{{ request('peraih_filter') }}" placeholder="Masukkan peraih"
                            {{ $siswa->isEmpty() ? 'disabled' : '' }}>
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
                            <option value="Akademik" {{ request('jenis_filter') === 'Akademik' ? 'selected' : '' }}>
                                Akademik</option>
                            <option value="Non-Akademik"
                                {{ request('jenis_filter') === 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="peringkat-filter" class="form-label">Peringkat</label>
                        <select class="form-select" id="peringkat-filter" name="peringkat_filter">
                            <option value="">-- Pilih Peringkat --</option>
                            <option value="1 (Pertama)"
                                {{ request('peringkat_filter') === '1 (Pertama)' ? 'selected' : '' }}>
                                1 (Pertama)</option>
                            <option value="2 (Kedua)"
                                {{ request('peringkat_filter') === '2 (Kedua)' ? 'selected' : '' }}>
                                2 (Kedua)</option>
                            <option value="3 (Ketiga)"
                                {{ request('peringkat_filter') === '3 (Ketiga)' ? 'selected' : '' }}>
                                3 (Ketiga)</option>
                            <option value="Harapan 1"
                                {{ request('peringkat_filter') === 'Harapan 1' ? 'selected' : '' }}>
                                Harapan 1</option>
                            <option value="Harapan 2"
                                {{ request('peringkat_filter') === 'Harapan 2' ? 'selected' : '' }}>
                                Harapan 2</option>
                            <option value="Harapan 3"
                                {{ request('peringkat_filter') === 'Harapan 3' ? 'selected' : '' }}>
                                Harapan 3</option>
                            <option value="Lainnya" {{ request('peringkat_filter') === 'Lainnya' ? 'selected' : '' }}>
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
                            <option value="Sekolah" {{ request('tingkat_filter') === 'Sekolah' ? 'selected' : '' }}>
                                Sekolah</option>
                            <option value="Desa" {{ request('tingkat_filter') === 'Desa' ? 'selected' : '' }}>
                                Desa</option>
                            <option value="Kecamatan"
                                {{ request('tingkat_filter') === 'Kecamatan' ? 'selected' : '' }}>
                                Kecamatan</option>
                            <option value="Kabupaten/Kota"
                                {{ request('tingkat_filter') === 'Kabupaten/Kota' ? 'selected' : '' }}>
                                kabupaten/Kota</option>
                            <option value="Provinsi" {{ request('tingkat_filter') === 'Provinsi' ? 'selected' : '' }}>
                                Provinsi</option>
                            <option value="Nasional" {{ request('tingkat_filter') === 'Nasional' ? 'selected' : '' }}>
                                Nasional</option>
                            <option value="Internasional"
                                {{ request('tingkat_filter') === 'Internasional' ? 'selected' : '' }}>
                                Internasional</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama-wilayah-filter" class="form-label">Nama Wilayah</label>
                        <input type="text" class="form-control" id="nama-wilayah-filter" name="nama_wilayah_filter"
                            value="{{ request('nama_wilayah_filter') }}" placeholder="Masukkan nama wilayah">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal-filter" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal-filter" name="tanggal_filter"
                            value="{{ request('tanggal_filter') }}">
                    </div>

                    <div class="text-center form-buttons mb-2">
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
