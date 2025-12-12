<?php

namespace App\Http\Controllers;

use App\Models\NilaiEkstrakurikuler;
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
            $nilai_ekstrakurikuler = NilaiEkstrakurikuler::with(['siswa', 'ekstrakurikuler', 'semester'])->filter(request()->all())->paginate(30)->withQueryString();
        else if (Gate::allows('siswa')) {
            $nilai_ekstrakurikuler = NilaiEkstrakurikuler::with(['siswa', 'ekstrakurikuler', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->all())->paginate(30)->withQueryString();
        } else {
            abort(404);
        }

        $siswa = Siswa::get();
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $semester = Semester::latest()->get();

        return view('pages.akademik.nilai_ekstrakurikuler.index', [
            'judul' => 'Nilai Ekstrakurikuler',
            'nilai_ekstrakurikuler' => $nilai_ekstrakurikuler,
            'siswa' => $siswa,
            'ekstrakurikuler' => $ekstrakurikuler,
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
    public function show(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        //
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

        $nilai_ekstrakurikuler_validation_rules = [
            'id.*' => 'required|exists:nilai_ekstrakurikulers,id_nilai_ekstrakurikuler',
            'nilai.*' => 'required|integer|min:0|max:100',
        ];

        $validated_nilai_ekstrakurikuler = $request->validate($nilai_ekstrakurikuler_validation_rules);

        foreach ($validated_nilai_ekstrakurikuler['id_nilai_ekstrakurikuler'] as $key => $id_nilai_ekstrakurikuler) {
            NilaiEkstrakurikuler::where('id_nilai_ekstrakurikuler', $id_nilai_ekstrakurikuler)
                ->update(['nilai' => $validated_nilai_ekstrakurikuler['nilai'][$key]]);
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
