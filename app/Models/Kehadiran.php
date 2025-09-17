<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';

    public function semester() {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
