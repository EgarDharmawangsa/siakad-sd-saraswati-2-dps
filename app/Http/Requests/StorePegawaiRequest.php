<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_mata_pelajaran'     => 'nullable|array',
            'id_mata_pelajaran.*'   => 'nullable|exists:mata_pelajaran,id_mata_pelajaran',
            'nik'                   => 'required|string|min:16|max:20|unique:pegawai,nik|unique:siswa,nik',
            'nip'                   => 'nullable|string|min:18|max:20|unique:pegawai,nip',
            'nipppk'                => 'nullable|string|min:18|max:20|unique:pegawai,nipppk',
            'nama_pegawai'          => 'required|min:3|string|max:255',
            'jenis_kelamin'         => 'required|string|min:3|max:10',
            'agama'                 => 'required|string|min:3|max:20',
            'tempat_lahir'          => 'required|string|min:3|max:25',
            'tanggal_lahir'         => 'required|date|before:today',
            'alamat'                => 'required|string|min:10|max:255',
            'no_telepon_rumah'      => 'nullable|string|min:10|max:15',
            'no_telepon_seluler'    => 'required|string|min:10|max:15',
            'username'              => 'nullable|string|min:5|max:50|unique:users,username',
            'password'              => 'nullable|string|min:8|max:255',
            'e_mail'                => 'nullable|email|min:7|max:255|unique:pegawai,e_mail|unique:siswa,e_mail',
            'jabatan'               => 'nullable|string|min:3|max:30',
            'status_perkawinan'     => 'required|min:3|max:10|string',
            'status_kepegawaian'    => 'nullable|min:3|max:15|string',
            'ijazah_terakhir'       => 'nullable|string|min:2|max:5',
            'tahun_ijazah'          => 'nullable|integer|min:1900|max:' . date('Y'),
            'posisi'                => 'required|string|min:3|max:20',
            'status_sertifikasi'    => 'required|string|min:3|max:5',
            'tahun_sertifikasi'     => 'nullable|integer|min:1900|max:' . date('Y'),
            'permulaan_kerja'       => 'required|date|before_or_equal:today',
            'permulaan_kerja_sds2'  => 'required|date|before_or_equal:today',
            'no_sk'                 => 'nullable|string|min:5|max:25',
            'tanggal_sk_terakhir'   => 'nullable|date|before_or_equal:today',
            'foto'                  => 'nullable|file|mimes:jpg,png,jpeg|max:2048'
        ];
    }
}
