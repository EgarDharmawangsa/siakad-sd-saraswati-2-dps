@extends('layouts.main')

@section('container')
    <div class="content-card">
        <a href="{{ route('jadwal-pelajaran.create') }}" class="btn btn-success mb-4"><i class="bi bi-plus-lg me-2"></i>Tambah
            Jadwal Pelajaran</a>

        
        @forelse ($kelas as $_kelas)
            @forelse ($kelas->jadwalPelajaran as $_jadwal_pelajaran)
                {{-- nanti disini isi jadwal pelajaran --}}
            @empty
                <p class="empty-message text-center mb-0 p-3 rounded">Belum ada Jadwal Pelajaran.</p>
            @endforelse
            {{-- <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pengumuman as $_pengumuman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $_pengumuman->judul }}</td>
                                <td>{{ $_pengumuman->tanggal->format('d-m-Y') }}</td>
                                <td>{!! Str::limit($_pengumuman->isi, 40, '...') !!}</td>
                                <td><span class="badge bg-{{ $_pengumuman->getStatus() == 'Terbit' ? 'success' : 'primary' }}">
                                        {{ $_pengumuman->getStatus() }}
                                    </span>
                                </td>
                                <td class="aksi-column">
                                    <a href="{{ route('pengumuman.show', $_pengumuman->id_pengumuman) }}"
                                        class="btn btn-info btn-sm"><i class="bi bi-info-lg me-2"></i>Detail</a>
                                    <a href="{{ route('pengumuman.edit', $_pengumuman->id_pengumuman) }}"
                                        class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil me-2"></i>Edit</a>
                                    <form id="delete-form"
                                        action="{{ route('pengumuman.destroy', $_pengumuman->id_pengumuman) }}" method="POST"
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
                                <td colspan="5">Belum ada Pengumuman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> --}}
        @empty
            <p class="empty-message text-center mb-0 p-3 rounded">Kelas tidak tersedia.</p>
        @endforelse

        <div class="d-flex justify-content-end">
            {{ $jadwal_pelajaran->links() }}
        </div>
    </div>
@endsection
