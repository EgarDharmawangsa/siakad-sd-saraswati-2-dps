@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('kehadiran.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                    Kehadiran</a>
            @endcan

            <div class="modifier-buttons">
                <div class="filter-modal-container">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filter-modal">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>
    
                    @include('components.akademik.kehadiran_filter_modal')
                </div>
            </div>
        </div>

        {{-- @if ($siswa->isNotEmpty()) --}}
        <form action="{{ route('kehadiran.mass-update') }}" method="POST" id="nilai-form">
            @method('PATCH')
            @csrf

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Siswa</th>
                            <th>Semester</th>
                            <th>Status Kehadiran</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- ================= STRUKTUR ASLI ================= --}}
                        {{--
                    @forelse ($kehadiran as $_kehadiran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <input type="hidden"
                                   name="kehadiran_ids[]"
                                   value="{{ $_kehadiran->id_kehadiran }}">
                            {{ $_kehadiran->siswa->getFormatedNamaSiswa() }}
                        </td>

                        <td>
                            {{ $_nilai_ekstrakurikuler->semester->getTahunAjaran(true) }}
                            <span class="badge bg-{{ $_semester->getStatus() === 'Berjalan' ? 'success' : ($_semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }}">
                                {{ $_semester->getStatus() }}
                            </span>
                        </td>

                        <td>
                            <input type="hidden"
                                   name="status[{{ $_kehadiran->id_kehadiran }}]"
                                   value="{{ $_kehadiran->status }}">

                            <div class="d-flex gap-2 px-2">
                                @foreach (['Hadir', 'Izin', 'Sakit', 'Alfa'] as $status)
                                    <label class="mx-auto">
                                        <input type="radio"
                                               name="radio_status_{{ $_kehadiran->id_kehadiran }}"
                                               class="kehadiran-input"
                                               data-row="{{ $_kehadiran->id_kehadiran }}"
                                               value="{{ $status }}"
                                               {{ $_kehadiran->status === $status ? 'checked' : '' }}>
                                        {{ $status }}
                                    </label>
                                @endforeach
                            </div>
                        </td>

                        <td>
                            <input type="text"
                                   name="keterangan[{{ $_kehadiran->id_kehadiran }}]"
                                   class="form-control keterangan-input"
                                   value="{{ $_kehadiran->keterangan }}"
                                   placeholder="Masukkan keterangan"
                                   {{ $_kehadiran->status === 'Izin' ? '' : 'disabled' }}>
                        </td>

                        <td>{{ $_kehadiran->tanggal->getFormatedTanggal() }}</td>
                    </tr>

                    @empty
                    <tr class="text-center">
                        <td colspan="6">Belum ada data kehadiran.</td>
                    </tr>
                    @endforelse
                    --}}
                        {{-- =============== END STRUKTUR ASLI =============== --}}

                        {{-- ================= DATA DUMMY ================= --}}

                        <tr>
                            <td>1</td>
                            <td>
                                <input type="hidden" name="kehadiran_ids[]" value="1">
                                220040026 | I Komang Egar Suarama Dharmawangsa
                            </td>
                            <td>Ganjil 2025/2026</td>

                            <td>
                                <input type="hidden" name="status[1]" value="Hadir">

                                <div class="d-flex gap-2 px-2">
                                    @foreach (['Hadir', 'Izin', 'Sakit', 'Alfa'] as $status)
                                        <label class="mx-auto">
                                            <input type="radio" name="radio_status_1" class="kehadiran-input"
                                                data-row="1" value="{{ $status }}"
                                                {{ $status === 'Hadir' ? 'checked' : '' }}>
                                            {{ $status }}
                                        </label>
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                <input type="text" name="keterangan[1]" class="form-control keterangan-input"
                                    placeholder="Masukkan keterangan" value="" disabled>
                            </td>

                            <td>2025-09-12</td>

                            <td>-</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>
                                <input type="hidden" name="kehadiran_ids[]" value="2">
                                220040027 | Ni Luh Putu Sari Dewi
                            </td>
                            <td>Ganjil 2025/2026</td>

                            <td>
                                <input type="hidden" name="status[2]" value="Izin">

                                <div class="d-flex gap-2 px-2">
                                    @foreach (['Hadir', 'Izin', 'Sakit', 'Alfa'] as $status)
                                        <label class="mx-auto">
                                            <input type="radio" name="radio_status_2" class="kehadiran-input"
                                                data-row="2" value="{{ $status }}"
                                                {{ $status === 'Izin' ? 'checked' : '' }}>
                                            {{ $status }}
                                        </label>
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                <input type="text" name="keterangan[2]" class="form-control keterangan-input"
                                    placeholder="Masukkan keterangan" value="Acara keluarga">
                            </td>

                            <td>2025-09-12</td>

                            <td>-</td>
                        </tr>

                        {{-- =============== END DATA DUMMY =============== --}}

                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between rounded-3 mt-4 p-3 submit-warning-container">
                <p class="mini-label submit-warning-text">
                    Simpan kehadiran sebelum berpindah ke halaman atau daftar berikutnya!
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
