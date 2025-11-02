@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="d-flex align-items-center flex-wrap mb-4">
            <a href="{{ route('pegawai.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                Pegawai</a>

            <div class="dropdown order-by-dropdown">
                <a class="btn btn-secondary dropdown-toggle order-by-dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sort-down me-2"></i>
                    @if (request('order_by') === 'desc' || !request('order_by'))
                        Terbaru ke Lama
                    @else
                        Lama ke Terbaru
                    @endif
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item order-by-dropdown-item"
                            href="{{ request()->fullUrlWithQuery(['order_by' => 'desc']) }}"
                            {{ request('order_by') === 'desc' || !request('order_by') ? 'active' : '' }}>Terbaru ke Lama</a>
                    </li>
                    <li><a class="dropdown-item order-by-dropdown-item"
                            href="{{ request()->fullUrlWithQuery(['order_by' => 'asc']) }}"
                            {{ request('order_by') === 'asc' ? 'active' : '' }}>Lama ke Terbaru</a></li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama Pegawai</th>
                        <th>Username</th>
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
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pegawai as $_pegawai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_pegawai->nik }}</td>
                            <td>{{ $_pegawai->nama_pegawai }}</td>
                            <td>{{ $_pegawai->userAuth?->username ?? '-' }}</td>
                            <td>{{ $_pegawai->jenis_kelamin }}</td>
                            <td>{{ $_pegawai->tempat_lahir }}</td>
                            <td>{{ $_pegawai->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>{{ $_pegawai->agama }}</td>
                            <td>{{ $_pegawai->status_perkawinan }}</td>
                            <td class="text-truncate">{{ $_pegawai->alamat }}</td>
                            <td>{{ $_pegawai->no_telepon_rumah ?? '-' }}</td>
                            <td>{{ $_pegawai->no_telepon_seluler }}</td>
                            <td>{{ $_pegawai->e_mail ?? '-' }}</td>
                            <td>{{ $_pegawai->posisi }}</td>
                            <td>{{ $_pegawai->posisi === 'Guru' ? $_pegawai->guruMataPelajaran?->count() . ' Mata Pelajaran' : '-' }}
                            </td>
                            <td>{{ $_pegawai->status_kepegawaian ?? '-' }}</td>
                            <td>{{ $_pegawai->nip ?? '-' }}</td>
                            <td>{{ $_pegawai->nipppk ?? '-' }}</td>
                            <td>{{ $_pegawai->jabatan ?? '-' }}</td>
                            <td>{{ $_pegawai->permulaan_kerja->format('d-m-Y') }}</td>
                            <td>{{ $_pegawai->permulaan_kerja_sds2->format('d-m-Y') }}</td>
                            <td>{{ $_pegawai->ijazah_terakhir ?? '-' }}</td>
                            <td>{{ $_pegawai->tahun_ijazah ?? '-' }}</td>
                            <td>{{ $_pegawai->status_sertifikasi }}</td>
                            <td>{{ $_pegawai->tahun_sertifikasi ?? '-' }}</td>
                            <td>{{ $_pegawai->no_sk ?? '-' }}</td>
                            <td>{{ $_pegawai->tanggal_sk_terakhir?->format('d-m-Y') ?? '-' }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('pegawai.show', $_pegawai->id_pegawai) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('pegawai.edit', $_pegawai->id_pegawai) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('pegawai.destroy', $_pegawai->id_pegawai) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                        data-bs-toggle="modal" data-bs-target="#delete-modal">
                                        <i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="28">Belum ada Pegawai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $pegawai->links() }}
        </div>
    </div>
@endsection
