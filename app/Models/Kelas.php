<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $guarded = ['id_kelas'];

    public function jadwalPelajaran() {
        return $this->hasMany(JadwalPelajaran::class, 'id_kelas', 'id_kelas');
    }

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function siswa() {
        return $this->hasOne(Siswa::class, 'id_kelas', 'id_kelas');
    }
}
