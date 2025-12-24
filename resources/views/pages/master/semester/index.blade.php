@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('semester.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                    Semester</a>
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
    
                    @include('components.master.semester_filter_modal')
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($semester as $_semester)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_semester->jenis }}</td>
                            <td>{{ $_semester->getTahunAjaran() }}</td>
                            <td>{{ $_semester->getFormatedTanggal('tanggal_mulai') }}</td>
                            <td>{{ $_semester->getFormatedTanggal('tanggal_selesai') }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $_semester->getStatus() === 'Berjalan' ? 'success' : ($_semester->getStatus() === 'Menunggu' ? 'primary' : 'secondary') }}">
                                    {{ $_semester->getStatus() }}
                                </span>
                            </td>
                            <td class="aksi-column">
                                <a href="{{ route('semester.show', $_semester->id_semester) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                @can('staf-tata-usaha')
                                    <a href="{{ route('semester.edit', $_semester->id_semester) }}"
                                        class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                    <form action="{{ route('semester.destroy', $_semester->id_semester) }}"
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
                            <td colspan="7">Belum ada Semester.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($semester->hasPages())
            <div class="d-flex justify-content-end mt-2">
                {{ $semester->links() }}
            </div>
        @endif
    </div>
@endsection
