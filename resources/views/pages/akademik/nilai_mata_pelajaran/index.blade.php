@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('guru')
                <a href="{{ route('nilai-mata-pelajaran.create') }}" class="btn btn-success"><i
                        class="bi bi-plus-lg me-2"></i>Tambah<span class="mx-2">/</span><i
                        class="bi bi-arrow-repeat me-2"></i>Sinkronkan Nilai Mata Pelajaran</a>
            @endcan

            <div class="modifier-buttons">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                    <i class="bi bi-funnel me-2"></i>Filter
                </button>

                @include('components.akademik.nilai_mata_pelajaran_filter_modal')
            </div>
        </div>

        @if ($siswa->isNotEmpty())
            <form action="{{ route('nilai-mata-pelajaran.mass-update') }}" method="POST" id="nilai-form">
                @method('PUT')
                @csrf

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                @canany(['staf-tata-usaha', 'guru'])
                                    <th>Siswa</th>
                                    <th>Kelas</th>
                                @endcanany
                                <th>Mata Pelajaran</th>
                                <th>Semester</th>
                                <th>Nilai Portofolio (Rata-Rata)</th>
                                <th>Nilai UB 1</th>
                                <th>Nilai UB 2</th>
                                <th>Nilai UTS</th>
                                <th>Nilai UAS</th>
                                <th>Nilai Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($nilai_mata_pelajaran as $_nilai_mata_pelajaran)
                                <tr>
                                    <td>
                                        <input type="hidden" name="id_nilai_mata_pelajaran[]"
                                            value="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}"
                                            data-row="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}">
                                        {{ $loop->iteration }}
                                    </td>

                                    @canany(['staf-tata-usaha', 'guru'])
                                        <td>{{ $_nilai_mata_pelajaran->siswa->getFormatedNamaSiswa(true) }}</td>

                                        <td>
                                            {{ $_nilai_mata_pelajaran->siswa->kelas?->nama_kelas ?? '-' }}
                                        </td>
                                    @endcanany

                                    <td>{{ $_nilai_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}</td>

                                    <td>
                                        {{ $_nilai_mata_pelajaran->semester->getTahunAjaran(true) }}
                                        <span
                                            class="badge bg-{{ $_nilai_mata_pelajaran->semester->getStatus() === 'Berjalan' ? 'success' : ($_nilai_mata_pelajaran->semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }} ms-1">
                                            {{ $_nilai_mata_pelajaran->semester->getStatus() }}
                                        </span>
                                    </td>

                                    <td>{{ $_nilai_mata_pelajaran->getNilaiPortofolioAverage() }}</td>

                                    @canany('guru')
                                        <td>
                                            <input type="number"
                                                name="nilai_ub_1[{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}]"
                                                class="form-control nilai-input @error("nilai_ub_1.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}") is-invalid @enderror"
                                                value="{{ $_nilai_mata_pelajaran->nilai_ub_1 }}" min="0" max="100"
                                                data-row="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}"
                                                placeholder="Masukkan nilai UB 1">
                                            @error("nilai_ub_1.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    
                                        <td>
                                            <input type="number"
                                                name="nilai_ub_2[{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}]"
                                                class="form-control nilai-input @error("nilai_ub_2.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}") is-invalid @enderror"
                                                value="{{ $_nilai_mata_pelajaran->nilai_ub_2 }}" min="0" max="100"
                                                data-row="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}"
                                                placeholder="Masukkan nilai UB 2">
                                            @error("nilai_ub_2.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
 
                                        <td>
                                            <input type="number"
                                                name="nilai_uts[{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}]"
                                                class="form-control nilai-input @error("nilai_uts.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}") is-invalid @enderror"
                                                value="{{ $_nilai_mata_pelajaran->nilai_uts }}" min="0" max="100"
                                                data-row="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}"
                                                placeholder="Masukkan nilai UTS">
                                            @error("nilai_uts.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number"
                                                name="nilai_uas[{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}]"
                                                class="form-control nilai-input @error("nilai_uas.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}") is-invalid @enderror"
                                                value="{{ $_nilai_mata_pelajaran->nilai_uas }}" min="0" max="100"
                                                data-row="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}"
                                                placeholder="Masukkan nilai UAS">
                                            @error("nilai_uas.{$_nilai_mata_pelajaran->id_nilai_mata_pelajaran}")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    @endcan

                                    @canany(['staf-tata-usaha', 'siswa'])
                                        <td>
                                            {{ $_nilai_mata_pelajaran->nilai_ub_1 }}
                                        </td>

                                        <td>
                                            {{ $_nilai_mata_pelajaran->nilai_ub_2 }}
                                        </td>

                                        <td>
                                            {{ $_nilai_mata_pelajaran->nilai_uts }}
                                        </td>                                    

                                        <td>
                                            {{ $_nilai_mata_pelajaran->nilai_uas }}
                                        </td>
                                    @endcanany

                                    <td>{{ $_nilai_mata_pelajaran->getNilaiAkhir() }}</td>

                                    <td class="aksi-column">
                                        <a href="{{ route('nilai-mata-pelajaran.show', $_nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
                                            class="btn btn-info"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                        <a href="{{ route('nilai-mata-pelajaran.edit', $_nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
                                            class="btn btn-warning mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    @canany(['staf-tata-usaha', 'guru'])
                                        <td colspan="12">Belum ada Nilai Mata Pelajaran.</td>
                                    @endcanany

                                    @can('siswa')
                                        <td colspan="10">Belum ada Nilai Mata Pelajaran.</td>
                                    @endcan
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($nilai_mata_pelajaran->hasPages())
                    <div class="d-flex justify-content-end mt-2">
                        {{ $nilai_mata_pelajaran->links() }}
                    </div>
                @endif

                @can('guru')
                    <p class="mini-label text-muted mt-2 mb-0">
                        Penginputan Nilai Portofolio dilakukan pada halaman edit masing-masing data.
                    </p>

                    <div class="d-flex justify-content-between rounded-3 mt-4 p-3 submit-warning-container">
                        <p class="mini-label submit-warning-text">
                            Simpan nilai sebelum berpindah ke halaman atau daftar berikutnya!
                        </p>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy me-2"></i>Simpan
                        </button>
                    </div>
                
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('nilai-mata-pelajaran.delete') }}" class="btn btn-danger"><i
                                class="bi bi-trash me-2"></i>Hapus Nilai Mata Pelajaran</a>
                    </div>
                @endcan
            </form>
        @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif
    </div>
@endsection
