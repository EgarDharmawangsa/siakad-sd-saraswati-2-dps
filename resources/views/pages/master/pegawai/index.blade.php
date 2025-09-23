@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('pegawai.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah
            Pegawai</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>No. Telepon Rumah</th>
                        <th>No. Telepon Seluler</th>
                        <th>E Mail</th>
                        <th>Pangkat</th>
                        <th>Status Perkawinan</th>
                        <th>Status Kepegawaian</th>
                        <th>Gelar Ijazah</th>
                        <th>Tahun Ijazah</th>
                        <th>Posisi</th>
                        <th>Status Sertifikasi</th>
                        <th>Tahun Sertifikasi</th>
                        <th>Permulaan Kerja</th>
                        <th>Permulaan Kerja (RASDA)</th>
                        <th>No. SK</th>
                        <th>Tanggal SK Terakhir</th>
                        <th>Golongan Ruang</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pegawai as $_pegawai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_pegawai->nik }}</td>
                            <td>{{ $_pegawai->nip }}</td>
                            <td>{{ $_pegawai->nama_pegawai }}</td>
                            <td>{{ $_pegawai->jenis_kelamin }}</td>
                            <td>{{ $_pegawai->agama }}</td>
                            <td>{{ $_pegawai->tempat_lahir }}</td>
                            <td>{{ $_pegawai->tanggal_lahir->format('d-m-Y') }}</td>
                            <td class="text-truncate">{{ $_pegawai->alamat }}</td>
                            <td>{{ $_pegawai->no_telepon_rumah }}</td>
                            <td>{{ $_pegawai->no_telepon_seluler }}</td>
                            <td>{{ $_pegawai->e_mail }}</td>
                            <td>{{ $_pegawai->pangkat }}</td>
                            <td>{{ $_pegawai->status_perkawinan }}</td>
                            <td>{{ $_pegawai->status_kepegawaian }}</td>
                            <td>{{ $_pegawai->gelar_ijazah }}</td>
                            <td>{{ $_pegawai->tahun_ijazah }}</td>
                            <td>{{ $_pegawai->posisi }}</td>
                            <td>{{ $_pegawai->status_sertifikasi }}</td>
                            <td>{{ $_pegawai->tahun_sertifikasi }}</td>
                            <td>{{ $_pegawai->permulaan_kerja }}</td>
                            <td>{{ $_pegawai->permulaan_kerja_sds2 }}</td>
                            <td>{{ $_pegawai->no_sk }}</td>
                            <td>{{ $_pegawai->tanggal_sk_terakhir->format('d-m-Y') }}</td>
                            <td>{{ $_pegawai->golongan_ruang }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('pegawai.show', $_pegawai->id_pegawai) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('pegawai.edit', $_pegawai->id_pegawai) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form id="delete-form" action="{{ route('pengumuman.destroy', $_pengumuman->id_pengumuman) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="button" class="btn btn-danger btn-sm" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#delete-modal">
                                        <i class="bi bi-trash me-2"></i>Batal</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="25">Belum ada data Pegawai.</td>
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
