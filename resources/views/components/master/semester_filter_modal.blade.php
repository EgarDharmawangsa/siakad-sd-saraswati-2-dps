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
                <form id="filter-modal-form" action="{{ route('semester.index') }}">
                    <div class="mb-3">
                        <label for="jenis-filter" class="form-label">Jenis</label>
                        <select class="form-select" id="jenis-filter" name="jenis_filter">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Ganjil" {{ request('jenis_filter') === 'Ganjil' ? 'selected' : '' }}>
                                Ganjil</option>
                            <option value="Genap" {{ request('jenis_filter') === 'Genap' ? 'selected' : '' }}>
                                Genap</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tahun-ajaran-filter" class="form-label">Tahun Ajaran</label>
                        <select class="form-select" id="tahun-ajaran-filter" name="tahun_ajaran_filter" {{ $semester->isEmpty() ? 'disabled' : '' }}>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @forelse ($semester as $_semester)
                                <option value="Ganjil" {{ request('tahun_ajaran_filter') === $_semester->getTahunAjaran() ? 'selected' : '' }}>{{ $_semester->getTahunAjaran() }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal-mulai-filter" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal-mulai-filter" name="tanggal_mulai_filter"
                            value="{{ request('tanggal_mulai_filter') }}">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal-selesai-filter" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal-selesai-filter" name="tanggal_selesai_filter"
                            value="{{ request('tanggal_selesai_filter') }}">
                    </div>

                    <div class="mb-3">
                        <label for="status-filter" class="form-label">Status</label>
                        <select class="form-select" id="status-filter" name="status_filter">
                            <option value="">-- Pilih Status --</option>
                            <option value="menunggu" {{ request('status_filter') === 'menunggu' ? 'selected' : '' }}>
                                Menunggu</option>
                            <option value="berjalan" {{ request('status_filter') === 'berjalan' ? 'selected' : '' }}>Berjalan
                            </option>
                            <option value="selesai" {{ request('status_filter') === 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
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
