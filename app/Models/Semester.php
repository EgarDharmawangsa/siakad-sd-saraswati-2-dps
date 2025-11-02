<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Semester extends Model
{
    protected $table = 'semester';

    protected $primaryKey = 'id_semester';

    protected $guarded = ['id_semester'];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    public function getTahunAjaran(): string
    {
        return $this->tanggal_mulai->format('Y') . '/' . $this->tanggal_selesai->format('Y');
    }

    public function getStatus(): string
    {
        $now = now();

        if ($now->between($this->tanggal_mulai, $this->tanggal_selesai)) {
            return 'Berjalan';
        } elseif ($now->lt($this->tanggal_mulai)) {
            return 'Menunggu';
        }
        return 'Selesai';
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
        $order_by = in_array(strtolower($filters['order_by'] ?? ''), ['asc', 'desc']) ? strtolower($filters['order_by']) : 'desc';
        $query->orderBy('tanggal_mulai', $order_by);

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
