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
                <form id="filter-modal-form" action="{{ route('pengumuman.index') }}">
                    <div class="mb-3">
                        <label for="judul-filter" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul-filter" name="judul_filter"
                            value="{{ request('judul_filter') }}" placeholder="Masukkan judul">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal-filter" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal-filter" name="tanggal_filter"
                            value="{{ request('tanggal_filter') }}">
                    </div>

                    {{-- <div class="mb-3">
                        <label for="isi-filter" class="form-label">Isi</label>
                        <input type="text" class="form-control" id="isi-filter" name="isi_filter"
                            value="{{ request('isi_filter') }}" placeholder="Masukkan isi">
                    </div> --}}

                    <div class="mb-2">
                        <label for="status-filter" class="form-label">Status</label>
                        <select class="form-select" id="status-filter" name="status_filter">
                            <option value="">-- Pilih Status --</option>
                            <option value="menunggu" {{ request('status_filter') === 'menunggu' ? 'selected' : '' }}>
                                Menunggu</option>
                            <option value="terbit" {{ request('status_filter') === 'terbit' ? 'selected' : '' }}>Terbit
                            </option>
                        </select>
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
