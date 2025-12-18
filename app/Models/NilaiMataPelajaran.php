<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMataPelajaran extends Model
{
    protected $table = 'nilai_mata_pelajaran';

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['kelas_filter'])) {
            $query->whereHas('pesertaEkstrakurikuler.siswa.kelas', fn($query) => $query->where('id_kelas', 'like', '%' . $filters['kelas_filter'] . '%'));
        }

        if (!empty($filters['siswa_filter'])) {
            $query->whereHas(
                'pesertaEkstrakurikuler.siswa',
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
                $query->where('id_mata_pelajaran', 'like', '%' . $filters['mata_pelajaran_filter'] . '%')
            );
        }

        if (!empty($filters['semester_filter'])) {
            $query->whereHas(
                'semester',
                fn($query) =>
                $query->where('id_semester', 'like', '%' . $filters['semester_filter'] . '%')
            );
        }

        // if (!empty($filters['nilai_filter'])) {
        //     $query->where('nilai', 'like', "%{$filters['nilai_filter']}%");
        // }

        if (!empty($filters['nilai_ub_filter'])) {
            $query->where('nilai_ub', 'like', "%{$filters['nilai_ub_filter']}%");
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
