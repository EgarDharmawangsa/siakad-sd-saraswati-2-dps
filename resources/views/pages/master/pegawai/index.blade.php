@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('pegawai.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                    Pegawai</a>
            @endcan

            <div class="modifier-buttons">
                @canany(['staf-tata-usaha', 'guru'])
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle order-by-dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i
                                class="bi bi-sort-down me-2"></i>{{ request('order_by') === 'asc' ? 'Lama ke Terbaru' : 'Terbaru ke Lama' }}
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item order-by-dropdown-item {{ request('order_by') !== 'asc' || !request('order_by') ? 'active' : '' }}"
                                    href="{{ request()->fullUrlWithQuery(['order_by' => 'desc']) }}">Terbaru ke Lama</a>
                            </li>
                            <li><a class="dropdown-item order-by-dropdown-item {{ request('order_by') === 'asc' ? 'active' : '' }}"
                                    href="{{ request()->fullUrlWithQuery(['order_by' => 'asc']) }}">Lama ke Terbaru</a></li>
                        </ul>
                    </div>
                @endcanany

                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                    <i class="bi bi-funnel me-2"></i>Filter
                </button>

                @include('components.master.pegawai_filter_modal')
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    {{-- <tr>
                        <th rowspan="2">No.</td>
                        <th colspan="12">Pribadi</th>
                        <th colspan="8">Kepegawaian</th>
                        <th colspan="4">Pendidikan & Sertifikasi</th>
                        <th colspan="2">SK</th>
                        <th rowspan="2">Aksi</th>
                    </tr> --}}
                    {{-- <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Username</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Status Perkawinan</th>
                        <th>Alamat</th>
                        <th>No. Telepon Rumah</th>
                        <th>No. Telepon Seluler</th>
                        <th>E Mail</th>

                        <th>Posisi</th>
                        <th>Guru Mata Pelajaran</th>
                        <th>Status Kepegawaian</th>
                        <th>NIP</th>
                        <th>NIPPPK</th>
                        <th>Jabatan</th>
                        <th>Permulaan Kerja</th>
                        <th>Permulaan Kerja (RASDA)</th>

                        <th>Ijazah Terakhir</th>
                        <th>Tahun Ijazah</th>
                        <th>Status Sertifikasi</th>
                        <th>Tahun Sertifikasi</th>

                        <th>No. SK</th>
                        <th>Tanggal SK Terakhir</th>
                        <th>Aksi</th>
                    </tr> --}}
                    <tr>
                        <th>No.</th>

                        @canany(['staf-tata-usaha', 'guru'])
                            <th>NIP</th>
                            <th>NIPPPK</th>
                        @endcanany

                        <th>Nama Pegawai</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>No. Telp (WA)</th>
                        <th>Alamat</th>

                        @canany(['staf-tata-usaha', 'guru'])
                            <th>Posisi</th>
                            <th>Status Kepegawaian</th>
                        @endcanany
                        
                        <th>Guru Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pegawai as $_pegawai)
                        <tr>
                            {{-- <td>{{ $loop->iteration }}</td>
                            <td>{{ $_pegawai->nik }}</td>
                            <td>{{ $_pegawai->userAuth?->username ?? '-' }}</td>
                            <td>{{ $_pegawai->nama_pegawai }}</td>
                            <td>{{ $_pegawai->jenis_kelamin }}</td>
                            <td>{{ $_pegawai->tempat_lahir }}</td>
                            <td>{{ $_pegawai->getFormatedTanggal('tanggal_lahir') }}</td>
                            <td>{{ $_pegawai->agama }}</td>
                            <td>{{ $_pegawai->status_perkawinan }}</td>
                            <td class="text-truncate">{{ $_pegawai->alamat }}</td>
                            <td>{{ $_pegawai->no_telepon_rumah ?? '-' }}</td>
                            <td>{{ $_pegawai->no_telepon_seluler }}</td>
                            <td>{{ $_pegawai->e_mail ?? '-' }}</td>
                            <td>{{ $_pegawai->posisi }}</td>
                            <td>
                                @if ($_pegawai->posisi === 'Guru')
                                    {{ $_pegawai->guruMataPelajaran?->count() }} Mata Pelajaran
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $_pegawai->status_kepegawaian ?? '-' }}</td>
                            <td>{{ $_pegawai->nip ?? '-' }}</td>
                            <td>{{ $_pegawai->nipppk ?? '-' }}</td>
                            <td>{{ $_pegawai->jabatan ?? '-' }}</td>
                            <td>{{ $_pegawai->getFormatedTanggal('permulaan_kerja') }}</td>
                            <td>{{ $_pegawai->getFormatedTanggal('permulaan_kerja_sds2') }}</td>
                            <td>{{ $_pegawai->ijazah_terakhir ?? '-' }}</td>
                            <td>{{ $_pegawai->tahun_ijazah ?? '-' }}</td>
                            <td>{{ $_pegawai->status_sertifikasi }}</td>
                            <td>{{ $_pegawai->tahun_sertifikasi ?? '-' }}</td>
                            <td>{{ $_pegawai->no_sk ?? '-' }}</td> --}}

                            <td>{{ $loop->iteration }}</td>

                            @canany(['staf-tata-usaha', 'guru'])
                                <td>{{ $_pegawai->nip ?? '-' }}</td>
                                <td>{{ $_pegawai->nipppk ?? '-' }}</td>
                            @endcanany

                            <td>{{ $_pegawai->nama_pegawai }}</td>
                            <td>{{ $_pegawai->jenis_kelamin }}</td>
                            <td>{{ $_pegawai->agama }}</td>
                            <td>{{ $_pegawai->no_telepon_seluler }}</td>
                            <td class="text-truncate">{{ $_pegawai->alamat }}</td>

                            @canany(['staf-tata-usaha', 'guru'])
                                <td>{{ $_pegawai->posisi }}</td>
                                <td>{{ $_pegawai->status_kepegawaian }}</td>
                            @endcanany

                            <td>
                                @if ($_pegawai->posisi === 'Guru')
                                    {{ $_pegawai->guruMataPelajaran?->count() }} Mata Pelajaran
                                @else
                                    -
                                @endif
                            </td>
                            <td class="aksi-column">
                                <a href="{{ request()->routeIs('pegawai.index') ? route('pegawai.show', $_pegawai->id_pegawai) : route('guru.show', $_pegawai->id_pegawai) }}"
                                    class="btn btn-info"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                @can('staf-tata-usaha')
                                    <a href="{{ route('pegawai.edit', $_pegawai->id_pegawai) }}"
                                        class="btn btn-warning mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                    <form action="{{ route('pegawai.destroy', $_pegawai->id_pegawai) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal"
                                            data-bs-target="#delete-modal">
                                            <i class="bi bi-trash me-2"></i>Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            @canany(['staf-tata-usaha', 'guru'])
                                <td colspan="28">Belum ada Pegawai.</td>
                            @endcanany

                            @can('siswa')
                                <td colspan="28">Belum ada Guru.</td>
                            @endcan
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pegawai->hasPages())
            <div class="d-flex justify-content-end mt-2">
                {{ $pegawai->links() }}
            </div>
        @endif
    </div>
@endsection
