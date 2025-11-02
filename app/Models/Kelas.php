<?php

namespace App\Models;

use App\Models\Siswa;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $guarded = ['id_kelas'];

    public function getSiswaInKelas()
    {
        $siswa_in_kelas = Siswa::with('kelas')->where('id_kelas', $this->id_kelas);

        return $siswa_in_kelas;
    }

    public function scopeOrderedNamaKelas($query)
    {
        $query->orderByRaw('CAST(nama_kelas AS UNSIGNED)')
            ->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")');

        return $query;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_option_value = ['desc', 'asc'];

        $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_option_value) ? $filters['order_by'] : 'nama_kelas';
        if ($order_by_value === 'nama_kelas') {
            $query->orderedNamaKelas();
        } else {
            $query->orderBy('create_at', $order_by_value);
        }

        if (!empty($filters['nama_kelas_filter'])) {
            $query->where('nama_kelas', 'like', "%{$filters['nama_kelas_filter']}%");
        }

        if (!empty($filters['nama_wali'])) {
            $query->whereHas('pegawai', fn($q) => $q->where('posisi', 'Guru')->where('nama_pegawai', 'like', '%' . $filters['nama_wali'] . '%'));
        }

        return $query;
    }

    public function jadwalPelajaran()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id_kelas', 'id_kelas');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }
}
