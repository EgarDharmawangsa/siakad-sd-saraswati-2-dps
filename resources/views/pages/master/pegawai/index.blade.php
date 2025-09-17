{{-- baru ngubah pengumuman ke pegawi --}}

@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('pegawai.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah pegawai</a>

        <div class="table-responsive-md">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Isi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pegawai as $_pegawai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_pegawai->judul }}</td>
                            <td>{{ $_pegawai->tanggal->format('d-m-Y') }}</td>
                            <td class="text-truncate">{{ $_pegawai->isi }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('pegawai.show', $_pegawai->id_pegawai) }}" class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('pegawai.edit', $_pegawai->id_pegawai) }}" class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('pegawai.destroy', $_pegawai->id_pegawai) }}" method="POST"class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pegawai ini?')"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5">Belum ada data pegawai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $pegawai->links() }}
        </div>
    </div>
@endsection