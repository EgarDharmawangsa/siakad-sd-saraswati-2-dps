<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property Carbon $tanggal
 * @property string|null $dokumentasi
 */

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $primaryKey = 'id_prestasi';

    protected $guarded = ['id_prestasi'];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    public function getFormatedTanggal()
    {
        $formated_tanggal = $this->tanggal->translatedFormat('d F Y');

        return $formated_tanggal;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];
        $jenis_array = ['akademik', 'non-akademik'];
        $peringkat_array = [
            '1 (pertama)',
            '2 (kedua)',
            '3 (ketiga)',
            'harapan 1',
            'harapan 2',
            'harapan 3',
            'lainnya'
        ];
        $tingkat_array = [
            'desa',
            'kecamatan',
            'kabupaten/kota',
            'provinsi',
            'nasional',
            'internasional'
        ];

        if (request()->routeIs('beranda')) {
            $prestasi_improvement_tahun_value = !empty($filters['prestasi_improvement_tahun_filter']) ? $filters['prestasi_improvement_tahun_filter'] : date('Y');

            if (!is_numeric($prestasi_improvement_tahun_value)) {
                $prestasi_improvement_tahun_value = date('Y');
            }

            $query->whereYear('tanggal', $prestasi_improvement_tahun_value)
                ->selectRaw('MONTH(tanggal) as month, COUNT(*) as amount')
                ->groupBy('month')
                ->orderBy('month');
        } else {
            $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
            $query->orderBy('tanggal', $order_by_value);

            if (!empty($filters['nama_prestasi_filter'])) {
                $query->where('nama_prestasi', 'like', "%{$filters['nama_prestasi_filter']}%");
            }

            if (!empty($filters['peraih_filter'])) {
                $query->whereHas('siswa', fn($query) => 
                    $query->where(fn($query) => 
                        $query->where('nisn', 'like', '%' . $filters['peraih_filter'] . '%')
                            ->orWhere('nama_siswa', 'like', '%' . $filters['peraih_filter'] . '%')
                    )
                );
            }

            if (!empty($filters['penyelenggara_filter'])) {
                $query->where('penyelenggara', 'like', "%{$filters['penyelenggara_filter']}%");
            }

            if (!empty($filters['jenis_filter'])) {
                $jenis_filter_value = \in_array(strtolower($filters['jenis_filter']), $jenis_array) ? $filters['jenis_filter'] : '';
                $query->where('jenis', 'like', "%{$jenis_filter_value}%");
            }

            if (!empty($filters['peringkat_filter'])) {
                $peringkat_filter_value = \in_array(strtolower($filters['peringkat_filter']), $peringkat_array) ? $filters['peringkat_filter'] : '';
                $query->where('peringkat', 'like', "%{$peringkat_filter_value}%");
            }

            if (!empty($filters['peringkat_lainnya'])) {
                $query->where('peringkat', 'like', "%{$filters['peringkat_lainnya']}%");
            }

            if (!empty($filters['tingkat_filter'])) {
                $tingkat_filter_value = \in_array(strtolower($filters['tingkat_filter']), $tingkat_array) ? $filters['tingkat_filter'] : '';
                $query->where('tingkat', 'like', "%{$tingkat_filter_value}%");
            }

            if (!empty($filters['nama_wilayah_filter'])) {
                $query->where('nama_wilayah', 'like', "%{$filters['nama_wilayah_filter']}%");
            }

            if (!empty($filters['tanggal_filter'])) {
                $query->whereDate('tanggal', $filters['tanggal_filter']);
            }
        }

        return $query;
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
