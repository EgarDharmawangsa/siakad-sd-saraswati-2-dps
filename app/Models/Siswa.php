<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    public function prestasi() {
        return $this->hasMany(Prestasi::class, 'id_siswa', 'id_siswa');
    }

    public function kehadiran() {
        return $this->hasMany(Kehadiran::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_siswa', 'id_siswa');
    }

    public function userAuth() {
        return $this->hasOne(User::class, 'id_siswa', 'id_siswa');
    }

    public function pesertaEkstrakurikuler() {
        return $this->hasMany(PesertaEkstrakurikuler::class, 'id_siswa', 'id_siswa');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }


}
