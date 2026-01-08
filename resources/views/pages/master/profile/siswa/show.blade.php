@extends('layouts.main')

@section('container')
    <div class="content-card">
        <h5>Detail {{ $judul }}</h5>
        <hr>
        <div class="show-buttons">
            <a href="{{ route('beranda') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm me-1"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
        </div>
        <ul class="nav nav-tabs" id="detail-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="detail-pribadi" data-bs-toggle="tab" data-bs-target="#view-pribadi"
                    type="button">Data Pribadi</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-alamat" data-bs-toggle="tab" data-bs-target="#view-alamat"
                    type="button">Alamat</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="detail-ortu" data-bs-toggle="tab" data-bs-target="#view-ortu"
                    type="button">Orang Tua</button>
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
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                        <div class="text-center">
                            @if ($user->foto)
                                <img src="{{ asset("storage/{$user->foto}") }}" alt="Foto Siswa" 
                                     class="foto">
                            @else
                                <img src="{{ asset('images/default_profile_photo.png') }}" alt="Default Foto" 
                                     class="foto">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ $user->userAuth->username ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ $user->nama_siswa }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" value="{{ $user->nik }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. KK</label>
                        <input type="text" class="form-control" value="{{ $user->no_kk }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NISN</label>
                        <input type="text" class="form-control" value="{{ $user->nisn }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIPD</label>
                        <input type="text" class="form-control" value="{{ $user->nipd }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" value="{{ $user->tempat_lahir }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control"
                            value="{{ $user->tanggal_lahir->translatedFormat('d F Y') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $user->jenis_kelamin }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Agama</label>
                        <input type="text" class="form-control" value="{{ $user->agama }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Tinggal</label>
                        <input type="text" class="form-control" value="{{ $user->jenis_tinggal }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alat Transportasi</label>
                        <input type="text" class="form-control" value="{{ $user->alat_transportasi }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telp Rumah</label>
                        <input type="text" class="form-control" value="{{ $user->no_telepon_rumah }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No HP (WA)</label>
                        <input type="text" class="form-control" value="{{ $user->no_telepon_seluler }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-Mail</label>
                        <input type="text" class="form-control" value="{{ $user->e_mail }}" readonly>
                    </div>
                    <div class="col-12">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold">Fisik & Disabilitas</label></div>
                    <div class="col-md-3">
                        <label class="form-label">Berat (kg)</label>
                        <input type="text" class="form-control" value="{{ $user->berat_badan }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tinggi (cm)</label>
                        <input type="text" class="form-control" value="{{ $user->tinggi_badan }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Lingkar Kepala (cm)</label>
                        <input type="text" class="form-control" value="{{ $user->lingkar_kepala }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jumlah Saudara Kandung</label>
                        <input type="text" class="form-control" value="{{ $user->jumlah_saudara_kandung }}"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Anak ke-</label>
                        <input type="text" class="form-control" value="{{ $user->anak_ke_berapa }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Reg Akta Lahir</label>
                        <input type="text" class="form-control" value="{{ $user->no_registrasi_akta_lahir }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Disabilitas</label>
                        <input type="text" class="form-control" value="{{ $user->disabilitas }}" readonly>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Keterangan Disabilitas</label>
                        <input type="text" class="form-control"
                            value="{{ $user->disabilitas }} {{ $user->keterangan_disabilitas ? '(' . $user->keterangan_disabilitas . ')' : '' }}"
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
                        <textarea class="form-control" rows="3" readonly>{{ $user->alamat }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RT</label>
                        <input type="text" class="form-control" value="{{ $user->rt }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RW</label>
                        <input type="text" class="form-control" value="{{ $user->rw }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dusun</label>
                        <input type="text" class="form-control" value="{{ $user->dusun }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan</label>
                        <input type="text" class="form-control" value="{{ $user->kelurahan }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" value="{{ $user->kecamatan }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" value="{{ $user->kode_pos }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lintang</label>
                        <input type="text" class="form-control" value="{{ $user->lintang }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bujur</label>
                        <input type="text" class="form-control" value="{{ $user->bujur }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
                        <input type="text" class="form-control" value="{{ $user->jarak_rumah_ke_sekolah }}"
                            readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#view-pribadi">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-ortu">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-ortu">
                <ul class="nav nav-tabs mb-3" id="ortuTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#detail-ayah">Data
                            Ayah</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#detail-ibu">Data Ibu</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#detail-wali">Data Wali</a>
                    </li>
                </ul>
                <div class="tab-content border px-3 pt-0 pb-3 rounded bg-white shadow-sm mb-3" id="ortuTabContent">
                    <div class="tab-pane fade show active" id="detail-ayah">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" value="{{ $user->nama_ayah }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK Ayah</label>
                                <input type="text" class="form-control" value="{{ $user->nik_ayah }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" value="{{ $user->tahun_lahir_ayah }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $user->pekerjaan_ayah }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pendidikan</label>
                                <input type="text" class="form-control" value="{{ $user->jenjang_pendidikan_ayah }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" value="{{ $user->penghasilan_ayah }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail-ibu">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" value="{{ $user->nama_ibu }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK Ibu</label>
                                <input type="text" class="form-control" value="{{ $user->nik_ibu }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" value="{{ $user->tahun_lahir_ibu }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $user->pekerjaan_ibu }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pendidikan</label>
                                <input type="text" class="form-control" value="{{ $user->jenjang_pendidikan_ibu }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" value="{{ $user->penghasilan_ibu }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail-wali">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Wali</label>
                                <input type="text" class="form-control" value="{{ $user->nama_wali }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIK Wali</label>
                                <input type="text" class="form-control" value="{{ $user->nik_wali }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tahun Lahir</label>
                                <input type="text" class="form-control" value="{{ $user->tahun_lahir_wali }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ $user->pekerjaan_wali }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pendidikan</label>
                                <input type="text" class="form-control" value="{{ $user->jenjang_pendidikan_wali }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Penghasilan</label>
                                <input type="text" class="form-control" value="{{ $user->penghasilan_wali }}"
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
                        <input type="text" class="form-control" value="{{ $user->sekolah_asal }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Peserta UN</label>
                        <input type="text" class="form-control" value="{{ $user->no_peserta_un }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Seri Ijazah</label>
                        <input type="text" class="form-control" value="{{ $user->no_seri_ijazah }}" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#view-ortu">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#view-bantuan">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="view-bantuan">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">KIP</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Penerima KIP</label>
                        <input type="text" class="form-control" value="{{ $user->penerima_kip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. KIP</label>
                        <input type="text" class="form-control" value="{{ $user->no_kip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama di KIP</label>
                        <input type="text" class="form-control" value="{{ $user->nama_kip }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">PIP</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Layak PIP</label>
                        <input type="text" class="form-control" value="{{ $user->layak_pip }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alasan Layak PIP</label>
                        <input type="text" class="form-control" value="{{ $user->alasan_layak_pip }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <hr class="text-muted opacity-25">
                    </div>
                    <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Bank</label></div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" value="{{ $user->nama_bank }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Rekening</label>
                        <input type="text" class="form-control" value="{{ $user->no_rekening }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Atas Nama</label>
                        <input type="text" class="form-control" value="{{ $user->nama_rekening }}" readonly>
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
                    <div class="col-md-4">
                        <label class="form-label ">Ekstrakurikuler</label>
                        <div class="dropdown w-100">
                            <button class="form-select text-start w-100 {{ $user->pesertaEkstrakurikuler?->isEmpty() ? 'text-muted' : '' }}" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->pesertaEkstrakurikuler?->isNotEmpty() ? $user->pesertaEkstrakurikuler->count() . ' Ekstrakurikuler' : 'Tidak mengikuti ekstrakurikuler' }}
                            </button>
                            @if ($user->pesertaEkstrakurikuler?->isNotEmpty())
                                <ul class="dropdown-menu w-100 p-2 shadow-sm border-0">
                                    @foreach ($user->pesertaEkstrakurikuler as $_peserta_ekstrakurikuler)
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
                    <div class="col-md-4">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" value="{{ $user->kelas?->nama_kelas }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nomor Urut</label>
                        <input type="text" class="form-control" value="{{ $user->nomor_urut }}" readonly>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-nav mt-4" data-next="#view-bantuan">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </button>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="deleteModal-{{ $user->id_siswa }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data siswa <strong>{{ $user->nama_siswa }}</strong>? Data yang dihapus tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('siswa.destroy', $user->id_siswa) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
