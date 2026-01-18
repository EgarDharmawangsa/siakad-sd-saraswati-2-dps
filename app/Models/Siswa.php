<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_siswa
 * @property int $id_kelas
 * @property int $nisn
 * @property int $nomor_urut
 * @property string $nama_siswa
 * @property string|null $foto
 */

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $guarded = ['id_siswa'];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function getFormatedNamaSiswa($nomor_urut_siswa = false)
    {
        $nomor_urut = $this->nomor_urut ?? '-';
        $formated_nama_siswa = $nomor_urut_siswa ? "{$nomor_urut} | {$this->nisn} | {$this->nama_siswa}" : "{$this->nisn} | {$this->nama_siswa}";

        return $formated_nama_siswa;
    }

    public function scopeOrderedNomorUrutSiswa($query, $kelas = null)
    {
        if ($kelas) {
            $query->whereHas('kelas', fn($query) => $query->where('id_kelas', $kelas));
        } else {
            $query->orderBy('nomor_urut');
        }

        return $query;
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $sort_by = \in_array(strtolower($filters['sort_by'] ?? ''), $order_by_array) ? strtolower($filters['sort_by']) : 'desc';
        $query->orderBy('created_at', $sort_by);
        
        // $like_fields = [
        //     // Pribadi
        //     'nik', 'no_kk', 'nisn', 'nipd', 'nama_siswa', 
        //     'tempat_lahir', 'no_telepon_rumah', 'no_telepon_seluler', 
        //     'e_mail', 'no_registrasi_akta_lahir', 'keterangan_disabilitas',

        //     // Alamat
        //     'alamat', 'dusun', 'kelurahan', 
        //     'kecamatan', 'kode_pos', 

        //     // Pendamping
        //     'nama_ayah', 'nik_ayah', 'tahun_lahir_ayah', 'jenjang_pendidikan_ayah', 'pekerjaan_ayah',
        //     'nama_ibu', 'nik_ibu', 'tahun_lahir_ibu', 'jenjang_pendidikan_ibu', 'pekerjaan_ibu',
        //     'nama_wali', 'nik_wali', 'tahun_lahir_wali', 'jenjang_pendidikan_wali', 'pekerjaan_wali',

        //     // Pendidikan
        //     'sekolah_asal', 'no_peserta_un', 'no_seri_ijazah',

        //     'no_kps', 'no_kks', 'no_kip', 'nama_kip', 'alasan_layak_pip', 
        //     'nama_bank', 'no_rekening', 'nama_rekening',

        //     // Akademik
        //     'nomor_urut'
        // ];

        // foreach ($like_fields as $_like_fields) {
        //     if (!empty($filters[$_like_fields])) {
        //         $query->where($_like_fields, 'like', "%{$filters[$_like_fields]}%");
        //     }
        // }

        // $exact_fields = [
        //     // Pribadi
        //     'jenis_kelamin', 'agama', 'jenis_tinggal', 'alat_transportasi',
        //     'berat_badan', 'tinggi_badan', 'lingkar_kepala',
        //     'jumlah_saudara_kandung', 'anak_ke_berapa',
        //     'disabilitas',

        //     // Alamat
        //     'rt', 'rw', 'lintang', 'bujur', 'jarak_rumah_ke_sekolah', 

        //     // Pendamping
        //     'penghasilan_ayah', 'penghasilan_ibu', 'penghasilan_wali',

        //     // Pendidikan
        //     'penerima_kps', 'penerima_kip', 'layak_pip'
        // ];

        // foreach ($exact_fields as $_exact_fields) {
        //     if (!empty($filters[$_exact_fields])) {
        //         $query->where($_exact_fields, $filters[$_exact_fields]);
        //     }
        // }

        // if (!empty($filters['tanggal_lahir'])) {
        //     $query->whereDate('tanggal_lahir', $filters['tanggal_lahir']);
        // }

        // if (!empty($filters['username'])) {
        //     $query->whereHas('userAuth', fn($query) => $query->where('username', 'like', '%' . $filters['username'] . '%'));
        // }

        if (!empty($filters['kelas'])) {
            $query->whereHas('kelas', fn($query) => $query->where('id_kelas', $filters['kelas']));
        }

        if (!empty($filters['nisn'])) {
            $query->where('nisn', 'like', '%' . $filters['nisn'] . '%');
        }

        if (!empty($filters['nama_siswa'])) {
            $query->where('nama_siswa', 'like', '%' . $filters['nama_siswa'] . '%');
        }

        if (!empty($filters['jenis_kelamin'])) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin']);
        }

        if (!empty($filters['agama'])) {
            $query->where('agama', $filters['agama']);
        }

        if (!empty($filters['no_telepon_seluler'])) {
            $query->where('no_telepon_seluler', 'like', '%' . $filters['no_telepon_seluler'] . '%');
        }

        if (!empty($filters['ekstrakurikuler'])) {
            $query->whereHas('pesertaEkstrakurikuler.ekstrakurikuler', fn($query) => $query->where('id_ekstrakurikuler', $filters['ekstrakurikuler']));
        }

        return $query;
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_siswa', 'id_siswa');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_siswa', 'id_siswa');
    }

    public function nilaiMataPelajaran()
    {
        return $this->hasMany(NilaiMataPelajaran::class, 'id_siswa', 'id_siswa');
    }

    public function userAuth()
    {
        return $this->hasOne(User::class, 'id_siswa', 'id_siswa');
    }

    public function pesertaEkstrakurikuler()
    {
        return $this->hasMany(PesertaEkstrakurikuler::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
