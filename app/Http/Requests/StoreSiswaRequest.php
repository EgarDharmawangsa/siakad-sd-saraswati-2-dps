<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Pastikan user boleh akses
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan Validasi
     */
    public function rules(): array
    {
        $id_kelas = $this->input('id_kelas');

        $rules = [
            'username'              => 'required|string|max:255|unique:users,username',
            'password'              => 'required|string|min:6',
            'konfirmasi_password'   => 'required|same:password',
            'nama_siswa'    => 'required|string|max:255',
            'nik'           => 'required|numeric|digits:16|unique:siswa,nik',
            'nisn'          => 'required|numeric|unique:siswa,nisn',
            'nipd'          => 'required|numeric|unique:siswa,nipd',
            'foto'          => 'nullable|image|max:2048',
            'tempat_lahir'           => 'required|string|max:255',
            'tanggal_lahir'          => 'required|date',
            'jenis_kelamin'          => 'required|in:Laki-laki,Perempuan',
            'agama'                  => 'required|string',
            'no_kk'                  => 'required|numeric',
            'no_registrasi_akta_lahir' => 'nullable|string',
            'kewarganegaraan'        => 'nullable|string',
            'berat_badan'            => 'nullable|numeric',
            'tinggi_badan'           => 'nullable|numeric',
            'lingkar_kepala'         => 'nullable|numeric',
            'jumlah_saudara_kandung' => 'nullable|integer',
            'anak_ke_berapa'         => 'nullable|integer',
            'disabilitas'            => 'nullable|string',
            'keterangan_disabilitas' => 'nullable|string',
            'alamat'                 => 'required|string',
            'rt'                     => 'nullable|string',
            'rw'                     => 'nullable|string',
            'dusun'                  => 'nullable|string',
            'kelurahan'              => 'nullable|string',
            'kecamatan'              => 'nullable|string',
            'kode_pos'               => 'nullable|numeric',
            'lintang'                => 'nullable|string',
            'bujur'                  => 'nullable|string',
            'jenis_tinggal'          => 'required|string',
            'alat_transportasi'      => 'required|string',
            'jarak_rumah_ke_sekolah' => 'nullable|numeric',
            'no_telepon_rumah'       => 'nullable|string',
            'no_telepon_seluler'     => 'required|string',
            'e_mail'                 => 'nullable|email',
            'nama_ayah'              => 'nullable|string',
            'nik_ayah'               => 'nullable|numeric',
            'tahun_lahir_ayah'       => 'nullable|numeric',
            'jenjang_pendidikan_ayah'=> 'nullable|string',
            'pekerjaan_ayah'         => 'nullable|string',
            'penghasilan_ayah'       => 'nullable|string',
            'berkebutuhan_khusus_ayah'=> 'nullable|string',
            'nama_ibu'               => 'nullable|string',
            'nik_ibu'                => 'nullable|numeric',
            'tahun_lahir_ibu'        => 'nullable|numeric',
            'jenjang_pendidikan_ibu' => 'nullable|string',
            'pekerjaan_ibu'          => 'nullable|string',
            'penghasilan_ibu'        => 'nullable|string',
            'berkebutuhan_khusus_ibu'=> 'nullable|string',
            'nama_wali'              => 'nullable|string',
            'nik_wali'               => 'nullable|numeric',
            'tahun_lahir_wali'       => 'nullable|numeric',
            'jenjang_pendidikan_wali'=> 'nullable|string',
            'pekerjaan_wali'         => 'nullable|string',
            'penghasilan_wali'       => 'nullable|string',
            'penerima_kip'           => 'required|string',
            'no_kip'                 => 'nullable|string',
            'nama_kip'               => 'nullable|string',
            'layak_pip'              => 'nullable|string',
            'alasan_layak_pip'       => 'nullable|string',
            'nama_bank'              => 'nullable|string',
            'no_rekening'            => 'nullable|string',
            'nama_rekening'          => 'nullable|string',
            'penerima_kps'           => 'nullable|string',
            'no_kps'                 => 'nullable|string',
            'sekolah_asal'           => 'nullable|string',
            'no_peserta_un'          => 'nullable|string',
            'no_seri_ijazah'         => 'nullable|string',
            'id_ekstrakurikuler'    => 'nullable|array',
            'id_ekstrakurikuler.*'   => 'nullable|exists:ekstrakurikuler,id_ekstrakurikuler',
            'id_kelas'              => 'nullable|exists:kelas,id_kelas',
            'nomor_urut'            => ['nullable', 'integer']
        ];

        if ($id_kelas !== null) {
            $rules['nomor_urut'][] = Rule::unique('siswa')->where(fn ($query) => $query->where('id_kelas', $id_kelas));
        }

        return $rules;
    }
}