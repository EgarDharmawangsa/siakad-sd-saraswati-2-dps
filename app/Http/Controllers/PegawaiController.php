<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\MataPelajaran;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PegawaiController extends Controller
{
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $judul = 'Pegawai';
            $pegawai = Pegawai::with(['guruMataPelajaran', 'userAuth'])->filter(request()->all())->paginate(30)->withQueryString();
            $route_index = route('pegawai.index');
        } else if (Gate::allows('siswa')) {
            $judul = 'Guru';
            $pegawai = Pegawai::where('posisi', 'Guru')->with('guruMataPelajaran')->filter(request()->only(['nama_guru_filter', 'guru_mata_pelajaran_filter']))->paginate(30)->withQueryString();
            $route_index = route('guru.index');
        } else {
            abort(404);
        }

        $mata_pelajaran = MataPelajaran::latest()->get();

        return view('pages.master.pegawai.index', [
            'judul' => $judul,
            'pegawai' => $pegawai,
            'mata_pelajaran' => $mata_pelajaran,
            'route_index' => $route_index
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

        $mata_pelajaran = MataPelajaran::latest()->get();

        return view('pages.master.pegawai.create', [
            'judul' => 'Pegawai',
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/PegawaiController.php
    public function store(StorePegawaiRequest $request)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_pegawai = $request->validated();

        if ($request->hasFile('foto')) {
            $validated_pegawai['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        }

        if ($validated_pegawai['posisi'] === 'Staf Tata Usaha' || $validated_pegawai['posisi'] === 'Guru') {
            $user_data = [
                'username' => $validated_pegawai['username'],
                'password' => bcrypt(trim($validated_pegawai['password'])),
                'role' => $validated_pegawai['posisi']
            ];
             
            unset($validated_pegawai['username'], $validated_pegawai['password']);
        }


        if (!empty($validated_pegawai['id_mata_pelajaran'])) {
            $mata_pelajaran_data = $validated_pegawai['id_mata_pelajaran'];
            unset($validated_pegawai['id_mata_pelajaran']);
        }

        $pegawai = Pegawai::create($validated_pegawai);

        if ($pegawai->posisi === 'Staf Tata Usaha' || $pegawai->posisi === 'Guru') {
            $pegawai->userAuth()->create($user_data);
        }

        if ($pegawai->posisi === 'Guru' && !empty($mata_pelajaran_data)) {
            foreach ($mata_pelajaran_data as $_id_mata_pelajaran) {
                $pegawai->guruMataPelajaran()->create([
                    'id_mata_pelajaran' => $_id_mata_pelajaran
                ]);
            }
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $judul = 'Pegawai';
        } else if (Gate::allows('siswa') && $pegawai->posisi === 'Guru') {
            $judul = 'Guru';
        } else {
            abort(404);
        }

        return view('pages.master.pegawai.show', [
            'judul' => $judul,
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $mata_pelajaran = MataPelajaran::latest()->get();

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
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_pegawai = $request->validated();

        // INI UNTUK FOTO
        if ($validated_pegawai['image_delete'] == 1) {
            if (!empty($pegawai->foto)) {
                Storage::delete($pegawai->foto);
            }
            $validated_pegawai['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            if (!empty($pegawai->foto)) {
                Storage::delete($pegawai->foto);
            }
            $validated_pegawai['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        } else {
            $validated_pegawai['foto'] = $pegawai->foto;
        }

        unset($validated_pegawai['image_delete']);

        // INI UNTUK USER
        if ($pegawai->posisi === 'Staf Tata Usaha' || $pegawai->posisi === 'Guru') {
            $user_data = [
                'username' => $validated_pegawai['username'],
                'role' => $validated_pegawai['posisi']
            ];

            if (!empty(trim($validated_pegawai['password']))) {
                $user_data['password'] = bcrypt(trim($validated_pegawai['password']));
            }

            $pegawai->userAuth()->update($user_data);
        } else {
            $pegawai->userAuth()->delete();
        }

        unset($validated_pegawai['username'], $validated_pegawai['password']);

        // INI UNTUK MATA PELAJARAN (APABILA GURU)
        if ($validated_pegawai['posisi'] === 'Guru' && !empty($validated_pegawai['id_mata_pelajaran'])) {
            $new_mata_pelajaran = $validated_pegawai['id_mata_pelajaran'];
            $old_mata_pelajaran = $pegawai->guruMataPelajaran->pluck('id_mata_pelajaran')->toArray();

            $checked_mata_pelajaran = array_diff($new_mata_pelajaran, $old_mata_pelajaran);
            $unchecked_mata_pelajaran = array_diff($old_mata_pelajaran, $new_mata_pelajaran);

            foreach ($checked_mata_pelajaran as $_id_mata_pelajaran) {
                $pegawai->guruMataPelajaran()->create([
                    'id_pegawai' => $pegawai->id_pegawai,
                    'id_mata_pelajaran' => $_id_mata_pelajaran
                ]);
            }

            if (!empty($unchecked_mata_pelajaran)) {
                $pegawai->guruMataPelajaran()
                    ->whereIn('id_mata_pelajaran', $unchecked_mata_pelajaran)
                    ->delete();
            }

            unset($validated_pegawai['id_mata_pelajaran']);
        } else {
            $pegawai->guruMataPelajaran()->delete();
            $pegawai->kelas()->update(['id_pegawai' => null]);
        }

        $pegawai->update($validated_pegawai);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }
        
        User::where('id_pegawai', $pegawai->id_pegawai)->first()?->delete();
        
        if (!empty($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
