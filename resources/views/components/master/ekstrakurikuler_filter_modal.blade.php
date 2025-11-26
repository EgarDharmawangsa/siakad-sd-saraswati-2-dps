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
                <form id="filter-modal-form" action="{{ route('ekstrakurikuler.index') }}">
                    <div class="mb-3">
                        <label for="nama-ekstrakurikuler-filter" class="form-label">Nama Ekstrakurikuler</label>
                        <input type="text" class="form-control" id="nama-ekstrakurikuler-filter" name="nama_ekstrakurikuler_filter"
                            value="{{ request('nama_ekstrakurikuler_filter') }}" placeholder="Masukkan nama ekstrakurikuler">
                    </div>

                    <div class="mb-3">
                        <label for="nama-pembina-filter" class="form-label">Nama Pembina</label>
                        <input type="text" class="form-control" id="nama-pembina-filter" name="nama_pembina_filter"
                            value="{{ request('nama_pembina_filter') }}" placeholder="Masukkan nama pembina">
                    </div>

                    <div class="mb-3">
                        <label for="alamat-pembina-filter" class="form-label">Alamat Pembina</label>
                        <input type="text" class="form-control" id="alamat-pembina-filter" name="alamat_pembina_filter"
                            value="{{ request('alamat_pembina_filter') }}" placeholder="Masukkan alamat pembina">
                    </div>

                    <div class="mb-3">
                        <label for="no-telepon-filter" class="form-label">No. Telepon</label>
                        <input type="number" class="form-control" id="no-telepon-filter" name="no_telepon_filter"
                            value="{{ request('no_telepon_filter') }}" placeholder="Masukkan no. telepon">
                    </div>

                    <div class="mb-3">
                        <label for="hari-filter" class="form-label">Hari</label>
                        <select class="form-select" id="hari-filter" name="hari_filter">
                            <option value="">-- Pilih Hari --</option>
                            <option value="senin" {{ request('hari_filter') === 'senin' ? 'selected' : '' }}>Senin</option>
                            <option value="selasa" {{ request('hari_filter') === 'selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="rabu" {{ request('hari_filter') === 'rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="kamis" {{ request('hari_filter') === 'kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="jumat" {{ request('hari_filter') === 'jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="sabtu" {{ request('hari_filter') === 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="minggu" {{ request('hari_filter') === 'minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jam-mulai-filter" class="form-label">Jam Mulai</label>
                        <input type="text" class="form-control" id="jam-mulai-filter" name="jam_mulai_filter"
                            value="{{ request('jam_mulai_filter') }}" placeholder="Tentukan jam mulai">
                    </div>

                    <div class="mb-2">
                        <label for="jam-selesai-filter" class="form-label">Jam Selesai</label>
                        <input type="text" class="form-control" id="jam-selesai-filter" name="jam_selesai_filter"
                            value="{{ request('jam_selesai_filter') }}" placeholder="Tentukan jam selesai">
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
