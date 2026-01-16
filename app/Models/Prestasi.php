<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

/**
 * @property int $id_siswa
 * @property Carbon $tanggal_peraihan
 * @property string|null $dokumentasi
 */

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $primaryKey = 'id_prestasi';

    protected $guarded = ['id_prestasi'];

    protected $casts = [
        // 'tanggal_peraihan' => 'datetime'
        'tanggal_peraihan' => 'datetime'
    ];

    public function getFormatedTanggalPeraihan()
    {
        $formated_tanggal_peraihan = $this->tanggal_peraihan->translatedFormat('d F Y');

        return $formated_tanggal_peraihan;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('tanggal_peraihan', $order_by_value);

        if (!empty($filters['nama_prestasi_filter'])) {
            $query->where('nama_prestasi', 'like', "%{$filters['nama_prestasi_filter']}%");
        }

        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            if (!empty($filters['peraih_filter'])) {
                $query->whereHas(
                    'siswa',
                    fn($query) =>
                    $query->where(
                        fn($query) =>
                        $query->where('nisn', 'like', '%' . $filters['peraih_filter'] . '%')
                            ->orWhere('nama_siswa', 'like', '%' . $filters['peraih_filter'] . '%')
                    )
                );
            }
        }

        // if (!empty($filters['penyelenggara_filter'])) {
        //     $query->where('penyelenggara', 'like', "%{$filters['penyelenggara_filter']}%");
        // }

        // if (!empty($filters['jenis_filter'])) {
        //     $query->where('jenis', $filters['jenis_filter']);
        // }

        // if (!empty($filters['peringkat_filter'])) {
        //     $query->where('peringkat', $filters['peringkat_filter']);
        // }

        // if (!empty($filters['peringkat_lainnya'])) {
        //     $query->where('peringkat', 'like', "%{$filters['peringkat_lainnya']}%");
        // }

        // if (!empty($filters['tingkat_filter'])) {
        //     $query->where('tingkat', $filters['tingkat_filter']);
        // }

        // if (!empty($filters['nama_wilayah_filter'])) {
        //     $query->where('nama_wilayah', 'like', "%{$filters['nama_wilayah_filter']}%");
        // }

        if (!empty($filters['tanggal_peraihan_filter'])) {
            $query->whereDate('tanggal_peraihan', $filters['tanggal_peraihan_filter']);
        }

        return $query;
    }

    public function scopePrestasiImprovementYear($query, $year)
    {
        $prestas_improvement_tahun_value = is_numeric($year ?? null)
            ? $year
            : date('Y');

        $query->whereYear('tanggal_peraihan', $prestas_improvement_tahun_value);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
