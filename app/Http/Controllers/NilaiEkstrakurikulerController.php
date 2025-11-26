<?php

namespace App\Http\Controllers;

use App\Models\NilaiEkstrakurikuler;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\Semester;
use Illuminate\Http\Request;

class NilaiEkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai_ekstrakurikuler = NilaiEkstrakurikuler::filter(request()->all())->paginate(30)->withQueryString();
        $siswa = Siswa::latest()->get();
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
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    {
        //
    }
}
