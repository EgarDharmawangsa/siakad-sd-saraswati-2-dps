<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Ekstrakurikuler;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $view = 'pages.master.profile.pegawai.show';
            $user = Auth::user()->pegawai;
        } else if (Gate::allows('siswa')) {
            $view = 'pages.master.profile.siswa.show';
            $user = Auth::user()->siswa;
        }

        return view($view, [
            'judul' => 'Profil Saya',
            'user' => $user
        ]);
    }

    public function edit()
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $view = 'pages.master.profile.pegawai.edit';
            $user = Auth::user()->pegawai;
            $mata_pelajaran = MataPelajaran::latest()->get();
        } else if (Gate::allows('siswa')) {
            $view = 'pages.master.profile.siswa.edit';
            $user = Auth::user()->siswa;
            $kelas = Kelas::orderedNamaKelas()->get();
            $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        }

        return view($view, [
            'judul' => 'Profil Saya',
            'user' => $user,
            'mata_pelajaran' => $mata_pelajaran ?? null,
            'kelas' => $kelas ?? null,
            'ekstrakurikuler' => $ekstrakurikuler ?? null
        ]);
    }

    public function pegawaiUpdate(UpdatePegawaiRequest $pegawai_request)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $validated_pegawai = $pegawai_request->validated();
        $pegawai = Auth::user()->pegawai;

        if ($validated_pegawai['image_delete'] == 1) {
            if (!empty($pegawai->foto)) {
                Storage::delete($pegawai->foto);
            }
            $validated_pegawai['foto'] = null;
        } elseif ($pegawai_request->hasFile('foto')) {
            if (!empty($pegawai->foto)) {
                Storage::delete($pegawai->foto);
            }
            $validated_pegawai['foto'] = $pegawai_request->file('foto')->store('foto_pegawai');
        } else {
            $validated_pegawai['foto'] = $pegawai->foto;
        }

        unset($validated_pegawai['image_delete']);

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

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function siswaUpdate(UpdateSiswaRequest $siswa_request)
    {
        if (!Gate::allows('siswa')) {
            abort(404);
        }

        $validated_siswa = $siswa_request->validated();
        $siswa = Auth::user()->siswa;

        if ($validated_siswa['image_delete'] == 1) {
            if (!empty($siswa->foto)) {
                Storage::delete($siswa->foto);
            }
            $validated_siswa['foto'] = null;
        } elseif ($siswa_request->hasFile('foto')) {
            if (!empty($siswa->foto)) {
                Storage::delete($siswa->foto);
            }
            $validated_siswa['foto'] = $siswa_request->file('foto')->store('foto_siswa');
        } else {
            $validated_siswa['foto'] = $siswa->foto;
        }

        unset($validated_siswa['image_delete']);

        $user_data = [
            'username' => $validated_siswa['username']
        ];

        if (!empty(trim($validated_siswa['password']))) {
            $user_data['password'] = bcrypt(trim($validated_siswa['password']));
        }

        $siswa->userAuth()->update($user_data);

        unset($validated_siswa['username'], $validated_siswa['password'], $validated_siswa['konfirmasi_password']);

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

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
