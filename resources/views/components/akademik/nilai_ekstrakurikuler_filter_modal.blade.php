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
                <form id="filter-modal-form" action="{{ route('nilai-ekstrakurikuler.index') }}">
                    <div class="mb-3">
                        <label for="siswa-filter" class="form-label">Siswa</label>
                        <input type="text" class="form-control" id="siswa-filter" name="siswa_filter"
                            value="{{ request('siswa_filter') }}" placeholder="Masukkan siswa (nisn/nama)">
                    </div>

                    <div class="mb-3">
                        <label for="ekstrakurikuler-filter" class="form-label">Ekstrakurikuler</label>
                        <select class="form-select" id="ekstrakurikuler-filter" name="ekstrakurikuler_filter"
                            {{ $ekstrakurikuler->isEmpty() ? 'disabled' : '' }}>
                            <option value="">
                                {{ $ekstrakurikuler->isNotEmpty() ? '-- Pilih Ekstrakurikuler --' : '-- Ekstrakurikuler Tidak Tersedia --' }}
                            </option>
                            @foreach ($ekstrakurikuler as $_ekstrakurikuler)
                                <option value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}"
                                    {{ old('ekstrakurikuler_filter') === $_ekstrakurikuler->id_ekstrakurikuler ? 'selected' : '' }}>
                                    {{ $_ekstrakurikuler->nama_ekstrakurikuler }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="semester-filter" class="form-label">Semester</label>
                        <select class="form-select" id="semester-filter" name="semester_filter"
                            {{ $semester->isEmpty() ? 'disabled' : '' }}>
                            <option value="">
                                {{ $semester->isNotEmpty() ? '-- Pilih Semester --' : '-- Semester Tidak Tersedia --' }}
                            </option>
                            @foreach ($semester as $_semester)
                                <option value="{{ $_semester->id_semester }}"
                                    {{ request('semester_filter') === $_semester->id_semester ? 'selected' : '' }}>
                                    {{ $_semester->jenis . ' ' . $_semester->getTahunAjaran() . ' ' . $_semester->getStatus() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="nilai-filter" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="nilai-filter" name="nilai_filter"
                            value="{{ request('nilai_filter') }}" placeholder="Masukkan nilai">
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
