@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah
            Ekstrakurikuler</a>

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
                            <td>{{ $_ekstrakurikuler->getHari() }}</td>
                            <td>{{ $_ekstrakurikuler->jam_mulai }}</td>
                            <td>{{ $_ekstrakurikuler->jam_selesai }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('ekstrakurikuler.show', $_ekstrakurikuler->id_ekstrakurikuler) }}"
                                    class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('ekstrakurikuler.edit', $_ekstrakurikuler->id_ekstrakurikuler) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form id="delete-form"
                                    action="{{ route('ekstrakurikuler.destroy', $_ekstrakurikuler->id_ekstrakurikuler) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" id="delete-button"><i
                                            class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="9">Belum ada data Ekstrakurikuler.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $ekstrakurikuler->links() }}
        </div>
    </div>
@endsection
