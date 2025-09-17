<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\BerandaController::class, 'index'])->name('beranda');

// Route Master
Route::resource('/pegawai', App\Http\Controllers\PegawaiController::class);
Route::resource('/siswa', App\Http\Controllers\SiswaController::class);
Route::resource('/kelas', App\Http\Controllers\KelasController::class);
Route::resource('/semester', App\Http\Controllers\SemesterController::class);
Route::resource('/mata-pelajaran', App\Http\Controllers\MataPelajaranController::class);
Route::resource('/guru-mata-pelajaran', App\Http\Controllers\GuruMataPelajaranController::class);
Route::resource('/ekstrakurikuler', App\Http\Controllers\EkstrakurikulerController::class);
Route::resource('/peserta-ekstrakurikuler', App\Http\Controllers\PesertaEkstrakurikulerController::class);
// Route::resource('/profil', App\Http\Controllers\ProfilController::class);

// Route Akademik
Route::resource('/jadwal-pelajaran', App\Http\Controllers\JadwalPelajaranController::class);
Route::resource('/nilai-mata-pelajaran', App\Http\Controllers\NilaiMataPelajaranController::class);
Route::resource('/nilai-ekstrakurikuler', App\Http\Controllers\NilaiEkstrakurikulerController::class);
Route::resource('/kehadiran', App\Http\Controllers\KehadiranController::class);
Route::resource('/prestasi', App\Http\Controllers\PrestasiController::class);
Route::resource('/pengumuman', App\Http\Controllers\PengumumanController::class);
