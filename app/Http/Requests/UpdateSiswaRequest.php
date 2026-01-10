<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (request()->routeIs('siswa.update')) {
            $id_siswa = $this->route('siswa')->id_siswa;
            $id_kelas = $this->route('siswa')->id_kelas;
        } else if (request()->routeIs('profile.siswa.update')) {
            $id_siswa = Auth::user()->siswa->id_siswa;
            $id_kelas = Auth::user()->siswa->id_kelas;
        }

        $rules = [
            // Akun
            'username'                  => "required|string|min:5|max:255|unique:users,username,{$id_siswa},id_siswa",
            'password'                  => 'nullable|string|min:6|max:255',

            'nama_siswa'                => 'required|string|min:3|max:255',
            'nik'                       => "required|string|size:16|unique:siswa,nik,{$id_siswa},id_siswa|unique:pegawai,nik",
            'nisn'                      => "required|string|size:10|unique:siswa,nisn,{$id_siswa},id_siswa",
            'nipd'                      => "nullable|string|min:3|max:15|unique:siswa,nipd,{$id_siswa},id_siswa",
            'foto'                      => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'image_delete'              => 'required|integer',
            'tempat_lahir'              => 'required|string|min:3|max:25',
            'tanggal_lahir'             => 'required|date|before:today',
            'jenis_kelamin'             => 'required|string|min:3|max:10',
            'agama'                     => 'required|string|min:3|max:20',
            'no_kk'                     => 'required|string|size:16',
            'jenis_tinggal'             => 'required|string|min:3|max:20',
            'alat_transportasi'         => 'required|string|min:3|max:25',
            'no_telepon_rumah'          => 'nullable|string|min:10|max:15',
            'no_telepon_seluler'        => 'required|string|min:10|max:15',
            'e_mail'                    => "nullable|email|min:3|max:255|unique:siswa,e_mail,{$id_siswa},id_siswa|unique:pegawai,e_mail",
            'berat_badan'               => 'nullable|numeric',
            'tinggi_badan'              => 'nullable|numeric',
            'lingkar_kepala'            => 'nullable|numeric',
            'jumlah_saudara_kandung'    => 'nullable|integer',
            'anak_ke_berapa'            => 'nullable|integer',
            'no_registrasi_akta_lahir'  => "nullable|string|min:10|max:50|unique:siswa,no_registrasi_akta_lahir,{$id_siswa},id_siswa",
            'disabilitas'               => 'nullable|string|min:3|max:20',
            'keterangan_disabilitas'    => 'nullable|string|min:3|max:100',
            'alamat'                    => 'required|string|min:3|max:255',
            'rt'                        => 'nullable|string|min:1|max:5',
            'rw'                        => 'nullable|string|min:1|max:5',
            'dusun'                     => 'nullable|string|min:3|max:25',
            'kelurahan'                 => 'nullable|string|min:3|max:25',
            'kecamatan'                 => 'nullable|string|min:3|max:25',
            'kode_pos'                  => 'nullable|string|min:3|max:5',
            'lintang'                   => 'nullable|string|min:3|max:10',
            'bujur'                     => 'nullable|string|min:3|max:10',
            'jarak_rumah_ke_sekolah'    => 'nullable|numeric',
            'nama_ayah'                 => 'nullable|string|min:3|max:255',
            'nik_ayah'                  => 'nullable|string|size:16',
            'tahun_lahir_ayah'          => 'nullable|integer|min:1900|max:' . date('Y'),
            'jenjang_pendidikan_ayah'   => 'nullable|string|min:3|max:50',
            'pekerjaan_ayah'            => 'nullable|string|min:3|max:100',
            'penghasilan_ayah'          => 'nullable|string|min:3|max:20',
            'nama_ibu'                  => 'nullable|string|min:3|max:255',
            'nik_ibu'                   => 'nullable|string|size:16',
            'tahun_lahir_ibu'           => 'nullable|integer|min:1900|max:' . date('Y'),
            'jenjang_pendidikan_ibu'    => 'nullable|string|min:3|max:50',
            'pekerjaan_ibu'             => 'nullable|string|min:3|max:100',
            'penghasilan_ibu'           => 'nullable|string|min:3|max:20',
            'nama_wali'                 => 'nullable|string|min:3|max:255',
            'nik_wali'                  => 'nullable|string|size:16',
            'tahun_lahir_wali'          => 'nullable|integer|min:1900|max:' . date('Y'),
            'jenjang_pendidikan_wali'   => 'nullable|string|min:3|max:50',
            'pekerjaan_wali'            => 'nullable|string|min:3|max:100',
            'penghasilan_wali'          => 'nullable|string|min:3|max:20',
            'penerima_kps'              => 'required|string|min:3|max:5',
            'no_kps'                    => 'nullable|string|min:10|max:13',
            'no_kks'                    => 'nullable|string|min:10|max:16',
            'penerima_kip'              => 'required|string|min:3|max:5',
            'no_kip'                    => "nullable|string|min:10|max:13|unique:siswa,no_kip,{$id_siswa},id_siswa",
            'nama_kip'                  => 'nullable|string|min:3|max:255',
            'layak_pip'                 => 'nullable|string|min:3|max:5',
            'alasan_layak_pip'          => 'nullable|string|min:3|max:255',
            'nama_bank'                 => 'nullable|string|min:3|max:255',
            'no_rekening'               => 'nullable|string|min:8|max:25',
            'nama_rekening'             => 'nullable|string|min:3|max:255',
            'sekolah_asal'              => 'nullable|string|min:3|max:255',
            'no_peserta_un'             => 'nullable|string|min:15|max:25',
            'no_seri_ijazah'            => "nullable|string|min:15|max:30|unique:siswa,no_seri_ijazah,{$id_siswa},id_siswa",
            'id_ekstrakurikuler'        => 'nullable|array',
            'id_ekstrakurikuler.*'      => 'nullable|exists:ekstrakurikuler,id_ekstrakurikuler',
            'id_kelas'                  => 'nullable|exists:kelas,id_kelas',
            'nomor_urut'                => ['nullable','integer']
        ];

        if ($this->filled('nomor_urut') && $id_kelas) {
            $rules['nomor_urut'][] = Rule::unique('siswa')
                ->where(fn ($q) => $q->where('id_kelas', $id_kelas))->ignore($id_siswa, 'id_siswa');
        }

        return $rules;
    }
}