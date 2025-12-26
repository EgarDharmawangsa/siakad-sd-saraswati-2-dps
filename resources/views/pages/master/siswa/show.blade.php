@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>
        <div class="show-buttons mb-4">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm me-1">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-sm me-1 text-white">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $siswa->id_siswa }}">
                <i class="bi bi-trash me-2"></i>Hapus
            </button>
        </div>
        <ul class="nav nav-tabs mb-3" id="detail-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="detail-pribadi" data-bs-toggle="tab" data-bs-target="#view-pribadi" type="button">Data Pribadi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-alamat" data-bs-toggle="tab" data-bs-target="#view-alamat" type="button">Alamat</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-ortu" data-bs-toggle="tab" data-bs-target="#view-ortu" type="button">Orang Tua</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-pendidikan" data-bs-toggle="tab" data-bs-target="#view-pendidikan" type="button">Pendidikan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-bantuan" data-bs-toggle="tab" data-bs-target="#view-bantuan" type="button">Bantuan</button>
            </li>
        </ul>
        <div class="tab-content" id="detail-tab-content">
            <div class="tab-pane fade show active" id="view-pribadi">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ $siswa->userAuth->username ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" value="{{ $siswa->kelas->nama_kelas ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_siswa }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">NISN</label>
                        <input type="text" class="form-control" value="{{ $siswa->nisn }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">NIPD</label>
                        <input type="text" class="form-control" value="{{ $siswa->nipd }}" readonly>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" value="{{ $siswa->nik }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" value="{{ $siswa->tempat_lahir }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $siswa->jenis_kelamin }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Agama</label>
                        <input type="text" class="form-control" value="{{ $siswa->agama }}" readonly>
                    </div>

                    <div class="col-12"><hr class="text-muted opacity-25"></div>
                    <div class="col-12"><label class="form-label fw-bold">Data Fisik</label></div>

                    <div class="col-md-3">
                        <label class="form-label">Berat (kg)</label>
                        <input type="text" class="form-control" value="{{ $siswa->berat_badan }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tinggi (cm)</label>
                        <input type="text" class="form-control" value="{{ $siswa->tinggi_badan }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Disabilitas</label>
                        <input type="text" class="form-control" value="{{ $siswa->disabilitas }} {{ $siswa->keterangan_disabilitas ? '('.$siswa->keterangan_disabilitas.')' : '' }}" readonly>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="view-alamat">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" rows="3" readonly>{{ $siswa->alamat }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">RT</label>
                        <input type="text" class="form-control" value="{{ $siswa->rt }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">RW</label>
                        <input type="text" class="form-control" value="{{ $siswa->rw }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dusun</label>
                        <input type="text" class="form-control" value="{{ $siswa->dusun }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" value="{{ $siswa->kelurahan }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" value="{{ $siswa->kecamatan }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $siswa->kode_pos }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Tinggal</label>
                        <input type="text" class="form-control" value="{{ $siswa->jenis_tinggal }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Transportasi</label>
                        <input type="text" class="form-control" value="{{ $siswa->alat_transportasi }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. HP (WA)</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_telepon_seluler }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-Mail</label>
                        <input type="text" class="form-control" value="{{ $siswa->e_mail }}" readonly>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="view-ortu">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card card-body bg-light border-0 h-100">
                            <h6 class="fw-bold text-primary mb-3">Data Ayah</h6>
                            <div class="mb-2">
                                <label class="form-label small">Nama</label>
                                <input type="text" class="form-control" value="{{ $siswa->nama_ayah }}" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">NIK</label>
                                <input type="text" class="form-control" value="{{ $siswa->nik_ayah }}" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $siswa->pekerjaan_ayah }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="card card-body bg-light border-0 h-100">
                            <h6 class="fw-bold text-danger mb-3">Data Ibu</h6>
                            <div class="mb-2">
                                <label class="form-label small">Nama</label>
                                <input type="text" class="form-control" value="{{ $siswa->nama_ibu }}" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">NIK</label>
                                <input type="text" class="form-control" value="{{ $siswa->nik_ibu }}" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $siswa->pekerjaan_ibu }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="card card-body bg-light border-0 h-100">
                            <h6 class="fw-bold text-success mb-3">Data Wali</h6>
                             <div class="mb-2">
                                <label class="form-label small">Nama</label>
                                <input type="text" class="form-control" value="{{ $siswa->nama_wali }}" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">NIK</label>
                                <input type="text" class="form-control" value="{{ $siswa->nik_wali }}" readonly>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $siswa->pekerjaan_wali }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="view-pendidikan">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Sekolah Asal</label>
                        <input type="text" class="form-control" value="{{ $siswa->sekolah_asal }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Peserta UN</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_peserta_un }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Seri Ijazah</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_seri_ijazah }}" readonly>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="view-bantuan">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Penerima KIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->penerima_kip }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">No. KIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_kip }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama di KIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_kip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Layak PIP</label>
                         <input type="text" class="form-control" value="{{ $siswa->layak_pip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alasan Layak PIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->alasan_layak_pip }}" readonly>
                    </div>
                    <div class="col-12"><hr class="text-muted opacity-25"></div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_bank }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">No. Rekening</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_rekening }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Atas Nama</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_rekening }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal-{{ $siswa->id_siswa }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data siswa <strong>{{ $siswa->nama_siswa }}</strong>? Data yang dihapus tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection