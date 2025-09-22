@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('kelas.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah Kelas</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kelas as $_kelas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_kelas->nama_kelas }}</td>
                            {{-- <td>{{ $_kelas->nama_kelas }}</td> --}}
                            <td class="aksi-column">
                                <a href="{{ route('kelas.show', $_kelas->id_kelas) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('kelas.edit', $_kelas->id_kelas) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('kelas.destroy', $_kelas->id_kelas) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" id="delete-button"><i
                                            class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4">Belum ada data Kelas.</td>
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
