@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('nilai-ekstrakurikuler.create') }}" class="btn btn-success"><i
                        class="bi bi-plus-lg me-2"></i>Tambah Nilai Ekstrakurikuler</a>
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

                <div class="filter-modal-container">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>

                    @include('components.akademik.nilai_ekstrakurikuler_filter_modal')
                </div>
            </div>
        </div>

        {{-- @if ($siswa->isNotEmpty()) --}}
        <form action="{{ route('nilai-ekstrakurikuler.mass-update') }}" method="POST" id="nilai-form">
            @method('PATCH')
            @csrf

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Siswa</th>
                            <th>Ekstrakurikuler</th>
                            <th>Semester</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- ================= DATA DUMMY ================= --}}
                        <tr>
                            <td>
                                <input type="hidden" name="nilai_ekstrakurikuler_ids[]" value="1" data-row="1">
                                1
                            </td>

                            <td>220040026 | I Komang Egar Suarama Dharmawangsa</td>

                            <td>Menggambar</td>

                            <td>Ganjil 2025/2026</td>

                            <td>
                                <input type="number" name="nilai[1]" class="form-control nilai-input" value="90"
                                    min="0" max="100" data-row="1">
                            </td>

                            <td></td>
                        </tr>

                        <tr>
                            <td>
                                <input type="hidden" name="nilai_ekstrakurikuler_ids[]" value="2" data-row="2">
                                2
                            </td>

                            <td>220040027 | Ni Luh Putu Sari Dewi</td>

                            <td>Tari Bali</td>

                            <td>Ganjil 2025/2026</td>

                            <td>
                                <input type="number" name="nilai[2]" class="form-control nilai-input" value="85"
                                    min="0" max="100" data-row="2">
                            </td>

                            <td></td>
                        </tr>
                        {{-- ================= END DATA DUMMY ================= --}}

                        {{-- @forelse ($nilai_ekstrakurikuler as $_nilai_ekstrakurikuler)
                            <tr>
                                <td>
                                    <input type="hidden"
                                           name="id_nilai_ekstrakurikuler[]"
                                           value="{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}"
                                           data-row="{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $_nilai_ekstrakurikuler->pesertaEkstrakurikuler->siswa->getFormatedNamaSiswa() }}
                                </td>

                                <td>
                                    {{ $_nilai_ekstrakurikuler->pesertaEkstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}
                                </td>

                                <td>
                                    {{ $_nilai_ekstrakurikuler->semester->getTahunAjaran(true) }}
                                    <span class="badge bg-{{ $_semester->getStatus() === 'Berjalan' ? 'success' : ($_semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }}">
                                        {{ $_semester->getStatus() }}
                                    </span>
                                </td>

                                <td>
                                    <input type="number"
                                           name="nilai[{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}]"
                                           class="form-control nilai-input"
                                           value="{{ $_nilai_ekstrakurikuler->nilai }}"
                                           min="0"
                                           max="100"
                                           data-row="{{ $_nilai_ekstrakurikuler->id_nilai_ekstrakurikuler }}"
                                           placeholder="Masukkan nilai">
                                </td>

                                <td class="aksi-column">
                                    <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-info-lg me-2"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">Belum ada Nilai Ekstrakurikuler.</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>

            @if ($nilai_ekstrakurikuler->hasPages())
                <div class="d-flex justify-content-end mt-2">
                    {{ $nilai_ekstrakurikuler->links() }}
                </div>
            @endif

            <div class="d-flex justify-content-between rounded-3 mt-4 p-3 submit-warning-container">
                <p class="mini-label submit-warning-text">
                    Simpan nilai sebelum berpindah ke halaman atau daftar berikutnya!
                </p>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy me-2"></i>Simpan
                </button>
            </div>
        </form>
        {{-- @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif --}}
    </div>
@endsection
