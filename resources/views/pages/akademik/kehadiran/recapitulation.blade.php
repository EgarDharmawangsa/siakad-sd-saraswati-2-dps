@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Rekapitulasi {{ $judul }}</h5>
        <hr>

        <div class="index-buttons mt-3">
            <a href="{{ route('kehadiran.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>

            <div class="modifier-buttons">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                    <i class="bi bi-funnel me-2"></i>Filter
                </button>

                @include('components.akademik.kehadiran_filter_modal')
            </div>
        </div>

        @if ($siswa->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            @canany(['staf-tata-usaha', 'guru'])
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                            @endcanany
                            <th>Semester</th>
                            <th>Hadir</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Alfa</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kehadiran as $_kehadiran)
                            <tr>
                                @canany(['staf-tata-usaha', 'guru'])
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $_kehadiran->siswa->getFormatedNamaSiswa(true) }}
                                    </td>

                                    <td>{{ $_kehadiran->siswa->kelas?->nama_kelas ?? '-' }}</td>
                                @endcanany

                                <td>
                                    {{ $_kehadiran->semester->getTahunAjaran(true) }}
                                    <span
                                        class="badge bg-{{ $_kehadiran->semester->getStatus() === 'Berjalan' ? 'success' : ($_kehadiran->semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }} ms-1">
                                        {{ $_kehadiran->semester->getStatus() }}
                                    </span>
                                </td>

                                <td>{{ $_kehadiran->hadir }} Kali</td>

                                <td>{{ $_kehadiran->izin }} Kali</td>

                                <td>{{ $_kehadiran->sakit }} Kali</td>

                                <td>{{ $_kehadiran->alfa }} Kali</td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                @canany(['staf-tata-usaha', 'guru'])
                                    <td colspan="8">Rekapitulasi Kehadiran tidak tersedia.</td>
                                @endcanany
                                @can('siswa')
                                    <td colspan="6">Rekapitulasi Kehadiran tidak tersedia.</td>
                                @endcan
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif
    </div>
@endsection
