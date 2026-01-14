<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * @property Carbon $tanggal
 * @property string|null $gambar
 */

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $primaryKey = 'id_pengumuman';

    protected $guarded = ['id_pengumuman'];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function getFormatedTanggal(bool $day_format = false)
    {
        $formated_tanggal = $day_format ? $this->tanggal->translatedFormat('l, d F Y') : $this->tanggal->translatedFormat('d F Y');

        return $formated_tanggal;
    }

    public function getStatus()
    {
        $status = $this->tanggal->lte(today()) ? 'Terbit' : 'Menunggu';

        return $status;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('tanggal', $order_by_value);

        if (!empty($filters['judul_filter'])) {
            $query->where('judul', 'like', "%{$filters['judul_filter']}%");
        }

        if (!empty($filters['tanggal_filter'])) {
            $query->whereDate('tanggal', $filters['tanggal_filter']);
        }

        // if (!empty($filters['isi_filter'])) {
        //     $query->where('isi', 'like', "%{$filters['isi_filter']}%");
        // }

        if (!empty($filters['status_filter'])) {
            if ($filters['status_filter'] === 'menunggu') {
                $query->where('tanggal', '>', today());
            } elseif ($filters['status_filter'] === 'terbit') {
                $query->where('tanggal', '<=', today());
            }
        }

        return $query;
    }
}
