@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('nilai-ekstrakurikuler.create') }}" class="btn btn-success"><i
                        class="bi bi-plus-lg me-2"></i>Tambah<span class="mx-2">/</span><i
                        class="bi bi-arrow-repeat me-2"></i>Sinkronkan Nilai Ekstrakurikuler</a>
            @endcan

            <div class="modifier-buttons">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle order-by-dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i
                            class="bi bi-sort-down me-2"></i>{{ request('order_by') === 'asc' ? 'Lama ke Terbaru' : 'Terbaru ke Lama' }}
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item order-by-dropdown-item {{ request('order_by') !== 'asc' || !request('order_by') ? 'active' : '' }}"
                                href="{{ request()->fullUrlWithQuery(['order_by' => 'desc']) }}">Terbaru ke Lama</a>
                        </li>
                        <li><a class="dropdown-item order-by-dropdown-item {{ request('order_by') === 'asc' ? 'active' : '' }}"
                                href="{{ request()->fullUrlWithQuery(['order_by' => 'asc']) }}">Lama ke Terbaru</a></li>
                    </ul>
                </div>

                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                    <i class="bi bi-funnel me-2"></i>Filter
                </button>

                @include('components.akademik.nilai_ekstrakurikuler_filter_modal')
            </div>
        </div>

        @if ($siswa->isNotEmpty())
            <form action="{{ route('nilai-ekstrakurikuler.mass-update') }}" method="POST" id="nilai-form">
                @method('PUT')
                @csrf

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                @canany(['staf-tata-usaha', 'guru'])
                                    <th>Siswa</th>
                                @endcanany
                                <th>Ekstrakurikuler</th>
                                <th>Semester</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($nilai_ekstrakurikuler as $_nilai_ekstrakurikuler)
                                <tr>
                                    <td>
                                        <input type="hidden" name="id_nilai_ekstrakurikuler[]"
                                            value="{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}"
                                            data-row="{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}">
                                        {{ $loop->iteration }}
                                    </td>

                                    @canany(['staf-tata-usaha', 'guru'])
                                        <td>{{ $_nilai_ekstrakurikuler->pesertaEkstrakurikuler->siswa->getFormatedNamaSiswa() }}
                                        </td>
                                    @endcanany

                                    <td>{{ $_nilai_ekstrakurikuler->pesertaEkstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}
                                    </td>

                                    <td>
                                        {{ $_nilai_ekstrakurikuler->semester->getTahunAjaran(true) }}
                                        <span
                                            class="badge bg-{{ $_nilai_ekstrakurikuler->semester->getStatus() === 'Berjalan' ? 'success' : ($_nilai_ekstrakurikuler->semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }} ms-1">
                                            {{ $_nilai_ekstrakurikuler->semester->getStatus() }}
                                        </span>
                                    </td>

                                    @can('staf-tata-usaha')
                                        <td>
                                            <input type="number"
                                                name="nilai[{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}]"
                                                class="form-control nilai-input @error("nilai.{$_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler}") is-invalid @enderror"
                                                value="{{ $_nilai_ekstrakurikuler->nilai }}" min="0" max="100"
                                                data-row="{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}"
                                                placeholder="Masukkan nilai">
                                            @error("nilai.{$_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler}")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    @endcan

                                    @can('siswa')
                                        <td>{{ $_nilai_ekstrakurikuler->nilai }}</td>
                                    @endcan

                                    <td class="aksi-column">
                                        <a href="{{ route('nilai-ekstrakurikuler.show', $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler) }}"
                                            class="btn btn-info">
                                            <i class="bi bi-info-lg me-2"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                @canany(['staf-tata-usaha', 'guru'])
                                    <tr class="text-center">
                                        <td colspan="6">Belum ada Nilai Ekstrakurikuler.</td>
                                    </tr>
                                @endcanany

                                @can('siswa')
                                    <tr class="text-center">
                                        <td colspan="5">Belum ada Nilai Ekstrakurikuler.</td>
                                    </tr>
                                @endcan
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($nilai_ekstrakurikuler->hasPages())
                    <div class="d-flex justify-content-end mt-2">
                        {{ $nilai_ekstrakurikuler->links() }}
                    </div>
                @endif

                @can('staf-tata-usaha')
                    <div class="d-flex justify-content-between rounded-3 mt-4 p-3 submit-warning-container">
                        <p class="mini-label submit-warning-text">
                            Simpan nilai sebelum berpindah ke halaman atau daftar berikutnya!
                        </p>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy me-2"></i>Simpan
                        </button>
                    </div>
                @endcan

                @can('staf-tata-usaha')
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('nilai-ekstrakurikuler.delete') }}" class="btn btn-danger"><i
                                class="bi bi-trash me-2"></i>Hapus Nilai Ekstrakurikuler</a>
                    </div>
                @endcan
            </form>
        @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif
    </div>
@endsection
