<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            // --- 1. AKUN (Wajib ada password & unique tanpa ignore) ---
            'username'              => 'required|string|max:255|unique:users,username',
            'password'              => 'required|string|min:6',
            'konfirmasi_password'   => 'required|same:password',

            // --- 2. DATA PRIBADI UTAMA ---
            'nama_siswa'    => 'required|string|max:255',
            'kelas_id'      => 'required|exists:kelas,id_kelas',
            // Unique biasa (karena data baru, belum ada ID)
            'nik'           => 'required|numeric|digits:16|unique:siswa,nik',
            'nisn'          => 'required|numeric|unique:siswa,nisn',
            'nipd'          => 'required|numeric|unique:siswa,nipd',
            'foto'          => 'nullable|image|max:2048', // Tambahkan validasi foto

            // --- 3. KELAHIRAN & AGAMA ---
            'tempat_lahir'           => 'required|string|max:255',
            'tanggal_lahir'          => 'required|date',
            'jenis_kelamin'          => 'required|in:Laki-laki,Perempuan',
            'agama'                  => 'required|string',
            'no_kk'                  => 'required|numeric',
            'no_registrasi_akta_lahir' => 'nullable|string',
            'kewarganegaraan'        => 'nullable|string',

            // --- 4. DATA FISIK ---
            'berat_badan'            => 'nullable|numeric',
            'tinggi_badan'           => 'nullable|numeric',
            'lingkar_kepala'         => 'nullable|numeric',
            'jumlah_saudara_kandung' => 'nullable|integer',
            'anak_ke_berapa'         => 'nullable|integer',
            'disabilitas'            => 'nullable|string',
            'keterangan_disabilitas' => 'nullable|string',

            // --- 5. ALAMAT ---
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

            // --- 6. KONTAK ---
            'no_telepon_rumah'       => 'nullable|string',
            'no_telepon_seluler'     => 'required|string',
            'e_mail'                 => 'nullable|email',

            // --- 7. DATA AYAH (Lengkapi semua field!) ---
            'nama_ayah'              => 'nullable|string',
            'nik_ayah'               => 'nullable|numeric',
            'tahun_lahir_ayah'       => 'nullable|numeric',
            'jenjang_pendidikan_ayah'=> 'nullable|string',
            'pekerjaan_ayah'         => 'nullable|string',
            'penghasilan_ayah'       => 'nullable|string',
            'berkebutuhan_khusus_ayah'=> 'nullable|string',

            // --- 8. DATA IBU (Lengkapi semua field!) ---
            'nama_ibu'               => 'nullable|string',
            'nik_ibu'                => 'nullable|numeric',
            'tahun_lahir_ibu'        => 'nullable|numeric',
            'jenjang_pendidikan_ibu' => 'nullable|string',
            'pekerjaan_ibu'          => 'nullable|string',
            'penghasilan_ibu'        => 'nullable|string',
            'berkebutuhan_khusus_ibu'=> 'nullable|string',

            // --- 9. DATA WALI (Tambahkan field wali!) ---
            'nama_wali'              => 'nullable|string',
            'nik_wali'               => 'nullable|numeric',
            'tahun_lahir_wali'       => 'nullable|numeric',
            'jenjang_pendidikan_wali'=> 'nullable|string',
            'pekerjaan_wali'         => 'nullable|string',
            'penghasilan_wali'       => 'nullable|string',

            // --- 10. KIP, PIP, BANK, SEKOLAH ASAL ---
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
        ];
    }
}