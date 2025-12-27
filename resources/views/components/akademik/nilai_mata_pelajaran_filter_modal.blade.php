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
                                @if ($kelas->isEmpty())
                                    <option value="">-- Kelas Tidak Tersedia --</option>
                                @else
                                    @if (!request('kelas_filter'))
                                        <option value="{{ $kelas_default_filter->id_kelas }}">
                                            {{ $kelas_default_filter->nama_kelas }}
                                        </option>
                                    @endif

                                    @foreach ($kelas as $_kelas)
                                        @if ($_kelas->id_kelas !== $kelas_default_filter->id_kelas)
                                            <option value="{{ $_kelas->id_kelas }}">
                                                {{ $_kelas->nama_kelas }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="siswa-filter" class="form-label">Siswa</label>
                            <input type="text" class="form-control" id="siswa-filter" name="siswa_filter"
                                value="{{ request('siswa_filter') }}" placeholder="Masukkan siswa (nisn/nama)">
                        </div>
                    @endcanany

                    <div class="mb-3">
                        <label for="mata-pelajaran-filter" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="mata-pelajaran-filter" name="mata_pelajaran_filter"
                            {{ $mata_pelajaran->isEmpty() ? 'disabled' : '' }}>
                            @if ($mata_pelajaran->isEmpty())
                                <option value="">-- Ekstrakurikuler Tidak Tersedia --</option>
                            @else
                                @if (!request('ekstrakurikuler_filter'))
                                    <option value="{{ $mata_pelajaran_default_filter->id_mata_pelajaran }}">
                                        {{ $mata_pelajaran_default_filter->nama_mata_pelajaran }}
                                    </option>
                                @endif

                                @foreach ($mata_pelajaran as $_mata_pelajaran)
                                    @if ($_mata_pelajaran->id_mata_pelajaran !== $mata_pelajaran_default_filter->id_mata_pelajaran)
                                        <option value="{{ $_mata_pelajaran->id_mata_pelajaran }}">
                                            {{ $_mata_pelajaran->nama_mata_pelajaran }}
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
                                    <option value="{{ $semester_default_filter->id_semester }}">
                                        {{ $semester_default_filter->getTahunAjaran(true) }}
                                    </option>
                                @endif

                                @foreach ($semester as $_semester)
                                    @if ($_semester->id_semester !== $semester_default_filter->id_semester)
                                        <option value="{{ $_semester->id_semester }}">
                                            {{ $_semester->getTahunAjaran(true) }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- <div class="mb-2">
                        <label for="nilai-filter" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="nilai-filter" name="nilai_filter"
                            value="{{ request('nilai_filter') }}" placeholder="Masukkan nilai">
                    </div> --}}

                    <div class="mb-2">
                        <label for="nilai-ub-filter" class="form-label">Nilai UB</label>
                        <input type="number" class="form-control" id="nilai-ub-filter" name="nilai_ub_filter"
                            value="{{ request('nilai_ub_filter') }}" placeholder="Masukkan nilai UB">
                    </div>

                    <div class="mb-2">
                        <label for="nilai-uts-filter" class="form-label">Nilai UTS</label>
                        <input type="number" class="form-control" id="nilai-uts-filter" name="nilai_uts_filter"
                            value="{{ request('nilai_uts_filter') }}" placeholder="Masukkan nilai UTS">
                    </div>

                    <div class="mb-2">
                        <label for="nilai-uas-filter" class="form-label">Nilai UAS</label>
                        <input type="number" class="form-control" id="nilai-uas-filter" name="nilai_uas_filter"
                            value="{{ request('nilai_uas_filter') }}" placeholder="Masukkan nilai UAS">
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
