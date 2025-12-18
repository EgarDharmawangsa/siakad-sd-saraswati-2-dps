<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\NilaiMataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NilaiMataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $nilai_mata_pelajaran = NilaiMataPelajaran::with(['siswa', 'ekstrakurikuler', 'semester'])->filter(request()->all())->paginate(30)->withQueryString();
        else if (Gate::allows('siswa')) {
            $nilai_mata_pelajaran = NilaiMataPelajaran::with(['siswa', 'ekstrakurikuler', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->all())->paginate(30)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::get();
        $mata_pelajaran = MataPelajaran::latest()->get();
        $semester = Semester::latest()->get();

        return view('pages.akademik.nilai_mata_pelajaran.index', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilai_mata_pelajaran,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'mata_pelajaran' => $mata_pelajaran,
            'semester' => $semester
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        return view('pages.akademik.nilai_mata_pelajaran.show', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilaiMataPelajaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        return view('pages.akademik.nilai_mata_pelajaran.edit', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilaiMataPelajaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiMataPelajaran $nilaiMataPelajaran)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $nilai_mata_pelajaran_validation_rules = [
            'id.*' => 'required|exists:nilai_mata_pelajaran,id_nilai_mata_pelajaran',
            'nilai_portofolio.*' => 'required|integer|min:0|max:100',
            'nilai_ub.*' => 'required|integer|min:0|max:100',
            'nilai_uts.*' => 'required|integer|min:0|max:100',
            'nilai_uas.*' => 'required|integer|min:0|max:100'
        ];

        $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_validation_rules);

        if (request()->routeIs('nilai-mata-pelajaran.mass-update')) {
            foreach ($validated_nilai_mata_pelajaran['id_nilai_mata_pelajaran'] as $key => $id_nilai_mata_pelajaran) {
                NilaiMataPelajaran::where('id_nilai_mata_pelajaran', $id_nilai_mata_pelajaran)
                    ->update([
                        'nilai_portofolio' => $validated_nilai_mata_pelajaran['nilai_portofolio'][$key],
                        'nilai_ub' => $validated_nilai_mata_pelajaran['nilai_ub'][$key],
                        'nilai_uts' => $validated_nilai_mata_pelajaran['nilai_uts'][$key],
                        'nilai_uas' => $validated_nilai_mata_pelajaran['nilai_uas'][$key]
                    ]);
            }
        } else {
            // nanti disini untuk update single 
        }

        return back()->with('success', 'Nilai Mata Pelajaran berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(NilaiMataPelajaran $nilaiMataPelajaran)
    // {
    //     //
    // }
}
