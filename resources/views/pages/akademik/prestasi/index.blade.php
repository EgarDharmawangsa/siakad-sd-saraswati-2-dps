@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('prestasi.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                    Prestasi</a>
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

                    @include('components.akademik.prestasi_filter_modal')
            </div>
        </div>

        @if ($siswa->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Prestasi</th>
                            <th>Siswa</th>
                            {{-- <th>Penyelenggara</th>
                            <th>Jenis</th>
                            <th>Peringkat</th>
                            <th>Tingkat</th>
                            <th>Wilayah</th> --}}
                            <th>Tanggal Peraihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($prestasi as $_prestasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $_prestasi->nama_prestasi }}</td>
                                <td>{{ $_prestasi->siswa->getFormatedNamaSiswa() }}</td>
                                {{-- <td>{{ $_prestasi->penyelenggara }}</td>
                                <td>{{ $_prestasi->jenis }}</td>
                                <td>{{ $_prestasi->peringkat ?? $_prestasi->peringkat_lainnya }}</td>
                                <td>{{ $_prestasi->tingkat }}</td>
                                <td>{{ $_prestasi->wilayah }}</td> --}}
                                <td>{{ $_prestasi->getFormatedTanggalPeraihan() }}</td>
                                <td class="aksi-column">
                                    <a href="{{ route('prestasi.show', $_prestasi->id_prestasi) }}"
                                        class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                    @can('staf-tata-usaha')
                                        <a href="{{ route('prestasi.edit', $_prestasi->id_prestasi) }}"
                                            class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                        <form action="{{ route('pengumuman.destroy', $_prestasi->id_prestasi) }}"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm delete-button"
                                                data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                <i class="bi bi-trash me-2"></i>Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5">Belum ada Prestasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-message text-center mb-0 p-3 rounded">Siswa tidak tersedia.</p>
        @endif

        @if ($prestasi->hasPages())
            <div class="d-flex justify-content-end mt-2">
                {{ $prestasi->links() }}
            </div>
        @endif
    </div>
@endsection
