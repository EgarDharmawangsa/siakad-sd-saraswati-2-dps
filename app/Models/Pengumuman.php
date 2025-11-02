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

    public function getStatus()
    {
        return $this->tanggal->lte(today()) ? 'Terbit' : 'Menunggu';
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_option_value = ['desc', 'asc'];
        $status_filter_option_value = ['terbit', 'menunggu'];

        $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_option_value) ? $filters['order_by'] : 'desc';
        $query->orderBy('tanggal', $order_by_value);

        if (!empty($filters['judul_filter'])) {
            $query->where('judul', 'like', "%{$filters['judul_filter']}%");
        }

        if (!empty($filters['tanggal_filter'])) {
            $query->whereDate('tanggal', $filters['tanggal_filter']);
        }

        if (!empty($filters['isi_filter'])) {
            $query->where('isi', 'like', "%{$filters['isi_filter']}%");
        }

        if (!empty($filters['status_filter'])) {
            $status_filter_value = in_array(strtolower($filters['status_filter']), $status_filter_option_value) ? $filters['status_filter'] : '';

            if ($status_filter_value === 'terbit') {
                $query->where('tanggal', '<=', today());
            } elseif ($status_filter_value === 'menunggu') {
                $query->where('tanggal', '>', today());
            }
        }

        return $query;
    }
}
