<?php

namespace App\Http\Controllers;

use App\Models\NilaiEkstrakurikuler;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NilaiEkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $nilai_ekstrakurikuler = NilaiEkstrakurikuler::with(['pesertaEkstrakurikuler.siswa', 'pesertaEkstrakurikuler.ekstrakurikuler', 'semester'])->filter(request()->all())->paginate(30)->withQueryString();
        else if (Gate::allows('siswa')) {
            $nilai_ekstrakurikuler = NilaiEkstrakurikuler::with(['pesertaEkstrakurikuler.siswa', 'pesertaEkstrakurikuler.ekstrakurikuler', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->all())->paginate(30)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::get();
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $semester = Semester::latest()->get();

        return view('pages.akademik.nilai_ekstrakurikuler.index', [
            'judul' => 'Nilai Ekstrakurikuler',
            'nilai_ekstrakurikuler' => $nilai_ekstrakurikuler,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'ekstrakurikuler' => $ekstrakurikuler,
            'semester' => $semester
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $semester = Semester::latest()->get();

        return view('pages.akademik.nilai_ekstrakurikuler.create', [
            'judul' => 'Nilai Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler,
            'semester' => $semester
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        return view('pages.akademik.nilai_ekstrakurikuler.show', [
            'judul' => 'Nilai Ekstrakurikuler',
            'nilai_ekstrakurikuler' => $nilaiEkstrakurikuler
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_nilai_ekstrakurikuler = $request->validate([
            'id_nilai_ekstrakurikuler' => 'required|array',
            'id_nilai_ekstrakurikuler.*' => 'required|exists:nilai_ekstrakurikuler,id_nilai_ekstrakurikuler',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|integer|min:0|max:100'
        ]);

        foreach ($validated_nilai_ekstrakurikuler['id_nilai_ekstrakurikuler'] as $_id_nilai_ekstrakurikuler) {
            if (!\array_key_exists($_id_nilai_ekstrakurikuler, $validated_nilai_ekstrakurikuler['nilai'])) {
                continue;
            }

            NilaiEkstrakurikuler::where('id_nilai_ekstrakurikuler', $_id_nilai_ekstrakurikuler)->where('nilai', '!=', $validated_nilai_ekstrakurikuler['nilai'][$_id_nilai_ekstrakurikuler])
                ->update([
                    'nilai' => $validated_nilai_ekstrakurikuler['nilai'][$_id_nilai_ekstrakurikuler]
                ]);
        }

        return back()->with('success', 'Nilai Ekstrakurikuler berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    // {
    //     //
    // }
}
