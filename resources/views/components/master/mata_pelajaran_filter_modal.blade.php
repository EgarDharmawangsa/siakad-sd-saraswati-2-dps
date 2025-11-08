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
                <form id="filter-modal-form" action="{{ route('mata-pelajaran.index') }}">
                    <div class="mb-3">
                        <label for="nama-mata-pelajaran-filter" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama-mata-pelajaran-filter"
                            name="nama_mata_pelajaran_filter" value="{{ request('nama_mata_pelajaran_filter') }}"
                            placeholder="Masukkan nama mata pelajaran">
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
