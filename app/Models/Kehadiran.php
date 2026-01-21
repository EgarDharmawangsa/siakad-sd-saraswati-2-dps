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

    protected $primaryKey = 'id_kehadiran';

    protected $guarded = [
        'id_kehadiran'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function scopeSiswaRecap($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->join('semester', 'semester.id_semester', '=', 'kehadiran.id_semester')->orderBy('semester.tanggal_mulai', $order_by_value);

        if (!empty($filters['kelas_filter'])) {
            $query->whereHas('siswa', function ($query) use ($filters) {
                $query->where('id_kelas', $filters['kelas_filter']);
            });
        }

        if (!empty($filters['id_siswa_filter'])) {
            $query->where('kehadiran.id_siswa', $filters['id_siswa_filter']);
        }

        if (!empty($filters['siswa_filter'])) {
            $query->whereHas('siswa', function ($query) use ($filters) {
                $query->where('nisn', 'like', "%{$filters['siswa_filter']}%")
                    ->orWhere('nama_siswa', 'like', "%{$filters['siswa_filter']}%");
            });
        }

        if (!empty($filters['semester_filter'])) {
            $query->where('kehadiran.id_semester', $filters['semester_filter']);
        }

        return $query
            ->select(
                'kehadiran.id_siswa',
                'kehadiran.id_semester'
            )
            ->selectRaw("SUM(status = 'Hadir') as hadir")
            ->selectRaw("SUM(status = 'Izin') as izin")
            ->selectRaw("SUM(status = 'Sakit') as sakit")
            ->selectRaw("SUM(status = 'Alfa') as alfa")
            ->groupBy(
                'kehadiran.id_siswa',
                'kehadiran.id_semester'
            );
    }

    public function getFormatedTanggal()
    {
        $formated_tanggal = $this->tanggal->translatedFormat('d F Y');

        return $formated_tanggal;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        // $query->join('semester', 'semester.id_semester', '=', 'kehadiran.id_semester')->orderBy('semester.tanggal_mulai', $order_by_value);
        $query->orderBy('tanggal', $order_by_value);

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

        if (!empty($filters['keterangan_filter'])) {
            $query->where('keterangan', 'like', "%{$filters['keterangan_filter']}%");
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
