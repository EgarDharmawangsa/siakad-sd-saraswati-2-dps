<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

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
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $mata_pelajaran = MataPelajaran::filter(request()->all())->paginate(20)->withQueryString();

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        return view('pages.master.mata_pelajaran.create', [
            'judul' => 'Mata Pelajaran'
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

        $validated_mata_pelajaran = $request->validate($this->kelas_validation_rules);

        MataPelajaran::create($validated_mata_pelajaran);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $kelas_update_validation_rules = $this->kelas_validation_rules;

        $kelas_update_validation_rules['nama_mata_pelajaran'] = "required|string|min:3|max:25|unique:mata_pelajaran,nama_mata_pelajaran,{$mataPelajaran->id_mata_pelajaran},id_mata_pelajaran";

        $validated_mata_pelajaran = $request->validate($kelas_update_validation_rules);

        $mataPelajaran->update($validated_mata_pelajaran);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        try {
            $mataPelajaran->delete();
    
            return redirect()->route('mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Mata Pelajaran gagal dihapus karena masih terhubung dengan Pegawai.');
        }
    }
}
