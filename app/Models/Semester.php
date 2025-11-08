<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property \Illuminate\Support\Carbon $tanggal_mulai
 * @property \Illuminate\Support\Carbon $tanggal_selesai
 */

class Semester extends Model
{
    protected $table = 'semester';

    protected $primaryKey = 'id_semester';

    protected $guarded = ['id_semester'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function getTahunAjaran(): string
    {
        $tahun_ajaran = $this->tanggal_mulai->format('Y') . '/' . $this->tanggal_selesai->format('Y');

        return $tahun_ajaran;
    }

    public function getFormatedTanggal(string $column)
    {
        $column_array = ['tanggal_mulai', 'tanggal_selesai'];

        if (!in_array($column, $column_array)) {
            return null;
        }

        $formated_tanggal = $this->{$column}->translatedFormat('d F Y');

        return $formated_tanggal;
    }

    public function getStatus(): string
    {
        if (now()->lt($this->tanggal_mulai)) {
            return 'Menunggu';
        } elseif (now()->between($this->tanggal_mulai, $this->tanggal_selesai)) {
            return 'Berjalan';
        } else {
            return 'Selesai';
        }
    }

    public static function getTanggalValidationErrors(string $mulai, string $selesai, ?int $ignore_id = null): array
    {
        $query = self::query()
            ->where('tanggal_mulai', '<=', $selesai)
            ->where('tanggal_selesai', '>=', $mulai);

        if ($ignore_id) {
            $query->where('id_semester', '!=', $ignore_id);
        }

        $overlaps = $query->get();
        $errors = [];

        if ($overlaps->isNotEmpty()) {
            $errors['tanggal_mulai'] = 'Rentang tanggal bertabrakan dengan semester lain.';
            $errors['tanggal_selesai'] = 'Rentang tanggal bertabrakan dengan semester lain.';
        }

        return $errors;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];
        $jenis_filter_array = ['ganjil', 'genap'];
        $status_filter_array = ['menunggu', 'berjalan', 'selesai'];

        $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('tanggal_mulai', $order_by_value);

        if (!empty($filters['jenis_filter'])) {
            $jenis_filter_value = in_array(strtolower($filters['jenis_filter']), $jenis_filter_array) ? $filters['jenis_filter'] : '';
            $query->where('jenis', 'like', "%{$jenis_filter_value}%");
        }

        if (!empty($filters['tahun_ajaran_filter'])) {
            $tahun_ajaran = trim($filters['tahun_ajaran_filter']);
            $tahun = explode('/', $tahun_ajaran);

            if (
                count($tahun) === 2 &&
                ctype_digit($tahun[0]) &&
                ctype_digit($tahun[1]) &&
                (int)$tahun[0] < (int)$tahun[1]
            ) {
                $tahun_mulai = (int)$tahun[0];
                $tahun_selesai = (int)$tahun[1];

                $query->whereYear('tanggal_mulai', $tahun_mulai)
                    ->whereYear('tanggal_selesai', $tahun_selesai);
            }
        }

        if (!empty($filters['tanggal_mulai_filter'])) {
            $query->whereDate('tanggal_mulai', $filters['tanggal_mulai_filter']);
        }

        if (!empty($filters['tanggal_selesai_filter'])) {
            $query->whereDate('tanggal_selesai', $filters['tanggal_selesai_filter']);
        }

        if (!empty($filters['status_filter'])) {
            $status_filter_value = in_array(strtolower($filters['status_filter']), $status_filter_array) ? $filters['status_filter'] : '';

            if ($status_filter_value === 'menunggu') {
                $query->where('tanggal_mulai', '>', now());
            } elseif ($status_filter_value === 'berjalan') {
                $query->where('tanggal_mulai', '<=', now())
                    ->where('tanggal_selesai', '>=', now());
            } elseif ($status_filter_value === 'selesai') {
                $query->where('tanggal_selesai', '<', now());
            }
        }

        return $query;
    }

    public function nilaiEkstrakurikuler()
    {
        return $this->hasMany(NilaiEkstrakurikuler::class, 'id_semester', 'id_semester');
    }

    public function nilaiMataPelajaran()
    {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_semester', 'id_semester');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_semester', 'id_semester');
    }
}
