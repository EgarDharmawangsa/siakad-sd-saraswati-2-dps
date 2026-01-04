<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Siswa::with('kelas:id_kelas,nama_kelas')
            ->filter($request->all())
            ->paginate(10)
            ->withQueryString();

        return view('pages.master.siswa.index', [
            'judul' => 'Data Siswa',
            'siswa' => $siswa
        ]);
    }

    public function create()
    {
        $kelas = Kelas::select('id_kelas', 'nama_kelas')->get();

        return view('pages.master.siswa.create', [
            'kelas' => $kelas,
            'judul' => 'Tambah Siswa'
        ]);
    }

    public function store(StoreSiswaRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();

            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('foto-siswa');
            }

            $userData = [
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role'     => 'siswa'
            ];

            unset($data['username'], $data['password'], $data['konfirmasi_password']);

            if (isset($data['kelas_id'])) {
                $data['id_kelas'] = $data['kelas_id'];
                unset($data['kelas_id']);
            }

            $siswa = Siswa::create($data);

            $siswa->userAuth()->create($userData);
        });

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('kelas', 'userAuth');

        return view('pages.master.siswa.show', [
            'siswa' => $siswa,
            'judul' => 'Detail Siswa'
        ]);
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::select('id_kelas', 'nama_kelas')->get();

        return view('pages.master.siswa.edit', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'judul' => 'Edit Siswa'
        ]);
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        return DB::transaction(function () use ($request, $siswa) {
            $data = $request->validated();

            if ($siswa->userAuth) {
                $dataUser = [
                    'username' => $data['username'],
                ];

                if (!empty($data['password'])) {
                    $dataUser['password'] = Hash::make($data['password']);
                }

                $siswa->userAuth->update($dataUser);
            }

            unset($data['username']);
            unset($data['password']);
            unset($data['konfirmasi_password']);

            if (isset($data['kelas_id'])) {
                $data['id_kelas'] = $data['kelas_id'];
                unset($data['kelas_id']);
            }

            if ($request->input('image_delete') == '1') {
                if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                    Storage::disk('public')->delete($siswa->foto);
                }
                $data['foto'] = null; 
            }

            if ($request->hasFile('foto')) {
                if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                    Storage::disk('public')->delete($siswa->foto);
                }
                $data['foto'] = $request->file('foto')->store('foto-siswa', 'public');
            }

            $siswa->update($data);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
        });
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        if ($siswa->userAuth) {
            $siswa->userAuth()->delete();
        }

        $nama = $siswa->nama_siswa;
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', "Data siswa $nama berhasil dihapus!");
    }
}
