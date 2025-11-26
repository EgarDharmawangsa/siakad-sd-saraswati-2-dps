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
                <form id="filter-modal-form" action="{{ route('kelas.index') }}">
                    <div class="mb-3">
                        <label for="nama-kelas-filter" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama-kelas-filter" name="nama_kelas_filter"
                            value="{{ request('nama_kelas_filter') }}" placeholder="Masukkan nama kelas">
                    </div>

                    <div class="mb-2">
                        <label for="wali-kelas-filter" class="form-label">Wali Kelas</label>
                        <input type="text" class="form-control" id="wali-kelas-filter" name="wali_kelas_filter"
                            value="{{ request('wali_kelas_filter') }}" placeholder="Masukkan wali kelas (nip/nipppk/nama)">
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
