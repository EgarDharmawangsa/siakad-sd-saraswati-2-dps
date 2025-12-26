<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

/**
 * @property Carbon $tanggal
 */

class Kehadiran extends Model
{
    protected $table = 'kehadiran';

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getFormatedTanggal()
    {
        $formated_tanggal = $this->tanggal?->translatedFormat('d F Y');

        return $formated_tanggal;
    }

    public function scopeFilter($query, array $filters)
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $query->whereHas('siswa.kelas', fn($query) => $query->where('id_kelas', 'like', '%' . ($filters['kelas_filter'] ?? Kelas::orderedNamaKelas()->value('nama_kelas')) . '%'));

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
        }

        $query->whereHas(
            'semester',
            fn($query) =>
            $query->where('id_semester', 'like', '%' . ($filters['semester_filter'] ?? Semester::activeSemester()->value('id_semester')) . '%')
        );

        if (!empty($filters['status_filter'])) {
            $query->where('status', 'like', "%{$filters['status_filter']}%");
        }

        if (!empty($filters['tanggal_filter'])) {
            $query->whereDate('tanggal', $filters['tanggal_filter']);
        }
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
