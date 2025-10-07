<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{

    public function validationRules()
    {
        return [
            'nik' => [
                'required',
                'string',
                'min:16',
                'max:20',
                function ($attribute, $value, $fail) {
                    $existsInPegawai = DB::table('pegawai')->where('nik', $value)->exists();
                    $existsInSiswa = DB::table('siswa')->where('nik', $value)->exists();
                    if ($existsInPegawai || $existsInSiswa) {
                        $fail('NIK sudah terdaftar.');
                    }
                },
            ],
            'nip' => 'nullable|string|min:18|max:20|unique:pegawai,nip',
            'nipppk' => 'nullable|string|min:18|max:20|unique:pegawai,nipppk',
            'nama_pegawai' => 'required|min:3|string|max:255',
            'jenis_kelamin' => 'required|integer|in:1,2',
            'agama' => 'required|integer|in:1,2,3,4,5,6,7',
            'tempat_lahir' => 'required|string|min:3|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|min:10|max:255',
            'no_telepon_rumah' => 'nullable|string|max:20',
            'no_telepon_seluler' => 'required|string|min:10|max:15',
            'username' => 'required|string|min:4|max:50|unique:pegawai,username',
            'password' => 'required|string|min:6',
            'e_mail' => [
                'nullable',
                'email',
                'min:7',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!$value) return;
                    $existsInPegawai = DB::table('pegawai')->where('e_mail', $value)->exists();
                    $existsInSiswa = DB::table('siswa')->where('e_mail', $value)->exists();
                    if ($existsInPegawai || $existsInSiswa) {
                        $fail('E-mail sudah terdaftar.');
                    }
                },
            ],
            'jabatan' => 'nullable|integer|not_int:0',
            'status_perkawinan' => 'nullable|integer|in:1,2,3,4,5,6',
            'status_kepegawaian' => 'required|integer|in:1,2,3',
            'gelar_ijazah' => 'nullable|string|min:3|max:5',
            'tahun_ijazah' => 'nullable|integer|min:1900|max:' . date('Y'),
            'posisi' => 'required|integer|in:1,2,3,4,5',
            'status_sertifikasi' => 'required|boolean',
            'tahun_sertifikasi' => 'required|integer|min:1900|max:' . date('Y'),
            'permulaan_kerja' => 'required|date',
            'permulaan_kerja_sds2' => 'required|date',
            'no_sk' => 'nullable|string|min:5|max:25',
            'tanggal_sk_terakhir' => 'nullable|date',
            'golongan_ruang' => 'nullable|string|min:3|max:5',
            'foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048'
        ];
    }

    public $custom_message_validation = [
        'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
        'agama.in' => 'Pilihan agama tidak valid.',
        'status_perkawinan.in' => 'Pilihan status perkawinan tidak valid.',
        'status_kepegawaian.in' => 'Pilihan status kepegawaian tidak valid.',
        'posisi.in' => 'Pilihan posisi tidak valid.',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.pegawai.index', [
            'judul' => 'Pegawai',
            'pegawai' => Pegawai::latest()->paginate(30)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.pegawai.create', [
            'judul' => 'Tambah Pegawai',
            'mata_pelajaran' => MataPelajaran::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
    public function store(Request $request)
    {
        $validated_pegawai = $request->validate($this->validationRules(), $this->custom_message_validation);

        Pegawai::create($validated_pegawai);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
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
    public function update(Request $request, Pegawai $pegawai) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
