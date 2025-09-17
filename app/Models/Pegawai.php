<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    public function kelas() {
        return $this->hasOne(Kelas::class, 'id_pegawai', 'id_pegawai');
    }

    public function guruMataPelajaran() {
        return $this->hasMany(GuruMataPelajaran::class, 'id_pegawai', 'id_pegawai');
    }

    public function userAuth() {
        return $this->hasOne(User::class, 'id_pegawai', 'id_pegawai');
    }
}
