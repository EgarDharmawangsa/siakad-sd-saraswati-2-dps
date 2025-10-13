<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public $kelas_validation_rules = [
        'nama_mata_pelajaran' => 'required|string|min:3|max:25|unique:mata_pelajaran,nama_mata_pelajaran',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mata_pelajaran = MataPelajaran::latest()->paginate(20)->withQueryString();

        return view('pages.master.mata_pelajaran.index', [
            'judul' => 'Mata Pelajaran',
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.mata_pelajaran.create', [
            'judul' => 'Mata Pelajaran'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_mata_pelajaran = $request->validate($this->kelas_validation_rules);

        MataPelajaran::create($validated_mata_pelajaran);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        return view('pages.master.mata_pelajaran.show', [
            'judul' => 'Mata Pelajaran',
            'mata_pelajaran' => $mataPelajaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('pages.master.mata_pelajaran.edit', [
            'judul' => 'Mata Pelajaran',
            'mata_pelajaran' => $mataPelajaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $kelas_validation_rules_update = $this->kelas_validation_rules;

        $kelas_validation_rules_update['nama_mata_pelajaran'] = "required|string|min:3|max:25|unique:mata_pelajaran,nama_mata_pelajaran,{$mataPelajaran->id_mata_pelajaran},id_mata_pelajaran";

        $validated_mata_pelajaran = $request->validate($kelas_validation_rules_update);

        $mataPelajaran->update($validated_mata_pelajaran);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
