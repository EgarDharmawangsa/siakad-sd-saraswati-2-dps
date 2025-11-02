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
                <form action="{{ route('ekstrakurikuler.index') }}">
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
                        <input type="text" class="form-control" id="no-telepon-filter" name="no_telepon_filter"
                            value="{{ request('no_telepon_filter') }}" placeholder="Masukkan no. telepon">
                    </div>

                    <div class="mb-3">
                        <label for="hari-filter" class="form-label">Hari</label>
                        <select class="form-select" id="hari-filter" name="hari_filter">
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin" {{ request('hari_filter') === 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ request('hari_filter') === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ request('hari_filter') === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ request('hari_filter') === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ request('hari_filter') === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ request('hari_filter') === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ request('hari_filter') === 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jam-mulai-filter" class="form-label">Jam Mulai</label>
                        <input type="text" class="form-control" id="jam-mulai-filter" name="jam_mulai_filter"
                            value="{{ request('jam_mulai_filter') }}" placeholder="Tentukan jam mulai">
                    </div>

                    <div class="mb-3">
                        <label for="jam-selesai-filter" class="form-label">Jam Selesai</label>
                        <input type="text" class="form-control" id="jam-selesai-filter" name="jam_selesai_filter"
                            value="{{ request('jam_selesai_filter') }}" placeholder="Tentukan jam selesai">
                    </div>

                    <div class="text-center form-buttons mb-2">
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
