<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';

    public function guruMataPelajaran() {
        return $this->belongsTo(GuruMataPelajaran::class, 'id_guru_mata_pelajaran', 'id_guru_mata_pelajaran');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
