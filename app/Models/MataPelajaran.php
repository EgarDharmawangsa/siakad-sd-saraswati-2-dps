<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $primaryKey = 'id_mata_pelajaran';

    protected $guarded = ['id_mata_pelajaran'];

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('created_at', $order_by_value);

        if (!empty($filters['nama_mata_pelajaran_filter'])) {
            $query->where('nama_mata_pelajaran', 'like', "%{$filters['nama_mata_pelajaran_filter']}%");
        }

        return $query;
    }

    public function nilaiMataPelajaran()
    {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function guruMataPelajaran()
    {
        return $this->hasMany(GuruMataPelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }
}
