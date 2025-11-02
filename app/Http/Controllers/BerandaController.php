<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\MataPelajaran;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Pengumuman;

class BerandaController extends Controller
{
    public function getPegawaiDistributionData()
    {
        $pegawai = Pegawai::all();

        return [
            'staf_tata_usaha' => $pegawai->where('posisi', 'Staf Tata Usaha')->count(),
            'guru' => $pegawai->where('posisi', 'Guru')->count(),
            'pegawai_perpustakaan' => $pegawai->where('posisi', 'Pegawai Perpustakaan')->count(),
            'satuan_pengamanan' => $pegawai->where('posisi', 'Satuan Pengamanan')->count(),
            'pegawai_kebersihan' => $pegawai->where('posisi', 'Pegawai Kebersihan')->count()
        ];
    }

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
            'pengumuman' => $pengumuman,
            'pegawai_distribution_data' => $this->getPegawaiDistributionData()
        ]);
    }

    public function getPegawaiDistributionChartData()
    {
        return response()->json($this->getPegawaiDistributionData());
    }

    public function getPrestasiImprovementChartData()
    {
        $prestasi_improvement_raw_data = Prestasi::filter(request(['prestasi_improvement_tahun_filter']))->get();
        $prestasi_improvement_data = [];
        $total = 0;

        for ($i = 1; $i <= 12; $i++) {
            $amount_per_month = $prestasi_improvement_raw_data->firstWhere('month', $i);
            $current_month_amount = $amount_per_month ? $amount_per_month->amount : 0;
            $total += $current_month_amount;
            $prestasi_improvement_data[] = $total;
        }

        return response()->json($prestasi_improvement_data);
    }
}
