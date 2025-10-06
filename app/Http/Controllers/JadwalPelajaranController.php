<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\GuruMataPelajaran;
use App\Models\MataPelajaran;

class JadwalPelajaranController extends Controller
{
    public $jadwal_pelajaran_validation_rules = [
        'id_kelas' => 'required|integer|not_in:0',
        'id_guru_mata_pelajaran' => 'required|integer|not_in:0',
        'hari' => 'required|string|not_in:default',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal_pelajaran = JadwalPelajaran::all();

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
        $kelas = Kelas::query()->orderByRaw('CAST(nama_kelas AS UNSIGNED)')->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")')->paginate(20)->withQueryString();
        $mata_pelajaran = MataPelajaran::latest()->get();
        $guru_mata_pelajaran = GuruMataPelajaran::all();

        return view('pages.akademik.jadwal_pelajaran.create', [
            'judul' => 'Jadwal Pelajaran',
            'kelas' => $kelas,
            'mata_pelajaran' => $mata_pelajaran,
            'guru_mata_pelajaran' => $guru_mata_pelajaran
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
    public function show(JadwalPelajaran $jadwalPelajaran)
    {
        return view('pages.akademik.jadwal_pelajaran.show', [
            'judul' => 'Jadwal Pelajaran',
            'jadwal_pelajaran' => $jadwalPelajaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPelajaran $jadwalPelajaran)
    {
        $kelas = Kelas::query()->orderByRaw('CAST(nama_kelas AS UNSIGNED)')->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")')->paginate(20)->withQueryString();
        $mata_pelajaran = MataPelajaran::latest()->get();
        $guru_mata_pelajaran = GuruMataPelajaran::all();

        return view('pages.akademik.jadwal_pelajaran.edit', [
            'judul' => 'Jadwal Pelajaran',
            'kelas' => $kelas,
            'jadwal_pelajaran' => $jadwalPelajaran,
            'mata_pelajaran' => $mata_pelajaran,
            'guru_mata_pelajaran' => $guru_mata_pelajaran
        ]);
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
        $jadwalPelajaran->delete();

        return redirect()->route('jadwal-pelajaran.index')->with('success', 'Jadwal Pelajaran berhasil dihapus.');
    }
}
