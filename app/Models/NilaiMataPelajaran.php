<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMataPelajaran extends Model
{
    protected $table = 'nilai_mata_pelajaran';

    public function semester() {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
