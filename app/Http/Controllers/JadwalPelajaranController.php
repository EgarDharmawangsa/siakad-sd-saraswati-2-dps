<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal_pelajaran = JadwalPelajaran::latest()->paginate(20)->withQueryString();

        $kelas = Kelas::query()->orderByRaw('CAST(nama_kelas AS UNSIGNED)')->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")')->paginate(20)->withQueryString();

        return view('pages.akademik.jadwal_pelajaran.index', [
            'judul' => 'Jadwal Pelajaran',
            'kelas' => $kelas,
            'jadwal_pelajaran' => $jadwal_pelajaran
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
    public function show(JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPelajaran $jadwalPelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPelajaran $jadwalPelajaran)
    {
        //
    }
}
