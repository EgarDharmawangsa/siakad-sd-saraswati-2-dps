@extends('layouts.main')

@section('container')
    <div class="row g-3">
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 pegawai-count-card">
                <div class="p-3">
                    <i class="bi bi-person-badge icon-count-card"></i>
                    <h3>{{ $counted_pegawai }}</h3>
                    <p class="m-0">Pegawai</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white pegawai-count-card-link"
                    href="{{ route('pegawai.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 siswa-count-card">
                <div class="p-3">
                    <i class="bi bi-people-fill icon-count-card"></i>
                    <h3>{{ $counted_siswa }}</h3>
                    <p class="m-0">Siswa</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white siswa-count-card-link"
                    href="{{ route('siswa.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 kelas-count-card">
                <div class="p-3">
                    <i class="bi bi-door-open icon-count-card"></i>
                    <h3>{{ $counted_kelas }}</h3>
                    <p class="m-0">Kelas</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white kelas-count-card-link"
                    href="{{ route('kelas.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 semester-count-card">
                <div class="p-3">
                    <i class="bi bi-calendar-range icon-count-card"></i>
                    <h3>{{ $counted_semester }}</h3>
                    <p class="m-0">Semester</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white semester-count-card-link"
                    href="{{ route('semester.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 mata-pelajaran-count-card">
                <div class="p-3">
                    <i class="bi bi-book icon-count-card"></i>
                    <h3>{{ $counted_mata_pelajaran }}</h3>
                    <p class="m-0">Mata Pelajaran</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white mata-pelajaran-count-card-link"
                    href="{{ route('mata-pelajaran.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 ekstrakurikuler-count-card">
                <div class="p-3">
                    <i class="bi bi-person-up icon-count-card"></i>
                    <h3>{{ $counted_ekstrakurikuler }}</h3>
                    <p class="m-0">Ekstrakurikuler</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white ekstrakurikuler-count-card-link"
                    href="{{ route('mata-pelajaran.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 prestasi-count-card">
                <div class="p-3">
                    <i class="bi bi-award icon-count-card"></i>
                    <h3>{{ $counted_prestasi }}</h3>
                    <p class="m-0">Prestasi</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white prestasi-count-card-link"
                    href="{{ route('prestasi.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="content-card p-0 pengumuman-count-card">
                <div class="p-3">
                    <i class="bi bi-megaphone icon-count-card"></i>
                    <h3>{{ $counted_pengumuman }}</h3>
                    <p class="m-0">Pengumuman</p>
                </div>
                <a class="text-decoration-none d-block p-2 pe-3 text-end text-white pengumuman-count-card-link"
                    href="{{ route('pengumuman.index') }}">Lihat
                    detail<i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="content-card">
                <h5>Distribusi Pegawai</h5>
                <hr>

                <canvas id="pegawai-distribution-chart" class="mt-3 p-3"></canvas>

                <ul class="list-unstyled mb-0 pegawai-distribution-list">
                    <li>
                        <span class="pegawai-distribution-color-box-label staf-tata-usaha-color-box-label"></span>
                        <span class="pegawai-distribution-label">Staf Tata Usaha</span>
                        <span
                            class="pegawai-distribution-count-label">{{ $pegawai_distribution_data['staf_tata_usaha'] }}</span>
                    </li>
                    <li>
                        <span class="pegawai-distribution-color-box-label guru-color-box-label"></span>
                        <span class="pegawai-distribution-label">Guru</span>
                        <span class="pegawai-distribution-count-label">{{ $pegawai_distribution_data['guru'] }}</span>
                    </li>
                    <li>
                        <span class="pegawai-distribution-color-box-label pegawai-perpustakaan-color-box-label"></span>
                        <span class="pegawai-distribution-label">Pegawai Perpustakaan</span>
                        <span
                            class="pegawai-distribution-count-label">{{ $pegawai_distribution_data['pegawai_perpustakaan'] }}</span>
                    </li>
                    <li>
                        <span class="pegawai-distribution-color-box-label satuan-pengamanan-color-box-label"></span>
                        <span class="pegawai-distribution-label">Satuan Pengamanan</span>
                        <span
                            class="pegawai-distribution-count-label">{{ $pegawai_distribution_data['satuan_pengamanan'] }}</span>
                    </li>
                    <li>
                        <span class="pegawai-distribution-color-box-label pegawai-kebersihan-color-box-label"></span>
                        <span class="pegawai-distribution-label">Pegawai Kebersihan</span>
                        <span
                            class="pegawai-distribution-count-label">{{ $pegawai_distribution_data['pegawai_kebersihan'] }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="content-card">
                <h5>Peningkatan Prestasi</h5>
                <hr>

                <form action="{{ route('beranda') }}" id="prestasi-improvement-tahun-filter-form"
                    class="d-flex align-items-center my-3">
                    <label for="prestasi-improvement-tahun-select" class="form-label me-3 mb-0">Tahun</label>
                    <select class="form-select" id="prestasi-improvement-tahun-select"
                        name="prestasi_improvement_tahun_filter">
                        @for ($tahun = date('Y'); $tahun >= 2000; $tahun--)
                            <option value="{{ $tahun }}"
                                {{ request('prestasi_improvement_tahun_filter', date('Y')) == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endfor
                    </select>
                </form>

                <canvas id="prestasi-improvement-chart" class="mt-3 p-3"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-12">
            <div class="content-card">
                <h5>Pengumuman</h5>
                <hr>

                @forelse ($pengumuman as $_pengumuman)
                    @if ($_pengumuman->getStatus() === 'Terbit')
                        <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}"
                            class="pengumuman-item text-decoration-none text-dark d-block p-3 rounded">
                            <h5 class="mb-2">{{ $_pengumuman->judul }}</h5>
                            <small class="text-muted mb-3 d-block">
                                Diterbitkan pada {{ $_pengumuman->tanggal->translatedFormat('l, d F Y') }}
                            </small>
                            <p class="mb-0">{{ Str::limit(strip_tags($_pengumuman->isi), 150, '...') }}</p>
                        </a>
                        <hr class="mt-0 {{ $loop->last ? 'd-none' : '' }}">
                    @endif
                @empty
                    <p class="text-center">Belum ada Pengumuman.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
