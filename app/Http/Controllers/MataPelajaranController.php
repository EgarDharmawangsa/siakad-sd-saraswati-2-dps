<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MataPelajaranController extends Controller
{
    public $validation_rules = [
        'nama_mata_pelajaran' => ['required', 'string', 'min:3', 'max:25'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.mata_pelajaran.index', [
            'judul' => 'Mata Pelajaran',
            'mata_pelajaran' => MataPelajaran::paginate(20)->withQueryString()
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
        $validated_mata_pelajaran = $request->validate($this->validation_rules);

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
        $update_validation_rules = $this->validation_rules;

        $update_validation_rules['nama_mata_pelajaran'][] = Rule::unique('mata_pelajaran', 'nama_mata_pelajaran')->ignore($mataPelajaran->id_mata_pelajaran);

        $validated_mata_pelajaran = $request->validate($update_validation_rules);

        $mataPelajaran->update($validated_mata_pelajaran);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil diubah.');
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
