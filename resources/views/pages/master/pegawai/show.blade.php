@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('pegawai.edit', $pegawai->id_pegawai) }}" class="btn btn-warning btn-sm me-1"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
            <form action="{{ route('pegawai.destroy', $pegawai->id_pegawai) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')

                <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                    data-bs-target="#delete-modal">
                    <i class="bi bi-trash me-2"></i>Hapus</button>
            </form>
        </div>

        <ul class="nav nav-tabs" id="pegawai-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="data-pribadi-tab" data-bs-toggle="tab" data-bs-target="#data-pribadi"
                    type="button">Data pribadi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-kepegawaian-tab" data-bs-toggle="tab" data-bs-target="#data-kepegawaian"
                    type="button">Data Kepegawaian</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-pendidikan-tab" data-bs-toggle="tab" data-bs-target="#data-pendidikan"
                    type="button">Pendidikan & Sertifikasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="data-sk-tab" data-bs-toggle="tab" data-bs-target="#data-sk" type="button">Data
                    SK</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mb-0" id="pegawai-tab-content">
            <!-- DATA PRIBADI -->
            <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-12 mt-5 mb-4 justify-content-center text-center">
                        @if ($pegawai->foto)
                            <img src="{{ asset("storage/{$pegawai->foto}") }}"
                                alt="Foto Pegawai" class="img-fluid foto">
                        @else
                            <img src="{{ asset('images/default_profile_photo.png') }}" alt="Foto Pegawai"
                                class="img-fluid rounded-circle foto">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" value="{{ $pegawai->nik }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="nama-pegawai" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama-pegawai" value="{{ $pegawai->nama_pegawai }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis-kelamin" value="{{ $pegawai->jenis_kelamin }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat-lahir" value="{{ $pegawai->tempat_lahir }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggal-lahir"
                            value="{{ $pegawai->getFormatedTanggal('tanggal_lahir') }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="agama" value="{{ $pegawai->agama }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="status-perkawinan" class="form-label">Status Perkawinan</label>
                        <input type="text" class="form-control" id="status-perkawinan"
                            value="{{ $pegawai->status_perkawinan }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" value="{{ $pegawai->alamat }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="no-telepon-rumah" class="form-label">No. Telepon Rumah</label>
                        <input type="text" class="form-control" id="no-telepon-rumah"
                            value="{{ $pegawai->no_telepon_rumah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="no-telepon-seluler" class="form-label">No. Telepon Seluler</label>
                        <input type="text" class="form-control" id="no-telepon-seluler"
                            value="{{ $pegawai->no_telepon_seluler }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="e-mail" class="form-label">E-Mail</label>
                        <input type="text" class="form-control" id="e-mail" value="{{ $pegawai->e_mail ?? '-' }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username"
                            value="{{ $pegawai->userAuth?->username ?? '-' }}" readonly>
                    </div>
                </div>
            </div>

            <!-- DATA KEPEGAWAIAN -->
            <div class="tab-pane fade" id="data-kepegawaian" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" class="form-control" id="posisi" value="{{ $pegawai->posisi }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="id-mata-pelajaran" class="form-label">Guru Mata Pelajaran</label>
                        <div class="dropdown w-100" id="id-mata-pelajaran">
                            <button class="form-select text-start w-100" type="button"
                                id="id-mata-pelajaran-dropdown-button" data-bs-toggle="dropdown" aria-expanded="false"
                                {{ $pegawai->guruMataPelajaran?->isEmpty() ? 'disabled' : '' }}>
                                {{ $pegawai->guruMataPelajaran?->isNotEmpty() ? $pegawai->guruMataPelajaran->count() . ' Mata Pelajaran' : '-' }}
                            </button>
                            @if ($pegawai->guruMataPelajaran?->isNotEmpty())
                                <ul class="dropdown-menu w-100 p-2" aria-labelledby="id-mata-pelajaran-dropdown-button">
                                    @forelse ($pegawai->guruMataPelajaran as $_guru_mata_pelajaran)
                                        <li>
                                            <label class="dropdown-item d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input me-2" checked disabled>
                                                {{ $_guru_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}
                                            </label>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="status-kepegawaian" class="form-label">Status Kepegawaian</label>
                        <input type="text" class="form-control" id="status-kepegawaian"
                            value="{{ $pegawai->status_kepegawaian ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" value="{{ $pegawai->nip ?? '-' }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="nipppk" class="form-label">NIPPPK</label>
                        <input type="text" class="form-control" id="nipppk" value="{{ $pegawai->nipppk ?? '-' }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan"
                            value="{{ $pegawai->jabatan ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="permulaan-kerja" class="form-label">Tanggal Permulaan Kerja</label>
                        <input type="text" class="form-control" id="permulaan-kerja"
                            value="{{ $pegawai->getFormatedTanggal('permulaan_kerja') }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="permulaan-kerja-sds2" class="form-label">Tanggal Permulaan Kerja (RASDA)</label>
                        <input type="text" class="form-control" id="permulaan-kerja-sds2"
                            value="{{ $pegawai->getFormatedTanggal('permulaan_kerja_sds2') }}" readonly>
                    </div>
                </div>
            </div>

            <!-- PENDIDIKAN & SERTIFIKASI -->
            <div class="tab-pane fade" id="data-pendidikan" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="ijazah-terakhir" class="form-label">Ijazah Terakhir</label>
                        <input type="text" class="form-control" id="ijazah-terakhir"
                            value="{{ $pegawai->ijazah_terakhir ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="tahun-ijazah" class="form-label">Tahun Ijazah</label>
                        <input type="text" class="form-control" id="tahun-ijazah"
                            value="{{ $pegawai->tahun_ijazah ?? '-' }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="status-sertifikasi" class="form-label">Status Sertifikasi</label>
                        <input type="text" class="form-control" id="status-sertifikasi"
                            value="{{ $pegawai->status_sertifikasi }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="tahun-sertifikasi" class="form-label">Tahun Sertifikasi</label>
                        <input type="text" class="form-control" id="tahun-sertifikasi"
                            value="{{ $pegawai->tahun_sertifikasi ?? '-' }}" readonly>
                    </div>
                </div>
            </div>

            <!-- DATA SK -->
            <div class="tab-pane fade" id="data-sk" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="no-sk" class="form-label">Nomor SK</label>
                        <input type="text" class="form-control" id="no-sk" value="{{ $pegawai->no_sk ?? '-' }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal-sk-terakhir" class="form-label">Tanggal SK Terakhir</label>
                        <input type="text" class="form-control" id="tanggal-sk-terakhir"
                            value="{{ $pegawai->getFormatedTanggal('tanggal_sk_terakhir') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
