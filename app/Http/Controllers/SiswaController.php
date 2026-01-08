<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Support\Facades\Gate;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $siswa = Siswa::with(['kelas', 'pesertaEkstrakurikuler'])
            ->filter($request->all())
            ->paginate(10)
            ->withQueryString();

        return view('pages.master.siswa.index', [
            'judul' => 'Siswa',
            'siswa' => $siswa
        ]);
    }

    public function create()
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();

        return view('pages.master.siswa.create', [
            'kelas' => $kelas,
            'ekstrakurikuler' => $ekstrakurikuler,
            'judul' => 'Siswa'
        ]);
    }

    public function store(StoreSiswaRequest $request)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_siswa = $request->validated();

        if ($request->hasFile('foto')) {
            $validated_siswa['foto'] = $request->file('foto')->store('foto_siswa', 'public');
        }

        $user_data = [
            'username' => $validated_siswa['username'],
            'password' => bcrypt(trim($validated_siswa['password'])),
            'role' => 'Siswa'
        ]; 

        unset($validated_siswa['username'], $validated_siswa['password']);

        if (!empty($validated_siswa['id_ekstrakurikuler'])) {
            $ekstrakurikuler_data = $validated_siswa['id_ekstrakurikuler'];
            unset($validated_siswa['id_ekstrakurikuler']);
        }

        $siswa = Siswa::create($validated_siswa);

        $siswa->userAuth()->create($user_data);

        if (!empty($ekstrakurikuler_data)) {
            foreach ($ekstrakurikuler_data as $_id_ekstrakurikuler) {
                $siswa->pesertaEkstrakurikuler()->create([
                    'id_ekstrakurikuler' => $_id_ekstrakurikuler,
                ]);
            }
        };

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        return view('pages.master.siswa.show', [
            'siswa' => $siswa,
            'judul' => 'Siswa'
        ]);
    }

    public function edit(Siswa $siswa)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $kelas = Kelas::orderedNamaKelas()->get();

        return view('pages.master.siswa.edit', [
            'siswa' => $siswa,
            'judul' => 'Siswa',
            'ekstrakurikuler' => $ekstrakurikuler,
            'kelas' => $kelas
        ]);
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_siswa = $request->validated();

        // INI UNTUK FOTO
        if ($validated_siswa['image_delete'] == 1) {
            if (!empty($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $validated_siswa['foto'] = null;
        } elseif ($request->hasFile('foto')) {
            if (!empty($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $validated_siswa['foto'] = $request->file('foto')->store('foto_siswa', 'public');
        } else {
            $validated_siswa['foto'] = $siswa->foto;
        }

        unset($validated_siswa['image_delete']);

        // INI UNTUK USER
        $user_data = [
            'username' => $validated_siswa['username']
        ];

        if (!empty(trim($validated_siswa['password']))) {
            $user_data['password'] = bcrypt(trim($validated_siswa['password']));
        }

        $siswa->userAuth()->update($user_data);

        unset($validated_siswa['username'], $validated_siswa['password'], $validated_siswa['konfirmasi_password']);

        // INI UNTUK NOMOR URUT
        if (empty($validated_siswa['id_kelas'])) {
            $validated_siswa['nomor_urut'] = null;
        }

        if (!empty($validated_siswa['id_ekstrakurikuler'])) {
            $new_ekstrakurikuler = $validated_siswa['id_ekstrakurikuler'];
            $old_ekstrakurikuler = $siswa->pesertaEkstrakurikuler()->pluck('id_ekstrakurikuler')->toArray();

            $checked_ekstrakurikuler = array_diff($new_ekstrakurikuler, $old_ekstrakurikuler);
            $unchecked_ekstrakurikuler = array_diff($old_ekstrakurikuler, $new_ekstrakurikuler);

            foreach ($checked_ekstrakurikuler as $_id_ekstrakurikuler) {
                $siswa->pesertaEkstrakurikuler()->create([
                    'id_ekstrakurikuler' => $_id_ekstrakurikuler,
                ]);
            }

            if (!empty($unchecked_ekstrakurikuler)) {
                $siswa->pesertaEkstrakurikuler()->whereIn('id_ekstrakurikuler', $unchecked_ekstrakurikuler)->delete();
            }

            unset($validated_siswa['id_ekstrakurikuler']);
        }

        $siswa->update($validated_siswa);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        if ($siswa->userAuth) {
            $siswa->userAuth()->delete();
        }

        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }
}
