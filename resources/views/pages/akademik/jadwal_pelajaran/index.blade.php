@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            <a href="{{ route('jadwal-pelajaran.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                Jadwal Pelajaran</a>

            <div class="modifier-buttons">
                <div>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>

                    @include('components.akademik.jadwal_pelajaran_filter_modal')
                </div>
            </div>
        </div>

        @forelse ($kelas as $_kelas)
            <div class="jadwal-pelajaran-container {{ !$loop->last ? 'mb-3' : '' }}">
                <h5 class="mb-0">Kelas : {{ $_kelas->nama_kelas }}</h5>
                <p class="mt-2 mb-0 wali-kelas-label">Wali Kelas : {{ $_kelas->pegawai?->getFormatedNamaPegawai() ?? '-' }}
                </p>
                <hr>

                @php
                    $jadwal_per_hari = $_kelas->jadwalPelajaran->groupBy('hari');
                @endphp

                @forelse ($jadwal_per_hari as $hari => $jadwal_pelajaran)
                    <div class="table-responsive jadwal-pelajaran-table mt-3">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="6">{{ $hari }}</th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Jam Mulai (WITA)</th>
                                    <th>Jam Selesai (WITA)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($jadwal_pelajaran as $_jadwal_pelajaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        @if ($_jadwal_pelajaran->kegiatan === 'Belajar')
                                            <td>{{ $_jadwal_pelajaran->guruMataPelajaran->mataPelajaran->nama_mata_pelajaran }}
                                            </td>
                                            <td>{{ $_jadwal_pelajaran->guruMataPelajaran->pegawai->getFormatedNamaPegawai() }}
                                            </td>
                                        @else
                                            <td colspan="2" class="text-center">Istirahat</td>
                                        @endif

                                        <td>{{ $_jadwal_pelajaran->getFormatedJam('jam_mulai') }}</td>
                                        <td>{{ $_jadwal_pelajaran->getFormatedJam('jam_selesai') }}</td>
                                        <td class="aksi-column">
                                            <a href="{{ route('jadwal-pelajaran.show', $_jadwal_pelajaran->id_jadwal_pelajaran) }}"
                                                class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                            <a href="{{ route('jadwal-pelajaran.edit', $_jadwal_pelajaran->id_jadwal_pelajaran) }}"
                                                class="btn btn-warning btn-sm mx-1"><i
                                                    class="bi bi-pencil me-2"></i>Edit</a>
                                            <form
                                                action="{{ route('jadwal-pelajaran.destroy', $_jadwal_pelajaran->id_jadwal_pelajaran) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-button"
                                                    data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                    <i class="bi bi-trash me-2"></i>Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @empty
                    <p class="empty-message text-center mb-0 p-3 rounded">Belum ada Jadwal Pelajaran.</p>
                @endforelse
            </div>
        @empty
            <p class="empty-message text-center mb-0 p-3 rounded">Kelas tidak tersedia.</p>
        @endforelse

        @if ($kelas->hasPages())
            <div class="d-flex justify-content-end">
                {{ $kelas->links() }}
            </div>
        @endif
    </div>
@endsection
