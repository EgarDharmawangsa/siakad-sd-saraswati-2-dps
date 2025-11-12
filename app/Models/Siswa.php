<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string|null $foto
 */

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $guarded = ['id_siswa'];

    public function getFormatedNamaSiswa()
    {
        return "{$this->nisn} | {$this->nama_siswa}";
    }

    public function scopeFilter($query, array $filters)
    {
        $sort_by = in_array(strtolower($filters['sort_by'] ?? ''), ['asc', 'desc']) ? strtolower($filters['sort_by']) : 'desc';
        $query->orderBy('created_at', $sort_by);

        return $query;
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_siswa', 'id_siswa');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiMataPelajaran()
    {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_siswa', 'id_siswa');
    }

    public function userAuth()
    {
        return $this->hasOne(User::class, 'id_siswa', 'id_siswa');
    }

    public function pesertaEkstrakurikuler()
    {
        return $this->hasMany(PesertaEkstrakurikuler::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
