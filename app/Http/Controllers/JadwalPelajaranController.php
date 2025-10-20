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
        'id_kelas' => 'nullable|integer',
        'id_guru_mata_pelajaran' => 'nullable|integer',
        'kegiatan' => 'required|string|min:3|max:10|in:Belajar,Istirahat',
        'hari' => 'required|string|min:3|max:10',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with([
            'pegawai',
            'jadwalPelajaran' => function($query) {
                $query->orderByRaw("
                    FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')
                ")->orderBy('jam_mulai');
            },
            'jadwalPelajaran.guruMataPelajaran.mataPelajaran',
            'jadwalPelajaran.guruMataPelajaran.pegawai'
        ])
            ->orderByRaw('CAST(nama_kelas AS UNSIGNED)')
            ->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")')
            ->get();

        return view('pages.akademik.jadwal_pelajaran.index', [
            'judul' => 'Jadwal Pelajaran',
            'kelas' => $kelas
        ]);   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::query()
            ->orderByRaw('CAST(nama_kelas AS UNSIGNED)')
            ->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")')
            ->paginate(20)
            ->withQueryString();
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
        $validated_jadwal_pelajaran = $request->validate($this->jadwal_pelajaran_validation_rules);

        $errors = JadwalPelajaran::getJamValidationErrors(
            $validated_jadwal_pelajaran['id_kelas'],
            $validated_jadwal_pelajaran['hari'],
            $validated_jadwal_pelajaran['jam_mulai'],
            $validated_jadwal_pelajaran['jam_selesai']
        );

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        JadwalPelajaran::create($validated_jadwal_pelajaran);

        return redirect()->route('jadwal-pelajaran.index')->with('success', 'Jadwal pelajaran berhasil ditambahkan.');
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
        $validated_jadwal_pelajaran = $request->validate($this->jadwal_pelajaran_validation_rules);

        $errors = JadwalPelajaran::getJamValidationErrors(
            $validated_jadwal_pelajaran['id_kelas'],
            $validated_jadwal_pelajaran['hari'],
            $validated_jadwal_pelajaran['jam_mulai'],
            $validated_jadwal_pelajaran['jam_selesai'],
            $jadwalPelajaran->id_jadwal_pelajaran
        );

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        if (empty($validated_jadwal_pelajaran['id_guru_mata_pelajaran'])) {
            $validated_jadwal_pelajaran['id_guru_mata_pelajaran'] = null;
        }

        $jadwalPelajaran->update($validated_jadwal_pelajaran);

        return redirect()->route('jadwal-pelajaran.index')->with('success', 'Jadwal pelajaran berhasil diperbarui.');
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
