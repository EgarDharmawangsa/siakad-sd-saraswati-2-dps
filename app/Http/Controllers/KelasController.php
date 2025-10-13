<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('pegawai')
            ->orderByRaw('CAST(nama_kelas AS UNSIGNED)')
            ->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")')
            ->paginate(20)
            ->withQueryString();

        return view('pages.master.kelas.index', [
            'judul' => 'Kelas',
            'kelas' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Pegawai::where('posisi', 'Guru')->latest()->get();

        return view('pages.master.kelas.create', [
            'judul' => 'Kelas',
            'guru' => $guru
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kelas_validation_rules = [
            'nama_kelas' => 'required|string|min:2|max:5|unique:kelas,nama_kelas|regex:/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{2,5}$/',
            'id_pegawai' => 'required|integer|not_in:0|exists:pegawai,id_pegawai|unique:kelas,id_pegawai',
        ];

        $validated_kelas = $request->validate($kelas_validation_rules);

        Kelas::create($validated_kelas);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        $guru = Pegawai::where('posisi', 2)->latest()->get();

        return view('pages.master.kelas.show', [
            'judul' => 'Kelas',
            'kelas' => $kelas,
            'guru' => $guru
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('pages.master.kelas.edit', [
            'judul' => 'Kelas',
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $kelas_validation_rules_update = [
            'nama_kelas' => "required|string|min:2|max:5|unique:kelas,nama_kelas,{$kelas->id_kelas},id_kelas|regex:/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{2,5}$/",
            'id_pegawai' => "required|integer|not_in:0|exists:pegawai,id_pegawai|unique:kelas,id_pegawai,{$kelas->id_kelas},id_kelas"
        ];

        $validated_kelas = $request->validate($kelas_validation_rules_update);

        $kelas->update($validated_kelas);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
