<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaEkstrakurikuler extends Model
{
    protected $table = 'peserta_ekstrakurikuler';

    public function nilaiEkstrakurikuler() {
        return $this->hasMany(NilaiEkstrakurikuler::class, 'id_nilai_ekstrakurikuler', 'id_nilai_ekstrakurikuler');
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function ekstrakurikuler() {
        return $this->belongsTo(Ekstrakurikuler::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
    }
}
