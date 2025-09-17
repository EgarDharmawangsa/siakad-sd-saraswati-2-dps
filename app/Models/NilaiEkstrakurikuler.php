<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiEkstrakurikuler extends Model
{
    protected $table = 'nilai_ekstrakurikuler';

    public function semester() {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function pesertaEkstrakurikuler() {
        return $this->belongsTo(PesertaEkstrakurikuler::class, 'id_peserta_ekstrakurikuler', 'id_peserta_ekstrakurikuler');
    }
}
