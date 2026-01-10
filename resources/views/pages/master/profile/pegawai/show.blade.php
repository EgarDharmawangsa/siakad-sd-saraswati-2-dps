@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>
        <div class="show-buttons">
            <a href="{{ route('beranda') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm me-1"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
        </div>
        <ul class="nav nav-tabs" id="pegawai-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="data-pribadi-tab-button" data-bs-toggle="tab" data-bs-target="#data-pribadi-tab"
                    type="button" role="tab">Pribadi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-kepegawaian-tab-button" data-bs-toggle="tab" data-bs-target="#data-kepegawaian-tab"
                    type="button" role="tab">Kepegawaian</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-pendidikan-tab-button" data-bs-toggle="tab" data-bs-target="#data-pendidikan-tab"
                    type="button" role="tab">Pendidikan & Sertifikasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-sk-tab-button" data-bs-toggle="tab" data-bs-target="#data-sk-tab" 
                    type="button" role="tab">SK</button>
            </li>
        </ul>

        <div class="tab-content mb-0" id="pegawai-tab-content">
            <div class="tab-pane fade show active" id="data-pribadi-tab" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-12 mt-4 d-flex justify-content-center">
                        @if ($user->foto)
                            <img src="{{ asset("storage/{$user->foto}") }}" alt="Foto Pegawai" 
                                    class="foto my-3">
                        @else
                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Default Foto" 
                                    class="foto my-3">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">NIK</label>
                        <input type="text" class="form-control" value="{{ $user->nik }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Nama Pegawai</label>
                        <input type="text" class="form-control" value="{{ $user->nama_pegawai }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $user->jenis_kelamin }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tempat Lahir</label>
                        <input type="text" class="form-control" value="{{ $user->tempat_lahir }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tanggal Lahir</label>
                        <input type="text" class="form-control" 
                               value="{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d F Y') : '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Agama</label>
                        <input type="text" class="form-control" value="{{ $user->agama }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Status Perkawinan</label>
                        <input type="text" class="form-control" value="{{ $user->status_perkawinan }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Alamat</label>
                        <input type="text" class="form-control" value="{{ $user->alamat }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">No. Telepon Rumah</label>
                        <input type="text" class="form-control" value="{{ $user->no_telepon_rumah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">No. Telepon Seluler</label>
                        <input type="text" class="form-control" value="{{ $user->no_telepon_seluler }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">E-Mail</label>
                        <input type="text" class="form-control" value="{{ $user->e_mail ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Username</label>
                        <input type="text" class="form-control" value="{{ $user->userAuth?->username ?? '-' }}" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    {{-- Tombol Next (Class btn-nav Wajib ada) --}}
                    <button type="button" class="btn btn-primary btn-nav" data-next="#data-kepegawaian-tab">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>

            <div class="tab-pane fade" id="data-kepegawaian-tab" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label ">Posisi</label>
                        <input type="text" class="form-control" value="{{ $user->posisi }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Guru Mata Pelajaran</label>
                        <div class="dropdown w-100">
                            <button class="form-select text-start w-100 {{ $user->guruMataPelajaran?->isEmpty() ? 'text-muted' : '' }}" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->guruMataPelajaran?->isNotEmpty() ? $user->guruMataPelajaran->count() . ' Mata Pelajaran' : 'Tidak ada mapel' }}
                            </button>
                            @if ($user->guruMataPelajaran?->isNotEmpty())
                                <ul class="dropdown-menu w-100 p-2 shadow-sm border-0">
                                    @foreach ($user->guruMataPelajaran as $_guru_mata_pelajaran)
                                        <li>
                                            <div class="dropdown-item d-flex align-items-center" style="cursor: default;">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                {{ $_guru_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Status Kepegawaian</label>
                        <input type="text" class="form-control" value="{{ $user->status_kepegawaian ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">NIP</label>
                        <input type="text" class="form-control" value="{{ $user->nip ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">NIPPPK</label>
                        <input type="text" class="form-control" value="{{ $user->nipppk ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Jabatan</label>
                        <input type="text" class="form-control" value="{{ $user->jabatan ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tanggal Permulaan Kerja</label>
                        <input type="text" class="form-control" 
                               value="{{ $user->permulaan_kerja ? $user->permulaan_kerja->format('d F Y') : '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ">Tanggal Permulaan Kerja (RASDA)</label>
                        <input type="text" class="form-control" 
                               value="{{ $user->permulaan_kerja_sds2 ? $user->permulaan_kerja_sds2->format('d F Y') : '-' }}" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#data-pribadi-tab">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#data-pendidikan-tab">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
            <div class="tab-pane fade" id="data-pendidikan-tab" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label ">Ijazah Terakhir</label>
                        <input type="text" class="form-control" value="{{ $user->ijazah_terakhir ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tahun Ijazah</label>
                        <input type="text" class="form-control" value="{{ $user->tahun_ijazah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Status Sertifikasi</label>
                        <input type="text" class="form-control" value="{{ $user->status_sertifikasi ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tahun Sertifikasi</label>
                        <input type="text" class="form-control" value="{{ $user->tahun_sertifikasi ?? '-' }}" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#data-kepegawaian-tab">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <button type="button" class="btn btn-primary btn-nav" data-next="#data-sk-tab">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>

            <div class="tab-pane fade" id="data-sk-tab" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label ">Nomor SK</label>
                        <input type="text" class="form-control" value="{{ $user->no_sk ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ">Tanggal SK Terakhir</label>
                        <input type="text" class="form-control" 
                               value="{{ $user->tanggal_sk_terakhir ? $user->tanggal_sk_terakhir->format('d F Y') : '-' }}" readonly>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-nav mt-4" data-next="#data-pendidikan-tab">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </button>
            </div>
        </div>
    </div>
    {{-- @can('staf-tata-usaha')
    <div class="modal fade" id="delete-modal-{{ $user->id_pegawai }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-circle text-danger display-4"></i>
                    </div>
                    <p class="mb-1">Apakah Anda yakin ingin menghapus data pegawai:</p>
                    <p class=" fs-5 text-dark">{{ $user->nama_pegawai }}</p>
                    <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('pegawai.destroy', $user->id_pegawai) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan --}}

@endsection