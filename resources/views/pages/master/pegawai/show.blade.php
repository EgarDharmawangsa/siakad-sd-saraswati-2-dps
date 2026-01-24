@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>
        <div class="show-buttons">
            @canany(['staf-tata-usaha', 'guru'])
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            @endcanany

            @can('siswa')
                <a href="{{ route('guru.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            @endcan

            @can('staf-tata-usaha')
                <a href="{{ route('pegawai.edit', $pegawai->id_pegawai) }}" class="btn btn-warning"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
                <form action="{{ route('pegawai.destroy', $pegawai->id_pegawai) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal"
                        data-bs-target="#delete-modal">
                        <i class="bi bi-trash me-2"></i>Hapus</button>
                </form>
            @endcan
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

            @canany(['staf-tata-usaha', 'guru'])
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="data-pendidikan-tab-button" data-bs-toggle="tab" data-bs-target="#data-pendidikan-tab"
                        type="button" role="tab">Pendidikan & Sertifikasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="data-sk-tab-button" data-bs-toggle="tab" data-bs-target="#data-sk-tab" 
                        type="button" role="tab">SK</button>
                </li>
            @endcan
        </ul>

        <div class="tab-content mb-0" id="pegawai-tab-content">
            <div class="tab-pane fade show active" id="data-pribadi-tab" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-12 mt-4 d-flex justify-content-center">
                        @if ($pegawai->foto)
                            <img src="{{ Storage::url($pegawai->foto) }}" alt="Foto Pegawai" 
                                    class="foto my-3">
                        @else
                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Default Foto" 
                                    class="foto my-3">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Username</label>
                        <input type="text" class="form-control" value="{{ $pegawai->userAuth?->username ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">NIK</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nik }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Nama Pegawai</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nama_pegawai }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $pegawai->jenis_kelamin }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tempat Lahir</label>
                        <input type="text" class="form-control" value="{{ $pegawai->tempat_lahir }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tanggal Lahir</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->tanggal_lahir ? $pegawai->tanggal_lahir->format('d F Y') : '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Agama</label>
                        <input type="text" class="form-control" value="{{ $pegawai->agama }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Status Perkawinan</label>
                        <input type="text" class="form-control" value="{{ $pegawai->status_perkawinan }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Alamat</label>
                        <input type="text" class="form-control" value="{{ $pegawai->alamat }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">No. Telepon Rumah</label>
                        <input type="text" class="form-control" value="{{ $pegawai->no_telepon_rumah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">No. Telepon Seluler</label>
                        <input type="text" class="form-control" value="{{ $pegawai->no_telepon_seluler }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">E-Mail</label>
                        <input type="text" class="form-control" value="{{ $pegawai->e_mail ?? '-' }}" readonly>
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
                    @canany(['staf-tata-usaha', 'guru'])
                        <div class="col-md-6">
                            <label class="form-label ">Posisi</label>
                            <input type="text" class="form-control" value="{{ $pegawai->posisi }}" readonly>
                        </div>
                    @endcanany

                    <div class="col-md-6">
                        <label class="form-label ">Guru Mata Pelajaran</label>
                        <div class="dropdown w-100">
                            @if ($pegawai->posisi === 'Guru')
                                <button class="form-select text-start w-100" 
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $pegawai->guruMataPelajaran?->count() . ' Mata Pelajaran' }}
                                </button>
                                @if ($pegawai->guruMataPelajaran?->isNotEmpty())
                                    <ul class="dropdown-menu w-100 p-2 shadow-sm border-0">
                                        @foreach ($pegawai->guruMataPelajaran as $_guru_mata_pelajaran)
                                            <li>
                                                <div class="dropdown-item d-flex align-items-center" style="cursor: default;">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    {{ $_guru_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @else
                                <input type="text" class="form-control" value="-" readonly>
                            @endif
                        </div>
                    </div>

                    @canany(['staf-tata-usaha', 'guru'])
                    <div class="col-md-6">
                        <label class="form-label ">Status Kepegawaian</label>
                        <input type="text" class="form-control" value="{{ $pegawai->status_kepegawaian ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">NIP</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nip ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">NIPPPK</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nipppk ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Jabatan</label>
                        <input type="text" class="form-control" value="{{ $pegawai->jabatan ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tanggal Permulaan Kerja</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->permulaan_kerja ? $pegawai->permulaan_kerja->format('d F Y') : '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ">Tanggal Permulaan Kerja (RASDA)</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->permulaan_kerja_sds2 ? $pegawai->permulaan_kerja_sds2->format('d F Y') : '-' }}" readonly>
                    </div>
                    @endcanany
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary btn-nav" data-next="#data-pribadi-tab">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    
                    @canany(['staf-tata-usaha', 'guru'])
                        <button type="button" class="btn btn-primary btn-nav" data-next="#data-pendidikan-tab">
                            Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    @endcanany
                </div>
            </div>
            <div class="tab-pane fade" id="data-pendidikan-tab" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label ">Ijazah Terakhir</label>
                        <input type="text" class="form-control" value="{{ $pegawai->ijazah_terakhir ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tahun Ijazah</label>
                        <input type="text" class="form-control" value="{{ $pegawai->tahun_ijazah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Status Sertifikasi</label>
                        <input type="text" class="form-control" value="{{ $pegawai->status_sertifikasi ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label ">Tahun Sertifikasi</label>
                        <input type="text" class="form-control" value="{{ $pegawai->tahun_sertifikasi ?? '-' }}" readonly>
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
                        <input type="text" class="form-control" value="{{ $pegawai->no_sk ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ">Tanggal SK Terakhir</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->tanggal_sk_terakhir ? $pegawai->tanggal_sk_terakhir->format('d F Y') : '-' }}" readonly>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-nav mt-4" data-next="#data-pendidikan-tab">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </button>
            </div>
        </div>
    </div>
    {{-- @can('staf-tata-usaha')
    <div class="modal fade" id="delete-modal-{{ $pegawai->id_pegawai }}" tabindex="-1" aria-hidden="true">
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
                    <p class=" fs-5 text-dark">{{ $pegawai->nama_pegawai }}</p>
                    <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('pegawai.destroy', $pegawai->id_pegawai) }}" method="POST">
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