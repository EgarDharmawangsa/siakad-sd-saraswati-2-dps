<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $guarded = ['id_pegawai'];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'permulaan_kerja' => 'date',
        'permulaan_kerja_sds2' => 'date',
        'tanggal_sk_terakhir' => 'date'
    ];

    public function getFormatedNamaPegawai()
    {
        $nip = $this->nip ?? $this->nipppk ?? '-';
        return "{$nip} | {$this->nama_pegawai}";
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_pegawai', 'id_pegawai');
    }

    public function guruMataPelajaran()
    {
        return $this->hasMany(GuruMataPelajaran::class, 'id_pegawai', 'id_pegawai');
    }

    public function userAuth()
    {
        return $this->hasOne(User::class, 'id_pegawai', 'id_pegawai');
    }
}
