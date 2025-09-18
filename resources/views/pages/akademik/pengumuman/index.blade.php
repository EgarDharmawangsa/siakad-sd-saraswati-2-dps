@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('pengumuman.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah Pengumuman</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Isi</th>
                        <th>Aksi </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengumuman as $_pengumuman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_pengumuman->judul }}</td>
                            <td>{{ $_pengumuman->tanggal->format('d-m-Y') }}</td>
                            <td class="text-truncate">{!! $_pengumuman->isi !!}</td>
                            <td class="aksi-column">
                                <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}" class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('pengumuman.edit', $_pengumuman->id_pengumuman) }}" class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('pengumuman.destroy', $_pengumuman->id_pengumuman) }}" method="POST"class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengumuman ini?')"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5">Belum ada data Pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $pengumuman->links() }}
        </div>
    </div>
@endsection