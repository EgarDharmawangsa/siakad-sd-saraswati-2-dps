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

    public function scopeOrderedNomorUrutSiswa($query, $kelas = null) {
        if ($kelas) {
            $query->whereHas('kelas', fn($query) => $query->where('id_kelas', $kelas));
        } else {
            $query->orderBy('nomor_urut');
        }

        return $query;
    }
    
    public function scopeFilter($query, array $filters)
    {
        $likeFields = [
            'nama_siswa', 'nisn', 'nipd', 'nik', 'tempat_lahir', 'kewarganegaraan',
            'no_registrasi_akta_lahir', 
            
            'alamat', 'rt', 'rw', 'dusun', 'kelurahan', 'kecamatan', 'kode_pos', 
            'alat_transportasi', 'no_telepon_rumah', 'no_telepon_seluler', 'e_mail', 
            'keterangan_disabilitas', 'jenis_tinggal',
            
            'nama_ayah', 'nik_ayah', 'jenjang_pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
            
            'nama_ibu', 'nik_ibu', 'jenjang_pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
            
            'nama_wali', 'nik_wali', 'jenjang_pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali',
            
            'no_kps', 'no_kip', 'nama_kip', 'alasan_layak_pip', 'nama_bank', 'no_rekening',
            'nama_rekening', 'sekolah_asal', 'no_peserta_un', 'no_seri_ijazah'
        ];

        foreach ($likeFields as $field) {
            if (isset($filters[$field]) && $filters[$field] !== null && $filters[$field] !== '') {
                $query->where($field, 'like', '%' . $filters[$field] . '%');
            }
        }

        $exactFields = [
            'jenis_kelamin', 'agama', 
            'tanggal_lahir', 
            'jarak_rumah_ke_sekolah', 
            'jumlah_saudara_kandung', 'anak_ke_berapa',
            'disabilitas',
            'penerima_kps', 'penerima_kip', 'layak_pip',
            
            'berat_badan', 'tinggi_badan', 'lingkar_kepala'
        ];

        foreach ($exactFields as $field) {
            if (isset($filters[$field]) && $filters[$field] !== null && $filters[$field] !== '') {
                $query->where($field, $filters[$field]);
            }
        }

        $sort_by = \in_array(strtolower($filters['sort_by'] ?? ''), ['asc', 'desc']) ? strtolower($filters['sort_by']) : 'desc';
        $query->orderBy('created_at', $sort_by);

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