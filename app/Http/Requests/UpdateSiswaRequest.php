<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // PERBAIKAN LOGIC AMBIL ID (Agar aman di PHP 8)
        $routeParam = $this->route('siswa');
        // Jika routeParam berbentuk object (Model), ambil id_siswa. Jika string/int, ambil langsung.
        $id = is_object($routeParam) ? $routeParam->id_siswa : $routeParam;

        return [
            // --- 1. AKUN & PRIBADI UTAMA ---
            'username'      => ['required', 'string', 'max:255'],
            'password'      => ['nullable', 'string', 'min:6'],
            'nama_siswa'    => ['required', 'string', 'max:255'],
            'kelas_id'      => ['required', 'exists:kelas,id_kelas'],
            
            // IGNORE ID UNTUK UNIQUE VALIDATION
            'nik'           => ['required', 'numeric', 'digits:16', Rule::unique('siswa', 'nik')->ignore($id, 'id_siswa')],
            'nisn'          => ['required', 'numeric', Rule::unique('siswa', 'nisn')->ignore($id, 'id_siswa')],
            'nipd'          => ['required', 'numeric', Rule::unique('siswa', 'nipd')->ignore($id, 'id_siswa')],
            'foto'          => ['nullable', 'image', 'max:2048'],

            // --- 2. DATA KELAHIRAN & AGAMA ---
            'tempat_lahir'           => ['required', 'string'],
            'tanggal_lahir'          => ['required', 'date'],
            'jenis_kelamin'          => ['required', 'in:Laki-laki,Perempuan'],
            'agama'                  => ['required', 'string'],
            'no_kk'                  => ['nullable', 'numeric'],
            'no_registrasi_akta_lahir' => ['nullable', 'string'],
            'kewarganegaraan'        => ['nullable', 'string'],

            // --- 3. DATA FISIK ---
            'berat_badan'            => ['nullable', 'numeric'],
            'tinggi_badan'           => ['nullable', 'numeric'],
            'lingkar_kepala'         => ['nullable', 'numeric'],
            'jumlah_saudara_kandung' => ['nullable', 'integer'],
            'anak_ke_berapa'         => ['nullable', 'integer'],
            'disabilitas'            => ['nullable', 'string'],
            'keterangan_disabilitas' => ['nullable', 'string'],

            // --- 4. ALAMAT ---
            'alamat'                 => ['required', 'string'],
            'rt'                     => ['nullable', 'string'],
            'rw'                     => ['nullable', 'string'],
            'dusun'                  => ['nullable', 'string'],
            'kelurahan'              => ['nullable', 'string'],
            'kecamatan'              => ['nullable', 'string'],
            'kode_pos'               => ['nullable', 'numeric'],
            'lintang'                => ['nullable', 'string'],
            'bujur'                  => ['nullable', 'string'],
            'jenis_tinggal'          => ['nullable', 'string'],
            'alat_transportasi'      => ['nullable', 'string'],
            'jarak_rumah_ke_sekolah' => ['nullable', 'numeric'],

            // --- 5. KONTAK ---
            'no_telepon_rumah'       => ['nullable', 'string'],
            'no_telepon_seluler'     => ['required', 'string'],
            'e_mail'                 => ['nullable', 'email'],

            // --- 6. DATA AYAH ---
            'nama_ayah'              => ['nullable', 'string'],
            'nik_ayah'               => ['nullable', 'numeric'],
            'tahun_lahir_ayah'       => ['nullable', 'numeric'],
            'jenjang_pendidikan_ayah'=> ['nullable', 'string'],
            'pekerjaan_ayah'         => ['nullable', 'string'],
            'penghasilan_ayah'       => ['nullable', 'string'],
            'berkebutuhan_khusus_ayah'=> ['nullable', 'string'],

            // --- 7. DATA IBU ---
            'nama_ibu'               => ['nullable', 'string'],
            'nik_ibu'                => ['nullable', 'numeric'],
            'tahun_lahir_ibu'        => ['nullable', 'numeric'],
            'jenjang_pendidikan_ibu' => ['nullable', 'string'],
            'pekerjaan_ibu'          => ['nullable', 'string'],
            'penghasilan_ibu'        => ['nullable', 'string'],
            'berkebutuhan_khusus_ibu'=> ['nullable', 'string'],

            // --- 8. DATA WALI ---
            'nama_wali'              => ['nullable', 'string'],
            'nik_wali'               => ['nullable', 'numeric'],
            'tahun_lahir_wali'       => ['nullable', 'numeric'],
            'jenjang_pendidikan_wali'=> ['nullable', 'string'],
            'pekerjaan_wali'         => ['nullable', 'string'],
            'penghasilan_wali'       => ['nullable', 'string'],

            // --- 9. KIP/PIP & BANK ---
            // WAJIB ADA: Jika tidak ada, kamu tidak bisa mengubah status penerima KIP
            'penerima_kip'           => ['required', 'string'], 
            
            'no_kip'                 => ['nullable', 'string'],
            'nama_kip'               => ['nullable', 'string'],
            'layak_pip'              => ['nullable', 'string'],
            'alasan_layak_pip'       => ['nullable', 'string'],
            'nama_bank'              => ['nullable', 'string'],
            'no_rekening'            => ['nullable', 'string'],
            'nama_rekening'          => ['nullable', 'string'],
            'penerima_kps'           => ['nullable', 'string'],
            'no_kps'                 => ['nullable', 'string'],
            'sekolah_asal'           => ['nullable', 'string'],
            'no_peserta_un'          => ['nullable', 'string'],
            'no_seri_ijazah'         => ['nullable', 'string'],
        ];
    }
}