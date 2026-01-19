@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Edit {{ $judul }}</h5>
        <hr>

        <form action="{{ route('nilai-mata-pelajaran.update', $nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
            method="POST">
            @method('PUT')
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="siswa" class="form-label">Siswa</label>
                    <input type="text" class="form-control" id="siswa"
                        value="{{ $nilai_mata_pelajaran->siswa->getFormatedNamaSiswa(true) }}" disabled>
                </div>

                <div class="col-md-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas"
                        value="{{ $nilai_mata_pelajaran->siswa->kelas?->nama_kelas ?? '-' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                    <input type="text" class="form-control" id="mata-pelajaran"
                        value="{{ $nilai_mata_pelajaran->mataPelajaran->nama_mata_pelajaran }}" disabled>
                </div>

                <div class="col-md-6">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control" id="semester"
                        value="{{ $nilai_mata_pelajaran->semester->getTahunAjaran(true) }}" disabled>
                </div>

                <div class="col-md-6">
                    <label for="nilai-ub-1" class="form-label">Nilai UB 1</label>
                    <input type="text" class="form-control @error('nilai_ub_1') is-invalid @enderror" id="nilai-ub-1"
                        name="nilai_ub_1" placeholder="Masukkan nilai UB 1"
                        value="{{ old('nilai_ub_1', $nilai_mata_pelajaran->nilai_ub_1) }}" min="0" max="100" step="0.01" 
                        required>
                    @error('nilai_ub_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nilai-ub-2" class="form-label">Nilai UB 2</label>
                    <input type="text" class="form-control @error('nilai_ub_2') is-invalid @enderror" id="nilai-ub-2"
                        name="nilai_ub_2" placeholder="Masukkan nilai UB 2"
                        value="{{ old('nilai_ub_2', $nilai_mata_pelajaran->nilai_ub_2) }}" min="0" max="100" step="0.01" 
                        required>
                    @error('nilai_ub_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nilai-uts" class="form-label">Nilai UTS</label>
                    <input type="text" class="form-control @error('nilai_uts') is-invalid @enderror" id="nilai-uts"
                        name="nilai_uts" placeholder="Masukkan nilai UTS"
                        value="{{ old('nilai_uts', $nilai_mata_pelajaran->nilai_uts) }}" min="0" max="100" step="0.01" 
                        required>
                    @error('nilai_uts')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nilai-uas" class="form-label">Nilai UAS</label>
                    <input type="text" class="form-control @error('nilai_uas') is-invalid @enderror" id="nilai-uas"
                        name="nilai_uas" placeholder="Masukkan nilai UAS"
                        value="{{ old('nilai_uas', $nilai_mata_pelajaran->nilai_uas) }}" min="0" max="100" step="0.01" 
                        required>
                    @error('nilai_uas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <hr class="text-muted opacity-25">
                </div>
                <div class="col-12"><label class="form-label fw-bold text-muted mt-1 mb-0">Nilai Portofolio</label>
                </div>

                @forelse ($nilai_mata_pelajaran->nilai_portofolio as $index => $portofolio)
                    <div class="col-md-6">
                        <div class="border border-2 border-secondary bg-secondary-subtle rounded px-3 pb-3 pt-2">
                            <label class="form-label">Portofolio {{ $loop->iteration }}</label>

                            <input type="text"
                                class="form-control @error("nilai_portofolio.$index.judul") is-invalid @enderror"
                                name="nilai_portofolio[{{ $index }}][judul]" placeholder="Masukkan judul portofolio"
                                value="{{ old("nilai_portofolio.$index.judul", $portofolio['judul']) }}" required>

                            @error("nilai_portofolio.$index.judul")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="number"
                                class="form-control mt-2 @error("nilai_portofolio.$index.nilai") is-invalid @enderror"
                                name="nilai_portofolio[{{ $index }}][nilai]" placeholder="Masukkan nilai portofolio"
                                value="{{ old("nilai_portofolio.$index.nilai", $portofolio['nilai']) }}" min="0"
                                max="100" step="0.01" required>

                            @error("nilai_portofolio.$index.nilai")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Nilai Portofolio tidak tersedia.</p>
                @endforelse
            </div>

            <p class="mini-label text-muted mt-3 mb-0">
                Mengubah judul portofolio akan mengubah seluruh judul portofolio lainnya di nilai mata pelajaran dengan kelas, mata pelajaran, dan semester yang sama.
            </p>

            <div class="form-buttons">
                <button type="button" class="btn btn-danger" id="cancel-button"
                    data-route="{{ route('nilai-mata-pelajaran.index') }}" data-bs-toggle="modal"
                    data-bs-target="#cancel-modal">
                    <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil me-2"></i>Simpan</button>
            </div>
        </form>
    </div>
@endsection
