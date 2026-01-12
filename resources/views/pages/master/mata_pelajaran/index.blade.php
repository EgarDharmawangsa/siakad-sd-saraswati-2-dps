@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                    Mata Pelajaran</a>
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

                @include('components.master.mata_pelajaran_filter_modal')
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($mata_pelajaran as $_mata_pelajaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_mata_pelajaran->nama_mata_pelajaran }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('mata-pelajaran.show', $_mata_pelajaran->id_mata_pelajaran) }}"
                                    class="btn btn-info"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                @can('staf-tata-usaha')
                                    <a href="{{ route('mata-pelajaran.edit', $_mata_pelajaran->id_mata_pelajaran) }}"
                                        class="btn btn-warning mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                    <form action="{{ route('mata-pelajaran.destroy', $_mata_pelajaran->id_mata_pelajaran) }}"
                                        method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger delete-button" data-bs-toggle="modal"
                                            data-bs-target="#delete-modal">
                                            <i class="bi bi-trash me-2"></i>Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="3">Belum ada Mata Pelajaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($mata_pelajaran->hasPages())
            <div class="d-flex justify-content-end mt-2">
                {{ $mata_pelajaran->links() }}
            </div>
        @endif
    </div>
@endsection
