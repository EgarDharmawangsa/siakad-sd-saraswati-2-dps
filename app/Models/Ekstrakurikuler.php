<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property Carbon $jam_mulai
 * @property Carbon $jam_selesai
 */

class Ekstrakurikuler extends Model
{
        use HasFactory;

        protected $table = 'ekstrakurikuler';

        protected $primaryKey = 'id_ekstrakurikuler';

        protected $guarded = ['id_ekstrakurikuler'];

        protected $casts = [
                'jam_mulai' => 'datetime',
                'jam_selesai' => 'datetime'
        ];

        public function getFormatedJam(string $column)
        {
                $column_array = ['jam_mulai', 'jam_selesai'];

                if (!in_array($column, $column_array)) {
                        return null;
                }

                $formated_jam = $this->{$column}?->format('H:i');

                if (!empty($formated_jam)) {
                        return $formated_jam;
                } else {
                        return '-';
                }
        }

        public function scopeFilter($query, array $filters)
        {
                $order_by_array = ['desc', 'asc'];
                $hari_array = [
                        'senin',
                        'selasa',
                        'rabu',
                        'kamis',
                        'jumat',
                        'sabtu',
                        'minggu'
                ];

                $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
                $query->orderBy('created_at', $order_by_value);

                if (!empty($filters['nama_ekstrakurikuler_filter'])) {
                        $query->where('nama_ekstrakurikuler', 'like', "%{$filters['nama_ekstrakurikuler_filter']}%");
                }

                if (!empty($filters['nama_pembina_filter'])) {
                        $query->where('nama_pembina', 'like', "%{$filters['nama_pembina_filter']}%");
                }

                if (!empty($filters['alamat_pembina_filter'])) {
                        $query->where('alamat_pembina', 'like', "%{$filters['alamat_pembina_filter']}%");
                }

                if (!empty($filters['no_telepon_filter'])) {
                        $query->where('no_telepon', 'like', "%{$filters['no_telepon_filter']}%");
                }

                if (!empty($filters['hari_filter'])) {
                        $hari_filter_value = in_array(strtolower($filters['hari_filter']), $hari_array) ? $filters['hari_filter'] : '';
                        $query->where('hari', 'like', "%{$hari_filter_value}%");
                }

                if (!empty($filters['jam_mulai_filter'])) {
                        $query->whereTime('jam_mulai', '=', $filters['jam_mulai_filter']);
                }

                if (!empty($filters['jam_selesai_filter'])) {
                        $query->whereTime('jam_selesai', '=', $filters['jam_selesai_filter']);
                }

                return $query;
        }

        public function pesertaEkstrakurikuler()
        {
                return $this->hasMany(PesertaEkstrakurikuler::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
        }
}
