@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah
            Mata Pelajaran</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($mata_pelajaran as $_mata_pelajaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $_mata_pelajaran->nama_mata_pelajaran }}</td>
                            <td class="aksi-column">
                                <a href="{{ route('mata-pelajaran.show', $_mata_pelajaran->id_mata_pelajaran) }}"
                                    class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                <a href="{{ route('mata-pelajaran.edit', $_mata_pelajaran->id_mata_pelajaran) }}"
                                    class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                <form id="delete-form" action="{{ route('mata-pelajaran.destroy', $_mata_pelajaran->id_mata_pelajaran) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="button" class="btn btn-danger btn-sm" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#delete-modal">
                                        <i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="3">Belum ada Mata Pelajaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $mata_pelajaran->links() }}
        </div>
    </div>
@endsection
