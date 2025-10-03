@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('siswa.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah Siswa</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>No. KK</th>
                        <th>NIK</th>
                        <th>NISN</th>
                        <th>NIPD</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Berat Badan</th>
                        <th>Tinggi Badan</th>
                        <th>Lingkar Kepala</th>
                        <th>Jumlah Saudara Kandung</th>
                        <th>Anak Ke Berapa</th>
                        <th>Agama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No. Registrasi Akta Lahir</th>
                        <th>Alamat</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Dusun</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Kode Pos</th>
                        <th>Lintang</th>
                        <th>Bujur</th>
                        <th>Jarak Rumah ke Sekolah</th>
                        <th>Jenis Tinggal</th>
                        <th>Alat Transportasi</th>
                        <th>No. Telepon Rumah</th>
                        <th>No. Telepon Seluler</th>
                        <th>E-mail</th>
                        <th>Disabilitas</th>
                        <th>Keterangan Disabilitas</th>
                        <th>Sekolah Asal</th>
                        <th>No. Peserta UN</th>
                        <th>No. Seri Ijazah</th>
                        {{-- <th>No. Seri Ijazah</th> --}}
                        <th>Penerima KPS</th>
                        <th>No. KPS</th>
                        <th>Penerima KIP</th>
                        <th>No. KIP</th>
                        <th>Nama KIP</th>
                        <th>Layak PIP</th>
                        <th>Alasan Layak PIP</th>
                        <th>Nama Bank</th>
                        <th>No. Rekening</th>
                        <th>Nama Rekening</th>
                        <th>No. KKS</th>
                        <th>NIK Ayah</th>
                        <th>Nama Ayah</th>
                        <th>Tahun Lahir Ayah</th>
                        <th>Jenjang Pendidikan Ayah</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Penghasilan Ayah</th>
                        <th>NIK Ibu</th>
                        <th>Nama Ibu</th>
                        <th>Tahun Lahir Ibu</th>
                        <th>Jenjang Pendidikan Ibu</th>
                        <th>Pekerjaan Ibu</th>
                        <th>Penghasilan Ibu</th>
                        <th>NIK Wali</th>
                        <th>Nama Wali</th>
                        <th>Tahun Lahir Wali</th>
                        <th>Jenjang Pendidikan Wali</th>
                        <th>Pekerjaan Wali</th>
                        <th>Penghasilan Wali</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($siswa as $_siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_siswa->kelas->nama_kelas }}</td>
                            <td>{{ $_siswa->no_kk }}</td>
                            <td>01010939394484839</td>
                            <td>{{ $_siswa->nisn }}</td>
                            <td>{{ $_siswa->nipd }}</td>
                            <td>{{ $_siswa->nama_siswa }}</td>
                            <td>{{ $_siswa->jenis_kelamin }}</td>
                            <td>{{ $_siswa->berat_badan }}</td>
                            <td>{{ $_siswa->tinggi_badan }}</td>
                            <td>{{ $_siswa->lingkar_kepala }}</td>
                            <td>{{ $_siswa->jumlah_saudara_kandung }}</td>
                            <td>{{ $_siswa->anak_ke_berapa }}</td>
                            <td>{{ $_siswa->agama }}</td>
                            <td>{{ $_siswa->tempat_lahir }}</td>
                            <td>{{ $_siswa->tanggal_lahir->format('d-m-Y') }}</td>
                            <td>{{ $_siswa->no_registrasi_akta_lahir }}</td>
                            <td class="text-truncate">{{ $_siswa->alamat }}</td>
                            <td>{{ $_siswa->rt }}</td>
                            <td>{{ $_siswa->rw }}</td>
                            <td>{{ $_siswa->dusun }}</td>
                            <td>{{ $_siswa->kelurahan }}</td>
                            <td>{{ $_siswa->kecamatan }}</td>
                            <td>{{ $_siswa->kode_pos }}</td>
                            <td>{{ $_siswa->lintang }}</td>
                            <td>{{ $_siswa->bujur }}</td>
                            <td>{{ $_siswa->jarak_rumah_ke_sekolah }}</td>
                            <td>{{ $_siswa->jenis_tinggal }}</td>
                            <td>{{ $_siswa->alat_transportasi }}</td>
                            <td>{{ $_siswa->no_telepon_rumah }}</td>
                            <td>{{ $_siswa->no_telepon_seluler }}</td>
                            <td>{{ $_siswa->e_mail }}</td>
                            <td>{{ $_siswa->disabilitas }}</td>
                            <td class="text-truncate">{{ $_siswa->keterangan_disabilitas }}</td>
                            <td>{{ $_siswa->sekolah_asal }}</td>
                            <td>{{ $_siswa->no_peserta_un }}</td>
                            <td>{{ $_siswa->no_seri_ijazah }}</td>
                            <td>{{ $_siswa->penerima_kps }}</td>
                            <td>{{ $_siswa->no_kps }}</td>
                            <td>{{ $_siswa->penerima_kip }}</td>
                            <td>{{ $_siswa->no_kip }}</td>
                            <td>{{ $_siswa->nama_kip }}</td>
                            <td>{{ $_siswa->layak_pip }}</td>
                            <td class="text-truncate">{{ $_siswa->alasan_layak_pip }}</td>
                            <td>{{ $_siswa->nama_bank }}</td>
                            <td>{{ $_siswa->no_rekening }}</td>
                            <td>{{ $_siswa->nama_rekening }}</td>
                            <td>{{ $_siswa->no_kks }}</td>
                            <td>{{ $_siswa->nik_ayah }}</td>
                            <td>{{ $_siswa->nama_ayah }}</td>
                            <td>{{ $_siswa->tahun_lahir_ayah }}</td>
                            <td>{{ $_siswa->jenjang_pendidikan_ayah }}</td>
                            <td>{{ $_siswa->pekerjaan_ayah }}</td>
                            <td>{{ $_siswa->penghasilan_ayah }}</td>
                            <td>{{ $_siswa->nik_ibu }}</td>
                            <td>{{ $_siswa->nama_ibu }}</td>
                            <td>{{ $_siswa->tahun_lahir_ibu }}</td>
                            <td>{{ $_siswa->jenjang_pendidikan_ibu }}</td>
                            <td>{{ $_siswa->pekerjaan_ibu }}</td>
                            <td>{{ $_siswa->penghasilan_ibu }}</td>
                            <td>{{ $_siswa->nik_wali }}</td>
                            <td>{{ $_siswa->nama_wali }}</td>
                            <td>{{ $_siswa->tahun_lahir_wali }}</td>
                            <td>{{ $_siswa->jenjang_pendidikan_wali }}</td>
                            <td>{{ $_siswa->pekerjaan_wali }}</td>
                            <td>{{ $_siswa->penghasilan_wali }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('siswa.show', $_siswa->id_siswa) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('siswa.edit', $_siswa->id_siswa) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form id="delete-form" action="{{ route('pengumuman.destroy', $_siswa->id_siswa) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="button" class="btn btn-danger btn-sm" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#delete-modal">
                                        <i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="67">Belum ada Siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $siswa->links() }}
        </div>
    </div>
@endsection
