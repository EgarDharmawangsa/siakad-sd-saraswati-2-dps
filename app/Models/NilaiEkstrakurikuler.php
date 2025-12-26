<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiEkstrakurikuler extends Model
{
    protected $table = 'nilai_ekstrakurikuler';

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('tanggal', $order_by_value);

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

        $query->whereHas(
            'pesertaEkstrakurikuler.ekstrakurikuler',
            fn($query) =>
            $query->where('id_ekstrakurikuler', 'like', '%' . ($filters['ekstrakurikuler_filter'] ?? Ekstrakurikuler::value('nama_ekstrakurikuler') . '%')
        ));

        $query->whereHas(
            'semester',
            fn($query) =>
            $query->where('id_semester', 'like', '%' . ($filters['semester_filter'] ?? Semester::activeSemester()->value('id_semester')) . '%')
        );

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
