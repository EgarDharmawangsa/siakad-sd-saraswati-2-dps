<?php

namespace App\Models;

use App\Models\Siswa;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_kelas
 */

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $guarded = ['id_kelas'];

    public function getSiswaInKelas()
    {
        $siswa_in_kelas = Siswa::with('kelas')->where('id_kelas', $this->id_kelas)->get();

        return $siswa_in_kelas;
    }

    public function scopeOrderedNamaKelas($query)
    {
        $query->orderByRaw('CAST(nama_kelas AS UNSIGNED)')
            ->orderByRaw('REGEXP_REPLACE(nama_kelas, "^[0-9]+", "")');

        return $query;
    }

    public function scopeWithJadwalPelajaran($query, $filters)
    {
        $query->with([
            'pegawai',
            'jadwalPelajaran' => function ($query) use ($filters) {
                $query->filter($filters)
                    ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
                    ->orderBy('jam_mulai')
                    ->with(['guruMataPelajaran.mataPelajaran', 'guruMataPelajaran.pegawai']);
            }
        ])->whereHas('jadwalPelajaran', function ($query) use ($filters) {
            $query->where('hari', 'like', "%{$filters['hari_filter']}%");
        });

        return $query;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'nama_kelas';

        if ($order_by_value === 'nama_kelas') {
            $query->orderedNamaKelas();
        } else {
            $query->orderBy('created_at', $order_by_value);
        }

        if (!empty($filters['nama_kelas_filter']) || !empty($filters['kelas_filter'])) {
            $nama_kelas_filter_value = $filters['nama_kelas_filter'] ?? $filters['kelas_filter'];
            $query->where('nama_kelas', 'like', "%{$nama_kelas_filter_value}%");
        }

        if (!empty($filters['nama_wali'])) {
            $query->whereHas('pegawai', fn($query) => $query->where('posisi', 'Guru')->where('nama_pegawai', 'like', '%' . $filters['nama_wali'] . '%'));
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
