<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_peserta_ekstrakurikuler
 * @property int $id_siswa
 */

class PesertaEkstrakurikuler extends Model
{
    protected $table = 'peserta_ekstrakurikuler';

    protected $primaryKey = 'id_peserta_ekstrakurikuler';

    protected $guarded = ['id_peserta_ekstrakurikuler'];

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
