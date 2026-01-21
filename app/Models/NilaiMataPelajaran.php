<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

/**
 * @property int $id_siswa
 * @property int $id_semester
 * @property int $id_mata_pelajaran
 * @property int $jumlah_portofolio
 * @property array $nilai_portofolio
 * @property int $nilai_ub_1
 * @property int $nilai_ub_2
 * @property int $nilai_uts
 * @property int $nilai_uas
 */

class NilaiMataPelajaran extends Model
{
    protected $table = 'nilai_mata_pelajaran';

    protected $primaryKey = 'id_nilai_mata_pelajaran';

    protected $guarded = [
        'id_nilai_mata_pelajaran',
    ];

    protected $casts = [
        'nilai_portofolio' => 'array'
    ];

    public function getNilaiPortofolioAverage()
    {
        if ($this->jumlah_portofolio === 0 || empty($this->nilai_portofolio)) {
            return 0;
        }

        $nilai_portofolio_total = 0;

        foreach ($this->nilai_portofolio as $_nilai_portofolio) {
            $nilai_portofolio_total += $_nilai_portofolio['nilai'];
        }

        $nilai_portofolio_average = $nilai_portofolio_total / $this->jumlah_portofolio;

        return $nilai_portofolio_average;
    }

    public function getNilaiAkhir() {
        $nilai_akhir = ($this->getNilaiPortofolioAverage() + $this->nilai_ub_1 + $this->nilai_ub_2 + $this->nilai_uts + $this->nilai_uas) / 5;

        return $nilai_akhir;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('created_at', $order_by_value);

        if (!empty($filters['kelas_filter'])) {
            $query->whereHas('siswa.kelas', fn($query) => $query->where('id_kelas', $filters['kelas_filter']));
        }

        if (!empty($filters['siswa_filter'])) {
            $query->whereHas(
                'siswa',
                fn($query) =>
                $query->where(
                    fn($query) =>
                    $query->where('nisn', 'like', '%' . $filters['siswa_filter'] . '%')
                        ->orWhere('nama_siswa', 'like', '%' . $filters['siswa_filter'] . '%')
                )
            );
        }

        if (!empty($filters['mata_pelajaran_filter'])) {
            $query->whereHas(
                'mataPelajaran',
                fn($query) =>
                $query->where('id_mata_pelajaran', $filters['mata_pelajaran_filter'])
            );
        }

        if (!empty($filters['semester_filter'])) {
            $query->whereHas(
                'semester',
                fn($query) =>
                $query->where('id_semester', $filters['semester_filter'])
            );
        }

        if (!empty($filters['jumlah_portofolio_filter'])) {
            $query->where('jumlah_portofolio', 'like', "%{$filters['jumlah_portofolio_filter']}%");
        }

        if (!empty($filters['nilai_ub_1_filter'])) {
            $query->where('nilai_ub_1', 'like', "%{$filters['nilai_ub_1_filter']}%");
        }

        if (!empty($filters['nilai_ub_2_filter'])) {
            $query->where('nilai_ub_2', 'like', "%{$filters['nilai_ub_2_filter']}%");
        }

        if (!empty($filters['nilai_uts_filter'])) {
            $query->where('nilai_uts', 'like', "%{$filters['nilai_uts_filter']}%");
        }

        if (!empty($filters['nilai_uas_filter'])) {
            $query->where('nilai_uas', 'like', "%{$filters['nilai_uas_filter']}%");
        }
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
