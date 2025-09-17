@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('semester.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah Semester</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Semester</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($semester as $_semester)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_semester->jenis_semester }}</td>
                            <td>{{ $_semester->tanggal_mulai->format('d-m-Y') }}</td>
                            <td>{{ $_semester->tanggal_selesai->format('d-m-Y') }}</td>
                            <td>{{ $_semester->status }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('semester.show', $_semester->id_semester) }}" class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('semester.edit', $_semester->id_semester) }}" class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('semester.destroy', $_semester->id_semester) }}" method="POST"class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus semester ini?')"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5">Belum ada data Semester.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $semester->links() }}
        </div>
    </div>
@endsection