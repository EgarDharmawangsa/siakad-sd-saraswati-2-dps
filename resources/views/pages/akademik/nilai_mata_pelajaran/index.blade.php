@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="d-flex justify-content-end mb-4">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                <i class="bi bi-funnel me-2"></i>Filter
            </button>

            @include('components.akademik.nilai_mata_pelajaran_filter_modal')
        </div>

        {{-- @if ($siswa->isNotEmpty())  --}}
        <form action="{{ route('nilai-mata-pelajaran.update') }}" method="POST" id="nilai-form">
            @method('PATCH')
            @csrf
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Semester</th>
                            <th>Nilai Portofolio (Rata-rata)</th>
                            <th>Nilai UB</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @forelse ($nilai_mata_pelajaran as $_nilai_mata_pelajaran) --}}
                        <tr>
                            {{-- <td>{{ $loop->iteration }}</td>
                            <td><input type="hidden" name="nilai_mata_pelajaran[]" value="{{ $_nilai_mata_pelajaran->id_nilai_mata_pelajaran }}"></td>
                            <td>{{ $_nilai_mata_pelajaran->siswa->getFormatedNamaSiswa() }}</td>
                            <td>{{ $_nilai_mata_pelajaran->mata_pelajaran->nama_mata_pelajaran }}</td>
                            <td>{{ $_nilai_mata_pelajaran->semester->getTahunAjaran(true) }}</td>
                            <td>{{ $_nilai_mata_pelajaran->getNilaiPortofolioAverage() }}</td>
                            <td><input type="text" name="nilai_ub[]" class="form-control nilai-input" value="{{ $_nilai_mata_pelajaran->nilai_ub }}" min="0" max="100"></td> 
                            <td><input type="text" name="nilai_uts[]" class="form-control nilai-input" value="{{ $_nilai_mata_pelajaran->nilai_uts }}" min="0" max="100"></td> 
                            <td><input type="text" name="nilai_uas[]" class="form-control nilai-input" value="{{ $_nilai_mata_pelajaran->nilai_uas }}" min="0" max="100"></td> --}}

                            {{-- Data Dummy --}}
                            <td>1</td>
                            <td>220040026 | I Komang Egar Suarama Dharmawangsa</td>
                            <td>Bahasa Indonesia</td>
                            <td>Ganjil 2025/2026</td>
                            <td>75</td>
                            <td><input type="number" name="nilai_ub[]" class="form-control nilai-input" value="90"
                                    min="0" max="100"></td>
                            <td><input type="number" name="nilai_uts[]" class="form-control nilai-input" value="80"
                                    min="0" max="100"></td>
                            <td><input type="number" name="nilai_uas[]" class="form-control nilai-input" value="85"
                                    min="0" max="100"></td>

                            {{-- <td class="aksi-column">
                                        <a href="{{ route('nilai-mata-pelajaran.show', $_nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
                                            class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                        @can('staf-tata-usaha')
                                            <a href="{{ route('nilai-mata-pelajaran.edit', $_nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
                                                class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                            <form
                                                action="{{ route('nilai-mata-pelajaran.destroy', $_nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-danger btn-sm delete-button"
                                                    data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                    <i class="bi bi-trash me-2"></i>Hapus</button>
                                            </form>
                                        @endcan
                                    </td> --}}
                        </tr>
                        {{-- @empty
                                <tr class="text-center">
                                    <td colspan="7">Belum ada Nilai Mata Pelajaran.</td>
                                </tr>
                            @endforelse --}}
                    </tbody>
                </table>
            </div>

            @if ($nilai_mata_pelajaran->hasPages())
                <div class="d-flex justify-content-end mt-2">
                    {{ $nilai_mata_pelajaran->links() }}
                </div>
            @endif

            <p class="mini-label text-muted mt-2 mb-0">Penginputan Nilai Portofolio dilakukan pada halaman edit masing-masing data.</p>

            <div class="d-flex justify-content-between rounded-3 mt-4 p-3 nilai-submit-container">
                <p class="mini-label nilai-submit-warning-text">Simpan nilai sebelum berpindah ke halaman atau daftar
                    berikutnya!</p>
                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy me-2"></i>Simpan</button>
            </div>
        </form>
        {{-- @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif --}}
    </div>
@endsection
