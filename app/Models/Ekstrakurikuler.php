<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekstrakurikuler extends Model
{
        use HasFactory;

        protected $table = 'ekstrakurikuler';

        protected $primaryKey = 'id_ekstrakurikuler';

        protected $guarded = ['id_ekstrakurikuler'];

        protected function jamMulai(): Attribute
        {
                return Attribute::make(get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),);
        }

        protected function jamSelesai(): Attribute
        {
                return Attribute::make(get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),);
        }

        public function scopeFilter($query, array $filters)
        {
                $order_by_option_value = ['desc', 'asc'];
                $hari_option_value = [
                        'senin',
                        'selasa',
                        'rabu',
                        'kamis',
                        'jumat',
                        'sabtu',
                        'minggu'
                ];

                $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_option_value) ? $filters['order_by'] : 'desc';
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
                        $hari_filter_value = in_array(strtolower($filters['hari_filter']), $hari_option_value) ? $filters['hari_filter'] : '';
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
