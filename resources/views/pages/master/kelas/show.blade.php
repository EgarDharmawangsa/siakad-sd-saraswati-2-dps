@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm me-1"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" class="btn btn-warning btn-sm me-1"><i
                    class="bi bi-pencil me-2"></i>Edit</a>
            <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')

                <button type="button" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal"
                    data-bs-target="#delete-modal">
                    <i class="bi bi-trash me-2"></i>Hapus</button>
            </form>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nama-kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama-kelas" value="{{ $kelas->nama_kelas }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="wali-kelas" class="form-label">Wali Kelas</label>
                <input type="text" class="form-control" id="wali-kelas"
                    value="{{ $kelas->pegawai?->getFormatedNamaPegawai() ?? '-' }}" readonly>
            </div>

            <div class="col-md-12">
                <label for="siswa" class="form-label">Anggota</label>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nomor Urut</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kelas->getSiswaInKelas() as $_siswa_in_kelas)
                                {{-- <tr>
                                    <td>{{ $_siswa_in_kelas->nomor_urut }}</td>
                                    <td>{{ $_siswa_in_kelas->nisn }}</td>
                                    <td>{{ $_siswa_in_kelas->nama_siswa }}</td>
                                </tr> --}}
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Belum memiliki Siswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
