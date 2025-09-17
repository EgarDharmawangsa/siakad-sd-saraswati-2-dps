<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    public function nilaiMataPelajaran() {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function guruMataPelajaran() {
        return $this->hasMany(GuruMataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }
}
