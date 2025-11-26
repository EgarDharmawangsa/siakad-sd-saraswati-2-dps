<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

/**
 * @property Carbon $jam_mulai
 * @property Carbon $jam_selesai
 */

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';

    protected $primaryKey = 'id_jadwal_pelajaran';

    protected $guarded = ['id_jadwal_pelajaran'];

    protected $casts = [
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime'
    ];

    public static function getJamValidationErrors(int $id_kelas, string $hari, string $mulai, string $selesai, ?int $ignore_id = null): array
    {
        $query = self::query()
            ->where('id_kelas', $id_kelas)
            ->where('hari', $hari)
            ->where('jam_mulai', '<', $selesai)
            ->where('jam_selesai', '>', $mulai);

        if ($ignore_id) {
            $query->where('id_jadwal_pelajaran', '!=', $ignore_id);
        }

        $overlaps = $query->get();
        $errors = [];

        if ($overlaps->isNotEmpty()) {
            $errors['jam_mulai'] = 'Rentang jam bertabrakan dengan jadwal lain di hari dan kelas yang sama.';
            $errors['jam_selesai'] = 'Rentang jam bertabrakan dengan jadwal lain di hari dan kelas yang sama.';
        }

        return $errors;
    }

    public function getFormatedJam(string $column)
    {
        $column_array = ['jam_mulai', 'jam_selesai'];

        if (!\in_array($column, $column_array)) {
            return null;
        }

        $formated_jam = $this->{$column}?->format('H:i');

        if (!empty($formated_jam)) {
            return $formated_jam;
        } else {
            return '-';
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $kegiatan_array = ['belajar', 'istirahat'];
        $hari_array = [
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
            'minggu'
        ];

        if (!empty($filters['kelas_filter'])) {
            $query->whereHas('kelas', fn($query) => $query->where('nama_kelas', 'like', '%' . $filters['kelas_filter'] . '%'));
        }

        if (!empty($filters['kegiatan_filter'])) {
            $kegiatan_filter_value = \in_array(strtolower($filters['kegiatan_filter']), $kegiatan_array) ? $filters['kegiatan_filter'] : '';
            $query->where('kegiatan', 'like', "%{$kegiatan_filter_value}%");
        }

        if (!empty($filters['mata_pelajaran_filter'])) {
            $query->whereHas('guruMataPelajaran.mataPelajaran', fn($query) => $query->where('nama_mata_pelajaran', 'like', '%' . $filters['mata_pelajaran_filter'] . '%'));
        }

        if (!empty($filters['guru_filter'])) {
            $query->whereHas('guruMataPelajaran.pegawai', fn($query) => $query->where('nama_pegawai', 'like', '%' . $filters['guru_filter'] . '%'));
        }

        if (!empty($filters['hari_filter'])) {
            $hari_filter_value = \in_array(strtolower($filters['hari_filter']), $hari_array) ? $filters['hari_filter'] : '';
            $query->where('hari', 'like', "%{$hari_filter_value}%");
        }

        if (!empty($filters['jam_mulai_filter'])) {
            $query->whereTime('jam_mulai', '=', $filters['jam_mulai_filter']);
        }

        if (!empty($filters['jam_selesai_filter'])) {
            $query->whereTime('jam_selesai', '=', $filters['jam_selesai_filter']);
        }

        return $query;
    }

    public function guruMataPelajaran()
    {
        return $this->belongsTo(GuruMataPelajaran::class, 'id_guru_mata_pelajaran', 'id_guru_mata_pelajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
