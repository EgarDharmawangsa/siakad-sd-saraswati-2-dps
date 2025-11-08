@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="d-flex align-items-center flex-wrap mb-4">
            <a href="{{ route('pengumuman.create') }}" class="btn btn-success create-button"><i
                    class="bi bi-plus-lg me-2"></i>Tambah
                Pengumuman</a>

            <div class="modifier-buttons">
                <div class="dropdown me-2">
                    <a class="btn btn-secondary dropdown-toggle order-by-dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i
                            class="bi bi-sort-down me-2"></i>{{ !request('order_by') || request('order_by') !== 'asc' ? 'Terbaru ke Lama' : 'Lama ke Terbaru' }}
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item order-by-dropdown-item {{ request('order_by') === 'desc' || !request('order_by') ? 'active' : '' }}"
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

                    @include('components.akademik.pengumuman_filter_modal')
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Isi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengumuman as $_pengumuman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_pengumuman->judul }}</td>
                            <td>{{ $_pengumuman->getFormatedTanggal() }}</td>
                            <td>{!! strip_tags(Str::limit($_pengumuman->isi, 40, '...')) !!}</td>
                            <td><span class="badge bg-{{ $_pengumuman->getStatus() === 'Terbit' ? 'success' : 'primary' }}">
                                    {{ $_pengumuman->getStatus() }}
                                </span>
                            </td>
                            <td class="aksi-column">
                                <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}"
                                    class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('pengumuman.edit', $_pengumuman->id_pengumuman) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('pengumuman.destroy', $_pengumuman->id_pengumuman) }}"
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
                            <td colspan="6">Belum ada Pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-2">
            {{ $pengumuman->links() }}
        </div>
    </div>
@endsection
