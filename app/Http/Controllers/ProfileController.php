<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function index()
    {
        $judul = 'Profil';
        
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $pegawai = Pegawai::where('id_pegawai', Auth::user()->pegawai->id_pegawai)->first();
            $view = view('pages.master.pegawai.show', [
                'judul' => $judul,
                'pegawai' => $pegawai
            ]);
        } else if (Gate::allows('siswa')) {
            $siswa = Siswa::where('id_siswa', Auth::user()->siswa->id_siswa)->first();
            $view = view('pages.master.siswa.show', [
                'judul' => $judul,
                'siswa' => $siswa
            ]);
        } else {
            abort(404);
        }

        return $view;
    }

    public function edit()
    {
        $judul = 'Profil';

        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $pegawai = Pegawai::where('id_pegawai', Auth::user()->pegawai->id_pegawai)->first();
            $mata_pelajaran = MataPelajaran::latest()->get();
            $view = view('pages.master.pegawai.edit', [
                'judul' => $judul,
                'pegawai' => $pegawai,
                'mata_pelajaran' => $mata_pelajaran
            ]);
        } else if (Gate::allows('siswa')) {
            $siswa = Siswa::where('id_siswa', Auth::user()->siswa->id_siswa)->first();
            $view = view('pages.master.siswa.edit', [
                'judul' => $judul,
                'siswa' => $siswa
            ]);
        } else {
            abort(404);
        }

        return $view;
    }
}
