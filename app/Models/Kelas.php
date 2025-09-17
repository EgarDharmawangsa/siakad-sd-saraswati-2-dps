<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    public function jadwalPelajaran() {
        return $this->hasMany(JadwalPelajaran::class, 'id_kelas', 'id_kelas');
    }

    // public function pegawai() {
    //     return $this->hasMany(Pegawai::class, 'id_kelas', 'id_kelas');
    // }

    public function siswa() {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }
}
