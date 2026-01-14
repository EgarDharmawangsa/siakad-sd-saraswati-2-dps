@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <div class="index-buttons">
            @can('staf-tata-usaha')
                <a href="{{ route('pengumuman.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Tambah
                    Pengumuman</a>
            @endcan

            <div class="modifier-buttons">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle order-by-dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sort-down me-2"></i>{{ request('order_by') === 'asc' ? 'Lama ke Terbaru' : 'Terbaru ke Lama' }}
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

                @include('components.akademik.pengumuman_filter_modal')
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        {{-- <th>Isi</th> --}}
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
                            {{-- <td>{!! strip_tags(Str::limit($_pengumuman->isi, 40, '...')) !!}</td> --}}
                            <td><span class="badge bg-{{ $_pengumuman->getStatus() === 'Terbit' ? 'success' : 'primary' }}">
                                    {{ $_pengumuman->getStatus() }}
                                </span>
                            </td>
                            <td class="aksi-column">
                                <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}"
                                    class="btn btn-info"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                @can('staf-tata-usaha')
                                    <a href="{{ route('pengumuman.edit', $_pengumuman->id_pengumuman) }}"
                                        class="btn btn-warning mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                    <form action="{{ route('pengumuman.destroy', $_pengumuman->id_pengumuman) }}"
                                        method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger delete-button"
                                            data-bs-toggle="modal" data-bs-target="#delete-modal">
                                            <i class="bi bi-trash me-2"></i>Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5">Belum ada Pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengumuman->hasPages())
            <div class="d-flex justify-content-end mt-2">
                {{ $pengumuman->links() }}
            </div>
        @endif
    </div>
@endsection
