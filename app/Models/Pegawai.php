<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

/**
 * @property int $id_pegawai
 * @property string|null $nip
 * @property string|null $nipppk
 * @property string $nama_pegawai
 * @property Carbon $tanggal_lahir
 * @property string $posisi
 * @property Carbon $permulaan_kerja
 * @property Carbon $permulaan_kerja_sds2
 * @property Carbon $tanggal_sk_terakhir
 * @property string|null $foto
 */

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

    public function getFormatedNamaPegawai()
    {
        $formated_nama_pegawai = ($this->nip ?? $this->nipppk ?? '-') . ' | ' . $this->nama_pegawai;

        return $formated_nama_pegawai;
    }

    public function getFormatedTanggal(string $column)
    {
        $column_array = ['tanggal_lahir', 'permulaan_kerja', 'permulaan_kerja_sds2', 'tanggal_sk_terakhir'];

        if (!\in_array($column, $column_array)) {
            return null;
        }

        $formated_tanggal = $this->{$column}?->translatedFormat('d F Y');

        if (!empty($formated_tanggal)) {
            return $formated_tanggal;
        } else {
            return '-';
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $order_by_array = ['desc', 'asc'];

        $order_by_value = \in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('created_at', $order_by_value);

        // $like_fields = [
        //     'nik', 
        //     'nama_pegawai', 
        //     'tempat_lahir', 
        //     'alamat', 
        //     'no_telepon_rumah', 
        //     'no_telepon_seluler', 
        //     'e_mail', 
        //     'nip', 
        //     'nipppk', 
        //     'ijazah_terakhir', 
        //     'tahun_ijazah', 
        //     'tahun_sertifikasi', 
        //     'no_sk', 
        //     'tgl_sk_terakhir'
        // ];

        // foreach ($like_fields as $_like_fields) {
        //     if (!empty($filters[$_like_fields])) {
        //         $like_field_filter = "{$_like_fields}_filter";

        //         $query->where($_like_fields, 'like', "%{$filters[$like_field_filter]}%");
        //     }
        // }
        
        // $exact_fields = [
        //     'jenis_kelamin', 
        //     'agama', 
        //     'status_perkawinan', 
        //     'posisi', 
        //     'jabatan', 
        //     'status_sertifikasi'
        // ];

        // foreach ($exact_fields as $_exact_fields) {
        //     if (!empty($filters[$_exact_fields])) {
        //         $exact_field_filter = "{$_exact_fields}_filter";
        //         $query->where($_exact_fields, $filters[$exact_field_filter]);
        //     }
        // }
        
        // $date_fields = [
        //     'tanggal_lahir', 
        //     'permulaan_kerja', 
        //     'permulaan_kerja_sds2',
        //     'tanggal_sk_terakhir'
        // ];
        
        // foreach ($date_fields as $_date_fields) {
        //     if (!empty($filters[$_date_fields])) {
        //         $date_field_filter = "{$_date_fields}_filter";
        //         $query->whereDate($_date_fields, $filters[$date_field_filter]);
        //     }
        // }

        // if (!empty($filters['username_filter'])) {
        //     $query->whereHas('userAuth', fn($query) => $query->where('username', 'like', '%' . $filters['username_filter'] . '%'));
        // }

        // if (!empty($filters['guru_mata_pelajaran_filter'])) {
        //     $query->whereHas('guruMataPelajaran.mataPelajaran', fn($query) => $query->where('guru_mata_pelajaran', 'like', "%{$filters['guru_mata_pelajaran_filter']}%"));
        // }

        if (!empty($filters['nip_filter'])) {
            $query->where('nip', 'like', '%' . $filters['nip'] . '%');
        }

        if (!empty($filters['nipppk_filter'])) {
            $query->where('nipppk', 'like', '%' . $filters['nipppk'] . '%');
        }

        if (!empty($filters['nama_pegawai_filter'])) {
            $query->where('nama_pegawai', 'like', '%' . $filters['nama_pegawai_filter'] . '%');
        }

        if (!empty($filters['nama_guru_filter'])) {
            $query->where('nama_pegawai', 'like', '%' . $filters['nama_guru_filter'] . '%');
        }

        if (!empty($filters['jenis_kelamin_filter'])) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin_filter']);
        }

        if (!empty($filters['agama_filter'])) {
            $query->where('agama', $filters['agama_filter']);
        }
        if (!empty($filters['no_telepon_seluler_filter'])) {
            $query->where('no_telepon_seluler', $filters['no_telepon_seluler_filter']);
        }
        
        if (!empty($filters['alamat_filter'])) {
            $query->where('alamat', 'like', '%' . $filters['alamat_filter'] . '%');
        }

        if (!empty($filters['posisi_filter'])) {
            $query->where('posisi', $filters['posisi_filter']);
        }

        if (!empty($filters['status_kepegawaian_filter'])) {
            $query->where('status_kepegawaian', $filters['status_kepegawaian_filter']);
        }

        if (!empty($filters['guru_mata_pelajaran_filter'])) {
            $query->whereHas('guruMataPelajaran.mataPelajaran', fn($query) => $query->where('id_mata_pelajaran', $filters['guru_mata_pelajaran_filter']));
        }

        return $query;
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_pegawai', 'id_pegawai');
    }

    public function guruMataPelajaran()
    {
        return $this->hasMany(GuruMataPelajaran::class, 'id_pegawai', 'id_pegawai');
    }

    public function userAuth()
    {
        return $this->hasOne(User::class, 'id_pegawai', 'id_pegawai');
    }
}
