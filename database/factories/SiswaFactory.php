<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kelas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    public function definition(): array
    {
        $yaTidak = fake()->randomElement(['Ya', 'Tidak']);

        return [
            'no_kk' => fake()->numerify('################'), 
            'nik' => fake()->unique()->numerify('################'),
            'nisn' => fake()->unique()->numerify('##########'),
            'nipd' => fake()->unique()->numerify('########'),
            'nama_siswa' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date('Y-m-d', '2015-01-01'),
            'no_registrasi_akta_lahir' => fake()->unique()->numerify('#######-#######-####'),
            'alamat' => fake()->address(),
            'rt' => fake()->numerify('0#'),
            'rw' => fake()->numerify('0#'),
            'dusun' => fake()->streetName(),
            'kelurahan' => fake()->streetName(),
            'kecamatan' => fake()->city(),
            // 'kode_pos' => fake()->postcode(),
            // 'lintang' => (string) fake()->latitude(),
            // 'bujur' => (string) fake()->longitude(),
            'jarak_rumah_ke_sekolah' => fake()->randomFloat(2, 0.1, 25),
            'jenis_tinggal' => fake()->randomElement(['Bersama Orang Tua', 'Wali', 'Kos', 'Asrama', 'Panti Asuhan']),
            'alat_transportasi' => fake()->randomElement(['Jalan Kaki', 'Sepeda Motor', 'Angkutan Umum', 'Antar Jemput']),
            // 'no_telepon_rumah' => fake()->optional()->phoneNumber(),
            'no_telepon_seluler' => '089524627369',
            'e_mail' => fake()->unique()->safeEmail(),
            'berat_badan' => fake()->randomFloat(2, 20, 80),
            'tinggi_badan' => fake()->randomFloat(2, 100, 180),
            'lingkar_kepala' => fake()->randomFloat(2, 40, 60),
            'jumlah_saudara_kandung' => fake()->numberBetween(0, 5),
            'anak_ke_berapa' => fake()->numberBetween(1, 5),
            'disabilitas' => fake()->randomElement(['Tidak', 'Tidak', 'Netra', 'Rungu', 'Daksa']), 
            'keterangan_disabilitas' => null, 
            'sekolah_asal' => 'TK ' . fake()->company(),
            'no_peserta_un' => fake()->numerify('##-##-##-##-###-###-#'),
            'no_seri_ijazah' => fake()->unique()->bothify('DN-?? #######'),
            'penerima_kps' => $yaTidak,
            'no_kps' => ($yaTidak === 'Ya') ? fake()->unique()->numerify('KPS#######') : null,
            'penerima_kip' => $yaTidak,
            'no_kip' => ($yaTidak === 'Ya') ? fake()->unique()->numerify('KIP#######') : null,
            'nama_kip' => ($yaTidak === 'Ya') ? fake()->name() : null,
            'layak_pip' => $yaTidak,
            'alasan_layak_pip' => ($yaTidak === 'Ya') ? 'Pemegang PKH/KPS/KIP' : null,
            'nama_bank' => ($yaTidak === 'Ya') ? 'BRI' : null,
            'no_rekening' => ($yaTidak === 'Ya') ? fake()->bankAccountNumber() : null,
            'nama_rekening' => ($yaTidak === 'Ya') ? fake()->name() : null,
            'no_kks' => fake()->optional()->numerify('KKS########'),
            'nik_ayah' => fake()->unique()->numerify('################'),
            'nama_ayah' => fake()->name('male'),
            'tahun_lahir_ayah' => fake()->year('1990'),
            'jenjang_pendidikan_ayah' => fake()->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah']),
            'pekerjaan_ayah' => fake()->jobTitle(),
            'penghasilan_ayah' => fake()->randomElement(['< 1 Juta', '1 - 2 Juta', '2 - 5 Juta', '5 - 20 Juta', '> 20 Juta']),
            'nik_ibu' => fake()->unique()->numerify('################'),
            'nama_ibu' => fake()->name('female'),
            'tahun_lahir_ibu' => fake()->year('1995'),
            'jenjang_pendidikan_ibu' => fake()->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah']),
            'pekerjaan_ibu' => fake()->jobTitle(),
            'penghasilan_ibu' => fake()->randomElement(['< 1 Juta', '1 - 2 Juta', '2 - 5 Juta', 'Tidak Berpenghasilan']),
            'nik_wali' => fake()->optional()->numerify('################'),
            'nama_wali' => fake()->optional()->name(),
            'tahun_lahir_wali' => fake()->optional()->year('1985'),
            'jenjang_pendidikan_wali' => fake()->optional()->randomElement(['SMA', 'S1']),
            'pekerjaan_wali' => fake()->optional()->jobTitle(),
            'penghasilan_wali' => fake()->optional()->randomElement(['2 - 5 Juta']),
            'foto' => null
        ];
    }
}