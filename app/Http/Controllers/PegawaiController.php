<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function pegawaiValidationRules()
    {
        return [
            'id_mata_pelajaran' => 'nullable|array',
            'nik' => 'required|string|min:16|max:20|unique:pegawai,nik|unique:siswa,nik',
            'nip' => 'nullable|string|min:18|max:20|unique:pegawai,nip',
            'nipppk' => 'nullable|string|min:18|max:20|unique:pegawai,nipppk',
            'nama_pegawai' => 'required|min:3|string|max:255',
            'jenis_kelamin' => 'required|string|min:3|max:10',
            'agama' => 'required|string|min:3|max:20',
            'tempat_lahir' => 'required|string|min:3|max:25',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string|min:10|max:255',
            'no_telepon_rumah' => 'nullable|string|min:10|max:15',
            'no_telepon_seluler' => 'required|string|min:10|max:15',
            'username' => 'nullable|string|min:5|max:50|unique:users,username',
            'password' => 'nullable|string|min:8|max:255',
            'e_mail' => 'nullable|email|min:7|max:255|unique:pegawai,e_mail|unique:siswa,e_mail',
            'jabatan' => 'nullable|string|min:3|max:30',
            'status_perkawinan' => 'required|min:3|max:10|string',
            'status_kepegawaian' => 'nullable|min:3|max:15|string',
            'ijazah_terakhir' => 'nullable|string|min:2|max:5',
            'tahun_ijazah' => 'nullable|integer|min:1900|max:' . date('Y'),
            'posisi' => 'required|string|min:3|max:20',
            'status_sertifikasi' => 'required|string|min:3|max:5',
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
        $pegawai = Pegawai::with('guruMataPelajaran')->filter(request()->all())->paginate(30)->withQueryString();

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
            $validated_pegawai['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        }

        $pegawai = Pegawai::create($validated_pegawai);

        if ($validated_pegawai['posisi'] === 'Staf Tata Usaha' || $validated_pegawai['posisi'] === 'Guru') {
            User::create([
                'id_pegawai' => $pegawai->id_pegawai,
                'username' => $validated_pegawai['username'],
                'password' => bcrypt($validated_pegawai['password']),
                'role' => $validated_pegawai['posisi']
            ]);
        }

        if ($validated_pegawai['posisi'] === 'Guru' && !empty($validated_pegawai['id_mata_pelajaran'])) {
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
        $pegawai_validation_rules_update = $this->pegawaiValidationRules();
        $pegawai_validation_rules_update['nik'] = "required|string|min:16|max:20|unique:pegawai,nik,{$pegawai->id_pegawai},id_pegawai|unique:siswa,nik";
        $pegawai_validation_rules_update['nip'] = "nullable|string|min:18|max:20|unique:pegawai,nip,{$pegawai->id_pegawai},id_pegawai";
        $pegawai_validation_rules_update['nipppk'] = "nullable|string|min:18|max:20|unique:pegawai,nipppk,{$pegawai->id_pegawai},id_pegawai";
        $pegawai_validation_rules_update['e_mail'] = "nullable|email|min:7|max:255|unique:pegawai,e_mail,{$pegawai->id_pegawai},id_pegawai|unique:siswa,e_mail";
        $pegawai_validation_rules_update['username'] = "nullable|string|min:5|max:50|unique:users,username,{$pegawai->id_pegawai},id_pegawai";
        $pegawai_validation_rules_update['image_delete'] = 'required|integer';

        $validated_pegawai = $request->validate($pegawai_validation_rules_update);

        $nullable_fields = [
            'nip',
            'nipppk',
            'jabatan',
            'status_kepegawaian',
            'ijazah_terakhir',
            'tahun_ijazah',
            'tahun_sertifikasi',
            'no_sk',
            'tanggal_sk_terakhir',
        ];

        foreach ($nullable_fields as $field) {
            if (empty($validated_pegawai[$field])) {
                $validated_pegawai[$field] = null;
            }
        }

        if ($validated_pegawai['image_delete'] == 1) {
            if (!empty($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $validated_pegawai['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            if (!empty($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $validated_pegawai['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        } else {
            $validated_pegawai['foto'] = $pegawai->foto;
        }

        $pegawai->update($validated_pegawai);

        if ($pegawai->posisi === 'Staf Tata Usaha' || $pegawai->posisi === 'Guru') {
            $user_data = [
                'username' => $validated_pegawai['username'],
                'role' => $validated_pegawai['posisi']
            ];

            if (!empty(trim($validated_pegawai['password']))) {
                $user_data['password'] = bcrypt($validated_pegawai['password']);
            }

            User::where('id_pegawai', $pegawai->id_pegawai)->update($user_data);
        } else {
            User::where('id_pegawai', $pegawai->id_pegawai)->delete();
        }

        if ($validated_pegawai['posisi'] === 'Guru' && !empty($validated_pegawai['id_mata_pelajaran'])) {
            $new_mata_pelajaran = $validated_pegawai['id_mata_pelajaran'];
            $old_mata_pelajaran = $pegawai->guruMataPelajaran->pluck('id_mata_pelajaran')->toArray();

            $checked_mata_pelajaran = array_diff($new_mata_pelajaran, $old_mata_pelajaran);
            $unchecked_mata_pelajaran = array_diff($old_mata_pelajaran, $new_mata_pelajaran);

            foreach ($checked_mata_pelajaran as $id_mata_pelajaran) {
                $pegawai->guruMataPelajaran()->create([
                    'id_pegawai' => $pegawai->id_pegawai,
                    'id_mata_pelajaran' => $id_mata_pelajaran
                ]);
            }

            if (!empty($unchecked_mata_pelajaran)) {
                $pegawai->guruMataPelajaran()
                    ->whereIn('id_mata_pelajaran', $unchecked_mata_pelajaran)
                    ->delete();
            }
        } else {
            $pegawai->guruMataPelajaran()->delete();
            $pegawai->kelas()->update(['id_pegawai' => null]);
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
