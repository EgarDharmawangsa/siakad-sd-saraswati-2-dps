@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('prestasi.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah
            Prestasi</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        {{-- <th>Siswa</th> --}}
                        <th>Nama Prestasi</th>
                        <th>Jenis</th>
                        <th>Tingkat</th>
                        <th>Peringkat</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($prestasi as $_prestasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_prestasi->nama_prestasi }}</td>
                            <td>{{ $_prestasi->jenis }}</td>
                            <td>{{ $_prestasi->tingkat }}</td>
                            <td>{{ $_prestasi->peringkat }}</td>
                            <td>{{ $_prestasi->peringkat_lainnya ?? '-' }}</td>
                            <td>{{ $_prestasi->penyelenggara }}</td>
                            <td>{{ $_prestasi->tanggal->format('d-m-Y') }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('prestasi.show', $_prestasi->id_prestasi) }}" class="btn btn-info btn-sm"><i
                                        class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('prestasi.edit', $_prestasi->id_prestasi) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form action="{{ route('pengumuman.destroy', $_prestasi->id_prestasi) }}" method="POST"
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
                            <td colspan="9">Belum ada Prestasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $prestasi->links() }}
        </div>
    </div>
@endsection
