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
                <form id="filter-modal-form" action="{{ route('jadwal-pelajaran.index') }}">
                    @canany(['staf-tata-usaha', 'guru'])
                        <div class="mb-3">
                            <label for="kelas-filter" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas-filter" name="kelas_filter"
                                {{ $all_kelas->isEmpty() ? 'disabled' : '' }}>
                                <option value="">
                                    {{ $all_kelas->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}
                                </option>
                                @foreach ($all_kelas as $_all_kelas)
                                    <option value="{{ $_all_kelas->id_kelas }}"
                                        {{ request('kelas_filter') == $_all_kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $_all_kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endcanany

                    <div class="mb-3">
                        <label for="kegiatan-filter" class="form-label">Kegiatan</label>
                        <select class="form-select" id="kegiatan-filter" name="kegiatan_filter">
                            <option value="">-- Pilih Kegiatan --</option>
                            <option value="belajar" {{ request('kegiatan_filter') === 'belajar' ? 'selected' : '' }}>Belajar
                            </option>
                            <option value="istirahat" {{ request('kegiatan_filter') === 'istirahat' ? 'selected' : '' }}>Istirahat
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="mata-pelajaran-filter" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="mata-pelajaran-filter" name="mata_pelajaran_filter"
                            {{ $mata_pelajaran->isEmpty() ? 'disabled' : '' }}>
                            <option value="">
                                {{ $mata_pelajaran->isNotEmpty() ? '-- Pilih Mata Pelajaran --' : '-- Mata Pelajaran Tidak Tersedia --' }}
                            </option>
                            @foreach ($mata_pelajaran as $_mata_pelajaran)
                                <option value="{{ $_mata_pelajaran->id_mata_pelajaran }}"
                                    {{ request('mata_pelajaran_filter') == $_mata_pelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                                    {{ $_mata_pelajaran->nama_mata_pelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="guru-filter" class="form-label">Guru</label>
                        <select class="form-select" id="guru-filter" name="guru_filter"
                            {{ $guru->isEmpty() ? 'disabled' : '' }}>
                            <option value="">
                                {{ $guru->isNotEmpty() ? '-- Pilih Kelas --' : '-- Kelas Tidak Tersedia --' }}
                            </option>
                            @foreach ($guru as $_guru)
                                <option value="{{ $_guru->id_pegawai }}"
                                    {{ request('guru_filter') == $_guru->id_pegawai ? 'selected' : '' }}>
                                    {{ $_guru->getFormatedNamaPegawai() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hari-filter" class="form-label">Hari</label>
                        <select class="form-select" id="hari-filter" name="hari_filter">
                            <option value="">-- Pilih Hari --</option>
                            <option value="senin" {{ request('hari_filter') === 'senin' ? 'selected' : '' }}>Senin
                            </option>
                            <option value="selasa" {{ request('hari_filter') === 'selasa' ? 'selected' : '' }}>Selasa
                            </option>
                            <option value="rabu" {{ request('hari_filter') === 'rabu' ? 'selected' : '' }}>Rabu
                            </option>
                            <option value="kamis" {{ request('hari_filter') === 'kamis' ? 'selected' : '' }}>Kamis
                            </option>
                            <option value="jumat" {{ request('hari_filter') === 'jumat' ? 'selected' : '' }}>Jumat
                            </option>
                            <option value="sabtu" {{ request('hari_filter') === 'sabtu' ? 'selected' : '' }}>Sabtu
                            </option>
                            <option value="minggu" {{ request('hari_filter') === 'minggu' ? 'selected' : '' }}>Minggu
                            </option>
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
