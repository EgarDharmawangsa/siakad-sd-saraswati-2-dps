<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';

    public function nilaiEkstrakurikuler() {
        return $this->hasMany(NilaiEkstrakurikuler::class, 'id_semester', 'id_semester');
    }

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_semester', 'id_semester');
    }

    public function kehadiran() {
        return $this->hasMany(Kehadiran::class, 'id_semester', 'id_semester');
    }
    
}
