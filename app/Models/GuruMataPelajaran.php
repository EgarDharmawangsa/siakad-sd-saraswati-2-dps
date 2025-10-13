<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruMataPelajaran extends Model
{
    protected $table = 'guru_mata_pelajaran';

    protected $primaryKey = 'id_guru_mata_pelajaran';

    protected $guarded = ['id_guru_mata_pelajaran'];

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function mataPelajaran() {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }
}
