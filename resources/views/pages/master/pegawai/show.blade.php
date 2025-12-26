@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>
        <div class="show-buttons mb-4">
            <a href="{{ request()->routeIs('pegawai.show') ? route('pegawai.index') : route('beranda') }}" 
               class="btn btn-secondary btn-sm me-1">
               <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            @can('pegawai-profile-edit')
                <a href="{{ request()->routeIs('pegawai.show') ? route('pegawai.edit', $pegawai->id_pegawai) : route('profil.edit') }}"
                    class="btn btn-warning btn-sm me-1 text-white">
                    <i class="bi bi-pencil me-2"></i>Edit
                </a>
            @endcan
            @can('staf-tata-usaha')
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                    data-bs-target="#delete-modal-{{ $pegawai->id_pegawai }}">
                    <i class="bi bi-trash me-2"></i>Hapus
                </button>
            @endcan
        </div>
        <ul class="nav nav-tabs" id="pegawai-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="data-pribadi-tab-button" data-bs-toggle="tab" data-bs-target="#data-pribadi-tab"
                    type="button" role="tab">Data Pribadi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-kepegawaian-tab-button" data-bs-toggle="tab" data-bs-target="#data-kepegawaian-tab"
                    type="button" role="tab">Data Kepegawaian</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-pendidikan-tab-button" data-bs-toggle="tab" data-bs-target="#data-pendidikan-tab"
                    type="button" role="tab">Pendidikan & Sertifikasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-sk-tab-button" data-bs-toggle="tab" data-bs-target="#data-sk-tab" 
                    type="button" role="tab">Data SK</button>
            </li>
        </ul>

        <div class="tab-content mb-0" id="pegawai-tab-content">
            
            <div class="tab-pane fade show active" id="data-pribadi-tab" role="tabpanel">
                <div class="row g-3 pt-3">
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                        <div class="text-center">
                            @if ($pegawai->foto)
                                <img src="{{ asset("storage/{$pegawai->foto}") }}" alt="Foto Pegawai" 
                                     class="img-thumbnail rounded" style="max-height: 200px; max-width: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default_profile_photo.png') }}" alt="Default Foto" 
                                     class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">NIK</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nik }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Pegawai</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nama_pegawai }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $pegawai->jenis_kelamin }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tempat Lahir</label>
                        <input type="text" class="form-control" value="{{ $pegawai->tempat_lahir }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->tanggal_lahir ? $pegawai->tanggal_lahir->format('d F Y') : '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Agama</label>
                        <input type="text" class="form-control" value="{{ $pegawai->agama }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Perkawinan</label>
                        <input type="text" class="form-control" value="{{ $pegawai->status_perkawinan }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Alamat</label>
                        <input type="text" class="form-control" value="{{ $pegawai->alamat }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">No. Telepon Rumah</label>
                        <input type="text" class="form-control" value="{{ $pegawai->no_telepon_rumah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">No. Telepon Seluler</label>
                        <input type="text" class="form-control" value="{{ $pegawai->no_telepon_seluler }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">E-Mail</label>
                        <input type="text" class="form-control" value="{{ $pegawai->e_mail ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" value="{{ $pegawai->userAuth?->username ?? '-' }}" readonly>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="data-kepegawaian-tab" role="tabpanel">
                <div class="row g-3 pt-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Posisi</label>
                        <input type="text" class="form-control" value="{{ $pegawai->posisi }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Guru Mata Pelajaran</label>
                        <div class="dropdown w-100">
                            <button class="form-select text-start w-100 {{ $pegawai->guruMataPelajaran?->isEmpty() ? 'text-muted' : '' }}" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false" 
                                    {{ $pegawai->guruMataPelajaran?->isEmpty() ? 'disabled' : '' }}>
                                {{ $pegawai->guruMataPelajaran?->isNotEmpty() ? $pegawai->guruMataPelajaran->count() . ' Mata Pelajaran' : 'Tidak ada mapel' }}
                            </button>
                            @if ($pegawai->guruMataPelajaran?->isNotEmpty())
                                <ul class="dropdown-menu w-100 p-2 shadow-sm border-0">
                                    @foreach ($pegawai->guruMataPelajaran as $gmp)
                                        <li>
                                            <div class="dropdown-item d-flex align-items-center" style="cursor: default;">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                {{ $gmp->mataPelajaran->nama_mata_pelajaran }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Kepegawaian</label>
                        <input type="text" class="form-control" value="{{ $pegawai->status_kepegawaian ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nip ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">NIPPPK</label>
                        <input type="text" class="form-control" value="{{ $pegawai->nipppk ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jabatan</label>
                        <input type="text" class="form-control" value="{{ $pegawai->jabatan ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Permulaan Kerja</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->permulaan_kerja ? $pegawai->permulaan_kerja->format('d F Y') : '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Permulaan Kerja (RASDA)</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->permulaan_kerja_sds2 ? $pegawai->permulaan_kerja_sds2->format('d F Y') : '-' }}" readonly>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="data-pendidikan-tab" role="tabpanel">
                <div class="row g-3 pt-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Ijazah Terakhir</label>
                        <input type="text" class="form-control" value="{{ $pegawai->ijazah_terakhir ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tahun Ijazah</label>
                        <input type="text" class="form-control" value="{{ $pegawai->tahun_ijazah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Sertifikasi</label>
                        <input type="text" class="form-control" value="{{ $pegawai->status_sertifikasi ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tahun Sertifikasi</label>
                        <input type="text" class="form-control" value="{{ $pegawai->tahun_sertifikasi ?? '-' }}" readonly>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="data-sk-tab" role="tabpanel">
                <div class="row g-3 pt-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nomor SK</label>
                        <input type="text" class="form-control" value="{{ $pegawai->no_sk ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal SK Terakhir</label>
                        <input type="text" class="form-control" 
                               value="{{ $pegawai->tanggal_sk_terakhir ? $pegawai->tanggal_sk_terakhir->format('d F Y') : '-' }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('staf-tata-usaha')
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
                    <p class="fw-bold fs-5 text-dark">{{ $pegawai->nama_pegawai }}</p>
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
    @endcan

@endsection