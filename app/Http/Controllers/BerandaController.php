<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\MataPelajaran;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Pengumuman;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $counted_pegawai = Pegawai::get()->count();
        $counted_siswa = Siswa::get()->count();
        $counted_kelas = Kelas::get()->count();
        $counted_semester = Semester::get()->count();
        $counted_mata_pelajaran = MataPelajaran::get()->count();
        $counted_ekstrakurikuler = Ekstrakurikuler::get()->count();
        $counted_prestasi = Prestasi::get()->count();
        $counted_pengumuman = Pengumuman::get()->count();
        $pengumuman = Pengumuman::query()->orderBy('tanggal', 'desc')->paginate(20)->withQueryString();
        $pengguna_aktif = User::query()->whereIn('id_user', function ($query) {
            $query->select('user_id')
                ->from('sessions')
                ->whereNotNull('user_id');
        })->get();

        return view('pages.beranda', [
            'judul' => 'Beranda',
            'counted_pegawai' => $counted_pegawai,
            'counted_siswa' => $counted_siswa,
            'counted_kelas' => $counted_kelas,
            'counted_semester' => $counted_semester,
            'counted_mata_pelajaran' => $counted_mata_pelajaran,
            'counted_ekstrakurikuler' => $counted_ekstrakurikuler,
            'counted_prestasi' => $counted_prestasi,
            'counted_pengumuman' => $counted_pengumuman,
            'pengguna_aktif' => $pengguna_aktif,
            'pengumuman' => $pengumuman
        ]);
    }
}
