<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class NilaiEkstrakurikuler extends Model
{
    protected $table = 'nilai_ekstrakurikuler';

    protected $primaryKey = 'id_nilai_ekstrakurikuler';

    protected $guarded = [
        'id_nilai_ekstrakurikuler'
    ];

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('created_at', $order_by_value);

        if (Gate::any(['staf-tata-usaha', 'guru'])) {
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
        }

        if (!empty($filters['ekstrakurikuler_filter'])) {
            $query->whereHas(
                'pesertaEkstrakurikuler.ekstrakurikuler',
                fn($query) =>
                $query->where('id_ekstrakurikuler', $filters['ekstrakurikuler_filter'])
            );
        }

        if (!empty($filters['semester_filter'])) {
            $query->whereHas(
                'semester',
                fn($query) =>
                $query->where('id_semester', $filters['semester_filter'])
            );
        }

        if (!empty($filters['nilai_filter'])) {
            $query->where('nilai', 'like', "%{$filters['nilai_filter']}%");
        }
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function pesertaEkstrakurikuler()
    {
        return $this->belongsTo(PesertaEkstrakurikuler::class, 'id_peserta_ekstrakurikuler', 'id_peserta_ekstrakurikuler');
    }
}
