@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Detail {{ $judul }}</h5>
        <hr>

        <div class="show-buttons">
            <a href="{{ route('nilai-mata-pelajaran.index') }}" class="btn btn-secondary"><i
                    class="bi bi-arrow-left me-2"></i>Kembali</a>
            @canany(['staf-tata-usaha', 'guru'])
                <a href="{{ route('nilai-mata-pelajaran.edit', $nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
                    class="btn btn-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
            @endcanany
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="siswa" class="form-label">Siswa</label>
                <input type="text" class="form-control" id="siswa"
                    value="{{ $nilai_mata_pelajaran->siswa->getFormatedNamaSiswa() }}" readonly>
            </div>

            @canany(['staf-tata-usaha', 'guru'])
                <div class="col-md-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas"
                        value="{{ $nilai_mata_pelajaran->siswa->kelas?->nama_kelas ?? '-' }}" readonly>
                </div>
            @endcanany

            <div class="col-md-6">
                <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control" id="mata-pelajaran"
                    value="{{ $nilai_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester"
                    value="{{ $nilai_mata_pelajaran->semester->getTahunAjaran(true) }}" readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-ub-1" class="form-label">Nilai UB 1</label>
                <input type="text" class="form-control" id="nilai-ub-1" value="{{ $nilai_mata_pelajaran->nilai_ub_1 }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-ub-2" class="form-label">Nilai UB 2</label>
                <input type="text" class="form-control" id="nilai-ub-2" value="{{ $nilai_mata_pelajaran->nilai_ub_2 }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-uts" class="form-label">Nilai UTS</label>
                <input type="text" class="form-control" id="nilai-uts" value="{{ $nilai_mata_pelajaran->nilai_uts }}"
                    readonly>
            </div>

            <div class="col-md-6">
                <label for="nilai-uas" class="form-label">Nilai UAS</label>
                <input type="text" class="form-control" id="nilai-uas" value="{{ $nilai_mata_pelajaran->nilai_uas }}"
                    readonly>
            </div>

            <div class="col-md-12">
                <hr class="text-muted opacity-25">
            </div>
            <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Nilai Portofolio</label></div>

            @forelse ($nilai_mata_pelajaran->nilai_portofolio as $_nilai_portofolio)
                <div class="col-md-6">
                    <div class="border border-2 border-secondary bg-secondary-subtle rounded px-3 pb-3 pt-2">
                        <label class="form-label">Portofolio {{ $loop->iteration }}</label>

                        <input type="text" class="form-control" id="nilai-portofolio" value="{{ $_nilai_portofolio['judul'] }}"
                            readonly>
                        <input type="text" class="form-control" id="nilai-portofolio" value="{{ $_nilai_portofolio['nilai'] }}"
                            readonly>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Nilai Portofolio tidak tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
