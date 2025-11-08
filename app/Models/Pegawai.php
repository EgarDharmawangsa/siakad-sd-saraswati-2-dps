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
        $formated_nama_pegawai = $this->nip ?? $this->nipppk ?? '-' . ' | ' . $this->nama_pegawai;

        return $formated_nama_pegawai;
    }

    public function getFormatedTanggal(string $column)
    {
        $column_array = ['tanggal_lahir', 'permulaan_kerja', 'permulaan_kerja_sds2', 'tanggal_sk_terakhir'];

        if (!in_array($column, $column_array)) {
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
        $jenis_kelamin_array = ['laki-laki', 'perempuan'];
        $agama_array = [
            'islam',
            'kristen protestan',
            'kristen katolik',
            'hindu',
            'budha',
            'konghucu',
            'tidak beragama'
        ];
        $status_perkawinan_array = ['sudah', 'pernah', 'belum'];
        $posisi_array = [
            'staf tata usaha',
            'guru',
            'pegawai perpustakaan',
            'satuan pengamanan',
            'pegawai kebersihan',
        ];
        $jabatan_array = [
            "pengatur muda | ii/a",
            "pengatur muda tk. i | ii/b",
            "pengatur | ii/c",
            "pengatur tk. i | ii/d",
            "penata muda | iii/a",
            "penata muda tk. i | iii/b",
            "penata | iii/c",
            "penata tk. i | iii/d",
            "pembina | iv/a",
            "pembina tk. i | iv/b",
            "pembina utama muda | iv/c",
            "pembina utama madya | iv/d",
            "pembina utama | iv/e",
        ];
        $status_sertifikasi_array = ['sudah', 'belum'];

        $order_by_value = in_array(strtolower($filters['order_by'] ?? ''), $order_by_array) ? $filters['order_by'] : 'desc';
        $query->orderBy('created_at', $order_by_value);

        // Data Pribadi
        if (!empty($filters['nik_filter'])) {
            $query->where('nik', 'like', "%{$filters['nik_filter']}%");
        }

        if (!empty($filters['nama_pegawai_filter'])) {
            $query->where('nama_pegawai', 'like', "%{$filters['nama_pegawai_filter']}%");
        }

        if (!empty($filters['jenis_kelamin_filter'])) {
            $jenis_kelamin_filter_value = in_array(strtolower($filters['jenis_kelamin_filter']), $jenis_kelamin_array) ? $filters['jenis_kelamin_filter'] : '';
            $query->where('jenis_kelamin', 'like', "%{$jenis_kelamin_filter_value}%");
        }

        if (!empty($filters['tempat_lahir_filter'])) {
            $query->where('tempat_lahir', 'like', "%{$filters['tempat_lahir_filter']}%");
        }

        if (!empty($filters['tanggal_lahir_filter'])) {
            $query->whereDate('tanggal_lahir', $filters['tanggal_lahir_filter']);
        }

        if (!empty($filters['agama_filter'])) {
            $agama_filter_value = in_array(strtolower($filters['agama_filter']), $agama_array) ? $filters['agama_filter'] : '';
            $query->where('agama', 'like', "%{$agama_filter_value}%");
        }

        if (!empty($filters['status_perkawinan_filter'])) {
            $status_perkawinan_filter_value = in_array(strtolower($filters['status_perkawinan_filter']), $status_perkawinan_array) ? $filters['status_perkawinan_filter'] : '';
            $query->where('status_perkawinan', 'like', "%{$status_perkawinan_filter_value}%");
        }

        if (!empty($filters['alamat_filter'])) {
            $query->where('alamat', 'like', "%{$filters['alamat_filter']}%");
        }

        if (!empty($filters['no_telepon_rumah_filter'])) {
            $query->where('no_telepon_rumah', 'like', "%{$filters['no_telepon_rumah_filter']}%");
        }

        if (!empty($filters['no_telepon_seluler_filter'])) {
            $query->where('no_telepon_seluler', 'like', "%{$filters['no_telepon_seluler_filter']}%");
        }

        if (!empty($filters['e_mail_filter'])) {
            $query->where('e_mail', 'like', "%{$filters['e_mail_filter']}%");
        }

        if (!empty($filters['username_filter'])) {
            $query->whereHas('userAuth', fn($query) => $query->where('username', 'like', '%' . $filters['username_filter'] . '%'));
        }

        // Data Kepegawaian
        if (!empty($filters['posisi_filter'])) {
            $posisi_filter_value = in_array(strtolower($filters['posisi_filter']), $posisi_array) ? $filters['posisi_filter'] : '';
            $query->where('posisi', 'like', "%{$posisi_filter_value}%");
        }

        if (!empty($filters['guru_mata_pelajaran_filter'])) {
            $query->whereHas('guruMataPelajaran.mataPelajaran', fn($query) => $query->where('nama_mata_pelajaran', 'like', "%{$filters['guru_mata_pelajaran_filter']}%"));
        }

        if (!empty($filters['nip_filter'])) {
            $query->where('nip', 'like', "%{$filters['nip_filter']}%");
        }

        if (!empty($filters['nipppk_filter'])) {
            $query->where('nipppk', 'like', "%{$filters['nipppk_filter']}%");
        }

        if (!empty($filters['jabatan_filter'])) {
            $jabatan_filter_value = in_array(strtolower($filters['jabatan_filter']), $jabatan_array) ? $filters['jabatan_filter'] : '';
            $query->where('jabatan', 'like', "%{$jabatan_filter_value}%");
        }

        if (!empty($filters['permulaan_kerja_filter'])) {
            $query->whereDate('permulaan_kerja', $filters['permulaan_kerja_filter']);
        }

        if (!empty($filters['permulaan_kerja_sds2_filter'])) {
            $query->whereDate('permulaan_kerja_sds2', $filters['permulaan_kerja_sds2_filter']);
        }

        // Data Sertifikasi
        if (!empty($filters['ijazah_terakhir_filter'])) {
            $query->where('ijazah_terakhir', 'like', "%{$filters['ijazah_terakhir_filter']}%");
        }

        if (!empty($filters['tahun_ijazah_filter'])) {
            $query->where('tahun_ijazah', 'like', "%{$filters['tahun_ijazah_filter']}%");
        }

        if (!empty($filters['status_sertifikasi_filter'])) {
            $status_sertifikasi_filter_value = in_array(strtolower($filters['status_sertifikasi_filter']), $status_sertifikasi_array) ? $filters['status_sertifikasi_filter'] : '';
            $query->where('status_sertifikasi', 'like', "%{$status_sertifikasi_filter_value}%");
        }

        if (!empty($filters['tahun_sertifikasi_filter'])) {
            $query->where('tahun_sertifikasi', 'like', "%{$filters['tahun_sertifikasi_filter']}%");
        }

        // Data SK
        if (!empty($filters['no_sk_filter'])) {
            $query->where('no_sk', 'like', "%{$filters['no_sk_filter']}%");
        }

        if (!empty($filters['tgl_sk_terakhir_filter'])) {
            $query->where('tgl_sk_terakhir', 'like', "%{$filters['tgl_sk_terakhir_filter']}%");
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
