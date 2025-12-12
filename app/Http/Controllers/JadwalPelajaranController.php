<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\GuruMataPelajaran;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Gate;

class JadwalPelajaranController extends Controller
{
    public $jadwal_pelajaran_validation_rules = [
        'id_kelas' => 'nullable|integer',
        'id_guru_mata_pelajaran' => 'nullable|integer',
        'kegiatan' => 'required|string|min:3|max:10',
        'hari' => 'required|string|min:3|max:10',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::withJadwalPelajaran(request()->except('nama_kelas_filter'))
            ->orderedNamaKelas()
            ->paginate(20)
            ->withQueryString();

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_jadwal_pelajaran = $request->validate($this->jadwal_pelajaran_validation_rules);

        if ($validated_jadwal_pelajaran['kegiatan'] === 'Belajar' && empty($validated_jadwal_pelajaran['id_guru_mata_pelajaran'])) {
            $id_guru_mata_pelajaran_error = ['id_guru_mata_pelajaran' => 'Guru Mata Pelajaran wajib diisi.'];

            return back()->withErrors($id_guru_mata_pelajaran_error)->withInput();
        }

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }
        
        $jadwalPelajaran->delete();

        return redirect()->route('jadwal-pelajaran.index')->with('success', 'Jadwal Pelajaran berhasil dihapus.');
    }
}
