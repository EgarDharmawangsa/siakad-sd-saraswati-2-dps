<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function pegawaiValidationRules() {
        return [
            'nik' => 'required|string|min:16|max:20',
            'nip' => 'nullable|string|min:18|max:20|unique:pegawai,nip',
            'nipppk' => 'nullable|string|min:18|max:20|unique:pegawai,nipppk',
            'nama_pegawai' => 'required|min:3|string|max:255',
            'jenis_kelamin' => 'required|string|not_in:default',
            'agama' => 'required|string|not_in:default',
            'tempat_lahir' => 'required|string|min:3|max:25',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string|min:10|max:255',
            'no_telepon_rumah' => 'nullable|string|max:15',
            'no_telepon_seluler' => 'required|string|min:10|max:15',
            'e_mail' => 'nullable|email|min:7|max:255',
            'jabatan' => 'nullable|string|not_in:default',
            'status_perkawinan' => 'required|string|not_in:default',
            'status_kepegawaian' => 'nullable|string|not_in:default',
            'ijazah_terakhir' => 'nullable|string|min:2|max:5',
            'tahun_ijazah' => 'nullable|integer|min:1900|max:' . date('Y'),
            'posisi' => 'required|string|not_in:default',
            'status_sertifikasi' => 'required|string|not_in:default',
            'tahun_sertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'permulaan_kerja' => 'required|date',
            'permulaan_kerja_sds2' => 'required|date',
            'no_sk' => 'nullable|string|min:5|max:25',
            'tanggal_sk_terakhir' => 'nullable|date|before_or_equal:today',
            'foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048'
        ];    
    }

    
    
    public function index()
    {
        $pegawai = Pegawai::latest()->paginate(30)->withQueryString();

        return view('pages.master.pegawai.index', [
            'judul' => 'Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.pegawai.create', [
            'judul' => 'Pegawai',
            'mata_pelajaran' => MataPelajaran::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
    public function store(Request $request)
    {
        $validated_pegawai =$request->validate($this->pegawaiValidationRules());

        if ($request->hasFile('foto')) {
            $validated_pegawai['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        Pegawai::create($validated_pegawai);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        return view('pages.master.pegawai.show', [
            'judul' => 'Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pages.master.pegawai.edit', [
            'judul' => 'Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated_pegawai = $request->validate($this->pegawaiValidationRules());

        if ($request->gambar_delete == 1) {
            if (!empty($request->old_foto)) {
                Storage::disk('public')->delete($request->old_foto);
            }
            $validated_pegawai['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            if (!empty($request->old_foto)) {
                Storage::disk('public')->delete($request->old_foto);
            }
            $validated_pegawai['foto'] = $request->file('foto')->store('pegawai', 'public');
        } else {
            $validated_pegawai['foto'] = $pegawai->old_foto;
        }

        $pegawai->update($validated_pegawai);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        if (!empty($pegawai->foto)) {
            Storage::delete($pegawai->foto);
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
