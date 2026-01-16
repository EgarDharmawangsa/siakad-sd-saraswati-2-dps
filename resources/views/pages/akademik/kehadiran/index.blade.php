@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('guru')
                <a href="{{ route('kehadiran.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah<span
                        class="mx-2">/</span><i class="bi bi-arrow-repeat me-2"></i>Sinkronkan Kehadiran</a>
            @endcan

            <a href="{{ route('kehadiran.recapitulation') }}" class="btn btn-info recapitulation-button"><i
                    class="bi bi-clipboard-check me-2"></i>Rekapitulasi Kehadiran</a>

            <div class="modifier-buttons ms-auto">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                    <i class="bi bi-funnel me-2"></i>Filter
                </button>

                @include('components.akademik.kehadiran_filter_modal')
            </div>
        </div>

        @if ($siswa->isNotEmpty())
            <form action="{{ route('kehadiran.mass-update') }}" method="POST" id="kehadiran-form">
                @method('PUT')
                @csrf

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>No.</th>
                                @canany(['staf-tata-usaha', 'guru'])
                                    <th>Siswa</th>
                                    <th>Kelas</th>
                                @endcanany
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kehadiran as $_kehadiran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    @canany(['staf-tata-usaha', 'guru'])
                                        <td>
                                            <input type="hidden" name="id_kehadiran[]" value="{{ $_kehadiran->id_kehadiran }}"
                                                data-row="{{ $_kehadiran->id_kehadiran }}">
                                            {{ $_kehadiran->siswa->getFormatedNamaSiswa(true) }}
                                        </td>

                                        <td>{{ $_kehadiran->siswa->kelas?->nama_kelas ?? '-' }}</td>
                                    @endcanany

                                    <td>
                                        {{ $_kehadiran->semester->getTahunAjaran(true) }}
                                        <span
                                            class="badge bg-{{ $_kehadiran->semester->getStatus() === 'Berjalan' ? 'success' : ($_kehadiran->semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }} ms-1">
                                            {{ $_kehadiran->semester->getStatus() }}
                                        </span>
                                    </td>

                                    @can('guru')
                                        <td>
                                            <div class="d-flex gap-2 px-2">
                                                @foreach (['Hadir', 'Izin', 'Sakit', 'Alfa'] as $status)
                                                    <label class="mx-auto">
                                                        <input type="radio" name="status[{{ $_kehadiran->id_kehadiran }}]"
                                                            class="kehadiran-input" data-row="{{ $_kehadiran->id_kehadiran }}"
                                                            value="{{ $status }}"
                                                            {{ $_kehadiran->status === $status ? 'checked' : '' }}>
                                                        {{ $status }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </td>

                                        <td>
                                            <input type="text" name="keterangan[{{ $_kehadiran->id_kehadiran }}]"
                                                class="form-control keterangan-input @error("keterangan.{$_kehadiran->id_kehadiran}") is-invalid @enderror"
                                                data-row="{{ $_kehadiran->id_kehadiran }}"
                                                value="{{ $_kehadiran->keterangan }}" placeholder="Masukkan keterangan"
                                                {{ $_kehadiran->status === 'Izin' ? '' : 'disabled' }}>
                                            @error("keterangan.{$_kehadiran->id_kehadiran}")
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                    @endcan

                                    @canany(['staf-tata-usaha', 'siswa'])
                                        <td>{{ $_kehadiran->status }}</td>
                                    @endcanany

                                    @canany(['staf-tata-usaha', 'siswa'])
                                        <td>{{ $_kehadiran->keterangan ?? '-' }}</td>
                                    @endcanany

                                    <td>{{ $_kehadiran->getFormatedTanggal() }}</td>

                                    {{-- <td class="aksi-column">
                                        <a href="{{ route('kehadiran.show', $_kehadiran->id_kehadiran) }}"
                                            class="btn btn-info">
                                            <i class="bi bi-info-lg me-2"></i>Detail
                                        </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr class="text-center">
                                    @canany(['staf-tata-usaha', 'guru'])
                                        <td colspan="7">Belum ada data kehadiran.</td>
                                    @endcanany

                                    @can('siswa')
                                        <td colspan="5">Belum ada data kehadiran.</td>
                                    @endcan
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @can('guru')
                    <div class="d-flex justify-content-between rounded-3 mt-4 p-3 submit-warning-container">
                        <p class="mini-label submit-warning-text">
                            Simpan kehadiran sebelum berpindah ke halaman atau daftar berikutnya!
                        </p>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy me-2"></i>Simpan
                        </button>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('kehadiran.delete') }}" class="btn btn-danger"><i class="bi bi-trash me-2"></i>Hapus
                            Kehadiran</a>
                    </div>
                @endcan
            </form>
        @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif
    </div>
@endsection
