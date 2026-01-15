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
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\Environment\Console;

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
        $user_data = [];
        $prestasi = Prestasi::latest()->get();

        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $user_data['counted_pegawai'] = Pegawai::get()->count();
            $user_data['counted_siswa'] = Siswa::get()->count();
            $user_data['counted_kelas'] = Kelas::get()->count();
            $user_data['counted_semester'] = Semester::get()->count();
            $user_data['counted_mata_pelajaran'] = MataPelajaran::get()->count();
            $user_data['counted_ekstrakurikuler'] = Ekstrakurikuler::get()->count();
            $user_data['counted_prestasi'] = $prestasi->count();
            $user_data['counted_pengumuman'] = Pengumuman::get()->count();
            $user_data['pegawai_distribution_data'] = $this->getPegawaiDistributionData();
        }

        $active_users = User::query()->whereIn('id_user', function ($query) {
            $query->select('user_id')
                ->from('sessions')
                ->whereNotNull('user_id');
        })->get()->groupBy('role');
        $pengumuman = Pengumuman::query()->orderBy('tanggal', 'desc')->paginate(20)->withQueryString();
        $user_data['judul'] = 'Beranda';
        $user_data['pengumuman'] = $pengumuman;
        $user_data['active_users'] = $active_users;
        $user_data['prestasi'] = $prestasi;

        return view('pages.beranda', $user_data);
    }

    public function getPegawaiDistributionChartData()
    {
        return response()->json($this->getPegawaiDistributionData());
    }

    public function getPrestasiImprovementChartData()
    {
        $prestasi_raw = Prestasi::prestasiImprovementYear(request('prestasi_improvement_tahun_filter'))->get();

        $prestasi_per_month = $prestasi_raw
            ->groupBy(fn($item) => (int) $item->tanggal->month)
            ->map(fn($items) => $items->count());

        $prestasi_improvement_data = [];

        for ($i = 1; $i <= 12; $i++) {
            $prestasi_improvement_data[] = $prestasi_per_month->get($i, 0);
        }

        return response()->json($prestasi_improvement_data);
    }

    public function getSemesterCalendarData()
    {
        $semester = Semester::all();
        $semester_array = [];
        $color_event_array = [
            '#C0392B',
            '#E67E22',
            '#27AE60',
            '#2980B9',
            '#2E86C1',
            '#8E44AD'
        ];
        $index_loop = 0;

        foreach ($semester as $_semester) {
            $semester_array[] = [
                'title' => "{$_semester->jenis} {$_semester->getTahunAjaran()} ({$_semester->getStatus()})",
                'start' => $_semester->tanggal_mulai,
                'end' => $_semester->tanggal_selesai,
                'color' => $color_event_array[$index_loop]
            ];

            if ($index_loop === 6) {
                $index_loop = 0;
            }

            $index_loop++;
        }

        return response()->json($semester_array);
    }
}
