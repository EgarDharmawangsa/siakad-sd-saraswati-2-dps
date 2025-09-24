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

        public function getHari(): string {
                $hari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                return $hari[$this->hari];
        }

        protected function jamMulai(): Attribute {
                return Attribute::make(get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),);
        }

        protected function jamSelesai(): Attribute {
                return Attribute::make(get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),);
        }

        public function pesertaEkstrakurikuler() {
                return $this->hasMany(PesertaEkstrakurikuler::class, 'id_ekstrakurikuler', 'id_ekstrakurikuler');
        }
}
