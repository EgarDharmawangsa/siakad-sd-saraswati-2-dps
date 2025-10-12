<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $guarded = ['id_pegawai'];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'permulaan_kerja' => 'date',
        'permulaan_kerja_sds2' => 'date',
        'tanggal_sk_terakhir' => 'date'
    ];

    public function getPegawai()
    {
        $nip = $this->nip ?? $this->nipppk ?? '-';
        return "{$nip} | {$this->nama_pegawai}";
    }

    // Cek NIK di pegawai & siswa
    public static function checkNikExists(string $nik): ?string
    {
        $exists = DB::table('pegawai')->where('nik', $nik)->exists()
            || DB::table('siswa')->where('nik', $nik)->exists();

        return $exists ? 'NIK sudah terdaftar di sistem.' : null;
    }

    // Cek Email di pegawai & siswa
    public static function checkEmailExists(string $email): ?string
    {
        $exists = DB::table('pegawai')->where('e_mail', $email)->exists()
            || DB::table('siswa')->where('e_mail', $email)->exists();

        return $exists ? 'E-mail sudah terdaftar di sistem.' : null;
    }

    public function kelas() {
        return $this->hasOne(Kelas::class, 'id_pegawai', 'id_pegawai');
    }

    public function guruMataPelajaran() {
        return $this->hasMany(GuruMataPelajaran::class, 'id_pegawai', 'id_pegawai');
    }

    public function userAuth() {
        return $this->hasOne(User::class, 'id_pegawai', 'id_pegawai');
    }
}
