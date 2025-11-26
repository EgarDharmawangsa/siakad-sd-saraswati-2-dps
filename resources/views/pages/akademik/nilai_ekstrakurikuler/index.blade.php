@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            <div class="modifier-buttons">
                <div class="filter-modal-container">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>

                    @include('components.akademik.nilai_ekstrakurikuler_filter_modal')
                </div>
            </div>
        </div>

        {{-- @if ($siswa->isNotEmpty())  --}}
        {{-- <form action="{{ route('nilai.store') }}" method="POST"> --}}
        <form action="" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Siswa</th>
                            <th>Ekstrakurikuler</th>
                            <th>Semester</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @forelse ($nilai_ekstrakurikuler as $_nilai_ekstrakurikuler) --}}
                        <tr>
                            {{-- <td>{{ $loop->iteration }}</td>
                                    <td>{{ $_nilai_ekstrakurikuler->siswa->getFormatedNamaSiswa() }}</td>
                                    <td>{{ $_nilai_ekstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}</td>
                                    <td>{{ $_nilai_ekstrakurikuler->semester }}</td>
                                    <td>{{ $_nilai_ekstrakurikuler->nilai }}</td> --}}

                            {{-- Data Dummy --}}
                            <td>1</td>
                            <td>220040026 | I Komang Egar Suarama Dharmawangsa</td>
                            <td>
                                Menggambar
                                <input type="hidden" name="id_ekstrakurikuler[]" value="1">
                            </td>
                            <td>
                                1
                                <input type="hidden" name="id_semester[]" value="1">
                            </td>
                            <td>
                                <input type="hidden" name="id_siswa[]" value="1">
                                <input type="text" name="nilai[]" class="form-control nilai-input" value="90">
                            </td>

                            {{-- <td class="aksi-column">
                                        <a href="{{ route('nilai-ekstrakurikuler.show', $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler) }}"
                                            class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                        <a href="{{ route('nilai-ekstrakurikuler.edit', $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler) }}"
                                            class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                        <form
                                            action="{{ route('nilai-ekstrakurikuler.destroy', $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler) }}"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm delete-button"
                                                data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                <i class="bi bi-trash me-2"></i>Hapus</button>
                                        </form>
                                    </td> --}}
                        </tr>
                        {{-- @empty
                                <tr class="text-center">
                                    <td colspan="7">Belum ada Nilai Ekstrakurikuler.</td>
                                </tr>
                            @endforelse --}}
                    </tbody>
                </table>
            </div>

            @if ($nilai_ekstrakurikuler->hasPages())
                <div class="d-flex justify-content-end mt-2">
                    {{ $nilai_ekstrakurikuler->links() }}
                </div>
            @endif

            <button type="submit" class="btn btn-primary mt-4"><i class="bi bi-floppy me-2"></i>Simpan</button>
            <p class="mini-label mt-2 mb-0"><span class="text-danger fw-bold">Peringatan:</span> Simpan nilai
                sebelum berpindah ke halaman atau daftar berikutnya.</p>
        </form>
        {{-- @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif --}}
    </div>
@endsection
