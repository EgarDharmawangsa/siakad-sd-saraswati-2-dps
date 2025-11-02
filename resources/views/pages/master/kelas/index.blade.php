@extends('layouts.main')

@section('container')
    <div class="content-card">
        <div class="d-flex align-items-center flex-wrap mb-4">
            <a href="{{ route('kelas.create') }}" class="btn btn-success create-button"><i
                    class="bi bi-plus-lg me-2"></i>Tambah
                Kelas</a>

            <div class="modifier-buttons">
                <div class="dropdown me-2">
                    <a class="btn btn-secondary dropdown-toggle order-by-dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i
                            class="bi bi-sort-down me-2"></i>{{ !request('order_by') || (request('order_by') !== 'desc' && request('order_by') !== 'asc') ? 'Nama Kelas' : (request('order_by') === 'desc' ? 'Terbaru ke Lama' : 'Lama ke Terbaru') }}
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item order-by-dropdown-item {{ !request('order_by') ? 'active' : '' }}"
                                href="{{ route('kelas.index') }}">Nama Kelas</a>
                        </li>
                        <li><a class="dropdown-item order-by-dropdown-item {{ request('order_by') === 'desc' ? 'active' : '' }}"
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

                    @include('components.master.kelas_filter_modal')
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kelas as $_kelas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_kelas->nama_kelas }}</td>
                            <td>{{ $_kelas->pegawai?->getFormatedNamaPegawai() ?? '-' }}</td>
                            <td>{{ $siswa->where('id_kelas', $_kelas->id_kelas)->count() }} Siswa</td>
                            <td class="aksi-column">
                                <a href="{{ route('kelas.show', $_kelas->id_kelas) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('kelas.edit', $_kelas->id_kelas) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('kelas.destroy', $_kelas->id_kelas) }}" method="POST"
                                    class="d-inline delete-form">
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
                            <td colspan="5">Belum ada Kelas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $kelas->links() }}
        </div>
    </div>
@endsection
