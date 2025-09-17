<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $primaryKey = 'id_prestasi';

    protected $guarded = ['id_prestasi'];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
