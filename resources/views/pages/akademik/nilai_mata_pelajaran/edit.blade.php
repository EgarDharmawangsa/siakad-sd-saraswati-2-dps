@extends('layouts.main')

@section('container')
    <div class="content-card mb-4">
        <h5>Edit {{ $judul }}</h5>
        <hr>

        <form action="{{ route('nilai-mata-pelajaran.edit', $nilai_mata_pelajaran->id_nilai_mata_pelajaran) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="siswa" class="form-label">Siswa</label>
                        <input type="text" class="form-control" id="siswa"
                            value="{{ $nilai_ekstrakurikuler->pesertaEkstrakurikuler->siswa->getFormatedNamaSiswa() }}"
                            disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="ekstrakurikuler" class="form-label">Ekstrakurikuler</label>
                        <input type="text" class="form-control" id="ekstrakurikuler"
                            value="{{ $nilai_ekstrakurikuler->pesertaEkstrakurikuler->ekstrakurikuler->nama_ekstrakurikuler }}"
                            disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester"
                            value="{{ $nilai_ekstrakurikuler->semester->getTahunAjaranFormated(true) }}" disabled>
                    </div>

                    @foreach ($nilai_mata_pelajaran->nilai_portofolio as $index => $portofolio)
                        <div class="col-md-6">
                            <div class="border border-2 border-secondary bg-secondary-subtle rounded px-3 pb-3 pt-2 mt-2">
                                <label class="form-label">Portofolio {{ $loop->iteration }}</label>

                                <input type="text"
                                    class="form-control @error("nilai_portofolio.$index.judul") is-invalid @enderror"
                                    name="nilai_portofolio[{{ $index }}][judul]"
                                    placeholder="Masukkan judul portofolio"
                                    value="{{ old("nilai_portofolio.$index.judul", $portofolio['judul']) }}" required>

                                @error("nilai_portofolio.$index.judul")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <input type="number"
                                    class="form-control mt-2 @error("nilai_portofolio.$index.nilai") is-invalid @enderror"
                                    name="nilai_portofolio[{{ $index }}][nilai]"
                                    placeholder="Masukkan nilai portofolio"
                                    value="{{ old("nilai_portofolio.$index.nilai", $portofolio['nilai']) }}" min="0"
                                    max="100" required>

                                @error("nilai_portofolio.$index.nilai")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach


                    <div class="col-md-6">
                        <label for="nilai-ub-1" class="form-label">Nilai UB 1</label>
                        <input type="text" class="form-control @error('nilai_ub_1') is-invalid @enderror" id="nilai-ub-1"
                            name="nilai_ub" placeholder="Masukkan nilai UB 1"
                            value="{{ old('nilai_ub_1', $nilai_mata_pelajaran->nilai_ub_1) }}" min="0" max="100"
                            required>
                        @error('nilai_ub_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nilai-ub-2" class="form-label">Nilai UB 2</label>
                        <input type="text" class="form-control @error('nilai_ub_2') is-invalid @enderror" id="nilai-ub-2"
                            name="nilai_ub" placeholder="Masukkan nilai UB 2"
                            value="{{ old('nilai_ub_2', $nilai_mata_pelajaran->nilai_ub_2) }}" min="0" max="100"
                            required>
                        @error('nilai_ub_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nilai-uts" class="form-label">Nilai UTS</label>
                        <input type="text" class="form-control @error('nilai_uts') is-invalid @enderror" id="nilai-uts"
                            name="nilai_uts" placeholder="Masukkan nilai UTS"
                            value="{{ old('nilai_uts', $nilai_mata_pelajaran->nilai_uts) }}" min="0" max="100"
                            required>
                        @error('nilai_uts')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nilai-uas" class="form-label">Nilai UAS</label>
                        <input type="text" class="form-control @error('nilai_uas') is-invalid @enderror" id="nilai-uas"
                            name="nilai_uas" placeholder="Masukkan nilai UAS"
                            value="{{ old('nilai_uas', $nilai_mata_pelajaran->nilai_uas) }}" min="0" max="100"
                            required>
                        @error('nilai_uas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="button" class="btn btn-danger" id="cancel-button"
                        data-route="{{ route('nilai-mata-pelajaran.index') }}" data-bs-toggle="modal"
                        data-bs-target="#cancel-modal">
                        <i class="bi bi-x-lg me-2 batal-icon-button"></i>Batal</button>
                    <button type="submit" class="btn btn-primary ms-2"><i class="bi bi-pencil me-2"></i>Simpan</button>
                </div>
        </form>
    </div>
@endsection
