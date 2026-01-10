@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>
        <div class="show-buttons">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            @can('staf-tata-usaha')
                <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-warning btn-sm me-1"><i
                        class="bi bi-pencil me-2"></i>Edit</a>
                <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                        data-bs-target="#delete-modal">
                        <i class="bi bi-trash me-2"></i>Hapus</button>
                </form>
            @endcan
        </div>
        <ul class="nav nav-tabs" id="detail-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="detail-pribadi" data-bs-toggle="tab" data-bs-target="#view-pribadi"
                    type="button">Pribadi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-alamat" data-bs-toggle="tab" data-bs-target="#view-alamat"
                    type="button">Alamat</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-pendamping" data-bs-toggle="tab" data-bs-target="#view-pendamping"
                    type="button">Pendamping</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-pendidikan" data-bs-toggle="tab" data-bs-target="#view-pendidikan"
                    type="button">Pendidikan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-bantuan" data-bs-toggle="tab" data-bs-target="#view-bantuan"
                    type="button">Bantuan</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-akademik" data-bs-toggle="tab" data-bs-target="#view-akademik"
                    type="button">Akademik</button>
            </li>
        </ul>
        <div class="tab-content" id="detail-tab-content">
            <div class="tab-pane fade show active" id="view-pribadi">
                <div class="row g-3">
                    <div class="col-md-12 mt-4 d-flex justify-content-center">
                        @if ($siswa->foto)
                            <img src="{{ asset("storage/{$siswa->foto}") }}" alt="Foto Siswa" 
                                    class="foto my-3">
                        @else
                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Default Foto" 
                                    class="foto my-3">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ $siswa->userAuth->username ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_siswa }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" value="{{ $siswa->nik }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. KK</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_kk }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NISN</label>
                        <input type="text" class="form-control" value="{{ $siswa->nisn }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIPD</label>
                        <input type="text" class="form-control" value="{{ $siswa->nipd ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" value="{{ $siswa->tempat_lahir }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control"
                            value="{{ $siswa->tanggal_lahir->translatedFormat('d F Y') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $siswa->jenis_kelamin }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Agama</label>
                        <input type="text" class="form-control" value="{{ $siswa->agama }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Tinggal</label>
                        <input type="text" class="form-control" value="{{ $siswa->jenis_tinggal }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alat Transportasi</label>
                        <input type="text" class="form-control" value="{{ $siswa->alat_transportasi }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telp. Rumah</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_telepon_rumah }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. HP (WA)</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_telepon_seluler }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-Mail</label>
                        <input type="text" class="form-control" value="{{ $siswa->e_mail }}" readonly>
                    </div>
                    <div class="col-md-12 mt-0">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Fisik & Disabilitas</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="text" class="form-control" value="{{ $siswa->berat_badan ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <input type="text" class="form-control" value="{{ $siswa->tinggi_badan ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lingkar Kepala (cm)</label>
                        <input type="text" class="form-control" value="{{ $siswa->lingkar_kepala ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Saudara Kandung</label>
                        <input type="text" class="form-control" value="{{ $siswa->jumlah_saudara_kandung ?? '-' }}"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Anak ke-</label>
                        <input type="text" class="form-control" value="{{ $siswa->anak_ke_berapa ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Reg. Akta Lahir</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_registrasi_akta_lahir ?? '-' }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Disabilitas</label>
                        <input type="text" class="form-control" value="{{ $siswa->disabilitas }}" readonly>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Keterangan Disabilitas</label>
                        <input type="text" class="form-control"
                            value="{{ $siswa->keterangan_disabilitas ?? '-' }}"
                            readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-alamat">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-alamat">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" rows="3" readonly>{{ $siswa->alamat }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RT</label>
                        <input type="text" class="form-control" value="{{ $siswa->rt ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RW</label>
                        <input type="text" class="form-control" value="{{ $siswa->rw ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dusun</label>
                        <input type="text" class="form-control" value="{{ $siswa->dusun ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" value="{{ $siswa->kelurahan ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" value="{{ $siswa->kecamatan ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $siswa->kode_pos ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lintang</label>
                        <input type="text" class="form-control" value="{{ $siswa->lintang ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bujur</label>
                        <input type="text" class="form-control" value="{{ $siswa->bujur ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
                        <input type="text" class="form-control" value="{{ $siswa->jarak_rumah_ke_sekolah ?? '-' }}"
                            readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#view-pribadi">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-pendamping">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-pendamping">
                <ul class="nav nav-tabs mb-3" id="pendampingTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#detail-ayah">Ayah</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#detail-ibu">Ibu</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#detail-wali">Wali</a>
                    </li>
                </ul>
                <div class="tab-content border px-3 pt-0 pb-3 rounded bg-white shadow-sm mb-3" id="pendampingTabContent">
                    <div class="tab-pane fade show active" id="detail-ayah">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" value="{{ $siswa->nama_ayah ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK Ayah</label>
                                <input type="text" class="form-control" value="{{ $siswa->nik_ayah ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" value="{{ $siswa->tahun_lahir_ayah ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $siswa->pekerjaan_ayah ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenjang Pendidikan</label>
                                <input type="text" class="form-control" value="{{ $siswa->jenjang_pendidikan_ayah ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" value="{{ $siswa->penghasilan_ayah ?? '-' }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail-ibu">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" value="{{ $siswa->nama_ibu ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK Ibu</label>
                                <input type="text" class="form-control" value="{{ $siswa->nik_ibu ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" value="{{ $siswa->tahun_lahir_ibu ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $siswa->pekerjaan_ibu ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenjang Pendidikan</label>
                                <input type="text" class="form-control" value="{{ $siswa->jenjang_pendidikan_ibu ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" value="{{ $siswa->penghasilan_ibu ?? '-' }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail-wali">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" value="{{ $siswa->nama_wali ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK Wali</label>
                                <input type="text" class="form-control" value="{{ $siswa->nik_wali ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" value="{{ $siswa->tahun_lahir_wali ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $siswa->pekerjaan_wali ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenjang Pendidikan</label>
                                <input type="text" class="form-control" value="{{ $siswa->jenjang_pendidikan_wali ?? '-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" value="{{ $siswa->penghasilan_wali ?? '-' }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#view-alamat">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-pendidikan">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-pendidikan">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Sekolah Asal</label>
                        <input type="text" class="form-control" value="{{ $siswa->sekolah_asal ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Peserta UN</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_peserta_un ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Seri Ijazah</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_seri_ijazah ?? '-' }}" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#view-pendamping">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-bantuan">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-bantuan">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KPS</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Penerima KPS</label>
                        <input type="text" class="form-control" value="{{ $siswa->penerima_kps }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. KPS</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_kps ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-12 mt-0">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KKS</label></div>
                    <div class="col-md-6">
                        <label class="form-label">No. KKS</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_kks ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-12 mt-0">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KIP</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Penerima KIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->penerima_kip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. KIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_kip ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama di KIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_kip ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-12 mt-0">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">PIP</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Layak PIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->layak_pip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alasan Layak PIP</label>
                        <input type="text" class="form-control" value="{{ $siswa->alasan_layak_pip ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-12 mt-0">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Bank</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_bank ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Rekening</label>
                        <input type="text" class="form-control" value="{{ $siswa->no_rekening ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Atas Nama</label>
                        <input type="text" class="form-control" value="{{ $siswa->nama_rekening ?? '-' }}" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#view-pendidikan">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-akademik">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-akademik">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Kelas</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" value="{{ $siswa->kelas?->nama_kelas }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Urut</label>
                        <input type="text" class="form-control" value="{{ $siswa->nomor_urut }}" readonly>
                    </div>
                    
                    <div class="col-md-12 mt-0">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Ekstrakurikuler</label></div>
                    <div class="col-md-6">
                        <label class="form-label ">Ekstrakurikuler</label>
                        <div class="dropdown w-100">
                            <button class="form-select text-start w-100" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $siswa->pesertaEkstrakurikuler?->count() . ' Ekstrakurikuler' }}
                            </button>
                            @if ($siswa->pesertaEkstrakurikuler?->isNotEmpty())
                                <ul class="dropdown-menu w-100 p-2 shadow-sm border-0">
                                    @foreach ($siswa->pesertaEkstrakurikuler as $_peserta_ekstrakurikuler)
                                        <li>
                                            <div class="dropdown-item d-flex align-items-center" style="cursor: default;">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                {{ $_peserta_ekstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-nav mt-4" data-next="#view-bantuan">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </button>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="deleteModal-{{ $siswa->id_siswa }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
    </div> --}}
@endsection
