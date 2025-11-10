@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="index-buttons">
            <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                Ekstrakurikuler</a>

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
    
                    @include('components.master.ekstrakurikuler_filter_modal')
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Ekstrakurikuler</th>
                        <th>Nama Pembina</th>
                        <th>Alamat Pembina</th>
                        <th>No. Telepon</th>
                        <th>Hari</th>
                        <th>Jam Mulai (WITA)</th>
                        <th>Jam Selesai (WITA)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($ekstrakurikuler as $_ekstrakurikuler)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_ekstrakurikuler->nama_ekstrakurikuler }}</td>
                            <td>{{ $_ekstrakurikuler->nama_pembina }}</td>
                            <td>{!! Str::limit($_ekstrakurikuler->alamat_pembina, 40, '...') !!}</td>
                            <td>{{ $_ekstrakurikuler->no_telepon }}</td>
                            <td>{{ $_ekstrakurikuler->hari }}</td>
                            <td>{{ $_ekstrakurikuler->getFormatedJam('jam_mulai') }}</td>
                            <td>{{ $_ekstrakurikuler->getFormatedJam('jam_selesai') }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('ekstrakurikuler.show', $_ekstrakurikuler->id_ekstrakurikuler) }}"
                                    class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('ekstrakurikuler.edit', $_ekstrakurikuler->id_ekstrakurikuler) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('pengumuman.destroy', $_ekstrakurikuler->id_ekstrakurikuler) }}"
                                    method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                        data-bs-toggle="modal" data-bs-target="#delete-modal">
                                        <i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="9">Belum ada Ekstrakurikuler.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($ekstrakurikuler->hasPages())
            <div class="d-flex justify-content-end mt-2">
                {{ $ekstrakurikuler->links() }}
            </div>
        @endif
    </div>
@endsection
