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
                    @canany(['staf-tata-usaha', 'guru'])
                        <div class="mb-3">
                            <label for="kelas-filter" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas-filter" name="kelas_filter"
                                {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                                <option value="">
                                    {{ $kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}
                                </option>
                                @foreach ($kelas as $_kelas)
                                    <option value="{{ $_kelas->id_kelas }}"
                                        {{ old('kelas_filter') === $_kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $_kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="siswa-filter" class="form-label">Siswa</label>
                            <input type="text" class="form-control" id="siswa-filter" name="siswa_filter"
                                value="{{ request('siswa_filter') }}" placeholder="Masukkan siswa (nisn/nama)">
                        </div>
                    @endcanany

                    <div class="mb-3">
                        <label for="ekstrakurikuler-filter" class="form-label">Ekstrakurikuler</label>
                        <select class="form-select" id="ekstrakurikuler-filter" name="ekstrakurikuler_filter"
                            {{ $ekstrakurikuler->isEmpty() ? 'disabled' : '' }}>
                            @if ($ekstrakurikuler->isEmpty())
                                <option value="">-- Ekstrakurikuler Tidak Tersedia --</option>
                            @else 
                                @if (!request('ekstrakurikuler_filter'))
                                    <option value="{{ $ekstrakurikuler_default_filter->id_ekstrakurikuler }}">
                                        {{ $ekstrakurikuler_default_filter->nama_ekstrakurikuler }}
                                    </option>
                                @endif

                                @foreach ($ekstrakurikuler as $_ekstrakurikuler)
                                    @if ($_ekstrakurikuler->id_ekstrakurikuler !== $ekstrakurikuler_default_filter->id_ekstrakurikuler)
                                        <option value="{{ $_ekstrakurikuler->id_ekstrakurikuler }}">
                                            {{ $_ekstrakurikuler->nama_ekstrakurikuler }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="semester-filter" class="form-label">Semester</label>
                        <select class="form-select" id="semester-filter" name="semester_filter"
                            {{ $semester->isEmpty() ? 'disabled' : '' }}>
                            @if ($semester->isEmpty())
                                <option value="">-- Semester Tidak Tersedia --</option>
                            @else
                                @if (!request('semester_filter'))
                                    <option value="{{ $active_semester->id_semester }}">
                                        {{ $active_semester->getTahunAjaran(true) }}
                                    </option>
                                @endif

                                @foreach ($semester as $_semester)
                                    @if ($_semester->id_semester !== $active_semester->id_semester)
                                        <option value="{{ $_semester->id_semester }}">
                                            {{ $_semester->getTahunAjaran(true) }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
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
                <button id="filter-modal-clear-button" class="btn btn-danger"><i
                        class="bi bi-eraser me-2"></i>Bersihkan</button>
                <button id="filter-modal-apply-button" class="btn btn-primary"><i
                        class="bi bi-check-lg me-2"></i>Terapkan</button>
            </div>
        </div>
    </div>
</div>
