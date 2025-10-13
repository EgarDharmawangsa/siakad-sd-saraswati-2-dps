<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $primaryKey = 'id_pengumuman';

    protected $guarded = ['id_pengumuman'];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    public function getStatus() {
        return $this->tanggal->lte(today()) ? 'Terbit' : 'Menunggu';
    }
}