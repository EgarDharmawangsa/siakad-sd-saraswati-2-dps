<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.pegawai.index', [
            'judul' => 'Pegawai',
            'pegawai' => Pegawai::latest()->paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.pegawai.create', [
            'judul' => 'Pegawai'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|string|max:20|unique:pegawais,nik',
        'nip' => 'required|string|max:20|unique:pegawais,nip',
        'nama_pegawai' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'tempat_lahir' => 'nullable|string|max:100',
        'tanggal_lahir' => 'nullable|date',
        'alamat' => 'nullable|string',
        'no_telepon_rumah' => 'nullable|string|max:20',
        'no_telepon_seluler' => 'nullable|string|max:20',
        'e_mail' => 'nullable|email|max:255',
        'pangkat' => 'nullable|string|max:100',
        'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
        'status_kepegawaian' => 'nullable|in:PNS,Honorer,Kontrak',
        'gelar_ijazah' => 'nullable|string|max:100',
        'tahun_ijazah' => 'nullable|integer|min:1900|max:' . date('Y'),
        'posisi' => 'nullable|string|max:100',
        'status_sertifikasi' => 'nullable|in:Sudah,Belum',
        'tahun_sertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
        'permulaan_kerja' => 'nullable|date',
        'permulaan_kerja_sds2' => 'nullable|date',
        'no_sk' => 'nullable|string|max:100',
        'tanggal_sk_terakhir' => 'nullable|date',
        'golongan_ruang' => 'nullable|string|max:50',
    ]);

    Pegawai::create($request->all());

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
public function update(Request $request, Pegawai $pegawai)
{
    $request->validate([
        'nik' => 'required|string|max:20|unique:pegawais,nik,' . $pegawai->id_pegawai . ',id_pegawai',
        'nip' => 'required|string|max:20|unique:pegawais,nip,' . $pegawai->id_pegawai . ',id_pegawai',
        'nama_pegawai' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        'tempat_lahir' => 'nullable|string|max:100',
        'tanggal_lahir' => 'nullable|date',
        'alamat' => 'nullable|string',
        'no_telepon_rumah' => 'nullable|string|max:20',
        'no_telepon_seluler' => 'nullable|string|max:20',
        'e_mail' => 'nullable|email|max:255',
        'pangkat' => 'nullable|string|max:100',
        'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
        'status_kepegawaian' => 'nullable|in:PNS,Honorer,Kontrak',
        'gelar_ijazah' => 'nullable|string|max:100',
        'tahun_ijazah' => 'nullable|integer|min:1900|max:' . date('Y'),
        'posisi' => 'nullable|string|max:100',
        'status_sertifikasi' => 'nullable|in:Sudah,Belum',
        'tahun_sertifikasi' => 'nullable|integer|min:1900|max:' . date('Y'),
        'permulaan_kerja' => 'nullable|date',
        'permulaan_kerja_sds2' => 'nullable|date',
        'no_sk' => 'nullable|string|max:100',
        'tanggal_sk_terakhir' => 'nullable|date',
        'golongan_ruang' => 'nullable|string|max:50',
    ]);

    $pegawai->update($request->all());

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diupdate!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
