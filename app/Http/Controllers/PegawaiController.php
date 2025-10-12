<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function pegawaiValidationRules() {
        return [
            'id_mata_pelajaran' => 'nullable|array',
            'nik' => 'required|string|min:16|max:20',
            'nip' => 'nullable|string|min:18|max:20|unique:pegawai,nip',
            'nipppk' => 'nullable|string|min:18|max:20|unique:pegawai,nipppk',
            'nama_pegawai' => 'required|min:3|string|max:255',
            'jenis_kelamin' => 'required|string|min:3|max:10|not_in:default',
            'agama' => 'required|string|min:3|max:20|not_in:default',
            'tempat_lahir' => 'required|string|min:3|max:25',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string|min:10|max:255',
            'no_telepon_rumah' => 'nullable|string|min:10|max:15',
            'no_telepon_seluler' => 'required|string|min:10|max:15',
            'username' => 'required|string|min:5|max:50|unique:users,username',
            'password' => 'required|string|min:8|max:255',
            'e_mail' => 'nullable|email|min:7|max:255',
            'jabatan' => 'nullable|string|min:3|max:30|not_in:default',
            'status_perkawinan' => 'required|min:3|max:10|string|not_in:default',
            'status_kepegawaian' => 'nullable|min:3|max:15|string|not_in:default',
            'ijazah_terakhir' => 'nullable|string|min:2|max:5',
            'tahun_ijazah' => 'nullable|integer|min:1900|max:' . date('Y'),
            'posisi' => 'required|string|min:3|max:20|not_in:default',
            'status_sertifikasi' => 'required|string|min:3|max:5|not_in:default',
            'tahun_sertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'permulaan_kerja' => 'required|date|before_or_equal:today',
            'permulaan_kerja_sds2' => 'required|date|before_or_equal:today',
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
        $mata_pelajaran = MataPelajaran::all();

        return view('pages.master.pegawai.create', [
            'judul' => 'Pegawai',
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
    public function store(Request $request)
    {
        $validated_pegawai = $request->validate($this->pegawaiValidationRules());

        if ($request->hasFile('foto')) {
            $validated_pegawai['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        if ($validated_pegawai['posisi'] == 'Guru' && empty($validated_pegawai['id_mata_pelajaran'])) {
            return redirect()->back()->withErrors(['id_mata_pelajaran' => 'Mata Pelajaran yang dipilih tidak valid.'])->withInput();
        }

        $pegawai = Pegawai::create($validated_pegawai);

        if ($validated_pegawai['posisi'] == 'Staf Tata Usaha' || $validated_pegawai['posisi'] == 'Guru') {
            User::create([
                'id_pegawai' => $pegawai->id_pegawai,
                'username' => $validated_pegawai['username'],
                'password' => bcrypt($validated_pegawai['password']),
                'role' => $validated_pegawai['posisi']
            ]);
        }

        if ($validated_pegawai['posisi'] == 'Guru') {
            foreach ($validated_pegawai['id_mata_pelajaran'] as $_id_mata_pelajaran) {
                $pegawai->guruMataPelajaran()->create([
                    'id_pegawai' => $pegawai->id_pegawai,
                    'id_mata_pelajaran' => $_id_mata_pelajaran
                ]);
            }
        }

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
        $mata_pelajaran = MataPelajaran::all();

        return view('pages.master.pegawai.edit', [
            'judul' => 'Pegawai',
            'pegawai' => $pegawai,
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated_pegawai = $request->validate($this->pegawaiValidationRules());

        if (empty($validated_pegawai['nip'])) {
            $validated_pegawai['nip'] = null;
        }

        if (empty($validated_pegawai['nipppk'])) {
            $validated_pegawai['nipppk'] = null;
        }

        if (empty($validated_pegawai['jabatan'])) {
            $validated_pegawai['jabatan'] = null;
        }

        if (empty($validated_pegawai['status_kepegawaian'])) {
            $validated_pegawai['status_kepegawaian'] = null;
        }

        if (empty($validated_pegawai['ijazah_terakhir'])) {
            $validated_pegawai['ijazah_terakhir'] = null;
        }

        if (empty($validated_pegawai['tahun_ijazah'])) {
            $validated_pegawai['tahun_ijazah'] = null;
        }

        if (empty($validated_pegawai['tahun_sertifikasi'])) {
            $validated_pegawai['tahun_sertifikasi'] = null;
        }

        if (empty($validated_pegawai['no_sk'])) {
            $validated_pegawai['no_sk'] = null;
        }

        if (empty($validated_pegawai['tanggal_sk_terakhir'])) {
            $validated_pegawai['tanggal_sk_terakhir'] = null;
        }

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

        if ($pegawai->posisi == 'Staf Tata Usaha' || $pegawai->posisi == 'Guru') {
            User::where('id_pegawai', $pegawai->id_pegawai)->update([
                'username' => $validated_pegawai['username'], 
                'password' => bcrypt($validated_pegawai['password']),
                'role' => $validated_pegawai['posisi']
            ]);
        } else {
            User::where('id_pegawai', $pegawai->id_pegawai)->delete();
        }

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        User::where('id_pegawai', $pegawai->id_pegawai)->delete();

        if (!empty($pegawai->foto)) {
            Storage::delete($pegawai->foto);
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
