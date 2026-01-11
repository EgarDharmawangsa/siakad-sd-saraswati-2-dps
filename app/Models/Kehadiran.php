<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

/**
 * @property string $status
 * @property string|null $keterangan
 * @property Carbon $tanggal
 */

class Kehadiran extends Model
{
    protected $table = 'kehadiran';

    protected $guarded = [
        'id_kehadiran'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getFormatedTanggal()
    {
        $formated_tanggal = $this->tanggal->translatedFormat('d F Y');

        return $formated_tanggal;
    }

    public function scopeFilter($query, array $filters)
    {
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

        if (!empty($filters['semester_filter'])) {
            $query->whereHas(
                'semester',
                fn($query) =>
                $query->where('id_semester', $filters['semester_filter'])
            );
        }

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
