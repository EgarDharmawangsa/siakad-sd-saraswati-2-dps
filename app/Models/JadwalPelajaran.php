<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';

    protected $primaryKey = 'id_jadwal_pelajaran';

    protected $guarded = ['id_jadwal_pelajaran'];

    public static function getJamValidationErrors(int $id_kelas ,string $hari ,string $mulai, string $selesai, ?int $ignore_id = null): array
    {
        $query = self::query()
            ->where('id_kelas', $id_kelas)
            ->where('hari', $hari)
            ->where('jam_mulai', '<=', $selesai)
            ->where('jam_selesai', '>=', $mulai);

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

    protected function jamMulai(): Attribute {
        return Attribute::make(get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),);
    }

    protected function jamSelesai(): Attribute {
        return Attribute::make(get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),);
    }

    public function guruMataPelajaran() {
        return $this->belongsTo(GuruMataPelajaran::class, 'id_guru_mata_pelajaran', 'id_guru_mata_pelajaran');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
